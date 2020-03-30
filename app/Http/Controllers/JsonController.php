<?php
namespace App\Http\Controllers;

use App\Libs\App;
use App\Libs\DxGridOfficial;
use App\Models\SYSAsset;
use App\Models\SYSSetting;
use App\Models\TAXNote;

/*
 *55a0c604380fe
 */

class JsonController extends Controller
{
    use App;

    public function json()
    {
        $section = \Request::get('b');
        switch ($section) {
            case '55a0c60438017':{ //item pilihan untuk selectbox, checkbox, dan radiogroup//
                    $for = \Request::get('c');
                    return response()->json($this->itemsOfOption($for), 200, [], JSON_NUMERIC_CHECK);
                    break;
                }
            case '55a0c60437bd8':{ //Grid untuk senarai pengguna//
                    return response()->json($this->userGrid(), 200, []);
                    break;
                }
            case '55a0c60437d14':{ //Grid untuk senarai tax//
                    return response()->json($this->taxGrid(), 200, []);
                    break;
                }
            case '55a0c60438203':{ //Dapatkan % processed excel//
                    return response()->json($this->getProcessedExcel(), 200, []);
                    break;
                }
            case '55a0c60438163':{ //Dapatkan form attach,ent//
                    $id = \Request::get('c');
                    return response()->json($this->getAttachment($id), 200, []);
                    break;
                }
            case '55a0c604381b5':{ //Dapatkan form note//
                    $id = \Request::get('c');
                    return response()->json($this->getNote($id), 200, []);
                    break;
                }
        }
    }

    private function itemsOfOption($for)
    {
        $items = [];
        if ($for == '' || $for == 'empty' || $for == 'undefined' || $for == 'null') {
            return $items;
        }
        $lists = config('appitem.' . $for);
        if ($for != 'roles') {
            asort($lists);
        }
        foreach ($lists as $key => $value) {
            array_push($items, ['id' => is_string($key) ? $key : $value, 'item' => $value]);
        }

        return $items;
    }

    private function userGrid()
    {
        $response   = null;
        $controller = new DxGridOfficial('usr_users',
            'id, fullname, username, role',
            'deleted_at IS NULL AND ');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return $response;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function taxGrid()
    {
        $response   = null;
        $controller = new DxGridOfficial('tax_records',
            'id, registration_status, registration_date, cancellation_approval, cancellation_effective, sst_no, station_code, station_name, ' .
            'gst_no, brn_no, business_name, trade_name, sst_type, email_address, telephone_no, company_address_1, company_address_2, ' .
            'company_address_3, company_postcode, company_city, company_state, correspondence_address_1, correspondence_address_2, ' .
            'correspondence_address_3, correspondence_postcode, correspondence_city, correspondence_state, factory_name, entity_type, ' .
            'business_activity, product_tax, facility_applied, local_marketing, statement, statement_status, uncomplience_type, ' .
            'syncronizing_at, updated_at',
            'deleted_at IS NULL AND ');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return $response;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function getProcessedExcel()
    {
        $setting = SYSSetting::where('param', 'syncronize')->get()->first();
        if ($setting != null) {
            return $setting->value;
        } else {
            return '100';
        }
    }

    private function getNote($id)
    {
        $note = TAXNote::find($id, ['id', 'note']);
        if ($note != null) {
            return $note->toArray();
        } else {
            return null;
        }
    }

    private function getAttachment($id)
    {
        $asset = SYSAsset::find($id, ['id', 'title', 'description']);
        if ($asset != null) {
            return $asset->toArray();
        } else {
            return null;
        }
    }
}
