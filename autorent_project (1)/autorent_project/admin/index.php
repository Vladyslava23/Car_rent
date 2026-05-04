<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/_admin_header.php';

$result = $conn->query("SELECT * FROM cars ORDER BY id DESC");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2">Autode haldus</h1>
    <a class="btn btn-success" href="add_car.php">Lisa auto</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle bg-white shadow-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pilt</th>
                <th>Auto</th>
                <th>Hind</th>
                <th>Staatus</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php while ($car = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= (int) $car['id'] ?></td>

                    <td>
                        <img 
                            src="<?= e($car['image']) ?>" 
                            width="90" 
                            height="55" 
                            style="object-fit: cover;" 
                            class="rounded"
                            alt="<?= e($car['mark'] . ' ' . $car['model']) ?>"
                        >
                    </td>

                    <td><?= e($car['mark'] . ' ' . $car['model']) ?></td>
                    <td><?= e($car['price']) ?> €</td>
                    <td><?= e($car['status']) ?></td>

                    <td class="text-end">
                        <a 
                            class="btn btn-sm btn-outline-primary" 
                            href="edit_car.php?id=<?= (int) $car['id'] ?>"
                        >
                            Muuda
                        </a>

                        <a 
                            class="btn btn-sm btn-outline-danger" 
                            href="delete_car.php?id=<?= (int) $car['id'] ?>" 
                            onclick="return confirm('Kas oled kindel, et soovid kustutada?')"
                        >
                            Kustuta
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/_admin_footer.php'; ?>