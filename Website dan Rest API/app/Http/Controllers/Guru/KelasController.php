<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class KelasController extends Controller
{
    protected $users;
    protected $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users=Auth::user();
            $this->role=User::with('role')->find($this->users->id)->role;
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $guru = Guru::where('user_id',$this->users->id)->first();
            $kelas = Kelas::where('guru_id',$guru->id)->get();
            return Datatables::of($kelas)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('guru.siswa', $row->id) . '" class="edit btn btn-primary btn-sm m-1"> SISWA</a>';
                    return $btn;
//                    return $btn . '<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="' . $row->id . '"> HAPUS</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('guru.kelas', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "kelas",
            'tagSubMenu' => "kelas",
            'template' => "adminlte",
        ));

    }
}
