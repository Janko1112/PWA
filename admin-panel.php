<?php
session_start();
include 'connect.php';
define('UPLPATH', 'img/');
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Admin panel</title>
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
          <li><a href="unos.html">Unos</a></li>
          <li><a href="registracija.php">Registracija</a></li>
          <li><a href="prijava.php">Prijava</a></li>
        </ul>
      </nav>
    </div>
  </header>

<main class="container">
  <h2 class="section-title">Administracija vijesti</h2>

  <?php
  $query = "SELECT * FROM vijesti";
  $result = mysqli_query($dbc, $query);

  while ($row = mysqli_fetch_array($result)) {
    echo '<form enctype="multipart/form-data" action="administracija.php" method="POST">
      <input type="hidden" name="id" value="'.$row['id'].'">
      <input type="text" name="title" value="'.$row['naslov'].'" class="form-field-textual"><br>
      <textarea name="about" class="form-field-textual">'.$row['sazetak'].'</textarea><br>
      <textarea name="content" class="form-field-textual">'.$row['tekst'].'</textarea><br>
      <img src="img/'.$row['slika'].'" width="100"><br>
      <select name="category" class="form-field-textual">
        <option value="Europa" '.($row['kategorija'] == 'Europa' ? 'selected' : '').'>Europa</option>
        <option value="Teknautas" '.($row['kategorija'] == 'Teknautas' ? 'selected' : '').'>Teknautas</option>
      </select><br>
      <label><input type="checkbox" name="archive" '.($row['arhiva'] ? 'checked' : '').'> Arhiviraj</label><br>
      <button type="submit" name="update">Izmijeni</button>
      <button type="submit" name="delete">Izbriši</button>
    </form><hr>';
  }

  if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    mysqli_query($dbc, "DELETE FROM vijesti WHERE id=$id");
  }

  if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;

    $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', kategorija='$category', arhiva=$archive WHERE id=$id";
    mysqli_query($dbc, $query);
  }
  ?>
</main>

  <footer>
    <div class="container">
      <p>Janko Jakopec | jjakopec@tvz.hr | 2025</p>
    </div>
  </footer>
</body>
</html>
