<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthController extends Controller
{
    /**
     * Attempt to log in a user.
     *
     * This method attempts to authenticate a user using email and password credentials.
     * If authentication is successful, a JWT token is returned.
     * If authentication fails, an error response is returned.
     *
     * @param Request $request The request object containing login credentials.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the JWT token or an error message.
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException Throws an HTTP exception if token creation fails.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    /**
     * Register a new user.
     *
     * This method validates the incoming request data for user registration and creates a new user if the validation is successful.
     * Upon successful creation, it generates a JWT token for the newly created user.
     * If validation fails, a validation exception will be thrown by the framework.
     *
     * @param Request $request The request object containing user registration data.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the new user's data and JWT token, with a 201 status code.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);
    }

    /**
     * Retrieve the authenticated user.
     *
     * Attempts to retrieve the authenticated user by parsing the JWT token.
     * Handles various exceptions related to the token and returns corresponding JSON responses.
     *
     * @return \Illuminate\Http\JsonResponse The authenticated user's data or error message.
     */
    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }
}
