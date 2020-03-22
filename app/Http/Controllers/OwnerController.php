<?php
namespace App\Http\Controllers;

use App\Exports;
use App\Libs\DxGridOfficial;
use App\Libs\App;
use App\Models;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;

class OwnerController extends Controller
{

    use App;

    public function index()
    {
        $data = array(
            'menu'       => ['menu' => 'Harta', 'subMenu' => 'Pemilik'],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item active">Pemilik</li>',
        );

        return view('property.owner.index', $data);
    }

    public function store($type, $tab, $ref = null)
    {
        $input     = \Request::all();
        $owner     = new Models\PROOwner();
        $owner->id = Uuid::uuid4()->getHex();
        $owner     = $this->populateSaveValue($owner, $input, array(
            'exclude' => array(
                '_token',
                'owner_id',
                'attach_to_property', //tak digunakan pada store, hanya unt update
                'picture',
                'officer_company',
                'officer_gov',
                'billing_to',
                'note',
            ),
        )
        );
        $owner->officer    = $input['officer_company'] != null ? strtoupper($input['officer_company']) : strtoupper($input['officer_gov']);
        $owner->billing_to = $input['billing_to'] == 'true' ? 1 : 0;
        $owner->note       = $input['note'];
        $owner->save();

        $file = \Request::file('picture');
        if ($file != null) {
            $this->upload($file, $ref, 'owner_avatar', $owner->id);
        }

        $property = Models\PROProperty::where('reference_no', $ref)->first();
        $property->owners()->attach($owner);

        return redirect()->back();
    }

    public function update($type, $tab, $ref = null)
    {
        $input = \Request::all();
        $owner = Models\PROOwner::find($input['owner_id']);
        $owner = $this->populateSaveValue($owner, $input, array(
            'exclude' => array(
                '_token',
                'owner_id',
                'attach_to_property',
                'picture',
                'officer_company',
                'officer_gov',
                'billing_to',
                'note',
            ),
        )
        );
        $owner->officer    = $input['officer_company'] != null ? strtoupper($input['officer_company']) : strtoupper($input['officer_gov']);
        $owner->billing_to = $input['billing_to'] == 'true' ? 1 : 0;
        $owner->note       = $input['note'];
        $owner->save();

        $file = \Request::file('picture');
        if ($file != null) {
            $this->upload($file, $ref, 'owner_avatar', $owner->id);
        }

        $owner->save();

        if ($input['attach_to_property'] == 'true') {
            $property = Models\PROProperty::where('reference_no', $ref)->first();
            //TODO check jika dah attach
            $property->owners()->attach($owner);
        }

        return redirect()->to('edit/property/' . $type . '/' . $tab . '/' . $ref)
            ->with('success', 'Maklumat harta telah dikemaskini.');
    }

    public function show()
    {
        $data = array(
            'menu'       => ['menu' => 'Harta', 'subMenu' => 'Pemilik'],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('owner') . '">Pemilik</a></li>
                             <li class="breadcrumb-item active">Papar</li>',
        );

        return view('property.owner.show', $data);
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

    public function delete($type, $tab, $ref = null)
    {
        $owner             = Models\PROOwner::find(\Request::input('id'));
        $relatedWithOthers = false;
        foreach ($owner->properties as $property) {
            if ($property->reference_no != $ref) {
                $relatedWithOthers = true;
            }
        };

        if (!$relatedWithOthers) {
            if ($owner->avatar != null) {
                $this->deleteUpload($owner->avatar, $ref);
            }
            $property = Models\PROProperty::where('reference_no', $ref)->first();
            $property->owners()->detach($owner);
            $owner->forceDelete();
        } else {
            $property = Models\PROProperty::where('reference_no', $ref)->first();
            $property->owners()->detach($owner);
        }

        return redirect()->to('edit/property/single/4/' . $ref)->with('success', 'Maklumat pemilik telah dihapuskan.');
    }
}
