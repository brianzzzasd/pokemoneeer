<?php

namespace App\Http\Controllers;

use App\Http\Resources\PokemonCollection;
use App\Models\Pokemons\Favorite;
use App\Models\Pokemons\Hate;
use App\Models\Pokemons\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PokemonController extends Controller
{
    /**
     * Get Pokemon
     * @param Request $request
     *
     * return Response
     */
    public function pokemon(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = $request->limit ?? 20;

        $pokemons = DB::table('pokemon')->skip($offset)->take($limit)->get();

        return new PokemonCollection($pokemons);
    }

    /**
     * Add Hated Pokemon
     * @param $id
     *
     * return Response
     */
    public function addHate($id)
    {
        $user = auth('sanctum')->user();

        if ($user->hates->count() === 3) {
            return response()->json([
                'status' => false,
                'message' => 'You can only hate 3 pokemons',
            ], 400);
        }

        $hate = Hate::create([
            'user_id' => $user->id,
            'pokemon_id' => $id
        ]);

        if ($hate) {
            return response()->json([
                'status' => true,
                'message' => 'Added Successfully',
            ], 200);
        }
    }

    /**
     * Add Like
     * @param $id
     *
     * return Response
     */
    public function addLike($id)
    {
        $user = auth('sanctum')->user();

        if ($user->likes->count() === 3) {
            return response()->json([
                'status' => false,
                'message' => 'You can only like 3 pokemons',
            ], 400);
        }

        $like = Like::create([
            'user_id' => $user->id,
            'pokemon_id' => $id
        ]);

        if ($like) {
            return response()->json([
                'status' => true,
                'message' => 'Added Successfully',
            ], 200);
        }
    }

    /**
     * Delete Hate
     * @param Hate $hate
     *
     * return Response
     */
    public function deleteHate(Hate $hate)
    {
        if ($hate->each->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Deleted Successfully',
            ], 200);
        }
    }

    /**
     * Delete Like
     * @param Like $like
     *
     * return Response
     */
    public function deleteLike(Like $like)
    {
        if ($like->each->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Deleted Successfully',
            ], 200);
        }
    }

    /**
     * Add Favorite
     * @param $id
     *
     * return Response
     */
    public function addFavorite($id)
    {
        $user = auth('sanctum')->user();

        $favorite = Favorite::create([
            'user_id' => $user->id,
            'pokemon_id' => $id
        ]);

        if ($user->favorite->count() > 0) {
            return response()->json([
                'status' => false,
                'message' => 'You can only favorite 1 pokemon',
            ], 400);
        }

        if ($favorite) {
            return response()->json([
                'status' => true,
                'message' => 'Added Successfully',
            ], 200);
        }
    }

    /**
     * Delete Favorite
     * @param Favorite $id
     *
     * return Response
     */
    public function deleteFavorite(Favorite $id)
    {
        $favorite = Favorite::find($id);

        if ($favorite->each->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Deleted Successfully',
            ], 200);
        }
    }

    /**
     * Basic Response
     * @param $status
     * @param $message
     * @param int $code
     *
     * return Response
     */
    public function basicResponse($status, $message, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $code);
    }
}
