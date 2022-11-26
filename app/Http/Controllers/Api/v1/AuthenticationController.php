<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegistrationRequest;

class AuthenticationController extends Controller
{
    /**
     * Log in the user with a given email and password
     *
     * @param \App\Http\Requests\Authentication\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (!auth()->attempt($validated)) {
            return response()->json([
                'message' => 'These credentials do not match our records.',
            ]);
        }

        /**
         * @var \App\Models\User
         */
        $user = auth()->user();

        $accessToken = $user->createToken(time())->plainTextToken;

        return response()->json([
            'token' => $accessToken,
        ]);
    }

    /**
     * Register a new user with a given username and password
     *
     * @param \App\Http\Requests\Authentication\RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $accessToken = $user->createToken(time())->plainTextToken;

        return response()->json([
            'token' => $accessToken,
        ]);
    }
}
