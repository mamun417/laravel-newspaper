<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admins = Admin::where('deletable', 1)->get();

        return view('backend.user.admin_list', compact('admins'));
    }

    public function create()
    {
        return view('backend.user.admin_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|unique:admins',
            'username' => 'required|unique:admins',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',

        ]);

        $admin = new Admin();
        $admin->name         = $request->name;
        $admin->designation  = $request->designation;
        $admin->username     = $request->username;
        $admin->email        = $request->email;
        $admin->password     = bcrypt($request->password);
        $admin->role         = $request->role;
        $admin->save();

        return redirect('backend/admins')->with('successMsg', 'The admin has been submitted successfully!');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);

        return view('backend.user.admin_edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'username' => 'required',

        ]);

        $admin = Admin::find($id);
        $admin->name         = $request->name;
        $admin->designation  = $request->designation;
        $admin->username     = $request->username;
        $admin->email        = $request->email;
        $admin->role         = $request->role;
        $admin->save();

        return redirect('backend/admins')->with('successMsg', 'The admin has been updated successfully!');
    }

    public function destroy($id)
    {
        Admin::where('id', $id)->update(['deletable' => 2]);
        return redirect('backend/admins')->with('successMsg', 'The admin has been removed successfully!');
    }

    public function getChangePassword($id){
        $admin = Admin::find($id);

        return view('backend.user.admin_change_password', compact('admin'));
    }

    public function postChangePassword(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        Admin::where('id', $id)->update(['password' => bcrypt($request->password)]);
        return redirect('backend/admins')->with('successMsg', 'The admin password has been changed successfully!');
    }
}
