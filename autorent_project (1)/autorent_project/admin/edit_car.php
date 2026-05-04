<?php
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';
require_admin();
$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM cars WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$car = $stmt->get_result()->fetch_assoc();
if (!$car) { die('Autot ei leitud.'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare('UPDATE cars SET mark=?, model=?, engine=?, fuel=?, price=?, image=?, year=?, transmission=?, seats=?, description=?, status=? WHERE id=?');
    $stmt->bind_param(
        'ssssdsisissi',
        $_POST['mark'],
        $_POST['model'],
        $_POST['engine'],
        $_POST['fuel'],
        $_POST['price'],
        $_POST['image'],
        $_POST['year'],
        $_POST['transmission'],
        $_POST['seats'],
        $_POST['description'],
        $_POST['status'],
        $id
    );
    $stmt->execute();
    redirect('index.php');
}
require_once __DIR__ . '/_admin_header.php';
?>
<h1 class="h2">Muuda autot</h1>
<form method="post" class="card card-body shadow-sm">
    <?php require __DIR__ . '/car_form.php'; ?>
</form>
<?php require_once __DIR__ . '/_admin_footer.php'; ?>
