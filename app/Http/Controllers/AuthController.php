<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
   
   public function register(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    // If validation fails, return a JSON response with validation errors
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Validation passed, create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $success['token'] = $user->createToken('MyApp')->plainTextToken;
    $success['name']  = $user->name;   
    
    return response()->json(['status' => true,'data'=>$success,'message'=>'User register Successfully'], 201);

    }

    public function login(Request $request)
    {
        // Validation logic...

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
             $success['name']  = $user->name;
             $success['email']  = $user->email;
            

            return response()->json(['status' => true,'data'=>$success,'message'=>'User Login Successfully'], 201);
        } else {
            return response()->json(['status' => false,'message'=>'invalid user name or password'], 401);
        }
    }

    // public function user()
    // {
    //     return response()->json(['user' => Auth::user()], 200);
    // }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
