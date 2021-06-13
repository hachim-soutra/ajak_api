<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(40);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('customauth.verify', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $updatePassword = DB::table('password_resets')
            ->where(['token' => $request->token])
            ->first();

        if (!$updatePassword)
            return response()->json([
                'message' => 'mot de pass incorrect!!'
            ]);
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return response()->json([
            'message' => 'Your password has been changed!'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Login or mot de pass incorrect !!'
            ], 401);

        if (Auth::user()->userable_type != Admin::class)
            return response()->json([
                'message' => `Unauthorized`. ${Auth::user()->userable_type}
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token'  => $tokenResult->accessToken,
            'user'          => auth()->user(),
            'space'         => 'agency',
            'message'       => 'login with success',
            'token_type'    => 'Bearer',
            'expires_at'    => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}
