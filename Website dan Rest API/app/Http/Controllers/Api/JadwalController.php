<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function get_data_jadwal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kelas' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak lengkap',
            ], 401);
        } else {
            $jadwal = Jadwal::with('kelas','mapel')->where('kelas_id',$request->id_kelas)->get();
            if(!$jadwal->isEmpty()){
                $arr = [];
                foreach($jadwal as $row){
                    $konten = [];
                    $konten['id'] = $row->id;
                    $konten['nama_pelajaran'] = $row->mapel->name;
                    $konten['nama_kelas'] = $row->kelas->name;
                    $konten['jadwal'] = $row->name;
                    array_push($arr,$konten);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data diperoleh',
                    'result' => $arr,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Kosong',
                ], 401);
            }
        }
    }
}
