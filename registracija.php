<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Registracija</title>
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
  <h2 class="section-title">Registracija</h2>
  <form action="registracija.php" method="post">
    <input type="text" name="username" placeholder="Korisničko ime" required><br>
    <input type="text" name="name" placeholder="Ime" required><br>
    <input type="text" name="surname" placeholder="Prezime" required><br>
    <input type="password" name="pass1" placeholder="Lozinka" required><br>
    <input type="password" name="pass2" placeholder="Ponovi lozinku" required><br>
    <button type="submit">Registriraj se</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';
    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 === $pass2) {
      $hashed = password_hash($pass1, PASSWORD_BCRYPT);
      $query = "INSERT INTO korisnik (korisnicko_ime, ime, prezime, lozinka, razina) VALUES (?, ?, ?, ?, 0)";
      $stmt = mysqli_prepare($dbc, $query);
      mysqli_stmt_bind_param($stmt, 'ssss', $username, $name, $surname, $hashed);
      mysqli_stmt_execute($stmt);
      echo "Uspješna registracija.";
    } else {
      echo "Lozinke se ne podudaraju.";
    }
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
