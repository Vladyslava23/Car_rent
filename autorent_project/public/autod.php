<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/header.php';

$q = $_GET['q'] ?? '';

if ($q != '') {
    $sql = "SELECT * FROM cars 
            WHERE mark LIKE '%$q%' OR model LIKE '%$q%'
            ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM cars ORDER BY id DESC";
}

$cars = mysqli_query($conn, $sql);
?>

<h1>Autod</h1>

<?php if ($q != ''): ?>
    <p class="text-secondary">
        Otsing: <b><?= e($q) ?></b>
    </p>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

    <?php while ($car = mysqli_fetch_assoc($cars)): ?>

        <div class="col">
            <div class="card h-100">

                <img src="<?= e($car['image']) ?>" class="card-img-top" style="height:170px; object-fit:cover">

                <div class="card-body">
                    <h5>
                        <?= e($car['mark']) ?> <?= e($car['model']) ?>
                    </h5>

                    <p class="text-secondary">
                        <?= e($car['year']) ?> · <?= e($car['fuel']) ?> · <?= e($car['engine']) ?>
                    </p>

                    <p>
                        Staatus: <?= e($car['status']) ?>
                    </p>

                    <p>
                        <b><?= e($car['price']) ?> €/päev</b>
                    </p>

                    <a href="auto.php?id=<?= $car['id'] ?>" class="btn btn-primary">
                        Rendi
                    </a>
                </div>

            </div>
        </div>

    <?php endwhile; ?>

</div>

<?php require_once __DIR__ . '/../inc/footer.php'; ?>