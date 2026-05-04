<?php require_once __DIR__ . '/../inc/header.php'; ?>
<section class="row align-items-center g-4 py-5">
    <div class="col-lg-6">
        <span class="badge text-bg-warning mb-3">Kiire ja lihtne autorent</span>
        <h1 class="display-5 fw-bold">Leia sobiv auto järgmiseks sõiduks</h1>
        <p class="lead text-secondary">Vali auto, vaata detaile ja tee broneering kuupäevade järgi.</p>
        <a href="autod.php" class="btn btn-primary btn-lg">Vaata autosid</a>
    </div>
    <div class="col-lg-6">
        <img class="img-fluid rounded-4 shadow" src="https://di-uploads-pod13.dealerinspire.com/maseratioftysons/uploads/2024/02/Small-19697-MC20Cielo.jpg" alt="Rendiauto">
    </div>
</section>

<section class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h3 mb-0">Populaarsed autod</h2>
        <a href="autod.php" class="btn btn-outline-primary">Kõik autod</a>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php
        require_once __DIR__ . '/../inc/db.php';
        $result = $conn->query("SELECT * FROM cars ORDER BY id DESC LIMIT 4");
        while ($car = $result->fetch_assoc()):
        ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="<?= e($car['image']) ?>" class="card-img-top" style="height:160px;object-fit:cover" alt="<?= e($car['mark'].' '.$car['model']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= e($car['mark'].' '.$car['model']) ?></h5>
                    <p class="card-text text-secondary"><?= e($car['fuel']) ?> · <?= e($car['engine']) ?></p>
                    <p class="fw-bold mb-3"><?= e($car['price']) ?> €/päev</p>
                    <a href="auto.php?id=<?= (int)$car['id'] ?>" class="btn btn-primary w-100">Rendi</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>
<?php require_once __DIR__ . '/../inc/footer.php'; ?>
