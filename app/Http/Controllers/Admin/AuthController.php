<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(){
        try{

            return view('pages.authentication.login');

        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }


    public function loginSubmit(Request $request){
        try{
            $user = User::where('email', $request->email)->first();
            if($user){
                $roles = $user->getRoleNames();
                if($roles->contains('admin')){
                    $credentials = $request->only('email', 'password');
                    if(Auth::attempt($credentials)){
                        Toastr::success('Successfully Created');
                        return redirect()->route('admin.dashboard');
                    }
                    Toastr::error("Credentials don't match");
                    return redirect()->back();
                }
                Toastr::error("You don't have permission");
                return redirect()->back();
            }
            Toastr::error("User doesn't exists");
            return redirect()->back();
        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dashboard(){
        try{
            return view('pages.admin.dashboard');

        }catch(\Exception $e){
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }
}
