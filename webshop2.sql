-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 27 mrt 2015 om 22:45
-- Serverversie: 5.6.20
-- PHP-versie: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `webshop2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
`categorieID` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `categorie`
--

INSERT INTO `categorie` (`categorieID`, `naam`) VALUES
(1, 'Smartphones');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`productID` int(11) NOT NULL,
  `titel` varchar(45) DEFAULT NULL,
  `beschrijving` varchar(45) DEFAULT NULL,
  `prijs` float DEFAULT NULL,
  `afbeelding` varchar(45) DEFAULT NULL,
  `categorieID` int(11) NOT NULL,
  `isfeatured` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`productID`, `titel`, `beschrijving`, `prijs`, `afbeelding`, `categorieID`, `isfeatured`) VALUES
(6, 'telefoontje1', 'Lorem ipsum dolor sit amet, consectetur adipi', 34, NULL, 1, '1'),
(7, 'telefoontje2', 'Lorem ipsum dolor sit amet, consectetur adipi', 87, NULL, 1, '1'),
(8, 'telefoontje3', 'Lorem ipsum dolor sit amet, consectetur adipi', 70, NULL, 1, '0'),
(9, 'telefoontje4', 'Lorem ipsum dolor sit amet, consectetur adipi', 50, NULL, 1, '0'),
(10, 'telefoontje5', 'Lorem ipsum dolor sit amet, consectetur adipi', 40, NULL, 1, '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_in_cart`
--

CREATE TABLE IF NOT EXISTS `product_in_cart` (
`productID` int(11) NOT NULL,
  `shopping_cartID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `review`
--

CREATE TABLE IF NOT EXISTS `review` (
`reviewID` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `content` varchar(45) DEFAULT NULL,
  `titel` varchar(45) DEFAULT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shopping_cart`
--

CREATE TABLE IF NOT EXISTS `shopping_cart` (
`shopping_cartID` int(11) NOT NULL,
  `User_userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`userID` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categorie`
--
ALTER TABLE `categorie`
 ADD PRIMARY KEY (`categorieID`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`productID`), ADD KEY `fk_Product_Categorie1_idx` (`categorieID`);

--
-- Indexen voor tabel `product_in_cart`
--
ALTER TABLE `product_in_cart`
 ADD PRIMARY KEY (`productID`,`shopping_cartID`), ADD KEY `fk_Product_has_Shopping_Cart_Shopping_Cart1_idx` (`shopping_cartID`), ADD KEY `fk_Product_has_Shopping_Cart_Product1_idx` (`productID`);

--
-- Indexen voor tabel `review`
--
ALTER TABLE `review`
 ADD PRIMARY KEY (`reviewID`), ADD KEY `fk_Review_Product1_idx` (`productID`);

--
-- Indexen voor tabel `shopping_cart`
--
ALTER TABLE `shopping_cart`
 ADD PRIMARY KEY (`shopping_cartID`), ADD KEY `fk_Shopping_Cart_User_idx` (`User_userID`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categorie`
--
ALTER TABLE `categorie`
MODIFY `categorieID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `product_in_cart`
--
ALTER TABLE `product_in_cart`
MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `review`
--
ALTER TABLE `review`
MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `shopping_cart`
--
ALTER TABLE `shopping_cart`
MODIFY `shopping_cartID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `fk_Product_Categorie1` FOREIGN KEY (`categorieID`) REFERENCES `categorie` (`categorieID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `product_in_cart`
--
ALTER TABLE `product_in_cart`
ADD CONSTRAINT `fk_Product_has_Shopping_Cart_Product1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Product_has_Shopping_Cart_Shopping_Cart1` FOREIGN KEY (`shopping_cartID`) REFERENCES `shopping_cart` (`shopping_cartID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `review`
--
ALTER TABLE `review`
ADD CONSTRAINT `fk_Review_Product1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `shopping_cart`
--
ALTER TABLE `shopping_cart`
ADD CONSTRAINT `fk_Shopping_Cart_User` FOREIGN KEY (`User_userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
