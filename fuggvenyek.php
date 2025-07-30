<?php

function cukraszda_csatlakozas () {
    //csatlakozunk a kiválasztott adatbázishoz
    $conn = mysqli_connect("localhost", "root", "")
    or die("Csatlakozási hiba");
    if ( false == mysqli_select_db($conn, "CUKRASZDA") ) {
        return NULL;
    }

    //karakterkódolás beállítása az adatbázisban, a kimenetben és az adatbázis kapcsolatban,
    mysqli_query($conn, 'SET NAMES UTF8');
    mysqli_query($conn, 'SET character_set_results=utf8');
    mysqli_set_charset($conn, 'utf8');

    return $conn;
}





function felhasznalot_beszur($nev, $email, $tel, $jelszo, $jelszo2, $nem, $kedvenc, $szerepkor) {
   //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //jelszavak hosszának ellenőrzése
    if (strlen($jelszo) > 64 || strlen($jelszo2) > 64) {
        header("Location: regisztracio.php?error=jelszohossz");
        exit();
    }
    if (strlen($jelszo) < 8 || strlen($jelszo2) < 8){
        header("Location: regisztracio.php?error=jelszohossz2");
        exit();
    }

    //név hosszának ellenőrzése
    if (strlen($nev) > 100) {
        header("Location: regisztracio.php?error=nevhossz");
        exit();
    }

    //nem űrlaprész kitöltöttségének ellenőrzése
    if (empty($nem)){
        header("Location: regisztracio.php?error=nem");
        exit();
    }

    //jelszavak egyezőségének ellenőrzése
    if ($jelszo != $jelszo2){
        header("Location: regisztracio.php?error=nemegyezik");
        exit();
    }

    //email validáció
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: regisztracio.php?error=ervenytelen_email");
        exit();
    }

    // Telefonszám validáció
    if (!preg_match("/^\+36 (20|30|70) \d{7}$/", $tel)) {
        header("Location: regisztracio.php?error=ervenytelen_tel");
        exit();
    }

    // Ellenőrzés, hogy a felhasználónév már létezik-e az adatbázisban
    $stmt = mysqli_prepare( $conn, "SELECT * FROM FELHASZNALOK WHERE felhasznalonev = ?");
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "s", $nev);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: regisztracio.php?error=nev_letezik");
        exit();
    }

    // Ellenőrzés, hogy az email cím már létezik-e az adatbázisban
    $stmt = mysqli_prepare( $conn, "SELECT * FROM FELHASZNALOK WHERE email = ?");
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $email);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: regisztracio.php?error=email_letezik");
        exit();
    }

    // Ellenőrzés, hogy a telefonszám már létezik-e az adatbázisban
    $stmt = mysqli_prepare( $conn, "SELECT * FROM FELHASZNALOK WHERE telefonszam = ?");
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $tel);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: regisztracio.php?error=tel_letezik");
        exit();
    }

    //ha nincs megyunk tovább

    //Titkosítjuk a jelszót
    $titkosjelszo = password_hash($jelszo, PASSWORD_DEFAULT);
    //előkészítjük az utasítást,
    $stmt = mysqli_prepare( $conn, "INSERT INTO FELHASZNALOK(felhasznalonev, email, telefonszam, jelszo, nem, kedvenc, szerepkor) VALUES (?, ?, ?, ?, ?, ?, ?)");
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "sssssss",  $nev, $email, $tel, $titkosjelszo, $nem, $kedvenc, $szerepkor);
    //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
    $sikeres = mysqli_stmt_execute($stmt);
    //Ez adja vissza sikerült-e
    if ( $sikeres == false ) {
        die(mysqli_error($conn));
    }
    //adatbázis kapcsolat zárása
    mysqli_close($conn);
    return $sikeres;
}





