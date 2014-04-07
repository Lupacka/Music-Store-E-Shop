-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2014 at 09:58 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hudobniny`
--
CREATE DATABASE IF NOT EXISTS `hudobniny` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hudobniny`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main` varchar(50) NOT NULL,
  `sub` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `main`, `sub`) VALUES
(1, 'guitars', 'acoustic guitars,electric guitars,guitar amps,guitar effects,cables,picks,strings'),
(2, 'bass_guitars', 'electric bassguitars,acoustic bassguitars,bassguitar amps, bassguitar effects,picks,strings'),
(3, 'drums', 'acoustic drums,electric drums,heads,sticks'),
(4, 'keyboards', 'keyboards,stage pianos,midi controllers');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rate` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_prod`, `user`, `user_id`, `comment`, `rate`, `date`) VALUES
(18, 12, 'admin', 1, 'Velmi dobre bicie', 100, '2014-04-01 09:22:18'),
(19, 12, 'admin', 1, 'Uplne na picu bicie', 60, '2014-04-01 09:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'user', ''),
(2, 'administrator', '{"admin" :1}');

-- --------------------------------------------------------

--
-- Table structure for table `session_user`
--

CREATE TABLE IF NOT EXISTS `session_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tovar`
--

CREATE TABLE IF NOT EXISTS `tovar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `sub` varchar(30) NOT NULL,
  `item_label` varchar(50) NOT NULL,
  `about` text CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `price` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `rated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tovar`
--

