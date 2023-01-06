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
    public function pokemon(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = $request->limit ?? 20;

        $pokemons = DB::table('pokemon')->skip($offset)->take($limit)->get();

        return new PokemonCollection($pokemons);
    }

    public function addHate(Request $request)
    {
       $hate = Hate::create([
            'user_id' => $request->user_id,
            'pokemon_id' => $request->pokemon_id
        ]);

        if ($hate) {
            return response()->json([
                'status' => true,
                'message' => 'Added Successfully',
            ], 200);
        }
    }

    public function addLike(Request $request)
    {
       $like = Like::create([
            'user_id' => $request->user_id,
            'pokemon_id' => $request->pokemon_id
        ]);

        if ($like) {
            return response()->json([
                'status' => true,
                'message' => 'Added Successfully',
            ], 200);
        }
    }

    public function deleteHate(Hate $id)
    {
        $hate = Hate::find($id);

        if ($hate->each->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Deleted Successfully',
            ], 200);
        }
    }

    public function deleteLike(Like $id)
    {
        $like = Like::find($id);

        if ($like->each->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Deleted Successfully',
            ], 200);
        }
    }

    public function addFavorite(Request $request)
    {
       $favorite = Favorite::create([
            'user_id' => $request->user_id,
            'pokemon_id' => $request->pokemon_id
        ]);

        if ($favorite) {
            return response()->json([
                'status' => true,
                'message' => 'Added Successfully',
            ], 200);
        }
    }

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

    public function basicResponse($status, $message, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $code);
    }
}
