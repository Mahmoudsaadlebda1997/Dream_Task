<?php

namespace Modules\AdminModule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\AdminModule\Services\Admin\AdminService;

class AuthController extends Controller
{
    protected $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }

    public function index()
    {
        return view('login');
    }
    public function dashboard()
    {
        return view('landingpage');
    }


    public function handleLoginAdmin(Request $request)
    {
        $request_data = $request->all();
        $response = $this->adminService->login($request_data);
        if (!$response['status']) {
            return back()->withErrors($response['data']['validation_errors'] ?? [])->withInput();
        }
        $user = getAuthUser('admin');
        return redirect()->route('getDashboardHome')->with('success', __('trans.welcome_login') . ' ' . $user->name);
    }


    public function handleLogoutAdmin(Request $request)
    {
        auth('admin')->logout();
        return redirect()->route('login');
    }
}
