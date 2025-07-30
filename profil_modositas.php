<?php
session_start();
include_once "fuggvenyek.php";

//POST-tal lekérjük az átküldött adatokat,
$nev = $_POST['nev'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$kedvenc = $_POST['kedvenc'];
$regi_nev = $_SESSION['nev'];

//ellenőrizzük, hogy kaptak-e értéket,
if ( empty($nev) && trim($nev) !== "" || empty($email) && trim($email) !== "" || empty($tel) && trim($tel) !== "" || empty($kedvenc)) {
    header("Location: profiloldal.php?error=profilkitoltes");
    exit();
}

else {
        //adat tisztítása: karaktereket karakterkódokra cseréljük,
        $tiszta_nev = htmlspecialchars($nev);
        $tiszta_email = htmlspecialchars($email);
        $tiszta_tel = htmlspecialchars($tel);
        $tiszta_kedvenc = htmlspecialchars($kedvenc);

        //beszúrjuk a rekordot az adatbázisba
        $sikeres = felhasznalot_modosit($regi_nev, $tiszta_nev, $tiszta_email, $tiszta_tel, $tiszta_kedvenc);

        if ( $sikeres == false ) {
            die("Nem sikerült felvinni a rekordot.");
        } else {
            //átlépünk a bejelentkezes.php-ra,
            header("Location: bejelentkezes.php?modosit=sikeres");
            exit();
        }
    }
?>