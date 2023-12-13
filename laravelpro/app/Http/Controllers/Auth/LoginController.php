<?php

namespace App\Http\Controllers\Auth;

use App\ActiveCode as AppActiveCode;
use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\ActiveCodeNotification;
use App\Notifications\LoginTowebsiteNotification;
use App\Providers\RouteServiceProvider;
use App\Rules\Recaptcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\False_;
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
    protected $redirectTo = RouteServiceProvider::HOME;
//
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->hasTwoFactorAuthenticatedEnabled()) {
            auth()->logout();

            $request->session()->flash('auth' , [
                'user_id' => $user->id,
                'using_sms' => false,
                'remember' => $request->has('remember')
            ]);


            if($user->two_factor_type == 'sms') {
                $data=$request->user()->phone_number;
                $code = AppActiveCode::generateCode($user);
                $request->user()->notify(new ActiveCodeNotification($code,$data));

                $request->session()->push('auth.using_sms' , true);
            }
            $user->notify(new LoginTowebsiteNotification());
            return redirect(route('2fa.token'));

        }


        return false;
    }
//    public function login(Request $request)
//    {
//        return $request->all();
//    }
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response'=>['required',new Recaptcha]
],[
            'g-recaptcha-response.required'=>'.لطفا روی من ربات نیستم کلیک کنید'
        ]);
    }

}
