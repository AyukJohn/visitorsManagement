<?php

namespace App\Modules\Residents\Models;

// use App\VisitsModel;
use App\Modules\Visitors\Models\VisitsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentsModel extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function visits()
    {
        return $this->hasMany(VisitsModel::class);
    }

}
