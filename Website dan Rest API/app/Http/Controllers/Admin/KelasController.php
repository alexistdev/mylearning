<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            $this->users = Auth::user();
            $this->role = User::with('role')->find($this->users->id)->role;
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kelas = Kelas::all();
            return Datatables::of($kelas)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.editkelas',$row->id).'" class="edit btn btn-success btn-sm m-1"> EDIT</a>';
                    $btn2 = $btn . '<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="' . $row->id . '"> HAPUS</a>';
                    return $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.kelas', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "kelas",
            'tagSubMenu' => "kelas",
            'template' => "adminlte",
        ));
    }

    public function create()
    {
        return view('admin.formkelas', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "kelas",
            'tagSubMenu' => "kelas",
            'tag' => 'add',
            'template' => "adminlte",
        ));
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.formkelas', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "kelas",
            'tagSubMenu' => "kelas",
            'tag' => 'edit',
            'template' => "adminlte",
            'id' => $id,
            'name' => $kelas->name,
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:kelas|max:255',
        ]);
        $kelas = new Kelas();
        $kelas->name = strtolower($request->name);
        $kelas->save();
        return redirect(route('admin.kelas'))->with('success','Data berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|unique:kelas|max:255',
        ]);
        Kelas::where('id',$request->id)->update([
           'name' => $request->name,
        ]);
        return redirect(route('admin.editkelas',$request->id))->with('success','Data berhasil disimpan!');
    }

    public function destroy(Request $request)
    {
        $kelas = Kelas::findOrFail($request->id);
        $kelas->delete();
        return redirect(route('admin.kelas'))->with('hapus','Data berhasil dihapus!');
    }
}
