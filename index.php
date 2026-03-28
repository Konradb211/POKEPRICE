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

$response = $client->get("cards?q=name:ditto");

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
        <?php foreach ($firstPokemon as $pokemon): ?>
            <?php
            $name = $pokemon["name"];
            $smallImg = $pokemon["images"]["small"];
            $prices = $pokemon["tcgplayer"]["prices"] ?? [];
            ?>

            <div class="item">
                <img src="<?= $smallImg ?>" alt="<?= htmlspecialchars(
    $name,
) ?>">

                <h2><?= htmlspecialchars($name) ?></h2>

                <?php if (!empty($prices)): ?>
                    <div class="prices">
                        <?php foreach ($prices as $type => $price): ?>
                            <p class="price">
                                <strong><?= htmlspecialchars($type) ?>:</strong>
                                <?= $price["market"] ?? "brak danych" ?> $
                            </p>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="price">Brak cen</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>
