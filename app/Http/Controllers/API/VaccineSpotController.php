<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VaccineSpot;
use Illuminate\Support\Facades\Validator;

class VaccineSpotController extends Controller
{
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "region_id" => "required",
            "date" => "required",
            "name" => "required",
            "address" => "required",
            "serve" => "required",
            "capacity" => "required",
            "available_vaccines" => "required",
        ]);

        if($validated->fails())
        {
            return response()->json([
                "message" => $validated->errors()
            ], 202);
        }

        $create = VaccineSpot::create([
            "region_id" => $request->region_id,
            "date" => $request->date,
            "name" => $request->name,
            "address" => $request->address,
            "serve" => $request->serve,
            "capacity" => $request->capacity,
            "available_vaccines" => $request->available_vaccines,
        ]);

        return response()->json([
            "message" => "success create vaccine spot",
            "datas" => $create
        ], 201);


    }


    public function showNearest()
    {
        $userRegion = auth()->user()->regional_id;

        $search = VaccineSpot::with("regional")->where("region_id", $userRegion)->get();

        return $search;

    }

    public function show(Request $request , $id)
    {
        if($request->date == "")
        {
            $request->date = date("Y-m-d");
        }

        $search = VaccineSpot::with("regional")->where("id", $id)->where("date", $request->date)->firstOrFail();
        

        return $search;

    }





}
