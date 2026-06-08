<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/header.php';

$result = $conn->query("SELECT * FROM cars ORDER BY price ASC");
?>
<div class="container py-5">
    <h1 class="mb-3">Hinnad</h1>
    <p class="lead text-muted mb-4">
        Vali sobiv auto ja vaata rendihinda ühe päeva kohta.
    </p>

    <div class="table-responsive">
        <table class="table table-striped align-middle bg-white shadow-sm">
            <thead>
                <tr>
                    <th>Auto</th>
                    <th>Aasta</th>
                    <th>Kütus</th>
                    <th>Käigukast</th>
                    <th>Kohti</th>
                    <th>Hind</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($car = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <strong><?= htmlspecialchars($car['mark'] . ' ' . $car['model']) ?></strong>
                        </td>
                        <td><?= htmlspecialchars($car['year']) ?></td>
                        <td><?= htmlspecialchars($car['fuel']) ?></td>
                        <td><?= htmlspecialchars($car['transmission']) ?></td>
                        <td><?= htmlspecialchars($car['seats']) ?></td>
                        <td>
                            <strong><?= number_format($car['price'], 2) ?> €/päev</strong>
                        </td>
                        <td>
                            <a href="auto.php?id=<?= $car['id'] ?>" class="btn btn-primary btn-sm">
                                Rendi
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>