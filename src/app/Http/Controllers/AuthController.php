<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{

    /**
     * Register a User.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        $data['user'] = $user;
        return $this->successResponse($data, 'Registration successful.');
    }


    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $token = auth()->attempt($validated);
        if (!$token) {
            return $this->errorResponse('Unauthorised.');
        }
        $data['token'] = $token;
        return $this->successResponse($data, 'Login successful.');
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        $user = auth()->user();
        $data['user'] = $user;
        return $this->successResponse($data, 'Profile successful.');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();
        return $this->successResponse(null, 'Logged out successful.');
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $newToken = auth()->refresh();
        $data['token'] = $newToken;
        return $this->successResponse($data, 'Token refreshed successful.');
    }
}
