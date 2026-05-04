<?php $c = $car ?? ['mark'=>'','model'=>'','engine'=>'','fuel'=>'','price'=>'','image'=>'','year'=>'','transmission'=>'','seats'=>'','description'=>'','status'=>'vaba']; ?>
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Mark</label><input class="form-control" name="mark" value="<?= e($c['mark']) ?>" required></div>
    <div class="col-md-6"><label class="form-label">Model</label><input class="form-control" name="model" value="<?= e($c['model']) ?>" required></div>
    <div class="col-md-4"><label class="form-label">Aasta</label><input class="form-control" type="number" name="year" value="<?= e($c['year']) ?>"></div>
    <div class="col-md-4"><label class="form-label">Mootor</label><input class="form-control" name="engine" value="<?= e($c['engine']) ?>"></div>
    <div class="col-md-4"><label class="form-label">Kütus</label><input class="form-control" name="fuel" value="<?= e($c['fuel']) ?>"></div>
    <div class="col-md-4"><label class="form-label">Käigukast</label><input class="form-control" name="transmission" value="<?= e($c['transmission']) ?>"></div>
    <div class="col-md-4"><label class="form-label">Kohti</label><input class="form-control" type="number" name="seats" value="<?= e($c['seats']) ?>"></div>
    <div class="col-md-4"><label class="form-label">Hind €/päev</label><input class="form-control" type="number" step="0.01" name="price" value="<?= e($c['price']) ?>" required></div>
    <div class="col-md-8"><label class="form-label">Pildi URL</label><input class="form-control" name="image" value="<?= e($c['image']) ?>"></div>
    <div class="col-md-4"><label class="form-label">Staatus</label><select class="form-select" name="status"><option <?= $c['status']==='vaba'?'selected':'' ?>>vaba</option><option <?= $c['status']==='renditud'?'selected':'' ?>>renditud</option><option <?= $c['status']==='hoolduses'?'selected':'' ?>>hoolduses</option></select></div>
    <div class="col-12"><label class="form-label">Kirjeldus</label><textarea class="form-control" name="description" rows="4"><?= e($c['description']) ?></textarea></div>
</div>
<button class="btn btn-primary mt-3">Salvesta</button>
