<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'username' => 'required|email|unique:users',
            'email'=> 'required|unique:users',
            'password'  => 'required|min:8|confirmed'
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $user = User::create([
            'name'      => $request->name,
            'username'      => $request->username,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        
        if($user) {
            return response()->json([
                'success' => 'success',
                'message' => 'Login successful',
                'data'    => $user,  
            ],201);
        }

    
        return response()->json([
            'success' => 'error',
            'message' => 'Invalid field(s) in request',
            'errors' => $user
        ],400);
    }
}