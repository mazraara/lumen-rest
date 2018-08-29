<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /**
     * Index login controller
     */
    public function index(Request $request)
    {
        $hasher = app()->make('hash');
        $email = $request->input('email');
        $password = $request->input('password');
        $login = User::where('email', $email)->first();
        if (! $login) {
            return response()->json([
                'success' => false,
                'message' => 'You are not subscribed yet!',
            ]);
        } else {
            if ($hasher->check($password, $login->password)) {
                $apiToken = sha1(time());
                $createToken = User::where('id', $login->id)->update(['api_token' => $apiToken]);
                if ($createToken) {
                    return response()->json([
                        'success' => true,
                        'api_token' => $apiToken,
                        'message' => 'Success',
                    ]);
                }
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Your email or password incorrect!',
                ]);
            }
        }
    }
}