<?php

namespace App\Http\Controllers;

use App\Mail\RestorePassword;
use App\Mail\VerifyEmail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verify', 'restorePassword']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Wrong Login or Password.'], 401);
        }
        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,255',
            'last_name' => 'required|string|between:2,255',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        if(env('EMAIL_CHECK',false)){
            $TIM=stripos($request->get('email',''),"@ftim.ru");
            if ($TIM==false){
                return response()->json(['Error'=>'Bad email'], 400);
            }
        }
        if ($validator->fails() ) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $token = Str::random(100);
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password),
                'verify_token' => $token
            ]
        ));
        Mail::to($user['email'])->send(new VerifyEmail(['email' => $user['email'], 'token' => $token]));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        $user = auth()->user();
        if (!isset($user['email_verified_at'])) {
            return response()->json(['error' => 'Verify your email'], 401);
        } else {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
                'user' => auth()->user()
            ]);
        }
    }


    public function restorePassword(Request $request)
    {

        $valid = $request->validate(['email' => 'required|string|email|max:100|exists:users,email']);

        $user = User::where('email', $valid['email'])->first();
        $new_password = Str::random(8);
        $user->password = Hash::make($new_password);
        $user->save();
        Mail::to($user->email)->send(new RestorePassword(['email' => $valid['email'], 'pass' => $new_password]));
        return array("message" => "Check your e-mail. You can now login.");
    }

    public function verify(Request $request)
    {
        $token = $request->get('token', '0');
        $user = User::where('verify_token', $token)->first();
        if (isset($user)) {
            $user['email_verified_at'] = new \DateTime();
            $user['verify_token'] = null;
            $user->save();
            return response()->redirectTo('http://innocase.cyberbobs.xsph.ru/');
        } else {
            return response()->json(['error' => 'Error'], 400);
        }
    }
}
