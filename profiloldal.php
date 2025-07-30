<?php
include('fuggvenyek.php');

//kapcsolódás az adatbázishoz
$conn = cukraszda_csatlakozas();

session_start();

if (!isset($_SESSION['nev'])) {
    header('Location: bejelentkezes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="img/png" href="img/profilLight.png">
    <title>Profil</title>
    <style>
        .egyenleg{
            margin: 20px 35% 20px 35%;
        }

        .egyenleg td{
            font-size: 20px;
            color: rgb(109, 86, 12);
        }

        #profilresz{
            width: 30%;
            color: rgb(109, 86, 12);
            text-align: left;
            border: 7px solid rgb(109, 86, 12);
            margin-left: 15px;
            border-color: antiquewhite;
            border-style: inset none none outset;
            border-radius: 10px;
            padding: 6px;
            display: inline-block;
        }

        p{
            font-size: 20px;
            margin: 15px;
            min-width: fit-content;
        }

        td label{
            font-size: 20px;
            margin: 5px;
            min-width: fit-content;
        }

        #kosartartalom{
            width: 55%;
            color: rgb(109, 86, 12);
            margin-left: 10%;
            vertical-align: top;
            border: 7px solid rgb(109, 86, 12);
            border-style: none outset inset none;
            border-radius: 10px;
            margin-right: 15px;
            text-align: right;
            position: relative;
            min-height: 200px;
            margin-bottom: 20px;
            display: inline-block;
            clear: both;

        }
        #kosar{
            width: 100%;
        }

        .button:hover, #vasarlasGomb:hover{
            background-color: blanchedalmond;
            color: grey;
            transition: all 0.5s linear;
        }
         
        #vasarlasGomb{
            float: right;
            clear: both;
        }

        .profilkep {
            width: 90px;
            height: 90px;
            border-radius: 100%;
            overflow: hidden;
            text-align: left;
            vertical-align: top;
            border: 2px solid rgb(109, 86, 12);
        }

        .profilkep img {
            width: 100%;
            height: auto;
        }

        input, select {
        color: black;
        font-size: 20px;
        margin: 10px;
        border: 3px solid antiquewhite;
        background-color: transparent;
        border-radius: 6px;
        }
        
        label{
            display: block;
            min-width: 100px;
            margin-left: 20px;
            font-size: larger;
        }
        input {
            text-align: left;
            display: inline-block;
            margin-left: 20px;
            min-width: 70px;
        }
        h2{
            display: inline-block;
            margin-left: 20px;
        }

        .termekrendeles td{
            text-align: left;
        }

        @media only screen and (max-width: 768px) {
            #profilresz {
                width: 100%;
                border-radius: 15px 15px 15px 15px;
                margin-top: 20px;
            }

            #kosartartalom {
                width: 100%;
                border-radius: 15px 15px 15px 15px;
                margin-top: 20px;
                float: none;
            }

            .infok {
                width: 80%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<main id="fooldal">
        <h1>Profil  oldal</h1>
    <table class="menupontok">
        <tr>
            <td class="menu"><a class="link" href="index.php"><img src="img/titlecakeBrown.png" alt="kezdolap" width="22">Kezdőlap </a></td>
            <td class="menu"><a class="link" href="termekek.php"><img src="img/cupcakeBrown.png" alt="termekek" width="22">Termékek </a></td>
            <td class="menu"><a class="link" href="receptek.php"><img src="img/paperBrown.png" alt="receptek" width="22">Receptek</a> </td>
        </tr>
        <tr>
            <td class="menu"><a class="link" href="leiras.php"><img src="img/paperBrown.png" alt="leiras" width="22">Termékleírás</a> </td>
            <td class="menu"><a class="link" href="profiloldal.php"><img  src="img/profilGreen.png" alt="profil" width="22">Profil oldal</a></td>
            <td class="menu"><a class="link" href="kijelentkezes.php"><img src="img/logout.png" alt="kijelentkezes" width="22">Kijelentkezés</a></td>
        </tr>
    </table>

    <table class="egyenleg">
        <tr>
            <?php

            $nev = $_SESSION['nev'];
            //lekérdezzük a felhasznalok tábla adatait név alapján
            $lista = "SELECT * FROM FELHASZNALOK  WHERE felhasznalonev = '$nev'";
            $eredmeny = mysqli_query($conn, $lista);
            if (!$eredmeny) {
                die("Lekérdezési hiba: " . mysqli_error($conn));
            }

            //asszociatív tömbbe eltárolja az adatokat
            while ($row = mysqli_fetch_assoc($eredmeny)) {
                $felhasznalonev = $row['felhasznalonev'];
                $email = $row['email'];
                $tel = $row['telefonszam'];
                $kedvenc = $row['kedvenc'];
                $egyenleg = $row["egyenleg"];
                $pontok = $row["pontok"];
                $kep = $row["kep_eleres"];

                if ($kedvenc === "sos") {
                    $kedvenc_kategoria = "Sós sütemények";
                } elseif ($kedvenc === "edes") {
                    $kedvenc_kategoria = "Édes sütemények";
                } else {
                    $kedvenc_kategoria = "";
                }
            }

                $nev = $_SESSION['nev'];
            ?>
            <td><img  src="img/money.png" alt="pontok" width="22"> Egyenleg: <?php echo $egyenleg; ?>Ft</td>
            <td><img  src="img/kosar2.png" alt="pontok" width="22"> Pontok: <?php echo $pontok; ?></td>
        </tr>
    </table>
        <div id="profilresz">
            <?php
            //Hibauzenetek
            if (isset($_GET["error"]) && $_GET["error"] === "profilkitoltes") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Nem töltött ki minden mezőt!</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "nevhossz") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Túl hosszú felhasználónevet adott meg!</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "nev_letezik") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott felhasználónévvel már van regisztrált fiók!</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "email_letezik") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott email címmel már van regisztrált fiók!</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "tel_letezik") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott telefonszámmal már van regisztrált fiók!</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "ervenytelen_email") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott email nem megfelelő formátumú!</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "ervenytelen_tel") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott telefonszám nem megfelelő formátumú!</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "hiba") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A kép feltöltése sikertelen!</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "kiterjesztes") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Csak JPG, JPEG és PNG kiterjesztésű képeket lehet feltölteni!</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "nagy") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Túl nagy méretű a kép! Max 30MB</p>';
            }
            if (isset($_GET["error"]) && $_GET["error"] === "ures") {
                echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Nem töltött fel képet!</p>';
            }
            ?>
                <form method="post" action="profil_modositas.php">
                    <?php
                    if($_SESSION['szerepkor'] == "0"){
                    echo
                    '<div class="profilkep">
                        <img src="'.$kep.'" alt="Profilkép">
                    </div>';
                    }
                    ?>
               <label for="nev">Felhasználói név: </label>
                 <input id="nev" name="nev" type="text" value="<?php echo $felhasznalonev?>" required placeholder="Max 100 karakter!">
               <br>
               <label for="email">E-mail cím: </label>
                 <input id="email" name="email" type="email" value="<?php echo $email?>" required placeholder="pl. minta@minta.com">
               <br>
               <label for="tel">Telefonszám: </label>
                 <input id="tel" name="tel" type="tel" value="<?php echo $tel?>" required placeholder="pl.+36 20/30/70 1234567">
               <br>
               <label for="kedvenc">Kedvenc desszertjeim:</label>
               <select id="kedvenc" name="kedvenc">
                   <option value="edes"  <?php if ($kedvenc === "edes") echo "selected"?>>Édes sütemények</option>
                   <option value="sos"  <?php if ($kedvenc === "sos") echo "selected"?>>Sós sütemények</option>
               </select>
                    <br>
                    <input class="button" type="submit" name="profil_modositas" value="Módosítás">
                </form>
            <form method="post" action="profilkep_modositas.php" enctype="multipart/form-data">
               <label for="fajlfeltoltes">Profilkép feltöltése </label>
               <input type="file" id="fajlfeltoltes" name="fajlfeltoltes" accept="image/*">
               <br>
               <input class="button" type="submit" name="profilkep_modositas" value="Módosítás">
           </form>

            <form method="post" action="profil_torles.php">
                <input class="button" type="submit" name="torles" value="Törlés">
            </form>

            <form method="POST" action="egyenlegfeltoltes.php">
            <h2>Befizetés:</h2>
            <?php
            if (isset($_GET["befizetve"]) && $_GET["befizetve"] === "sikeres") {
                echo '<p style="color: rgb(70,148,0); font-size: 20px; font-weight: bold; display: inline-block">Sikeres befizetés!</p>';
            }
            // Hibaüzenet
            if (isset($_GET["error"]) && $_GET["error"] === "osszeg") {
                echo '<p style="color: red; font-size: 20px; font-weight: bold; display: inline-block">Nem adott meg összeget!</p>';
            }
            ?>
            <label>Befizetni kívánt összeg:</label>
            <input style="text-align: right" type="number" name="osszeg"/>Ft
            <br>
            <input class="button" type="submit" value="Befizetés">
            </form>
       </div>

   <div id="kosartartalom">
