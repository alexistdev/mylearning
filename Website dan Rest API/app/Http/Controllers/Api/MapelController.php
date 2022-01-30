<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /** route: api/mapel */
    public function get_data_mapel(Request $request)
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
            $mapel = Mapel::where('kelas_id', $request->id_kelas)->get();
            if (empty($mapel)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data kosong',
                ], 404);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil didapatkan',
                    'result' => $mapel,
                ], 200);
            }
        }
    }

    /** route: api/pertemuan */
    public function get_materi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_mapel' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak lengkap',
            ], 401);
        } else {
            $mapel = Mapel::find($request->id_mapel);
            if($mapel != null){
                $materi = Materi::where('mapel_id',$mapel->id)->get();
                $arr = [];
                foreach($materi as $row){
                    $konten = [];
                    $konten['id'] = $row->id;
                    $konten['judul'] = $row->judul;
                    $konten['deskripsi'] = $row->deskripsi;
                    $konten['gambar'] = $row->gambar;
                    $konten['tanggal'] = date('d-m-Y',strtotime($row->created_at));
                    $konten['lampiran'] = $row->lampiran;
                    array_push($arr,$konten);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil didapatkan',
                    'result' => $arr,

                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ], 404);
            }
        }
    }

    /** route: api/pertemuan/detail */
    public function get_detail_pertemuan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak lengkap',
            ], 401);
        } else {
            $materi = Materi::find($request->id);
            if($materi != null){
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil didapatkan',
                    'materi' => $materi->id,
                    'judul' => $materi->judul,
                    'deskripsi' => $materi->deskripsi,
                    'gambar' => $materi->gambar,
                    'tanggal' => date("d-m-Y",strtotime($materi->created_at)),
                    'lampiran' => $materi->lampiran,
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ada',
                ], 404);
            }
        }
    }
}
