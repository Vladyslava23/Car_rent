<?php
require_once __DIR__ . '/../inc/header.php';
?>

<div class="container py-5">
    <h1 class="mb-4">Kontakt</h1>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h4>Võta meiega ühendust</h4>
                    <p class="text-muted">Kui sul on küsimusi autorendi või broneeringu kohta, kirjuta meile.</p>
                    <p><strong>E-post:</strong> info@autorent.test</p>
                    <p><strong>Telefon:</strong> +372 5555 1234</p>
                    <p><strong>Aadress:</strong> Tartu mnt 10, Tallinn</p>
                    <p><strong>Tööaeg:</strong> E–R 09:00–18:00</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h4>Kirjuta meile</h4>

                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nimi</label>
                            <input type="text" class="form-control" placeholder="Sinu nimi">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-post</label>
                            <input type="email" class="form-control" placeholder="sinu@email.ee">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sõnum</label>
                            <textarea class="form-control" rows="4" placeholder="Kirjuta sõnum..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Saada</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../inc/footer.php';
?>