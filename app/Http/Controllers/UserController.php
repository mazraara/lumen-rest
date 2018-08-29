<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Register new user
     *
     * @param $request Request
     */
    public function register(Request $request)
    {
        $hasher = app()->make('hash');

        $username = $request->input('username');
        $email = $request->input('email');
        $password = $hasher->make($request->input('password'));
        $register = User::create([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);
        if ($register) {
            return response()->json([
                'success' => true,
                'message' => 'Success',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed',
            ]);
        }
    }

    /**
     * Get user by id
     * URL /user/{id}
     */
    public function getUser(Request $request, $id)
    {
        $user = User::where('id', $id)->get();
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => $user,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cannot find user!',
            ]);
        }
    }
}