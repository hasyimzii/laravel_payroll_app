<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    private function checkId($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            Alert::toast('Data user tidak ditemukan!', 'error');
            return false;
        }
        return $user;
    }

    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'name' => ['required', 'string', 'max:30'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
        ]);
        if (!$validated) return back();

        User::create([
            'role_id' => 2,
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
 
        Alert::toast('Berhasil menambah data user!', 'success');
        return to_route('user.index');
    }
    
    public function edit($id)
    {
        $user = $this->checkId($id);
        if (!$user) return back();

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->checkId($id);
        if (!$user) return back();
        
        $validated = WebRequest::validator($request->all(), [
            'name' => ['required', 'string', 'max:30'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string'],
        ]);
        if (!$validated) return back();

        if(!Hash::check($request->password, $user->password)) {
            Alert::toast('Password salah!', 'error');
            return back();
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);
 
        Alert::toast('Berhasil mengubah data user!', 'success');
        return to_route('user.index');
    }

    public function editPassword($id)
    {
        $user = $this->checkId($id);
        if (!$user) return back();

        return view('user.editPassword', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = $this->checkId($id);
        if (!$user) return back();
        
        $validated = WebRequest::validator($request->all(), [
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
        ]);
        if (!$validated) return back();

        $user->update([
            'password' => Hash::make($request->password),
        ]);
 
        Alert::toast('Berhasil mengubah data password user!', 'success');
        return to_route('user.index');
    }
}
