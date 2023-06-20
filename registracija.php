<?php

include 'connect.php';

$registriran_korisnik = '';
$msg = '';

if (isset($_POST['registracija'])) {
  $ime = $_POST['ime'];
  $prezime = $_POST['prezime'];
  $korisnicko_ime = $_POST['korisnicko_ime'];
  $lozinka = $_POST['lozinka'];
  $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
  $razina = 0;

  //Provjera postoji li u bazi već korisnik s tim korisničkim imenom
  $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
  $stmt = mysqli_stmt_init($dbc);

  if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
  }
  if (mysqli_stmt_num_rows($stmt) > 0) {
    $msg = 'Korisničko ime već postoji!';
  } else {
    // Ako ne postoji korisnik s tim korisničkim imenom - Registracija korisnika
    //u bazi pazeći na SQL injection
    $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
      mysqli_stmt_bind_param(
        $stmt,
        'ssssd',
        $ime,
        $prezime,
        $korisnicko_ime,
        $hashed_password,
        $razina
      );
      mysqli_stmt_execute($stmt);
      $registriran_korisnik = true;
    }
  }
}
mysqli_close($dbc)

  ?>

<!DOCTYPE html>
<html lang="hr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <title>Registracija</title>
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
    if ($registriran_korisnik == true) {
      echo '<a href="administracija.php"><p style="text-align: center; font-weight: bold">Korisnik je uspješno registriran!</p>';
      echo '<p style="text-align: center; font-weight: bold">KLIKNITE OVDJE ZA PRIJAVU!</p></a>';
    } else {
    }
    //registracija nije protekla uspješno ili je korisnik prvi put došao na stranicu
    ?>

    <form action="registracija.php" method="POST" id="forma" name="forma">
      <div class="form-item">
        <span id="porukaIme" class="bojaPoruke"></span>
        <label for="ime">Ime:</label>
        <div class="form-field">
          <input type="text" name="ime" id="ime" class="form-field-textual" />
        </div>
      </div>
      <div class="form-item">
        <span id="porukaPrezime" class="bojaPoruke"></span>
        <label for="prezime">Prezime:</label>
        <div class="form-field">
          <input type="text" name="prezime" id="prezime" class="form-field-textual" />
        </div>
      </div>
      <div class="form-item">
        <span id="porukaKorisnickoIme" class="bojaPoruke"></span>
        <label for="korisnicko_ime">Korisničko ime:</label>
        <?php echo '<br><span class="bojaPoruke">' . $msg . '</span>'; ?>
        <div class="form-field">
          <input type="text" name="korisnicko_ime" id="korisnicko_ime" class="form-field-textual" />
        </div>
      </div>
      <div class="form-item">
        <span id="porukaLozinka" class="bojaPoruke"></span>
        <label for="lozinka">Lozinka:</label>
        <div class="form-field">
          <input type="password" name="lozinka" id="lozinka" class="form-field-textual" />
        </div>
      </div>
      <div class="form-item">
        <span id="porukaPonoviteLozinku" class="bojaPoruke"></span>
        <label for="ponovite_lozinku">Ponovite lozinku:</label>
        <div class="form-field">
          <input type="password" name="ponovite_lozinku" id="ponovite_lozinku" class="form-field-textual" />
        </div>
      </div>
      <div class="form-item">
        <button type="submit" name="registracija" class="registracija" id="registracija"
          value="Registracija">Registracija</button>
      </div>
    </form>

  </div>

  <footer>
    <h1 class="header1">Llist</h1>
    <p class="credits">© 2023 Mario Tucman (mtucman@tvz.hr)</p>
  </footer>
</body>

<script type="text/javascript">
  document.getElementById("registracija").onclick = function (event) {

    var slanjeForme = true;

    // Ime korisnika mora biti uneseno
    var poljeIme = document.getElementById("ime");
    var ime = document.getElementById("ime").value;
    if (ime.length == 0) {
      slanjeForme = false;
      poljeIme.style.border = "2px dashed red";
      document.getElementById("porukaIme").innerHTML = "<br>Unesite ime!<br>";
    } else {
      poljeIme.style.border = "2px solid green";
      document.getElementById("porukaIme").innerHTML = "";
    }
    // Prezime korisnika mora biti uneseno
    var poljePrezime = document.getElementById("prezime");
    var prezime = document.getElementById("prezime").value;
    if (prezime.length == 0) {
      slanjeForme = false;
      poljePrezime.style.border = "2px dashed red";

      document.getElementById("porukaPrezime").innerHTML = "<br>Unesite prezime!<br>";
    } else {
      poljePrezime.style.border = "2px solid green";
      document.getElementById("porukaPrezime").innerHTML = "";
    }

    // Korisničko ime mora biti uneseno
    var poljeUsername = document.getElementById("korisnicko_ime");
    var username = document.getElementById("korisnicko_ime").value;
    if (username.length == 0) {
      slanjeForme = false;
      poljeUsername.style.border = "2px dashed red";

      document.getElementById("porukaKorisnickoIme").innerHTML = "<br>Unesite korisničko ime!<br>";
    } else {
      poljeUsername.style.border = "2px solid green";
      document.getElementById("porukaKorisnickoIme").innerHTML = "";
    }

    // Provjera podudaranja lozinki
    var poljePass = document.getElementById("lozinka");
    var pass = document.getElementById("lozinka").value;
    var poljePassRep = document.getElementById("ponovite_lozinku");
    var passRep = document.getElementById("ponovite_lozinku").value;
    if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
      slanjeForme = false;
      poljePass.style.border = "2px dashed red";
      poljePassRep.style.border = "2px dashed red";
      document.getElementById("porukaLozinka").innerHTML = "<br>Lozinke nisu iste!<br>";

      document.getElementById("porukaPonoviteLozinku").innerHTML = "<br>Lozinke nisu iste!<br>";
    } else {
      poljePass.style.border = "2px solid green";
      poljePassRep.style.border = "2px solid green";
      document.getElementById("porukaLozinka").innerHTML = "";
      document.getElementById("porukaPonoviteLozinku").innerHTML = "";
    }

    if (slanjeForme != true) {
      event.preventDefault();
    }

  };

</script>

</html>