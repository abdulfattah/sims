<?php
namespace App\Http\Controllers;

use App\Libs\App;
use App\Models;
use App\Models\SYSAsset;
use App\Models\TAXNote;

class AttachmentController extends Controller
{

    use App;

    public function index()
    {
    }

    public function create()
    {
    }

    public function store()
    {
        $file       = \Request::file('filename');
        $attachment = new SYSAsset();
        if ($file != null) {
            $attachment->for         = 'Tax Attachment';
            $attachment->for_id      = request()->get('tax_record_id');
            $attachment->upload_by   = \Auth::user()->id;
            $attachment->asset_name  = $file->getClientOriginalName();
            $attachment->title       = strtoupper(request()->get('title'));
            $attachment->description = request()->get('description');
            $attachment->save();

            $uploadPath = env('ASSETS_STORAGE') . 'attachment' . DIRECTORY_SEPARATOR . request()->get('tax_record_id') . DIRECTORY_SEPARATOR;
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath);
            }
            $filename = $attachment->id . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $attachment->file_size = \Storage::disk('asset')->size('attachment' . DIRECTORY_SEPARATOR . request()->get('tax_record_id') . DIRECTORY_SEPARATOR . $filename);
            $attachment->md5       = md5_file($uploadPath . $filename);
            $attachment->save();
        }

        return redirect()->to('tax/' . request()->get('tax_record_id') . '?tab=3')
            ->with('success', 'Attachment has been uploaded.');
    }

    public function edit($id)
    {
    }

    public function update($id)
    {
        $attachment              = SYSAsset::find($id);
        $attachment->title       = strtoupper(request()->get('title'));
        $attachment->description = request()->get('description');
        $file                    = \Request::file('filename');
        if ($file != null) {
            $uploadPath = env('ASSETS_STORAGE') . 'attachment' . DIRECTORY_SEPARATOR . request()->get('tax_record_id') . DIRECTORY_SEPARATOR;
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath);
            }
            if (file_exists($uploadPath . $attachment->id . '.' . $this->getExtension($attachment))) {
                unlink($uploadPath . $attachment->id . '.' . $this->getExtension($attachment));
            }
            $filename               = $id . '.' . $file->getClientOriginalExtension();
            $attachment->asset_name = $file->getClientOriginalName();
            $file->move($uploadPath, $filename);
            $attachment->file_size = \Storage::disk('asset')->size('attachment' . DIRECTORY_SEPARATOR . request()->get('tax_record_id') . DIRECTORY_SEPARATOR . $filename);
            $attachment->md5       = md5_file($uploadPath . $filename);
            $attachment->save();
        }
        $attachment->save();

        return redirect()->to('tax/' . $attachment->for_id . '?tab=3')
            ->with('success', 'Attachment has been update.');
    }

    public function show($id)
    {
    }

    public function destroy($id)
    {
        try {
            $attachment  = Models\SYSAsset::find($id);
            $taxId = $attachment->for_id;
            $uploadPath = env('ASSETS_STORAGE') . 'attachment' . DIRECTORY_SEPARATOR . $taxId . DIRECTORY_SEPARATOR;
            if (file_exists($uploadPath . $attachment->id . '.' . $this->getExtension($attachment))) {
                unlink($uploadPath . $attachment->id . '.' . $this->getExtension($attachment));
            }
            $attachment->delete();

            return redirect()->to('tax/' . $taxId . '?tab=3')->with('success', 'Attachment has been deleted');
        } catch (\Exception $ex) {
            return redirect()->to('tax/' . $taxId . '?tab=3')->with('success', 'Error on deleted that record');
        }
    }
}
