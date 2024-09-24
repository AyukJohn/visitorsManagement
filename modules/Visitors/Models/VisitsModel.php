<?php

namespace App\Modules\Visitors\Models;

use App\Modules\Residents\Models\ResidentsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitsModel extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function resident()
    {
        return $this->belongsTo(ResidentsModel::class, 'resident_id', 'id');
    }


    public function visitor()
    {
        return $this->belongsTo(VisitorsModel::class, 'visitor_id', 'id');
    }

}
