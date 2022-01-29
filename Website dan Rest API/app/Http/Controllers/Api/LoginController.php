<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Siswakelas;
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
                $siswa = Siswa::where('user_id',Auth::id())->first();
                $idkelas = Siswakelas::where('siswa_id',($siswa != null)?$siswa->id:0)->first();
                return response()->json([
                    'status' => true,
                    'message' => 'berhasil login',
                    'id' => Auth::id(),
                    'kelas' => ($idkelas != null)?$idkelas->kelas_id:0,
                ], 200);
            }
        }


    }
}
