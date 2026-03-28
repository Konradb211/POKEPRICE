<?php

require __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new Client([
    "base_uri" => "https://api.pokemontcg.io/v2/",
]);

$response = $client->get("cards?q=name:ditto&pageSize=10");

$data = json_decode($response->getBody(), true);

$firstPokemon = $data["data"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/styles.css">
    <title>POKEPRICE</title>
</head>

<body>
    <div class="wrapper">
        <?php foreach ($firstPokemon as $pokemons) {
            $name = $pokemons["name"];
            $smallImg = $pokemons["images"]["small"];
            $largeImage = $pokemons["images"]["large"];
            $prices = $pokemons["tcgplayer"]["prices"] ?? [];
            echo "<div class='item'>";
            echo "<img src='$smallImg' alt='$name' />";
            foreach ($prices as $price) {
                echo "<p class='price'>" .
                    "cena: " .
                    $price["market"] .
                    "$" .
                    "</p>";
            }
            echo "</div>";
        } ?>
    </div>
</body>

</html>
