<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function edit()
    {
        return view('user.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed']
        ]);

        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if(!empty($request->password)){
            Auth::user()->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('user.edit');
    }
}
