<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Modules\Auth\Http\Requests\AuthRequest;
use App\Modules\User\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Modules\User\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(protected UserService $service)
    {
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request)
    {
        if(!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return $this->unauthorizedResponse('Unauthorized');
        }

        return $this->respondWithToken();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        $this->service->revokeTokens();
        return $this->okResponse('Logged out');
    }

    /**
     * Return user access token and data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => auth()->user()->createToken(env('TOKEN_NAME'))->plainTextToken,
            'user' => new UserResource(auth()->user())
        ]);
    }
}
