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
        $res['user'] = $user;

        return $this->successResponse($res, 'Register successfully.');
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

        $res['token'] = $token;

        return $this->successResponse($res, 'Login successfully.');
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        $user = auth()->user();
        $res['user'] = $user;
        return $this->successResponse($res);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();
        return $this->successResponse(null, 'Successfully logged out.');
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $newToken = auth()->refresh();
        $res['token'] = $newToken;
        return $this->successResponse($res, 'Refresh token return successfully.');
    }
}
