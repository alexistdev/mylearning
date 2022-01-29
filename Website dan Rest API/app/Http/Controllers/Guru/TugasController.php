<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswakelas;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TugasController extends Controller
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

        return view('guru.tugas', array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "mapel",
            'tagSubMenu' => "mapel",
            'template' => "adminlte",
        ));

    }
}
