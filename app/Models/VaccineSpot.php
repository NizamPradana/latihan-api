<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class VaccineSpot extends Model
{
    use HasFactory, HasApiTokens;

    protected $guarded = ['id'];

    public function regional()
    {
        return $this->belongsTo(Region::class, "region_id");
    }

}