INSERT INTO `tovar` (`id`, `name`, `category`, `sub`, `item_label`, `about`, `price`, `date`, `img_url`, `rating`, `rated`) VALUES
(1, 'LAG Tramontane T 400 D', 'guitars', 'acoustic_guitars', 'Acoustic Guitar', 'Akustická gitara série Tramontane, špičkový nástroj za vynikajúcu cenu. Tvar tela Dreadnought s vysoko lesklou povrchovou úpravou. Linka hornej dosky a rozeta rezonančného otvoru z javora a palisandra, kvalitná olejová mechanika čiernej farby. Vrchná doska z masívneho smreku Sitka, zadná doska a luby z Indonézskeho palisandra, rovnako hmatník a kobylka. Nástroj sa dodáva osadený strunami Elixir NANOWEB® rozmeru 011-052.', 483, '2014-01-29 20:41:59', './media/prod_photo/1.jpg', 0, 0),
(2, 'Marshall MS-4', 'guitars', 'guitar_amps', 'Marshal Amp', 'hlava, gitarová: Micro- Stack, 2 Watt, čierny, 2 reproduktory, na 9V batériu, Clean a Overdrive Mode, slúchadlový výstup, kovový stojanček na podopretie,', 145, '2014-01-29 20:58:07', '/media/prod_photo/2.jpg', 0, 0),
(3, 'Premier OLYMPIC ROCK 22 WR', 'drums', 'acoustic_drums', 'Acoustic Drums', 'Akustická bicia súprava: Olympic Rock 22. Séria Olympic bola prvý raz predstavená v roku 1937, odvtedy sa stala obľúbenou sadou začínajúcich bubeníkov. Príjemná cena a výborná kvalita, to sú poznávacie znaky série Olympic. Sada obsahuje 22"BD, 12x9"+13x10"TT, 16x16"FT, 14"SD + hardware, činely, stolička a paličky - Wine Red', 370, '2014-01-29 21:27:16', '/media/prod_photo/3.jpg', 0, 0),
(4, 'Stagg BC300-NS', 'bass_guitars', 'electric_bassguitars', 'Stags bass', 'Basgitara typu Fusion. Telo masív jelša, krk javor, hmatník palisander, 24 pražcov, Menzúra 867 mm, snímače 1x PB, 1x JB, ovládanie 2x Volume, 1x Tone, mechanika die-cast, čierny hardware. Farba prírodná, matná.', 231, '2014-01-29 22:06:02', '/media/prod_photo/4.jpg', 0, 0),
(5, 'Dimavery FV520', 'guitars', 'electric_guitars', 'Electric hell', 'One bad ass guitar', 698, '2014-01-30 12:49:03', '/media/prod_photo/5.jpg', 0, 0),
(6, 'Behringer AM 300', 'guitars', 'guitar_effects', 'Guitar effect', 'Gitarový efekt Acoustic Modeler pre akúkoľvek elektrickú gitaru, flexibilný prepínač s voľbou 4 rôznych módov – simulácií (standard, large, piezo, bright), 2 individuálne výstupy umožňujú jednoduché prepínanie medzi zvukmi akustickej a elektrickej gitary pri použití dvoch rozličných zosilňovačov, napájanie pomocou 9V batérie alebo adaptérom (nie je súčasťou', 21, '2014-01-30 12:50:22', '/media/prod_photo/6.jpg', 0, 0),
(7, 'Dunlop 41R 1.14 Delrin', 'guitars', 'picks', 'Pick', 'Trsátko Delrin 500 Standard, hrúbka 1.14. Trsátka Delrin Standard kombinujú najnovšie metódy vo výrobe plastu so skvelou pamäťou a bezchybným hladkým povrchom, ktorý je špeciálne leštený.', 1, '2014-01-30 12:52:18', '/media/prod_photo/7.jpg', 0, 0),
(8, 'Soundking INC048-1M', 'guitars', 'cables', 'Instrument Cable', 'Hotový nástrojový kábel vhodný pre pódiá, živé aplikácie, aj pevné inštalácie. Prierez vodičov 2x0,22mm, Prierez kábla 6,4 mm, tienenie 99%, Impedancia: cca 100 Ohm. Konektory: Jack 6,3mm mono - Jack 6,3mm mono, samec-samec, dĺžka 1 m', 3, '2014-01-30 12:54:04', '/media/prod_photo/8.jpg', 0, 0),
(9, 'Dunlop DEN 1150', 'guitars', 'strings', 'String', 'DEN 1150 struny pre elektrickú gitaru. Hrúbka 11-14-18-28-38-50. Nové poniklované struny Dunlop poskytujú perfektne vyvážený zvuk s vynikajúcimi akustickými kvalitami. Vďaka špičkovému materiálu a prepracovanej technológii výroby sú nové struny veľmi flexibilné, vhodné na mocné riffy, silné powerkordy a strhujúce sóla. Vďaka špeciálnej technológii sa struny Dunlop vyznačujú skvelou životnosťou a zachovaním všetkých zvukových kvalít.', 7, '2014-01-30 13:01:12', '/media/prod_photo/9.jpg', 0, 0),
(10, 'Ibanez AEB 8E BK', 'bass_guitars', 'acoustic_bassguitars', 'Acoustic guitar', 'Elektro-akustická basgitara AEG 8E so vstavanou ladičkou, čiernej farby (BK-black) so smrekovou vrchnou doskou, zadná doska a luby sú z dreva agathis, krk z mahagónu. Hrúbka tela je 8cm, chrómová mechanika, snímač Ibanez, Eq. Ibanez SPT Pre-Amp, 3pásm. EQ s ladičkou, mechanika Di-Cast chróm, cutaway.', 456, '2014-01-30 13:02:12', '/media/prod_photo/10.jpg', 0, 0),
(11, 'Laney RB1 Richter Bass', 'bass_guitars', 'bassguitar_amps', 'Bass AMP', 'Basové kombo serie Richter Bass, výkon: 15W, reproduktor: 1x8 ", vstup: 1x Jack, equalizer: basy, stredy, výšky, slúchadlový výstup, kompresor, interný limiter, CD / line vstup, celková hlasitosť.', 123, '2014-01-30 13:02:51', '/media/prod_photo/11.jpg', 0, 0),
(12, 'Alesis DM Lite Kit', 'drums', 'electric_drums', 'Electric drums', 'Sada elektronických bicích, ktorá ponúka maximálnu kvalitu, pokročilé zvuky, najlepšiu technológiu a skvelú cenu. Unikátnou vlastnosťou sady je osvietenie padov a činelov LED diódami, ktoré im dodávajú efektný vzhľad. V bicom module máte k dispozícii viac ako 200 zvukov bubnov a činelov s možnosťou ľubovoľnej kombinácie, 30 skladieb, ktoré Vás môžu sprevádzať pri hraní, vstavaný metronóm, USB a MIDI rozhranie s možnosťou pripojenia k Vášmu počítaču alebo iným zariadeniam, stereo výstup, výstup pre slúchadlá a vstup pre mp3 alebo CD prehrávač.', 259, '2014-01-30 13:08:43', '/media/prod_photo/12.jpg', 60, 2),
(14, 'Stick of Truth', 'drums', 'Sticks', 'Best Stick', 'Best stick you can get mota faka', 10, '2014-04-07 07:23:41', '/media/prod_photo/13.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(30) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `salt` varbinary(32) NOT NULL,
  `joined` datetime NOT NULL,
  `group` varchar(10) NOT NULL,
  `activated` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nick`, `pass`, `salt`, `joined`, `group`, `activated`) VALUES
(1, 'admin', 'ca3aa67801eb952870a7b7ae8dcbd0b4c6a3634d378013e46e24e6a02879c273', 'o�*�X��\\���W��;����8�-!��', '2013-12-02 09:09:10', '1', '1'),
(4, 'Wrecko', '534d9e1d76939ca028d366abbd844bf61d7f3e5114001ca1e2d8f3079593a5f1', '����A����s)�F�\\�{X|�]�(Mδ��O�', '2013-12-05 01:00:32', '1', '0'),
(12, 'Testing', 'fb74fa539f2cf695527bf0a14cd2cc7139b9d94149ca18f785686835629a864c', '���=��@TE�D��4�V�"w/�Ř��r', '2013-12-05 20:09:29', '0', '1'),
(10, 'Ananas', '5e3205ff89575146e4a7e376a6c8622953f8f83dc8d2b803710fa01132c3d671', 'V17T�+q<��dz[-F`6���;�t��O���y', '2013-12-05 15:27:03', '0', '1'),
(14, 'Testik', '6fe291ecc249802f70dc76c977e03b4404d2d6cd01cb34420a4cc8ec3a1359ed', '4O��2�:��F��	f�I���Ћ�GQ�mf3', '2013-12-08 21:15:43', '0', '3db61747cb3b34c81c071b93efb79cad');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE IF NOT EXISTS `users_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adress` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `p_number` varchar(50) NOT NULL,
  `name` varchar(10) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `img_url` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `adress`, `country`, `p_number`, `name`, `surname`, `email`, `img_url`) VALUES
(1, 'Adminovska25, 55555, Adminovo', 'Slovakia', '91847563', 'Adminn', 'Adminovsky', 'admin@adminovsky.com', 'http://hudobniny.g6.cz/media/blank_person.jpg'),
(4, 'pri krizi 20, 12345, Bratislava', 'Slovakia', '+421918065987', 'Roman', 'Vrecnik', 'wrecko@zozonam.sk', 'http://hudobniny.g6.cz/media/blank_person.jpg'),
(10, 'Ananasova 42, 66688, Ananasovo', 'Czech Republic', '+4219074026', 'Ananas', 'Ananasovyk', 'wrecusko@gmail.com', 'http://localhost/hudobniny/media/users_photo/10.png'),
(12, 'Googlovska, 00000, Googlee', 'Slovakia', '+421654789231', 'Google', 'Googlovaty', 'wrecko@centrum.sk', 'http://hudobniny.g6.cz/media/blank_person.jpg'),
(14, 'Testiko 25, 54123, Testikovo', 'Slovakia', '+42194563210', 'Tesikk', 'Testik', 'testik@testik.com', 'http://localhost/hudobniny/media/blank_person.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
