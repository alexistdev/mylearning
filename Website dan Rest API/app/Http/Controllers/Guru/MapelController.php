<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class MapelController extends Controller
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
            $mapel = Mapel::with('kelas')->get();
            return Datatables::of($mapel)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.editmapel',$row->id).'" class="edit btn btn-success btn-sm m-1"> MATERI</a>';
                    $btn = $btn.'<a href="'.route('admin.editmapel',$row->id).'" class="edit btn btn-primary btn-sm m-1"> KUIS</a>';
                    $btn2 = $btn . '<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="' . $row->id . '"> TUGAS</a>';
                    return $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('guru.mapel', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "mapel",
            'tagSubMenu' => "mapel",
            'template' => "adminlte",
        ));
    }
}
