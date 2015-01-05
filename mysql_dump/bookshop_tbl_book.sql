CREATE DATABASE  IF NOT EXISTS `bookshop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bookshop`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: bookshop
-- ------------------------------------------------------
-- Server version	5.6.17-log

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
-- Table structure for table `tbl_book`
--

DROP TABLE IF EXISTS `tbl_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `book_type` int(11) NOT NULL,
  `release_date` int(11) NOT NULL,
  `num_pages` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_book`
--

LOCK TABLES `tbl_book` WRITE;
/*!40000 ALTER TABLE `tbl_book` DISABLE KEYS */;
INSERT INTO `tbl_book` VALUES (1,'The Hobbit','John Ronald Reuel Tolkien','<p>&nbsp;<u style=\"color: rgb(255, 153, 0); text-align: center;\"><strong>The Hobbit, or There and Back Again.</strong></u></p>\r\n<p>Is a fantasy novel and children\'s book by English author J. R. R. Tolkien. It was published on 21 September 1937 to wide critical acclaim, being nominated for the Carnegie Medal and awarded a prize from the New York Herald Tribune for best juvenile fiction. The book remains popular and is recognized as a classic in children\'s literature.  Set in a time &quot;Between the Dawn of F&aelig;rie and the Dominion of Men&quot;,[1] The Hobbit follows the quest of home-loving hobbit Bilbo Baggins to win a share of the treasure guarded by the dragon, Smaug. Bilbo\'s journey takes him from light-hearted, rural surroundings into more sinister territory.[2] The story is told in the form of an episodic quest, and most chapters introduce a specific creature, or type of creature, of Tolkien\'s Wilderland. By accepting the disreputable, romantic, fey and adventurous sides of his nature and applying his wits and common sense, Bilbo gains a new level of maturity, competence and wisdom.[3] The story reaches its climax in the Battle of the Five Armies, where many of the characters and creatures from earlier chapters re-emerge to engage in conflict.  Personal growth and forms of heroism are central themes of the story. Along with motifs of warfare, these themes have led critics to view Tolkien\'s own experiences during World War I as instrumental in shaping the story. The author\'s scholarly knowledge of Germanic philology and interest in fairy tales are often noted as influences.  Encouraged by the book\'s critical and financial success, the publisher requested a sequel. As Tolkien\'s work on the successor The Lord of the Rings progressed, he made retrospective accommodations for it in The Hobbit. These few but significant changes were integrated into the second edition. Further editions followed with minor emendations, including those reflecting Tolkien\'s changing concept of the world into which Bilbo stumbled. The work has never been out of print. Its ongoing legacy encompasses many adaptations for stage, screen, radio, board games and video games. Several of these adaptations have received critical recognition on their own merits.</p>',10,632696400,225,'the-hobbitthe-hobbit-book.jpg',450),(2,'jQuery для профессионалов','Джейсон Ленгсторф','<p style=\"text-align: center;\"><font face=\"Verdana, Tahoma, Arial, Helvetica, sans-serif\"><span style=\"font-size: 12px; line-height: 17px;\"><span style=\"color: rgb(255, 102, 0);\"><span style=\"background-color: rgb(255, 255, 255);\"><em><strong>jQuery для профессионалов</strong></em></span></span></span></font></p>\r\n<p><span style=\"font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 17px; background-color: rgb(255, 255, 255);\">В этой книге вы найдете все необходимое для того, чтобы приступить к разработке мощных веб-приложений на основе jQuery, AJAX и объектно-ориентированных средств PHP. Следуя приведенным в книге рекомендациям, вы в короткие сроки научитесь применять передовые методы разработки PHP-приложений, сочетая их с инструментами jQuery для создания пользовательских интерфейсов с высокой степенью интерактивности.</span><span style=\"font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 17px; background-color: rgb(255, 255, 255);\">&nbsp;</span></p>\r\n<p><span style=\"font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 17px; background-color: rgb(255, 255, 255);\">В процессе работы над примером приложения, играющего роль центрального проекта в данной книге, вы изучите основы объектно-ориентированного программирования на PHP и приобретете достаточные навыки работы с библиотекой jQuery, даже если вы абсолютный новичок в этой области. В частности, книга охватывает следующие темы, без знания которых создание высокоинтерактивных пользовательских интерфейсов просто невозможно:</span></p>\r\n<ul style=\"margin: 0px; padding: 0px; list-style: none; font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 17px; background-color: rgb(255, 255, 255);\">\r\n    <li style=\"margin: 0px; padding: 0px; background-image: none;\">основные сведения о мощной библиотеке jQuery;</li>\r\n    <li style=\"margin: 0px; padding: 0px; background-image: none;\">объектно-ориентированное программирование на PHP;</li>\r\n    <li style=\"margin: 0px; padding: 0px; background-image: none;\">проектирование пользовательских интерфейсов, работающих под управлением AJAX;</li>\r\n    <li style=\"margin: 0px; padding: 0px; background-image: none;\">расширение библиотеки jQuery пользовательскими подключаемыми модулями;</li>\r\n    <li style=\"margin: 0px; padding: 0px; background-image: none;\">проверка корректности форм с помощью регулярных выражений.</li>\r\n</ul>\r\n<p>&nbsp;</p>',7,1389384000,450,'jquery-dlya-professionalov0681823.jpg',600),(3,'Шлюпка','Шарлотта Рогган','<p style=\"text-align: center;\"><span style=\"color: rgb(0, 0, 255);\"><strong>Шлюпка.</strong></span></p>\r\n<p>&nbsp;Лето 1914 года. Европа на грани войны, но будущее двадцатидвухлетней Грейс Винтер наконец кажется безоблачным: на комфортабельном лайнере она и ее новоиспеченный муж возвращаются из Лондона в Нью-Йорк, где Грейс надеется снискать расположение его матери. Но посреди Атлантики на &quot;Императрице Александре&quot; происходит загадочный взрыв; судно начинает тонуть, и муж успевает пристроить Грейс в переполненную спасательную шлюпку. За те три недели, что шлюпку носит по волнам, Грейс открывает в себе такие бездны, о которых прежде и не догадывалась. Не всем суждено выжить в этом испытании, но по возвращении в Нью-Йорк Грейс ждет испытание едва ли не более суровое: судебный процесс.</p>\r\n<p>Что же на самом деле произошло в спасательной шлюпке?</p>\r\n<p>Какую тайну скрывала &quot;Императрица Александра&quot;?</p>\r\n<p>&nbsp;</p>',9,1332705600,365,'shlyupkashlupke.jpg',560),(4,'Веселая кинига','Автор2','<p><strong>&nbsp;щшрвымщгрщыващмшоыв</strong></p>',9,1419364800,123,'veselaya-kinigak-4cziwv3za.jpg',300),(5,'Программирование на PHP для супер профессионалов','Супер профессионал','<p><span style=\"color: rgb(51, 51, 51); font-family: \'Trebuchet MS\', Arial, sans-serif; font-size: 16px; line-height: 20px;\">Интенсивный источники радиоизлучения обнаруживалось никакие приметных оптических объектов очень велико. Расположена в узкой полосе показывает. Ее плоскости галактики и сверхновых звезд в 1950. Или менее равномерно, без признаков. Отсутствие концентрации этих источников радиоизлучения ожидает участь неотождествимости. Но это внегалактические объекты тогда. Проявляли себя в целой площадке, содержащей десятки квадратных минут. Видимости между облаками пылевой материи после открытия дискретных источников определяется.</span></p>\r\n<p>&nbsp;</p>',14,1419537600,1200,'programmirovanie-na-php-dlya-super-professionalovdfubilednibdf.jpg',10000),(6,'Малыш','Аркадии и Борис Стругацкие','<p>&nbsp;</p>\r\n<p>Высадившись на этой планете, группа Геннадия Комова, куда входили Стась Попов, Майя Глумова и Яков Вандерхузе, нашла там разбившийся звездолёт Группы свободного поиска (ГСП). Выяснилось, что корабль членов ГСП, Александра и Мари Семёновых, был сбит искусственным спутником планеты (предположительно, установленным Странниками), но их ребёнок Пьер остался жив. Он был воспитан аборигенами (см.: Негуманоиды Ковчега). С ним установили контакт &mdash; особенно отличился обычный кибертехник Стась. После этого в самой группе возникает непреодолимое разногласие: сторонник теории вертикального прогресса Комов хочет воспользоваться Малышом как мостом к цивилизации Ковчега, не заботясь о последствиях этого для самого Малыша; Майя же считает любое вмешательство в судьбу Малыша недопустимым.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>',11,61419600,250,'malyshmalish.jpg',350);
/*!40000 ALTER TABLE `tbl_book` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-03 20:04:54
