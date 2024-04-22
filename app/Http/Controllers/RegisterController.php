<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function create(){
        return view('admin.register');
    }

    public function store(Request $request){
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'sname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'sname' => $request->sname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->attachRole('admin');
        event(new Registered($user));
        
        return back()->with('status','Admin a été enregistré avec succès');
    }
}
