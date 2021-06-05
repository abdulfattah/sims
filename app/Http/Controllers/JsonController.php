<?php

namespace App\Http\Controllers;

use App\Libs\App;
use App\Libs\DxGridOfficial;
use App\Models\SYSAsset;
use App\Models\SYSSetting;
use App\Models\TAXNote;
use App\Models\TAXRecords;
use App\Models\USRUsers;

class JsonController extends Controller
{
    use App;

    public function json()
    {
        $section = \Request::get('b');
        switch ($section) {
            case '55a0c60438017':
            { //item pilihan untuk selectbox, checkbox, dan radiogroup//
                $for = \Request::get('c');
                return response()->json($this->itemsOfOption($for), 200, [], JSON_NUMERIC_CHECK);
                break;
            }
            case '55a0c60437bd8':
            { //Grid untuk senarai pengguna//
                $trashed = \Request::get('c') == 1;
                return response()->json($this->userGrid($trashed), 200, []);
                break;
            }
            case '55a0c60437d14':
            { //Grid untuk senarai tax//
                $trashed = \Request::get('c') == 1;
                return response()->json($this->taxGrid($trashed), 200, []);
                break;
            }
            case '55a0c604380fe':
            { //Grid untuk report profile//
                $profile = \Request::get('c');
                return response()->json($this->reportGrid($profile), 200, []);
                break;
            }
            case '55a0c60438203':
            { //Dapatkan % processed excel//
                return response()->json($this->getProcessedExcelBase(), 200, []);
                break;
            }
            case '55a0c60438303':
            { //Dapatkan % processed excel//
                return response()->json($this->getProcessedExcelStatement(), 200, []);
                break;
            }
            case '55a0c604381b6':
            { //Dapatkan form CDN status//
                $id = \Request::get('c');
                return response()->json($this->getCDNStatus($id), 200, []);
                break;
            }
            case '55a0c60438163':
            { //Dapatkan form attachment//
                $id = \Request::get('c');
                return response()->json($this->getAttachment($id), 200, []);
                break;
            }
            case '55a0c604381b5':
            { //Dapatkan form note//
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
        } elseif ($for == 'staffs') { //khas untuk manually tambah statement
            $staffs = USRUsers::orderBy('fullname')->get();
            foreach ($staffs as $staff) {
                array_push($items, ['id' => $staff->id, 'item' => $staff->fullname]);
            }
        } else {
            $lists = config('appitem.' . $for);
            if ($for != 'roles') {
                asort($lists);
            }
            foreach ($lists as $key => $value) {
                array_push($items, ['id' => is_string($key) ? $key : $value, 'item' => $value]);
            }
        }
        return $items;
    }

    private function userGrid($trashed)
    {
        $response   = null;
        $deleted    = $trashed ? 'deleted_at IS NOT NULL AND ' : 'deleted_at IS NULL AND ';
        $controller = new DxGridOfficial('usr_users',
                                         'id, fullname, username, role',
                                         $deleted);
        $params     = $controller->GetParseParams($_GET);
        $response   = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return $response;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function taxGrid($trashed)
    {
        $response   = null;
        $deleted    = $trashed ? 'deleted_at IS NOT NULL AND ' : 'deleted_at IS NULL AND ';
        $controller = new DxGridOfficial('tax_records',
                                         'id, registration_status, registration_date, cancellation_approval, cancellation_effective, sst_no, station_code, station_name, ' .
                                         'gst_no, brn_no, business_name, trade_name, sst_type, email_address, telephone_no, company_address_1, company_address_2, ' .
                                         'company_address_3, company_postcode, company_city, company_state, correspondence_address_1, correspondence_address_2, ' .
                                         'correspondence_address_3, correspondence_postcode, correspondence_city, correspondence_state, factory_name, entity_type, ' .
                                         'business_activity, product_tax, facility_applied, local_marketing, statement, statement_status, uncomplience_type, ' .
                                         'syncronizing_at, updated_at, deleted_at',
                                         $deleted);
        $params     = $controller->GetParseParams($_GET);
        $response   = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return $response;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function reportGrid($profile)
    {
        $response   = null;
        if ($profile == 'profiling_01') {
            $controller = new DxGridOfficial('tax_profiling_01',
                                             'id, tax_id, business_name, brn_no, mark_01, mark_02, mark_03, mark_04, mark_05, mark_06, mark_07, mark_08, mark_09, mark_10, ' .
                                             'mark_11, mark_12, risk_level_text',
                                             '');
        } elseif ($profile == 'risk_entity') {
            $controller = new DxGridOfficial('tax_profiling_02',
                                             'id, tax_id, business_name, brn_no, mark_01, mark_02, mark_03, mark_04, mark_05, mark_06, mark_07, mark_08, mark_09, mark_10, ' .
                                             'mark_11, mark_12, risk_level_text',
                                             '');
        } elseif ($profile == 'risk_person') {
            $controller = new DxGridOfficial('tax_profiling_03',
                                             'id, tax_id, business_name, brn_no, mark_01, mark_02, mark_03, mark_04, mark_05, mark_06, mark_07, mark_08, mark_09, risk_level_text',
                                             '');
        }
        $params     = $controller->GetParseParams($_GET);
        $response   = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return $response;
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function getProcessedExcelBase()
    {
        $setting = SYSSetting::where('param', 'syncronize.base')->get()->first();
        if ($setting != null) {
            return $setting->value;
        } else {
            return '100';
        }
    }

    private function getProcessedExcelStatement()
    {
        $setting = SYSSetting::where('param', 'syncronize.statement')->get()->first();
        if ($setting != null) {
            return $setting->value;
        } else {
            return '100';
        }
    }

    private function getCDNStatus($id)
    {
        $cdnStatus = TAXRecords::find($id, ['cdn_status', 'cdn_status_desc']);
        if ($cdnStatus != null) {
            return $cdnStatus->toArray();
        } else {
            return null;
        }
    }

    private function getNote($id)
    {
        $note = TAXNote::find($id, ['id', 'tax_record_id', 'note_title', 'note']);
        if ($note != null) {
            return $note->toArray();
        } else {
            return null;
        }
    }

    private function getAttachment($id)
    {
        $asset = SYSAsset::find($id, ['id', 'for_id', 'title', 'description']);
        if ($asset != null) {
            return $asset->toArray();
        } else {
            return null;
        }
    }
}
