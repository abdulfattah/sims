<?php
namespace App\Http\Controllers;

use App\Libs\DxGridOfficial;
use App\Libs\App;
use App\Models;

/*
 *55a0c604380fe<br />55a0c60438163<br />55a0c604381b5<br />55a0c60438203
 */

class JsonController extends Controller
{
    use App;

    public function json()
    {
        $section = \Request::get('b');
        switch ($section) {
            case '55a0c60438017':{ //item pilihan untuk selectbox, checkbox, dan radiogroup
                    $for = \Request::get('c');
                    return response()->json($this->itemsOfOption($for), 200, [], JSON_NUMERIC_CHECK);
                    break;
                }
            case '55a0c60437bd8':{ //Grid untuk senarai pengguna
                    return response()->json($this->usersGrid(), 200, []);
                    break;
                }
            case '55a0c60437d14':{ //Grid untuk senarai harta
                    return response()->json($this->propertyGrid(), 200, []);
                    break;
                }
            case '55a0c604380b1':{ //Grid untuk senarai pemilik
                    return response()->json($this->ownerGrid(), 200, []);
                    break;
                }
            case '55a0c60437e48':{ //Json dapatkan grid building rate item
                    return response()->json($this->buildingRateGrid(), 200, []);
                    break;
                }
            case '55a0c60437e96':{ //Json dapatkan grid tax rate
                    return response()->json($this->taxRateGrid(), 200, []);
                    break;
                }
            case '55a0c60437f7d':{ //Json dapatkan grid list assessment
                    return response()->json($this->listAssessmentGrid(), 200, []);
                    break;
                }
            case '55a0c6043880f':{ //Json dapatkan maklumat pemilik
                    $id = \Request::get('c');
                    return response()->json($this->editOwner($id), 200, [], JSON_NUMERIC_CHECK);
                    break;
                }
            case '55a0c60438064':{ //Json dapatkan pemilik by checking
                    return response()->json($this->checkOwner(), 200, [], JSON_NUMERIC_CHECK);
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

    private function usersGrid()
    {
        $response   = null;
        $controller = new DxGridOfficial('usr_users',
            'id, fullname, username, role',
            '');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return response()->json($response)->getData();
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function propertyGrid()
    {
        $response   = null;
        $controller = new DxGridOfficial('vw_property',
            'id, reference_no, account_no, file_no, address, category, area_text, current_status, updated_at',
            '');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return response()->json($response)->getData();
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function ownerGrid()
    {
        $response   = null;
        $controller = new DxGridOfficial('vw_owner',
            'id, owner_name, type, identification_no, company_no, address, email, phone_no',
            '');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return response()->json($response)->getData();
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function buildingRateGrid()
    {
        $response   = null;
        $controller = new DxGridOfficial('ass_building_rate',
            'id, area_text, category_name, type, total_level, for_level, wide_type, rate',
            '');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return response()->json($response)->getData();
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function taxRateGrid()
    {
        $response   = null;
        $controller = new DxGridOfficial('ass_tax_rate',
            'id, area_text, category_name, type, rate',
            '');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return response()->json($response)->getData();
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function listAssessmentGrid()
    {
        $response   = null;
        $controller = new DxGridOfficial('ass_list',
            'id, account_no, area, sub_area, use_of_land, total_mfa, total_afa, address, owner,
        owner_address, building_type, monthly_value, total_value, discount, value_after_discount, tax_rate, tax, error, auto',
            '');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return response()->json($response)->getData();
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    private function editOwner($id)
    {
        return Models\PROOwner::find($id);
    }

    private function checkOwner()
    {
        $checkingValue = \Request::get('c');
        if (is_numeric($checkingValue) && strlen($checkingValue) == 12) {
            $checkingValue = substr($checkingValue, 0, 6) . '-' . substr($checkingValue, 6, 2) . '-' . substr($checkingValue, 8, 4);
        }
        $finalOwners = [];
        $checkingSQL = Models\PROOwner::select(['id', 'owner_name', 'type', 'identification_no', 'company_no'])
            ->orWhere('owner_name', 'like', '%' . strtoupper($checkingValue) . '%')
            ->orWhere('identification_no', $checkingValue)
            ->orWhere('company_no', $checkingValue)
            ->get();

        foreach ($checkingSQL as $owner) {
            array_push($finalOwners, ['id' => $owner->id, 'owner_name' => $owner->owner_name, 'type' => $owner->type, 'identification_no' => $owner->identification_no, 'company_no' => $owner->company_no]);
        }

        return $finalOwners;
    }
}
