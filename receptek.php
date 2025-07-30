<?php
include('fuggvenyek.php');

//kapcsolódás az adatbázishoz
$conn = cukraszda_csatlakozas();

session_start();

if (!isset($_SESSION['nev'])) {
    header('Location: bejelentkezes.php');
    exit;
}

if(isset($_POST['keres'])) {
    //Kiválasztott kategória tárolása
    $selectedCategory = $_POST['receptkategoriak2'];

    //lekérdezzök a kiválasztott kategóriával egyező termékeket
    $lista = "SELECT * FROM RECEPTEK WHERE kategoria = '$selectedCategory'";
    $eredmeny = mysqli_query($conn, $lista);
    if (!$eredmeny) {
        die("Lekérdezési hiba: " . mysqli_error($conn));
    }

} else {
    // Alapértelmezett lekérdezés, ha nem történt keresés
    $lista = "SELECT * FROM RECEPTEK";
    $eredmeny = mysqli_query($conn, $lista);
    if (!$eredmeny) {
        die("Lekérdezési hiba: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="img/png" href="img/paperLight.png">
    <title>Receptek</title>
    <style>
        header{
            font-size: 20px;
            color: rgb(109, 86, 12);
            font-weight: bold;
            margin-top: 5px;
            min-width: 150px;
            margin-bottom: 10px;
            display: inline-block;
            text-align: center;
        }

        #kategoriak{
            color: rgb(109, 86, 12);
            display: inline-block;
            background-color: rgba(157, 208, 111, 0.80);
            text-align: left;
            font-size: 20px;
            width: 20%;
            margin-top: 50px;
            border: 3px solid rgb(109, 86, 12);
            border-radius: 0 15px 15px 0;
            vertical-align: top;
        }

        #kategoriak label, input, select {
            text-align: center;
            margin-left: 25%;
        }

        #kategoriak .button {
            margin-left: 25%;
        }

        #receptek{
            color: rgb(109, 86, 12);
            display: inline-block;
            font-size: 15px;
            width: 55%;
            margin-top: 50px;
            border: 3px solid rgb(109, 86, 12);
            border-radius: 15px;
            vertical-align: top;
        }

        .recept {
            background-image: url(img/recept.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            width: 75%;
            height: auto;
            margin-top: 10px;
            margin-bottom: 20px;
            padding: 10px;
        }

        .recept .receptnev{
            font-size: 20px;
            color: rgb(109, 86, 12);
            font-weight: bold;
            margin-top: 5px;
            min-width: 150px;
            margin-bottom: 10px;
            display: inline-block;
            text-align: center;
        }

        .recept .kozzetette{
            text-align: left;
            margin-left: 5%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .recept .cimek  {
            text-align: left;
            margin-left: 5%;
            margin-bottom: 10px;
        }

        .recept .hozzavalok{
            text-align: left;
            margin-left: 5%;
            white-space: pre-wrap;
            font-size: 15px;
        }

        .recept .elkeszites{
            text-align: left;
            margin-left: 5%;
            white-space: pre-wrap;
            font-size: 15px;
        }

        #ujrecept{
            color: rgb(109, 86, 12);
            display: inline-block;
            background-color: rgba(157, 208, 111, 0.80);
            width: 20%;
            margin-top: 50px;
            border: 3px solid rgb(109, 86, 12);
            border-radius: 15px 0 0 15px;
            vertical-align: top;
        }

        label {
            font-size: 15px;
            color: rgb(109, 86, 12);
            font-weight: bold;
            margin-bottom: 5px;
            min-width: 100px;
            display: inline-block;
        }

        input, select{
            color: black;
            font-size: 15px;
            margin: 10px;
            border: 3px solid  rgb(109, 86, 12);
            background-color: transparent;
        }

        .button {
            color: rgb(109, 86, 12);
            font-size: 15px;
            margin-top: 10px;
            border-radius: 12px;
            border: 3px solid  rgb(109, 86, 12);
            background-color: transparent;
            transition: all 0.5s linear;
        }

        .button:hover {
            color: antiquewhite;
            background-color:  rgb(109, 86, 12);

        }

        #ujrecept textarea{
            color: black;
            font-size: 10px;
            margin: 10px;
            border: 3px solid  rgb(109, 86, 12);
            background-color: transparent;
        }

        #move-to-top {
            position: fixed;
            text-decoration: none;
            font-size: xx-large;
            color: rgb(109, 86, 12);
            padding: 10px;
            border: 2px solid #9DD06F;
            text-align: center;
            width: 35px;
            height: 35px;
            border-radius: 30px;
            background-color: antiquewhite;
            vertical-align: bottom;
            flex-wrap: wrap;
        }
        input[type=range] {
            width: 70%;
            margin: auto;
            display: block;
            height: 20px;
        }

        @media only screen and (max-width: 768px) {
            #kategoriak {
                width: 100%;
                border-radius: 15px 15px 15px 15px;
                margin-top: 20px;
            }

            #receptek {
                width: 100%;
                border-radius: 15px 15px 15px 15px;
                margin-top: 20px;
            }

            #ujrecept{
                width: 100%;
                border-radius: 15px 15px 15px 15px;
                margin-top: 20px;
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
    <div>
        <h1 id="top">Receptek</h1>
        <table class="menupontok">
            <tr>
                <td class="menu"><a class="link" href="index.php"><img src="img/titlecakeBrown.png" alt="kezdolap" width="22">Kezdőlap </a></td>
                <td class="menu"><a class="link" href="termekek.php"><img src="img/cupcakeBrown.png" alt="termekek" width="22">Termékek </a></td>
                <td class="menu"><a class="link" href="receptek.php"><img  src="img/paperGreen.png" alt="receptek" width="22">Receptek</a> </td>
            </tr>
            <tr>
                <td class="menu"><a class="link" href="leiras.php"><img src="img/paperBrown.png" alt="leiras" width="22">Termékleírások</a> </td>
                <td class="menu"><a class="link" href="profiloldal.php"><img src="img/profil.png" alt="profil" width="22">Profil oldal</a></td>
                <td class="menu"><a class="link" href="kijelentkezes.php"><img src="img/logout.png" alt="kijelentkezes" width="22">Kijelentkezés</a></td>
            </tr>
        </table>
    </div>

    <div id="kategoriak">
        <form method="post" action="receptek.php">
            <h4>Választható kategóriák:</h4>
            <label>Édes sütemény<input type="radio" name="category2" value="edes" required onclick="megjelenit2()"></label>
            <br>
            <label>Sós sütemény<input type="radio" name="category2" value="sos" required onclick="megjelenit2()"></label>
            <br>
            <label>Ital<input type="radio" name="category2" value="ital" required onclick="megjelenit2()"></label>
            <br>
            <label for="receptkategoriak2">Kategória:</label>
            <select id="receptkategoriak2" required name="receptkategoriak2">
                <option value="" disabled selected>Válassz kategóriát!</option>
                <option value="1torta">Torta</option>
                <option value="1pite">Pite</option>
                <option value="1keksz">Keksz</option>
                <option value="1muffin">Muffin</option>
                <option value="1fagylalt">Fagylalt</option>
                <option value="1fank">Fánk</option>
                <option value="1palacsinta">Palacsinta</option>
                <option value="1kremes">Krémes</option>
                <option value="2pugacsa">Pogácsa</option>
                <option value="2kifli">Kifli</option>
                <option value="2perec">Perec</option>
                <option value="2tekercs">Tekercs</option>
                <option value="2bagel">Bagel</option>
                <option value="2kenyer">Kenyér</option>
                <option value="2szendvics">Szendvics</option>
                <option value="2lepeny">Lepény</option>
                <option value="3kave">Kávé</option>
                <option value="3tea">Tea</option>
                <option value="3limonade">Limonádé</option>
                <option value="3shake">Shake</option>
            </select>

            <script>
                function megjelenit2() {
                    //kiválasztja a select-et azonosító alapján
                    let select = document.getElementById("receptkategoriak2");
                    //elérhetóvé teszi az összes opciót a menüben
                    let options = select.options;

                    // Minden elem engedélyezése
                    for (let i = 0; i < options.length; i++) {
                        options[i].style.display = "block";
                    }

                    //megnézi melyik rádió gomb lett kiválasztva
                    let radios = document.getElementsByName("category2");
                    let selectedCategory;
                    for (let i = 0; i < radios.length; i++) {
                        if (radios[i].checked) {
                            selectedCategory = radios[i].value;
                            break;
                        }
                    }

                    //a feltételek alapján elrejt bizonyos lehetőségeket
                    if (selectedCategory === "edes") {
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].value.startsWith("2") || options[i].value.startsWith("3")) {
                                options[i].style.display = "none";
                            }
                        }
                    } else if (selectedCategory === "sos") {
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].value.startsWith("1") || options[i].value.startsWith("3")) {
                                options[i].style.display = "none";
                            }
                        }
                    } else if (selectedCategory === "ital") {
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].value.startsWith("1") || options[i].value.startsWith("2")) {
                                options[i].style.display = "none";
                            }
                        }
                    }
                }
            </script>
            <br>
            <input class="button" type="submit" name="keres" value="Keresés">
        </form>
    </div>

    <div id="receptek">

        <?php
        if (isset($_GET["error"]) && $_GET["error"] === "ertekelte") {
            echo '<p style="color: red; font-size: 20px; text-align: center; display: inline-block">Az ön által értékelni kívánt receptet korábban már értékelte!</p>';
        }

        if (isset($_GET["ertekelte"]) && $_GET["ertekelte"] === "sikeres") {
            echo '<p style="color: rgb(70,148,0); font-size: 20px; text-align: center; display: inline-block">Sikeresen értékelte a kívánt receptet!</p>';
        }

        //asszociatív tömbbe eltárolja az adatokat
        while ($row = mysqli_fetch_assoc($eredmeny)) {
            $nev = $row['nev'];
            $kategoria = $row['kategoria'];
            $hozzavalok = $row['hozzavalok'];
            $elkeszites = $row['elkeszites'];
            $feltoltotte = $row['feltoltotte'];
            $ertekeles = $row['ertekeles'];
            $darab = $row['darab'];

            if ($ertekeles == null){
                $ertekeles = "Még nincs értékelés!";
            }
            if ($darab == null){
                $darab = "Még nem értékelte senki!";
            }

            //div-et generál amibe bele pakolja a tömbből lekért adatokat
            //benne egy form is legenerálódik amivel a kosárba helyezés oldódik meg
            echo '
                   <div class="'.$kategoria.' recept">
                    <p class="receptnev">'.$nev.'</p>
                    <br>
                    <p class="kozzetette">Közzétette: '.$feltoltotte.'</p>
                    <p class="cimek">Hozzávalók:</p>
                    <pre class="hozzavalok">'.$hozzavalok.'</pre>
                    <p class="cimek"> Elkészítés:</p>
                    <pre  class="elkeszites">'.$elkeszites.'</pre>
                     <form method="post" action="ertekeles.php">
                     <input type="hidden" name="nev" value="'.$nev.'">
                     <label>Értékelje a receptet a skála mozdításával!</label>
                     <input name="ertekeles" type="range" min="1" max="10" step="1">
                     <input class="button" type="submit" name="ertekel" value="Értékelés">
                    </form>
                    <table style=" margin: 0 auto;">
                    <tr><td>Értékelés</td><td>Értékelések száma</td></tr>
                    <tr><td>'.$ertekeles.'</td><td>'.$darab.'</td></tr>
                    </table>
                </div>';
        }

        ?>
    </div>


    <div id="ujrecept">
        <form method="post" action="recept_hozzaadas.php">
            <header>Új recept hozzáadása:</header>
