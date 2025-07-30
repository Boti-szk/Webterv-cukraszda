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
    $selectedCategory = $_POST['termekkategoriak2'];

    //lekérdezzök a kiválasztott kategóriával egyező termékeket
    $lista = "SELECT * FROM TERMEKEK WHERE kategoria = '$selectedCategory'";
    $eredmeny = mysqli_query($conn, $lista);
    if (!$eredmeny) {
        die("Lekérdezési hiba: " . mysqli_error($conn));
    }

} else {
    // Alapértelmezett lekérdezés
    $lista = "SELECT * FROM TERMEKEK";
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
    <link rel="icon" type="img/png" href="img/cupcakeLight.png">
    <title>Termékek</title>
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

        #kategoriak {
                color: rgb(109, 86, 12);
                display: inline-block;
                background-color: rgb(157, 208, 111, 0.8);
                text-align: left;
                font-size: 20px;
                width: 20%;
                margin-top: 50px;
                border: 3px solid rgb(109, 86, 12);
                border-radius: 0 25px 25px 0;
                vertical-align: top;
            }

        #kategoriak label, input, select {
            text-align: center;
            margin-left: 25%;
        }

        #kategoriak .button {
            margin-left: 25%;
        }

        #termekek {
            color: rgb(109, 86, 12);
            text-align: left;
            width: 70%;
            display: inline-block;
            font-size: 20px;
            margin-top: 50px;
        }

        #ujtermek{
            color: rgb(109, 86, 12);
            display: inline-block;
            background-color: rgba(157, 208, 111, 0.80);
            width: 70%;
            margin-top: 20px;
            border: 3px solid rgb(109, 86, 12);
            border-radius: 15px 15px 15px 15px;
            vertical-align: top;
            text-align: center;
            margin-left: 15%;
            margin-right: 15%;
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
        }

        #move {
            margin-left: 60px;
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
        }

        #termekek input{
            background-color: transparent;
            max-width: 100px;
            text-align: right;
            font-size: 15px;
            color: rgb(109, 86, 12);
            border: none;
        }

        #termekek .button{
            background-color: transparent;
            border: 4px solid rgb(109, 86, 12);
            border-radius: 10px;
            font-size: large;
            color: rgb(131, 76, 5);
            margin: 5px;
            padding:5px;
        }
        #termekek .button:hover{
            background-color: rgb(109, 86, 12);
            color: antiquewhite;
            transition:all 0.5s linear;
        }

        .elemek {
            display: inline-block;
            width: 100%;
            border: 4px solid;
            text-align: center;
            min-height: 80px;
            padding-top: 10px;
            border-radius: 25px;
            margin: 5px;
        }

        .kepek {
            text-align: center;
            border-radius: 30px;
            margin: 20px 45px;
            max-width: 60%;
            background-color: rgb(255,228,196, 0.8);
        }

        p {
            font-size: larger;
        }

        #ujtermek label {
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

        @media only screen and (max-width: 768px) {
            #kategoriak {
                width: 100%;
                border-radius: 15px 15px 15px 15px;
                margin-top: 20px;
            }

            .elemek {
                width: 45%;
            }

            .kepek {
                border-radius: 30px;
                margin: 10px auto;
                max-width: 90%;
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

        <h1 id="top">Termékeink</h1>
        <table class="menupontok">
            <tr>
                <td class="menu"><a class="link" href="index.php"><img src="img/titlecakeBrown.png" alt="kezdolap" width="22">Kezdőlap </a></td>
                <td class="menu"><a class="link" href="termekek.php"><img src="img/cupcake.png" alt="termekek" width="22">Termékek </a></td>
                <td class="menu"><a class="link" href="receptek.php"><img src="img/paperBrown.png" alt="receptek" width="22">Receptek</a> </td>
            </tr>
            <tr>
                <td class="menu"><a class="link" href="leiras.php"><img src="img/paperBrown.png" alt="leiras" width="22">Termékleírások</a> </td>
                <td class="menu"><a class="link" href="profiloldal.php"><img src="img/profil.png" alt="profil" width="22">Profil oldal</a></td>
                <td class="menu"><a class="link" href="kijelentkezes.php"><img src="img/logout.png" alt="kijelentkezes" width="22">Kijelentkezés</a></td>
            </tr>
        </table>

            <div id="kategoriak">
                <form method="post" action="termekek.php">
                    <h4>Választható kategóriák:</h4>
                    <label>Édes sütemény<input type="radio" name="category2" value="edes" required onclick="megjelenit2()"></label>
                    <br>
                    <label>Sós sütemény<input type="radio" name="category2" value="sos" required onclick="megjelenit2()"></label>
                    <br>
                    <label>Ital<input type="radio" name="category2" value="ital" required onclick="megjelenit2()"></label>
                    <br>
                    <label for="termekkategoriak2">Kategória:</label>
                    <select id="termekkategoriak2" required name="termekkategoriak2">
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
                            let select = document.getElementById("termekkategoriak2");
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

            <div id="termekek">
                <?php
                if (isset($_GET["kosarba"]) && $_GET["kosarba"] === "sikeres") {
                echo '<p style="color: rgb(70,148,0); font-size: 20px; margin-left: 8%; display: inline-block">Sikeresen kosárba került a termék!</p>';
                }
                if (isset($_GET["error"]) && $_GET["error"] === "kitoltes") {
                    echo '<p style="color: red; font-size: 20px; margin-left: 8%; display: inline-block">Nem sikerült kosárba helyezni a terméket!</p>';
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
                <div class="elemek">

                <?php
                //asszociatív tömbbe eltárolja az adatokat
                while ($row = mysqli_fetch_assoc($eredmeny)) {
                    $azonosito = $row['azonosito'];
                    $nev = $row['nev'];
                    $kep = $row['kep'];
                    $ar = $row['ar'];
                    $kategoria = $row['kategoria'];

                    //div-et generál amibe bele pakolja a tömbből lekért adatokat
                    //benne egy form is legenerálódik amivel a kosárba helyezés oldódik meg
                    echo '
                   <div class="'.$kategoria.' kepek elemek">
                   <form method="post" action="kosarba_rak.php" enctype="multipart/form-data">
                   <img class="kepek" src="'.$kep.'" alt="'.$kategoria.'" width="200">
                   <input type="hidden" name="nev" value="'.$kep.'">
                    <p>'.$nev.'</p>
                    <p>'.$ar.'Ft</p>
                    <input type="hidden" name="nev" value="'.$nev.'">
                    <input type="hidden" name="ar" value="'.$ar.'">
                    <input style="border: 3px solid  rgb(109, 86, 12); font-weight: bold" type="number" name="darab" placeholder="Mennyiség">db
                    <br>
                    <input class="button" type="submit" name="kosarba" value="Kosárba">
                     </form>
                    </div>';
                }

                ?>
            </div>
            </div>
            <a id="move-to-top" href="#top">↑</a>
            <?php
            if ($_SESSION['szerepkor'] == 1){
                echo'<a id="move" href="#ujtermek">↓</a>';

                //Hibauzenetek
                if (isset($_GET["hozzaad"]) && $_GET["hozzaad"] === "sikeres") {
                    echo '<p style="color: rgb(70,148,0); font-size: 20px; margin-left: 8%; display: inline-block">Sikeresen hozzáadta a terméket a kínálathoz!</p>';
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

                echo '
            <div id="ujtermek">
            <form method="post" action="termek_hozzaadas.php" enctype="multipart/form-data">
            <header>Új termék hozzáadása:</header>
            <br>
            <br>
            <label>Édes sütemény<input type="radio" name="category" value="edes" required onclick="megjelenit()"></label>
            <br>
            <label>Sós sütemény<input type="radio" name="category" value="sos" required onclick="megjelenit()"></label>
            <br>
            <label>Ital<input type="radio" name="category" value="ital" required onclick="megjelenit()"></label>
            <br>
            <label for="termekkategoriak">Kategória:</label>
            <select id="termekkategoriak" required name="termekkategoriak">
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
                function megjelenit() {
                    //kiválasztja a select-et azonosító alapján
                    let select = document.getElementById("termekkategoriak");
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
            <br>
            <label for="termeknev">Termék neve: </label>
            <br>
            <input id="termeknev" name="nev" required type="text" placeholder="Max 100 karakter!">
            <br>
            <label for="fajlfeltoltes">Termék kép feltöltése </label>
            <input type="file" id="fajlfeltoltes" name="fajlfeltoltes" accept="image/*">
            <br>
            <label for="armezo">Írja le a termék árát </label>
            <br>
            <input id="armezo" name="ar" type="number" >
            <br>
            <input class="button" type="submit" name="kuldes" value="Feltöltés">
        </form>
    </div>';
            }
            ?>


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
                <p><img src="img/tel.png" alt="telefon" width="25"> Tel.: +36 1 234 5678</p>
                <p><img src="img/mail.png" alt="email" width="25"> E-mail: info@cukraszda.hu</p>
            </section>

            <aside class="infok">
                <h2><img src="img/uzlet.png" alt="üzlet" width="25"> Üzleteink: </h2>
                <h4>Látogasson el hozzánk személyesen is!</h4>
                <ol>
                    <li>Budapest:</li>
                </ol>
                <ul>
                    <li>Deák Ferenc tér 4.</li>
                    <li>Kossuth Lajos utca 12.</li>
                    <li>Váci út 1.</li>
                </ul>
                <ol>
                    <li>Szeged:</li>
                </ol>
                <ul>
                    <li>Kálvin tér 10.</li>
                    <li>Római krt. 2.</li>
                    <li>Tisza Lajos krt. 15.</li>
                </ul>
                <ol>
                    <li>Debrecen:</li>
                </ol>
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