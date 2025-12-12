<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function authenticate(Request $request) {
        if(!Auth::attempt($request->only('email','password'))){
            return redirect()->back()->withErrors(['Usuário ou senha inválida']);
        }

        return to_route('series.index');
    }

    public function create(){
        return view('login.create');
    }

    public function store(Request $request){
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        Auth::login($user);

        return to_route('series.index');
    }

    public function logout()
    {
        Auth::logout();

        return to_route('login');
    }
}
