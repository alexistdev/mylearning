<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdminAuth;
use App\Http\Traits\GuruAuth;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Mapel;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Exception;

class GuruController extends Controller
{
    use AdminAuth;

    /** route: admin.guru */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::with('guru')->where('role_id', 2)->get();
            return Datatables::of($user)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.guru.edit', base64_encode($row->id)) . '" class="edit btn btn-success btn-sm m-1"> EDIT</a>';
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

    /** route: admin.guru.add */
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

    /** route: admin.guru.edit */
    public function edit($id)
    {
        $user = User::with('guru')->findOrFail(base64_decode($id));
        return view('admin.formguru', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "guru",
            'tagSubMenu' => "guru",
            'tag' => 'edit',
            'template' => "adminlte",
            'datauser' => $user,
            'id' => base64_decode($id),
        ));
    }

    /** route: admin.guru.update */
    public function update(Request $request)
    {
        if ($request->routeIs('admin.*')) {
            $request->validate([
                'user_id' => 'required|numeric',
                'nama' => 'required|max:125',
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($request->user_id),
                ],
                'nip' => [
                    'required',
                    Rule::unique('gurus')->ignore($request->user_id, 'user_id'),
                ],
                'phone' => 'required|max:255',
                'alamat' => 'required|max:500',
            ]);
            DB::beginTransaction();
            try {
                User::where('id', $request->user_id)->update([
                    'name' => $request->nama,
                    'email' => $request->email,
                ]);
                Guru::where('user_id', $request->user_id)->update([
                    'nip' => $request->nip,
                    'phone' => $request->phone,
                    'alamat' => $request->alamat,
                ]);
                DB::commit();
                return redirect(route('admin.guru.edit', base64_encode($request->user_id)))->with(['success' => "Data Guru berhasil diperbaharui!"]);
            } catch (Exception $e) {
                DB::rollback();
                return redirect(route('admin.guru'))->with(['error' => $e->getMessage()]);
            }
        } else {
            return abort("404", "NOT FOUND");
        }
    }

    /** route: admin.guru.save */
    public function save(Request $request)
    {
        if ($request->routeIs('admin.*')) {
            $request->validate([
                'nama' => 'required|max:125',
                'email' => 'required|unique:users,email',
                'nip' => 'required|unique:gurus|max:255',
                'phone' => 'required|max:255',
                'alamat' => 'required|max:500',
            ]);
            DB::beginTransaction();
            try {
                $user = new User();
                $user->role_id = 2;
                $user->name = $request->nama;
                $user->email = $request->email;
                $user->password = Hash::make("1234");
                $user->save();

                $guru = new Guru();
                $guru->user_id = $user->id;
                $guru->nip = $request->nip;
                $guru->phone = $request->phone;
                $guru->alamat = $request->alamat;
                $guru->save();
                DB::commit();
                return redirect(route('admin.guru'))->with('success', 'Data berhasil disimpan!');
            } catch (Exception $e) {
                DB::rollback();
                return redirect(route('admin.guru'))->with(['error' => $e->getMessage()]);
            }
        } else {
            return abort("404", "NOT FOUND");
        }
    }

    /** route: admin.guru.delete */
    public function destroy(Request $request)
    {
        if ($request->routeIs('admin.*')) {
            $request->validate([
                'user_id' => 'required|numeric',
            ]);
            $user = User::findOrFail($request->user_id);
            $user->delete();
            return redirect(route('admin.guru'))->with(['success' => "Guru berhasil di delete"]);
        } else {
            return abort("404", "NOT FOUND");
        }
    }
}
