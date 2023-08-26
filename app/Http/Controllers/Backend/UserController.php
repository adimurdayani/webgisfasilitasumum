<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('app.users.index');
        $roles = Role::all();
        return view('backend.user.index', compact('roles'));
    }

    public function load_data()
    {
        $user = User::all();
        return DataTables::of($user)->toJson();
    }

    public function create()
    {
        Gate::authorize('app.users.create');
        $roles = Role::all();
        return view('backend.user.create', compact('roles'));
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email|string|max:255',
            'password' => 'required|min:6|string|max:255',
            'conf_password' => 'required|min:6|same:password|string|max:255',
        ]);

        User::create([
            "role_id" => $request->role_id,
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "status" => $request->status,
        ]);

        Session::flash('success', 'Data berhasil disimpan!');
        return redirect()->back();
    }

    public function edit(User $user)
    {
        Gate::authorize('app.users.edit');
        $roles = Role::all();
        return view('backend.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|min:6|string|max:255',
            'conf_password' => 'required|min:6|same:password|string|max:255',
        ]);

        $user->update([
            "role_id" => $request->role_id,
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "status" => $request->status,
        ]);

        Session::flash('success', 'Data berhasil diubah!');
        return redirect()->back();
    }

    public function update_data(Request $request)
    {

        $validasi = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255'
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        }

        if ($request->ajax()) {
            User::find($request->id)->update([
                "name" => $request->name,
                "email" => $request->email,
            ]);

            return response()->json(['success' => 'Data berhasil disimpan']);
        }
    }

    public function hapus(User $user)
    {
        Gate::authorize('app.users.destroy');
        if (empty($user->id)) {
            return response()->json(['error' => 'User not found!']);
        } else {
            $user->delete();
            return response()->json(['success' => 'Data berhasil dihapus!']);
        }
    }
}
