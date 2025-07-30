<?php
session_start();
include("fuggvenyek.php");

//POST-tal lekérjük az átküldött adatokat,
$nev = $_POST['nev'];
$kod = $_POST['kod'];

//ellenőrizzük, hogy kaptak-e értéket,
if ( empty($nev) || empty($kod) ) {
    header("Location: admin.php?error=kitoltes");
    exit();

} else {
    //adat tisztítása: karaktereket karakterkódokra cseréljük,
    $tiszta_nev = htmlspecialchars($nev);
    $tiszta_kod = htmlspecialchars($kod);

    //beszúrjuk a rekordot az adatbázisba
    $sikeres = admin_ellenorzes($tiszta_nev, $tiszta_kod);

    if ( $sikeres == false ) {
        die("Nem sikerült bejelentkezni.");
    } else {
        //átlépünk az index.php-ra,
        header("Location: index.php?admin_bejelentkezett=sikeres");
    }
}

?>