<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\VaccineSpot;

class Vaccination extends Model
{
    use HasFactory;


    public function vaccinespot()
    {
        return $this->belongsTo(VaccineSpot::class, "spot_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
