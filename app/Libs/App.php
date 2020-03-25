<?php

namespace App\Libs;

use App\Models;

trait App
{
    /**
     *
     * @param      $model
     * @param      $input
     * @param null $option With 'exclude' item to exclude post data, and 'date' to format post data if date exist
     *
     * @return array
     */
    public function populateSaveValue($model, $input, $option = null)
    {
        foreach ($input as $key => $value) {
            if ($option != null) {
                if (isset($option['exclude'])) {
                    if (array_search($key, $option['exclude']) === false) {
                        if (isset($option['exclude_prefix']) && substr($key, 0, strlen($option['exclude_prefix'])) != $option['exclude_prefix']) {
                            $key = substr($key, strlen($option['exclude_prefix']));
                            if (isset($option['date'])) {
                                if (array_search($key, $option['date']) !== false) {
                                    $model->$key = $value == '' ? null : date("Y-m-d", strtotime($value));
                                } else {
                                    if ($key == 'username' || $key == 'email') {
                                        $model->$key = $value == '' ? null : $value;
                                    } elseif ($key == 'identification_no') {
                                        $model->$key = $value == '' ? null : substr($value, 0, 6) . '-' . substr($value, 6, 2) . '-' . substr($value, 8, 4);
                                    } else {
                                        $model->$key = $value == '' ? null : strtoupper($value);
                                    }
                                }
                            } else {
                                if ($key == 'username' || $key == 'email') {
                                    $model->$key = $value == '' ? null : $value;
                                } elseif ($key == 'identification_no') {
                                    $model->$key = $value == '' ? null : substr($value, 0, 6) . '-' . substr($value, 6, 2) . '-' . substr($value, 8, 4);
                                } else {
                                    $model->$key = $value == '' ? null : strtoupper($value);
                                }
                            }
                        } elseif (!isset($option['exclude_prefix'])) {
                            if (isset($option['date'])) {
                                if (array_search($key, $option['date']) !== false) {
                                    $model->$key = $value == '' ? null : date("Y-m-d", strtotime($value));
                                } else {
                                    if ($key == 'username' || $key == 'email') {
                                        $model->$key = $value == '' ? null : $value;
                                    } elseif ($key == 'identification_no') {
                                        $model->$key = $value == '' ? null : substr($value, 0, 6) . '-' . substr($value, 6, 2) . '-' . substr($value, 8, 4);
                                    } else {
                                        $model->$key = $value == '' ? null : strtoupper($value);
                                    }
                                }
                            } else {
                                if ($key == 'username' || $key == 'email') {
                                    $model->$key = $value == '' ? null : $value;
                                } elseif ($key == 'identification_no') {
                                    $model->$key = $value == '' ? null : substr($value, 0, 6) . '-' . substr($value, 6, 2) . '-' . substr($value, 8, 4);
                                } else {
                                    $model->$key = $value == '' ? null : strtoupper($value);
                                }
                            }
                        }
                    }
                } else {
                    if (isset($option['date'])) {
                        if (array_search($key, $option['date']) !== false) {
                            $model->$key = $value == '' ? null : date("Y-m-d", strtotime($value));
                        } else {
                            if ($key == 'username' || $key == 'email') {
                                $model->$key = $value == '' ? null : $value;
                            } elseif ($key == 'identification_no') {
                                $model->$key = $value == '' ? null : substr($value, 0, 6) . '-' . substr($value, 6, 2) . '-' . substr($value, 8, 4);
                            } else {
                                $model->$key = $value == '' ? null : strtoupper($value);
                            }
                        }
                    } else {
                        if ($key == 'username' || $key == 'email') {
                            $model->$key = $value == '' ? null : $value;
                        } elseif ($key == 'identification_no') {
                            $model->$key = $value == '' ? null : substr($value, 0, 6) . '-' . substr($value, 6, 2) . '-' . substr($value, 8, 4);
                        } else {
                            $model->$key = $value == '' ? null : strtoupper($value);
                        }
                    }
                }
            } else {
                if ($key == 'username' || $key == 'email') {
                    $model->$key = $value == '' ? null : $value;
                } elseif ($key == 'identification_no') {
                    $model->$key = $value == '' ? null : substr($value, 0, 6) . '-' . substr($value, 6, 2) . '-' . substr($value, 8, 4);
                } else {
                    $model->$key = $value == '' ? null : strtoupper($value);
                }
            }
        }

        return $model;
    }

