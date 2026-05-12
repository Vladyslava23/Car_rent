<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function redirect($url) {
    header('Location: ' . $url);
    exit;
}

function require_admin() {
    if (empty($_SESSION['is_admin'])) {
        redirect('login.php');
    }
}

function current_user_id() {
    return $_SESSION['user_id'] ?? null;
}

function days_between($start, $end) {
    $s = new DateTime($start);
    $e = new DateTime($end);
    return max(0, (int)$s->diff($e)->format('%a'));
}
?>
