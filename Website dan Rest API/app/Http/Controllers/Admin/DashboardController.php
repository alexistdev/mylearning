<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdminAuth;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use AdminAuth;

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