    public function upload($file, $propertyId, $assetType, $forId)
    {
        if (!file_exists(env('ASSETS_STORAGE') . 'property')) {
            mkdir(env('ASSETS_STORAGE') . 'property');
        }
        $uploadPath = env('ASSETS_STORAGE') . 'property' . DIRECTORY_SEPARATOR . $propertyId;
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath);
        }

        if ($file != null) {

            $asset     = new Models\SYSAsset();
            if ($assetType == 'building_plan') {
                $asset->for    = 'Building Plan';
                $asset->for_id = $forId;
            }            
            $asset->upload_by  = \Auth::user()->id;
            $asset->save();
            
            $originalName = $file->getClientOriginalName();
            $newName      = $asset->id . '.' . $file->getClientOriginalExtension();
            if ($assetType == 'owner_avatar') {
                $file->move(env('ASSETS_STORAGE') . 'avatar', $newName);
            } else {
                $file->move($uploadPath, $newName);
            }
            $asset->asset_name = $originalName;
            if ($assetType == 'owner_avatar') {
                $asset->file_size = \Storage::disk('asset')->size('avatar' . DIRECTORY_SEPARATOR . $newName);
                $asset->md5       = md5_file(env('ASSETS_STORAGE') . 'avatar' . DIRECTORY_SEPARATOR . $newName);
            } else {
                $asset->file_size = \Storage::disk('asset')->size('property' . DIRECTORY_SEPARATOR . $propertyId . DIRECTORY_SEPARATOR . $newName);
                $asset->md5       = md5_file($uploadPath . DIRECTORY_SEPARATOR . $newName);
            }
            $asset->save();
        }
    }

    public function deleteUpload($asset, $ref)
    {
        if ($asset != null && \Storage::disk('asset')->exists('property' . DIRECTORY_SEPARATOR . $ref . DIRECTORY_SEPARATOR . $this->getFilename('images', $asset))) {
            \Storage::disk('asset')->delete('property' . DIRECTORY_SEPARATOR . $ref . DIRECTORY_SEPARATOR . $this->getFilename('images', $asset));
        }
        if ($asset != null) {
            $asset->forceDelete();
        }
    }

    public function getDbConfig($config)
    {
        $config = Models\SYSSetting::where('param', $config);
        if ($config->count() > 0) {
            return $config->first()->value;
        } else {
            return null;
        }
    }

    public static function rglob($pattern = '*', $path = '', $flags = 0)
    {
        $paths = glob($path . '*', GLOB_MARK | GLOB_ONLYDIR | GLOB_NOSORT);
        $files = glob($path . $pattern . '*', $flags);
        foreach ($paths as $path) {
            $files = array_merge($files, App::rglob($pattern, $path, $flags));
        }

        return $files;
    }

    //Delete directory and all content of it. the target must end with DIRECTORY_SEPARATOR
    public function delDir($target)
    {
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
            foreach ($files as $file) {
                $this->delDir($file);
            }
            rmdir($target);
        } elseif (is_file($target)) {
            unlink($target);
        }
    }

    public static function getFilename($type, $asset)
    {
        $filename = null;
        if ($asset != null) {
            $extension = explode('.', $asset->asset_name);
            $filename  = $asset->id . '.' . $extension[count($extension) - 1];
        } else {
            if ($type === 'image') {
                $filename = 'no_picture.png';
            }
        }

        return $filename;
    }

    public static function getExtension($asset)
    {
        $extension = null;
        if ($asset != null) {
            $extension = explode('.', $asset->asset_name);
        }

        return $extension[count($extension) - 1];
    }

    public static function getAddress($model)
    {
        $address = '';
        if ($model->address != null or $model->address != '') {
            $address .= $model->address . ', ';
        }
        if ($model->postcode != null or $model->postcode != '') {
            $address .= $model->postcode . ', ';
        }
        if ($model->town != null or $model->town != '') {
            $address .= $model->town . ', ';
        }
        if ($model->state != null or $model->state != '') {
            $address .= $model->state . ', ';
        }

        return substr($address, 0, -2);
    }

    public static function getAddressEPBT($model)
    {
        $address = '';
        if ($model->address_epbt1 != null or $model->address_epbt1 != '') {
            $address .= $model->address_1 . ', ';
        }
        if ($model->address_epbt2 != null or $model->address_epbt2 != '') {
            $address .= $model->address_2 . ', ';
        }
        if ($model->address_epbt3 != null or $model->address_epbt3 != '') {
            $address .= $model->address_2 . ', ';
        }

        return substr($address, 0, -2);
    }
}
