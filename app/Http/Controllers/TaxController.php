<?php

namespace App\Http\Controllers;

use App\Excel\Exports\Profiling01Export;
use App\Excel\Exports\Profiling02Export;
use App\Excel\Exports\Profiling03Export;
use App\Excel\Exports\TaxRecordsExport;
use App\Jobs\ProcessExcelBase;
use App\Jobs\ProcessExcelCrs;
use App\Jobs\ProcessExcelStatement;
use App\Libs\App;
use App\Libs\DxGridOfficial;
use App\Models;
use App\Models\SYSAsset;
use App\Models\SYSSetting;
use App\Models\TAXNote;
use App\Models\TAXProfiling01;
use App\Models\TAXProfiling02;
use App\Models\TAXProfiling03;
use App\Models\TAXRecords;
use App\Models\USRHistoryLog;
use Maatwebsite\Excel\Facades\Excel;

class TaxController extends Controller
{

    use App;

    public function index()
    {
        $data = array(
            'menu'       => ['menu' => 'Tax', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item active">Tax Records</li>',
            'title'      => 'All Tax Records',
            'trashed'    => request()->get('show') == 'trashed',
        );

        return view('tax.index', $data);
    }

    public function sync()
    {
        $checkBase      = SYSSetting::where('param', 'synchronize.base')->get();
        $checkStatement = SYSSetting::where('param', 'synchronize.statement')->get();
        $checkCrs       = SYSSetting::where('param', 'synchronize.crs')->get();
        $data           = array(
            'menu'            => ['menu' => 'Tax', 'subMenu' => ''],
            'breadcrumb'      => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('tax') . '">Tax Records</a></li>
                             <li class="breadcrumb-item active">Syncronization</li>',
            'title'           => 'Import Tax Record From SST System',
            'uploadBase'      => $checkBase->count() < 1,
            'uploadStatement' => $checkStatement->count() < 1,
            'uploadCrs'       => $checkCrs->count() < 1,
            'syncBase'        => $checkBase->count() > 0,
            'syncStatement'   => $checkStatement->count() > 0,
            'syncCrs'         => $checkCrs->count() > 0,
        );

        return view('tax.sync', $data);
    }

    public function doSync()
    {
        $fileBase  = \Request::file('excelBase');
        $checkBase = SYSSetting::where('param', 'synchronize.base')->get();
        if ($fileBase != null) {
            if ($checkBase->count() > 0) {
                return redirect()->to('tax/sync');
            } else {
                $newName = 'excel-base.' . $fileBase->getClientOriginalExtension();
                $fileBase->move(env('ASSETS_STORAGE') . 'synchronize', $newName);
                $setting        = new SYSSetting();
                $setting->param = 'synchronize.base';
                $setting->value = '1';
                $setting->save();
                ProcessExcelBase::dispatch($setting, $newName, \Auth::user());
            }
        }

        $fileStatement  = \Request::file('excelStatement');
        $checkStatement = SYSSetting::where('param', 'synchronize.statement')->get();
        if ($fileStatement != null) {
            if ($checkStatement->count() > 0) {
                return redirect()->to('tax/sync');
            } else {
                $newName = 'excel-statement.' . $fileStatement->getClientOriginalExtension();
                $fileStatement->move(env('ASSETS_STORAGE') . 'synchronize', $newName);
                $setting        = new SYSSetting();
                $setting->param = 'synchronize.statement';
                $setting->value = '1';
                $setting->save();
                ProcessExcelStatement::dispatch($setting, $newName, \Auth::user());
            }
        }

        $fileCrs  = \Request::file('excelCrs');
        $checkCrs = SYSSetting::where('param', 'synchronize.crs')->get();
        if ($fileCrs != null) {
            if ($checkCrs->count() > 0) {
                return redirect()->to('tax/sync');
            } else {
                $newName = 'excel-Crs.' . $fileCrs->getClientOriginalExtension();
                $fileCrs->move(env('ASSETS_STORAGE') . 'synchronize', $newName);
                $setting        = new SYSSetting();
                $setting->param = 'synchronize.Crs';
                $setting->value = '1';
                $setting->save();
                ProcessExcelCrs::dispatch($setting, $newName, \Auth::user());
            }
        }

        $data = array(
            'menu'            => ['menu' => 'Tax', 'subMenu' => ''],
            'breadcrumb'      => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('tax') . '">Tax Records</a></li>
                             <li class="breadcrumb-item active">Syncronization</li>',
            'title'           => 'Import Tax Record From SST System',
            'uploadBase'      => !($fileBase != null),
            'uploadStatement' => !($fileStatement != null),
            'uploadCrs'       => !($fileCrs != null),
            'syncBase'        => $checkBase->count() > 0,
            'syncStatement'   => $checkStatement->count() > 0,
            'syncCrs'         => $checkCrs->count() > 0,
        );

        return view('tax.sync', $data);
    }

    public function store()
    {
        if (request()->get('section') == 'attachment') {
            $file       = \Request::file('filename');
            $attachment = new SYSAsset();
            if ($file != null) {
                $attachment->for         = 'Tax Attachment';
                $attachment->for_id      = request()->get('tax_record_id');
                $attachment->upload_by   = \Auth::user()->id;
                $attachment->asset_name  = $file->getClientOriginalName();
                $attachment->title       = strtoupper(request()->get('title'));
                $attachment->description = request()->get('description');
                $attachment->save();

                $uploadPath = env('ASSETS_STORAGE') . 'attachment' . DIRECTORY_SEPARATOR . request()->get('tax_record_id') . DIRECTORY_SEPARATOR;
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath);
                }
                $filename = $attachment->id . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);
                $attachment->file_size = \Storage::disk('asset')->size('attachment' . DIRECTORY_SEPARATOR . request()->get('tax_record_id') . DIRECTORY_SEPARATOR . $filename);
                $attachment->md5       = md5_file($uploadPath . $filename);
                $attachment->save();
            }

