<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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

        if (Auth::user()->userable_type != Client::class)
        return response()->json([
            'message' => `Unauthorized`
        ], 401);

        $user = auth()->user();
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