function bejelentkezik($nev, $jelszo ) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //Lekérdezzük az adatokat a név alapján
    $stmt = mysqli_prepare( $conn, "SELECT * FROM FELHASZNALOK WHERE felhasznalonev = ?");
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "s", $nev);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if ( mysqli_num_rows($eredmeny) == 1 ) {

        //kigyűjtjük sorban az adatokat
        $adatok = mysqli_fetch_assoc($eredmeny);
        if ($adatok['felhasznalonev'] == $nev) {
            // a felhasználónév egyezik, ellenőrizzük a jelszót
            $titkosjelszo = $adatok['jelszo'];
            //összehasonlítjuk a tárolt-kódolt jelszót az űrlapban megadottal
            if (password_verify($jelszo, $titkosjelszo)) {
                //az azonosítót, a nevet és a szerepkört sessionbe tároljuk
                session_start();
                $_SESSION['azonosito'] = $adatok['azonosito'];
                $_SESSION['nev'] = $adatok['felhasznalonev'];
                $_SESSION['szerepkor'] = $adatok['szerepkor'];

                //utolsó belépés frissítése
                $sql = 'UPDATE FELHASZNALOK SET bejelentkezve = 1 WHERE felhasznalonev = "'.$_SESSION["nev"].'"';
                $stmt = mysqli_stmt_init($conn);
                //előkészíti a lekérdezést
                mysqli_stmt_prepare($stmt, $sql);
                //lefuttatjuk az SQL utasítást
                mysqli_stmt_execute($stmt);
                //lezárjuk az sql lekérzezést
                mysqli_stmt_close($stmt);

                return $adatok;
            } else {
                header("Location: bejelentkezes.php?error=jelszo_nemegyezik");
                exit();
            }
        }
    }
    else {
        header("Location: bejelentkezes.php?error=nev_nemegyezik");
        exit();
    }
}





function admin_ellenorzes ($nev, $kod) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //Lekérdezzük a kódot a táblából
    $stmt = mysqli_prepare( $conn, "SELECT * FROM ADMINKOD WHERE kod = ?");
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "s", $kod);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if ( mysqli_num_rows($eredmeny) == 1 ) {

        //Lekérdezzük az adatokat a név alapján
        $stmt = mysqli_prepare($conn, "SELECT * FROM FELHASZNALOK WHERE felhasznalonev = ?");
        //bekötjük a paramétereket
        mysqli_stmt_bind_param($stmt, "s", $nev);
        //lefuttatjuk az SQL utasítást
        mysqli_stmt_execute($stmt);
        //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
        $eredmeny2 = mysqli_stmt_get_result($stmt);
        //kigyűjtjük sorban az adatokat
        $adatok = mysqli_fetch_assoc($eredmeny2);
        //ellenőrizzük van-e benne adat
        if (mysqli_num_rows($eredmeny2) == 1) {
            //az azonosítót, a nevet és a szerepkört sessionbe tároljuk
            session_start();
            $_SESSION['azonosito'] = $adatok['azonosito'];
            $_SESSION['nev'] = $nev;
            $_SESSION['szerepkor'] = '1';

            // Felhasználói adatok módosítása
            $sql = 'UPDATE FELHASZNALOK SET bejelentkezve = 1, szerepkor = 1 WHERE felhasznalonev = "' . $_SESSION["nev"] . '"';
            $stmt = mysqli_stmt_init($conn);
            //előkészíti a lekérdezést
            mysqli_stmt_prepare($stmt, $sql);
            //lefuttatjuk az SQL utasítást
            mysqli_stmt_execute($stmt);
            //lezárjuk az sql lekérzezést
            mysqli_stmt_close($stmt);

            return true;
        } else {
            header("Location: admin.php?error=nincs_admin");
            exit();
        }
    }
    else{
        header("Location: admin.php?error=hibas");
        exit();
    }
}





