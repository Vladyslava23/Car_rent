<?php

require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/_admin_header.php';

$sql = "
SELECT *
FROM reservations
JOIN users ON reservations.user_id = users.id
JOIN cars ON reservations.car_id = cars.id
";

$result = mysqli_query($conn, $sql);

?>

<h1>Broneeringud</h1>

<table class="table">

    <tr>
        <th>ID</th>
        <th>Kasutaja</th>
        <th>Auto</th>
        <th>Algus</th>
        <th>Lõpp</th>
        <th>Hind</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)): ?>

    <tr>
        <td><?= $row['id'] ?></td>

        <td>
            <?= $row['name'] ?>
        </td>

        <td>
            <?= $row['mark'] ?> <?= $row['model'] ?>
        </td>

        <td>
            <?= $row['start_date'] ?>
        </td>

        <td>
            <?= $row['end_date'] ?>
        </td>

        <td>
            <?= $row['total_price'] ?> €
        </td>
    </tr>

    <?php endwhile; ?>

</table>

<?php require_once __DIR__ . '/_admin_footer.php'; ?>

