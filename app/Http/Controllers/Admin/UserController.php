<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; 

class UserController extends Controller
{
public function index()
{
    $users = \App\Models\User::select('user_id', 'name', 'email', 'role')->get();
    
    return view('admin.users.index', compact('users'));
}

public function destroy($id)
{
    $user = \App\Models\User::where('user_id', $id)->firstOrFail();
    
    if (auth()->id() == $user->user_id) {
        return back()->with('error', 'Вы не можете удалить свой собственный аккаунт!');
    }

    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно удален');
}
}

