<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\VpUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('backend.register');
    }
    public function postRegister(RegisterRequest $request)
    {
        $user = new VpUser();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 2;
        $user->save();
        return redirect()->intended('/login');
    }
}
