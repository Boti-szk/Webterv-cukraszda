<?php
session_start();
include_once "fuggvenyek.php";

//POST-tal lekérjük az átküldött adatokat,
$tipus = $_POST['category'];
$kategoria = $_POST['receptkategoriak'];
$nev = $_POST['receptnev'];
$hozzavalok = $_POST['hozzavalok'];
$elkeszites = $_POST['elkeszites'];

//ellenőrizzük, hogy kaptak-e értéket,
if ( empty($tipus) || empty($kategoria) || empty($nev) && trim($nev) !== "" || empty($hozzavalok)|| empty($elkeszites)) {
    header("Location: receptek.php?error=kitoltes");
    exit();
}
else {
    //adat tisztítása: karaktereket karakterkódokra cseréljük,
    $tiszta_tipus = htmlspecialchars($tipus);
    $tiszta_kategoria = htmlspecialchars($kategoria);
    $tiszta_nev = htmlspecialchars($nev);
    $tiszta_hozzavalok = htmlspecialchars($hozzavalok);
    $tiszta_elkeszites = htmlspecialchars($elkeszites);

    $feltoltotte = $_SESSION['nev'];

    //beszúrjuk a rekordot az adatbázisba
    $sikeres = recept_hozzaadas($tiszta_tipus, $tiszta_kategoria, $tiszta_nev, $tiszta_hozzavalok, $tiszta_elkeszites, $feltoltotte);

    if ( $sikeres == false ) {
        die("Nem sikerült felvinni a rekordot.");
    } else {
        //átlépünk a receptek.php-ra,
        header("Location: receptek.php?feltoltes=sikeres");
        exit();
    }
}

?>
