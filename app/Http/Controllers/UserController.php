<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserController extends Controller
{
    //index
    public function index(Request $request)
    {
        $users = DB::table('users')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%'.$name.'%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('pages.users.index' , compact('users'));
    }
    //create
    public function create()
    {

        return view('pages.users.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }
    //show
    public function show($id)
    {
        $user = User::find($id);
        return view('pages.users.show', compact('user'));
    }

    //edit
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.users.edit', compact('user'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable',
            'role' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        if($request->password){
            $user->password = Hash::make($request->password);
        }else{
            $user->password = $user->password;
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    //destroy
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
