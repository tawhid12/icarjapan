<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Settings\Country;
use App\Models\Settings\Port;
use App\Models\Role;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    /*
    * relation with role
    */
    public function role(){
        return $this->belongsTo(Role::class);
    }

    /*
    * relation with company
    */
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function userDetl(){
        return $this->hasOne(UserDetail::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function port(){
        return $this->belongsTo(Port::class);
    }
    public function executive(){
        return $this->belongsTo(User::class,'executiveId','id');
    }
    public function clientTransfers()
    {
        return $this->hasMany(ClientTransfer::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
