<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\Client;

final class PokemonTcgClient
{
    public function __construct(private Client $client) {}

    public function searchCardsByName(string $pokemonName): array
    {
        $pokemonName = trim($pokemonName);

        if ($pokemonName === "") {
            $pokemonName = "arceus";
        }

        $response = $this->client->get("cards", [
            "query" => [
                "q" => "name:$pokemonName",
            ],
        ]);

        $data = json_decode((string) $response->getBody(), true);

        return $data["data"] ?? [];
    }
}
