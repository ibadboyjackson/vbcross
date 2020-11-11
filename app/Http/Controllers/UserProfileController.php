<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\UserQA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'alpha_dash', 'max:255', Rule::unique('users')->ignore($user)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        toast('Profile updated successfully', 'success');
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            toast('Password change successfully', 'success');
            return redirect()->back();
        } else {
            toast('Current password does not match', 'error');
            return redirect()->back();
        }

    }

    public function publicProfile($username)
    {
        $user = User::where('username' , $username)->get()->first();
        $user->load('roles');
        $userTotalLikes = 0;
        $posts = Post::with('likes')->where('user_id' , $user->id)->get();

        foreach ($posts as $post){
            $userTotalLikes = $userTotalLikes + $post->likers()->count();
        }

        return view('profile.public', compact('user' , 'userTotalLikes'));

    }
}