<table id="kosar">
    <?php
    //Hibaüzenetek
    if (!empty($_GET["vasarlas"]) && $_GET["vasarlas"] === "sikeres") {
        echo '<p style="color: rgb(70,148,0); font-size: 20px; font-weight: bold; display: inline-block">A vásárlás sikeres! Köszönjük, hogy minket választott!</p>';
    }
    if (!empty($_GET["eltavolitotta"]) && $_GET["eltavolitotta"] === "sikeres") {
        echo '<p style="color: rgb(70,148,0); font-size: 20px; font-weight: bold; display: inline-block">Sikeresen eltávolította a terméket a kosárból!</p>';
    }
    // Hibaüzenet
    if (!empty($_GET["error"]) && $_GET["error"] === "kosarkitoltes") {
        echo '<p style="color: red; font-size: 20px; font-weight: bold; display: inline-block">A vásárlásban hiba lépett fel!</p>';
    }
    if (!empty($_GET["vasarlas"]) && $_GET["vasarlas"] === "sikertelen") {
        echo '<p style="color: red; font-size: 20px; font-weight: bold; display: inline-block">Nincs elegendő összeg az egyenlegén!</p>';
    }
    ?>


    <?php
        //lekérdezzük a kosar rábla adatait felhasznalo_azonosito alapján
       $lista = 'SELECT * FROM KOSAR WHERE felhasznalo_azonosito ="'.$_SESSION["azonosito"].'"';
       $eredmeny = mysqli_query($conn, $lista);
       if (!$eredmeny) {
           die("Lekérdezési hiba: " . mysqli_error($conn));
       }

       $ossz_darab = 0;
       $ossz_osszeg = 0;
       $ossz_pontok = 0;

       echo'<tr><td colspan="4">KOSÁR</td></tr>';

    //asszociatív tömbbe eltárolja az adatokat
    while ($row = mysqli_fetch_assoc($eredmeny)) {
           $nev = $row['nev'];
           $ar = $row['ar'];
           $darab = $row['darab'];


           // Darabszám összege
           $ossz_darab += $darab;

           // Végösszeg kiszámítása
           $ossz_osszeg += $ar;

           // Pontok számítása
           $ossz_pontok += $darab * 0.5;

           //a kosár táblázatát legeneráljuk
           echo ' <form method="post" action="kosar_urites.php">
           <tr><td> '. $nev .' </td><td> '. $ar .'</td><td> '. $darab .'</td>
           <td>
           <input type="hidden" name="nev" value="'.$nev.'">
           <input style="font-size: 15px; color: rgb(109, 86, 12); border: 1px solid rgb(109, 86, 12)" type="submit" name="torol" value="Eltávolítás">
           </td>
           </tr>
           </form>';
       }
       echo'
        <tr>
        <td></td>
        <td><label>Végösszeg:</label>'.$ossz_osszeg.'Ft</td>
        <td><label>Termékek:</label>'.$ossz_darab.'db</td>
        <td><label>Termékek utáni pontok: </label>'.$ossz_pontok.'pont</td>
        </tr>
        </table>';

       echo '<form method="post" action="vasarlas.php">
       <input type="hidden" name="osszeg" value="'.$ossz_osszeg.'">
       <input type="hidden" name="pontok" value="'.$ossz_pontok.'">
        <input id="vasarlasGomb" type="submit" name="vasarlasgomb" value="Vásárlás">
       </form>';
       ?>
   </div>

   <footer>
       <section class="infok">
           <h2><img src="img/open.png" alt="naptár" width="25"> Nyitvatartás: </h2>
           <h4>Minden cukrászdánk azonos nyitvatartással rendelkezik!</h4>
           <p>Hétfő: 6:00 - 18:00</p>
           <p>Kedd: 6:00 - 18:00</p>
           <p>Szerda: 6:00 - 18:00</p>
           <p>Csütörtök: 6:00 - 18:00</p>
           <p>Péntek: 6:00 - 18:00</p>
           <p>Szombat: 8:00 - 20:00</p>
           <p>Vasárnap: ZÁRVA</p>

           <h2>Elérhetőségek:</h2>
           <p><img  src="img/tel.png" alt="telefon" width="25">  Tel.: +36 1 234 5678</p>
           <p><img  src="img/mail.png" alt="email" width="25">  E-mail: info@cukraszda.hu</p>
       </section>

       <aside class="infok">
           <h2><img  src="img/uzlet.png" alt="üzlet" width="25">  Üzleteink: </h2>
           <h4>Látogasson el hozzánk személyesen is!</h4>
           <ol><li>Budapest:</li></ol>
           <ul>
               <li>Deák Ferenc tér 4.</li>
               <li>Kossuth Lajos utca 12.</li>
               <li>Váci út 1.</li>
           </ul>
           <ol><li>Szeged:</li></ol>
           <ul>
               <li>Kálvin tér 10.</li>
               <li>Római krt. 2.</li>
               <li>Tisza Lajos krt. 15.</li>
           </ul>
           <ol><li>Debrecen:</li></ol>
           <ul>
               <li>Kossuth tér 5.</li>
               <li>Egyetem tér 1.</li>
               <li>Petőfi tér 8.</li>
           </ul>
       </aside>
   </footer>
</main>
</body>
</html>