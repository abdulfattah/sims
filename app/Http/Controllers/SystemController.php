<?php
namespace App\Http\Controllers;

use App\Libs\App;

class SystemController extends Controller
{
    use App;

    public function image()
    {
        $folder   = \Request::input('in');
        $filename = \Request::input('filename');
        $image    = null;

        $storagePath = env('ASSETS_STORAGE') . $folder . DIRECTORY_SEPARATOR . $filename;

        try {
            $image = \Image::make($storagePath);
        } catch (\Exception $ex) {
            $image = \Image::make(env('ASSETS_STORAGE') . 'no_picture.png');
        };

        return $image->response();
    }

    public function file()
    {
        $folder     = \Request::input('in');
        $filename   = \Request::input('filename');
        $actualname = \Request::input('actualname');

        $storagePath = env('ASSETS_STORAGE') . $folder . DIRECTORY_SEPARATOR . $filename;

        return \Response::make(file_get_contents($storagePath), 200, [
            'Content-Type'        => \File::mimeType($storagePath),
            'Content-Disposition' => 'inline; filename="' . $actualname . '"',
        ]);
    }

    public function thumbnail($filename)
    {
        $storagePath = env('ASSETS_STORAGE') . 'contents' . DIRECTORY_SEPARATOR . 'thumbnails' . DIRECTORY_SEPARATOR . $filename;

        return \Image::make($storagePath)->response();
    }

    public function aboutUs()
    {
        $data = array(
            'menu'       => ['menu' => 'Mengenai Kami', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Utama</a></li>
                             <li class="breadcrumb-item active">Mengenai Kami</li>',
        );

        return view('about_us', $data);
    }

    public function userManual()
    {
        $data = array(
            'menu'       => ['menu' => 'Manual Pengguna', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Utama</a></li>
                             <li class="breadcrumb-item active">User Manual</li>',
        );

        return view('help.pentadbir_sistem', $data);
    }
}
