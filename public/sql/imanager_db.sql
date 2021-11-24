-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 20, 2021 at 12:50 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imanager_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL,
  `catalog_symbol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_on`, `created_by`, `catalog_symbol`) VALUES
(1, 'AACE Foods', '2021-09-17', 8, 'AAC'),
(2, 'Aani', '2021-09-17', 8, 'AAN'),
(3, 'Airwick', '2021-09-17', 8, 'AWK'),
(4, 'Amarula', '2021-09-17', 8, 'AMA'),
(5, 'Amel Susan', '2021-09-17', 8, 'AME'),
(6, 'Amoy', '2021-09-17', 8, 'AMY'),
(7, 'Amstel', '2021-09-17', 8, 'AMS'),
(8, 'Angostura', '2021-09-17', 8, 'ANG'),
(9, 'As E Dey Hot', '2021-09-17', 8, 'AED'),
(10, 'Ayoola Foods', '2021-09-17', 8, 'AYF'),
(11, 'Bacardi', '2021-09-17', 8, 'BAC'),
(12, 'Baileys', '2021-09-17', 8, 'BAI'),
(13, 'Bama', '2021-09-17', 8, 'BAM'),
(21, 'Berol', '2021-09-17', 8, 'BER'),
(22, 'Black & White', '2021-09-17', 8, 'BAW'),
(23, 'Bon voyage', '2021-09-17', 8, 'BVY'),
(24, 'Bonita', '2021-09-17', 8, 'BON'),
(25, 'Budweiser', '2021-09-17', 8, 'BUD'),
(26, 'Bullet', '2021-09-17', 8, 'BUL'),
(27, 'Buywholefoodsonline.co.uk', '2021-09-17', 8, 'BWF'),
(28, 'Campari', '2021-09-17', 8, 'CMP'),
(29, 'Captain morgan', '2021-09-17', 8, 'CPM'),
(30, 'Certex', '2021-09-17', 8, 'CTX'),
(31, 'Checkers', '2021-09-17', 8, 'CHK'),
(32, 'Chivita', '2021-09-17', 8, 'CHV'),
(33, 'Clearasil', '2021-09-17', 8, 'CLR'),
(34, 'Coke', '2021-09-17', 8, 'COK'),
(35, 'Deep Action', '2021-09-17', 8, 'DEA'),
(36, 'Dettol', '2021-09-17', 8, 'DET'),
(37, 'Donfelder', '2021-09-17', 8, 'DFL'),
(38, 'Drostdy hof', '2021-09-17', 8, 'DDH'),
(39, 'Dubic', '2021-09-17', 8, 'DUB'),
(40, 'Eva', '2021-09-17', 8, 'EVA'),
(41, 'Exeter', '2021-09-17', 8, 'EXT'),
(42, 'Fanta', '2021-09-17', 8, 'FTA'),
(43, 'Faultless', '2021-09-17', 8, 'FAU'),
(44, 'Flirt', '2021-09-17', 8, 'FLR'),
(45, 'GBC', '2021-09-17', 8, 'GBC'),
(46, 'Generic', '2021-09-17', 8, 'GEN'),
(47, 'Gino', '2021-09-17', 8, 'GNO'),
(48, 'GMCE', '2021-09-17', 8, 'GMC'),
(49, 'Goldberg', '2021-09-17', 8, 'GBG'),
(50, 'Gordon', '2021-09-17', 8, 'GDN'),
(51, 'Grenadine', '2021-09-17', 8, 'GRN'),
(52, 'Guiness', '2021-09-17', 8, 'GUN'),
(53, 'Gulder', '2021-09-17', 8, 'GUL'),
(54, 'Hamish Robertson & Co.', '2021-09-17', 8, 'HAM'),
(55, 'Harp', '2021-09-17', 8, 'HAR'),
(56, 'Harpic', '2021-09-17', 8, 'HRP'),
(57, 'Heineken', '2021-09-17', 8, 'HEI'),
(58, 'Heinz', '2021-09-17', 8, 'HEI'),
(59, 'Henessy', '2021-09-17', 8, 'HEN'),
(60, 'Henessy (VSOP)', '2021-09-17', 8, 'HNV'),
(61, 'Hollandia', '2021-09-17', 8, 'HOL'),
(62, 'Honeywell', '2021-09-17', 8, 'HNY'),
(63, 'Hunter\'s', '2021-09-17', 8, 'HUN'),
(64, 'Hypo', '2021-09-17', 8, 'HYP'),
(65, 'Indomie', '2021-09-17', 8, 'IND'),
(66, 'Izal', '2021-09-17', 8, 'IZL'),
(67, 'Jameson', '2021-09-17', 8, 'JMS'),
(68, 'Jim Beam', '2021-09-17', 8, 'JMB'),
(69, 'Jollofe', '2021-09-17', 8, 'JLF'),
(70, 'Kelloggs', '2021-09-17', 8, 'KLG'),
(71, 'Knorr', '2021-09-17', 8, 'KNR'),
(72, 'Kolaq Alagbo', '2021-09-17', 8, 'KAG'),
(73, 'Ktc', '2021-09-17', 8, 'KTC'),
(74, 'Lasena', '2021-09-17', 8, 'LAS'),
(75, 'Legend', '2021-09-17', 8, 'LEG'),
(76, 'Lipton', '2021-09-17', 8, 'LIP'),
(77, 'Magic Time', '2021-09-17', 8, 'MGT'),
(78, 'Mama Gold', '2021-09-17', 8, 'MMG'),
(79, 'Mama Lemon', '2021-09-17', 8, 'MML'),
(80, 'Masego Hills Farm', '2021-09-17', 8, 'MHF'),
(81, 'Milo', '2021-09-17', 8, 'MLO'),
(82, 'Monster', '2021-09-17', 8, 'MNS'),
(83, 'Morning Fresh', '2021-09-17', 8, 'MFR'),
(84, 'Mortein', '2021-09-17', 8, 'MRT'),
(85, 'Natco', '2021-09-17', 8, 'NAT'),
(86, 'Nederburg Cabernet Sauvignon', '2021-09-17', 8, 'NBG'),
(87, 'Nederburg Chardonnay', '2021-09-17', 8, 'NBC'),
(88, 'Nederburg Merlot', '2021-09-17', 8, 'NBM'),
(89, 'Nederburg Pinotage', '2021-09-17', 8, 'NBP'),
(90, 'Nederburg Rose', '2021-09-17', 8, 'NBR'),
(91, 'Nederburg Sauvignon Blanc', '2021-09-17', 8, 'NSB'),
(92, 'Nederburg Shiraz', '2021-09-17', 8, 'NSH'),
(93, 'Nescafe', '2021-09-17', 8, 'NSC'),
(94, 'Nestle', '2021-09-17', 8, 'NSL'),
(95, 'Nivea', '2021-09-17', 8, 'NIV'),
(96, 'Noble CRU', '2021-09-17', 8, 'NCR'),
(97, 'Olu Olu', '2021-09-17', 8, 'OLU'),
(98, 'Ore', '2021-09-17', 8, 'ORE'),
(99, 'Origin', '2021-09-17', 8, 'ORI'),
(100, 'Paul Masson', '2021-09-17', 8, 'PMS'),
(101, 'Peak', '2021-09-17', 8, 'PEA'),
(102, 'Powerhorse', '2021-09-17', 8, 'PWH'),
(103, 'Pride of Kings', '2021-09-17', 8, 'POK'),
(104, 'Quaker', '2021-09-17', 8, 'QKR'),
(105, 'Realemon 100%', '2021-09-17', 8, 'RLM'),
(106, 'Red Bull', '2021-09-17', 8, 'RBL'),
(107, 'Red Label', '2021-09-17', 8, 'RLB'),
(108, 'Rose', '2021-09-17', 8, 'RSE'),
(109, 'Savannah Dry', '2021-09-17', 8, 'SVD'),
(110, 'Schweppes', '2021-09-17', 8, 'SWP'),
(111, 'Seaman\'s', '2021-09-17', 8, 'SEA'),
(112, 'Secret Love', '2021-09-17', 8, 'SLV'),
(113, 'Sierra Tequila', '2021-09-17', 8, 'STQ'),
(114, 'Smirnoff ice', '2021-09-17', 8, 'SMI'),
(115, 'Spice Supreme', '2021-09-17', 8, 'SSM'),
(116, 'Spring Fresh', '2021-09-17', 8, 'SFR'),
(117, 'Sprite', '2021-09-17', 8, 'SPR'),
(118, 'St Louis', '2021-09-17', 8, 'STL'),
(119, 'Star Lager', '2021-09-17', 8, 'SLG'),
(120, 'Star radler', '2021-09-17', 8, 'SRD'),
(121, 'Sunlight', '2021-09-17', 8, 'SUN'),
(122, 'Sunripe', '2021-09-17', 8, 'SNR'),
(123, 'Swiss', '2021-09-17', 8, 'SWS'),
(124, 'Tabby', '2021-09-17', 8, 'TAB'),
(125, 'Tequila Blanco', '2021-09-17', 8, 'TQB'),
(126, 'Tequila gold', '2021-09-17', 8, 'TQG'),
(127, 'Three Barrel VSOP', '2021-09-17', 8, 'TBV'),
(128, 'Trophy', '2021-09-17', 8, 'TPY'),
(129, 'Trs', '2021-09-17', 8, 'TRS'),
(130, 'Valdivieso', '2021-09-17', 8, 'VLV'),
(131, 'Williams lawson', '2021-09-17', 8, 'WLW'),
(132, 'Wind', '2021-09-17', 8, 'WND'),
(133, 'Windolene', '2021-09-17', 8, 'WDL'),
(134, 'Wing Yip', '2021-09-17', 8, 'WYP'),
(135, 'Unknown Brand', '2021-11-17', 8, 'UKN');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `abbrv` varchar(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `cat_image` varchar(40) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL,
  `catalog_symbol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `abbrv`, `parent_id`, `description`, `cat_image`, `created_on`, `created_by`, `catalog_symbol`) VALUES
(3, 'Adhesives and Sealants', 'ADHSL', NULL, '', '', '2021-09-17', 8, 'AS'),
(4, 'Air Freshener', 'AFRSH', NULL, '', '', '2021-09-17', 8, 'AF'),
(5, 'Alcoholic Drinks', 'ALCOH', NULL, '', '', '2021-09-17', 8, 'AD'),
(6, 'Breakfast and Cereals', 'BCERL', NULL, '', '', '2021-09-17', 8, 'BC'),
(7, 'Cleaning Liquids and Sprays', 'CLNLQ', NULL, '', '', '2021-09-17', 8, 'CL'),
(8, 'Cleaning Utilities', 'CLNUT', NULL, '', '', '2021-09-17', 8, 'CU'),
(9, 'Cooking and Table Oils', 'OILCK', NULL, '', '', '2021-09-17', 8, 'CK'),
(10, 'Energy Drinks', 'EDRNK', NULL, '', '', '2021-09-17', 8, 'ED'),
(11, 'Flour, Meals and Grains', 'FMGRN', NULL, '', '', '2021-09-17', 8, 'FM'),
(12, 'Food Packaging', 'FDPKG', NULL, '', '', '2021-09-17', 8, 'FP'),
(13, 'Fruit Juice and Syrups', 'FJSYR', NULL, '', '', '2021-09-17', 8, 'FJ'),
(14, 'Grocery', 'GRCRY', NULL, '', '', '2021-09-17', 8, 'GR'),
(15, 'Insecticides and Pesticides', 'ICIDE', NULL, '', '', '2021-09-17', 8, 'IC'),
(16, 'Milk and Yoghurt', 'MLKYO', NULL, '', '', '2021-09-17', 8, 'MY'),
(17, 'Non-alcoholic Drinks', 'NALCO', NULL, '', '', '2021-09-17', 8, 'NA'),
(18, 'Nuts', 'GNUTS', NULL, '', '', '2021-09-17', 8, 'NT'),
(19, 'Packaged Water', 'WATER', NULL, '', '', '2021-09-17', 8, 'PW'),
(20, 'Soaps and Detergents', 'SOAPD', NULL, '', '', '2021-09-17', 8, 'SD'),
(21, 'Spices and Condiments', 'SPICE', NULL, '', '', '2021-09-17', 8, 'SC'),
(22, 'Teas and Beverages', 'TEABV', NULL, '', '', '2021-09-17', 8, 'TB'),
(23, 'Toiletries', 'TOILT', NULL, '', '', '2021-09-17', 8, 'TL'),
(24, 'Waste Bags', 'WBAGS', NULL, '', '', '2021-09-17', 8, 'WB'),
(25, 'Unknown Category', 'UNKNN', NULL, 'Unknown category', '', '2021-11-17', 8, 'UK');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) NOT NULL,
  `subject` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `subject`) VALUES
(1, 'Conversation Stream #1');

-- --------------------------------------------------------

--
-- Table structure for table `conversations_members`
--

CREATE TABLE `conversations_members` (
  `conversation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `conversation_last_view` int(10) NOT NULL DEFAULT current_timestamp(),
  `conversation_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations_members`
--

INSERT INTO `conversations_members` (`conversation_id`, `user_id`, `conversation_last_view`, `conversation_deleted`) VALUES
(1, 2, 0, 0),
(1, 8, 1637181075, 0);

-- --------------------------------------------------------

--
-- Table structure for table `conversations_messages`
--

CREATE TABLE `conversations_messages` (
  `message_id` bigint(20) NOT NULL,
  `conversation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `message_date` int(10) NOT NULL DEFAULT current_timestamp(),
  `message_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations_messages`
--

INSERT INTO `conversations_messages` (`message_id`, `conversation_id`, `user_id`, `message_date`, `message_text`) VALUES
(1, 1, 8, 1637162673, 'Message #1 in conversation stream #1'),
(2, 1, 8, 1637181075, 'Message #2 in conversation stream #1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_porders`
--

CREATE TABLE `customer_porders` (
  `id` bigint(20) NOT NULL,
  `porder_no` varchar(20) NOT NULL,
  `porder_date` datetime NOT NULL,
  `preq_id` bigint(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `originator_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `sub_dom_id` bigint(20) NOT NULL,
  `sub_total` double NOT NULL,
  `vat` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_method` int(11) NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `shipping_cost` double NOT NULL,
  `status` int(11) NOT NULL,
  `rel_request_id` bigint(20) NOT NULL,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_porders`
--

INSERT INTO `customer_porders` (`id`, `porder_no`, `porder_date`, `preq_id`, `description`, `originator_id`, `customer_id`, `domain_id`, `sub_dom_id`, `sub_total`, `vat`, `discount`, `net_total`, `paid`, `due`, `payment_method`, `shipping_method`, `shipping_cost`, `status`, `rel_request_id`, `notes`) VALUES
(1, 'WPNTWWMJ', '2021-10-18 21:51:00', 1, 'Purchase Order #1', 24, 9, 9, 5, 181000, 13575, 0, 194575, 0, 194575, 0, 0, 0, 0, 152, 'Replenish house keeping materials'),
(2, 'VPGDCUJG', '2021-11-02 12:22:00', 1, 'Demiâ€™s urgent needs', 24, 9, 9, 5, 267433, 20057.47, 0, 287490.47, 0, 287490.47, 0, 0, 0, 0, 165, 'Please deal');

-- --------------------------------------------------------

--
-- Table structure for table `customer_porder_line_items`
--

CREATE TABLE `customer_porder_line_items` (
  `id` bigint(20) NOT NULL,
  `porder_id` bigint(20) NOT NULL,
  `catalog_product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rx_quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total_cost` double NOT NULL,
  `additional_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_porder_line_items`
--

INSERT INTO `customer_porder_line_items` (`id`, `porder_id`, `catalog_product_id`, `quantity`, `rx_quantity`, `unit_price`, `total_cost`, `additional_info`) VALUES
(1, 1, 2, 40, 0, 3970, 158800, ''),
(2, 1, 7, 12, 0, 1850, 22200, ''),
(3, 2, 37, 90, 0, 1490, 134100, ''),
(4, 2, 9, 100, 0, 1333.33, 133333, '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_porder_receive_txns`
--

CREATE TABLE `customer_porder_receive_txns` (
  `id` bigint(20) NOT NULL,
  `txn_date` datetime NOT NULL,
  `porder_id` bigint(20) NOT NULL,
  `action_type` int(11) NOT NULL,
  `catalog_product_id` bigint(20) NOT NULL,
  `received_qty` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `receive_notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_preqs`
--

CREATE TABLE `customer_preqs` (
  `id` bigint(20) NOT NULL,
  `preq_no` varchar(20) NOT NULL,
  `preq_date` datetime NOT NULL,
  `description` varchar(500) NOT NULL,
  `originator_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `sub_dom_id` bigint(20) NOT NULL,
  `sub_total` double NOT NULL,
  `vat` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_method` int(11) NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `shipping_cost` double NOT NULL,
  `status` int(11) NOT NULL,
  `rel_request_id` bigint(20) NOT NULL,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_preqs`
--

INSERT INTO `customer_preqs` (`id`, `preq_no`, `preq_date`, `description`, `originator_id`, `customer_id`, `domain_id`, `sub_dom_id`, `sub_total`, `vat`, `discount`, `net_total`, `paid`, `due`, `payment_method`, `shipping_method`, `shipping_cost`, `status`, `rel_request_id`, `notes`) VALUES
(1, 'WPNTWWMJ', '2021-10-18 21:51:00', 'Purchase Requisition #1', 24, 9, 9, 5, 181000, 13575, 0, 194575, 0, 194575, 0, 0, 0, 0, 2, 'Replenish house keeping materials');

-- --------------------------------------------------------

--
-- Table structure for table `customer_preq_line_items`
--

CREATE TABLE `customer_preq_line_items` (
  `id` bigint(20) NOT NULL,
  `preq_id` bigint(20) NOT NULL,
  `catalog_product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rx_quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total_cost` double NOT NULL,
  `additional_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `name`, `description`) VALUES
(1, 'kustomlynx.com', 'Kustomlynx Ltd'),
(2, 'acme.com', 'Acme Enterprises'),
(3, 'konga.com', 'Konga'),
(4, 'jumia.com', 'Jumia'),
(5, 'supermart.ng', 'Supermart Ltd'),
(6, 'addide.com', 'Addide Supermarket Ltd'),
(7, 'boyawek.ng', 'Boyawek Commercial Enterprises'),
(8, 'Jaagee.ng', 'Jaagee Nigeria Ltd'),
(9, 'h1plus.com', 'H1Plus Hotels Ltd'),
(10, 'default', 'Default'),
(11, 'root', 'SysAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `domain_operators`
--

CREATE TABLE `domain_operators` (
  `id` bigint(20) NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `sub_dom_id` bigint(20) NOT NULL,
  `dom_function_id` bigint(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `assoc_role` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `domain_operators`
--

INSERT INTO `domain_operators` (`id`, `domain_id`, `sub_dom_id`, `dom_function_id`, `description`, `assoc_role`, `user_id`) VALUES
(1, 9, 5, 7, 'Role & Group Admin', 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'basic', 'Basic user group'),
(2, 'admin', 'Administrator group'),
(3, 'employee', 'Employee'),
(4, 'manager', 'Manager group'),
(5, 'company_a', ''),
(6, 'company_b', ''),
(7, 'company_c', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups_roles`
--

CREATE TABLE `groups_roles` (
  `group_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `label` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups_roles`
--

INSERT INTO `groups_roles` (`group_id`, `role_id`, `label`, `description`) VALUES
(1, 1, 'BASIC_BASIC', ''),
(2, 1, 'ADMIN_BASIC', ''),
(2, 2, 'ADMIN_ADMIN', 'Admin Role in Admin Group'),
(2, 6, 'sfafas', 'afsdfasdf'),
(3, 1, 'EMPLOYEE_BASIC', ''),
(4, 1, 'MANAGER_BASIC', ''),
(4, 2, 'MANAGER_ADMIN', ''),
(5, 3, 'DASHBOARD_COMPANY_A', ''),
(6, 4, 'DASHBOARD_COMPANY_B', ''),
(6, 7, 'BUTTON_COMPANY_B', ''),
(7, 6, 'DASHBOARD_COMPANY_C', '');

-- --------------------------------------------------------

--
-- Table structure for table `ims_events`
--

CREATE TABLE `ims_events` (
  `id` bigint(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` text NOT NULL,
  `category` text NOT NULL,
  `table_str` varchar(50) NOT NULL,
  `table_id` bigint(20) NOT NULL,
  `action` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `route` varchar(50) NOT NULL,
  `generated_by` bigint(20) NOT NULL DEFAULT 0,
  `xinfo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ims_events`
--

INSERT INTO `ims_events` (`id`, `created_on`, `type`, `category`, `table_str`, `table_id`, `action`, `status`, `route`, `generated_by`, `xinfo`) VALUES
(1, '2021-11-09 12:10:25', 'account_create', 'user_access', 'user', 118, 'account_created', 'complete', '', 118, ''),
(2, '2021-11-09 14:49:01', 'account_create', 'user_access', 'user', 9, 'account_created', 'complete', '', 9, '');

-- --------------------------------------------------------

--
-- Table structure for table `ims_requests`
--

CREATE TABLE `ims_requests` (
  `id` bigint(20) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `generated_by` bigint(20) NOT NULL,
  `target_id` bigint(20) NOT NULL,
  `request_type` int(11) NOT NULL,
  `request_category` varchar(50) NOT NULL,
  `table_str` varchar(255) NOT NULL,
  `op_code` varchar(50) NOT NULL,
  `record_id` bigint(20) NOT NULL,
  `xinfo` varchar(500) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loginattempts`
--

CREATE TABLE `loginattempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `timestamp` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `target_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `notified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `target_id`, `name`, `type`, `message`, `status`, `notified_at`) VALUES
(23, 0, 0, 'Andrew', 'like', 'Dont check out o!', 'read', '2021-10-29 21:23:32'),
(24, 0, 0, 'Moraine Damodred', 'like', 'Wheel of Time', 'read', '2021-10-29 21:52:44'),
(25, 0, 0, '', 'document', 'A new monthly report is ready to download!', 'read', '2021-10-28 11:33:59'),
(26, 0, 0, '', 'income', '$290.29 has been deposited into your account!', 'read', '2021-10-29 23:15:58'),
(27, 0, 0, '', 'alert', 'Spending Alert: We\'ve noticed unusually high spending for your account.', 'read', '2021-10-29 23:16:03'),
(28, 8, 2, '', 'comment', 'afafdsfa', 'read', '2021-11-17 16:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `type` varchar(30) NOT NULL,
  `address` varchar(500) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `contact_email` varchar(30) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `domain_id`, `type`, `address`, `contact_person`, `contact_email`, `contact_phone`, `description`) VALUES
(1, 'Kustomlynx Ltd', 1, 'service_provider', '210/212 Herbert Macaulay Way, Yaba, Laos', 'Tammi Takaya', 'tammit@kustomlynx.com', '+234 809 142 7402', 'Software Development Company'),
(2, 'Acme Enterprises', 2, 'customer', 'No. 227, Oyin-Jolayemi Street, Victoria Island, Lagos', 'Macmillan Sonore', 'mac.sonore@acme.com', '+123 456 7890', 'Food Processing company'),
(3, 'Konga', 3, 'vendor', '2 Norman Williams by Keffi off Awolowo Rd', 'Nnamdi Ekeh', 'nnamdi.ekeh@konga.com', '+234 708 063 5700', 'Ecommerce based merchandise supplier'),
(4, 'Jumia', 4, 'vendor', '76 Old Yaba Rd, Lagos Mainland 100001, Lagos', 'Kareem Akinjide', 'kareem.akinjide@jumia.com', '+234 901 443 7333', 'ECommerce based Merchandise Supplier'),
(5, 'Supermart Ltd', 5, 'vendor', '16, Karimu Kotun VI, Lagos', 'Raphael Afaedor', 'rafaedor@supermart.ng', '+234 806 178 7063', ''),
(6, 'Addide Supermarket Ltd', 6, 'vendor', '5/7 Diya Street, Ifako-Gbagada, Lagos, Nigeria.', 'Pedro Bushy', 'pedrobushy@addide.com', '+234 802 433 5021', ''),
(7, 'Boyawek Commercial Enterprises', 7, 'vendor', 'Landmark House (Wing A), 52 54 Isaac John St, GRA, Lagos', 'Julius Ipoola', 'julius.ipoola@hotmail.com', '+234 805 145 6738', ''),
(8, 'Jaagee Nigeria Ltd', 8, 'vendor', 'Gboyega Kilo St, Ojodu 101233, Lagos', 'Isaac Jagun', 'jagun@jaagee.com', '+234 701 548 7047', ''),
(9, 'H1Plus Hotels Ltd', 9, 'customer', '13 Adeyamo Street, Toyin Street, Ikeja', 'Dem Elesho', 'dem.elesho@h1plus.com', '+234 709 345 6787', 'Hotel and Restaurant Services'),
(10, 'Default', 10, 'default', '', '', '', '', ''),
(11, 'SysAdmin', 11, 'root', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `page_access_groups`
--

CREATE TABLE `page_access_groups` (
  `id` bigint(20) NOT NULL,
  `label` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page_access_groups`
--

INSERT INTO `page_access_groups` (`id`, `label`, `description`) VALUES
(1, 'DASHBOARD_COMPANY_A', 'Company A Dashboard'),
(2, 'DASHBOARD_COMPANY_B', ''),
(3, 'DASHBOARD_COMPANY_C', ''),
(4, 'ADMIN', '');

-- --------------------------------------------------------

--
-- Table structure for table `page_access_groups_roles`
--

CREATE TABLE `page_access_groups_roles` (
  `pag_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `label` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page_access_groups_roles`
--

INSERT INTO `page_access_groups_roles` (`pag_id`, `role_id`, `label`, `description`) VALUES
(1, 2, 'One', 'Un'),
(1, 3, 'Two', 'Deux'),
(2, 2, 'Three', 'Trois'),
(2, 4, 'Four', 'Quart'),
(2, 7, 'Five', 'Cinq'),
(2, 8, 'Six', 'Six'),
(3, 2, 'Seven', 'Sept'),
(3, 6, 'Eight', 'Huit'),
(4, 2, 'Nine', 'Neuf');

-- --------------------------------------------------------

--
-- Table structure for table `page_access_level`
--

CREATE TABLE `page_access_level` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `access_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `weight` varchar(25) NOT NULL,
  `volume` varchar(25) NOT NULL,
  `color` varchar(25) NOT NULL,
  `size` varchar(50) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `short_descr` varchar(255) NOT NULL,
  `long_descr` varchar(500) NOT NULL,
  `unit_price` double NOT NULL,
  `main_pix` varchar(255) NOT NULL,
  `gallery_pix_id` bigint(20) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `freq_wt` int(11) NOT NULL DEFAULT 100,
  `keep_stock` text NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL,
  `expiry` date NOT NULL DEFAULT current_timestamp(),
  `batch_no` varchar(50) NOT NULL,
  `serial_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `product_name`, `unit`, `brand_id`, `weight`, `volume`, `color`, `size`, `category_id`, `short_descr`, `long_descr`, `unit_price`, `main_pix`, `gallery_pix_id`, `tags`, `freq_wt`, `keep_stock`, `created_on`, `created_by`, `expiry`, `batch_no`, `serial_no`) VALUES
(1, 'SHU456788', 'Air Freshener', 'refill', 3, '', '', '', '', 4, 'Air wick Freshmatic Refill Air Freshener - Sparkling Citrux', '', 2049.5, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(2, 'SHU456789', 'Bath Gel', 'bottle', 33, '0.6kg', '130ml', '', '', 20, 'Clearasil Shower Gel', '', 3970, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(3, 'SHU456790', 'Body Lotion', 'bottle', 95, '', '400ml', '', '', 20, 'NIVEA Vanilla & Almond Oil Body Lotion For Women - 400ml', '', 1700, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(4, 'SHU456791', 'Bath Soap', 'bar', 36, '', '', '', '', 20, 'Dettol Even Tone Anti-Bacterial Soap - 65g', '', 130, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(5, 'SHU456792', 'Block Airfreshener', 'pack', 132, '', '', '', '', 4, 'Wind Block Air Fresheners', '', 266.67, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(6, 'SHU456793', 'Dental Kit', 'pc', 116, '0.1kg', '', '', '', 4, 'Spring Fresh Oral Care Kit for Clean Teeth and Gums', 'Oral Care Kit For Clean Teeth & Gum is Essential For Maintaining Proper Dental Hygiene. It Removes Food Particles Which May Cause Damage to the Tooth and Help Removes Odour Causing Bacteria.', 2999, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(7, 'SHU456794', 'Detergent', 'bag', 121, '0.9kg', '', '', '', 20, 'Sunlight Detergent Powder 900g', '', 1850, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(8, 'SHU456795', 'Dustbin nylon (black)', 'roll', 46, '0.5kg', '', 'Black', '', 24, '1pc of 20 Heavy Duty Trash /Refuse /Waste Bin Bag Nylon', '', 2600, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(9, 'SHU456797', 'Air Freshener', 'spray', 45, '0.5kg', '500ml', '', '', 4, 'Gbc TOP QUALITY SUPER AIR FRESHENER - 500ml', '', 1333.33, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(10, 'SHU456798', 'Glass Cleaner', 'bottle', 133, '0.6kg', '750ml', '', '', 7, 'Windolene Glass & Shiny Surfaces- 750ml ', '', 2500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(11, 'SHU456799', 'Handwash', 'bottle', 30, '0.5kg', '500ml', '', '', 20, 'Certex 500ml Certex Antibacterial Handwash', '', 4500, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(12, 'SHU456800', 'Toilet Cleaner Liquid', 'bottle', 56, '0.7kg', '725ml', '', '', 20, 'Harpic Toilet Cleaner: Power Plus 725ml', '', 999, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(13, 'SHU456801', 'Bleach', 'bottle', 64, '1kg', '3500ml', '', '', 20, 'Hypo Bleach Lime 3.5L', '', 1850, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(14, 'SHU456802', 'Tea', 'satchet', 76, '', '', '', '', 22, 'Lipton America\'s Favourite Black Tea', '', 32.69, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(15, 'SHU456803', 'Insecticide', 'can', 84, '0.8kg', '400ml', '', '', 15, 'Mortein Multi Insect Killer - 400ml', '', 875, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(16, 'SHU456804', 'Disinfectant', 'pc', 66, '0.2kg', '150ml', '', '', 7, 'Izal Germicide / Disinfectant', '', 1750, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(17, 'SHU456805', 'Mama Lemon', 'bottle', 79, '', '550ml', '', '', 20, 'Mama Lemon 550ml Liquid Dish Washing Soap', '', 1450, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(18, 'SHU456806', 'Milo', 'satchet', 81, '', '', '', '', 22, 'Nestle Milo 20g', '', 65, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(19, 'SHU456807', 'Milk', 'satchet', 101, '12g', '', '', '', 16, 'Peak Filled Milk Pouch 12g', '', 105, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(20, 'SHU456808', 'Multi surface cleaner', 'bottle', 35, '', '1000ml', '', '', 7, 'DEEP ACTION Multi-Purpose Cleaner Lemon- 1000ml Spray', '', 2990, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(21, 'SHU456809', 'Scouring Pad', 'pc', 46, '0.03kg', '', '', '', 8, '6 Pieces Sponge Scouring Pad', '', 333.33, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(22, 'SHU456810', 'Shower Cap', 'pc', 46, '', '', 'Clear', 'L25 x W18 x H2 cm', 23, 'SPA Salon Home Hotel Disposable Bathing Shower Caps Hats Hair', '', 23.72, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(23, 'SHU456811', 'Nescafe', 'satchet', 93, '2g', '', '', '', 22, 'Nestle Nescafe Nescafe Classic Sticks 2g', '', 50, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(24, 'SHU456812', 'Spray Starch', 'can', 43, '1kg', '', '', '', 7, 'Faultless Heavy Spray Starch For Professional Ironing', '', 2190, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(25, 'SHU456813', 'Spray Airfreshner', 'can', 112, '', '300ml', '', '', 4, 'Secret Love Heaven Air Freshener Spray 300ML', '', 2500, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(26, 'SHU456814', 'Sugar', 'pkt', 118, '0.2kg', '', '', '', 22, 'St Louis Cube Sugar 500g', '', 1000, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(27, 'SHU456815', 'Super Glue', 'pc', 46, '0.1kg', '', '', '', 3, 'Super Glue', '', 141.67, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(28, 'SHU456816', 'Swiss', 'bottle', 123, '', '500ml', '', '', 4, 'Swiss 3 In 1 Flower Liquid Air Freshener 500ML', '', 1333.33, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(29, 'SHU456817', 'Tissue', 'roll', 108, '0.5kg', '', '', '', 23, 'Rose Tissue', '', 166.67, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(30, 'SHU456818', 'Tissue Box', 'box', 46, '0.4kg', '', '', '', 23, 'Quality Tissue Box For Home And Offices', '', 3700, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(31, 'SHU456819', 'Vanity Kit', 'pack', 46, '0.1kg', '', '', '', 23, 'Hotel Guest Amenity (Vanity Kit)', '', 100, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(32, 'SHU456820', 'Scouring Powder (vim)', 'pc', 83, '0.45kg', '', '', '', 20, 'Morning Fresh Scouring Powder', '', 1700, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(33, 'SHU456821', 'Baked Beans', 'tin', 58, '0.15kg', '', '', '', 14, 'Heinz Tomato Sauce Baked Beans (150g)', '', 583.33, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(34, 'SHU456822', 'Baked Beans', 'tin', 58, '0.415kg', '', '', '', 14, 'Heinz Tomato Sauce Baked Beanz 415g', '', 1266.67, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(35, 'SHU456823', 'Mayonnaise', 'jar', 13, '', '946ml', '', '', 14, 'Bama Mayonnaise 946ml', '', 2400, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(36, 'SHU456824', 'Mayonnaise', 'jar', 13, '', '473ml', '', '', 14, 'Bama Mayonnaise 473ml', '', 1900, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(37, 'SHU456825', 'Black Pepper', 'pc', 115, '57g', '', '', '', 21, 'Spice Supreme Pure Ground Black Pepper', '', 1490, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(38, 'SHU456826', 'Basmati Rice', 'bag', 2, '10kg', '', '', '', 11, 'Aani Premium Basmati Rice - 10kg', '', 14500, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(39, 'SHU456827', 'Cameroun Pepper', 'jar', 48, '150g', '', '', '', 21, 'GMCE Hot Cameroon Pepper Powder 150g', '', 1299, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(40, 'SHU456828', 'Crayfish', 'pkt', 80, '150g', '', '', '', 21, 'Masego Hills Farm Whole Crayfish 150g', '', 1600, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(41, 'SHU456829', 'Coconut Milk', 'can', 129, '', '400ml', '', '', 14, 'Trs Coconut Milk 400ml', '', 1333.17, '', 0, '', 25, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(42, 'SHU456830', 'Coffee', 'jar', 93, '190g', '', '', '', 22, 'Nescafe Gold Coffee In Jar 190G', '', 4233, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(43, 'SHU456831', 'Corned Beef', 'tin', 41, '340g', '', '', '', 14, 'Heinz Corned Beef 340g', '', 2151, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(44, 'SHU456832', 'Cornflakes', 'pkt', 70, '350g', '', '', '', 6, 'Kellogg\'s Cornflakes 350g', '', 735, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(45, 'SHU456833', 'Cornflour', 'pc', 5, '350g', '', '', '', 14, 'Amel Susan Susan Corn Flour', '', 1500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(46, 'SHU456834', 'Curry Powder', 'pkt', 129, '100g', '', '', '', 21, 'Trs Hot Madras Curry Powder 100g', '', 2700, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(47, 'SHU456835', 'Custard', 'jar', 31, '2kg', '', '', '', 6, 'Checkers Custard Yellow Big Size', '', 7000, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(48, 'SHU456836', 'Curry Sauce', 'jar', 134, '', '250ml', '', '', 21, 'Wing Yip Medium Concentrate Curry Sauce 250 ml', '', 1350, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(49, 'SHU456837', 'Dried Pepper', 'jar', 9, '1kg', '', '', '', 21, 'Grounded Dried Red Spice Seasoning Condiment Soup Stew Ingredient Spicy As E Dey Hot Pepper', '', 1416.8, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(51, 'SHU456838', 'Egusi', 'pkt', 69, '100g', '', '', '', 21, 'Jollofe Melon Seed 100g', '', 1692, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(52, 'SHU456839', 'Fried Rice Spice', 'pc', 115, '121g', '', '', '', 21, 'Spice Supreme Fried Rice Seasoning (121g)', '', 1500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(53, 'SHU456840', 'Fish Spice', 'pc', 115, '198g', '', '', '', 21, 'Spice Supreme Spicy Fish Seasoning 198g', '', 1300, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(54, 'SHU456841', 'Garlic', 'pc', 1, '80g', '', '', '', 21, 'AACE FOODS Garlic Powder - 80g', '', 799, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(55, 'SHU456842', 'Ginger', 'pc', 1, '80g', '', '', '', 21, 'AACE FOODS Ginger Powder - 80g', '', 799, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(56, 'SHU456843', 'Knorr Chicken Cubes', 'pkt', 71, '400g', '', '', '', 21, 'Knorr Seasoning Chicken Cube - 8g ? 50 Cubes ( 1 Pack)', '', 1700, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(57, 'SHU456844', 'Tea', 'pkt', 76, '', '', '', '', 22, 'Lipton Yellow Label Black Tea With Rich Natural Taste 50g (25 Bags)', '', 300, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(58, 'SHU456845', 'Mushroom', 'pkt', 27, '50g', '', '', '', 14, 'Buywholefoodsonline.co.uk Dried Porcini Mushroom Pieces 50g', '', 8000, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(59, 'SHU456846', 'Noodles', 'pkt', 65, '70g', '', '', '', 11, 'Indomie 70g', '', 72.5, '', 0, '', 25, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(60, 'SHU456847', 'Oat', 'tin', 104, '500g', '', '', '', 11, 'Quaker White Oats Tin - 500g', '', 1415, '', 0, '', 25, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(61, 'SHU456848', 'Oatmeal', 'bag', 27, '1.25kg', '', '', '', 11, 'Buywholefoodsonline.co.uk Organic Jumbo Porridge Oats - 1.25kg', '', 5499, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(62, 'SHU456849', 'Pepper soup spice', 'pc', 115, '198g', '', '', '', 21, 'Spice Supreme Spicy Pepper Soup Spice', '', 1750, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(63, 'SHU456850', 'Poundo Yam', 'bag', 10, '4.5kg', '', '', '', 11, 'Ayoola Foods Ayoola Poundo Yam - 4.5kg', '', 6500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(64, 'SHU456851', 'Semolina', 'bag', 62, '10kg', '', '', '', 11, 'Honeywell Semolina - 10kg', '', 9600, '', 0, '', 25, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(65, 'SHU456853', 'Sesame Oil', 'bottle', 6, '', '150ml', '', '', 9, 'Amoy Blended Sesame Oil 150ml', '', 1500, '', 0, '', 35, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(66, 'SHU456854', 'Spaghetti', 'pkt', 24, '2kg', '', '', '', 11, 'Bonita Slim SPAGHETTI 500G', '', 528, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(67, 'SHU456855', 'Sweet Chilli', 'bottle', 73, '', '23.7 fl oz', '', '', 21, 'Ktc Thai Sweet Chilli Sauce', '', 3800, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(68, 'SHU456856', 'Sweet Corn', 'can', 122, '340g', '', '', '', 14, 'Sunripe Sweet Corn 340g', '', 830, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(69, 'SHU456857', 'Takeaway Pack', 'pack', 46, '', '', '', 'L20 x W15 x H9 cm', 12, 'Disposable Foam Takeaway Packs - 100 Pieces[multi-colors]', '', 3500, '', 0, '', 30, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(70, 'SHU456858', 'Thyme', 'jar', 85, '25g', '', '', '', 21, 'Natco Thyme - 25g Jar', '', 1500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(71, 'SHU456859', 'Tin Tomato', 'tin', 47, '210g', '', '', '', 14, 'Gino Tomato Paste 210g', '', 1083.33, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(72, 'SHU456860', 'Tomato Ketchup', 'bottle', 58, '1.25kg', '', '', '', 21, 'Heinz Tomato Ketchup - 1.25kg', '', 2999.67, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(73, 'SHU456861', 'Wheat', 'bag', 62, '5kg', '', '', '', 11, 'Honeywell Whole Wheat Meal - 5kg', '', 6000, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(74, 'SHU456862', 'White Pepper', 'pc', 115, '56g', '', '', '', 21, 'Spice Supreme Pure Ground White Pepper', '', 1500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(75, 'SHU456863', 'Cream Liquor', 'bottle', 4, '', '700ml', '', '', 5, 'Amarula Cream Liquor 700ml', '', 6500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(76, 'SHU456864', 'Malt', 'can', 7, '', '330ml', '', '', 17, 'Amstel No Alcohol Malt Drink Can', '', 291.67, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(77, 'SHU456865', 'Bitters', 'bottle', 8, '', '200ml', '', '', 5, 'Angostura Aromatic Bitters AAB 200ML', '', 9470, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(78, 'SHU456866', 'White Rum', 'bottle', 11, '', '50ml', '', '', 5, 'Bacardi Carta Blanca Superior White Rum 50ml', '', 550, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(79, 'SHU456867', 'Baileys', 'bottle', 12, '', '700ml', '', '', 5, 'Baileys Irish Cream', '', 7200, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(80, 'SHU456868', 'Red Wine', 'bottle', 21, '', '750ml', '', '', 19, 'Marques De Berol Semi-Sweet - Red Wine 2017 - 750ml', '', 1650, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(81, 'SHU456869', 'Water', 'bottle', 74, '', '750ml', '', '', 19, 'Lasena Alkaline Water 75cl (16 Bottles In A Pack)', '', 4900, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(82, 'SHU456870', 'Bitter Lemon', 'can', 110, '', '330ml', '', '', 17, 'Schweppes 33CL Bitter Lemon', '', 520.83, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(83, 'SHU456871', 'Whisky', 'bottle', 22, '', '700ml', '', '', 5, 'Black & White Scotch Whiskey 70 cl', '', 2751.67, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(84, 'SHU456872', 'Red Wine', 'bottle', 23, '', '750ml', '', '', 5, 'Bon Voyage Cape Red Wine 75 cl', '', 2180, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(85, 'SHU456873', 'Beer', 'bottle', 25, '', '600ml', '', '', 5, 'Budweiser (60 cl)', '', 390, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(86, 'SHU456874', 'Bullet', 'can', 26, '', '250ml', '', '', 5, 'Bullet Vodka Mixed Drink 250ml Can', '', 765.25, '', 0, '', 25, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(87, 'SHU456875', 'Campari', 'bottle', 28, '', '1litre', '', '', 5, 'Campari Bitters 1 ltr', '', 8500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(88, 'SHU456876', 'Rum', 'bottle', 29, '', '700ml', '', '', 5, 'Captain Morgan Spiced Gold Rum (70 cl)', '', 7500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(89, 'SHU456877', 'Red Wine', 'bottle', 103, '', '750ml', '', '', 5, 'Pride of Kings - Merlot (Cabernet Savignon)', '', 1250, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(90, 'SHU456878', 'Juice', 'packet', 32, '', '1litre', '', '', 13, 'Chi Chivita 100% Red Grape Fruit Juice - 1 Ltr', '', 547.2, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(91, 'SHU456879', 'Coke', 'bottle', 34, '', '500ml', '', '', 17, 'Coca-cola Coke Soft Drink 50cl', '', 291.67, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(92, 'SHU456880', 'Red Wine', 'bottle', 37, '', '750ml', '', '', 5, 'Dornfelder Lieblich, 750ml', '', 1705, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(93, 'SHU456881', 'Red Wine', 'bottle', 38, '', '750ml', '', '', 5, 'Drostdy-Hof Red Wine - 75 Cl', '', 2400, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(94, 'SHU456882', 'Malt', 'bottle', 39, '', '330ml', '', '', 17, 'Dubic Malt Drink 33cl', '', 150.92, '', 0, '', 25, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(95, 'SHU456883', 'Fanta', 'bottle', 42, '', '500ml', '', '', 17, 'Fanta Orange 50cl PET', '', 262.5, '', 0, '', 25, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(96, 'SHU456884', 'Vodka', 'bottle', 44, '', '1litre', '', '', 5, 'Flirt Vodka Chocolate 1 Ltr', '', 4500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(97, 'SHU456885', 'Vodka', 'bottle', 44, '', '200ml', '', '', 5, 'Flirt Vodka 200ml', '', 410, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(98, 'SHU456886', 'Beer', 'bottle', 49, '', '600ml', '', '', 5, 'Goldberg 60cl', '', 325, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(99, 'SHU456887', 'Beer', 'can', 49, '', '500ml', '', '', 5, 'Goldberg Lager Beer 50cl Can', '', 240, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(100, 'SHU456888', 'Gin', 'bottle', 50, '', '700ml', '', '', 5, 'Gordons London Dry Gin - 70cl', '', 4850, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(101, 'SHU456889', 'Gin', 'bottle', 50, '', '200ml', '', '', 5, 'Gordon\'s London Dry Gin 20 cl', '', 1150, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(102, 'SHU456890', 'Syrup', 'bottle', 51, '', '500ml', '', '', 13, 'Chtoura Garden Grenadine (pomegranate) Molasses 500ml', '', 5400, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(103, 'SHU456891', 'Groundnut', 'bottle', 98, '', '', '', '', 18, 'Ore Roasted Groundnut (honey Flavoured)', '', 1900, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(104, 'SHU456892', 'Stout', 'bottle', 52, '', '600ml', '', '', 5, 'Guiness Big Stout (60cl)', '', 494, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(105, 'SHU456893', 'Malt', 'bottle', 52, '', '350ml', '', '', 17, 'Maltina Classic Non-Alcoholic Malt Drink 35cl', '', 114.58, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(106, 'SHU456894', 'Stout', 'can', 52, '', '330ml', '', '', 5, 'Guinness Smooth Stout Can', '', 291.67, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(107, 'SHU456895', 'Beer', 'bottle', 53, '', '600ml', '', '', 5, 'Gulder Bottle (60cl)', '', 364, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(108, 'SHU456896', 'Beer', 'bottle', 55, '', '600ml', '', '', 5, 'Harp Lager Beer (60cl)', '', 338, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(109, 'SHU456897', 'Beer', 'bottle', 57, '', '330ml', '', '', 5, 'Heineken Lager Beer - 60cl crate', '', 660, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(110, 'SHU456898', 'Beer', 'can', 57, '', '330ml', '', '', 5, 'Heineken Can (33cl)', '', 260, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(111, 'SHU456899', 'Cognac', 'bottle', 59, '', '350ml', '', '', 5, 'Hennessy VS - 35cl', '', 9200, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(112, 'SHU456900', 'Cognac', 'bottle', 60, '', '700ml', '', '', 5, 'Hennessy V.S.O.P Cognac', '', 41169.99, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(113, 'SHU456901', 'Liquid Milk', 'can', 101, '170g', '', '', '', 16, 'Peak Full Cream Unsweetened Evaporated Liquid Milk 170g', '', 300, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(114, 'SHU456902', 'Yoghurt', 'pack', 61, '', '1litre', '', '', 16, 'Hollandia YOGHURT - Plain Sweetened (1LTR)', '', 1700, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(115, 'SHU456903', 'Beer', 'bottle', 63, '', '330ml', '', '', 5, 'Hunter\'s Dry NRB (33cl)', '', 390, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(116, 'SHU456904', 'Beer', 'bottle', 63, '', '330ml', '', '', 5, 'Hunter\'s Gold NRB (33cl)', '', 390, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(117, 'SHU456905', 'Whisky', 'bottle', 67, '', '700ml', '', '', 5, 'Jameson Black Barrel 70cl', '', 15000, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(118, 'SHU456906', 'Whisky', 'bottle', 67, '', '200ml', '', '', 5, 'Jameson Irish Whiskey 20cl', '', 2370, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(119, 'SHU456907', 'Whisky', 'bottle', 68, '', '1litre', '', '', 5, 'Jim Beam Kentucky Straight Bourbon Whiskey 1 L', '', 28210, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(120, 'SHU456908', 'Bitters', 'pcs', 72, '', '200ml', '', '', 5, 'Kolaq Alagbo For Maximum Sexual Pleasure', '', 583.33, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(121, 'SHU456909', 'Stout', 'bottle', 75, '', '600ml', '', '', 5, 'Legend Extra Stout 60cl Bottle', '', 300, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(122, 'SHU456910', 'Lemon juice', 'bottle', 77, '', '946ml', '', '', 13, 'Magic Time Lemon Juice 946 ml', '', 2525, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(124, 'SHU456912', 'Red Wine', 'bottle', 88, '', '750ml', '', '', 5, 'Nederburg Merlot -75CL', '', 5450, '', 0, '', 45, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(125, 'SHU456913', 'White Wine', 'bottle', 87, '', '750ml', '', '', 5, 'Nederburg Chardonnay White Wine -75CL', '', 4660, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(126, 'SHU456914', 'Red Wine', 'bottle', 89, '', '750ml', '', '', 5, 'Nederburg Pinotage Wine -75CL', '', 4900, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(127, 'SHU456915', 'Rose Wine', 'bottle', 90, '', '750ml', '', '', 5, 'Nederburg Rose Wine 75cl, 14.47% acl. (Single Bottle)', '', 3530, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(128, 'SHU456916', 'White Wine', 'bottle', 91, '', '750ml', '', '', 5, 'Nederburg Sauvignon Blanc White wine -75CL ', '', 4550, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(129, 'SHU456917', 'Red Wine', 'bottle', 86, '', '750ml', '', '', 5, 'Nederburg Cabernet Sauvignon -75CL', '', 5430, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(130, 'SHU456918', 'Red Wine', 'bottle', 92, '', '750ml', '', '', 5, 'Nederburg Shiraz Wine -75CL (x6Bottles)', '', 4908.33, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(131, 'SHU456919', 'Red Wine', 'bottle', 96, '', '750ml', '', '', 5, 'Noble CRU 750ml', '', 3500, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(132, 'SHU456920', 'Energy Drink', 'can', 82, '', '440ml', '', '', 10, 'Monster Energy Drink - 440ml', '', 550, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(133, 'SHU456921', 'Bitters', 'bottle', 99, '', '750ml', '', '', 5, 'Buy Orijin Bitters - 75CL ', '', 1350, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(134, 'SHU456922', 'Bitters', 'can', 99, '', '330ml', '', '', 5, 'Orijin Spirit Mixed Drink (33cl)', '', 187.5, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(135, 'SHU456923', 'Bitters', 'bottle', 99, '', '200ml', '', '', 5, 'Origin Bitters (20cl)', '', 390, '', 0, '', 25, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(136, 'SHU456924', 'Brandy', 'bottle', 100, '', '750ml', '', '', 5, 'Paul Masson VSOP 75cl', '', 1000, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(137, 'SHU456925', 'Beer', 'bottle', 97, '', '600ml', '', '', 5, 'Olu Olu Palmi Nature\'s Sparkling Palm Drink 60 cl', '', 380, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(138, 'SHU456926', 'Energy Drink', 'can', 102, '', '330ml', '', '', 10, 'Power Horse Energy Drink 330ML', '', 300, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(139, 'SHU456927', 'Energy Drink', 'can', 106, '', '250ml', '', '', 10, 'Red Bull Energy Drink 25 cl', '', 435, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(140, 'SHU456928', 'Whisky', 'bottle', 107, '', '700ml', '', '', 5, 'Johnnie Walker Red Lable 70 cl', '', 3240, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(141, 'SHU456929', 'Lemon juice', 'bottle', 105, '', '1.4litre', '', '', 13, 'Realemon Lemon Juice 1.4 Litres 2in1 Pack For Daily Use.', '', 3250, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(143, 'SHU456931', 'Robertson Whiskey', 'bottle', 54, '', '750ml', '', '', 5, 'Hamish Robertson & Co. Royal Park Fine Blended Scotch Whisky', '', 4546, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(144, 'SHU456932', 'Cider', 'bottle', 109, '', '330ml', '', '', 5, 'Savanna Dry Cider Cider (33cl)', '', 455, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(145, 'SHU456933', 'Tequila', 'bottle', 113, '', '700ml', '', '', 5, 'Sierra Tequila Silver 70 cl', '', 6000, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(146, 'SHU456934', 'Water', 'bottle', 40, '', '750ml', '', '', 19, 'Eva Table Water 75 cl', '', 72.92, '', 0, '', 15, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(147, 'SHU456935', 'Vodka', 'bottle', 114, '', '600ml', '', '', 5, 'Smirnoff Ice Bottle 60 cl', '', 420, '', 0, '', 25, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(148, 'SHU456936', 'Beer', 'bottle', 120, '', '500ml', '', '', 5, 'Star Radler Bottle (50cl)', '', 273, '', 0, '', 20, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(149, 'SHU456937', 'Schnapp', 'bottle', 111, '', '750ml', '', '', 5, 'Seaman\'s Aromatic Schnapps 75 cl', '', 1420, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(150, 'SHU456938', 'Soda water', 'can', 110, '', '500ml', '', '', 17, 'Schweppes Soda Water Pet Bottle 50 cl', '', 137.5, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(151, 'SHU456939', 'Soda water', 'bottle', 110, '', '330ml', '', '', 17, 'Schweppes Soda Water - Can - 33CL', '', 160, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(152, 'SHU456940', 'Sprite', 'bottle', 117, '', '500ml', '', '', 17, 'Sprite Pet Bottle 50 cl', '', 83.33, '', 0, '', 30, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(153, 'SHU456941', 'Beer', 'bottle', 119, '', '600ml', '', '', 5, 'Star Lager Beer 600ml', '', 116.67, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(154, 'SHU456942', 'Beer', 'can', 119, '', '330ml', '', '', 5, 'Star Lager Beer Can 33 cl', '', 160, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(155, 'SHU456943', 'Tequila', 'bottle', 125, '', '350ml', '', '', 5, 'Olmeca Tequila Blanco 35 cl', '', 2535, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(156, 'SHU456944', 'Tequila', 'bottle', 125, '', '750ml', '', '', 5, 'Olmeca Blanco Tequila - 75CL', '', 6650, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(157, 'SHU456945', 'Tequila', 'bottle', 126, '', '750ml', '', '', 5, 'Olmeca Tequila Gold 75 cl', '', 4840, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(159, 'SHU456947', 'Brandy', 'bottle', 127, '', '700ml', '', '', 5, 'Three Barrels Brandy V.S.O.P 70cl', '', 1650, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(160, 'SHU456948', 'Beer', 'can', 128, '', '500ml', '', '', 5, 'Trophy Lager Beer Can - 50CL', '', 280, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(161, 'SHU456949', 'White Wine', 'bottle', 130, '', '700ml', '', '', 5, 'Valdivieso Classic Chardonnay', '', 5589, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(162, 'SHU456950', 'Water', 'bottle', 94, '', '1.5litre', '', '', 19, 'Nestle Pure Life Water 150 cl', '', 105, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(163, 'SHU456952', 'Whisky', 'bottle', 131, '', '750ml', '', '', 5, 'William Lawson\'s Scotch Whisky - 75cl', '', 4200, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(164, 'SHU456953', 'Whisky', 'bottle', 131, '', '200ml', '', '', 5, 'William Lawson Scotch Whisky 200ml', '', 1099.9, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(165, 'SHU456796', 'Dustbin nylon (colored)', 'roll', 124, '0.6kg', '', 'MultiColored', '', 24, 'Colored 3 In 1 Trash Bags Garbage Bags Waste Nylon Bags (90 pcs per roll)', '', 2650, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(166, 'SHU456852', 'Semolina', 'bag', 78, '10kg', '', '', '', 11, 'Mama Gold Semolina 10kg', '', 6000, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', ''),
(167, 'SHU456951', 'Water', 'bottle', 94, '', '60ml', '', '', 19, 'Nestle table water 60cl', '', 67.5, '', 0, '', 100, 'Yes', '2021-09-18', 32, '2021-11-15', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_tasks`
--

CREATE TABLE `project_tasks` (
  `id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `sequence` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `status` text NOT NULL,
  `tracking_descr` varchar(500) NOT NULL,
  `duration` int(11) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_tasks`
--

INSERT INTO `project_tasks` (`id`, `task`, `sequence`, `progress`, `status`, `tracking_descr`, `duration`, `due_date`) VALUES
(1, 'Application Skeleton (Bootstrap)', 0, 100, 'Completed', '', 1, '2021-09-30'),
(2, 'Web Registration & Login', 0, 100, 'Completed', '', 1, '2021-09-30'),
(3, 'Validation and password reset/recovery by email', 0, 100, 'Completed', '', 1, '2021-09-30'),
(4, 'Protection (CSRF, Brute Force)', 0, 100, 'Completed', '', 1, '2021-09-30'),
(5, 'Request to join group', 0, 100, 'Completed', '', 1, '2021-09-30'),
(6, 'Remember Me functionality ', 0, 80, 'In progress', 'Security concerns to be fixed', 1, '2021-09-30'),
(7, 'Define Groups and Roles', 0, 100, 'Completed', '', 1, '2021-09-30'),
(8, 'UI & UX Design', 0, 40, 'In progress', 'User interface and responsive for devices', 1, '2021-09-30'),
(9, 'Site topology', 0, 70, 'In progress', '', 1, '2021-09-30'),
(10, 'Pages structure - split into components', 0, 100, 'Completed', '', 1, '2021-09-30'),
(11, 'CRUD Functionality', 0, 100, 'Completed', '', 1, '2021-09-30'),
(12, 'DB integration ', 0, 70, 'On-track', 'DB functions as services', 1, '2021-09-30'),
(13, 'Build Pages', 0, 90, 'In progress', 'Create records structure and generate dummy data', 1, '2021-09-30'),
(14, 'Dashboards', 0, 10, 'Started', 'Gathering typical watch kpis', 1, '2021-09-30'),
(15, 'Set page restrictions by role', 0, 20, 'On-track', 'Functionality implemented', 1, '2021-09-30'),
(16, 'Site Navigation', 0, 40, 'In progress', 'Needs review', 1, '2021-09-30'),
(17, 'Create REST API interface for external/remote access', 0, 70, 'In progress', '', 1, '2021-09-30'),
(18, 'JWT authentication', 0, 100, 'Completed', '', 1, '2021-09-30'),
(19, 'Logging (audit, error)', 0, 10, 'Started', '', 1, '2021-09-30'),
(20, 'Unit Testing', 0, 20, 'Started', '', 1, '2021-09-30'),
(21, 'Deployment (Github, VPS)', 0, 100, 'Completed', '', 1, '2021-09-30'),
(22, 'Android UI', 0, 0, 'Not started', '', 1, '2021-09-30'),
(23, 'Android authentication', 0, 0, 'Not started', '', 1, '2021-09-30'),
(24, 'Requisition activity and records', 0, 0, 'Not started', '', 1, '2021-09-30'),
(25, 'Deploy to playstore', 0, 0, 'Not started', '', 1, '2021-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `page_access_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `page_access_level`) VALUES
(1, 'basic', 'Basic user role', 3),
(2, 'admin', 'Administrator', 15),
(3, 'dashboard_company_a', 'Company A Dashboard Access', 3),
(4, 'dashboard_company_b', 'Company B Dashboard Access', 5),
(6, 'dashboard_company_c', 'Company C Dashboard Access', 5),
(7, 'button_company_b', '', 1),
(8, 'form_company_b', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `org_id` bigint(20) NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `department` varchar(50) NOT NULL,
  `functional_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `org_id`, `domain_id`, `department`, `functional_role`) VALUES
(1, 24, 9, 9, 'Kitchen', 'Kitchen officer'),
(2, 25, 9, 9, 'Kitchen', 'Kitchen officer'),
(3, 27, 9, 9, 'House Keeping', 'Cleaning Officer'),
(4, 26, 9, 9, 'Stores and Logistics', 'Supply Chain Manager'),
(5, 28, 9, 9, 'Restaurant and Bar', 'Bar officer'),
(6, 29, 9, 9, 'Finance', 'Accountant'),
(7, 30, 9, 9, 'Operations', 'Hotel Manager'),
(8, 31, 2, 2, 'Executive Office', 'Managing Director'),
(9, 32, 2, 2, 'Sales and Marketing', 'Sales Manager');

-- --------------------------------------------------------

--
-- Table structure for table `static_codes`
--

CREATE TABLE `static_codes` (
  `id` bigint(20) NOT NULL,
  `parent` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `catalog_symbol` text NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `static_codes`
--

INSERT INTO `static_codes` (`id`, `parent`, `type`, `label`, `value`, `catalog_symbol`, `description`) VALUES
(1, 'products', 'packaging_unit', 'pc', 0, 'A', 'piece'),
(2, 'products', 'packaging_unit', 'packet', 0, 'B', ''),
(3, 'products', 'packaging_unit', 'box', 0, 'C', ''),
(4, 'products', 'packaging_unit', 'pack', 0, 'D', ''),
(5, 'products', 'packaging_unit', 'bag', 0, 'E', ''),
(6, 'products', 'packaging_unit', 'satchet', 0, 'F', ''),
(7, 'ims_requests', 'request_type', 'group_request', 3, '', 'status code'),
(8, 'validation_requests', 'request_type', 'validate_email', 0, '', 'status code'),
(9, 'validation_requests', 'request_type', 'reset_password', 1, '', 'status code'),
(10, 'page_access_level', 'access_level', 'read_only', 1, '', ''),
(11, 'page_access_level', 'access_level', 'read_create', 3, '', ''),
(12, 'page_access_level', 'access_level', 'read_edit', 5, '', ''),
(13, 'page_access_level', 'access_level', 'read_create_edit', 7, '', ''),
(14, 'page_access_level', 'access_level', 'read_delete', 9, '', ''),
(15, 'page_access_level', 'access_level', 'read_edit_delete', 13, '', ''),
(16, 'page_access_level', 'access_level', 'read_create_edit_delete', 15, '', ''),
(17, 'products', 'packaging_unit', 'bar', 0, 'G', ''),
(18, 'products', 'packaging_unit', 'bottle', 0, 'H', ''),
(19, 'products', 'packaging_unit', 'can', 0, 'I', ''),
(20, 'products', 'packaging_unit', 'jar', 0, 'J', ''),
(21, 'products', 'packaging_unit', 'refill', 0, 'K', ''),
(22, 'products', 'packaging_unit', 'roll', 0, 'L', ''),
(23, 'products', 'packaging_unit', 'tin', 0, 'M', ''),
(24, 'products', 'packaging_unit', 'sack', 0, 'N', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` bigint(20) NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `sub_dom_id` bigint(20) NOT NULL,
  `item` varchar(255) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `lot` varchar(25) NOT NULL,
  `per_lot` int(11) NOT NULL,
  `curr_stock_level` int(11) NOT NULL,
  `pending_reserved` int(11) NOT NULL DEFAULT 0,
  `reorder_tresh` int(11) NOT NULL,
  `required_level` int(11) NOT NULL,
  `freq_wt` int(11) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `domain_id`, `sub_dom_id`, `item`, `sku`, `lot`, `per_lot`, `curr_stock_level`, `pending_reserved`, `reorder_tresh`, `required_level`, `freq_wt`) VALUES
(1, 9, 5, 'Airwick (refill)', 'SHU456788', 'ea', 1, 10, 0, 5, 20, 100),
(2, 9, 5, 'Bath Gel', 'SHU456789', 'ea', 1, 230, 23, 100, 500, 100),
(3, 9, 5, 'Body Lotion', 'SHU456790', 'ea', 1, 343, 0, 100, 500, 100),
(4, 9, 5, 'Bath Soap (bar)', 'SHU456791', 'ea', 1, 276, 0, 100, 500, 100),
(5, 9, 5, 'Block airfreshner', 'SHU456792', 'ea', 1, 116, 11, 80, 400, 100),
(6, 9, 5, 'Dental Kit', 'SHU456793', 'ea', 1, 110, 21, 50, 200, 100),
(7, 9, 5, 'Detergent', 'SHU456794', 'ea', 1, 8, 0, 10, 30, 20),
(8, 9, 5, 'Dustbin nylon (colored)', 'SHU456796', 'ea', 1, 33, 0, 50, 200, 20),
(9, 9, 5, 'GBC', 'SHU456797', 'ea', 1, 0, 0, 0, 0, 100),
(10, 9, 5, 'Glass Cleaner', 'SHU456798', 'ea', 1, 19, 0, 4, 20, 100),
(11, 9, 5, 'Handwash', 'SHU456799', 'ea', 1, 11, 0, 5, 25, 20),
(12, 9, 5, 'Harpic', 'SHU456800', 'ea', 1, 26, 0, 5, 30, 20),
(13, 9, 5, 'Hypo', 'SHU456801', 'ea', 1, 7, 0, 5, 15, 20),
(14, 9, 5, 'Individual Liption', 'SHU456802', 'ea', 1, 464, 0, 300, 800, 100),
(15, 9, 5, 'Insecticide', 'SHU456803', 'ea', 1, 18, 0, 4, 20, 15),
(16, 9, 5, 'Izal', 'SHU456804', 'ea', 1, 12, 0, 4, 20, 100),
(17, 9, 5, 'Mama Lemon', 'SHU456805', 'ea', 1, 18, 0, 8, 20, 20),
(18, 9, 5, 'Milo', 'SHU456806', 'ea', 1, 371, 0, 400, 800, 100),
(19, 9, 5, 'Milk', 'SHU456807', 'ea', 1, 497, 0, 400, 800, 100),
(20, 9, 5, 'Multi surface cleaner', 'SHU456808', 'ea', 1, 13, 0, 5, 20, 100),
(21, 9, 5, 'Scouring Pad', 'SHU456809', 'ea', 1, 22, 0, 15, 40, 100),
(22, 9, 5, 'Shower Cap', 'SHU456810', 'ea', 1, 295, 0, 200, 500, 100),
(23, 9, 5, 'Stick Nescafe', 'SHU456811', 'ea', 1, 308, 190, 200, 500, 100),
(24, 9, 5, 'Spray Starch', 'SHU456812', 'ea', 1, 10, 0, 5, 20, 100),
(25, 9, 5, 'Spray Airfreshner', 'SHU456813', 'ea', 1, 27, 0, 8, 25, 15),
(26, 9, 5, 'Sugar', 'SHU456814', 'ea', 1, 9, 4, 20, 50, 15),
(27, 9, 5, 'Super Glue', 'SHU456815', 'ea', 1, 0, 0, 2, 5, 100),
(28, 9, 5, 'Swiss (Liquid Airfreshner)', 'SHU456816', 'ea', 1, 35, 0, 15, 50, 20),
(29, 9, 5, 'Tissue', 'SHU456817', 'ea', 1, 577, 0, 250, 800, 15),
(30, 9, 5, 'Tissue Box', 'SHU456818', 'ea', 1, 83, 0, 50, 200, 100),
(31, 9, 5, 'Vanity Kit', 'SHU456819', 'ea', 1, 112, 0, 50, 200, 100),
(32, 9, 5, 'Vim', 'SHU456820', 'ea', 1, 18, 0, 5, 20, 100),
(33, 2, 1, 'Baked Beans', 'SHU456822', 'ea', 1, 24, 0, 15, 50, 100),
(34, 2, 1, 'Bama', 'SHU456823', 'ea', 1, 9, 0, 10, 40, 100),
(35, 2, 1, 'Black Pepper', 'SHU456825', 'ea', 1, 1, 0, 2, 5, 100),
(36, 2, 1, 'Basmati Rice', 'SHU456826', 'ea', 1, 4, 0, 3, 10, 20),
(37, 2, 1, 'Cameroun Pepper', 'SHU456827', 'ea', 1, 0, 0, 1, 2, 100),
(38, 2, 1, 'Crayfish', 'SHU456828', 'ea', 1, 0, 0, 1, 2, 100),
(39, 2, 1, 'Coconut Milk', 'SHU456829', 'ea', 1, 1, 0, 0, 2, 25),
(40, 2, 1, 'Coffee', 'SHU456830', 'ea', 1, 5, 0, 3, 10, 20),
(41, 2, 1, 'Corned Beef', 'SHU456831', 'ea', 1, 7, 0, 2, 10, 100),
(42, 2, 1, 'Cornflakes', 'SHU456832', 'ea', 1, 5, 0, 4, 10, 15),
(43, 2, 1, 'Cornflour', 'SHU456833', 'ea', 1, 8, 0, 4, 10, 100),
(44, 2, 1, 'Curry Powder', 'SHU456834', 'ea', 1, 6, 0, 4, 10, 20),
(45, 2, 1, 'Custard', 'SHU456835', 'ea', 1, 5, 0, 4, 10, 20),
(46, 2, 1, 'Curry Sauce', 'SHU456836', 'ea', 1, 5, 0, 4, 10, 100),
(47, 2, 1, 'Dried Pepper', 'SHU456837', 'ea', 1, 0, 0, 0, 2, 100),
(48, 2, 1, 'Dustbin Nylon', 'SHU456795', 'ea', 1, 14, 0, 20, 50, 25),
(49, 2, 1, 'Egusi', 'SHU456838', 'ea', 1, 0, 0, 0, 2, 100),
(50, 2, 1, 'Fried Rice Spice', 'SHU456839', 'ea', 1, 5, 0, 5, 10, 100),
(51, 9, 5, 'Fish Spice', 'SHU456840', 'ea', 1, 2, 0, 2, 5, 100),
(52, 9, 5, 'Garlic', 'SHU456841', 'ea', 1, 0, 0, 2, 5, 100),
(53, 9, 5, 'Ginger', 'SHU456842', 'ea', 1, 0, 0, 2, 5, 100),
(54, 9, 5, 'Knorr Chicken Cubes', 'SHU456843', 'ea', 1, 43, 0, 15, 50, 15),
(55, 9, 5, 'Lipton', 'SHU456844', 'ea', 1, 8, 0, 5, 20, 15),
(56, 9, 5, 'Mushroom', 'SHU456845', 'ea', 1, 14, 0, 5, 20, 100),
(57, 9, 5, 'Noodles', 'SHU456846', 'carton', 40, 103, 0, 20, 100, 25),
(58, 9, 5, 'Oat', 'SHU456847', 'ea', 1, 4, 0, 4, 10, 25),
(59, 9, 5, 'Oatmeal', 'SHU456848', 'ea', 1, 0, 0, 1, 2, 100),
(60, 9, 5, 'Pepper soup spice', 'SHU456849', 'ea', 1, 4, 0, 2, 5, 100),
(61, 9, 5, 'Poundo Yam', 'SHU456850', 'ea', 1, 8, 0, 4, 10, 100),
(62, 9, 5, 'Semolina', 'SHU456851', 'ea', 1, 5, 0, 4, 10, 20),
(63, 9, 5, 'Sesame Oil', 'SHU456853', 'ea', 1, 8, 0, 5, 20, 35),
(64, 9, 5, 'Spaghetti', 'SHU456854', 'ea', 1, 20, 0, 4, 20, 15),
(65, 9, 5, 'Sweet Chilli', 'SHU456855', 'ea', 1, 9, 0, 4, 10, 100),
(66, 9, 5, 'Sweet Corn', 'SHU456856', 'ea', 1, 24, 0, 20, 100, 100),
(67, 9, 5, 'Takeaway Pack', 'SHU456857', 'ea', 1, 107, 0, 50, 200, 30),
(68, 9, 5, 'Thyme', 'SHU456858', 'ea', 1, 7, 0, 4, 10, 100),
(69, 9, 5, 'Tin Tomato', 'SHU456859', 'ea', 1, 5, 0, 5, 20, 15),
(70, 9, 5, 'Tomato Ketchup', 'SHU456860', 'ea', 1, 2, 0, 2, 5, 100),
(71, 9, 5, 'Wheat', 'SHU456861', 'ea', 1, 2, 0, 2, 5, 100),
(72, 9, 5, 'White Pepper', 'SHU456862', 'ea', 1, 1, 0, 0, 2, 100),
(73, 9, 5, 'Amarula', 'SHU456863', 'ea', 1, 0, 0, 0, 1, 100),
(74, 9, 5, 'Amstel Malt', 'SHU456864', 'ea', 1, 18, 3, 10, 25, 100),
(75, 9, 5, 'Angustara', 'SHU456865', 'ea', 1, 0, 0, 0, 1, 100),
(76, 9, 5, 'Bacardi (small)', 'SHU456866', 'ea', 1, 1, 0, 0, 1, 100),
(77, 9, 5, 'Baileys', 'SHU456867', 'ea', 1, 0, 0, 0, 1, 100),
(78, 9, 5, 'Berol (red wine)', 'SHU456868', 'ea', 1, 0, 0, 0, 1, 100),
(79, 9, 5, 'Big Water (75cl)', 'SHU456869', 'pack', 12, 5, 12, 10, 20, 100),
(80, 9, 5, 'Bitter Lemon', 'SHU456870', 'ea', 1, 12, 0, 10, 20, 20),
(81, 9, 5, 'Black&White (whiskey)', 'SHU456871', 'ea', 1, 0, 0, 0, 1, 100),
(82, 9, 5, 'Bon voyage', 'SHU456872', 'ea', 1, 0, 0, 0, 1, 100),
(83, 9, 5, 'Budweiser', 'SHU456873', 'ea', 1, 0, 0, 0, 0, 100),
(84, 9, 5, 'Bullet', 'SHU456874', 'ea', 1, 12, 0, 6, 20, 25),
(85, 9, 5, 'Campari', 'SHU456875', 'ea', 1, 2, 0, 0, 5, 100),
(86, 9, 5, 'Captain morgan', 'SHU456876', 'ea', 1, 0, 0, 0, 0, 100),
(87, 9, 5, 'Cabernet Savignon (pride of kings)', 'SHU456877', 'ea', 1, 0, 0, 0, 1, 100),
(88, 9, 5, 'Chivita Juice', 'SHU456878', 'ea', 1, 20, 0, 10, 25, 15),
(89, 9, 5, 'Coke', 'SHU456879', 'pack', 12, 2, 10, 2, 10, 20),
(90, 9, 5, 'Donfelder', 'SHU456880', 'ea', 1, 1, 0, 0, 2, 100),
(91, 9, 5, 'Drostdy hof', 'SHU456881', 'ea', 1, 0, 0, 0, 2, 100),
(92, 9, 5, 'Dubic Malt', 'SHU456882', 'ea', 1, 4, 0, 4, 10, 25),
(93, 9, 5, 'Fanta', 'SHU456883', 'pack', 12, 3, 0, 2, 5, 25),
(94, 9, 5, 'Flirt Vodka (big)', 'SHU456884', 'ea', 1, 1, 0, 0, 1, 100),
(95, 9, 5, 'Flirt Vodka (small)', 'SHU456885', 'ea', 1, 0, 0, 0, 0, 100),
(96, 9, 5, 'Goldberg (bottle)', 'SHU456886', 'ea', 1, 0, 0, 0, 0, 100),
(97, 9, 5, 'Goldberg (can)', 'SHU456887', 'ea', 1, 0, 0, 0, 0, 100),
(98, 9, 5, 'Gordon gin (big)', 'SHU456888', 'ea', 1, 2, 5, 2, 3, 100),
(99, 9, 5, 'Gordon gin (small)', 'SHU456889', 'ea', 1, 0, 0, 2, 3, 100),
(100, 9, 5, 'Greenadine', 'SHU456890', 'ea', 1, 0, 0, 1, 2, 100),
(101, 9, 5, 'Groundnut', 'SHU456891', 'ea', 1, 0, 0, 2, 5, 100),
(102, 9, 5, 'Guiness big stout', 'SHU456892', 'ea', 1, 36, 0, 15, 50, 100),
(103, 9, 5, 'Guiness Malt', 'SHU456893', 'ea', 1, 6, 0, 4, 10, 15),
(104, 9, 5, 'Guiness Stout (can)', 'SHU456894', 'ea', 1, 0, 0, 0, 5, 100),
(105, 9, 5, 'Gulder', 'SHU456895', 'ea', 1, 0, 0, 0, 5, 100),
(106, 9, 5, 'Harp', 'SHU456896', 'ea', 1, 0, 0, 0, 5, 100),
(107, 9, 5, 'Heineken (big)', 'SHU456897', 'ea', 1, 24, 0, 15, 50, 100),
(108, 9, 5, 'Heineken (can)', 'SHU456898', 'ea', 1, 0, 0, 0, 2, 100),
(109, 9, 5, 'Henessy (small)', 'SHU456899', 'ea', 1, 0, 0, 0, 2, 100),
(110, 9, 5, 'Henessy (VSOP)', 'SHU456900', 'ea', 1, 0, 0, 0, 1, 100),
(111, 9, 5, 'Liquid Milk', 'SHU456901', 'ea', 1, 18, 0, 10, 25, 15),
(112, 9, 5, 'Hollandia Yoghurt', 'SHU456902', 'ea', 1, 10, 0, 10, 25, 15),
(113, 9, 5, 'Hunter\'s Dry', 'SHU456903', 'ea', 1, 6, 0, 4, 10, 100),
(114, 9, 5, 'Hunter\'s Gold', 'SHU456904', 'ea', 1, 6, 0, 4, 10, 100),
(115, 9, 5, 'Jameson (big)', 'SHU456905', 'ea', 1, 1, 0, 0, 1, 100),
(116, 9, 5, 'Jameson (small)', 'SHU456906', 'ea', 1, 0, 0, 0, 1, 100),
(117, 9, 5, 'Jim Beam', 'SHU456907', 'ea', 1, 0, 0, 0, 1, 100),
(118, 9, 5, 'Kolaq Alagbo', 'SHU456908', 'ea', 1, 6, 0, 4, 10, 100),
(119, 9, 5, 'Legend (big)', 'SHU456909', 'ea', 1, 0, 0, 0, 1, 100),
(120, 9, 5, 'Lemon juice', 'SHU456910', 'ea', 1, 0, 0, 0, 1, 100),
(121, 9, 5, 'Merlot', 'SHU456912', 'ea', 1, 1, 0, 1, 1, 45),
(122, 9, 5, 'Netherburg Chardonnay', 'SHU456913', 'ea', 1, 0, 0, 0, 1, 100),
(123, 9, 5, 'Netherburg Pinotage', 'SHU456914', 'ea', 1, 1, 0, 1, 1, 100),
(124, 9, 5, 'Netherburg Rose', 'SHU456915', 'ea', 1, 0, 0, 0, 0, 100),
(125, 9, 5, 'Netherburg Savignon Blanc', 'SHU456916', 'ea', 1, 0, 0, 1, 1, 100),
(126, 9, 5, 'Netherburg Savignon Carbernet', 'SHU456917', 'ea', 1, 1, 0, 1, 2, 100),
(127, 9, 5, 'Netherburg Shiraz', 'SHU456918', 'ea', 1, 1, 0, 1, 2, 100),
(128, 9, 5, 'Noble CRU', 'SHU456919', 'ea', 1, 1, 0, 0, 1, 100),
(129, 9, 5, 'Monster', 'SHU456920', 'ea', 1, 8, 0, 4, 10, 15),
(130, 9, 5, 'Origin (bottle)', 'SHU456921', 'ea', 1, 0, 0, 0, 1, 100),
(131, 9, 5, 'Origin (can)', 'SHU456922', 'ea', 1, 0, 0, 0, 1, 100),
(132, 9, 5, 'Origin (small)', 'SHU456923', 'ea', 1, 8, 5, 0, 1, 25),
(133, 9, 5, 'Palmason VSOP', 'SHU456924', 'ea', 1, 0, 0, 0, 1, 100),
(134, 9, 5, 'Palmi', 'SHU456925', 'ea', 1, 0, 0, 0, 1, 100),
(135, 9, 5, 'Powerhorse', 'SHU456926', 'ea', 1, 28, 0, 10, 30, 20),
(136, 9, 5, 'Red Bull', 'SHU456927', 'ea', 1, 24, 0, 10, 30, 20),
(137, 9, 5, 'Red Label', 'SHU456928', 'ea', 1, 0, 0, 0, 1, 100),
(138, 9, 5, 'Realemon 100%', 'SHU456929', 'ea', 1, 1, 0, 1, 2, 100),
(139, 9, 5, 'Robertson Whiskey', 'SHU456931', 'ea', 1, 0, 0, 0, 1, 100),
(140, 9, 5, 'Savannah Dry', 'SHU456932', 'ea', 1, 0, 0, 0, 1, 100),
(141, 9, 5, 'Sierra Tequila', 'SHU456933', 'ea', 1, 0, 0, 0, 1, 100),
(142, 9, 5, 'Small Water (75cl)', 'SHU456934', 'pack', 12, 15, 0, 10, 20, 15),
(143, 9, 5, 'Smirnoff ice (bottle)', 'SHU456935', 'ea', 1, 24, 0, 10, 25, 25),
(144, 9, 5, 'Star radler beer', 'SHU456936', 'ea', 1, 8, 0, 5, 15, 20),
(145, 9, 5, 'Snapp', 'SHU456937', 'ea', 1, 0, 0, 0, 1, 100),
(146, 9, 5, 'Soda water (can)', 'SHU456938', 'ea', 1, 0, 1, 0, 1, 100),
(147, 9, 5, 'Soda water (plastic)', 'SHU456939', 'ea', 1, 2, 0, 4, 10, 100),
(148, 9, 5, 'Sprite', 'SHU456940', 'pack', 12, 1, 0, 2, 5, 30),
(149, 9, 5, 'Star (bottle)', 'SHU456941', 'ea', 1, 0, 0, 0, 1, 100),
(150, 9, 5, 'star (can)', 'SHU456942', 'ea', 1, 0, 0, 0, 1, 100),
(151, 9, 5, 'Tequila Blanco (small)', 'SHU456943', 'ea', 1, 0, 0, 0, 1, 100),
(152, 9, 5, 'Tequila Blanco (big)', 'SHU456944', 'ea', 1, 0, 0, 0, 1, 100),
(153, 9, 5, 'Tequila gold', 'SHU456945', 'ea', 1, 1, 0, 0, 1, 100),
(154, 9, 5, 'Three Barrel VSOP', 'SHU456947', 'ea', 1, 0, 0, 0, 1, 100),
(155, 9, 5, 'Trophy', 'SHU456948', 'ea', 1, 36, 0, 15, 50, 100),
(156, 9, 5, 'Valdieviso', 'SHU456949', 'ea', 1, 0, 0, 0, 1, 100),
(157, 9, 5, 'Water (complementary)', 'SHU456950', 'pack', 1, 3, 0, 5, 10, 100),
(158, 9, 5, 'Williams lawson (big)', 'SHU456952', 'ea', 1, 0, 0, 0, 1, 100),
(159, 9, 5, 'Williams lawson (small)', 'SHU456953', 'ea', 1, 0, 0, 0, 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `stock_txns`
--

CREATE TABLE `stock_txns` (
  `id` bigint(20) NOT NULL,
  `txn_date` datetime NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `sub_dom_id` bigint(20) NOT NULL,
  `table_str` varchar(50) NOT NULL,
  `record_id` bigint(20) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `action_type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store_reqs`
--

CREATE TABLE `store_reqs` (
  `id` bigint(20) NOT NULL,
  `requisition_no` varchar(20) NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `sub_dom_id` bigint(20) NOT NULL,
  `brief_description` varchar(500) NOT NULL,
  `requester_id` bigint(20) NOT NULL,
  `approver_id` bigint(20) NOT NULL,
  `approver_notes` varchar(550) NOT NULL,
  `storekeeper_id` bigint(20) NOT NULL,
  `storekeeper_notes` varchar(550) NOT NULL,
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `rel_request_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_reqs`
--

INSERT INTO `store_reqs` (`id`, `requisition_no`, `domain_id`, `sub_dom_id`, `brief_description`, `requester_id`, `approver_id`, `approver_notes`, `storekeeper_id`, `storekeeper_notes`, `request_date`, `status`, `rel_request_id`) VALUES
(1, 'RGBE5536', 9, 5, 'Requisition #1 for House Keeping', 24, 30, '', 26, '', '2021-11-18 10:36:59', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `store_req_line_items`
--

CREATE TABLE `store_req_line_items` (
  `id` bigint(20) NOT NULL,
  `requisition_id` bigint(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `requested_qty` int(11) NOT NULL,
  `issued_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subdomains`
--

CREATE TABLE `subdomains` (
  `id` bigint(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `parent_domain_id` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subdomains`
--

INSERT INTO `subdomains` (`id`, `name`, `parent_domain_id`, `description`) VALUES
(1, 'acme_main', 2, 'Default sub-domain'),
(2, 'addide_main', 6, 'Default sub-domain'),
(3, 'boyawek_main', 7, 'Default sub-domain'),
(4, 'default_main', 10, 'Default sub-domain'),
(5, 'h1plus_main', 9, 'Default sub-domain'),
(6, 'jaagee_main', 8, 'Default sub-domain'),
(7, 'jumia_main', 4, 'Default sub-domain'),
(8, 'konga_main', 3, 'Default sub-domain'),
(9, 'kustomlynx_main', 1, 'Default sub-domain'),
(10, 'root_main', 11, 'Default sub-domain'),
(11, 'supermart_main', 5, 'Default sub-domain'),
(12, 'root_test', 11, 'Test sub-domain for root'),
(17, 'Store01', 7, 'Store #1'),
(18, 'Store02', 7, 'Store #2'),
(19, 'Store03', 7, 'Store #3');

-- --------------------------------------------------------

--
-- Table structure for table `subdomains_users`
--

CREATE TABLE `subdomains_users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `sub_dom_id` bigint(20) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subdomains_users`
--

INSERT INTO `subdomains_users` (`id`, `user_id`, `sub_dom_id`, `notes`) VALUES
(1, 1, 10, ''),
(2, 2, 9, ''),
(3, 5, 9, ''),
(4, 7, 4, ''),
(5, 8, 10, ''),
(6, 24, 5, ''),
(7, 25, 5, ''),
(8, 26, 4, ''),
(9, 27, 5, ''),
(10, 28, 5, ''),
(11, 29, 5, ''),
(12, 30, 5, ''),
(13, 31, 1, ''),
(14, 32, 1, ''),
(15, 8, 12, ''),
(16, 39, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `sys_settings`
--

CREATE TABLE `sys_settings` (
  `id` bigint(20) NOT NULL,
  `sys_key` varchar(50) NOT NULL,
  `sys_value` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sys_settings`
--

INSERT INTO `sys_settings` (`id`, `sys_key`, `sys_value`, `description`) VALUES
(1, 'system_name', 'iManager Inventory Management System', ''),
(2, 'system_shortname', 'IMS', ''),
(3, 'company_name', 'Reilppus Limited', ''),
(4, 'company_email', 'sales@reilppus.com', ''),
(5, 'company_address', '210/212 Herbert Macaulay Way,\r\nYaba, Lagos', ''),
(6, 'system_logo', 'no-image-available.png', ''),
(7, 'dom_function_1', 'Role and Group Admin', ''),
(8, 'dom_function_2', 'User Admin', ''),
(9, 'dom_function_3', 'Store Requisition Creator', ''),
(10, 'dom_function_4', 'Store Requisition Approver', 'Configurable Levels'),
(11, 'dom_function_5', 'Store Keeper Issuing', ''),
(12, 'dom_function_6', 'Store Keeper Receiving', ''),
(13, 'dom_function_7', 'Customer Purchase Requisition Creator', ''),
(14, 'dom_function_8', 'Customer Purchase Requisition Approver', 'Configurable Levels'),
(15, 'dom_function_9', 'Customer Purchase Order Issuer', ''),
(16, 'dom_function_10', 'Supplier Purchase Requisition Creator', ''),
(17, 'dom_function_11', 'Supplier Purchase Requisition Approver', 'Configurable Levels'),
(18, 'dom_function_12', 'Supplier Purchase Order Issuer', ''),
(19, 'dom_function_13', 'Stock Editor', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL,
  `student_name` text NOT NULL,
  `student_phone` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `student_name`, `student_phone`, `image`) VALUES
(1, 'Gary M. Boyd', '847-736-9617', ''),
(2, 'Carl N. Fries', '773-613-7843', ''),
(3, 'Judy R. Rogers', '606-279-9337', ''),
(4, 'Dan V. McLendon', '954-776-1615', ''),
(5, 'Jacqueline J. Sheffield', '703-375-7072', ''),
(6, 'John Smith', '847-736-9617', ''),
(7, 'Peter Parker', '773-613-7843', ''),
(8, 'Donna Hubber', '606-279-9337', ''),
(24, 'Gary M. Boyd', '847-736-9617', ''),
(25, 'Carl N. Fries', '773-613-7843', ''),
(26, 'Judy R. Rogers', '606-279-9337', ''),
(27, 'Dan V. McLendon', '954-776-1615', ''),
(28, 'Jacqueline J. Sheffield', '703-375-7072', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `domain` bigint(20) NOT NULL,
  `groupid` int(11) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` text DEFAULT 'no-image-available.svg',
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `domain`, `groupid`, `verified`, `avatar`, `created_on`) VALUES
(1, 'Administrator', 'admin@admin.com', '$2y$10$Vgk/GATWeZZs2HKBUHZsc.mzEE2vkEJMBxN5HmBKKZxgD/VNdEAaG', 11, 2, 1, 'no-image-available.svg', '2021-09-11 20:47:41'),
(2, 'Kylo Ren', 'kylo@gmail.com', '$2y$10$Wi.XmHp6lK3sVY9E2f.HfeNJ6noaN/fYDYYmh1ETcdfOqvqEG.Qra', 1, 1, 1, 'no-image-available.svg', '2021-09-10 22:04:15'),
(5, 'Kayode Ayodele', 'kayodele@oauife.edu.ng', '$2y$10$Bcvodf5Kj6aRf2jluvVsC.QyMLt5ILmmC5lyFkx1jOoISdjG1Honu', 10, 1, 1, 'no-image-available.svg', '2021-09-12 17:57:31'),
(7, 'Isaac Inyang', 'iainyang@roscosmos.ru', '$2y$10$w3DowpZVumpByLIWQomyI.hRkMoYaEyFugmB1FUKE2PjRDr64aPSS', 1, 1, 1, 'no-image-available.svg', '2021-10-16 12:15:50'),
(8, 'Tammi Takaya', 'tb.takaya@gmail.com', '$2y$10$lj9G9E5msLCTTwOhVnl3WuQbZV0dr86DTt2ajAp0I/jzObvtdTIWC', 11, 2, 1, '1636721520_person 4.jpg', '2021-11-03 20:05:32'),
(24, 'Mary Onyali', 'mary.onyali@h1plus.com', '$2y$10$COTqAV3Qxm9Hu5I.sDUzE.7nYRrOHNmg.cQzXfjKwgFojbPL82HU2', 9, 1, 1, 'no-image-available.svg', '2021-11-12 19:39:57'),
(25, 'Motunrayo Adeniji', 'tunrayo@h1plus.com', '$2y$10$DX1k/mI8im7m8tw2Xe5F6.QuEvJmGCYa2h4CIX86HYm.7F2aSdEqW', 9, 1, 0, 'no-image-available.svg', '2021-11-12 19:40:49'),
(26, 'Tunde Edwards', 'tunde.edwards@gmail.com', '$2y$10$QqhUnzMWGoKtIn4BaXKZMOzP0Vyz6yUXzTrd6A57pjNzZ8LjkHcSC', 9, 1, 0, 'no-image-available.svg', '2021-11-12 19:41:32'),
(27, 'Cynthia Rothfuss', 'cynthia@h1plus.com', '$2y$10$riYp8n0pbMfRevsk/kI7EepDywBLoSRM8PQ4DYucn4Z7o5Eaq/j7G', 9, 1, 0, 'no-image-available.svg', '2021-11-12 19:42:15'),
(28, 'Millicent Adewale', 'millicent.adewale@h1plus.com', '$2y$10$n4I56SeTVecbPivAx/bmj.aSqZ5GbQl70d9daw0ESqEY/8MxSl.FG', 9, 1, 0, 'no-image-available.svg', '2021-11-12 19:55:20'),
(29, 'Bolaji Kehinde', 'bolaji.kehinde@h1plus.com', '$2y$10$Ar8nmY3cz7TnApRaNmut/.6iPxKdBQxk4l303T/o0fgzfCXEiRhdu', 9, 1, 0, 'no-image-available.svg', '2021-11-12 19:57:10'),
(30, 'Usman Ajadu', 'usman.ajadu@h1plus.com', '$2y$10$cl/GzSJS/IjMOKqJxpKvO.0w1VxzUo8FshBqIZiDXyLoT2DEWtEja', 9, 1, 0, 'no-image-available.svg', '2021-11-12 19:59:15'),
(31, 'Macmillan Sonore', 'mac.sonore@acme.com', '$2y$10$UFshjO6Qsb2PbgQmN7xwC.qZFYMDZ3snCvlu/3jd4uc1.oq61apRm', 2, 1, 0, 'no-image-available.svg', '2021-11-12 20:11:19'),
(32, 'Haruna Ahmed', 'haruna.ahmed@acme.com', '$2y$10$MBxe6dObhxJkHk4z5iSjd.CGXG.hwUYwEkeF8xnc8wmqjS6rrPeX6', 2, 1, 1, 'no-image-available.svg', '2021-11-12 21:22:51'),
(39, 'Max Maxted', 'max.maxted@gmail.com', '$2y$10$xygXkcr/rR9Q/al0A8F/WOcI08so7pcWAO2xdxJD7oxBHnZlpBAJq', 7, 1, 1, '1637361420_person 3.jpg', '2021-11-19 23:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `validation_requests`
--

CREATE TABLE `validation_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `timestamp` int(10) UNSIGNED DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendors_products`
--

CREATE TABLE `vendors_products` (
  `id` bigint(20) NOT NULL,
  `domain_id` bigint(20) NOT NULL,
  `sub_dom_id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `provisional_sku` varchar(20) NOT NULL,
  `product_name_descr` varchar(255) NOT NULL,
  `feature` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `lot` varchar(20) NOT NULL,
  `qty_per_offer` int(11) NOT NULL,
  `offer_price` double NOT NULL,
  `offer_date` datetime NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(4) NOT NULL,
  `main_pix` varchar(255) NOT NULL,
  `gallery_pix_id` bigint(20) NOT NULL,
  `attributes` varchar(255) NOT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `ipc` varchar(20) DEFAULT NULL,
  `batch_no` varchar(20) DEFAULT NULL,
  `produced_on` date DEFAULT NULL,
  `expires_on` date DEFAULT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors_products`
--

INSERT INTO `vendors_products` (`id`, `domain_id`, `sub_dom_id`, `vendor_id`, `brand`, `category`, `provisional_sku`, `product_name_descr`, `feature`, `unit`, `lot`, `qty_per_offer`, `offer_price`, `offer_date`, `active`, `main_pix`, `gallery_pix_id`, `attributes`, `serial_no`, `ipc`, `batch_no`, `produced_on`, `expires_on`, `created_on`, `created_by`) VALUES
(1, 3, 8, 3, 'Airwick', 'Air Freshener', 'SHU456788', 'Air wick Freshmatic Refill Air Freshener - Sparkling Citrux X2', '500ml', 'refill', 'pack', 2, 3861.7, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(2, 4, 7, 4, 'Airwick', 'Air Freshener', 'UKN456788', 'Air wick Freshmatic Refill Air Freshener - Sparkling Citrux X2', '500ml', 'refill', 'pack', 2, 4013.82, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(3, 5, 11, 5, 'Airwick', 'Air Freshener', 'UKN456788', 'Air wick Freshmatic Refill Air Freshener - Sparkling Citrux X2', '500ml', 'refill', 'pack', 2, 3898.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(4, 6, 2, 6, 'Airwick', 'Air Freshener', 'UKN456788', 'Air wick Freshmatic Refill Air Freshener - Sparkling Citrux X2', '500ml', 'refill', 'pack', 2, 4281.74, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(5, 4, 7, 4, 'Clearasil', 'Soaps and Detergents', 'UKN456789', 'Clearasil Shower Gel', '300ml', 'bottle', 'ea', 1, 4195.62, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(6, 6, 2, 6, 'Clearasil', 'Soaps and Detergents', 'SHU456789', 'Clearasil Shower Gel', '300ml', 'bottle', 'ea', 1, 3751.9, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(7, 6, 2, 6, 'Nivea', 'Soaps and Detergents', 'UKN456790', 'NIVEA Vanilla & Almond Oil Body Lotion For Women - 400ml (Pack Of 2)', '400ml', 'bottle', 'pack', 2, 3369.32, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(8, 4, 7, 4, 'Nivea', 'Soaps and Detergents', 'SHU456790', 'NIVEA Vanilla & Almond Oil Body Lotion For Women - 400ml (Pack Of 2)', '400ml', 'bottle', 'pack', 2, 3528.46, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(9, 5, 11, 5, 'Nivea', 'Soaps and Detergents', 'SHU456790', 'NIVEA Vanilla & Almond Oil Body Lotion For Women - 400ml (Pack Of 2)', '400ml', 'bottle', 'pack', 2, 3411.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(10, 3, 8, 3, 'Dettol', 'Soaps and Detergents', 'UKN456791', 'Dettol Even Tone Anti-Bacterial Soap - 65g (Pack Of 6)', '65g', 'bar', 'pack', 6, 748.12, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(11, 4, 7, 4, 'Dettol', 'Soaps and Detergents', 'SHU456791', 'Dettol Even Tone Anti-Bacterial Soap - 65g (Pack Of 6)', '65g', 'bar', 'pack', 6, 774.32, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(12, 5, 11, 5, 'Dettol', 'Soaps and Detergents', 'SHU456791', 'Dettol Even Tone Anti-Bacterial Soap - 65g (Pack Of 6)', '65g', 'bar', 'pack', 6, 738.81, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(13, 6, 2, 6, 'Dettol', 'Soaps and Detergents', 'SHU456791', 'Dettol Even Tone Anti-Bacterial Soap - 65g (Pack Of 6)', '65g', 'bar', 'pack', 6, 767.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(14, 7, 3, 7, 'Dettol', 'Soaps and Detergents', 'SHU456791', 'Dettol Even Tone Anti-Bacterial Soap - 65g (Pack Of 6)', '65g', 'bar', 'pack', 6, 749.04, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(15, 8, 6, 8, 'Dettol', 'Soaps and Detergents', 'SHU456791', 'Dettol Even Tone Anti-Bacterial Soap - 65g (Pack Of 6)', '65g', 'bar', 'pack', 6, 735.8, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(16, 4, 7, 4, 'Wind', 'Air Freshener', 'UKN456792', 'Wind Block Air Fresheners (12 Packs)', '50g', 'bar', 'pack', 12, 3178.8, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(17, 6, 2, 6, 'Wind', 'Air Freshener', 'SHU456792', 'Wind Block Air Fresheners (12 Packs)', '50g', 'bar', 'pack', 12, 3281.77, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(18, 8, 6, 8, 'Wind', 'Air Freshener', 'SHU456792', 'Wind Block Air Fresheners (12 Packs)', '50g', 'bar', 'pack', 12, 3163.53, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(19, 8, 6, 8, 'Spring Fresh', 'Air Freshener', 'SHU456793', 'Spring Fresh ORAL CARE KIT FOR CLEAN TEETH AND GUMS', '200g', 'pc', 'ea', 1, 2921.19, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(20, 3, 8, 3, 'Spring Fresh', 'Air Freshener', 'UKN456793', 'Spring Fresh ORAL CARE KIT FOR CLEAN TEETH AND GUMS', '200g', 'pc', 'ea', 1, 2933.61, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(21, 4, 7, 4, 'Spring Fresh', 'Air Freshener', 'SHU456793', 'Spring Fresh ORAL CARE KIT FOR CLEAN TEETH AND GUMS', '200g', 'pc', 'ea', 1, 3131.25, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(22, 4, 7, 4, 'Sunlight', 'Soaps and Detergents', 'SHU456794', 'Sunlight Detergent Powder 900g', '900g', 'bag', 'ea', 1, 1865.91, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(23, 5, 11, 5, 'Sunlight', 'Soaps and Detergents', 'SHU456794', 'Sunlight Detergent Powder 900g', '900g', 'bag', 'ea', 1, 1797.18, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(24, 6, 2, 6, 'Sunlight', 'Soaps and Detergents', 'SHU456794', 'Sunlight Detergent Powder 900g', '900g', 'bag', 'ea', 1, 1744.04, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(25, 7, 3, 7, 'Sunlight', 'Soaps and Detergents', 'SHU456794', 'Sunlight Detergent Powder 900g', '900g', 'bag', 'ea', 1, 1765.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(26, 3, 8, 3, 'Generic', 'Waste Bags', 'SHU456795', '1pc of 20 Heavy Duty Trash /Refuse /Waste Bin Bag Nylon', '1metre', 'roll', 'ea', 1, 2629.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(27, 6, 2, 6, 'Generic', 'Waste Bags', 'SHU456795', '1pc of 20 Heavy Duty Trash /Refuse /Waste Bin Bag Nylon', '1metre', 'roll', 'ea', 1, 2546.94, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(28, 4, 7, 4, 'Generic', 'Waste Bags', 'SHU456795', '1pc of 20 Heavy Duty Trash /Refuse /Waste Bin Bag Nylon', '1metre', 'roll', 'ea', 1, 2713.86, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(29, 7, 3, 7, 'Generic', 'Waste Bags', 'SHU456795', '1pc of 20 Heavy Duty Trash /Refuse /Waste Bin Bag Nylon', '1metre', 'roll', 'ea', 1, 2691.36, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(30, 3, 8, 3, 'Tabby', 'Waste Bags', 'SHU456796', 'Colored 3 In 1 Trash Bags Garbage Bags Waste Nylon Bags (90 pcs per roll)', '1metre', 'roll', 'ea', 1, 2806.45, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(31, 4, 7, 4, 'Tabby', 'Waste Bags', 'SHU456796', 'Colored 3 In 1 Trash Bags Garbage Bags Waste Nylon Bags (90 pcs per roll)', '1metre', 'roll', 'ea', 1, 2678.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(32, 3, 8, 3, 'GBC', 'Air Freshener', 'SHU456797', 'Gbc TOP QUALITY SUPER AIR FRESHENER - 500ml X 3PCS', '500ml', 'spray', 'pack', 3, 4091.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(33, 4, 7, 4, 'Windolene', 'Cleaning Liquids and Sprays', 'SHU456798', 'Windolene Glass & Shiny Surfaces- 750ml X3', '750ml', 'bottle', 'pack', 3, 7068.64, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(34, 5, 11, 5, 'Windolene', 'Cleaning Liquids and Sprays', 'SHU456798', 'Windolene Glass & Shiny Surfaces- 750ml X3', '750ml', 'bottle', 'pack', 3, 7759.18, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(35, 6, 2, 6, 'Windolene', 'Cleaning Liquids and Sprays', 'SHU456798', 'Windolene Glass & Shiny Surfaces- 750ml X3', '750ml', 'bottle', 'pack', 3, 7787.04, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(36, 3, 8, 3, 'Certex', 'Soaps and Detergents', 'SHU456799', 'Certex 500ml Certex Antibacterial Handwash', '500ml', 'bottle', 'ea', 1, 4548.52, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(37, 4, 7, 4, 'Harpic', 'Soaps and Detergents', 'SHU456800', 'Harpic Toilet Cleaner: Power Plus 725ml', '725ml', 'bottle', 'ea', 1, 987.36, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(38, 3, 8, 3, 'Hypo', 'Soaps and Detergents', 'SHU456801', 'Hypo Bleach Lime 3.5L (1 Piece)', '3.5L', 'bottle', 'ea', 1, 1877.03, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(39, 6, 2, 6, 'Hypo', 'Soaps and Detergents', 'SHU456801', 'Hypo Bleach Lime 3.5L (1 Piece)', '3.5L', 'bottle', 'ea', 1, 1825.54, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(40, 4, 7, 4, 'Hypo', 'Soaps and Detergents', 'SHU456801', 'Hypo Bleach Lime 3.5L (1 Piece)', '3.5L', 'bottle', 'ea', 1, 1907.83, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(41, 7, 3, 7, 'Hypo', 'Soaps and Detergents', 'SHU456801', 'Hypo Bleach Lime 3.5L (1 Piece)', '3.5L', 'bottle', 'ea', 1, 1915.48, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(42, 8, 6, 8, 'Hypo', 'Soaps and Detergents', 'SHU456801', 'Hypo Bleach Lime 3.5L (1 Piece)', '3.5L', 'bottle', 'ea', 1, 1874.65, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(43, 5, 11, 5, 'Hypo', 'Soaps and Detergents', 'SHU456801', 'Hypo Bleach Lime 3.5L (1 Piece)', '3.5L', 'bottle', 'ea', 1, 1787.33, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(44, 3, 8, 3, 'Lipton', 'Teas and Beverages', 'SHU456802', 'Lipton America\'s Favourite Black Tea-104 Tea Bags', '', 'satchet', 'packet', 104, 3350.56, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(45, 6, 2, 6, 'Lipton', 'Teas and Beverages', 'SHU456802', 'Lipton America\'s Favourite Black Tea-104 Tea Bags', '', 'satchet', 'packet', 104, 3362.56, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(46, 4, 7, 4, 'Lipton', 'Teas and Beverages', 'SHU456802', 'Lipton America\'s Favourite Black Tea-104 Tea Bags', '', 'satchet', 'packet', 104, 3381.8, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(47, 7, 3, 7, 'Lipton', 'Teas and Beverages', 'SHU456802', 'Lipton America\'s Favourite Black Tea-104 Tea Bags', '', 'satchet', 'packet', 104, 3559.27, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(48, 8, 6, 8, 'Lipton', 'Teas and Beverages', 'SHU456802', 'Lipton America\'s Favourite Black Tea-104 Tea Bags', '', 'satchet', 'packet', 104, 3552.07, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(49, 4, 7, 4, 'Mortein', 'Insecticides and Pesticides', 'SHU456803', 'Mortein Multi Insect Killer - 400ml (33% Extra Free)', '400ml', 'can', 'ea', 1, 882.2, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(50, 3, 8, 3, 'Mortein', 'Insecticides and Pesticides', 'SHU456803', 'Mortein Multi Insect Killer - 400ml (33% Extra Free)', '400ml', 'can', 'ea', 1, 870.66, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(51, 5, 11, 5, 'Mortein', 'Insecticides and Pesticides', 'SHU456803', 'Mortein Multi Insect Killer - 400ml (33% Extra Free)', '400ml', 'can', 'ea', 1, 847.59, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(52, 6, 2, 6, 'Mortein', 'Insecticides and Pesticides', 'SHU456803', 'Mortein Multi Insect Killer - 400ml (33% Extra Free)', '400ml', 'can', 'ea', 1, 901.9, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(53, 6, 2, 6, 'Izal', 'Cleaning Liquids and Sprays', 'SHU456804', 'Izal Germicide / Disinfectant 2 pc', '', 'pc', 'pack', 2, 3443.84, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(54, 4, 7, 4, 'Izal', 'Cleaning Liquids and Sprays', 'SHU456804', 'Izal Germicide / Disinfectant 2 pc', '', 'pc', 'pack', 2, 3601.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(55, 3, 8, 3, 'Mama Lemon', 'Soaps and Detergents', 'SHU456805', 'Mama Lemon 550ml X 1 Liquid Dish Washing Soap', '550ml', 'bottle', 'ea', 1, 1527.57, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(56, 5, 11, 5, 'Mama Lemon', 'Soaps and Detergents', 'SHU456805', 'Mama Lemon 550ml X 1 Liquid Dish Washing Soap', '550ml', 'bottle', 'ea', 1, 1400.46, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(57, 6, 2, 6, 'Mama Lemon', 'Soaps and Detergents', 'SHU456805', 'Mama Lemon 550ml X 1 Liquid Dish Washing Soap', '550ml', 'bottle', 'ea', 1, 1444.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(58, 3, 8, 3, 'Milo', 'Teas and Beverages', 'SHU456806', 'Nestle Milo 20g X 10 X 10(100 Sachet)', '20g', 'satchet', 'pack', 100, 6731.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(59, 4, 7, 4, 'Milo', 'Teas and Beverages', 'SHU456806', 'Nestle Milo 20g X 10 X 10(100 Sachet)', '20g', 'satchet', 'pack', 100, 6579.68, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(60, 5, 11, 5, 'Milo', 'Teas and Beverages', 'SHU456806', 'Nestle Milo 20g X 10 X 10(100 Sachet)', '20g', 'satchet', 'pack', 100, 6133.79, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(61, 6, 2, 6, 'Milo', 'Teas and Beverages', 'SHU456806', 'Nestle Milo 20g X 10 X 10(100 Sachet)', '20g', 'satchet', 'pack', 100, 6492.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(62, 8, 6, 8, 'Peak', 'Milk and Yoghurt', 'SHU456807', 'Peak Filled Milk Pouch 12g X 10 (powder)', '12g', 'satchet', 'pack', 10, 1102.54, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(63, 5, 11, 5, 'Peak', 'Milk and Yoghurt', 'SHU456807', 'Peak Filled Milk Pouch 12g X 10 (powder)', '12g', 'satchet', 'pack', 10, 997.58, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(64, 4, 7, 4, 'Peak', 'Milk and Yoghurt', 'SHU456807', 'Peak Filled Milk Pouch 12g X 10 (powder)', '12g', 'satchet', 'pack', 10, 1101.96, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(65, 4, 7, 4, 'Deep Action', 'Cleaning Liquids and Sprays', 'SHU456808', 'DEEP ACTION Multi-Purpose Cleaner Lemon- 1000ml Spray', '1000ml', 'bottle', 'ea', 1, 2867.51, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(66, 3, 8, 3, 'Deep Action', 'Cleaning Liquids and Sprays', 'SHU456808', 'DEEP ACTION Multi-Purpose Cleaner Lemon- 1000ml Spray', '1000ml', 'bottle', 'ea', 1, 3163.73, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(67, 3, 8, 3, 'Generic', 'Cleaning Utilities', 'SHU456809', '6 Pieces Sponge Scouring Pad', '', 'pc', 'pack', 6, 2030.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(68, 4, 7, 4, 'Generic', 'Cleaning Utilities', 'SHU456809', '6 Pieces Sponge Scouring Pad', '', 'pc', 'pack', 6, 1892.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(69, 5, 11, 5, 'Generic', 'Cleaning Utilities', 'SHU456809', '6 Pieces Sponge Scouring Pad', '', 'pc', 'pack', 6, 2105.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(70, 6, 2, 6, 'Generic', 'Cleaning Utilities', 'SHU456809', '6 Pieces Sponge Scouring Pad', '', 'pc', 'pack', 6, 1907.52, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(71, 5, 11, 5, 'Generic', 'Toiletries', 'SHU456810', '100x SPA Salon Home Hotel Disposable Bathing Shower Caps Hats Hair', '', 'pc', 'pack', 100, 2374.53, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(72, 3, 8, 3, 'Nescafe', 'Teas and Beverages', 'SHU456811', 'Nestle Nescafe Nescafe Classic Sticks 2g X 20', '2g', 'satchet', 'pack', 20, 1039.02, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(73, 4, 7, 4, 'Nescafe', 'Teas and Beverages', 'SHU456811', 'Nestle Nescafe Nescafe Classic Sticks 2g X 20', '2g', 'satchet', 'pack', 20, 984.42, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(74, 5, 11, 5, 'Nescafe', 'Teas and Beverages', 'SHU456811', 'Nestle Nescafe Nescafe Classic Sticks 2g X 20', '2g', 'satchet', 'pack', 20, 1040.46, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(75, 6, 2, 6, 'Nescafe', 'Teas and Beverages', 'SHU456811', 'Nestle Nescafe Nescafe Classic Sticks 2g X 20', '2g', 'satchet', 'pack', 20, 965.7, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(76, 7, 3, 7, 'Nescafe', 'Teas and Beverages', 'SHU456811', 'Nestle Nescafe Nescafe Classic Sticks 2g X 20', '2g', 'satchet', 'pack', 20, 979.38, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(77, 3, 8, 3, 'Faultless', 'Cleaning Liquids and Sprays', 'SHU456812', 'Faultless Heavy Spray Starch For Professional Ironing', '', 'can', 'ea', 1, 2183.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(78, 4, 7, 4, 'Faultless', 'Cleaning Liquids and Sprays', 'SHU456812', 'Faultless Heavy Spray Starch For Professional Ironing', '', 'can', 'ea', 1, 2257.14, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(79, 5, 11, 5, 'Faultless', 'Cleaning Liquids and Sprays', 'SHU456812', 'Faultless Heavy Spray Starch For Professional Ironing', '', 'can', 'ea', 1, 2243.15, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(80, 5, 11, 5, 'Secret Love', 'Air Freshener', 'SHU456813', 'Secret Love Heaven Air Freshener Spray 300ML', '', 'can', 'ea', 1, 2436.18, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(81, 3, 8, 3, 'St Louis', 'Teas and Beverages', 'SHU456814', 'St Louis Cube Sugar 500g X Pack Of 3', '500g', 'pkt', 'pack', 3, 2829.12, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(82, 4, 7, 4, 'St Louis', 'Teas and Beverages', 'SHU456814', 'St Louis Cube Sugar 500g X Pack Of 3', '500g', 'pkt', 'pack', 3, 2910.16, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(83, 5, 11, 5, 'St Louis', 'Teas and Beverages', 'SHU456814', 'St Louis Cube Sugar 500g X Pack Of 3', '500g', 'pkt', 'pack', 3, 3179.3, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(84, 6, 2, 6, 'St Louis', 'Teas and Beverages', 'SHU456814', 'St Louis Cube Sugar 500g X Pack Of 3', '500g', 'pkt', 'pack', 3, 2971.91, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(85, 7, 3, 7, 'St Louis', 'Teas and Beverages', 'SHU456814', 'St Louis Cube Sugar 500g X Pack Of 3', '500g', 'pkt', 'pack', 3, 2858.43, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(86, 3, 8, 3, 'Generic', 'Adhesives and Sealants', 'SHU456815', 'Super Glue (12pcs)', '', 'pc', 'pack', 12, 1679.42, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(87, 4, 7, 4, 'Generic', 'Adhesives and Sealants', 'SHU456815', 'Super Glue (12pcs)', '', 'pc', 'pack', 12, 1732.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(88, 5, 11, 5, 'Generic', 'Adhesives and Sealants', 'SHU456815', 'Super Glue (12pcs)', '', 'pc', 'pack', 12, 1610.73, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(89, 6, 2, 6, 'Generic', 'Adhesives and Sealants', 'SHU456815', 'Super Glue (12pcs)', '', 'pc', 'pack', 12, 1703.22, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(90, 7, 3, 7, 'Generic', 'Adhesives and Sealants', 'SHU456815', 'Super Glue (12pcs)', '', 'pc', 'pack', 12, 1719.52, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(91, 8, 6, 8, 'Generic', 'Adhesives and Sealants', 'SHU456815', 'Super Glue (12pcs)', '', 'pc', 'pack', 12, 1700.71, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(92, 5, 11, 5, 'Swiss', 'Air Freshener', 'SHU456816', 'Swiss 3 In 1 Flower Liquid Air Freshener 500ML 3pieces', '500ml', 'bottle', 'pack', 3, 3847.3, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(93, 6, 2, 6, 'Swiss', 'Air Freshener', 'SHU456816', 'Swiss 3 In 1 Flower Liquid Air Freshener 500ML 3pieces', '500ml', 'bottle', 'pack', 3, 3936.31, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(94, 3, 8, 3, 'Rose', 'Toiletries', 'SHU456817', 'Rose Tissue', '', 'roll', 'pack', 12, 1947.06, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(95, 4, 7, 4, 'Rose', 'Toiletries', 'SHU456817', 'Rose Tissue', '', 'roll', 'pack', 12, 1964.86, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(96, 5, 11, 5, 'Rose', 'Toiletries', 'SHU456817', 'Rose Tissue', '', 'roll', 'pack', 12, 2040.95, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(97, 6, 2, 6, 'Rose', 'Toiletries', 'SHU456817', 'Rose Tissue', '', 'roll', 'pack', 12, 2032.34, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(98, 4, 7, 4, 'Generic', 'Toiletries', 'SHU456818', 'Quality Tissue Box For Home And Offices::', '', 'box', 'ea', 1, 3498.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(99, 5, 11, 5, 'Generic', 'Toiletries', 'SHU456818', 'Quality Tissue Box For Home And Offices::', '', 'box', 'ea', 1, 3734.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(100, 6, 2, 6, 'Generic', 'Toiletries', 'SHU456818', 'Quality Tissue Box For Home And Offices::', '', 'box', 'ea', 1, 3531.19, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(101, 4, 7, 4, 'Generic', 'Toiletries', 'SHU456819', 'Hotel Guest Amenity (Vanity Kit)', '', 'pack', 'ea', 1, 104.66, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(102, 5, 11, 5, 'Generic', 'Toiletries', 'SHU456819', 'Hotel Guest Amenity (Vanity Kit)', '', 'pack', 'ea', 1, 99.07, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(103, 3, 8, 3, 'Morning Fresh', 'Soaps and Detergents', 'SHU456820', 'Morning Fresh Scouring Powder', '', 'pc', 'ea', 1, 1598.48, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(104, 4, 7, 4, 'Morning Fresh', 'Soaps and Detergents', 'SHU456820', 'Morning Fresh Scouring Powder', '', 'pc', 'ea', 1, 1800.37, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(105, 5, 11, 5, 'Morning Fresh', 'Soaps and Detergents', 'SHU456820', 'Morning Fresh Scouring Powder', '', 'pc', 'ea', 1, 1727.64, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(106, 6, 2, 6, 'Heinz', 'Grocery', 'SHU456821', 'Heinz Tomato Sauce Baked Beans (150g)', '150g', 'tin', 'pack', 12, 6700.67, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(107, 7, 3, 7, 'Heinz', 'Grocery', 'SHU456821', 'Heinz Tomato Sauce Baked Beans (150g)', '150g', 'tin', 'pack', 12, 6893.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(108, 8, 6, 8, 'Heinz', 'Grocery', 'SHU456822', 'Heinz Tomato Sauce Baked Beanz 415g X 3', '415g', 'tin', 'pack', 3, 4006.06, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(109, 5, 11, 5, 'Heinz', 'Grocery', 'SHU456822', 'Heinz Tomato Sauce Baked Beanz 415g X 3', '415g', 'tin', 'pack', 3, 3728.62, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(110, 6, 2, 6, 'Heinz', 'Grocery', 'SHU456822', 'Heinz Tomato Sauce Baked Beanz 415g X 3', '415g', 'tin', 'pack', 3, 3782.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(111, 7, 3, 7, 'Heinz', 'Grocery', 'SHU456822', 'Heinz Tomato Sauce Baked Beanz 415g X 3', '415g', 'tin', 'pack', 3, 3601.17, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(112, 8, 6, 8, 'Bama', 'Grocery', 'SHU456823', 'Bama Mayonnaise 946ml X2', '946ml', 'jar', 'pack', 2, 4645.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(113, 5, 11, 5, 'Bama', 'Grocery', 'SHU456823', 'Bama Mayonnaise 946ml X2', '946ml', 'jar', 'pack', 2, 4608.48, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(114, 6, 2, 6, 'Bama', 'Grocery', 'SHU456823', 'Bama Mayonnaise 946ml X2', '946ml', 'jar', 'pack', 2, 4819.34, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(115, 3, 8, 3, 'Bama', 'Grocery', 'SHU456824', 'Bama Mayonnaise 473ml X2', '946ml', 'jar', 'pack', 2, 3862.12, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(116, 8, 6, 8, 'Bama', 'Grocery', 'SHU456824', 'Bama Mayonnaise 473ml X2', '946ml', 'jar', 'pack', 2, 3913.91, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(117, 5, 11, 5, 'Spice Supreme', 'Spices and Condiments', 'SHU456825', 'Spice Supreme Pure Ground Black Pepper', '', 'pc', 'ea', 1, 1444.01, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(118, 6, 2, 6, 'Spice Supreme', 'Spices and Condiments', 'SHU456825', 'Spice Supreme Pure Ground Black Pepper', '', 'pc', 'ea', 1, 1483.74, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(119, 7, 3, 7, 'Spice Supreme', 'Spices and Condiments', 'SHU456825', 'Spice Supreme Pure Ground Black Pepper', '', 'pc', 'ea', 1, 1489.23, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(120, 5, 11, 5, 'Aani', 'Flour', 'SHU456826', 'Aani Premium Basmati Rice - 10kg', '10kg', 'bag', 'ea', 1, 14867.06, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(121, 6, 2, 6, 'Aani', 'Flour', 'SHU456826', 'Aani Premium Basmati Rice - 10kg', '10kg', 'bag', 'ea', 1, 15220.02, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(122, 7, 3, 7, 'Aani', 'Flour', 'SHU456826', 'Aani Premium Basmati Rice - 10kg', '10kg', 'bag', 'ea', 1, 15313.9, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(123, 6, 2, 6, 'GMCE', 'Spices and Condiments', 'SHU456827', 'GMCE Hot Cameroon Pepper Powder 1 Piece 150g', '150g', 'jar', 'ea', 1, 1297.4, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(124, 7, 3, 7, 'GMCE', 'Spices and Condiments', 'SHU456827', 'GMCE Hot Cameroon Pepper Powder 1 Piece 150g', '150g', 'jar', 'ea', 1, 1324.86, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(125, 8, 6, 8, 'Masego Hills Farm', 'Spices and Condiments', 'SHU456828', 'Masego Hills Farm Whole Crayfish 150g', '150g', 'pkt', 'ea', 1, 1511.44, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(126, 5, 11, 5, 'Masego Hills Farm', 'Spices and Condiments', 'SHU456828', 'Masego Hills Farm Whole Crayfish 150g', '150g', 'pkt', 'ea', 1, 1518.65, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(127, 6, 2, 6, 'Masego Hills Farm', 'Spices and Condiments', 'SHU456828', 'Masego Hills Farm Whole Crayfish 150g', '150g', 'pkt', 'ea', 1, 1611.62, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(128, 7, 3, 7, 'Masego Hills Farm', 'Spices and Condiments', 'SHU456828', 'Masego Hills Farm Whole Crayfish 150g', '150g', 'pkt', 'ea', 1, 1562.35, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(129, 8, 6, 8, 'Trs', 'Grocery', 'SHU456829', 'Trs Coconut Milk 400ml X6', '400ml', 'can', 'pack', 6, 8472.04, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(130, 5, 11, 5, 'Trs', 'Grocery', 'SHU456829', 'Trs Coconut Milk 400ml X6', '400ml', 'can', 'pack', 6, 7919.32, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(131, 6, 2, 6, 'Nescafe', 'Teas and Beverages', 'SHU456830', 'Nescafe Gold Coffee In Jar 190G X1', '190g', 'jar', 'ea', 1, 4318.84, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(132, 7, 3, 7, 'Nescafe', 'Teas and Beverages', 'SHU456830', 'Nescafe Gold Coffee In Jar 190G X1', '190g', 'jar', 'ea', 1, 4421.54, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(133, 3, 8, 3, 'Nescafe', 'Teas and Beverages', 'SHU456830', 'Nescafe Gold Coffee In Jar 190G X1', '190g', 'jar', 'ea', 1, 4190.32, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(134, 6, 2, 6, 'Exeter', 'Grocery', 'SHU456831', 'Heinz Corned Beef 340g X 3pic', '340g', 'tin', 'pack', 3, 6760.89, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(135, 7, 3, 7, 'Exeter', 'Grocery', 'SHU456831', 'Heinz Corned Beef 340g X 3pic', '340g', 'tin', 'pack', 3, 6767.96, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(136, 8, 6, 8, 'Kelloggs', 'Breakfast and Cereals', 'SHU456832', 'Kellogg\'s Cornflakes 350g X 1 box', '350g', 'pkt', 'ea', 1, 774.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(137, 5, 11, 5, 'Kelloggs', 'Breakfast and Cereals', 'SHU456832', 'Kellogg\'s Cornflakes 350g X 1 box', '350g', 'pkt', 'ea', 1, 700.25, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(138, 6, 2, 6, 'Kelloggs', 'Breakfast and Cereals', 'SHU456832', 'Kellogg\'s Cornflakes 350g X 1 box', '350g', 'pkt', 'ea', 1, 698.48, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(139, 7, 3, 7, 'Kelloggs', 'Breakfast and Cereals', 'SHU456832', 'Kellogg\'s Cornflakes 350g X 1 box', '350g', 'pkt', 'ea', 1, 710.44, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(140, 3, 8, 3, 'Amel Susan', 'Grocery', 'SHU456833', 'Amel Susan Susan Corn Flour', '', 'pc', 'ea', 1, 1421.65, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(141, 4, 7, 4, 'Amel Susan', 'Grocery', 'SHU456833', 'Amel Susan Susan Corn Flour', '', 'pc', 'ea', 1, 1543.31, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(142, 8, 6, 8, 'Trs', 'Spices and Condiments', 'SHU456834', 'Trs Hot Madras Curry Powder 100g X 3', '100g', 'pkt', 'pack', 3, 2848.36, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(143, 5, 11, 5, 'Trs', 'Spices and Condiments', 'SHU456834', 'Trs Hot Madras Curry Powder 100g X 3', '100g', 'pkt', 'pack', 3, 2758.23, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(144, 6, 2, 6, 'Trs', 'Spices and Condiments', 'SHU456834', 'Trs Hot Madras Curry Powder 100g X 3', '100g', 'pkt', 'pack', 3, 2847.67, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(145, 7, 3, 7, 'Trs', 'Spices and Condiments', 'SHU456834', 'Trs Hot Madras Curry Powder 100g X 3', '100g', 'pkt', 'pack', 3, 2846.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(146, 3, 8, 3, 'Checkers', 'Breakfast and Cereals', 'SHU456835', 'Checkers Custard Yellow Big Size', '', 'jar', 'ea', 1, 6678.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(147, 4, 7, 4, 'Checkers', 'Breakfast and Cereals', 'SHU456835', 'Checkers Custard Yellow Big Size', '', 'jar', 'ea', 1, 7328.2, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(148, 5, 11, 5, 'Checkers', 'Breakfast and Cereals', 'SHU456835', 'Checkers Custard Yellow Big Size', '', 'jar', 'ea', 1, 6720.47, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(149, 6, 2, 6, 'Wing Yip', 'Spices and Condiments', 'SHU456836', 'Wing Yip Medium Concentrate Curry Sauce 250 ml', '250ml', 'jar', 'ea', 1, 1374.15, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(150, 7, 3, 7, 'Wing Yip', 'Spices and Condiments', 'SHU456836', 'Wing Yip Medium Concentrate Curry Sauce 250 ml', '250ml', 'jar', 'ea', 1, 1380.27, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(151, 8, 6, 8, 'As E Dey Hot', 'Spices and Condiments', 'SHU456837', '5 Grounded Dried Red Spice Seasoning Condiment Soup Stew Ingredient Spicy As E Dey Hot Pepper', '', 'jar', 'pack', 5, 7071.77, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(152, 3, 8, 3, 'As E Dey Hot', 'Spices and Condiments', 'SHU456837', '5 Grounded Dried Red Spice Seasoning Condiment Soup Stew Ingredient Spicy As E Dey Hot Pepper', '', 'jar', 'pack', 5, 7355.14, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(153, 4, 7, 4, 'As E Dey Hot', 'Spices and Condiments', 'SHU456837', '5 Grounded Dried Red Spice Seasoning Condiment Soup Stew Ingredient Spicy As E Dey Hot Pepper', '', 'jar', 'pack', 5, 6870.15, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(154, 5, 11, 5, 'Jollofe', 'Spices and Condiments', 'SHU456838', 'Jollofe Melon Seed 100g', '100g', 'pkt', 'ea', 1, 1638.2, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(155, 6, 2, 6, 'Jollofe', 'Spices and Condiments', 'SHU456838', 'Jollofe Melon Seed 100g', '100g', 'pkt', 'ea', 1, 1666.25, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(156, 7, 3, 7, 'Jollofe', 'Spices and Condiments', 'SHU456838', 'Jollofe Melon Seed 100g', '100g', 'pkt', 'ea', 1, 1658.23, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(157, 8, 6, 8, 'Spice Supreme', 'Spices and Condiments', 'SHU456839', 'Spice Supreme Fried Rice Seasoning (121g)', '121g', 'pc', 'ea', 1, 1541.28, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(158, 3, 8, 3, 'Spice Supreme', 'Spices and Condiments', 'SHU456839', 'Spice Supreme Fried Rice Seasoning (121g)', '121g', 'pc', 'ea', 1, 1417.68, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(159, 4, 7, 4, 'Spice Supreme', 'Spices and Condiments', 'SHU456839', 'Spice Supreme Fried Rice Seasoning (121g)', '121g', 'pc', 'ea', 1, 1567.56, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(160, 5, 11, 5, 'Spice Supreme', 'Spices and Condiments', 'SHU456839', 'Spice Supreme Fried Rice Seasoning (121g)', '121g', 'pc', 'ea', 1, 1571.75, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(161, 6, 2, 6, 'Spice Supreme', 'Spices and Condiments', 'SHU456840', 'Spice Supreme Spicy Fish Seasoning 198g', '198g', 'pc', 'ea', 1, 1247.64, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(162, 7, 3, 7, 'Spice Supreme', 'Spices and Condiments', 'SHU456840', 'Spice Supreme Spicy Fish Seasoning 198g', '198g', 'pc', 'ea', 1, 1327.78, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(163, 5, 11, 5, 'AACE Foods', 'Spices and Condiments', 'SHU456841', 'AACE FOODS Garlic Powder - 80g', '80g', 'pc', 'ea', 1, 822.23, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(164, 6, 2, 6, 'AACE Foods', 'Spices and Condiments', 'SHU456841', 'AACE FOODS Garlic Powder - 80g', '80g', 'pc', 'ea', 1, 828.17, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(165, 3, 8, 3, 'AACE Foods', 'Spices and Condiments', 'SHU456841', 'AACE FOODS Garlic Powder - 80g', '80g', 'pc', 'ea', 1, 836, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(166, 4, 7, 4, 'AACE Foods', 'Spices and Condiments', 'SHU456841', 'AACE FOODS Garlic Powder - 80g', '80g', 'pc', 'ea', 1, 811.4, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(167, 6, 2, 6, 'AACE Foods', 'Spices and Condiments', 'SHU456841', 'AACE FOODS Garlic Powder - 80g', '80g', 'pc', 'ea', 1, 767.48, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(168, 7, 3, 7, 'AACE Foods', 'Spices and Condiments', 'SHU456841', 'AACE FOODS Garlic Powder - 80g', '80g', 'pc', 'ea', 1, 783.06, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(169, 8, 6, 8, 'AACE Foods', 'Spices and Condiments', 'SHU456842', 'AACE FOODS Ginger Powder - 80g', '80g', 'pc', 'ea', 1, 764.33, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(170, 3, 8, 3, 'AACE Foods', 'Spices and Condiments', 'SHU456842', 'AACE FOODS Ginger Powder - 80g', '80g', 'pc', 'ea', 1, 819.88, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(171, 4, 7, 4, 'Knorr', 'Spices and Condiments', 'SHU456843', 'Knorr Seasoning Chicken Cube - 8g ? 50 Cubes ( 1 Pack)', '8g', 'pkt', 'ea', 1, 1756.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(172, 6, 2, 6, 'Knorr', 'Spices and Condiments', 'SHU456843', 'Knorr Seasoning Chicken Cube - 8g ? 50 Cubes ( 1 Pack)', '8g', 'pkt', 'ea', 1, 1790.84, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(173, 8, 6, 8, 'Knorr', 'Spices and Condiments', 'SHU456843', 'Knorr Seasoning Chicken Cube - 8g ? 50 Cubes ( 1 Pack)', '8g', 'pkt', 'ea', 1, 1688.88, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(174, 3, 8, 3, 'Lipton', 'Teas and Beverages', 'SHU456844', 'Lipton Yellow Label Black Tea With Rich Natural Taste 50g (25 Bags)', '50g', 'pkt', 'ea', 1, 302.89, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(175, 4, 7, 4, 'Lipton', 'Teas and Beverages', 'SHU456844', 'Lipton Yellow Label Black Tea With Rich Natural Taste 50g (25 Bags)', '50g', 'pkt', 'ea', 1, 282.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(176, 3, 8, 3, 'Buywholefoodsonline.co.uk', 'Grocery', 'SHU456845', 'Buywholefoodsonline.co.uk Dried Porcini Mushroom Pieces 50g', '50g', 'pkt', 'ea', 1, 7687.81, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(177, 4, 7, 4, 'Buywholefoodsonline.co.uk', 'Grocery', 'SHU456845', 'Buywholefoodsonline.co.uk Dried Porcini Mushroom Pieces 50g', '50g', 'pkt', 'ea', 1, 8220.99, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(178, 3, 8, 3, 'Indomie', 'Flour', 'SHU456846', 'Indomie 40 Packs 70g each (1carton)', '70g', 'pkt', 'carton', 40, 2825.09, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(179, 4, 7, 4, 'Indomie', 'Flour', 'SHU456846', 'Indomie 40 Packs 70g each (1carton)', '70g', 'pkt', 'carton', 40, 3072.44, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(180, 6, 2, 6, 'Indomie', 'Flour', 'SHU456846', 'Indomie 40 Packs 70g each (1carton)', '70g', 'pkt', 'carton', 40, 2943.12, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(181, 7, 3, 7, 'Indomie', 'Flour', 'SHU456846', 'Indomie 40 Packs 70g each (1carton)', '70g', 'pkt', 'carton', 40, 2994.18, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(182, 8, 6, 8, 'Indomie', 'Flour', 'SHU456846', 'Indomie 40 Packs 70g each (1carton)', '70g', 'pkt', 'carton', 40, 2802.78, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(183, 3, 8, 3, 'Quaker', 'Flour', 'SHU456847', 'Quaker White Oats Tin - 500g X1', '500g', 'tin', 'ea', 1, 1334.09, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(184, 4, 7, 4, 'Quaker', 'Flour', 'SHU456847', 'Quaker White Oats Tin - 500g X1', '500g', 'tin', 'ea', 1, 1350.05, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(185, 5, 11, 5, 'Quaker', 'Flour', 'SHU456847', 'Quaker White Oats Tin - 500g X1', '500g', 'tin', 'ea', 1, 1368.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(186, 6, 2, 6, 'Buywholefoodsonline.co.uk', 'Flour', 'SHU456848', 'Buywholefoodsonline.co.uk Organic Jumbo Porridge Oats - 1.25kg', '1.25kg', 'bag', 'ea', 1, 5263.13, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(187, 7, 3, 7, 'Buywholefoodsonline.co.uk', 'Flour', 'SHU456848', 'Buywholefoodsonline.co.uk Organic Jumbo Porridge Oats - 1.25kg', '1.25kg', 'bag', 'ea', 1, 5411.41, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(188, 8, 6, 8, 'Buywholefoodsonline.co.uk', 'Flour', 'SHU456848', 'Buywholefoodsonline.co.uk Organic Jumbo Porridge Oats - 1.25kg', '1.25kg', 'bag', 'ea', 1, 5173.39, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(189, 5, 11, 5, 'Buywholefoodsonline.co.uk', 'Flour', 'SHU456848', 'Buywholefoodsonline.co.uk Organic Jumbo Porridge Oats - 1.25kg', '1.25kg', 'bag', 'ea', 1, 5712.28, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(190, 5, 11, 5, 'Spice Supreme', 'Spices and Condiments', 'SHU456849', 'Spice Supreme Spicy Pepper Soup Spice (Pack Of 2)', '', 'pc', 'pack', 2, 3578.89, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(191, 6, 2, 6, 'Spice Supreme', 'Spices and Condiments', 'SHU456849', 'Spice Supreme Spicy Pepper Soup Spice (Pack Of 2)', '', 'pc', 'pack', 2, 3654.67, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(192, 7, 3, 7, 'Spice Supreme', 'Spices and Condiments', 'SHU456849', 'Spice Supreme Spicy Pepper Soup Spice (Pack Of 2)', '', 'pc', 'pack', 2, 3636.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(193, 8, 6, 8, 'Ayoola Foods', 'Flour', 'SHU456850', 'Ayoola Foods Ayoola Poundo Yam - 4.5kg', '4.5kg', 'bag', 'ea', 1, 6174.23, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(194, 3, 8, 3, 'Ayoola Foods', 'Flour', 'SHU456850', 'Ayoola Foods Ayoola Poundo Yam - 4.5kg', '4.5kg', 'bag', 'ea', 1, 6575.03, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(195, 4, 7, 4, 'Ayoola Foods', 'Flour', 'SHU456850', 'Ayoola Foods Ayoola Poundo Yam - 4.5kg', '4.5kg', 'bag', 'ea', 1, 6391.68, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(196, 5, 11, 5, 'Honeywell', 'Flour', 'SHU456851', 'Honeywell Semolina - 10kg', '10kg', 'bag', 'ea', 1, 9531.75, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(197, 6, 2, 6, 'Honeywell', 'Flour', 'SHU456851', 'Honeywell Semolina - 10kg', '10kg', 'bag', 'ea', 1, 9710.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(198, 3, 8, 3, 'Mama Gold', 'Flour', 'SHU456852', 'Mama Gold Semolina 10kg', '10kg', 'bag', 'ea', 1, 6230.63, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(199, 4, 7, 4, 'Mama Gold', 'Flour', 'SHU456852', 'Mama Gold Semolina 10kg', '10kg', 'bag', 'ea', 1, 5898.32, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(200, 5, 11, 5, 'Mama Gold', 'Flour', 'SHU456852', 'Mama Gold Semolina 10kg', '10kg', 'bag', 'ea', 1, 5663.79, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(201, 6, 2, 6, 'Mama Gold', 'Flour', 'SHU456852', 'Mama Gold Semolina 10kg', '10kg', 'bag', 'ea', 1, 5914.87, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(202, 3, 8, 3, 'Amoy', 'Cooking and Table Oils', 'SHU456853', 'Amoy Blended Sesame Oil 150ml X3', '150ml', 'bottle', 'pack', 3, 4391.05, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(203, 4, 7, 4, 'Amoy', 'Cooking and Table Oils', 'SHU456853', 'Amoy Blended Sesame Oil 150ml X3', '150ml', 'bottle', 'pack', 3, 4505.34, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(204, 5, 11, 5, 'Amoy', 'Cooking and Table Oils', 'SHU456853', 'Amoy Blended Sesame Oil 150ml X3', '150ml', 'bottle', 'pack', 3, 4616.77, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(205, 4, 7, 4, 'Bonita', 'Flour', 'SHU456854', 'Bonita Slim SPAGHETTI 500G - X 10 (Half Carton)', '500g', 'pkt', 'carton', 10, 5424.9, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(206, 5, 11, 5, 'Bonita', 'Flour', 'SHU456854', 'Bonita Slim SPAGHETTI 500G - X 10 (Half Carton)', '500g', 'pkt', 'carton', 10, 5587.92, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(207, 6, 2, 6, 'Ktc', 'Spices and Condiments', 'SHU456855', 'Ktc Thai Sweet Chilli Sauce', '', 'bottle', 'ea', 1, 3752.74, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(208, 3, 8, 3, 'Ktc', 'Spices and Condiments', 'SHU456855', 'Ktc Thai Sweet Chilli Sauce', '', 'bottle', 'ea', 1, 3856.92, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(209, 4, 7, 4, 'Ktc', 'Spices and Condiments', 'SHU456855', 'Ktc Thai Sweet Chilli Sauce', '', 'bottle', 'ea', 1, 3905.64, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(210, 7, 3, 7, 'Sunripe', 'Grocery', 'SHU456856', 'Sunripe Sweet Corn 340g X 3', '340g', 'can', 'pack', 3, 2509.25, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(211, 8, 6, 8, 'Sunripe', 'Grocery', 'SHU456856', 'Sunripe Sweet Corn 340g X 3', '340g', 'can', 'pack', 3, 2436.67, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(212, 5, 11, 5, 'Sunripe', 'Grocery', 'SHU456856', 'Sunripe Sweet Corn 340g X 3', '340g', 'can', 'pack', 3, 2552.02, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(213, 3, 8, 3, 'Sunripe', 'Grocery', 'SHU456856', 'Sunripe Sweet Corn 340g X 3', '340g', 'can', 'pack', 3, 2390.07, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(214, 4, 7, 4, 'Generic', 'Food Packaging', 'SHU456857', 'Disposable Foam Takeaway Packs - 100 Pieces[multi-colors]', '', 'pack', 'ea', 1, 3569.04, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(215, 7, 3, 7, 'Generic', 'Food Packaging', 'SHU456857', 'Disposable Foam Takeaway Packs - 100 Pieces[multi-colors]', '', 'pack', 'ea', 1, 3593.83, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8);
INSERT INTO `vendors_products` (`id`, `domain_id`, `sub_dom_id`, `vendor_id`, `brand`, `category`, `provisional_sku`, `product_name_descr`, `feature`, `unit`, `lot`, `qty_per_offer`, `offer_price`, `offer_date`, `active`, `main_pix`, `gallery_pix_id`, `attributes`, `serial_no`, `ipc`, `batch_no`, `produced_on`, `expires_on`, `created_on`, `created_by`) VALUES
(216, 5, 11, 5, 'Natco', 'Spices and Condiments', 'SHU456858', 'Natco Thyme - 25g Jar', '25g', 'jar', 'ea', 1, 1485.75, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(217, 6, 2, 6, 'Natco', 'Spices and Condiments', 'SHU456858', 'Natco Thyme - 25g Jar', '25g', 'jar', 'ea', 1, 1449.08, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(218, 3, 8, 3, 'Natco', 'Spices and Condiments', 'SHU456858', 'Natco Thyme - 25g Jar', '25g', 'jar', 'ea', 1, 1505.61, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(219, 4, 7, 4, 'Natco', 'Spices and Condiments', 'SHU456858', 'Natco Thyme - 25g Jar', '25g', 'jar', 'ea', 1, 1489.55, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(220, 3, 8, 3, 'Gino', 'Grocery', 'SHU456859', 'Gino Tomato Paste 210g X 6', '210g', 'tin', 'pack', 6, 6145.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(221, 4, 7, 4, 'Gino', 'Grocery', 'SHU456859', 'Gino Tomato Paste 210g X 6', '210g', 'tin', 'pack', 6, 6631.53, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(222, 5, 11, 5, 'Heinz', 'Spices and Condiments', 'SHU456860', 'Heinz Tomato Ketchup - 1.25kg (3 Bottles)', '1.25kg', 'bottle', 'pack', 3, 9141.4, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(223, 6, 2, 6, 'Heinz', 'Spices and Condiments', 'SHU456860', 'Heinz Tomato Ketchup - 1.25kg (3 Bottles)', '1.25kg', 'bottle', 'pack', 3, 9014.05, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(224, 3, 8, 3, 'Heinz', 'Spices and Condiments', 'SHU456860', 'Heinz Tomato Ketchup - 1.25kg (3 Bottles)', '1.25kg', 'bottle', 'pack', 3, 8633.32, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(225, 4, 7, 4, 'Heinz', 'Spices and Condiments', 'SHU456860', 'Heinz Tomato Ketchup - 1.25kg (3 Bottles)', '1.25kg', 'bottle', 'pack', 3, 9037.88, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(226, 7, 3, 7, 'Honeywell', 'Flour', 'SHU456861', 'Honeywell Whole Wheat Meal - 5kg (1 Bag)', '5kg', 'bag', 'ea', 1, 6013.71, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(227, 8, 6, 8, 'Honeywell', 'Flour', 'SHU456861', 'Honeywell Whole Wheat Meal - 5kg (1 Bag)', '5kg', 'bag', 'ea', 1, 5954.59, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(228, 3, 8, 3, 'Honeywell', 'Flour', 'SHU456861', 'Honeywell Whole Wheat Meal - 5kg (1 Bag)', '5kg', 'bag', 'ea', 1, 5886.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(229, 5, 11, 5, 'Spice Supreme', 'Spices and Condiments', 'SHU456862', 'Spice Supreme Pure Ground White Pepper', '', 'pc', 'ea', 1, 1511.49, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(230, 6, 2, 6, 'Spice Supreme', 'Spices and Condiments', 'SHU456862', 'Spice Supreme Pure Ground White Pepper', '', 'pc', 'ea', 1, 1478.4, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(231, 3, 8, 3, 'Spice Supreme', 'Spices and Condiments', 'SHU456862', 'Spice Supreme Pure Ground White Pepper', '', 'pc', 'ea', 1, 1493.67, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(232, 4, 7, 4, 'Spice Supreme', 'Spices and Condiments', 'SHU456862', 'Spice Supreme Pure Ground White Pepper', '', 'pc', 'ea', 1, 1562, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(233, 3, 8, 3, 'Amarula', 'Alcoholic Drinks', 'SHU456863', 'Amarula Cream Liquor 700ml', '', 'bottle', 'ea', 1, 6621.15, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(234, 4, 7, 4, 'Amarula', 'Alcoholic Drinks', 'SHU456863', 'Amarula Cream Liquor 700ml', '', 'bottle', 'ea', 1, 6172.2, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(235, 5, 11, 5, 'Amstel', 'Non-alcoholic Drinks', 'SHU456864', 'Amstel No Alcohol Malt Drink Can (x12)', '', 'can', 'pack', 12, 3556.4, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(236, 6, 2, 6, 'Amstel', 'Non-alcoholic Drinks', 'SHU456864', 'Amstel No Alcohol Malt Drink Can (x12)', '', 'can', 'pack', 12, 3386.05, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(237, 3, 8, 3, 'Amstel', 'Non-alcoholic Drinks', 'SHU456864', 'Amstel No Alcohol Malt Drink Can (x12)', '', 'can', 'pack', 12, 3441.21, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(238, 4, 7, 4, 'Amstel', 'Non-alcoholic Drinks', 'SHU456864', 'Amstel No Alcohol Malt Drink Can (x12)', '', 'can', 'pack', 12, 3395.68, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(239, 7, 3, 7, 'Angostura', 'Alcoholic Drinks', 'SHU456865', 'Angostura Aromatic Bitters AAB 200ML', '200ml', 'bottle', 'ea', 1, 8972.4, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(240, 8, 6, 8, 'Angostura', 'Alcoholic Drinks', 'SHU456865', 'Angostura Aromatic Bitters AAB 200ML', '200ml', 'bottle', 'ea', 1, 9902.54, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(241, 3, 8, 3, 'Angostura', 'Alcoholic Drinks', 'SHU456865', 'Angostura Aromatic Bitters AAB 200ML', '200ml', 'bottle', 'ea', 1, 9012.78, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(242, 5, 11, 5, 'Bacardi', 'Alcoholic Drinks', 'SHU456866', 'Bacardi Carta Blanca Superior White Rum 50ml- 10pcs', '50ml', 'bottle', 'pack', 10, 5721.25, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(243, 6, 2, 6, 'Bacardi', 'Alcoholic Drinks', 'SHU456866', 'Bacardi Carta Blanca Superior White Rum 50ml- 10pcs', '50ml', 'bottle', 'pack', 10, 5698.87, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(244, 7, 3, 7, 'Baileys', 'Alcoholic Drinks', 'SHU456867', 'Baileys Irish Cream', '', 'bottle', 'ea', 1, 7453.44, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(245, 8, 6, 8, 'Baileys', 'Alcoholic Drinks', 'SHU456867', 'Baileys Irish Cream', '', 'bottle', 'ea', 1, 7296.82, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(246, 3, 8, 3, 'Baileys', 'Alcoholic Drinks', 'SHU456867', 'Baileys Irish Cream', '', 'bottle', 'ea', 1, 7494.51, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(247, 5, 11, 5, 'Berol', 'Packaged Water', 'SHU456868', 'Marques De Berol Semi-Sweet - Red Wine 2017 - 750ml', '750ml', 'bottle', 'ea', 1, 1678, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(248, 6, 2, 6, 'Berol', 'Packaged Water', 'SHU456868', 'Marques De Berol Semi-Sweet - Red Wine 2017 - 750ml', '750ml', 'bottle', 'ea', 1, 1568.09, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(249, 3, 8, 3, 'Berol', 'Packaged Water', 'SHU456868', 'Marques De Berol Semi-Sweet - Red Wine 2017 - 750ml', '750ml', 'bottle', 'ea', 1, 1643.12, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(250, 4, 7, 4, 'Berol', 'Packaged Water', 'SHU456868', 'Marques De Berol Semi-Sweet - Red Wine 2017 - 750ml', '750ml', 'bottle', 'ea', 1, 1727.59, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(251, 6, 2, 6, 'Lasena', 'Packaged Water', 'SHU456869', 'Lasena Alkaline Water 75cl (16 Bottles In A Pack) X 2 Packs', '75cl', 'bottle', 'ea', 1, 4934.48, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(252, 3, 8, 3, 'Lasena', 'Packaged Water', 'SHU456869', 'Lasena Alkaline Water 75cl (16 Bottles In A Pack) X 2 Packs', '75cl', 'bottle', 'ea', 1, 4955.8, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(253, 8, 6, 8, 'Lasena', 'Packaged Water', 'SHU456869', 'Lasena Alkaline Water 75cl (16 Bottles In A Pack) X 2 Packs', '75cl', 'bottle', 'ea', 1, 4608.8, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(254, 7, 3, 7, 'Schweppes', 'Non-alcoholic Drinks', 'SHU456870', 'Schweppes 33CL Bitter Lemon X 24 cans', '33cl', 'can', 'pack', 24, 11948.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(255, 6, 2, 6, 'Schweppes', 'Non-alcoholic Drinks', 'SHU456870', 'Schweppes 33CL Bitter Lemon X 24 cans', '33cl', 'can', 'pack', 24, 12946.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(256, 3, 8, 3, 'Black & White', 'Alcoholic Drinks', 'SHU456871', 'Black & White Scotch Whiskey 70 cl (Pack of 6)', '70cl', 'bottle', 'pack', 6, 16921.15, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(257, 4, 7, 4, 'Black & White', 'Alcoholic Drinks', 'SHU456871', 'Black & White Scotch Whiskey 70 cl (Pack of 6)', '70cl', 'bottle', 'pack', 6, 15588.18, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(258, 5, 11, 5, 'Black & White', 'Alcoholic Drinks', 'SHU456871', 'Black & White Scotch Whiskey 70 cl (Pack of 6)', '70cl', 'bottle', 'pack', 6, 16992.86, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(259, 3, 8, 3, 'Bon voyage', 'Alcoholic Drinks', 'SHU456872', 'Bon Voyage Cape Red Wine 75 cl', '75cl', 'bottle', 'ea', 1, 2262.99, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(260, 4, 7, 4, 'Bon voyage', 'Alcoholic Drinks', 'SHU456872', 'Bon Voyage Cape Red Wine 75 cl', '75cl', 'bottle', 'ea', 1, 2120.69, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(261, 5, 11, 5, 'Bon voyage', 'Alcoholic Drinks', 'SHU456872', 'Bon Voyage Cape Red Wine 75 cl', '75cl', 'bottle', 'ea', 1, 2216.09, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(262, 8, 6, 8, 'Budweiser', 'Alcoholic Drinks', 'SHU456873', 'Budweiser (60 cl)', '60cl', 'bottle', 'ea', 1, 375.93, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(263, 7, 3, 7, 'Budweiser', 'Alcoholic Drinks', 'SHU456873', 'Budweiser (60 cl)', '60cl', 'bottle', 'ea', 1, 394.89, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(264, 6, 2, 6, 'Bullet', 'Alcoholic Drinks', 'SHU456874', 'Bullet Vodka Mixed Drink 250ml Can', '250ml', 'can', 'pack', 4, 3040.19, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(265, 5, 11, 5, 'Bullet', 'Alcoholic Drinks', 'SHU456874', 'Bullet Vodka Mixed Drink 250ml Can', '250ml', 'can', 'pack', 4, 2930.87, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(266, 8, 6, 8, 'Campari', 'Alcoholic Drinks', 'SHU456875', 'Campari Bitters 1 ltr', '1L', 'bottle', 'ea', 1, 8977.69, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(267, 7, 3, 7, 'Campari', 'Alcoholic Drinks', 'SHU456875', 'Campari Bitters 1 ltr', '1L', 'bottle', 'ea', 1, 8084.56, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(268, 6, 2, 6, 'Campari', 'Alcoholic Drinks', 'SHU456875', 'Campari Bitters 1 ltr', '1L', 'bottle', 'ea', 1, 8512.85, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(269, 3, 8, 3, 'Captain morgan', 'Alcoholic Drinks', 'SHU456876', 'Captain Morgan Spiced Gold Rum (70 cl)', '70cl', 'bottle', 'ea', 1, 7155.83, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(270, 4, 7, 4, 'Captain morgan', 'Alcoholic Drinks', 'SHU456876', 'Captain Morgan Spiced Gold Rum (70 cl)', '70cl', 'bottle', 'ea', 1, 7537.64, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(271, 5, 11, 5, 'Pride of Kings', 'Alcoholic Drinks', 'SHU456877', 'Pride of Kings - Merlot (Cabernet Savignon)', '', 'bottle', 'ea', 1, 1253.41, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(272, 8, 6, 8, 'Pride of Kings', 'Alcoholic Drinks', 'SHU456877', 'Pride of Kings - Merlot (Cabernet Savignon)', '', 'bottle', 'ea', 1, 1178.07, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(273, 7, 3, 7, 'Chivita', 'Fruit Juice and Syrups', 'SHU456878', 'Chi Chivita 100% Red Grape Fruit Juice - 1 Ltr X10', '1L', 'packet', 'pack', 10, 5476.75, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(274, 6, 2, 6, 'Chivita', 'Fruit Juice and Syrups', 'SHU456878', 'Chi Chivita 100% Red Grape Fruit Juice - 1 Ltr X10', '1L', 'packet', 'pack', 10, 5535.27, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(275, 3, 8, 3, 'Chivita', 'Fruit Juice and Syrups', 'SHU456878', 'Chi Chivita 100% Red Grape Fruit Juice - 1 Ltr X10', '1L', 'packet', 'pack', 10, 5282.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(276, 4, 7, 4, 'Chivita', 'Fruit Juice and Syrups', 'SHU456878', 'Chi Chivita 100% Red Grape Fruit Juice - 1 Ltr X10', '1L', 'packet', 'pack', 10, 5474.37, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(277, 6, 2, 6, 'Coke', 'Non-alcoholic Drinks', 'SHU456879', 'Coca-cola Coke Soft Drink 50clX12 Bottles', '50cl', 'bottle', 'pack', 12, 3531.09, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(278, 3, 8, 3, 'Coke', 'Non-alcoholic Drinks', 'SHU456879', 'Coca-cola Coke Soft Drink 50clX12 Bottles', '50cl', 'bottle', 'pack', 12, 3325.69, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(279, 4, 7, 4, 'Coke', 'Non-alcoholic Drinks', 'SHU456879', 'Coca-cola Coke Soft Drink 50clX12 Bottles', '50cl', 'bottle', 'pack', 12, 3392.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(280, 5, 11, 5, 'Donfelder', 'Alcoholic Drinks', 'SHU456880', 'Dornfelder Lieblich', '', 'bottle', 'ea', 1, 3392.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(281, 6, 2, 6, 'Donfelder', 'Alcoholic Drinks', 'SHU456880', 'Dornfelder Lieblich', '', 'bottle', 'ea', 1, 3392.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(282, 5, 11, 5, 'Drostdy hof', 'Alcoholic Drinks', 'SHU456881', 'Drostdy-Hof Red Wine - 75 Cl', '75cl', 'bottle', 'ea', 1, 2505.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(283, 6, 2, 6, 'Drostdy hof', 'Alcoholic Drinks', 'SHU456881', 'Drostdy-Hof Red Wine - 75 Cl', '75cl', 'bottle', 'ea', 1, 2358.57, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(284, 7, 3, 7, 'Dubic', 'Non-alcoholic Drinks', 'SHU456882', 'Dubic Malt Drink 33cl X24 Cans', '33cl', 'bottle', 'pack', 24, 3629.19, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(285, 8, 6, 8, 'Dubic', 'Non-alcoholic Drinks', 'SHU456882', 'Dubic Malt Drink 33cl X24 Cans', '33cl', 'bottle', 'pack', 24, 3833.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(286, 3, 8, 3, 'Dubic', 'Non-alcoholic Drinks', 'SHU456882', 'Dubic Malt Drink 33cl X24 Cans', '33cl', 'bottle', 'pack', 24, 3571.32, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(287, 4, 7, 4, 'Dubic', 'Non-alcoholic Drinks', 'SHU456882', 'Dubic Malt Drink 33cl X24 Cans', '33cl', 'bottle', 'pack', 24, 3526.27, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(288, 5, 11, 5, 'Dubic', 'Non-alcoholic Drinks', 'SHU456882', 'Dubic Malt Drink 33cl X24 Cans', '33cl', 'bottle', 'pack', 24, 3658.3, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(289, 7, 3, 7, 'Fanta', 'Non-alcoholic Drinks', 'SHU456883', 'Fanta Orange 50cl PET', '50cl', 'bottle', 'pack', 12, 3252.37, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(290, 8, 6, 8, 'Fanta', 'Non-alcoholic Drinks', 'SHU456883', 'Fanta Orange 50cl PET', '50cl', 'bottle', 'pack', 12, 3222.71, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(291, 3, 8, 3, 'Fanta', 'Non-alcoholic Drinks', 'SHU456883', 'Fanta Orange 50cl PET', '50cl', 'bottle', 'pack', 12, 3106.9, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(292, 4, 7, 4, 'Fanta', 'Non-alcoholic Drinks', 'SHU456883', 'Fanta Orange 50cl PET', '50cl', 'bottle', 'pack', 12, 3098.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(293, 5, 11, 5, 'Fanta', 'Non-alcoholic Drinks', 'SHU456883', 'Fanta Orange 50cl PET', '50cl', 'bottle', 'pack', 12, 3197.08, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(294, 8, 6, 8, 'Flirt', 'Alcoholic Drinks', 'SHU456884', 'Flirt Vodka Chocolate 1 Ltr', '1L', 'bottle', 'ea', 1, 4580.83, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(295, 6, 2, 6, 'Flirt', 'Alcoholic Drinks', 'SHU456884', 'Flirt Vodka Chocolate 1 Ltr', '1L', 'bottle', 'ea', 1, 4568.62, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(296, 8, 6, 8, 'Flirt', 'Alcoholic Drinks', 'SHU456885', 'Flirt Vodka 200ml', '200ml', 'bottle', 'ea', 1, 389.94, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(297, 6, 2, 6, 'Flirt', 'Alcoholic Drinks', 'SHU456885', 'Flirt Vodka 200ml', '200ml', 'bottle', 'ea', 1, 397.78, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(298, 8, 6, 8, 'Goldberg', 'Alcoholic Drinks', 'SHU456886', 'Goldberg 60cl', '60cl', 'bottle', 'ea', 1, 319.91, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(299, 3, 8, 3, 'Goldberg', 'Alcoholic Drinks', 'SHU456886', 'Goldberg 60cl', '60cl', 'bottle', 'ea', 1, 313.7, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(300, 4, 7, 4, 'Goldberg', 'Alcoholic Drinks', 'SHU456886', 'Goldberg 60cl', '60cl', 'bottle', 'ea', 1, 312.15, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(301, 5, 11, 5, 'Goldberg', 'Alcoholic Drinks', 'SHU456887', 'Goldberg Lager Beer 50cl Can', '50cl', 'can', 'ea', 1, 248.43, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(302, 8, 6, 8, 'Goldberg', 'Alcoholic Drinks', 'SHU456887', 'Goldberg Lager Beer 50cl Can', '50cl', 'can', 'ea', 1, 248.96, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(303, 8, 6, 8, 'Gordon', 'Alcoholic Drinks', 'SHU456888', 'Gordons London Dry Gin - 70cl', '70cl', 'bottle', 'ea', 1, 5078.49, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(304, 3, 8, 3, 'Gordon', 'Alcoholic Drinks', 'SHU456888', 'Gordons London Dry Gin - 70cl', '70cl', 'bottle', 'ea', 1, 4652.66, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(305, 4, 7, 4, 'Gordon', 'Alcoholic Drinks', 'SHU456888', 'Gordons London Dry Gin - 70cl', '70cl', 'bottle', 'ea', 1, 5133.62, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(306, 5, 11, 5, 'Gordon', 'Alcoholic Drinks', 'SHU456889', 'Gordon\'s London Dry Gin 20 cl', '20cl', 'bottle', 'ea', 1, 1153.12, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(307, 8, 6, 8, 'Gordon', 'Alcoholic Drinks', 'SHU456889', 'Gordon\'s London Dry Gin 20 cl', '20cl', 'bottle', 'ea', 1, 1104.96, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(308, 3, 8, 3, 'Grenadine', 'Fruit Juice and Syrups', 'SHU456890', 'Chtoura Garden Grenadine (pomegranate) Molasses 500ml', '500ml', 'bottle', 'ea', 1, 5418.96, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(309, 4, 7, 4, 'Grenadine', 'Fruit Juice and Syrups', 'SHU456890', 'Chtoura Garden Grenadine (pomegranate) Molasses 500ml', '500ml', 'bottle', 'ea', 1, 5196.29, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(310, 8, 6, 8, 'Ore', 'Nuts', 'SHU456891', 'Ore Roasted Groundnut (honey Flavoured) X2', '', 'bottle', 'ea', 2, 3800.89, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(311, 3, 8, 3, 'Ore', 'Nuts', 'SHU456891', 'Ore Roasted Groundnut (honey Flavoured) X2', '', 'bottle', 'ea', 2, 3974.83, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(312, 4, 7, 4, 'Ore', 'Nuts', 'SHU456891', 'Ore Roasted Groundnut (honey Flavoured) X2', '', 'bottle', 'ea', 2, 3950.04, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(313, 5, 11, 5, 'Ore', 'Nuts', 'SHU456891', 'Ore Roasted Groundnut (honey Flavoured) X2', '', 'bottle', 'ea', 2, 3957.91, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(314, 8, 6, 8, 'Guiness', 'Alcoholic Drinks', 'SHU456892', 'Guiness Big Stout (60cl)', '60cl', 'bottle', 'ea', 1, 490.37, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(315, 3, 8, 3, 'Guiness', 'Alcoholic Drinks', 'SHU456892', 'Guiness Big Stout (60cl)', '60cl', 'bottle', 'ea', 1, 515.1, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(316, 4, 7, 4, 'Guiness', 'Alcoholic Drinks', 'SHU456892', 'Guiness Big Stout (60cl)', '60cl', 'bottle', 'ea', 1, 501.06, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(317, 5, 11, 5, 'Guiness', 'Alcoholic Drinks', 'SHU456892', 'Guiness Big Stout (60cl)', '60cl', 'bottle', 'ea', 1, 492.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(318, 3, 8, 3, 'Guiness', 'Non-alcoholic Drinks', 'SHU456893', 'Maltina Classic Non-Alcoholic Malt Drink 35cl x 24 Bottles', '35cl', 'bottle', 'pack', 24, 2834.36, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(319, 4, 7, 4, 'Guiness', 'Non-alcoholic Drinks', 'SHU456893', 'Maltina Classic Non-Alcoholic Malt Drink 35cl x 24 Bottles', '35cl', 'bottle', 'pack', 24, 2711.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(320, 5, 11, 5, 'Guiness', 'Non-alcoholic Drinks', 'SHU456893', 'Maltina Classic Non-Alcoholic Malt Drink 35cl x 24 Bottles', '35cl', 'bottle', 'pack', 24, 2664.41, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(321, 4, 7, 4, 'Guiness', 'Alcoholic Drinks', 'SHU456894', 'Guinness Smooth Stout Can X24', '', 'can', 'pack', 24, 6609.56, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(322, 5, 11, 5, 'Guiness', 'Alcoholic Drinks', 'SHU456894', 'Guinness Smooth Stout Can X24', '', 'can', 'pack', 24, 7031.01, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(323, 3, 8, 3, 'Gulder', 'Alcoholic Drinks', 'SHU456895', 'Gulder Bottle (60cl)', '60cl', 'bottle', 'ea', 1, 385.24, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(324, 4, 7, 4, 'Gulder', 'Alcoholic Drinks', 'SHU456895', 'Gulder Bottle (60cl)', '60cl', 'bottle', 'ea', 1, 352.29, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(325, 5, 11, 5, 'Gulder', 'Alcoholic Drinks', 'SHU456895', 'Gulder Bottle (60cl)', '60cl', 'bottle', 'ea', 1, 354.05, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(326, 8, 6, 8, 'Gulder', 'Alcoholic Drinks', 'SHU456895', 'Gulder Bottle (60cl)', '60cl', 'bottle', 'ea', 1, 382.73, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(327, 6, 2, 6, 'Harp', 'Alcoholic Drinks', 'SHU456896', 'Harp Lager Beer (60cl)', '60cl', 'bottle', 'ea', 1, 350.91, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(328, 5, 11, 5, 'Harp', 'Alcoholic Drinks', 'SHU456896', 'Harp Lager Beer (60cl)', '60cl', 'bottle', 'ea', 1, 333.85, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(329, 8, 6, 8, 'Harp', 'Alcoholic Drinks', 'SHU456896', 'Harp Lager Beer (60cl)', '60cl', 'bottle', 'ea', 1, 317.99, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(330, 8, 6, 8, 'Heineken', 'Alcoholic Drinks', 'SHU456897', 'Heineken Lager Beer - 60cl crate', '60cl', 'bottle', 'crate', 6, 4011.74, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(331, 7, 3, 7, 'Heineken', 'Alcoholic Drinks', 'SHU456897', 'Heineken Lager Beer - 60cl crate', '60cl', 'bottle', 'crate', 6, 3793.32, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(332, 6, 2, 6, 'Heineken', 'Alcoholic Drinks', 'SHU456897', 'Heineken Lager Beer - 60cl crate', '60cl', 'bottle', 'crate', 6, 4182.45, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(333, 5, 11, 5, 'Heineken', 'Alcoholic Drinks', 'SHU456897', 'Heineken Lager Beer - 60cl crate', '60cl', 'bottle', 'crate', 6, 3773.01, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(334, 3, 8, 3, 'Heineken', 'Alcoholic Drinks', 'SHU456898', 'Heineken Can (33cl)', '33cl', 'can', 'ea', 1, 267.38, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(335, 4, 7, 4, 'Heineken', 'Alcoholic Drinks', 'SHU456898', 'Heineken Can (33cl)', '33cl', 'can', 'ea', 1, 251.59, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(336, 5, 11, 5, 'Heineken', 'Alcoholic Drinks', 'SHU456898', 'Heineken Can (33cl)', '33cl', 'can', 'ea', 1, 251.07, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(337, 3, 8, 3, 'Henessy', 'Alcoholic Drinks', 'SHU456899', 'Hennessy VS - 35cl', '35cl', 'bottle', 'ea', 1, 9511.42, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(338, 4, 7, 4, 'Henessy', 'Alcoholic Drinks', 'SHU456899', 'Hennessy VS - 35cl', '35cl', 'bottle', 'ea', 1, 9501.54, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(339, 5, 11, 5, 'Henessy', 'Alcoholic Drinks', 'SHU456899', 'Hennessy VS - 35cl', '35cl', 'bottle', 'ea', 1, 8887.41, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(340, 4, 7, 4, 'Henessy (VSOP)', 'Alcoholic Drinks', 'SHU456900', 'Hennessy V.S.O.P Cognac', '', 'bottle', 'ea', 1, 38877.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(341, 5, 11, 5, 'Henessy (VSOP)', 'Alcoholic Drinks', 'SHU456900', 'Hennessy V.S.O.P Cognac', '', 'bottle', 'ea', 1, 43248.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(342, 6, 2, 6, 'Peak', 'Milk and Yoghurt', 'SHU456901', 'Peak Full Cream Unsweetened Evaporated Liquid Milk 170g X12', '170g', 'can', 'pack', 12, 3781.59, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(343, 5, 11, 5, 'Peak', 'Milk and Yoghurt', 'SHU456901', 'Peak Full Cream Unsweetened Evaporated Liquid Milk 170g X12', '170g', 'can', 'pack', 12, 3467.4, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(344, 8, 6, 8, 'Peak', 'Milk and Yoghurt', 'SHU456901', 'Peak Full Cream Unsweetened Evaporated Liquid Milk 170g X12', '170g', 'can', 'pack', 12, 3394.27, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(345, 4, 7, 4, 'Peak', 'Milk and Yoghurt', 'SHU456901', 'Peak Full Cream Unsweetened Evaporated Liquid Milk 170g X12', '170g', 'can', 'pack', 12, 3732.82, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(346, 6, 2, 6, 'Hollandia', 'Milk and Yoghurt', 'SHU456902', 'Hollandia YOGHURT - Plain Sweetened (1LTR X 10 PCS)', '1L', 'pack', 'pack', 10, 16563.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(347, 5, 11, 5, 'Hollandia', 'Milk and Yoghurt', 'SHU456902', 'Hollandia YOGHURT - Plain Sweetened (1LTR X 10 PCS)', '1L', 'pack', 'pack', 10, 17243.97, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(348, 8, 6, 8, 'Hollandia', 'Milk and Yoghurt', 'SHU456902', 'Hollandia YOGHURT - Plain Sweetened (1LTR X 10 PCS)', '1L', 'pack', 'pack', 10, 16594.36, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(349, 3, 8, 3, 'Hunter\'s', 'Alcoholic Drinks', 'SHU456903', 'Hunter\'s Dry NRB (33cl)', '33cl', 'bottle', 'ea', 1, 407.7, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(350, 4, 7, 4, 'Hunter\'s', 'Alcoholic Drinks', 'SHU456903', 'Hunter\'s Dry NRB (33cl)', '33cl', 'bottle', 'ea', 1, 399.23, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(351, 3, 8, 3, 'Hunter\'s', 'Alcoholic Drinks', 'SHU456904', 'Hunter\'s Gold NRB (33cl)', '33cl', 'bottle', 'ea', 1, 403.37, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(352, 4, 7, 4, 'Hunter\'s', 'Alcoholic Drinks', 'SHU456904', 'Hunter\'s Gold NRB (33cl)', '33cl', 'bottle', 'ea', 1, 393.28, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(353, 3, 8, 3, 'Jameson', 'Alcoholic Drinks', 'SHU456905', 'Jameson Black Barrel 70cl', '70cl', 'bottle', 'ea', 1, 14645.75, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(354, 4, 7, 4, 'Jameson', 'Alcoholic Drinks', 'SHU456905', 'Jameson Black Barrel 70cl', '70cl', 'bottle', 'ea', 1, 15807.36, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(355, 6, 2, 6, 'Jameson', 'Alcoholic Drinks', 'SHU456906', 'Jameson Irish Whiskey 20cl', '20cl', 'bottle', 'ea', 1, 2251.51, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(356, 5, 11, 5, 'Jameson', 'Alcoholic Drinks', 'SHU456906', 'Jameson Irish Whiskey 20cl', '20cl', 'bottle', 'ea', 1, 2230.62, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(357, 4, 7, 4, 'Jim Beam', 'Alcoholic Drinks', 'SHU456907', 'Jim Beam Kentucky Straight Bourbon Whiskey 1 L', '1L', 'bottle', 'ea', 1, 27177.56, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(358, 5, 11, 5, 'Jim Beam', 'Alcoholic Drinks', 'SHU456907', 'Jim Beam Kentucky Straight Bourbon Whiskey 1 L', '1L', 'bottle', 'ea', 1, 28845.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(359, 3, 8, 3, 'Kolaq Alagbo', 'Alcoholic Drinks', 'SHU456908', 'Kolaq Alagbo For Maximum Sexual Pleasure (12pcs)', '', 'pcs', 'pack', 12, 6687.17, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(360, 7, 3, 7, 'Kolaq Alagbo', 'Alcoholic Drinks', 'SHU456908', 'Kolaq Alagbo For Maximum Sexual Pleasure (12pcs)', '', 'pcs', 'pack', 12, 6835.27, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(361, 8, 6, 8, 'Kolaq Alagbo', 'Alcoholic Drinks', 'SHU456908', 'Kolaq Alagbo For Maximum Sexual Pleasure (12pcs)', '', 'pcs', 'pack', 12, 6934.86, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(362, 7, 3, 7, 'Legend', 'Alcoholic Drinks', 'SHU456909', 'Legend Extra Stout 60cl Bottle', '60cl', 'bottle', 'ea', 1, 314.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(363, 8, 6, 8, 'Legend', 'Alcoholic Drinks', 'SHU456909', 'Legend Extra Stout 60cl Bottle', '60cl', 'bottle', 'ea', 1, 314.09, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(364, 7, 3, 7, 'Magic Time', 'Fruit Juice and Syrups', 'SHU456910', 'Magic Time Lemon Juice 946 ml', '946ml', 'bottle', 'ea', 1, 2596.09, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(365, 8, 6, 8, 'Magic Time', 'Fruit Juice and Syrups', 'SHU456910', 'Magic Time Lemon Juice 946 ml', '946ml', 'bottle', 'ea', 1, 2446.43, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(366, 7, 3, 7, 'Nederburg Merlot', 'Alcoholic Drinks', 'SHU456912', 'Nederburg Merlot -75CL', '75cl', 'bottle', 'ea', 1, 5704.91, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(367, 8, 6, 8, 'Nederburg Merlot', 'Alcoholic Drinks', 'SHU456912', 'Nederburg Merlot -75CL', '75cl', 'bottle', 'ea', 1, 5355.03, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(368, 3, 8, 3, 'Nederburg Chardonnay', 'Alcoholic Drinks', 'SHU456913', 'Nederburg Chardonnay White Wine -75CL', '75cl', 'bottle', 'ea', 1, 4753.12, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(369, 7, 3, 7, 'Nederburg Chardonnay', 'Alcoholic Drinks', 'SHU456913', 'Nederburg Chardonnay White Wine -75CL', '75cl', 'bottle', 'ea', 1, 4755.83, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(370, 8, 6, 8, 'Nederburg Pinotage', 'Alcoholic Drinks', 'SHU456914', 'Nederburg Pinotage Wine -75CL', '75cl', 'bottle', 'ea', 1, 5035.18, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(371, 5, 11, 5, 'Nederburg Pinotage', 'Alcoholic Drinks', 'SHU456914', 'Nederburg Pinotage Wine -75CL', '75cl', 'bottle', 'ea', 1, 5034.5, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(372, 6, 2, 6, 'Nederburg Rose', 'Alcoholic Drinks', 'SHU456915', 'Nederburg Rose Wine 75cl', '75cl', 'bottle', 'ea', 1, 0, '0000-00-00 00:00:00', 0, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(373, 5, 11, 5, 'Nederburg Rose', 'Alcoholic Drinks', 'SHU456915', 'Nederburg Rose Wine 75cl', '75cl', 'bottle', 'ea', 1, 0, '0000-00-00 00:00:00', 0, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(374, 6, 2, 6, 'Nederburg Sauvignon Blanc', 'Alcoholic Drinks', 'SHU456916', 'Nederburg Sauvignon Blanc White wine -75CL ', '75cl', 'bottle', 'ea', 1, 4626.86, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(375, 5, 11, 5, 'Nederburg Sauvignon Blanc', 'Alcoholic Drinks', 'SHU456916', 'Nederburg Sauvignon Blanc White wine -75CL ', '75cl', 'bottle', 'ea', 1, 4539.63, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(376, 8, 6, 8, 'Nederburg Sauvignon Blanc', 'Alcoholic Drinks', 'SHU456916', 'Nederburg Sauvignon Blanc White wine -75CL ', '75cl', 'bottle', 'ea', 1, 4499.15, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(377, 6, 2, 6, 'Nederburg Cabernet Sauvignon', 'Alcoholic Drinks', 'SHU456917', 'Nederburg Cabernet Sauvignon -75CL', '75cl', 'bottle', 'ea', 1, 5586.32, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(378, 5, 11, 5, 'Nederburg Cabernet Sauvignon', 'Alcoholic Drinks', 'SHU456917', 'Nederburg Cabernet Sauvignon -75CL', '75cl', 'bottle', 'ea', 1, 5440.74, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(379, 7, 3, 7, 'Nederburg Shiraz', 'Alcoholic Drinks', 'SHU456918', 'Nederburg Shiraz Wine -75CL (x6Bottles)', '75cl', 'bottle', 'pack', 6, 27912.18, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(380, 8, 6, 8, 'Nederburg Shiraz', 'Alcoholic Drinks', 'SHU456918', 'Nederburg Shiraz Wine -75CL (x6Bottles)', '75cl', 'bottle', 'pack', 6, 30288.43, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(381, 5, 11, 5, 'Noble CRU', 'Alcoholic Drinks', 'SHU456919', 'Noble CRU 750ml', '750ml', 'bottle', 'ea', 1, 3461.02, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(382, 8, 6, 8, 'Noble CRU', 'Alcoholic Drinks', 'SHU456919', 'Noble CRU 750ml', '750ml', 'bottle', 'ea', 1, 3381.93, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(383, 3, 8, 3, 'Monster', 'Energy Drinks', 'SHU456920', 'Monster Energy Drink - 440ml', '440ml', 'can', 'ea', 1, 543.59, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(384, 4, 7, 4, 'Monster', 'Energy Drinks', 'SHU456920', 'Monster Energy Drink - 440ml', '440ml', 'can', 'ea', 1, 525.15, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(385, 5, 11, 5, 'Monster', 'Energy Drinks', 'SHU456920', 'Monster Energy Drink - 440ml', '440ml', 'can', 'ea', 1, 546.09, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(386, 6, 2, 6, 'Monster', 'Energy Drinks', 'SHU456920', 'Monster Energy Drink - 440ml', '440ml', 'can', 'ea', 1, 560.22, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(387, 4, 7, 4, 'Origin', 'Alcoholic Drinks', 'SHU456921', 'Buy Orijin Bitters - 75CL ', '75cl', 'bottle', 'ea', 1, 1396.59, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(388, 5, 11, 5, 'Origin', 'Alcoholic Drinks', 'SHU456921', 'Buy Orijin Bitters - 75CL ', '75cl', 'bottle', 'ea', 1, 1331.11, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(389, 6, 2, 6, 'Origin', 'Alcoholic Drinks', 'SHU456921', 'Buy Orijin Bitters - 75CL ', '75cl', 'bottle', 'ea', 1, 1339.01, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(390, 5, 11, 5, 'Origin', 'Alcoholic Drinks', 'SHU456922', 'Orijin Spirit Mixed Drink (33cl x 24)', '33cl', 'can', 'carton', 24, 4284.2, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(391, 6, 2, 6, 'Origin', 'Alcoholic Drinks', 'SHU456922', 'Orijin Spirit Mixed Drink (33cl x 24)', '33cl', 'can', 'carton', 24, 4299.36, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(392, 4, 7, 4, 'Origin', 'Alcoholic Drinks', 'SHU456923', 'Origin Bitters (20cl)', '20cl', 'bottle', 'ea', 1, 380.26, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(393, 5, 11, 5, 'Origin', 'Alcoholic Drinks', 'SHU456923', 'Origin Bitters (20cl)', '20cl', 'bottle', 'ea', 1, 403.76, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(394, 6, 2, 6, 'Origin', 'Alcoholic Drinks', 'SHU456923', 'Origin Bitters (20cl)', '20cl', 'bottle', 'ea', 1, 395.9, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(395, 4, 7, 4, 'Paul Masson', 'Alcoholic Drinks', 'SHU456924', 'Paul Masson VSOP 75cl (X6 Bottles)', '75cl', 'bottle', 'pack', 26, 25647.98, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(396, 5, 11, 5, 'Paul Masson', 'Alcoholic Drinks', 'SHU456924', 'Paul Masson VSOP 75cl (X6 Bottles)', '75cl', 'bottle', 'pack', 26, 25902.04, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(397, 4, 7, 4, 'Olu Olu', 'Alcoholic Drinks', 'SHU456925', 'Olu Olu Palmi Nature\'s Sparkling Palm Drink 60 cl', '60cl', 'bottle', 'ea', 1, 394.73, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(398, 5, 11, 5, 'Olu Olu', 'Alcoholic Drinks', 'SHU456925', 'Olu Olu Palmi Nature\'s Sparkling Palm Drink 60 cl', '60cl', 'bottle', 'ea', 1, 392.47, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(399, 7, 3, 7, 'Powerhorse', 'Energy Drinks', 'SHU456926', 'Power Horse Energy Drink 330ML', '330ml', 'can', 'ea', 1, 287.87, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(400, 8, 6, 8, 'Powerhorse', 'Energy Drinks', 'SHU456926', 'Power Horse Energy Drink 330ML', '330ml', 'can', 'ea', 1, 317.19, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(401, 3, 8, 3, 'Powerhorse', 'Energy Drinks', 'SHU456926', 'Power Horse Energy Drink 330ML', '330ml', 'can', 'ea', 1, 315.19, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(402, 4, 7, 4, 'Powerhorse', 'Energy Drinks', 'SHU456926', 'Power Horse Energy Drink 330ML', '330ml', 'can', 'ea', 1, 293.55, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(403, 8, 6, 8, 'Red Bull', 'Energy Drinks', 'SHU456927', 'Red Bull Energy Drink 25 cl', '25cl', 'can', 'ea', 1, 434.38, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(404, 3, 8, 3, 'Red Bull', 'Energy Drinks', 'SHU456927', 'Red Bull Energy Drink 25 cl', '25cl', 'can', 'ea', 1, 418.83, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(405, 4, 7, 4, 'Red Bull', 'Energy Drinks', 'SHU456927', 'Red Bull Energy Drink 25 cl', '25cl', 'can', 'ea', 1, 457.31, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(406, 4, 7, 4, 'Red Label', 'Alcoholic Drinks', 'SHU456928', 'Johnnie Walker Red Lable 70 cl', '70cl', 'bottle', 'ea', 1, 3332.93, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(407, 5, 11, 5, 'Red Label', 'Alcoholic Drinks', 'SHU456928', 'Johnnie Walker Red Lable 70 cl', '70cl', 'bottle', 'ea', 1, 3416.75, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(408, 4, 7, 4, 'Realemon 100%', 'Fruit Juice and Syrups', 'SHU456929', 'Realemon Lemon Juice 1.4 Litres 2in1 Pack For Daily Use.', '1.4L', 'bottle', 'pack', 2, 6111.45, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(409, 5, 11, 5, 'Realemon 100%', 'Fruit Juice and Syrups', 'SHU456929', 'Realemon Lemon Juice 1.4 Litres 2in1 Pack For Daily Use.', '1.4L', 'bottle', 'pack', 2, 6733.05, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(410, 3, 8, 3, 'Hamish Robertson & Co.', 'Alcoholic Drinks', 'SHU456931', 'Hamish Robertson & Co. Royal Park Fine Blended Scotch Whisky', '', 'bottle', 'ea', 1, 4754, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(411, 4, 7, 4, 'Hamish Robertson & Co.', 'Alcoholic Drinks', 'SHU456931', 'Hamish Robertson & Co. Royal Park Fine Blended Scotch Whisky', '', 'bottle', 'ea', 1, 4303.53, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(412, 7, 3, 7, 'Savannah Dry', 'Alcoholic Drinks', 'SHU456932', 'Savanna Dry Cider Cider (33cl)', '33cl', 'bottle', 'ea', 1, 437.44, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(413, 4, 7, 4, 'Savannah Dry', 'Alcoholic Drinks', 'SHU456932', 'Savanna Dry Cider Cider (33cl)', '33cl', 'bottle', 'ea', 1, 434.46, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(414, 3, 8, 3, 'Savannah Dry', 'Alcoholic Drinks', 'SHU456932', 'Savanna Dry Cider Cider (33cl)', '33cl', 'bottle', 'ea', 1, 481.22, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(415, 8, 6, 8, 'Savannah Dry', 'Alcoholic Drinks', 'SHU456932', 'Savanna Dry Cider Cider (33cl)', '33cl', 'bottle', 'ea', 1, 449.19, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(416, 3, 8, 3, 'Sierra Tequila', 'Alcoholic Drinks', 'SHU456933', 'Sierra Tequila Silver 70 cl', '70cl', 'bottle', 'ea', 1, 6309.42, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(417, 7, 3, 7, 'Sierra Tequila', 'Alcoholic Drinks', 'SHU456933', 'Sierra Tequila Silver 70 cl', '70cl', 'bottle', 'ea', 1, 6269.6, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(418, 7, 3, 7, 'Eva', 'Packaged Water', 'SHU456934', 'Eva Table Water 75 cl x12', '75cl', 'bottle', 'pack', 12, 822.82, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(419, 4, 7, 4, 'Eva', 'Packaged Water', 'SHU456934', 'Eva Table Water 75 cl x12', '75cl', 'bottle', 'pack', 12, 856, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(420, 3, 8, 3, 'Eva', 'Packaged Water', 'SHU456934', 'Eva Table Water 75 cl x12', '75cl', 'bottle', 'pack', 12, 866.93, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(421, 8, 6, 8, 'Eva', 'Packaged Water', 'SHU456934', 'Eva Table Water 75 cl x12', '75cl', 'bottle', 'pack', 12, 875.37, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(422, 4, 7, 4, 'Smirnoff ice', 'Alcoholic Drinks', 'SHU456935', 'Smirnoff Ice Bottle 60 cl', '60cl', 'bottle', 'ea', 1, 422.78, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(423, 3, 8, 3, 'Smirnoff ice', 'Alcoholic Drinks', 'SHU456935', 'Smirnoff Ice Bottle 60 cl', '60cl', 'bottle', 'ea', 1, 439.08, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(424, 8, 6, 8, 'Smirnoff ice', 'Alcoholic Drinks', 'SHU456935', 'Smirnoff Ice Bottle 60 cl', '60cl', 'bottle', 'ea', 1, 395.79, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(425, 7, 3, 7, 'Star radler', 'Alcoholic Drinks', 'SHU456936', 'Star Radler Bottle (50cl)', '50cl', 'bottle', 'ea', 1, 270.35, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(426, 4, 7, 4, 'Star radler', 'Alcoholic Drinks', 'SHU456936', 'Star Radler Bottle (50cl)', '50cl', 'bottle', 'ea', 1, 272.62, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(427, 7, 3, 7, 'Seaman\'s', 'Alcoholic Drinks', 'SHU456937', 'Seaman\'s Aromatic Schnapps 75 cl', '75cl', 'bottle', 'ea', 1, 1359.9, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(428, 4, 7, 4, 'Seaman\'s', 'Alcoholic Drinks', 'SHU456937', 'Seaman\'s Aromatic Schnapps 75 cl', '75cl', 'bottle', 'ea', 1, 1360.78, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(429, 3, 8, 3, 'Schweppes', 'Non-alcoholic Drinks', 'SHU456938', 'Schweppes Soda Water Pet Bottle 50 cl x12', '50cl', 'can', 'pack', 12, 1715.74, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(430, 4, 7, 4, 'Schweppes', 'Non-alcoholic Drinks', 'SHU456939', 'Schweppes Soda Water - Can - 33CL (x24 Cans)', '33cl', 'bottle', 'pack', 24, 3940.08, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(431, 5, 11, 5, 'Schweppes', 'Non-alcoholic Drinks', 'SHU456939', 'Schweppes Soda Water - Can - 33CL (x24 Cans)', '33cl', 'bottle', 'pack', 24, 3898.35, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(432, 6, 2, 6, 'Schweppes', 'Non-alcoholic Drinks', 'SHU456939', 'Schweppes Soda Water - Can - 33CL (x24 Cans)', '33cl', 'bottle', 'pack', 24, 4056.27, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(433, 7, 3, 7, 'Schweppes', 'Non-alcoholic Drinks', 'SHU456939', 'Schweppes Soda Water - Can - 33CL (x24 Cans)', '33cl', 'bottle', 'pack', 24, 3827.6, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8);
INSERT INTO `vendors_products` (`id`, `domain_id`, `sub_dom_id`, `vendor_id`, `brand`, `category`, `provisional_sku`, `product_name_descr`, `feature`, `unit`, `lot`, `qty_per_offer`, `offer_price`, `offer_date`, `active`, `main_pix`, `gallery_pix_id`, `attributes`, `serial_no`, `ipc`, `batch_no`, `produced_on`, `expires_on`, `created_on`, `created_by`) VALUES
(434, 8, 6, 8, 'Schweppes', 'Non-alcoholic Drinks', 'SHU456939', 'Schweppes Soda Water - Can - 33CL (x24 Cans)', '33cl', 'bottle', 'pack', 24, 3719.15, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(435, 5, 11, 5, 'Sprite', 'Non-alcoholic Drinks', 'SHU456940', 'Sprite Pet Bottle 50 cl x12', '50cl', 'bottle', 'pack', 12, 993.19, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(436, 6, 2, 6, 'Sprite', 'Non-alcoholic Drinks', 'SHU456940', 'Sprite Pet Bottle 50 cl x12', '50cl', 'bottle', 'pack', 12, 985.81, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(437, 7, 3, 7, 'Sprite', 'Non-alcoholic Drinks', 'SHU456940', 'Sprite Pet Bottle 50 cl x12', '50cl', 'bottle', 'pack', 12, 1037.43, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(438, 4, 7, 4, 'Sprite', 'Non-alcoholic Drinks', 'SHU456940', 'Sprite Pet Bottle 50 cl x12', '50cl', 'bottle', 'pack', 12, 995.4, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(439, 5, 11, 5, 'Star Lager', 'Alcoholic Drinks', 'SHU456941', 'Star Lager Beer 600ml x 24 bottle', '600ml', 'bottle', 'pack', 24, 2908.12, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(440, 6, 2, 6, 'Star Lager', 'Alcoholic Drinks', 'SHU456941', 'Star Lager Beer 600ml x 24 bottle', '600ml', 'bottle', 'pack', 24, 2905.12, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(441, 7, 3, 7, 'Star Lager', 'Alcoholic Drinks', 'SHU456941', 'Star Lager Beer 600ml x 24 bottle', '600ml', 'bottle', 'pack', 24, 2909.01, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(442, 6, 2, 6, 'Star Lager', 'Alcoholic Drinks', 'SHU456942', 'Star Lager Beer Can 33 cl', '33cl', 'can', 'ea', 1, 156.51, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(443, 7, 3, 7, 'Star Lager', 'Alcoholic Drinks', 'SHU456942', 'Star Lager Beer Can 33 cl', '33cl', 'can', 'ea', 1, 161.58, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(444, 4, 7, 4, 'Star Lager', 'Alcoholic Drinks', 'SHU456942', 'Star Lager Beer Can 33 cl', '33cl', 'can', 'ea', 1, 156.39, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(445, 5, 11, 5, 'Tequila Blanco', 'Alcoholic Drinks', 'SHU456943', 'Olmeca Tequila Blanco 35 cl', '35cl', 'bottle', 'ea', 1, 2410.6, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(446, 6, 2, 6, 'Tequila Blanco', 'Alcoholic Drinks', 'SHU456943', 'Olmeca Tequila Blanco 35 cl', '35cl', 'bottle', 'ea', 1, 2556.57, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(447, 7, 3, 7, 'Tequila Blanco', 'Alcoholic Drinks', 'SHU456943', 'Olmeca Tequila Blanco 35 cl', '35cl', 'bottle', 'ea', 1, 2616.87, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(448, 7, 3, 7, 'Tequila Blanco', 'Alcoholic Drinks', 'SHU456944', 'Olmeca Blanco Tequila - 75CL', '75cl', 'bottle', 'ea', 1, 6806.69, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(449, 4, 7, 4, 'Tequila Blanco', 'Alcoholic Drinks', 'SHU456944', 'Olmeca Blanco Tequila - 75CL', '75cl', 'bottle', 'ea', 1, 6943.22, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(450, 6, 2, 6, 'Tequila gold', 'Alcoholic Drinks', 'SHU456945', 'Olmeca Tequila Gold 75 cl', '75cl', 'bottle', 'ea', 1, 4775.7, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(451, 7, 3, 7, 'Tequila gold', 'Alcoholic Drinks', 'SHU456945', 'Olmeca Tequila Gold 75 cl', '75cl', 'bottle', 'ea', 1, 4992.17, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(452, 4, 7, 4, 'Three Barrel VSOP', 'Alcoholic Drinks', 'SHU456947', 'Three Barrels Brandy V.S.O.P 70cl', '70cl', 'bottle', 'ea', 1, 1730.9, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(453, 5, 11, 5, 'Three Barrel VSOP', 'Alcoholic Drinks', 'UKN456947', 'Three Barrels Brandy V.S.O.P 70cl', '70cl', 'bottle', 'ea', 1, 1602.53, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(454, 6, 2, 6, 'Trophy', 'Alcoholic Drinks', 'SHU456948', 'Trophy Lager Beer Can - 50CL (x6 Cans)', '50cl', 'can', 'pack', 6, 1635.65, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(455, 7, 3, 7, 'Trophy', 'Alcoholic Drinks', 'SHU456948', 'Trophy Lager Beer Can - 50CL (x6 Cans)', '50cl', 'can', 'pack', 6, 1587.87, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(456, 4, 7, 4, 'Trophy', 'Alcoholic Drinks', 'SHU456948', 'Trophy Lager Beer Can - 50CL (x6 Cans)', '50cl', 'can', 'pack', 6, 1643.19, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(457, 4, 7, 4, 'Valdivieso', 'Alcoholic Drinks', 'SHU456949', 'Valdivieso Classic Chardonnay', '', 'bottle', 'ea', 1, 5810.23, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(458, 5, 11, 5, 'Valdivieso', 'Alcoholic Drinks', 'SHU456949', 'Valdivieso Classic Chardonnay', '', 'bottle', 'ea', 1, 5637.99, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(459, 6, 2, 6, 'Nestle', 'Packaged Water', 'SHU456950', 'Nestle Pure Life Water 150 cl x12', '150cl', 'bottle', 'pack', 12, 1253.64, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(460, 7, 3, 7, 'Nestle', 'Packaged Water', 'SHU456950', 'Nestle Pure Life Water 150 cl x12', '150cl', 'bottle', 'pack', 12, 1234.43, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(461, 4, 7, 4, 'Nestle', 'Packaged Water', 'SHU456950', 'Nestle Pure Life Water 150 cl x12', '150cl', 'bottle', 'pack', 12, 1249.2, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(462, 4, 7, 4, 'Nestle', 'Packaged Water', 'SHU456951', 'Nestle table water 60cl x 20', '60cl', 'bottle', 'pack', 20, 1378.59, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(463, 5, 11, 5, 'Nestle', 'Packaged Water', 'SHU456951', 'Nestle table water 60cl x 20', '60cl', 'bottle', 'pack', 20, 1425.09, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(464, 7, 3, 7, 'Williams lawson', 'Alcoholic Drinks', 'SHU456952', 'William Lawson\'s Scotch Whisky - 75cl', '75cl', 'bottle', 'ea', 1, 4190.51, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(465, 4, 7, 4, 'Williams lawson', 'Alcoholic Drinks', 'SHU456952', 'William Lawson\'s Scotch Whisky - 75cl', '75cl', 'bottle', 'ea', 1, 4396.54, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(466, 5, 11, 5, 'Williams lawson', 'Alcoholic Drinks', 'SHU456953', 'William Lawson Scotch Whisky 200ml', '200ml', 'bottle', 'ea', 1, 1160.08, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(467, 6, 2, 6, 'Williams lawson', 'Alcoholic Drinks', 'SHU456953', 'William Lawson Scotch Whisky 200ml', '200ml', 'bottle', 'ea', 1, 1161.77, '0000-00-00 00:00:00', 1, '', 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 8),
(481, 7, 3, 7, 'Airwick', 'Air Freshener', 'UKN456948', 'Air wick Freshmatic Refill Air Freshener - Sparkling Citrux', '500ml', 'refill', 'ea', 1, 2049.5, '2021-11-19 23:57:41', 0, '', 0, '', NULL, NULL, NULL, NULL, NULL, '2021-11-19', 39),
(482, 7, 3, 7, 'Clearasil', 'Soaps and Detergents', 'UKN456949', 'Clearasil Shower Gel', '130ml/0.6kg', 'bottle', 'ea', 1, 3970, '2021-11-19 23:57:41', 0, '', 0, '', NULL, NULL, NULL, NULL, NULL, '2021-11-19', 39),
(483, 7, 3, 7, 'Milo', 'Teas and Beverages', 'UKN456950', 'Nestle Milo 20g', '20g', 'satchet', 'ea', 1, 65, '2021-11-19 23:57:41', 0, '', 0, '', NULL, NULL, NULL, NULL, NULL, '2021-11-19', 39);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_porders`
--

CREATE TABLE `vendor_porders` (
  `id` bigint(20) NOT NULL,
  `porder_no` varchar(20) NOT NULL,
  `porder_date` datetime NOT NULL,
  `src_requisition_id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `requester_id` bigint(20) NOT NULL,
  `issuer_id` bigint(20) NOT NULL,
  `issuer_notes` varchar(500) NOT NULL,
  `order_descr` varchar(500) NOT NULL,
  `sub_total` double NOT NULL,
  `vat` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_method` int(11) NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `shipping_cost` double NOT NULL,
  `status` int(11) NOT NULL,
  `rel_request_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_porder_line_items`
--

CREATE TABLE `vendor_porder_line_items` (
  `id` bigint(20) NOT NULL,
  `porder_id` bigint(20) NOT NULL,
  `vendor_product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total_cost` double NOT NULL,
  `additional_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_preqs`
--

CREATE TABLE `vendor_preqs` (
  `id` bigint(20) NOT NULL,
  `preq_date` datetime NOT NULL,
  `requisition_no` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `requester_id` bigint(20) NOT NULL,
  `approver_id` bigint(20) NOT NULL,
  `approver_notes` varchar(500) NOT NULL,
  `base_cost` double NOT NULL,
  `status` int(11) NOT NULL,
  `rel_request_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_preq_line_items`
--

CREATE TABLE `vendor_preq_line_items` (
  `id` bigint(20) NOT NULL,
  `preq_id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `vendor_product_id` bigint(20) NOT NULL,
  `rate` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL,
  `additional_info` varchar(500) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations_members`
--
ALTER TABLE `conversations_members`
  ADD UNIQUE KEY `unique` (`conversation_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `conversations_messages`
--
ALTER TABLE `conversations_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `customer_porders`
--
ALTER TABLE `customer_porders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `porder_no` (`porder_no`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `originator_id` (`originator_id`),
  ADD KEY `preq_id` (`preq_id`);

--
-- Indexes for table `customer_porder_line_items`
--
ALTER TABLE `customer_porder_line_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `porder_id` (`porder_id`),
  ADD KEY `catalog_product_id` (`catalog_product_id`);

--
-- Indexes for table `customer_porder_receive_txns`
--
ALTER TABLE `customer_porder_receive_txns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `catalog_product_id` (`catalog_product_id`),
  ADD KEY `porder_id` (`porder_id`);

--
-- Indexes for table `customer_preqs`
--
ALTER TABLE `customer_preqs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `porder_no` (`preq_no`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `originator_id` (`originator_id`),
  ADD KEY `domain_id` (`domain_id`),
  ADD KEY `sub_dom_id` (`sub_dom_id`);

--
-- Indexes for table `customer_preq_line_items`
--
ALTER TABLE `customer_preq_line_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preq_id` (`preq_id`),
  ADD KEY `catalog_product_id` (`catalog_product_id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain_operators`
--
ALTER TABLE `domain_operators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `assoc_role` (`assoc_role`),
  ADD KEY `dom_function_id` (`dom_function_id`),
  ADD KEY `domain_operators_ibfk_1` (`domain_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `groups_roles`
--
ALTER TABLE `groups_roles`
  ADD UNIQUE KEY `group_id` (`group_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `ims_events`
--
ALTER TABLE `ims_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_requests`
--
ALTER TABLE `ims_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generated_by` (`generated_by`);

--
-- Indexes for table `loginattempts`
--
ALTER TABLE `loginattempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domain_id` (`domain_id`);

--
-- Indexes for table `page_access_groups`
--
ALTER TABLE `page_access_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Indexes for table `page_access_groups_roles`
--
ALTER TABLE `page_access_groups_roles`
  ADD UNIQUE KEY `pag_id` (`pag_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `page_access_level`
--
ALTER TABLE `page_access_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `project_tasks`
--
ALTER TABLE `project_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `static_codes`
--
ALTER TABLE `static_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sku` (`sku`),
  ADD KEY `domain_id` (`domain_id`),
  ADD KEY `sub_dom_id` (`sub_dom_id`);

--
-- Indexes for table `stock_txns`
--
ALTER TABLE `stock_txns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_reqs`
--
ALTER TABLE `store_reqs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `requisition_no` (`requisition_no`),
  ADD KEY `approver_id` (`approver_id`),
  ADD KEY `requester_id` (`requester_id`),
  ADD KEY `domain_id` (`domain_id`),
  ADD KEY `sub_dom_id` (`sub_dom_id`);

--
-- Indexes for table `store_req_line_items`
--
ALTER TABLE `store_req_line_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sku` (`sku`),
  ADD KEY `requisition_id` (`requisition_id`);

--
-- Indexes for table `subdomains`
--
ALTER TABLE `subdomains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_domain_id` (`parent_domain_id`);

--
-- Indexes for table `subdomains_users`
--
ALTER TABLE `subdomains_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sub_dom_id` (`sub_dom_id`);

--
-- Indexes for table `sys_settings`
--
ALTER TABLE `sys_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sys_key` (`sys_key`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `validation_requests`
--
ALTER TABLE `validation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `vendors_products`
--
ALTER TABLE `vendors_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `vendor_porders`
--
ALTER TABLE `vendor_porders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `porder_no` (`porder_no`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `requester_id` (`requester_id`);

--
-- Indexes for table `vendor_porder_line_items`
--
ALTER TABLE `vendor_porder_line_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `porder_id` (`porder_id`),
  ADD KEY `vendor_product_id` (`vendor_product_id`);

--
-- Indexes for table `vendor_preqs`
--
ALTER TABLE `vendor_preqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requester_id` (`requester_id`);

--
-- Indexes for table `vendor_preq_line_items`
--
ALTER TABLE `vendor_preq_line_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preq_id` (`preq_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `vendor_product_id` (`vendor_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `conversations_messages`
--
ALTER TABLE `conversations_messages`
  MODIFY `message_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_porders`
--
ALTER TABLE `customer_porders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer_porder_line_items`
--
ALTER TABLE `customer_porder_line_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_porder_receive_txns`
--
ALTER TABLE `customer_porder_receive_txns`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_preqs`
--
ALTER TABLE `customer_preqs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_preq_line_items`
--
ALTER TABLE `customer_preq_line_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `domain_operators`
--
ALTER TABLE `domain_operators`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ims_events`
--
ALTER TABLE `ims_events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ims_requests`
--
ALTER TABLE `ims_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loginattempts`
--
ALTER TABLE `loginattempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `page_access_groups`
--
ALTER TABLE `page_access_groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page_access_level`
--
ALTER TABLE `page_access_level`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `project_tasks`
--
ALTER TABLE `project_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `static_codes`
--
ALTER TABLE `static_codes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `stock_txns`
--
ALTER TABLE `stock_txns`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_reqs`
--
ALTER TABLE `store_reqs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_req_line_items`
--
ALTER TABLE `store_req_line_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subdomains`
--
ALTER TABLE `subdomains`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subdomains_users`
--
ALTER TABLE `subdomains_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sys_settings`
--
ALTER TABLE `sys_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `validation_requests`
--
ALTER TABLE `validation_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors_products`
--
ALTER TABLE `vendors_products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;

--
-- AUTO_INCREMENT for table `vendor_porders`
--
ALTER TABLE `vendor_porders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_porder_line_items`
--
ALTER TABLE `vendor_porder_line_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_preqs`
--
ALTER TABLE `vendor_preqs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_preq_line_items`
--
ALTER TABLE `vendor_preq_line_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `customer_porders`
--
ALTER TABLE `customer_porders`
  ADD CONSTRAINT `customer_porders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `customer_porders_ibfk_2` FOREIGN KEY (`originator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customer_porders_ibfk_3` FOREIGN KEY (`preq_id`) REFERENCES `customer_preqs` (`id`);

--
-- Constraints for table `customer_porder_line_items`
--
ALTER TABLE `customer_porder_line_items`
  ADD CONSTRAINT `customer_porder_line_items_ibfk_1` FOREIGN KEY (`porder_id`) REFERENCES `customer_porders` (`id`),
  ADD CONSTRAINT `customer_porder_line_items_ibfk_2` FOREIGN KEY (`catalog_product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `customer_porder_receive_txns`
--
ALTER TABLE `customer_porder_receive_txns`
  ADD CONSTRAINT `customer_porder_receive_txns_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customer_porder_receive_txns_ibfk_2` FOREIGN KEY (`catalog_product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `customer_porder_receive_txns_ibfk_3` FOREIGN KEY (`porder_id`) REFERENCES `customer_porders` (`id`);

--
-- Constraints for table `customer_preqs`
--
ALTER TABLE `customer_preqs`
  ADD CONSTRAINT `customer_preqs_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `customer_preqs_ibfk_2` FOREIGN KEY (`originator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customer_preqs_ibfk_3` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`),
  ADD CONSTRAINT `customer_preqs_ibfk_4` FOREIGN KEY (`sub_dom_id`) REFERENCES `subdomains` (`id`);

--
-- Constraints for table `customer_preq_line_items`
--
ALTER TABLE `customer_preq_line_items`
  ADD CONSTRAINT `customer_preq_line_items_ibfk_1` FOREIGN KEY (`preq_id`) REFERENCES `customer_preqs` (`id`),
  ADD CONSTRAINT `customer_preq_line_items_ibfk_2` FOREIGN KEY (`catalog_product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `domain_operators`
--
ALTER TABLE `domain_operators`
  ADD CONSTRAINT `domain_operators_ibfk_1` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`),
  ADD CONSTRAINT `domain_operators_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `domain_operators_ibfk_3` FOREIGN KEY (`assoc_role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `domain_operators_ibfk_4` FOREIGN KEY (`dom_function_id`) REFERENCES `sys_settings` (`id`);

--
-- Constraints for table `groups_roles`
--
ALTER TABLE `groups_roles`
  ADD CONSTRAINT `groups_roles_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `groups_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `ims_requests`
--
ALTER TABLE `ims_requests`
  ADD CONSTRAINT `ims_requests_ibfk_1` FOREIGN KEY (`generated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_ibfk_1` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`);

--
-- Constraints for table `page_access_groups_roles`
--
ALTER TABLE `page_access_groups_roles`
  ADD CONSTRAINT `page_access_groups_roles_ibfk_1` FOREIGN KEY (`pag_id`) REFERENCES `page_access_groups` (`id`),
  ADD CONSTRAINT `page_access_groups_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `page_access_level`
--
ALTER TABLE `page_access_level`
  ADD CONSTRAINT `page_access_level_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `page_access_level_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`sku`) REFERENCES `products` (`sku`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`),
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`sub_dom_id`) REFERENCES `subdomains` (`id`);

--
-- Constraints for table `store_reqs`
--
ALTER TABLE `store_reqs`
  ADD CONSTRAINT `store_reqs_ibfk_1` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `store_reqs_ibfk_2` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `store_reqs_ibfk_3` FOREIGN KEY (`domain_id`) REFERENCES `domains` (`id`),
  ADD CONSTRAINT `store_reqs_ibfk_4` FOREIGN KEY (`sub_dom_id`) REFERENCES `subdomains` (`id`);

--
-- Constraints for table `store_req_line_items`
--
ALTER TABLE `store_req_line_items`
  ADD CONSTRAINT `store_req_line_items_ibfk_2` FOREIGN KEY (`sku`) REFERENCES `products` (`sku`),
  ADD CONSTRAINT `store_req_line_items_ibfk_3` FOREIGN KEY (`requisition_id`) REFERENCES `store_reqs` (`id`);

--
-- Constraints for table `subdomains`
--
ALTER TABLE `subdomains`
  ADD CONSTRAINT `subdomains_ibfk_1` FOREIGN KEY (`parent_domain_id`) REFERENCES `domains` (`id`);

--
-- Constraints for table `subdomains_users`
--
ALTER TABLE `subdomains_users`
  ADD CONSTRAINT `subdomains_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subdomains_users_ibfk_2` FOREIGN KEY (`sub_dom_id`) REFERENCES `subdomains` (`id`);

--
-- Constraints for table `vendors_products`
--
ALTER TABLE `vendors_products`
  ADD CONSTRAINT `vendors_products_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `vendors_products_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `vendor_porders`
--
ALTER TABLE `vendor_porders`
  ADD CONSTRAINT `vendor_porders_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `vendor_porders_ibfk_2` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vendor_porder_line_items`
--
ALTER TABLE `vendor_porder_line_items`
  ADD CONSTRAINT `vendor_porder_line_items_ibfk_1` FOREIGN KEY (`porder_id`) REFERENCES `vendor_porders` (`id`),
  ADD CONSTRAINT `vendor_porder_line_items_ibfk_2` FOREIGN KEY (`vendor_product_id`) REFERENCES `vendors_products` (`id`);

--
-- Constraints for table `vendor_preqs`
--
ALTER TABLE `vendor_preqs`
  ADD CONSTRAINT `vendor_preqs_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vendor_preq_line_items`
--
ALTER TABLE `vendor_preq_line_items`
  ADD CONSTRAINT `vendor_preq_line_items_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `vendor_preq_line_items_ibfk_2` FOREIGN KEY (`preq_id`) REFERENCES `vendor_preqs` (`id`),
  ADD CONSTRAINT `vendor_preq_line_items_ibfk_3` FOREIGN KEY (`vendor_product_id`) REFERENCES `vendors_products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
