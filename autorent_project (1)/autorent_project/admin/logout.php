<?php
require_once __DIR__ . '/../inc/functions.php';
unset($_SESSION['is_admin']);
redirect('login.php');