function leiras_hozzaadas ($tipus, $kategoria, $nev, $leiras, $eleresi_ut) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //név hosszának ellenőrzése
    if (strlen($nev) > 100) {
        header("Location: leiras.php?error=nevhossz");
        exit();
    }

    //először ellenőrizzük, hogy van-e már a megadottal egyező név a táblában,
    $stmt = mysqli_prepare( $conn, 'SELECT * FROM TERMEKLEIRAS WHERE nev = ?');
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $nev);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: leiras.php?error=nev_letezik");
        exit();
    }

    //előkészítjük az utasítást,
    $stmt = mysqli_prepare( $conn, "INSERT INTO TERMEKLEIRAS(nev, tipus, kategoria, kep, leiras) VALUES (?, ?, ?, ?, ?)");
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "sssss", $nev, $tipus, $kategoria, $eleresi_ut, $leiras);
    //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
    $sikeres = mysqli_stmt_execute($stmt);
    //Ez adja vissza sikerült-e
    if ( $sikeres == false ) {
        die(mysqli_error($conn));
    }
    //adatbázis kapcsolat zárása
    mysqli_close($conn);
    return $sikeres;
}





function termek_hozzaadas ($tipus, $kategoria, $nev, $ar, $eleresi_ut) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //név hosszának ellenőrzése
    if (strlen($nev) > 100) {
        header("Location: termekek.php?error=nevhossz");
        exit();
    }

    //először ellenőrizzük, hogy van-e már a megadottal egyező név a táblában,
    $stmt = mysqli_prepare( $conn, "SELECT * FROM TERMEKEK WHERE nev = ?");
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $nev);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: termekek.php?error=nev_letezik");
        exit();
    }

    //előkészítjük az utasítást,
    $stmt = mysqli_prepare( $conn, "INSERT INTO TERMEKEK(nev, kep, ar, tipus, kategoria) VALUES (?, ?, ?, ?, ?)");
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "ssdss", $nev, $eleresi_ut, $ar, $tipus, $kategoria);
    //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
    $sikeres = mysqli_stmt_execute($stmt);
    //Ez adja vissza sikerült-e
    if ( $sikeres == false ) {
        die(mysqli_error($conn));
    }
    //adatbázis kapcsolat zárása
    mysqli_close($conn);
    return $sikeres;
}





function kosarba_rak($nev, $ar, $darab) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //kiszámoljuk a szükséges adatokat
    $kosar_ar = $ar * $darab;
    $kosar_darab = $darab;

    //először ellenőrizzük, hogy van-e már a megadottal egyező név és a sessionben tárolt azonosítóval megegyező azonosító a táblában,
    $stmt = mysqli_prepare( $conn, 'SELECT * FROM KOSAR WHERE nev = ? && felhasznalo_azonosito = "'.$_SESSION["azonosito"].'"');
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $nev);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //kiolvasás és eltárolás
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {

        // Kosár adatok módosítása
        $stmt = mysqli_prepare( $conn, "UPDATE KOSAR SET ar = ar + '$kosar_ar', darab = darab + '$kosar_darab' WHERE nev = '$nev'");
        //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
        $sikeres = mysqli_stmt_execute($stmt);
        //Ez adja vissza sikerült-e
        if ( $sikeres == false ) {
            die(mysqli_error($conn));
        }
        //adatbázis kapcsolat zárása
        mysqli_close($conn);
        return $sikeres;
    }

    else {
        //előkészítjük az utasítást,
        $stmt = mysqli_prepare($conn, "INSERT INTO KOSAR(nev, ar, darab, felhasznalo_azonosito) VALUES (?, ?, ?, ?)");
        //bekötjük a paramétereket
        mysqli_stmt_bind_param($stmt, "sddi", $nev, $kosar_ar, $kosar_darab, $_SESSION['azonosito']);
        //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
        $sikeres = mysqli_stmt_execute($stmt);
        //Ez adja vissza sikerült-e
        if ($sikeres == false) {
            die(mysqli_error($conn));
        }
        //adatbázis kapcsolat zárása
        mysqli_close($conn);
        return $sikeres;
    }
}





