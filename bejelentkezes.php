<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/regisztracio_bejelentkezes.css">
    <link rel="icon" type="img/png" href="img/menuLight.png">
    <style>
        table {
            border: 3px solid honeydew;
            margin: auto;
            border-collapse: collapse;
            min-width: 600px;
            min-height: 60px;
        }

        nav a{
            color: rgb(109, 86, 12);
        }

        nav a:hover{
            color: #9DD06F;
            transition: all 0.75s;
        }

        @media only screen and (max-width: 768px) {
            input, select {
                font-size: 15px;
                width: fit-content;
            }

            .infok {
                width: 80%;
                text-align: center;
            }
        }
    </style>
    <title>Bejelentkezés</title>
</head>
<body>
<main id="fooldal">
    <h1>Sweet candy cukrászda</h1>
    <table>
        <tr>
            <td class="menu"><a class="link" href="bejelentkezes.php"><img src="img/loginGreen.png" alt="bejelentkezés" width="22">Bejelentkezés</a></td>
            <td class="menu"><a class="link" href="regisztracio.php"><img  src="img/view-detailsDark.png" alt="regisztrácio" width="22">Regisztráció</a></td>
            <td class="menu"><a class="link" href="admin.php"><img  src="img/key.png" alt="admin" width="22">Admin</a></td>
        </tr>
    </table>

    <header>
        Bejelentezés
        <?php
        if (isset($_GET["regisztralt"]) && $_GET["regisztralt"] === "sikeres") {
            echo '<p style="color: rgb(70,148,0); font-size: 20px; margin-left: 8%; display: inline-block">Sikeres regisztráció!</p>';
        }
        if (isset($_GET["kijelentkezett"]) && $_GET["kijelentkezett"] === "sikeres") {
            echo '<p style="color: rgb(70,148,0); font-size: 20px; margin-left: 8%; display: inline-block">Sikeres kijelentkezés!</p>';
        }
        if (!empty($_GET["modosit"]) && $_GET["modosit"] === "sikeres") {
            echo '<p style="color: rgb(70,148,0); font-size: 20px; font-weight: bold; display: inline-block">Sikeresen módosította adatait! Jelentkezzen be újra!</p>';
        }
        if (isset($_GET["error"]) && $_GET["error"] === "kitoltes") {
            echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Nem adott meg minden adatot!</p>';
        }
        if (isset($_GET["error"]) && $_GET["error"] === "nev_nemegyezik") {
            echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Ezzel a felhasználónévvel még nem regisztrált! </p>';
        }

        if (isset($_GET["error"]) && $_GET["error"] === "jelszo_nemegyezik") {
            echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Helytelen jelszót adott meg! </p>';
        }
        ?>
    </header>
    <section id="adatok">
        <form method="post" action="adatellenorzes.php">
            <label for="nev">Felhasználói név: </label>
                <input id="nev" name="nev" required type="text" placeholder="Max 100 karakter!">
            <br>
            <label for="jelszo">Jelszó: </label>
                <input id="jelszo" name="jelszo" required type="password" placeholder="Min 8 és max 64 karakter!">
            <br>
            <nav>Ha még nem rendelkezik felhasználói fiókkal, kattintson <a href="regisztracio.php">ide</a>!</nav>
            <br>
                <input id="button" type="submit" name="bejelentkezes" value="Bejelentkezés">
        </form>
    </section>

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