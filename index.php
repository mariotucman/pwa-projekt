<?php
include 'connect.php';
define('UPLPATH', 'img/');
?>

<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <title>Početna</title>
</head>

<body>
  <div class="main">
    <nav class="navigation">
      <ul>
        <li><a href="index.php" class="active">POČETNA</a></li>
        <li><a href="kategorija.php?kategorija=politika">POLITIKA</a></li>
        <li><a href="kategorija.php?kategorija=sport">SPORT</a></li>
        <li><a href="administracija.php">ADMINISTRACIJA</a></li>
      </ul>
    </nav>

    <header>
      <h1 class="header1">Llist</h1>
    </header>

    <section class="container politika">

      <aside class="container-aside">
        <div class="rectangle-aside"></div>
        <p class="paragraph-aside">Politika</p>
      </aside>

      <?php
      $query = "SELECT * FROM vijesti WHERE kategorija='politika' AND arhiva = 0 ORDER BY id DESC LIMIT 3";
      $result = mysqli_query($dbc, $query);

      while ($row = mysqli_fetch_array($result)) {
        echo '<article class="container-article">';
        echo '<a href="clanak.php?clanak=' . $row["id"] . '"><img src="' . UPLPATH . $row['slika'] . '">';
        echo '<h3 class="header3">' . $row["podnaslov"] . '</h3>';
        echo '<h2 class="header2">' . $row["naslov"] . '</h2>';
        echo '<p class="paragraph">' . $row["sazetak"] . '</p></a>';
        echo '</article>';
        continue;
      }
      ?>
    </section>


    <section class="container sport">

      <aside class="container-aside">
        <div class="rectangle-aside"></div>
        <p class="paragraph-aside">Sport</p>
      </aside>

      <?php
      $query = "SELECT * FROM vijesti WHERE kategorija='sport' AND arhiva = 0 ORDER BY id DESC LIMIT 3";
      $result = mysqli_query($dbc, $query);
      while ($row = mysqli_fetch_array($result)) {
        echo '<article class="container-article">';
        echo '<a href="clanak.php?clanak=' . $row["id"] . '"><img src="' . UPLPATH . $row['slika'] . '">';
        echo '<h3 class="header3">' . $row["podnaslov"] . '</h3>';
        echo '<h2 class="header2">' . $row["naslov"] . '</h2>';
        echo '<p class="paragraph">' . $row["sazetak"] . '</p></a>';
        echo '</article>';
        continue;
      }
      ?>
    </section>
  </div>

  <footer>
    <h1 class="header1">Llist</h1>
    <p class="credits">© 2023 Mario Tucman (mtucman@tvz.hr)</p>
  </footer>
</body>

</html>