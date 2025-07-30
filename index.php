<?php
session_start();

if (!isset($_SESSION['nev'])) {
    header('Location: bejelentkezes.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="img/png" href="img/titlecake.png">
    <title>Főoldal</title>
    <style>
        @media only screen and (max-width: 768px) {
            .infok {
                width: 80%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<main id="fooldal">
        <h1>Sweet candy cukrászda</h1>
         <div>
            <ul class="foszempont">
                <li class="foszempontok">Üdvözlünk a Sweet candy honlapon és köszönjük hogy minket választott!</li>
                <li class="foszempontok">A honlapot Szitás Botond Károly és Csanádi Szabolcs Norbert készítette, mellyel frissen sült termékek kínálatával , megannyi modern receptekkel, ötletekkel, kedvező árakkal kedveskedig vevőinek, a megfelelő minőséget nem kihagyva.</li>
                <li class="foszempontok">A Termékek fül alatt megtekintheti színes kínálatunkat és saját ízlése szerint választhat.</li>
                <li class="foszempontok">A Receptek fül alatt a felhasználók/felületkezelők által eddig feltöltött ötleteket, recept különlegességeket olvashat, írhat.</li>
                <li class="foszempontok">Kedves vásárlóinkat értékes pontokkal gazdagítjuk amellyet a Profil oldalon láthat.</li>
            </ul>
             <?php
             if (isset($_GET["bejelentkezett"]) && $_GET["bejelentkezett"] === "sikeres") {
                 echo '<p style="color: rgb(70,148,0); font-size: 20px; font-weight: bold; background-color: #faead6e6; padding: 20px; display: inline-block" >Üdvözöljük '.$_SESSION['nev'].'!</p>';
             }
             if (isset($_GET["admin_bejelentkezett"]) && $_GET["admin_bejelentkezett"] === "sikeres") {
                 echo '<p style="color: rgb(70,148,0); font-size: 20px; font-weight: bold; background-color: #faead6e6; padding: 20px; display: inline-block">Sikeres bejelentkezés!</p>';
             }
             ?>
         </div>
<div>
    <h1>Válasszon kategóriát!</h1>
    <table class="menupontok">
        <tr>
            <td class="menu"><a class="link" href="index.php"><img  src="img/titlecakeLight.png" alt="kezdolap" width="22">Kezdőlap </a></td>
            <td class="menu"><a class="link" href="termekek.php"><img src="img/cupcakeBrown.png" alt="termekek" width="22">Termékek </a></td>
            <td class="menu"><a class="link" href="receptek.php"><img src="img/paperBrown.png" alt="receptek" width="22">Receptek</a> </td>
        </tr>
        <tr>
            <td class="menu"><a class="link" href="leiras.php"><img src="img/paperBrown.png" alt="leiras" width="22">Termékleírás</a> </td>
            <td class="menu"><a class="link" href="profiloldal.php"><img src="img/profil.png" alt="profil" width="22">Profil oldal</a></td>
            <td class="menu"><a class="link" href="kijelentkezes.php"><img src="img/logout.png" alt="kijelentkezes" width="22">Kijelentkezés</a></td>
        </tr>
    </table>
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