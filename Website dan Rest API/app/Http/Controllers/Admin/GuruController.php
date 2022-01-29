<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Mapel;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class GuruController extends Controller
{
    protected $users;
    protected $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            $this->role = User::with('role')->find($this->users->id)->role;
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $guru = Guru::with('user')->get();
            return Datatables::of($guru)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.editjadwal', $row->id) . '" class="edit btn btn-success btn-sm m-1"> SISWA</a>';
                    return $btn . '<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="' . $row->id . '"> HAPUS</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.guru', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "guru",
            'tagSubMenu' => "guru",
            'template' => "adminlte",
        ));
    }

    public function create()
    {
        $user = User::where('role_id', 2)
            ->whereDoesntHave('guru')
            ->get();
        return view('admin.formguru', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "guru",
            'tagSubMenu' => "guru",
            'tag' => 'add',
            'template' => "adminlte",
            'datauser' => $user,
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'nip' => 'required|unique:gurus|max:255',
            'phone' => 'required|max:255',
            'alamat' => 'required|max:500',
        ]);
        $guru = new Guru();
        $guru->user_id = $request->user_id;
        $guru->nip = $request->nip;
        $guru->phone = $request->phone;
        $guru->alamat = $request->alamat;
        $guru->save();
        return redirect(route('admin.guru'))->with('success','Data berhasil disimpan!');

    }
}
