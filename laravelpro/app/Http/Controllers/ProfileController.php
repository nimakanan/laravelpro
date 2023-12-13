<?php

namespace App\Http\Controllers;

use App\Models\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function manageTwoFactor()
    {
        return view('profile.twofactor');
    }

    public function postManageTwoFactor(Request $request)
    {

        $data = $request->validate([
            'type' => 'required|in:sms,off',
            'phone'=>['required_unless:type,off',Rule::unique('users','phone_number')->ignore($request->user()->id)]
        ]);

        if($data['type'] === 'sms') {
            if($request->user()->phone_number !== $data['phone']) {
                // create a new code
                $code = ActiveCode::generateCode($request->user());
//                dd($code);
                $request->session()->flash('phone' , $data['phone']);
                // send the code to user phone number
              $request->user()->notify(new ActiveCodeNotification($code,$data['phone']));

                return redirect(route('verifycode'));
            } else {
                $request->user()->update([
                    'two_factor_type' => 'sms'
                ]);
            }
        }

        if($data['type'] === 'off') {
            $request->user()->update([
                'two_factor_type' => 'off'
            ]);
        }

        return back();
    }


    public function getPhoneVerify(Request $request)
    {
        if(! $request->session()->has('phone')) {
            return redirect(route('twofactor'));
        }

        $request->session()->reflash();

        return view('profile.verifycode');
    }

    public function postPhoneVerify(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        if(! $request->session()->has('phone')) {
            return redirect(route('twofactor'));
        }


        $status = ActiveCode::verifyCode($request->token , $request->user());

        if($status) {
            $request->user()->activeCode()->delete();
            $request->user()->update([
                'phone_number' => $request->session()->get('phone'),
                'two_factor_type' => 'sms'
            ]);

            alert()->success('شماره تلفن و احرازهویت دو مرحلهای شما تایید شد.' , 'عملیات موفقیت آمیز بود');
        } else {
            alert()->error('شماره تلفن و احرازهویت دو مرحلهای شما تایید نشد.' , 'عملیات ناموفق بود');
        }

        return redirect(route('profile.2fa.manage'));
    }
}
