<?php

namespace App\Models;

//use Illuminate\Auth\Notifications\Resetassword as ResetPasswordNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    Protected $primaryKey="id";
    protected $fillable = [
        'name',
        'email',
        'is_superuser',
        'is_stuff',
        'password',
        'two_factor_type',
        'phone_number'
    ];
public function hasfactor($key){
    return auth()->user()->two_factor_type==$key;
}
 public function active_code(){
    return $this->hasMany(ActiveCode::class);
 }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPassword($token));
    }
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function is_superuser(){
        return $this->is_superuser;
    }
    public function is_stuff(){
        return $this->is_stuff;
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmail);
    }
    public function hasTwoFactorAuthenticatedEnabled()
    {
        return $this->two_factor_type !== 'off';
    }
    public function setPasswordAttribute($value){
       $this->attributes['password']=bcrypt($value);

    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
    public function hasroles($roles){
!!$roles->intersect($this->roles)->all();
    }
    public function haspermission($permission){
return $this->permissions->contains("name",$permission->name)||$this->hasroles($permission->roles) ;
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
}
