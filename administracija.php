<?php
session_start();

include 'connect.php';
define('UPLPATH', 'img/');

$uspjesnaPrijava = '';
$admin = '';

// Provjera da li je korisnik došao s login forme
if (isset($_POST['prijava'])) {
    // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
    $prijavaImeKorisnika = $_POST['korisnicko_ime'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }

    mysqli_stmt_bind_result(
        $stmt,
        $imeKorisnika,
        $lozinkaKorisnika,
        $levelKorisnika
    );

    mysqli_stmt_fetch($stmt);

    //Provjera lozinke
    if (
        password_verify($_POST['lozinka'], $lozinkaKorisnika) &&
        mysqli_stmt_num_rows($stmt) > 0
    ) {
        $uspjesnaPrijava = true;

        // Provjera da li je admin
        if ($levelKorisnika == 1) {
            $admin = true;
        } else {
            $admin = false;
        }
        //postavljanje session varijabli
        $_SESSION['$korisnicko_ime'] = $imeKorisnika;
        $_SESSION['$razina'] = $levelKorisnika;
    } else {
        $uspjesnaPrijava = false;
    }

}

//Korisnik je admin; može brisati vijesti
if (isset($_POST['izbrisi'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM vijesti WHERE id=$id ";
    $result = mysqli_query($dbc, $query);
}

//Korisnik je admin; može uređivati vijesti
if (isset($_POST['izmjeni'])) {
    $id = $_POST['id'];
    $naslov = $_POST['title'];
    $podnaslov = $_POST['subtitle'];
    $sazetak = $_POST['about'];
    $tekst = $_POST['content'];
    $slika = $_FILES['pphoto']['name'];
    $kategorija = $_POST['category'];

    if (isset($_POST['archive'])) {
        $arhiva = 1;
    } else {
        $arhiva = 0;
    }

    if (is_uploaded_file($_FILES['pphoto']['tmp_name'])) {
        $target_dir = 'img/' . $slika;
        move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

        $query = "UPDATE vijesti SET naslov='$naslov', podnaslov='$podnaslov', sazetak='$sazetak', tekst='$tekst', slika='$slika', kategorija='$kategorija', arhiva='$arhiva' WHERE id=$id";
        $result = mysqli_query($dbc, $query);
    } else {
        $query = "UPDATE vijesti SET naslov='$naslov', podnaslov='$podnaslov', sazetak='$sazetak', tekst='$tekst', kategorija='$kategorija', arhiva='$arhiva' WHERE id=$id";
        $result = mysqli_query($dbc, $query);
    }

}

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Administracija</title>
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
        // Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je
        if (
            ($uspjesnaPrijava == true && $admin == true) ||
            (isset($_SESSION['$korisnicko_ime'])) && $_SESSION['$razina'] == 1
        ) {
            echo '<div class="button-admin">';
            echo '<button type="button" name="new" class="new" id="new" value="Unesi novu vijest" onClick="otvoriUnos()">Unesi novu vijest</button>';
            echo '</div>';
            echo '<br>';
            $query = "SELECT * FROM vijesti";
            $result = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($result)) {

                //forma za administraciju
                echo '
        <form enctype="multipart/form-data" action="" method="POST" id="forma" name="forma">
        <div class="form-item">
          <span id="porukaTitle_' . $row['id'] . '" class="bojaPoruke"></span>
          <label for="title">Naslov vijesti (do 100 znakova):</label>
          <div class="form-field">
            <input type="text" name="title" id="title_' . $row['id'] . '" class="form-field-textual" value="' . $row['naslov'] . '"/>
          </div>
        </div>
        <div class="form-item">
          <span id="porukaSubtitle_' . $row['id'] . '" class="bojaPoruke"></span>
          <label for="subtitle">Podnaslov vijesti (do 50 znakova):</label>
          <div class="form-field">
            <input type="text" name="subtitle" id="subtitle_' . $row['id'] . '" class="form-field-textual" value="' . $row['podnaslov'] . '"/>
          </div>
        </div>
        <div class="form-item">
          <span id="porukaAbout_' . $row['id'] . '" class="bojaPoruke"></span>
          <label for="about">Kratki sadržaj vijesti (do 255 znakova):</label>
          <div class="form-field">
            <textarea name="about" id="about_' . $row['id'] . '" cols="80" rows="6" class="form-field-textual">' . $row['sazetak'] . '</textarea>
          </div>
        </div>
        <div class="form-item">
          <span id="porukaContent_' . $row['id'] . '" class="bojaPoruke"></span>
          <label for="content">Sadržaj vijesti:</label>
          <div class="form-field">
            <textarea name="content" id="content_' . $row['id'] . '" cols="80" rows="12" class="form-field-textual">' . $row['tekst'] . '</textarea>
          </div>
        </div>
        <div class="form-item">
          <span id="porukaSlika_' . $row['id'] . '" class="bojaPoruke"></span>
          <label for="pphoto">Slika:</label>
          <div class="form-field">
            <input type="file" accept="image/jpg,image/jpeg,image/png,image/gif" class="input-text" id="pphoto_' . $row['id'] . '" name="pphoto" value="' . $row['slika'] . '" /> <br><img src="' . UPLPATH . $row['slika'] . '" width=100px>
          </div>
        </div>
        <div class="form-item">
          <label for="category">Kategorija vijesti:</label>
          <div class="form-field">
            <select name="category" id="" class="form-field-textual" value="' . $row['kategorija'] . '">';
                if ($row['kategorija'] == 'politika') {
                    echo '
                    <option value="politika">Politika</option>
                    <option value="sport">Sport</option>
                    ';
                } else {
                    echo '
                    <option value="sport">Sport</option>
                    <option value="politika">Politika</option>
                    ';
                }
                echo '
            </select>
          </div>
        </div>
        <div class="form-item">
            <label>Spremiti u arhivu:
                <div class="form-field">';
                if ($row['arhiva'] == 0) {
                    echo '<input type="checkbox" name="archive" id="archive"/> Arhiviraj?';
                } else {
                    echo '<input type="checkbox" name="archive" id="archive" checked/> Arhiviraj?';
                }
                echo '</div>
            </label>
        </div>
        <div class="form-item">
            <input type="hidden" name="id" class="form-field-textual" value="' . $row['id'] . '">
            <button type="reset" class="ponisti" name="ponisti" value="Poništi">Poništi</button>
            <button type="submit" class="izmjeni" name="izmjeni" id="izmjeni_' . $row['id'] . '" value="Prihvati">Izmjeni</button>
            <button type="submit" class="izbrisi" name="izbrisi" value="Izbriši">Izbriši</button>
        </div>
        </form>
        ';
                echo '

            <script type="text/javascript">

            document.getElementById("izmjeni_' . $row['id'] . '").onclick = function (event) {

            var slanjeForme = true;
        
            // Naslov vijesti
            var poljeTitle = document.getElementById("title_' . $row['id'] . '");
            var title = document.getElementById("title_' . $row['id'] . '").value;
            if (title.length < 5 || title.length > 100) {
              slanjeForme = false;
              poljeTitle.style.border = "2px dashed red";
              document.getElementById("porukaTitle_' . $row['id'] . '").innerHTML = "Naslov vijesti mora imati između 5 i 100 znakova!<br>";
            } else {
              poljeTitle.style.border = "2px solid green";
              document.getElementById("porukaTitle_' . $row['id'] . '").innerHTML = "";
            }
        
            // Podnaslov vijesti
            var poljeSubtitle = document.getElementById("subtitle_' . $row['id'] . '");
            var subtitle = document.getElementById("subtitle_' . $row['id'] . '").value;
            if (subtitle.length < 5 || subtitle.length > 50) {
              slanjeForme = false;
              poljeSubtitle.style.border = "2px dashed red";
              document.getElementById("porukaSubtitle_' . $row['id'] . '").innerHTML = "Podnaslov vijesti mora imati između 5 i 50 znakova!<br>";
            } else {
              poljeSubtitle.style.border = "2px solid green";
              document.getElementById("porukaSubtitle_' . $row['id'] . '").innerHTML = "";
            }
        
            // Kratki sadržaj
            var poljeAbout = document.getElementById("about_' . $row['id'] . '");
            var about = document.getElementById("about_' . $row['id'] . '").value;
            if (about.length < 10 || about.length > 255) {
              slanjeForme = false;
              poljeAbout.style.border = "2px dashed red";
              document.getElementById("porukaAbout_' . $row['id'] . '").innerHTML = "Kratki sadržaj mora imati između 10 i 255 znakova!<br>";
            } else {
              poljeAbout.style.border = "2px solid green";
              document.getElementById("porukaAbout_' . $row['id'] . '").innerHTML = "";
            }
        
            // Sadržaj mora biti unesen
            var poljeContent = document.getElementById("content_' . $row['id'] . '");
            var content = document.getElementById("content_' . $row['id'] . '").value;
            if (content.length == 0) {
              slanjeForme = false;
              poljeContent.style.border = "2px dashed red";
              document.getElementById("porukaContent_' . $row['id'] . '").innerHTML = "Sadržaj mora biti unesen!<br>";
            } else {
              poljeContent.style.border = "2px solid green";
              document.getElementById("porukaContent_' . $row['id'] . '").innerHTML = "";
            }
        
            if (slanjeForme != true) {
                event.preventDefault();
            }
        
          };
          </script>';
            }

            echo '
            <script type="text/javascript">
            function otvoriUnos() {
                window.location.href = "unos.html";
            }
            </script>';

            // Pokaži poruku da je korisnik uspješno prijavljen, ali nije administrator
        } else if ($uspjesnaPrijava == true && $admin == false) {

            echo '<p style="text-align: center; font-weight: bold">Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali
niste administrator.</p>';
        } else if (isset($_SESSION['$korisnicko_ime']) && $_SESSION['$razina'] == 0) {

            echo '<p style="text-align: center; font-weight: bold">Bok ' . $_SESSION['$korisnicko_ime'] . '! Uspješno ste
prijavljeni, ali niste administrator.</p>';
        } else if ($uspjesnaPrijava == false) {
            ?>
                        <form action="administracija.php" method="POST" id="forma" name="forma">
                            <div class="form-item">
                                <span id="porukaKorisnickoIme" class="bojaPoruke"></span>
                                <label for="korisnicko_ime">Korisničko ime:</label>
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
                                <button type="submit" name="prijava" class="prijava" id="prijava" value="Prijava">Prijava</button>
                                <a href="registracija.php">Nemaš račun? Registriraj se.</a>
                            </div>
                        </form>
                        <script type="text/javascript">

                            document.getElementById("prijava").onclick = function (event) {

                                var slanjeForme = true;

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

                        <?php
        }
        ?>
    </div>
    <footer>
        <h1 class="header1">Llist</h1>
        <p class="credits">© 2023 Mario Tucman (mtucman@tvz.hr)</p>
    </footer>