<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'autorent';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Andmebaasi ühendus ebaõnnestus');
}

mysqli_set_charset($conn, "utf8");

?>