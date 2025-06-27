<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $getModul = User::paginate(10)->onEachSide(2);

        return view('panel.users.index', ['data' => $getModul]);
    }

    public function create()
    {
        return view('panel.users.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('message', 'User telah ditambah');
    }

    public function show($id)
    {
        $getModul = User::find($id);

        return view('panel.users.show', ['data' => $getModul]);
    }

    public function edit($id)
    {
        $getModul = User::find($id);

        return view('panel.users.edit', ['data' => $getModul]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|unique:users,email,'.$id,
        ]);

        if ($request->password != null) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:8',
            ]);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        if ($user->update()) {
            return redirect()->route('users.show', $id)->with('message', 'Users telah diupdate');
        }
    }

    public function destroy($id)
    {
        $modul = User::find($id);
        if ($modul->delete()) {
            return redirect()->back()->with('message', 'User telah dihapus');
        }
    }
}
