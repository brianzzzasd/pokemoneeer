<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get Users
     * @param Request $request
     *
     * return Response
     */
    public function users(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = $request->limit ?? 20;

        $users = User::query()
            ->with(['hates', 'likes', 'favorite'])
            ->skip($offset)->take($limit)->get();

        return response()->json([
            'status' => true,
            'users' => UserResource::collection($users),
        ]);
    }

    /**
     * Get User
     * @param Request $request
     *
     * return Response
     */
    public function user()
    {
        return response()->json([
            'status' => true,
            'user' => auth('sanctum')->user(),
        ]);
    }

    /**
     * Update User
     * @param Request $request
     *
     * return Response
     */
    public function updateUser(Request $request)
    {
        $user = auth('sanctum')->user();

        $validateUser = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors(),
            ], 401);
        }

        $user->update([
            'name' => request()->name,
            'email' => request()->email,
            'password' => request()->password,
        ]);

        return response()->json([
            'user' => $user,
            'status' => true,
            'message' => 'User Updated',
        ]);
    }
}
