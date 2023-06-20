<?php
include 'connect.php';

if (isset($_POST['submit'])) {
  $naslov = $_POST['title'];
  $podnaslov = $_POST['subtitle'];
  $sazetak = $_POST['about'];
  $tekst = $_POST['content'];
  $slika = $_FILES['pphoto']['name'];
  $kategorija = $_POST['category'];
  $datum = date('d.m.Y.');

  if (isset($_POST['archive'])) {
    $arhiva = 1;
  } else {
    $arhiva = 0;
  }

  $target_dir = 'img/' . $slika;
  move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

  $query = "INSERT INTO vijesti (naslov, podnaslov, sazetak, tekst, slika, kategorija, arhiva, datum) VALUES ('$naslov', '$podnaslov', '$sazetak', '$tekst', '$slika', '$kategorija', '$arhiva', '$datum')";
  $result = mysqli_query($dbc, $query) or die('Error querying databese.');

  mysqli_close($dbc);
}

?>

<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <title>Pregled unešene vijesti</title>
</head>

<body>
  <div class="main">
    <nav class="navigation">
      <ul>
        <li><a href="index.php">POČETNA</a></li>
        <li><a href="kategorija.php?kategorija=politika">POLITIKA</a></li>
        <li><a href="kategorija.php?kategorija=sport">SPORT</a></li>
        <li><a href="administracija.php">ADMINISTRACIJA</a></li>
      </ul>
    </nav>

    <header>
      <h1 class="header1">Llist</h1>
    </header>

    <?php
    echo '<section class="clanak" role="main">';
    echo '<div class="row">';
    echo '<h2 class="clanak-naslov"><div class="clanak-rectangle"></div>' . $naslov . '</h2>';
    echo '<p class="clanak-datum">Objavljeno: ' . $datum . '</p>';
    echo '</div>';

    echo '<section class="clanak-slika">';
    echo '<img src="img/' . $slika . '">';
    echo '</section>';
    echo '<section class="clanak-sazetak">';
    echo '<p>' . $sazetak . '</p>';
    echo '</section>';
    echo '<section class="clanak-tekst">';
    echo '<p class="p-tekst">' . $tekst . '</p>';
    echo '</section>';
    echo '</section>';
    ?>

  </div>

  <footer>
    <h1 class="header1">Llist</h1>
    <p class="credits">© 2023 Mario Tucman (mtucman@tvz.hr)</p>
  </footer>
</body>

</html>