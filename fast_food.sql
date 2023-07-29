-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 15, 2023 at 03:57 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fast_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_to_cart`
--

DROP TABLE IF EXISTS `add_to_cart`;
CREATE TABLE IF NOT EXISTS `add_to_cart` (
  `add_to_cart_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `qty` int NOT NULL,
  `mobile_no` double NOT NULL,
  PRIMARY KEY (`add_to_cart_id`),
  KEY `mobile_no` (`mobile_no`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int NOT NULL,
  `area_name` varchar(1000) NOT NULL,
  `pincode` int NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `area_name`, `pincode`) VALUES
(1001, 'VESU', 395007),
(1002, 'PAL BHATHA', 394510),
(1003, 'PIPLOD', 394370),
(1004, 'RAMNAGAR', 395005),
(1005, 'PARVAT PATIYA', 395010),
(1006, 'NAVYUG COLLEGE', 395009),
(1007, 'BHAGAL', 395003),
(1008, 'ATHWALINES', 395001),
(1009, 'AMROLI', 394107),
(1010, 'KATARGAM', 395004),
(1011, 'MOTA VARACHHA', 394101),
(1012, 'RANDER', 395005),
(1013, 'UMRA', 395007),
(1014, 'sdfghjkl;', 395009);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `discount_id` int NOT NULL AUTO_INCREMENT,
  `discount_name` varchar(20) NOT NULL,
  `percentage` int NOT NULL,
  PRIMARY KEY (`discount_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_name`, `percentage`) VALUES
(1, 'ABC', 10),
(2, 'TASTYTRACK', 50),
(3, 'FLAT25', 25);

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `favorite_id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `mobile_no` double NOT NULL,
  PRIMARY KEY (`favorite_id`),
  KEY `item_id` (`item_id`),
  KEY `mobile_no` (`mobile_no`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`favorite_id`, `item_id`, `mobile_no`) VALUES
(103, 0, 9016787115),
(114, 14, 7263438493),
(115, 15, 7263438493),
(116, 2, 987654322),
(117, 6, 987654322),
(118, 12, 987654322),
(119, 35, 9016787115),
(120, 36, 9016787115),
(121, 40, 9016787115),
(123, 29, 9016787115),
(124, 34, 9016787115),
(125, 3, 9016787115),
(126, 19, 9016787115),
(127, 1, 9016787115);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `hotel_id` int NOT NULL,
  `hotel_name` varchar(1000) NOT NULL,
  `mobile_no` double NOT NULL,
  `area_id` int NOT NULL,
  `landmark_id` int NOT NULL,
  `package_id` int NOT NULL,
  `image` varchar(1000) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `map` varchar(1000) NOT NULL,
  `open_time` varchar(1000) NOT NULL,
  `open_days` varchar(1000) NOT NULL,
  `type` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'HOTEL',
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`hotel_id`),
  KEY `area_id` (`area_id`),
  KEY `landmark_id` (`landmark_id`),
  KEY `package_id` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `hotel_name`, `mobile_no`, `area_id`, `landmark_id`, `package_id`, `image`, `address`, `map`, `open_time`, `open_days`, `type`, `password`) VALUES
(301, 'MALHAR', 9978856759, 1005, 108, 204, 'registered_hotel/MALHAR', ' TAPI RIVER FRONT, RANDER.', 'registered_hotel/MALHAR-MAP.png.png', '10:00AM TO 11:30PM', 'MON-THU', 'HOTEL', 'malhar@123'),
(302, 'DEVILLA', 7802074000, 1002, 103, 201, 'registered_hotel/DEVILLA', 'RAJHANS MULTIPLEX ,PAL BHATHA ,SURAT', 'registered_hotel/DEVILLA.png', '06:00PM TO 10:00PM', 'MON-SUN', 'HOTEL', 'devilla@123'),
(303, 'BAY LEAF', 8140015000, 1002, 109, 203, 'registered_hotel/BAY LEAF.jpg', 'PAL BHATHA, RAJHANS MULTIPLEX,SURAT', 'registered_hotel/BAY LEAF.png', '10:00AM TO 12:00PM', 'MON-FRI', 'HOTEL', 'bayleaf@123'),
(304, 'RADHE KRISHNA', 8200443230, 1001, 101, 202, 'registered_hotel/RADHE KRISHNA.jpg', 'VNSGU UNIVERSITY, VESU, SURAT', 'registered_hotel/RADHE KRISHNA.png', '10:00AM TO 11:30PM', 'MON-SAT', 'HOTEL', 'radhekrishna@123'),
(305, 'GREEN SPICE', 7567563366, 1005, 108, 205, 'registered_hotel/GREEN SPICE.jpg', 'TAPI RIVER FRONT, PATVAT PATIYA, SURAT', 'registered_hotel/GREEN SPICE.png', '10:00AM TO 11:30PM', 'MON-THU', 'HOTEL', 'greenspice@123'),
(306, '3 SEVENTY', 8153000370, 1013, 107, 203, 'registered_hotel/3SEVENTY KITCHEN.jpg', 'AMBIKA NIKETAN TEMPLE,UMRA, SURAT', 'registered_hotel/3SEVENTY KITCHEN.png', '10:00AM TO 11:00PM', 'MON-SAT', 'HOTEL', '3seventy@123'),
(307, 'CHARCOAL DOSA', 9898853000, 1006, 106, 204, 'registered_hotel/CHARCOAL DOSA.jpg', 'SURAT CASTLE ,NAVYUG COLLEGE,SURAT', 'registered_hotel/CHARCOAL DOSA.png', '10:00AM TO 11:30PM', 'MON-SUN', 'HOTEL', 'charcoaldosa@123'),
(308, 'VANAKKAM', 9893845321, 1004, 103, 205, 'registered_hotel/VANAKKAM.jpg', 'BHOJAL RAM CHOWK, RAMNAGAR, SURAT', 'registered_hotel/VANAKKAM.png', '10:00AM TO 10:00PM', 'MON-FRI', 'HOTEL', 'vanakkam@123'),
(309, 'THE LIME TREE', 9328284025, 1003, 107, 203, 'registered_hotel/THE LIME TREE.jpg', 'AMBIKA NIKETAN TEMPLE,PIPLOD, SURAT', 'registered_hotel/THE LIME TREE.png', '10:00AM TO 11:00PM', 'MON-SUN', 'HOTEL', 'thelimetree@123'),
(310, 'WOK ON FIRE', 7874922522, 1003, 107, 203, 'registered_hotel/WOK ON FIRE.jpg', 'AMBIKA NIKETAN TEMPLE,PIPLOD, SURAT', 'registered_hotel/WOK ON FIRE.png', '10:00AM TO 12:00PM', 'MON-SUN', 'HOTEL', 'wokonfire@123');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int NOT NULL,
  `item_name` varchar(1000) NOT NULL,
  `hotel_id` int NOT NULL,
  `petasub_cat_id` int NOT NULL,
  `image` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `about` varchar(1000) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `petasub_cat_id` (`petasub_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `hotel_id`, `petasub_cat_id`, `image`, `price`, `about`) VALUES
