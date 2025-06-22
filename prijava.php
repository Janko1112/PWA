<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8" />
  <title>Prijava</title>
  <link rel="stylesheet" href="style.css" />
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
  <h2 class="section-title">Prijava</h2>
  <form action="prijava.php" method="post">
    <input type="text" name="username" placeholder="Korisničko ime" required><br>
    <input type="password" name="password" placeholder="Lozinka" required><br>
    <button type="submit">Prijavi se</button>
  </form>

  <?php
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id, korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['lozinka'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['korisnicko_ime'];
        $_SESSION['razina'] = $row['razina'];

        if ($row['razina'] == 1) {
          header("Location: admin-panel.php");
          exit();
        } else {
          echo "<p>Nemate administratorska prava.</p>";
        }
      } else {
        echo "<p>Neispravna lozinka.</p>";
      }
    } else {
      echo "<p>Korisnik ne postoji.</p>";
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
