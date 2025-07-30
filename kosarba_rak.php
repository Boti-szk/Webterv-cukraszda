<?php
include_once "fuggvenyek.php";

session_start();

//POST-tal lekérjük az átküldött adatokat,
    $nev = $_POST['nev'];
    $ar = $_POST['ar'];
    $darab = $_POST['darab'];

//ellenőrizzük, hogy kaptak-e értéket,
    if (empty($nev) && trim($nev) !== "" || empty($ar) || empty($darab)) {
        header("Location: termekek.php?error=kitoltes");
        exit();
    } else {
        //adat tisztítása: karaktereket karakterkódokra cseréljük,
        $tiszta_nev = htmlspecialchars($nev);
        $tiszta_ar = htmlspecialchars($ar);
        $tiszta_darab = htmlspecialchars($darab);


        //beszúrjuk a rekordot az adatbázisba
        $sikeres = kosarba_rak($tiszta_nev, $tiszta_ar, $tiszta_darab);

        if ($sikeres == false) {
            die("Nem sikerült felvinni a rekordot.");
        } else {
            //átlépünk a bejelentkezes.php-ra,
            header("Location: termekek.php?kosarba=sikeres");
            exit();

        }
    }
?>
