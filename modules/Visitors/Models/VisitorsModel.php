<?php

// namespace App;
namespace App\Modules\Visitors\Models;

use App\Modules\Visitors\Models\VisitsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorsModel extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function visits()
    {
        return $this->hasMany(VisitsModel::class);
    }
}
