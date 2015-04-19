-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ipark
-- ------------------------------------------------------
-- Server version	5.6.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `parks`
--

DROP TABLE IF EXISTS `parks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parks` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Company` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Address` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `ZIPCode` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `ZIPLocation` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `Country` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Latitude` decimal(11,8) DEFAULT NULL,
  `Longitude` decimal(11,8) DEFAULT NULL,
  `Phone` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `OpeningHour` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `ClosingHour` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `PricePerHour` int(11) DEFAULT NULL,
  `Floors` int(11) DEFAULT NULL,
  `DisabledPlaces` int(11) DEFAULT NULL,
  `Capacity` int(11) NOT NULL,
  `Active` bit(1) NOT NULL DEFAULT b'1',
  `CreationDate` date NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `paymentmethods`
--

DROP TABLE IF EXISTS `paymentmethods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymentmethods` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ParkID` int(11) NOT NULL,
  `Description` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `Park_PaymentMethods_idx` (`ParkID`),
  CONSTRAINT `Park_PaymentMethods` FOREIGN KEY (`ParkID`) REFERENCES `parks` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stocking`
--

DROP TABLE IF EXISTS `stocking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocking` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ParkID` int(11) NOT NULL,
  `Value` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `Park_Stocking_idx` (`ParkID`),
  CONSTRAINT `Park_Stocking` FOREIGN KEY (`ParkID`) REFERENCES `parks` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `Name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Email` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `Gender` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `Country` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `RegistrationDate` date NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-01 19:35:52
