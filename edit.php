<?php
include 'header.php';
include 'footer.php';

$pdo = new PDO('mysql:host=localhost;dbname=MovieTracker', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];

// Fetch movie data
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $watched = isset($_POST['watched']) ? 1 : 0;
    $rating = $watched ? ($_POST['rating'] !== '' ? (int)$_POST['rating'] : null) : null;

    $stmt = $pdo->prepare("UPDATE movies SET title = ?, date_published = ?, director = ?, starring = ?, watched = ?, rating = ? WHERE id = ?");
    $stmt->execute([
        $_POST['title'],
        $_POST['date_published'],
        $_POST['director'],
        $_POST['starring'],
        $watched,
        $rating,
        $id
    ]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Edit Movie</title>
<link rel="stylesheet" href="styles.css" />
</head>
<body>
<div id="addGun">
  <h2>Edit Movie</h2>
  <form method="post" action="edit.php?id=<?= $id ?>">
    <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required />
    <input type="date" name="date_published" value="<?= htmlspecialchars($movie['date_published']) ?>" required />
    <input type="text" name="director" value="<?= htmlspecialchars($movie['director']) ?>" required />
    <input type="text" name="starring" value="<?= htmlspecialchars($movie['starring']) ?>" required />

    <label>
      <input type="checkbox" name="watched" <?= $movie['watched'] ? 'checked' : '' ?> />
      Watched
    </label>

    <label for="rating">Rating (1–5):</label>
    <select name="rating">
      <option value="">Unrated</option>
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <option value="<?= $i ?>" <?= ($movie['rating'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
      <?php endfor; ?>
    </select>

    <button type="submit">Update Movie</button>
  </form>

  <a href="index.php" class="exit-button">Back to List</a>
</div>
</body>
</html>


