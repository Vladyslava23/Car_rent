<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/_admin_header.php';

$sql = "SELECT * FROM cars";
$result = mysqli_query($conn, $sql);
?>

<h1>Autode haldus</h1>

<p>
    <a href="add_car.php" class="btn btn-success">Lisa auto</a>
</p>

<table class="table">
    <tr>
        <th>ID</th>
        <th>Auto</th>
        <th>Hind</th>
        <th>Staatus</th>
        <th>Tegevused</th>
    </tr>

    <?php while ($car = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $car['id'] ?></td>

            <td>
                <?= $car['mark'] ?> <?= $car['model'] ?>
            </td>

            <td>
                <?= $car['price'] ?> €
            </td>

            <td>
                <?= $car['status'] ?>
            </td>

            <td>
                <a href="edit_car.php?id=<?= $car['id'] ?>" class="btn btn-primary btn-sm">
                    Muuda
                </a>

                <a href="delete_car.php?id=<?= $car['id'] ?>" class="btn btn-danger btn-sm">
                    Kustuta
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php require_once __DIR__ . '/_admin_footer.php'; ?>