<?php
if (!empty($_GET["feltoltes"]) && $_GET["feltoltes"] === "sikeres") {
    echo '<p style="color: rgb(70,148,0); font-size: 20px; font-weight: bold; display: inline-block">Sikeresen közzétette a receptet!</p>';
}
    if (isset($_GET["error"]) && $_GET["error"] === "kitoltes") {
        echo '<p style="color: red; font-size: 20px; margin-left: 30%; text-align: center; display: inline-block">Nem töltött ki minden mezőt!</p>';
    }
    if (isset($_GET["error"]) && $_GET["error"] === "hiba") {
        echo '<p style="color: red; font-size: 20px; margin-left: 30%; text-align: center; display: inline-block">A kép feltöltése sikertelen!</p>';
    }
    if (isset($_GET["error"]) && $_GET["error"] === "kiterjesztes") {
        echo '<p style="color: red; font-size: 20px; margin-left: 30%; text-align: center; display: inline-block">Csak JPG, JPEG és PNG kiterjesztésű képeket lehet feltölteni!</p>';
    }
    if (isset($_GET["error"]) && $_GET["error"] === "nagy") {
        echo '<p style="color: red; font-size: 20px; margin-left: 30%; text-align: center; display: inline-block">Túl nagy méretű a kép! Max 30MB</p>';
    }
    if (isset($_GET["error"]) && $_GET["error"] === "nevhossz") {
        echo '<p style="color: red; font-size: 20px; margin-left: 30%; text-align: center; display: inline-block">Túl hosszú terméknevet adott meg!</p>';
    }
    if (isset($_GET["error"]) && $_GET["error"] === "nev_letezik") {
        echo '<p style="color: red; font-size: 20px; margin-left: 30%; text-align: center; display: inline-block">A megadott terméknévvel már létezik leírás!</p>';
    }
    ?>
            <br>
            <br>
            <label>Édes sütemény<input type="radio" name="category" value="edes" required onclick="megjelenit(this.value)"></label>
            <br>
            <label>Sós sütemény<input type="radio" name="category" value="sos" required onclick="megjelenit(this.value)"></label>
            <br>
            <label>Ital<input type="radio" name="category" value="ital" required onclick="megjelenit(this.value)"></label>
            <br>
            <label for="receptkategoriak">Kategória:</label>
            <select id="receptkategoriak" required name="receptkategoriak">
                <option value="" disabled selected>Válassz kategóriát!</option>
                <option value="1torta">Torta</option>
                <option value="1pite">Pite</option>
                <option value="1keksz">Keksz</option>
                <option value="1muffin">Muffin</option>
                <option value="1fagylalt">Fagylalt</option>
                <option value="1fank">Fánk</option>
                <option value="1palacsinta">Palacsinta</option>
                <option value="1kremes">Krémes</option>
                <option value="2pugacsa">Pogácsa</option>
                <option value="2kifli">Kifli</option>
                <option value="2perec">Perec</option>
                <option value="2tekercs">Tekercs</option>
                <option value="2bagel">Bagel</option>
                <option value="2kenyer">Kenyér</option>
                <option value="2szendvics">Szendvics</option>
                <option value="2lepeny">Lepény</option>
                <option value="3kave">Kávé</option>
                <option value="3tea">Tea</option>
                <option value="3limonade">Limonádé</option>
                <option value="3shake">Shake</option>
            </select>
            <script>
                function megjelenit(value) {
                    //kiválasztja a select-et azonosító alapján
                    let select = document.getElementById("receptkategoriak");
                    //elérhetóvé teszi az összes opciót a menüben
                    let options = select.options;

                    // Minden elem engedélyezése
                    for (let i = 0; i < options.length; i++) {
                        options[i].style.display = "block";
                    }

                    //megnézi melyik rádió gomb lett kiválasztva
                    let radios = document.getElementsByName("category");
                    let selectedCategory;
                    for (let i = 0; i < radios.length; i++) {
                        if (radios[i].checked) {
                            selectedCategory = radios[i].value;
                            break;
                        }
                    }

                    //a feltételek alapján elrejt bizonyos lehetőségeket
                    if (value === "edes") {
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].value.startsWith("2") || options[i].value.startsWith("3")) {
                                options[i].style.display = "none";
                            }
                        }
                    } else if (value === "sos") {
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].value.startsWith("1") || options[i].value.startsWith("3")) {
                                options[i].style.display = "none";
                            }
                        }
                    } else if (value === "ital") {
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].value.startsWith("1") || options[i].value.startsWith("2")) {
                                options[i].style.display = "none";
                            }
                        }
                    }
                }
            </script>
            <br>
            <label for="receptnev">Recept neve: </label>
            <br>
            <input id="receptnev" name="receptnev" required type="text">
            <br>
            <label for="hozzavalok">Hozzávalók:</label>
            <br>
            <textarea id="hozzavalok" name="hozzavalok" placeholder="Ide írja a hozzávalókat! (Lehetőleg külön sorokba)" rows="15" cols="30" required></textarea>
            <br>
            <label for="elkeszites">Elkészítés:</label>
            <br>
            <textarea id="elkeszites" name="elkeszites" placeholder="Ide írja az elkészítés menetét!" rows="15" cols="30" required></textarea>
            <br>
            <input class="button" type="submit" name="kuldes" value="Megosztás">
        </form>
    </div>
        <a id="move-to-top" href="#top">↑</a>

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