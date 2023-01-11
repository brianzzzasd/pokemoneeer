<?php

namespace App\Http\Controllers;

use App\Http\Resources\PokemonCollection;
use App\Models\Pokemons\Favorite;
use App\Models\Pokemons\Hate;
use App\Models\Pokemons\Like;
use App\Models\Pokemons\Pokemon;
use Illuminate\Http\Request;

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
        $string = $request->string;

        if ($string) {
            $pokemons = Pokemon::query()
                ->where(function ($query) use ($string) {
                    $query->where('name', 'like', '%' . $string . '%')
                        ->orWhereJsonContains('types', $string);
                })->get();

            return new PokemonCollection($pokemons);
        }

        $pokemons = Pokemon::query()->skip($offset)->take($limit)->get();

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

        if ($user->hates->where('pokemon_id', $id)->first()) {
            return response()->json([
                'status' => false,
                'message' => 'You already hate this pokemon, please don\'t hate it again :(',
            ], 400);
        }

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

        if ($user->likes->where('pokemon_id', $id)->first()) {
            return response()->json([
                'status' => false,
                'message' => 'You already like this pokemon, please choose another :)',
            ], 400);
        }

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
