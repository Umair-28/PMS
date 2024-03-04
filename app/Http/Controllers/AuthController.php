<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);

        // Create a new user instance
        try {
            // Create a new user instance
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect('/login');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during user creation
            return response()->json([
                'error' => 'Registration failed',
                'message' => $e->getMessage(),
            ], 500); // Return a 500 status code to indicate a server error
        }
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $role_name="";
        $tasks = "";

        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = Auth::user();

                $user_id = $user->id;
                $user_name = $user->name;
                $role_id = DB::table('model_has_roles')->where('model_id', $user_id)->value('role_id');

  
                    $role_name = DB::table('roles')->where('id', $role_id)->value('name');

                    $user = $request->user();
                    if($user->hasRole("developer")){
                        $tasks = DB::table('tasks')->where('assignee',$user->name)->get();
                        
                    }else{
                         $tasks = DB::table('tasks')->get();
                    }
            return view('dashboard',compact('user', 'role_name', 'user_name', 'tasks'));
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
