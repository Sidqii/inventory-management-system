<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Enum\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Function for Registration.
     * @param RegisterRequest $request
     * @return UserResource
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            ...$request->validated(),
            'role' => Role::EMPLOYEE,
        ]);

        $user->refresh();

        return new UserResource($user);
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
        if (! User::where('email', $request->email)->exists()) {
            abort(404, 'User not found');
        }

        if (! Auth::attempt($request->validated())) {
            abort(401, 'Invalid credentials.');
        }

        $user = $request->user();

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
