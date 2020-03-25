<?php
namespace App\Http\Controllers;

use App\Libs\App;
use App\Models;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    use App;

    public function edit($tab)
    {
        $data = array(
            'menu'       => ['menu' => 'Tetapan', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Utama</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('user') . '">Pengguna</a></li>
                             <li class="breadcrumb-item active">Tetapan</li>',
        );

        if ($tab == 1) {
            $data['emelDaripada'] = Models\SYSSetting::where('param', 'emel_daripada')->get(['param', 'value'])->first()->toArray();
            $data['emelNama']     = Models\SYSSetting::where('param', 'emel_nama')->get(['param', 'value'])->first()->toArray();
        } elseif ($tab == 3) {
            $data['proCategories'] = config('epenilaian.kategoriHarta');
            unset($data['proCategories']['hartaPersendirian']);
            if (\Session::get('subTab') != null) {
                $hartaKhas       = Models\SYSItems::where('item', \Session::get('subTab'))->get()->first();
                $data['subList'] = Models\SYSItems::orderBy('item', 'asc')->descendantsOf($hartaKhas->id)->toFlatTree();
                $data['active']  = \Session::get('subTab');
            } else {
                $hartaKhas       = Models\SYSItems::where('item', 'hartaKerajaanPersekutuan')->get()->first();
                $data['subList'] = Models\SYSItems::orderBy('item', 'asc')->descendantsOf($hartaKhas->id)->toFlatTree();
                $data['active']  = 'hartaKerajaanPersekutuan';
            }
        } elseif ($tab == 4) {
            $data['buildings'] = config('epenilaian.kategoriBangunan');
            if (\Session::get('subTab') != null) {
                $hartaKhas       = Models\SYSItems::where('item', \Session::get('subTab'))->get()->first();
                $data['subList'] = Models\SYSItems::orderBy('item', 'asc')->descendantsOf($hartaKhas->id)->toFlatTree();
                $data['active']  = \Session::get('subTab');
            } else {
                $hartaKhas       = Models\SYSItems::where('item', 'bangunanKediaman')->get()->first();
                $data['subList'] = Models\SYSItems::orderBy('item', 'asc')->descendantsOf($hartaKhas->id)->toFlatTree();
                $data['active']  = 'bangunanKediaman';
            }
        } elseif ($tab == 5) {
            $data['gates'] = ['strukturPagar' => 'PAGAR', 'strukturPintuPagar' => 'PINTU PAGAR'];
            if (\Session::get('subTab') != null) {
                $hartaKhas       = Models\SYSItems::where('item', \Session::get('subTab'))->get()->first();
                $data['subList'] = Models\SYSItems::orderBy('item', 'asc')->descendantsOf($hartaKhas->id)->toFlatTree();
                $data['active']  = \Session::get('subTab');
            } else {
                $hartaKhas       = Models\SYSItems::where('item', 'strukturPagar')->get()->first();
                $data['subList'] = Models\SYSItems::orderBy('item', 'asc')->descendantsOf($hartaKhas->id)->toFlatTree();
                $data['active']  = 'strukturPagar';
            }
        } elseif ($tab == 6) {
            $data['others'] = [
                'bangsa'         => 'BANGSA',
                'jalanTerdekat'  => 'JALAN MASUK',
                'jenisSiling'    => 'JENIS SILING',
                'jenisLantai'    => 'JENIS LANTAI',
                'jenisDinding'   => 'JENIS DINDING',
                'jenisBumbung'   => 'JENIS BUMBUNG',
                'jawatan'        => 'JAWATAN',
                'keadaanTanah'   => 'KEADAAN TANAH',
                'kegunaanTanah'  => 'KEGUNAAN TANAH',
                'kemudahan'      => 'KEMUDAHAN',
                'kodHakMilik'    => 'KOD HAK MILIK',
                'kodLot'         => 'KOD LOT',
                'jenisPemilikan' => 'JENIS PEMILIKAN',
                'parasTanah'     => 'PARAS TANAH',
                'sekatanTanah'   => 'SEKATAN TANAH',
                'warganegara'    => 'WARGANEGARA',
            ];
            if (\Session::get('subTab') != null) {
                $hartaKhas       = Models\SYSItems::where('item', \Session::get('subTab'))->get()->first();
                $data['subList'] = Models\SYSItems::orderBy('item', 'asc')->descendantsOf($hartaKhas->id)->toFlatTree();
                $data['active']  = \Session::get('subTab');
            } else {
                $hartaKhas       = Models\SYSItems::where('item', 'bangsa')->get()->first();
                $data['subList'] = Models\SYSItems::orderBy('item', 'asc')->descendantsOf($hartaKhas->id)->toFlatTree();
                $data['active']  = 'bangsa';
            }
        }

        return view('system.config.edit', $data);
    }

    public function store($tab, Request $request)
    {
        if ($tab == 2) {
            if ($request->get('id') != null) {
                $zone = Models\SYSItems::find($request->get('id'));
            } else {
                $zone = Models\SYSItems::where('item', 'zon')->get()->first();
            }
            $level = Models\SYSItems::withDepth()->find($zone->id);
            if ($level->depth < config('epenilaian.arasZon')) {
                $checkExisting = Models\SYSItems::where('item', strtoupper($request->get('zone')))->where('parent_id', $zone->id)->get();
                if ($checkExisting->count() < 1) {
                    $newZone       = new Models\SYSItems();
                    $newZone->id   = Uuid::uuid4()->getHex();
                    $newZone->item = strtoupper($request->get('zone'));
                    $zone->appendNode($newZone);
                    return redirect('edit/config/2')->with('success', 'Kawasan telah ditambah');
                } else {
                    return redirect('edit/config/2')->with('subTab', $request->get('property_category'))->with('error', 'Kawasan ini telah wujud');
                }
            } else {
                return redirect('edit/config/2')->with('error', 'Maksimum hanya ' . config('epenilaian.arasZon') . ' level kawasan sahaja');
            }

        } elseif ($tab == 3) {
            $proCategory   = Models\SYSItems::where('item', $request->get('property_category'))->get()->first();
            $checkExisting = Models\SYSItems::where('item', strtoupper($request->get('procategory_item')))->where('parent_id', $proCategory->id)->get();
            if ($checkExisting->count() < 1) {
                $proCategoryItem       = new Models\SYSItems();
                $proCategoryItem->id   = Uuid::uuid4()->getHex();
                $proCategoryItem->item = strtoupper($request->get('procategory_item'));
                $proCategory->appendNode($proCategoryItem);
                return redirect('edit/config/3')->with('subTab', $request->get('property_category'))->with('success', 'Kategori harta telah ditambah');
            } else {
                return redirect('edit/config/3')->with('subTab', $request->get('property_category'))->with('error', 'Kategori harta ini telah wujud');
            }
        } elseif ($tab == 4) {
            $buildingCategory = Models\SYSItems::where('item', $request->get('building_category'))->get()->first();
            $checkExisting    = Models\SYSItems::where('item', strtoupper($request->get('building_type')))->where('parent_id', $buildingCategory->id)->get();
            if ($checkExisting->count() < 1) {
                $buildingType       = new Models\SYSItems();
                $buildingType->id   = Uuid::uuid4()->getHex();
                $buildingType->item = strtoupper($request->get('building_type'));
                $buildingCategory->appendNode($buildingType);
                return redirect('edit/config/4')->with('subTab', $request->get('building_category'))->with('success', 'Jenis bangunan telah ditambah');
            } else {
                return redirect('edit/config/4')->with('subTab', $request->get('building_category'))->with('error', 'Jenis bangunan ini telah wujud');
            }
        } elseif ($tab == 5) {
            $gateCategory  = Models\SYSItems::where('item', $request->get('gate_category'))->get()->first();
            $checkExisting = Models\SYSItems::where('item', strtoupper($request->get('gate_type')))->where('parent_id', $gateCategory->id)->get();
            if ($checkExisting->count() < 1) {
                $gateType       = new Models\SYSItems();
                $gateType->id   = Uuid::uuid4()->getHex();
                $gateType->item = strtoupper($request->get('gate_type'));
                $gateCategory->appendNode($gateType);
                return redirect('edit/config/5')->with('subTab', $request->get('gate_category'))->with('success', 'Jenis struktur pagar telah ditambah');
            } else {
                return redirect('edit/config/5')->with('subTab', $request->get('gate_category'))->with('error', 'Jenis struktur pagar ini telah wujud');
            }
        } elseif ($tab == 6) {
            $otherCategory = Models\SYSItems::where('item', $request->get('other_category'))->get()->first();
            $checkExisting = Models\SYSItems::where('item', strtoupper($request->get('other_type')))->where('parent_id', $otherCategory->id)->get();
            if ($checkExisting->count() < 1) {
                $otherType       = new Models\SYSItems();
                $otherType->id   = Uuid::uuid4()->getHex();
                $otherType->item = strtoupper($request->get('other_type'));
                $otherCategory->appendNode($otherType);
                return redirect('edit/config/6')->with('subTab', $request->get('other_category'))->with('success', 'Item telah ditambah');
            } else {
                return redirect('edit/config/6')->with('subTab', $request->get('other_category'))->with('error', 'Item ini telah wujud');
            }
        }
    }

    public function update($tab, Request $request)
    {
        if ($tab == 1) {
            $emelDaripada        = Models\SYSSetting::where('param', 'emel_daripada')->get()->first();
            $emelDaripada->value = $request->get('emel_daripada');
            $emelDaripada->save();

            $emelNama        = Models\SYSSetting::where('param', 'emel_nama')->get()->first();
            $emelNama->value = strtoupper($request->get('emel_nama'));
            $emelNama->save();

            return redirect('edit/config/1')->with('success', 'Tetapan umum telah dikemaskini');
        } elseif ($tab == 2) {
            // TODO: macamana nak update area_text pada pro_property, ass_building_rate, dan ass_tax_rate?
            // kena schedule regenerate area_text semua row kat background.
            $zone       = Models\SYSItems::find($request->get('id'));
            $parentZone = Models\SYSItems::find($zone->parent_id);
            if (strtoupper($request->get('zone')) != $zone->item) {
                $checkExisting = Models\SYSItems::where('item', strtoupper($request->get('zone')))->where('parent_id', $parentZone->id)->get();
                if ($checkExisting->count() < 1) {
                    $zone->item = strtoupper($request->get('zone'));
                    $zone->save();
                    return redirect('edit/config/2')->with('success', 'Kawasan telah dikemaskini');
                } else {
                    return redirect('edit/config/2')->with('error', 'Kawasan ini telah wujud');
                }
            }
            return redirect('edit/config/2')->with('success', 'Kawasan telah dikemaskini');

        } elseif ($tab == 3) {
            $proCategoryItem = Models\SYSItems::find($request->get('id'));
            $proCategory     = Models\SYSItems::find($proCategoryItem->parent_id);
            if (strtoupper($request->get('procategory_item')) != $proCategoryItem->item) {
                $checkExisting = Models\SYSItems::where('item', strtoupper($request->get('procategory_item')))->where('parent_id', $proCategory->id)->get();
                if ($checkExisting->count() < 1) {
                    $proCategoryItem->item = strtoupper($request->get('procategory_item'));
                    $proCategoryItem->save();
                    return redirect('edit/config/3')->with('subTab', $request->get('property_category'))->with('success', 'Kategori harta telah dikemaskini');
                } else {
                    return redirect('edit/config/3')->with('subTab', $request->get('property_category'))->with('error', 'Kategori harta ini telah wujud');
                }
            }
            return redirect('edit/config/3')->with('subTab', $request->get('property_category'))->with('success', 'Kategori harta telah dikemaskini');
        } elseif ($tab == 4) {
            $buildingType     = Models\SYSItems::find($request->get('id'));
            $buildingCategory = Models\SYSItems::find($buildingType->parent_id);
            if (strtoupper($request->get('building_type')) != $buildingType->item) {
                $checkExisting = Models\SYSItems::where('item', strtoupper($request->get('building_type')))->where('parent_id', $buildingCategory->id)->get();
                if ($checkExisting->count() < 1) {
                    $buildingType->item = strtoupper($request->get('building_type'));
                    $buildingType->save();
                    return redirect('edit/config/4')->with('subTab', $request->get('building_category'))->with('success', 'Jenis bangunan telah dikemaskini');
                } else {
                    return redirect('edit/config/4')->with('subTab', $request->get('building_category'))->with('error', 'Jenis bangunan ini telah wujud');
                }
            }
            return redirect('edit/config/4')->with('subTab', $request->get('building_category'))->with('success', 'Jenis bangunan telah dikemaskini');
        } elseif ($tab == 5) {
            $gateType     = Models\SYSItems::find($request->get('id'));
            $gateCategory = Models\SYSItems::find($gateType->parent_id);
            if (strtoupper($request->get('gate_type')) != $gateType->item) {
                $checkExisting = Models\SYSItems::where('item', strtoupper($request->get('gate_type')))->where('parent_id', $gateCategory->id)->get();
                if ($checkExisting->count() < 1) {
                    $gateType->item = strtoupper($request->get('gate_type'));
                    $gateType->save();
                    return redirect('edit/config/5')->with('subTab', $request->get('gate_category'))->with('success', 'Jenis struktur pagar telah dikemaskini');
                } else {
                    return redirect('edit/config/5')->with('subTab', $request->get('gate_category'))->with('error', 'Jenis struktur pagar ini telah wujud');
                }
            }
            return redirect('edit/config/5')->with('subTab', $request->get('gate_category'))->with('success', 'Jenis struktur pagar telah dikemaskini');
        } elseif ($tab == 6) {
            $otherType     = Models\SYSItems::find($request->get('id'));
            $otherCategory = Models\SYSItems::find($otherType->parent_id);
            if (strtoupper($request->get('other_type')) != $otherType->item) {
                $checkExisting = Models\SYSItems::where('item', strtoupper($request->get('other_type')))->where('parent_id', $otherCategory->id)->get();
                if ($checkExisting->count() < 1) {
                    $otherType->item = strtoupper($request->get('other_type'));
                    $otherType->save();
                    return redirect('edit/config/6')->with('subTab', $request->get('other_category'))->with('success', 'Item telah dikemaskini');
                } else {
                    return redirect('edit/config/6')->with('subTab', $request->get('other_category'))->with('error', 'Item ini telah wujud');
                }
            }
            return redirect('edit/config/6')->with('subTab', $request->get('other_category'))->with('success', 'Item telah dikemaskini');
        }
    }

    public function delete($tab, Request $request)
    {
        if ($tab == 2) {
            $zones = Models\SYSItems::descendantsAndSelf($request->get('id'))->toFlatTree();
            foreach ($zones as $zone) {
                Models\PROProperty::where('area_id', $request->get('id'))->update(['area_id' => null, 'area_text' => null]);
                Models\ASSBuildingRate::where('area_id', $request->get('id'))->update(['area_id' => null, 'area_text' => null]);
                Models\ASSTaxRate::where('area_id', $request->get('id'))->update(['area_id' => null, 'area_text' => null]);
            }

            $zone = Models\SYSItems::find($request->get('id'));
            $zone->delete();

            return redirect('edit/config/2')->with('success', 'Kawasan dan semua sub kawasan telah dihapuskan');

        } elseif ($tab == 3) {
            $proCategoryItem = Models\SYSItems::find($request->get('id'));
            $proCategory     = $proCategoryItem->ancestors[0]->item;
            $proCategoryItem->delete();

            return redirect('edit/config/3')->with('subTab', $proCategory)->with('success', 'Kategori harta telah dihapuskan');
        } elseif ($tab == 4) {
            $buildingType     = Models\SYSItems::find($request->get('id'));
            $buildingCategory = $buildingType->ancestors[0]->item;
            $buildingType->delete();

            return redirect('edit/config/4')->with('subTab', $buildingCategory)->with('success', 'Jenis bangunan telah dihapuskan');
        } elseif ($tab == 5) {
            $gateType     = Models\SYSItems::find($request->get('id'));
            $gateCategory = $gateType->ancestors[0]->item;
            $gateType->delete();

            return redirect('edit/config/5')->with('subTab', $gateCategory)->with('success', 'Jenis struktur pagar telah dihapuskan');
        } elseif ($tab == 6) {
            $otherType     = Models\SYSItems::find($request->get('id'));
            $otherCategory = $otherType->ancestors[0]->item;
            $otherType->delete();

            return redirect('edit/config/6')->with('subTab', $otherCategory)->with('success', 'Item telah dihapuskan');
        }
    }
}
