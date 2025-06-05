<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$pdo = new PDO('mysql:host=localhost;dbname=MovieTracker', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $movie_id = filter_input(INPUT_POST, 'movie_id', FILTER_VALIDATE_INT);

    if ($movie_id) {
        // Mark as watched
        $stmt = $pdo->prepare("UPDATE movies SET watched = 1 WHERE id = ?");
        $stmt->execute([$movie_id]);
    }
}

// Redirect back to index
header("Location: index.php");
exit;
