<?php

namespace App\Http\Controllers;

use App\Libs\App;
use App\Models;
use Artisan;

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

        $data['defaultPassword'] = Models\SYSSetting::where('param', 'default_password')->get(['param', 'value'])->first()->toArray();
        $data['emailUsername'] = Models\SYSSetting::where('param', 'mail.mailers.smtp.username')->get(['param', 'value'])->first()->toArray();
        $data['emailPassword'] = Models\SYSSetting::where('param', 'mail.mailers.smtp.password')->get(['param', 'value'])->first()->toArray();
        $data['emailHost']     = Models\SYSSetting::where('param', 'mail.mailers.smtp.host')->get(['param', 'value'])->first()->toArray();
        $data['emailPort']     = Models\SYSSetting::where('param', 'mail.mailers.smtp.port')->get(['param', 'value'])->first()->toArray();
        $data['emailSSL']      = Models\SYSSetting::where('param', 'mail.mailers.smtp.encryption')->get(['param', 'value'])->first()->toArray();
        $data['emailFrom']     = Models\SYSSetting::where('param', 'mail.from.address')->get(['param', 'value'])->first()->toArray();
        $data['emailName']     = Models\SYSSetting::where('param', 'mail.from.name')->get(['param', 'value'])->first()->toArray();

        return view('system.config', $data);
    }

    public function update($id)
    {
        \DB::update('UPDATE sys_setting set value = ? where param = ?', [request()->get('default_password'), 'default_password']);
        \DB::update('UPDATE sys_setting set value = ? where param = ?', [request()->get('mail_mailers_smtp_host'), 'mail.mailers.smtp.host']);
        \DB::update('UPDATE sys_setting set value = ? where param = ?', [request()->get('mail_mailers_smtp_port'), 'mail.mailers.smtp.port']);
        \DB::update('UPDATE sys_setting set value = ? where param = ?', [request()->get('mail_mailers_smtp_encryption'), 'mail.mailers.smtp.encryption']);
        \DB::update('UPDATE sys_setting set value = ? where param = ?', [request()->get('mail_mailers_smtp_username'), 'mail.mailers.smtp.username']);
        \DB::update('UPDATE sys_setting set value = ? where param = ?', [request()->get('mail_mailers_smtp_password'), 'mail.mailers.smtp.password']);
        \DB::update('UPDATE sys_setting set value = ? where param = ?', [request()->get('mail_from_address'), 'mail.from.address']);
        \DB::update('UPDATE sys_setting set value = ? where param = ?', [request()->get('mail_from_name'), 'mail.from.name']);

        Artisan::call('config:clear');
        Artisan::call('queue:restart');

        return redirect('config')->with('success', 'System settings has been updated');
    }
}
