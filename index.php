<?php

declare(strict_types=1);

require __DIR__ . "/vendor/autoload.php";

use App\Controller\PokemonController;
use App\Service\PokemonTcgClient;
use GuzzleHttp\Client;

$client = new Client([
    "base_uri" => "https://api.pokemontcg.io/v2/",
]);

$pokemonService = new PokemonTcgClient($client);
$controller = new PokemonController($pokemonService);

$controller->index();
