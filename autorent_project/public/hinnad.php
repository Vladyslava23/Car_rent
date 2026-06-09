<?php

require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/header.php';

$sql = "SELECT * FROM cars ORDER BY price";
$result = mysqli_query($conn, $sql);

?>

<h1>Hinnad</h1>

<table class="table">

    <tr>
        <th>Auto</th>
        <th>Hind</th>
        <th></th>
    </tr>

    <?php while($car = mysqli_fetch_assoc($result)): ?>

    <tr>

        <td>
            <?= $car['mark'] ?>
            <?= $car['model'] ?>
        </td>

        <td>
            <?= $car['price'] ?> €/päev
        </td>

        <td>
            <a href="auto.php?id=<?= $car['id'] ?>" class="btn btn-primary btn-sm">
                Rendi
            </a>
        </td>

    </tr>

    <?php endwhile; ?>

</table>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>