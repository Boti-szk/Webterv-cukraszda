-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 21. 18:42
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `cukraszda`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adminkod`
--

CREATE TABLE `adminkod` (
  `kod` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `adminkod`
--

INSERT INTO `adminkod` (`kod`) VALUES
('0123456789');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekeles`
--

CREATE TABLE `ertekeles` (
  `ki` int(11) DEFAULT NULL,
  `mit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `ertekeles`
--

INSERT INTO `ertekeles` (`ki`, `mit`) VALUES
(NULL, 2),
(17, 2),
(17, 3),
(17, 4),
(17, 5),
(17, 6),
(17, 7),
(18, 3),
(18, 4),
(18, 7),
(19, 2),
(19, 3),
(19, 5),
(19, 6),
(NULL, 104);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `azonosito` int(11) NOT NULL,
  `felhasznalonev` varchar(100) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `telefonszam` varchar(100) NOT NULL,
  `jelszo` varchar(100) NOT NULL,
  `nem` varchar(100) NOT NULL,
  `kedvenc` varchar(50) NOT NULL,
  `szerepkor` varchar(20) NOT NULL,
  `bejelentkezve` tinyint(1) NOT NULL,
  `egyenleg` decimal(20,0) NOT NULL,
  `pontok` decimal(20,1) NOT NULL,
  `kep_eleres` blob NOT NULL DEFAULT '\\img/profil.png\\'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`azonosito`, `felhasznalonev`, `email`, `telefonszam`, `jelszo`, `nem`, `kedvenc`, `szerepkor`, `bejelentkezve`, `egyenleg`, `pontok`, `kep_eleres`) VALUES
(1, 'admin', '', '', '', '', '', '1', 0, 0, 0.0, 0x5c696d672f70726f66696c2e706e675c),
(16, 'Csanadi', 'csanadia@gmail.com', '+36 20 2346782', '$2y$10$oGTZyRYRYgOKTEft1qkH.ebopEPhaoPimy9XCYIuI4HQaGaWCUXl2', 'ferfi', 'edes', '0', 0, 0, 0.0, 0x5c696d672f70726f66696c2e706e675c),
(17, 'Kovács István', 'kovacsistvan@gmail.com', '+36 30 1234435', '$2y$10$Vhg/lr7.WWeBeDbXI.Xjge3Wio3QOUYX15wPKXdYoJA7crmv8fLBO', 'ferfi', 'sos', '0', 0, 0, 0.0, 0x5c696d672f70726f66696c2e706e675c),
(18, 'Vas Kinga', 'vaskinga@gmail.com', '+36 20 3734665', '$2y$10$9SXrpdSxVV3h6LNlwkGLtue0JBhgnothTWWYeU.w5uKiF0t5ERVHa', 'no', 'edes', '0', 0, 500, 10.0, 0x5c696d672f70726f66696c2e706e675c),
(19, 'Faragó Zoltán', 'zoltanfarago@gmail.com', '+36 70 3287823', '$2y$10$uc4wg6EbbVDvm8V4Dm4zh.T2rLfdkycoknWEraRI6c7vzOM6.Disi', 'ferfi', 'edes', '0', 0, 0, 0.0, 0x5c696d672f70726f66696c2e706e675c),
(20, 'Cifra Konrád', 'konradcifra@gmail.com', '+36 30 4456591', '$2y$10$Mdz6vX7jK7MNzR2.V5B5se9QDnt8qLX29DDqENWT7sVq/W3iwpHa6', 'egyeb', 'sos', '0', 0, 0, 0.0, 0x5c696d672f70726f66696c2e706e675c),
(21, 'Eszenyi Borbála', 'borbalaeszenyi@gmail.com', '+36 30 2202020', '$2y$10$Y6UB0.ks88A39SV0DQHFr.BjBMgdS7cB/x6p4Nnb8VjRsGujY2uQa', 'no', 'edes', '0', 0, 0, 0.0, 0x5c696d672f70726f66696c2e706e675c),
(22, 'Vésnök Márton', 'vesnokmarton@gmail.com', '+36 70 4403200', '$2y$10$HEMkVl5567egOtcY0QANcuFUKrUcleCXEX4qGt8.dyEcYLaV/XcVO', 'ferfi', 'sos', '0', 0, 0, 0.0, 0x5c696d672f70726f66696c2e706e675c);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kosar`
--

CREATE TABLE `kosar` (
  `azonosito` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `ar` varchar(100) NOT NULL,
  `darab` decimal(10,0) NOT NULL DEFAULT 1,
  `felhasznalo_azonosito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `kosar`
--

INSERT INTO `kosar` (`azonosito`, `nev`, `ar`, `darab`, `felhasznalo_azonosito`) VALUES
(14, 'Vajas Kifli', '60000', 1000, 18),
(19, 'Sajtos Kifli', '140', 2, 17);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `receptek`
--

CREATE TABLE `receptek` (
  `azonosito` int(11) NOT NULL,
  `tipus` varchar(100) NOT NULL,
  `kategoria` varchar(100) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `hozzavalok` text NOT NULL,
  `elkeszites` text NOT NULL,
  `feltoltotte` varchar(100) NOT NULL,
  `ertekeles` decimal(10,2) DEFAULT NULL,
  `darab` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `receptek`
--

INSERT INTO `receptek` (`azonosito`, `tipus`, `kategoria`, `nev`, `hozzavalok`, `elkeszites`, `feltoltotte`, `ertekeles`, `darab`) VALUES
(2, 'sos', '2pugacsa', 'Sajtos pogácsa', '250 g vaj vagy margarin\r\n250 g reszelt sajt (pl. trappista)\r\n500 g liszt\r\n2 tojássárgája\r\n1 teáskanál só\r\n1 csomag sütőpor\r\n1 dl tejföl', 'A vajat vagy margarint és a lisztet morzsoljuk össze egy tálban. Adjuk hozzá a reszelt sajtot, a tojássárgáját, a sót, a sütőport és a tejfölt. Gyúrjuk össze a tésztát, majd tegyük hűtőbe legalább fél órára. Miután a tészta kihűlt, nyújtsuk ki kb. 1 cm vastagra. Vágjunk ki belőle különböző formákat (pl. pogácsaszaggatóval), majd helyezzük őket sütőpapírral bélelt tepsibe. Kenjük meg a tetejüket felvert tojással. Előmelegített sütőben süssük 180 fokon kb. 15-20 percig, vagy amíg aranybarnák lesznek. Miután megsültek, hagyjuk őket kihűlni egy kicsit, majd tálaljuk.', 'admin', 6.67, 3),
(3, 'sos', '2pugacsa', 'Túrós pogácsa', '\r\n50 dkg liszt\r\n25 dkg vaj vagy margarin\r\n25 dkg túró\r\n1 tojás\r\n1 csomag sütőpor\r\nSó ízlés szerint\r\nReszelt sajt a tetejére', '\r\nA lisztet összekeverjük a sütőporral és a sóval.\r\nHozzáadjuk a vajat vagy margarint, majd összemorzsoljuk.\r\nBelekeverjük a túrót és a tojást, majd jól összedolgozzuk.\r\nA tésztát letakarva pihentetjük 30 percig.\r\nLisztezett felületen kinyújtjuk, majd pogácsaszaggatóval kiszaggatjuk.\r\nA kiszaggatott pogácsákat tojással megkenjük, majd reszelt sajttal megszórjuk.\r\nElőmelegített sütőben 180 fokon kb. 20 perc alatt aranybarnára sütjük.\r\n', 'Kovács István', 5.00, 3),
(4, 'sos', '2pugacsa', 'Hajtogatott tepertős pogácsa', '\r\n50 dkg liszt\r\n25 dkg vaj vagy margarin\r\n2 dl tej\r\n1 csomag sütőpor\r\n20 dkg tepertő\r\n1 tojás\r\nSó ízlés szerint\r\nReszelt sajt a tetejére', '\r\nA lisztet összekeverjük a sütőporral és a sóval.\r\nHozzáadjuk a vajat vagy margarint, majd összemorzsoljuk.\r\nBeleöntjük a tejet, majd jól összedolgozzuk.\r\nA tésztát letakarva pihentetjük 30 percig.\r\nLisztezett felületen kinyújtjuk, majd háromszor hajtogatjuk össze.\r\nIsmét pihentetjük 30 percig.\r\nKinyújtjuk, és pogácsaszaggatóval kiszaggatjuk.\r\nA kiszaggatott pogácsákat tojással megkenjük, majd reszelt sajttal és tepertővel megszórjuk.\r\nElőmelegített sütőben 180 fokon kb. 20 perc alatt aranybarnára sütjük.\r\n', 'Kovács István', 9.50, 2),
(5, 'sos', '2pugacsa', 'Köményes pogácsa', '\r\n50 dkg liszt\r\n20 dkg vaj\r\n2 dl tej\r\n2 dkg élesztő\r\n1 teáskanál cukor\r\n2 teáskanál só\r\n2 tojás (1 a tésztába, 1 a kenéshez)\r\n2 teáskanál őrölt kömény\r\n', '\r\nAz élesztőt a langyos tejben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót, a vajat, az élesztős tejet és összegyúrjuk.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, kifliket formázunk, és tojással megkenjük.\r\nMegszórjuk őrölt köménnyel.\r\n200 fokon 15-20 percig sütjük.\r\n', 'Vas Kinga', 6.00, 2),
(6, 'sos', '2pugacsa', 'Pizzás pogácsa', '\r\n50 dkg liszt\r\n25 dkg margarin\r\n2 dl tej\r\n2 dkg élesztő\r\n1 teáskanál cukor\r\n2 teáskanál só\r\n2 tojás (1 a tésztába, 1 a kenéshez)\r\n10 dkg sonka\r\n10 dkg sajt\r\n2 evőkanál paradicsompüré', '\r\nAz élesztőt a langyos tejben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót, a margarint, az élesztős tejet és összegyúrjuk.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, kiszaggatjuk.\r\nA tetejét megkenjük paradicsompürével, rátesszük a sonkát és a sajtot.\r\nTojással megkenjük.\r\n200 fokon 20 percig sütjük.', 'Vas Kinga', 3.00, 2),
(7, 'sos', '2pugacsa', 'Fokhagymás pogácsa', '\r\n50 dkg liszt\r\n25 dkg vaj\r\n2 dl tej\r\n2 dkg élesztő\r\n1 teáskanál cukor\r\n2 teáskanál só\r\n2 tojás (1 a tésztába, 1 a kenéshez)\r\n3 gerezd zúzott fokhagyma', '\r\nAz élesztőt a langyos tejben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót, a vajat, az élesztős tejet és összegyúrjuk.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, kiszaggatjuk.\r\nA tetejét megkenjük tojással, megszórjuk zúzott fokhagymával.\r\n180 fokon 20 percig sütjük.', 'Faragó Zoltán', 7.50, 2),
(8, 'sos', '2kifli', 'Békebeli ropogós kifli', 'Hozzávalók:\r\n50 dkg liszt\r\n2 teáskanál só\r\n2 dkg élesztő\r\n1 nagy evőkanál tejföl\r\n2 dl tej\r\n1 dl víz', '\r\nA tejet és a vizet összeöntjük és elkeverjük benne a tejfölt, majd meglangyosítjuk.\r\nA lisztbe belekeverjük a sót, a közepébe mélyedést készítünk, ahova belemorzsoljuk az élesztőt és beleöntjük a langyos tejfölös keveréket.\r\nAz egészet összegyúrjuk és kidagasztjuk a kifli tésztáját.\r\n40-45 percet kelesztjük, kifliket formázunk, és 220 fokon 10-15 percig sütjük', 'Faragó Zoltán', NULL, NULL),
(9, 'sos', '2kifli', 'Gyors házi kifli', '\r\n50 dkg liszt\r\n2 dkg élesztő\r\n2 dl tej\r\n1 teáskanál cukor\r\n1 teáskanál só\r\n1 tojás\r\n5 dkg vaj', '\r\nAz élesztőt a langyos tejben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót és a vajat, majd az élesztős tejet és összegyúrjuk.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, kifliket formázunk, és 180 fokon 20 percig sütjük', 'Faragó Zoltán', NULL, NULL),
(10, 'sos', '2kifli', 'Szezámmagos kifli', '\r\n50 dkg liszt\r\n2 dkg élesztő\r\n2 dl tej\r\n1 teáskanál cukor\r\n1 teáskanál só\r\n1 tojás\r\n5 dkg vaj\r\nSzezámmag a szóráshoz', '\r\nAz élesztőt a langyos tejben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót és a vajat, majd az élesztős tejet és összegyúrjuk.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, kifliket formázunk, megszórjuk szezámmaggal, és 180 fokon 20 percig sütjük\r\n', 'Vas Kinga', NULL, NULL),
(11, 'sos', '2kifli', 'Sörkifli', '\r\n50 dkg liszt\r\n2 dkg élesztő\r\n2 dl sör\r\n1 teáskanál cukor\r\n1 teáskanál só\r\n1 tojás\r\n5 dkg vaj', '\r\nAz élesztőt a langyos sörben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót és a vajat, majd az élesztős sört és összegyúrjuk.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, kifliket formázunk, és 180 fokon 20 percig sütjük\r\n', 'Vas Kinga', NULL, NULL),
(12, 'sos', '2kifli', 'Sonkás kifli', '\r\n50 dkg liszt\r\n2 dkg élesztő\r\n2 dl tej\r\n1 teáskanál cukor\r\n1 teáskanál só\r\n1 tojás\r\n5 dkg vaj\r\n10 dkg sonka apróra vágva', '\r\nAz élesztőt a langyos tejben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót és a vajat, majd az élesztős tejet és összegyúrjuk.\r\nA sonkát is belekeverjük a tésztába.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, kifliket formázunk, és 180 fokon 20 percig sütjük\r\n\r\n', 'Cifra Konrád', NULL, NULL),
(13, 'sos', '2perec', 'Klasszikus német perec', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só\r\n1 teáskanál cukor\r\n50 g vaj\r\n3 liter víz\r\n3 evőkanál szódabikarbóna', '\r\nAz élesztőt keverd el a vízben cukorral, majd add hozzá a liszthez, a sóhoz és a vajhoz.\r\nGyúrd össze alaposan, majd hagyd kelni 1 órán át.\r\nFormázd meg a pereceket, és hagyd pihenni még 20 percig.\r\nForrald fel a vizet a szódabikarbónával, majd mártsd bele a pereceket 30 másodpercre.\r\nSüsd 200 fokon 15-20 percig, amíg aranybarna nem lesz.', 'Kovács István', NULL, NULL),
(14, 'sos', '2perec', 'Sós perec', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só\r\n1 teáskanál cukor\r\n50 g vaj\r\n3 liter víz\r\n3 evőkanál szódabikarbóna', '\r\nAz élesztőt keverd el a vízben cukorral, majd add hozzá a liszthez, a sóhoz és a vajhoz.\r\nGyúrd össze alaposan, majd hagyd kelni 1 órán át.\r\nFormázd meg a pereceket, és hagyd pihenni még 20 percig.\r\nForrald fel a vizet a szódabikarbónával, majd mártsd bele a pereceket 30 másodpercre.\r\nSüsd 200 fokon 15-20 percig, amíg aranybarna nem lesz.', 'Vas Kinga', NULL, NULL),
(15, 'sos', '2perec', 'Szezámmagos sós perec', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só\r\n1 teáskanál cukor\r\n50 g olvasztott vaj\r\nSzezámmag a tetejére szórásra\r\n3 liter víz\r\n3 evőkanál szódabikarbóna a forraláshoz', '\r\nAz élesztőt oldd fel a langyos vízben a cukorral.\r\nA liszthez add hozzá a sót, az élesztős vizet és az olvasztott vajat, majd gyúrd össze alaposan.\r\nHagyd kelni a tésztát meleg helyen kb. 1 órán át.\r\nFormázd meg a pereceket, és hagyd pihenni még 20 percig.\r\nForrald fel a vizet a szódabikarbónával, majd mártsd bele a pereceket 30 másodpercre.\r\nHelyezd a pereceket sütőpapírral bélelt tepsire, szórd meg a tetejüket szezámmaggal.\r\nSüsd 200 fokon 15-20 percig, amíg aranybarna nem lesz.\r\n\r\n', 'Cifra Konrád', NULL, NULL),
(16, 'sos', '2perec', 'Sajtos-snidlinges sós perec', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só\r\n1 teáskanál cukor\r\n50 g olvasztott vaj\r\n100 g reszelt érett cheddar sajt\r\n1 csokor snidling, apróra vágva\r\n3 liter víz\r\n3 evőkanál szódabikarbóna a forraláshoz\r\nDurva só és apróra vágott snidling a szóráshoz', 'Az élesztőt oldd fel a langyos vízben a cukorral.\r\nA liszthez add hozzá a sót, az élesztős vizet, az olvasztott vajat, a reszelt sajtot és az apróra vágott snidlinget, majd gyúrd össze alaposan.\r\nHagyd kelni a tésztát meleg helyen kb. 1 órán át.\r\nFormázd meg a pereceket, és hagyd pihenni még 20 percig.\r\nForrald fel a vizet a szódabikarbónával, majd mártsd bele a pereceket 30 másodpercre.\r\nSüsd 200 fokon 15-20 percig, amíg aranybarna nem lesz, majd szórd meg durva sóval és apróra vágott snidlinggel.\r\n', 'Faragó Zoltán', NULL, NULL),
(17, 'sos', '2perec', 'Rozmaringos és tengeri sós perec', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só\r\n1 teáskanál cukor\r\n50 g olvasztott vaj\r\n2 evőkanál friss rozmaring, apróra vágva\r\nTengeri só a szóráshoz\r\n3 liter víz\r\n3 evőkanál szódabikarbóna a forraláshoz\r\n', '\r\nAz élesztőt oldd fel a langyos vízben a cukorral.\r\nA liszthez add hozzá a sót, az élesztős vizet, az olvasztott vajat és a rozmaringot, majd gyúrd össze alaposan.\r\nHagyd kelni a tésztát meleg helyen kb. 1 órán át.\r\nFormázd meg a pereceket, és hagyd pihenni még 20 percig.\r\nForrald fel a vizet a szódabikarbónával, majd mártsd bele a pereceket 30 másodpercre.\r\nSüsd 200 fokon 15-20 percig, amíg aranybarna nem lesz, majd szórd meg tengeri sóval.\r\n', 'Vas Kinga', NULL, NULL),
(18, 'sos', '2tekercs', 'Sonkás-sajtos tekercs', '\r\n1 csomag leveles tészta\r\n100 g sonka, vékonyan szeletelve\r\n100 g reszelt sajt\r\n1 tojás a kenéshez', '\r\nNyújtsd ki a leveles tésztát, rakd rá a sonkaszeleteket és szórd meg reszelt sajttal.\r\nTekerd fel szorosan, majd vágd 2 cm vastag szeletekre.\r\nKenjük meg a tetejét felvert tojással, és 200 fokon süsd aranybarnára.', 'Kovács István', NULL, NULL),
(19, 'sos', '2tekercs', 'Spenótos-fetás tekercs', '\r\n1 csomag leveles tészta\r\n200 g friss spenót\r\n100 g feta sajt, morzsolt\r\n1 tojás a kenéshez', '\r\nPárold meg a spenótot, majd keverd össze a fetával.\r\nNyújtsd ki a leveles tésztát, terítsd rá a spenótos keveréket.\r\nTekerd fel szorosan, majd vágd 2 cm vastag szeletekre.\r\nKenjük meg a tetejét felvert tojással, és 200 fokon süsd aranybarnára.\r\n', 'Eszenyi Borbála', NULL, NULL),
(20, 'sos', '2tekercs', 'Sajtos-póréhagymás tekercs', '\r\n1 csomag leveles tészta\r\n1 póréhagyma, vékonyan szeletelve\r\n100 g reszelt sajt\r\n1 tojás a kenéshez', '\r\nPárold meg a póréhagymát, majd keverd össze a reszelt sajttal.\r\nNyújtsd ki a leveles tésztát, terítsd rá a póréhagymás keveréket.\r\nTekerd fel szorosan, majd vágd 2 cm vastag szeletekre.\r\nKenjük meg a tetejét felvert tojással, és 200 fokon süsd aranybarnára.\r\n', 'Vas Kinga', NULL, NULL),
(21, 'sos', '2tekercs', 'Kolbászos tekercs', '\r\n1 csomag leveles tészta\r\n100 g kolbász, vékonyan szeletelve\r\n1 tojás a kenéshez', '\r\nNyújtsd ki a leveles tésztát, rakd rá a kolbászszeleteket.\r\nTekerd fel szorosan, majd vágd 2 cm vastag szeletekre.\r\nKenjük meg a tetejét felvert tojással, és 200 fokon süsd aranybarnára.\r\n', 'Faragó Zoltán', NULL, NULL),
(22, 'sos', '2tekercs', 'Pesto tekercs', '\r\n1 csomag leveles tészta\r\n4 evőkanál pesto\r\n1 tojás a kenéshez', '\r\nNyújtsd ki a leveles tésztát, kend meg pestoval.\r\nTekerd fel szorosan, majd vágd 2 cm vastag szeletekre.\r\nKenjük meg a tetejét felvert tojással, és 200 fokon süsd aranybarnára.\r\n', 'Kovács István', NULL, NULL),
(23, 'sos', '2bagel', 'Klasszikus francia bagett', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só', '\r\nAz élesztőt keverd el a vízben, majd add hozzá a liszthez és a sóhoz.\r\nGyúrd össze alaposan, majd hagyd kelni 1 órán át.\r\nFormázd meg a bagetteket, és hagyd pihenni még 30 percig.\r\nÉles késsel vágj be rajtuk néhány bemetszést, majd 250 fokon süsd 20-25 percig.\r\n', 'Cifra Konrád', NULL, NULL),
(24, 'sos', '2bagel', 'Olívás bagett', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só\r\n100 g fekete olíva, darabokra vágva', '\r\nAz élesztőt keverd el a vízben, majd add hozzá a liszthez, a sóhoz és az olívához.\r\nGyúrd össze alaposan, majd hagyd kelni 1 órán át.\r\nFormázd meg a bagetteket, és hagyd pihenni még 30 percig.\r\nÉles késsel vágj be rajtuk néhány bemetszést, majd 250 fokon süsd 20-25 percig.\r\n', 'Eszenyi Borbála', NULL, NULL),
(25, 'sos', '2bagel', 'Sajtos bagett', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só\r\n150 g reszelt sajt', '\r\nAz élesztőt keverd el a vízben, majd add hozzá a liszthez, a sóhoz és a sajthoz.\r\nGyúrd össze alaposan, majd hagyd kelni 1 órán át.\r\nFormázd meg a bagetteket, és hagyd pihenni még 30 percig.\r\nÉles késsel vágj be rajtuk néhány bemetszést, majd 250 fokon süsd 20-25 percig.\r\n', 'Kovács István', NULL, NULL),
(26, 'sos', '2bagel', 'Fokhagymás bagett', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só\r\n3 gerezd fokhagyma, apróra vágva', '\r\nAz élesztőt keverd el a vízben, majd add hozzá a liszthez, a sóhoz és a fokhagymához.\r\nGyúrd össze alaposan, majd hagyd kelni 1 órán át.\r\nFormázd meg a bagetteket, és hagyd pihenni még 30 percig.\r\nÉles késsel vágj be rajtuk néhány bemetszést, majd 250 fokon süsd 20-25 percig.\r\n', 'Faragó Zoltán', NULL, NULL),
(27, 'sos', '2bagel', 'Rozmaringos bagett', '\r\n500 g finomliszt\r\n300 ml langyos víz\r\n10 g friss élesztő\r\n10 g só\r\n2 evőkanál friss rozmaring, apróra vágva', 'Az élesztőt keverd el a vízben, majd add hozzá a liszthez, a sóhoz és a rozmaringhoz.\r\nGyúrd össze alaposan, majd hagyd kelni 1 órán át.\r\nFormázd meg a bagetteket, és hagyd pihenni még 30 percig.\r\nÉles késsel vágj be rajtuk néhány bemetszést, majd 250 fokon süsd 20-25 percig.\r\n', 'Vas Kinga', NULL, NULL),
(28, 'sos', '2kenyer', 'Fehér kenyér', '\r\n50 dkg liszt\r\n2 dkg élesztő\r\n2 dl víz\r\n1 teáskanál cukor\r\n1 teáskanál só\r\n1 tojás\r\n5 dkg vaj', '\r\nAz élesztőt a langyos vízben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót és a vajat, majd az élesztős vizet és összegyúrjuk.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, formákat készítünk, és 180 fokon 25 percig sütjük.\r\n', 'Faragó Zoltán', NULL, NULL),
(29, 'sos', '2kenyer', 'Teljes kiőrlésű kenyér', '\r\n25 dkg teljes kiőrlésű liszt\r\n25 dkg fehér liszt\r\n2 dkg élesztő\r\n2 dl víz\r\n1 teáskanál cukor\r\n1 teáskanál só\r\n1 tojás\r\n5 dkg vaj', '\r\nAz élesztőt a langyos vízben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót és a vajat, majd az élesztős vizet és összegyúrjuk.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, formákat készítünk, és 180 fokon 30 percig sütjük.\r\n', 'Eszenyi Borbála', NULL, NULL),
(30, 'sos', '2kenyer', 'Magvas kenyér', '\r\n50 dkg liszt\r\n2 dkg élesztő\r\n2 dl víz\r\n1 teáskanál cukor\r\n1 teáskanál só\r\n1 tojás\r\n5 dkg vaj\r\n10 dkg vegyes magvak (napraforgó, tökmag, lenmag)', '\r\nAz élesztőt a langyos vízben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót és a vajat, majd az élesztős vizet és összegyúrjuk.\r\nA magvakat is belekeverjük a tésztába.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, formákat készítünk, és 180 fokon 30 percig sütjük.\r\n', 'Kovács István', NULL, NULL),
(31, 'sos', '2kenyer', 'Rozskenyér', '\r\n25 dkg rozsliszt\r\n25 dkg fehér liszt\r\n2 dkg élesztő\r\n2 dl víz\r\n1 teáskanál cukor\r\n1 teáskanál só\r\n1 tojás\r\n5 dkg vaj', '\r\nAz élesztőt a langyos vízben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót és a vajat, majd az élesztős vizet és összegyúrjuk.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, formákat készítünk, és 180 fokon 35 percig sütjük.\r\n', 'Vésnök Márton', NULL, NULL),
(32, 'sos', '2kenyer', 'Aszalt gyümölcsös kenyér', '\r\n50 dkg liszt\r\n2 dkg élesztő\r\n2 dl víz\r\n1 teáskanál cukor\r\n1 teáskanál só\r\n1 tojás\r\n5 dkg vaj\r\n10 dkg apróra vágott aszalt gyümölcsök (pl. mazsola, sárgabarack)', '\r\nAz élesztőt a langyos vízben cukorral felfuttatjuk.\r\nA liszthez hozzáadjuk a sót és a vajat, majd az élesztős vizet és összegyúrjuk.\r\nAz apróra vágott aszalt gyümölcsöket is belekeverjük a tésztába.\r\nLetakarva, meleg helyen kelesztjük 1 órát.\r\nKinyújtjuk a tésztát, formákat készítünk, és 180 fokon 35 percig sütjük.\r\n', 'Vas Kinga', NULL, NULL),
(33, 'sos', '2szendvics', 'Csirkesaláta szendvics', '\r\n2 szelet teljes kiőrlésű kenyér\r\n100 g főtt csirke, apróra vágva\r\n2 evőkanál majonéz\r\n1 teáskanál mustár\r\nSó, bors ízlés szerint\r\nFriss salátalevél', '\r\nKeverd össze a csirkét, majonézt, mustárt, sót és borsot egy tálban.\r\nKend meg az egyik szelet kenyeret a csirkesalátával.\r\nTedd rá a salátalevelet, majd fedd be a másik szelettel.', 'Kovács István', NULL, NULL),
(34, 'sos', '2szendvics', 'Tonhalas szendvics', '\r\n2 szelet rozskenyér\r\n1 konzerv tonhal olajban\r\n1 evőkanál majonéz\r\n1 teáskanál citromlé\r\nSó, bors ízlés szerint\r\nPár szelet uborka', '\r\nCsepegtesd le a tonhalat, majd keverd össze a majonézzel, citromlével, sóval és borssal.\r\nKend meg az egyik szelet kenyeret a tonhalas keverékkel.\r\nRakd rá az uborkaszeleteket, majd fedd be a másik szelettel.\r\n', 'Eszenyi Borbála', NULL, NULL),
(35, 'sos', '2szendvics', 'Mozzarella és paradicsom szendvics', '\r\n2 szelet ciabatta kenyér\r\n1 nagy mozzarella golyó, szeletelve\r\n1 nagy érett paradicsom, szeletelve\r\nFriss bazsalikomlevelek\r\nOlívaolaj\r\nSó, bors ízlés szerint', '\r\nCsepegtess olívaolajat a ciabatta szeletekre.\r\nRakd rá a mozzarella és paradicsom szeleteket, majd szórd meg sóval, borssal és bazsalikomlevelekkel.\r\nTedd össze a szendvicset.', 'Kovács István', NULL, NULL),
(36, 'sos', '2szendvics', 'Avokádós tojásszendvics', '\r\n2 szelet barna kenyér\r\n1 érett avokádó, pépesítve\r\n2 keményre főtt tojás, szeletelve\r\nSó, bors ízlés szerint\r\nFriss spenótlevél', '\r\nKend meg az egyik szelet kenyeret az avokádóval.\r\nRakd rá a tojásszeleteket és a spenótleveleket.\r\nFűszerezd sóval és borssal, majd tedd össze a szendvicset.\r\n', 'Vas Kinga', NULL, NULL),
(37, 'sos', '2szendvics', 'Sült paprikás hússzendvics', '\r\n2 szelet bagett\r\n100 g sült marhahús, vékonyan szeletelve\r\n1 sült paprika, csíkokra vágva\r\n1 evőkanál mustár\r\n1 evőkanál majonéz\r\nFriss rukkola', '\r\nKeverd össze a mustárt és a majonézt, majd kend meg vele a bagett szeleteket.\r\nRakd rá a hússzeleteket, a sült paprikát és a rukkolát.\r\nTedd össze a szendvicset.\r\n', 'Cifra Konrád', NULL, NULL),
(38, 'sos', '2lepeny', 'Sonkás-tejfölös lepény', '\r\n300 g finomliszt\r\n150 ml víz\r\n100 g sonka, apróra vágva\r\n100 ml tejföl\r\n1 teáskanál só\r\n2 evőkanál olívaolaj', '\r\nKeverd össze a lisztet és a sót egy tálban.\r\nAdd hozzá a vizet, az apróra vágott sonkát és az olívaolajat.\r\nGyúrd össze, amíg sima tésztát nem kapsz.\r\nHagyd pihenni a tésztát 30 percig.\r\nNyújtsd ki kb. 1 cm vastagra, és helyezd sütőpapírral bélelt tepsire.\r\nKend meg a tetejét tejföllel.\r\nSüsd előmelegített sütőben 200°C-on 15-20 percig, amíg aranybarna nem lesz.\r\n', 'Kovács István', NULL, NULL),
(39, 'sos', '2lepeny', ' Sajtos-tejfölös lepény', '\r\n250 g finomliszt\r\n100 g reszelt sajt\r\n100 ml tejföl\r\n1 teáskanál só\r\n1 teáskanál sütőpor\r\n2 evőkanál olívaolaj', '\r\nKeverd össze a lisztet, a sütőport és a sót egy tálban.\r\nAdd hozzá a tejfölt, a reszelt sajtot és az olívaolajat.\r\nGyúrd össze, amíg sima tésztát nem kapsz.\r\nHagyd pihenni a tésztát 30 percig.\r\nNyújtsd ki kb. 1 cm vastagra, és helyezd sütőpapírral bélelt tepsire.\r\nSüsd előmelegített sütőben 200°C-on 15-20 percig, amíg aranybarna nem lesz.\r\n', 'Faragó Zoltán', NULL, NULL),
(40, 'sos', '2lepeny', 'Paprikás-snidlinges lepény', '\r\n300 g finomliszt\r\n150 ml víz\r\n1 teáskanál füstölt paprika\r\n1 csokor snidling, apróra vágva\r\n1 teáskanál só\r\n2 evőkanál olívaolaj\r\n', '\r\nKeverd össze a lisztet, a füstölt paprikát, a snidlinget és a sót egy tálban.\r\nAdd hozzá a vizet és az olívaolajat.\r\nGyúrd össze, amíg sima tésztát nem kapsz.\r\nHagyd pihenni a tésztát 30 percig.\r\nNyújtsd ki kb. 1 cm vastagra, és helyezd sütőpapírral bélelt tepsire.\r\nSüsd előmelegített sütőben 200°C-on 15-20 percig, amíg aranybarna nem lesz.\r\n', 'Eszenyi Borbála', NULL, NULL),
(41, 'sos', '2lepeny', 'Hagymás lepény', '\r\n300 g finomliszt\r\n150 ml víz\r\n1 nagy fej vöröshagyma, apróra vágva\r\n1 teáskanál só\r\n2 evőkanál olívaolaj', '\r\nKeverd össze a lisztet és a sót egy tálban.\r\nAdd hozzá a vizet, az apróra vágott vöröshagymát és az olívaolajat.\r\nGyúrd össze, amíg sima tésztát nem kapsz.\r\nHagyd pihenni a tésztát 30 percig.\r\nNyújtsd ki kb. 1 cm vastagra, és helyezd sütőpapírral bélelt tepsire.\r\nSüsd előmelegített ', 'Vas Kinga', NULL, NULL),
(42, 'sos', '2lepeny', 'Mediterrán fűszeres lepény', '\r\n300 g finomliszt\r\n150 ml víz\r\n1 teáskanál oregánó\r\n1 teáskanál bazsalikom\r\n1 teáskanál rozmaring\r\n1 teáskanál só\r\n2 evőkanál olívaolaj', '\r\nKeverd össze a lisztet, az oregánót, a bazsalikomot, a rozmaringot és a sót egy tálban.\r\nAdd hozzá a vizet és az olívaolajat.\r\nGyúrd össze, amíg sima tésztát nem kapsz.\r\nHagyd pihenni a tésztát 30 percig.\r\nNyújtsd ki kb. 1 cm vastagra, és helyezd sütőpapírral bélelt tepsire.\r\nSüsd előmelegített sütőben 200°C-on 15-20 percig, amíg aranybarna nem lesz.\r\n', 'Vas Kinga', NULL, NULL),
(43, 'edes', '1torta', 'Csokoládé ganache torta', '\r\n200 g étcsokoládé\r\n200 ml tejszín\r\n150 g liszt\r\n150 g cukor\r\n100 g vaj\r\n4 tojás\r\n1 teáskanál sütőpor\r\nGanache:\r\n\r\n200 g étcsokoládé\r\n200 ml tejszín', '\r\nA torta tésztájához olvaszd fel a csokoládét és a vajat.\r\nVerd fel a tojásokat a cukorral, majd keverd hozzá a csokoládés keveréket.\r\nSzitáld hozzá a lisztet és a sütőport, majd óvatosan keverd össze.\r\nÖntsd a tésztát egy kivajazott tortaformába.\r\nSüsd 180°C-on 30-35 percig.\r\nA ganache-hoz melegítsd fel a tejszínt, majd öntsd rá az apróra tört csokoládéra és keverd simára.\r\nHagyd hűlni, majd kend a kihűlt tortára.\r\n', 'Faragó Zoltán', NULL, NULL),
(44, 'edes', '1torta', 'Málnás mascarpone torta', '\r\n200 g liszt\r\n150 g cukor\r\n100 g vaj\r\n4 tojás\r\n1 teáskanál sütőpor\r\n200 g friss málna\r\nMascarpone krém:\r\n\r\n250 g mascarpone\r\n100 g porcukor\r\n1 teáskanál vanília kivonat', '\r\nA torta tésztájához keverd össze a lisztet, a cukrot és a sütőport.\r\nAdd hozzá a vajat és a tojásokat, majd keverd simára.\r\nÖntsd a tésztát egy kivajazott tortaformába.\r\nSüsd 180°C-on 25-30 percig.\r\nA mascarpone krémhez keverd össze a mascarponét, a porcukrot és a vanília kivonatot.\r\nA kihűlt tortát vágd ketté, töltsd meg a krémmel és a málnával, majd kend be a tetejét is.\r\n', 'Vas Kinga', NULL, NULL),
(45, 'edes', '1torta', 'Citromos piskótatorta', '\r\n4 tojás\r\n120 g cukor\r\n120 g liszt\r\n1 citrom reszelt héja\r\n\r\nCitromkrém:\r\n2 citrom leve és reszelt héja\r\n150 g cukor\r\n100 g vaj\r\n2 tojás', '\r\nA piskótához verd fel a tojásokat a cukorral, majd óvatosan keverd hozzá a lisztet és a citromhéjat.\r\nÖntsd a tésztát egy kivajazott tortaformába.\r\nSüsd 180°C-on 20-25 percig.\r\nA citromkrémhez keverd össze a citromlevet, a cukrot, a vajat és a tojásokat, majd főzd sűrűre.\r\nA kihűlt piskótát vágd ketté, töltsd meg a krémmel, majd kend be a tetejét is.\r\n', 'Eszenyi Borbála', NULL, NULL),
(46, 'edes', '1torta', 'Karamellás diótorta', '\r\n200 g darált dió\r\n4 tojás\r\n150 g cukor\r\n1 teáskanál sütőpor\r\n\r\nKaramellkrém:\r\n200 g cukor\r\n100 ml tejszín\r\n100 g vaj', '\r\nA torta tésztájához verd fel a tojásokat a cukorral, majd keverd hozzá a darált diót és a sütőport.\r\nÖntsd a tésztát egy kivajazott tortaformába.\r\nSüsd 180°C-on 25-30 percig.\r\nA karamellkrémhez karamellizáld a cukrot, majd óvatosan add hozzá a tejszínt és a vajat.\r\nHagyd hűlni, majd kend a kihűlt tortára.\r\n', 'Faragó Zoltán', NULL, NULL),
(47, 'edes', '1torta', 'Tiramisu torta', '\r\n200 g piskóta\r\n250 g mascarpone\r\n100 g porcukor\r\n2 tojás\r\n1 csésze erős kávé\r\nKakaópor a szóráshoz', '\r\nA mascarpone krémhez keverd össze a mascarponét, a porcukrot és a tojások sárgáját.\r\nVerd fel a tojások fehérjét, majd óvatosan keverd a krémhez.\r\nÁztasd meg a piskótákat a kávéban, majd rétegezd őket a krémmel egy tortaformában.\r\nTedd hűtőbe legalább 4 órára.\r\nTálalás előtt szórd meg kakaóporral.\r\n', 'Cifra Konrád', NULL, NULL),
(48, 'edes', '1pite', ' Almás pite', '\r\n300 g liszt\r\n150 g hideg vaj\r\n100 g cukor\r\n1 tojás\r\n1 csipet só\r\n4-5 evőkanál hideg víz\r\nTöltelék:\r\n\r\n5-6 közepes alma\r\n150 g barna cukor\r\n1 teáskanál őrölt fahéj\r\n1/2 teáskanál őrölt szegfűszeg\r\n1 evőkanál kukoricakeményítő', 'tésztához morzsold össze a lisztet, a hideg vajat, a cukrot és a sót, majd add hozzá a tojást és annyi hideg vizet, amennyitől összeáll a tészta.\r\nGyúrd simára, formázz korongot, és tedd hűtőbe pihenni legalább 30 percre.\r\nAz almákat hámozd meg, magozd ki, vágd vékony szeletekre, és keverd össze a barna cukorral, fahéjjal, szegfűszeggel és kukoricakeményítővel.\r\nA tésztát nyújtsd ki, helyezd egy piteformába, és szúrd meg villával.\r\nRendezd el az almás tölteléket a tésztán.\r\nSüsd előmelegített sütőben 180°C-on kb. 50-60 percig, amíg az alma megpuhul és a tészta aranybarna nem lesz.\r\n', 'Kovács István', NULL, NULL),
(49, 'edes', '1pite', 'Meggyes pite', '\r\n300 g liszt\r\n150 g hideg vaj\r\n100 g cukor\r\n1 tojás\r\n1 csipet só\r\n4-5 evőkanál hideg víz\r\n\r\nTöltelék:\r\n500 g magozott meggy (friss vagy fagyasztott)\r\n150 g cukor\r\n2 evőkanál kukoricakeményítő\r\n1 teáskanál vanília kivonat', '\r\nA tésztát készítsd el az almás pite tésztája szerint.\r\nA meggyet keverd össze a cukorral, kukoricakeményítővel és vanília kivonattal.\r\nA tésztát nyújtsd ki, helyezd egy piteformába, és szúrd meg villával.\r\nRendezd el a meggyes tölteléket a tésztán.\r\nSüsd előmelegített sütőben 180°C-on kb. 50-60 percig, amíg a töltelék buborékolni nem kezd.\r\n', 'Vas Kinga', NULL, NULL),
(50, 'edes', '1pite', 'Túrós pite', '\r\n300 g liszt\r\n150 g hideg vaj\r\n100 g cukor\r\n1 tojás\r\n1 csipet só\r\n4-5 evőkanál hideg víz\r\n\r\nTöltelék:\r\n500 g túró\r\n200 g cukor\r\n2 tojás\r\n1 citrom reszelt héja\r\n1 csomag vaníliás cukor\r\n1 evőkanál búzadara', '\r\nA tésztát készítsd el az almás pite tésztája szerint.\r\nA túrót keverd össze a cukorral, a tojásokkal, a citromhéjjal, a vaníliás cukorral és a búzadarával.\r\nA tésztát nyújtsd ki, helyezd egy piteformába, és szúrd meg villával.\r\nRendezd el a túrós tölteléket a tésztán.\r\nSüsd előmelegített sütőben 180°C-on kb. 50-60 percig, amíg a túró meg nem szilárdul.\r\n', 'Faragó Zoltán', NULL, NULL),
(51, 'edes', '1pite', 'Epres pite', '\r\n300 g liszt\r\n150 g hideg vaj\r\n100 g cukor\r\n1 tojás\r\n1 csipet só\r\n4-5 evőkanál hideg víz\r\n\r\nTöltelék:\r\n500 g friss eper\r\n150 g cukor\r\n2 evőkanál kukoricakeményítő\r\n1 teáskanál vanília kivonat', '\r\nA tésztát készítsd el az almás pite tésztája szerint.\r\nAz epret vágd fel, keverd össze a cukorral, kukoricakeményítővel és vanília kivonattal.\r\nA tésztát nyújtsd ki, helyezd egy piteformába, és szúrd meg villával.\r\nRendezd el az epret a tésztán.\r\nSüsd előmelegített sütőben 180°C-on kb. 45-50 percig, amíg az eper megpuhul.\r\n', 'Cifra Konrád', NULL, NULL),
(52, 'edes', '1pite', 'Barackos pite', '\r\n300 g liszt\r\n150 g hideg vaj\r\n100 g cukor\r\n1 tojás\r\n1 csipet só\r\n4-5 evőkanál hideg víz\r\n\r\nTöltelék:\r\n500 g friss barack\r\n150 g cukor\r\n2 evőkanál kukoricakeményítő\r\n1 teáskanál őrölt fahéj', '\r\nA tésztát készítsd el az almás pite tésztája szerint.\r\nA barackot vágd fel, keverd össze a cukorral, kukoricakeményítővel és fahéjjal.\r\nA tésztát nyújtsd ki, helyezd egy piteformába, és szúrd meg villával.\r\nRendezd el a barackot a tésztán.\r\nSüsd előmelegített sütőben 180°C-on kb. 45-50 percig, amíg a barack megpuhul.\r\n', 'Eszenyi Borbála', NULL, NULL),
(53, 'edes', '1keksz', 'Csokoládés darabos keksz', '\r\n225 g vaj\r\n200 g barna cukor\r\n100 g kristálycukor\r\n2 tojás\r\n1 teáskanál vanília kivonat\r\n300 g liszt\r\n1/2 teáskanál szódabikarbóna\r\n1/2 teáskanál só\r\n200 g étcsokoládé darabokra törve', '\r\nKeverd össze a vajat a cukrokkal, majd add hozzá a tojásokat és a vanília kivonatot.\r\nEgy másik tálban keverd össze a lisztet, a szódabikarbónát és a sót, majd add hozzá a vajas keverékhez.\r\nKeverd bele a csokoládé darabokat.\r\nFormázz kis golyókat a tésztából, helyezd őket sütőpapírral bélelt tepsire.\r\nSüsd 180°C-on 10-12 percig.\r\n', 'Kovács István', NULL, NULL),
(54, 'edes', '1keksz', 'Vajas keksz', '\r\n225 g vaj\r\n150 g porcukor\r\n1 tojás\r\n1 teáskanál vanília kivonat\r\n300 g liszt\r\n1/2 teáskanál sütőpor\r\n1/4 teáskanál só', '\r\nKeverd össze a vajat a porcukorral, majd add hozzá a tojást és a vanília kivonatot.\r\nEgy másik tálban keverd össze a lisztet, a sütőport és a sót, majd add hozzá a vajas keverékhez.\r\nFormázz kis golyókat a tésztából, helyezd őket sütőpapírral bélelt tepsire.\r\nSüsd 180°C-on 8-10 percig.\r\n', 'Faragó Zoltán', NULL, NULL),
(55, 'edes', '1keksz', 'Mogyoróvajas keksz', '\r\n225 g mogyoróvaj\r\n200 g barna cukor\r\n1 tojás\r\n1 teáskanál vanília kivonat\r\n250 g liszt\r\n1/2 teáskanál szódabikarbóna\r\n1/4 teáskanál só', '\r\nKeverd össze a mogyoróvajat a cukorral, majd add hozzá a tojást és a vanília kivonatot.\r\nEgy másik tálban keverd össze a lisztet, a szódabikarbónát és a sót, majd add hozzá a mogyoróvajas keverékhez.\r\nFormázz kis golyókat a tésztából, helyezd őket sütőpapírral bélelt tepsire.\r\nSüsd 180°C-on 10-12 percig.', 'Kovács István', NULL, NULL),
(56, 'edes', '1keksz', ' Kókuszos keksz', '\r\n225 g vaj\r\n200 g cukor\r\n2 tojás\r\n1 teáskanál vanília kivonat\r\n250 g liszt\r\n1/2 teáskanál sütőpor\r\n1/4 teáskanál só\r\n100 g kókuszreszelék', '\r\nKeverd össze a vajat a cukorral, majd add hozzá a tojásokat és a vanília kivonatot.\r\nEgy másik tálban keverd össze a lisztet, a sütőport és a sót, majd add hozzá a vajas keverékhez.\r\nKeverd bele a kókuszreszeléket.\r\nFormázz kis golyókat a tésztából, helyezd őket sütőpapírral bélelt tepsire.\r\nSüsd 180°C-on 10-12 percig.', 'Vas Kinga', NULL, NULL),
(57, 'edes', '1keksz', 'Mandulás keksz', '\r\n225 g vaj\r\n150 g cukor\r\n2 tojás\r\n1 teáskanál mandula kivonat\r\n300 g liszt\r\n1/2 teáskanál sütőpor\r\n1/4 teáskanál só\r\n100 g darált mandula', '\r\nKeverd össze a vajat a cukorral, majd add hozzá a tojásokat és a mandula kivonatot.\r\nEgy másik tálban keverd össze a lisztet, a sütőport és a sót, majd add hozzá a vajas keverékhez.\r\nKeverd bele a darált mandulát.\r\nFormázz kis golyókat a tésztából, helyezd őket sütőpapírral bélelt tepsire.\r\nSüsd 180°C-on 10-12 percig.\r\n', 'Vas Kinga', NULL, NULL),
(58, 'edes', '1muffin', 'Csokoládés muffin', '\r\n250 g liszt\r\n2 teáskanál sütőpor\r\n1/2 teáskanál szódabikarbóna\r\n4 evőkanál kakaópor\r\n150 g cukor\r\n100 g étcsokoládé darabokra törve\r\n2 tojás\r\n250 ml tej\r\n90 ml olaj', '\r\nKeverd össze a száraz hozzávalókat egy tálban.\r\nEgy másik tálban keverd össze a tojásokat, a tejet és az olajat.\r\nAdd hozzá a száraz keverékhez, majd óvatosan keverd össze.\r\nKeverd bele a csokoládé darabokat.\r\nTöltsd a tésztát muffin formákba.\r\nSüsd 180°C-on 20-25 percig.\r\n', 'Eszenyi Borbála', NULL, NULL),
(59, 'edes', '1muffin', ' Vaníliás muffin', '\r\n250 g liszt\r\n2 teáskanál sütőpor\r\n150 g cukor\r\n2 tojás\r\n250 ml tej\r\n90 ml olaj\r\n1 teáskanál vanília kivonat', '\r\nKeverd össze a lisztet, a sütőport és a cukrot egy tálban.\r\nEgy másik tálban keverd össze a tojásokat, a tejet, az olajat és a vanília kivonatot.\r\nAdd hozzá a száraz keverékhez, majd óvatosan keverd össze.\r\nTöltsd a tésztát muffin formákba.\r\nSüsd 180°C-on 20-25 percig.', 'Kovács István', NULL, NULL),
(60, 'edes', '1muffin', 'Mogyoróvajas muffin', '\r\n250 g liszt\r\n2 teáskanál sütőpor\r\n150 g cukor\r\n100 g mogyoróvaj\r\n2 tojás\r\n250 ml tej\r\n90 ml olaj', '\r\nKeverd össze a lisztet, a sütőport és a cukrot egy tálban.\r\nEgy másik tálban keverd össze a tojásokat, a tejet, az olajat és a mogyoróvajat.\r\nAdd hozzá a száraz keverékhez, majd óvatosan keverd össze.\r\nTöltsd a tésztát muffin formákba.\r\nSüsd 180°C-on 20-25 percig.\r\n', 'Faragó Zoltán', NULL, NULL),
(61, 'edes', '1muffin', 'Citromos mákos muffin', '\r\n250 g liszt\r\n2 teáskanál sütőpor\r\n150 g cukor\r\n2 evőkanál mák\r\n2 tojás\r\n250 ml tej\r\n90 ml olaj\r\n1 citrom reszelt héja és leve', '\r\nKeverd össze a lisztet, a sütőport, a cukrot és a mákot egy tálban.\r\nEgy másik tálban keverd össze a tojásokat, a tejet, az olajat, a citrom reszelt héját és levét.\r\nAdd hozzá a száraz keverékhez, majd óvatosan keverd össze.\r\nTöltsd a tésztát muffin formákba.\r\nSüsd 180°C-on 20-25 percig.\r\n', 'Kovács István', NULL, NULL),
(62, 'edes', '1muffin', 'Banános muffin', '\r\n250 g liszt\r\n2 teáskanál sütőpor\r\n150 g cukor\r\n2 érett banán összetörve\r\n2 tojás\r\n250 ml tej\r\n90 ml olaj', '\r\nKeverd össze a lisztet, a sütőport és a cukrot egy tálban.\r\nEgy másik tálban keverd össze a tojásokat, a tejet, az olajat és az összetört banánt.\r\nAdd hozzá a száraz keverékhez, majd óvatosan keverd össze.\r\nTöltsd a tésztát muffin formákba.\r\nSüsd 180°C-on 20-25 percig.\r\n', 'Vas Kinga', NULL, NULL),
(63, 'edes', '1fagylalt', 'Vanília fagylalt', '\r\n500 ml tejszín\r\n250 ml tej\r\n150 g cukor\r\n1 vaníliarúd kikapart magjai\r\n6 tojássárgája', '\r\nKeverd össze a tejet, a tejszínt és a vaníliamagokat egy lábosban, és melegítsd fel közepes lángon.\r\nEgy másik tálban keverd össze a tojássárgájákat és a cukrot, amíg világos és habos nem lesz.\r\nLassan öntsd a tojásos keverékhez a meleg tejes keveréket, közben folyamatosan keverd.\r\nÖntsd vissza a lábosba, és főzd sűrűre alacsony lángon, amíg bevonja a kanál hátát.\r\nHagyd kihűlni, majd tedd fagyasztóba, és keverd meg óránként, amíg meg nem fagy.\r\n', 'Faragó Zoltán', NULL, NULL),
(64, 'edes', '1fagylalt', 'Csokoládé fagylalt', '\r\n500 ml tejszín\r\n250 ml tej\r\n200 g étcsokoládé\r\n150 g cukor\r\n6 tojássárgája', '\r\nA tejet és a tejszínt melegítsd fel egy lábosban.\r\nA csokoládét olvaszd fel vízgőz felett, majd keverd a meleg tejes keverékhez.\r\nA tojássárgájákat és a cukrot keverd habosra, majd öntsd hozzá a csokoládés tejet.\r\nFőzd sűrűre alacsony lángon, majd hagyd kihűlni és tedd fagyasztóba.\r\n', 'Vas Kinga', NULL, NULL),
(65, 'edes', '1fagylalt', 'Eper fagylalt', '\r\n500 ml tejszín\r\n250 ml tej\r\n150 g cukor\r\n300 g friss eper pürésítve', '\r\nKeverd össze a tejet, a tejszínt és a cukrot egy lábosban, és melegítsd fel.\r\nAdd hozzá az eperpürét, és keverd simára.\r\nHagyd kihűlni, majd tedd fagyasztóba, és keverd meg óránként, amíg meg nem fagy.\r\n', 'Kovács István', NULL, NULL),
(66, 'edes', '1fagylalt', ' Menta csokidarabos fagylalt', '\r\n500 ml tejszín\r\n250 ml tej\r\n150 g cukor\r\n1 teáskanál menta kivonat\r\n100 g apróra tört étcsokoládé', '\r\nKeverd össze a tejet, a tejszínt és a cukrot egy lábosban, és melegítsd fel.\r\nAdd hozzá a menta kivonatot, és keverd simára.\r\nHagyd kihűlni, majd tedd fagyasztóba, és keverd meg óránként, amíg meg nem fagy.\r\nAmikor majdnem kész, keverd bele az apróra tört csokoládét.\r\n', 'Kovács István', NULL, NULL),
(67, 'edes', '1fagylalt', 'Kókusz fagylalt', '\r\n500 ml kókusztej\r\n250 ml tejszín\r\n150 g cukor\r\n100 g reszelt kókusz', '\r\nKeverd össze a kókusztejet, a tejszínt és a cukrot egy lábosban, és melegítsd fel.\r\nAdd hozzá a reszelt kókuszt, és keverd simára.\r\nHagyd kihűlni, majd tedd fagyasztóba, és keverd meg óránként, amíg meg nem fagy.\r\n', 'Eszenyi Borbála', NULL, NULL),
(68, 'edes', '1fank', ' Amerikai fánk', '\r\n500 g liszt\r\n250 ml tej\r\n50 g cukor\r\n50 g olvasztott vaj\r\n2 tojás\r\n1 csomag szárított élesztő\r\n1 teáskanál só\r\nOlaj a sütéshez', '\r\nKeverd össze a tejet, a cukrot és az élesztőt, hagyd állni 10 percig.\r\nKeverd hozzá a lisztet, a sót, az olvasztott vajat és a tojásokat, majd gyúrd sima tésztává.\r\nHagyd kelni meleg helyen kb. 1 órán át.\r\nNyújtsd ki a tésztát kb. 1 cm vastagra, szaggass ki fánkokat.\r\nHagyd pihenni őket még 30 percig.\r\nForró olajban süsd ki mindkét oldalukat aranybarnára.\r\n', 'Eszenyi Borbála', NULL, NULL),
(69, 'edes', '1fank', 'Túrós fánk', '\r\n250 g túró\r\n200 g liszt\r\n50 g cukor\r\n2 tojás\r\n1 teáskanál sütőpor\r\n1 csipet só\r\nOlaj a sütéshez', '\r\nKeverd össze a túrót, a cukrot, a tojásokat, a lisztet, a sütőport és a sót.\r\nFormázz kis gombócokat a tésztából.\r\nForró olajban süsd ki őket aranybarnára.\r\n', 'Faragó Zoltán', NULL, NULL),
(70, 'edes', '1fank', ' Kókuszos fánk', '\r\n500 g liszt\r\n250 ml kókusztej\r\n100 g cukor\r\n50 g olvasztott kókuszzsír\r\n3 tojás\r\n1 csomag szárított élesztő\r\n1 csipet só\r\n100 g kókuszreszelék\r\nOlaj a sütéshez', '\r\nKeverd össze a kókusztejet, a cukrot és az élesztőt, hagyd állni 10 percig.\r\nKeverd hozzá a lisztet, a sót, az olvasztott kókuszzsírt, a tojásokat és a kókuszreszeléket, majd gyúrd sima tésztává.\r\nHagyd kelni meleg helyen kb. 1 órán át.\r\nNyújtsd ki a tésztát kb. 1 cm vastagra, szaggass ki fánkokat.\r\nHagyd pihenni őket még 30 percig.\r\nForró olajban süsd ki mindkét oldalukat aranybarnára.', 'Faragó Zoltán', NULL, NULL),
(71, 'edes', '1fank', ' Fahéjas cukros fánk', '\r\n500 g liszt\r\n250 ml langyos tej\r\n100 g cukor\r\n50 g olvasztott vaj\r\n30 g friss élesztő\r\n2 tojás\r\n1 csipet só\r\n1 teáskanál őrölt fahéj\r\nOlaj a sütéshez\r\nFahéjas cukor a hempergetéshez', '\r\nAz élesztőt futtasd fel a langyos tejben egy kevés cukorral.\r\nA lisztet keverd össze a maradék cukorral, sóval és fahéjjal egy nagy tálban.\r\nAdd hozzá az élesztős tejet, az olvasztott vajat és a tojásokat, majd gyúrd sima tésztává.\r\nHagyd kelni meleg helyen kb. 1 órán át, amíg megduplázódik a térfogata.\r\nNyújtsd ki a tésztát kb. 1 cm vastagra, szaggass ki fánkokat.\r\nHagyd pihenni őket még 30 percig.\r\nForró olajban süsd ki mindkét oldalukat aranybarnára.\r\nHempergesd meg őket fahéjas cukorban.\r\n', 'Faragó Zoltán', NULL, NULL),
(72, 'edes', '1fank', 'Nutellás töltött fánk', '\r\n500 g liszt\r\n250 ml langyos tej\r\n100 g cukor\r\n50 g olvasztott vaj\r\n30 g friss élesztő\r\n2 tojás\r\n1 csipet só\r\nNutella a töltéshez\r\nOlaj a sütéshez\r\nPorcukor a szóráshoz', '\r\nAz élesztőt futtasd fel a langyos tejben egy kevés cukorral.\r\nA lisztet keverd össze a maradék cukorral és sóval egy nagy tálban.\r\nAdd hozzá az élesztős tejet, az olvasztott vajat és a tojásokat, majd gyúrd sima tésztává.\r\nHagyd kelni meleg helyen kb. 1 órán át, amíg megduplázódik a térfogata.\r\nNyújtsd ki a tésztát kb. 1 cm vastagra, szaggass ki fánkokat.\r\nHagyd pihenni őket még 30 percig.\r\nForró olajban süsd ki mindkét oldalukat aranybarnára.\r\nTöltsd meg Nutellával, és szórd meg porcukorral.\r\n', 'Vas Kinga', NULL, NULL),
(73, 'edes', '1palacsinta', 'Hagyományos palacsinta', '\r\n250 g liszt\r\n500 ml tej\r\n2 tojás\r\n2 evőkanál cukor\r\n1 csipet só\r\nOlaj vagy vaj a sütéshez', '\r\nKeverd össze a lisztet, a cukrot és a sót egy nagy tálban.\r\nVerd fel a tojásokat, majd add hozzá a tejet és keverd simára.\r\nAdd hozzá a száraz hozzávalókat, és keverd csomómentesre.\r\nEgy serpenyőben melegíts olajat vagy vajat, és süsd ki a palacsintákat mindkét oldalukon aranybarnára.\r\n', 'Kovács István', NULL, NULL),
(74, 'edes', '1palacsinta', 'Csokoládés palacsinta', '\r\n250 g liszt\r\n3 evőkanál kakaópor\r\n500 ml tej\r\n2 tojás\r\n3 evőkanál cukor\r\n1 csipet só\r\nOlaj vagy vaj a sütéshez', '\r\nKeverd össze a lisztet, a kakaóport, a cukrot és a sót egy nagy tálban.\r\nVerd fel a tojásokat, majd add hozzá a tejet és keverd simára.\r\nAdd hozzá a száraz hozzávalókat, és keverd csomómentesre.\r\nEgy serpenyőben melegíts olajat vagy vajat, és süsd ki a palacsintákat mindkét oldalukon aranybarnára.\r\n', 'Vas Kinga', NULL, NULL),
(75, 'edes', '1palacsinta', 'Túrós palacsinta', '\r\n250 g liszt\r\n500 ml tej\r\n2 tojás\r\n2 evőkanál cukor\r\n1 csipet só\r\n250 g túró\r\nOlaj vagy vaj a sütéshez', '\r\nKeverd össze a lisztet, a cukrot és a sót egy nagy tálban.\r\nVerd fel a tojásokat, majd add hozzá a tejet és keverd simára.\r\nAdd hozzá a száraz hozzávalókat, és keverd csomómentesre.\r\nKeverd hozzá a túrót.\r\nEgy serpenyőben melegíts olajat vagy vajat, és süsd ki a palacsintákat mindkét oldalukon aranybarnára.\r\n', 'Vas Kinga', NULL, NULL),
(76, 'edes', '1palacsinta', 'Almás fahéjas palacsinta', '\r\n250 g liszt\r\n500 ml tej\r\n2 tojás\r\n2 evőkanál cukor\r\n1 csipet só\r\n2 közepes alma lereszelve\r\n1 teáskanál őrölt fahéj\r\nOlaj vagy vaj a sütéshez', '\r\nKeverd össze a lisztet, a cukrot, a sót és a fahéjat egy nagy tálban.\r\nVerd fel a tojásokat, majd add hozzá a tejet és keverd simára.\r\nAdd hozzá a száraz hozzávalókat, és keverd csomómentesre.\r\nKeverd hozzá a lereszelt almát.\r\nEgy serpenyőben melegíts olajat vagy vajat, és süsd ki a palacsintákat mindkét oldalukon aranybarnára.\r\n', 'Eszenyi Borbála', NULL, NULL),
(77, 'edes', '1palacsinta', 'Epres palacsinta', '\r\n250 g liszt\r\n500 ml tej\r\n2 tojás\r\n2 evőkanál cukor\r\n1 csipet só\r\n200 g friss eper apróra vágva\r\nOlaj vagy vaj a sütéshez', '\r\nKeverd össze a lisztet, a cukrot és a sót egy nagy tálban.\r\nVerd fel a tojásokat, majd add hozzá a tejet és keverd simára.\r\nAdd hozzá a száraz hozzávalókat, és keverd csomómentesre.\r\nKeverd hozzá az apróra vágott epret.\r\nEgy serpenyőben melegíts olajat vagy vajat, és süsd ki a palacsintákat mindkét oldalukon aranybarnára.\r\n', 'Cifra Konrád', NULL, NULL),
(78, 'edes', '1kremes', ' Vaníliakrémes', '\r\n1 csomag vaníliás pudingpor\r\n500 ml tej\r\n200 g cukor\r\n1 csomag vaníliás cukor\r\n250 g vaj\r\n1 csomag réteslap vagy leveles tészta', '\r\nA pudingport keverd el a cukorral és főzd meg a tejjel a csomagoláson leírtak szerint.\r\nHagyd kihűlni, majd keverd habosra a vajjal és a vaníliás cukorral.\r\nA réteslapot vagy leveles tésztát süsd meg, majd válaszd két részre.\r\nAz egyik lapra kenj vastagon a krémet, majd takard be a másik lappal.\r\nHagyd pihenni egy éjszakán át, hogy a tészta megpuhuljon.\r\n', 'Faragó Zoltán', NULL, NULL),
(79, 'edes', '1kremes', ' Csokoládékrémes', '\r\n1 csomag csokoládé pudingpor\r\n500 ml tej\r\n200 g cukor\r\n250 g vaj\r\n1 csomag réteslap vagy leveles tészta', '\r\nA pudingport keverd el a cukorral és főzd meg a tejjel a csomagoláson leírtak szerint.\r\nHagyd kihűlni, majd keverd habosra a vajjal.\r\nA réteslapot vagy leveles tésztát süsd meg, majd válaszd két részre.\r\nAz egyik lapra kenj vastagon a krémet, majd takard be a másik lappal.\r\nHagyd pihenni egy éjszakán át, hogy a tészta megpuhuljon.\r\n', 'Faragó Zoltán', NULL, NULL),
(80, 'edes', '1kremes', 'Karamellkrémes', '\r\n1 csomag karamell pudingpor\r\n500 ml tej\r\n200 g cukor\r\n250 g vaj\r\n1 csomag réteslap vagy leveles tészta', '\r\nA pudingport keverd el a cukorral és főzd meg a tejjel a csomagoláson leírtak szerint.\r\nHagyd kihűlni, majd keverd habosra a vajjal.\r\nA réteslapot vagy leveles tésztát süsd meg, majd válaszd két részre.\r\nAz egyik lapra kenj vastagon a krémet, majd takard be a másik lappal.\r\nHagyd pihenni egy éjszakán át, hogy a tészta megpuhuljon.\r\n', 'Vas Kinga', NULL, NULL),
(81, 'edes', '1kremes', ' Citromkrémes', '\r\n1 csomag citrom ízű pudingpor\r\n500 ml tej\r\n200 g cukor\r\n250 g vaj\r\n1 csomag réteslap vagy leveles tészta', '\r\nA pudingport keverd el a cukorral és főzd meg a tejjel a csomagoláson leírtak szerint.\r\nHagyd kihűlni, majd keverd habosra a vajjal.\r\nA réteslapot vagy leveles tésztát süsd meg, majd válaszd két részre.\r\nAz egyik lapra kenj vastagon a krémet, majd takard be a másik lappal.\r\nHagyd pihenni egy éjszakán át, hogy a tészta megpuhuljon.\r\n', 'Eszenyi Borbála', NULL, NULL),
(82, 'edes', '1kremes', ' Eperkrémes', '\r\n1 csomag vaníliás pudingpor\r\n500 ml tej\r\n200 g cukor\r\n250 g friss eper pürésítve\r\n250 g vaj\r\n1 csomag réteslap vagy leveles tészta', '\r\nA pudingport keverd el a cukorral és főzd meg a tejjel a csomagoláson leírtak szerint.\r\nHagyd kihűlni, majd keverd habosra a vajjal és az eperpürével.\r\nA réteslapot vagy leveles tésztát süsd meg, majd válaszd két részre.\r\nAz egyik lapra kenj vastagon a krémet, majd takard be a másik lappal.\r\nHagyd pihenni egy éjszakán át, hogy a tészta megpuhuljon.\r\n', 'Vas Kinga', NULL, NULL),
(83, 'ital', '3kave', 'Házi kávé latte', '\r\n1 csésze erős, frissen főzött kávé\r\n1 csésze melegített tej\r\n1 teáskanál cukor vagy ízlés szerint\r\nTejszínhab a tetejére (opcionális)', '\r\nFőzz egy csésze erős kávét.\r\nMelegítsd fel a tejet, majd habosítsd fel.\r\nÖntsd a kávét egy bögrébe, adj hozzá cukrot, majd öntsd rá a meleg tejet.\r\nTetejére teheted a tejszínhabot.', 'Kovács István', NULL, NULL),
(84, 'ital', '3kave', 'Jeges kávé', '\r\n1 csésze erős, frissen főzött kávé\r\nJégkockák\r\nHideg tej vagy tejszín\r\nÍzlés szerint cukor vagy édesítőszer', '\r\nHűtsd le a frissen főzött kávét.\r\nTölts egy poharat jégkockákkal, öntsd rá a kávét.\r\nAdj hozzá hideg tejet vagy tejszínt és cukrot ízlés szerint.\r\n', 'Kovács István', NULL, NULL),
(85, 'ital', '3kave', 'Házi Cappuccino', '\r\n1 rész espresso\r\n2 rész meleg tej\r\n2 rész tejhab', '\r\nFőzz egy adag espressot.\r\nMelegítsd fel a tejet, majd habosítsd fel.\r\nÖntsd az espressot egy bögrébe, majd öntsd rá a meleg tejet és végül a tejhabot.\r\n', 'Kovács István', NULL, NULL),
(86, 'ital', '3kave', ' Mokka', '\r\n1 rész espresso\r\n1 rész forró csokoládé\r\nTejhab a tetejére', '\r\nKészíts egy adag espressot.\r\nKészíts forró csokoládét.\r\nÖntsd össze az espressot a forró csokoládéval, majd tedd rá a tejhabot.\r\n', 'Vas Kinga', NULL, NULL),
(87, 'ital', '3kave', 'Macchiato', '2 rész meleg tej\r\n1 rész espresso\r\nTejhab a tetejére', '\r\nMelegítsd fel a tejet, majd habosítsd fel.\r\nÖntsd a meleg tejet egy magas pohárba, majd óvatosan öntsd rá az espressot.\r\nA tetejére kanalazz egy kevés tejhabot.', 'Vésnök Márton', NULL, NULL),
(88, 'ital', '3tea', 'Citromos Jegestea', '\r\n6 teáskanálnyi fekete tea vagy filteres tea\r\n1 bögrényi forró víz\r\nJégkockák\r\nFél liter hideg víz\r\nCitromkarikák\r\nCukor ízlés szerint', '\r\nÖnts le a teát a forró vízzel, majd áztasd 3-4 percig.\r\nAdj hozzá jeget és töltsd fel hideg vízzel.\r\nCsepegtess bele citromot és ízlés szerint cukrot.\r\nKész is vagy!', 'Vésnök Márton', NULL, NULL),
(89, 'ital', '3tea', 'Epres-mentás Jegestea', '\r\n4 dl hideg víz\r\n1 teáskanál szálas zöld tea\r\nEperszörp\r\nFél lime (zöldcitrom) leve\r\nJégkockák\r\nFriss mentabóbiták', '\r\nÖntsd le a zöld teát nem forróbb, mint 75°C fokos vízzel, majd áztasd 3 percig.\r\nSzűrd át egy hőálló tálba vagy fazékba.\r\nÖntsd hozzá a 4 dl hideg vizet és az eperszörpöt.\r\nCsepegtess bele egy fél lime levét és tedd hűtőszekrénybe 2 órára.\r\nTálaláskor öntsd át egy jégkockákkal és mentabóbitákkal teli üvegkancsóba.\r\n', 'Faragó Zoltán', NULL, NULL),
(90, 'ital', '3tea', 'Gyömbér Tea', '\r\nKb. 30 gramm gyömbér\r\n1,2 liter hideg víz\r\n1 rúd egész fahéj\r\n2 darab szegfűszeg\r\nCitrom és méz ízlés szerint', '\r\nVágd fel vagy reszeld le a gyömbért apró darabokra.\r\nForralj fel a gyömbérrel, fahéjjal és szegfűszeggel 20 percig.\r\nSzűrd le egy kancsóba, ízesítsd citrommal és mézzel.\r\n', 'Vas Kinga', NULL, NULL),
(91, 'ital', '3tea', 'Mézes Kamilla Tea', '\r\n2 teáskanálnyi szárított kamillavirág\r\n1 bögrényi forró víz\r\n1 teáskanálnyi méz', '\r\nForralj fel vizet.\r\nAdj hozzá a kamillavirágot és áztasd 5 percig.\r\nSzűrd le és ízesítsd mézzel.', 'Eszenyi Borbála', NULL, NULL),
(92, 'ital', '3tea', 'Bodzavirág Tea', '\r\nFriss vagy szárított bodzavirág\r\nForró víz\r\nCitrom vagy méz ízlés szerint', '\r\nSzedj friss bodzavirágot vagy használj szárítottat.\r\nÖntsd le a virágokkal forró vízzel és áztasd 5-10 percig.\r\nÍzesítheted citrommal vagy mézzel.\r\n', 'Kovács István', NULL, NULL),
(93, 'ital', '3limonade', 'Frissítő Citromos Nyári Limonádé', '\r\n30 db citrom\r\n50 szál menta\r\n20 evőkanál méz\r\n1500 g kristálycukor\r\n30 liter víz', '\r\nFacsard ki a citromok levét.\r\nKeverd össze a citromlevet, a mentát, a mézet és a cukrot.\r\nAdj hozzá a vízhez, majd jól keverd össze.\r\nSzűrd le, hűtsd le, majd tálald jégkockával.\r\n', 'Eszenyi Borbála', NULL, NULL),
(94, 'ital', '3limonade', 'Levendulás-Mentás Limonádé', '\r\n10 db citrom\r\n20 szál menta\r\n5 evőkanál méz\r\n1 evőkanál levendula\r\n1 liter víz', '\r\nFacsard ki a citromok levét.\r\nKeverd össze a citromlevet, a mentát, a mézet és a levendulát.\r\nAdj hozzá a vízhez, majd jól keverd össze.\r\nHűtsd le, majd tálald jégkockával.', 'Vas Kinga', NULL, NULL),
(95, 'ital', '3limonade', 'Bodzalimonádé', '\r\n10 db bodza virág\r\n1 liter víz\r\n10 evőkanál cukor\r\n1 citrom', '\r\nÁztasd be a bodza virágokat vízbe.\r\nKeverd össze a cukrot és a vizet.\r\nAdj hozzá a citromlevet, majd hűtsd le.\r\nSzűrd le, majd tálald jégkockával.\r\n', 'Cifra Konrád', NULL, NULL),
(96, 'ital', '3limonade', 'Málnás Limonádé', '\r\n10 db citrom\r\n20 szál menta\r\n5 evőkanál méz\r\n1 evőkanál levendula\r\n1 liter víz', '\r\nFacsard ki a citromok levét.\r\nKeverd össze a citromlevet, a mentát, a mézet és a levendulát.\r\nAdj hozzá a vízhez, majd jól keverd össze.\r\nHűtsd le, majd tálald jégkockával.\r\n', 'Kovács István', NULL, NULL);
INSERT INTO `receptek` (`azonosito`, `tipus`, `kategoria`, `nev`, `hozzavalok`, `elkeszites`, `feltoltotte`, `ertekeles`, `darab`) VALUES
(97, 'ital', '3limonade', 'Epres Limonádé', '\r\n10 db citrom\r\n20 szál menta\r\n5 evőkanál méz\r\n1 evőkanál levendula\r\n1 liter víz', '\r\nFacsard ki a citromok levét.\r\nKeverd össze a citromlevet, a mentát, a mézet és a levendulát.\r\nAdj hozzá a vízhez, majd jól keverd össze.\r\nHűtsd le, majd tálald jégkockával.', 'Faragó Zoltán', NULL, NULL),
(98, 'ital', '3shake', 'Csokis Shake', '\r\n4 deciliter tej\r\n3 evőkanál instant kakaópor\r\n20 dkg csokoládé fagylalt', '\r\nTurmixgépbe tegyük a hozzávalókat és habosra turmixoljuk.\r\nTetejére szórjunk egy marék perecet.\r\n', 'Eszenyi Borbála', NULL, NULL),
(99, 'ital', '3shake', 'Mogyoróvajas Shake', '\r\n1 adag mogyoróvajas krémes shake', '\r\nTurmixgépben keverjük össze a mogyoróvajas krémet.\r\n', 'Faragó Zoltán', NULL, NULL),
(100, 'ital', '3shake', 'Banán Shake', '\r\n3 gombóc vanília jégkrém\r\n1,5-2 dl tej\r\n1 banán\r\n1/2 csomag vaníliás puding (főzés nélküli)', '\r\nTurmixgépben keverjük össze a hozzávalókat.', 'Vas Kinga', NULL, NULL),
(101, 'ital', '3shake', 'Epres Shake Keksszel', '\r\n3 gombóc eper fagyi\r\n1,5-2 dl tej\r\n1 marék apróra darált keksz\r\n1 marék eper', '\r\nTurmixgépben keverjük össze az eper fagyit, tejet és kekszet.\r\n', 'Faragó Zoltán', NULL, NULL),
(102, 'ital', '3shake', 'Sós Karamellás Shake', '\r\n3 gombóc vanília jégkrém\r\n1,5-2 dl tej\r\nKaramella öntet\r\nTetejére egy marék perec', '\r\nTurmixgépben keverjük össze a hozzávalókat.\r\n', 'Eszenyi Borbála', NULL, NULL),
(104, 'ital', '3kave', 'Tejeskávé', '2 evőkanál őrölt kávé (frissen őrölve a legjobb!)\r\n300 ml víz\r\nTej vagy tejszín (opcionális)\r\nCukor vagy édesítőszer (ízlés szerint)', 'Melegítsd fel a vizet egy fazékban vagy vízforralóban, amíg majdnem forrni kezd, de még nem forr. Helyezz egy papír vagy textil szűrőt egy kávéfőző gépbe vagy egy French Press-be, majd önts bele két evőkanál őrölt kávét. Lassan és egyenletesen öntsd rá a forró vizet a kávéra. Vigyázz, hogy minden őrölt kávét ellepjen a víz. Hagyd ázni a kávét 3-4 percig, hogy kinyerje az aromáit és az ízeit. Ha használsz szűrőt, lassan nyomd le a szűrőt, hogy kiszűrd a kávét. Ha French Press-t használsz, csak lassan toljad le a dugót. Ha szereted tejjel vagy tejszínnel, adj hozzá az elkészült kávéhoz. Ízlés szerint add hozzá a cukrot vagy édesítőszert. Keverd össze, majd szervírozd azonnal.', 'Kovács István', 7.00, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekek`
--

CREATE TABLE `termekek` (
  `azonosito` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `kep` blob NOT NULL,
  `ar` varchar(50) NOT NULL,
  `tipus` varchar(100) NOT NULL,
  `kategoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `termekek`
--

INSERT INTO `termekek` (`azonosito`, `nev`, `kep`, `ar`, `tipus`, `kategoria`) VALUES
(4, 'Vajas Kifli', 0x696d672f76616a61734b69666c692e6a7067, '60', 'sos', '2kifli'),
(5, 'Foghagymás Kifli', 0x696d672f6b69666c692e6a7067, '65', 'sos', '2kifli'),
(6, 'Sajtos Kifli', 0x696d672f73616a746f7376616a61734b69666c692e6a706567, '70', 'sos', '2kifli'),
(7, 'Fehér Kenyér', 0x696d672f66656865726b656e7965722e6a7067, '800', 'sos', '2kenyer'),
(8, 'Kovászos Kenyér', 0x696d672f6b656e7965722e6a7067, '950', 'sos', '2kenyer'),
(9, 'Teljeskiőrlésű Kenyér', 0x696d672f6b6f7661737a6f732e6a7067, '970', 'sos', '2kenyer'),
(10, 'Szalámis Szendvics', 0x696d672f737a656e6476696373537a616c616d69732e6a7067, '450', 'sos', '2szendvics'),
(11, 'Fasírtos Szendvics', 0x696d672f6661736972746f73737a656e64766963732e6a7067, '650', 'sos', '2szendvics'),
(12, 'Retro Melegszendvics', 0x696d672f726574726f6d656c6567737a656e64766963732e6a7067, '700', 'sos', '2szendvics'),
(13, 'Sajtos tekercs', 0x696d672f74656b657263732e6a7067, '350', 'sos', '2tekercs'),
(14, 'Sonkás Tekercs', 0x696d672f736f6e6b617374656b657263732e6a7067, '450', 'sos', '2tekercs'),
(15, 'Sos tekercs', 0x696d672f736f7374656b657263732e6a7067, '450', 'sos', '2tekercs'),
(16, 'Sima Bagett', 0x696d672f6261676574742e6a7067, '500', 'sos', '2bagel'),
(17, 'Fokhagymas Bagett', 0x696d672f666f6b686167796d61736261676574742e6a7067, '600', 'sos', '2bagel'),
(18, 'Sós Perec', 0x696d672f70657265632e6a7067, '200', 'sos', '2perec'),
(19, 'Talleros Perec', 0x696d672f736a61746f7374616c6c65726f732e4a5047, '250', 'sos', '2perec'),
(20, 'Bajor Perec', 0x696d672f62616a6f7270657265632e6a7067, '300', 'sos', '2perec'),
(21, 'Lepény', 0x696d672f6c6570656e7953696d612e6a7067, '400', 'sos', '2lepeny'),
(22, 'Juhtúrós Lepény', 0x696d672f6a687475726f736c6570656e792e6a7067, '650', 'sos', '2lepeny'),
(23, 'Bourbon torta', 0x696d672f626f7572626f6e2e6a7067, '3500', 'edes', '1torta'),
(24, 'Gyümölcs Torta', 0x696d672f4779756d6f6c6373746f7274612e6a7067, '4500', 'edes', '1torta'),
(25, 'Marcipános Torta', 0x696d672f6d6172636970616e6f73746f7274612e6a7067, '4000', 'edes', '1torta'),
(26, 'Csokis Keksz', 0x696d672f63736f6b69734b656b737a2e6a7067, '250', 'edes', '1keksz'),
(27, 'Vaníliás Keksz', 0x696d672f76616e696c6961732e6a7067, '250', 'edes', '1keksz'),
(28, 'Macaron', 0x696d672f6d616361726f6e2e6a7067, '400', 'edes', '1keksz'),
(29, 'Kakaós Muffin', 0x696d672f6b616b616f734d756666696e2e6a7067, '400', 'edes', '1muffin'),
(30, 'Házirétes Muffin', 0x696d672f6d756666696e68617a6972657465732e6a7067, '450', 'edes', '1muffin'),
(31, 'Marcipános Muffin', 0x696d672f6d756666696e6d6172632e6a7067, '400', 'edes', '1muffin'),
(32, 'Vegyes Fagyi', 0x696d672f6661677969446f626f7a6f732e6a7067, '1300', 'edes', '1fagylalt'),
(33, 'Epres Fagyi', 0x696d672f657072657366616779692e6a7067, '1600', 'edes', '1fagylalt'),
(34, 'Farsangi Fánk', 0x696d672f737a616c61676f7366616e6b2e6a7067, '500', 'edes', '1fank'),
(35, 'Csokis Fánk', 0x696d672f63736f6b697346616e6b2e6a7067, '300', 'edes', '1fank'),
(36, 'Amerikai palacsinta', 0x696d672f616d6572696b616963736f6b696f6e74657474656c2e6a7067, '600', 'edes', '1palacsinta'),
(37, 'Epres palacsinta', 0x696d672f657072657370616c616373696e74612e6a7067, '600', 'edes', '1palacsinta'),
(38, 'Gundel palacsinta', 0x696d672f67756e64656c70616c616373696e74612e6a7067, '700', 'edes', '1palacsinta'),
(39, 'Skót Krémes', 0x696d672f736b6f746b72656d65732e6a7067, '700', 'edes', '1kremes'),
(40, 'Csokis Krémes', 0x696d672f63736f6b69736b72656d65732e6a7067, '750', 'edes', '1kremes'),
(41, 'Mézes Krémes', 0x696d672f6d657a65736b72656d65732e6a7067, '600', 'edes', '1kremes'),
(42, 'Espresso', 0x696d672f657370726573736f2e6a7067, '250', 'ital', '3kave'),
(43, 'Dolce Gusto', 0x696d672f646f6c6365677573746f2e6a7067, '400', 'ital', '3kave'),
(44, 'Hosszú Kávé', 0x696d672f686f73737a756b6176652e6a7067, '300', 'ital', '3kave'),
(45, 'Mézes tea', 0x696d672f6d657a65737465612e6a7067, '400', 'ital', '3tea'),
(46, 'Kamilla tea', 0x696d672f6b616d696c6c617465612e6a7067, '300', 'ital', '3tea'),
(47, 'Zöld tea', 0x696d672f7a6f6c647465612e6a7067, '200', 'ital', '3tea'),
(49, 'Citromos limonádé', 0x696d672f636974726f6d6f736c696d6f6e6164652e6a7067, '700', 'ital', '3limonade'),
(50, 'Candy Shake', 0x696d672f63616e64797368616b652e6a7067, '800', 'ital', '3shake'),
(51, 'Caramell Shake', 0x696d672f636172616d656c6c7368616b652e6a7067, '850', 'ital', '3shake'),
(52, 'Vanilia Shake', 0x696d672f76616e696c69617368616b652e6a7067, '900', 'ital', '3shake'),
(53, 'Almás pite', 0x696d672f616c6d6173506974652e6a7067, '450', 'edes', '1pite'),
(62, 'Epres Limonádé', 0x696d672f65707265736c696d6f6e6164652e6a7067, '600', 'ital', '3limonade'),
(63, 'Sajtos pogácsa', 0x696d672f706f67616373612e6a7067, '300', 'sos', '2pugacsa');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termekleiras`
--

CREATE TABLE `termekleiras` (
  `azonosito` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `tipus` varchar(100) NOT NULL,
  `kategoria` varchar(100) NOT NULL,
  `kep` blob NOT NULL,
  `leiras` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `termekleiras`
--

INSERT INTO `termekleiras` (`azonosito`, `nev`, `tipus`, `kategoria`, `kep`, `leiras`) VALUES
(9, 'Kifli', 'sos', '2kifli', 0x696d672f6b69666c692e6a7067, 'Tápérték információ / 100g\r\nEnergia: 243 kcal\r\nZsír: 2,2 g\r\n- ebből telített zsírsav: 0,6 g\r\nSzénhidrát: 47 g\r\n- ebből cukor: 2,8 g\r\nRost: 1,8 g\r\nFehérje: 8,3 g\r\nSó: 0,88 g\r\nAllergének:\r\nÉdesítőszer\r\nGlutén\r\nTojás\r\nFöldimogyoró'),
(10, 'Kenyér', 'sos', '2kenyer', 0x696d672f6b656e7965722e6a7067, 'Tápérték információ / 100g\r\nEnergia:  249 kcal\r\nZsír: 1,8 g\r\n- ebből telített zsírsav: 0,6 g\r\nSzénhidrát: 49 g\r\n- ebből cukor: 1,6 g\r\nRost: 1,8 g\r\nFehérje: 8,3 g\r\nSó: 1,2 g\r\nAllergének:\r\nÉdesítőszer\r\nGlutén\r\nSzójabab\r\nTej\r\nDiófélék'),
(11, 'Szendvics', 'sos', '2szendvics', 0x696d672f6661736972746f73737a656e64766963732e6a7067, 'Tápérték információ / 100g\r\nEnergiatartalom: 305Kcal\r\nZsír: 15,0g\r\n- ebből telített zsírsav: 6,6g\r\nSzénhidrát: 32,0g\r\n- ebből cukor: 0,8g\r\nRost: 1,1g\r\nFehérje: 9,4g\r\nSó: 9g\r\nAllergének:\r\nGlutén\r\nMustár'),
(12, 'Tekercs', 'sos', '2tekercs', 0x696d672f736f6e6b617374656b657263732e6a7067, 'Tápérték információ / 100g\r\nEnergia: 367 kcal \r\nZsír: 21 g\r\n - ebből telített zsírsav: 11 g\r\nSzénhidrát: 33 g\r\n- ebből cukor: 3,8g \r\nRost: 1,1 g\r\nFehérje: 11 g\r\nSó: 1,5 g\r\nAllergének:\r\nTej\r\nDiófélék\r\nZeller\r\nMustár'),
(13, 'Bagett', 'sos', '2bagel', 0x696d672f6261676574742e6a7067, 'Tápérték információ / 100g\r\nEnergia:  310 kcal\r\nZsír: 6,4 g\r\n- ebből telített zsírsav: 2,4 g\r\nSzénhidrát: 53 g\r\n- ebből cukor: 3,6 g \r\nRost: 2,3 g\r\nFehérjetartalom: 9,4 g\r\nSó: 2,2 g\r\nAllergének:\r\nTej\r\nDiófélék\r\nZeller\r\nMustár\r\nSzezámmag\r\nCsillagfürt'),
(14, 'Perec', 'sos', '2perec', 0x696d672f62616a6f7270657265632e6a7067, 'Tápérték információ / 100g\r\nEnergiatartalom: 297 kcal\r\nZsír: 6,2 g\r\n- ebből telített zsírsav: 1,9 g\r\nSzénhidrát: 47,5 g\r\n- ebből cukor: 3,1 g\r\nFehérje: 11,3 g\r\nSó: 1,67 g\r\nAllergének:\r\nTej \r\nMustár\r\nSzója\r\nTojás'),
(15, 'Lepény', 'sos', '2lepeny', 0x696d672f6c6570656e7953696d612e6a7067, 'Tápérték információ / 100g\r\nEnergiatartalom: 297 kcal\r\nZsír: 6,2 g\r\n- ebből telített zsírsav: 1,9 g\r\nSzénhidrát: 47,5 g\r\n- ebből cukor: 3,1 g\r\nFehérje: 11,3 g\r\nSó: 1,67 g\r\nAllergének:\r\nGlutén\r\nRákfélék\r\nTojás\r\nHalak'),
(16, 'Torta', 'edes', '1torta', 0x696d672f626f7572626f6e2e6a7067, 'Tápérték információ / 100g\r\nEnergiatartalom: 389 kcal\r\nZsír: 6,2 g\r\n- ebből telített zsírsav: 1,9 g\r\nSzénhidrát: 52,84 g\r\n- ebből cukor: 39,96 g\r\nFehérje: 3,48 g\r\nSó: 1,67 g\r\nKoleszterin: 22 g\r\nRost: 2,2 g\r\nAllergének:\r\nGlutén\r\nTojás\r\nTej '),
(17, 'Keksz', 'edes', '1keksz', 0x696d672f63736f6b69734b656b737a2e6a7067, 'Tápérték információ / 100g\r\nEnergiatartalom: 420 kcal\r\nZsír: 26,6 g\r\n- ebből telített zsírsav: 19,9 g\r\nSzénhidrát: 24,3 g\r\n- ebből cukor: 14 g\r\nFehérje: 3,3 g\r\nSó: 0,01 g\r\nAllergének:\r\nGlutén\r\nSzulfit \r\nTej \r\nDiófélék\r\nFöldimogyoró'),
(18, 'Muffin', 'edes', '1muffin', 0x696d672f6b616b616f734d756666696e2e6a7067, 'Tápérték információ / 100g\r\nEnergiatartalom: 456 kcal\r\nZsír: 27 g\r\n- ebből telített zsírsav: 5,5 g\r\nSzénhidrát: 49 g\r\n- ebből cukor: 28 g\r\nFehérje: 4,2 g\r\nAllergének:\r\nGlutén\r\nTojás\r\nTej \r\nSzójabab'),
(19, 'Fagylalt', 'edes', '1fagylalt', 0x696d672f657072657366616779692e6a7067, 'Tápérték információ / 100g\r\nKalória: 249 kcal\r\nFehérje:3,5 g\r\nSzénhidrát:	22,29 g\r\n- amelyből cukor:	20,65 g\r\nZsír:	16,2 g\r\n- ebből telített zsírsavak 10,33 g\r\nNátrium	0,06 g\r\nKoleszterin: 92 g\r\nAllergének:\r\nGlutén\r\nKókusz\r\nMandula'),
(20, 'Fánk', 'edes', '1fank', 0x696d672f63736f6b697346616e6b2e6a7067, 'Tápérték információ / 100g\r\nKalória: 340 kcal	\r\nFehérje: 5,9 g	\r\nSzénhidrát: 39 g	\r\n- amelyből cukor: 21,1 g	\r\nZsír: 18,7 g	\r\n- amelyből telített zsírsavak: 4,84 g\r\nAllergének:\r\nGlutén\r\nTojás\r\nSzójabab\r\nFöldimogyoró'),
(21, 'Palacsinta', 'edes', '1palacsinta', 0x696d672f616d6572696b616963736f6b696f6e74657474656c2e6a7067, 'Tápérték információ / 100g\r\nKalória: 227 kcal\r\nFehérje: 6,4 g\r\nSzénhidrát: 28,3 g\r\nZsír: 9,7 g\r\n- amelyből telített zsírsavak: 2,12 g\r\nKoleszterin: 59 g\r\nAllergének:\r\nGlutén\r\nTojás\r\nSzója'),
(22, 'Krémes', 'edes', '1kremes', 0x696d672f736b6f746b72656d65732e6a7067, 'Tápérték információ / 100g\r\nEnergiatartalom: 344 kcal\r\nZsír: 18,8 g\r\n- amelyből telített zsírsavak: 11,9 g\r\nSzénhidrát:	45,3 g\r\n- amelyből cukrok: 30 g\r\nFehérje: 4,6 g\r\nSó:	0,62 g\r\nAllergének:\r\nGlutén\r\nÉdesítőszer'),
(23, 'Kávé', 'ital', '3kave', 0x696d672f657370726573736f2e6a7067, 'Tápérték információ / csésze\r\nEnergiatartalom: 9 kcal\r\nZsír: 0,18 g\r\n- amelyből telített zsírsavak: 0,9 g\r\nSzénhidrát: 1,67 g\r\nFehérje: 0,12 g'),
(24, 'Tea', 'ital', '3tea', 0x696d672f6d657a65737465612e6a7067, 'Tápérték információ /100 ml\r\nEnergia tartalom 2 kcal \r\nFehérje: 0 g\r\nSzénhidrát: 0,5 g\r\nZsír: 0 g\r\nRost: 0 g\r\nSó: 0 g'),
(26, 'Shake', 'ital', '3shake', 0x696d672f63616e64797368616b652e6a7067, 'Tápérték információ / adag\r\nEnergia: 118,8 kcal\r\nZsír: 2,5 g\r\n- amelyből telített zsírsavak: 1,7 g\r\nSzénhidrát 20,9 g\r\n- amelyből cukrok: 18,4 g\r\nRost : 0,4	g\r\nFehérje: 3,1 g\r\nSó : 0,2 g\r\nAllergének:\r\nTej'),
(27, 'Pite', 'edes', '1pite', 0x696d672f616c6d6173506974652e6a7067, 'Tápérték információ / 100g\r\nEnergiatartalom: 486 kcal\r\nZsír: 27 g\r\n- ebből telített zsírsav: 5,5 g\r\nSzénhidrát: 49 g\r\n- ebből cukor: 28 g\r\nFehérje: 4,2 g\r\nAllergének:\r\nGlutén\r\nTojás\r\nTej \r\nSzójabab'),
(29, 'Limonádé', 'ital', '3limonade', 0x696d672f65707265736c696d6f6e6164652e6a7067, 'Tápérték információ / 100 ml\r\nEnergia tartalom: 132 kcal\r\nZsír: 0 g\r\n- amelyből telített zsírsavak: 0 g\r\nSzénhidrát: 0,8 g\r\n- amelyből cukrok: 10 g\r\nFehérje: 0 g\r\nSó: 0 g');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ertekeles`
--
ALTER TABLE `ertekeles`
  ADD KEY `ki` (`ki`),
  ADD KEY `ertekeles_ibfk_3` (`mit`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`azonosito`);

--
-- A tábla indexei `kosar`
--
ALTER TABLE `kosar`
  ADD PRIMARY KEY (`azonosito`),
  ADD KEY `kosar_ibfk_1` (`felhasznalo_azonosito`);

--
-- A tábla indexei `receptek`
--
ALTER TABLE `receptek`
  ADD PRIMARY KEY (`azonosito`);

--
-- A tábla indexei `termekek`
--
ALTER TABLE `termekek`
  ADD PRIMARY KEY (`azonosito`);

--
-- A tábla indexei `termekleiras`
--
ALTER TABLE `termekleiras`
  ADD PRIMARY KEY (`azonosito`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT a táblához `kosar`
--
ALTER TABLE `kosar`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT a táblához `receptek`
--
ALTER TABLE `receptek`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT a táblához `termekek`
--
ALTER TABLE `termekek`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT a táblához `termekleiras`
--
ALTER TABLE `termekleiras`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ertekeles`
--
ALTER TABLE `ertekeles`
  ADD CONSTRAINT `ertekeles_ibfk_2` FOREIGN KEY (`ki`) REFERENCES `felhasznalok` (`azonosito`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ertekeles_ibfk_3` FOREIGN KEY (`mit`) REFERENCES `receptek` (`azonosito`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Megkötések a táblához `kosar`
--
ALTER TABLE `kosar`
  ADD CONSTRAINT `kosar_ibfk_1` FOREIGN KEY (`felhasznalo_azonosito`) REFERENCES `felhasznalok` (`azonosito`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
