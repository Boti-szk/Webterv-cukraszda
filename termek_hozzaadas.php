<?php
session_start();
include_once "fuggvenyek.php";

//POST-tal lekérjük az átküldött adatokat,
$tipus = $_POST['category'];
$kategoria = $_POST['termekkategoriak'];
$nev = $_POST['nev'];
$ar = $_POST['ar'];

//ellenőrizzük, hogy kaptak-e értéket,
if (empty($kategoria)|| empty($kategoria)|| empty($nev) && trim($nev) !== "" || empty($ar)) {
    header("Location: leiras.php?error=kitoltes");
    exit();
}
else {
    if (isset($_FILES["fajlfeltoltes"])) {
        // csak JPG, JPEG és PNG kiterjesztésű képeket szeretnénk engedélyezni a feltöltéskor
        $engedelyezett_kiterjesztesek = ["jpg", "jpeg", "png"];

        // a feltöltött fájl kiterjesztésének lekérdezése
        $kiterjesztes = strtolower(pathinfo($_FILES["fajlfeltoltes"]["name"], PATHINFO_EXTENSION));

        // ha a fájl kiterjesztése szerepel az engedélyezett kiterjesztések között...
        if (in_array($kiterjesztes, $engedelyezett_kiterjesztesek)) {
            // ha a fájl feltöltése sikeresen megtörtént...
            if ($_FILES["fajlfeltoltes"]["error"] === 0) {
                // ha a fájlméret nem nagyobb 30 MB-nál...
                if ($_FILES["fajlfeltoltes"]["size"] <= 31457280) {
                    // a cél útvonal összeállítása
                    $img_mappa = "img/";
                    $eleresi_ut = $img_mappa . $_FILES["fajlfeltoltes"]["name"];

                    // a fájl átmozgatása a cél útvonalra
                    if (move_uploaded_file($_FILES["fajlfeltoltes"]["tmp_name"], $eleresi_ut)) {
                        //adat tisztítása: karaktereket karakterkódokra cseréljük,
                        $tiszta_tipus = htmlspecialchars($tipus);
                        $tiszta_kategoria = htmlspecialchars($kategoria);
                        $tiszta_nev = htmlspecialchars($nev);
                        $tiszta_ar = htmlspecialchars($ar);

                        //beszúrjuk a rekordot az adatbázisba
                        $sikeres = termek_hozzaadas($tiszta_tipus, $tiszta_kategoria, $tiszta_nev, $tiszta_ar, $eleresi_ut);

                        if ( $sikeres == false ) {
                            die("Nem sikerült felvinni a rekordot.");
                        } else {
                            header("Location: termekek.php?hozzaad=sikeres");
                            exit();
                        }
                    } else {
                        header("Location: termekek.php?error=hiba");
                        exit();
                    }
                } else {
                    header("Location: termekek.php?error=nagy");
                    exit();
                }
            } else {
                header("Location: termekek.php?error=hiba");
                exit();
            }
        } else {
            header("Location: termekek.php?error=kiterjesztes");
            exit();
        }
    }
}
?>