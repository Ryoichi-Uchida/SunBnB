<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function show()
    {
        return view('users.show');
    }

    public function edit()
    {
        return view('users.edit');
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['nullable', 'numeric', 'digits:11'],
            'description' => ['nullable', 'min:10', 'max:255'],
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

        if(!empty($request->phone)){
            Auth::user()->update([
                'phone' => $request->phone
            ]);
        }

        if(!empty($request->description)){
            Auth::user()->update([
                'description' => $request->description
            ]);
        }

        if(!empty($request->password)){
            Auth::user()->update([
                'password' => bcrypt($request->password)
            ]);
        }

        toastr()->success("Successfully updated!");

        return redirect()->route('users.edit');
    }
}