function felhasznalot_modosit ($regi_nev, $nev, $email, $tel, $kedvenc) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //név hosszának ellenőrzése
    if (strlen($nev) > 100) {
        header("Location: profiloldal.php?error=nevhossz");
        exit();
    }

    //email validáció
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: profiloldal.php?error=ervenytelen_email");
        exit();
    }

    // Telefonszám validáció
    if (!preg_match("/^\+36 (20|30|70) \d{7}$/", $tel)) {
        header("Location: profiloldal.php?error=ervenytelen_tel");
        exit();
    }

    // Ellenőrzés, hogy a felhasználónév már létezik-e az adatbázisban
    $stmt = mysqli_prepare( $conn, "SELECT * FROM FELHASZNALOK WHERE felhasznalonev = ?");
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $nev);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: profiloldal.php?error=nev_letezik");
        exit();
    }
    // Ellenőrzés, hogy a email cím már létezik-e az adatbázisban
    $stmt = mysqli_prepare( $conn, "SELECT * FROM FELHASZNALOK WHERE email = ?");
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $email);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: profiloldal.php?error=email_letezik");
        exit();
    }
    // Ellenőrzés, hogy a telefonszám már létezik-e az adatbázisban
    $stmt = mysqli_prepare( $conn, "SELECT * FROM FELHASZNALOK WHERE telefonszam = ?");
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $tel);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: profiloldal.php?error=tel_letezik");
        exit();
    }

    //ha nincs megyunk tovább

    //előkészítjük az utasítást,
    $stmt = mysqli_prepare( $conn, "UPDATE felhasznalok SET felhasznalonev = ?, email = ?, telefonszam = ?, kedvenc = ? WHERE felhasznalonev = '$regi_nev'");
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "ssss",  $nev, $email, $tel, $kedvenc);
    //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
    $sikeres = mysqli_stmt_execute($stmt);
    //Ez adja vissza sikerült-e
    if ( $sikeres == false ) {
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $sikeres;
}





function kepet_modosit ($eleresi_ut) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //előkészítjük az utasítást,
    $stmt = mysqli_prepare( $conn, 'UPDATE felhasznalok SET  kep_eleres = ? WHERE felhasznalonev = "' . $_SESSION["nev"] . '"');
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "s",   $eleresi_ut);
    //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
    $sikeres = mysqli_stmt_execute($stmt);
    //Ez adja vissza sikerült-e
    if ( $sikeres == false ) {
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $sikeres;
}





function befizetes($osszeg) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //előkészítjük az utasítást,
    $stmt = mysqli_prepare( $conn, 'UPDATE FELHASZNALOK SET egyenleg = egyenleg + '.$osszeg.' WHERE felhasznalonev = "'.$_SESSION["nev"].'"');
    //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
    $sikeres = mysqli_stmt_execute($stmt);
    //Ez adja vissza sikerült-e
    if ( $sikeres == false ) {
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $sikeres;
}





function vasarlas ($osszeg, $pontok){
    //kapcsolódás az adatbázishoz
    if (!($conn = cukraszda_csatlakozas())) {
        return false;
    }

    //kilistázzuk a sessionben tárolt azonosítóval megegyező sort a felhasznalok táblából
    $stmt = mysqli_prepare($conn, 'SELECT * FROM FELHASZNALOK WHERE azonosito = "' . $_SESSION["azonosito"] . '"');
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //asszociatív tömbbe eltárolja az adatokat
    $row = mysqli_fetch_assoc($eredmeny);
    $egyenleg = $row['egyenleg'];

    //megnézzük elegendő-e az egyenleg
    if ($egyenleg < $osszeg) {
        header("Location: profiloldal.php?vasarlas=sikertelen");
        exit();
    } else {

        //frissítjük a felhasznalok táblát a megadott szempontokkal
        $stmt = mysqli_prepare($conn, 'UPDATE FELHASZNALOK SET egyenleg = egyenleg - ' . $osszeg . ', pontok = pontok + ' . $pontok . ' WHERE azonosito = "' . $_SESSION["azonosito"] . '"');
        //lefuttatjuk az SQL utasítást
        mysqli_stmt_execute($stmt);

        //töröljük a kosar táblából a felhasználóhoz kapcsolódó adatokat
        $stmt = mysqli_prepare($conn, 'DELETE FROM  KOSAR WHERE felhasznalo_azonosito = "' . $_SESSION["azonosito"] . '"');
        //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
        $sikeres = mysqli_stmt_execute($stmt);
        //Ez adja vissza sikerült-e
        if ($sikeres == false) {
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $sikeres;
    }
}





function recept_hozzaadas ($tipus, $kategoria, $nev, $hozzavalok, $elkeszites, $feltoltotte) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //név hosszának ellenőrzése
    if (strlen($nev) > 100) {
        header("Location: receptek.php?error=nevhossz");
        exit();
    }

    //először ellenőrizzük, hogy van-e már a megadottal egyező név a táblában,
    $stmt = mysqli_prepare( $conn, "SELECT * FROM RECEPTEK WHERE nev = ?");
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $nev);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: receptek.php?error=nev_letezik");
        exit();
    }

    //előkészítjük az utasítást
    $stmt = mysqli_prepare( $conn, "INSERT INTO RECEPTEK(tipus, kategoria, nev, hozzavalok, elkeszites, feltoltotte) VALUES (?, ?, ?, ?, ?, ?)");
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "ssssss", $tipus, $kategoria, $nev, $hozzavalok, $elkeszites, $feltoltotte);
    //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
    $sikeres = mysqli_stmt_execute($stmt);
    //Ez adja vissza sikerült-e
    if ( $sikeres == false ) {
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $sikeres;
}





