<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id) {
        $id = (integer)$id;
        $user_id = Auth::id();
        $user = $this->user->where('id', $id)->first();
        if ($id != $user_id) {
            return redirect()->route('user.show', ['id' => $user_id]);
        }
        return view('users.show', ['user' => $user]);
    }

    public function edit($id) {
        $id = (integer)$id;
        $user_id = Auth::id();
        $user = $this->user->where('id', $id)->first();
        if ($id != $user_id) {
            return redirect()->route('home');
        }
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id) {
        $inputs = $request->all();
        $this->user->where('id', $id)->update(['name' => $inputs["name"]], ['email' => $inputs['email']]);
        return redirect()->route('user.show', ['id' => $id]);
    }
}