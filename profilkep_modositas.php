<?php
session_start();
include_once "fuggvenyek.php";

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
                    $felhasznalo_konyvtar = $img_mappa . $_SESSION["azonosito"] . "/";
                    if (!file_exists($felhasznalo_konyvtar)) {
                        mkdir($felhasznalo_konyvtar, 0777, true); // 0777: jogosultságok, true: rekurzív létrehozás
                    }
                    $eleresi_ut = $felhasznalo_konyvtar . $_FILES["fajlfeltoltes"]["name"];

                    // a fájl átmozgatása a cél útvonalra
                    if (move_uploaded_file($_FILES["fajlfeltoltes"]["tmp_name"], $eleresi_ut)) {
                        //adat tisztítása: karaktereket karakterkódokra cseréljük,

                        //beszúrjuk a rekordot az adatbázisba
                        $sikeres = kepet_modosit($eleresi_ut);

                        if ($sikeres == false) {
                            die("Nem sikerült felvinni a rekordot.");
                        } else {
                            header("Location: profiloldal.php?modosit=sikeres");
                            exit();
                        }
                    } else {
                        header("Location: profiloldal.php?error=hiba");
                        exit();
                    }
                } else {
                    header("Location: profiloldal.php?error=nagy");
                    exit();
                }
            } else {
                header("Location: profiloldal.php?error=hiba");
                exit();
            }
        } else {
            header("Location: profiloldal.php?error=kiterjesztes");
            exit();
        }
    }
    else{
        header("Location: profiloldal.php?error=ures");
        exit();
    }

?>
