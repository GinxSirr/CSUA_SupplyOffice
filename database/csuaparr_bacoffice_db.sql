-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2025 at 01:40 PM
-- Server version: 8.0.40-cll-lve
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csuaparr_bacoffice_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int NOT NULL,
  `folder_id` int NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` int NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `folder_id`, `file_name`, `file_path`, `file_type`, `file_size`, `uploaded_at`) VALUES
(3, 7, 'Accredited org_2024 (2).pdf', 'C:/Users/Mark Angelo Bulauan/OneDrive/Documents/ScannedPAR/par3\\68595721a90d4_Accredited_org_2024__2_.pdf', 'pdf', 1326390, '2025-06-23 21:31:13'),
(4, 8, 'updated_products (3).xlsx', 'C:/Users/Mark Angelo Bulauan/OneDrive/Documents/ScannedPAR/par2\\685957433f66b_updated_products__3_.xlsx', 'xlsx', 51383, '2025-06-23 21:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int NOT NULL,
  `folder_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `folder_name`, `created_at`, `updated_at`) VALUES
(7, 'par3', '2025-06-23 13:16:57', '2025-06-23 13:16:57'),
(8, 'par2', '2025-06-23 13:31:37', '2025-06-23 13:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `iar`
--

CREATE TABLE `iar` (
  `id` int NOT NULL,
  `iar_no` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `entity_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fund_cluster` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `supplier` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `po_no_date` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `office_dept` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `responsibility_code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_inspected` date NOT NULL,
  `invoice_no` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_accepted` date NOT NULL,
  `inspection_officer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `product_date` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stock_no` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `product_description` text COLLATE utf8mb4_general_ci,
  `unit` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `iar_group_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iar`
--

INSERT INTO `iar` (`id`, `iar_no`, `entity_name`, `fund_cluster`, `supplier`, `po_no_date`, `office_dept`, `responsibility_code`, `date_inspected`, `invoice_no`, `date_accepted`, `inspection_officer`, `product_date`, `stock_no`, `product_description`, `unit`, `quantity`, `iar_group_id`) VALUES
(9, 'A-2021-03-041', 'CAGAYAN STATE UNIVERSITY AT APARRI', 'sdsa', 'ST. PATRICK GARDEN HOTEL', 'SO-A-2021-03-002   MARCH 9, 2021', 'CHM', '', '2025-06-19', '2047', '2025-06-19', 'LITO D. MAPE / GLOMARIE GABRIEL', 'Day 1 -June 19, 2025', '1', 'Lunch, Nido soup, fresh lumpia, pork hamonado, chicken pastel, carbonara, pipino salad, fruit salad, rice and bottled water', 'pax', 50, 'IARG-6853627184df3'),
(10, 'A-2021-03-041', 'CAGAYAN STATE UNIVERSITY AT APARRI', 'sdsa', 'ST. PATRICK GARDEN HOTEL', 'SO-A-2021-03-002   MARCH 9, 2021', 'CHM', '', '2025-06-19', '2047', '2025-06-19', 'LITO D. MAPE / GLOMARIE GABRIEL', 'Day 1 -June 19, 2025', '2', 'Lunch, Nido soup, fresh lumpia, pork hamonado, chicken pastel, carbonara, pipino salad, fruit salad, rice and bottled water', 'pax', 40, 'IARG-6853627184df3'),
(11, 'A-2021-03-041', 'CAGAYAN STATE UNIVERSITY AT APARRI', 'sdsa', 'ST. PATRICK GARDEN HOTEL', 'SO-A-2021-03-002   MARCH 9, 2021', 'CHM', '', '2025-06-19', '2047', '2025-06-19', 'LITO D. MAPE / GLOMARIE GABRIEL', 'Day 2 - June 20,2025', '1', 'Lunch, Nido soup, fresh lumpia, pork hamonado, chicken pastel, carbonara, pipino salad, fruit salad, rice and bottled water', 'pax', 30, 'IARG-6853627184df3'),
(12, '-', 'CAGAYAN STATE UNIVERSITY AT APARRI', '-', 'Gino', '-', '-', '-', '2025-10-06', '-', '2025-10-07', '-', '-', '1', 'laptop', 'unit', 1, 'IARG-68e36c9424c5e');

-- --------------------------------------------------------

--
-- Table structure for table `order_requests`
--

CREATE TABLE `order_requests` (
  `order_id` int UNSIGNED NOT NULL,
  `transaction_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `unit_of_measurement` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `requested_quantity` int NOT NULL,
  `person_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `office_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `purpose` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Pending','Approved','Rejected') COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `remarks` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `admin_message` text COLLATE utf8mb4_general_ci,
  `rejection_reason` text COLLATE utf8mb4_general_ci,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_requests`
--

INSERT INTO `order_requests` (`order_id`, `transaction_id`, `user_id`, `product_id`, `product_code`, `description`, `unit_of_measurement`, `requested_quantity`, `person_name`, `designation`, `office_name`, `purpose`, `status`, `remarks`, `admin_message`, `rejection_reason`, `request_date`, `user_read`) VALUES
(106, 29, 4, 2217, '12191601-AL-E04', 'ALCOHOL, Ethyl, 500ml', 'bottle', 1, 'Jhunrey Ordioso', 'BAC Sec', 'BAC', 'For Office Use.', 'Approved', 'Available', 'pick up na po', '', '2025-10-06 01:25:43', 0),
(107, 30, 3, 2348, '14111514-NP-S03', 'NOTE PAD, stick on, 3\" x 3\"', 'PAD', 1, 'Jhunrey Ordioso', 'BAC Sec', 'BAC', 'office use', 'Rejected', 'Not Available', NULL, 'no available stock', '2025-10-07 04:00:55', 0),
(108, 30, 3, 2349, '14111514-NP-S02', 'NOTE PAD, stick on, 50mm x 76mm (2\" x 3\") min', 'PAD', 1, 'Jhunrey Ordioso', 'BAC Sec', 'BAC', 'office use', 'Rejected', 'Not Available', NULL, 'no available stock', '2025-10-07 04:00:55', 0),
(109, 30, 3, 2350, '14111514-NP-S04', 'NOTE PAD, stick on, 76mm x 100mm (3\" x 4\") min', 'PAD', 1, 'Jhunrey Ordioso', 'BAC Sec', 'BAC', 'office use', 'Rejected', 'Not Available', NULL, 'no available stock', '2025-10-07 04:00:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `par`
--

CREATE TABLE `par` (
  `id` int NOT NULL,
  `entity_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fund_cluster` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `par_no` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `received_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `received_position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `received_date` date NOT NULL,
  `issued_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `issued_position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `issued_date` date NOT NULL,
  `quantity` int NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `property_number` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_acquired` date DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `par_group_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `par_transfers`
--

CREATE TABLE `par_transfers` (
  `id` int NOT NULL,
  `par_id` int NOT NULL,
  `entity_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fund_cluster` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `par_no` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `property_number` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_acquired` date DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `par_group_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `approved_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `approved_position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `approved_date` date NOT NULL,
  `issued_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `issued_position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `issued_date` date NOT NULL,
  `received_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `received_position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `received_date` date NOT NULL,
  `transfer_reason` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `par_transfers`
--

INSERT INTO `par_transfers` (`id`, `par_id`, `entity_name`, `fund_cluster`, `par_no`, `quantity`, `unit`, `description`, `property_number`, `date_acquired`, `amount`, `par_group_id`, `approved_by`, `approved_position`, `approved_date`, `issued_by`, `issued_position`, `issued_date`, `received_by`, `received_position`, `received_date`, `transfer_reason`, `created_at`) VALUES
(23, 6, 'CAGAYAN STATE UNIVERSITY AT APARRI', '213123', '1111111', '1', 'sets', 'Large Industrial Fan; Ceiling Mounted, Heavy Duty ', '1', '0000-00-00', 99999999.99, 'PARG-6853b3e5a2790', 'Diosa Mari C. Domingo', 'Campus Supply Officer', '2025-06-19', 'Jenean M. Luga', 'Property Custodian', '2025-06-19', 'EUSEBIO SARMIENTO', 'Campus Infra Coordinator ', '2025-06-19', 'asaSas', '2025-06-19 13:24:24'),
(24, 7, 'CAGAYAN STATE UNIVERSITY AT APARRI', '21', '11', '10', 'sets', 'Large Industrial Fan; Ceiling Mounted, Heavy Duty ', '2', '2025-06-18', 99999999.99, 'PARG-6853ff21725b1', 'Diosa Mari C. Domingo', 'Campus Supply Officer', '2025-06-19', 'Jenean M. Luga', 'Property Custodian', '2025-06-19', 'EUSEBIO SARMIENTO', 'Campus Infra Coordinator ', '2025-06-19', 'ZSdasdasdas', '2025-06-19 13:35:52'),
(25, 8, 'CAGAYAN STATE UNIVERSITY AT APARRI', '22', '22', '22', 'pack', 'pack', '22', '1111-11-11', 99999999.99, 'PARG-68540d8f35f52', 'Mark Angelo Bulauan', 'Campus Supply Officer', '2025-06-19', 'Jenean M. Luga', 'Property Custodian', '2025-06-19', 'EUSEBIO SARMIENTO', 'Campus Infra Coordinator ', '2025-06-19', 'reiter', '2025-06-19 14:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` int UNSIGNED NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `unit_of_measurement` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `product_code`, `product_description`, `unit_of_measurement`, `quantity`, `price`, `created_at`) VALUES
(2214, '13111203-AC-F01', 'ACETATE', 'ROLL', 0, 79.00, '2025-06-20 04:18:43'),
(2215, '47131812-AF-A01', 'AIR FRESHENER, Aerosol Type', 'Can', 77, 417.00, '2025-06-20 04:18:43'),
(2216, '12191601-AL-E03', 'ALCOHOL, Ethyl, 1 Gallon', 'Gallon', 362, 9.00, '2025-06-20 04:18:43'),
(2217, '12191601-AL-E04', 'ALCOHOL, Ethyl, 500ml', 'bottle', 8, 2.00, '2025-06-20 04:18:43'),
(2218, '26111702-BT-A01', 'BATTERY, dry cell, AAA', 'Pack', 15, 0.00, '2025-06-20 04:18:43'),
(2219, '26111702-BT-A02', 'BATTERY, dry Cell, size AA', 'Pack', 19, 0.00, '2025-06-20 04:18:43'),
(2220, '44101602-PB-M01', 'BINDING AND PUNCHING MACHINE, 50mm binding capacit', 'Unit', 0, 0.00, '2025-06-20 04:18:43'),
(2221, '44122037-RB-P10', 'BINDING RING/COMB, plastic, 32mm', 'Bundle', 0, 0.00, '2025-06-20 04:18:43'),
(2222, '44121612-BL-H01', 'BLADE, for general purpose cutter/utility knife', 'Tube', 9, 0.00, '2025-06-20 04:18:43'),
(2223, '47131604-BR-S01', 'BROOM (Walis Tambo)', 'Piece', 141, 0.00, '2025-06-20 04:18:43'),
(2224, '47131604-BR-T01', 'BROOM (Walis Ting-Ting)', 'Piece', 19, 0.00, '2025-06-20 04:18:43'),
(2225, '44101807-CA-C01', 'CALCULATOR, Compact', 'Unit', 223, 239.00, '2025-06-20 04:18:43'),
(2226, '13111201-CF-P02', 'CARBON FILM, Legal Size', 'Box', 362, 224.00, '2025-06-20 04:18:43'),
(2227, '14111525-CA-A01', 'CARTOLINA, assorted colors', 'Pack', 87, 0.00, '2025-06-20 04:18:43'),
(2228, '44121710-CH-W01', 'CHALK, white enamel', 'Box', 25, 0.00, '2025-06-20 04:18:43'),
(2229, '47131829-TB-C01', 'CLEANER, toilet and urinal', 'Bottle', 31, 0.00, '2025-06-20 04:18:43'),
(2230, '47131805-CL-P01', 'CLEANSER, scouring powder', 'Can', 24, 0.00, '2025-06-20 04:18:43'),
(2231, '60121413-CB-P01', 'CLEARBOOK, A4', 'Piece', 36, 106.00, '2025-06-20 04:18:43'),
(2232, '60121413-CB-P02', 'CLEARBOOK, Legal', 'Piece', 38, 138.00, '2025-06-20 04:18:43'),
(2233, '44122105-BF-C01', 'CLIP, Backfold, 19mm', 'Box', 11, 3.00, '2025-06-20 04:18:43'),
(2234, '44122105-BF-C02', 'CLIP, backfold, 25mm', 'Box', 20, 1.00, '2025-06-20 04:18:43'),
(2235, '44122105-BF-C03', 'CLIP, Backfold, 32mm', 'Box', 34, 0.00, '2025-06-20 04:18:43'),
(2236, '44122105-BF-C04', 'CLIP, Backfold, 50mm', 'Box', 64, 555.00, '2025-06-20 04:18:43'),
(2237, '14111506-CF-L11', 'COMPUTER CONTINUOUS FORM, 1 ply, 280mm x 241mm', 'Box', 972, 0.00, '2025-06-20 04:18:43'),
(2238, '14111506-CF-L12', 'COMPUTER CONTINUOUS FORM, 1 ply, 280mm x 378mm', 'Box', 977, 0.00, '2025-06-20 04:18:43'),
(2239, '43211708-MO-O02', 'COMPUTER MOUSE, Wireless', 'Unit', 166, 1.00, '2025-06-20 04:18:43'),
(2240, '44121801-CT-R02', 'CORRECTION TAPE', 'Piece', 19, 0.00, '2025-06-20 04:18:43'),
(2241, '44121612-CU-H01', 'CUTTER/UTILITY KNIFE, for general purpose', 'Piece', 32, 0.00, '2025-06-20 04:18:43'),
(2242, '44111515-DF-B01', 'DATA FILE BOX', 'Piece', 150, 0.00, '2025-06-20 04:18:43'),
(2243, '44122011-DF-F01', 'DATA FOLDER', 'Piece', 102, 211.00, '2025-06-20 04:18:43'),
(2244, '44103202-DS-M01', 'DATER STAMP', 'Piece', 478, 0.00, '2025-06-20 04:18:43'),
(2245, '43211507-DSK001', 'DESKTOP FOR BASIC USERS', 'Unit', 25, 0.00, '2025-06-20 04:18:43'),
(2246, '43211507-DSK002', 'DESKTOP FOR MID-RANGE USERS', 'Unit', 43, 0.00, '2025-06-20 04:18:43'),
(2247, '47131811-DE-B02', 'DETERGENT BAR, 140g', 'PIECE', 9, 2.00, '2025-06-20 04:18:43'),
(2248, '47131811-DE-P03', 'DETERGENT POWDER, all-purpose', 'POUCH', 0, 0.00, '2025-06-20 04:18:43'),
(2249, '52161535-DV-R01', 'DIGITAL VOICE RECORDER', 'Unit', 7, 0.00, '2025-06-20 04:18:43'),
(2250, '47131803-DS-A01', 'DISINFECTANT SPRAY, aerosol, 400g (min)', 'Can', 144, 0.00, '2025-06-20 04:18:43'),
(2251, '45121517-DO-C02', 'DOCUMENT CAMERA, 8 MP', 'Unit', 24, 0.00, '2025-06-20 04:18:43'),
(2252, '44103109-BR-D05', 'DRUM CART, BROTHER DR-3455, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2253, '47131601-DU-P01', 'DUST PAN', 'Piece', 48, 0.00, '2025-06-20 04:18:43'),
(2254, '40101604-EF-C01', 'ELECTRIC FAN, Ceiling Mount, Orbit Type', 'Unit', 1, 0.00, '2025-06-20 04:18:43'),
(2255, '40101604-EF-G01', 'ELECTRIC FAN, Industrial, Ground Type', 'Unit', 1, 0.00, '2025-06-20 04:18:43'),
(2256, '40101604-EF-S01', 'ELECTRIC FAN, Stand Type', 'Unit', 1, 0.00, '2025-06-20 04:18:43'),
(2257, '40101604-EF-W01', 'ELECTRIC FAN, Wall Mount', 'Unit', 928, 3.00, '2025-06-20 04:18:43'),
(2258, '44121506-EN-D01', 'ENVELOPE, Documentary, A4', 'Box', 872, 0.00, '2025-06-20 04:18:43'),
(2259, '44121506-EN-D02', 'ENVELOPE, Documentary, Legal', 'BOX', 1, 0.00, '2025-06-20 04:18:43'),
(2260, '44121506-EN-X01', 'ENVELOPE, Expanding, Kraft', 'Box', 967, 0.00, '2025-06-20 04:18:43'),
(2261, '44121506-EN-X02', 'ENVELOPE, expanding, plastic', 'Piece', 31, 0.00, '2025-06-20 04:18:43'),
(2262, '44121506-EN-M02', 'ENVELOPE, Mailing', 'Box', 473, 92.00, '2025-06-20 04:18:43'),
(2263, '44121504-EN-W02', 'ENVELOPE, Mailing with Window', 'Box', 528, 0.00, '2025-06-20 04:18:43'),
(2264, '44121506-EN-M01', 'ENVELOPE, Mailing, White', '', 463, 0.00, '2025-06-20 04:18:43'),
(2265, '44111912-ER-B01', 'ERASER, Felt, Blackboard/Whiteboard', 'PIECE', 11, 0.00, '2025-06-20 04:18:43'),
(2266, '60121534-ER-P01', 'ERASER, Plastic/Rubber', 'Piece', 9, 169.00, '2025-06-20 04:18:43'),
(2267, '43201827-HD-X02', 'EXTERNAL HARD DRIVE', 'Unit', 3, 0.00, '2025-06-20 04:18:43'),
(2268, '44122118-FA-P01', 'FASTENER, metal', 'Box', 98, 0.00, '2025-06-20 04:18:43'),
(2269, '44111515-FO-X01', 'FILE ORGANIZER', 'Piece', 93, 153.00, '2025-06-20 04:18:43'),
(2270, '44122018-FT-D01', 'FILE TAB DIVIDER, A4', 'SET', 12, 0.00, '2025-06-20 04:18:43'),
(2271, '44122018-FT-D02', 'FILE TAB DIVIDER, legal', 'Set', 17, 0.00, '2025-06-20 04:18:43'),
(2272, '46191601-FE-M01', 'FIRE EXTINGUISHER, dry chemical', 'Unit', 1, 0.00, '2025-06-20 04:18:43'),
(2273, '43202010-FD-U04', 'FLASH DRIVE, 64GB capacity', '', 157, 395.00, '2025-06-20 04:18:43'),
(2274, '47131802-FW-P02', 'FLOOR WAX, paste type, red', 'Can', 319, 0.00, '2025-06-20 04:18:43'),
(2275, '44122011-FO-T03', 'FOLDER with Tab, A4', 'Pack', 390, 104.00, '2025-06-20 04:18:43'),
(2276, '44122011-FO-T04', 'FOLDER with TAB, Legal', 'Pack', 426, 1.00, '2025-06-20 04:18:43'),
(2277, '44122011-FO-F01', 'FOLDER, Fancy, A4', 'Bundle', 278, 44.00, '2025-06-20 04:18:43'),
(2278, '44122011-FO-L01', 'FOLDER, L-type, A4', 'Pack', 166, 0.00, '2025-06-20 04:18:43'),
(2279, '44122011-FO-L02', 'FOLDER, L-type, Legal', 'Pack', 182, 0.00, '2025-06-20 04:18:43'),
(2280, '44122011-FO-F02', 'FOLDER, Morocco with Slide, Legal', 'Bundle', 299, 12.00, '2025-06-20 04:18:43'),
(2281, '44122027-FO-P01', 'FOLDER, pressboard', 'Box', 981, 0.00, '2025-06-20 04:18:43'),
(2282, '47131830-FC-A01', 'FURNITURE CLEANER', 'Can', 145, 830.00, '2025-06-20 04:18:43'),
(2283, '31201610-GL-J01', 'GLUE, All Purpose', 'Jar', 73, 0.00, '2025-06-20 04:18:43'),
(2284, '53131626-HS-S01', 'HAND SANITIZER, 500mL', 'Bottle', 88, 0.00, '2025-06-20 04:18:43'),
(2285, '73101612-HS-L01', 'HAND SOAP, LIQUID, 500ml', 'Bottle', 46, 0.00, '2025-06-20 04:18:43'),
(2286, '55101524-RA-H01', 'HANDBOOK (RA 9184), 8th edition', 'Book', 48, 0.00, '2025-06-20 04:18:43'),
(2287, '44122008-IT-T01', 'INDEX TAB', 'Box', 50, 0.00, '2025-06-20 04:18:43'),
(2288, '44103105-CA-C04', 'Ink Cartridge, Canon CL-741, Colored', 'Cart', 1, 0.00, '2025-06-20 04:18:43'),
(2289, '44103105-CA-C02', 'Ink Cartridge, Canon CL-811, Colored', 'Cart', 1, 0.00, '2025-06-20 04:18:43'),
(2290, '44103105-CA-B04', 'Ink Cartridge, Canon PG-740, Black', 'Cart', 775, 0.00, '2025-06-20 04:18:43'),
(2291, '44103105-CA-B02', 'Ink Cartridge, Canon PG-810, Black', 'Cart', 918, 0.00, '2025-06-20 04:18:43'),
(2292, '44103105-EP-B17', 'INK CARTRIDGE, EPSON C13T664100 (T6641), BLACK', 'Cart', 238, 0.00, '2025-06-20 04:18:43'),
(2293, '44103105-EP-C17', 'INK CARTRIDGE, EPSON C13T664200 (T6642), CYAN', 'Cart', 249, 0.00, '2025-06-20 04:18:43'),
(2294, '44103105-EP-M17', 'INK CARTRIDGE, EPSON C13T664300 (T6643), MAGENTA', 'Cart', 249, 0.00, '2025-06-20 04:18:43'),
(2295, '44103105-EP-Y17', 'INK CARTRIDGE, EPSON C13T664400 (T6644), YELLOW', 'Cart', 249, 0.00, '2025-06-20 04:18:43'),
(2296, '44103105-HP-B40', 'INK CARTRIDGE, HP C2P04AA (HP62), BLACK', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2297, '44103105-HP-T40', 'INK CARTRIDGE, HP C2P06AA (HP62), TRI-COLOR', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2298, '44103105-HP-B09', 'INK CARTRIDGE, HP C9351AA, (HP21), BLACK', 'Cart', 668, 0.00, '2025-06-20 04:18:43'),
(2299, '44103105-HP-T10', 'INK CARTRIDGE, HP C9352AA, (HP22), TRI-COLOR', 'Cart', 773, 0.00, '2025-06-20 04:18:43'),
(2300, '44103105-HP-B17', 'INK CARTRIDGE, HP CC640WA (HP60), BLACK', 'Cart', 906, 0.00, '2025-06-20 04:18:43'),
(2301, '44103105-HP-T17', 'INK CARTRIDGE, HP CC643WA (HP60), TRI-COLOR', 'Cart', 775, 0.00, '2025-06-20 04:18:43'),
(2302, '44103105-HP-B35', 'INK CARTRIDGE, HP CD887AA (HP703), BLACK', 'Cart', 358, 0.00, '2025-06-20 04:18:43'),
(2303, '44103105-HP-T35', 'INK CARTRIDGE, HP CD888AA (HP703), TRI-COLOR', 'Cart', 346, 0.00, '2025-06-20 04:18:43'),
(2304, '44103105-HX-C40', 'INK CARTRIDGE, HP CD972AA (HP920XL), CYAN', 'Cart', 647, 0.00, '2025-06-20 04:18:43'),
(2305, '44103105-HX-M40', 'INK CARTRIDGE, HP CD973AA (HP920XL), MAGENTA', 'Cart', 647, 0.00, '2025-06-20 04:18:43'),
(2306, '44103105-HX-Y40', 'INK CARTRIDGE, HP CD974AA (HP920XL), YELLOW', 'Cart', 647, 0.00, '2025-06-20 04:18:43'),
(2307, '44103105-HX-B40', 'INK CARTRIDGE, HP CD975AA (HP920XL), BLACK', 'Cart', 1, 0.00, '2025-06-20 04:18:43'),
(2308, '44103105-HP-B20', 'INK CARTRIDGE, HP CH561WA (HP61), BLACK', 'Cart', 663, 0.00, '2025-06-20 04:18:43'),
(2309, '44103105-HP-T20', 'INK CARTRIDGE, HP CH562WA (HP61), TRI-COLOR', 'Cart', 850, 0.00, '2025-06-20 04:18:43'),
(2310, '44103105-HX-B43', 'INK CARTRIDGE, HP CN045AA (HP950XL), BLACK', 'Cart', 1, 0.00, '2025-06-20 04:18:43'),
(2311, '44103105-HX-C43', 'INK CARTRIDGE, HP CN046AA (HP951XL) CYAN', 'Cart', 1, 0.00, '2025-06-20 04:18:43'),
(2312, '44103105-HX-M43', 'INK CARTRIDGE, HP CN047AA (HP951XL) MAGENTA', 'Cart', 1, 0.00, '2025-06-20 04:18:43'),
(2313, '44103105-HX-Y43', 'INK CARTRIDGE, HP CN048AA (HP951XL) YELLOW', 'Cart', 1, 0.00, '2025-06-20 04:18:43'),
(2314, '44103105-HP-B36', 'INK CARTRIDGE, HP CN692AA (HP704) BLACK', 'Cart', 379, 0.00, '2025-06-20 04:18:43'),
(2315, '44103105-HP-T36', 'INK CARTRIDGE, HP CN693AA (HP704) TRI-COLOR', 'Cart', 379, 0.00, '2025-06-20 04:18:43'),
(2316, '44103105-HP-B33', 'INK CARTRIDGE, HP CZ107AA (HP678) BLACK', 'Cart', 416, 0.00, '2025-06-20 04:18:43'),
(2317, '44103105-HP-T33', 'INK CARTRIDGE, HP CZ108AA (HP678) TRI-COLOR', 'Cart', 416, 0.00, '2025-06-20 04:18:43'),
(2318, '44103105-HP-T43', 'INK CARTRIDGE, HP F6V26AA (HP680) TRI-COLOR', 'Cart', 437, 0.00, '2025-06-20 04:18:43'),
(2319, '44103105-HP-B43', 'INK CARTRIDGE, HP F6V27AA (HP680) BLACK', 'Cart', 437, 0.00, '2025-06-20 04:18:43'),
(2320, '44103105-HP-C50', 'INK CARTRIDGE, HP L0S51AA (HP955) CYAN ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2321, '44103105-HP-M50', 'INK CARTRIDGE, HP L0S54AA (HP955) MAGENTA ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2322, '44103105-HP-Y50', 'INK CARTRIDGE, HP L0S57AA (HP955) YELLOW ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2323, '44103105-HP-B50', 'INK CARTRIDGE, HP L0S60AA (HP955) BLACK ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2324, '44103105-HX-C48', 'INK CARTRIDGE, HP L0S63AA (HP955XL) CYAN ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2325, '44103105-HX-M48', 'INK CARTRIDGE, HP L0S66AA (HP955XL) MAGENTA', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2326, '44103105-HX-Y48', 'INK CARTRIDGE, HP L0S69AA (HP955XL) YELLOW', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2327, '44103105-HX-B48', 'INK CARTRIDGE, HP L0S72AA (HP955XL) BLACK ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2328, '44103105-HP-C51', 'INK CARTRIDGE, HP T6L89AA (HP905) CYAN ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2329, '44103105-HP-M51', 'INK CARTRIDGE, HP T6L93AA (HP905) MAGENTA ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2330, '44103105-HP-Y51', 'INK CARTRIDGE, HP T6L97AA (HP905) YELLOW ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2331, '44103105-HP-B51', 'INK CARTRIDGE, HP T6M01AA (HP905) BLACK ORIGINAL', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2332, '10191509-IN-A01', 'INSECTICIDE', 'Can', 144, 0.00, '2025-06-20 04:18:43'),
(2333, '43211503-LAP002', 'LAPTOP, LIGHTWEIGHT', 'unit', 48, 0.00, '2025-06-20 04:18:43'),
(2334, '43211503-LAP001', 'LAPTOP, MID-RANGE', 'unit', 43, 0.00, '2025-06-20 04:18:43'),
(2335, '39101628-LB-L01', 'LIGHT EMITTING DIODE (LED), Light Bulb', 'Piece', 0, 0.00, '2025-06-20 04:18:43'),
(2336, '39101628-LT-L01', 'LINEAR TUBE, Light Emitting Diode (LED), 18 watts', 'Piece', 0, 0.00, '2025-06-20 04:18:43'),
(2337, '44121716-MA-F01', 'MARKER, fluorescent', 'Set', 32, 356.00, '2025-06-20 04:18:43'),
(2338, '44121708-MP-B01', 'MARKER, permanent, black', 'Piece', 8, 0.00, '2025-06-20 04:18:43'),
(2339, '44121708-MP-B02', 'MARKER, permanent, blue', 'Piece', 9, 0.00, '2025-06-20 04:18:43'),
(2340, '44121708-MP-B03', 'MARKER, permanent, red', 'Piece', 9, 0.00, '2025-06-20 04:18:43'),
(2341, '44121708-MW-B01', 'MARKER, whiteboard, black', 'Piece', 10, 0.00, '2025-06-20 04:18:43'),
(2342, '44121708-MW-B02', 'MARKER, whiteboard, blue', 'Piece', 10, 0.00, '2025-06-20 04:18:43'),
(2343, '44121708-MW-B03', 'MARKER, whiteboard, red', 'Piece', 11, 0.00, '2025-06-20 04:18:43'),
(2344, '56101504-CM-B01', 'MONOBLOC CHAIR, beige', 'Piece', 357, 0.00, '2025-06-20 04:18:43'),
(2345, '56101504-CM-W01', 'MONOBLOC CHAIR, white', 'Piece', 351, 0.00, '2025-06-20 04:18:43'),
(2346, '47121804-MP-B01', 'MOP BUCKET, heavy duty, hard plastic', 'Unit', 2, 0.00, '2025-06-20 04:18:43'),
(2347, '45111609-MM-P01', 'MULTIMEDIA PROJECTOR, 4000 min', 'Unit', 17, 0.00, '2025-06-20 04:18:43'),
(2348, '14111514-NP-S03', 'NOTE PAD, stick on, 3\" x 3\"', 'PAD', 54, 0.00, '2025-06-20 04:18:43'),
(2349, '14111514-NP-S02', 'NOTE PAD, stick on, 50mm x 76mm (2\" x 3\") min', 'PAD', 39, 0.00, '2025-06-20 04:18:43'),
(2350, '14111514-NP-S04', 'NOTE PAD, stick on, 76mm x 100mm (3\" x 4\") min', 'PAD', 61, 0.00, '2025-06-20 04:18:43'),
(2351, '14111531-PP-R01', 'PAD PAPER, ruled', 'PAD', 23, 0.00, '2025-06-20 04:18:43'),
(2352, '44122104-PC-G01', 'PAPER CLIP, vinyl/plastic coated, 33mm', 'Box', 9, 0.00, '2025-06-20 04:18:43'),
(2353, '44122104-PC-J02', 'PAPER CLIP, vinyl/plastic coated, jumbo, 50mm', 'Box', 20, 648.00, '2025-06-20 04:18:43'),
(2354, '44101603-PS-M02', 'PAPER SHREDDER', 'Units', 0, 0.00, '2025-06-20 04:18:43'),
(2355, '44101601-PT-M02', 'PAPER TRIMMER/CUTTING MACHINE, table top', '', 0, 0.00, '2025-06-20 04:18:43'),
(2356, '14111507-PP-C02', 'PAPER, Multi-Purpose, 70gsm (min.), Legal', 'Ream', 158, 0.00, '2025-06-20 04:18:43'),
(2357, '14111507-PP-C01', 'PAPER, Multi-Purpose, A4', 'REAM', 137, 0.00, '2025-06-20 04:18:43'),
(2358, '14111507-PP-M01', 'PAPER, MULTICOPY, A4', 'REAM', 209, 0.00, '2025-06-20 04:18:43'),
(2359, '14111507-PP-M02', 'PAPER, MULTICOPY, Legal', 'REAM', 228, 0.00, '2025-06-20 04:18:43'),
(2360, '14111503-PA-P01', 'PAPER, parchment', 'Box', 158, 102.00, '2025-06-20 04:18:43'),
(2361, '44121619-PS-M01', 'PENCIL SHARPENER', 'piece', 243, 187.00, '2025-06-20 04:18:43'),
(2362, '44121706-PE-L01', 'PENCIL, Lead/Graphite, With Eraser', 'Box', 46, 3.00, '2025-06-20 04:18:43'),
(2363, '55121905-PH-F01', 'PHILIPPINE NATIONAL FLAG', 'Piece', 278, 0.00, '2025-06-20 04:18:43'),
(2364, '43212102-PR-D02', 'PRINTER, impact, dot matrix, 24 pins, 136 columns', 'Unit', 39, 0.00, '2025-06-20 04:18:43'),
(2365, '43212105-PR-L01', 'PRINTER, Laser, Monochrome', 'Unit', 0, 0.00, '2025-06-20 04:18:43'),
(2366, '44101602-PU-P01', 'PUNCHER, Paper, Heavy Duty', 'Piece', 158, 0.00, '2025-06-20 04:18:43'),
(2367, '47131501-RG-C01', 'RAGS', 'Bundle', 71, 0.00, '2025-06-20 04:18:43'),
(2368, '14111531-RE-B01', 'RECORD BOOK, 300 pages', 'BOOK', 94, 1.00, '2025-06-20 04:18:43'),
(2369, '14111531-RE-B02', 'RECORD BOOK, 500 pages', 'BOOK', 128, 594.00, '2025-06-20 04:18:43'),
(2370, '44103112-EP-R05', 'RIBBON CART, EPSON C13S015516 (#8750), Black', 'Cart', 78, 0.00, '2025-06-20 04:18:43'),
(2371, '44103112-EP-R13', 'RIBBON CART, EPSON C13S015632, Black', 'Cart', 73, 0.00, '2025-06-20 04:18:43'),
(2372, '44103112-EP-R07', 'RIBBON CARTRIDGE, EPSON C13S015531 (S015086)', 'Cart', 745, 0.00, '2025-06-20 04:18:43'),
(2373, '44122101-RU-B01', 'RUBBER BAND, No. 18', 'Box', 112, 0.00, '2025-06-20 04:18:43'),
(2374, '41111604-RU-P02', 'RULER, plastic, 450mm', 'Piece', 20, 221.00, '2025-06-20 04:18:43'),
(2375, '44121618-SS-S01', 'SCISSORS, Symmetrical / Asymmetrical', 'Pair', 67, 0.00, '2025-06-20 04:18:43'),
(2376, '47131602-SC-N01', 'SCOURING PAD', 'Pack', 88, 93.00, '2025-06-20 04:18:43'),
(2377, '60121524-SP-G01', 'SIGN PEN, Extra fine tip, black', 'Piece', 18, 0.00, '2025-06-20 04:18:43'),
(2378, '60121524-SP-G02', 'SIGN PEN, Extra fine tip, blue', 'Piece', 18, 0.00, '2025-06-20 04:18:43'),
(2379, '60121524-SP-G03', 'SIGN PEN, Extra fine tip, red', 'Piece', 35, 0.00, '2025-06-20 04:18:43'),
(2380, '44121905-SP-F01', 'STAMP PAD, felt', 'Piece', 28, 0.00, '2025-06-20 04:18:43'),
(2381, '12171703-SI-P01', 'STAMP PAD, Ink', 'Bottle', 29, 648.00, '2025-06-20 04:18:43'),
(2382, '44121613-SR-P02', 'STAPLE REMOVER, plier type', '', 47, 0.00, '2025-06-20 04:18:43'),
(2383, '31151804-SW-H01', 'STAPLE WIRE, heavy duty (binder type)', 'Box', 23, 0.00, '2025-06-20 04:18:43'),
(2384, '31151804-SW-S01', 'STAPLE WIRE, standard', 'Box', 29, 34.00, '2025-06-20 04:18:43'),
(2385, '44121615-ST-B01', 'STAPLER, Heavy Duty (Binder)', 'Unit', 713, 0.00, '2025-06-20 04:18:43'),
(2386, '44121615-ST-S01', 'STAPLER, standard type', 'Piece', 203, 0.00, '2025-06-20 04:18:43'),
(2387, '14111514-NB-S02', 'STENO NOTEBOOK', '', 11, 0.00, '2025-06-20 04:18:43'),
(2388, '44121605-TD-T01', 'TAPE DISPENSER, Table Top', 'Unit', 80, 0.00, '2025-06-20 04:18:43'),
(2389, '31201502-TA-E01', 'TAPE, electrical', 'Roll', 18, 0.00, '2025-06-20 04:18:43'),
(2390, '31201503-TA-M01', 'TAPE, masking, 24mm', 'Roll', 57, 216.00, '2025-06-20 04:18:43'),
(2391, '31201503-TA-M02', 'TAPE, MASKING, 48mm', 'Roll', 123, 0.00, '2025-06-20 04:18:43'),
(2392, '31201517-TA-P01', 'TAPE, packaging, 48mm', 'Roll', 24, 0.00, '2025-06-20 04:18:43'),
(2393, '31201512-TA-T01', 'TAPE, transparent, 24mm', 'Roll', 18, 2.00, '2025-06-20 04:18:43'),
(2394, '31201512-TA-T02', 'TAPE, transparent, 48mm', 'Roll', 30, 2.00, '2025-06-20 04:18:43'),
(2395, '14111704-TT-P04', 'TISSUE, Interfolded Paper Towel', 'Pack', 0, 0.00, '2025-06-20 04:18:43'),
(2396, '14111704-TT-P02', 'TOILET TISSUE PAPER, 2 ply', 'Pack', 101, 2.00, '2025-06-20 04:18:43'),
(2397, '44103103-BR-B04', 'TONER CART,  BROTHER TN-2130, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2398, '44103103-BR-B09', 'TONER CART,  BROTHER TN-3320, Black', 'Cart', 3, 0.00, '2025-06-20 04:18:43'),
(2399, '44103103-BR-B11', 'TONER CART,  BROTHER TN-3350, Black', 'Cart', 4, 0.00, '2025-06-20 04:18:43'),
(2400, '44103103-BR-B15', 'TONER CART, BROTHER TN-3478, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2401, '44103103-HP-B14', 'TONER CART, HP CB540A, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2402, '44103103-HP-B26', 'TONER CART, HP CE400A, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2403, '44103103-HP-C26', 'TONER CART, HP CE401A, Cyan', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2404, '44103103-HP-Y26', 'TONER CART, HP CE402A, Yellow', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2405, '44103103-HP-M26', 'TONER CART, HP CE403A, Magenta', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2406, '44103103-HP-B48', 'TONER CART, HP Q7553A, Black', 'Cart', 3, 0.00, '2025-06-20 04:18:43'),
(2407, '44103103-SA-B03', 'TONER CART, SAMSUNG ML-D2850B, Black', 'Cart', 4, 0.00, '2025-06-20 04:18:43'),
(2408, '44103103-SA-B07', 'TONER CART, SAMSUNG MLT-D103S, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2409, '44103103-SA-B08', 'TONER CART, SAMSUNG MLT-D104S, Black', 'Cart', 2, 0.00, '2025-06-20 04:18:43'),
(2410, '44103103-SA-B14', 'TONER CART, SAMSUNG MLT-D108S, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2411, '44103103-SA-B20', 'TONER CART, SAMSUNG MLT-D203U, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2412, '44103103-SA-B10', 'TONER CART, SAMSUNG SCX-D6555A, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2413, '44103103-BR-B16', 'Toner Cartridge, Brother TN-456 Black, High Yield', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2414, '44103103-BR-C03', 'Toner Cartridge, Brother TN-456 Cyan, High Yield', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2415, '44103103-BR-M03', 'Toner Cartridge, Brother TN-456 Magenta, High', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2416, '44103103-BR-Y03', 'Toner Cartridge, Brother TN-456 Yellow, High Yield', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2417, '44103103-CA-B00', 'Toner Cartridge, Canon CRG-324 II', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2418, '44103103-HP-B12', 'TONER CARTRIDGE, HP CB435A, Black', 'Cart', 3, 0.00, '2025-06-20 04:18:43'),
(2419, '44103103-HP-B18', 'TONER CARTRIDGE, HP CE255A, Black', 'Cart', 7, 0.00, '2025-06-20 04:18:43'),
(2420, '44103103-HP-B21', 'TONER CARTRIDGE, HP CE278A, Black', 'Cart', 3, 0.00, '2025-06-20 04:18:43'),
(2421, '44103103-HP-B22', 'TONER CARTRIDGE, HP CE285A (HP85A), Black', 'Cart', 3, 0.00, '2025-06-20 04:18:43'),
(2422, '44103103-HP-B23', 'TONER CARTRIDGE, HP CE310A, Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2423, '44103103-HP-C23', 'TONER CARTRIDGE, HP CE311A, Cyan', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2424, '44103103-HP-Y23', 'TONER CARTRIDGE, HP CE312A, Yellow', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2425, '44103103-HP-M23', 'TONER CARTRIDGE, HP CE313A, Magenta', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2426, '44103103-HP-B28', 'TONER CARTRIDGE, HP CE505A, Black', 'Cart', 4, 6.00, '2025-06-20 04:18:43'),
(2427, '44103103-HP-B52', 'TONER CARTRIDGE, HP CF217A (HP17A), Black,', 'Cart', 2, 377.00, '2025-06-20 04:18:43'),
(2428, '44103103-HP-B53', 'TONER CARTRIDGE, HP CF226A (HP26A), Black,', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2429, '44103103-HP-B56', 'TONER CARTRIDGE, HP CF281A (HP81A), Black,', 'Cart', 8, 0.00, '2025-06-20 04:18:43'),
(2430, '44103103-HP-B57', 'TONER CARTRIDGE, HP CF283A (HP83A), LaserJet,', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2431, '44103103-HX-B51', 'Toner Cartridge, HP CF283XC (HP83X) Blk Contract L', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2432, '44103103-HP-B58', 'TONER CARTRIDGE, HP CF287A (HP87), Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2433, '44103103-HX-B52', 'Toner Cartridge, HP CF325XC (HP25X) Black LaserJet', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2434, '44103103-HP-B60', 'TONER CARTRIDGE, HP CF350A, Black LJ', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2435, '44103103-HP-C60', 'TONER CARTRIDGE, HP CF351A, Cyan LJ', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2436, '44103103-HP-Y60', 'TONER CARTRIDGE, HP CF352A, Yellow LJ', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2437, '44103103-HP-M60', 'TONER CARTRIDGE, HP CF353A, Magenta LJ', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2438, '44103103-HP-B61', 'TONER CARTRIDGE, HP CF360A (HP508A), Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2439, '44103103-HP-C61', 'TONER CARTRIDGE, HP CF361A (HP508A), Cyan', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2440, '44103103-HP-Y61', 'TONER CARTRIDGE, HP CF362A (HP508A), Yellow', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2441, '44103103-HP-M61', 'TONER CARTRIDGE, HP CF363A (HP508A), Magenta', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2442, '44103103-HP-B62', 'TONER CARTRIDGE, HP CF400A (HP201A), Black', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2443, '44103103-HP-C62', 'TONER CARTRIDGE, HP CF401A (HP201A), Cyan', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2444, '44103103-HP-Y62', 'TONER CARTRIDGE, HP CF402A (HP201A), Yellow', 'Cart', 0, 0.00, '2025-06-20 04:18:43'),
(2445, '44103103-HP-M62', 'TONER CARTRIDGE, HP CF403A (HP201A), Magenta', 'Cart', 0, 0.00, '2025-06-20 04:18:44'),
(2446, '44103103-HP-B63', 'TONER CARTRIDGE, HP CF410A (HP410A), black', 'Cart', 0, 0.00, '2025-06-20 04:18:44'),
(2447, '44103103-HP-C63', 'TONER CARTRIDGE, HP CF411A (HP410A), Cyan', 'Cart', 0, 0.00, '2025-06-20 04:18:44'),
(2448, '44103103-HP-Y63', 'TONER CARTRIDGE, HP CF412A (HP410A), Yellow', 'Cart', 0, 0.00, '2025-06-20 04:18:44'),
(2449, '44103103-HP-M63', 'TONER CARTRIDGE, HP CF413A (HP410A), Magenta', 'Cart', 0, 0.00, '2025-06-20 04:18:44'),
(2450, '44103103-HP-B34', 'TONER CARTRIDGE, HP Q2612A, Black', 'Cart', 4, 0.00, '2025-06-20 04:18:44'),
(2451, '47121701-TB-P04', 'TRASHBAG, XXL size', 'Pack', 133, 593.00, '2025-06-20 04:18:44'),
(2452, '31151507-TW-P01', 'TWINE, plastic', 'Roll', 72, 123.00, '2025-06-20 04:18:44'),
(2453, '47121702-WB-P01', 'WASTEBASKET', 'Piece', 45, 128.00, '2025-06-20 04:18:44'),
(2454, '60121124-WR-P01', 'WRAPPING PAPER, kraft', 'Pack', 0, 0.00, '2025-06-20 04:18:44'),
(2456, 'DS-Tape', 'Double sided tape', 'roll', 19, 35.00, '2025-09-18 02:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `request_date`) VALUES
(18, 2, '2025-06-23 01:29:49'),
(19, 2, '2025-06-23 07:14:33'),
(20, 2, '2025-06-23 07:21:29'),
(21, 2, '2025-06-23 07:28:12'),
(22, 2, '2025-06-23 14:13:42'),
(23, 2, '2025-06-30 01:15:20'),
(24, 2, '2025-07-07 02:15:05'),
(25, 2, '2025-07-07 02:16:34'),
(26, 2, '2025-09-14 10:45:27'),
(27, 3, '2025-09-18 02:16:28'),
(28, 2, '2025-10-03 11:46:52'),
(29, 4, '2025-10-06 01:25:43'),
(30, 3, '2025-10-07 04:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_forms`
--

CREATE TABLE `user_forms` (
  `user_id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_forms`
--

INSERT INTO `user_forms` (`user_id`, `name`, `email`, `password`, `user_type`, `created_at`) VALUES
(1, 'Administrator', 'admin@mail.com', '$2y$10$RYvV6/Lo7JpIblUlvGpZhulVyIXDzNw4ZcP01SFuhcmDsWIXRPqo2', 'admin', '2025-03-09 02:40:29'),
(2, 'Mark Angelo B. Bulauan', 'bulauan.angelo03@gmail.com', '$2y$10$6YwzvzBh9H3t.GrVHhXeYOmDkiIKfbSDTYM5D8jHVDuJLskM0jZXW', 'user', '2025-03-09 02:40:57'),
(3, 'Jhunrey Ordioso ', 'csuabacsecretariat@gmail.com', '$2y$10$ipmqjElzhZnC3mOQlkYt4uV8e7RrKfZWShb/3/nvS5frkTDZudJkG', 'user', '2025-09-18 00:10:57'),
(4, 'Jhunrey C. Ordioso', 'yernuhj2126@gmail.com', '$2y$10$ux2TunUf8XlZtfkaBgl92uXKL7y.mOlChxBQT8nTx.AI4jvnwbQRW', 'user', '2025-10-06 01:23:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folder_id` (`folder_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iar`
--
ALTER TABLE `iar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_requests`
--
ALTER TABLE `order_requests`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_order_product` (`product_id`);

--
-- Indexes for table `par`
--
ALTER TABLE `par`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `par_transfers`
--
ALTER TABLE `par_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_forms`
--
ALTER TABLE `user_forms`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `iar`
--
ALTER TABLE `iar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_requests`
--
ALTER TABLE `order_requests`
  MODIFY `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `par`
--
ALTER TABLE `par`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `par_transfers`
--
ALTER TABLE `par_transfers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2457;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_forms`
--
ALTER TABLE `user_forms`
  MODIFY `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_requests`
--
ALTER TABLE `order_requests`
  ADD CONSTRAINT `fk_order_product` FOREIGN KEY (`product_id`) REFERENCES `product_inventory` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_requests_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_requests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_forms` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_forms` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
