<?php

namespace App\Modules\Admin\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivilegesModel extends Model
{
    use HasFactory;

    protected $guarded = [];



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

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}
