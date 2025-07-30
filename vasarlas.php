<?php
include_once "fuggvenyek.php";

session_start();

//POST-tal lekérjük az átküldött adatokat,
$osszeg = $_POST['osszeg'];
$pontok = $_POST['pontok'];

//ellenőrizzük, hogy kaptak-e értéket,
if (empty($osszeg) || empty($pontok)) {
    header("Location: profiloldal.php?error=kitoltes");
    exit();
} else {
    //adat tisztítása: karaktereket karakterkódokra cseréljük,
    $tiszta_osszeg = htmlspecialchars($osszeg);
    $tiszta_pontok = htmlspecialchars($pontok);

    //beszúrjuk a rekordot az adatbázisba
    $sikeres = vasarlas($tiszta_osszeg, $tiszta_pontok);

    if ($sikeres == false) {
        die("Nem sikerült felvinni a rekordot.");
    } else {
        //átlépünk a profiloldal.php-ra,
        header("Location: profiloldal.php?vasarlas=sikeres");
        exit();

    }
}
?>
