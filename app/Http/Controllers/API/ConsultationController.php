<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultation = Consultation::with('users')->get();
        // $userConsul = User::where("id", $consultation->user_id)->get();

        return response()->json([
            "data" => [
                "consultation_data" => $consultation,
            ]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "disease_history" => "required",
            "current_symptoms" => "required",
        ]);

        if($validated->fails())
        {
            return response()->json([
                "message" => $validated->errors()
            ], 202);
        }

        $consultation = Consultation::create([
            "user_id" => auth()->user()->id,
            "disease_history" => $request->disease_history,
            "current_symptoms" => $request->current_symptoms
        ]);

        if(auth()->user()->consultation_status > 0 )
        {
            $consul_status = auth()->user()->consultation_status++;
        }else{
            $consul_status = 1;
        }

        User::where('id', auth()->user()->id)->update(['consultation_status' => $consul_status]);

        return response()->json([
            "message" => "Consultation sent success!"
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consultation = Consultation::with('users')->where("user_id", $id)->firstOrFail();
        
        return response()->json([
            "success" => true,
            "consultation_data" => $consultation
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            "doctor_notes" => "required",
            "status" => "required",
        ]);

        if($validated->fails())
        {
            return response()->json([
                "message" => $validated->errors()
            ], 202);
        }

        $update = Consultation::where("id", $id)->update([
            "doctor_notes" => $request->doctor_notes,
            "doctor" => auth()->user()->name,
            "status" => $request->status,
        ]);

        return response()->json([
            "message" => "Success to update data!"
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
