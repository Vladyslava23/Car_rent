<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/_admin_header.php';

$sql = "
    SELECT 
        reservations.id,
        users.name,
        users.email,
        cars.mark,
        cars.model,
        reservations.start_date,
        reservations.end_date,
        reservations.total_price,
        reservations.status
    FROM reservations
    JOIN users ON reservations.user_id = users.id
    JOIN cars ON reservations.car_id = cars.id
    ORDER BY reservations.id DESC
";

$result = $conn->query($sql);
?>

<div class="container py-5">
    <h1 class="mb-4">Broneeringud</h1>

    <div class="table-responsive">
        <table class="table table-striped align-middle bg-white shadow-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kasutaja</th>
                    <th>Email</th>
                    <th>Auto</th>
                    <th>Algus</th>
                    <th>Lõpp</th>
                    <th>Hind</th>
                    <th>Staatus</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['mark'] . ' ' . $row['model']) ?></td>
                            <td><?= htmlspecialchars($row['start_date']) ?></td>
                            <td><?= htmlspecialchars($row['end_date']) ?></td>
                            <td><?= number_format($row['total_price'], 2) ?> €</td>
                            <td><?= htmlspecialchars($row['status']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Broneeringuid ei leitud.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/_admin_footer.php'; ?>