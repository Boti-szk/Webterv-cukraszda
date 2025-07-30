<?php
session_start();
include_once "fuggvenyek.php";

//POST-tal lekérjük az átküldött adatokat,
$nev = $_POST['nev'];
$ertekeles = $_POST['ertekeles'];


//ellenőrizzük, hogy kaptak-e értéket,
if ( empty($ertekeles)) {
    header("Location: receptek.php?error=hiba");
    exit();
}

else {
    //adat tisztítása: karaktereket karakterkódokra cseréljük,
    $tiszta_nev = htmlspecialchars($nev);
    $tiszta_ertekeles = htmlspecialchars($ertekeles);


    //beszúrjuk a rekordot az adatbázisba
    $sikeres = ertekeles($tiszta_nev, $tiszta_ertekeles);

    if ( $sikeres == false ) {
        die("Nem sikerült felvinni a rekordot.");
    } else {
        //átlépünk a receptek.php-ra,
        header("Location: receptek.php?ertekelte=sikeres");
        exit();
    }
}
?>