<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'username';
    }
    public function showLoginForm()
    {
        //$dataTahunDasar = \App\TahunDasar::orderBy('tahun', 'asc')->get();
        return view('users.login');
    }
    protected function authenticate(Request $request)
    {
        $count = User::where([['username','=',$request->username],['flag',1]])->count();
        if ($count>0)
        {
            $dd_cek_username = User::where([['username','=',$request->username],['flag',1]])->first();
             //cek pake auth login
             $this->validate($request, [
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);

            if (auth()->attempt(['username' => $request->username, 'password' => $request->password, 'flag' => 1])) {
                //JIKA BERHASIL, MAKA REDIRECT KE HALAMAN HOME
                return view('depan');
            }
            //JIKA SALAH, MAKA KEMBALI KE LOGIN DAN TAMPILKAN NOTIFIKASI
            Session::flash('err_password', 'Password tidak benar!');
            return redirect()->route('login');
        }
        else {
            //tidak ada username
            //return view('login.index')->withError('Username tidak terdaftar');
            $errors = [$this->username() => trans('auth.belumaktif')];
            Session::flash('err_username', 'Username tidak terdaftar atau belum aktif, silakan cek email untuk aktivasi');
            return redirect()->route('login');
        }
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }
    protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password');
        return ['username' => $request->{$this->username()}, 'password' => $request->password, 'flag' => 1];
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        //User::where([['username','=',$request->username],['flag',1]])->first()
        $cek_user = User::where('username',$request->username)->first();

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($cek_user && \Hash::check($request->password, $cek_user->password) && $cek_user->flag != 1) {
            $errors = [$this->username() => trans('auth.belumaktif')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
    public function authenticated(Request $request, $user)
    {
        $user->lastlogin = Carbon::now()->toDateTimeString();
        $user->lastip = $request->getClientIp();
        $user->save();
    }
}