(1, 'INSTANT RAVA DOSA', 301, 3037, 'registered_item/INSTANT RAVA DOSA.jpg', 250, 'This is our special instant rava dosa....'),
(2, 'POHA IDLLI', 301, 3071, 'registered_item/POHA IDLLI.jpg', 150, 'These is south indian special poha idli....'),
(3, 'MALHAR MASALA DOSA', 301, 3038, 'registered_item/MALHAR MASALA DOSA.jpg', 350, 'These is south indian special masala dosa....'),
(4, 'PLAIN DOSA', 301, 3041, 'registered_item/PLAIN DOSA.jpg', 200, 'These is south indian special plain dosa....'),
(5, 'RAVA IDLLI', 301, 3070, 'registered_item/RAVA IDLLI.jpg', 280, 'These is south indian special rava idli....'),
(6, 'OATS IDLLI', 301, 3068, 'registered_item/OATS IDLLI.jpg', 300, 'These is south indian special oats idli....'),
(7, 'RAVA UTTAPAM', 301, 3096, 'registered_item/RAVA UTTAPAM.jpg', 350, 'These is south indian special rava uttapam....'),
(8, 'MENDU VADA', 301, 3099, 'registered_item/MENDU VADA.jpg', 290, 'These is south indian special mendu vada....'),
(9, 'PALAK VADA', 301, 3100, 'registered_item/PALAK VADA.jpg', 330, 'This is south indian special palak vada.....'),
(10, 'PASTOR TACOS', 301, 3051, 'registered_item/PASTOR TACOS.jpg', 350, 'This is special pastor tacos.....'),
(11, 'CARNITAS TACOS', 301, 3049, 'registered_item/CARNITAS TACOS.jpg', 320, 'This is special carnitos tacos.....'),
(12, 'MAYONNAISE SANDWICH', 301, 3079, 'registered_item/MAYONNAISE SANDWICH.jpg', 320, 'This is our special mayonnaise sandwich.......'),
(13, 'VEGAN HOTDOGS', 301, 3062, 'registered_item/VEGAN HOTDOGS.jpg', 320, 'This is our special vegan hotdogs.....'),
(14, 'BURRITOS BOWL', 302, 3111, 'registered_item/BURRITOS BOWL.jpg', 550, 'This is our burritos special burritos bowl....'),
(15, 'GREEN CHILLY CHEESE HAMBURGER', 302, 3114, 'registered_item/GREEN CHILLY CHEESE HAMBURGER.jpg', 499, 'This is special hamburger....'),
(16, 'CHEESE HOTDOGS', 302, 3061, 'registered_item/CHEESE HOTDOGS.jpg', 280, 'This is our hotdogs special cheese hotdogs....'),
(17, 'CHILLY CHEESE TOAST', 302, 3077, 'registered_item/CHILLY CHEESE TOAST.jpg', 420, 'This is our special chilli cheese toast sandwich....'),
(18, 'SPINACH CORN SANDWICH', 302, 3080, 'registered_item/SPINACH CORN SANDWICH.jpg', 380, 'This is special spinach corn sandwich....'),
(19, 'GOBI MANCHURIAN', 302, 3008, 'registered_item/GOBI MANCHURIAN.jpg', 440, 'This is our manchurian special gobi manchurian....'),
(20, 'TAWA PANNER', 302, 3103, 'registered_item/TAWA PANNER.jpg', 380, 'This is special tawa panner....'),
(21, 'ACHARI PANNER', 302, 3101, 'registered_item/ACHARI PANNER.jpg', 450, 'This is our special achari panner....'),
(22, 'PANNER 65 FRY', 302, 3104, 'registered_item/PANNER 65 FRY.jpg', 520, 'This is our special panner 65 fry ......'),
(23, 'UTTAPAM PIZZA', 302, 3097, 'registered_item/UTTAPAM PIZZA.jpg', 340, 'This is our uttapam special uttapam pizza....'),
(24, 'JALFREZI PANNER', 303, 3102, 'registered_item/JALFREZI PANNER.jpg', 430, 'This is special jalfrezi panner.....'),
(25, 'RICE NOODLES', 303, 3012, 'registered_item/RICE NOODLES.jpg', 280, 'This is special rice noodles....'),
(26, 'VEG MANCHURIAN', 303, 3010, 'registered_item/VEG MANCHURIAN.jpg', 320, 'This is special veg manchurian....'),
(27, 'SOYA CHUNK MANCHURIAN', 303, 3009, 'registered_item/SOYA CHUNK MANCHURIAN.jpg', 330, 'This is our manchurian special soya chunk manchurian....'),
(28, 'LIGHTER FRIED RICE', 303, 3001, 'registered_item/LIGHTER FRIED RICE.jpg', 370, 'This is our fried rice special lighter fried rice ......'),
(29, 'CHEESE SPRING ROLL', 303, 3106, 'registered_item/CHEESE SPRING ROLL.jpg', 420, 'This is our chineese special cheese spring roll......'),
(30, 'CLASSIC BURRITOS', 304, 3112, 'registered_item/CLASSIC BURRITOS.jpg', 290, 'This is our burritos special classic burritos....'),
(31, 'CHEESE HOTDOGS', 304, 3061, 'registered_item/CHEESE HOTDOGS.jpg', 350, 'This is special cheese hotdogs....'),
(32, 'GRILLED SANDWICH', 304, 3078, 'registered_item/GRILLED SANDWICH.jpg', 320, 'This is special grilled sandwich......'),
(33, 'MASALA DOSA', 304, 3038, 'registered_item/MASALA DOSA.jpg', 340, 'This is our special masala dosa.....'),
(34, 'UTTAPAM PIZZA', 304, 3097, 'registered_item/UTTAPAM PIZZA.jpg', 290, 'This is our special uttapam pizza....'),
(35, 'MANGO SHERBET', 304, 3046, 'registered_item/MANGO SHERBET.jpg', 350, 'This is our special mango sherbet....'),
(36, 'BANANA CUSTARD', 304, 3072, 'registered_item/BANANA CUSTARD.jpg', 420, 'This is our special banana custard....'),
(37, 'FRENCH ICECREAM', 304, 3042, 'registered_item/FRENCH ICECREAM.jpg', 290, 'This is our icecream special french icecream....'),
(38, 'GELATO', 305, 3044, 'registered_item/GELATO.jpg', 430, 'This is our special icecream gelato....'),
(39, 'CHOCOLATE MUD CUPCAKE', 305, 3015, 'registered_item/CHOCOLATE MUD CUPCAKE.jpg', 390, 'This is our special chocolate mud cupcake....'),
(40, 'CHOCOLATE ICECREAM', 305, 3045, 'registered_item/CHOCOLATE ICECREAM.jpg', 210, 'This is special chocolate icecream....'),
(41, 'PEANUT BUTTER COOKIES', 305, 3020, 'registered_item/PEANUT BUTTER COOKIES.jpg', 220, 'This is our cookies special peanut butter cookies....'),
(42, 'GRILLED SANDWICH', 305, 3078, 'registered_item/GRILLED SANDWICH.jpg', 280, 'This is our special grilled sandwich....'),
(43, 'GREEN CHILLY CHEESE HAMBURGER', 305, 3114, 'registered_item/GREEN CHILLY CHEESE HAMBURGER.jpg', 320, 'This is our special green chilli cheese burger....'),
(44, 'PANNER BUTTER MASALA', 306, 3029, 'registered_item/PANNER BUTTER MASALA.jpg', 320, 'This is our special paneer butter masala....'),
(45, 'PUNJABI STYLE BOONDI KADHI', 306, 3026, 'registered_item/PUNJABI STYLE BOONDI KADHI.jpg', 320, 'This is our special punjabi style boondi kadhi....'),
(46, 'KULCHA NAAN', 306, 3065, 'registered_item/KULCHA NAAN.jpg', 390, 'This is our special kulcha naan....'),
(47, 'BEET ROOT PULAO', 306, 3082, 'registered_item/BEET ROOT PULAO.jpg', 340, 'This is our special beetroot pulao ....'),
(48, 'BEET ROOT PURI', 306, 3086, 'registered_item/BEET ROOT PURI.jpg', 150, 'This is our special beet root puri....'),
(49, 'CHOLA PURI', 306, 3087, 'registered_item/CHOLA PURI.jpg', 120, 'This is our special chola puri....'),
(50, 'BISCOTTI', 306, 3017, 'registered_item/BISCOTTI.jpg', 290, 'This is our special biscotti cookies....'),
(51, 'CHEESE CAKE', 306, 3076, 'registered_item/CHEESE CAKE.jpg', 360, 'This is our special cheese cake....'),
(52, 'PLAIN DOSA', 307, 3041, 'registered_item/PLAIN DOSA.jpg', 290, 'This is special plain dosa....'),
(53, 'MASALA DOSA', 307, 3038, 'registered_item/MASALA DOSA.jpg', 280, 'This is our special chilli masala dosa....'),
(54, 'INSTANT RAVA DOSA', 307, 3037, 'registered_item/INSTANT RAVA DOSA.jpg', 280, 'This is our special instant rava dosa....'),
(55, 'MOONG DAAL DOSA', 307, 3039, 'registered_item/MOONG DAAL DOSA.jpg', 310, 'This is our special moong dal dosa....'),
(56, 'NEER DOSA', 307, 3040, 'registered_item/NEER DOSA.jpg', 330, 'This is our dosa special neer dosa....'),
(57, 'GRILLED SANDWICH', 308, 3078, 'registered_item/GRILLED SANDWICH.jpg', 280, 'This is special grilled sandwich....'),
(58, 'CHILLY CHEESE TOAST', 308, 3077, 'registered_item/CHILLY CHEESE TOAST.jpg', 320, 'This is special chilly cheese toast....'),
(59, 'FLOURLESS ORANGE CAKE', 308, 3016, 'registered_item/FLOURLESS ORANGE CAKE.jpg', 320, 'This is our special flourless orange cake....'),
(60, 'BEAN PIE', 308, 3074, 'registered_item/BEAN PIE.jpg', 550, 'This is our special chilli beam pie....'),
(61, 'BUTTER MILK PIE', 308, 3075, 'registered_item/BUTTER MILK PIE.jpg', 340, 'This is our special butter milk pie....'),
(62, 'BANANA CUSTARD', 308, 3072, 'registered_item/BANANA CUSTARD.jpg', 490, 'This is our special banana custard....'),
(63, 'CHOWMEIN NOODLES', 309, 3011, 'registered_item/CHOWMEIN NOODLES.jpg', 300, 'This is our noodle special chowmein noodles....'),
(64, 'BABY CORN MANCHURIAN', 309, 3007, 'registered_item/BABY CORN MANCHURIAN.jpg', 350, 'This is our special baby corn manchurian....'),
(65, 'JALFREZI PANNER', 309, 3102, 'registered_item/JALFREZI PANNER.jpg', 320, 'This is our special jalfrezi panner....'),
(66, 'KOREAN BURRITOS', 309, 3113, 'registered_item/KOREAN BURRITOS.jpg', 320, 'This is our special korean burritos....'),
(67, 'FRENCH ICECREAM', 309, 3042, 'registered_item/FRENCH ICECREAM.jpg', 290, 'This is our special french icecream.....'),
(68, 'MAYONNAISE SANDWICH', 310, 3079, 'registered_item/MAYONNAISE SANDWICH.jpg', 210, 'This is our special mayonnaise sandwich....'),
(69, 'BREAK FAST BURRITOS', 310, 3110, 'registered_item/BREAK FAST BURRITOS.jpg', 290, 'This is our special breakfast burritos....'),
(70, 'WILD SALMON BURGER', 310, 3116, 'registered_item/WILD SALMON BURGER.jpg', 310, 'This is our special wild salmon hamburger....'),
(71, 'BARBOCOA TACOS', 310, 3047, 'registered_item/BARBOCOA TACOS.jpg', 210, 'This is our special barbocoa tacos....'),
(72, 'SUADERO TACOS', 310, 3050, 'registered_item/SUADERO TACOS.jpg', 320, 'This is our special suadero tacos....');

