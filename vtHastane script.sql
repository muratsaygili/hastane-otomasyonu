-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Oca 2016, 21:50:26
-- Sunucu sürümü: 5.6.24
-- PHP Sürümü: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hastane`
--
CREATE DATABASE IF NOT EXISTS `hastane` DEFAULT CHARACTER SET utf8 COLLATE utf8_turkish_ci;
USE `hastane`;

DELIMITER $$
--
-- Yordamlar
--
DROP PROCEDURE IF EXISTS `hastaCikis`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `hastaCikis` (IN `kayitNo` INT)  BEGIN
UPDATE pol_kayit SET pol_kayit.h_cikis_tarihi=CURDATE() WHERE pol_kayit.kayit_no=kayitNo;

END$$

DROP PROCEDURE IF EXISTS `hastaKayit`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `hastaKayit` (IN `kayitNo` INT, IN `ad` VARCHAR(15), IN `soyad` VARCHAR(20), IN `tcno` DOUBLE, IN `cinsiyet` VARCHAR(5), IN `telno` DOUBLE, IN `dtarihi` DATE, IN `il` VARCHAR(15), IN `ilce` VARCHAR(15), IN `mahalle` VARCHAR(15), IN `sokak` VARCHAR(15), IN `bina` VARCHAR(15), IN `daire` INT, IN `polNo` INT, IN `drNo` INT)  BEGIN
INSERT INTO pol_kayit(kayit_no,pol_no,dr_no) VALUES (kayitNo,polNo,drNo);
INSERT INTO hasta VALUES (kayitNo,ad,soyad,tcno,cinsiyet,telno,dtarihi);
INSERT INTO adres VALUES (kayitNo,il,ilce,mahalle,sokak,bina,daire);
END$$

DROP PROCEDURE IF EXISTS `taniGiris`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `taniGiris` (IN `gTani` VARCHAR(30), IN `kayitNo` INT)  NO SQL
BEGIN
UPDATE pol_kayit SET pol_kayit.tani=gTani WHERE pol_kayit.kayit_no=kayitNo;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adres`
--

