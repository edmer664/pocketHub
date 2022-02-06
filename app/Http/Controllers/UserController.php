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
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $query = User::find(Auth::user()->id)->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
            ]);
            if(!$query){
                return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your profile info has been update successfuly.']);
            }
        }
    }

    public function changePassword(Request $request){
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
                return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
            }else{

            $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newPassword)]);

            if( !$update ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
            }
        }
    }

    public function uploadAvatar(Request $request){
        
        $validator =  \Validator::make($request->all(),[
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $path = 'app/public/avatars/';
        $file = $request->file('avatar');
        $new_name = $file->getClientOriginalName();

        if( !$validator->passes() ){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

        $upload = $file->move(storage_path($path), $new_name);
        
        if( !$upload ){
            return response()->json(['status'=>0,'msg'=>'Something went wrong, upload new picture failed.']);
            }else{
                
                $update = User::find(Auth::user()->id)->update(['avatar_path'=>$new_name]);

                if( !$upload ){
                    return response()->json(['status'=>0,'msg'=>'Something went wrong, updating picture in db failed.']);
                }else{
                    return response()->json(['status'=>1,'msg'=>'Your profile picture has been updated successfully','avatar'=>$new_name]);
                }
            }
        }
    }
}
