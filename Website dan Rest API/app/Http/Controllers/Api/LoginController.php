<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function validasi_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Username dan password tidak sesuai',
            ], 401);
        } else {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Username dan password tidak sesuai',
                ], 401);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'berhasil login',
                    'id' => Auth::id(),
                ], 200);
            }
        }


    }
}
