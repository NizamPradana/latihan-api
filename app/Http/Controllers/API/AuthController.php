<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            "name" => "required",
            "id_card_number" => "required|unique:users",
            "born_date" => "required",
            "address" => "required",
            "regional_id" => "required",
            "gender" => "required",
        ]);

        if($validated->fails())
        {
            return response()->json([
                "message" => "Failed to register"
            ], 202);
        }


        $password = Hash::make($request->id_card_number);

        $user = User::create([
            "name" => $request->name,
            "id_card_number" => $request->id_card_number,
            "born_date" => $request->born_date,
            "address" => $request->address,
            "gender" => $request->gender,
            "role" => $request->role,
            "regional_id" => $request->regional_id,
            "password" => $password
        ]);

        $token = $user->createToken("register_token")->plainTextToken;

        return response()->json([
            "success" => true,
            "message" => "User Registered",
            "token" => $token
        ], 201);
    
    }

    public function login(Request $request)
    {

        if(!Auth::attempt($request->only("id_card_number", "password")))
        {
            return response()->json([
                "message" => "Unauthorized"
            ], 401);
        }

        $user = User::with("regional")->where("id_card_number", $request->id_card_number)->firstOrFail();

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "success" => true,
            "message" => "Login success!",
            "data" => $user,
            "token" => $token
        ], 200);


    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token , $key){
            $token->where('tokenable_id', auth()->user()->id)->delete();
        });

        // $user = auth()->user();

        // $user->currentAccessToken()->delete();

        return response()->json([
            "success" => true,
            "message" => "Successful Logout"
        ], 200);

    }



}
