<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    //method to login the user

    public function login(Request $request) {
        //validating 
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword'=> 'required',
        ]);

        //attempt method performs the necessary queries to check for the user with name equal to login name and match the password by automatically converting it from hash to original form .
        if(auth() -> attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
           $request->session()->regenerate();// use to gerate a new session id to prevent attack attempt.
        }

        return redirect('/');
    }


    //method to logout the user

    public function logout() { 
        auth() -> logout();// logout() method removes the authentication info stored int he user's session
        return redirect('/');
    }


    // method to Register the user by creating a new user account

    public function register (Request $request) {

        $incomingFields = $request->validate([
            "name" => ["required", "min:3", "max:10", Rule::unique('users', 'name')],//this check queries the database to check the name doesn't already exists...
            "email" => ["required", "min:6", "email", Rule::unique('users', 'email')],
            "password" => ["required", "min:5", "max:200"]
        ]);

        $incomingFields["password"] = bcrypt($incomingFields["password"]);

        $user = User::create($incomingFields);

        auth()->login($user);// auth() helper function provides access to laravel's authentication system.

        //login() this method takes the user model instance and sets up the seession data and effectively logs the user in.

        return redirect('/');
       
    }
}
