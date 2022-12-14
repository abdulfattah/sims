<?php

namespace App\Http\Controllers;

use App\Libs\App;
use App\Libs\DxGridOfficial;
use App\Models\SYSAsset;
use App\Models\SYSSetting;
use App\Models\TAXCurrentReturnStatus;
use App\Models\TAXGesaan;
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
            case '55a0c60438403':
            { //Dapatkan % processed excel//
                return response()->json($this->getProcessedExcelCrsCp(), 200, []);
                break;
            }
            case '55a0c60411103':
            { //Dapatkan % processed excel//
                return response()->json($this->getProcessedExcelCrsCj(), 200, []);
                break;
            }
            case '55a0c604381b6':
            { //Dapatkan form SIMS status//
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
            case '55a0c605481b5':
            { //Dapatkan crs data//
                $id = \Request::get('c');
                return response()->json($this->getCRS($id), 200, []);
                break;
            }
            case '55abc604310b5':
            { //Dapatkan form note//
                $id = \Request::get('c');
                return response()->json($this->getGesaan($id), 200, []);
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
            if ($for != 'roles' || $for != 'pushType' || $for != 'bodStatus' || $for != 'bodPenaltyRate') {
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
        } elseif ($profile == 'push_report') {
            $controller = new DxGridOfficial('vw_tax_gesaan',
                                             'id, tax_crs_id, crs_taxable_period, tax_record_id, business_name, sst_no, email_address, telephone_no, push_type, push_gesaan_date, push_status_penyata, 
                                             push_pic, push_ikrar_penyata_date, push_email_date, push_email_time, push_phone_date, push_phone_time, push_whatsapp_date, 
                                             push_whatsapp_time, push_visit_date, push_visit_time, push_bod_penalty_rate, push_bod_penalty_amount, push_bod_status, push_bod_abt, 
                                             push_note',
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
        $setting = SYSSetting::where('param', 'synchronize.base')->get()->first();
        if ($setting != null) {
            return $setting->value;
        } else {
            return '100';
        }
    }

    private function getProcessedExcelStatement(): string
    {
        $setting = SYSSetting::where('param', 'synchronize.statement')->get()->first();
        if ($setting != null) {
            return $setting->value;
        } else {
            return '100';
        }
    }

    private function getProcessedExcelCrsCp(): string
    {
        $setting = SYSSetting::where('param', 'synchronize.crs.cp')->get()->first();
        if ($setting != null) {
            return $setting->value;
        } else {
            return '100';
        }
    }

    private function getProcessedExcelCrsCj(): string
    {
        $setting = SYSSetting::where('param', 'synchronize.crs.cj')->get()->first();
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

    private function getCRS($id)
    {
        $crs = TAXCurrentReturnStatus::find($id);
        if ($crs != null) {
            $crs->crs_due_date = $crs->crs_due_date != null ? date('d M Y', strtotime($crs->crs_due_date)) : null;
            $crs->crs_submit_date = $crs->crs_submit_date != null ? date('d M Y', strtotime($crs->crs_submit_date)) : null;
            $crs->crs_receipt_date = $crs->crs_receipt_date != null ? date('d M Y', strtotime($crs->crs_receipt_date)) : null;
            $crs->crs_tax_payable = $crs->crs_tax_payable != null ? 'RM' . number_format($crs->crs_tax_payable, 2) : null;
            $crs->crs_receipt_amt = $crs->crs_receipt_amt != null ? 'RM' . number_format($crs->crs_receipt_amt, 2) : null;
            $crs->crs_penalty_amt = $crs->crs_penalty_amt != null ? 'RM' . number_format($crs->crs_penalty_amt, 2) : null;
            $crs->crs_bod_tax_paid = $crs->crs_bod_tax_paid != null ? 'RM' . number_format($crs->crs_bod_tax_paid, 2) : null;
            $crs->crs_bod_total_tax = $crs->crs_bod_total_tax != null ? 'RM' . number_format($crs->crs_bod_total_tax, 2) : null;
            $crs->crs_bod_penalty_paid = $crs->crs_bod_penalty_paid != null ? 'RM' . number_format($crs->crs_bod_penalty_paid, 2) : null;
            $crs->crs_bod_total_penalty = $crs->crs_bod_total_penalty != null ? 'RM' . number_format($crs->crs_bod_total_penalty, 2) : null;

            return $crs->toArray();
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

    private function getGesaan($id)
    {
        $gesaan = TAXGesaan::find($id);
        if ($gesaan != null) {
            return $gesaan->toArray();
        } else {
            return null;
        }
    }
}
