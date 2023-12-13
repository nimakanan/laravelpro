<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class ActiveCode extends Model
{
    protected $table='active_codes';

    protected $fillable=[
        'phone_id',
        'code',
        'expired_time'
    ];
    public function phone(){
        return $this->belongsTo(Phone::class);
    }
    public function scopeVerifyCode($query,$code,$phone){
        return !!$phone->active_code()->where('code',$code)->where('expired_time','>',now())->first();
    }

    public  function scopeGenerateCode($query,$phone)
    {
       if ($code=$this->getcodeAlive($phone)){
$code=$code->code;
       }else{
$phone->active_code()->delete();

       }
        
        do{
            $code=mt_rand(100000, 999999);
        }while($this->checkcodeIsunique($phone,$code));
        $phone->active_code()->create([
            'code'=>$code,
            'expired_time'=>now()->addMinutes(10)
        ]);
        return $code;

    }
    public $timestamps=false;

    private function checkcodeIsunique($phone, int $code)
    {
        return !!$phone->active_code()->where('code',$code)->first();
    }

    private function getcodeAlive($phone)
    {

        return $phone->active_code()->where('expired_time' , '>' , now())->first();
    }

    use HasFactory;
}
