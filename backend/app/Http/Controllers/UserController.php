<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create User
     * @param Request $request
     *
     * return Response
     */
    public function createUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User Created',
            ]);
        }
    }

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
            'users' => $users,
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
}
