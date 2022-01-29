<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswakelas;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    protected $users;
    protected $role;
    protected $guru;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users=Auth::user();
            $this->role=User::with('role')->find($this->users->id)->role;
            return $next($request);
        });
    }

    public function index()
    {
//        $kelas= Kelas::where('guru_id',$this->guru->id)->findOrFail($id);
//        $siswa = Siswakelas::with('siswa')->where('kelas_id',$id)->get();

        return view('guru.materi', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "kelas",
            'tagSubMenu' => "kelas",
            'template' => "adminlte",
//            'idKelas' => $id,
//            'namaKelas' => $kelas->name,
//            'dataMateri' => $siswa,
        ));

    }
}
