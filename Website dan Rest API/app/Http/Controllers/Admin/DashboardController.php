<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        return view('admin.dashboard',array(
            'judul' => "Dashboard Administrator | MyLearning V.1.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "admin",
            'template' => "adminlte",
        ));
    }
}
