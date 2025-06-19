<?php
session_start();
include 'connect.php';
define('UPLPATH', 'img/');
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>El Confidencial</title>
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
    <hr class="section-divider" />
    <section class="section-title">Europa</section>
    <section class="grid">
      <?php
      $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='Europa' LIMIT 3";
      $result = mysqli_query($dbc, $query);
      while($row = mysqli_fetch_array($result)):
      ?>
        <article>
          <img src="img/<?php echo $row['slika']; ?>" alt="">
          <h2><a href="clanak.php?id=<?php echo $row['id']; ?>"><?php echo $row['naslov']; ?></a></h2>
          <p><?php echo $row['sazetak']; ?></p>
          <span class="datum"><?php echo $row['datum']; ?></span>
        </article>
      <?php endwhile; ?>
    </section>

    <hr class="section-divider" />
    <section class="section-title">Teknautas</section>
    <section class="grid">
      <?php
      $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='Teknautas' LIMIT 3";
      $result = mysqli_query($dbc, $query);
      while($row = mysqli_fetch_array($result)):
      ?>
        <article>
          <img src="img/<?php echo $row['slika']; ?>" alt="">
          <h2><a href="clanak.php?id=<?php echo $row['id']; ?>"><?php echo $row['naslov']; ?></a></h2>
          <p><?php echo $row['sazetak']; ?></p>
          <span class="datum"><?php echo $row['datum']; ?></span>
        </article>
      <?php endwhile; ?>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>Janko Jakopec | jjakopec@tvz.hr | 2025</p>
    </div>
  </footer>
</body>
</html>
