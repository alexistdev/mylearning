<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TugasController extends Controller
{
    public function get_data_tugas(Request $request)
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
            $kelas = Kelas::find($request->id_kelas);
            if ($kelas != null) {
                $tugas = Tugas::with('materi')->where('kelas_id', $request->id_kelas)->get();
                if(!$tugas->isEmpty()){
                    $arr = [];
                    foreach($tugas as $row){
                        $konten = [];
                        $konten['id'] = $row->id;
                        $konten['name'] = $row->name;
                        $konten['deskripsi'] = $row->deskripsi;
                        $konten['mapel'] = $row->materi->mapel->name;
                        $konten['lampiran'] = $row->lampiran;
                        $konten['akhir'] = $row->batas_akhir;
                        array_push($arr,$konten);
                    }
                    return response()->json([
                        'status' => true,
                        'message' => 'Data diperoleh',
                        'result' => $arr,
                    ], 200);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Not Found',
                    ], 404);
                }

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Not Found',
                ], 404);
            }

        }
    }
}
