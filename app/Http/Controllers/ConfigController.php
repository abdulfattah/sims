<?php
namespace App\Http\Controllers;

use App\Libs\App;
use App\Models;
use Artisan;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    use App;

    public function index()
    {
        $data = array(
            'menu'       => ['menu' => 'Tetapan', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Utama</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('user') . '">Pengguna</a></li>
                             <li class="breadcrumb-item active">Tetapan</li>',
        );

        $data['emailHost']     = Models\SYSSetting::where('param', 'email_host')->get(['param', 'value'])->first()->toArray();
        $data['emailPort']     = Models\SYSSetting::where('param', 'email_port')->get(['param', 'value'])->first()->toArray();
        $data['emailSSL']      = Models\SYSSetting::where('param', 'email_ssl')->get(['param', 'value'])->first()->toArray();
        $data['emailFrom']     = Models\SYSSetting::where('param', 'email_from')->get(['param', 'value'])->first()->toArray();
        $data['emailName']     = Models\SYSSetting::where('param', 'email_name')->get(['param', 'value'])->first()->toArray();
        $data['emailPassword'] = Models\SYSSetting::where('param', 'email_password')->get(['param', 'value'])->first()->toArray();

        return view('system.config', $data);
    }

    public function update($id)
    {
        $emailHost        = Models\SYSSetting::where('param', 'email_host')->get()->first();
        $emailHost->value = request()->get('email_host');
        $emailHost->save();

        $emailPort        = Models\SYSSetting::where('param', 'email_port')->get()->first();
        $emailPort->value = request()->get('email_port');
        $emailPort->save();

        $emailSSL        = Models\SYSSetting::where('param', 'email_ssl')->get()->first();
        $emailSSL->value = request()->get('email_ssl');
        $emailSSL->save();

        $emailFrom        = Models\SYSSetting::where('param', 'email_from')->get()->first();
        $emailFrom->value = request()->get('email_from');
        $emailFrom->save();

        $emailName        = Models\SYSSetting::where('param', 'email_name')->get()->first();
        $emailName->value = strtoupper(request()->get('email_name'));
        $emailName->save();

        $emailPassword        = Models\SYSSetting::where('param', 'email_password')->get()->first();
        $emailPassword->value = request()->get('email_password');
        $emailPassword->save();

        Artisan::call('config:clear');
        Artisan::call('queue:restart');

        return redirect('config')->with('success', 'System settings has been updated');
    }
}
