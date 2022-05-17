<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vaccination;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    public function index()
    {
        $vaccine = Vaccination::with("user")->with("vaccinespot")->get();
        return $vaccine;
    }
}
