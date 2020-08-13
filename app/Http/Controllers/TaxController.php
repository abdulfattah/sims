<?php
namespace App\Http\Controllers;

use App\Exports\TaxRecordsExport;
use App\Jobs\ProcessExcel;
use App\Libs\App;
use App\Libs\DxGridOfficial;
use App\Models;
use App\Models\SYSAsset;
use App\Models\SYSSetting;
use App\Models\TAXNote;
use App\Models\TAXProfiling;
use App\Models\TAXRecords;
use App\Models\USRHistoryLog;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;

class TaxController extends Controller
{

    use App;

    public function index()
    {
        $data = array(
            'menu'       => ['menu' => 'Tax', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item active">Tax Records</li>',
            'trashed'    => request()->get('show') == 'trashed',
        );

        return view('tax.index', $data);
    }

    public function sync()
    {
        $check = SYSSetting::where('param', 'syncronize')->get();
        $data  = array(
            'menu'       => ['menu' => 'Tax', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('tax') . '">Tax Records</a></li>
                             <li class="breadcrumb-item active">Syncronization</li>',
            'upload'     => true,
            'sync'       => $check->count() > 0,
        );

        return view('tax.sync', $data);
    }

    public function doSync()
    {
        $file  = \Request::file('excel');
        $check = SYSSetting::where('param', 'syncronize')->get();
        if ($file != null) {
            if ($check->count() > 0) {
                return redirect()->to('tax/sync');
            } else {
                $newName = 'excel.' . $file->getClientOriginalExtension();
                $file->move(env('ASSETS_STORAGE') . 'syncronize', $newName);
                $setting        = new SYSSetting();
                $setting->param = 'syncronize';
                $setting->value = '1';
                $setting->save();
                ProcessExcel::dispatch($setting, $newName, \Auth::user());
            }
        }

        $data = array(
            'menu'       => ['menu' => 'Tax', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('tax') . '">Tax Records</a></li>
                             <li class="breadcrumb-item active">Syncronization</li>',
            'upload'     => false,
            'sync'       => $check->count() > 0,
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
        } elseif (request()->get('section') == 'profiling') {
            $input     = \Request::all();
            $profiling = new TAXProfiling();
            $profiling = $this->populateSaveValue($profiling, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            $profiling->save();

            $tax = TAXRecords::find(request()->get('tax_id'));
            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Create profiling');

            return redirect()->to('tax/' . request()->get('tax_id') . '?section=' . \Request::get('section'))->with('success', 'Profiling has been added.');
        } elseif (request()->get('section') == 'note') {
            $note                = new TAXNote();
            $note->tax_record_id = request()->get('tax_record_id');
            $note->note_by       = \Auth::user()->id;
            $note->note_title    = strtoupper(request()->get('note_title'));
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
            'tax'        => Models\TAXRecords::find($id),
        );

        return view('tax.form', $data);
    }

    public function update($id)
    {
        if (request()->get('section') == 'basic') {
            $input = \Request::all();
            $tax   = Models\TAXRecords::find($id);
            $tax   = $this->populateSaveValue($tax, $input, array(
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
        } elseif (request()->get('section') == 'profiling') {
            $input     = \Request::all();
            $profiling = TAXProfiling::find(request()->get('id'));
            $profiling = $this->populateSaveValue($profiling, $input, array(
                'exclude' => array('_token', '_method', 'section'),
            ));
            $profiling->save();

            $tax = TAXRecords::find($profiling->tax_id);
            activity('tax')
                ->causedBy(\Auth::user())
                ->performedOn($tax)
                ->log('Update profiling');

            return redirect()->to('tax/' . $id . '?section=' . \Request::get('section'))->with('success', 'Profiling has been update.');
        } elseif (request()->get('section') == 'note') {
            $note             = TAXNote::find(request()->get('id'));
            $note->note_title = strtoupper(request()->get('note_title'));
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
            'tax'        => $tax,
            'histories'  => $logs,

        );

        return view('tax.show', $data);
    }

    public function exportExcel()
    {
        $response  = null;
        $arrayCols = json_decode(request()->get('column'));
        unset($arrayCols[0]);
        $cols       = implode(',', $arrayCols);
        $controller = new DxGridOfficial('tax_records',
            $cols,
            'deleted_at IS NULL AND ');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return Excel::download(new TaxRecordsExport($response['data'], $arrayCols), '[CDN Information Integration System] Tax Records (' . date('d-m-Y') . ').xlsx');
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
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
