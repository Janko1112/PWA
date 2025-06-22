<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;
    $image = $_FILES['pphoto']['name'];
    $image_tmp = $_FILES['pphoto']['tmp_name'];
    $target = 'img/' . basename($image);
    move_uploaded_file($image_tmp, $target);
    $date = date("Y-m-d");

    $query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) 
              VALUES ('$date', '$title', '$about', '$content', '$image', '$category', '$archive')";
    $result = mysqli_query($dbc, $query) or die('Greška kod upisa u bazu.');
}
mysqli_close($dbc);
header("Location: index.php");
exit;
?>


<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Pregled vijesti</title>
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
      <p class="category"><?php echo $category; ?></p>
      <h2 class="article-title"><?php echo $title; ?></h2>
      <p class="datum-veliki">Objavljeno: <?php echo date("d.m.Y. H:i"); ?> | Arhivirano: <?php echo $archive; ?></p>
      <img src="img/<?php echo $image; ?>" alt="Slika vijesti" class="article-image">
      <section class="about">
        <p><?php echo $about; ?></p>
      </section>
      <section class="article-body">
        <p><?php echo $content; ?></p>
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
