<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait GuruAuth
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
}
