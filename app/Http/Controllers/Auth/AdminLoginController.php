<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
  
   


    public function __construct()
    {
        $this->middleware('guest:admin')->except('Adminlogout');
    }
    public function showLoginForm()
    {
        return view('auth.adminlogin');
    }
    public function login(Request $request) {

        $this->validate($request,[
            'email' => 'email|required',
            'password' => 'min:6|required',


        ]);


        if(Auth::guard('admin')->attempt(['email'=>request('email'),'password' =>request('password')],$request->remember))
        {

            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email','remember'));

        
        
    }

    public function Adminlogout() {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }

}