function ertekeles ($nev, $ertekeles) {
    //kapcsolódás az adatbázishoz
    if ( !($conn = cukraszda_csatlakozas()) ) {
        return false;
    }

    //először ellenőrizzük, hogy van-e már a megadottal egyező név a táblában,
    $stmt = mysqli_prepare( $conn, "SELECT azonosito, ertekeles, darab FROM RECEPTEK WHERE nev = ?");
    //bekötjük a aparamétereket
    mysqli_stmt_bind_param($stmt, "s", $nev);
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //asszociatív tömbben tároljuk
    $row = mysqli_fetch_assoc($eredmeny);
    $regi_ertekeles = $row['ertekeles'];
    $regi_darab = $row['darab'];
    $azonosito = $row['azonosito'];

    //először ellenőrizzük, hogy van-e már a sessionben tárolt azonosítóval és termék azonositoval megegyező azonositok a táblában,
    $stmt = mysqli_prepare( $conn, 'SELECT * FROM ERTEKELES WHERE ki = "' . $_SESSION["azonosito"] . '" AND mit = "' . $azonosito . '"');
    //lefuttatjuk az SQL utasítást
    mysqli_stmt_execute($stmt);
    //egy eredmény halmazt adunk vissza, amit el is tárolunk egy változóban
    $eredmeny = mysqli_stmt_get_result($stmt);
    //ellenőrizzük van-e benne adat
    if (mysqli_num_rows($eredmeny) > 0) {
        header("Location: receptek.php?error=ertekelte");
        exit();
    }

    //kiszámoljuk a szükséges adatokat
    $uj_darab = $regi_darab +1;
    $uj_ertekeles = (($regi_ertekeles * $regi_darab) + $ertekeles) / $uj_darab;

    //előkészítjük az utasítást,
    $stmt = mysqli_prepare( $conn, "UPDATE RECEPTEK SET ertekeles = '$uj_ertekeles', darab = '$uj_darab' WHERE nev = '$nev'");
    //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
    mysqli_stmt_execute($stmt);

    //előkészítjük az utasítást,
    $stmt = mysqli_prepare( $conn, "INSERT INTO ERTEKELES(ki, mit) VALUES (?, ?)");
    //bekötjük a paramétereket
    mysqli_stmt_bind_param($stmt, "ii", $_SESSION["azonosito"], $azonosito);
    //lefuttatjuk az SQL utasítást(kiolvasás és eltárolas),
    $sikeres = mysqli_stmt_execute($stmt);
    //Ez adja vissza sikerült-e
    if ( $sikeres == false ) {
        die(mysqli_error($conn));
    }
    //adatbázis kapcsolat zárása
    mysqli_close($conn);
    return $sikeres;
}