            $tax = TAXRecords::find(request()->get('tax_record_id'));
            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Upload attachment');

            return redirect()->to('tax/' . request()->get('tax_record_id') . '?section=' . \Request::get('section'))->with('success', 'Attachment has been uploaded.');
        } elseif (request()->get('section') == 'profiling_01') {
            $input = \Request::all();
            $tax   = TAXRecords::find(request()->get('tax_id'));

            $profiling                = new TAXProfiling01();
            $profiling->business_name = $tax->business_name;
            $profiling->sst_no        = $tax->sst_no;
            $profiling->brn_no        = $tax->brn_no;
            $profiling                = $this->populateSaveValue($profiling, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            //maintain original case
            $profiling->answer_01 = request()->get('answer_01');
            $profiling->answer_02 = request()->get('answer_02');
            $profiling->answer_03 = request()->get('answer_03');
            $profiling->answer_04 = request()->get('answer_04');
            $profiling->answer_05 = request()->get('answer_05');
            $profiling->answer_06 = request()->get('answer_06');
            $profiling->answer_07 = request()->get('answer_07');
            $profiling->answer_08 = request()->get('answer_08');
            $profiling->answer_09 = request()->get('answer_09');
            $profiling->answer_10 = request()->get('answer_10');
            $profiling->answer_11 = request()->get('answer_11');
            $profiling->answer_12 = request()->get('answer_12');
            $profiling->save();

            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Create profiling 01');

            return redirect()->to('tax/' . request()->get('tax_id') . '?section=profiling')->with('success', 'Profiling 01 has been added.');
        } elseif (request()->get('section') == 'risk_entity') {
            $input = \Request::all();
            $tax   = TAXRecords::find(request()->get('tax_id'));

            $profiling                = new TAXProfiling02();
            $profiling->business_name = $tax->business_name;
            $profiling->sst_no        = $tax->sst_no;
            $profiling->brn_no        = $tax->brn_no;
            $profiling                = $this->populateSaveValue($profiling, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            //maintain original case
            $profiling->answer_01 = request()->get('answer_01');
            $profiling->answer_02 = request()->get('answer_02');
            $profiling->answer_03 = request()->get('answer_03');
            $profiling->answer_04 = request()->get('answer_04');
            $profiling->answer_05 = request()->get('answer_05');
            $profiling->answer_06 = request()->get('answer_06');
            $profiling->answer_07 = request()->get('answer_07');
            $profiling->answer_08 = request()->get('answer_08');
            $profiling->answer_09 = request()->get('answer_09');
            $profiling->answer_10 = request()->get('answer_10');
            $profiling->answer_11 = request()->get('answer_11');
            $profiling->answer_12 = request()->get('answer_12');
            $profiling->save();

            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Create profiling 02');

            return redirect()->to('tax/' . request()->get('tax_id') . '?section=profiling')->with('success', 'Risk entity has been added.');
        } elseif (request()->get('section') == 'risk_person') {
            $input = \Request::all();
            $tax   = TAXRecords::find(request()->get('tax_id'));

            $profiling                = new TAXProfiling03();
            $profiling->business_name = $tax->business_name;
            $profiling->sst_no        = $tax->sst_no;
            $profiling->brn_no        = $tax->brn_no;
            $profiling                = $this->populateSaveValue($profiling, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            //maintain original case
            $profiling->answer_01 = request()->get('answer_01');
            $profiling->answer_02 = request()->get('answer_02');
            $profiling->answer_03 = request()->get('answer_03');
            $profiling->answer_04 = request()->get('answer_04');
            $profiling->answer_05 = request()->get('answer_05');
            $profiling->answer_06 = request()->get('answer_06');
            $profiling->answer_07 = request()->get('answer_07');
            $profiling->answer_08 = request()->get('answer_08');
            $profiling->answer_09 = request()->get('answer_09');
            $profiling->save();

            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Create profiling 03');

            return redirect()->to('tax/' . request()->get('tax_id') . '?section=profiling')->with('success', 'Risk person has been added.');
        } elseif (request()->get('section') == 'note') {
            $note                = new TAXNote();
            $note->tax_record_id = request()->get('tax_record_id');
            $note->note_by       = \Auth::user()->id;
            $note->note_title    = request()->get('note_title');
            $note->note          = request()->get('note');
            $note->save();

            $tax = TAXRecords::find(request()->get('tax_record_id'));
            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Create new note');

            return redirect()->to('tax/' . request()->get('tax_record_id') . '?section=' . \Request::get('section'))->with('success', 'Note has been added.');
        }
    }

    public function edit($id)
    {
        $data = array(
            'menu'       => ['menu' => 'Tax', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('tax') . '">Tax Records</a></li>
                             <li class="breadcrumb-item active">Edit</li>',
            'title'      => 'Update Tax Record',
            'tax'        => Models\TAXRecords::find($id),
        );

        return view('tax.form', $data);
    }

    public function update($id)
    {
        if (request()->get('section') == 'basic') {
            $input                = \Request::all();
            $tax                  = Models\TAXRecords::find($id);
            $tax                  = $this->populateSaveValue($tax, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            $tax->cdn_status_desc = request()->get('cdn_status_desc');
            $tax->save();

            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Update CDN Status');

            return redirect()->to('tax/' . $id . '?section=' . \Request::get('section'))->with('success', 'Tax information has been update.');
        } elseif (request()->get('section') == 'additional') {
            $input = \Request::all();
            $tax   = Models\TAXRecords::find($id);
            $tax   = $this->populateSaveValue($tax, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            $tax->save();

            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Update additional information');

            return redirect()->to('tax/' . $id . '?section=' . \Request::get('section'))->with('success', 'Tax information has been update.');
        } elseif (request()->get('section') == 'attachment') {
            $attachment              = SYSAsset::find(request()->get('id'));
            $attachment->title       = strtoupper(request()->get('title'));
            $attachment->description = request()->get('description');
            $file                    = \Request::file('filename');
            if ($file != null) {
                $uploadPath = env('ASSETS_STORAGE') . 'attachment' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR;
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath);
                }
                if (file_exists($uploadPath . $attachment->id . '.' . $this->getExtension($attachment))) {
                    unlink($uploadPath . $attachment->id . '.' . $this->getExtension($attachment));
                }
                $filename               = request()->get('id') . '.' . $file->getClientOriginalExtension();
                $attachment->asset_name = $file->getClientOriginalName();
                $file->move($uploadPath, $filename);
                $attachment->file_size = \Storage::disk('asset')->size('attachment' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $filename);
                $attachment->md5       = md5_file($uploadPath . $filename);
                $attachment->save();
            }
            $attachment->save();

            $tax = TAXRecords::find($attachment->for_id);
            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Update attachment');

            return redirect()->to('tax/' . $id . '?section=' . \Request::get('section'))->with('success', 'Attachment has been update.');
        } elseif (request()->get('section') == 'profiling_01') {
            $input                    = \Request::all();
            $profiling                = TAXProfiling01::find(request()->get('id'));
            $tax                      = TAXRecords::find($profiling->tax_id);
            $profiling->business_name = $tax->business_name;
            $profiling->sst_no        = $tax->sst_no;
            $profiling->brn_no        = $tax->brn_no;
            $profiling                = $this->populateSaveValue($profiling, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            //maintain original case
            $profiling->answer_01 = request()->get('answer_01');
            $profiling->answer_02 = request()->get('answer_02');
            $profiling->answer_03 = request()->get('answer_03');
            $profiling->answer_04 = request()->get('answer_04');
            $profiling->answer_05 = request()->get('answer_05');
            $profiling->answer_06 = request()->get('answer_06');
            $profiling->answer_07 = request()->get('answer_07');
            $profiling->answer_08 = request()->get('answer_08');
            $profiling->answer_09 = request()->get('answer_09');
            $profiling->answer_10 = request()->get('answer_10');
            $profiling->answer_11 = request()->get('answer_11');
            $profiling->answer_12 = request()->get('answer_12');
            $profiling->save();

            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Update profiling 01');

            return redirect()->to('tax/' . $id . '?section=profiling')->with('success', 'Profiling 01 has been update.');
        } elseif (request()->get('section') == 'risk_entity') {
            $input                    = \Request::all();
            $profiling                = TAXProfiling02::find(request()->get('id'));
            $tax                      = TAXRecords::find($profiling->tax_id);
            $profiling->business_name = $tax->business_name;
            $profiling->sst_no        = $tax->sst_no;
            $profiling->brn_no        = $tax->brn_no;
            $profiling                = $this->populateSaveValue($profiling, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            //maintain original case
            $profiling->answer_01 = request()->get('answer_01');
            $profiling->answer_02 = request()->get('answer_02');
            $profiling->answer_03 = request()->get('answer_03');
            $profiling->answer_04 = request()->get('answer_04');
            $profiling->answer_05 = request()->get('answer_05');
            $profiling->answer_06 = request()->get('answer_06');
            $profiling->answer_07 = request()->get('answer_07');
            $profiling->answer_08 = request()->get('answer_08');
            $profiling->answer_09 = request()->get('answer_09');
            $profiling->answer_10 = request()->get('answer_10');
            $profiling->answer_11 = request()->get('answer_11');
            $profiling->answer_12 = request()->get('answer_12');
            $profiling->save();

            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Update profiling 02');

            return redirect()->to('tax/' . $id . '?section=profiling')->with('success', 'Risk entity has been update.');
        } elseif (request()->get('section') == 'risk_person') {
            $input = \Request::all();

            $profiling                = TAXProfiling03::find(request()->get('id'));
            $tax                      = TAXRecords::find($profiling->tax_id);
            $profiling->business_name = $tax->business_name;
            $profiling->sst_no        = $tax->sst_no;
            $profiling->brn_no        = $tax->brn_no;
            $profiling                = $this->populateSaveValue($profiling, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            //maintain original case
            $profiling->answer_01 = request()->get('answer_01');
            $profiling->answer_02 = request()->get('answer_02');
            $profiling->answer_03 = request()->get('answer_03');
            $profiling->answer_04 = request()->get('answer_04');
            $profiling->answer_05 = request()->get('answer_05');
            $profiling->answer_06 = request()->get('answer_06');
            $profiling->answer_07 = request()->get('answer_07');
            $profiling->answer_08 = request()->get('answer_08');
            $profiling->answer_09 = request()->get('answer_09');
            $profiling->save();

            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Update profiling 03');

            return redirect()->to('tax/' . $id . '?section=profiling')->with('success', 'Risk person has been update.');
        } elseif (request()->get('section') == 'note') {
            $note             = TAXNote::find(request()->get('id'));
            $note->note_title = request()->get('note_title');
            $note->note       = request()->get('note');
            $note->save();

            $tax = TAXRecords::find($note->tax_record_id);
            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Update note');

            return redirect()->to('tax/' . $id . '?section=' . \Request::get('section'))->with('success', 'Note has been update.');
        }
    }

    public function show($id)
    {
        $tax  = TAXRecords::find($id);
        $logs = USRHistoryLog::where('log_name', 'tax')
                             ->where('subject_id', $tax->id)
                             ->orderBy('created_at', 'DESC')
                             ->get();
        $data = array(
            'menu'       => ['menu' => 'Tax', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('tax') . '">Tax Record</a></li>
                             <li class="breadcrumb-item active">Show</li>',
            'title'      => 'Show Tax Record',
            'tax'        => $tax,
            'histories'  => $logs,

        );

        return view('tax.show', $data);
    }

    public function exportExcel($exportWhat)
    {
        $response  = null;
        $arrayCols = json_decode(request()->get('column'));
        unset($arrayCols[0]);
        $cols = implode(',', $arrayCols);
        if ($exportWhat == 'list') {
            $controller = new DxGridOfficial('tax_records',
                                             $cols,
                                             'deleted_at IS NULL AND ');
        } elseif ($exportWhat == 'profiling_01') {
            $controller = new DxGridOfficial('tax_profiling_01',
                                             $cols,
                                             '');
        } elseif ($exportWhat == 'risk_entity') {
            $controller = new DxGridOfficial('tax_profiling_02',
                                             $cols,
                                             '');
        } elseif ($exportWhat == 'risk_person') {
            $controller = new DxGridOfficial('tax_profiling_03',
                                             $cols,
                                             '');
        }
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            if ($exportWhat == 'list') {
                return Excel::download(new TaxRecordsExport($response['data'], $arrayCols), '[CDN Information Integration System] Tax Records (' . date('d-m-Y') . ').xlsx');
            } elseif ($exportWhat == 'profiling_01') {
                return Excel::download(new Profiling01Export($response['data'], $arrayCols), '[CDN Information Integration System] Profiling 01 (' . date('d-m-Y') . ').xlsx');
            } elseif ($exportWhat == 'risk_entity') {
                return Excel::download(new Profiling02Export($response['data'], $arrayCols), '[CDN Information Integration System] Risk Entity (' . date('d-m-Y') . ').xlsx');
            } elseif ($exportWhat == 'risk_person') {
                return Excel::download(new Profiling03Export($response['data'], $arrayCols), '[CDN Information Integration System] Risk Person (' . date('d-m-Y') . ').xlsx');
            }
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    function print($printWhat, $id)
    {
        $tax  = TAXRecords::find($id);
        $data = [
            'tax' => $tax
        ];

        if ($printWhat == 'profiling_01') {
//            return view('print.profiling_01', $data);
            $pdf = \PDF::loadView('print.profiling_01', $data);

            return $pdf->stream('Profiling 01 (' . $tax->sst_no . ').pdf');
        } elseif ($printWhat == 'risk_entity') {
//            return view('print.risk_entity', $data);
            $pdf = \PDF::loadView('print.risk_entity', $data);

            return $pdf->stream('Risk Entity (' . $tax->sst_no . ').pdf');
        } elseif ($printWhat == 'risk_person') {
//            return view('print.risk_person', $data);
            $pdf = \PDF::loadView('print.risk_person', $data);

            return $pdf->stream('Risk Person (' . $tax->sst_no . ').pdf');
        }
    }

    function report($reportWhat)
    {
        if ($reportWhat == 'profiling_01') {
            $data = array(
                'menu'       => ['menu' => 'Report', 'subMenu' => 'Profile 01'],
                'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item active">Report</li>',
                'title'      => 'Report 01'
            );
            return view('report.profiling_01', $data);
        } elseif ($reportWhat == 'risk_entity') {
            $data = array(
                'menu'       => ['menu' => 'Report', 'subMenu' => 'Risk Entity'],
                'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item active">Report</li>',
                'title'      => 'Report Risk Entity'
            );
            return view('report.risk_entity', $data);
        } elseif ($reportWhat == 'risk_person') {
            $data = array(
                'menu'       => ['menu' => 'Report', 'subMenu' => 'Risk Person'],
                'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item active">Report</li>',
                'title'      => 'Report Risk Person'
            );
            return view('report.risk_person', $data);
        }
    }

    public function destroy($id)
    {
        if (request()->get('section') == 'basic') {
            try {
                $taxRecords = Models\TAXRecords::find($id);
                $taxRecords->delete();

                return response()->json(['status' => true, 'message' => 'Tax record has been deleted']);
            } catch (\Exception $ex) {
                return response()->json(['status' => false, 'message' => 'Error on deleted that record']);
            }
        } elseif (request()->get('section') == 'attachment') {
            try {
                $attachment = Models\SYSAsset::find(request()->get('id'));
                $taxId      = $attachment->for_id;
                $uploadPath = env('ASSETS_STORAGE') . 'attachment' . DIRECTORY_SEPARATOR . $taxId . DIRECTORY_SEPARATOR;
                if (file_exists($uploadPath . $attachment->id . '.' . $this->getExtension($attachment))) {
                    unlink($uploadPath . $attachment->id . '.' . $this->getExtension($attachment));
                }
                $attachment->delete();

                $tax = TAXRecords::find($attachment->for_id);
                activity('tax')
                    ->causedBy(\Auth::user())
                    ->performedOn($tax)
                    ->log('Delete attachment');

                return redirect()->to('tax/' . $taxId . '?section=' . \Request::get('section'))->with('success', 'Attachment has been deleted.');
            } catch (\Exception $ex) {
                return redirect()->to('tax/' . $taxId . '?section=' . \Request::get('section'))->with('error', 'Error on deleted that record.');
            }
        } elseif (request()->get('section') == 'note') {
            try {
                $note  = Models\TAXNote::find(request()->get('id'));
                $taxId = $note->tax_record_id;
                $note->delete();

                $tax = TAXRecords::find($note->tax_record_id);
                activity('tax')
                    ->causedBy(\Auth::user())
                    ->performedOn($tax)
                    ->log('Delete note');

                return redirect()->to('tax/' . $taxId . '?section=' . \Request::get('section'))->with('success', 'Note has been deleted.');
            } catch (\Exception $ex) {
                return redirect()->to('tax/' . $taxId . '?section=' . \Request::get('section'))->with('error', 'Error on deleted that record.');
            }
        } elseif (request()->get('section') == 'risk_entity') {
            $riskEntity = Models\TAXProfiling02::find(request()->get('id'));
            $taxId      = $riskEntity->tax_id;
            $riskEntity->delete();

            $tax = TAXRecords::find($taxId);
            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Delete risk entity profile');

            return redirect()->to('tax/' . $taxId . '?section=profiling')->with('success', 'Risk entity has been deleted.');
        } elseif (request()->get('section') == 'risk_person') {
            $riskPerson = Models\TAXProfiling03::find(request()->get('id'));
            $taxId      = $riskPerson->tax_id;
            $riskPerson->delete();

            $tax = TAXRecords::find($taxId);
            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Delete risk person profile');

            return redirect()->to('tax/' . $taxId . '?section=profiling')->with('success', 'Risk person has been deleted.');
        }
    }

    public function restore($id)
    {
        try {
            Models\TAXRecords::withTrashed()->find($id)->restore();

            return response()->json(['status' => true, 'message' => 'Tax record has been restores']);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => 'Error on restored that record']);
        }
    }
}
