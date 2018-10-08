<?php

namespace App\Http\Controllers\Admin;

use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:access-admin-panel');
    }
    public function index()
    {
        $users = User::getAllUsers()->paginate(5);

        return view('admin.dashboard', ['users' => $users, 'roles' => User::getRoles()]);
    }
}
