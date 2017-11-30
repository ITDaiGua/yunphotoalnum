-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: yunphotoalbum
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `collection`
--

DROP TABLE IF EXISTS `collection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collection` (
  `cltId` varchar(18) NOT NULL,
  `uid` varchar(16) NOT NULL,
  `sid` varchar(30) NOT NULL,
  `cltTime` varchar(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cltId`),
  UNIQUE KEY `clt` (`uid`,`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collection`
--

LOCK TABLES `collection` WRITE;
/*!40000 ALTER TABLE `collection` DISABLE KEYS */;
INSERT INTO `collection` VALUES ('clt15096154235089','u145678945123458','s123456','1509641395',0),('clt15096154519764','u145678945123458','s123487','1509716520',0),('clt15098760163021','u789123456','s123456','1511974918',0),('clt15099645676529','u789123456','s123487','1510326365',0),('clt15117901373755','u789123456','s4567813456','1511790137',0);
/*!40000 ALTER TABLE `collection` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `inc_afterClt`
AFTER INSERT ON `collection`
FOR EACH ROW
BEGIN
      update `sharePA` set cltSum=cltSum+1 where sid=new.sid;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cancleClt`
AFTER UPDATE ON `collection`
FOR EACH ROW
BEGIN
	IF new.status=1 THEN
      update `sharepa` set cltSum=cltSum-1 where sid=old.sid;
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `cid` varchar(16) NOT NULL,
  `sid` varchar(16) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `time` varchar(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `tipOffSum` int(11) NOT NULL DEFAULT '0',
  `isIgnore` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `cmt` (`sid`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES ('c15093521287848','s123456','编程','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/0.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509352128',0,1,0),('c15093521355091','s123456','编程','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/13.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509352135',0,0,0),('c15093521478468','s123456','编程','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/24.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509352147',0,0,0),('c15093527706486','s123456','编程','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/13.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509352770',0,0,0),('c15093536568459','s123456','编程','图片处理得很好啊','1509353656',0,3,0),('c15093544347416','s123456','编程','7945787878','1509354434',0,3,0),('c15093544772655','s123456','编程','很好&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/0.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509354477',0,3,0),('c15093805886415','s123487','编程','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/13.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509380588',0,1,0),('c15093806506632','s123487','编程','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/0.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509380650',0,1,0),('c15093808965628','s123487','编程','名人眼','1509380896',0,1,0),('c15093837607240','s123456','编程','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/109.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509383760',0,1,0),('c15095506584718','s123456','编程','ssssssssssssssssssssssssssss','1509550658',0,1,0),('c15095507600372','s123456','编程','ffffffff','1509550760',0,2,0),('c15095507772844','s123456','编程','fffffffffffffffffffff','1509550777',0,1,0),('c15095508339562','s123456','编程','ddadadada','1509550833',0,1,0),('c15095548642030','s123487','编程','是是是是是是是是是是','1509554864',0,0,0),('c15095550572447','s123487','编程','是是是','1509555057',0,0,0),('c15095551381538','s123487','编程','广告广告咯咯咯咯咯过过过过过过过过','1509555138',0,0,0),('c15095552462715','s123487','编程','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/15.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509555246',0,0,0),('c15096157303311','s123456','编程','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/2.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509615730',0,1,0),('c15097800046837','s123456','编程','564','1509780004',0,0,0),('c15098948547248','s123487','代号','&lt;img src=&quot;http://localhost:8080/YunPhotoAlbum/Public/kindeditor/plugins/emoticons/images/0.gif&quot; border=&quot;0&quot; alt=&quot;&quot; /&gt;','1509894854',0,0,0),('c15102209781879','s123487','代号','wqe','1510220978',0,0,0),('c15111919561787','s123456','代号','我我我我我我我无无错','1511191956',0,0,0),('c15111939804924','s123456','代号','123','1511193980',0,0,0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like`
--

DROP TABLE IF EXISTS `like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `like` (
  `sid` varchar(16) NOT NULL,
  `uid` varchar(16) NOT NULL,
  `likeTime` varchar(11) NOT NULL,
  PRIMARY KEY (`sid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like`
--

LOCK TABLES `like` WRITE;
/*!40000 ALTER TABLE `like` DISABLE KEYS */;
INSERT INTO `like` VALUES ('s123456','u145678945123458','1509376394'),('s123456','u789123456','1509894041'),('s123487','u145678945123458','1509376389'),('s123487','u789123456','1509894877'),('s15117909529799','u789123456','1511974981'),('s4567813456','u145678945123458','1509721644'),('s4567813456','u789123456','1509957512');
/*!40000 ALTER TABLE `like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `uid` varchar(16) NOT NULL,
  `pid` varchar(16) NOT NULL,
  `PAId` varchar(17) NOT NULL,
  `PLink` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`pid`,`PAId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES ('u789123456','p15106798524578','pa15106798524014','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p1547897/t/jpg',0),('u789123456','p15106798525789','pa15106798524014','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p4678945/t/jpg',0),('u789123456','p15118545885503','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118545885503/t/png',0),('u789123456','p15118531215100','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118531215100/t/jpg',0),('u789123456','p15118531217403','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118531217403/t/jpg',0),('u789123456','p15118531214415','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118531214415/t/jpg',0),('u789123456','p15118531204556','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118531204556/t/jpg',0),('u789123456','p15118531203828','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118531203828/t/jpg',0),('u789123456','p15118531207032','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118531207032/t/jpg',0),('u789123456','p15118531202233','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118531202233/t/jpg',0),('u789123456','p15118531204774','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118531204774/t/jpg',0),('u789123456','p15118531204663','pa15113665008339','/YunPhotoAlbum/Index/thumb1/p/image-u789123456/fn/p15118531204663/t/jpg',0);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photoalbum`
--

DROP TABLE IF EXISTS `photoalbum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photoalbum` (
  `uid` varchar(16) NOT NULL,
  `PAId` varchar(17) NOT NULL,
  `PAName` varchar(30) NOT NULL DEFAULT '未命名',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`PAId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photoalbum`
--

LOCK TABLES `photoalbum` WRITE;
/*!40000 ALTER TABLE `photoalbum` DISABLE KEYS */;
INSERT INTO `photoalbum` VALUES ('u7871123','pa1564789145','风景秀丽的大别山啊',0),('u789123456','pa15106798524014','未命名2',0),('u789123456','pa15113379172349','未命名1',0),('u789123456','pa15113415110788','未命名3',0),('u789123456','pa15113415195911','未命名4',0),('u789123456','pa15113572070507','未命名5',0),('u789123456','pa15113572148613','未命名6',0),('u789123456','pa15113574681104','未命名7',0),('u789123456','pa15113574777239','未命名8',0),('u789123456','pa15113574827088','未命名9',0),('u789123456','pa15113574889582','未命名10',0),('u789123456','pa15113574946945','未命名11',0),('u789123456','pa15113575007062','未命名12',0),('u789123456','pa15113665008339','未命名13',0);
/*!40000 ALTER TABLE `photoalbum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sharepa`
--

DROP TABLE IF EXISTS `sharepa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sharepa` (
  `sid` varchar(16) NOT NULL,
  `uid` varchar(16) NOT NULL,
  `PAId` varchar(16) NOT NULL,
  `authorName` varchar(30) NOT NULL,
  `sName` varchar(30) NOT NULL,
  `profile` varchar(200) NOT NULL,
  `sclass` varchar(10) NOT NULL,
  `skey` varchar(50) NOT NULL,
  `lookSum` int(10) unsigned NOT NULL DEFAULT '0',
  `likeSum` int(10) unsigned NOT NULL DEFAULT '0',
  `cltSum` int(11) NOT NULL,
  `shareTime` varchar(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sid`),
  FULLTEXT KEY `sft` (`sclass`,`skey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sharepa`
--

LOCK TABLES `sharepa` WRITE;
/*!40000 ALTER TABLE `sharepa` DISABLE KEYS */;
INSERT INTO `sharepa` VALUES ('s123456','u789123','pa15106798745864','莫白柏','这是文件夹','这是我的旅游记录','旅;游','风;景;热;情',142,2,2,'1234567899',0),('s4567813456','u789123','pa15106798745126','莫柏模','我的旅游相册','这是在香港旅游拍的相片','旅游','旅 游;香 港;',24,2,1,'1508835243',0),('s15117909529799','u789123456','pa15106798524014','代号','未命名2','方法反反复复反复反复反复反复反复反复反复反复反复反复反复反复付付付付付付付或或或或或或或或或或或或或或或','人;物;','没;变;',4,1,0,'1511790952',0);
/*!40000 ALTER TABLE `sharepa` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `cancleShare` AFTER UPDATE ON `sharepa` FOR EACH ROW BEGIN
      IF new.status=1 THEN
      	update `sharephoto` set status=1 where sid=new.sid ;
      END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `sharephoto`
--

DROP TABLE IF EXISTS `sharephoto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sharephoto` (
  `sid` varchar(16) NOT NULL,
  `pid` varchar(16) NOT NULL,
  `spLink` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`sid`,`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sharephoto`
--

LOCK TABLES `sharephoto` WRITE;
/*!40000 ALTER TABLE `sharephoto` DISABLE KEYS */;
INSERT INTO `sharephoto` VALUES ('pa002','dsds','sds',0),('s123456','p1547896','/YunPhotoAlbum/Index/thumbAuth/u/u789123/fn/p98756/sid/s123456/t/jpg/w/159/h/190',0),('s123456','p25496','/YunPhotoAlbum/Index/thumbAuth/u/u789123/fn/p1547896/sid/s123456/t/jpg/w/159/h/190',0),('s123456','p4678945','/YunPhotoAlbum/Index/thumbAuth/u/u789123/fn/p1547897/sid/s123456/t/jpg/w/159/h/190',0),('s123456','p78456','/YunPhotoAlbum/Index/thumbAuth/u/u789123/fn/p4678945/sid/s123456/t/jpg/w/159/h/190',0),('s123456','p791457','/YunPhotoAlbum/Index/thumbAuth/u/u789123/fn/p4793546/sid/s123456/t/jpg/w/159/h/190',0),('s123456','p79267','/YunPhotoAlbum/Index/thumbAuth/u/u789123/fn/p76419834/sid/s123456/t/jpg/w/159/h/190',0),('s123456','p794555','/YunPhotoAlbum/Index/thumbAuth/u/u789123/fn/p45783154678/sid/s123456/t/jpg/w/159/h/190',0),('s123456','p79456','/YunPhotoAlbum/Index/thumbAuth/u/u789123/fn/p78964301567/sid/s123456/t/jpg/w/159/h/190',0),('s123487','p1547897','/YunPhotoAlbum/Index/thumbAuth/u/u7871123/fn/p98756/sid/s123487/t/jpg/w/159/h/190',0),('s123487','p79457','/YunPhotoAlbum/Index/thumbAuth/u/u7845613/fn/p1547896/sid/s123487/t/jpg/w/159/h/190',0),('s123487','p85457','/YunPhotoAlbum/Index/thumbAuth/u/u7845613/fn/p4793546/sid/s123487/t/jpg/w/159/h/190',0),('s15111949200758','p15106798524578','/YunPhotoAlbum/Index/thumbAuth/p/u789123456/fn/p1547897/t/jpg/sid/s15111949200758/w/159/h/190',0),('s15117762961800','p15106798524578','/YunPhotoAlbum/Index/thumbAuth/p/image-u789123456/fn/p1547897/t/jpg/sid/s15117762961800/w/159/h/190',0),('s15117762961800','p15106798525789','/YunPhotoAlbum/Index/thumbAuth/p/image-u789123456/fn/p4678945/t/jpg/sid/s15117762961800/w/159/h/190',0),('s15117764449608','p15106798524578','/YunPhotoAlbum/Index/thumbAuth/p/image-u789123456/fn/p1547897/t/jpg/sid/s15117764449608/w/159/h/190',0),('s15117764449608','p15106798525789','/YunPhotoAlbum/Index/thumbAuth/p/image-u789123456/fn/p4678945/t/jpg/sid/s15117764449608/w/159/h/190',0),('s15117768592535','p15106798524578','/YunPhotoAlbum/Index/thumbAuth/p/image-u789123456/fn/p1547897/t/jpg/sid/s15117768592535/w/159/h/190',0),('s15117768592535','p15106798525789','/YunPhotoAlbum/Index/thumbAuth/p/image-u789123456/fn/p4678945/t/jpg/sid/s15117768592535/w/159/h/190',0),('s15117909529799','p15106798524578','/YunPhotoAlbum/Index/thumbAuth/p/image-u789123456/fn/p1547897/t/jpg/sid/s15117909529799/w/159/h/190',0),('s15117909529799','p15106798525789','/YunPhotoAlbum/Index/thumbAuth/p/image-u789123456/fn/p4678945/t/jpg/sid/s15117909529799/w/159/h/190',0);
/*!40000 ALTER TABLE `sharephoto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spatipoff`
--

DROP TABLE IF EXISTS `spatipoff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spatipoff` (
  `stfId` varchar(16) NOT NULL,
  `uid` varchar(16) NOT NULL,
  `sid` varchar(16) NOT NULL,
  `style` varchar(10) NOT NULL,
  `tpContactWay` varchar(11) NOT NULL,
  `tpexplain` varchar(150) NOT NULL,
  `tpImgs` text,
  `TipOffTime` varchar(11) NOT NULL,
  `handleAd` varchar(17) DEFAULT NULL,
  `result` varchar(100) DEFAULT NULL,
  `handleTime` varchar(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`stfId`),
  UNIQUE KEY `stfuk` (`uid`,`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spatipoff`
--

LOCK TABLES `spatipoff` WRITE;
/*!40000 ALTER TABLE `spatipoff` DISABLE KEYS */;
INSERT INTO `spatipoff` VALUES ('stf150998858803','u789123456','s123456','血腥恐怖','18813757931','血腥恐怖血腥恐怖血腥恐怖血腥恐怖血腥恐怖血腥恐怖血腥恐怖血腥恐怖血腥恐怖血腥恐怖','http://localhost:8080/YunPhotoAlbum/Index/thumbAuth/p/tipoffImg-u789123456/fn/tpi1509988578/t/jpg/w/80/h/80|http://localhost:8080/YunPhotoAlbum/Index/thumbAuth/p/tipoffImg-u789123456/fn/tpi1509988581/t/jpg/w/80/h/80|http://localhost:8080/YunPhotoAlbum/Index/thumbAuth/p/tipoffImg-u789123456/fn/tpi1509988584/t/jpg/w/80/h/80|','1509988588',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `spatipoff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `char` char(50) NOT NULL,
  `varchar` varchar(50) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `char` (`char`),
  FULLTEXT KEY `varchar` (`varchar`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp`
--

LOCK TABLES `temp` WRITE;
/*!40000 ALTER TABLE `temp` DISABLE KEYS */;
INSERT INTO `temp` VALUES (1,'a bc 我 知道 1 23','a bc 我 知道 1 23','a bc 我 知道 1 23');
/*!40000 ALTER TABLE `temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uloginlog`
--

DROP TABLE IF EXISTS `uloginlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uloginlog` (
  `uid` varchar(30) NOT NULL,
  `loginIp` varchar(128) NOT NULL,
  `loginTime` varchar(11) NOT NULL,
  `status` int(11) NOT NULL,
  KEY `loginIp` (`loginIp`,`loginTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uloginlog`
--

LOCK TABLES `uloginlog` WRITE;
/*!40000 ALTER TABLE `uloginlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `uloginlog` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `lgErr_count` BEFORE INSERT ON `uloginlog` FOR EACH ROW BEGIN
	IF new.status=1 THEN
		set @maxTime=(select unix_timestamp(now()));
		set @minTime=@maxTime-900;
		set @errcount=(select count(*) from uloginlog where uid=new.uid and (loginTime between @minTime and @maxTime));
		IF @errcount>=4 THEN
			update user set status=1 where uid=new.uid;
		END IF;
	END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` varchar(16) NOT NULL,
  `umail` varchar(40) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `upw` varchar(32) NOT NULL,
  `autonym` varchar(30) DEFAULT NULL,
  `usex` enum('男','女') NOT NULL DEFAULT '男',
  `birthday` varchar(11) DEFAULT NULL,
  `profile` varchar(250) DEFAULT NULL,
  `userImg` varchar(100) DEFAULT NULL,
  `securityQst` varchar(100) DEFAULT NULL,
  `securityAsw` varchar(32) DEFAULT NULL,
  `rgstTime` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `umail` (`umail`),
  KEY `login` (`umail`,`upw`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('u15101611795007','157@qq.com','1234','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,NULL,NULL,NULL,'2017-11-09',0),('u15101620789365','1578@qq.com','3人体','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,NULL,NULL,NULL,'2017-11-09',0),('u15101635125508','15789@qq.com','辅导费','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,NULL,NULL,NULL,'2017-11-09',0),('u15101636225993','1578910@qq.com','的法国','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,NULL,NULL,NULL,'2017-11-09',0),('u15101637977410','1578911@qq.com','美白','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,NULL,NULL,NULL,'2017-11-09',0),('u15101640546891','157812@qq.com','的法国2','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,NULL,NULL,NULL,'2017-11-09',0),('u15101644547815','157813@qq.com','uname','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,NULL,NULL,NULL,'2017-11-09',0),('u15102205741218','2059078284@qq.com','7946','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,NULL,NULL,NULL,'2017-11-09',1),('u7871123','1789461315@qq.com','刘焕子','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,'/YunPhotoAlbum/Index/thumb1/p/UserImg/fn/u789123/t/jpg','',NULL,'2009-01-02',0),('u789123','1571190643@qq.com','莫白柏','asadce15xscvbn2er',NULL,'男',NULL,NULL,'/YunPhotoAlbum/Index/thumb1/p/UserImg/fn/u7871123/t/jpg',NULL,NULL,'2014-01-07',0),('u789123456','1571190644@qq.com','代号','e3464a5c98bacd98fe692de5a51c75f0',NULL,'男',NULL,NULL,'/YunPhotoAlbum/Index/thumb1/p/UserImg/fn/u789123456/t/jpg/','我的密保','e3464a5c98bacd98fe692de5a51c75f0','2016-03-03',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-30 15:22:30
