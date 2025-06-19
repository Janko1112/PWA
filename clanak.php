<?php
include 'connect.php';
define('UPLPATH', 'img/');
$id = $_GET['id'];
$query = "SELECT * FROM vijesti WHERE id=$id";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title><?php echo $row['naslov']; ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="container">
      <h1>El Confidencial</h1>
      <p>El diario de los lectores influyentes</p>
      <hr class="nav-line" />
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="kategorija.php?kategorija=Europa">Europa</a></li>
          <li><a href="kategorija.php?kategorija=Teknautas">Teknautas</a></li>
          <?php if (isset($_SESSION['level']) && $_SESSION['level'] == 1): ?>
            <li><a href="admin-panel.php">Administracija</a></li>
          <?php endif; ?>
          <li><a href="registracija.php">Registracija</a></li>
          <li><a href="prijava.php">Prijava</a></li>
        </ul>
      </nav>
    </div>
  </header>

<main class="container">
  <article class="full-article">
    <p class="category"><?php echo $row['kategorija']; ?></p>
    <h2 class="article-title"><?php echo $row['naslov']; ?></h2>
    <p class="datum-veliki"><?php echo $row['datum']; ?></p>
    <img src="img/<?php echo $row['slika']; ?>" alt="slika" class="article-image">
    <section class="about">
      <p><?php echo $row['sazetak']; ?></p>
    </section>
    <section class="article-body">
      <p><?php echo $row['tekst']; ?></p>
    </section>
  </article>
</main>

<footer>
    <div class="container">
      <p>Janko Jakopec | jjakopec@tvz.hr | 2025</p>
    </div>
</footer>
</body>
</html>