-- --------------------------------------------------------

--
-- Table structure for table `landmark`
--

DROP TABLE IF EXISTS `landmark`;
CREATE TABLE IF NOT EXISTS `landmark` (
  `landmark_id` int NOT NULL,
  `area_id` int NOT NULL,
  `landmark_name` varchar(1000) NOT NULL,
  PRIMARY KEY (`landmark_id`),
  KEY `area_id` (`area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `landmark`
--

INSERT INTO `landmark` (`landmark_id`, `area_id`, `landmark_name`) VALUES
(101, 1001, 'VNSGU UNIVERSITY\r\n'),
(102, 1001, 'SIDDHI VINAYAK TEMPLE'),
(103, 1011, 'BHOJAL RAM CHOWK'),
(104, 1010, 'DUTCH CEMETERY'),
(105, 1007, 'CHOWK BAZAR'),
(106, 1007, 'SURAT CASTLE'),
(107, 1008, 'AMBIKA NIKETAN TEMPLE'),
(108, 1005, 'TAPI RIVER FRONT'),
(109, 1002, 'RAJHANS MULTIPLEX');

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

DROP TABLE IF EXISTS `main_category`;
CREATE TABLE IF NOT EXISTS `main_category` (
  `main_cat_id` int NOT NULL,
  `main_cat_name` varchar(1000) NOT NULL,
  PRIMARY KEY (`main_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`main_cat_id`, `main_cat_name`) VALUES
(1001, 'CHINESE '),
(1002, 'SOUTH INDIAN'),
(1003, 'FAST FOOD'),
(1004, 'GUJARATI'),
(1005, 'STARTER'),
(1006, 'DESSERT'),
(1007, 'PUNJABI'),
(1008, 'MAIN COURSE');

-- --------------------------------------------------------

--
-- Table structure for table `main_category_assign`
--

DROP TABLE IF EXISTS `main_category_assign`;
CREATE TABLE IF NOT EXISTS `main_category_assign` (
  `main_cat_assign_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `main_cat_id` int NOT NULL,
  PRIMARY KEY (`main_cat_assign_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `main_cat_id` (`main_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_category_assign`
--

INSERT INTO `main_category_assign` (`main_cat_assign_id`, `hotel_id`, `main_cat_id`) VALUES
(1003, 309, 1003),
(1004, 309, 1006),
(1005, 309, 1001),
(1006, 302, 1005),
(1007, 302, 1003),
(1009, 302, 1001),
(1010, 302, 1006),
(1011, 303, 1001),
(1012, 303, 1007),
(1013, 303, 1008),
(1014, 303, 1005),
(1015, 304, 1003),
(1016, 304, 1002),
(1017, 304, 1006),
(1018, 305, 1003),
(1019, 305, 1006),
(1020, 306, 1005),
(1021, 306, 1008),
(1022, 306, 1006),
(1023, 307, 1002),
(1024, 308, 1003),
(1025, 308, 1006),
(1026, 310, 1003),
(1027, 301, 1003),
(1028, 301, 1002),
(1029, 301, 1004),
(1030, 301, 1006);

-- --------------------------------------------------------

--
-- Table structure for table `order_cart`
--

DROP TABLE IF EXISTS `order_cart`;
CREATE TABLE IF NOT EXISTS `order_cart` (
  `order_id` int NOT NULL,
  `order_cart_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `mobile_no` double NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL,
  `discount` varchar(1000) NOT NULL,
  `final_amount` float NOT NULL,
  `bill_amount` float NOT NULL,
  `order_date` date NOT NULL,
  `address` varchar(500) NOT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'PENDING',
  PRIMARY KEY (`order_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `mobile_no` (`mobile_no`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_cart`
--

INSERT INTO `order_cart` (`order_id`, `order_cart_id`, `hotel_id`, `mobile_no`, `item_id`, `quantity`, `price`, `discount`, `final_amount`, `bill_amount`, `order_date`, `address`, `status`) VALUES
(1, 1001, 301, 9016787115, 17, 1, 100, '20', 80, 80, '2023-06-05', 'B- 502 shankeshwara heights, pal surat', 'delivered'),
(2, 1001, 301, 9016787115, 1, 2, 200, '10', 360, 360, '2023-06-05', 'B-502 shankeshwara heights,pal,surat', 'delivered'),
(3, 1002, 301, 9016787115, 11, 2, 320, '64', 640, 576, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'delivered'),
(4, 1002, 301, 9016787115, 2, 2, 150, '30', 300, 270, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'pending'),
(5, 1002, 301, 9016787115, 7, 1, 350, '35', 350, 315, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(6, 1003, 301, 9016787115, 6, 3, 300, '90', 900, 810, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(7, 1003, 301, 9016787115, 10, 1, 350, '35', 350, 315, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(8, 1003, 302, 9016787115, 23, 2, 340, '68', 680, 612, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(9, 1004, 302, 9016787115, 19, 2, 440, '88', 880, 792, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(10, 1004, 302, 9016787115, 22, 1, 520, '52', 520, 468, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'delivered'),
(11, 1004, 308, 9016787115, 58, 3, 320, '96', 960, 864, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(12, 1004, 308, 9016787115, 62, 1, 490, '49', 490, 441, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(13, 1004, 304, 9016787115, 35, 6, 350, '210', 2100, 1890, '2023-06-14', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(18, 1006, 301, 9016787115, 3, 1, 350, '175', 350, 175, '2023-06-17', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(19, 1006, 302, 9016787115, 17, 2, 420, '420', 840, 420, '2023-06-17', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'delivered'),
(20, 1006, 302, 9016787115, 20, 1, 380, '190', 380, 190, '2023-06-17', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'delivered'),
(21, 1006, 307, 9016787115, 52, 2, 290, '290', 580, 290, '2023-06-17', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(22, 1007, 301, 9016787115, 7, 3, 350, '525', 1050, 525, '2023-06-17', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'pending'),
(23, 1008, 308, 9016787115, 62, 3, 490, '147', 1470, 1323, '2023-06-17', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(24, 1009, 305, 7263438493, 42, 1, 280, '140', 280, 140, '2023-06-17', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(25, 1009, 303, 7263438493, 26, 2, 320, '320', 640, 320, '2023-06-17', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(26, 1009, 305, 7263438493, 38, 1, 430, '215', 430, 215, '2023-06-17', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(28, 1011, 301, 9016787115, 2, 1, 150, '15', 150, 135, '2023-06-19', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(29, 1012, 301, 9016787115, 10, 1, 350, '35', 350, 315, '2023-06-20', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING'),
(30, 1012, 302, 9016787115, 22, 2, 520, '104', 1040, 936, '2023-06-20', '402 shilp Appartment ,Makanji Park,Adajan ,Surat', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
CREATE TABLE IF NOT EXISTS `package` (
  `package_id` int NOT NULL,
  `package_name` varchar(1000) NOT NULL,
  `duration` varchar(1000) NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`package_id`,`rate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `package_name`, `duration`, `rate`) VALUES
(201, 'PLATINUM', '12 MONTHS', 50000),
(202, 'DIAMOND', '9 MONTHS', 25000),
(203, 'GOLD', '6 MONTHS', 12500),
(204, 'SILVER', '3 MONTHS', 6250),
(205, 'BRONZE', '1 MONTH', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `package_bill`
--

DROP TABLE IF EXISTS `package_bill`;
CREATE TABLE IF NOT EXISTS `package_bill` (
  `package_bill_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `package_id` int NOT NULL,
  `bill_date` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`package_bill_id`),
  KEY `package_bill_ibfk_2` (`hotel_id`),
  KEY `composite_key` (`package_id`,`rate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_bill`
--

INSERT INTO `package_bill` (`package_bill_id`, `hotel_id`, `package_id`, `bill_date`, `start_date`, `end_date`, `rate`) VALUES
(101, 301, 204, '', '19-04-2023', '19-07-2023', 6250),
(102, 302, 201, '2023-06-20', '16/04/2023', '16/04/2024', 50000),
(103, 303, 203, '', '12/04/2023', '12/10/2023', 12500),
(104, 304, 202, '', '17/03/2023', '17/12/2023', 25000),
(105, 305, 205, '', '01/06/2023', '01/07/2023', 3000),
(106, 306, 203, '', '07/04/2023', '07/10/2023', 12500),
(107, 307, 204, '', '28/05/2023', '28/08/2023', 6250),
(108, 308, 205, '', '27/05/2023', '27/06/2023', 3000),
(109, 309, 203, '', '06/06/2023', '06/12/2023', 12500),
(110, 310, 203, '', '13/05/2023', '13/11/2023', 12500);

-- --------------------------------------------------------

--
-- Table structure for table `petasub_category`
--

DROP TABLE IF EXISTS `petasub_category`;
CREATE TABLE IF NOT EXISTS `petasub_category` (
  `petasub_cat_id` int NOT NULL,
  `sub_cat_id` int NOT NULL,
  `petasub_cat_name` varchar(1000) NOT NULL,
  PRIMARY KEY (`petasub_cat_id`),
  KEY `sub_cat_id` (`sub_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petasub_category`
--

INSERT INTO `petasub_category` (`petasub_cat_id`, `sub_cat_id`, `petasub_cat_name`) VALUES
(3001, 2009, 'LIGHTER FRIED RICE'),
(3002, 2009, 'PEANUT SAUCE FRIED RICE'),
(3003, 2009, 'PORK FRIED RICE'),
(3004, 2009, 'RAINBOW FRIED RICE'),
(3005, 2009, 'SOYA SAUCE FRIED RICE'),
(3006, 2009, 'SPICY VEGETABLE FRIED RICE'),
(3007, 2008, 'BABY CORN MANCHURIYAN'),
(3008, 2008, 'GOBI MANCHURIYAN'),
(3009, 2008, 'SOYA CHUNK MANCHURIYAN'),
(3010, 2008, 'VEG MANCHURIYAN'),
(3011, 2006, 'CHOWMEIN NOODLES'),
(3012, 2006, 'RICE NOODLES'),
(3013, 2006, 'SOMEN NOODLES'),
(3014, 2022, 'CHOCOLATE COCONUT CAKE'),
(3015, 2022, 'CHOCOLATE MUD CUPCAKE'),
(3016, 2022, 'FLOURLESS ORANGE CAKE'),
(3017, 2023, 'BISCOTTI'),
(3018, 2023, 'BUTTER COOKIES'),
(3019, 2023, 'CHOCOLATE CHIPS COOKIES'),
(3020, 2023, 'PEANUT BUTTER COOKIES'),
(3021, 2023, 'SHORT BREAD COOKIES'),
(3022, 2023, 'WHOOPIE PIES'),
(3023, 2027, 'KARELA KADHI'),
(3024, 2027, 'MAHARASHTRIAN KADHI'),
(3025, 2027, 'PALAK KADHI'),
(3026, 2027, 'PUNJABI STYLE BOONDI KADHI'),
(3027, 2028, 'DAL PALAK'),
(3028, 2028, 'PANEER BHURJI'),
(3029, 2028, 'PANEER BUTTER MASALA'),
(3030, 2028, 'PANEER TIKKA MASALA'),
(3031, 2034, 'ATE DA HALWA'),
(3032, 2034, 'BESANKI BARFI'),
(3033, 2034, 'KHEER'),
(3034, 2034, 'LAUKI HALWA'),
(3035, 2034, 'MEETHA PUDA'),
(3036, 2034, 'PANJIRI'),
(3037, 2001, 'INSTANT RAVA DOSA'),
(3038, 2001, 'MASALA DOSA'),
(3039, 2001, 'MOONG DAAL DOSA'),
(3040, 2001, 'NEER DOSA'),
(3041, 2001, 'PLAIN DOSA'),
(3042, 2025, 'FRENCH ICECREAM'),
(3043, 2025, 'FROZEN YOGURT'),
(3044, 2025, 'GELATO'),
(3045, 2025, 'CHOCOLATE ICECREAM'),
(3046, 2025, 'MANGO SHERBET'),
(3047, 2015, 'BARBOCOA TACOS'),
(3048, 2015, 'BIRRIA TACOS'),
(3049, 2015, 'CARNITAS TACOS'),
(3050, 2015, 'SUADERO TACOS'),
(3051, 2015, 'PASTOR TACOS'),
(3052, 2020, 'MASALA KHICHDI'),
(3053, 2020, 'MOONG DAL KHICHDI'),
(3054, 2020, 'OATS KHICHDI'),
(3055, 2020, 'SABUDANA KHICHDI'),
(3056, 2032, 'CHANA MASALA'),
(3057, 2032, 'DAL MAKHANI'),
(3058, 2032, 'MALAI KOFTA'),
(3059, 2032, 'PALAK PANNER'),
(3060, 2032, 'PANEER BUTTER MASALA'),
(3061, 2013, 'CHEESE HOTDOGS'),
(3062, 2013, 'VEGAN HOTDOGS'),
(3063, 2029, 'BUTTER NAAN'),
(3064, 2029, 'KEEMA NAAN'),
(3065, 2029, 'KULCHA NAAN'),
(3066, 2029, 'PESHWARI NAAN'),
(3067, 2002, 'CUCUMBER IDLIES'),
(3068, 2002, 'OATS IDLIES'),
(3069, 2002, 'RAGI IDLIES'),
(3070, 2002, 'RAVA IDLIES'),
(3071, 2002, 'POHA IDLIES'),
(3072, 2024, 'BANANA CUSTARD'),
(3073, 2024, 'BANANA PUDDING'),
(3074, 2024, 'BEAN PIE'),
(3075, 2024, 'BUTTER MILK PIE'),
(3076, 2024, 'CHEESE CAKE'),
(3077, 2014, 'CHILLI CHEESE TOAST'),
(3078, 2014, 'GRILLED SANDWICH'),
(3079, 2014, 'MAYONNAISE SANDWICH'),
(3080, 2014, 'SPINACH CORN SANDWICH'),
(3081, 2030, 'PALAK PULAO'),
(3082, 2030, 'BEET ROOT PULAO'),
(3083, 2030, 'CABBAGE PULAO'),
(3084, 2030, 'KARNATAKA STYLE VEGETABLE PULAO'),
(3085, 2030, 'KASHMIRI PULAO'),
(3086, 2031, 'BEETROOT PURI'),
(3087, 2031, 'CHOLA PURI'),
(3088, 2031, 'PUFFY PURI'),
(3089, 2031, 'RAGI PURI'),
(3090, 2033, 'AKKI ROTI'),
(3091, 2033, 'CHAPATI'),
(3092, 2033, 'MAKI KI ROTI'),
(3093, 2033, 'PARATHA'),
(3094, 2033, 'THALIPEETH ROTI'),
(3095, 2003, 'BREAD UTTAPAM'),
(3096, 2003, 'RAVA UTTAPAM'),
(3097, 2003, 'UTTAPAM PIZZA'),
(3098, 2004, 'MADDHUR VADA'),
(3099, 2004, 'MEDUVADA'),
(3100, 2004, 'PALAK VADA'),
(3101, 2005, 'ACHARI PANNER'),
(3102, 2005, 'JALFREZI PANNER'),
(3103, 2005, 'TAWA PANNER'),
(3104, 2005, 'PANNER 65 FRY'),
(3105, 2007, 'HONEY CHILLI POTATO'),
(3106, 2010, 'CHEESE SPRING ROLL'),
(3107, 2010, 'PANNER SPRING ROLL'),
(3108, 2010, 'CHEESE PANNER SPRING ROLL'),
(3109, 2010, 'VEGETABLE SPRING ROLL'),
(3110, 2011, 'BREAK FAST BURRITOS'),
(3111, 2011, 'BURRITOS BOWL'),
(3112, 2011, 'CLASSIC BURRITOS'),
(3113, 2011, 'KOREAN BURRITOS'),
(3114, 2012, 'GREEN CHILLY CHEESE HAMBURGER'),
(3115, 2012, 'STEAMED CHEESE BURGER'),
(3116, 2012, 'WILD SALMON BURGER'),
(3117, 2016, 'KHOYA JALEBI WITH FAFDA'),
(3118, 2016, 'ORIGINAL JALEBI AND FAFDA'),
(3119, 2016, 'PANNER JALEBI AND FAFDA');

-- --------------------------------------------------------

--
-- Table structure for table `petasub_category_assign`
--

DROP TABLE IF EXISTS `petasub_category_assign`;
CREATE TABLE IF NOT EXISTS `petasub_category_assign` (
  `petasub_cat_assign_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `petasub_cat_id` int NOT NULL,
  PRIMARY KEY (`petasub_cat_assign_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `petasub_cat_id` (`petasub_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petasub_category_assign`
--

INSERT INTO `petasub_category_assign` (`petasub_cat_assign_id`, `hotel_id`, `petasub_cat_id`) VALUES
(3002, 301, 3070),
(3003, 301, 3071),
(3004, 301, 3041),
(3005, 301, 3068),
(3006, 301, 3096),
(3007, 301, 3067),
(3008, 302, 3111),
(3009, 302, 3114),
(3010, 302, 3061),
(3011, 302, 3077),
(3012, 302, 3080),
(3013, 302, 3008),
(3014, 302, 3103),
(3015, 302, 3101),
(3016, 302, 3104),
(3017, 302, 3097),
(3018, 302, 3010),
(3019, 302, 3041),
(3020, 302, 3011),
(3021, 302, 3019),
(3022, 302, 3105),
(3023, 302, 3043),
(3024, 302, 3014),
(3025, 302, 3044),
(3026, 302, 3022),
(3027, 301, 3037),
(3028, 301, 3079),
(3029, 301, 3078),
(3030, 301, 3110),
(3031, 301, 3039),
(3032, 301, 3077),
(3033, 303, 3102),
(3034, 303, 3012),
(3035, 303, 3010),
(3036, 303, 3009),
(3037, 303, 3001),
(3038, 303, 3103),
(3039, 303, 3106),
(3040, 303, 3108),
(3041, 303, 3058),
(3042, 303, 3060),
(3043, 303, 3091),
(3044, 303, 3092),
(3045, 303, 3093),
(3046, 303, 3028),
(3047, 303, 3029),
(3048, 303, 3030),
(3049, 303, 3063),
(3050, 303, 3065),
(3051, 303, 3083),
(3052, 303, 3085),
(3053, 304, 3112),
(3054, 304, 3061),
(3055, 304, 3062),
(3056, 304, 3078),
(3057, 304, 3077),
(3058, 304, 3038),
(3059, 304, 3049),
(3060, 304, 3097),
(3061, 304, 3045),
(3062, 304, 3046),
(3063, 304, 3072),
(3064, 304, 3042),
(3065, 305, 3044),
(3066, 305, 3015),
(3067, 305, 3045),
(3068, 305, 3020),
(3069, 305, 3078),
(3070, 305, 3114),
(3071, 306, 3029),
(3072, 306, 3026),
(3073, 306, 3065),
(3074, 306, 3082),
(3075, 306, 3086),
(3076, 306, 3087),
(3077, 306, 3017),
(3078, 306, 3076),
(3079, 307, 3041),
(3080, 307, 3038),
(3081, 307, 3037),
(3082, 307, 3039),
(3083, 307, 3040),
(3084, 308, 3078),
(3085, 308, 3077),
(3086, 308, 3051),
(3087, 308, 3016),
(3088, 308, 3074),
(3089, 308, 3075),
(3090, 308, 3072),
(3091, 309, 3011),
(3092, 309, 3007),
(3093, 309, 3102),
(3094, 309, 3113),
(3095, 309, 3042),
(3096, 310, 3079),
(3097, 310, 3110),
(3098, 310, 3116),
(3099, 310, 3047),
(3100, 310, 3050),
(3101, 301, 3038),
(3102, 301, 3069);

-- --------------------------------------------------------

--
-- Table structure for table `rate_hotel`
--

DROP TABLE IF EXISTS `rate_hotel`;
CREATE TABLE IF NOT EXISTS `rate_hotel` (
  `rate_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `mobile_no` double NOT NULL,
  `rating` varchar(1000) NOT NULL,
  `feedback` varchar(100) NOT NULL,
  PRIMARY KEY (`rate_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `mobile_no` (`mobile_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate_hotel`
--

INSERT INTO `rate_hotel` (`rate_id`, `hotel_id`, `mobile_no`, `rating`, `feedback`) VALUES
(101, 301, 7359014990, 'Excellent', 'NICE FOOD...'),
(102, 301, 9016787115, 'GOOD', 'NICE FOOD...'),
(103, 304, 9016787115, 'GOOD', 'HELLO'),
(104, 304, 9016787115, 'GOOD', 'addf'),
(105, 301, 7359014990, 'EXCELLENT', 'NICE ONE......'),
(106, 304, 7359014990, 'EXCELLENT', 'NICE FOOD !!!!.............'),
(107, 304, 7359014990, 'EXCELLENT', ''),
(108, 301, 9016787115, 'GOOD', 'good'),
(109, 303, 9016787115, 'EXCELLENT', 'ewertyuio');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `sub_cat_id` int NOT NULL,
  `main_cat_id` int NOT NULL,
  `sub_cat_name` varchar(1000) NOT NULL,
  PRIMARY KEY (`sub_cat_id`),
  KEY `main_cat_id` (`main_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_cat_id`, `main_cat_id`, `sub_cat_name`) VALUES
(2001, 1002, 'DOSA'),
(2002, 1002, 'IDLI'),
(2003, 1002, 'UTTAPAM'),
(2004, 1002, 'VADA'),
(2005, 1001, 'CHILLI PANNER'),
(2006, 1001, 'NOODLES'),
(2007, 1001, 'HOT AND CHILLY POTATO'),
(2008, 1001, 'MANCHURIYAN'),
(2009, 1001, 'FRIED RICE'),
(2010, 1001, 'CHINESE_SPRING ROLL'),
(2011, 1003, 'BURRITOS'),
(2012, 1003, 'HAMBURGER'),
(2013, 1003, 'HOTDOG'),
(2014, 1003, 'SANDWICH'),
(2015, 1003, 'TACOS'),
(2016, 1004, 'FAFDA JALEBI'),
(2017, 1004, 'HANDVO'),
(2018, 1004, 'KHAMAN DHOKALA'),
(2019, 1004, 'KHANDVI'),
(2020, 1004, 'KHICHDI'),
(2021, 1006, 'BISCUITS'),
(2022, 1006, 'CAKES'),
(2023, 1006, 'COOKIES'),
(2024, 1006, 'CUSTARDS PUDDINGS'),
(2025, 1006, 'FROZEN'),
(2026, 1006, 'PASTRIES'),
(2027, 1008, 'KADHI'),
(2028, 1008, 'MAINCOURSE_SABJI'),
(2029, 1008, 'NAAN'),
(2030, 1008, 'PULAO'),
(2031, 1008, 'PURI'),
(2032, 1007, 'PUNJABI_SABJI'),
(2033, 1007, 'ROTI'),
(2034, 1007, 'SWEET'),
(2035, 1007, 'PUNJABI STARTER'),
(2036, 1005, 'BATATA VADA'),
(2037, 1005, 'PANEER TIKKA'),
(2038, 1005, 'SAMOSA CHAAT');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_assign`
--

DROP TABLE IF EXISTS `sub_category_assign`;
CREATE TABLE IF NOT EXISTS `sub_category_assign` (
  `sub_cat_assign_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `sub_cat_id` int NOT NULL,
  PRIMARY KEY (`sub_cat_assign_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `sub_cat_id` (`sub_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category_assign`
--

INSERT INTO `sub_category_assign` (`sub_cat_assign_id`, `hotel_id`, `sub_cat_id`) VALUES
(2001, 301, 2001),
(2002, 301, 2003),
(2004, 301, 2014),
(2005, 301, 2011),
(2006, 309, 2011),
(2007, 309, 2014),
(2008, 309, 2013),
(2009, 309, 2022),
(2010, 309, 2025),
(2011, 309, 2006),
(2012, 309, 2008),
(2013, 302, 2005),
(2014, 302, 2014),
(2015, 302, 2006),
(2016, 302, 2007),
(2017, 302, 2009),
(2018, 302, 2008),
(2019, 309, 2005),
(2020, 302, 2024),
(2021, 302, 2023),
(2022, 302, 2026),
(2023, 302, 2037),
(2024, 302, 2010),
(2025, 302, 2015),
(2026, 303, 2005),
(2027, 303, 2008),
(2028, 303, 2010),
(2029, 303, 2032),
(2030, 303, 2033),
(2031, 303, 2028),
(2032, 303, 2037),
(2033, 303, 2029),
(2034, 303, 2030),
(2035, 303, 2038),
(2036, 304, 2001),
(2037, 304, 2002),
(2038, 304, 2003),
(2039, 304, 2014),
(2040, 304, 2013),
(2041, 304, 2025),
(2042, 305, 2013),
(2043, 305, 2014),
(2044, 305, 2015),
(2045, 305, 2022),
(2046, 305, 2026),
(2047, 306, 2026),
(2048, 306, 2023),
(2049, 306, 2038),
(2050, 306, 2029),
(2051, 306, 2028),
(2052, 306, 2030),
(2053, 306, 2027),
(2054, 306, 2024),
(2055, 307, 2001),
(2056, 308, 2014),
(2057, 308, 2013),
(2058, 308, 2015),
(2059, 308, 2021),
(2060, 308, 2022),
(2061, 308, 2026),
(2062, 308, 2024),
(2063, 310, 2014),
(2064, 310, 2011),
(2065, 310, 2012),
(2066, 310, 2013),
(2067, 310, 2015),
(2068, 301, 2002),
(2069, 301, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `mobile_no` double NOT NULL,
  `fname` varchar(1000) NOT NULL,
  `lname` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `type` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'USER',
  PRIMARY KEY (`mobile_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`mobile_no`, `fname`, `lname`, `email`, `password`, `gender`, `type`) VALUES
(7263438493, 'KHUSHBU', 'VARAIYA', 'khushbu@gmail.com', 'khushbu@123', 'FEMALE', 'USER'),
(7359014990, 'KHUSHI', 'VARAIYA', 'khushivaraiya2734@gmail.com', 'abc@123', 'FEMALE', 'ADMIN'),
(7621880953, 'KHUSHI', 'PATELs', 'khushi@gmail.com', 'khushi@123', 'FEMALE', 'ADMIN'),
(9016787115, 'FALGUNI', 'VARAIYA', 'falguni@gmail.com', 'falguni@123', 'FEMALE', 'USER'),
(9327088021, 'HASTI', 'KATRODIYA', 'hasti@gmail.com', 'hasti@123', 'FEMALE', 'ADMIN'),
(9429150548, 'SAKSHI', 'VARAIYA', 'sakshi@gmail.com', 'sakshi@123', 'FEMALE', 'USER'),
(9787756578, 'ABC', 'XYZ', 'KHUSHI@GMAIL.COM', 'khushi@123', 'FEMALE', 'USER'),
(9874839747, 'DHRUV ', 'VARAIYA', 'dhruv@gmail.com', 'dhruv@123', 'MALE', 'USER'),
(9925199358, 'NENSHI', 'VIRADIYA', 'nenshi@gmail.com', 'nenshi@123', 'FEMALE', 'USER');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hotel_ibfk_2` FOREIGN KEY (`landmark_id`) REFERENCES `landmark` (`landmark_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hotel_ibfk_3` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`petasub_cat_id`) REFERENCES `petasub_category` (`petasub_cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `landmark`
--
ALTER TABLE `landmark`
  ADD CONSTRAINT `landmark_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `main_category_assign`
--
ALTER TABLE `main_category_assign`
  ADD CONSTRAINT `main_category_assign_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `main_category_assign_ibfk_2` FOREIGN KEY (`main_cat_id`) REFERENCES `main_category` (`main_cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_cart`
--
ALTER TABLE `order_cart`
  ADD CONSTRAINT `order_cart_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_cart_ibfk_2` FOREIGN KEY (`mobile_no`) REFERENCES `user` (`mobile_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_cart_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_bill`
--
ALTER TABLE `package_bill`
  ADD CONSTRAINT `composite_key` FOREIGN KEY (`package_id`,`rate`) REFERENCES `package` (`package_id`, `rate`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_bill_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petasub_category`
--
ALTER TABLE `petasub_category`
  ADD CONSTRAINT `petasub_category_ibfk_1` FOREIGN KEY (`sub_cat_id`) REFERENCES `sub_category` (`sub_cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petasub_category_assign`
--
ALTER TABLE `petasub_category_assign`
  ADD CONSTRAINT `petasub_category_assign_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `petasub_category_assign_ibfk_2` FOREIGN KEY (`petasub_cat_id`) REFERENCES `petasub_category` (`petasub_cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate_hotel`
--
ALTER TABLE `rate_hotel`
  ADD CONSTRAINT `rate_hotel_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_hotel_ibfk_2` FOREIGN KEY (`mobile_no`) REFERENCES `user` (`mobile_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`main_cat_id`) REFERENCES `main_category` (`main_cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_category_assign`
--
ALTER TABLE `sub_category_assign`
  ADD CONSTRAINT `sub_category_assign_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_category_assign_ibfk_2` FOREIGN KEY (`sub_cat_id`) REFERENCES `sub_category` (`sub_cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
