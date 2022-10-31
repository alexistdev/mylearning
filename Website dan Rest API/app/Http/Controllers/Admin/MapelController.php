<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdminAuth;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class MapelController extends Controller
{
    use AdminAuth;

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
                    $btn = '<a href="'.route('admin.editmapel',$row->id).'" class="edit btn btn-success btn-sm m-1"> EDIT</a>';
                    $btn2 = $btn . '<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="' . $row->id . '"> HAPUS</a>';
                    return $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.mapel', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "mapel",
            'tagSubMenu' => "mapel",
            'template' => "adminlte",
        ));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $guru = Guru::with('user')->get();
        return view('admin.formmapel', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "mapel",
            'tagSubMenu' => "mapel",
            'tag' => 'add',
            'template' => "adminlte",
            'datakelas' => $kelas,
            'dataGuru' => $guru,
        ));
    }

    public function edit($id)
    {
        $mapel = Mapel::with('kelas')->findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.formmapel', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "mapel",
            'tagSubMenu' => "mapel",
            'tag' => 'edit',
            'template' => "adminlte",
            'datakelas' => $kelas,
            'id' => $id,
            'mapel' => $mapel,
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'kelas_id' => 'required',
            'name' => 'required|unique:kelas|max:255',
        ]);
        Mapel::where('id', $request->id)->update([
            'kelas_id' => $request->kelas_id,
            'name' => $request->name,
        ]);
        return redirect(route('admin.editmapel',$request->id))->with('success','Data berhasil diperbaharui!');
    }

    public function save(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required',
            'name' => 'required|unique:kelas|max:255',
            'guru_id' => 'required|numeric',
        ]);
        $mapel = new Mapel();
        $mapel->kelas_id = $request->kelas_id;
        $mapel->name = $request->name;
        $mapel->guru_id = $request->guru_id;
        $mapel->save();
        return redirect(route('admin.mapel'))->with('success','Data berhasil disimpan!');
    }

    public function destroy(Request $request)
    {
        $mapel = Mapel::findOrFail($request->id);
        $mapel->delete();
        return redirect(route('admin.mapel'))->with('hapus','Data berhasil dihapus!');
    }
}
