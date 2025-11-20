<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout() {
        auth() -> logout();
        return redirect('/');
    }

    public function register (REQUEST $request) {
        $incomingFields = $request->validate([
            "name" => ["required", "min:3", "max:10", Rule::unique('users', 'name')],
            "email" => ["required", "min:6", "email", Rule::unique('users', 'email')],
            "password" => ["required", "min:5", "max:200"]
        ]);

    $incomingFields["password"] = bcrypt($incomingFields["password"]);
    $user = User::create($incomingFields);

    auth()->login($user);
    return redirect('/');
       
    }
}
