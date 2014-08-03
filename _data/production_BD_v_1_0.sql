CREATE DATABASE  IF NOT EXISTS `iyfevent` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `iyfevent`;
-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: 68.178.216.177    Database: iyfevent
-- ------------------------------------------------------
-- Server version	5.0.96-log

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
-- Not dumping tablespaces as no INFORMATION_SCHEMA.FILES table on this server
--

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id_city` int(11) NOT NULL auto_increment,
  `name` char(35) NOT NULL default '',
  `id_country` char(3) NOT NULL default '',
  `district` char(20) NOT NULL default '',
  `population` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_city`),
  KEY `fk_cities_1_idx` (`id_country`)
) ENGINE=InnoDB AUTO_INCREMENT=3596 DEFAULT CHARSET=utf8 COMMENT='chanfe collatio';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (69,'Buenos Aires','ARG','Distrito Federal',2982146),(70,'La Matanza','ARG','Buenos Aires',1266461),(71,'Córdoba','ARG','Córdoba',1157507),(72,'Rosario','ARG','Santa Fé',907718),(73,'Lomas de Zamora','ARG','Buenos Aires',622013),(74,'Quilmes','ARG','Buenos Aires',559249),(75,'Almirante Brown','ARG','Buenos Aires',538918),(76,'La Plata','ARG','Buenos Aires',521936),(77,'Mar del Plata','ARG','Buenos Aires',512880),(78,'San Miguel de Tucumán','ARG','Tucumán',470809),(79,'Lanús','ARG','Buenos Aires',469735),(80,'Merlo','ARG','Buenos Aires',463846),(81,'General San Martín','ARG','Buenos Aires',422542),(82,'Salta','ARG','Salta',367550),(83,'Moreno','ARG','Buenos Aires',356993),(84,'Santa Fé','ARG','Santa Fé',353063),(85,'Avellaneda','ARG','Buenos Aires',353046),(86,'Tres de Febrero','ARG','Buenos Aires',352311),(87,'Morón','ARG','Buenos Aires',349246),(88,'Florencio Varela','ARG','Buenos Aires',315432),(89,'San Isidro','ARG','Buenos Aires',306341),(90,'Tigre','ARG','Buenos Aires',296226),(91,'Malvinas Argentinas','ARG','Buenos Aires',290335),(92,'Vicente López','ARG','Buenos Aires',288341),(93,'Berazategui','ARG','Buenos Aires',276916),(94,'Corrientes','ARG','Corrientes',258103),(95,'San Miguel','ARG','Buenos Aires',248700),(96,'Bahía Blanca','ARG','Buenos Aires',239810),(97,'Esteban Echeverría','ARG','Buenos Aires',235760),(98,'Resistencia','ARG','Chaco',229212),(99,'José C. Paz','ARG','Buenos Aires',221754),(100,'Paraná','ARG','Entre Rios',207041),(101,'Godoy Cruz','ARG','Mendoza',206998),(102,'Posadas','ARG','Misiones',201273),(103,'Guaymallén','ARG','Mendoza',200595),(104,'Santiago del Estero','ARG','Santiago del Estero',189947),(105,'San Salvador de Jujuy','ARG','Jujuy',178748),(106,'Hurlingham','ARG','Buenos Aires',170028),(107,'Neuquén','ARG','Neuquén',167296),(108,'Ituzaingó','ARG','Buenos Aires',158197),(109,'San Fernando','ARG','Buenos Aires',153036),(110,'Formosa','ARG','Formosa',147636),(111,'Las Heras','ARG','Mendoza',145823),(112,'La Rioja','ARG','La Rioja',138117),(113,'San Fernando del Valle de Cata','ARG','Catamarca',134935),(114,'Río Cuarto','ARG','Córdoba',134355),(115,'Comodoro Rivadavia','ARG','Chubut',124104),(116,'Mendoza','ARG','Mendoza',123027),(117,'San Nicolás de los Arroyos','ARG','Buenos Aires',119302),(118,'San Juan','ARG','San Juan',119152),(119,'Escobar','ARG','Buenos Aires',116675),(120,'Concordia','ARG','Entre Rios',116485),(121,'Pilar','ARG','Buenos Aires',113428),(122,'San Luis','ARG','San Luis',110136),(123,'Ezeiza','ARG','Buenos Aires',99578),(124,'San Rafael','ARG','Mendoza',94651),(125,'Tandil','ARG','Buenos Aires',91101),(193,'Santa Cruz de la Sierra','BOL','Santa Cruz',935361),(194,'La Paz','BOL','La Paz',758141),(195,'El Alto','BOL','La Paz',534466),(196,'Cochabamba','BOL','Cochabamba',482800),(197,'Oruro','BOL','Oruro',223553),(198,'Sucre','BOL','Chuquisaca',178426),(199,'Potosí','BOL','Potosí',140642),(200,'Tarija','BOL','Tarija',125255),(206,'São Paulo','BRA','São Paulo',9968485),(207,'Rio de Janeiro','BRA','Rio de Janeiro',5598953),(208,'Salvador','BRA','Bahia',2302832),(209,'Belo Horizonte','BRA','Minas Gerais',2139125),(210,'Fortaleza','BRA','Ceará',2097757),(211,'Brasília','BRA','Distrito Federal',1969868),(212,'Curitiba','BRA','Paraná',1584232),(213,'Recife','BRA','Pernambuco',1378087),(214,'Porto Alegre','BRA','Rio Grande do Sul',1314032),(215,'Manaus','BRA','Amazonas',1255049),(216,'Belém','BRA','Pará',1186926),(217,'Guarulhos','BRA','São Paulo',1095874),(218,'Goiânia','BRA','Goiás',1056330),(219,'Campinas','BRA','São Paulo',950043),(220,'São Gonçalo','BRA','Rio de Janeiro',869254),(221,'Nova Iguaçu','BRA','Rio de Janeiro',862225),(222,'São Luís','BRA','Maranhão',837588),(223,'Maceió','BRA','Alagoas',786288),(224,'Duque de Caxias','BRA','Rio de Janeiro',746758),(225,'São Bernardo do Campo','BRA','São Paulo',723132),(226,'Teresina','BRA','Piauí',691942),(227,'Natal','BRA','Rio Grande do Norte',688955),(228,'Osasco','BRA','São Paulo',659604),(229,'Campo Grande','BRA','Mato Grosso do Sul',649593),(230,'Santo André','BRA','São Paulo',630073),(231,'João Pessoa','BRA','Paraíba',584029),(232,'Jaboatão dos Guararapes','BRA','Pernambuco',558680),(233,'Contagem','BRA','Minas Gerais',520801),(234,'São José dos Campos','BRA','São Paulo',515553),(235,'Uberlândia','BRA','Minas Gerais',487222),(236,'Feira de Santana','BRA','Bahia',479992),(237,'Ribeirão Preto','BRA','São Paulo',473276),(238,'Sorocaba','BRA','São Paulo',466823),(239,'Niterói','BRA','Rio de Janeiro',459884),(240,'Cuiabá','BRA','Mato Grosso',453813),(241,'Juiz de Fora','BRA','Minas Gerais',450288),(242,'Aracaju','BRA','Sergipe',445555),(243,'São João de Meriti','BRA','Rio de Janeiro',440052),(244,'Londrina','BRA','Paraná',432257),(245,'Joinville','BRA','Santa Catarina',428011),(246,'Belford Roxo','BRA','Rio de Janeiro',425194),(247,'Santos','BRA','São Paulo',408748),(248,'Ananindeua','BRA','Pará',400940),(249,'Campos dos Goytacazes','BRA','Rio de Janeiro',398418),(250,'Mauá','BRA','São Paulo',375055),(251,'Carapicuíba','BRA','São Paulo',357552),(252,'Olinda','BRA','Pernambuco',354732),(253,'Campina Grande','BRA','Paraíba',352497),(254,'São José do Rio Preto','BRA','São Paulo',351944),(255,'Caxias do Sul','BRA','Rio Grande do Sul',349581),(256,'Moji das Cruzes','BRA','São Paulo',339194),(257,'Diadema','BRA','São Paulo',335078),(258,'Aparecida de Goiânia','BRA','Goiás',324662),(259,'Piracicaba','BRA','São Paulo',319104),(260,'Cariacica','BRA','Espírito Santo',319033),(261,'Vila Velha','BRA','Espírito Santo',318758),(262,'Pelotas','BRA','Rio Grande do Sul',315415),(263,'Bauru','BRA','São Paulo',313670),(264,'Porto Velho','BRA','Rondônia',309750),(265,'Serra','BRA','Espírito Santo',302666),(266,'Betim','BRA','Minas Gerais',302108),(267,'Jundíaí','BRA','São Paulo',296127),(268,'Canoas','BRA','Rio Grande do Sul',294125),(269,'Franca','BRA','São Paulo',290139),(270,'São Vicente','BRA','São Paulo',286848),(271,'Maringá','BRA','Paraná',286461),(272,'Montes Claros','BRA','Minas Gerais',286058),(273,'Anápolis','BRA','Goiás',282197),(274,'Florianópolis','BRA','Santa Catarina',281928),(275,'Petrópolis','BRA','Rio de Janeiro',279183),(276,'Itaquaquecetuba','BRA','São Paulo',270874),(277,'Vitória','BRA','Espírito Santo',270626),(278,'Ponta Grossa','BRA','Paraná',268013),(279,'Rio Branco','BRA','Acre',259537),(280,'Foz do Iguaçu','BRA','Paraná',259425),(281,'Macapá','BRA','Amapá',256033),(282,'Ilhéus','BRA','Bahia',254970),(283,'Vitória da Conquista','BRA','Bahia',253587),(284,'Uberaba','BRA','Minas Gerais',249225),(285,'Paulista','BRA','Pernambuco',248473),(286,'Limeira','BRA','São Paulo',245497),(287,'Blumenau','BRA','Santa Catarina',244379),(288,'Caruaru','BRA','Pernambuco',244247),(289,'Santarém','BRA','Pará',241771),(290,'Volta Redonda','BRA','Rio de Janeiro',240315),(291,'Novo Hamburgo','BRA','Rio Grande do Sul',239940),(292,'Caucaia','BRA','Ceará',238738),(293,'Santa Maria','BRA','Rio Grande do Sul',238473),(294,'Cascavel','BRA','Paraná',237510),(295,'Guarujá','BRA','São Paulo',237206),(296,'Ribeirão das Neves','BRA','Minas Gerais',232685),(297,'Governador Valadares','BRA','Minas Gerais',231724),(298,'Taubaté','BRA','São Paulo',229130),(299,'Imperatriz','BRA','Maranhão',224564),(300,'Gravataí','BRA','Rio Grande do Sul',223011),(301,'Embu','BRA','São Paulo',222223),(302,'Mossoró','BRA','Rio Grande do Norte',214901),(303,'Várzea Grande','BRA','Mato Grosso',214435),(304,'Petrolina','BRA','Pernambuco',210540),(305,'Barueri','BRA','São Paulo',208426),(306,'Viamão','BRA','Rio Grande do Sul',207557),(307,'Ipatinga','BRA','Minas Gerais',206338),(308,'Juazeiro','BRA','Bahia',201073),(309,'Juazeiro do Norte','BRA','Ceará',199636),(310,'Taboão da Serra','BRA','São Paulo',197550),(311,'São José dos Pinhais','BRA','Paraná',196884),(312,'Magé','BRA','Rio de Janeiro',196147),(313,'Suzano','BRA','São Paulo',195434),(314,'São Leopoldo','BRA','Rio Grande do Sul',189258),(315,'Marília','BRA','São Paulo',188691),(316,'São Carlos','BRA','São Paulo',187122),(317,'Sumaré','BRA','São Paulo',186205),(318,'Presidente Prudente','BRA','São Paulo',185340),(319,'Divinópolis','BRA','Minas Gerais',185047),(320,'Sete Lagoas','BRA','Minas Gerais',182984),(321,'Rio Grande','BRA','Rio Grande do Sul',182222),(322,'Itabuna','BRA','Bahia',182148),(323,'Jequié','BRA','Bahia',179128),(324,'Arapiraca','BRA','Alagoas',178988),(325,'Colombo','BRA','Paraná',177764),(326,'Americana','BRA','São Paulo',177409),(327,'Alvorada','BRA','Rio Grande do Sul',175574),(328,'Araraquara','BRA','São Paulo',174381),(329,'Itaboraí','BRA','Rio de Janeiro',173977),(330,'Santa Bárbara d´Oeste','BRA','São Paulo',171657),(331,'Nova Friburgo','BRA','Rio de Janeiro',170697),(332,'Jacareí','BRA','São Paulo',170356),(333,'Araçatuba','BRA','São Paulo',169303),(334,'Barra Mansa','BRA','Rio de Janeiro',168953),(335,'Praia Grande','BRA','São Paulo',168434),(336,'Marabá','BRA','Pará',167795),(337,'Criciúma','BRA','Santa Catarina',167661),(338,'Boa Vista','BRA','Roraima',167185),(339,'Passo Fundo','BRA','Rio Grande do Sul',166343),(340,'Dourados','BRA','Mato Grosso do Sul',164716),(341,'Santa Luzia','BRA','Minas Gerais',164704),(342,'Rio Claro','BRA','São Paulo',163551),(343,'Maracanaú','BRA','Ceará',162022),(344,'Guarapuava','BRA','Paraná',160510),(345,'Rondonópolis','BRA','Mato Grosso',155115),(346,'São José','BRA','Santa Catarina',155105),(347,'Cachoeiro de Itapemirim','BRA','Espírito Santo',155024),(348,'Nilópolis','BRA','Rio de Janeiro',153383),(349,'Itapevi','BRA','São Paulo',150664),(350,'Cabo de Santo Agostinho','BRA','Pernambuco',149964),(351,'Camaçari','BRA','Bahia',149146),(352,'Sobral','BRA','Ceará',146005),(353,'Itajaí','BRA','Santa Catarina',145197),(354,'Chapecó','BRA','Santa Catarina',144158),(355,'Cotia','BRA','São Paulo',140042),(356,'Lages','BRA','Santa Catarina',139570),(357,'Ferraz de Vasconcelos','BRA','São Paulo',139283),(358,'Indaiatuba','BRA','São Paulo',135968),(359,'Hortolândia','BRA','São Paulo',135755),(360,'Caxias','BRA','Maranhão',133980),(361,'São Caetano do Sul','BRA','São Paulo',133321),(362,'Itu','BRA','São Paulo',132736),(363,'Nossa Senhora do Socorro','BRA','Sergipe',131351),(364,'Parnaíba','BRA','Piauí',129756),(365,'Poços de Caldas','BRA','Minas Gerais',129683),(366,'Teresópolis','BRA','Rio de Janeiro',128079),(367,'Barreiras','BRA','Bahia',127801),(368,'Castanhal','BRA','Pará',127634),(369,'Alagoinhas','BRA','Bahia',126820),(370,'Itapecerica da Serra','BRA','São Paulo',126672),(371,'Uruguaiana','BRA','Rio Grande do Sul',126305),(372,'Paranaguá','BRA','Paraná',126076),(373,'Ibirité','BRA','Minas Gerais',125982),(374,'Timon','BRA','Maranhão',125812),(375,'Luziânia','BRA','Goiás',125597),(376,'Macaé','BRA','Rio de Janeiro',125597),(377,'Teófilo Otoni','BRA','Minas Gerais',124489),(378,'Moji-Guaçu','BRA','São Paulo',123782),(379,'Palmas','BRA','Tocantins',121919),(380,'Pindamonhangaba','BRA','São Paulo',121904),(381,'Francisco Morato','BRA','São Paulo',121197),(382,'Bagé','BRA','Rio Grande do Sul',120793),(383,'Sapucaia do Sul','BRA','Rio Grande do Sul',120217),(384,'Cabo Frio','BRA','Rio de Janeiro',119503),(385,'Itapetininga','BRA','São Paulo',119391),(386,'Patos de Minas','BRA','Minas Gerais',119262),(387,'Camaragibe','BRA','Pernambuco',118968),(388,'Bragança Paulista','BRA','São Paulo',116929),(389,'Queimados','BRA','Rio de Janeiro',115020),(390,'Araguaína','BRA','Tocantins',114948),(391,'Garanhuns','BRA','Pernambuco',114603),(392,'Vitória de Santo Antão','BRA','Pernambuco',113595),(393,'Santa Rita','BRA','Paraíba',113135),(394,'Barbacena','BRA','Minas Gerais',113079),(395,'Abaetetuba','BRA','Pará',111258),(396,'Jaú','BRA','São Paulo',109965),(397,'Lauro de Freitas','BRA','Bahia',109236),(398,'Franco da Rocha','BRA','São Paulo',108964),(399,'Teixeira de Freitas','BRA','Bahia',108441),(400,'Varginha','BRA','Minas Gerais',108314),(401,'Ribeirão Pires','BRA','São Paulo',108121),(402,'Sabará','BRA','Minas Gerais',107781),(403,'Catanduva','BRA','São Paulo',107761),(404,'Rio Verde','BRA','Goiás',107755),(405,'Botucatu','BRA','São Paulo',107663),(406,'Colatina','BRA','Espírito Santo',107354),(407,'Santa Cruz do Sul','BRA','Rio Grande do Sul',106734),(408,'Linhares','BRA','Espírito Santo',106278),(409,'Apucarana','BRA','Paraná',105114),(410,'Barretos','BRA','São Paulo',104156),(411,'Guaratinguetá','BRA','São Paulo',103433),(412,'Cachoeirinha','BRA','Rio Grande do Sul',103240),(413,'Codó','BRA','Maranhão',103153),(414,'Jaraguá do Sul','BRA','Santa Catarina',102580),(415,'Cubatão','BRA','São Paulo',102372),(416,'Itabira','BRA','Minas Gerais',102217),(417,'Itaituba','BRA','Pará',101320),(418,'Araras','BRA','São Paulo',101046),(419,'Resende','BRA','Rio de Janeiro',100627),(420,'Atibaia','BRA','São Paulo',100356),(421,'Pouso Alegre','BRA','Minas Gerais',100028),(422,'Toledo','BRA','Paraná',99387),(423,'Crato','BRA','Ceará',98965),(424,'Passos','BRA','Minas Gerais',98570),(425,'Araguari','BRA','Minas Gerais',98399),(426,'São José de Ribamar','BRA','Maranhão',98318),(427,'Pinhais','BRA','Paraná',98198),(428,'Sertãozinho','BRA','São Paulo',98140),(429,'Conselheiro Lafaiete','BRA','Minas Gerais',97507),(430,'Paulo Afonso','BRA','Bahia',97291),(431,'Angra dos Reis','BRA','Rio de Janeiro',96864),(432,'Eunápolis','BRA','Bahia',96610),(433,'Salto','BRA','São Paulo',96348),(434,'Ourinhos','BRA','São Paulo',96291),(435,'Parnamirim','BRA','Rio Grande do Norte',96210),(436,'Jacobina','BRA','Bahia',96131),(437,'Coronel Fabriciano','BRA','Minas Gerais',95933),(438,'Birigui','BRA','São Paulo',94685),(439,'Tatuí','BRA','São Paulo',93897),(440,'Ji-Paraná','BRA','Rondônia',93346),(441,'Bacabal','BRA','Maranhão',93121),(442,'Cametá','BRA','Pará',92779),(443,'Guaíba','BRA','Rio Grande do Sul',92224),(444,'São Lourenço da Mata','BRA','Pernambuco',91999),(445,'Santana do Livramento','BRA','Rio Grande do Sul',91779),(446,'Votorantim','BRA','São Paulo',91777),(447,'Campo Largo','BRA','Paraná',91203),(448,'Patos','BRA','Paraíba',90519),(449,'Ituiutaba','BRA','Minas Gerais',90507),(450,'Corumbá','BRA','Mato Grosso do Sul',90111),(451,'Palhoça','BRA','Santa Catarina',89465),(452,'Barra do Piraí','BRA','Rio de Janeiro',89388),(453,'Bento Gonçalves','BRA','Rio Grande do Sul',89254),(454,'Poá','BRA','São Paulo',89236),(455,'Águas Lindas de Goiás','BRA','Goiás',89200),(554,'Santiago de Chile','CHL','Santiago',4703954),(555,'Puente Alto','CHL','Santiago',386236),(556,'Viña del Mar','CHL','Valparaíso',312493),(557,'Valparaíso','CHL','Valparaíso',293800),(558,'Talcahuano','CHL','Bíobío',277752),(559,'Antofagasta','CHL','Antofagasta',251429),(560,'San Bernardo','CHL','Santiago',241910),(561,'Temuco','CHL','La Araucanía',233041),(562,'Concepción','CHL','Bíobío',217664),(563,'Rancagua','CHL','O´Higgins',212977),(564,'Arica','CHL','Tarapacá',189036),(565,'Talca','CHL','Maule',187557),(566,'Chillán','CHL','Bíobío',178182),(567,'Iquique','CHL','Tarapacá',177892),(568,'Los Angeles','CHL','Bíobío',158215),(569,'Puerto Montt','CHL','Los Lagos',152194),(570,'Coquimbo','CHL','Coquimbo',143353),(571,'Osorno','CHL','Los Lagos',141468),(572,'La Serena','CHL','Coquimbo',137409),(573,'Calama','CHL','Antofagasta',137265),(574,'Valdivia','CHL','Los Lagos',133106),(575,'Punta Arenas','CHL','Magallanes',125631),(576,'Copiapó','CHL','Atacama',120128),(577,'Quilpué','CHL','Valparaíso',118857),(578,'Curicó','CHL','Maule',115766),(579,'Ovalle','CHL','Coquimbo',94854),(580,'Coronel','CHL','Bíobío',93061),(581,'San Pedro de la Paz','CHL','Bíobío',91684),(582,'Melipilla','CHL','Santiago',91056),(584,'San José','CRI','San José',339131),(587,'Santo Domingo de Guzmán','DOM','Distrito Nacional',1609966),(588,'Santiago de los Caballeros','DOM','Santiago',365463),(589,'La Romana','DOM','La Romana',140204),(590,'San Pedro de Macorís','DOM','San Pedro de Macorís',124735),(591,'San Francisco de Macorís','DOM','Duarte',108485),(592,'San Felipe de Puerto Plata','DOM','Puerto Plata',89423),(593,'Guayaquil','ECU','Guayas',2070040),(594,'Quito','ECU','Pichincha',1573458),(595,'Cuenca','ECU','Azuay',270353),(596,'Machala','ECU','El Oro',210368),(597,'Santo Domingo de los Colorados','ECU','Pichincha',202111),(598,'Portoviejo','ECU','Manabí',176413),(599,'Ambato','ECU','Tungurahua',169612),(600,'Manta','ECU','Manabí',164739),(601,'Duran [Eloy Alfaro]','ECU','Guayas',152514),(602,'Ibarra','ECU','Imbabura',130643),(603,'Quevedo','ECU','Los Ríos',129631),(604,'Milagro','ECU','Guayas',124177),(605,'Loja','ECU','Loja',123875),(606,'Ríobamba','ECU','Chimborazo',123163),(607,'Esmeraldas','ECU','Esmeraldas',123045),(929,'Port-au-Prince','HTI','Ouest',884472),(930,'Carrefour','HTI','Ouest',290204),(931,'Delmas','HTI','Ouest',240429),(932,'Le-Cap-Haïtien','HTI','Nord',102233),(1529,'Spanish Town','JAM','St. Catherine',110379),(1530,'Kingston','JAM','St. Andrew',103962),(1531,'Portmore','JAM','St. Andrew',99799),(2257,'Santafé de Bogotá','COL','Santafé de Bogotá',6260862),(2258,'Cali','COL','Valle',2077386),(2259,'Medellín','COL','Antioquia',1861265),(2260,'Barranquilla','COL','Atlántico',1223260),(2261,'Cartagena','COL','Bolívar',805757),(2262,'Cúcuta','COL','Norte de Santander',606932),(2263,'Bucaramanga','COL','Santander',515555),(2264,'Ibagué','COL','Tolima',393664),(2265,'Pereira','COL','Risaralda',381725),(2266,'Santa Marta','COL','Magdalena',359147),(2267,'Manizales','COL','Caldas',337580),(2268,'Bello','COL','Antioquia',333470),(2269,'Pasto','COL','Nariño',332396),(2270,'Neiva','COL','Huila',300052),(2271,'Soledad','COL','Atlántico',295058),(2272,'Armenia','COL','Quindío',288977),(2273,'Villavicencio','COL','Meta',273140),(2274,'Soacha','COL','Cundinamarca',272058),(2275,'Valledupar','COL','Cesar',263247),(2276,'Montería','COL','Córdoba',248245),(2277,'Itagüí','COL','Antioquia',228985),(2278,'Palmira','COL','Valle',226509),(2279,'Buenaventura','COL','Valle',224336),(2280,'Floridablanca','COL','Santander',221913),(2281,'Sincelejo','COL','Sucre',220704),(2282,'Popayán','COL','Cauca',200719),(2283,'Barrancabermeja','COL','Santander',178020),(2284,'Dos Quebradas','COL','Risaralda',159363),(2285,'Tuluá','COL','Valle',152488),(2286,'Envigado','COL','Antioquia',135848),(2287,'Cartago','COL','Valle',125884),(2288,'Girardot','COL','Cundinamarca',110963),(2289,'Buga','COL','Valle',110699),(2290,'Tunja','COL','Boyacá',109740),(2291,'Florencia','COL','Caquetá',108574),(2292,'Maicao','COL','La Guajira',108053),(2293,'Sogamoso','COL','Boyacá',107728),(2294,'Giron','COL','Santander',90688),(2515,'Ciudad de México','MEX','Distrito Federal',8591309),(2516,'Guadalajara','MEX','Jalisco',1647720),(2517,'Ecatepec de Morelos','MEX','Estado de México',1620303),(2518,'Puebla','MEX','Puebla',1346176),(2519,'Nezahualcóyotl','MEX','Estado de México',1224924),(2520,'Juárez','MEX','Chihuahua',1217818),(2521,'Tijuana','MEX','Baja California',1212232),(2522,'León','MEX','Guanajuato',1133576),(2523,'Monterrey','MEX','Nuevo León',1108499),(2524,'Zapopan','MEX','Jalisco',1002239),(2525,'Naucalpan de Juárez','MEX','Estado de México',857511),(2526,'Mexicali','MEX','Baja California',764902),(2527,'Culiacán','MEX','Sinaloa',744859),(2528,'Acapulco de Juárez','MEX','Guerrero',721011),(2529,'Tlalnepantla de Baz','MEX','Estado de México',720755),(2530,'Mérida','MEX','Yucatán',703324),(2531,'Chihuahua','MEX','Chihuahua',670208),(2532,'San Luis Potosí','MEX','San Luis Potosí',669353),(2533,'Guadalupe','MEX','Nuevo León',668780),(2534,'Toluca','MEX','Estado de México',665617),(2535,'Aguascalientes','MEX','Aguascalientes',643360),(2536,'Querétaro','MEX','Querétaro de Arteaga',639839),(2537,'Morelia','MEX','Michoacán de Ocampo',619958),(2538,'Hermosillo','MEX','Sonora',608697),(2539,'Saltillo','MEX','Coahuila de Zaragoza',577352),(2540,'Torreón','MEX','Coahuila de Zaragoza',529093),(2541,'Centro (Villahermosa)','MEX','Tabasco',519873),(2542,'San Nicolás de los Garza','MEX','Nuevo León',495540),(2543,'Durango','MEX','Durango',490524),(2544,'Chimalhuacán','MEX','Estado de México',490245),(2545,'Tlaquepaque','MEX','Jalisco',475472),(2546,'Atizapán de Zaragoza','MEX','Estado de México',467262),(2547,'Veracruz','MEX','Veracruz',457119),(2548,'Cuautitlán Izcalli','MEX','Estado de México',452976),(2549,'Irapuato','MEX','Guanajuato',440039),(2550,'Tuxtla Gutiérrez','MEX','Chiapas',433544),(2551,'Tultitlán','MEX','Estado de México',432411),(2552,'Reynosa','MEX','Tamaulipas',419776),(2553,'Benito Juárez','MEX','Quintana Roo',419276),(2554,'Matamoros','MEX','Tamaulipas',416428),(2555,'Xalapa','MEX','Veracruz',390058),(2556,'Celaya','MEX','Guanajuato',382140),(2557,'Mazatlán','MEX','Sinaloa',380265),(2558,'Ensenada','MEX','Baja California',369573),(2559,'Ahome','MEX','Sinaloa',358663),(2560,'Cajeme','MEX','Sonora',355679),(2561,'Cuernavaca','MEX','Morelos',337966),(2562,'Tonalá','MEX','Jalisco',336109),(2563,'Valle de Chalco Solidaridad','MEX','Estado de México',323113),(2564,'Nuevo Laredo','MEX','Tamaulipas',310277),(2565,'Tepic','MEX','Nayarit',305025),(2566,'Tampico','MEX','Tamaulipas',294789),(2567,'Ixtapaluca','MEX','Estado de México',293160),(2568,'Apodaca','MEX','Nuevo León',282941),(2569,'Guasave','MEX','Sinaloa',277201),(2570,'Gómez Palacio','MEX','Durango',272806),(2571,'Tapachula','MEX','Chiapas',271141),(2572,'Nicolás Romero','MEX','Estado de México',269393),(2573,'Coatzacoalcos','MEX','Veracruz',267037),(2574,'Uruapan','MEX','Michoacán de Ocampo',265211),(2575,'Victoria','MEX','Tamaulipas',262686),(2576,'Oaxaca de Juárez','MEX','Oaxaca',256848),(2577,'Coacalco de Berriozábal','MEX','Estado de México',252270),(2578,'Pachuca de Soto','MEX','Hidalgo',244688),(2579,'General Escobedo','MEX','Nuevo León',232961),(2580,'Salamanca','MEX','Guanajuato',226864),(2581,'Santa Catarina','MEX','Nuevo León',226573),(2582,'Tehuacán','MEX','Puebla',225943),(2583,'Chalco','MEX','Estado de México',222201),(2584,'Cárdenas','MEX','Tabasco',216903),(2585,'Campeche','MEX','Campeche',216735),(2586,'La Paz','MEX','Estado de México',213045),(2587,'Othón P. Blanco (Chetumal)','MEX','Quintana Roo',208014),(2588,'Texcoco','MEX','Estado de México',203681),(2589,'La Paz','MEX','Baja California Sur',196708),(2590,'Metepec','MEX','Estado de México',194265),(2591,'Monclova','MEX','Coahuila de Zaragoza',193657),(2592,'Huixquilucan','MEX','Estado de México',193156),(2593,'Chilpancingo de los Bravo','MEX','Guerrero',192509),(2594,'Puerto Vallarta','MEX','Jalisco',183741),(2595,'Fresnillo','MEX','Zacatecas',182744),(2596,'Ciudad Madero','MEX','Tamaulipas',182012),(2597,'Soledad de Graciano Sánchez','MEX','San Luis Potosí',179956),(2598,'San Juan del Río','MEX','Querétaro',179300),(2599,'San Felipe del Progreso','MEX','Estado de México',177330),(2600,'Córdoba','MEX','Veracruz',176952),(2601,'Tecámac','MEX','Estado de México',172410),(2602,'Ocosingo','MEX','Chiapas',171495),(2603,'Carmen','MEX','Campeche',171367),(2604,'Lázaro Cárdenas','MEX','Michoacán de Ocampo',170878),(2605,'Jiutepec','MEX','Morelos',170428),(2606,'Papantla','MEX','Veracruz',170123),(2607,'Comalcalco','MEX','Tabasco',164640),(2608,'Zamora','MEX','Michoacán de Ocampo',161191),(2609,'Nogales','MEX','Sonora',159103),(2610,'Huimanguillo','MEX','Tabasco',158335),(2611,'Cuautla','MEX','Morelos',153132),(2612,'Minatitlán','MEX','Veracruz',152983),(2613,'Poza Rica de Hidalgo','MEX','Veracruz',152678),(2614,'Ciudad Valles','MEX','San Luis Potosí',146411),(2615,'Navolato','MEX','Sinaloa',145396),(2616,'San Luis Río Colorado','MEX','Sonora',145276),(2617,'Pénjamo','MEX','Guanajuato',143927),(2618,'San Andrés Tuxtla','MEX','Veracruz',142251),(2619,'Guanajuato','MEX','Guanajuato',141215),(2620,'Navojoa','MEX','Sonora',140495),(2621,'Zitácuaro','MEX','Michoacán de Ocampo',137970),(2622,'Boca del Río','MEX','Veracruz-Llave',135721),(2623,'Allende','MEX','Guanajuato',134645),(2624,'Silao','MEX','Guanajuato',134037),(2625,'Macuspana','MEX','Tabasco',133795),(2626,'San Juan Bautista Tuxtepec','MEX','Oaxaca',133675),(2627,'San Cristóbal de las Casas','MEX','Chiapas',132317),(2628,'Valle de Santiago','MEX','Guanajuato',130557),(2629,'Guaymas','MEX','Sonora',130108),(2630,'Colima','MEX','Colima',129454),(2631,'Dolores Hidalgo','MEX','Guanajuato',128675),(2632,'Lagos de Moreno','MEX','Jalisco',127949),(2633,'Piedras Negras','MEX','Coahuila de Zaragoza',127898),(2634,'Altamira','MEX','Tamaulipas',127490),(2635,'Túxpam','MEX','Veracruz',126475),(2636,'San Pedro Garza García','MEX','Nuevo León',126147),(2637,'Cuauhtémoc','MEX','Chihuahua',124279),(2638,'Manzanillo','MEX','Colima',124014),(2639,'Iguala de la Independencia','MEX','Guerrero',123883),(2640,'Zacatecas','MEX','Zacatecas',123700),(2641,'Tlajomulco de Zúñiga','MEX','Jalisco',123220),(2642,'Tulancingo de Bravo','MEX','Hidalgo',121946),(2643,'Zinacantepec','MEX','Estado de México',121715),(2644,'San Martín Texmelucan','MEX','Puebla',121093),(2645,'Tepatitlán de Morelos','MEX','Jalisco',118948),(2646,'Martínez de la Torre','MEX','Veracruz',118815),(2647,'Orizaba','MEX','Veracruz',118488),(2648,'Apatzingán','MEX','Michoacán de Ocampo',117849),(2649,'Atlixco','MEX','Puebla',117019),(2650,'Delicias','MEX','Chihuahua',116132),(2651,'Ixtlahuaca','MEX','Estado de México',115548),(2652,'El Mante','MEX','Tamaulipas',112453),(2653,'Lerdo','MEX','Durango',112272),(2654,'Almoloya de Juárez','MEX','Estado de México',110550),(2655,'Acámbaro','MEX','Guanajuato',110487),(2656,'Acuña','MEX','Coahuila de Zaragoza',110388),(2657,'Guadalupe','MEX','Zacatecas',108881),(2658,'Huejutla de Reyes','MEX','Hidalgo',108017),(2659,'Hidalgo','MEX','Michoacán de Ocampo',106198),(2660,'Los Cabos','MEX','Baja California Sur',105199),(2661,'Comitán de Domínguez','MEX','Chiapas',104986),(2662,'Cunduacán','MEX','Tabasco',104164),(2663,'Río Bravo','MEX','Tamaulipas',103901),(2664,'Temapache','MEX','Veracruz',102824),(2665,'Chilapa de Alvarez','MEX','Guerrero',102716),(2666,'Hidalgo del Parral','MEX','Chihuahua',100881),(2667,'San Francisco del Rincón','MEX','Guanajuato',100149),(2668,'Taxco de Alarcón','MEX','Guerrero',99907),(2669,'Zumpango','MEX','Estado de México',99781),(2670,'San Pedro Cholula','MEX','Puebla',99734),(2671,'Lerma','MEX','Estado de México',99714),(2672,'Tecomán','MEX','Colima',99296),(2673,'Las Margaritas','MEX','Chiapas',97389),(2674,'Cosoleacaque','MEX','Veracruz',97199),(2675,'San Luis de la Paz','MEX','Guanajuato',96763),(2676,'José Azueta','MEX','Guerrero',95448),(2677,'Santiago Ixcuintla','MEX','Nayarit',95311),(2678,'San Felipe','MEX','Guanajuato',95305),(2679,'Tejupilco','MEX','Estado de México',94934),(2680,'Tantoyuca','MEX','Veracruz',94709),(2681,'Salvatierra','MEX','Guanajuato',94322),(2682,'Tultepec','MEX','Estado de México',93364),(2683,'Temixco','MEX','Morelos',92686),(2684,'Matamoros','MEX','Coahuila de Zaragoza',91858),(2685,'Pánuco','MEX','Veracruz',90551),(2686,'El Fuerte','MEX','Sinaloa',89556),(2687,'Tierra Blanca','MEX','Veracruz',89143),(2882,'Ciudad de Panamá','PAN','Panamá',471373),(2883,'San Miguelito','PAN','San Miguelito',315382),(2885,'Asunción','PRY','Asunción',557776),(2886,'Ciudad del Este','PRY','Alto Paraná',133881),(2887,'San Lorenzo','PRY','Central',133395),(2888,'Lambaré','PRY','Central',99681),(2889,'Fernando de la Mora','PRY','Central',95287),(2890,'Lima','PER','Lima',6464693),(2891,'Arequipa','PER','Arequipa',762000),(2892,'Trujillo','PER','La Libertad',652000),(2893,'Chiclayo','PER','Lambayeque',517000),(2894,'Callao','PER','Callao',424294),(2895,'Iquitos','PER','Loreto',367000),(2896,'Chimbote','PER','Ancash',336000),(2897,'Huancayo','PER','Junín',327000),(2898,'Piura','PER','Piura',325000),(2899,'Cusco','PER','Cusco',291000),(2900,'Pucallpa','PER','Ucayali',220866),(2901,'Tacna','PER','Tacna',215683),(2902,'Ica','PER','Ica',194820),(2903,'Sullana','PER','Piura',147361),(2904,'Juliaca','PER','Puno',142576),(2905,'Huánuco','PER','Huanuco',129688),(2906,'Ayacucho','PER','Ayacucho',118960),(2907,'Chincha Alta','PER','Ica',110016),(2908,'Cajamarca','PER','Cajamarca',108009),(2909,'Puno','PER','Puno',101578),(2910,'Ventanilla','PER','Callao',101056),(2911,'Castilla','PER','Piura',90642),(3539,'Caracas','VEN','Distrito Federal',1975294),(3540,'Maracaíbo','VEN','Zulia',1304776),(3541,'Barquisimeto','VEN','Lara',877239),(3542,'Valencia','VEN','Carabobo',794246),(3543,'Ciudad Guayana','VEN','Bolívar',663713),(3544,'Petare','VEN','Miranda',488868),(3545,'Maracay','VEN','Aragua',444443),(3546,'Barcelona','VEN','Anzoátegui',322267),(3547,'Maturín','VEN','Monagas',319726),(3548,'San Cristóbal','VEN','Táchira',319373),(3549,'Ciudad Bolívar','VEN','Bolívar',301107),(3550,'Cumaná','VEN','Sucre',293105),(3551,'Mérida','VEN','Mérida',224887),(3552,'Cabimas','VEN','Zulia',221329),(3553,'Barinas','VEN','Barinas',217831),(3554,'Turmero','VEN','Aragua',217499),(3555,'Baruta','VEN','Miranda',207290),(3556,'Puerto Cabello','VEN','Carabobo',187722),(3557,'Santa Ana de Coro','VEN','Falcón',185766),(3558,'Los Teques','VEN','Miranda',178784),(3559,'Punto Fijo','VEN','Falcón',167215),(3560,'Guarenas','VEN','Miranda',165889),(3561,'Acarigua','VEN','Portuguesa',158954),(3562,'Puerto La Cruz','VEN','Anzoátegui',155700),(3563,'Ciudad Losada','VEN','',134501),(3564,'Guacara','VEN','Carabobo',131334),(3565,'Valera','VEN','Trujillo',130281),(3566,'Guanare','VEN','Portuguesa',125621),(3567,'Carúpano','VEN','Sucre',119639),(3568,'Catia La Mar','VEN','Distrito Federal',117012),(3569,'El Tigre','VEN','Anzoátegui',116256),(3570,'Guatire','VEN','Miranda',109121),(3571,'Calabozo','VEN','Guárico',107146),(3572,'Pozuelos','VEN','Anzoátegui',105690),(3573,'Ciudad Ojeda','VEN','Zulia',99354),(3574,'Ocumare del Tuy','VEN','Miranda',97168),(3575,'Valle de la Pascua','VEN','Guárico',95927),(3576,'Araure','VEN','Portuguesa',94269),(3577,'San Fernando de Apure','VEN','Apure',93809),(3578,'San Felipe','VEN','Yaracuy',90940),(3579,'El Limón','VEN','Aragua',90000),(3580,'Alvaro Obregón','MEX','Distrito Federal',0),(3581,'Azcapotzalco','MEX','Distrito Federal',0),(3582,'Benito Juárez','MEX','Distrito Federal',0),(3583,'Coyoacán','MEX','Distrito Federal',0),(3584,'Cuajimalpa de Morelos','MEX','Distrito Federal',0),(3585,'Cuauhtémoc','MEX','Distrito Federal',0),(3586,'Gustavo A. Madero','MEX','Distrito Federal',0),(3587,'Iztacalco','MEX','Distrito Federal',0),(3588,'Iztapalapa','MEX','Distrito Federal',0),(3589,'Magdalena Contreras','MEX','Distrito Federal',0),(3590,'Miguel Hidalgo','MEX','Distrito Federal',0),(3591,'Milpa Alta','MEX','Distrito Federal',0),(3592,'Tláhuac','MEX','Distrito Federal',0),(3593,'Tlalpan','MEX','Distrito Federal',0),(3594,'Venustiano Carranza','MEX','Distrito Federal',0),(3595,'Xochimilco','MEX','Distrito Federal',0);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_type`
--

DROP TABLE IF EXISTS `contact_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_type` (
  `id_contact_type` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `description` varchar(45) default NULL,
  PRIMARY KEY  (`id_contact_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_type`
--

LOCK TABLES `contact_type` WRITE;
/*!40000 ALTER TABLE `contact_type` DISABLE KEYS */;
INSERT INTO `contact_type` VALUES (1,'Teléfono casa',NULL),(2,'Celular',NULL),(3,'Usuario Skype',NULL),(4,'Usuairo Facebook',NULL),(5,'Usuario Twitter',NULL);
/*!40000 ALTER TABLE `contact_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_user`
--

DROP TABLE IF EXISTS `contact_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_user` (
  `id_contact` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY  (`id_contact`,`id_user`),
  KEY `fk_contact_user_2_idx` (`id_user`),
  CONSTRAINT `fk_contact_user_1` FOREIGN KEY (`id_contact`) REFERENCES `contacts` (`id_contact`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_contact_user_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_user`
