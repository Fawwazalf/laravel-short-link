<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
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
            'username'  => 'required',
            'email'     => 'required',
            'password'  => 'required'
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

      
        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'status' => "error",
                'message' => 'Username or password is incorrect'
            ], 400);
        }

       
        return response()->json([
            'success' => 'success',
            'message' => 'Login successful',
            'data' => auth()->guard('api')->user(),    
            'token'   => $token   
        ],200);
    }
}