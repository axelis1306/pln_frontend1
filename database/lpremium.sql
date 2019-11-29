-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2019 at 03:28 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpremium`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_engineering`
--

CREATE TABLE `company_engineering` (
  `id_company_engineering` int(11) NOT NULL,
  `name_company_engineering` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_engineering`
--

INSERT INTO `company_engineering` (`id_company_engineering`, `name_company_engineering`, `position`, `phone`, `email`) VALUES
(1, 'asdkfjh', 'asdkjfhasdkjfh', '081231235', 'asdfk@gma.co');

-- --------------------------------------------------------

--
-- Table structure for table `company_finance`
--

CREATE TABLE `company_finance` (
  `id_company_finance` int(11) NOT NULL,
  `name_company_finance` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_finance`
--

INSERT INTO `company_finance` (`id_company_finance`, `name_company_finance`, `position`, `phone`, `email`) VALUES
(1, 'asdfkjashdfkjshadf', 'asdkjfhaskjdhfasdkjfh', '085772341', 'sadf@gma.co');

-- --------------------------------------------------------

--
-- Table structure for table `company_general`
--

CREATE TABLE `company_general` (
  `id_company_general` int(11) NOT NULL,
  `name_company_general` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_general`
--

INSERT INTO `company_general` (`id_company_general`, `name_company_general`, `position`, `phone`, `email`) VALUES
(1, 'lsakdjhfkjashdf', 'akjsdfakjsdhfkajshdfkajshf', '0881287125', 'asdf@mgasd.co');

-- --------------------------------------------------------

--
-- Table structure for table `company_leader`
--

CREATE TABLE `company_leader` (
  `id_company_leader` int(11) NOT NULL,
  `name_company_leader` varchar(255) NOT NULL,
  `position` varchar(200) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_leader`
--

INSERT INTO `company_leader` (`id_company_leader`, `name_company_leader`, `position`, `phone`, `email`) VALUES
(1, 'akjsdhfaksjdhf', 'askjdhfaskjdfh', '088712381', 'asdf@ga.co');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `id_company_profile` int(11) NOT NULL,
  `name_company` varchar(255) NOT NULL,
  `address_company` varchar(255) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `facsimile` varchar(14) NOT NULL,
  `email_company` varchar(200) NOT NULL,
  `date_of_establishment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id_company_profile`, `name_company`, `address_company`, `phone`, `facsimile`, `email_company`, `date_of_establishment`) VALUES
(1, 'ASUS', 'LASDFJASDKHFAJSDH', '08129481', '12385123', 'sdf@mg.co', '1991-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(12) NOT NULL,
  `id_company_profile` int(11) DEFAULT NULL,
  `id_company_leader` int(11) DEFAULT NULL,
  `id_company_finance` int(11) DEFAULT NULL,
  `id_company_engineering` int(11) DEFAULT NULL,
  `id_company_general` int(11) DEFAULT NULL,
  `name_customer` varchar(255) NOT NULL,
  `address_customer` varchar(255) NOT NULL,
  `id_tariff` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `subsistem` varchar(255) NOT NULL,
  `bep_value` int(255) NOT NULL,
  `id_substation` int(11) NOT NULL,
  `id_feeder_substation` int(11) NOT NULL,
  `id_type_of_service` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_information` int(11) DEFAULT NULL,
  `captive_power` varchar(2) DEFAULT NULL,
  `amount_of_power` int(255) DEFAULT NULL,
  `next_meeting` date DEFAULT NULL,
  `suggestion` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `id_company_profile`, `id_company_leader`, `id_company_finance`, `id_company_engineering`, `id_company_general`, `name_customer`, `address_customer`, `id_tariff`, `power`, `subsistem`, `bep_value`, `id_substation`, `id_feeder_substation`, `id_type_of_service`, `id_status`, `id_information`, `captive_power`, `amount_of_power`, `next_meeting`, `suggestion`) VALUES
(149, 1, 1, 1, 1, 1, 'test6', '123123123asdfjklashdfkjasdkjfh', 11, 7700, '124', 1, 3, 1, 1, 6, 10, '2', 10000, '2019-08-31', 'ajskldhfkajsdhfkajsdhfaksjdhf'),
(150, NULL, NULL, NULL, NULL, NULL, 'test5', '123123123123', 10, 7700, '123', 1, 2, 1, 2, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feeder_substation`
--

CREATE TABLE `feeder_substation` (
  `id_feeder_substation` int(11) NOT NULL,
  `name_feeder_substation` varchar(255) NOT NULL,
  `address_feeder_substation` varchar(255) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feeder_substation`
--

INSERT INTO `feeder_substation` (`id_feeder_substation`, `name_feeder_substation`, `address_feeder_substation`, `latitude`, `longitude`) VALUES
(1, 'Gardu Induk Pulomas', 'Jl. Rawamangun Muka Selatan No.1, RT.1/RW.13, Rawamangun, Kec. Pulo Gadung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13220', '-6.198475', '106.884858');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id_information` int(11) NOT NULL,
  `information` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id_information`, `information`) VALUES
(1, 'Not Yet'),
(2, 'Probing'),
(3, 'Menunggu Reksis'),
(4, 'Proses Reksis'),
(5, 'Proses SPJBTL'),
(6, 'WO to Construction'),
(7, 'Working Order Terbit'),
(8, 'On Construction'),
(9, 'Proses Energizing'),
(10, 'Finished'),
(11, 'Cancelled'),
(12, 'Waiting For Confirmation'),
(13, 'Terminated By Problem');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id_notification` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_type_notification` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id_notification`, `id_customer`, `id_user`, `id_type_notification`, `title`, `details`, `created_at`) VALUES
(1, 149, 3, 12, 'Info', 'test6 telah dikunjungi oleh Account Executive DISJAYA dan telah melakukan peremajaan data', '2019-08-23 12:08:16'),
(2, 149, 3, 12, 'Info', 'test6 telah memasuki tahap Closing. Surat Permohonan Pelanggan sudah di upload oleh Account Executive DISJAYA', '2019-08-23 12:13:48'),
(3, 149, 3, 13, 'Report', 'test6 telah memasuki tahap Closing. Surat Permohonan Pelanggan sudah di upload oleh Account Executive DISJAYA. Terbitkan Rekomendasi Sistem dan SLD segera!', '2019-08-23 12:13:49'),
(4, 149, 2, 12, 'Info', 'Rekomendasi Sistem dan SLD untuk test6 telah terbit, di upload oleh Planning DISJAYA.', '2019-08-23 12:14:52'),
(5, 149, 2, 2, 'Info', 'Rekomendasi Sistem dan SLD untuk test6 telah terbit, di upload oleh Planning DISJAYA bagian Planning.', '2019-08-23 12:14:52'),
(6, 149, 2, 14, 'Report', 'Rekomendasi Sistem dan SLD untuk test6 telah terbit, di upload oleh Planning DISJAYA bagian Planning.', '2019-08-23 12:14:52'),
(7, 149, 3, 12, 'Info', 'SPJBTL dan Surat Kontrak Pelanggan test6 telah di upload oleh Account Executive DISJAYA.', '2019-08-23 12:18:24'),
(8, 149, 3, 12, 'Info', 'Working Order pelaksanaan konstruksi Pelanggan test6 untuk bagian Konstruksi telah Terbit, di upload oleh Account Executive DISJAYA.', '2019-08-23 12:18:32'),
(9, 149, 3, 15, 'Need Action', 'Working Order pelaksanaan konstruksi Pelanggan test6 telah terbit, di upload oleh Account Executive DISJAYA bagian Planning. Lakukan Pelaksanaan Konstruksi Segera! Semangat!', '2019-08-23 12:18:32'),
(10, 149, 4, 8, 'On Construction', 'Pelanggan test6 telah memasuki proses Konstruksi.', '2019-08-23 12:28:53'),
(11, 149, 4, 9, 'Info', 'Pelanggan test6 telah memasuki proses Konstruksi.', '2019-08-23 12:28:53'),
(16, 149, 4, 4, 'Proses Energize', 'Pelanggan test6 telah memasuki proses Energizing. Bersiaplah!', '2019-08-23 12:29:13'),
(17, 149, 4, 10, 'Proses Energize', 'Pelanggan test6 telah memasuki proses Konstruksi. Bersiaplah!', '2019-08-23 12:29:13'),
(20, 149, 4, 16, 'test6 Energized!', 'test6 telah berhasil di Energized! Pelanggan kini resmi menjadi Pelanggan Premium, Selamat!!', '2019-08-23 12:29:41'),
(21, 149, 4, 6, 'test6 Energized!', 'test6 telah berhasil di Energized! Pelanggan kini resmi menjadi Pelanggan Premium, Selamat!!', '2019-08-23 12:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `notification_target`
--

CREATE TABLE `notification_target` (
  `id_notification_target` int(11) NOT NULL,
  `id_notification` int(11) NOT NULL,
  `id_target` int(11) NOT NULL,
  `status_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_target`
--

INSERT INTO `notification_target` (`id_notification_target`, `id_notification`, `id_target`, `status_read`) VALUES
(1, 1, 5, 0),
(2, 1, 6, 0),
(3, 2, 5, 0),
(4, 2, 6, 0),
(5, 3, 2, 1),
(6, 4, 5, 0),
(7, 4, 6, 0),
(8, 5, 3, 0),
(9, 6, 4, 0),
(10, 7, 5, 1),
(11, 7, 6, 0),
(12, 8, 5, 0),
(13, 8, 6, 0),
(14, 9, 4, 0),
(15, 10, 5, 0),
(16, 10, 6, 0),
(17, 11, 3, 0),
(18, 16, 5, 0),
(19, 16, 6, 0),
(20, 17, 3, 0),
(21, 20, 5, 0),
(22, 20, 6, 0),
(23, 21, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `potencial_customer`
--

CREATE TABLE `potencial_customer` (
  `id_potencial_customer` int(11) NOT NULL,
  `name_customer` varchar(255) NOT NULL,
  `id_customer` varchar(9) NOT NULL,
  `id_tariff` int(11) NOT NULL,
  `power` int(255) NOT NULL,
  `address_customer` text NOT NULL,
  `id_substation` int(11) NOT NULL,
  `id_feeder_substation` int(11) NOT NULL,
  `subsistem` varchar(255) NOT NULL,
  `bep_value` varchar(12) NOT NULL,
  `id_type_of_service` int(11) NOT NULL,
  `id_status` int(11) DEFAULT NULL,
  `id_information` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `potencial_customer`
--

INSERT INTO `potencial_customer` (`id_potencial_customer`, `name_customer`, `id_customer`, `id_tariff`, `power`, `address_customer`, `id_substation`, `id_feeder_substation`, `subsistem`, `bep_value`, `id_type_of_service`, `id_status`, `id_information`) VALUES
(3, 'test5', '150', 10, 7700, '123123123123', 2, 1, '123', '1', 2, 1, 1),
(4, 'test6', '149', 11, 7700, '123123123', 3, 1, '124', '1.1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id_type_of_service` int(11) NOT NULL,
  `type_of_service` varchar(100) NOT NULL,
  `badge` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id_type_of_service`, `type_of_service`, `badge`) VALUES
(1, 'Platinum', 'badge-platinum'),
(2, 'Gold', 'badge-gold'),
(3, 'Silver', 'badge-silver'),
(4, 'Bronze', 'badge-bronze');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `badge_status` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`, `badge_status`, `keterangan`) VALUES
(1, 'Not Yet', 'badge-secondary', NULL),
(2, 'Problem Mapping', 'badge-primary', NULL),
(3, 'Closing', 'badge-warning', NULL),
(4, 'Construction', 'badge-energizing', NULL),
(5, 'Energizing', 'badge-energizing', NULL),
(6, 'Completed', 'badge-success', NULL),
(7, 'Terminated', 'badge-danger', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `substation`
--

CREATE TABLE `substation` (
  `id_substation` int(11) NOT NULL,
  `name_substation` varchar(255) NOT NULL,
  `address_substation` varchar(255) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `substation`
--

INSERT INTO `substation` (`id_substation`, `name_substation`, `address_substation`, `latitude`, `longitude`) VALUES
(1, 'Gardu Induk Gambir Lama', 'Jl. Batu Blok B No.26, RT.7/RW.1, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110', '-6.179675', '106.835307'),
(2, 'Gardu Induk Dukuh Atas', 'Jl. Edi I, Guntur, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12980', '-6.206080', '106.834517'),
(3, 'Gardu Induk Karet', 'Jl. Tenaga Listrik 1, RT.16/RW.16, Kb. Melati, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10230', '-6.197640', '106.811239'),
(4, 'GIS Kebon Sirih', 'Jl. Kb. Sirih Tim. Gg. 10 No.110, RT.14/RW.6, Kb. Sirih, Kec. Menteng, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10340', '-6.185136', '106.831710');

-- --------------------------------------------------------

--
-- Table structure for table `tariff`
--

CREATE TABLE `tariff` (
  `id_tariff` int(11) NOT NULL,
  `tariff` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tariff`
--

INSERT INTO `tariff` (`id_tariff`, `tariff`) VALUES
(1, 'S-1'),
(2, 'S-2'),
(3, 'S-3'),
(4, 'R-1'),
(5, 'R-2'),
(6, 'R-3'),
(7, 'B-1'),
(8, 'B-2'),
(9, 'B-3'),
(10, 'I-1'),
(11, 'I-2'),
(12, 'I-3'),
(13, 'I-4'),
(14, 'P-1'),
(15, 'P-2'),
(16, 'P-3'),
(17, 'T'),
(18, 'C'),
(19, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `type_notification`
--

CREATE TABLE `type_notification` (
  `id_type_notification` int(11) NOT NULL,
  `icon_notification` varchar(255) NOT NULL,
  `type_notification` varchar(255) NOT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `bg_color` varchar(255) NOT NULL,
  `id_role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_notification`
--

INSERT INTO `type_notification` (`id_type_notification`, `icon_notification`, `type_notification`, `menu`, `bg_color`, `id_role`) VALUES
(2, 'fas fa-file-alt', 'Single', 'bg-primary', 'bg-primary', NULL),
(3, 'fas fa-exclamation-triangle', 'Single', 'bg-warning', 'bg-warning', NULL),
(4, 'fas fa-bolt', 'Broadcast', NULL, 'bg-success', 6),
(5, 'fas fa-times', 'Broadcast', NULL, 'bg-danger', 6),
(6, 'fas fa-check', 'Single', NULL, 'bg-success', NULL),
(7, 'fas fa-exclamation', 'Single', NULL, 'bg-warning', NULL),
(8, 'fas fa-business-time', 'Broadcast', NULL, 'bg-info', 6),
(9, 'fas fa-business-time', 'Single', NULL, 'bg-info', NULL),
(10, 'fas fa-bolt', 'Single', NULL, 'bg-success', NULL),
(11, 'fas fa-times', 'Single', NULL, 'bg-danger', NULL),
(12, 'fas fa-info', 'Broadcast', NULL, 'bg-info', 6),
(13, 'fas fa-exclamation-triangle', 'Broadcast', NULL, 'bg-warning', 4),
(14, 'fas fa-file-alt', 'Broadcast', NULL, 'bg-primary', 5),
(15, 'fas fa-exclamation-triangle', 'Broadcast', NULL, 'bg-warning', 5),
(16, 'fas fa-check', 'Broadcast', NULL, 'bg-success', 6),
(17, 'fas fa-business-time', 'Broadcast', NULL, 'bg-danger', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `id_role` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `image`, `id_role`, `is_active`, `created_at`) VALUES
(1, 'Administrator DISJAYA', 'admin@premium.id', '$2y$10$yZo9FsgnJS298avCefqQf.9yhcqhx7JVp.JFt839MNqEqJqQOzk8O', 'default.jpg', 1, 1, '2019-08-23 04:18:53'),
(2, 'Planning DISJAYA', 'planning@premium.id', '$2y$10$bfKnuHHY3Mv4/xjRkkCp4.ExdKX3o0LltGbs7AckZSwLpksBk6h62', 'default.jpg', 4, 1, '2019-08-23 04:19:48'),
(3, 'Account Executive DISJAYA', 'account.executive@premium.id', '$2y$10$nSP/Kq0n/3PAx2Nt4upPUeZ6rx6uqYzQwarn0utAdEwKirNr4Je5e', 'default.jpg', 3, 1, '2019-08-23 04:21:21'),
(4, 'Construction DISJAYA', 'construction@premium.id', '$2y$10$KjVW9oRGXfen.3zpD9tSSuOy.gR2U7IY54xWbF1daFtrDX.Lf8ybK', 'default.jpg', 5, 1, '2019-08-23 04:22:43'),
(5, 'Manager DISJAYA', 'manager@premium.id', '$2y$10$Clt7b4nFsr8RISH/f06qD.4fg995Y2RepQR2OSnilvoV7c3YVjlEC', 'default.jpg', 6, 1, '2019-08-23 04:23:44'),
(6, 'Manager DISJAYA 2', 'manager2@premium.id', '$2y$10$XeffboxNqhDzpYClmr/dOOWyqA/aPLIkSsZw.mi4rJ5JHlyB0k5HO', 'default.jpg', 6, 1, '2019-08-23 11:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_user_access_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_user_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_user_access_menu`, `id_role`, `id_user_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 3, 5),
(7, 1, 6),
(8, 1, 7),
(11, 4, 6),
(12, 1, 8),
(13, 3, 2),
(14, 4, 2),
(15, 5, 7),
(16, 5, 2),
(17, 6, 2),
(18, 6, 8),
(20, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_cancellation`
--

CREATE TABLE `user_cancellation` (
  `id_user_cancellation` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `cancellation_reason` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_closing`
--

CREATE TABLE `user_closing` (
  `id_user_closing` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_user_app_letter` int(11) DEFAULT NULL,
  `app_letter` timestamp NULL DEFAULT NULL,
  `id_user_reksis_sld` int(11) DEFAULT NULL,
  `reksis_sld` timestamp NULL DEFAULT NULL,
  `id_user_spjbtl` int(11) DEFAULT NULL,
  `spjbtl` timestamp NULL DEFAULT NULL,
  `id_user_contract_letter` int(11) DEFAULT NULL,
  `contract_letter` timestamp NULL DEFAULT NULL,
  `id_user_wo_cons` int(11) DEFAULT NULL,
  `working_order_cons` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_closing`
--

INSERT INTO `user_closing` (`id_user_closing`, `id_user`, `id_customer`, `id_user_app_letter`, `app_letter`, `id_user_reksis_sld`, `reksis_sld`, `id_user_spjbtl`, `spjbtl`, `id_user_contract_letter`, `contract_letter`, `id_user_wo_cons`, `working_order_cons`) VALUES
(1, 3, 149, 3, '2019-08-23 12:13:48', NULL, '2019-08-23 12:14:52', 3, '2019-08-23 12:18:23', 3, '2019-08-23 12:18:23', 3, '2019-08-23 12:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_energize`
--

CREATE TABLE `user_energize` (
  `id_user_energize` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `ba_aco` timestamp NULL DEFAULT NULL,
  `ba_penyambungan` timestamp NULL DEFAULT NULL,
  `surat_pk` timestamp NULL DEFAULT NULL,
  `dokumentasi` timestamp NULL DEFAULT NULL,
  `catatan_khusus` text,
  `last_submit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_energize`
--

INSERT INTO `user_energize` (`id_user_energize`, `id_user`, `id_customer`, `ba_aco`, `ba_penyambungan`, `surat_pk`, `dokumentasi`, `catatan_khusus`, `last_submit`) VALUES
(1, 4, 149, '2019-08-23 12:29:41', '2019-08-23 12:29:41', '2019-08-23 12:29:41', '2019-08-23 12:29:41', 'BLABLABLABLABLABLABLA', '2019-08-23 12:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_user_menu` int(11) NOT NULL,
  `menu` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_user_menu`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Test'),
(5, 'Account Executive'),
(6, 'Planning'),
(7, 'Construction'),
(8, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `user_report`
--

CREATE TABLE `user_report` (
  `id_user_report` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_customer` int(12) NOT NULL,
  `report_reason` text,
  `report_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_report`
--

INSERT INTO `user_report` (`id_user_report`, `id_user`, `id_customer`, `report_reason`, `report_time`) VALUES
(1, 3, 149, 'ALSJDKFKASJDHFAKJSDF', '2019-08-23 12:08:30'),
(2, 3, 149, 'kjasdfkjashdfkjashdfkjashdf', '2019-08-23 12:08:45'),
(3, 3, 149, 'BLABLABLABLABLA', '2019-08-23 12:18:23'),
(4, 4, 149, 'HASDHFASHDFHASDHFASHDFAHSDF', '2019-08-23 12:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `role_type`) VALUES
(3, 'Account Executive'),
(1, 'Administrator'),
(5, 'Construction'),
(6, 'Manager'),
(2, 'Member'),
(4, 'Planning');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_user_sub_menu` int(11) NOT NULL,
  `id_user_menu` int(11) NOT NULL,
  `title` varchar(127) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active_menu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_user_sub_menu`, `id_user_menu`, `title`, `url`, `icon`, `is_active_menu`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user-tie', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Manajemen', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Manajemen', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(6, 5, 'Data Potential', 'accountexecutive', 'fas fa-fw fa-chart-area', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tag', 1),
(8, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(9, 2, 'Report', 'user/report', 'fas fa-fw fa-file-alt', 0),
(10, 2, 'Monitorings', 'user/monitoring', 'fas fa-fw fa-desktop', 0),
(11, 5, 'Closing', 'accountexecutive/closing', 'far fa-fw fa-handshake', 0),
(12, 5, 'Problem Mapping', 'accountexecutive/problemmappingby', 'fas fa-fw fa-map', 0),
(13, 6, 'Master Data Pelanggan', 'planning', 'fas fa-fw fa-chart-area', 1),
(14, 6, 'Input Potential', 'planning/addpotencial', 'fas fa-fw fa-edit', 1),
(15, 5, 'Customer List', 'accountexecutive/index', 'fas fa-fw fa-chart-area', 0),
(17, 5, 'TESTASUu', 'accountexecutive', 'fas fa-fw fa-key', 0),
(19, 7, 'ASU', 'construction', 'fas fa-fw fa-desktop', 0),
(20, 1, 'Notification', 'admin/notification', 'fas fa-fw fa-bell', 0),
(21, 6, 'Upload Reksis dan SLD', 'planning/addReksisBy', 'fas fa-fw fa-file-upload', 0),
(22, 7, 'Master Data Pelanggan', 'construction', 'fas fa-fw fa-chart-area', 1),
(23, 8, 'Monitoring', 'manager/index', 'fas fa-fw fa-desktop', 1),
(24, 8, 'Notification', 'manager/notification', 'fas fa-fw fa-bell', 0),
(25, 6, 'Data For Reksis', 'planning/dataForReksis', 'fas fa-fw fa-bookmark', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_engineering`
--
ALTER TABLE `company_engineering`
  ADD PRIMARY KEY (`id_company_engineering`),
  ADD UNIQUE KEY `email_company_engineering` (`email`),
  ADD KEY `position_of_company_engineering` (`position`),
  ADD KEY `phone_of_company_engineering` (`phone`);

--
-- Indexes for table `company_finance`
--
ALTER TABLE `company_finance`
  ADD PRIMARY KEY (`id_company_finance`),
  ADD UNIQUE KEY `email_company_finance` (`email`),
  ADD KEY `phone_company_finance` (`phone`);

--
-- Indexes for table `company_general`
--
ALTER TABLE `company_general`
  ADD PRIMARY KEY (`id_company_general`),
  ADD UNIQUE KEY `email_company_general` (`email`),
  ADD KEY `position_company_general` (`position`),
  ADD KEY `phone_company_general` (`phone`);

--
-- Indexes for table `company_leader`
--
ALTER TABLE `company_leader`
  ADD PRIMARY KEY (`id_company_leader`),
  ADD UNIQUE KEY `email_leader` (`email`),
  ADD KEY `phone_company_leader` (`phone`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`id_company_profile`),
  ADD UNIQUE KEY `email_company` (`email_company`),
  ADD KEY `phone_company` (`phone`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `id_type_of_service` (`id_type_of_service`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `company_profile` (`id_company_profile`),
  ADD KEY `company_leader` (`id_company_leader`),
  ADD KEY `company_finance` (`id_company_finance`),
  ADD KEY `company_engineering` (`id_company_engineering`),
  ADD KEY `company_general` (`id_company_general`),
  ADD KEY `id_substation` (`id_substation`),
  ADD KEY `id_feeder_substation` (`id_feeder_substation`),
  ADD KEY `id_tariff` (`id_tariff`),
  ADD KEY `id_information` (`id_information`);

--
-- Indexes for table `feeder_substation`
--
ALTER TABLE `feeder_substation`
  ADD PRIMARY KEY (`id_feeder_substation`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id_information`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_type_notification` (`id_type_notification`);

--
-- Indexes for table `notification_target`
--
ALTER TABLE `notification_target`
  ADD PRIMARY KEY (`id_notification_target`),
  ADD KEY `id_notification` (`id_notification`),
  ADD KEY `id_target` (`id_target`);

--
-- Indexes for table `potencial_customer`
--
ALTER TABLE `potencial_customer`
  ADD PRIMARY KEY (`id_potencial_customer`),
  ADD UNIQUE KEY `id_customer` (`id_customer`),
  ADD UNIQUE KEY `id_tariff` (`id_potencial_customer`),
  ADD KEY `id_substation` (`id_substation`),
  ADD KEY `id_feeder_substation` (`id_feeder_substation`),
  ADD KEY `id_type_of_service` (`id_type_of_service`),
  ADD KEY `fk_potencial_customer_to_tariff` (`id_tariff`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_information` (`id_information`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_type_of_service`),
  ADD UNIQUE KEY `type_of_service` (`type_of_service`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `substation`
--
ALTER TABLE `substation`
  ADD PRIMARY KEY (`id_substation`);

--
-- Indexes for table `tariff`
--
ALTER TABLE `tariff`
  ADD PRIMARY KEY (`id_tariff`);

--
-- Indexes for table `type_notification`
--
ALTER TABLE `type_notification`
  ADD PRIMARY KEY (`id_type_notification`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `fk_user_to_user_role` (`id_role`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_user_access_menu`),
  ADD KEY `id_role` (`id_role`) USING BTREE,
  ADD KEY `id_user_menu` (`id_user_menu`) USING BTREE;

--
-- Indexes for table `user_cancellation`
--
ALTER TABLE `user_cancellation`
  ADD PRIMARY KEY (`id_user_cancellation`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `user_closing`
--
ALTER TABLE `user_closing`
  ADD PRIMARY KEY (`id_user_closing`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_app_letter` (`id_user_app_letter`),
  ADD KEY `id_user_reksis_sld` (`id_user_reksis_sld`),
  ADD KEY `id_user_spjbtl` (`id_user_spjbtl`),
  ADD KEY `id_user_contract_letter` (`id_user_contract_letter`),
  ADD KEY `id_user_wo_cons` (`id_user_wo_cons`);

--
-- Indexes for table `user_energize`
--
ALTER TABLE `user_energize`
  ADD PRIMARY KEY (`id_user_energize`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_user_menu`);

--
-- Indexes for table `user_report`
--
ALTER TABLE `user_report`
  ADD PRIMARY KEY (`id_user_report`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `role_type` (`role_type`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_user_sub_menu`),
  ADD KEY `fk_user_sub_menu_to_user_menu` (`id_user_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_engineering`
--
ALTER TABLE `company_engineering`
  MODIFY `id_company_engineering` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_finance`
--
ALTER TABLE `company_finance`
  MODIFY `id_company_finance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_general`
--
ALTER TABLE `company_general`
  MODIFY `id_company_general` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_leader`
--
ALTER TABLE `company_leader`
  MODIFY `id_company_leader` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `id_company_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id_information` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notification_target`
--
ALTER TABLE `notification_target`
  MODIFY `id_notification_target` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `potencial_customer`
--
ALTER TABLE `potencial_customer`
  MODIFY `id_potencial_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id_type_of_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `substation`
--
ALTER TABLE `substation`
  MODIFY `id_substation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tariff`
--
ALTER TABLE `tariff`
  MODIFY `id_tariff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `type_notification`
--
ALTER TABLE `type_notification`
  MODIFY `id_type_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_user_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_cancellation`
--
ALTER TABLE `user_cancellation`
  MODIFY `id_user_cancellation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_closing`
--
ALTER TABLE `user_closing`
  MODIFY `id_user_closing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_energize`
--
ALTER TABLE `user_energize`
  MODIFY `id_user_energize` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_user_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_report`
--
ALTER TABLE `user_report`
  MODIFY `id_user_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_user_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_to_company_engineering` FOREIGN KEY (`id_company_engineering`) REFERENCES `company_engineering` (`id_company_engineering`),
  ADD CONSTRAINT `fk_customer_to_company_finance` FOREIGN KEY (`id_company_finance`) REFERENCES `company_finance` (`id_company_finance`),
  ADD CONSTRAINT `fk_customer_to_company_general` FOREIGN KEY (`id_company_general`) REFERENCES `company_general` (`id_company_general`),
  ADD CONSTRAINT `fk_customer_to_company_leader` FOREIGN KEY (`id_company_leader`) REFERENCES `company_leader` (`id_company_leader`),
  ADD CONSTRAINT `fk_customer_to_company_profile` FOREIGN KEY (`id_company_profile`) REFERENCES `company_profile` (`id_company_profile`),
  ADD CONSTRAINT `fk_customer_to_feeder_substation` FOREIGN KEY (`id_feeder_substation`) REFERENCES `feeder_substation` (`id_feeder_substation`),
  ADD CONSTRAINT `fk_customer_to_information` FOREIGN KEY (`id_information`) REFERENCES `information` (`id_information`),
  ADD CONSTRAINT `fk_customer_to_service` FOREIGN KEY (`id_type_of_service`) REFERENCES `service` (`id_type_of_service`),
  ADD CONSTRAINT `fk_customer_to_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `fk_customer_to_substation` FOREIGN KEY (`id_substation`) REFERENCES `substation` (`id_substation`),
  ADD CONSTRAINT `fk_customer_to_tariff` FOREIGN KEY (`id_tariff`) REFERENCES `tariff` (`id_tariff`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notif_to_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `fk_notif_to_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `id_notif_to_typenotif` FOREIGN KEY (`id_type_notification`) REFERENCES `type_notification` (`id_type_notification`);

--
-- Constraints for table `notification_target`
--
ALTER TABLE `notification_target`
  ADD CONSTRAINT `fk_notif_target_to_notif` FOREIGN KEY (`id_notification`) REFERENCES `notification` (`id_notification`),
  ADD CONSTRAINT `fk_notif_target_to_user` FOREIGN KEY (`id_target`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `potencial_customer`
--
ALTER TABLE `potencial_customer`
  ADD CONSTRAINT `fk_potencial_customer_to_feeder_substation` FOREIGN KEY (`id_feeder_substation`) REFERENCES `feeder_substation` (`id_feeder_substation`),
  ADD CONSTRAINT `fk_potencial_customer_to_service` FOREIGN KEY (`id_type_of_service`) REFERENCES `service` (`id_type_of_service`),
  ADD CONSTRAINT `fk_potencial_customer_to_substation` FOREIGN KEY (`id_substation`) REFERENCES `substation` (`id_substation`),
  ADD CONSTRAINT `fk_potencial_customer_to_tariff` FOREIGN KEY (`id_tariff`) REFERENCES `tariff` (`id_tariff`),
  ADD CONSTRAINT `fk_potential_customer_to_information` FOREIGN KEY (`id_information`) REFERENCES `information` (`id_information`),
  ADD CONSTRAINT `fk_potential_customer_to_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`);

--
-- Constraints for table `type_notification`
--
ALTER TABLE `type_notification`
  ADD CONSTRAINT `fk_typenotif_to_user_role` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_to_user_role` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`);

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_user_menu`) REFERENCES `user_menu` (`id_user_menu`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`);

--
-- Constraints for table `user_cancellation`
--
ALTER TABLE `user_cancellation`
  ADD CONSTRAINT `fk_cancel_to_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `fk_cancel_to_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user_closing`
--
ALTER TABLE `user_closing`
  ADD CONSTRAINT `fk_user_closing_to_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `fk_user_closing_to_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user_energize`
--
ALTER TABLE `user_energize`
  ADD CONSTRAINT `fk_user_energize_to_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `fk_user_energize_to_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user_report`
--
ALTER TABLE `user_report`
  ADD CONSTRAINT `fk_user_report_to_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `fk_user_report_to_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `fk_user_sub_menu_to_user_menu` FOREIGN KEY (`id_user_menu`) REFERENCES `user_menu` (`id_user_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
