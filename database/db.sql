-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: placement_portal
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table admin
--

DROP TABLE IF EXISTS admin;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE admin (
  id_admin int(11) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (id_admin)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table admin
--

LOCK TABLES admin WRITE;
/*!40000 ALTER TABLE admin DISABLE KEYS */;
INSERT INTO admin VALUES (1,'admin','123456');
/*!40000 ALTER TABLE admin ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table apply_job_post
--

DROP TABLE IF EXISTS apply_job_post;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE apply_job_post (
  id_apply int(11) NOT NULL AUTO_INCREMENT,
  id_jobpost int(11) NOT NULL,
  id_company int(11) NOT NULL,
  id_user int(11) NOT NULL,
  status int(11) NOT NULL DEFAULT 2,
  PRIMARY KEY (id_apply)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table apply_job_post
--

LOCK TABLES apply_job_post WRITE;
/*!40000 ALTER TABLE apply_job_post DISABLE KEYS */;
INSERT INTO apply_job_post VALUES (25,1,2,1,2);
/*!40000 ALTER TABLE apply_job_post ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table company
--

DROP TABLE IF EXISTS company;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE company (
  id_company int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  companyname varchar(255) NOT NULL,
  country varchar(255) NOT NULL,
  state varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  contactno varchar(255) NOT NULL,
  website varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  aboutme varchar(255) DEFAULT NULL,
  logo varchar(255) NOT NULL,
  createdAt timestamp NOT NULL DEFAULT current_timestamp(),
  active int(11) NOT NULL DEFAULT 2,
  PRIMARY KEY (id_company),
  UNIQUE KEY email (email)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table company
--

LOCK TABLES company WRITE;
/*!40000 ALTER TABLE company DISABLE KEYS */;
INSERT INTO company VALUES (2,'Amit','Co-ordinator','India','Madhya Pradesh','Indore','7987487551','www.scsplacementcelll.com','amit@gmail.com','ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=','Student','627635c95a472.jpg','2022-05-05 08:43:22',1);
/*!40000 ALTER TABLE company ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table job_post
--

DROP TABLE IF EXISTS job_post;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE job_post (
  id_jobpost int(11) NOT NULL AUTO_INCREMENT,
  id_company int(11) NOT NULL,
  jobtitle varchar(255) NOT NULL,
  description text NOT NULL,
  minimumsalary varchar(255) NOT NULL,
  minimummarks varchar(255) NOT NULL,
  experience varchar(255) NOT NULL,
  qualification varchar(255) NOT NULL,
  createdat timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id_jobpost)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table job_post
--

LOCK TABLES job_post WRITE;
/*!40000 ALTER TABLE job_post DISABLE KEYS */;
INSERT INTO job_post VALUES (1,2,'Accenture','Accenture plc is an Ireland-based multinational professional services company that specializes in information technology (IT) services and consulting. A Fortune Global 500 company, it reported revenues of $50.53 billion in 2021. Accenture\'s current clients include 91 of the Fortune Global 100 and more than three-quarters of the Fortune Global 500.\r\n\r\nJulie Sweet has served as CEO of Accenture since 1 September 2019.\r\n\r\nIt has been incorporated in Dublin, Ireland, since 2009.','650000','65','Software Engineer','MCA','2022-05-05 09:16:08'),(3,2,'Quantiphi','Cognizant is an American multinational information technology services and consulting company. It is headquartered in Teaneck, New Jersey, United States. Cognizant is part of the NASDAQ-100 and trades under CTSH. It was founded as an in-house technology unit of Dun & Bradstreet in 1994,[5] and started serving external clients in 1996.[5]\r\n\r\nAfter a series of corporate re-organizations there was an initial public offering in 1998.[6]\r\n\r\nCognizant had a period of fast growth during the 2000s and became a Fortune 500 company in 2011; as of 2021, it is ranked 185.[7]','450000','50','Software Engineer','MCA','2022-05-07 11:57:52');
/*!40000 ALTER TABLE job_post ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table mailbox
--

DROP TABLE IF EXISTS mailbox;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE mailbox (
  id_mailbox int(11) NOT NULL AUTO_INCREMENT,
  id_fromuser int(11) NOT NULL,
  fromuser varchar(255) NOT NULL,
  id_touser int(11) NOT NULL,
  subject varchar(255) NOT NULL,
  message text NOT NULL,
  createdAt timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id_mailbox)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table mailbox
--

LOCK TABLES mailbox WRITE;
/*!40000 ALTER TABLE mailbox DISABLE KEYS */;
/*!40000 ALTER TABLE mailbox ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table notice
--

DROP TABLE IF EXISTS notice;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE notice (
  id int(11) NOT NULL AUTO_INCREMENT,
  subject varchar(250) NOT NULL,
  notice varchar(255) DEFAULT NULL,
  audience varchar(255) DEFAULT NULL,
  date datetime DEFAULT NULL,
  UNIQUE KEY id (id)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table notice
--

LOCK TABLES notice WRITE;
/*!40000 ALTER TABLE notice DISABLE KEYS */;
INSERT INTO notice VALUES (23,'Placement Result for Accenture','Narendra Kumar','All Students','2022-05-10 12:53:43'),(24,'Placement Result for Cognizant','Amit','Co-ordinators','2022-05-10 12:54:06');
/*!40000 ALTER TABLE notice ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table reply_mailbox
--

DROP TABLE IF EXISTS reply_mailbox;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE reply_mailbox (
  id_reply int(11) NOT NULL AUTO_INCREMENT,
  id_mailbox int(11) NOT NULL,
  id_user int(11) NOT NULL,
  usertype varchar(255) NOT NULL,
  message text NOT NULL,
  createdAt timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id_reply)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table reply_mailbox
--

LOCK TABLES reply_mailbox WRITE;
/*!40000 ALTER TABLE reply_mailbox DISABLE KEYS */;
/*!40000 ALTER TABLE reply_mailbox ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table users
--

DROP TABLE IF EXISTS users;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE users (
  id_user int(11) NOT NULL AUTO_INCREMENT,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  address text DEFAULT NULL,
  city varchar(255) DEFAULT NULL,
  state varchar(255) DEFAULT NULL,
  contactno varchar(255) DEFAULT NULL,
  qualification varchar(255) DEFAULT NULL,
  stream varchar(255) DEFAULT NULL,
  passingyear varchar(255) DEFAULT NULL,
  dob varchar(255) DEFAULT NULL,
  age varchar(255) DEFAULT NULL,
  designation varchar(255) DEFAULT NULL,
  resume varchar(255) DEFAULT NULL,
  hash varchar(255) DEFAULT NULL,
  active int(11) NOT NULL DEFAULT 2,
  aboutme text DEFAULT NULL,
  skills text DEFAULT NULL,
  hsc varchar(200) NOT NULL,
  ssc int(11) NOT NULL,
  ug int(11) NOT NULL,
  pg int(11) NOT NULL,
  CTC int(11) NOT NULL,
  PRIMARY KEY (id_user),
  UNIQUE KEY email (email)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table users
--

LOCK TABLES users WRITE;
/*!40000 ALTER TABLE users DISABLE KEYS */;
INSERT INTO users VALUES (1,'Narendra','Kumar','narendra@gmail.com','ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=','32, ANNAPURNA COLONY\r\nKODARIYA','MHOW','Madhya Pradesh','7987487551','MCA','','','','','','627b82a7732d4.','0e52568ac719e70f13c79b8c18020d67',1,'Student','Web Development','80',80,65,65,0);
/*!40000 ALTER TABLE users ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-11 15:20:02