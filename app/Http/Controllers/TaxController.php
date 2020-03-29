<?php
namespace App\Http\Controllers;

use App\Exports;
use App\Jobs\ProcessExcel;
use App\Libs\App;
use App\Libs\DxGridOfficial;
use App\Models;
use App\Models\SYSSetting;
use App\Models\TAXNote;
use App\Models\TAXRecords;
use Carbon\Carbon;
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
            'tax'       => Models\TAXRecords::find($id),
        );

        return view('tax.form', $data);
    }

    public function update($id)
    {
        $input = \Request::all();
        $tax = Models\TAXRecords::find($id);
        $tax = $this->populateSaveValue($tax, $input, array(
            'exclude' => array(
                '_token',
                '_method',
            ),
        )
        );
        $tax->save();

        return redirect()->to('tax/' . $id . '?tab=2')
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
        $response   = null;
        $controller = new DxGridOfficial('vw_owner',
            'owner_name, type, identification_no, company_no, address, email, phone_no',
            '');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return Excel::download(new Exports\OwnerExport($response['data']), '[Kastam] Senarai Pemilik (' . date('dmY HiA') . ').xlsx');
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

            // if ($taxRecords->avatar != null &&
            //     \Storage::disk('asset')->exists('avatar' . DIRECTORY_SEPARATOR . $this->getFilename('images', $user->avatar))) {
            //     \Storage::disk('asset')->delete('avatar' . DIRECTORY_SEPARATOR . $this->getFilename('images', $user->avatar));
            // }

            // $asset = Models\SYSAsset::where('for_id', $user->id)->where('for', 'User Avatar');
            // if ($asset->count() > 0) {
            //     $asset->forceDelete();
            // }

            $taxRecords->delete();

            return response()->json(['status' => true, 'message' => 'Tax record has been deleted']);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => 'Error on deleted that record']);
        }
    }
}
