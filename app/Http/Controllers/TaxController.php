<?php
namespace App\Http\Controllers;

use App\Exports\TaxRecordsExport;
use App\Jobs\ProcessExcel;
use App\Libs\App;
use App\Libs\DxGridOfficial;
use App\Models;
use App\Models\SYSSetting;
use App\Models\TAXRecords;
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
                ProcessExcel::dispatch($setting, $newName);
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
        $input = \Request::all();
        $tax   = Models\TAXRecords::find($id);
        $tax   = $this->populateSaveValue($tax, $input, array(
            'exclude' => array(
                '_token',
                '_method',
            ),
        )
        );
        $tax->save();

        return redirect()->to('tax/' . $id . '?section=2')
            ->with('success', 'Tax information has been update.');
    }

    public function show($id)
    {
        $tax  = TAXRecords::find($id);
        $data = array(
            'menu'       => ['menu' => 'Tax', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('tax') . '">Tax Record</a></li>
                             <li class="breadcrumb-item active">Show</li>',
            'tax'        => $tax,
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
        try {
            $taxRecords = Models\TAXRecords::find($id);
            $taxRecords->delete();

            return response()->json(['status' => true, 'message' => 'Tax record has been deleted']);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => 'Error on deleted that record']);
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
