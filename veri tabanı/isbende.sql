-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 11 Oca 2019, 12:34:10
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `isbende`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `admin_id` smallint(9) NOT NULL,
  `admin_kAdi` varchar(20) NOT NULL,
  `admin_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_kAdi`, `admin_password`) VALUES
(1, 'admin', 'admin'),
(2, 'volkan', '123456'),
(5, '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_logo` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_baslik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_aciklama` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_keywords` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_yazar` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_gsm` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_faks` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_ilce` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_il` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_adres` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_mesai` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_maps` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_analystic` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_zopim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_facebook` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_twitter` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_youtube` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtphost` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtpuser` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtppassword` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtpport` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_bakim` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`ayar_id`, `ayar_logo`, `ayar_baslik`, `ayar_aciklama`, `ayar_keywords`, `ayar_yazar`, `ayar_tel`, `ayar_gsm`, `ayar_faks`, `ayar_mail`, `ayar_ilce`, `ayar_il`, `ayar_adres`, `ayar_mesai`, `ayar_maps`, `ayar_analystic`, `ayar_zopim`, `ayar_facebook`, `ayar_twitter`, `ayar_youtube`, `ayar_smtphost`, `ayar_smtpuser`, `ayar_smtppassword`, `ayar_smtpport`, `ayar_bakim`) VALUES
(1, 'ayar_logo', 'ayar_baslik', 'ayar_aciklama', 'ayar_keywords', 'ayar_yazar', '0312 484 77 10', '506 363 66 07', 'ayar_faks', 'info@isbende.com', 'ayar_ilce', 'ayar_il', 'ayar_adres', 'ayar_mesai', 'ayar_maps', 'ayar_analystic', 'ayar_zopim', 'ayar_facebook', 'ayar_twitter', 'ayar_youtube', 'ayar_smtphost', 'ayar_smtpuser', 'ayar_smtppassword', 'ayar_smtpport', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gorev`
--

CREATE TABLE `gorev` (
  `gorev_id` smallint(9) NOT NULL,
  `veren_id` int(9) NOT NULL,
  `yapan_id` int(9) NOT NULL DEFAULT '0',
  `gorev_kategori` varchar(20) DEFAULT NULL,
  `gorev_baslik` varchar(100) DEFAULT NULL,
  `gorev_detay` varchar(300) DEFAULT NULL,
  `gorev_il` varchar(20) DEFAULT NULL,
  `gorev_ek` varchar(250) DEFAULT NULL,
  `gorev_basTarih` datetime DEFAULT CURRENT_TIMESTAMP,
  `gorev_bitTarih` date DEFAULT NULL,
  `gorev_butce` smallint(9) DEFAULT NULL,
  `gorev_yetenek` varchar(50) DEFAULT NULL,
  `puandurumu` bit(1) NOT NULL DEFAULT b'0',
  `teslimalindi` bit(1) NOT NULL DEFAULT b'0',
  `teslimedildi` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `gorev`
--

INSERT INTO `gorev` (`gorev_id`, `veren_id`, `yapan_id`, `gorev_kategori`, `gorev_baslik`, `gorev_detay`, `gorev_il`, `gorev_ek`, `gorev_basTarih`, `gorev_bitTarih`, `gorev_butce`, `gorev_yetenek`, `puandurumu`, `teslimalindi`, `teslimedildi`) VALUES
(38, 12, 0, '8', 'Php E-ticaret sitesi', '1920\'de Waukegan, Illinois\'de doğdu. 1934\'te ailesiyle Los Angeles\'a taşındı. 1947\'de Marguerite McClure\'la evlendi. Şimdi yetişkin olan dört kızları var ve halen Los Angeles\'ta yaşıyorlar. Bugün Dünya\'nın en büyük bilimkurgu ve fantezi yazarlarından biri olan Ray Bradbury, yirmi yaşındayken qweasd1', '', '/25654258391461483155678.jpg', '2018-12-19 04:48:48', '2019-12-21', 100, NULL, b'0', b'0', b'0'),
(39, 11, 28, '9', 'arkadaşlık sitesi', '1920\'de Waukegan, Illinois\'de doğdu. 1934\'te ailesiyle Los Angeles\'a taşındı. 1947\'de Marguerite McClure\'la evlendi. Şimdi yetişkin olan dört kızları var ve halen Los Angeles\'ta yaşıyorlar. Bugün Dünya\'nın en büyük bilimkurgu ve fantezi yazarlarından biri olan Ray Bradbury, yirmi yaşındayken qweasd1', '', '/2781828567İŞ YERİ EĞİTİMİ SON.docx', '2018-12-19 19:24:28', '2019-12-26', 100, NULL, b'0', b'0', b'0'),
(49, 12, 0, '10', 'download kontrol', 'dosya indir kontrol', 'Elazığ', '/2520024194PTD.docx', '2018-12-20 02:05:49', '2019-12-28', 10, NULL, b'0', b'0', b'0'),
(50, 11, 0, '12', 'download', 'indir kontrol', 'elazığ', '/2371625496.PTD.docx', '2018-12-20 02:07:15', '2019-12-21', 100, NULL, b'0', b'0', b'0'),
(51, 11, 28, '9', 'Plaka Okuma', 'OpenALPR birçok programlama diline destek veren bir plaka tanıma kütüphanesidir.\r\nSizinle paylaşacağımız bu örnekte c# dili kullanılarak plaka tanıma işlemi yapılıyor.\r\nOpenALPR’nin kendi klasöründeki (openalpr-mastersrcindingscsharpAlprNetGuiTest) c# örneği hatalıdır.\r\nBiz bu örnekteki hataları ', 'istanbul', '/2150625012MustafaDemirCv.docx', '2019-01-03 00:48:32', '2019-01-10', 1200, NULL, b'1', b'0', b'1'),
(52, 28, 0, '8', 'adsa', 'asda', 'ad', '/2781828567İŞ YERİ EĞİTİMİ SON.docx', '2019-01-03 00:55:27', '2019-01-26', 111, NULL, b'0', b'0', b'0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda`
--

CREATE TABLE `hakkimizda` (
  `hakkimizda_id` int(11) NOT NULL,
  `hakkimizda_baslik` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_vizyon` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_misyon` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hakkimizda`
--

INSERT INTO `hakkimizda` (`hakkimizda_id`, `hakkimizda_baslik`, `hakkimizda_icerik`, `hakkimizda_vizyon`, `hakkimizda_misyon`) VALUES
(0, 'Hakkımızda Baslık', 'Hakkımızda içerik -Hakkımızda içerik -Hakkımızda içerik -Hakkımızda içerik -Hakkımızda içerik  ', 'hakkimizda vizyon-hakkimizda vizyon-hakkimizda vizyon-hakkimizda vizyon-hakkimizda vizyon-hakkimizda vizyon-hakkimizda vizyon', 'hakkimizda misyon-hakkimizda misyon-hakkimizda misyon-hakkimizda misyon-hakkimizda misyon-hakkimizda misyon-hakkimizda misyon');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` smallint(9) NOT NULL,
  `kategori_ad` varchar(25) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_ad`) VALUES
(8, 'Mobil'),
(9, 'NesneTabanlı'),
(10, 'Web'),
(11, 'Veritabanı'),
(12, 'MasaÜstü');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` smallint(9) NOT NULL,
  `kullanici_zaman` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kullanici_foto` varchar(250) DEFAULT '/avatar.png',
  `kullanici_bio` varchar(300) DEFAULT 'Bize Kendinden ve Daha Önce Neler Yaptığından Kısaca Bahset',
  `kullanici_ad` varchar(20) NOT NULL,
  `kullanici_soyad` varchar(20) NOT NULL,
  `kullanici_mail` varchar(50) NOT NULL,
  `kullanici_gsm` char(11) NOT NULL,
  `kullanici_password` varchar(50) NOT NULL,
  `kullanici_il` varchar(15) NOT NULL,
  `kullanici_ilce` varchar(20) NOT NULL,
  `kullanici_adres` varchar(250) DEFAULT NULL,
  `kullanici_univ` varchar(40) DEFAULT NULL,
  `kullanici_bolum` varchar(30) DEFAULT NULL,
  `kullanici_derece` varchar(15) DEFAULT 'q',
  `uye_onay` bit(1) NOT NULL DEFAULT b'0',
  `puan` int(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_id`, `kullanici_zaman`, `kullanici_foto`, `kullanici_bio`, `kullanici_ad`, `kullanici_soyad`, `kullanici_mail`, `kullanici_gsm`, `kullanici_password`, `kullanici_il`, `kullanici_ilce`, `kullanici_adres`, `kullanici_univ`, `kullanici_bolum`, `kullanici_derece`, `uye_onay`, `puan`) VALUES
(11, '2018-11-24 20:09:49', '/29442251831430134996866.jpg', '', 'Volkan', 'Biçen', 'vbicen2@gmail.com', '05063636607', 'e10adc3949ba59abbe56e057f20f883e', 'Ankara', 'Gölbaşı', 'merkez', 'Fırat Üniversitesi', 'Yazılım Mühendisliği', 'Lisans', b'1', 0),
(12, '2018-12-13 17:28:39', '/avatar.png', 'Bize Kendinden ve Daha Önce Neler Yaptığından Kısaca Bahset', 'deneme', 'hesap', 'vbicen1@gmail.com', '05076529874', 'e10adc3949ba59abbe56e057f20f883e', 'Ankara', 'Gölbaşı', '', 'Fırat Üniversitesi', 'Yazılım Mühendisliği', 'lisans', b'1', 0),
(19, '2018-12-11 15:59:37', '/25654258391461483155678.jpg', 'biyografi kontrol ', 'admin', 'admin', 'deneyelim0912@gmail.com', '05063636613', 'e10adc3949ba59abbe56e057f20f883e', 'Ankara', 'Gölbaşı', '', 'Fırat Üniversitesi', 'Yazılım Mühendisliği', 'Lisans', b'1', 0),
(27, '2018-12-13 19:23:16', '/avatar.png', 'Bize Kendinden ve Daha Önce Neler Yaptığından Kısaca Bahset', 'mustafa2', 'tüter', 'denemeisbende@gmail.com', '05063636612', 'e10adc3949ba59abbe56e057f20f883e', 'Ankara', 'Gölbaşı', NULL, 'Fırat Üniversitesi', 'Yazılım Mühendisliği', 'lisans', b'1', 0),
(28, '2019-01-03 00:10:15', '/avatar.png', 'Bize Kendinden ve Daha Önce Neler Yaptığından Kısaca Bahset', 'mustafa', 'demır', 'dmrrrr.mstf@gmail.com', '05426090423', 'e5b78b1e9b452d9c68e30e1a7372ea2a', 'kayseri', 'develi', 'elazı', 'fırat', 'yazılım', '4', b'1', 9);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullaniciyetenek`
--

CREATE TABLE `kullaniciyetenek` (
  `kYetId` smallint(9) NOT NULL,
  `yetenekid` smallint(9) NOT NULL,
  `kullaniciId` smallint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullaniciyetenek`
--

INSERT INTO `kullaniciyetenek` (`kYetId`, `yetenekid`, `kullaniciId`) VALUES
(6, 7, 11),
(7, 9, 11),
(8, 8, 27),
(9, 10, 27),
(10, 9, 20),
(11, 9, 19),
(17, 3, 31),
(18, 3, 11);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

CREATE TABLE `mesaj` (
  `mesajId` smallint(9) NOT NULL,
  `gonderenId` smallint(9) NOT NULL,
  `cevaplayanId` smallint(9) NOT NULL,
  `gorev_id` smallint(9) NOT NULL,
  `mesaj` varchar(300) NOT NULL,
  `cevap` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `mesaj`
--

INSERT INTO `mesaj` (`mesajId`, `gonderenId`, `cevaplayanId`, `gorev_id`, `mesaj`, `cevap`) VALUES
(4, 11, 31, 38, 'Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu ', 'ben yaptım oldu'),
(8, 19, 11, 38, 'Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu', 'dedim ya la ben yaparım'),
(9, 11, 11, 39, 'deneme 2', 'nasıl cevap verdim ama hahaha nasıl cevap verdim ama hahaha nasıl cevap verdim ama hahaha '),
(10, 11, 11, 39, 'Nasıl yaptın la bunu Nasıl yaptın la bunu Nasıl yaptın la bunu ', 'q'),
(11, 19, 11, 39, 'deneme 2', 'deneme3'),
(12, 11, 12, 38, 'Soruma Cevap ver', 'verdim '),
(13, 20, 11, 39, 'soru deneme', ''),
(14, 12, 11, 39, 'soru sorun la bana', ''),
(15, 12, 11, 39, 'soru deneme', ''),
(16, 28, 11, 39, 'daadaa', ''),
(17, 11, 12, 49, 'dhsadas', ''),
(18, 28, 11, 51, 'mehaba', ''),
(19, 28, 11, 51, 'nasılsınız', ''),
(20, 28, 11, 51, 'yarrağımmm', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `teklif`
--

CREATE TABLE `teklif` (
  `teklif_id` smallint(9) NOT NULL,
  `gorev_id` smallint(6) NOT NULL,
  `veren_id` smallint(6) NOT NULL,
  `teklif_miktar` smallint(9) NOT NULL,
  `teklif_secim` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `teklif`
--

INSERT INTO `teklif` (`teklif_id`, `gorev_id`, `veren_id`, `teklif_miktar`, `teklif_secim`) VALUES
(1, 38, 11, 10, b'0'),
(3, 38, 19, 100, b'0'),
(4, 39, 19, 100, b'0'),
(5, 39, 12, 100, b'0'),
(6, 39, 28, 100, b'0'),
(7, 49, 11, 0, b'0'),
(8, 51, 28, 100, b'0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yetenek`
--

CREATE TABLE `yetenek` (
  `yetenekId` smallint(9) NOT NULL,
  `yetenekadi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yetenek`
--

INSERT INTO `yetenek` (`yetenekId`, `yetenekadi`) VALUES
(3, 'Web Sitesi'),
(4, 'Android Uygulama'),
(5, 'İos Uygulama'),
(6, 'C'),
(7, 'C++'),
(8, 'Csharp'),
(9, 'Java'),
(10, 'Python'),
(11, 'Php'),
(12, 'Asp.Net'),
(13, 'JavaScript');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `gorev`
--
ALTER TABLE `gorev`
  ADD PRIMARY KEY (`gorev_id`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`),
  ADD UNIQUE KEY `email` (`kullanici_mail`),
  ADD UNIQUE KEY `telNo` (`kullanici_gsm`);

--
-- Tablo için indeksler `kullaniciyetenek`
--
ALTER TABLE `kullaniciyetenek`
  ADD PRIMARY KEY (`kYetId`);

--
-- Tablo için indeksler `mesaj`
--
ALTER TABLE `mesaj`
  ADD PRIMARY KEY (`mesajId`);

--
-- Tablo için indeksler `teklif`
--
ALTER TABLE `teklif`
  ADD PRIMARY KEY (`teklif_id`);

--
-- Tablo için indeksler `yetenek`
--
ALTER TABLE `yetenek`
  ADD PRIMARY KEY (`yetenekId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` smallint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `gorev`
--
ALTER TABLE `gorev`
  MODIFY `gorev_id` smallint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` smallint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` smallint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Tablo için AUTO_INCREMENT değeri `kullaniciyetenek`
--
ALTER TABLE `kullaniciyetenek`
  MODIFY `kYetId` smallint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tablo için AUTO_INCREMENT değeri `mesaj`
--
ALTER TABLE `mesaj`
  MODIFY `mesajId` smallint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Tablo için AUTO_INCREMENT değeri `teklif`
--
ALTER TABLE `teklif`
  MODIFY `teklif_id` smallint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `yetenek`
--
ALTER TABLE `yetenek`
  MODIFY `yetenekId` smallint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
