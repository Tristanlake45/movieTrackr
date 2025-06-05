<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// DB setup
$pdo = new PDO('mysql:host=localhost;dbname=MovieTracker', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Input validation
$movie_id = filter_input(INPUT_POST, 'movie_id', FILTER_VALIDATE_INT);
$rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);

if ($movie_id === false || $rating === false || $rating < 1 || $rating > 5) {
    die('Invalid input. Movie ID and rating must be valid.');
}

// Check if movie exists and is watched
$stmt = $pdo->prepare("SELECT watched FROM movies WHERE id = ?");
$stmt->execute([$movie_id]);
$movie = $stmt->fetch();

if (!$movie) {
    die('Movie not found.');
}

if (!$movie['watched']) {
    die('You must mark the movie as watched before rating it.');
}

// Update rating
$updateStmt = $pdo->prepare("UPDATE movies SET rating = ? WHERE id = ?");
$updateStmt->execute([$rating, $movie_id]);

header("Location: index.php");
exit();
?>
