<?php
session_start();
include("fuggvenyek.php");

//POST-tal lekérjük az átküldött adatokat,
$nev = $_POST['nev'];
$jelszo = $_POST['jelszo'];

//ellenőrizzük, hogy kaptak-e értéket,
if ( empty($nev) || empty($jelszo)) {
    header("Location: bejelentkezes.php?error=kitoltes");
    exit();

} else {
    //adat tisztítása: karaktereket karakterkódokra cseréljük,
    $tiszta_nev = htmlspecialchars($nev);
    $tiszta_jelszo = htmlspecialchars($jelszo);

    //beszúrjuk a rekordot az adatbázisba
    $sikeres = bejelentkezik($tiszta_nev, $tiszta_jelszo);

    if ( $sikeres == false ) {
        die("Nem sikerült bejelentkezni.");
    } else {
        //átlépünk az index.php-ra,
        header("Location: index.php?bejelentkezett=sikeres");
    }
}

?>