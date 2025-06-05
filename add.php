<?php
$pdo = new PDO('mysql:host=localhost;dbname=MovieTracker', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert new movie
    $stmt = $pdo->prepare("INSERT INTO movies (title, date_published, director, starring) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['title'],
        $_POST['date_published'],
        $_POST['director'],
        $_POST['starring']
    ]);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Add New Movie</title>
<link rel="stylesheet" href="styles.css" />
</head>
<body>
<div id="addGun">
  <h2>Add New Movie</h2>
  <form method="post" action="add.php">
    <input type="text" name="title" placeholder="Movie Title" required />
    <input type="date" name="date_published" required />
    <input type="text" name="director" placeholder="Director" required />
    <input type="text" name="starring" placeholder="Starring" required />
    <button type="submit">Add Movie</button>
  </form>
  <a href="index.php" class="exit-button">Back to List</a>
</div>
</body>
</html>

