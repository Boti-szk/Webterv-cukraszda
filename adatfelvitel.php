<?php

include_once "fuggvenyek.php";

//POST-tal lekérjük az átküldött adatokat,
$nev = $_POST['nev'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$jelszo = $_POST['jelszo'];
$jelszo2 = $_POST['jelszo2'];
$nem = $_POST['nem'];
$kedvenc = $_POST['kedvenc'];
$szerepkor = $_POST['szerepkor'];

//ellenőrizzük, hogy kaptak-e értéket,
if ( empty($nev) && trim($nev) !== "" || empty($email) && trim($email) !== "" || empty($tel) && trim($tel) !== "" || empty($jelszo) && trim($jelszo) !== "" || empty($jelszo2) && trim($jelszo2) !== "" || empty($nem) || empty($kedvenc)) {
    header("Location: regisztracio.php?error=kitoltes");
    exit();
}
else {
	//adat tisztítása: karaktereket karakterkódokra cseréljük,
	$tiszta_nev = htmlspecialchars($nev);
	$tiszta_email = htmlspecialchars($email);
	$tiszta_tel = htmlspecialchars($tel);
	$tiszta_jelszo = htmlspecialchars($jelszo);
    $tiszta_jelszo2 = htmlspecialchars($jelszo2);
    $tiszta_nem = htmlspecialchars($nem);
    $tiszta_kedvenc = htmlspecialchars($kedvenc);
	$tiszta_szerepkor = htmlspecialchars($szerepkor);

	//beszúrjuk a rekordot az adatbázisba
	$sikeres = felhasznalot_beszur($tiszta_nev, $tiszta_email, $tiszta_tel, $tiszta_jelszo, $tiszta_jelszo2, $tiszta_nem, $tiszta_kedvenc, $tiszta_szerepkor);

	if ( $sikeres == false ) {
		die("Nem sikerült felvinni a rekordot.");
	} else {
		//átlépünk a bejelentkezes.php-ra,
		header("Location: bejelentkezes.php?regisztralt=sikeres");
		exit();
	}
}

?>
