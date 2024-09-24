<?php

namespace App\Modules;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseModel extends Model
{

    use DateFilter;

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function setPasswordAttribute($password)
    {

        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    protected $casts = [
        "created_at" => 'datetime:d-m-Y H:i:s',
        "updated_at" => 'datetime:d-m-Y H:i:s',
        "pickup_date" => 'datetime:d-m-Y H:i:s',
    ];
}
