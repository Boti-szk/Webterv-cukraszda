<?php
//session leállítása
session_start();
include("fuggvenyek.php");

//kapcsolódás az adatbázishoz
if ( !($conn = cukraszda_csatlakozas()) ) {
    exit ();
}
//POST-tal lekérjük az átküldött adatokat,
$nev = $_POST['nev'];

//ellenőrizzük, hogy kaptak-e értéket,
if (empty($nev) && trim($nev) !== "") {
    header("Location: profiloldal.php?error=kosarkitoltes");
    exit();
} else {
//töröljük a kosárba a megadott nev és felhasznalo_azonositoval rendelkező sort
    $sql = 'DELETE FROM KOSAR WHERE nev = "' . $nev . '" AND felhasznalo_azonosito = "' . $_SESSION["azonosito"] . '"';
    $stmt = mysqli_stmt_init($conn);
//előkészítjük, végrehajtjuk majd bezárjuk
    mysqli_stmt_prepare($stmt, $sql);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //lezárjuk az utasítást
    mysqli_stmt_close($stmt);

//visszalepünk a profiloldal.php-ra
    header("Location:profiloldal.php?eltavolitotta=sikeres");
}
?>