<?php

namespace LaraDev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaraDev\Http\Controllers\Controller;
use LaraDev\User;

class AuthController extends Controller
{
    public function ShowLoginForm()
    {
        if (Auth::check() == true){
            return redirect()->route('admin.home');
        }
        return view('admin.index');
    }

    public function home()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if (in_array('', $request->only('email', 'password'))){
            $json['message'] = $this->message->error('opps, informe todos os dados.')->render();
            return response()->json($json);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json['message'] = $this->message->error('opps, informe um email valido.')->render();
            return response()->json($json);
        }

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)){

            $json['message'] = $this->message->error('opps, usuario e senha nao conferem.')->render();
            return response()->json($json);
        }

        $this->authentication($request->getClientIp());
        $json['redirect'] = route('admin.home');
        return response()->json($json);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function authentication($ip)
    {
        $user = User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip
        ]);
    }
}
