<?php
//session  indítása
session_start();
include("fuggvenyek.php");

//kapcsolódás az adatbázishoz
if ( !($conn = cukraszda_csatlakozas()) ) {
    exit ();
}
//átállítjuk a bejelentkezés állapotát a sessionbe tárolt személynél
$sql = 'UPDATE FELHASZNALOK SET bejelentkezve = 0 WHERE felhasznalonev = "'.$_SESSION["nev"].'"';
$stmt = mysqli_stmt_init($conn);
//előkészíti a lekérdezést
mysqli_stmt_prepare($stmt, $sql);
//lefuttatjuk az SQL utasítást
mysqli_stmt_execute($stmt);
//lezárjuk az sql lekérzezést
mysqli_stmt_close($stmt);

//töröljük a sessiont
session_destroy();
session_unset();

//visszalepünk a bejelentkezes.php-ra
header("Location:bejelentkezes.php?kijelentkezett=sikeres");

?>