<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Validator;
use Firebase\JWT\JWT;

class LoginController extends Controller
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Create a new token.
     *
     * @param \App\User $user
     * @return string
     */
    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60 * 60 // Expiration time
        ];

        // passing `JWT_SECRET` as the second param will be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function authenticate(User $user)
    {
        $this->validate($this->request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email
        $user = User::where('email', $this->request->input('email'))->first();
        if (! $user) {

            return response()->json([
                'success'=>false,
                'message' => 'Email does not exist.',
            ]);
        }
        // Verify the password and generate the token
        if (Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'success'=>true,
                'api_token' => $this->jwt($user),
                'data' => $user,
            ]);
        }

        // Bad Request response
        return response()->json([
            'success'=>false,
            'message' => 'Email or password is wrong.',
        ]);
    }

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