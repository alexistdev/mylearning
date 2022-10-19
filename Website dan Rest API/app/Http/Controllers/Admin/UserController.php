<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdminAuth;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use AdminAuth;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::with('role')->get();
            return Datatables::of($user)
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
        return view('admin.users', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "user",
            'tagSubMenu' => "user",
            'template' => "adminlte",
        ));
    }
}
