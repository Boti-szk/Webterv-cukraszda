<?php
session_start();
include("fuggvenyek.php");

//POST-tal lekérjük az átküldött adatokat,
$osszeg = $_POST['osszeg'];

//ellenőrizzük, hogy kaptak-e értéket,
if ( empty($osszeg) ) {
    header("Location: profiloldaL.php?error=osszeg");
    exit();
}
else {
    //adat tisztítása: karaktereket karakterkódokra cseréljük,
    $tiszta_osszeg = htmlspecialchars($osszeg);
    //beszúrjuk a rekordot az adatbázisba
    $sikeres = befizetes($tiszta_osszeg);

    if ( $sikeres == false ) {
        die("Nem sikerült felvinni a rekordot.");
    } else {
        //visszalépünk a profiloldal.php-ra,
        header("Location: profiloldal.php?befizetve=sikeres");
        exit();
    }
}

?>
