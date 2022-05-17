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

    public function show($id_user)
    {
        $vaccine = Vaccination::where("user_id", $id_user)->with("user")->with("vaccinespot")->get();
        return $vaccine;
    }
}
