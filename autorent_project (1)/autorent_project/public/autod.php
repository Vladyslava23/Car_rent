<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/header.php';

$q = trim($_GET['q'] ?? '');
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$perPage = 8;
$offset = ($page - 1) * $perPage;

if ($q !== '') {
    $search = '%' . $q . '%';

    $countSql = "SELECT COUNT(*) AS total FROM cars WHERE mark LIKE ? OR model LIKE ?";
    $stmt = $conn->prepare($countSql);
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total = (int)$row['total'];

    $sql = "SELECT * FROM cars WHERE mark LIKE ? OR model LIKE ? ORDER BY id DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $search, $search, $perPage, $offset);
} else {
    $countSql = "SELECT COUNT(*) AS total FROM cars";
    $result = $conn->query($countSql);
    $row = $result->fetch_assoc();
    $total = (int)$row['total'];

    $sql = "SELECT * FROM cars ORDER BY id DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $perPage, $offset);
}

$stmt->execute();
$cars = $stmt->get_result();

$totalPages = ceil($total / $perPage);

if ($totalPages < 1) {
    $totalPages = 1;
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h2">Autod</h1>

        <?php if ($q !== ''): ?>
            <p class="text-secondary">
                Otsing:
                <strong><?= e($q) ?></strong>,
                tulemusi <?= (int)$total ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <?php while ($car = $cars->fetch_assoc()): ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img
                    src="<?= e($car['image']) ?>"
                    class="card-img-top"
                    style="height:170px;object-fit:cover"
                    alt="<?= e($car['mark'] . ' ' . $car['model']) ?>"
                >

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">
                        <?= e($car['mark'] . ' ' . $car['model']) ?>
                    </h5>

                    <p class="card-text text-secondary small mb-1">
                        <?= e($car['year']) ?> ·
                        <?= e($car['transmission']) ?> ·
                        <?= e($car['seats']) ?> kohta
                    </p>

                    <p class="card-text text-secondary">
                        <?= e($car['fuel']) ?> · <?= e($car['engine']) ?>
                    </p>

                    <span class="badge text-bg-<?= $car['status'] === 'vaba' ? 'success' : 'secondary' ?> mb-2 align-self-start">
                        <?= e($car['status']) ?>
                    </span>

                    <p class="fw-bold mt-auto">
                        <?= e($car['price']) ?> €/päev
                    </p>

                    <a href="auto.php?id=<?= (int)$car['id'] ?>" class="btn btn-primary">
                        Rendi
                    </a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<nav class="mt-4">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                <a class="page-link" href="?q=<?= urlencode($q) ?>&page=<?= $i ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>