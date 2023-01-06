<?php

namespace App\Console\Commands;

use App\Models\Pokemons\Pokemon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FillPokemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pokemon:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill Database with Pokemon Data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pokemons = [];

        for ($i = 1; $i <= 10249; $i++) {
            if ($i > 905 && $i < 10001) {
                continue;
            }

            $response = Http::get('https://pokeapi.co/api/v2/pokemon/' . $i)->json();
            $sprite =  $response['sprites']['other']['official-artwork']['front_default'] ??
                $response['sprites']['front_default'] ??
                "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/back/0.png";
            $typesResult = $response['types'];
            $types = [];

            foreach ($typesResult as $type) {
                array_push($types, $type['type']['name']);
            }

            Pokemon::create([
                'name' => ucfirst($response['name']),
                'types' => json_encode($types),
                'sprite' => $sprite,
            ]);
        }
    }
}