DROP TABLE IF EXISTS `adres`;
CREATE TABLE IF NOT EXISTS `adres` (
  `kayit_no` int(11) NOT NULL,
  `il` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `ilce` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `mahalle` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `sokak` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `bina` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `daire` int(11) DEFAULT NULL,
  PRIMARY KEY (`kayit_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `adres`:
--   `kayit_no`
--       `pol_kayit` -> `kayit_no`
--

--
-- Tablo döküm verisi `adres`
--

INSERT INTO `adres` (`kayit_no`, `il`, `ilce`, `mahalle`, `sokak`, `bina`, `daire`) VALUES
(2, 'Denizli', 'Merkez', 'Kınıklı', 'Yalçın', '11', 1),
(3, 'Denizli', 'Çal', 'Hançalar', 'Kirişler', '8', 1),
(4, 'Aydın', 'Söke', 'Konak', 'Yalçın', '20', 10),
(5, 'Kocaeli', 'Gebze', 'Emek', 'Akasya', '14', 3),
(6, 'Denizli', 'Merkez', 'Kınıklı', '1.Cadde', '43', 3),
(7, 'Afyonkarahisar', 'Çay', 'Vakıf', 'Emekliler', '81', 2),
(8, 'İzmir', 'Buca', 'Gediz', '102', '12', 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `doktor`
--

DROP TABLE IF EXISTS `doktor`;
CREATE TABLE IF NOT EXISTS `doktor` (
  `dr_no` int(11) NOT NULL AUTO_INCREMENT,
  `dr_dal_no` int(11) DEFAULT NULL,
  `dr_ad` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `dr_soyad` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dr_no`),
  KEY `dr_dal_no` (`dr_dal_no`),
  KEY `dr_dal_no_2` (`dr_dal_no`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `doktor`:
--   `dr_dal_no`
--       `pol_dal` -> `pol_no`
--

--
-- Tablo döküm verisi `doktor`
--

INSERT INTO `doktor` (`dr_no`, `dr_dal_no`, `dr_ad`, `dr_soyad`, `durum`) VALUES
(1, 1, 'Mustafa', 'Albayrak', 1),
(2, 2, 'Merve', 'Koç', 1),
(3, 3, 'Cem', 'Saygın', 1),
(4, 4, 'Gonca', 'Akın', 1),
(5, 5, 'Cüneyt', 'Şaşmaz', 1),
(6, 6, 'Gözde', 'Yılmaz', 1),
(7, 7, 'Murat', 'Saygılı', 0),
(8, 2, 'Yunus Emre', 'Erken', 1),
(9, 3, 'Emre', 'Kara', 0),
(10, 4, 'Mehmet', 'Kaya', 1),
(11, 5, 'Veli', 'Boyacı', 0),
(12, 6, 'Mahmut', 'Arslan', 1),
(15, 7, 'Yusuf', 'Okur', 1),
(16, 8, 'Hazal', 'Karadeniz', 1),
(17, 1, 'Selda', 'Yazar', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hasta`
--

DROP TABLE IF EXISTS `hasta`;
CREATE TABLE IF NOT EXISTS `hasta` (
  `kayit_no` int(11) NOT NULL,
  `h_ad` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `h_soyad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `h_tcno` double NOT NULL,
  `h_cinsiyet` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  `h_telno` double NOT NULL,
  `h_dogum_tarihi` date NOT NULL,
  PRIMARY KEY (`kayit_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `hasta`:
--   `kayit_no`
--       `pol_kayit` -> `kayit_no`
--

--
-- Tablo döküm verisi `hasta`
--

INSERT INTO `hasta` (`kayit_no`, `h_ad`, `h_soyad`, `h_tcno`, `h_cinsiyet`, `h_telno`, `h_dogum_tarihi`) VALUES
(2, 'Yunus Emre', 'Erken', 12345678999, 'Erkek', 5396212612, '1994-09-09'),
(3, 'Veli Can', 'Boyacı', 123456789789, 'Erkek', 5059018765, '1993-04-07'),
(4, 'Murat', 'Saygılı', 12637498662, 'Erkek', 5382173169, '1993-10-29'),
(5, 'Sebahattin', 'Çetin', 34567834657, 'Erkek', 5315436577, '1992-03-11'),
(6, 'Mete', 'Hadimlioğlu', 65237834876, 'Erkek', 5435434343, '1993-01-01'),
(7, 'Yusuf', 'Okur', 78624587345, 'Erkek', 5494565656, '1994-08-08'),
(8, 'Salih', 'Kösali', 76340737195, 'Erkek', 5443156171, '1993-05-12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ilac`
--

DROP TABLE IF EXISTS `ilac`;
CREATE TABLE IF NOT EXISTS `ilac` (
  `ilac_no` int(11) NOT NULL AUTO_INCREMENT,
  `ilac_ad` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `ilac_barkod_no` double NOT NULL,
  `ilac_miktar` int(11) NOT NULL,
  `ilac_tipi` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`ilac_no`),
  UNIQUE KEY `ilac_barkod_no` (`ilac_barkod_no`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `ilac`:
--

--
-- Tablo döküm verisi `ilac`
--

INSERT INTO `ilac` (`ilac_no`, `ilac_ad`, `ilac_barkod_no`, `ilac_miktar`, `ilac_tipi`) VALUES
(1, 'Allersol', 49873231521, 7, 'Göz Damlası'),
(2, 'Andolor', 87564512341, 26, 'Tablet'),
(3, 'Asomal', 84651538451, 7, 'Şurup'),
(4, 'Asiviral', 54215454154, 0, 'Krem'),
(5, 'Enflar', 12121545488, 14, 'Tablet'),
(6, 'Ezetrol', 21454515184, 15, 'Tablet'),
(7, 'Naponal', 57896415152, 18, 'Tablet'),
(8, 'Perebron', 94512184548, 7, 'Şurup'),
(9, 'Zovirax', 87415123333, 15, 'Krem'),
(10, 'Rinizol', 95454852224, 15, 'Burun Spreyi'),
(11, 'Vermidon', 8699516010720, 77, 'Tablet'),
(12, 'Aspirin', 8699516010722, 55, 'Tablet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kull_malz`
--

DROP TABLE IF EXISTS `kull_malz`;
CREATE TABLE IF NOT EXISTS `kull_malz` (
  `malzeme_no` int(11) NOT NULL AUTO_INCREMENT,
  `kayit_no` int(11) NOT NULL,
  `mal_no` int(11) NOT NULL,
  `mal_adet` int(11) NOT NULL,
  PRIMARY KEY (`malzeme_no`),
  KEY `mal_no` (`mal_no`),
  KEY `kayit_no` (`kayit_no`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `kull_malz`:
--   `mal_no`
--       `stok` -> `mal_no`
--   `kayit_no`
--       `pol_kayit` -> `kayit_no`
--

--
-- Tablo döküm verisi `kull_malz`
--

INSERT INTO `kull_malz` (`malzeme_no`, `kayit_no`, `mal_no`, `mal_adet`) VALUES
(1, 5, 3, 2),
(3, 5, 5, 1),
(5, 6, 1, 2),
(6, 4, 2, 3),
(7, 4, 3, 1),
(9, 8, 3, 2),
(10, 8, 1, 3),
(11, 7, 1, 4),
(12, 7, 3, 1);

--
-- Tetikleyiciler `kull_malz`
--
DROP TRIGGER IF EXISTS `stokArttır`;
DELIMITER $$
CREATE TRIGGER `stokArttır` BEFORE DELETE ON `kull_malz` FOR EACH ROW UPDATE stok SET stok.stok_adet=stok.stok_adet+OLD.mal_adet WHERE stok.mal_no=OLD.mal_no
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `stokAzalt`;
DELIMITER $$
CREATE TRIGGER `stokAzalt` AFTER INSERT ON `kull_malz` FOR EACH ROW UPDATE stok SET stok.stok_adet=stok.stok_adet-NEW.mal_adet WHERE stok.mal_no=NEW.mal_no
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pol_dal`
--

DROP TABLE IF EXISTS `pol_dal`;
CREATE TABLE IF NOT EXISTS `pol_dal` (
  `pol_no` int(11) NOT NULL AUTO_INCREMENT,
  `pol_ad` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`pol_no`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `pol_dal`:
--

--
-- Tablo döküm verisi `pol_dal`
--

INSERT INTO `pol_dal` (`pol_no`, `pol_ad`) VALUES
(1, 'Dahiliye'),
(2, 'Ortopedi'),
(3, 'Kardiyoloji'),
(4, 'Göz Hastalıkları'),
(5, 'Kulak Burun Boğaz'),
(6, 'Nöroloji'),
(7, 'Dermatoloji'),
(8, 'Psikiyatri');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pol_kayit`
--

DROP TABLE IF EXISTS `pol_kayit`;
CREATE TABLE IF NOT EXISTS `pol_kayit` (
  `kayit_no` int(11) NOT NULL AUTO_INCREMENT,
  `pol_no` int(11) NOT NULL,
  `recete_no` int(11) DEFAULT NULL,
  `dr_no` int(11) NOT NULL,
  `malzeme_no` int(11) DEFAULT NULL,
  `tani` varchar(30) COLLATE utf8_turkish_ci DEFAULT 'girilmemiş',
  `h_kayit_tarihi` date DEFAULT NULL,
  `h_cikis_tarihi` date DEFAULT NULL,
  PRIMARY KEY (`kayit_no`),
  KEY `pol_no` (`pol_no`),
  KEY `recete_no` (`recete_no`),
  KEY `dr_no` (`dr_no`),
  KEY `malzeme_no` (`malzeme_no`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `pol_kayit`:
--   `pol_no`
--       `pol_dal` -> `pol_no`
--   `recete_no`
--       `recete` -> `recete_no`
--   `dr_no`
--       `doktor` -> `dr_no`
--   `malzeme_no`
--       `kull_malz` -> `malzeme_no`
--

--
-- Tablo döküm verisi `pol_kayit`
--

INSERT INTO `pol_kayit` (`kayit_no`, `pol_no`, `recete_no`, `dr_no`, `malzeme_no`, `tani`, `h_kayit_tarihi`, `h_cikis_tarihi`) VALUES
(2, 8, NULL, 16, NULL, 'Uykuda Bağırma', '2015-12-18', '2015-12-19'),
(3, 4, NULL, 10, NULL, 'Körlük', '2015-12-18', '2015-12-31'),
(4, 4, NULL, 4, NULL, 'Astigmatizm', '2015-12-19', '2015-12-30'),
(5, 7, NULL, 2, NULL, 'Sivilce', '2015-12-22', '2015-12-29'),
(6, 5, NULL, 11, NULL, 'Guatr', '2015-12-26', '2015-12-29'),
(7, 5, NULL, 5, NULL, 'Yeni Tanı', '2015-12-27', '2016-01-01'),
(8, 2, NULL, 2, NULL, 'yeni tanı', '2015-12-30', '2015-12-31');

--
-- Tetikleyiciler `pol_kayit`
--
DROP TRIGGER IF EXISTS `kayitTarihi`;
DELIMITER $$
CREATE TRIGGER `kayitTarihi` BEFORE INSERT ON `pol_kayit` FOR EACH ROW SET NEW.h_kayit_tarihi =CURDATE()
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `ucretOlustur`;
DELIMITER $$
CREATE TRIGGER `ucretOlustur` AFTER INSERT ON `pol_kayit` FOR EACH ROW INSERT INTO ucretler VALUES (NEW.kayit_no,0)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `recete`
--

DROP TABLE IF EXISTS `recete`;
CREATE TABLE IF NOT EXISTS `recete` (
  `recete_no` int(11) NOT NULL AUTO_INCREMENT,
  `ilac_no` int(11) NOT NULL,
  `kayit_no` int(11) NOT NULL,
  `kul_suresi` int(11) NOT NULL,
  `dozaj` int(11) NOT NULL,
  PRIMARY KEY (`recete_no`),
  KEY `ilac_no` (`ilac_no`),
  KEY `kayit_no` (`kayit_no`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `recete`:
--

--
-- Tablo döküm verisi `recete`
--

INSERT INTO `recete` (`recete_no`, `ilac_no`, `kayit_no`, `kul_suresi`, `dozaj`) VALUES
(1, 3, 2, 14, 1),
(2, 6, 2, 7, 3),
(7, 12, 5, 7, 1),
(8, 5, 8, 7, 3),
(9, 10, 7, 7, 3),
(10, 11, 7, 14, 3);

--
-- Tetikleyiciler `recete`
--
DROP TRIGGER IF EXISTS `ilacArttır`;
DELIMITER $$
CREATE TRIGGER `ilacArttır` BEFORE DELETE ON `recete` FOR EACH ROW UPDATE ilac SET ilac.ilac_miktar=ilac.ilac_miktar+1 WHERE ilac.ilac_no=ilac_no
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `ilacAzalt`;
DELIMITER $$
CREATE TRIGGER `ilacAzalt` AFTER INSERT ON `recete` FOR EACH ROW UPDATE ilac SET ilac.ilac_miktar=ilac.ilac_miktar-1 WHERE ilac.ilac_no=NEW.ilac_no
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok`
--

DROP TABLE IF EXISTS `stok`;
CREATE TABLE IF NOT EXISTS `stok` (
  `mal_no` int(11) NOT NULL AUTO_INCREMENT,
  `mal_ad` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `stok_adet` int(11) NOT NULL,
  `mal_fiyat` float(5,2) NOT NULL,
  PRIMARY KEY (`mal_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `stok`:
--

--
-- Tablo döküm verisi `stok`
--

INSERT INTO `stok` (`mal_no`, `mal_ad`, `stok_adet`, `mal_fiyat`) VALUES
(1, 'Sargı Bezi', 4990, 2.50),
(2, 'Şırınga', 2498, 1.00),
(3, 'Serum', 1996, 7.50),
(4, 'Plaster', 0, 4.75),
(5, 'Tentürdiyot', 499, 4.99);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ucretler`
--

DROP TABLE IF EXISTS `ucretler`;
CREATE TABLE IF NOT EXISTS `ucretler` (
  `kayit_no` int(11) NOT NULL,
  `toplam_ucret` float NOT NULL,
  PRIMARY KEY (`kayit_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `ucretler`:
--   `kayit_no`
--       `pol_kayit` -> `kayit_no`
--

--
-- Tablo döküm verisi `ucretler`
--

INSERT INTO `ucretler` (`kayit_no`, `toplam_ucret`) VALUES
(2, 0),
(3, 0),
(4, 13),
(5, 19.99),
(6, 5),
(7, 17.5),
(8, 22.5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- TABLO BAĞLANTILARI `users`:
--

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'bilgi_islem', 'bilgi_pass'),
(2, 'hasta_kayit1', 'kayit_pass1'),
(3, 'hasta_kayit2', 'kayit_pass2');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `adres`
--
ALTER TABLE `adres`
  ADD CONSTRAINT `adres_ibfk_1` FOREIGN KEY (`kayit_no`) REFERENCES `pol_kayit` (`kayit_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `doktor`
--
ALTER TABLE `doktor`
  ADD CONSTRAINT `doktor_ibfk_1` FOREIGN KEY (`dr_dal_no`) REFERENCES `pol_dal` (`pol_no`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `hasta`
--
ALTER TABLE `hasta`
  ADD CONSTRAINT `hasta_ibfk_1` FOREIGN KEY (`kayit_no`) REFERENCES `pol_kayit` (`kayit_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `kull_malz`
--
ALTER TABLE `kull_malz`
  ADD CONSTRAINT `kull_malz_ibfk_1` FOREIGN KEY (`mal_no`) REFERENCES `stok` (`mal_no`),
  ADD CONSTRAINT `kull_malz_ibfk_2` FOREIGN KEY (`kayit_no`) REFERENCES `pol_kayit` (`kayit_no`);

--
-- Tablo kısıtlamaları `pol_kayit`
--
ALTER TABLE `pol_kayit`
  ADD CONSTRAINT `pol_kayit_ibfk_1` FOREIGN KEY (`pol_no`) REFERENCES `pol_dal` (`pol_no`),
  ADD CONSTRAINT `pol_kayit_ibfk_2` FOREIGN KEY (`recete_no`) REFERENCES `recete` (`recete_no`),
  ADD CONSTRAINT `pol_kayit_ibfk_3` FOREIGN KEY (`dr_no`) REFERENCES `doktor` (`dr_no`),
  ADD CONSTRAINT `pol_kayit_ibfk_4` FOREIGN KEY (`malzeme_no`) REFERENCES `kull_malz` (`malzeme_no`);

--
-- Tablo kısıtlamaları `ucretler`
--
ALTER TABLE `ucretler`
  ADD CONSTRAINT `ucretler_ibfk_1` FOREIGN KEY (`kayit_no`) REFERENCES `pol_kayit` (`kayit_no`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
