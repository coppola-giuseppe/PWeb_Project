-- Progettazione Web 
-- MySQL dump 10.13  Distrib 5.7.28, for Win64 (x86_64)
--
-- Host: localhost    Database: playHub
-- ------------------------------------------------------
-- Server version	5.7.28

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
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `Username` varchar(255) NOT NULL,
  `Data` varchar(255) NOT NULL,
  `Gioco` varchar(255) NOT NULL,
  `Esito` varchar(255) NOT NULL,
  PRIMARY KEY (`Username`,`Data`),
  CONSTRAINT `games_FK_1` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES ('username','2024-01-08 22:19:38','Tic Tac Toe','vittoria'),('username','2024-01-08 22:19:43','Sasso Carta Forbici','pareggio'),('username','2024-01-08 22:23:29','Impiccato','sconfitta'),('username','2024-01-08 22:23:36','Impiccato','vittoria'),('username','2024-01-08 22:23:45','Tic Tac Toe','vittoria'),('username','2024-01-08 22:23:53','Sasso Carta Forbici','pareggio'),('username','2024-01-08 22:55:30','Tic Tac Toe','vittoria'),('username','2024-01-08 22:55:35','Sasso Carta Forbici','pareggio'),('username','2024-01-08 22:55:49','Impiccato','sconfitta'),('username','2024-01-08 22:55:58','Impiccato','vittoria');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Domanda` varchar(255) NOT NULL,
  `Risposta` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('user','$2y$10$DoGp1rcm3Qz8eHhmdMcsnuVT4f5xUjOEH28TJw.n9dFBnGVDAJDgy','Nome del tuo migliore amico?','marco','emaildiprova1@gmail.com'),('username','$2y$10$2cGg8HYqPnsuKY7KHUblIuBJkVazIyCeBQ1u8fFjW0UcD8r8QkgGy','Nome del tuo primo animale domestico?','pippo','emaildiprova@gmail.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `words`
--

DROP TABLE IF EXISTS `words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `words` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Parola` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Parola` (`Parola`)
) ENGINE=InnoDB AUTO_INCREMENT=468 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `words`
--

