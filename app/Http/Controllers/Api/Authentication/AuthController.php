<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Enum\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    /**
     * Display a listing of User.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $user = User::latest()->paginate();

        return UserResource::collection($user);
    }

    /**
     * Summary of store
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            ...$request->validated(),
            'role' => Role::EMPLOYEE,
        ]);

        $user->sendEmailVerificationNotification();

        $user->refresh();

        return response()->json([
            'message' => 'Registration successful, please verify your email',
            'data' => new UserResource($user),
        ], 201);
    }

    /**
     * Display the specified user.
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Function for Logging in.
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (! Auth::attempt($request->validated())) {
            abort(401, 'Invalid credentials.');
        }

        $user = $request->user();

        $key = Str::lower($user->email) . '|veriviation-email';

        if (! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();

            if (RateLimiter::tooManyAttempts($key, 3)) {
                return response()->json([
                    'message' => 'Too many varification email requests. Please try again later.',
                    'available_in_seconds' => RateLimiter::availableIn($key),
                ]);
            }

            return response()->json([
                'message' => 'Please verify your email. Verification link has been sent.',
            ], 403);
        }

        RateLimiter::hit($key, 60);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'credentials' => new UserResource($user),
        ]);
    }

    /**
     * Has not been implemented yet
     * @param Request $request
     * @param string $id
     * @return void
     */
    public function update(Request $request, string $id)
    {
        throw new \Exception("Not implemented");
    }

    /**
     * Function for Logging out
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successfuly',
        ]);
    }

    /**
     * Has not been implemented yet
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        throw new \Exception("Not implemented");
    }
}
