<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, User::$create_validation_rules);
        $data = $request->only('name', 'email', 'password','user_type');
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        if($user){
            \Auth::login($user);
            if($user->user_type == 'Administrator') {
                return redirect('/admin');
            }

            else if($user->user_type == 'Pharmacist') {
                return redirect('/home');
            }
            /*return redirect()->route('home');*/
        }

        return back()->withInput();
    }

    public function home(){
        return view ('admin.index');
    }

}
