<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{

    public function _construct(){
        $this->middleware('guest')->except('logout');
    }

    public function register ()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request){
        Validator::make($request->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'matricule' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'matricule' => $request->matricule,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => "0"
        ]);

        return redirect()->route('login');
    }

    public function login ()
    {
        return view('auth/login');
    }

    public function loginAction (Request $request)
    {
        Validator::make($request->all(), [
            'matricule' => 'required',
            'password' => 'required'
        ])->validate();

        /* if(!Auth::attempt($request->only('matricule', 'password'))) {
            throw ValidationException::withMessage([
                'email' => trans('auth.failed')
            ]);
        } */

        // Vérification des identifiants
        if (!Auth::attempt(['matricule' => $request->matricule, 'password' => $request->password])) {
            return back()->withErrors([
                'matricule' => 'Matricule ou mot de passe incorrect.',
            ])->withInput();
        }

        $request->session()->regenerate();

        if(auth()->user()->type == 'admin') {
            return redirect()->route('admin/home');
        }else {
            return redirect()->route('home');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }


    
}
