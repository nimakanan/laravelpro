<?php

namespace App\Http\Controllers\Phone;

use App\ActiveCode as AppActiveCode;
use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\ActiveCodeNotification;
use GuzzleHttp\Promise\Create;

class RegisterPhoneController extends Controller
{
    public function phone()
    {
return view("auth.phonenumber");
    }
    public function store(Request $request)
    {
$data=$request->validate([
"phone"=>["required",'regex:/(0|\+98)?([ ]|,|-|[()]){0,2}9[1|2|3|4]([ ]|,|-|[()]){0,2}(?:[0-9]([ ]|,|-|[()]){0,2}){8}/',"unique:phones,phone"]

]);
$phone=Phone::Create($data);
$phone=Phone::wherephone($data["phone"])->first();
$code = ActiveCode::generateCode($phone);
$phone->notify(new ActiveCodeNotification($code , $phone->phone));

 return redirect(route("2fa.token"));
    }
}
