<?php
//session leállítása
session_start();
include("fuggvenyek.php");

if ( !($conn = cukraszda_csatlakozas()) ) {
//ha nem sikerül csatlakozni kilépünk,
exit ();
}
//átállítjuk a bejelentkezés állapotát a sessionbe tárolt személynél
$sql = 'DELETE FROM FELHASZNALOK  WHERE felhasznalonev = "'.$_SESSION["nev"].'"';
//statement objektum inivializálása
$stmt = mysqli_stmt_init($conn);
//előkészítjük, végrehajtjuk majd bezárjuk
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);


//töröljük a sessiont
session_destroy();
session_unset();

//visszalepünk a regisztracio.php-ra
header("Location:regisztracio.php?torolt=sikeres");

?>
