<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        return view('user.profile');
    }

    public function edit(){
        return view('user.edit');
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=> 'required|email|unique:users,email,'.Auth::user()->id,
        ]);

        if(!$validator->passes()){
            return redirect('profile/');
        }else{
            $query = User::find(Auth::user()->id)->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
            ]);
            return redirect('edit');

        }
    }
    
}
