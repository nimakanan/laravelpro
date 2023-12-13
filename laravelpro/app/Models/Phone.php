<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;


use Laravel\Sanctum\HasApiTokens;


class Phone extends Model
{

    use HasFactory,Notifiable;
    Protected $primaryKey="id";
    protected $fillable=["phone"];
    public function active_code(){
        return $this->hasMany(ActiveCode::class);
    }
}
