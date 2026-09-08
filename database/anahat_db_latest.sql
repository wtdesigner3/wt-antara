-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: anahat_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `tbl_about`
--

DROP TABLE IF EXISTS `tbl_about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_about` (
  `id` int(11) NOT NULL,
  `story_subheading` varchar(255) NOT NULL DEFAULT 'Origin Heritage & Sourcing Network',
  `story_heading` varchar(255) NOT NULL DEFAULT 'Bridging Indian Cultivation Belts With Global Markets & Commercial Kitchens',
  `story_content` longtext NOT NULL,
  `story_image` varchar(255) NOT NULL DEFAULT 'assets/img/commodities/hero-coffee-plantation-banner.jpg',
  `story_badge_exp` varchar(50) NOT NULL DEFAULT '15+',
  `story_badge_title` varchar(255) DEFAULT 'Dependable Sourcing Partner',
  `story_badge_subtitle` varchar(255) DEFAULT '15+ Years Origin Experience • Direct Cooperative Ties',
  `mission_heading` varchar(255) NOT NULL DEFAULT 'Our Strategic Mission',
  `mission_content` longtext NOT NULL,
  `mission_image` varchar(255) DEFAULT '',
  `vision_heading` varchar(255) NOT NULL DEFAULT 'Our Global Vision',
  `vision_content` longtext NOT NULL,
  `vision_image` varchar(255) DEFAULT '',
  `value1_title` varchar(255) NOT NULL DEFAULT 'Origin Authenticity & Traceability',
  `value1_desc` text NOT NULL,
  `value1_image` varchar(255) DEFAULT '',
  `value1_icon` varchar(100) DEFAULT 'fa-solid fa-seedling',
  `value2_title` varchar(255) NOT NULL DEFAULT 'Laboratory-Grade Batch Quality',
  `value2_desc` text NOT NULL,
  `value2_image` varchar(255) DEFAULT '',
  `value2_icon` varchar(100) DEFAULT 'fa-solid fa-microscope',
  `value3_title` varchar(255) NOT NULL DEFAULT 'Predictable Maritime Logistics',
  `value3_desc` text NOT NULL,
  `value3_image` varchar(255) DEFAULT '',
  `value3_icon` varchar(100) DEFAULT 'fa-solid fa-ship',
  `value4_title` varchar(255) NOT NULL DEFAULT 'Transparent Commercial Integrity',
  `value4_desc` text NOT NULL,
  `value4_image` varchar(255) DEFAULT '',
  `value4_icon` varchar(100) DEFAULT 'fa-solid fa-headset',
  `export_line_title` varchar(255) NOT NULL DEFAULT 'Bulk Agricultural Commodity Export Desk',
  `export_line_desc` text NOT NULL,
  `horeca_line_title` varchar(255) NOT NULL DEFAULT 'Hospitality & Café Supply Network',
  `horeca_line_desc` text NOT NULL,
  `stat_volume` varchar(50) NOT NULL DEFAULT '500+ MT',
  `stat_volume_label` varchar(100) NOT NULL DEFAULT 'Monthly Commodity Flow',
  `stat_ports` varchar(50) NOT NULL DEFAULT '18+',
  `stat_ports_label` varchar(100) NOT NULL DEFAULT 'Global Discharge Ports',
  `stat_lots` varchar(50) NOT NULL DEFAULT '100%',
  `stat_lots_label` varchar(100) NOT NULL DEFAULT 'Batch Traceable Lots',
  `stat_clients` varchar(50) NOT NULL DEFAULT '120+',
  `stat_clients_label` varchar(100) NOT NULL DEFAULT 'Commercial Buyers',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `capabilities_subheading` varchar(255) DEFAULT 'Comprehensive Supply Capability',
  `capabilities_heading` varchar(255) DEFAULT 'From Indian Cultivation Belts to Commercial Kitchens',
  `capabilities_badge_title` varchar(255) DEFAULT 'Direct Agro-Commodity & HORECA Logistics',
  `capabilities_content` longtext DEFAULT NULL,
  `capabilities_image` varchar(255) DEFAULT 'assets/img/commodities/shipping-logistics-port.jpg',
  `capabilities_btn1_text` varchar(100) DEFAULT 'Browse Export Products',
  `capabilities_btn1_link` varchar(255) DEFAULT 'product-arabica.php',
  `capabilities_btn2_text` varchar(100) DEFAULT 'View HORECA Products',
  `capabilities_btn2_link` varchar(255) DEFAULT 'supply-coffee.php',
  `ind_subheading` varchar(255) DEFAULT 'Industries We Serve',
  `ind_heading` varchar(255) DEFAULT 'Tailored Procurement Across Two Core Sectors',
  `ind_desc` text DEFAULT NULL,
  `ind1_badge` varchar(100) DEFAULT 'International Trade Division',
  `ind1_title` varchar(255) DEFAULT 'Export Sector',
  `ind1_desc` text DEFAULT NULL,
  `ind1_clients` varchar(255) DEFAULT 'Importers, Distributors, Wholesalers, Retail Brands, Food Manufacturers',
  `ind1_btn_text` varchar(100) DEFAULT 'Explore Export Commodities',
  `ind1_btn_link` varchar(255) DEFAULT 'product-arabica.php',
  `ind1_icon` varchar(255) DEFAULT 'assets/img/icons/industry-export.svg',
  `ind2_badge` varchar(100) DEFAULT 'Hospitality & Food Service',
  `ind2_title` varchar(255) DEFAULT 'HORECA Sector',
  `ind2_desc` text DEFAULT NULL,
  `ind2_clients` varchar(255) DEFAULT 'Hotels, Restaurants, Cafés, Caterers, Cloud Kitchens',
  `ind2_btn_text` varchar(100) DEFAULT 'Explore Foodservice Products',
  `ind2_btn_link` varchar(255) DEFAULT 'supply-coffee.php',
  `ind2_icon` varchar(255) DEFAULT 'assets/img/icons/industry-horeca.svg',
  `cta_subheading` varchar(255) DEFAULT 'Commercial Trade Desk',
  `cta_heading` varchar(255) DEFAULT 'Looking to Partner with a Dependable Indian Sourcing Company?',
  `cta_desc` text DEFAULT NULL,
  `cta_btn_text` varchar(100) DEFAULT 'Connect with Trade Desk',
  `cta_btn_link` varchar(255) DEFAULT 'contact.php',
  `cta_btn_action` varchar(50) DEFAULT 'link',
  `cta_bg_image` varchar(255) DEFAULT 'assets/img/commodities/shipping-logistics-port.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_about`
--

LOCK TABLES `tbl_about` WRITE;
/*!40000 ALTER TABLE `tbl_about` DISABLE KEYS */;
INSERT INTO `tbl_about` VALUES (1,'Origin Heritage & Sourcing Network','Bridging Indian Cultivation Belts With Global Markets & Commercial Kitchens','<p>Antara Globale was established to solve a fundamental trade challenge: international buyers seeking genuine Indian origin agricultural commodities frequently face multi-tier brokerage layers, inconsistent batch quality, and delayed shipping documentation. Simultaneously, domestic café chains, roasters, and restaurant operators require dependable, consolidated wholesale food supplies delivered with rigorous consistency.</p><p>We operate directly at the agricultural source. By establishing direct procurement relationships with planters, cooperatives, and spice processing units across Southern and Eastern India, Antara Globale delivers certified commodity shipments and kitchen ingredients backed by strict laboratory grade analysis and hermetic packaging.</p>','assets/img/generated/about_story_macro_hands_1788780249618.jpg','','Dependable Sourcing Partner','15+ Years Origin Experience • Direct Cooperative Ties','Our Strategic Mission','<p>To provide international commodity buyers and domestic foodservice operators with direct, transparent, and certified access to India\'s agricultural wealth, executing every transaction with precision grading, competitive commercial terms, and dependable maritime delivery.</p>','assets/img/icons/mission-target.svg','Our Global Vision','<p>To stand as India\'s most trusted export and foodservice procurement desk, recognized across global ports and commercial kitchens for unyielding quality assurance, supply predictability, and customer-first trade execution.</p>','assets/img/icons/vision-compass.svg','Origin Authenticity & Traceability','Eliminating speculative trading layers by sourcing directly from plantation gates and verified producer clusters.','','fa-solid fa-seedling','Laboratory-Grade Batch Quality','Zero compromise on screen calibration, moisture ceilings, essential oil density, and export certifications.','','fa-solid fa-microscope','Predictable Maritime Logistics','Strategic warehouse buffering and freight partnerships ensuring scheduled container dispatches without disruption.','','fa-solid fa-ship','Transparent Commercial Integrity','24-hour response turnaround on FOB/CIF quotations, sample evaluation kits, and real-time shipping tracking.','','fa-solid fa-headset','Bulk Agricultural Commodity Export Desk','Arabica & Robusta green coffee beans, estate single-origin orthodox & CTC teas, whole black pepper, and high-curcumin turmeric fingers.','Hospitality & Café Supply Network','Roasted beans, ceremonial & culinary matcha, flavored syrups, commercial sugar sachets & cubes, sauces & condiments (Veeba & on request), and custom procurement.','500+ MT','Monthly Commodity Flow','18+','Global Discharge Ports','100%','Batch Traceable Lots','120+','Commercial Buyers','2026-09-08 05:56:04','Comprehensive Supply Capability','From Indian Cultivation Belts to Commercial Kitchens','Direct Agro-Commodity & HORECA Logistics','<p>Our dual operational capability ensures that whether you require container shipments of export-grade commodities or consolidated pantry and beverage supplies for multi-location hospitality chains, procurement is always dependable:</p>\n<ul class=\"feature-check-list mb-4 list-unstyled\">\n    <li class=\"mb-3 d-flex align-items-start gap-3\">\n        <i class=\"fa-solid fa-circle-check text-success fs-5 mt-1\"></i>\n        <div><strong>Agro-Commodity Export Line:</strong> Arabica & Robusta green coffee beans, estate single-origin orthodox & CTC teas, whole black pepper, and high-curcumin turmeric fingers.</div>\n    </li>\n    <li class=\"mb-3 d-flex align-items-start gap-3\">\n        <i class=\"fa-solid fa-circle-check text-success fs-5 mt-1\"></i>\n        <div><strong>Restaurant & Café Supplies:</strong> Roasted beans, ceremonial & culinary matcha, flavored syrups, commercial sugar sachets & cubes, sauces & condiments (Veeba & on request), and custom procurement.</div>\n    </li>\n    <li class=\"d-flex align-items-start gap-3\">\n        <i class=\"fa-solid fa-circle-check text-success fs-5 mt-1\"></i>\n        <div><strong>Consistent Commercial Execution:</strong> Strict quality checking, responsive communication desk, sample evaluation kits, and transparent commercial pricing.</div>\n    </li>\n</ul>','assets/img/generated/about_us_hero_plantation_1788780177756.jpg','Browse Export Products','product-arabica.php','View HORECA Products','supply-coffee.php','Industries We Serve','Tailored Procurement Across Two Core Sectors','Providing customized sourcing frameworks tailored to international bulk commodity trade and domestic commercial hospitality operations.','International Trade Division','Export Sector','Supporting international trade desks with origin-graded agricultural commodities, customized export packaging, containerized sea freight logistics, and strict quality verification.','Importers, Distributors, Wholesalers, Retail Brands, Food Manufacturers','Explore Export Commodities','product-arabica.php','assets/img/icons/industry-export.svg','Hospitality & Food Service','HORECA Sector','Dedicated procurement service delivering essential beverage solutions, cooking condiments, sugars, specialty coffees, matcha, and custom food ingredients to professional kitchens.','Hotels, Restaurants, Cafés, Caterers, Cloud Kitchens','Explore Foodservice Products','supply-coffee.php','assets/img/icons/industry-horeca.svg','Commercial Trade Desk','Looking to Partner with a Dependable Indian Sourcing Company?','Contact our commercial trade desk today with your specifications, volume requirements, and delivery destination.','Connect with Trade Desk','contact.php','link','assets/img/commodities/shipping-logistics-port.jpg');
/*!40000 ALTER TABLE `tbl_about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'Admin',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL DEFAULT 'logo.svg',
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES (1,'Antara Admin','admin','0192023a7bbd73250516f069df18b500','trade@antaraglobale.com','antara-logo-dark.svg','2026-09-04 06:54:34');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_blogs`
--

DROP TABLE IF EXISTS `tbl_blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_blogs` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_title` varchar(255) NOT NULL,
  `b_url` varchar(255) NOT NULL,
  `b_category` varchar(100) DEFAULT 'Export Insights',
  `author` varchar(100) DEFAULT 'Antara Trade Desk',
  `b_image` varchar(255) DEFAULT NULL,
  `broad_image` varchar(255) DEFAULT NULL,
  `b_short_desc` text DEFAULT NULL,
  `b_description` longtext DEFAULT NULL,
  `b_quote` text DEFAULT NULL,
  `b_quote_author` varchar(150) DEFAULT NULL,
  `b_tags` varchar(255) DEFAULT 'Commodities, Export, Quality QA',
  `read_time` varchar(50) DEFAULT '5 min read',
  `b_date` date DEFAULT NULL,
  `b_status` tinyint(1) DEFAULT 1,
  `b_sort` int(11) DEFAULT 0,
  `metatag` text DEFAULT NULL,
  `metakeyword` text DEFAULT NULL,
  `metadesc` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_url` (`b_url`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_blogs`
--

LOCK TABLES `tbl_blogs` WRITE;
/*!40000 ALTER TABLE `tbl_blogs` DISABLE KEYS */;
INSERT INTO `tbl_blogs` VALUES (1,'The Evolution of Indian Arabica: How Micro-Lots & Altitude Crafting Win European Roasters','evolution-of-indian-arabica-coffee-export','Coffee Insights','Antara Trade Desk','assets/img/commodities/hero-specialty-coffee.jpg',NULL,'Exploring how high-altitude estates in Chikmagalur and Baba Budan Giri are producing specialty grade Arabica beans meeting strict European cupping standards.','<p class=\"mb-3\">Indian Arabica coffee has undergone a profound transformation over the last decade. Historically recognized for consistent commercial body in espresso blends, Southern India\'s plantation belts—nestled between 1,100 to 1,500 meters above sea level—are now commanding prime attention in specialty cupping tables across Frankfurt, London, and Melbourne.</p><p class=\"mb-3\">Our trade specialists at Antara Globale work directly with certified estate producers across Chikmagalur, Coorg, and Shevaroys. Through calibrated selective hand-picking, anaerobic fermentation trials, and strict moisture stabilization below 11.5%, we deliver washed Plantation A and Specialty Micro-Lot Arabicas that showcase bright citric acidity, cane sweetness, and delicate floral undertones.</p><h3 class=\"mt-4 mb-3\">Quality Parameters for Commercial Export</h3><p class=\"mb-3\">Every export lot undergoes comprehensive green bean grading, screen sizing (Screen 17/18 for Plantation A), and defect count audits adhering to the Coffee Board of India and International Coffee Organization (ICO) benchmarks. Containerization with inner GrainPro liner bags guarantees protection against sea freight humidity fluctuations.</p>','Consistency in screen grading and moisture equilibrium is the true foundation of long-term export relationships.','Lead Agronomist, Antara Trade Desk','Arabica, Coffee Export, Specialty Coffee, Quality QA','4 min read','2026-08-15',1,1,NULL,NULL,NULL,'2026-09-07 10:07:31'),(2,'Global Spice Sourcing: Verifying Malabar Black Pepper & Alleppey Turmeric Quality','global-spice-sourcing-malabar-pepper-turmeric-qa','Spice Trade','Quality Control Division','assets/img/commodities/black-pepper.jpg',NULL,'A master guide to export quality parameters: moisture thresholds, bulk density (GL), and curcumin percentage verification for international port compliance.','<p class=\"mb-3\">India remains the world’s undisputed epicenter for botanical potency and high-oil spice cultivation. For international spice importers, food processors, and seasoning houses, understanding rigorous laboratory benchmarks is the only hedge against consignment rejection at destination ports.</p><p class=\"mb-3\">Malabar Black Pepper from Kerala\'s Western Ghats is globally celebrated for its high piperine content (4.5%–6.0%) and robust bulk density (measured in Grams per Liter, or GL 550 to GL 570). Concurrently, Alleppey Finger Turmeric is sought after for its distinctive deep golden-yellow pigment and rich natural curcumin content averaging 5.0% to 5.5%.</p><h3 class=\"mt-4 mb-3\">Physical & Microbiological Rigor</h3><p class=\"mb-3\">Antara Globale enforces multi-stage sorting: pre-cleaning to extract light berries and pinheads, spiral gravity separators for density sorting, and final steam sterilization when specified for European and US FDA microbiological standards.</p>','Quality is not a final inspection step; it begins at the sorting tables in Kochi.','QA Director, Antara Globale','Black Pepper, Turmeric, Spices Export, Food Safety','5 min read','2026-08-28',1,2,NULL,NULL,NULL,'2026-09-07 10:07:31'),(3,'From Port to Pantry: Supply Chain Best Practices for Commercial HORECA Inflow','supply-chain-best-practices-horeca-foodservice','HORECA Supply','Logistics & Supply Desk','assets/img/commodities/shipping-logistics-port.jpg',NULL,'How temperature-monitored warehousing and containerized transit ensure zero degradation for bulk tea, sugar sachets, and barista syrups.','<p class=\"mb-3\">Managing high-frequency ingredient supply for luxury hotel chains, multi-location café brands, and commercial cloud kitchens requires zero-tolerance logistics. Downtime or stock inconsistency directly degrades guest satisfaction and brand reputation.</p><p class=\"mb-3\">Antara Globale bridges the gap between agricultural producers and hospitality pantry procurement. By maintaining regional hub warehousing in Bangalore and Mumbai, our clients benefit from palletized consolidation of Veeba condiments, artisanal barista syrups, branded portion-pack sugar sachets, and freshly roasted espresso blends.</p><h3 class=\"mt-4 mb-3\">Scheduled Batch Logistics</h3><p class=\"mb-3\">Our unified procurement SLA guarantees predictable dispatch cycles, computerized batch expiration traceability, and custom private labeling support for enterprise hotel franchises.</p>','Hospitality procurement demands the predictability of a clockwork logistics engine.','Operations Head, Antara Globale','HORECA, Hospitality, Supply Chain, Logistics','6 min read','2026-09-02',1,3,NULL,NULL,NULL,'2026-09-07 10:07:31'),(4,'czxczxc','czxczxc','Export Insights','Antara Trade Desk','uploads/blogs/1788776848_sadsad.png',NULL,'<p>zxcxzczxczxczxczxc</p>','<p>zxczxczxcxzc</p>','zcxzcxzc','','Commodities, Export, Quality QA','5 min read','2026-09-07',0,0,'zxcxzc','zxczxczxc','zxczxczxc','2026-09-07 10:25:29');
/*!40000 ALTER TABLE `tbl_blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `division` enum('export','horeca') NOT NULL DEFAULT 'horeca',
  `title` varchar(200) NOT NULL,
  `keyword` varchar(200) NOT NULL,
  `metadesc` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` VALUES (1,'Export Agricultural Commodities','export-commodities','export','Bulk Indian Agricultural Export','','',1,'assets/img/commodities/hero-export-banner.jpg','Direct-from-origin export commodities including Coffee Beans, Bulk Teas, and Malabar Spices.',1),(2,'Restaurant & Caf?? Supplies','restaurant-cafe-supplies','horeca','Commercial Hospitality & HORECA Supply','','',2,'assets/img/commodities/hero-coffee-beans-banner.jpg','Comprehensive foodservice solutions across 8 essential categories for caf??s, restaurants, and hotels.',1);
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contact`
--

DROP TABLE IF EXISTS `tbl_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contact` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_phone1` varchar(100) NOT NULL DEFAULT '+91 98765 43210',
  `con_phone2` varchar(100) NOT NULL DEFAULT '+91 91234 56789',
  `con_email1` varchar(100) NOT NULL DEFAULT 'trade@antaraglobale.com',
  `con_email2` varchar(100) NOT NULL DEFAULT 'exports@antaraglobale.com',
  `con_address` text NOT NULL,
  `con_detail` text NOT NULL,
  `con_sla_notice` varchar(255) DEFAULT '24-Hour Commercial Quote SLA',
  `con_hours` varchar(255) DEFAULT 'Mon - Sat: 9:00 AM - 7:00 PM IST',
  `con_map` text NOT NULL,
  `con_facebook` text NOT NULL,
  `con_instagram` text NOT NULL,
  `con_skype` text NOT NULL,
  `con_linkedin` text NOT NULL,
  `con_twitter` text NOT NULL,
  `con_youtube` text NOT NULL,
  `con_google` text NOT NULL,
  `con_whatsaap` varchar(255) NOT NULL DEFAULT '+919876543210',
  `widget_call_status` tinyint(1) DEFAULT 1,
  `widget_call_phone` varchar(100) DEFAULT '+91 98765 43210',
  `widget_call_position` varchar(20) DEFAULT 'left',
  `widget_call_tooltip` varchar(255) DEFAULT 'Call Us',
  `widget_wa_status` tinyint(1) DEFAULT 1,
  `widget_wa_number` varchar(100) DEFAULT '+919876543210',
  `widget_wa_position` varchar(20) DEFAULT 'right',
  `widget_wa_message` text DEFAULT 'Hello Antara Globale, I am interested in commodity sourcing & trade inquiries.',
  `widget_wa_tooltip` varchar(255) DEFAULT 'Chat on WhatsApp',
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contact`
--

LOCK TABLES `tbl_contact` WRITE;
/*!40000 ALTER TABLE `tbl_contact` DISABLE KEYS */;
INSERT INTO `tbl_contact` VALUES (1,'+91 98765 43210','+91 91234 56789','trade@antaraglobale.com','exports@antaraglobale.com','Antara Globale Trade Office, Bangalore & Mumbai Ports, India','Global Agricultural Export & HORECA Foodservice Procurement Desk','24-Hour Commercial Quote SLA','Mon - Sat: 9:00 AM - 7:00 PM IST','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.001696423985!2d77.5945627!3d12.9715987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1680000000000!5m2!1sen!2sin','https://facebook.com','https://instagram.com','','https://linkedin.com','https://twitter.com','','','+919876543210',1,'+91 98765 43210','left','Call Us',1,'+919876543210','right','Hello Antara Globale, I am interested in commodity sourcing & trade inquiries.','Chat on WhatsApp');
/*!40000 ALTER TABLE `tbl_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_enquiry`
--

DROP TABLE IF EXISTS `tbl_enquiry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL DEFAULT 'India',
  `division` enum('export','horeca') NOT NULL DEFAULT 'horeca',
  `product_interest` varchar(255) NOT NULL,
  `volume_requirement` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','in_discussion','quoted','closed') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_enquiry`
--

LOCK TABLES `tbl_enquiry` WRITE;
/*!40000 ALTER TABLE `tbl_enquiry` DISABLE KEYS */;
INSERT INTO `tbl_enquiry` VALUES (1,'Marcus Vance','Alpine Roastworks GmbH','m.vance@alpinesip.de','+49 89 2441 5500','Germany','export','Arabica Green Coffee Beans','1x20ft Container (19.2 MT)','Interested in receiving sample lot for Plantation AA washed beans. Need CIF Hamburg price indication.','in_discussion',NULL,NULL,'2026-09-04 06:54:34'),(2,'Aarav Sharma','Blue Terrace Caf?? & Bistro','procurement@blueterrace.in','+91 98200 12345','India','horeca','Coffee Solutions, Flavoured Syrups','50 kg/month coffee, 20 bottles syrups','Opening two new caf?? outlets in Bangalore. Requesting trade catalog and commercial pricing for espresso beans and syrups.','pending',NULL,NULL,'2026-09-04 06:54:34'),(3,'Michael Sterling','Nordic Bean Importers Ltd','m.sterling@nordicbean.se','+46 8 123 4567','Sweden','export','Arabica Green Coffee Beans','2x20ft FCL (~38.4 MT)','Requesting CIF Gothenburg pricing for Plantation AA and sample cupping lot.','pending',NULL,'::1','2026-09-04 07:48:54');
/*!40000 ALTER TABLE `tbl_enquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_hero_slides`
--

DROP TABLE IF EXISTS `tbl_hero_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_hero_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `badge_text` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `btn1_text` varchar(100) DEFAULT 'Request Trade Quote',
  `btn1_link` varchar(255) DEFAULT '#b2bEnquiryModal',
  `btn2_text` varchar(100) DEFAULT 'Export Commodities',
  `btn2_link` varchar(255) DEFAULT 'products.php?division=export',
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_hero_slides`
--

LOCK TABLES `tbl_hero_slides` WRITE;
/*!40000 ALTER TABLE `tbl_hero_slides` DISABLE KEYS */;
INSERT INTO `tbl_hero_slides` VALUES (1,'DIRECT ORIGIN COMMODITY EXPORT & B2B FOODSERVICE SUPPLY','Indian Agricultural Commodities & Foodservice Supplies','Connecting international commodity buyers with export-grade Coffee Beans, Bulk Teas, and Malabar Spices, and serving restaurant & café chains across India with dependable commercial food supplies.','Request Trade Quote','#b2bEnquiryModal','Export Commodities','product-arabica.php','assets/img/generated/homepage_hero_warehouse_notext_1788779442604.jpg',1,1,'2026-09-07 05:00:00'),(2,'BULK AGRO COMMODITY EXPORT TO 30+ GLOBAL PORTS','Single-Origin Teas, Malabar Pepper & High-Curcumin Turmeric','Export-grade orthodox teas, high-piperine black pepper, and golden turmeric sourced from celebrated Indian agro-climatic belts for global blenders and packers.','Request Trade Quote','#b2bEnquiryModal','Explore Export Commodities','product-arabica.php','assets/img/generated/export_division_warehouse_test_1788780039698.jpg',2,1,'2026-09-07 05:00:00'),(6,'B2B RESTAURANT & CAFÉ FOODSERVICE SUPPLY','Commercial Coffee Roasts, Syrups & Beverage Ingredients','Supplying gourmet roasted coffee blends, artisanal dessert sauces, fruit syrups, and barista essentials to leading cafés, hotel chains, and restaurants across India.','Explore Café Supplies','restaurant-cafe-supply.php','Download Product Catalog','#b2bEnquiryModal','assets/img/generated/hero_slider_horeca_cafe_supply.jpg',3,1,'2026-09-08 04:25:49'),(7,'DIRECT-FROM-ESTATE GREEN COFFEE EXPORT','High-Altitude Arabica & Monsoon Malabar Green Coffee','Screened, washed, and custom-graded green coffee beans directly sourced from Western Ghats estates for global specialty roasters and commercial importers.','Request FOB / CIF Quote','#b2bEnquiryModal','View Coffee Specifications','product-arabica.php','assets/img/generated/hero_slider_green_coffee_export.jpg',4,1,'2026-09-08 04:25:49');
/*!40000 ALTER TABLE `tbl_hero_slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_home_content`
--

DROP TABLE IF EXISTS `tbl_home_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_home_content` (
  `id` int(11) NOT NULL,
  `hero_badge_1` varchar(255) NOT NULL DEFAULT 'DIRECT ORIGIN COMMODITY EXPORT & B2B FOODSERVICE SUPPLY',
  `hero_title_1` varchar(255) NOT NULL DEFAULT 'Indian Agricultural Commodities & Foodservice Supplies',
  `hero_desc_1` text NOT NULL,
  `hero_btn1_text_1` varchar(100) NOT NULL DEFAULT 'Request Trade Quote',
  `hero_btn1_link_1` varchar(255) NOT NULL DEFAULT '#b2bEnquiryModal',
  `hero_btn2_text_1` varchar(100) NOT NULL DEFAULT 'Export Commodities',
  `hero_btn2_link_1` varchar(255) NOT NULL DEFAULT 'product-arabica.php',
  `hero_btn3_text_1` varchar(100) NOT NULL DEFAULT 'Restaurant & Café Supply',
  `hero_btn3_link_1` varchar(255) NOT NULL DEFAULT 'supply-coffee.php',
  `hero_image_1` varchar(255) NOT NULL DEFAULT 'assets/img/commodities/hero-export-banner.jpg',
  `hero_badge_2` varchar(255) NOT NULL DEFAULT 'BULK AGRO COMMODITY EXPORT TO 30+ GLOBAL PORTS',
  `hero_title_2` varchar(255) NOT NULL DEFAULT 'Single-Origin Teas, Malabar Pepper & High-Curcumin Turmeric',
  `hero_desc_2` text NOT NULL,
  `hero_btn1_text_2` varchar(100) NOT NULL DEFAULT 'Request Trade Quote',
  `hero_btn1_link_2` varchar(255) NOT NULL DEFAULT '#b2bEnquiryModal',
  `hero_btn2_text_2` varchar(100) NOT NULL DEFAULT 'Explore Export Commodities',
  `hero_btn2_link_2` varchar(255) NOT NULL DEFAULT 'product-arabica.php',
  `hero_image_2` varchar(255) NOT NULL DEFAULT 'assets/img/commodities/hero-tea-gardens.jpg',
  `about_subheading` varchar(255) NOT NULL DEFAULT 'Direct Farm-Gate & Estate Sourcing Network',
  `about_heading` varchar(255) NOT NULL DEFAULT 'Indian Origin Procurement & Export Logistics',
  `about_content` longtext NOT NULL,
  `about_badge_title` varchar(255) DEFAULT 'Sourcing & Trading Desk',
  `about_badge_exp` varchar(255) DEFAULT '15+ Years Origin Experience',
  `about_stat_vol` varchar(100) DEFAULT '500+ MT',
  `about_stat_ports` varchar(100) DEFAULT '18+',
  `about_point_1` varchar(255) NOT NULL DEFAULT 'Direct farm-gate and estate procurement avoiding multi-tier middleman inflation.',
  `about_point_2` varchar(255) NOT NULL DEFAULT 'Batch-tested origin verification with multi-wall hermetic GrainPro packing.',
  `about_point_3` varchar(255) NOT NULL DEFAULT 'Pan-India port logistics connectivity to Mangalore, Cochin, Chennai, and Nhava Sheva.',
  `about_exp_years` varchar(50) NOT NULL DEFAULT '15+',
  `about_ports_count` varchar(50) NOT NULL DEFAULT '30+',
  `about_image` varchar(255) NOT NULL DEFAULT 'assets/img/commodities/hero-coffee-beans-banner.jpg',
  `pillar1_title` varchar(255) NOT NULL DEFAULT 'Direct Origin Procurement',
  `pillar1_desc` text NOT NULL,
  `pillar1_icon` varchar(100) NOT NULL DEFAULT 'fa-solid fa-seedling',
  `pillar1_image` varchar(255) DEFAULT '',
  `pillar2_title` varchar(255) NOT NULL DEFAULT 'Strict Quality Assurance',
  `pillar2_desc` text NOT NULL,
  `pillar2_icon` varchar(100) NOT NULL DEFAULT 'fa-solid fa-microscope',
  `pillar2_image` varchar(255) DEFAULT '',
  `pillar3_title` varchar(255) NOT NULL DEFAULT 'Export Packaging & Logistics',
  `pillar3_desc` text NOT NULL,
  `pillar3_icon` varchar(100) NOT NULL DEFAULT 'fa-solid fa-box-archive',
  `pillar3_image` varchar(255) DEFAULT '',
  `pillar4_title` varchar(255) NOT NULL DEFAULT 'Responsive Commercial SLA',
  `pillar4_desc` text NOT NULL,
  `pillar4_icon` varchar(100) NOT NULL DEFAULT 'fa-solid fa-headset',
  `pillar4_image` varchar(255) DEFAULT '',
  `terroir_subheading` varchar(255) NOT NULL DEFAULT 'Indian Agricultural Terroir',
  `terroir_heading` varchar(255) NOT NULL DEFAULT 'Prime Sourcing Belts Across India',
  `terroir_desc` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `choose_subheading` varchar(255) DEFAULT 'Export Advantages',
  `choose_heading` varchar(255) DEFAULT 'Why International Buyers Choose Antara Globale',
  `choose_desc` text DEFAULT NULL,
  `choose_image` varchar(255) DEFAULT 'assets/img/commodities/hero-spices-export.jpg',
  `choose_badge_title` varchar(255) DEFAULT '100% Export Grade',
  `choose_badge_desc` varchar(255) DEFAULT 'Direct Farmgate to Seaport',
  `choose_btn1_text` varchar(100) DEFAULT 'Request Specifications & Quote',
  `choose_btn1_link` varchar(255) DEFAULT '#b2bEnquiryModal',
  `choose_btn2_text` varchar(100) DEFAULT 'About Company',
  `choose_btn2_link` varchar(255) DEFAULT 'about.php',
  `choose_card1_title` varchar(255) DEFAULT 'Direct Origin Procurement',
  `choose_card1_desc` text DEFAULT NULL,
  `choose_card1_icon` varchar(255) DEFAULT 'assets/img/icons/pillar-1-origin.svg',
  `choose_card2_title` varchar(255) DEFAULT 'Strict Quality Assurance',
  `choose_card2_desc` text DEFAULT NULL,
  `choose_card2_icon` varchar(255) DEFAULT 'assets/img/icons/pillar-2-quality.svg',
  `choose_card3_title` varchar(255) DEFAULT 'Export Packaging & Logistics',
  `choose_card3_desc` text DEFAULT NULL,
  `choose_card3_icon` varchar(255) DEFAULT 'assets/img/icons/pillar-3-logistics.svg',
  `choose_card4_title` varchar(255) DEFAULT 'Responsive Commercial SLA',
  `choose_card4_desc` text DEFAULT NULL,
  `choose_card4_icon` varchar(255) DEFAULT 'assets/img/icons/pillar-4-support.svg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_home_content`
--

LOCK TABLES `tbl_home_content` WRITE;
/*!40000 ALTER TABLE `tbl_home_content` DISABLE KEYS */;
INSERT INTO `tbl_home_content` VALUES (1,'DIRECT ORIGIN COMMODITY EXPORT & B2B FOODSERVICE SUPPLY','Indian Agricultural Commodities & Foodservice Supplies','Connecting international commodity buyers with export-grade Coffee Beans, Bulk Teas, and Malabar Spices, and serving restaurant & café chains across India with dependable commercial food supplies.','Request Trade Quote','#b2bEnquiryModal','Export Commodities','product-arabica.php','Restaurant & Café Supply','supply-coffee.php','assets/img/commodities/hero-export-banner.jpg','BULK AGRO COMMODITY EXPORT TO 30+ GLOBAL PORTS','Single-Origin Teas, Malabar Pepper & High-Curcumin Turmeric','Export-grade orthodox teas, high-piperine black pepper, and golden turmeric sourced from celebrated Indian agro-climatic belts for global blenders and packers.','Request Trade Quote','#b2bEnquiryModal','Explore Export Commodities','product-arabica.php','assets/img/commodities/hero-tea-gardens.jpg','Direct Farm-Gate & Estate Sourcing Network','Indian Origin Procurement & Export Logistics','<p>Antara Globale operates as a specialized Indian agricultural commodity exporter and commercial foodservice procurement partner. Headquartered in India with sourcing corridors across Karnataka, Kerala, Assam, and Deccan cultivation belts, we bridge the gap between regional agricultural producers and demanding commercial enterprises.</p><p>Our business is organized into two dedicated operating divisions: <strong>Export Commodities Division</strong> supplying global importers, roasters, and spice blenders with bulk FCL shipments, and <strong>Restaurant &amp; Café Supply Division</strong> delivering tailored wholesale beverage solutions, artisanal syrups, portion sugars, and high-yield kitchen condiments to hospitality operators.&nbsp;</p>','Sourcing & Trading Desk','500+ MT monthly • 18+ global ports','500+ MT','18+','Direct farm-gate and estate procurement avoiding multi-tier middleman inflation.','Batch-tested origin verification with multi-wall hermetic GrainPro packing.','Pan-India port logistics connectivity to Mangalore, Cochin, Chennai, and Nhava Sheva.','15+','30+','assets/img/generated/about_intro_inspector_1788779507099.jpg','Direct Origin Procurement','We procure directly from farm-gate cooperatives and shade-grown plantations, ensuring lot traceability, competitive baseline pricing, and genuine regional authenticity.','fa-solid fa-seedling','','Strict Quality Assurance','Every export consignment undergoes strict batch analysis for moisture content, screen calibration, piperine or curcumin density, and sensory cupping.','fa-solid fa-microscope','','Export Packaging & Logistics','GrainPro hermetic lining, nitrogen-flushed bulk containers, and swift dispatch through major maritime gateways including Mangalore, Cochin, and Nhava Sheva.','fa-solid fa-box-archive','','Responsive Commercial SLA','Dedicated commercial trade desk offering 24-hour turnaround on FOB/CIF quotations, sample evaluation dispatch, and real-time shipping documentation.','fa-solid fa-headset','','Indian Agricultural Terroir','Prime Sourcing Belts Across India','Explore celebrated agricultural zones producing our export-grade coffee, teas, and spices with authentic geographic provenance.','2026-09-07 12:12:40','Export Advantages','Why International Buyers Choose Antara Globale','An export-first methodology designed for international contract structures, strict technical tolerances, and predictable maritime shipment schedules.','uploads/home/choose_showcase_1788774726_466.png','100% Export Grade','Direct Farmgate to Seaport','Request Specifications & Quote','#b2bEnquiryModal','About Company','about.php','Direct Origin Procurement','We procure directly from farm-gate cooperatives and shade-grown plantations, ensuring lot traceability, competitive baseline pricing, and genuine regional authenticity.','uploads/home/choose_card_1_1788774610_575.svg','Strict Quality Assurance','Every export consignment undergoes strict batch analysis for moisture content, screen calibration, piperine or curcumin density, and sensory cupping.','assets/img/icons/pillar-2-quality.svg','Export Packaging & Logistics','GrainPro hermetic lining, nitrogen-flushed bulk containers, and swift dispatch through major maritime gateways including Mangalore, Cochin, and Nhava Sheva.','assets/img/icons/pillar-3-logistics.svg','Responsive Commercial SLA','Dedicated commercial trade desk offering 24-hour turnaround on FOB/CIF quotations, sample evaluation dispatch, and real-time shipping documentation.','assets/img/icons/pillar-4-support.svg');
/*!40000 ALTER TABLE `tbl_home_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `division` enum('export','horeca') NOT NULL DEFAULT 'horeca',
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `available_varieties` text NOT NULL,
  `brands` varchar(255) NOT NULL DEFAULT 'Antara Globale Sourced',
  `specifications` text NOT NULL,
  `packaging` varchar(255) NOT NULL,
  `moq` varchar(100) NOT NULL,
  `applications` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `badge1_title` varchar(255) DEFAULT 'Batch Verified',
  `badge1_desc` varchar(255) DEFAULT 'Strict QA check on moisture, grading & packaging.',
  `badge2_title` varchar(255) DEFAULT 'Dependable Logistics',
  `badge2_desc` varchar(255) DEFAULT 'Timely port freight & domestic dispatch.',
  `badge3_title` varchar(255) DEFAULT 'Commercial Pricing',
  `badge3_desc` varchar(255) DEFAULT 'Competitive volume rates for long-term partners.',
  `badge1_icon` varchar(255) DEFAULT 'assets/img/icons/pillar-2-quality.svg',
  `badge2_icon` varchar(255) DEFAULT 'assets/img/icons/pillar-3-logistics.svg',
  `badge3_icon` varchar(255) DEFAULT 'assets/img/icons/partnership-trust.svg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product`
--

LOCK TABLES `tbl_product` WRITE;
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` VALUES (1,2,'horeca','Coffee Solutions','supply-coffee','Commercial Brewing & Espresso Grade Beans','<p>Premium coffee solutions for cafés, restaurants, hotels and hospitality businesses. We supply quality coffee beans for a variety of brewing methods, with options tailored to commercial requirements.</p>','assets/img/generated/horeca_division_cafe_1788780105761.jpg','assets/img/commodities/hero-coffee-beans-banner.jpg','Arabica Coffee Beans, Robusta Coffee Beans, Roasted Coffee Beans','Antara Globale Roast Master Selection','<p>Variety: Arabica, Robusta, Commercial Blends; Roast Profiles: Light, Medium, Dark Espresso; Shelf Life: 12 Months; Certifications: FSSAI, Coffee Board of India; Aroma: Rich Caramel &amp; Nutty notes</p>','1kg Valve Pouches, 5kg Nitrogen Bulk Packs, 20kg Bags','20 kg','',1,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(2,2,'horeca','Matcha Powder','supply-matcha','Authentic Ceremonial & Culinary Grade Green Tea Powder','<p>Premium matcha sourced for cafés, bakeries and beverage businesses. Available in multiple grades depending on the intended application.&nbsp;</p>','assets/img/generated/horeca_matcha_1788781004348.jpg','assets/img/commodities/hero-tea-gardens.jpg','Ceremonial Grade Matcha, Culinary Grade Matcha, Matcha Premix','First & Second Flush Origin Sourced','<p>Grades: Ceremonial Grade A+, Barista Culinary, Sweetened Premix; Mesh: 800-1000 ultra-fine; Color: Vibrant Jade Emerald; Caffeine: Natural sustained vitality; Shelf Life: 18 Months</p>','100g Airtight Tins, 500g Foil Pouches, 1kg Barista Bags','5 kg','',2,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(3,2,'horeca','Foodservice Tea','supply-tea','Consistent Quality Teas for Hospitality & Offices','<p>A carefully selected range of teas suitable for restaurants, cafés, hotels and offices, offering consistent taste and quality.&nbsp;</p>','assets/img/commodities/indian-tea.jpg','assets/img/commodities/hero-tea-gardens.jpg','Black Tea, Green Tea, Orthodox Tea, CTC Tea','Assam, Darjeeling & Nilgiri Estates','<p>Types: Whole Leaf Orthodox, CTC Granules, Green Sencha Style, English Breakfast Blend; Liquor: Rich golden to deep amber; Origin: Assam / Nilgiris; Shelf Life: 24 Months</p>','250g Pouches, 1kg Foodservice Packs, 25kg Bulk Bags','25 kg','',3,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(4,2,'horeca','Sauces & Condiments','supply-sauces','High-Yield Kitchen Condiments & Tabletop Sauces','A range of popular sauces and condiments for restaurants, cafés, cloud kitchens and food service businesses. Suitable for everyday commercial kitchen use.','assets/img/generated/horeca_syrups_sauces_1788780922134.jpg','assets/img/commodities/hero-spices-export.jpg','Honey Mustard, Pizza & Pasta Sauce, Schezwan Sauce, Mayonnaise, Tomato Ketchup, Sandwich Spread, Thousand Island Dressing, Burger Sauce','Veeba & other brands on request','Brands: Veeba Commercial, Custom Foodservice Packs; Emulsion: Smooth & heat-stable; Storage: Ambient dry store (refrigerate after opening); Shelf Life: 6-9 Months; Consistency: Heavy-duty kitchen grade','1kg Squeezer Pouches, 1.2kg Dispenser Jars, 5kg Foodservice Buckets','5 Cartons / 25 kg','Burgers, Wraps, Pizzas, Sandwiches, Salad Dressings, Dipping Stations',4,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(5,2,'horeca','Flavoured Syrups','supply-syrups','Artisanal Barista & Mixology Syrups','Flavoured syrups for cafés, restaurants and beverage businesses, suitable for coffee, mocktails, shakes and desserts.','assets/img/generated/horeca_syrups_sauces_1788780922134.jpg','assets/img/commodities/hero-coffee-beans-banner.jpg','Vanilla Syrup, Hazelnut Syrup, Caramel Syrup, Irish Syrup, Chocolate Syrup, Kala Khatta and Spicy Mango, Strawberry Syrup, Blue Curacao Syrup, Mojito Mint Syrup','Craft Beverage Formulations','Flavours: 9 Classic & Tropical Options; Brix Level: 65?? dense concentration; Pump Compatibility: Standard 10ml barista pumps; Artificial Sweeteners: None; Shelf Life: 24 Months','750ml PET & Glass Bottles, Case of 6 or 12','1 Case (6 Bottles)','Specialty Lattes, Iced Mochas, Craft Mocktails, Shakes, Frappes, Dessert Drizzles',5,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(6,2,'horeca','Commercial Sugar Solutions','supply-sugar','Portion Controlled & Kitchen Prep Sugars','Commercial sugar solutions designed for cafés, restaurants, hotels and institutional buyers.','assets/img/commodities/hero-export-banner.jpg','assets/img/commodities/hero-export-banner.jpg','Sugar Sachets, Breakfast Sugar, Brown Sugar Sachets, Sugar Cubes, Castor Sugar, Icing Sugar','Foodgrade Crystal Standards','Purity: 99.8% Refined Cane Sugar; Sachet Fill: 5g portion control; Custom Printing: Logo branding available on sachets; Moisture: < 0.04%; Dissolution: Instant hot/cold dissolve','5g Sachets (1000/box), 500g Cube Packs, 1kg Castor Bags, 25kg Bulk','1000 Sachets / 25 kg','Tabletop Beverage Service, Quick-Dissolve Barista Prep, Baking, Confectionery',6,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(7,2,'horeca','Green Coffee Beans (Domestic Roasters)','supply-green-coffee','Direct Estate Lots for Indian Artisan Roasters','Export-grade green coffee beans also available for specialty roasters and coffee businesses within India.','assets/img/generated/horeca_green_coffee_1788780830569.jpg','assets/img/commodities/hero-coffee-plantation-banner.jpg','Arabica (AAA, AA, AB, A, Peaberry), Robusta (AAA, AA, AB, Peaberry)','Coorg, Chikmagalur & Wayanad Estates','Species: Coffea Arabica & Coffea Canephora; Processing: Washed / Unwashed / Parchment; Moisture: <= 12%; Defect Rate: < 1.5%; Elevation: 800 - 1,450 meters MASL','30kg & 60kg Jute Gunny Bags with GrainPro hermetic liners','60 kg (1 Bag)','Batch Drum Roasting, Specialty Single Origins, Signature Caf?? Blends',7,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(8,2,'horeca','Custom Procurement','supply-custom-procurement','Bespoke Sourcing Network for Hospitality & Retail','If your required product is not listed in our catalogue, our sourcing network enables us to procure a wide range of food and beverage products based on your business requirements.','assets/img/generated/horeca_custom_procurement_1788783749989.jpg','assets/img/commodities/hero-export-banner.jpg','Specialty Syrups, Custom Sauce Formulations, Gourmet Dry Ingredients, Private Label Packaging','Partner Network & Contract Producers','Sourcing Scope: Pan-India farm-gate & manufacturing network; Evaluation: Strict COA and QA batch verification; Commercial Terms: Direct factory rates, consolidated freight','Tailored to buyer specification','Flexible based on product line','Custom Menu Rollouts, New Caf?? Launches, Hotel Chain Sourcing',8,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(9,1,'export','Arabica Green Coffee Beans','product-arabica','High-Altitude Specialty Export Lots','Premium unroasted green Arabica coffee beans sourced from the high-altitude shade-grown plantations of Karnataka and Kerala.','assets/img/generated/product_arabica_coffee_1788780432243.jpg','assets/img/commodities/hero-coffee-plantation-banner.jpg','Plantation AA, Plantation A, Plantation B, Peaberry (PB)','Antara Export Grade Lots','Origin: India; Processing: Fully Washed; Moisture: <= 12.0%; Screen Size: Screen 17/18 (AA); Defects: Max 1.5%; Ports: Mangalore, Cochin, Chennai;data:new','60kg Jute Bags with GrainPro liner','1x20ft FCL (~19.2 MT)','',9,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(10,1,'export','Robusta Green Coffee Beans','product-robusta','Heavy-Bodied Clean Indian Cherry & Parchment','World-renowned Indian Robusta coffee beans celebrated for exceptional body, thick crema, and smooth chocolate undertones.','assets/img/generated/product_robusta_coffee_1788780517644.jpg','assets/img/commodities/hero-coffee-plantation-banner.jpg','Robusta Cherry AB, Robusta Parchment AB, Peaberry (PB)','Antara Export Grade Lots','Origin: Coorg / Wayanad, India; Processing: Natural Sun-Dried / Washed; Moisture: <= 12.5%; Screen Size: 17/18; Ports: Cochin, Mangalore','60kg Jute Bags with GrainPro liner','1x20ft FCL (~19.2 MT)','Espresso Crema Optimization, Instant Coffee Extraction, Dark Roasts',10,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(11,1,'export','Indian Tea Export','product-tea','Bulk Orthodox Leaf & Strong Liquoring CTC','Direct-from-estate bulk tea shipments sourced from Assam and Nilgiri plantations, offering consistent cup character for international blenders.','assets/img/generated/product_tea_1788780744116.jpg','assets/img/commodities/hero-tea-gardens.jpg','Assam CTC (BOP, BP, OF), Nilgiri Orthodox Orange Pekoe, Green Tea','Origin Estate Harvests','Grades: BOP, BP, OF, TGFOP; Moisture: <= 6.5%; Origin: Assam & Nilgiris; Packaging: Multiwall paper sacks / wooden chests; Ports: Kolkata, Haldia, Cochin','25kg & 50kg Multi-Wall Paper Sacks with inner poly liner','5 Metric Tons','Commercial Tea Bagging, Ready-to-Drink Teas, Specialty Blends',11,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(12,1,'export','Whole Black Pepper','product-black-pepper','Malabar Garbled Black Peppercorns','Sourced from the spice heartland of Kerala, renowned globally for intense pungency, high piperine content, and bold berry density.','assets/img/generated/product_black_pepper_1788780607287.jpg','assets/img/commodities/hero-spices-export.jpg','Malabar Garbled (MG-1), Tellicherry Extra Bold (TGSEB)','Malabar Spice Trade Origin','Piperine: 5.5% - 7.0%; Moisture: <= 11.5%; Bulk Density: 550 - 580 g/L; Foreign Matter: <= 0.5%; Ports: Cochin Port, Tuticorin Port','25kg & 50kg Heavy Polypropylene Bags','5 Metric Tons','Spice Grinding, Meat Processing, Seasoning Blends, Oleoresin Extraction',12,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg'),(13,1,'export','Indian Turmeric','product-turmeric','High-Curcumin Alleppey & Nizamabad Fingers','Sun-cured golden turmeric fingers with deep orange-yellow pigmentation, rich essential oils, and high curcumin density.','assets/img/generated/product_turmeric_1788780652554.jpg','assets/img/commodities/hero-spices-export.jpg','Alleppey Finger Turmeric, Nizamabad Polished Fingers, Salem Grade','Deccan & Malabar Harvests','Curcumin Content: 3.5% - 5.5%; Moisture: <= 10.0%; Total Ash: <= 7.0%; Lead/Heavy Metals: Non-Detectable; Ports: Chennai, Nhava Sheva, Cochin','25kg & 50kg Jute / PP Woven Bags','5 Metric Tons','Curcumin Extraction, Food Seasoning, Health Supplements, Natural Dyeing',13,1,1,'2026-09-04 06:54:34','Batch Verified','Strict QA check on moisture, grading & packaging.','Dependable Logistics','Timely port freight & domestic dispatch.','Commercial Pricing','Competitive volume rates for long-term partners.','assets/img/icons/pillar-2-quality.svg','assets/img/icons/pillar-3-logistics.svg','assets/img/icons/partnership-trust.svg');
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_profile`
--

DROP TABLE IF EXISTS `tbl_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_profile` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_logo` varchar(255) NOT NULL DEFAULT 'antara-logo-white.svg',
  `pro_dark_logo` varchar(255) NOT NULL DEFAULT 'antara-logo-dark.svg',
  `pro_favicon` varchar(255) NOT NULL DEFAULT 'favicon.svg',
  `pro_title` text NOT NULL,
  `pro_keyword` text NOT NULL,
  `pro_detail` text NOT NULL,
  `pro_footer_desc` text DEFAULT NULL,
  `pro_copyright` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_profile`
--

LOCK TABLES `tbl_profile` WRITE;
/*!40000 ALTER TABLE `tbl_profile` DISABLE KEYS */;
INSERT INTO `tbl_profile` VALUES (1,'assets/img/logo/antara-logo-white.svg','assets/img/logo/antara-logo-dark.svg','uploads/logo/favicon_1788771254.png','Antara Globale | Indian Agricultural Commodity Exporter & HORECA Supplier','Indian agricultural exporter, coffee beans export, spices export, bulk tea, horeca supplies','Antara Globale is an Indian sourcing and trading company supplying premium food products and ingredients to global buyers and the hospitality industry.','Antara Globale is an Indian sourcing and trading company focused on supplying quality agricultural food products, green coffee beans, spices, and foodservice ingredients to international buyers and the hospitality industry.','Antara Globale. All Rights Reserved. Indian Agricultural Sourcing & Export Trading.');
/*!40000 ALTER TABLE `tbl_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_terroir_belts`
--

DROP TABLE IF EXISTS `tbl_terroir_belts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_terroir_belts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `badge` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `tags` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_terroir_belts`
--

LOCK TABLES `tbl_terroir_belts` WRITE;
/*!40000 ALTER TABLE `tbl_terroir_belts` DISABLE KEYS */;
INSERT INTO `tbl_terroir_belts` VALUES (1,'Southern Western Ghats','Coorg & Chikmagalur Highlands','High-altitude shade-grown Arabica & bold Robusta green coffee beans cultivated at 1,100m - 1,500m MSL under natural rainforest canopy.','Arabica AA / AB, Robusta AAA, Mangalore Port','uploads/home/terroir_1788785711_6215.jpg',1,1,'2026-09-07 06:06:09'),(2,'Eastern Himalayas','Assam & Darjeeling Valleys','Rich alluvial river plains and misty Himalayan foothills producing bold CTC teas and fragrant Orthodox black tea leaves.','Orthodox Leaf, CTC Grades, Kolkata Port','assets/img/commodities/hero-tea-gardens.jpg',2,1,'2026-09-07 06:06:09'),(3,'Kerala Spice Belt','Malabar Coast & Wayanad','The historic spice coast renowned worldwide for whole black pepper with high piperine content, pungent essential oils, and uniform bulk density.','Tellicherry Garbled, MG1 Grade, Cochin Port','assets/img/commodities/black-pepper.jpg',3,1,'2026-09-07 06:06:09'),(4,'Tamil Nadu Agro Belt','Erode & Salem Agricultural Belts','India\'s primary turmeric growing belt producing rich golden whole turmeric fingers and ground turmeric with high natural curcumin levels.','Whole Fingers, High Curcumin, Chennai / Tuticorin','assets/img/commodities/turmeric.jpg',4,1,'2026-09-07 06:06:09');
/*!40000 ALTER TABLE `tbl_terroir_belts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_testimonial`
--

DROP TABLE IF EXISTS `tbl_testimonial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_testimonial` (
  `tt_id` int(11) NOT NULL AUTO_INCREMENT,
  `tt_name` varchar(255) NOT NULL,
  `tt_location` varchar(255) NOT NULL,
  `tt_rating` int(1) NOT NULL DEFAULT 5,
  `tt_detail` text NOT NULL,
  `tt_image` varchar(255) NOT NULL,
  `tt_status` int(11) NOT NULL DEFAULT 1,
  `tt_sort` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_testimonial`
--

LOCK TABLES `tbl_testimonial` WRITE;
/*!40000 ALTER TABLE `tbl_testimonial` DISABLE KEYS */;
INSERT INTO `tbl_testimonial` VALUES (1,'Marcus Vance','Managing Director, Alpine Roastworks (Hamburg, Germany)',5,'Antara Globale provided exemplary transparency on green coffee lot consistency. Moisture levels matched our specifications exactly, and export documentation was seamless.','assets/img/testimonial/client-1.jpg',1,1),(2,'Tariq Al-Mansoor','Procurement Head, Gulf Hospitality & Spice Traders (Dubai, UAE)',5,'Our spice consignments of Malabar Black Pepper and Alleppey Turmeric arrived in pristine packaging. Consistent grading and direct communication make them a dependable sourcing partner.','assets/img/testimonial/client-2.jpg',1,2),(3,'Elena Rostova','Chief Sourcing Officer, Continental Specialty Foods (London, UK)',5,'Sourcing Indian orthodox teas through Antara Globale streamlined our procurement. Samples arrived promptly and the volume order matched the cupping evaluation flawlessly.','assets/img/testimonial/client-3.jpg',1,3);
/*!40000 ALTER TABLE `tbl_testimonial` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-08 11:52:26
