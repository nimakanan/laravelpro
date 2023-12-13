<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AuthTokencontroller extends Controller
{
   public function gettoken(Request $request){
       if (! $request->session()->has('auth')){
           return redirect(route('login'));
       }
       $request->session()->reflash();
       return view('auth.token');


   }
   public function posttoken(Request $request){
       $request->validate([
           'token'=>'required'
       ]) ;
       if (! $request->session()->has('auth')){
           return redirect(route('login'));
       }
       $user=User::FindOrFail($request->session()->get('auth.user_id'));
      $status= ActiveCode::verifycode($request->token, $user);
      if(! $status){
          Alert::error('خطا', 'کد وارد شده اشتباه است.');
          return redirect(route('login'));
      }
      if(auth()->LoginUsingId($user->id,$request->session()->get('auth,remember'))){
          $user->active_code()->delete();
          Alert::success('!!تبریک','!!شما با موفقیت وارد حساب کاربری خود شدید');
          return redirect('/');
       }
      return redirect(route('login'));


   }
}
