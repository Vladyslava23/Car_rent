<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/header.php';

$q = trim($_GET['q'] ?? '');
$page = (int)($_GET['page'] ?? 1);

if ($page < 1) {
    $page = 1;
}

$perPage = 8;
$offset = ($page - 1) * $perPage;

if ($q != '') {

    $search = "%$q%";

    $sql = "SELECT COUNT(*) AS total 
            FROM cars 
            WHERE mark LIKE '$search' OR model LIKE '$search'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total = $row['total'];

    $sql = "SELECT * FROM cars 
            WHERE mark LIKE '$search' OR model LIKE '$search'
            ORDER BY id DESC
            LIMIT $perPage OFFSET $offset";

} else {

    $sql = "SELECT COUNT(*) AS total FROM cars";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total = $row['total'];

    $sql = "SELECT * FROM cars 
            ORDER BY id DESC
            LIMIT $perPage OFFSET $offset";
}

$cars = $conn->query($sql);

$totalPages = ceil($total / $perPage);

if ($totalPages < 1) {
    $totalPages = 1;
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1>Autod</h1>

        <?php if ($q != ''): ?>
            <p class="text-secondary">
                Otsing: <b><?= e($q) ?></b>,
                tulemusi <?= $total ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

    <?php while ($car = $cars->fetch_assoc()): ?>

        <div class="col">
            <div class="card h-100 shadow-sm">

                <img src="<?= e($car['image']) ?>"
                     class="card-img-top"
                     style="height:170px; object-fit:cover"
                     alt="auto">

                <div class="card-body d-flex flex-column">

                    <h5 class="card-title">
                        <?= e($car['mark'] . ' ' . $car['model']) ?>
                    </h5>

                    <p class="text-secondary small mb-1">
                        <?= e($car['year']) ?> ·
                        <?= e($car['transmission']) ?> ·
                        <?= e($car['seats']) ?> kohta
                    </p>

                    <p class="text-secondary">
                        <?= e($car['fuel']) ?> · <?= e($car['engine']) ?>
                    </p>

                    <?php if ($car['status'] == 'vaba'): ?>
                        <span class="badge bg-success mb-2 align-self-start">vaba</span>
                    <?php else: ?>
                        <span class="badge bg-secondary mb-2 align-self-start">
                            <?= e($car['status']) ?>
                        </span>
                    <?php endif; ?>

                    <p class="fw-bold mt-auto">
                        <?= e($car['price']) ?> €/päev
                    </p>

                    <a href="auto.php?id=<?= $car['id'] ?>" class="btn btn-primary">
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
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="?q=<?= urlencode($q) ?>&page=<?= $i ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>

    </ul>
</nav>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>