<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PokemonTcgClient;

class PokemonController
{
    public function __construct(private PokemonTcgClient $pokemonTcgClient) {}

    public function index(): void
    {
        $pokemonName = trim($_POST["name"] ?? "arceus");
        $firstPokemon = $this->pokemonTcgClient->searchCardsByName(
            $pokemonName,
        );

        require __DIR__ . "/../../views/home.php";
    }
}
