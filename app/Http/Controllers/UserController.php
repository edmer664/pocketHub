<?php

namespace App\Http\Controllers;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Comment;

use App\Models\User;

class UserController extends Controller
{
    public function profile(){
        //retrieve all user posts from database
        $user_id = Auth::user()->id;
        $posts = Post::where('author_id',$user_id)->orderBy('created_at', 'desc')->get();
        // count comments for each post
        foreach($posts as $post){
            $post->comments_count = Comment::where('post_id',$post->id)->count();
        }

        return view('user.profile',compact('posts'));
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
            $validator = Validator::make($request->all(),[
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
        $validator =  Validator::make($request->all(),[
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $path = 'app/public/avatars/';
        $file = $request->file('avatar');
        $new_name = time() .'_'. Auth::user()->id .'.'. $file->extension();

        if( !$validator->passes() ){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

            $oldPicture = User::find(Auth::user()->id)->getAttributes()['avatar_path'];
            if( $oldPicture != '' ){
                if( \File::exists(storage_path($path.$oldPicture))){
                    \File::delete(storage_path($path.$oldPicture));
                }
            }

            $upload = $file->move(storage_path($path), $new_name);
        
            if( !$upload ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, upload new picture failed.']);
                }else{

                    $update = User::find(Auth::user()->id)->update(['avatar_path'=>$new_name]);
                    
                    if( !$upload ){
                        return response()->json(['status'=>0,'msg'=>'Something went wrong, updating picture in db failed.']);
                    }else{
                        return response()->json(['status'=>1,'msg'=>'Your profile picture has been updated successfully','avatar'=>$new_name,'url'=>url('/'), 'old'=>$oldPicture]);
                    }
                }
        }
    }

    public function getUserInfo(Request $request, $id){
        $user = User::find($id);
        if( !$user ){
            return response()->json(['status'=>0,'msg'=>'User not found.']);
        }else{
            return response()->json(['status'=>1,'user'=>$user]);
        }
    }

    public function deactivate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>[
                'required', function($attribute, $value, $fail){
                    if($value !== Auth::user()->email){
                        return $fail(__('Incorrect'));
                    }
                },
            ],
            'password'=>[
                'required', function($attribute, $value, $fail){
                    if( !\Hash::check($value, Auth::user()->password) ){
                        return $fail(__('Incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ]
        ]);

        if( !$validator->passes() ){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

            $delete = User::find(Auth::user()->id);
            $delete->delete();
            Auth::logout();
            return redirect('/');
        }
    }
}
