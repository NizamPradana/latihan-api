<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{


    public function index()
    {
        $region = Region::all();

        return response()->json([
            "success" => true,
            "message" => "Success get data!",
            "data" => $region
        ], 200);

    }


    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "province" => "required",
            "district" => "required",
        ]);

        if($validated->fails())
        {
            return response()->json([
                "message" => $validated->errors()
            ], 202);
        }

        Region::create([
            "province" => $request->province,
            "district" => $request->district,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Region Created"
        ], 201);

    }
}
