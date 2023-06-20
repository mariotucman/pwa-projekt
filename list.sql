-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 05:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `list`
--
CREATE DATABASE IF NOT EXISTS `list` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `list`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `korisnicko_ime` varchar(32) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Ivan', 'Horvat', 'ivanh', '$2y$10$X/CYNGk/lA0UZbUBeBAXPOCc9/XdQmAN7Bek0bd8GDQH/FUQ1UpHa', 0),
(2, 'adminIme', 'adminPrezime', 'admin', '$2y$10$WUaXAgZ1moTecq8MyN4V4e1qb3gNiVary7NqDSfT8vdw9rF1mFlhy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `podnaslov` varchar(50) NOT NULL,
  `sazetak` varchar(255) NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(64) NOT NULL,
  `kategorija` varchar(64) NOT NULL,
  `arhiva` tinyint(1) NOT NULL,
  `datum` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `naslov`, `podnaslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`, `datum`) VALUES
(1, 'MOL ostvario osjetno manju dobit u prvom tromjesečju', 'Naglasili negativan utjecaj reguliranih cijena RH', 'MAĐARSKA naftna i plinska grupa MOL izvijestila je u petak o osjetno manjoj dobiti u prvom tromjesečju, izdvojivši pad cijena energenata na svjetskim tržištima i porez na ekstraprofit u matičnoj Mađarskoj.', 'Ukupni operativni prihod grupe porastao je u prvom tromjesečju za osam posto, na 2.1 bilijun forinti (5.65 milijardi eura).\r\n\r\nČista dobit prije kamata, poreza, deprecijacije i amortizacije, prilagođena za promjene vrijednosti zaliha (čista CCS EBITDA), smanjila se za 14 posto, na 714 milijuna dolara. Mađarska je postupno ukinula ograničenje cijena goriva, ali na rezultat je utjecao porez na ekstraprofit, u iznosu od 350 milijuna dolara, navode u MOL-u.\r\n\r\nNaglasili negativan utjecaj reguliranih cijena u Hrvatskoj\r\nNeto dobit pala je za 13 posto, na 167.2 milijarde forinti. U odjelu prerade i prodaje čista EBITDA, prilagođena za promjenu vrijednosti zaliha, porasla je 18 posto, na 299 milijuna dolara, zahvaljujući dobrim rezultatima u rafinerijskom poslovanju.\r\n\r\nU odjelu istraživanja i proizvodnje prilagođena EBITDA smanjena je pak za 44 posto, na 283 milijuna dolara, što u MOL-u objašnjavaju padom cijena energenata na svjetskim tržištima.\r\n\r\nIstiču i negativan utjecaj viših rojaliteta u matičnoj Mađarskoj i reguliranih cijena u Hrvatskoj, u iznosu od 130 milijuna dolara. MOL je u prvom kvartalu proizveo 96 tisuća ekvivalenata barela nafte dnevno, neznatno više nego u istom lanjskom kvartalu, no znatno više od zacrtanih 90 tisuća barela dnevno.\r\n\r\nKompanija bi mogla imati problema s ostvarivanjem ciljeva\r\nOrganska kapitalna ulaganja bila su pak za 39.3 posto manja nego u istom lanjskom kvartalu, kliznuvši na 196 milijuna dolara, signalizirajući da bi kompanija mogla imati problema s ostvarivanjem zacrtanog godišnjeg cilja o 1.7 milijardi dolara ulaganja u 2023.\r\n\r\n\"MOL je ostvario stabilne rezultate u prvom tromjesečju 2023. jer je normalizacija makro uvjeta uglavnom ublažena dobrim internim rezultatima divizija\", rekao je izvršni direktor MOL-a Zsolt Hernádi.', '9349c53c-8664-454d-8485-77be4093d281.jpg', 'politika', 0, '12.05.2023.'),
(2, 'SAD: Kina nam je obećala da neće slati oružje Rusiji', 'Bilateralni odnosi ostaju napeti', 'AMERIČKI državni tajnik Antony Blinken danas je, tijekom svog dvodnevnog posjeta Pekingu, rekao kako je Kina ponovila svoje obećanje da neće slati naoružanje Rusiji za rat protiv Ukrajine.', '\"Mi smo, kao i druge zemlje, dobili garancije od Kine da nije i neće davati smrtonosnu pomoć Rusiji za korištenje u Ukrajini\", rekao je šef američke diplomacije novinarima nakon dva dana razgovora u kineskoj prijestolnici. \r\n\r\n\"Nismo vidjeli dokaze koji govore suprotno. No ono što nas i dalje brine je mogućnost da kineske tvrtke Rusiji isporučuju tehnologiju koju može koristiti za nastavak agresije na Ukrajinu\", dodao je pozvavši kinesku vladu da bude \"oprezna\" po tom pitanju. \r\n\r\n\"Dvije strane postigle su napredak i pronašle zajednički jezik\"\r\nBlinken je rekao da su kineska obećanja dana i \"proteklih tjedana\", a ne samo tijekom njegovog posjeta.  Washington je ranije izražavao zabrinutost oko mogućnosti da Kina Rusiji šalje naoružanje. \r\n\r\nTvrdeći da je neutralna u sukobu, Kina poziva na poštovanje suvereniteta država, uključujući Ukrajine, no nikad nije javno osudila rusku vojnu agresiju na tu zemlju. Kineski predsjednik Xi Jinping pozdravio je pak \"napredak\" i pronalaženje \"zajedničkog jezika\" Pekinga i Washingtona, uslijed tenzija između dviju država. \r\n\r\n\"Dvije strane postigle su napredak i pronašle zajednički jezik u nekoliko specifičnih točaka\", rekao je Xi ne navodeći o kojim se točkama radi, u obraćanju emitiranom na kineskoj državnoj televiziji.\r\n\r\nBilateralni odnosi ostaju napeti\r\n\"Nadam se da će Blinken ovim posjetom donijeti pozitivan rezultat za stabilizaciju odnosa između Kine i SAD-a\", naglasio je Xi.\r\n\r\nI sam Blinken je potvrdio da dvije sile žele \"stabilizirati\" odnose, no priznao je i da postoje mnoge nesuglasice. \"Nemamo iluzija o izazovima upravljanja ovim odnosom. Postoje mnoga pitanja oko kojih se duboko - čak žestoko - ne slažemo\", rekao je američki državni tajnik.\r\n\r\nSusret Xija i Blinkena dogodio se drugog, posljednjeg posjeta državnog tajnika Kini, prvog nakon pet godina. \r\n\r\nOsim po pitanju Tajvana, Peking i Washington spore se po nizu drugih pitanja, zbog čega bilateralni odnosi ostaju napeti. \r\n\r\nMeđu njima se izdvajaju tehnološki ratovi, američke sankcije kineskih digitalnih giganata, trgovinska pitanja, tretman prema muslimanskoj zajednici Ujgura i kineska svojatanja Južnog kineskog mora. ', '69086c84-d7e9-40e5-9614-35782d55c70e.jpg', 'politika', 0, '19.06.2023.'),
(3, 'Predsjednica Europskog parlamenta: Mladi, aktivirajte se u politici', 'Mladi nisu glasali. Njihovi djedovi jesu.', 'PREDSJEDNICA Europskog parlamenta Roberta Metsola danas je u Zagrebu pozvala mlade na veći angažman u politici, naglasivši da su prošla vremena kad nije bilo potrebno suprotstavljati se populizmu i dezinformacijama.', 'Metsola, predsjednica Europskog parlamenta od siječnja 2022. godine, na Muzičkoj akademiji Sveučilišta u Zagrebu odgovarala je na pitanja srednjoškolaca i studenata, ispričavši im svoj politički put od svog ranog aktivizma do te funkcije na kojoj je ona tek treća žena u povijesti. \r\n\r\n\"Nije važna veličina države nego veličina ideja\"\r\nDanas 44-godišnja Maltežanka prvi put se kandidirala na europskim izborima kao 24-godišnjakinja, na prijedlog tadašnjeg premijera kojemu je \"nedostajalo mladih i žena\". Tada u inozemstvu, Metsola je nevoljko prihvatila, braneći se od te ideje jer nije imala sredstava te je smatrala da to neće \"sjesti\" njezinim roditeljima.\r\n\r\nU parlament je ušla tek u trećem pokušaju, a iste godine se kandidirao i njezin suprug s kojim je imala dvoje djece. Kako će uskladiti političku karijeru i obitelj, pitali su samo nju, prepričala je Maltežanka u Zagrebu. \r\n\r\n\"Ako želite biti zastupnik, nemojte odustajati\", poručila je predsjednica EP-a koja stiže iz najmanje članice Europske unije. \r\n\r\n\"Nije važna veličina države nego veličina ideja, možete biti od bilo gdje\", naglasila je. Metsola se prisjetila i referenduma o ulasku njezine zemlje u EU i snažne kampanje \"dezinformacija\" i \"širenja straha\" onih koji su se tome protivili – na kraju je Malta za ulazak glasala sa samo 53.65 posto te je zemlja ušla u EU 2004. godine. \r\n\r\nNešto manje od godinu dana prije izbora za Europski parlament Metsola je pozvala mlade da se suprotstave onima koji šire dezinformacije. \r\n\r\n\"Borite se, dugo se nismo borili\"\r\n\"Danas je moj odgovor – borite se. Dugo se nismo borili, mislili smo da će, štogod se dogodilo, većina biti konstruktivna, no to više nije slučaj\", kazala je. Ključno je spriječiti miješanje trećih država, naglašavati dobrobiti koje je EU donijela europskim građanima, komunicirati na jednostavan i iskren način.\r\n\r\nNa izborima iduće godine u četiri države glasat će i 16-godišnjaci, a među njima je i Malta. Među glasačima južne otočne države bit će i Metsolin sin Luca za kojeg je, dan nakon što je Hrvatska na penalima izgubila od Španjolske u finalu Lige nacija, rekla da je dobio ime po Modriću kojeg \"jako želi upoznati\". \r\n\r\nPredsjednica EP-a je naglasila da ona podržava ideju snižavanja dobi za glasanje koje \"nije samo privilegij već i dužnost\". Istaknula je važnost podsjećanja da mnogi u svijetu nemaju pravo glasa ili on ne vrijedi jer je riječ o društvima koja nisu u potpunosti demokratska. Maltežanka smatra kako 16-godišnjaci mogu biti i kandidati na izborima, što \"nije lako, ali je moguće\". \r\n\r\n\"Mladi nisu glasali. Njihovi djedovi jesu\"\r\n\"Kad sam bila mlada, mrzila sam kad bi neki stari političar, poput mene danas, govorio da smo mi budućnost\", nastavila je Metsola. \r\n\r\n\"Ja bih rekla \"ja sam tu\", mi nismo budućnost, mi smo sadašnjost. Ako donosite odluke, uzmite nas u obzir, da ne bude ništa o mladima bez mladih\", rekla je. Metsola je u izlaganju rekla i kako su neki od najuspješnijih zastupnika u EP-u mladi te da žali zbog odluka poput Brexita, donesenim bez velike izlaznosti mladih na birališta. \r\n\r\n\"Mladi nisu glasali. Njihovi djedovi jesu\", rekla je o odluci Ujedinjenog Kraljevstva da izađe iz Europske unije, dodavši i primjer francuskih izbora na kojem se bilježi manja izlaznost mladih. \r\n\r\nS druge strane, na referendumu o članstvu Malte prevagu su donijeli upravo mladi koji su se aktivirali, naglasila je godinu dana prije 20. godišnjice članstva Malte u EU. \r\n', '4b7de003-b45e-41c8-bc9b-95bb0c411b9f.jpg', 'politika', 0, '19.06.2023.'),
(4, 'Ministarstvo: Novi dodaci za sudske službenike doveli bi do nove nepravde', 'U sindikatu ostaju pri prijedlogu povećanja plaća', 'Iz Ministarstva pravosuđa su ocijenili da bi ugrađivanje novih dodataka kod donošenja novog sustava plaća generiralo nove nepravde.', 'Podsjetili su na odluku vlade da se službenicima i namještenicima u pravosudnim tijelima isplati privremeni dodatak od 60 do 100 eura.\r\n\r\nVlada RH je na sjednici održanoj 15. lipnja donijela odluku o isplati privremenog dodatka kojom su obuhvaćena 7272 od 7554 službenika i namještenika u pravosudnim tijelima, priopćili su iz Ministarstva pravosuđa i uprave te dodali da će dodatak na plaću dobivati i službenici i namještenici u štrajku.\r\n\r\nKako su naveli, najveći broj službenika i namještenika u pravosudnim tijelima, njih 6316, dobit će najveći dodatak od 100 eura neto, 374 dodatak od 80 eura, a 582 dodatak od 60 eura.\r\n\r\nOdlukom vlade obuhvaćeno je više od 96 posto službenika i namještenika na sudovima i državnim odvjetništvima.\r\n\r\nPrema podacima koje su Ministarstvu pravosuđa i uprave dostavila pravosudna tijela, u štrajku je manje od 3000 službenika i namještenika.\r\n\r\n\"Nastavit ćemo s izradom pravednijeg sustava plaća\"\r\nU priopćenju su naglasili i da će u postupku izrade novog Zakona o plaćama u državnoj i javnoj službi i donošenja nove Uredbe o nazivima radnih mjesta i koeficijentima složenosti poslova, Ministarstvo pravosuđa i uprave nastaviti s izradom cjelovitog i pravednijeg sustava plaća u dijalogu sa socijalnim partnerima.\r\n\r\n\"Postojeći sustav plaća s godinama je generirao više od 560 dodataka na plaću za oko 2500 radnih mjesta. Novim sustavom plaća cilj je dodatke ugraditi u koeficijente, a broj radnih mjesta smanjiti do 600. Na taj način spriječit će se generiranje različitih koeficijenata ili dodataka za ista radna mjesta\", istaknuli su.\r\n\r\nIz Ministarstva pravosuđa i uprave ustvrdili su da bi \"ugrađivanjem novih dodataka u postupku donošenja novog sustava plaća rezultiralo narušavanjem odnosa u sustavu plaća i generiranju novih nepravdi jer bi službenici i namještenici u pravosudnim tijelima za isti posao u državnoj službi dobili 300 eura veću plaću u odnosu na službenika i namještenika u tijelu državne uprave\".\r\n\r\n\"Referent na sudu imao bi značajno veću plaću od referenta u ministarstvu\"\r\nPrimjerice, kažu, računovodstveni referent na sudu imao bi značajno veću plaću u odnosu na računovodstvenog referenta u nekom ministarstvu.\r\n\r\n\"Ministarstvo pravosuđa i uprave nastavit će s aktivnostima uvođenja novog sustava plaća kroz sveobuhvatni pristup koji će rezultirati povećanjem plaća svih službenika i namještenika, uključujući službenike i namještenike u pravosudnim tijelima\", poručili su u priopćenju.\r\n\r\nPredsjednica Sindikata državnih i lokalnih službenika i namještenika (SDLSN) Iva Šušković ranije u utorak pozdravila je odluku Vrhovnog suda da je štrajk službenika i namještenika u sudovima zakonit te najavila da će, ako do kraja tjedna ne dođe ponuda Ministarstva, sljedeći tjedan biti održan veliki prosvjed.\r\n\r\nPonovila je da traže povećanje od 400 eura u neto plaći te kaže da mogu razgovarati i o nešto nižem s obzirom na odluku vlade o povećanju od 100 eura za sve, osobito ako se govori o najniže rangiranima. \"Ali\", dodala je, \"mi ostajemo pri našem povećanju od 400 eura pa ćemo vidjeti što će u Ministarstvu ponuditi\".', '53b241e9-16f8-42cf-abae-f449d2da509b.jpg', 'politika', 0, '20.06.2023.'),
(5, 'Pep se i službeno odrekao jednog od najboljih bekova svijeta', 'Sve je jasno', 'JOAO CANCELO (29) napušta Manchester City, potvrdio je Fabrizio Romano.', 'Pep Guardiola se i službeno odrekao jednog od najboljih bekova svijeta, koji je do siječnja 2023. bio standardan član prve postave novog europskog prvaka. Cancelo je od siječnja bio na posudbi u Bayernu, no njemački prvak ga neće otkupiti za 70 milijuna eura.\r\n\r\n\"City i Cancelo traže najbolje rješenje i igrač planira vrlo brzo pronaći novi klub. Barcelona ostaje najzainteresiraniji klub za Cancela, ovisno o svojoj situaciji s financijskim fair-playom\", dodaje Romano. Cancelo prema Transfermarktu vrijedi 60 milijuna eura. Za Bayern je odigrao 21 utakmicu. Zabio je jedan gol i asistirao šest puta. Ugovor sa Cityjem ima do ljeta 2027. godine. U karijeri je igrao za Benficu B, Benficu, Valenciju, Inter i Juventus. Za Portugal u 43 nastupa ima osam golova.', '8eb483e4-83ab-4402-b8a0-953185dc93ca.jpg', 'sport', 0, '20.06.2023.'),
(6, 'Kicker: Bayern je razgovarao sa zaboravljenim Hrvatom. Otkrio mu je plan', 'Bayern je primijetio da Stanišić napreduje', 'BAYERN traži desnog bočnog igrača jer Benjamin Pavard želi napustiti klub. Spominju se pregovori s Kyleom Walkerom iz Manchester Cityja, dok je Chelseajev Cesar Azpilicueta navodna alternativa.', 'Kicker piše kako je 23-godišnji Stanišić \"pao u zaborav\" iako Bayern ima plan za njega. Njemački medij otkriva kako je vodstvo minhenskog kluba poručilo Stanišiću da računaju na njega. Prošle sezone, u kojoj je Bayern u zadnjem kolu osvojio Bundesligu, sakupio je 23 nastupa.\r\n\r\nKicker ističe kako je Stanišić na Svjetskom prvenstvu u Kataru igrao tek u utakmici za treće mjesto, kada je Hrvatska pobijedila Maroko 2:1. Na njegovom mjestu bio je Josip Juranović, no Nijemci napominju kako se \"na Stanišića uvijek može osloniti\".\r\n\r\n\"Bayern je primijetio da se Stanišić iz godine u godinu dobro razvija\"\r\nStanišić je od juniorskog uzrasta član Bayerna, a najbolji period imao je u nedavno završenoj sezoni, kada je u osmini finala Lige prvaka zamijenio suspendiranog Pavarda te mu je Julian Nagelsmann dao šansu protiv PSG-a. On ju je fantastično iskoristio jer je zaustavio Kyliana Mbappea.\r\n\r\n\"Bayern je primijetio da se Stanišić iz godine u godinu dobro razvija. Tako treba i nastaviti. Planovi bi se mogli promijeniti samo ako do kraja prijelaznog roka na Stanišićevoj poziciji nastane gužva. Tada bi moglo doći do promjene, no sada se to ne čini izgledno\", zaključuje Kicker. Stanišićev ugovor vrijedi do ljeta 2026., a Transfermarkt ga procjenjuje na 12 milijuna eura.', '1fa881e0-f0b4-496e-b064-1f915474bfa0.jpg', 'sport', 0, '20.06.2023.'),
(7, 'Insajder: Dalić je dobio ponudu saudijskog kluba. Trenirao bi Ronalda', 'Tijekom godina dobivao je brojne ponude', 'AL NASSR traži trenera te je poslao ponudu izborniku hrvatske reprezentacije Zlatku Daliću, tvrdi talijanski insajder Rudy Galetti dodajući kako se \"situacija razvija\".', 'Dalić je izbornik reprezentacije od 2017. godine i aktualni ugovor vrijedi mu do 2026. Na Svjetskom prvenstvu u Rusiji 2018. godine osvojio je drugo mjesto, dok je u Kataru četiri godine kasnije bio treći. U nedavno završenoj Ligi nacija također je uzeo drugo mjesto.\r\n\r\nViše puta govorio je kako je tijekom godina dobio brojne ponude. \"Rekao sam predsjedniku (HNS-a, Marijanu Kustiću, op.a.) da imam motiv i energiju za voditi Hrvatsku. Dok se tako osjećam, tako će biti. Uvijek će biti ponuda, neće one izostati ni kasnije.\r\n\r\nSvjestan sam toga da je ovo za mene još jedna stepenica, napravili smo sjajne stvari, teško je to sve ponavljati, ali pokušat ćemo. Imam sjajan odnos s igračima, stožerom i ljudima koji vode savez, to treba iskoristiti\", izjavio je Dalić u travnju.\r\n\r\nDalić je već vodio saudijske klubove\r\nDalić je tijekom trenerske karijere vodio Rijeku, albanski Dinamo i Slaven Belupo. Već je radio u Saudijskoj Arabiji, i to kao trener Al Faisalyja i Al Hilala, dok je u Ujedinjenim Arapskim Emiratima trenirao Al Ain.\r\n\r\n\"Mene vuče motiv, mene vuče Hrvatska i meni nema ljepšega posla od ovoga koji tu radim. Osvojiti tri medalje u pet godina, s tim se ne mogu pohvaliti ni puno jače reprezentacije, puno brojnije države nego što je Hrvatska.\r\n\r\nJa sam ponosan na ovih svojih pet godina, na našu reprezentaciju, na igrače, na ovo što smo napravili. Ponosan sam na svoju karijeru osobito\", rekao je Dalić u ponedjeljak, dan nakon što je Hrvatska izgubila od Španjolske na penale u finalu Lige nacija.', '85be6e7b-87e5-4cdd-ba7c-d6e71187a191.jpg', 'sport', 0, '20.06.2023.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
