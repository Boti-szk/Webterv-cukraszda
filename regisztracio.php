<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/regisztracio_bejelentkezes.css">
  <link rel="icon" type="img/png" href="img/menuLight.png">
  <style>
    #table1 {
      border: 3px solid honeydew;
      margin: auto;
      border-collapse: collapse;
      min-width: 600px;
      min-height: 60px;
    }

    #profiltablazat{
      margin-top: 10px;
    }

    td label{
        font-size: 20px;
        margin: 10px;
        min-width: fit-content;
    }

    @media only screen and (max-width: 768px) {
        input, select {
            font-size: 15px;
            width: fit-content;
        }

        td label{
            min-width: fit-content;
        }

        .infok {
            width: 80%;
            text-align: center;
        }
    }
  </style>
  <title>Regisztráció</title>
</head>
<body>
<main id="fooldal">
  <h1>Sweet candy cukrászda</h1>
  <table id="table1">
    <tr>
        <td class="menu"><a class="link" href="bejelentkezes.php"><img src="img/login.png" alt="bejelentkezés" width="22">Bejelentkezés</a></td>
        <td class="menu"><a class="link" href="regisztracio.php"><img  src="img/view-details.png" alt="regisztráció" width="22">Regisztráció</a></td>
        <td class="menu"><a class="link" href="admin.php"><img src="img/key.png" alt="admin" width="22">Admin</a></td>
    </tr>
  </table>

  <header>
      Regisztráció
      <?php
      // Hibaüzenetek
      if (isset($_GET["torolt"]) && $_GET["torolt"] === "sikeres") {
          echo '<p style="color: rgb(70,148,0); font-size: 20px; margin-left: 8%; display: inline-block">Sikeresen törölte a fiókját!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "kitoltes") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Nem töltött ki minden mezőt!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "jelszohossz") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Túl hosszú jelszót adott meg!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "jelszohossz2") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Túl rövid jelszót adott meg!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "nevhossz") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Túl hosszú felhasználónevet adott meg!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "nem") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">Nem választott nemet!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "nemegyezik") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A két jelszó nem egyezik!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "nev_letezik") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott felhasználónévvel már van regisztrált fiók!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "email_letezik") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott email címmel már van regisztrált fiók!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "tel_letezik") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott telefonszámmal már van regisztrált fiók!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "ervenytelen_email") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott email nem megfelelő formátumú!</p>';
      }
      if (isset($_GET["error"]) && $_GET["error"] === "ervenytelen_tel") {
          echo '<p style="color: red; font-size: 20px; margin-left: 10%; display: inline-block">A megadott telefonszám nem megfelelő formátumú!</p>';
      }
      ?>
  </header>
  <section id="adatok">
      <form method="post" action="adatfelvitel.php">
      <label for="nev">Felhasználói név: </label>
        <input id="nev" name="nev" required type="text" placeholder="Max 100 karakter!">
      <br>
      <label for="email">E-mail cím: </label>
        <input id="email" name="email" required type="email" placeholder="pl. minta@minta.com">
      <br>
      <label for="tel">Telefonszám: </label>
        <input id="tel" name="tel" required type="tel" placeholder="pl.+36 20/30/70 1234567">
      <br>
      <label for="jelszo">Jelszó: </label>
        <input id="jelszo" name="jelszo" required type="password" placeholder="Min 8 és max 64 karakter!">
      <br>
      <label for="jelszo2">Jelszó újra: </label>
        <input id="jelszo2" name="jelszo2" required  type="password" placeholder="Min 8 és max 64 karakter!">
      <br>
      <table id="profiltablazat">
      <tr>
        <td>Neme: </td>
          <td><label for="ferfi">Férfi <input id="ferfi" type="radio" name="nem" value="ferfi"></label></td>
          <td><label for="no">Nő <input id="no" type="radio" name="nem" value="no"></label></td>
          <td><label for="nemadommeg">Nem akarom megadni <input id="nemadommeg" type="radio" name="nem" value="egyeb" required></label></td>
      </tr>
      </table>
      <br>
         <label for="kedvenc">Kedvenc desszertjeim:</label>
         <select name="kedvenc" id="kedvenc">
          <option value="edes" selected>Édes sütemények</option>
          <option value="sos">Sós sütemények</option>
        </select>
          <input type="hidden" name="szerepkor" value="0">
      <br>
        <input id="button" type="submit" name="regisztracio" value="Regisztráció">
  </form>
  </section>

    <footer>
        <section class="infok">
            <h2><img src="img/open.png" alt="naptár" width="25"> Nyitvatartás: </h2>
            <h4>Minden cukrászdánk azonos nyitvatartással rendelkezik!</h4>
            <p>Hétfő: 6:00 - 18:00</p>
            <p>Kedd: 6:00 - 18:00</p>
            <p>Szerda: 6:00 - 18:00</p>
            <p>Csütörtök: 6:00 - 18:00</p>
            <p>Péntek: 6:00 - 18:00</p>
            <p>Szombat: 8:00 - 20:00</p>
            <p>Vasárnap: ZÁRVA</p>

            <h2>Elérhetőségek:</h2>
            <p><img  src="img/tel.png" alt="telefon" width="25">  Tel.: +36 1 234 5678</p>
            <p><img  src="img/mail.png" alt="email" width="25">  E-mail: info@cukraszda.hu</p>
        </section>

        <aside class="infok">
            <h2><img  src="img/uzlet.png" alt="üzlet" width="25">  Üzleteink: </h2>
            <h4>Látogasson el hozzánk személyesen is!</h4>
            <ol><li>Budapest:</li></ol>
            <ul>
                <li>Deák Ferenc tér 4.</li>
                <li>Kossuth Lajos utca 12.</li>
                <li>Váci út 1.</li>
            </ul>
            <ol><li>Szeged:</li></ol>
            <ul>
                <li>Kálvin tér 10.</li>
                <li>Római krt. 2.</li>
                <li>Tisza Lajos krt. 15.</li>
            </ul>
            <ol><li>Debrecen:</li></ol>
            <ul>
                <li>Kossuth tér 5.</li>
                <li>Egyetem tér 1.</li>
                <li>Petőfi tér 8.</li>
            </ul>
        </aside>
    </footer>
</main>
</body>
</html>