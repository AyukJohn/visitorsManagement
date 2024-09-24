<?php

// namespace App;
namespace App\Modules\Admin\Models;

use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class AdminModel extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;


    
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Africa/Lagos')
            ->toDateTimeString()
        ;
    }


    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Africa/Lagos')
            ->toDateTimeString()
        ;
    }

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


    public function getJWTIdentifier() {
        return $this->getKey();
    }


    public function getJWTCustomClaims() {
        return [];
    }

    
    public function privileges()
    {
        return $this->hasMany(PrivilegesModel::class, 'admin_id');
    }


    public function hasPrivilege($privilegeName)
    {
        return $this->privileges->where('name', $privilegeName)->isNotEmpty();
    }


}