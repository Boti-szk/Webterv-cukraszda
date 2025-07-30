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
    <title>Admin</title>
</head>
<body>
<main id="fooldal">
    <h1>Sweet candy cukrászda</h1>
    <table>
        <tr>
            <td class="menu"><a class="link" href="bejelentkezes.php"><img src="img/login.png" alt="bejelentkezés" width="22">Bejelentkezés</a></td>
            <td class="menu"><a class="link" href="regisztracio.php"><img src="img/view-detailsDark.png" alt="regisztráció" width="22">Regisztráció</a></td>
            <td class="menu"><a class="link" href="admin.php"><img  src="img/keyGreen.png" alt="admin" width="22">Admin</a></td>
        </tr>
    </table>
    <header>
        Adja meg a felhasználónevét és a belépési kódot!
        <?php
        if (isset($_GET["error"]) && $_GET["error"] === "kitoltes") {
            echo '<p style="color: red; font-size: 20px; margin-left: 8%; display: block">Nem töltötte ki a mezőt!</p>';
        }
        if (isset($_GET["error"]) && $_GET["error"] === "nincs_admin") {
            echo '<p style="color: red; font-size: 20px; margin-left: 8%; display: block">Nincs ilyen nevű admin!</p>';
        }
        if (isset($_GET["error"]) && $_GET["error"] === "hibas") {
            echo '<p style="color: red; font-size: 20px; margin-left: 8%; display: block">Helytelen belépési kódot adott meg!</p>';
        }
        ?>
    </header>
    <section id="adatok">
        <form method="post" action="admin_ellenorzes.php">
            <label for="nev">Felhasználónév: </label>
            <input id="nev" name="nev" type="text" required placeholder="Max 100 karakter!">
            <label for="kod"><img  src="img/keyBrown.png" alt="kulcs" width="25"> Kód: </label>
            <input id="kod" name="kod" required type="password" placeholder="Min 8 és max 64 karakter!">
            <br>
            <input id="button" type="submit" name="belepes" value="Belépés">
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