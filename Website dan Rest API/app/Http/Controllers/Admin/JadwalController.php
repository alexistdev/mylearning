<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdminAuth;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class JadwalController extends Controller
{
    use AdminAuth;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $jadwal = Jadwal::with('mapel')->get();
            return Datatables::of($jadwal)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.editjadwal',$row->id).'" class="edit btn btn-success btn-sm m-1"> EDIT</a>';
                    return $btn . '<a href="#" class="hapus btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus" data-id="' . $row->id . '"> HAPUS</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.jadwal', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "jadwal",
            'tagSubMenu' => "jadwal",
            'template' => "adminlte",
        ));
    }

    public function create()
    {
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        return view('admin.formjadwal', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "jadwal",
            'tagSubMenu' => "jadwal",
            'tag' => 'add',
            'template' => "adminlte",
            'datamapel' => $mapel,
            'datakelas' => $kelas,
        ));
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $mapel = Mapel::all();
        return view('admin.formjadwal', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "jadwal",
            'tagSubMenu' => "jadwal",
            'tag' => 'edit',
            'template' => "adminlte",
            'datamapel' => $mapel,
            'id' => $id,
            'datajadwal' => $jadwal,

        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required|numeric',
            'kelas_id' => 'required|numeric',
            'name' => 'required|unique:kelas|max:255',
        ]);
        $jadwal = new Jadwal();
        $jadwal->mapel_id = $request->mapel_id;
        $jadwal->name = $request->name;
        $jadwal->kelas_id = $request->kelas_id;
        $jadwal->save();
        return redirect(route('admin.jadwal'))->with('success','Data berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'mapel_id' => 'required|numeric',
            'name' => 'required|unique:kelas|max:255',
        ]);
        Jadwal::where('id',$request->id)->update([
            'mapel_id' =>$request->mapel_id,
            'name' => $request->name,
        ]);
        return redirect(route('admin.editjadwal',$request->id))->with('success','Data berhasil diperbaharui!');
    }

    public function destroy(Request $request)
    {
        $jadwal = Jadwal::findOrFail($request->id);
        $jadwal->delete();
        return redirect(route('admin.jadwal'))->with('hapus','Data berhasil dihapus!');
    }
}
