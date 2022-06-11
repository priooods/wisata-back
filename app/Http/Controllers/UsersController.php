<?php

namespace App\Http\Controllers;

use App\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','not_access']]);
    }

    public function register(Request $request){
        if ($validate = $this->validing($request->all(),[
            'username' => 'required|string|max:20',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|min:6',
        ]))
            return $validate;

        $request['password'] = Hash::make($request->get('password'));
        $user = AppUser::create($request->all());
        $token = JWTAuth::fromUser($user);
        return $this->resSuccess(["token" => $token],200);
    }

    public function user_all(){
        return $this->resSuccess(AppUser::all());
    }

    public function logout(){
        return $this->resSuccess(auth()->logout());
    }

    public function me(){
        return $this->resSuccess(auth()->user());
    }

    public function login(Request $request){
        if ($validate = $this->validing($request->all(),[
            'username' => 'required|string|max:20',
            'password' => 'required|min:6',
        ]))
            return $validate;

        if (!$token = auth()->attempt($request->all())) {
            return $this->resFailure(1,"Informasi pengguna tidak valid !");
        }
        return $this->resSuccess(["token" => $token],200);
    }

    public function not_access(){
        return $this->resFailure(1,"Not Access !");
    }
}