LOCK TABLES `words` WRITE;
/*!40000 ALTER TABLE `words` DISABLE KEYS */;
INSERT INTO `words` VALUES (312,'abito'),(32,'acqua'),(379,'affare'),(303,'aiuto'),(254,'albergo'),(85,'albero'),(304,'ambiente'),(33,'amico'),(36,'amore'),(384,'angolo'),(322,'anima'),(111,'animale'),(305,'animo'),(2,'anno'),(256,'argomento'),(38,'aria'),(251,'arma'),(318,'arte'),(282,'articolo'),(356,'aspetto'),(460,'atteggiamento'),(125,'attenzione'),(463,'attesa'),(295,'attimo'),(355,'atto'),(457,'attore'),(354,'automobile'),(126,'autore'),(441,'avvocato'),(338,'azione'),(464,'bagno'),(373,'bambina'),(184,'bambino'),(105,'base'),(260,'battaglia'),(374,'bellezza'),(380,'bene'),(306,'bestia'),(173,'bisogno'),(321,'bocca'),(270,'bosco'),(183,'braccio'),(447,'calcio'),(205,'camera'),(59,'campagna'),(169,'campo'),(92,'cane'),(225,'capello'),(44,'capo'),(106,'carattere'),(243,'carne'),(361,'carta'),(6,'casa'),(24,'caso'),(98,'causa'),(349,'cavallo'),(209,'centro'),(313,'chiave'),(182,'chiesa'),(160,'chilometro'),(174,'cielo'),(259,'classe'),(411,'collina'),(415,'collo'),(341,'colore'),(213,'colpa'),(331,'colpo'),(437,'commercio'),(128,'commissione'),(385,'compagnia'),(233,'compagno'),(134,'comunicazione'),(461,'concetto'),(197,'condizione'),(286,'confronto'),(445,'congresso'),(431,'conoscenza'),(117,'conseguenza'),(343,'consiglio'),(296,'contatto'),(177,'conto'),(149,'controllo'),(392,'coraggio'),(178,'corpo'),(314,'corrente'),(154,'corsa'),(316,'corso'),(307,'cortile'),(1,'cosa'),(107,'coscienza'),(275,'costa'),(283,'costruzione'),(291,'crisi'),(424,'croce'),(292,'cucina'),(300,'cultura'),(163,'cuore'),(416,'cura'),(425,'decisione'),(138,'denaro'),(119,'dente'),(389,'desiderio'),(139,'destino'),(413,'difesa'),(148,'differenza'),(76,'dio'),(393,'direttore'),(112,'direzione'),(201,'diritto'),(208,'discorso'),(417,'disposizione'),(120,'distanza'),(129,'dito'),(242,'dolore'),(375,'domanda'),(418,'Domenica'),(216,'don'),(10,'donna'),(236,'dottore'),(140,'dovere'),(74,'dubbio'),(113,'eccellenza'),(102,'effetto'),(246,'elemento'),(401,'energia'),(144,'epoca'),(155,'erba'),(297,'errore'),(271,'esame'),(166,'esempio'),(394,'esercito'),(83,'esperienza'),(386,'espressione'),(405,'estate'),(438,'fabbrica'),(170,'faccia'),(454,'fame'),(47,'famiglia'),(448,'fantasia'),(280,'fatica'),(34,'fatto'),(432,'favore'),(402,'fede'),(135,'fenomeno'),(141,'ferro'),(56,'festa'),(372,'fianco'),(427,'fiducia'),(194,'figlia'),(27,'figlio'),(77,'figura'),(406,'film'),(428,'filo'),(188,'fine'),(317,'finestra'),(60,'fiore'),(381,'fiume'),(465,'foglia'),(429,'folla'),(165,'fondo'),(189,'forma'),(357,'fortuna'),(39,'forza'),(267,'frase'),(366,'fratello'),(298,'fretta'),(176,'fronte'),(407,'frutto'),(116,'funzione'),(69,'fuoco'),(252,'gamba'),(293,'gatto'),(244,'generale'),(346,'genere'),(35,'gente'),(262,'gesto'),(103,'giardino'),(57,'gioco'),(255,'gioia'),(347,'giornale'),(325,'giornata'),(4,'giorno'),(419,'giovanotto'),(353,'giro'),(301,'giudizio'),(439,'giugno'),(440,'giustizia'),(52,'governo'),(395,'grado'),(150,'grazia'),(206,'gruppo'),(108,'guardia'),(25,'guerra'),(121,'gusto'),(164,'idea'),(399,'immagine'),(73,'importanza'),(122,'impressione'),(367,'industria'),(130,'inizio'),(299,'intenzione'),(333,'interesse'),(229,'inverno'),(93,'isola'),(466,'istante'),(123,'istituto'),(387,'labbro'),(467,'lago'),(272,'lato'),(455,'latte'),(22,'lavoro'),(192,'legge'),(202,'lettera'),(175,'letto'),(193,'libro'),(268,'limite'),(352,'linea'),(223,'lingua'),(207,'lira'),(382,'lotta'),(45,'luce'),(145,'luna'),(196,'luogo'),(360,'macchina'),(161,'madre'),(369,'maestro'),(136,'maggio'),(114,'malattia'),(218,'mamma'),(250,'maniera'),(11,'mano'),(42,'mare'),(199,'marito'),(156,'massa'),(248,'materia'),(449,'matrimonio'),(340,'mattina'),(263,'mattino'),(450,'medico'),(109,'memoria'),(95,'mente'),(383,'mercato'),(456,'merito'),(43,'mese'),(442,'messa'),(462,'mestiere'),(414,'metro'),(211,'mezzo'),(328,'milione'),(180,'ministro'),(362,'minuto'),(62,'misura'),(17,'modo'),(171,'moglie'),(16,'momento'),(18,'mondo'),(400,'montagna'),(227,'monte'),(187,'morte'),(82,'motivo'),(94,'movimento'),(350,'muro'),(235,'musica'),(64,'natura'),(238,'nave'),(230,'nazione'),(80,'nemico'),(30,'nome'),(279,'nord'),(365,'notizia'),(28,'notte'),(179,'numero'),(96,'occasione'),(12,'occhio'),(281,'odore'),(217,'oggetto'),(337,'ombra'),(408,'onore'),(54,'opera'),(315,'operaio'),(273,'operazione'),(264,'opinione'),(13,'ora'),(167,'ordine'),(443,'orecchio'),(157,'origine'),(358,'oro'),(451,'ospedale'),(186,'pace'),(20,'padre'),(396,'padrone'),(15,'paese'),(231,'pagina'),(323,'palazzo'),(403,'pane'),(118,'parete'),(19,'parola'),(7,'parte'),(359,'partito'),(151,'passato'),(127,'passione'),(324,'passo'),(253,'patria'),(162,'paura'),(308,'pelle'),(81,'pena'),(185,'pensiero'),(409,'pericolo'),(99,'periodo'),(49,'persona'),(370,'personaggio'),(422,'peso'),(224,'pezzo'),(368,'piacere'),(320,'piano'),(376,'pianta'),(452,'pianura'),(78,'piazza'),(48,'piede'),(239,'pietra'),(426,'poesia'),(420,'poeta'),(86,'politica'),(158,'polizia'),(371,'pomeriggio'),(265,'ponte'),(433,'popolazione'),(190,'popolo'),(89,'porta'),(446,'porto'),(63,'posizione'),(168,'posto'),(287,'potenza'),(234,'potere'),(274,'pranzo'),(276,'prato'),(219,'presenza'),(342,'presidente'),(97,'prezzo'),(344,'principe'),(221,'principio'),(181,'problema'),(87,'processo'),(55,'prodotto'),(240,'produzione'),(198,'professore'),(131,'programma'),(245,'proposito'),(309,'proposta'),(58,'prova'),(146,'provincia'),(377,'pubblico'),(142,'punta'),(21,'punto'),(124,'quadro'),(79,'questione'),(203,'ragazza'),(172,'ragazzo'),(41,'ragione'),(327,'rapporto'),(226,'regione'),(143,'regno'),(258,'relazione'),(277,'repubblica'),(195,'resto'),(458,'ricchezza'),(75,'ricerca'),(84,'ricordo'),(214,'rispetto'),(397,'risposta'),(72,'risultato'),(269,'ritorno'),(310,'riva'),(284,'rivoluzione'),(430,'roba'),(459,'sacrificio'),(61,'sala'),(332,'sangue'),(249,'scala'),(215,'scena'),(115,'scienza'),(232,'scopo'),(410,'scrittore'),(204,'scuola'),(210,'secolo'),(378,'sede'),(200,'segno'),(311,'segretario'),(404,'seguito'),(53,'senso'),(237,'sentimento'),(31,'sera'),(390,'serie'),(326,'servizio'),(364,'settimana'),(288,'sforzo'),(257,'sguardo'),(289,'sicurezza'),(51,'signora'),(14,'signore'),(336,'signorina'),(335,'silenzio'),(319,'sistema'),(351,'situazione'),(91,'sogno'),(70,'soldato'),(46,'sole'),(159,'soluzione'),(444,'sonno'),(101,'sorella'),(266,'sorriso'),(334,'spalla'),(152,'spazio'),(66,'specie'),(241,'speranza'),(302,'spesa'),(132,'spettacolo'),(348,'spirito'),(421,'stagione'),(137,'stampa'),(329,'stanza'),(23,'stato'),(247,'stazione'),(153,'stella'),(37,'storia'),(26,'strada'),(434,'strumento'),(191,'studio'),(67,'successo'),(90,'sud'),(100,'sviluppo'),(398,'tavola'),(453,'tavolo'),(220,'teatro'),(9,'tempo'),(222,'termine'),(110,'terreno'),(294,'territorio'),(40,'testa'),(212,'tipo'),(133,'titolo'),(423,'tono'),(363,'tratto'),(228,'treno'),(290,'ufficiale'),(65,'ufficio'),(3,'uomo'),(435,'uso'),(278,'valle'),(330,'valore'),(339,'vento'),(436,'vestito'),(50,'via'),(345,'viaggio'),(388,'villa'),(88,'vino'),(391,'visita'),(261,'viso'),(71,'vista'),(8,'vita'),(29,'voce'),(147,'voglia'),(5,'volta'),(104,'volto'),(285,'zia'),(412,'zio'),(68,'zona');
/*!40000 ALTER TABLE `words` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-08 23:01:44
