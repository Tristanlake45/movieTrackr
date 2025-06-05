<?php
include 'header.php';
include 'footer.php';
$pdo = new PDO('mysql:host=localhost;dbname=MovieTracker', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM movies WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;

