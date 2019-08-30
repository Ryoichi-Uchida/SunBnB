<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function edit()
    {
        return view('user.edit');
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed']
        ]);
    
        if($validator->fails()) {
            toastr()->error("The input contents are invalid!");
            
            return back()
                ->withErrors($validator) //It makes $errors array
                ->withInput();  //It makes 'old' array
        }

        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if(!empty($request->password)){
            Auth::user()->update([
                'password' => bcrypt($request->password)
            ]);
        }

        toastr()->success("Successfully updated!");

        return redirect()->route('user.edit');
    }
}
