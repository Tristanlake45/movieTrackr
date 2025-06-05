<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdo = new PDO('mysql:host=localhost;dbname=MovieTracker', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch all movies
$stmt = $pdo->query("SELECT * FROM movies ORDER BY id DESC");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Movie Watchlist Tracker</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
<div class="home-page">
  <header class="home-header">
    <h1>my movie watchlist</h1>
  </header>

  <div class="home-content">
    <a href="add.php" class="primary-button no-underline">Add New Movie</a>

    <ul id="movieList">
      <?php foreach ($movies as $movie): ?>
      <li class="movie-item">
        <div>
          <strong>Title:</strong> <?= htmlspecialchars($movie['title']) ?><br />
          <strong>Published:</strong> <?= htmlspecialchars($movie['date_published']) ?><br />
          <strong>Director:</strong> <?= htmlspecialchars($movie['director']) ?><br />
          <strong>Starring:</strong> <?= htmlspecialchars($movie['starring']) ?><br />

          <div class="watched-box <?= $movie['watched'] ? 'watched' : 'unwatched' ?>">
            <strong>Watched:</strong> <?= $movie['watched'] ? 'Yes' : 'No' ?>
          </div>

          <strong>Review:</strong>
          <?php if ($movie['watched']): ?>
            <?php if ($movie['rating'] !== null): ?>
              <?= $movie['rating'] ?> / 5
            <?php else: ?>
              <form action="rate_movie.php" method="post" style="display:inline;">
                <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
                <select name="rating" required>
                  <option value="">Rate</option>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                  <?php endfor; ?>
                </select>
                <input type="submit" value="Submit">
              </form>
            <?php endif; ?>
          <?php else: ?>
            -
          <?php endif; ?>
        </div>

        <div style="margin-top: 8px;">
          <?php if (!$movie['watched']): ?>
            <form action="mark_watched.php" method="post" style="display:inline;">
              <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
              <input type="submit" value="Mark as Watched" class="watched-button">
            </form>
          <?php endif; ?>
          <a href="edit.php?id=<?= $movie['id'] ?>" class="edit-button">Edit</a>
          <a href="delete.php?id=<?= $movie['id'] ?>" class="delete-button" onclick="return confirm('Delete this movie?');">Delete</a>
        </div>
      </li>
      <?php endforeach; ?>
      <?php if (empty($movies)): ?>
        <li>No movies found. Add one!</li>
      <?php endif; ?>
    </ul>
  </div>
</div>
</body>
</html>