--

LOCK TABLES `contact_user` WRITE;
/*!40000 ALTER TABLE `contact_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id_contact` int(11) NOT NULL auto_increment,
  `type` int(11) NOT NULL,
  `value` varchar(75) default NULL,
  PRIMARY KEY  (`id_contact`),
  KEY `fk_contacts_1_idx` (`type`),
  CONSTRAINT `fk_contacts_1` FOREIGN KEY (`type`) REFERENCES `contact_type` (`id_contact_type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id_country` char(3) NOT NULL default '',
  `name` char(52) NOT NULL default '',
  `capital` int(11) default NULL,
  `code2` char(2) NOT NULL default '',
  PRIMARY KEY  (`id_country`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES ('ARG','Argentina',69,'AR'),('BOL','Bolivia',194,'BO'),('BRA','Brazil',211,'BR'),('CHL','Chile',554,'CL'),('COL','Colombia',2257,'CO'),('CRI','Costa Rica',584,'CR'),('DOM','Dominican Republic',587,'DO'),('ECU','Ecuador',594,'EC'),('HTI','Haiti',929,'HT'),('JAM','Jamaica',1530,'JM'),('MEX','Mexico',2515,'MX'),('PAN','Panama',2882,'PA'),('PER','Peru',2890,'PE'),('PRY','Paraguay',2885,'PY'),('VEN','Venezuela',3539,'VE');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id_group` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `description` varchar(200) default NULL,
  `group_master` int(11) default NULL,
  PRIMARY KEY  (`id_group`),
  KEY `fk_groups_1_idx` (`group_master`),
  CONSTRAINT `fk_groups_1` FOREIGN KEY (`group_master`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'default','A default group for users which doesn\'t fit the other groups predefined',NULL);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `headquarters`
--

DROP TABLE IF EXISTS `headquarters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headquarters` (
  `id_headquarter` int(11) NOT NULL auto_increment,
  `name` varchar(150) default NULL,
  `description` varchar(200) default NULL,
  `location` varchar(200) default NULL,
  PRIMARY KEY  (`id_headquarter`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `headquarters`
--

LOCK TABLES `headquarters` WRITE;
/*!40000 ALTER TABLE `headquarters` DISABLE KEYS */;
INSERT INTO `headquarters` VALUES (1,'IYF Cd. De Mexico',NULL,NULL),(2,'IYF Acayuca',NULL,NULL),(3,'IYF Atizapan de Zaragoza',NULL,NULL),(4,'IYF Coatzacoalcos',NULL,NULL),(5,'IYF Cuautitlan Izcalli',NULL,NULL),(6,'IYF Guadalajara',NULL,NULL),(7,'IYF Monterrey',NULL,NULL),(8,'IYF Puebla',NULL,NULL),(9,'IYF Queretaro',NULL,NULL),(10,'IYF Tijuana',NULL,NULL),(11,'IYF Toluca',NULL,NULL),(12,'IYF Veracruz',NULL,NULL);
/*!40000 ALTER TABLE `headquarters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modalities`
--

DROP TABLE IF EXISTS `modalities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modalities` (
  `id_modality` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `description` varchar(200) default NULL,
  `admin_required` varchar(1) default '1',
  PRIMARY KEY  (`id_modality`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modalities`
--

LOCK TABLES `modalities` WRITE;
/*!40000 ALTER TABLE `modalities` DISABLE KEYS */;
INSERT INTO `modalities` VALUES (1,'Nuevo A (Primera Vez en IYF)',NULL,'0'),(2,'Nuevo B (Participo en Eventos de IYF)',NULL,'0'),(3,'Miembro de IYF (Formo parte IYF)',NULL,'0'),(4,'Miembro Activo de IYF',NULL,'0'),(5,'Maestro',NULL,'1'),(6,'Staff Tecnico',NULL,'1'),(7,'Staff Oficina',NULL,'1'),(8,'Staff Cocina',NULL,'1'),(9,'Staff Logistico (transportadores)',NULL,'1'),(10,'Staff VIP',NULL,'1'),(11,'Ministro',NULL,'1'),(12,'Voluntario',NULL,'1');
/*!40000 ALTER TABLE `modalities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_type`
--

DROP TABLE IF EXISTS `payment_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_type` (
  `id_payment_type` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(150) default NULL,
  PRIMARY KEY  (`id_payment_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_type`
--

LOCK TABLES `payment_type` WRITE;
/*!40000 ALTER TABLE `payment_type` DISABLE KEYS */;
INSERT INTO `payment_type` VALUES (1,'Banco',NULL),(2,'Abono',NULL);
/*!40000 ALTER TABLE `payment_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_user`
--

DROP TABLE IF EXISTS `payment_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_user` (
  `id_payment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY  (`id_payment`,`id_user`),
  KEY `fk_payment_user_2_idx` (`id_user`),
  CONSTRAINT `fk_payment_user_1` FOREIGN KEY (`id_payment`) REFERENCES `payments` (`id_payment`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_payment_user_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_user`
--

LOCK TABLES `payment_user` WRITE;
/*!40000 ALTER TABLE `payment_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id_payment` int(11) NOT NULL auto_increment,
  `amount` decimal(5,2) NOT NULL,
  `date` timestamp NULL default NULL,
  `id_payment_type` int(11) default '1',
  `registered_by` int(11) NOT NULL,
  PRIMARY KEY  (`id_payment`),
  KEY `fk_payments_1_idx` (`id_payment_type`),
  KEY `fk_payments_2_idx` (`registered_by`),
  CONSTRAINT `fk_payments_1` FOREIGN KEY (`id_payment_type`) REFERENCES `payment_type` (`id_payment_type`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_payments_2` FOREIGN KEY (`registered_by`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicities`
--

DROP TABLE IF EXISTS `publicities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicities` (
  `id_publicity` int(11) NOT NULL auto_increment,
  `name` varchar(75) collate utf8_spanish_ci default NULL,
  `description` varchar(45) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id_publicity`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicities`
--

LOCK TABLES `publicities` WRITE;
/*!40000 ALTER TABLE `publicities` DISABLE KEYS */;
INSERT INTO `publicities` VALUES (1,'Volante',NULL),(2,'Facebook',NULL),(3,'Twitter',NULL),(4,'Videoblog o gestor de video (youtube, vimeo, etc.)',NULL),(5,'Radio',NULL),(6,'Televisión',NULL),(7,'Periódico',NULL),(8,'Invitación ',NULL),(9,'Metro',NULL),(10,'Otros',NULL);
/*!40000 ALTER TABLE `publicities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scolarships`
--

DROP TABLE IF EXISTS `scolarships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scolarships` (
  `id_scolarship` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `description` varchar(45) default NULL,
  PRIMARY KEY  (`id_scolarship`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scolarships`
--

LOCK TABLES `scolarships` WRITE;
/*!40000 ALTER TABLE `scolarships` DISABLE KEYS */;
INSERT INTO `scolarships` VALUES (1,'Secundaria',NULL),(2,'Preparatoria',NULL),(3,'Universitario',NULL),(4,'Maestria',NULL),(5,'Doctorado',NULL);
/*!40000 ALTER TABLE `scolarships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL auto_increment,
  `names` varchar(100) NOT NULL,
  `parent_names` varchar(100) default NULL,
  `genre` varchar(1) NOT NULL,
  `born` date default NULL,
  `email` varchar(100) NOT NULL,
  `scolarship` int(11) default NULL,
  `assistance` varchar(1) default 'N',
  `id_group` int(11) default NULL,
  `usrnm` varchar(20) default NULL,
  `id_usertype` int(11) default '5',
  `id_modality` int(11) default NULL,
  `notes` varchar(500) default NULL,
  `registered` timestamp NULL default NULL,
  `id_country` char(3) default 'MEX',
  `psswrd` text,
  `id_headquarters` int(11) NOT NULL,
  `id_city` int(11) default NULL,
  `id_publicity` int(11) default NULL,
  `hosted` varchar(1) default 'Y',
  `pays` int(11) default NULL,
  `maternal_name` varchar(100) default NULL,
  PRIMARY KEY  (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`usrnm`),
  KEY `fk_users_1_idx` (`scolarship`),
  KEY `fk_users_2_idx` (`id_usertype`),
  KEY `fk_users_3_idx` (`id_modality`),
  KEY `fk_users_4_idx` (`id_group`),
  KEY `fk_users_6_idx` (`id_headquarters`),
  KEY `fk_users_7_idx` (`id_city`),
  KEY `fk_users_8_idx` (`id_publicity`),
  CONSTRAINT `fk_users_1` FOREIGN KEY (`scolarship`) REFERENCES `scolarships` (`id_scolarship`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_2` FOREIGN KEY (`id_usertype`) REFERENCES `usertypes` (`id_usertype`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_3` FOREIGN KEY (`id_modality`) REFERENCES `modalities` (`id_modality`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_4` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id_group`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_7` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id_city`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_8` FOREIGN KEY (`id_publicity`) REFERENCES `publicities` (`id_publicity`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=128002 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (100001,'Administrador','del','M','2014-06-03','admin@iyf.com',3,'0',1,'admin',1,NULL,NULL,'2014-07-03 20:18:47','MEX','78411ae77a086e8b8fa2730b7b065e04',1,2551,NULL,'0',25,'sistema');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usertypes`
--

DROP TABLE IF EXISTS `usertypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usertypes` (
  `id_usertype` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `description` varchar(45) default NULL,
  PRIMARY KEY  (`id_usertype`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usertypes`
--

LOCK TABLES `usertypes` WRITE;
/*!40000 ALTER TABLE `usertypes` DISABLE KEYS */;
INSERT INTO `usertypes` VALUES (1,'Administrador',NULL),(2,'Supervisor',NULL),(3,'Registrador',NULL),(4,'Cajero',NULL),(5,'Participante',NULL);
/*!40000 ALTER TABLE `usertypes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-31 14:30:36
