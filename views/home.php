<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/styles.css">
    <title>POKEPRICE</title>
</head>
<body>
    <div>
        <div>
            <form action="/" method="post">
                <input
                    type="text"
                    name="name"
                    value="<?= htmlspecialchars($pokemonName) ?>"
                    placeholder="Enter pokemon name"
                />
                <input type="submit" value="Search" />
            </form>
        </div>

        <div class="wrapper">
            <?php foreach ($firstPokemon as $pokemon): ?>
                <?php
                $name = $pokemon["name"] ?? "Unknown";
                $smallImg = $pokemon["images"]["small"] ?? "";
                $prices = $pokemon["tcgplayer"]["prices"] ?? [];
                ?>

                <div class="item">
                    <?php if ($smallImg !== ""): ?>
                        <img src="<?= htmlspecialchars(
                            $smallImg,
                        ) ?>" alt="<?= htmlspecialchars($name) ?>">
                    <?php endif; ?>

                    <h2><?= htmlspecialchars($name) ?></h2>

                    <?php if (!empty($prices)): ?>
                        <div class="prices">
                            <?php foreach ($prices as $type => $price): ?>
                                <p class="price">
                                    <strong><?= htmlspecialchars(
                                        (string) $type,
                                    ) ?>:</strong>
                                    <?= htmlspecialchars(
                                        (string) ($price["market"] ??
                                            "brak danych"),
                                    ) ?> $
                                </p>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="price">Brak cen</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
