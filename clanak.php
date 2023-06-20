<?php

include 'connect.php';
define('UPLPATH', 'img/');
$clanak = $_GET["clanak"];

?>

<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <title>
    <?php
    $query = "SELECT * FROM vijesti WHERE id=$clanak";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($result)) {
      echo $row["naslov"];
      break;
    }
    ?>
  </title>
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
    $query = "SELECT * FROM vijesti WHERE id=$clanak";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($result)) {
      echo '<section class="clanak" role="main">';
      echo '<div class="row">';
      echo '<h2 class="clanak-naslov"><div class="clanak-rectangle"></div>' . $row["naslov"] . '</h2>';
      echo '<p class="clanak-datum">Objavljeno: ' . $row["datum"] . '</p>';
      echo '</div>';

      echo '<section class="clanak-slika">';
      echo '<img src="' . UPLPATH . $row['slika'] . '">';
      echo '</section>';
      echo '<section class="clanak-sazetak">';
      echo '<p>' . $row["sazetak"] . '</p>';
      echo '</section>';
      echo '<section class="clanak-tekst">';
      echo '<p class="p-tekst">' . $row["tekst"] . '</p>';
      echo '</section>';
      echo '</section>';

      break;
    }
    ?>

  </div>

  <footer>
    <h1 class="header1">Llist</h1>
    <p class="credits">© 2023 Mario Tucman (mtucman@tvz.hr)</p>
  </footer>
</body>

</html>