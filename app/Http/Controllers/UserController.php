<?php

namespace App\Http\Controllers;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    public function profile(){
        return view('user.profile');
    }

    public function editInfo(){
        return view('user.editInfo');
    }

    public function updateInfo(Request $request){

        $validator = Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=> 'required|email|unique:users,email,'.Auth::user()->id,
        ]);

        if(!$validator->passes()){
            return redirect()->route('profile');
        }else{
            $query = User::find(Auth::user()->id)->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
            ]);
            return redirect()->route('editInfo');

        }
    }
    function changePassword(Request $request){
            $validator = \Validator::make($request->all(),[
                'currentPassword'=>[
                    'required', function($attribute, $value, $fail){
                        if( !\Hash::check($value, Auth::user()->password) ){
                            return $fail(__('The current password is incorrect'));
                        }
                    },
                    'min:8',
                    'max:30'
                ],
                'newPassword'=>'required|min:8|max:30',
                'reTypePassword'=>'required|same:newPassword'
            ],[
                'currentPassword.required'=>'Enter your current password',
                'currentPassword.min'=>'Old password must have atleast 8 characters',
                'currentPassword.max'=>'Old password must not be greater than 30 characters',
                'newPassword.required'=>'Enter new password',
                'newPassword.min'=>'New password must have atleast 8 characters',
                'newPassword.max'=>'New password must not be greater than 30 characters',
                'reTypePassword.required'=>'ReEnter your new password',
                'reTypePassword.same'=>'New password and Confirm new password must match'
            ]);

            if( !$validator->passes() ){
                return Redirect::back()->withErrors($validator);
            }else{

            $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newPassword)]);

            if( !$update ){
                return redirect()->route('profile');
            }else{
                return redirect()->route('editInfo');
            }
        }
    }
}
