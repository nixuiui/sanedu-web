-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2018 at 06:17 AM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.2.4-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanedu`
--

-- --------------------------------------------------------

--
-- Table structure for table `set_kategori`
--

CREATE TABLE `set_kategori` (
  `id` tinyint(2) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_kategori`
--

INSERT INTO `set_kategori` (`id`, `nama`) VALUES
(10, 'Role User'),
(11, 'Kategori Tiket'),
(12, 'Kategori Grup Chat'),
(13, 'Sekolah'),
(14, 'Jenis Ujian'),
(15, 'Mata Pelajaran'),
(16, 'Kelas'),
(17, 'Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `set_pustaka`
--

CREATE TABLE `set_pustaka` (
  `id` int(4) NOT NULL,
  `id_kategori` tinyint(2) NOT NULL,
  `id_parent` int(4) DEFAULT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `set_pustaka`
--

INSERT INTO `set_pustaka` (`id`, `id_kategori`, `id_parent`, `nama`) VALUES
(1001, 10, NULL, 'Super Admin'),
(1002, 10, NULL, 'Admin'),
(1003, 10, NULL, 'Admin Tiket'),
(1004, 10, NULL, 'Member'),
(1005, 10, NULL, 'User'),
(1101, 11, NULL, 'Tiket Member'),
(1102, 11, NULL, 'Tiket User'),
(1103, 11, NULL, 'Tiket Partisipan'),
(1201, 12, NULL, 'LINE'),
(1202, 12, NULL, 'WhatsApp'),
(1301, 13, NULL, 'SD'),
(1302, 13, NULL, 'SMP'),
(1303, 13, NULL, 'SMA'),
(1401, 14, NULL, 'Ujian Nasional'),
(1402, 14, NULL, 'Ujian Tengah Semester'),
(1403, 14, NULL, 'Ujian Semester'),
(1404, 14, NULL, 'SBMPTN'),
(1405, 14, NULL, 'STAN'),
(1406, 14, NULL, 'POLTEKES'),
(1501, 15, NULL, 'Matematika'),
(1502, 15, NULL, 'Bahasa Indonesia'),
(1503, 15, NULL, 'Bahasa Inggris'),
(1504, 15, NULL, 'IPA'),
(1505, 15, NULL, 'IPS'),
(1506, 15, NULL, 'IPC'),
(1507, 15, NULL, 'IPA TERPADU'),
(1508, 15, NULL, 'IPS TERPADU'),
(1509, 15, NULL, 'Sejarah'),
(1510, 15, NULL, 'Ekonomi'),
(1511, 15, NULL, 'Sosiologi'),
(1512, 15, NULL, 'Geografi'),
(1513, 15, NULL, 'Biologi'),
(1514, 15, NULL, 'Kimia'),
(1515, 15, NULL, 'Fisika'),
(1601, 16, NULL, '1'),
(1602, 16, NULL, '2'),
(1603, 16, NULL, '3'),
(1604, 16, NULL, '4'),
(1605, 16, NULL, '5'),
(1606, 16, NULL, '6'),
(1607, 16, NULL, '7'),
(1608, 16, NULL, '8'),
(1609, 16, NULL, '9'),
(1610, 16, NULL, '10'),
(1611, 16, NULL, '11'),
(1612, 16, NULL, '12'),
(1701, 17, NULL, 'Informasi Universitas'),
(1702, 17, NULL, 'Informasi Beasiswa'),
(1703, 17, NULL, 'Informasi Lowongan Kerja');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attempt`
--

CREATE TABLE `tbl_attempt` (
  `id` char(36) NOT NULL,
  `start_attempt` datetime NOT NULL,
  `end_attempt` datetime NOT NULL,
  `id_ujian` char(36) DEFAULT NULL,
  `id_pembelian` char(36) DEFAULT NULL,
  `id_user` char(36) DEFAULT NULL,
  `jumlah_benar` tinyint(4) NOT NULL DEFAULT '0',
  `jumlah_salah` tinyint(4) NOT NULL DEFAULT '0',
  `jumlah_tidak_jawab` tinyint(4) NOT NULL DEFAULT '0',
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attempt`
--

INSERT INTO `tbl_attempt` (`id`, `start_attempt`, `end_attempt`, `id_ujian`, `id_pembelian`, `id_user`, `jumlah_benar`, `jumlah_salah`, `jumlah_tidak_jawab`, `nilai`, `created_at`, `updated_at`, `deleted_at`) VALUES
('e6690db0-9a4d-11e8-acd3-ed357c0be9e3', '2018-08-07 21:26:40', '2018-08-07 22:06:40', '1b3b6f80-9304-11e8-bf2c-efc2da0ea6f0', 'd5eb7cc0-9a4d-11e8-b929-ff770c623d6f', '2e4cb000-74b0-11e8-b897-4d5bdd8ac141', 0, 0, 0, 0, '2018-08-07 14:26:40', '2018-08-07 14:26:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attempt_correction`
--

CREATE TABLE `tbl_attempt_correction` (
  `id` char(36) NOT NULL,
  `id_attempt` char(36) NOT NULL,
  `jawaban` enum('a','b','c','d','e') NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `id_soal` char(36) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cetak_tiket`
--

CREATE TABLE `tbl_cetak_tiket` (
  `id` char(36) NOT NULL,
  `id_kategori_tiket` int(4) NOT NULL,
  `id_user` char(36) DEFAULT NULL,
  `jumlah_tiket` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cetak_tiket`
--

INSERT INTO `tbl_cetak_tiket` (`id`, `id_kategori_tiket`, `id_user`, `jumlah_tiket`, `created_at`, `updated_at`, `deleted_at`) VALUES
('274ed950-9414-11e8-b123-d54b563a8911', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 100, '2018-07-30 16:18:11', '2018-07-30 16:18:11', NULL),
('38652d90-9192-11e8-a1b2-1fd8bfe4bd95', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('46318a60-8a9b-11e8-867f-fbbba0211a0a', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('487453f0-83d6-11e8-a737-03a8c727bcaa', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-09 17:14:59', '2018-07-09 17:15:55', '2018-07-09 17:15:55'),
('52ee4600-9192-11e8-81ce-d1887c9f2986', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-27 11:43:47', '2018-07-27 11:43:47', NULL),
('65971c00-9217-11e8-b0eb-0f1428b1fabc', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('6643d630-83d6-11e8-a1d4-b94eea93744f', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-09 17:15:49', '2018-07-09 17:15:58', '2018-07-09 17:15:58'),
('7571ee50-83d6-11e8-bea6-75928a0947bb', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-09 17:16:15', '2018-07-09 17:19:32', '2018-07-09 17:19:32'),
('99057cc0-77ad-11e8-8890-c5b2f02402c3', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-06-24 05:53:31', '2018-07-09 17:15:57', '2018-07-09 17:15:57'),
('a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 10, '2018-07-28 03:38:12', '2018-07-28 03:38:12', NULL),
('e8d07210-83d5-11e8-bf71-3dacee84a75b', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-09 17:12:19', '2018-07-09 17:12:25', '2018-07-09 17:12:25'),
('f3801a30-83d6-11e8-a295-f7e7aa62bf35', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('fa487540-83d5-11e8-a68b-e736eacb80bd', 1101, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 0, '2018-07-09 17:12:48', '2018-07-09 17:14:34', '2018-07-09 17:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grup_chat`
--

CREATE TABLE `tbl_grup_chat` (
  `id` char(36) NOT NULL,
  `id_kategori_grup_chat` int(4) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `jumlah_member` int(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grup_chat`
--

INSERT INTO `tbl_grup_chat` (`id`, `id_kategori_grup_chat`, `nama`, `link`, `jumlah_member`, `created_at`, `updated_at`, `deleted_at`) VALUES
('041e601e-824f-11e8-aa93-fcde56ff0106', 1201, 'Grup WA', 'http://google.com', 1, '2018-07-08 01:34:11', NULL, NULL),
('2ea949d0-8254-11e8-b364-43ed9b438fd0', 1201, 'asdas', 'http://www.google.com', 0, '2018-07-07 19:11:10', '2018-07-07 19:14:47', NULL),
('34e72c50-8254-11e8-8600-87aa90e91c2a', 1202, 'wa', 'http://wa.com', 1, '2018-07-07 19:11:21', '2018-07-07 19:11:21', NULL),
('995dfec0-8253-11e8-8ae6-1d8ab6e747a9', 1201, 'Grup Line', 'http://google.com', 0, '2018-07-07 19:07:00', '2018-07-07 19:07:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grup_chat_member`
--

CREATE TABLE `tbl_grup_chat_member` (
  `id` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `id_kategori_grup_chat` int(4) NOT NULL,
  `id_grup_chat` char(36) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grup_chat_member`
--

INSERT INTO `tbl_grup_chat_member` (`id`, `id_user`, `id_kategori_grup_chat`, `id_grup_chat`, `created_at`, `updated_at`, `deleted_at`) VALUES
('5b96af30-825c-11e8-8a0b-635a2bf74dcf', '2e4cb000-74b0-11e8-b897-4d5bdd8ac141', 1202, '34e72c50-8254-11e8-8600-87aa90e91c2a', '2018-07-07 20:09:42', '2018-07-07 20:09:42', NULL),
('5c61c630-825c-11e8-aa89-5bc87065dcdb', '2e4cb000-74b0-11e8-b897-4d5bdd8ac141', 1201, '041e601e-824f-11e8-aa93-fcde56ff0106', '2018-07-07 20:09:43', '2018-07-07 20:09:43', NULL);

--
-- Triggers `tbl_grup_chat_member`
--
DELIMITER $$
CREATE TRIGGER `grup_chat_update_jumlah_member` AFTER INSERT ON `tbl_grup_chat_member` FOR EACH ROW UPDATE tbl_grup_chat SET jumlah_member=jumlah_member+1 WHERE id=new.id_grup_chat
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `grup_chat_update_jumlah_member_when_member_out` BEFORE DELETE ON `tbl_grup_chat_member` FOR EACH ROW UPDATE tbl_grup_chat SET jumlah_member=jumlah_member-1 WHERE id=old.id_grup_chat
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_informasi`
--

CREATE TABLE `tbl_informasi` (
  `id` char(36) NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `id_author` char(36) NOT NULL,
  `judul` text NOT NULL,
  `foto` text,
  `isi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_informasi`
--

INSERT INTO `tbl_informasi` (`id`, `id_kategori`, `id_author`, `judul`, `foto`, `isi`, `created_at`, `updated_at`, `deleted_at`) VALUES
('510cc080-93e8-11e8-957d-19932e6f8259', 1701, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 'asdsa', NULL, 'dasd', '2018-07-30 11:04:23', '2018-07-30 11:04:23', NULL),
('5a1cb180-93e8-11e8-a5a3-57cc495dee9d', 1702, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 'asdasd', NULL, 'sadasd', '2018-07-30 11:04:38', '2018-07-30 11:04:38', NULL),
('7722eca0-93e2-11e8-ba2a-35ba1be8f70f', 1701, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 'Tes', NULL, 'asdas', '2018-07-30 10:22:30', '2018-07-30 10:22:30', NULL),
('915a2da0-93e6-11e8-9a7d-f199fb1f1c82', 1701, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 'SDasd', 'storage/image/072018/1532947912.jpeg', 'asdasdas', '2018-07-30 10:51:52', '2018-07-30 10:51:52', NULL),
('9bae9bb0-93e6-11e8-a2c1-e1ee9e667180', 1703, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 'KNKSDC', 'storage/image/072018/1532948780.jpeg', 'SDSA', '2018-07-30 10:52:09', '2018-07-30 11:06:20', NULL),
('9e73bb30-93e8-11e8-8a73-09930a3594ae', 1703, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 'ASD', NULL, 'ASD', '2018-07-30 11:06:33', '2018-07-30 11:06:33', NULL),
('a260a2e0-93e4-11e8-9b52-d9944710640e', 1702, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 'asdas', NULL, 'dasdsa', '2018-07-30 10:38:02', '2018-07-30 10:38:02', NULL),
('b6076fa0-93e4-11e8-8395-4b6861480da5', 1702, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 'sadas', 'storage/image/072018/1532947115.jpeg', 'dsdasdsad', '2018-07-30 10:38:35', '2018-07-30 10:53:36', '2018-07-30 10:53:36'),
('e7ccf0e0-93ec-11e8-a072-254b89297470', 1702, 'd1ab8960-7428-11e8-84a9-a17f4599cb08', 'WKWK', 'storage/image/072018/1532952239.jpeg', '<h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">The standard Lorem Ipsum passage, used since the 1500s</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">1914 translation by H. Rackham</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>', '2018-07-30 11:37:17', '2018-07-30 12:25:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `id` char(36) NOT NULL,
  `id_universitas` char(36) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `kuota` int(11) NOT NULL,
  `peminat` int(11) NOT NULL,
  `passing_grade` double NOT NULL,
  `akreditasi` char(2) NOT NULL,
  `soshum` tinyint(1) NOT NULL,
  `saintek` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id`, `id_universitas`, `jurusan`, `kuota`, `peminat`, `passing_grade`, `akreditasi`, `soshum`, `saintek`, `created_at`, `updated_at`, `deleted_at`) VALUES
('11f16460-9414-11e8-9637-4fcb6361c6d2', 'a6537450-940d-11e8-9318-ad01b8183ce7', 'Fisika', 2000, 3000, 40, '40', 1, 0, '2018-07-30 16:17:35', '2018-07-30 16:17:41', NULL),
('94e206c0-9414-11e8-be1a-6b785e2e23f0', '8de2dfb0-940d-11e8-915d-8b900d7f77bf', 'Ilmu Komputer', 500, 10000, 40, 'A', 1, 1, '2018-07-30 16:21:15', '2018-07-30 16:21:15', NULL),
('9dd49e20-9414-11e8-aae7-51686e1900ed', '9db96a10-9414-11e8-b59c-2f92a5b81684', 'Ilmu Komputer', 1000, 5000, 80, 'A', 0, 1, '2018-07-30 16:21:30', '2018-07-30 16:21:30', NULL),
('9ddde160-9414-11e8-bd1c-a3db7c9d09d4', '9db96a10-9414-11e8-b59c-2f92a5b81684', 'Matematika', 1000, 5000, 45, 'A', 1, 1, '2018-07-30 16:21:30', '2018-07-30 16:21:30', NULL),
('9de98790-9414-11e8-91dd-0da6672d5919', '9db96a10-9414-11e8-b59c-2f92a5b81684', 'Biologi', 2000, 6000, 50, 'B', 1, 0, '2018-07-30 16:21:30', '2018-07-30 16:21:30', NULL),
('a662f7f0-940d-11e8-8a8b-87c3a67bbae6', 'a6537450-940d-11e8-9318-ad01b8183ce7', 'Ilmu Komputer', 1000, 5000, 80, 'A', 1, 0, '2018-07-30 15:31:38', '2018-07-30 16:05:07', NULL),
('a66c3d50-940d-11e8-aac0-0be2f2e885b0', 'a6537450-940d-11e8-9318-ad01b8183ce7', 'Matematika', 1000, 5000, 45, 'A', 1, 1, '2018-07-30 15:31:38', '2018-07-30 15:43:31', NULL),
('a67828c0-940d-11e8-8600-25834dc37825', 'a6537450-940d-11e8-9318-ad01b8183ce7', 'Biologi', 2000, 6000, 50, 'B', 0, 1, '2018-07-30 15:31:38', '2018-07-30 16:04:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_reset`
--

CREATE TABLE `tbl_password_reset` (
  `email` varchar(100) NOT NULL,
  `token` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_password_reset`
--

INSERT INTO `tbl_password_reset` (`email`, `token`, `created_at`) VALUES
('nikirahmadiwihart@gmail.com', '0', '2018-07-19 07:08:38'),
('nikirahmadiwihart@gmail.com', '0', '2018-07-19 07:23:34'),
('nikirahmadiwihart@gmail.com', '0', '2018-07-19 07:25:52'),
('nikirahmadiwihart@gmail.com', '0', '2018-07-19 07:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelian_ujian`
--

CREATE TABLE `tbl_pembelian_ujian` (
  `id` char(36) NOT NULL,
  `id_ujian` char(36) NOT NULL,
  `id_user` char(36) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembelian_ujian`
--

INSERT INTO `tbl_pembelian_ujian` (`id`, `id_ujian`, `id_user`, `harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
('d5eb7cc0-9a4d-11e8-b929-ff770c623d6f', '1b3b6f80-9304-11e8-bf2c-efc2da0ea6f0', '2e4cb000-74b0-11e8-b897-4d5bdd8ac141', 100000, '2018-08-07 14:26:12', '2018-08-07 14:26:12', NULL);

--
-- Triggers `tbl_pembelian_ujian`
--
DELIMITER $$
CREATE TRIGGER `mengurangi_saldo_member_saat_membeli_ujian` AFTER INSERT ON `tbl_pembelian_ujian` FOR EACH ROW UPDATE tbl_users SET saldo=saldo-new.harga WHERE id=new.id_user
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pilihan_passing_grade`
--

CREATE TABLE `tbl_pilihan_passing_grade` (
  `id` char(36) NOT NULL,
  `id_attempt` char(36) NOT NULL,
  `id_ujian` char(36) NOT NULL,
  `pilihan_1` char(36) NOT NULL,
  `pilihan_2` char(36) NOT NULL,
  `pilihan_3` char(36) NOT NULL,
  `jurusan` int(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pilihan_passing_grade`
--

INSERT INTO `tbl_pilihan_passing_grade` (`id`, `id_attempt`, `id_ujian`, `pilihan_1`, `pilihan_2`, `pilihan_3`, `jurusan`, `created_at`, `updated_at`, `deleted_at`) VALUES
('a4b0ec10-99d8-11e8-9a5d-6d6b5bb9d8c7', 'a4b07bc0-99d8-11e8-aed2-555030583b3d', '7b0688f0-98bd-11e8-9918-0fd496423e88', '11f16460-9414-11e8-9637-4fcb6361c6d2', '11f16460-9414-11e8-9637-4fcb6361c6d2', '11f16460-9414-11e8-9637-4fcb6361c6d2', 1505, '2018-08-07 00:27:18', '2018-08-07 00:27:18', NULL),
('e6699b90-9a4d-11e8-9a7d-8f6f516bbb52', 'e6690db0-9a4d-11e8-acd3-ed357c0be9e3', '1b3b6f80-9304-11e8-bf2c-efc2da0ea6f0', '11f16460-9414-11e8-9637-4fcb6361c6d2', 'a66c3d50-940d-11e8-aac0-0be2f2e885b0', 'a662f7f0-940d-11e8-8a8b-87c3a67bbae6', 1505, '2018-08-07 14:26:40', '2018-08-07 14:26:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id` char(36) NOT NULL,
  `soal` text NOT NULL,
  `a` text,
  `b` text,
  `c` text,
  `d` text,
  `e` text,
  `jawaban` enum('a','b','c','d','e') NOT NULL,
  `id_ujian` char(36) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_soal`
--

INSERT INTO `tbl_soal` (`id`, `soal`, `a`, `b`, `c`, `d`, `e`, `jawaban`, `id_ujian`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1c307260-93ae-11e8-9aef-517ee4e20c82', 'wew', NULL, NULL, NULL, NULL, NULL, 'c', 'f56069f0-93a3-11e8-9960-e77dab41c15d', '2018-07-30 04:07:44', '2018-07-30 04:07:44', NULL),
('49726460-9319-11e8-9d5d-e78b46c3c2d0', '<p>asdasd</p>', '<p>sadas</p>', NULL, '<p>dasdas</p>', '<p>asdasd</p>', NULL, 'd', '1b3b6f80-9304-11e8-bf2c-efc2da0ea6f0', '2018-07-29 10:02:20', '2018-07-29 10:22:25', NULL),
('b224f460-9318-11e8-a950-e3237a4154ab', '<p>asdasd</p>', 'asdasd', NULL, '<p>dasdas</p>', '<p>asdasd</p>', NULL, 'a', '1b3b6f80-9304-11e8-bf2c-efc2da0ea6f0', '2018-07-29 10:18:11', '2018-07-29 10:18:11', NULL),
('eb23f420-93a6-11e8-81b8-4bc42bd6f5c4', '<p>TES&nbsp;</p>', 'TES', 'TES', 'TES', 'TES', 'TES', 'b', 'f56069f0-93a3-11e8-9960-e77dab41c15d', '2018-07-30 03:16:15', '2018-07-30 03:16:15', NULL),
('f32780b0-9318-11e8-8a9b-effc93b84d4b', '<p>asdasd</p>', '<p>sadas</p>', NULL, '<p>dasdas</p>', '<p>asdasd</p>', NULL, 'e', '1b3b6f80-9304-11e8-bf2c-efc2da0ea6f0', '2018-07-29 10:20:00', '2018-07-29 10:20:00', NULL),
('ff4089d0-93a6-11e8-8092-172849e0857b', '<h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">The standard Lorem Ipsum passage, used since the 1500s</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">1914 translation by H. Rackham</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>', '<h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">The standard Lorem Ipsum passage, used since the 1500s</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">1914 translation by H. Rackham</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>', '<h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">The standard Lorem Ipsum passage, used since the 1500s</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">1914 translation by H. Rackham</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>', '<h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">The standard Lorem Ipsum passage, used since the 1500s</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">1914 translation by H. Rackham</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>', '<h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">The standard Lorem Ipsum passage, used since the 1500s</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">1914 translation by H. Rackham</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>', '<h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">The standard Lorem Ipsum passage, used since the 1500s</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p><h3 style="margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">1914 translation by H. Rackham</h3><p style="padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>', 'c', 'f56069f0-93a3-11e8-9960-e77dab41c15d', '2018-07-30 03:16:49', '2018-07-30 03:16:49', NULL);

--
-- Triggers `tbl_soal`
--
DELIMITER $$
CREATE TRIGGER `ujian_update_jumlah_soal_when_add_soal` AFTER INSERT ON `tbl_soal` FOR EACH ROW UPDATE tbl_ujian SET jumlah_soal=jumlah_soal+1 WHERE id=new.id_ujian
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ujian_update_jumlah_soal_when_delete_soal` BEFORE DELETE ON `tbl_soal` FOR EACH ROW UPDATE tbl_ujian SET jumlah_soal=jumlah_soal-1 WHERE id=old.id_ujian
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket`
--

CREATE TABLE `tbl_tiket` (
  `id` char(36) NOT NULL,
  `id_cetak_tiket` char(36) NOT NULL,
  `kap` varchar(59) NOT NULL,
  `pin` varchar(50) NOT NULL,
  `id_user` char(36) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tiket`
--

INSERT INTO `tbl_tiket` (`id`, `id_cetak_tiket`, `kap`, `pin`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1', '52ee4600-9192-11e8-81ce-d1887c9f2986', '1232312321321312312312', '123123123123213213', '1ce92d60-77ae-11e8-a04d-8fb905f83ba3', '2018-07-28 03:37:05', NULL, NULL),
('276596e0-9414-11e8-ac08-6f9cba0cdfc0', '274ed950-9414-11e8-b123-d54b563a8911', '191961306000', '1181111961372000', NULL, '2018-07-30 16:18:11', '2018-07-30 16:18:11', NULL),
('2774c900-9414-11e8-a4ff-a5ef94477c5c', '274ed950-9414-11e8-b123-d54b563a8911', '191961391001', '1181111961999001', NULL, '2018-07-30 16:18:11', '2018-07-30 16:18:11', NULL),
('27859660-9414-11e8-b07a-5f8b7d220986', '274ed950-9414-11e8-b123-d54b563a8911', '191961342002', '1181111961849002', NULL, '2018-07-30 16:18:11', '2018-07-30 16:18:11', NULL),
('278a8210-9414-11e8-a527-4d733a1f0396', '274ed950-9414-11e8-b123-d54b563a8911', '191961314003', '1181111961862003', NULL, '2018-07-30 16:18:11', '2018-07-30 16:18:11', NULL),
('279182c0-9414-11e8-9fab-ab448e7113f9', '274ed950-9414-11e8-b123-d54b563a8911', '191961373004', '1181111961733004', NULL, '2018-07-30 16:18:11', '2018-07-30 16:18:11', NULL),
('2799e490-9414-11e8-ae10-9bad9074fd22', '274ed950-9414-11e8-b123-d54b563a8911', '191961342005', '1181111961874005', NULL, '2018-07-30 16:18:11', '2018-07-30 16:18:11', NULL),
('27a78860-9414-11e8-ab8a-55d9a99b5455', '274ed950-9414-11e8-b123-d54b563a8911', '192962397006', '1181211962607006', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('27b6c460-9414-11e8-af5e-cb4598246ae4', '274ed950-9414-11e8-b123-d54b563a8911', '192962315007', '1181211962578007', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('27c0eac0-9414-11e8-9640-39e07639b872', '274ed950-9414-11e8-b123-d54b563a8911', '192962349008', '1181211962882008', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('27cc8d50-9414-11e8-bad7-37d766ad3135', '274ed950-9414-11e8-b123-d54b563a8911', '192962359009', '1181211962377009', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('27d1db70-9414-11e8-9681-45d01347da3f', '274ed950-9414-11e8-b123-d54b563a8911', '192962387010', '1181211962184010', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('27d6b950-9414-11e8-981d-7f20a6562e44', '274ed950-9414-11e8-b123-d54b563a8911', '192962389011', '1181211962565011', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('27df6900-9414-11e8-8d89-d73edd782fc0', '274ed950-9414-11e8-b123-d54b563a8911', '192962350012', '1181211962492012', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('27fc1e20-9414-11e8-a9d3-9389fb6dd90a', '274ed950-9414-11e8-b123-d54b563a8911', '192962338013', '1181211962661013', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('280109c0-9414-11e8-8d56-8fec9d955dcc', '274ed950-9414-11e8-b123-d54b563a8911', '192962353014', '1181211962492014', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('2807f7c0-9414-11e8-8041-9381400124ad', '274ed950-9414-11e8-b123-d54b563a8911', '192962371015', '1181211962392015', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('280ec740-9414-11e8-8ff7-0f944abae57b', '274ed950-9414-11e8-b123-d54b563a8911', '192962349016', '1181211962157016', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('2813ce90-9414-11e8-b010-339043227098', '274ed950-9414-11e8-b123-d54b563a8911', '192962310017', '1181211962935017', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('281c6200-9414-11e8-a0d9-655f1375bc3d', '274ed950-9414-11e8-b123-d54b563a8911', '192962312018', '1181211962053018', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('28215c90-9414-11e8-9f1c-91496c314f07', '274ed950-9414-11e8-b123-d54b563a8911', '192962399019', '1181211962763019', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('282b9c80-9414-11e8-ae22-e1c4dd81cc40', '274ed950-9414-11e8-b123-d54b563a8911', '192962302020', '1181211962013020', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('28309890-9414-11e8-ab84-815cc65548a2', '274ed950-9414-11e8-b123-d54b563a8911', '192962368021', '1181211962266021', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('2835c7a0-9414-11e8-bc6b-bdde9b3f9537', '274ed950-9414-11e8-b123-d54b563a8911', '192962320022', '1181211962022022', NULL, '2018-07-30 16:18:12', '2018-07-30 16:18:12', NULL),
('283ac2c0-9414-11e8-b859-c316a790cc11', '274ed950-9414-11e8-b123-d54b563a8911', '192962331023', '1181211962633023', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('2841a300-9414-11e8-8679-93635a7bad4d', '274ed950-9414-11e8-b123-d54b563a8911', '193963335024', '1181311963910024', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28605580-9414-11e8-8420-7f15ba0cfc2a', '274ed950-9414-11e8-b123-d54b563a8911', '193963352025', '1181311963978025', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('286893a0-9414-11e8-b800-3d8895a51bd1', '274ed950-9414-11e8-b123-d54b563a8911', '193963354026', '1181311963643026', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28710b80-9414-11e8-8e17-dff2a025c65b', '274ed950-9414-11e8-b123-d54b563a8911', '193963382027', '1181311963689027', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28761910-9414-11e8-a55c-f7733c6c3984', '274ed950-9414-11e8-b123-d54b563a8911', '193963352028', '1181311963183028', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28913620-9414-11e8-b0f5-031dbe0ab713', '274ed950-9414-11e8-b123-d54b563a8911', '193963388029', '1181311963667029', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('2897e9f0-9414-11e8-b0c3-19a7ca4ad99b', '274ed950-9414-11e8-b123-d54b563a8911', '193963333030', '1181311963466030', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28a58600-9414-11e8-ba12-bddb5820f917', '274ed950-9414-11e8-b123-d54b563a8911', '193963393031', '1181311963568031', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28aa9e10-9414-11e8-8964-6562a70ccb2f', '274ed950-9414-11e8-b123-d54b563a8911', '193963323032', '1181311963468032', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28afb0c0-9414-11e8-8d1b-69bba36cfb24', '274ed950-9414-11e8-b123-d54b563a8911', '193963375033', '1181311963216033', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28b81600-9414-11e8-badd-196ccd34e096', '274ed950-9414-11e8-b123-d54b563a8911', '193963313034', '1181311963734034', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28c09f60-9414-11e8-b55e-69d7d2be0dc6', '274ed950-9414-11e8-b123-d54b563a8911', '193963335035', '1181311963221035', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28c918e0-9414-11e8-96f2-b97cf80f34ff', '274ed950-9414-11e8-b123-d54b563a8911', '193963359036', '1181311963165036', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28cfc8c0-9414-11e8-96f6-f37c8cf81120', '274ed950-9414-11e8-b123-d54b563a8911', '193963354037', '1181311963980037', NULL, '2018-07-30 16:18:13', '2018-07-30 16:18:13', NULL),
('28d4f400-9414-11e8-b47a-fbc2feb54dbb', '274ed950-9414-11e8-b123-d54b563a8911', '194964357038', '1181411964652038', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('28dba4e0-9414-11e8-9410-938a71df39ef', '274ed950-9414-11e8-b123-d54b563a8911', '194964371039', '1181411964061039', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('28e40940-9414-11e8-9de2-6375370e2627', '274ed950-9414-11e8-b123-d54b563a8911', '194964374040', '1181411964163040', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('28e94740-9414-11e8-a17a-e5f7f4a08c3a', '274ed950-9414-11e8-b123-d54b563a8911', '194964380041', '1181411964275041', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('28f192b0-9414-11e8-a954-afa832797603', '274ed950-9414-11e8-b123-d54b563a8911', '194964335042', '1181411964666042', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('28f6d130-9414-11e8-a0c8-31cd328be7dc', '274ed950-9414-11e8-b123-d54b563a8911', '194964393043', '1181411964002043', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('292b4cc0-9414-11e8-b195-5d1a9a76eb58', '274ed950-9414-11e8-b123-d54b563a8911', '194964345044', '1181411964759044', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('2933c0e0-9414-11e8-a64d-7b884639c3c1', '274ed950-9414-11e8-b123-d54b563a8911', '194964367045', '1181411964391045', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('2938af00-9414-11e8-9a0d-ef91d73a3dfe', '274ed950-9414-11e8-b123-d54b563a8911', '194964319046', '1181411964283046', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('293c3c30-9414-11e8-92dd-63858b44ba64', '274ed950-9414-11e8-b123-d54b563a8911', '194964351047', '1181411964992047', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('2942d7b0-9414-11e8-a53a-c70b043cc019', '274ed950-9414-11e8-b123-d54b563a8911', '194964370048', '1181411964020048', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('29481be0-9414-11e8-ac9b-cbbbc676fe39', '274ed950-9414-11e8-b123-d54b563a8911', '194964395049', '1181411964476049', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('2953f200-9414-11e8-bf93-a3d0ab55d614', '274ed950-9414-11e8-b123-d54b563a8911', '194964343050', '1181411964830050', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('2958f280-9414-11e8-a740-374bed628cf5', '274ed950-9414-11e8-b123-d54b563a8911', '194964369051', '1181411964598051', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('295e1da0-9414-11e8-b2cd-1d3b024921c2', '274ed950-9414-11e8-b123-d54b563a8911', '194964303052', '1181411964843052', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('29631be0-9414-11e8-ba8e-4f42ab23388b', '274ed950-9414-11e8-b123-d54b563a8911', '194964391053', '1181411964136053', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('29684440-9414-11e8-8a7c-fb28ef3e85eb', '274ed950-9414-11e8-b123-d54b563a8911', '194964318054', '1181411964290054', NULL, '2018-07-30 16:18:14', '2018-07-30 16:18:14', NULL),
('296f0b40-9414-11e8-8aeb-73ad5f2c6cfd', '274ed950-9414-11e8-b123-d54b563a8911', '195965341055', '1181511965470055', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('2973f700-9414-11e8-8828-8391ac281ead', '274ed950-9414-11e8-b123-d54b563a8911', '195965369056', '1181511965839056', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('297ae740-9414-11e8-a3ae-a770d0b1fd36', '274ed950-9414-11e8-b123-d54b563a8911', '195965387057', '1181511965496057', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('297fd140-9414-11e8-a729-19506e7814de', '274ed950-9414-11e8-b123-d54b563a8911', '195965311058', '1181511965168058', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('29851060-9414-11e8-9894-e93d7df8bfb2', '274ed950-9414-11e8-b123-d54b563a8911', '195965368059', '1181511965336059', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('2989f9e0-9414-11e8-9646-b57007966676', '274ed950-9414-11e8-b123-d54b563a8911', '195965360060', '1181511965946060', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('2990edc0-9414-11e8-acf6-cf707b22051b', '274ed950-9414-11e8-b123-d54b563a8911', '195965352061', '1181511965360061', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('29d65270-9414-11e8-b5e4-c32ddf06548f', '274ed950-9414-11e8-b123-d54b563a8911', '195965326062', '1181511965067062', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('29dcef90-9414-11e8-b62b-ed72d8293141', '274ed950-9414-11e8-b123-d54b563a8911', '195965321063', '1181511965669063', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('29e22da0-9414-11e8-a8d3-337dc2dbccba', '274ed950-9414-11e8-b123-d54b563a8911', '195965338064', '1181511965196064', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('29eaa840-9414-11e8-a75b-e7ebeb8cf4c5', '274ed950-9414-11e8-b123-d54b563a8911', '195965348065', '1181511965250065', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('29efa170-9414-11e8-9c3a-7f1f76fb33f0', '274ed950-9414-11e8-b123-d54b563a8911', '195965376066', '1181511965022066', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('29f9e480-9414-11e8-b430-d1828b9bbc24', '274ed950-9414-11e8-b123-d54b563a8911', '195965309067', '1181511965881067', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('29fee1c0-9414-11e8-9fd8-790fc3ad4538', '274ed950-9414-11e8-b123-d54b563a8911', '195965376068', '1181511965383068', NULL, '2018-07-30 16:18:15', '2018-07-30 16:18:15', NULL),
('2a059250-9414-11e8-a9c3-af8de303158a', '274ed950-9414-11e8-b123-d54b563a8911', '196966306069', '1181611966543069', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a0c8430-9414-11e8-99b6-6f44556ee3bc', '274ed950-9414-11e8-b123-d54b563a8911', '196966377070', '1181611966437070', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a134ac0-9414-11e8-8f49-31a9e21527c6', '274ed950-9414-11e8-b123-d54b563a8911', '196966353071', '1181611966942071', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a1e5bb0-9414-11e8-af27-eb5341b20b3d', '274ed950-9414-11e8-b123-d54b563a8911', '196966331072', '1181611966805072', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a2e6300-9414-11e8-bb13-e3bff3571233', '274ed950-9414-11e8-b123-d54b563a8911', '196966311073', '1181611966664073', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a3b0520-9414-11e8-ae96-9147b81678a3', '274ed950-9414-11e8-b123-d54b563a8911', '196966344074', '1181611966024074', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a5c79c0-9414-11e8-bf5c-832037457e48', '274ed950-9414-11e8-b123-d54b563a8911', '196966379075', '1181611966481075', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a71f130-9414-11e8-8139-6335bb976127', '274ed950-9414-11e8-b123-d54b563a8911', '196966384076', '1181611966275076', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a860e60-9414-11e8-81f2-83317942b53d', '274ed950-9414-11e8-b123-d54b563a8911', '196966324077', '1181611966280077', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a924650-9414-11e8-81d0-731ca2a2e8e7', '274ed950-9414-11e8-b123-d54b563a8911', '196966301078', '1181611966473078', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2a9abfb0-9414-11e8-b08d-c54b98c64afe', '274ed950-9414-11e8-b123-d54b563a8911', '196966378079', '1181611966931079', NULL, '2018-07-30 16:18:16', '2018-07-30 16:18:16', NULL),
('2aa337d0-9414-11e8-bd13-6d3a1beb0068', '274ed950-9414-11e8-b123-d54b563a8911', '197967316080', '1181711967004080', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2aaa7aa0-9414-11e8-b428-8d9017fe5996', '274ed950-9414-11e8-b123-d54b563a8911', '197967376081', '1181711967911081', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2abfe610-9414-11e8-b4d5-db467b47e247', '274ed950-9414-11e8-b123-d54b563a8911', '197967341082', '1181711967693082', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2ad2a460-9414-11e8-bc50-df52d5259848', '274ed950-9414-11e8-b123-d54b563a8911', '197967351083', '1181711967200083', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2adb77c0-9414-11e8-b27d-f15b03a13e42', '274ed950-9414-11e8-b123-d54b563a8911', '197967394084', '1181711967295084', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2af0ebb0-9414-11e8-b7df-9da4a3550f56', '274ed950-9414-11e8-b123-d54b563a8911', '197967306085', '1181711967593085', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2afe8950-9414-11e8-9052-55ae93f0d0a1', '274ed950-9414-11e8-b123-d54b563a8911', '197967337086', '1181711967240086', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2b056de0-9414-11e8-8c5f-c5e542ad9245', '274ed950-9414-11e8-b123-d54b563a8911', '197967376087', '1181711967770087', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2b0f96b0-9414-11e8-b941-5357a4f2a5a7', '274ed950-9414-11e8-b123-d54b563a8911', '197967329088', '1181711967635088', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2b15be00-9414-11e8-84c2-01af8553155c', '274ed950-9414-11e8-b123-d54b563a8911', '197967385089', '1181711967523089', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2b211890-9414-11e8-a358-f719137cdf41', '274ed950-9414-11e8-b123-d54b563a8911', '197967398090', '1181711967049090', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2b2e7780-9414-11e8-9521-319aa35a4ccb', '274ed950-9414-11e8-b123-d54b563a8911', '197967300091', '1181711967216091', NULL, '2018-07-30 16:18:17', '2018-07-30 16:18:17', NULL),
('2b383aa0-9414-11e8-a9eb-8b0f0a0362ec', '274ed950-9414-11e8-b123-d54b563a8911', '198968393092', '1181811968983092', NULL, '2018-07-30 16:18:18', '2018-07-30 16:18:18', NULL),
('2b3f8500-9414-11e8-918a-53d259789af3', '274ed950-9414-11e8-b123-d54b563a8911', '198968380093', '1181811968710093', NULL, '2018-07-30 16:18:18', '2018-07-30 16:18:18', NULL),
('2b4b7db0-9414-11e8-9ddf-9fccfebf4ac0', '274ed950-9414-11e8-b123-d54b563a8911', '198968346094', '1181811968723094', NULL, '2018-07-30 16:18:18', '2018-07-30 16:18:18', NULL),
('2b5550a0-9414-11e8-93c9-156f3fa41a22', '274ed950-9414-11e8-b123-d54b563a8911', '198968358095', '1181811968045095', NULL, '2018-07-30 16:18:18', '2018-07-30 16:18:18', NULL),
('2b5bcc40-9414-11e8-a06a-11790cf2b592', '274ed950-9414-11e8-b123-d54b563a8911', '198968311096', '1181811968097096', NULL, '2018-07-30 16:18:18', '2018-07-30 16:18:18', NULL),
('2b6e3780-9414-11e8-a24d-f97b907f136c', '274ed950-9414-11e8-b123-d54b563a8911', '198968322097', '1181811968195097', NULL, '2018-07-30 16:18:18', '2018-07-30 16:18:18', NULL),
('2b738160-9414-11e8-a8b7-45282be38d39', '274ed950-9414-11e8-b123-d54b563a8911', '198968305098', '1181811968252098', NULL, '2018-07-30 16:18:18', '2018-07-30 16:18:18', NULL),
('2ba60440-9414-11e8-b7e2-71e698355631', '274ed950-9414-11e8-b123-d54b563a8911', '198968329099', '1181811968815099', NULL, '2018-07-30 16:18:18', '2018-07-30 16:18:18', NULL),
('3873eb00-9192-11e8-b290-4b74622f855b', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693321000', '1180311693246000', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('387f9b80-9192-11e8-8e70-859088bbe73b', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693334001', '1180311693232001', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('388572d0-9192-11e8-b827-15006a8d17b2', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693349002', '1180311693886002', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('388fafe0-9192-11e8-a018-779f9c8f0598', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693308003', '1180311693595003', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38959dd0-9192-11e8-a33f-3bd75e293885', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693338004', '1180311693039004', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('389b8bf0-9192-11e8-b569-35fcdbc3848f', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693315005', '1180311693548005', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38a17930-9192-11e8-a430-37382f80aa56', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693375006', '1180311693366006', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38a76400-9192-11e8-9df8-731cfbc66149', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693337007', '1180311693812007', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38ad5420-9192-11e8-ab5a-7b335e56b28d', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693302008', '1180311693891008', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38b4ed80-9192-11e8-8c60-6104a8076d84', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693396009', '1180311693973009', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38bd5380-9192-11e8-85de-e37c88e0294c', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693348010', '1180311693935010', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38c35540-9192-11e8-b906-8d7fb1f8cfc4', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693331011', '1180311693997011', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38c92b80-9192-11e8-8af8-c9f3302df9e6', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693384012', '1180311693303012', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38d0e2e0-9192-11e8-b602-d54ef3e60a0f', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693395013', '1180311693447013', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38d6b910-9192-11e8-934b-c7f939a78127', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '183693381014', '1180311693967014', NULL, '2018-07-27 04:43:03', '2018-07-27 04:43:03', NULL),
('38dcbc70-9192-11e8-94f4-878f38b6c4de', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694327015', '1180411694470015', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('38e29730-9192-11e8-9088-8d4b9ac2e963', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694397016', '1180411694590016', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('38e89630-9192-11e8-bfa5-fbd631060b11', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694373017', '1180411694403017', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('38ee6ee0-9192-11e8-92df-b9da4efdda7e', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694322018', '1180411694547018', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('38f47210-9192-11e8-967a-01cb905cdfa2', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694310019', '1180411694314019', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('38fa4ab0-9192-11e8-b2a7-8d1bfdf9b190', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694326020', '1180411694212020', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('39004be0-9192-11e8-a6a1-5f77727d97b5', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694351021', '1180411694890021', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('390620e0-9192-11e8-accb-79e72e56f88c', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694310022', '1180411694754022', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('390c25e0-9192-11e8-8af5-95d0bf4193c1', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694319023', '1180411694193023', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('39155d80-9192-11e8-ad55-bdec288c36c7', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694376024', '1180411694679024', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('39214d80-9192-11e8-81c2-77562882ef31', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694365025', '1180411694732025', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('3938ece0-9192-11e8-b956-f3e50060a3d6', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694382026', '1180411694260026', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('393ef0e0-9192-11e8-aabe-4b9f460ebc55', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694380027', '1180411694725027', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('3945b700-9192-11e8-8240-e1e1de9b34ea', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694364028', '1180411694400028', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('39540700-9192-11e8-9829-a7cdbf811ac9', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694377029', '1180411694503029', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('39603af0-9192-11e8-b2c2-f53451d7b5aa', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694324030', '1180411694279030', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('396ca7e0-9192-11e8-bc90-09c4cbb864cf', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '184694384031', '1180411694031031', NULL, '2018-07-27 04:43:04', '2018-07-27 04:43:04', NULL),
('3975e4e0-9192-11e8-9960-b129d5c07749', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695390032', '1180511695164032', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39861080-9192-11e8-86c7-85a82b69aaae', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695380033', '1180511695302033', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('398e8740-9192-11e8-8ec8-e167c2a52a31', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695371034', '1180511695358034', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39945e60-9192-11e8-a3e9-b170e7193b19', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695382035', '1180511695634035', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('399a5fe0-9192-11e8-a64c-dbe390e9a552', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695310036', '1180511695882036', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39a03a50-9192-11e8-b4de-03e76049e81b', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695337037', '1180511695478037', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39a639a0-9192-11e8-84ae-0d40bebc3077', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695348038', '1180511695879038', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39b06200-9192-11e8-992a-cbcc05945439', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695395039', '1180511695453039', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39b9b120-9192-11e8-a741-5fa41482a247', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695378040', '1180511695508040', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39c151a0-9192-11e8-9e4a-bb28d6afd5e1', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695357041', '1180511695044041', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39c73b40-9192-11e8-85da-fbd13bb5e4a1', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695387042', '1180511695651042', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39cd29d0-9192-11e8-a50b-57883335963f', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695377043', '1180511695064043', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39d31780-9192-11e8-b816-9fcbc2c910d7', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695336044', '1180511695157044', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39d90380-9192-11e8-92f5-73475691f31d', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695322045', '1180511695080045', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39def040-9192-11e8-8de0-af6a88691829', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695352046', '1180511695967046', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39e90720-9192-11e8-9a23-b390a0dc691a', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695339047', '1180511695602047', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39ef0f20-9192-11e8-98ee-fd9b46f7040a', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695365048', '1180511695745048', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39f4e0a0-9192-11e8-9cea-2d0c94f701a8', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695389049', '1180511695193049', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('39fae280-9192-11e8-be4d-d94c407708b3', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695324050', '1180511695190050', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('3a00c080-9192-11e8-8972-09b9ebc97539', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695317051', '1180511695634051', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('3a06bdd0-9192-11e8-8149-792b95d7c0c3', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695342052', '1180511695457052', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('3a0c9640-9192-11e8-96e7-fb932f9f57c4', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '185695337053', '1180511695468053', NULL, '2018-07-27 04:43:05', '2018-07-27 04:43:05', NULL),
('3a1299a0-9192-11e8-b6e6-a73893dad870', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696364054', '1180611696909054', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a1871f0-9192-11e8-b101-9d262f69c516', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696386055', '1180611696391055', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a1e7140-9192-11e8-b9dc-0b9c10e97824', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696322056', '1180611696137056', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a362860-9192-11e8-a0a8-59e145b0b5c7', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696318057', '1180611696393057', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a3c10c0-9192-11e8-a374-a54528726e98', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696377058', '1180611696717058', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a420320-9192-11e8-b5bf-b3e1b9ced923', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696395059', '1180611696226059', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a4ddc60-9192-11e8-b676-9f9274cbfc6d', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696325060', '1180611696727060', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a53b3f0-9192-11e8-a413-0906bbbb9684', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696373061', '1180611696657061', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a5d19f0-9192-11e8-a8f7-dd7f93120b74', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696303062', '1180611696592062', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a62ee60-9192-11e8-8e4c-ed144cd66e9e', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696354063', '1180611696136063', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a6b7e80-9192-11e8-a93a-67ad7921b13b', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696392064', '1180611696093064', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a767f80-9192-11e8-bad9-9b615f448dfb', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696395065', '1180611696090065', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a80a840-9192-11e8-a97b-99c9d49a914e', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696307066', '1180611696454066', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a867040-9192-11e8-9ce4-fdd4d5799a65', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696374067', '1180611696272067', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a8ef920-9192-11e8-b3a0-03e07d6e8c57', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696317068', '1180611696962068', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a94f910-9192-11e8-8aa7-ff5bf95a5677', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696385069', '1180611696863069', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3a9d7420-9192-11e8-aab3-f3b8a328d062', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696328070', '1180611696896070', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3aa33a20-9192-11e8-84a6-0bf0fe23bda3', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '186696397071', '1180611696770071', NULL, '2018-07-27 04:43:06', '2018-07-27 04:43:06', NULL),
('3aa94f80-9192-11e8-830b-433344f254d4', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697305072', '1180711697272072', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3aaf12f0-9192-11e8-9434-4bee1867b9d4', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697311073', '1180711697091073', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3ab52d00-9192-11e8-8ffe-1b1962c6dce3', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697346074', '1180711697617074', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3abaedc0-9192-11e8-9abc-8b37ae31b3b9', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697391075', '1180711697333075', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3ac103b0-9192-11e8-9fb0-933af44fe80e', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697364076', '1180711697247076', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3ac6c780-9192-11e8-9eed-c99cac105e84', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697392077', '1180711697725077', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3acce1e0-9192-11e8-82a7-1d506e9c582a', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697386078', '1180711697958078', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3ad2a340-9192-11e8-821c-39b29c584fdc', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697319079', '1180711697780079', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3ad8b940-9192-11e8-a7c0-679f323c626e', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697391080', '1180711697617080', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3ade7cc0-9192-11e8-a034-f517c2ed1129', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697399081', '1180711697166081', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3ae49440-9192-11e8-bf76-4f61290902c1', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697389082', '1180711697268082', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3aea5860-9192-11e8-ab93-ef0864fe70ba', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697337083', '1180711697350083', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3af06c80-9192-11e8-b2ec-4f61fc5efd2a', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697375084', '1180711697305084', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3af63310-9192-11e8-901c-7b3252f8714b', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697353085', '1180711697081085', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3afc4780-9192-11e8-b246-c5f7c9ad32fe', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697342086', '1180711697262086', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b020c60-9192-11e8-a64a-010d07785090', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697391087', '1180711697356087', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b082160-9192-11e8-85b5-6d6bbc950677', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697333088', '1180711697477088', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b0de8a0-9192-11e8-9055-fd039de10b09', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697329089', '1180711697840089', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b13fb70-9192-11e8-b350-995e9733f86b', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697339090', '1180711697866090', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b1b70a0-9192-11e8-a6af-d790868c5efd', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697322091', '1180711697488091', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b218720-9192-11e8-8e77-c335a748f915', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697331092', '1180711697983092', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b274ae0-9192-11e8-977a-c5c0998d273d', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697388093', '1180711697129093', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b2d6180-9192-11e8-a319-d573ab11bdc7', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697311094', '1180711697411094', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b332600-9192-11e8-af6c-d9edd6b4b16d', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697300095', '1180711697421095', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b3af350-9192-11e8-848b-3b3585595b7c', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '187697351096', '1180711697962096', NULL, '2018-07-27 04:43:07', '2018-07-27 04:43:07', NULL),
('3b40b2e0-9192-11e8-b7c1-8f3ab9b2cdab', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '188698327097', '1180811698681097', NULL, '2018-07-27 04:43:08', '2018-07-27 04:43:08', NULL),
('3b487a70-9192-11e8-9c14-a5d16678a936', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '188698345098', '1180811698573098', NULL, '2018-07-27 04:43:08', '2018-07-27 04:43:08', NULL),
('3b4e3dd0-9192-11e8-9ae1-59ab04b9706a', '38652d90-9192-11e8-a1b2-1fd8bfe4bd95', '188698345099', '1180811698124099', NULL, '2018-07-27 04:43:08', '2018-07-27 04:43:08', NULL),
('4631ff50-8a9b-11e8-88a4-4b3432a199bc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923318000', '1181303923755000', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46324e20-8a9b-11e8-a71a-2926f325a283', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923360001', '1181303923546001', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4632a660-8a9b-11e8-b6bd-7748c79a5b2d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923386002', '1181303923049002', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4632f660-8a9b-11e8-a7fb-c39390ef45aa', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923369003', '1181303923378003', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46334b70-8a9b-11e8-8603-3fec265fd46b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923397004', '1181303923872004', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463381a0-8a9b-11e8-83fe-5bbf1c8a0b30', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923314005', '1181303923958005', '51aec9f0-8b27-11e8-a7cf-c96bd96ef905', '2018-07-18 08:00:13', '2018-07-19 00:42:42', NULL),
('4633bf10-8a9b-11e8-95bc-cb8eba60b7d1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923367006', '1181303923716006', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463417d0-8a9b-11e8-824b-6f6f8412246f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923326007', '1181303923890007', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463456a0-8a9b-11e8-84a7-c9b7f9396062', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923364008', '1181303923976008', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4634ab50-8a9b-11e8-a598-7b1b52515c3b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923355009', '1181303923849009', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4634e2a0-8a9b-11e8-b32e-ffcd01eb0d89', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923323010', '1181303923458010', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46353670-8a9b-11e8-95e7-43e8e88daa11', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923385011', '1181303923012011', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463572e0-8a9b-11e8-a00a-55b6f6c5bee7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923309012', '1181303923690012', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4635be70-8a9b-11e8-a8a7-5b35d4689701', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923373013', '1181303923996013', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4635f500-8a9b-11e8-9a85-2b04e6af2605', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923312014', '1181303923964014', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46362e20-8a9b-11e8-927b-035a258e951b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923310015', '1181303923636015', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46370f10-8a9b-11e8-98ca-4d5c1d01d801', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923368016', '1181303923224016', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46375b40-8a9b-11e8-b02d-01be22dcdcf9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923393017', '1181303923308017', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4637af80-8a9b-11e8-aebb-b1fbc8e135dd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923337018', '1181303923190018', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4637f210-8a9b-11e8-8d95-a93f2c55ae32', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923301019', '1181303923248019', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463848a0-8a9b-11e8-bac2-3f7f8cf863f6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923371020', '1181303923510020', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463886c0-8a9b-11e8-84cb-7d3c74edb150', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923318021', '1181303923829021', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4638d9c0-8a9b-11e8-8913-1f6dae2f7943', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923333022', '1181303923849022', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46395850-8a9b-11e8-9550-275161204501', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923329023', '1181303923365023', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4639b510-8a9b-11e8-8adc-4b38ea8fbc74', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923370024', '1181303923372024', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463a0c60-8a9b-11e8-b920-b578dcb7c42d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923315025', '1181303923363025', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463a4fb0-8a9b-11e8-9cb8-2d234e784b63', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923303026', '1181303923774026', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463aad80-8a9b-11e8-bc4e-9514640a8ecb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923322027', '1181303923218027', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463ae310-8a9b-11e8-8452-ffafbb2d9878', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923307028', '1181303923353028', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463b30a0-8a9b-11e8-8d46-47ff06582184', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923331029', '1181303923556029', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463b7b40-8a9b-11e8-b70d-5be8e30aee27', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923357030', '1181303923452030', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463bf220-8a9b-11e8-86d9-ffbd0a94ea0f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923315031', '1181303923855031', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463c3a00-8a9b-11e8-be76-39728868c9c9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923351032', '1181303923315032', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463c91c0-8a9b-11e8-b046-ef79ecb36a07', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923371033', '1181303923083033', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463cd300-8a9b-11e8-b41c-7d6f67693e40', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923324034', '1181303923937034', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463d2d00-8a9b-11e8-a6eb-e970acab8e04', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923364035', '1181303923274035', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463d6130-8a9b-11e8-8363-a7e20a7e07d2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923308036', '1181303923921036', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463dad30-8a9b-11e8-9c31-a912d28cf74f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923385037', '1181303923871037', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463df840-8a9b-11e8-913c-d1863f50e449', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923371038', '1181303923959038', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463e5740-8a9b-11e8-b5df-6ddb97c5ee90', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923399039', '1181303923767039', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463e9ee0-8a9b-11e8-8fb8-435ad1a98e27', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923329040', '1181303923206040', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463eeae0-8a9b-11e8-93b0-e305ba51f56f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923345041', '1181303923154041', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463f2120-8a9b-11e8-8edd-c9985bfedc51', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923304042', '1181303923690042', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463f75f0-8a9b-11e8-992d-edbb38183e6f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923358043', '1181303923568043', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463fb1c0-8a9b-11e8-8ee0-490cc5cfd92e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923334044', '1181303923449044', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('463fe300-8a9b-11e8-8633-4f82567c6c37', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923332045', '1181303923069045', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464033c0-8a9b-11e8-a926-4fb825f4d084', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923358046', '1181303923681046', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46407460-8a9b-11e8-a08d-2d9ba09dc15f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923321047', '1181303923390047', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4640d860-8a9b-11e8-baa9-9faff3eb3a07', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923308048', '1181303923431048', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46411e10-8a9b-11e8-ba1c-d592da3a54c8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923335049', '1181303923737049', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46417700-8a9b-11e8-af7c-f1482971e3aa', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923348050', '1181303923693050', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4641b3d0-8a9b-11e8-a098-65a6aa360fe8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923385051', '1181303923071051', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46421420-8a9b-11e8-a8cd-dbcf39ac0506', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923396052', '1181303923958052', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46425ec0-8a9b-11e8-8b44-c9b55d17e61e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923370053', '1181303923701053', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4642b560-8a9b-11e8-9745-9d0b29d61cfa', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923366054', '1181303923042054', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4642f650-8a9b-11e8-9f93-7718c89e8b99', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923316055', '1181303923156055', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46434d30-8a9b-11e8-bb0e-01b7e4036c59', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923315056', '1181303923943056', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46438d40-8a9b-11e8-9bd8-8fbdd3269e35', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923300057', '1181303923975057', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4643e490-8a9b-11e8-83b9-2f4eed73149e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923329058', '1181303923616058', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46441f70-8a9b-11e8-ae04-419409511927', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923323059', '1181303923137059', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4644bb80-8a9b-11e8-b42e-23b4e25078ee', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923385060', '1181303923028060', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46451980-8a9b-11e8-85ec-317ab6c729e8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923334061', '1181303923344061', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46455310-8a9b-11e8-8d24-3de017fcaa4f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923366062', '1181303923278062', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4645b660-8a9b-11e8-adbb-8f45dfc973bb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923378063', '1181303923472063', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46461010-8a9b-11e8-bdd4-31ff2d90cd2f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923385064', '1181303923757064', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46466dc0-8a9b-11e8-a4f1-45c068500698', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923342065', '1181303923899065', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4646c9c0-8a9b-11e8-ac4b-b7954b15592b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923366066', '1181303923325066', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46470840-8a9b-11e8-af4a-03c221a32ee3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923352067', '1181303923283067', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46474ac0-8a9b-11e8-88a8-f736e1638615', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923352068', '1181303923055068', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4647a500-8a9b-11e8-997c-e3508ac8de23', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923338069', '1181303923716069', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4647e130-8a9b-11e8-a391-73905995c4b5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923378070', '1181303923445070', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46484ff0-8a9b-11e8-9432-47ea5c9d5d49', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923355071', '1181303923110071', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4648bbd0-8a9b-11e8-b2f1-1be5745ba36c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923381072', '1181303923407072', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4648f500-8a9b-11e8-a033-592b131ca41b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923319073', '1181303923458073', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464945f0-8a9b-11e8-a95a-fb3fb4b1dace', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923359074', '1181303923431074', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46497d80-8a9b-11e8-b195-6f52e7cf3f32', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923363075', '1181303923488075', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4649ba10-8a9b-11e8-be01-759852ab1a25', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923399076', '1181303923009076', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464a0680-8a9b-11e8-a28d-7f8f232411ed', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923328077', '1181303923068077', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464a3e90-8a9b-11e8-9360-917bc6c3fe5a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923396078', '1181303923022078', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464a8f80-8a9b-11e8-a6d5-e96296254c49', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923364079', '1181303923839079', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464acd90-8a9b-11e8-a7fe-bdd449b5a647', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923304080', '1181303923922080', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464b37e0-8a9b-11e8-bb71-c7b954798f52', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923323081', '1181303923941081', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464b7a60-8a9b-11e8-bed8-7f093fad9272', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923301082', '1181303923990082', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464bcf90-8a9b-11e8-bc6d-7f9f71669f4a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923398083', '1181303923315083', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464c18a0-8a9b-11e8-862a-1df7ae5eabe3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923339084', '1181303923609084', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL);
INSERT INTO `tbl_tiket` (`id`, `id_cetak_tiket`, `kap`, `pin`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('464c7bb0-8a9b-11e8-9696-cd89feb73752', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923392085', '1181303923348085', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464cf1b0-8a9b-11e8-9465-8b67ee1a846b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923366086', '1181303923951086', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464d4bf0-8a9b-11e8-9395-9704e806c23f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923372087', '1181303923997087', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464db590-8a9b-11e8-b13e-bb7d430df25d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923399088', '1181303923808088', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464de980-8a9b-11e8-a395-136bf5edd4c3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923315089', '1181303923376089', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464e7e30-8a9b-11e8-a382-a35a155eb1e6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923380090', '1181303923648090', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464edb00-8a9b-11e8-a626-c9c327112111', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923319091', '1181303923858091', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464f19b0-8a9b-11e8-986b-09a9f8222a93', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923386092', '1181303923834092', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464f7e10-8a9b-11e8-adbf-4f7d4f40eb74', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923353093', '1181303923422093', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('464fb800-8a9b-11e8-90b1-bdc0643b4788', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923364094', '1181303923150094', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46502000-8a9b-11e8-becc-296516ffa362', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923317095', '1181303923536095', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46505d10-8a9b-11e8-b049-f97c2064a7e3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923392096', '1181303923928096', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4650ab10-8a9b-11e8-8124-49981d3c984b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923306097', '1181303923846097', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4650e560-8a9b-11e8-b495-fb415761b65e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923385098', '1181303923697098', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465138d0-8a9b-11e8-8e0f-ef6f6f4b1e9e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923357099', '1181303923380099', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46517f50-8a9b-11e8-9817-3bc9648b8aef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923366100', '1181303923365100', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4651d980-8a9b-11e8-ab3e-af0bccc09ad5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923380101', '1181303923569101', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46522170-8a9b-11e8-a717-4f0fcdf5c340', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923307102', '1181303923357102', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46527f90-8a9b-11e8-bba7-4b3ece343738', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923386103', '1181303923592103', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4652d100-8a9b-11e8-9dd6-6be8239ea5b3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923379104', '1181303923856104', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46532a50-8a9b-11e8-995b-0da627b8a59f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923336105', '1181303923193105', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46536ac0-8a9b-11e8-84a8-4562c9e3ea03', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923363106', '1181303923296106', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4653c1c0-8a9b-11e8-bdec-6123737e89db', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923365107', '1181303923754107', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46540510-8a9b-11e8-a770-29783a76fa35', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923320108', '1181303923729108', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46545c80-8a9b-11e8-96ac-2feeae1d944b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923344109', '1181303923611109', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4654a0a0-8a9b-11e8-abaa-1d0203e50de6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923301110', '1181303923599110', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46550c40-8a9b-11e8-ae62-41cf7fefc90b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923319111', '1181303923406111', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46557700-8a9b-11e8-93da-03e79e2f53cb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923382112', '1181303923912112', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4655b2f0-8a9b-11e8-b76a-0d4ef2b041b6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923360113', '1181303923715113', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46562340-8a9b-11e8-a1ce-ad2414e53d9c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923336114', '1181303923399114', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46566560-8a9b-11e8-8a85-21c247d0fc78', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923376115', '1181303923061115', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4656c830-8a9b-11e8-815d-07798ff30ad3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923334116', '1181303923181116', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46575e10-8a9b-11e8-a263-2fa3df72a423', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923383117', '1181303923507117', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4657ac50-8a9b-11e8-9194-93e7e785947c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923338118', '1181303923398118', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46580a90-8a9b-11e8-a28c-9f7a5208aea6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923307119', '1181303923578119', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46585570-8a9b-11e8-922b-3391f02d8d7c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923313120', '1181303923893120', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4658b310-8a9b-11e8-95c7-41f21fd1eba1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923367121', '1181303923485121', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4658fd20-8a9b-11e8-9246-81b6f0e63fde', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923305122', '1181303923338122', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46594ed0-8a9b-11e8-a158-bf6b234298e9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923333123', '1181303923142123', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('46598180-8a9b-11e8-a294-d7cfe5f62e75', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923376124', '1181303923918124', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('4659cc50-8a9b-11e8-9341-d7652b7735f6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923349125', '1181303923687125', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465a09f0-8a9b-11e8-93b3-3f35e06a4950', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923329126', '1181303923479126', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465a67a0-8a9b-11e8-8139-4fa8fda691f8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923323127', '1181303923934127', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465aa7d0-8a9b-11e8-83f1-1d18f287ce4c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923362128', '1181303923069128', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465b0670-8a9b-11e8-9904-037eddca849e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923360129', '1181303923580129', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465b5950-8a9b-11e8-8d1a-c5d3342f8cfd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923392130', '1181303923209130', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465bb180-8a9b-11e8-b39a-8b6e7bd99098', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923389131', '1181303923477131', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465bea60-8a9b-11e8-aba0-4727f7582b3d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923384132', '1181303923551132', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465c3ad0-8a9b-11e8-b67f-53b05bd65efa', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923340133', '1181303923954133', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465c83d0-8a9b-11e8-abe6-4dcbe98129dd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923365134', '1181303923014134', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465cf1e0-8a9b-11e8-8516-ff565bc99933', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923302135', '1181303923228135', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465d3870-8a9b-11e8-8a63-bb5382bb830c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923322136', '1181303923209136', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465d9430-8a9b-11e8-b55c-53f9b461ff8a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923305137', '1181303923232137', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465dd070-8a9b-11e8-80fa-6b65fdd11313', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923321138', '1181303923216138', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465e3100-8a9b-11e8-90e5-5b279cb9d788', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923381139', '1181303923485139', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465e6710-8a9b-11e8-9470-2b43aae7cdad', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923331140', '1181303923873140', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465ebe90-8a9b-11e8-a1cc-c3de29ca3cf8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923380141', '1181303923504141', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465efd00-8a9b-11e8-b50d-61ec49b78c7e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923385142', '1181303923439142', NULL, '2018-07-18 08:00:13', '2018-07-18 08:00:13', NULL),
('465f5f80-8a9b-11e8-8d40-09c606f0287f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '113923393143', '1181303923145143', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('465fa910-8a9b-11e8-8053-c9e40267d496', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924337144', '1181403924741144', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('465ff790-8a9b-11e8-b4ef-0f7dc4a5f85e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924347145', '1181403924394145', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46604840-8a9b-11e8-8c8a-4d7587595538', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924349146', '1181403924271146', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4660ae40-8a9b-11e8-92dc-61fd2381deab', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924312147', '1181403924201147', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466111e0-8a9b-11e8-b154-715dc4822025', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924327148', '1181403924655148', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46615600-8a9b-11e8-afd6-ad6e7d80d4cb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924355149', '1181403924715149', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4661ac60-8a9b-11e8-b7ec-375b9b31b50f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924377150', '1181403924170150', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4661ecb0-8a9b-11e8-8b2d-0580205e0abc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924321151', '1181403924386151', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4662da40-8a9b-11e8-a905-9da85d32af56', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924383152', '1181403924806152', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46635360-8a9b-11e8-b784-8f69fbab576e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924366153', '1181403924539153', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4663c5a0-8a9b-11e8-a5f9-e10370d8c168', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303154', '1181403924758154', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46643730-8a9b-11e8-95ef-e105a36d9baa', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924351155', '1181403924687155', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46648f80-8a9b-11e8-8bce-bd48fa01bc19', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924395156', '1181403924445156', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4664f7f0-8a9b-11e8-a383-7bfcb3e5eeb3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924340157', '1181403924942157', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466554e0-8a9b-11e8-b548-0da9f3ce74c8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924381158', '1181403924180158', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46659bb0-8a9b-11e8-afad-9be82040fe78', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311159', '1181403924712159', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4665f680-8a9b-11e8-b7c1-a737414851af', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924302160', '1181403924537160', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46663410-8a9b-11e8-aad6-41694ec419c4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924381161', '1181403924467161', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466687d0-8a9b-11e8-adae-5596e33b5927', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924313162', '1181403924761162', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4666d700-8a9b-11e8-93b4-9742cfae2866', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924321163', '1181403924052163', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46674050-8a9b-11e8-8838-c173a21150e6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924390164', '1181403924031164', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46677ff0-8a9b-11e8-bbfa-2d02efc292fe', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924307165', '1181403924769165', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4667dd70-8a9b-11e8-9362-ad5c9c0aedf1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924378166', '1181403924512166', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46682260-8a9b-11e8-a497-39c5afeb8928', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924347167', '1181403924128167', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46688720-8a9b-11e8-828c-d75b4afcb97c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924346168', '1181403924159168', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4668d3f0-8a9b-11e8-8aa4-8f2443680a54', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924355169', '1181403924689169', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466944e0-8a9b-11e8-bee7-73c1558b484e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924319170', '1181403924830170', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4669b9f0-8a9b-11e8-9a8c-bb82022c80f4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924353171', '1181403924835171', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4669eca0-8a9b-11e8-a972-718dd5201676', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924354172', '1181403924989172', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466a3a00-8a9b-11e8-98aa-f1e3ab507b1e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924350173', '1181403924173173', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466a70b0-8a9b-11e8-a5c4-99ec9932cf5e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924344174', '1181403924020174', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466acc60-8a9b-11e8-aade-3db6ff6c6cfd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924305175', '1181403924887175', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466b0fd0-8a9b-11e8-82ab-174931311331', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924319176', '1181403924287176', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466b4630-8a9b-11e8-8fa8-d56c63de74f1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924331177', '1181403924929177', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466b99d0-8a9b-11e8-aa56-7bc38d0ace6e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924307178', '1181403924053178', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466c92e0-8a9b-11e8-babd-7d85a3fe79af', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924359179', '1181403924073179', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466cf1e0-8a9b-11e8-b972-173c3889a380', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924387180', '1181403924650180', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466d69c0-8a9b-11e8-bf9e-89c54b63c1cd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924359181', '1181403924074181', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466db690-8a9b-11e8-bb0b-83268b3015b9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924333182', '1181403924688182', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466e10b0-8a9b-11e8-b998-03b68a2c0d5e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924306183', '1181403924948183', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466e7d00-8a9b-11e8-bc06-f38f220b7871', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924324184', '1181403924956184', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466eb5a0-8a9b-11e8-9332-8ff45d3f62f8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924364185', '1181403924587185', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466ee650-8a9b-11e8-9c2a-e9e2b59fff7e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924368186', '1181403924394186', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466f2ac0-8a9b-11e8-b147-8f3c1bb58d20', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924353187', '1181403924765187', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466f5aa0-8a9b-11e8-9dba-8116a2aa6f37', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924379188', '1181403924600188', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('466fb280-8a9b-11e8-a8fe-8395bb1880e6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924300189', '1181403924002189', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46704ac0-8a9b-11e8-914f-79a2b33ce3dd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924339190', '1181403924290190', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46708730-8a9b-11e8-a911-f7c7ad0df597', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924388191', '1181403924473191', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4670f380-8a9b-11e8-bddf-ab5388033193', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924345192', '1181403924163192', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46714d00-8a9b-11e8-bba9-c19e108a2a8c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924327193', '1181403924233193', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46719bf0-8a9b-11e8-b1ed-4d88ef25c186', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924361194', '1181403924733194', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46721b80-8a9b-11e8-932f-9303ae016ef0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924315195', '1181403924915195', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46727a40-8a9b-11e8-8da8-6154e7968c6c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924355196', '1181403924853196', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4672f560-8a9b-11e8-a283-eb00b1b46c5d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924377197', '1181403924024197', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46733ac0-8a9b-11e8-a7ec-25bc55b1c002', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924397198', '1181403924038198', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4673b3e0-8a9b-11e8-bcac-17a5d440f812', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924365199', '1181403924803199', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46741860-8a9b-11e8-90f3-61b1bd6af969', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924367200', '1181403924676200', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46746c70-8a9b-11e8-ac50-dff12452ef77', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924327201', '1181403924665201', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4674d200-8a9b-11e8-a72d-694a274075f7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924306202', '1181403924826202', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46752f80-8a9b-11e8-a557-03caa103de16', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924342203', '1181403924151203', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4675a560-8a9b-11e8-80f5-7d56ae6e30f9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924373204', '1181403924625204', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46761080-8a9b-11e8-9e66-71e40ee31f3a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924327205', '1181403924495205', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46767120-8a9b-11e8-9fb3-a518715783bc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924321206', '1181403924437206', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4676b1e0-8a9b-11e8-a8ef-f15151d37b71', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924360207', '1181403924176207', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467713f0-8a9b-11e8-92e1-b3da112793d0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924340208', '1181403924479208', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46776250-8a9b-11e8-8b85-0fa747f358df', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924373209', '1181403924916209', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4677c330-8a9b-11e8-b655-7dc071cd8135', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924367210', '1181403924508210', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46780d70-8a9b-11e8-b6de-f52305f66943', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924385211', '1181403924280211', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46786d40-8a9b-11e8-bcb2-4fa0e0977f5a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924361212', '1181403924939212', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4678b5c0-8a9b-11e8-9692-f5b767597f6d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924399213', '1181403924046213', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46791f40-8a9b-11e8-9242-af04f1ffcc81', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924369214', '1181403924336214', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46797420-8a9b-11e8-949e-73315912aceb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924395215', '1181403924094215', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4679aab0-8a9b-11e8-8492-47ca3d9075c2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924315216', '1181403924631216', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4679e460-8a9b-11e8-ac38-73276583f66d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924375217', '1181403924849217', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467a2db0-8a9b-11e8-92e0-0b4ca349c612', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924371218', '1181403924897218', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467a5d80-8a9b-11e8-8e3e-15825f28c1d8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924383219', '1181403924709219', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467aada0-8a9b-11e8-9967-59cbcc233e67', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303220', '1181403924300220', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467ae4c0-8a9b-11e8-b7ab-d54d5c708913', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924345221', '1181403924781221', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467b18a0-8a9b-11e8-a404-4718338a8336', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924304222', '1181403924541222', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467b63c0-8a9b-11e8-ac56-93a59fd3a9a2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924332223', '1181403924424223', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467b9a90-8a9b-11e8-b76a-4f1cce4efab8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924331224', '1181403924373224', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467beb70-8a9b-11e8-9ba6-6fc65efe5b37', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924385225', '1181403924880225', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467c25a0-8a9b-11e8-9fb3-a36406d05f63', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924320226', '1181403924152226', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467c6380-8a9b-11e8-a24b-3fd8bbbc97ec', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924326227', '1181403924299227', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467cbbc0-8a9b-11e8-9988-ab17f0146595', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924399228', '1181403924012228', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467d1d80-8a9b-11e8-9d1f-efb77ba1c85f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924346229', '1181403924540229', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467d5c20-8a9b-11e8-bcf5-7d01aabca25a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303230', '1181403924481230', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467d9b80-8a9b-11e8-bc43-ff5c7da6c1b5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924379231', '1181403924764231', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467df9f0-8a9b-11e8-a8a1-f98f030c3a29', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924327232', '1181403924413232', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467e8e60-8a9b-11e8-98ce-e73b453a706a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924397233', '1181403924994233', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467ed9c0-8a9b-11e8-b1ec-512b2b3b7945', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924323234', '1181403924135234', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467f3fe0-8a9b-11e8-bbef-ef1293aa3f85', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924382235', '1181403924978235', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467fac30-8a9b-11e8-a6b3-479669ffaf47', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311236', '1181403924682236', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('467ff110-8a9b-11e8-a11d-43bf032f86da', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311237', '1181403924658237', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46808c00-8a9b-11e8-94bf-bb30019a5d35', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924352238', '1181403924164238', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4680f200-8a9b-11e8-a856-4d5f97ba844f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924308239', '1181403924687239', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46813320-8a9b-11e8-aed4-19d867cac5c3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303240', '1181403924567240', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46819940-8a9b-11e8-9733-7bcdd3b4353a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924362241', '1181403924575241', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4681dc80-8a9b-11e8-b394-bd2aa9352238', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924309242', '1181403924960242', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468234e0-8a9b-11e8-9726-0b73f3918467', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924386243', '1181403924971243', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46827aa0-8a9b-11e8-a2b7-1941f227cec5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924327244', '1181403924483244', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4682d160-8a9b-11e8-8b23-e1dc6eda4d99', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924302245', '1181403924938245', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46831640-8a9b-11e8-90d4-9125e9e5698c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924371246', '1181403924021246', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46836870-8a9b-11e8-920f-4948553824b1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924340247', '1181403924758247', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46839ac0-8a9b-11e8-8798-41a8d18f2965', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924346248', '1181403924234248', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4683f030-8a9b-11e8-b959-a11a7104cfb3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924388249', '1181403924024249', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46842c20-8a9b-11e8-b208-c5584f46c025', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311250', '1181403924395250', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46848520-8a9b-11e8-8691-f964dac6aec4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924348251', '1181403924897251', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4684c8a0-8a9b-11e8-b01c-f792b439d869', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924344252', '1181403924475252', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46852590-8a9b-11e8-b1d6-0baeee365ba8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924345253', '1181403924369253', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46856990-8a9b-11e8-b1f3-f36b12d56d34', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924325254', '1181403924823254', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4685ba40-8a9b-11e8-bf2e-535868a9f3ef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924356255', '1181403924887255', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4685eb70-8a9b-11e8-bacf-3b354a2ca84e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924307256', '1181403924757256', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46862280-8a9b-11e8-a86f-37e0cb11c4cb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924308257', '1181403924614257', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46867b70-8a9b-11e8-8ca5-790ac87a991a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924354258', '1181403924489258', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4686c400-8a9b-11e8-9ef4-b99a9e808dd5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924300259', '1181403924463259', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468717e0-8a9b-11e8-bae2-4bc2a64756ba', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924389260', '1181403924877260', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46874b50-8a9b-11e8-b6f0-4f6c08cfdf7a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924387261', '1181403924335261', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46879d10-8a9b-11e8-935d-9fa3c2127a05', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924316262', '1181403924320262', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46888bc0-8a9b-11e8-8098-e5debd66b788', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924393263', '1181403924259263', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4688ec80-8a9b-11e8-81cc-77692d061481', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924340264', '1181403924412264', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46895630-8a9b-11e8-b76d-db7d20d6ab12', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924370265', '1181403924902265', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4689ac90-8a9b-11e8-bd08-87fc43a61292', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303266', '1181403924903266', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468a0970-8a9b-11e8-b04c-ad6321af3acd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924397267', '1181403924511267', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468a5300-8a9b-11e8-92ed-1759c9654a15', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924315268', '1181403924812268', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468ac280-8a9b-11e8-8265-238c63a625ae', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924301269', '1181403924294269', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468b2660-8a9b-11e8-b052-f1dc68563ebc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924332270', '1181403924657270', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468b6310-8a9b-11e8-80c2-db2778e31fe6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924396271', '1181403924724271', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468ba5b0-8a9b-11e8-bb88-8d5439528ca6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924398272', '1181403924149272', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468c05d0-8a9b-11e8-9951-dbdb7244e5a7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924334273', '1181403924519273', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468c6970-8a9b-11e8-ac92-335104c6d861', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924302274', '1181403924114274', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468caa00-8a9b-11e8-aec8-67460b9ea94e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924339275', '1181403924277275', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468d1850-8a9b-11e8-ba0a-2fe58aa58f08', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924397276', '1181403924663276', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468d5860-8a9b-11e8-81e3-8fc5e6880d9c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924308277', '1181403924720277', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468da400-8a9b-11e8-925c-ef6925e566b4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924340278', '1181403924871278', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468e0d20-8a9b-11e8-b0a5-47dcde96aa39', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311279', '1181403924360279', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468e7750-8a9b-11e8-a93f-bdb7032cc048', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924382280', '1181403924471280', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468eebb0-8a9b-11e8-9f5f-a91aace533cc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924351281', '1181403924970281', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468f3050-8a9b-11e8-90df-65c232d1d1c5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924301282', '1181403924542282', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468f8fa0-8a9b-11e8-962f-472a9c1140dd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924324283', '1181403924414283', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('468fcf50-8a9b-11e8-8a87-7bc9a482a570', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924305284', '1181403924172284', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46901b90-8a9b-11e8-8e13-37a9dbd2dab6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924308285', '1181403924809285', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469051a0-8a9b-11e8-b852-3d9f5733dd7e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924323286', '1181403924393286', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4690b500-8a9b-11e8-82f7-659e358c260b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924368287', '1181403924903287', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46919e00-8a9b-11e8-a97e-1dbd1a20803c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924337288', '1181403924351288', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46920280-8a9b-11e8-920c-979e53c45a78', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924369289', '1181403924586289', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46924040-8a9b-11e8-9c20-57e92050c64b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924358290', '1181403924871290', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469297f0-8a9b-11e8-a2c1-230b1eb9d357', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924312291', '1181403924256291', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4692dfc0-8a9b-11e8-baa4-c95ecb0f910a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924338292', '1181403924445292', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46933dc0-8a9b-11e8-8011-670f78ac5acd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924326293', '1181403924967293', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46937c00-8a9b-11e8-9b39-511823edc9bf', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924363294', '1181403924501294', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4693e0d0-8a9b-11e8-8bd5-cfd6113f5f50', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924335295', '1181403924139295', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46941cc0-8a9b-11e8-8bd8-2d46075b5556', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924376296', '1181403924465296', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469476c0-8a9b-11e8-9990-9ddd783b031d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924382297', '1181403924385297', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4694c500-8a9b-11e8-8038-7793b0a66b7d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924388298', '1181403924785298', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46951cc0-8a9b-11e8-9954-e1a95e80255c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924322299', '1181403924371299', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46955400-8a9b-11e8-821a-978c31d7fae7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924390300', '1181403924643300', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4695ae50-8a9b-11e8-b744-f7a621efbc41', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924386301', '1181403924783301', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4695f620-8a9b-11e8-86e4-05f6fa66685f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924393302', '1181403924115302', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46964990-8a9b-11e8-a236-c917797b152a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924319303', '1181403924102303', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46968720-8a9b-11e8-898b-cb71100bb988', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924362304', '1181403924655304', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4696dee0-8a9b-11e8-812b-1b7af30416b1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924365305', '1181403924692305', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46972f70-8a9b-11e8-9af3-93b3979024ba', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924363306', '1181403924670306', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46979120-8a9b-11e8-9078-31408a1d6526', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924317307', '1181403924365307', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4697cb70-8a9b-11e8-8f45-dbe22a389b93', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924366308', '1181403924524308', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46982b10-8a9b-11e8-8698-21cc5c7c69d2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924357309', '1181403924558309', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46987100-8a9b-11e8-b339-b911eae4b97b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924381310', '1181403924609310', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4698c9e0-8a9b-11e8-803f-17a7a1ce641f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924357311', '1181403924993311', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4698fd00-8a9b-11e8-82c8-85eded4cee47', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924301312', '1181403924159312', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46995430-8a9b-11e8-9300-3ff4529604ac', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311313', '1181403924550313', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46999580-8a9b-11e8-b329-99bc60b06dda', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924323314', '1181403924657314', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('4699fd40-8a9b-11e8-85a2-a72958ec50cb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924325315', '1181403924933315', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469a3a90-8a9b-11e8-9360-6f11d65b8fc3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924375316', '1181403924646316', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469a8380-8a9b-11e8-a963-fd50e881f744', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924335317', '1181403924741317', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469abd70-8a9b-11e8-8402-2db7e4cb15ad', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924323318', '1181403924611318', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469b1a30-8a9b-11e8-9197-dba4bcd0a9a0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924306319', '1181403924370319', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469b4940-8a9b-11e8-8225-71ca161421f1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924331320', '1181403924418320', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469b75a0-8a9b-11e8-91f1-71741ce9af2b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924365321', '1181403924813321', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469bc270-8a9b-11e8-9bb9-579a27d1a403', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924362322', '1181403924233322', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469c0570-8a9b-11e8-b435-3b40110fce69', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924369323', '1181403924861323', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469c5f30-8a9b-11e8-9050-495b792b9bb3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924360324', '1181403924037324', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469ca100-8a9b-11e8-8317-8d2a6414f5f6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924309325', '1181403924962325', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469cf4d0-8a9b-11e8-b4cb-85a0f9babcf4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924320326', '1181403924349326', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469d3080-8a9b-11e8-adb2-6134f982f711', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924328327', '1181403924474327', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469e2b40-8a9b-11e8-9f86-d1a1fe849405', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924304328', '1181403924110328', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469e80a0-8a9b-11e8-b2d1-d5b26cc66ba9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311329', '1181403924061329', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469ee560-8a9b-11e8-9f09-39f1abb19159', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924310330', '1181403924200330', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469f4de0-8a9b-11e8-9c16-2fcb3303e1f0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924389331', '1181403924066331', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469f8db0-8a9b-11e8-b2ad-853b38703bdb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924313332', '1181403924357332', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('469ff5e0-8a9b-11e8-9b1a-d745c3823703', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924338333', '1181403924734333', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a03c10-8a9b-11e8-a7ed-69b9120483dc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924363334', '1181403924669334', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a08e20-8a9b-11e8-8f7c-6f5ce938f0d5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924391335', '1181403924160335', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a0c670-8a9b-11e8-8fbb-0d5222ab1256', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303336', '1181403924933336', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a0fc10-8a9b-11e8-bd7f-fd4b88750656', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924331337', '1181403924242337', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a157a0-8a9b-11e8-bccb-c3e213f55c60', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924329338', '1181403924033338', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a18e30-8a9b-11e8-83ee-df7800d92784', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924306339', '1181403924552339', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a1d850-8a9b-11e8-91b3-23a58309105d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924336340', '1181403924690340', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a20290-8a9b-11e8-b548-dd85f3ff6c46', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924302341', '1181403924769341', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a23350-8a9b-11e8-85d8-173710fdc5fd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924366342', '1181403924353342', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a291a0-8a9b-11e8-b7f3-311a3bf603bc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924316343', '1181403924312343', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a2d200-8a9b-11e8-b858-9d4c2cf460b4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924385344', '1181403924924344', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a322d0-8a9b-11e8-b6a2-f715c2d07e98', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924328345', '1181403924661345', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a35960-8a9b-11e8-b368-2f0cf08bf34b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924319346', '1181403924568346', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a3bb80-8a9b-11e8-9dfd-9b95bebfb53d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924305347', '1181403924300347', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a42e60-8a9b-11e8-8ac9-b77e5dae71af', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924377348', '1181403924941348', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a49f20-8a9b-11e8-954c-89d07cc06017', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924355349', '1181403924832349', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a4f840-8a9b-11e8-92bf-e7bab5968246', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924344350', '1181403924283350', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a542f0-8a9b-11e8-8a95-73713475e053', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924377351', '1181403924399351', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a597e0-8a9b-11e8-8871-ff8259725282', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924308352', '1181403924955352', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a5da70-8a9b-11e8-854d-e565ce641e9e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924317353', '1181403924572353', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a63fb0-8a9b-11e8-8030-eb9f9575dcd2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924310354', '1181403924038354', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a6b3c0-8a9b-11e8-847a-311c106e903a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924337355', '1181403924877355', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a6f1d0-8a9b-11e8-88a9-f9d890860a5c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924399356', '1181403924783356', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a74660-8a9b-11e8-8a57-cd716731bd00', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924357357', '1181403924270357', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a78230-8a9b-11e8-8917-859b36359371', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924362358', '1181403924213358', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a7e280-8a9b-11e8-b767-452a8fe32a89', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924396359', '1181403924068359', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a822d0-8a9b-11e8-8674-f3f64fea8180', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924315360', '1181403924283360', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a87a10-8a9b-11e8-9bae-d501e51b182f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924336361', '1181403924557361', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a8bcb0-8a9b-11e8-a557-e7b9664b76bc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924320362', '1181403924753362', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a90b10-8a9b-11e8-8878-bfcda215c9cf', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924349363', '1181403924914363', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a93d30-8a9b-11e8-ae2b-6953d4aac5fd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924335364', '1181403924666364', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a96f10-8a9b-11e8-ae64-6be69606d30c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924372365', '1181403924438365', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a9c4c0-8a9b-11e8-b310-3fef64c5d92c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303366', '1181403924846366', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46a9fbb0-8a9b-11e8-b3f7-bd5b43c45092', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924365367', '1181403924023367', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46aa4da0-8a9b-11e8-9f17-2961b7edd72f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924329368', '1181403924416368', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46aa9ae0-8a9b-11e8-9c4c-af1b9a144d96', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924379369', '1181403924838369', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46aaee30-8a9b-11e8-9ed8-6d89c4e95dc1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924316370', '1181403924259370', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL);
INSERT INTO `tbl_tiket` (`id`, `id_cetak_tiket`, `kap`, `pin`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('46ab2050-8a9b-11e8-b3e6-df3e14ea4e1b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924309371', '1181403924981371', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ab63c0-8a9b-11e8-8c59-f168e9676315', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924397372', '1181403924250372', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46abc260-8a9b-11e8-9c32-19d7b7a30c86', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924388373', '1181403924119373', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ac0910-8a9b-11e8-bf50-655d356b42e8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924318374', '1181403924320374', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ac53b0-8a9b-11e8-ab66-5b4d2c6e655a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924377375', '1181403924701375', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ac9600-8a9b-11e8-8a1a-e54acfec7ffe', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924362376', '1181403924726376', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46aced60-8a9b-11e8-8de6-432f241b53ef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924318377', '1181403924909377', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ad2af0-8a9b-11e8-b866-8d8207872a39', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924370378', '1181403924261378', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ad83e0-8a9b-11e8-b3b7-3103c3673c3a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924335379', '1181403924116379', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46adf2d0-8a9b-11e8-9df2-35b223d266cd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924370380', '1181403924120380', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ae4370-8a9b-11e8-914b-033b3b181309', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924321381', '1181403924194381', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46aea310-8a9b-11e8-9396-9949ad028c07', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924391382', '1181403924220382', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46aefb20-8a9b-11e8-a66d-c1b89410a906', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924383383', '1181403924804383', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46af6720-8a9b-11e8-a8fa-95f1e70eff71', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924332384', '1181403924857384', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46afa720-8a9b-11e8-946b-032c8f7bbe37', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924356385', '1181403924111385', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46affd70-8a9b-11e8-a0e8-0f9640d83862', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924379386', '1181403924694386', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b04120-8a9b-11e8-b423-c933d478901d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924362387', '1181403924188387', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b09e10-8a9b-11e8-820b-594756b03fa3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924386388', '1181403924508388', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b0fc40-8a9b-11e8-aa33-ff57067e84a0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924360389', '1181403924862389', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b12e00-8a9b-11e8-9562-4fe01185031a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924361390', '1181403924337390', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b15d10-8a9b-11e8-ad5d-8953d79a5fb2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924337391', '1181403924098391', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b1afc0-8a9b-11e8-8cea-3ffb30112db2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924362392', '1181403924485392', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b1f440-8a9b-11e8-854f-29a52019f052', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924355393', '1181403924905393', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b25140-8a9b-11e8-9dd4-65d458e7d33a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924347394', '1181403924945394', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b298a0-8a9b-11e8-98c3-73f8571565d1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924339395', '1181403924089395', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b2f180-8a9b-11e8-be9c-5f93a0006f0e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924316396', '1181403924650396', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b33920-8a9b-11e8-9f2f-9356f643ab1b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924390397', '1181403924657397', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b3a0c0-8a9b-11e8-a5fe-8b49b08a13f1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924346398', '1181403924874398', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b3e4a0-8a9b-11e8-a978-8775712a0163', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924368399', '1181403924333399', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b43700-8a9b-11e8-b63d-fdcd4aef2060', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924380400', '1181403924434400', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b48cc0-8a9b-11e8-99cf-056d1acceed9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924361401', '1181403924617401', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b4df50-8a9b-11e8-99dc-896dc25d7d6e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924337402', '1181403924279402', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b51470-8a9b-11e8-90da-d5c22f206ad7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924337403', '1181403924340403', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b56910-8a9b-11e8-b6db-a13525e1cd6a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924371404', '1181403924710404', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b5c360-8a9b-11e8-872e-79d717f6ff33', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924376405', '1181403924394405', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b62260-8a9b-11e8-89c4-4549a120d7ee', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924360406', '1181403924068406', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b67ce0-8a9b-11e8-a5e2-b7fc6d89c376', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924353407', '1181403924427407', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b6b4c0-8a9b-11e8-b98a-b52cd55b9761', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924376408', '1181403924582408', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b72140-8a9b-11e8-afaf-977dae466406', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924397409', '1181403924255409', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b76c70-8a9b-11e8-8835-eb6abac0ecec', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924370410', '1181403924027410', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b7e980-8a9b-11e8-a14a-4779ef413449', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924354411', '1181403924906411', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b89110-8a9b-11e8-8c91-93313869493a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924343412', '1181403924315412', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b8e6c0-8a9b-11e8-920e-21db36a65019', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924309413', '1181403924027413', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b920a0-8a9b-11e8-88b8-ed1600eb113c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924367414', '1181403924623414', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b98e20-8a9b-11e8-a3b6-692330bba17b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924330415', '1181403924087415', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b9c7f0-8a9b-11e8-9d69-f7da165a53c6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924396416', '1181403924407416', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46b9fad0-8a9b-11e8-a208-bd1b7d1e5484', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924377417', '1181403924850417', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ba4370-8a9b-11e8-ad9e-13cb70febc73', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924350418', '1181403924894418', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ba8f90-8a9b-11e8-b6a7-c5b832d7504e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924335419', '1181403924450419', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bb0660-8a9b-11e8-8ef3-93977eca1827', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924392420', '1181403924972420', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bb64e0-8a9b-11e8-95ea-b57d1f923313', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924384421', '1181403924755421', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bbb940-8a9b-11e8-a42c-6d8ba150767f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924364422', '1181403924913422', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bc3060-8a9b-11e8-9067-dd5ecd3ea9f2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924383423', '1181403924997423', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bc9cb0-8a9b-11e8-a3e1-d7d9e2346c58', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924343424', '1181403924044424', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bd14b0-8a9b-11e8-8adf-dddd335efdef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924383425', '1181403924847425', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bd9ee0-8a9b-11e8-8743-2f14677c797b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924345426', '1181403924670426', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bdfca0-8a9b-11e8-931f-6fee0c2d84e4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924387427', '1181403924608427', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46be3e80-8a9b-11e8-a5dc-fdd3fd9197e3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924333428', '1181403924424428', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46be9990-8a9b-11e8-8c99-4d7c4caacbe0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924330429', '1181403924220429', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bed070-8a9b-11e8-8011-5f7497683bc9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924372430', '1181403924232430', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bf28b0-8a9b-11e8-9dd0-57c0e956620e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924393431', '1181403924495431', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bf68c0-8a9b-11e8-8331-cbd99f7c576e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924377432', '1181403924823432', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bfbf00-8a9b-11e8-a4dd-63870cbcd46c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924338433', '1181403924160433', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46bfffc0-8a9b-11e8-b632-a7091371b675', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924358434', '1181403924429434', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c0a450-8a9b-11e8-b4e2-c5bbd6c1735e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924314435', '1181403924439435', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c103b0-8a9b-11e8-b93d-59b31dfeda17', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924360436', '1181403924391436', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c14090-8a9b-11e8-a2e7-737ea1b15450', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924300437', '1181403924820437', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c19c00-8a9b-11e8-b0cf-451fa5009a24', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924318438', '1181403924099438', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c1da20-8a9b-11e8-9905-c7fd08472974', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924392439', '1181403924034439', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c24c80-8a9b-11e8-8d6e-df0e3e51bf51', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924356440', '1181403924244440', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c2b9c0-8a9b-11e8-96f4-1fbe79fed165', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924336441', '1181403924986441', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c2f0b0-8a9b-11e8-b29f-714b00b4ba81', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924336442', '1181403924519442', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c32060-8a9b-11e8-a340-f5d29559781c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303443', '1181403924961443', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c37dd0-8a9b-11e8-9c57-e3506d29db80', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924380444', '1181403924860444', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c3be80-8a9b-11e8-baad-7da511226f95', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924367445', '1181403924811445', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c41880-8a9b-11e8-ba77-d158f7758675', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924388446', '1181403924066446', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c45e00-8a9b-11e8-af9c-e77e3e9ee234', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924300447', '1181403924978447', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c4cc10-8a9b-11e8-affc-01830103b1be', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924371448', '1181403924511448', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c533a0-8a9b-11e8-8818-0900e664b28c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924384449', '1181403924557449', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c575c0-8a9b-11e8-875c-81d9bb6257dd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924342450', '1181403924375450', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c5ee30-8a9b-11e8-8cea-2979bab25d49', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924371451', '1181403924716451', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c63880-8a9b-11e8-9ca8-c93b5c0d7644', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924349452', '1181403924306452', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c694e0-8a9b-11e8-9dc9-2f748fdc0aa6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311453', '1181403924771453', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c777e0-8a9b-11e8-bb74-07b925c12608', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924383454', '1181403924325454', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c7de80-8a9b-11e8-a4c5-69ab91111835', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924371455', '1181403924506455', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c830f0-8a9b-11e8-bfc2-5765fc701e32', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924355456', '1181403924032456', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c86f10-8a9b-11e8-a423-652e9cef2506', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924314457', '1181403924079457', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c8cd90-8a9b-11e8-8155-7bf3c2ca615f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924378458', '1181403924088458', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c911a0-8a9b-11e8-8852-710b64f4b63b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924364459', '1181403924574459', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46c9eaa0-8a9b-11e8-927e-1fcd050b8091', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924312460', '1181403924411460', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ca43b0-8a9b-11e8-9c56-a5f0fe476f63', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924367461', '1181403924233461', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46caae60-8a9b-11e8-b908-29267b4a5317', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924391462', '1181403924150462', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46caf040-8a9b-11e8-a919-77d2ea9cce98', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924344463', '1181403924954463', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cb4260-8a9b-11e8-84cc-298287d84fc2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311464', '1181403924791464', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cbf900-8a9b-11e8-897d-95d98f7af6ee', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924397465', '1181403924276465', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cc3230-8a9b-11e8-9e13-9159890ca962', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924357466', '1181403924567466', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cc8b80-8a9b-11e8-98ec-c3fc433b75a9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924347467', '1181403924968467', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cce140-8a9b-11e8-a87a-e723f0ae8068', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924336468', '1181403924465468', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cd42e0-8a9b-11e8-89f9-81810d89df23', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924382469', '1181403924438469', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cd7a90-8a9b-11e8-8d4a-973c4b5a97b7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924358470', '1181403924950470', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cdd610-8a9b-11e8-be9b-b312b4d66d89', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303471', '1181403924744471', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ce1b10-8a9b-11e8-85a0-2dac192d1344', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924320472', '1181403924896472', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ce7ff0-8a9b-11e8-a853-1510c33bec6c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924379473', '1181403924531473', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ced150-8a9b-11e8-a20e-ff3d41b26a75', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924390474', '1181403924820474', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cf2cb0-8a9b-11e8-aeef-71e3d34a7ee4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924313475', '1181403924677475', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cf82b0-8a9b-11e8-a3c0-25ed2911d0f9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924341476', '1181403924904476', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cfb9d0-8a9b-11e8-97f2-6fcbcade5a34', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924319477', '1181403924556477', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46cfe820-8a9b-11e8-a647-dfe4aa1d1098', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924369478', '1181403924732478', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d04410-8a9b-11e8-875e-df6d6f0ebca5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924334479', '1181403924448479', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d08bf0-8a9b-11e8-8fb5-a32f832ecea3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924378480', '1181403924881480', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d0f200-8a9b-11e8-9c9b-25de608484d1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924302481', '1181403924078481', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d13040-8a9b-11e8-b654-e5e1ecf0d823', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924367482', '1181403924835482', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d19450-8a9b-11e8-b6c7-85e20cea7e0e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924312483', '1181403924976483', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d1f840-8a9b-11e8-96f4-ab66615be3f4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924380484', '1181403924287484', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d23500-8a9b-11e8-858b-e91f804b9ff2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924362485', '1181403924316485', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d26380-8a9b-11e8-8738-cbf061127fef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924358486', '1181403924716486', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d2a9e0-8a9b-11e8-89da-7552e10489a2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924306487', '1181403924017487', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d2eea0-8a9b-11e8-989f-59d57ff0a842', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924354488', '1181403924720488', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d34700-8a9b-11e8-b0f1-831f4c83f1b4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924306489', '1181403924541489', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d38890-8a9b-11e8-aeb3-a15d8ba81030', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924360490', '1181403924608490', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d3dae0-8a9b-11e8-b516-b37a25b0556e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924350491', '1181403924182491', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d43000-8a9b-11e8-b24c-a9dce8c9cd47', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924380492', '1181403924513492', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d48aa0-8a9b-11e8-84ca-8dc1ccd4f6e5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924316493', '1181403924485493', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d4cad0-8a9b-11e8-a2af-c1d83f6ea3fa', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924307494', '1181403924977494', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d52030-8a9b-11e8-ba6c-1bf598013402', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924330495', '1181403924411495', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d562e0-8a9b-11e8-8af9-ebe3a36c9c08', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924375496', '1181403924221496', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d5bd30-8a9b-11e8-9120-477076005380', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924314497', '1181403924182497', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d5f260-8a9b-11e8-99d7-53dc18725123', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924374498', '1181403924946498', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d64800-8a9b-11e8-af40-031b7124771f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924363499', '1181403924469499', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d69680-8a9b-11e8-88a6-8fb85a2336e5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924352500', '1181403924147500', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d70840-8a9b-11e8-bcb2-61de3d86853a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924378501', '1181403924910501', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d74220-8a9b-11e8-ae92-6f03ef9697e0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924375502', '1181403924743502', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d79890-8a9b-11e8-8344-0b46cfc7ec1a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924316503', '1181403924219503', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d7e5b0-8a9b-11e8-b10c-8366c8302da0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924399504', '1181403924782504', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46d83e80-8a9b-11e8-8015-956b5d07c228', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924334505', '1181403924073505', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46da4940-8a9b-11e8-aeef-0b6ff994bebd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924381506', '1181403924049506', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46dab5c0-8a9b-11e8-bee4-b13d5e3e4278', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924350507', '1181403924507507', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46dafa00-8a9b-11e8-abe8-ff68ce6ebb1e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924390508', '1181403924822508', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46db52d0-8a9b-11e8-ac2f-5f102f4c31d6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924381509', '1181403924105509', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46db9220-8a9b-11e8-b2d8-913911128f86', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924361510', '1181403924797510', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46dc0880-8a9b-11e8-8692-71f46b38e83e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924368511', '1181403924633511', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46dc6800-8a9b-11e8-8d88-fd902e8b5035', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924300512', '1181403924491512', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46dca0e0-8a9b-11e8-8bc0-03bec68ad3ee', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924384513', '1181403924465513', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46dcf800-8a9b-11e8-b1a2-018884867615', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924361514', '1181403924259514', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46dd3f10-8a9b-11e8-a01d-6d876ea9ed34', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924305515', '1181403924807515', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ddaf10-8a9b-11e8-8654-59705c35f6c3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924356516', '1181403924763516', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46de0030-8a9b-11e8-bd4c-8fd6129a0882', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924355517', '1181403924821517', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46de69e0-8a9b-11e8-a66e-ad4478113ff9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924353518', '1181403924845518', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ded210-8a9b-11e8-9b5e-57125cc9ce49', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924384519', '1181403924943519', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46df0b60-8a9b-11e8-95e3-e5cbae3fbacb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924370520', '1181403924961520', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46df5ba0-8a9b-11e8-b7a3-dba895d2bff0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924300521', '1181403924111521', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46df9e60-8a9b-11e8-a89f-1ba36fee05e1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924304522', '1181403924117522', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46dfe3e0-8a9b-11e8-88a8-d55e1dfe523f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303523', '1181403924394523', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e037a0-8a9b-11e8-9ecf-9b9843077ec6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924382524', '1181403924804524', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e07430-8a9b-11e8-8a39-d59fac9f9ad7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924349525', '1181403924724525', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e0c840-8a9b-11e8-b8d6-35a8f0878c95', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924307526', '1181403924318526', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e10550-8a9b-11e8-83ed-2d3f52805963', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924352527', '1181403924790527', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e15b70-8a9b-11e8-9b9c-89fba89a10de', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924382528', '1181403924756528', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e19790-8a9b-11e8-8275-f9a703d93622', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924385529', '1181403924202529', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e1f570-8a9b-11e8-afc2-5b79d1706780', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924309530', '1181403924077530', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e24110-8a9b-11e8-94ad-b99602b6357d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924344531', '1181403924898531', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e2b220-8a9b-11e8-b66f-7db8211d717c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924392532', '1181403924914532', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e2edc0-8a9b-11e8-8f44-41aefca1ea7a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924384533', '1181403924085533', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e343a0-8a9b-11e8-b5d6-a95352369b11', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924370534', '1181403924418534', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e401b0-8a9b-11e8-8fdb-a52212cc4ecb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924324535', '1181403924627535', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e489f0-8a9b-11e8-9fe9-fb013d6c5d81', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924327536', '1181403924838536', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e4fd80-8a9b-11e8-9851-ef0b8038676a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924386537', '1181403924751537', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e54c30-8a9b-11e8-b501-e510390dedc7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924344538', '1181403924659538', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e5ad80-8a9b-11e8-959d-f9e4b45dec8c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924311539', '1181403924980539', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e5f3a0-8a9b-11e8-b40d-f714ca0f5d4b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924358540', '1181403924466540', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e656f0-8a9b-11e8-b973-1d2852772888', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924388541', '1181403924161541', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e69980-8a9b-11e8-9adc-bb802ab74f90', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924392542', '1181403924053542', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e6f470-8a9b-11e8-b7e6-6f94d3b6c560', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924350543', '1181403924530543', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e73220-8a9b-11e8-97dc-5f5c53a28ca2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924349544', '1181403924797544', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e78a10-8a9b-11e8-90df-33fece667507', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924336545', '1181403924200545', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e7c190-8a9b-11e8-8c13-272236c48ee1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924387546', '1181403924056546', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e80d20-8a9b-11e8-a7cc-0b6d763f5bd4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924371547', '1181403924592547', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e85d60-8a9b-11e8-a056-af239d648e4c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924318548', '1181403924062548', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e8ca00-8a9b-11e8-9b5a-619d931bd059', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924308549', '1181403924245549', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e90460-8a9b-11e8-9a8b-c7d9aeb08d3d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924348550', '1181403924717550', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e95b70-8a9b-11e8-a617-9528a1e98cee', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924326551', '1181403924875551', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46e9a2e0-8a9b-11e8-81d0-939c8841b71d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924303552', '1181403924995552', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ea0220-8a9b-11e8-9472-dd5080bbddf2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924359553', '1181403924907553', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ea6ef0-8a9b-11e8-a05e-db7b05c5036c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924364554', '1181403924277554', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46eaa700-8a9b-11e8-aad7-e5de36cc4700', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924373555', '1181403924755555', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46eafae0-8a9b-11e8-a785-e540670b92e4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924371556', '1181403924705556', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46eb3190-8a9b-11e8-9818-8b56cd762dda', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924390557', '1181403924299557', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46eb65d0-8a9b-11e8-b89f-75a5fa8c8b06', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924321558', '1181403924130558', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ebb370-8a9b-11e8-a41e-c53ca603ec3a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924363559', '1181403924048559', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ebead0-8a9b-11e8-8803-73e0b0de7392', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924370560', '1181403924889560', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ec4280-8a9b-11e8-8042-11c19980cd5d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924383561', '1181403924192561', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ed37c0-8a9b-11e8-84de-5d6bbad3ef4b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924322562', '1181403924078562', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ed8e00-8a9b-11e8-a2da-0dcbd5819d95', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924393563', '1181403924779563', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46edde30-8a9b-11e8-abb7-115a2f2c0d28', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924343564', '1181403924449564', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ee4d00-8a9b-11e8-b8bb-7f1ca6a00e2d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924360565', '1181403924022565', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46eeb4e0-8a9b-11e8-9ed5-bf4fb532beea', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924374566', '1181403924532566', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ef0db0-8a9b-11e8-909c-63cdf5f7377e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924312567', '1181403924288567', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46ef6b20-8a9b-11e8-8d56-211ea848e8d3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924332568', '1181403924954568', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46efaa80-8a9b-11e8-85f6-bde7f7bd65e8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924302569', '1181403924631569', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f02030-8a9b-11e8-8746-4d55602b3087', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924345570', '1181403924397570', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f09090-8a9b-11e8-8590-2f772fb70a0f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924342571', '1181403924016571', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f0ce40-8a9b-11e8-8007-9b47d27363e5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924395572', '1181403924180572', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f11450-8a9b-11e8-b484-136fec98f0df', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924334573', '1181403924712573', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f15470-8a9b-11e8-8817-715241b396dc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924364574', '1181403924936574', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f1b210-8a9b-11e8-8f95-5528f0a7c4ef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924338575', '1181403924817575', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f1ed50-8a9b-11e8-9d01-45f565d4e218', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924394576', '1181403924194576', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f21bc0-8a9b-11e8-b8c3-89b971cd3318', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924342577', '1181403924419577', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f27880-8a9b-11e8-8486-970e5a4f6fb8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924385578', '1181403924769578', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f2c5c0-8a9b-11e8-a660-4f4e45926d3e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924383579', '1181403924127579', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f329e0-8a9b-11e8-85cc-513914613e66', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924338580', '1181403924657580', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f3c990-8a9b-11e8-bf37-d9c1280afcaa', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924344581', '1181403924406581', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f42000-8a9b-11e8-b40d-657242085a1f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924323582', '1181403924625582', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f45e80-8a9b-11e8-940c-354fbca921c9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924337583', '1181403924990583', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f49f70-8a9b-11e8-b14c-0f96cbb2dcf5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924302584', '1181403924217584', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f509b0-8a9b-11e8-a16e-ad82a279954a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924375585', '1181403924952585', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f57400-8a9b-11e8-9096-656465b89cef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924301586', '1181403924108586', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f5aeb0-8a9b-11e8-81e2-633b5ebf655d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924337587', '1181403924417587', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f5fe00-8a9b-11e8-b91a-81990611b622', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924367588', '1181403924610588', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f63d90-8a9b-11e8-a7ab-bbbc060f355e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924308589', '1181403924360589', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f69c90-8a9b-11e8-93f8-5faa1920df03', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924387590', '1181403924145590', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f6dfe0-8a9b-11e8-8399-7b62a4d54dd3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924394591', '1181403924343591', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f73ed0-8a9b-11e8-bec1-1fca5ab5ee1a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924341592', '1181403924605592', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f77f70-8a9b-11e8-99b9-b777fcbde3e7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924343593', '1181403924865593', NULL, '2018-07-18 08:00:14', '2018-07-18 08:00:14', NULL),
('46f7d090-8a9b-11e8-823a-ed903df814ff', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924360594', '1181403924112594', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46f80d40-8a9b-11e8-b8d4-6329e391e1b0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '114924326595', '1181403924901595', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46f84060-8a9b-11e8-9ebb-5746a3cdf818', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925374596', '1181503925170596', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46f89180-8a9b-11e8-9a0d-8f248273a34d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925381597', '1181503925419597', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46f8cf50-8a9b-11e8-a362-1d021f75d7d0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925369598', '1181503925862598', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46f932b0-8a9b-11e8-b5a3-d52c34977c75', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925335599', '1181503925205599', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46f97de0-8a9b-11e8-8240-2df9fdedbc67', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925314600', '1181503925118600', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46f9d580-8a9b-11e8-ab34-9f7698ba1231', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925316601', '1181503925300601', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fa1a90-8a9b-11e8-a362-f98935136623', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925325602', '1181503925500602', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fa7ec0-8a9b-11e8-ab13-add65fb0f781', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925398603', '1181503925378603', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fae400-8a9b-11e8-a4cb-bb2997e208b9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925334604', '1181503925069604', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fb2810-8a9b-11e8-b379-23b40713b57c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925391605', '1181503925363605', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fb8ba0-8a9b-11e8-89f8-650a9b67b304', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925360606', '1181503925886606', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fbd060-8a9b-11e8-b368-136e3fa02b82', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925358607', '1181503925762607', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fc3a50-8a9b-11e8-a71b-13b71aadabaf', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925361608', '1181503925075608', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fc7900-8a9b-11e8-80d2-07a42ab61e14', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925376609', '1181503925642609', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fcdee0-8a9b-11e8-86d0-d99c13fe03ec', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925376610', '1181503925206610', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fd2f40-8a9b-11e8-a4bb-9bddf95bd4d0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925368611', '1181503925998611', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fd80f0-8a9b-11e8-8c92-2b7b1d82f4fb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925397612', '1181503925436612', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fdc3d0-8a9b-11e8-abe1-45a8d7040411', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925348613', '1181503925421613', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fe20a0-8a9b-11e8-97bb-d1bea0f53c5e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925369614', '1181503925357614', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fe8c90-8a9b-11e8-bcaf-23152dc8cead', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925365615', '1181503925147615', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46fece30-8a9b-11e8-a6a0-2d443a3dfde5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925339616', '1181503925551616', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46ff3300-8a9b-11e8-9765-e73b78174a80', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925360617', '1181503925434617', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46ff8220-8a9b-11e8-9dbe-6de77cf38f96', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925374618', '1181503925581618', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('46ffd690-8a9b-11e8-b8ec-050cf2a836d9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925321619', '1181503925782619', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470070e0-8a9b-11e8-9416-d779a90bba73', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925385620', '1181503925196620', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4700b590-8a9b-11e8-b722-4b6981da9c23', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925322621', '1181503925775621', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47013010-8a9b-11e8-a355-5b6983548f7b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925368622', '1181503925238622', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47017120-8a9b-11e8-a0b7-3dd429a52f3b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925310623', '1181503925339623', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4701e210-8a9b-11e8-8582-1d7beee39444', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925349624', '1181503925641624', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470241c0-8a9b-11e8-aeed-859d8c9b7f0a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925353625', '1181503925168625', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47027e20-8a9b-11e8-a8fa-a520e877d6d1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925398626', '1181503925052626', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4702dee0-8a9b-11e8-98f9-073dc19c11a1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925372627', '1181503925620627', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47032a20-8a9b-11e8-8b32-6d7e5cddeb2a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925300628', '1181503925744628', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47038ed0-8a9b-11e8-b0f6-3134b495d01e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925334629', '1181503925924629', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4703d700-8a9b-11e8-a4b7-5fb0fdb0e2a8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925311630', '1181503925407630', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47042bc0-8a9b-11e8-8c54-8bc1cb997ede', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925301631', '1181503925882631', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47049730-8a9b-11e8-9c40-17ec5f9db70f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925356632', '1181503925506632', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4704cdc0-8a9b-11e8-84a4-474fa1872b58', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925363633', '1181503925193633', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47050010-8a9b-11e8-bfbc-a1c66777b50d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925318634', '1181503925966634', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47054920-8a9b-11e8-a35d-d9916549408a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925378635', '1181503925810635', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47058b10-8a9b-11e8-abd7-8f48fafe0869', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925329636', '1181503925161636', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4705e830-8a9b-11e8-be04-8bb2a8060867', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925357637', '1181503925641637', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470625f0-8a9b-11e8-aba6-05eff10422e5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925322638', '1181503925846638', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47067690-8a9b-11e8-9325-2fb8dc10a602', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925314639', '1181503925877639', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4706bd50-8a9b-11e8-baa6-5d070febf7ab', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925319640', '1181503925184640', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47071570-8a9b-11e8-89ed-95f190d950f1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925366641', '1181503925281641', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470755c0-8a9b-11e8-a967-c51cb2ffe616', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925379642', '1181503925888642', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4707ab80-8a9b-11e8-83b7-eff948c90e8d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925380643', '1181503925363643', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4707e820-8a9b-11e8-a05e-25ec1a6d214e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925373644', '1181503925615644', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47082590-8a9b-11e8-af40-87013ea28b1e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925326645', '1181503925666645', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470898b0-8a9b-11e8-a6bf-650d47988edc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925388646', '1181503925497646', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4708f2d0-8a9b-11e8-9c21-a52a79a9ed06', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925321647', '1181503925400647', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47092ef0-8a9b-11e8-a354-f33f443e1580', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925342648', '1181503925023648', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4709a060-8a9b-11e8-bd69-d1941fc75e9f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925371649', '1181503925982649', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4709ea40-8a9b-11e8-b8b6-db818fb415f1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925397650', '1181503925702650', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470a3ca0-8a9b-11e8-b96c-79bebfc6086c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925361651', '1181503925037651', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470a77a0-8a9b-11e8-8e08-5b670b9a98e1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925320652', '1181503925510652', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470ae700-8a9b-11e8-b630-992892544c37', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925356653', '1181503925392653', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470b2b10-8a9b-11e8-8e88-e55d5934041b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925326654', '1181503925599654', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470b8300-8a9b-11e8-888e-eff4352e8a71', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925358655', '1181503925897655', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470bbe00-8a9b-11e8-be9b-b71829ff5417', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925376656', '1181503925486656', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL);
INSERT INTO `tbl_tiket` (`id`, `id_cetak_tiket`, `kap`, `pin`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('470c13e0-8a9b-11e8-8170-63f6d80c5d9b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925369657', '1181503925646657', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470c51e0-8a9b-11e8-9ef1-832d3249a97b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925328658', '1181503925635658', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470c9f70-8a9b-11e8-bc13-3fdeee14205e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925383659', '1181503925599659', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470cd720-8a9b-11e8-b1cb-3df839e28c64', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925375660', '1181503925601660', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470d2ee0-8a9b-11e8-b9d6-5fff3f095f5b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925378661', '1181503925839661', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470d7040-8a9b-11e8-8164-c5aa19692316', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925377662', '1181503925999662', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470e57f0-8a9b-11e8-be8f-c724ae021a72', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925357663', '1181503925718663', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470eb3d0-8a9b-11e8-8bff-178563faf62c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925393664', '1181503925938664', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470f13d0-8a9b-11e8-976e-59778e69a001', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925318665', '1181503925510665', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470f4de0-8a9b-11e8-ba01-b5192c8b0294', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925379666', '1181503925969666', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470fa9b0-8a9b-11e8-9ac2-d3c433ceea45', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925355667', '1181503925662667', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('470fe4d0-8a9b-11e8-b05c-db68b58b1675', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925369668', '1181503925152668', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471051e0-8a9b-11e8-b639-ff22b6f15217', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925386669', '1181503925209669', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471091d0-8a9b-11e8-9ace-3195690618f6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925360670', '1181503925854670', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4710ef00-8a9b-11e8-ba83-934cd09b27ca', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925328671', '1181503925672671', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471138b0-8a9b-11e8-a626-65ff3a662ab8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925335672', '1181503925095672', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47118c70-8a9b-11e8-9866-ef30945d371c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925398673', '1181503925490673', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4711c230-8a9b-11e8-9da2-f56c22ddba5c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925349674', '1181503925785674', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47120d40-8a9b-11e8-9c0f-310dbcf0918d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925332675', '1181503925762675', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47124580-8a9b-11e8-8f3e-bf30938ddf94', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925338676', '1181503925676676', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471283a0-8a9b-11e8-9bfd-9b790ee1923c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925313677', '1181503925091677', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4712dea0-8a9b-11e8-aa98-2769d67ba093', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925308678', '1181503925864678', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471320b0-8a9b-11e8-b49c-8792bf9c25e2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925366679', '1181503925559679', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47137990-8a9b-11e8-84cc-e7256cd34d75', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925352680', '1181503925466680', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4713c3e0-8a9b-11e8-ab44-395b7bb9abb9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925365681', '1181503925522681', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47141c90-8a9b-11e8-ac7d-3b5695ceefe2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925376682', '1181503925873682', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47145270-8a9b-11e8-ade7-1f63b71a957c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925344683', '1181503925752683', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47149b20-8a9b-11e8-9d5a-09e82694f159', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925355684', '1181503925716684', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47155dd0-8a9b-11e8-9fc6-a96201697716', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925351685', '1181503925015685', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4715b3e0-8a9b-11e8-833a-37e7b493ede0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925395686', '1181503925127686', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4715f100-8a9b-11e8-b3ed-6568a1f4765a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925398687', '1181503925761687', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47163180-8a9b-11e8-b79a-3fa672391bdd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925350688', '1181503925934688', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47168800-8a9b-11e8-b137-d1aec0038438', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925353689', '1181503925261689', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4716c0c0-8a9b-11e8-8424-9567f81992a8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925319690', '1181503925608690', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47170d60-8a9b-11e8-bb5e-35cbd47a0952', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925391691', '1181503925282691', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47174f70-8a9b-11e8-a95b-e7197ce6528a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925320692', '1181503925096692', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4717ada0-8a9b-11e8-82ba-377c2c21b5f3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925376693', '1181503925607693', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4717ee80-8a9b-11e8-ae97-6126624c446c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925370694', '1181503925755694', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471850d0-8a9b-11e8-8889-43919e953cfb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925308695', '1181503925196695', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47188680-8a9b-11e8-98db-5d1c395d368c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925395696', '1181503925409696', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471913f0-8a9b-11e8-a12b-5f7f5c8e62ef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925360697', '1181503925902697', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47196ea0-8a9b-11e8-9274-a9544950f7ad', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925357698', '1181503925656698', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4719a680-8a9b-11e8-8c9a-ff2fc45833df', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925362699', '1181503925119699', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4719fa60-8a9b-11e8-a676-b7814fa60418', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925339700', '1181503925814700', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471a3950-8a9b-11e8-be2a-79bed353a371', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925360701', '1181503925391701', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471a9880-8a9b-11e8-a327-d794905329c5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925341702', '1181503925762702', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471adae0-8a9b-11e8-852d-9fbeb583796a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925396703', '1181503925934703', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471b2c70-8a9b-11e8-ba71-e134199cf1c5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925397704', '1181503925262704', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471b6260-8a9b-11e8-966f-5b86245f44ed', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925324705', '1181503925499705', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471b8dc0-8a9b-11e8-9d30-c70869155279', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925382706', '1181503925301706', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471bdff0-8a9b-11e8-b0c0-254e8b5ddfee', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925331707', '1181503925479707', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471c16f0-8a9b-11e8-b418-2f3b694db578', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925335708', '1181503925756708', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471c6a60-8a9b-11e8-9d98-2b64c19ecc4b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925322709', '1181503925895709', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471cc700-8a9b-11e8-95e0-7dfeb675be15', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925348710', '1181503925353710', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471d44e0-8a9b-11e8-9be0-33b28e39149f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925398711', '1181503925881711', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471dbba0-8a9b-11e8-8ae9-69f963a53d40', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925340712', '1181503925587712', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471e0c80-8a9b-11e8-97ea-c547bb57dfbb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925364713', '1181503925145713', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471e67c0-8a9b-11e8-b11a-a507ccd2f4c1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925365714', '1181503925742714', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471eaac0-8a9b-11e8-b2d4-e745c0f80472', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925317715', '1181503925305715', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471f0200-8a9b-11e8-90c9-85d0a2156084', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925353716', '1181503925890716', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('471f4dc0-8a9b-11e8-a7ba-b3adba832ac9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925361717', '1181503925271717', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472014c0-8a9b-11e8-97e8-a7389efcb537', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925341718', '1181503925324718', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47207c10-8a9b-11e8-9ab5-3ba35fee55a9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925316719', '1181503925732719', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4720d8d0-8a9b-11e8-9181-edd4e28ad7df', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925340720', '1181503925929720', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47210d50-8a9b-11e8-98e7-1342f83a0bdd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925308721', '1181503925326721', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47215a90-8a9b-11e8-ac24-c983cecddc35', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925352722', '1181503925590722', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472198a0-8a9b-11e8-9c3f-0312bebc8627', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925301723', '1181503925526723', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4721e910-8a9b-11e8-987c-e593ac2e7bd6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925328724', '1181503925371724', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47222700-8a9b-11e8-b6d7-27eb0851d75e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925364725', '1181503925443725', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47225800-8a9b-11e8-a4c2-8faea59484a3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925317726', '1181503925656726', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4722f890-8a9b-11e8-8d73-8be0a2de89c9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925341727', '1181503925636727', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47235360-8a9b-11e8-aff1-3534333dd815', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925369728', '1181503925737728', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47238fb0-8a9b-11e8-a35b-61cb9142f7d1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925301729', '1181503925186729', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4723e240-8a9b-11e8-a38d-5560e74fb350', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925334730', '1181503925408730', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47243ca0-8a9b-11e8-a554-3b780ed0d08f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925378731', '1181503925396731', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47249700-8a9b-11e8-8d49-97466b0717b0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925301732', '1181503925961732', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4724fba0-8a9b-11e8-8aa6-b7db345d01dc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925301733', '1181503925462733', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47254620-8a9b-11e8-bc07-add596a1a346', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925314734', '1181503925365734', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47259d30-8a9b-11e8-b559-c526553c5f0e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925328735', '1181503925482735', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4725f200-8a9b-11e8-abbf-d99f464d30c4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925312736', '1181503925677736', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47263f80-8a9b-11e8-b026-31a31ec0122d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925377737', '1181503925955737', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47267520-8a9b-11e8-bb1f-7dd6efab3d8f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925361738', '1181503925348738', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4726e010-8a9b-11e8-b43f-516e22c0269d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925304739', '1181503925340739', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472731a0-8a9b-11e8-ba5a-99f960822e0e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925314740', '1181503925831740', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47278e80-8a9b-11e8-823c-a5bb24c692f2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925347741', '1181503925562741', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4727d8a0-8a9b-11e8-bbde-eda6dbedd385', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925389742', '1181503925502742', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47284530-8a9b-11e8-8c0f-359b6445028e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925321743', '1181503925145743', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4728a370-8a9b-11e8-9a9d-536aea7b0d28', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925327744', '1181503925879744', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4728dc40-8a9b-11e8-a6de-878f6ba24fff', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925377745', '1181503925556745', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472912c0-8a9b-11e8-af52-c91ad1ed19be', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925350746', '1181503925298746', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472962e0-8a9b-11e8-a56d-0f5574de56ef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925345747', '1181503925360747', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47299310-8a9b-11e8-afa7-07b3cfdb6c1f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925302748', '1181503925335748', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4729f970-8a9b-11e8-80c8-ddc462efe299', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925321749', '1181503925207749', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472a3c40-8a9b-11e8-8ed1-f9b3528b807f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925375750', '1181503925749750', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472aa6f0-8a9b-11e8-a12c-091bf3b8d475', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925391751', '1181503925521751', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472aedc0-8a9b-11e8-8d51-83da7b5193dd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925300752', '1181503925732752', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472b4a20-8a9b-11e8-858d-3b9e818b1948', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925386753', '1181503925780753', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472b8440-8a9b-11e8-b630-954dabf4639c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925358754', '1181503925102754', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472be600-8a9b-11e8-8f65-bd0a21b906a0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925365755', '1181503925404755', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472c4810-8a9b-11e8-a741-7b4391c99370', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925345756', '1181503925043756', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472c8960-8a9b-11e8-ba4d-15ecad2ad5fb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925311757', '1181503925915757', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472ce590-8a9b-11e8-a01c-9f3a1ceee0a5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925390758', '1181503925488758', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472d2280-8a9b-11e8-8d0b-17d9a73da911', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925394759', '1181503925356759', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472d54a0-8a9b-11e8-8427-d92f6ee02667', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925322760', '1181503925182760', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472da2c0-8a9b-11e8-90ff-911557eae8f8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925374761', '1181503925405761', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472ddda0-8a9b-11e8-ac58-1d597fb0a107', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925337762', '1181503925924762', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472e3060-8a9b-11e8-960a-7b7b2a41f050', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925370763', '1181503925528763', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472e71a0-8a9b-11e8-a7ba-35b62d697705', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925354764', '1181503925685764', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472edf60-8a9b-11e8-b233-133d6be89a7c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925345765', '1181503925227765', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472f2100-8a9b-11e8-9043-fb8207fd7525', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925379766', '1181503925926766', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472f79c0-8a9b-11e8-af51-19d567736f02', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925349767', '1181503925200767', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('472fc570-8a9b-11e8-ada7-f7de901f4395', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925362768', '1181503925704768', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47303510-8a9b-11e8-b69c-43caf75d103b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925393769', '1181503925134769', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47308ad0-8a9b-11e8-9219-1d26dc18d956', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925371770', '1181503925516770', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4730bd40-8a9b-11e8-aa19-6b0e11e606cb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925311771', '1181503925176771', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4730ff70-8a9b-11e8-a5eb-0ffb0087bb83', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925382772', '1181503925176772', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47315620-8a9b-11e8-a13f-ffff39e7e161', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925303773', '1181503925601773', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47319790-8a9b-11e8-bebf-61e567666bb2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925322774', '1181503925431774', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4731ece0-8a9b-11e8-8e8e-fb47363cefb1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925309775', '1181503925162775', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47322ea0-8a9b-11e8-81ac-d5d5a4bfa231', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925380776', '1181503925828776', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47328100-8a9b-11e8-ba5a-bf1c3d968a6a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925314777', '1181503925675777', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4732c500-8a9b-11e8-b013-734fb9657c58', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925312778', '1181503925250778', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47331580-8a9b-11e8-9aa0-3dc634ea7df9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925364779', '1181503925694779', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47334e30-8a9b-11e8-adfc-c9be97d5b0f6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925333780', '1181503925161780', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4733b3e0-8a9b-11e8-85b7-ebd746779444', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925326781', '1181503925260781', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4733f480-8a9b-11e8-bd1a-53b4585f0a7d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925312782', '1181503925407782', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47344560-8a9b-11e8-94af-9349ceed3315', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925367783', '1181503925529783', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47349720-8a9b-11e8-8fd5-b3c74d1fc8ef', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925348784', '1181503925077784', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47350740-8a9b-11e8-b592-058e6a3b3b19', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925332785', '1181503925675785', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473540e0-8a9b-11e8-b3ff-c7af4b9bded9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925315786', '1181503925722786', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47358e90-8a9b-11e8-9f7b-6d2ae5ce7d44', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925360787', '1181503925350787', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4735c1d0-8a9b-11e8-98f7-e58c7257f2c9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925334788', '1181503925776788', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47361ed0-8a9b-11e8-8b50-1b06a6a12b45', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925300789', '1181503925744789', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47366a20-8a9b-11e8-be96-bf593887a664', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925352790', '1181503925687790', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4736cd10-8a9b-11e8-a18f-b59a0fcbdf5b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925342791', '1181503925803791', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47374ac0-8a9b-11e8-9a55-0bcf193c63f7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925372792', '1181503925316792', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47380430-8a9b-11e8-ae23-41bc18ebb710', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925368793', '1181503925691793', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47386520-8a9b-11e8-aef1-cff303178c25', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925382794', '1181503925667794', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4738c760-8a9b-11e8-83fb-2b9dc4260667', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925382795', '1181503925506795', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47392640-8a9b-11e8-94be-bb17b3d94f2b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925379796', '1181503925720796', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473a5ba0-8a9b-11e8-9478-7b2b275142e7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925378797', '1181503925231797', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473ad2d0-8a9b-11e8-857e-ad697ea5c62d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925352798', '1181503925873798', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473b3390-8a9b-11e8-ba44-8f6bda84b103', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925328799', '1181503925100799', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473b9e10-8a9b-11e8-ab6f-7154ccad460a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925372800', '1181503925948800', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473bdfe0-8a9b-11e8-ad67-9727f971a71f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925317801', '1181503925965801', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473c4760-8a9b-11e8-9025-c50adb962028', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925367802', '1181503925619802', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473c9960-8a9b-11e8-af85-917373be92af', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925355803', '1181503925135803', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473ce340-8a9b-11e8-8070-1ba661d32957', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925387804', '1181503925311804', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473d1000-8a9b-11e8-a55e-6f28936212d8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925387805', '1181503925179805', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473d59c0-8a9b-11e8-a1c3-bb75ab29383b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925358806', '1181503925459806', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473d9a90-8a9b-11e8-9a34-0d5b724c1940', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925366807', '1181503925838807', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473dfc00-8a9b-11e8-b8e9-eba3d3f91fbb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925326808', '1181503925389808', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473e37b0-8a9b-11e8-bc0f-b937be568fdb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925321809', '1181503925227809', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473e67a0-8a9b-11e8-b961-95f1e5936d24', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925394810', '1181503925522810', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473ec210-8a9b-11e8-8411-21fd61b98a68', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925308811', '1181503925942811', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473ef6a0-8a9b-11e8-a312-ef75eae6fe81', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925357812', '1181503925391812', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('473fca70-8a9b-11e8-8f66-3b3be1c385ed', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925302813', '1181503925564813', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47403750-8a9b-11e8-b600-2d7cc8e0b960', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925313814', '1181503925702814', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47409ec0-8a9b-11e8-86b0-636e70ab8c00', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925339815', '1181503925260815', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4740e080-8a9b-11e8-ac8c-e31537190d69', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925350816', '1181503925255816', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47413c80-8a9b-11e8-97c0-8bbf59fb1c9b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925353817', '1181503925154817', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47417e00-8a9b-11e8-b17b-b78f2c13d86d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925396818', '1181503925172818', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4741d2f0-8a9b-11e8-a4f1-23c6b3756568', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925363819', '1181503925100819', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47420e70-8a9b-11e8-995b-4320e6d1c8b1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925373820', '1181503925847820', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47427c90-8a9b-11e8-acc6-43e1feaf0d82', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925310821', '1181503925977821', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4742c0e0-8a9b-11e8-a2d9-078c08bf5239', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925331822', '1181503925065822', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47431e80-8a9b-11e8-bf0b-6379369820cc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925357823', '1181503925020823', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474359d0-8a9b-11e8-9b9c-374cad49e81c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925381824', '1181503925529824', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4743c0f0-8a9b-11e8-9cea-e156b1ae58a9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925333825', '1181503925762825', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47442d20-8a9b-11e8-98df-f9c770436a92', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925390826', '1181503925455826', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47447240-8a9b-11e8-bb93-fb3bc5967b7e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925395827', '1181503925052827', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47452b10-8a9b-11e8-98cb-d5c8f3cf80f0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925379828', '1181503925707828', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47458760-8a9b-11e8-aab7-f56fc8617846', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925353829', '1181503925292829', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4745cf40-8a9b-11e8-9410-2f6025b4918c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925308830', '1181503925072830', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47462cf0-8a9b-11e8-adb1-d377fbce2358', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925355831', '1181503925109831', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4746a020-8a9b-11e8-887d-5f9061ddaadc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925385832', '1181503925378832', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47472550-8a9b-11e8-9854-05443be57e0f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925323833', '1181503925424833', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474783d0-8a9b-11e8-a600-5b8116580f05', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925356834', '1181503925829834', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4747e3e0-8a9b-11e8-9330-bd5cac4b7a97', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925316835', '1181503925117835', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47482d50-8a9b-11e8-aa71-93490153f07e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925312836', '1181503925781836', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474888e0-8a9b-11e8-b66a-210e79d73c7e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925371837', '1181503925304837', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4748c580-8a9b-11e8-9064-bd0f704e9775', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925313838', '1181503925933838', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474918f0-8a9b-11e8-8d5d-ed05de89b620', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925332839', '1181503925526839', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474950e0-8a9b-11e8-a493-41e02c207ac8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925341840', '1181503925327840', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4749a090-8a9b-11e8-a8ec-0539b9e68f19', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925382841', '1181503925111841', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4749d7c0-8a9b-11e8-8541-dfd995247826', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925319842', '1181503925754842', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474a2ee0-8a9b-11e8-8518-737f2e9c4a8b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925321843', '1181503925681843', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474a7710-8a9b-11e8-bdfc-cb0548b3f064', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925374844', '1181503925209844', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474ae030-8a9b-11e8-904e-51005c8376b6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925389845', '1181503925665845', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474b2110-8a9b-11e8-84c7-eb92853efa77', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925331846', '1181503925129846', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474b8c00-8a9b-11e8-9624-9d91995efdf9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925386847', '1181503925395847', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474bde70-8a9b-11e8-a1fb-f1f72ce895a5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925391848', '1181503925438848', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474c3090-8a9b-11e8-ab49-67551bb7b938', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925393849', '1181503925547849', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474c6440-8a9b-11e8-9a49-79eea7d8fc8a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925336850', '1181503925522850', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474cb770-8a9b-11e8-a1ef-3bf2d0048eb8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925361851', '1181503925336851', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474cf660-8a9b-11e8-b40a-9d7326c9fa27', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925339852', '1181503925015852', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474d5a90-8a9b-11e8-ab95-e5679fbf68d5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925380853', '1181503925806853', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474d9a80-8a9b-11e8-a1f8-756afc01c1e9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925374854', '1181503925021854', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474df270-8a9b-11e8-b229-89771b47b57d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925345855', '1181503925371855', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474e3990-8a9b-11e8-860d-f9e45e6c3908', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925359856', '1181503925419856', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474e9060-8a9b-11e8-b202-9d12911d93e2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925314857', '1181503925433857', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474ec330-8a9b-11e8-ad13-d51a0096bf50', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925371858', '1181503925204858', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474f0b60-8a9b-11e8-a3a5-e774ae3fe7cb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925327859', '1181503925424859', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474f4c70-8a9b-11e8-8c8f-2360fd6b434e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925306860', '1181503925522860', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('474f8a60-8a9b-11e8-82c5-f1c7bf37cafe', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925396861', '1181503925779861', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47500230-8a9b-11e8-9dc2-a99af97ad3af', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925319862', '1181503925889862', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47507070-8a9b-11e8-9ab7-3f167efe9c0f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925303863', '1181503925855863', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4750cb60-8a9b-11e8-83cf-570311c049ee', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925374864', '1181503925779864', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47512d90-8a9b-11e8-9ef4-1b1e6559a7e2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925308865', '1181503925355865', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47517eb0-8a9b-11e8-8991-65c8bbef3043', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925362866', '1181503925025866', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4751c6c0-8a9b-11e8-9c4b-e5a4a88741ae', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925359867', '1181503925892867', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47522310-8a9b-11e8-8d03-2f64d2ec03fb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925357868', '1181503925295868', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47526030-8a9b-11e8-83d7-db1d3fd6a97c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925372869', '1181503925491869', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475290d0-8a9b-11e8-bbfd-c775b9a641e9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925386870', '1181503925729870', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4752de00-8a9b-11e8-9cf8-add76a123844', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925312871', '1181503925341871', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47532610-8a9b-11e8-aa2c-8f9b70fb1ef9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925327872', '1181503925195872', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47538b20-8a9b-11e8-8f22-1d3bfbbf1d66', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925304873', '1181503925010873', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4753cbe0-8a9b-11e8-b3b5-151801439356', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925315874', '1181503925564874', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47541720-8a9b-11e8-a462-1d793f09ef52', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925308875', '1181503925643875', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47545920-8a9b-11e8-9423-5b17d27effa1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925398876', '1181503925759876', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4754b330-8a9b-11e8-a28a-018eaddd7b17', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925340877', '1181503925825877', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4754f910-8a9b-11e8-80df-e552c4c876e3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925359878', '1181503925043878', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47554a80-8a9b-11e8-8902-a5fae1fbffb9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925348879', '1181503925355879', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47558ef0-8a9b-11e8-9f36-bd1feded9fa3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925318880', '1181503925316880', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4755e230-8a9b-11e8-949f-0315551efd6f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925374881', '1181503925076881', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47561f70-8a9b-11e8-82f7-4bd5bb44c50f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925357882', '1181503925276882', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475671d0-8a9b-11e8-95df-5f607ed49e09', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925318883', '1181503925528883', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4756c590-8a9b-11e8-9d59-6f2d966db41c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925307884', '1181503925874884', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47573610-8a9b-11e8-8d65-6b0bad7e393f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925345885', '1181503925859885', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4757a190-8a9b-11e8-b568-89beab3d08d9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925374886', '1181503925059886', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4757e7f0-8a9b-11e8-aab7-051a63a94dd7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925326887', '1181503925803887', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47583b80-8a9b-11e8-a0ea-3d5deca1f41c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925326888', '1181503925011888', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47591b40-8a9b-11e8-9f2d-77526a159b91', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925327889', '1181503925632889', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475981b0-8a9b-11e8-acf1-079c799ed579', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925378890', '1181503925882890', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4759c730-8a9b-11e8-8e81-09916438cc35', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925350891', '1181503925802891', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475a2960-8a9b-11e8-9b06-7b32f1ee445b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925309892', '1181503925326892', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475a7250-8a9b-11e8-a844-57f1c6842d3c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925378893', '1181503925369893', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475adf60-8a9b-11e8-b236-37c9547796f2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925372894', '1181503925050894', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475b2600-8a9b-11e8-afd1-5df61acce41c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925372895', '1181503925441895', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475b80e0-8a9b-11e8-8b83-1d7abd746a42', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925391896', '1181503925933896', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475bc590-8a9b-11e8-a046-0fbe9a641b34', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925367897', '1181503925435897', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475ca540-8a9b-11e8-8745-b75b17dd0029', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925352898', '1181503925335898', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475cd8b0-8a9b-11e8-9c2c-11de57317bee', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925398899', '1181503925968899', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475d31e0-8a9b-11e8-b76b-37094e0ed696', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925332900', '1181503925784900', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475d7ef0-8a9b-11e8-b7f7-a58236ed2ab6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925369901', '1181503925988901', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475de110-8a9b-11e8-9bb6-bbf56edd6bd5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925389902', '1181503925150902', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475e2550-8a9b-11e8-a7d4-f948e48aec3e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925322903', '1181503925036903', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475e70a0-8a9b-11e8-926c-c39cced55388', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925327904', '1181503925626904', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475ea910-8a9b-11e8-b1bf-1745b10a51ed', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925300905', '1181503925634905', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475f0f20-8a9b-11e8-9992-c974e9363523', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925355906', '1181503925256906', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475f4310-8a9b-11e8-a2fa-a16ad2a79440', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925387907', '1181503925171907', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475f9650-8a9b-11e8-af20-53bb9f11df24', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925388908', '1181503925794908', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('475fff40-8a9b-11e8-99ee-4f15b5a85553', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925327909', '1181503925419909', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476062e0-8a9b-11e8-a635-c7d5f572d454', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925342910', '1181503925413910', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47609900-8a9b-11e8-bce5-dbda765968cd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925304911', '1181503925920911', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4760ef50-8a9b-11e8-950a-03ecd8ad4bc3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925308912', '1181503925893912', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47614240-8a9b-11e8-8c79-4d28d76ad952', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925342913', '1181503925093913', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47619c40-8a9b-11e8-87fb-67ffbf3f40e9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925307914', '1181503925178914', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4761d6c0-8a9b-11e8-9815-354133b76ebd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925321915', '1181503925936915', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47622c20-8a9b-11e8-b6b3-b91ee228917d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925316916', '1181503925806916', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47627130-8a9b-11e8-b883-cd694b4c1285', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925345917', '1181503925512917', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4762cf50-8a9b-11e8-b940-fd63b39d3356', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925357918', '1181503925700918', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47630b80-8a9b-11e8-8285-55d1a535952e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925340919', '1181503925463919', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476356a0-8a9b-11e8-aa1d-95e8f53f071c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925362920', '1181503925219920', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47639360-8a9b-11e8-b6b9-f98c0d7c90b7', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925394921', '1181503925001921', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47640160-8a9b-11e8-bf78-5b3a9297ddce', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925342922', '1181503925499922', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47643f70-8a9b-11e8-89f1-edcd92999450', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925396923', '1181503925010923', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476495d0-8a9b-11e8-a064-315d6c0c5c2c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925365924', '1181503925305924', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4764d3a0-8a9b-11e8-b0a1-5590f639bfa3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925337925', '1181503925202925', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47652e00-8a9b-11e8-928e-bfd60e820827', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925312926', '1181503925552926', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47656f20-8a9b-11e8-9dc4-ff1d10d195cc', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925364927', '1181503925630927', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4765bc70-8a9b-11e8-bc4b-ed17560a716f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925324928', '1181503925550928', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47665400-8a9b-11e8-ae9a-d1ba00769c62', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925344929', '1181503925798929', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47669310-8a9b-11e8-976a-0b2ff29fe8f6', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925337930', '1181503925873930', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4766e640-8a9b-11e8-aa13-c77dc105755c', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925332931', '1181503925765931', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47671d70-8a9b-11e8-914c-7162db4a8481', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925301932', '1181503925785932', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47675ff0-8a9b-11e8-8a91-050eabf68486', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925303933', '1181503925085933', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4767cbf0-8a9b-11e8-b922-59c43df560e2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925304934', '1181503925049934', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47682500-8a9b-11e8-b1fe-dd4b08f09fbe', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925335935', '1181503925034935', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476858a0-8a9b-11e8-8c6c-51d6682c6eea', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925334936', '1181503925151936', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4768b4a0-8a9b-11e8-89ba-ddc423d2ffbb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925396937', '1181503925683937', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476916a0-8a9b-11e8-9058-bb2746dc7f2d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925334938', '1181503925930938', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476982e0-8a9b-11e8-a30d-a95c79633008', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925314939', '1181503925184939', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4769c520-8a9b-11e8-abdd-595ccd3295e5', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925354940', '1181503925453940', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476a1a50-8a9b-11e8-972b-ffce65b3d03f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925313941', '1181503925265941', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476a52e0-8a9b-11e8-92cf-bdca05f10e55', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925301942', '1181503925350942', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL);
INSERT INTO `tbl_tiket` (`id`, `id_cetak_tiket`, `kap`, `pin`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('476b76a0-8a9b-11e8-9c14-3ff5e8c741de', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925329943', '1181503925347943', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476bd490-8a9b-11e8-9aa8-1bc6e1050956', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925330944', '1181503925047944', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476c0da0-8a9b-11e8-99a7-0fb11332030b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925334945', '1181503925616945', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476c6480-8a9b-11e8-86c1-0d28e5749e35', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925315946', '1181503925572946', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476cb160-8a9b-11e8-b05e-8f8b9caeb78d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925346947', '1181503925449947', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476d2ef0-8a9b-11e8-83ee-4d8ecdc60612', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925353948', '1181503925279948', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476d6f20-8a9b-11e8-b3aa-15b8ec04cef0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925347949', '1181503925631949', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476e0030-8a9b-11e8-8a95-2f06ca5d50a3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925319950', '1181503925696950', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476e71c0-8a9b-11e8-8866-7907db026061', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925333951', '1181503925069951', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476ee3e0-8a9b-11e8-bb3e-7748b47edff3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925388952', '1181503925983952', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476f5040-8a9b-11e8-a397-53c3a552345a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925391953', '1181503925215953', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('476fdcb0-8a9b-11e8-be4f-dde97dfe94ce', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925330954', '1181503925865954', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4770eba0-8a9b-11e8-a4b1-4bdfec96a0fe', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925346955', '1181503925964955', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47718f40-8a9b-11e8-9fdf-21bea0923d99', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925386956', '1181503925839956', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('477206b0-8a9b-11e8-ab3f-7fee0f0098b1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925395957', '1181503925259957', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47724920-8a9b-11e8-9cbe-5dc2ff84fce1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925326958', '1181503925621958', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4772aab0-8a9b-11e8-95ca-2563ef670828', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925395959', '1181503925283959', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4772f440-8a9b-11e8-b0fd-37964c28a518', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925300960', '1181503925602960', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47736ad0-8a9b-11e8-8701-f18b39eff675', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925310961', '1181503925153961', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4773d260-8a9b-11e8-b550-010cf0e3a261', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925352962', '1181503925757962', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47741340-8a9b-11e8-90a1-0553db68415f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925358963', '1181503925014963', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('477495d0-8a9b-11e8-8b70-b150adddf693', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925351964', '1181503925568964', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4774e750-8a9b-11e8-bac6-956cf682067f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925395965', '1181503925184965', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47752b00-8a9b-11e8-9e73-13f2bde01788', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925355966', '1181503925165966', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('477564b0-8a9b-11e8-a7fe-3f1c6af641eb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925342967', '1181503925540967', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4775bfc0-8a9b-11e8-a9cd-23dcf7da4a8e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925387968', '1181503925620968', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47762710-8a9b-11e8-9b4b-e75956c872e3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925309969', '1181503925678969', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('477667f0-8a9b-11e8-98f4-c5e42c0db2f8', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925336970', '1181503925376970', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4776cbf0-8a9b-11e8-a95c-7738a75e57b3', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925379971', '1181503925186971', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47771c00-8a9b-11e8-8fd5-cb4c32d7cbd2', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925313972', '1181503925345972', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47778280-8a9b-11e8-b730-a5b9265bfe9a', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925389973', '1181503925621973', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4777c360-8a9b-11e8-b203-f32ff7d10c95', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925346974', '1181503925146974', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47784370-8a9b-11e8-a137-87e4521a4dc1', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925331975', '1181503925099975', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4778a8c0-8a9b-11e8-a314-336fc4579d46', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925383976', '1181503925280976', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4778e0f0-8a9b-11e8-b26f-b9d1fadc88bb', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925374977', '1181503925164977', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47793d80-8a9b-11e8-8dd9-f766bc38f5bd', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925393978', '1181503925840978', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47798f20-8a9b-11e8-9c08-57df19f8b6c0', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925351979', '1181503925249979', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4779e2c0-8a9b-11e8-b545-abd4d0027510', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925303980', '1181503925732980', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47800980-8a9b-11e8-affd-23983f865102', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925301981', '1181503925072981', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47805bd0-8a9b-11e8-8b53-ed8537b5a46b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925366982', '1181503925128982', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4780bda0-8a9b-11e8-a8ee-69a7a315e941', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925364983', '1181503925634983', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4780f2b0-8a9b-11e8-84aa-e7e0e0ec3e26', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925302984', '1181503925925984', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('478149f0-8a9b-11e8-902e-956a0ad3f5b4', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925336985', '1181503925844985', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('478188e0-8a9b-11e8-a7d6-437bfaaaa009', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925300986', '1181503925998986', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4781d820-8a9b-11e8-960a-6bc4e3b4661f', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925368987', '1181503925798987', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47821890-8a9b-11e8-8d9b-e9697241d603', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925355988', '1181503925414988', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47827d20-8a9b-11e8-9d77-29d3718dd18b', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925398989', '1181503925672989', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4782b830-8a9b-11e8-9576-d91a55ab2676', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925365990', '1181503925413990', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47830970-8a9b-11e8-aafb-91f1670da7b9', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925312991', '1181503925640991', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('478357b0-8a9b-11e8-a641-a9b1ef2d7f0d', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925311992', '1181503925920992', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4783c340-8a9b-11e8-94f2-5587d366fd00', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925312993', '1181503925144993', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('478402d0-8a9b-11e8-85c3-3b8d903f3645', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925391994', '1181503925841994', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47845670-8a9b-11e8-9804-53e7a8a79070', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925354995', '1181503925656995', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('47849620-8a9b-11e8-b3af-3db6d8d274ff', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925377996', '1181503925515996', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('4784f500-8a9b-11e8-8cce-870078bcfc98', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925328997', '1181503925413997', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('478545d0-8a9b-11e8-ae4e-99d5fa2cf67e', '46318a60-8a9b-11e8-867f-fbbba0211a0a', '115925369998', '1181503925706998', NULL, '2018-07-18 08:00:15', '2018-07-18 08:00:15', NULL),
('52f73b60-9192-11e8-9bc9-0b3baa3bb63a', '52ee4600-9192-11e8-81ce-d1887c9f2986', '127697386000', '1184706697654000', NULL, '2018-07-27 11:43:47', '2018-07-27 11:43:47', NULL),
('5302f550-9192-11e8-88a1-89ae067393c5', '52ee4600-9192-11e8-81ce-d1887c9f2986', '127697373001', '1184706697720001', NULL, '2018-07-27 11:43:47', '2018-07-27 11:43:47', NULL),
('53072200-9192-11e8-84c4-4b489e019be6', '52ee4600-9192-11e8-81ce-d1887c9f2986', '127697322002', '1184706697948002', NULL, '2018-07-27 11:43:47', '2018-07-27 11:43:47', NULL),
('530ec340-9192-11e8-8671-5ffb93fe08e6', '52ee4600-9192-11e8-81ce-d1887c9f2986', '127697373003', '1184706697111003', NULL, '2018-07-27 11:43:47', '2018-07-27 11:43:47', NULL),
('5314b340-9192-11e8-a6df-abc8baf711eb', '52ee4600-9192-11e8-81ce-d1887c9f2986', '127697356004', '1184706697801004', NULL, '2018-07-27 11:43:47', '2018-07-27 11:43:47', NULL),
('659e8000-9217-11e8-8bd3-5793fd083af8', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742351000', '1182210742290000', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65aa3090-9217-11e8-9800-578f679d6c00', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742397001', '1182210742157001', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65b003a0-9217-11e8-89e5-53c18b24f8e3', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742337002', '1182210742320002', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65b60be0-9217-11e8-9e9c-cda607dc6fb1', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742369003', '1182210742214003', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65bbddc0-9217-11e8-b2ba-a1baac50c22a', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742335004', '1182210742396004', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65c1e660-9217-11e8-813e-53e876056611', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742349005', '1182210742062005', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65c7a3f0-9217-11e8-8a75-cfe4e2918230', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742399006', '1182210742950006', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65cdbf60-9217-11e8-bdad-0f7cd6dd6f96', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742370007', '1182210742060007', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65d37d50-9217-11e8-8aad-75b78ca11960', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742397008', '1182210742600008', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65d99a50-9217-11e8-9f5f-9b74de8efa58', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742365009', '1182210742950009', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65df56d0-9217-11e8-b944-9963fe05cfa3', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742390010', '1182210742367010', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65e574c0-9217-11e8-b024-df9bbeff5377', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742394011', '1182210742687011', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65eb3420-9217-11e8-9740-9bfe4c4e4b6c', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742391012', '1182210742195012', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65f14dd0-9217-11e8-bc8b-8b10a7ca5d90', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742383013', '1182210742455013', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65f70de0-9217-11e8-be16-4f92fb16a377', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742366014', '1182210742709014', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('65fd2a10-9217-11e8-94ce-0b9a0a2340fe', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742317015', '1182210742300015', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('6602e700-9217-11e8-ba14-7f3fe114e5ff', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742389016', '1182210742281016', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('660aa800-9217-11e8-b15b-a9e2ab2cc05c', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742378017', '1182210742129017', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('6614e250-9217-11e8-9c35-91b03e0a5d0a', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742391018', '1182210742550018', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('661a9910-9217-11e8-9de2-516591c8d95b', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '182742313019', '1182210742522019', NULL, '2018-07-28 03:36:22', '2018-07-28 03:36:22', NULL),
('6620ba30-9217-11e8-b954-a5479faa33bd', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743313020', '1182310743228020', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('662824f0-9217-11e8-bb8d-9324f68f4b94', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743319021', '1182310743165021', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('66323880-9217-11e8-9589-bd07dbe833e6', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743323022', '1182310743106022', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('66429a50-9217-11e8-a79b-5bbf05215ed5', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743374023', '1182310743635023', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('664d6920-9217-11e8-9d1f-d731f9632961', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743323024', '1182310743596024', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('66538d10-9217-11e8-9c4b-33e43f96dc87', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743341025', '1182310743868025', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('666368d0-9217-11e8-8470-335e77ebe72a', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743325026', '1182310743161026', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('66705220-9217-11e8-97fe-2385cb049334', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743343027', '1182310743408027', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('667e5320-9217-11e8-8854-4b89a9ea6862', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743398028', '1182310743048028', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('6686e210-9217-11e8-ac21-9d7dbeea5131', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743313029', '1182310743319029', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('668d19a0-9217-11e8-b944-51acb6e2374f', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743388030', '1182310743281030', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('6692c170-9217-11e8-b0cb-4b5c3609e1c5', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743327031', '1182310743523031', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('6698f620-9217-11e8-9217-13635ebaf137', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743379032', '1182310743165032', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('669e9980-9217-11e8-9e83-4f198cbcd8f7', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743316033', '1182310743639033', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('66a4d270-9217-11e8-8e92-47a552a9bd4b', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743379034', '1182310743636034', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('66aa7180-9217-11e8-8f0e-277ab4e20152', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743360035', '1182310743992035', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('66b0a720-9217-11e8-8227-a9771d55035e', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743394036', '1182310743281036', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('66b70600-9217-11e8-9ff5-b54061387e97', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '183743329037', '1182310743462037', NULL, '2018-07-28 03:36:23', '2018-07-28 03:36:23', NULL),
('66be3a00-9217-11e8-86b2-6333edf9e3d9', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744332038', '1182410744151038', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('66cf2460-9217-11e8-9ffd-a34249bc0d35', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744319039', '1182410744754039', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('66e01140-9217-11e8-aef1-8b118ddcf4ce', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744346040', '1182410744562040', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('66e5b400-9217-11e8-9c9e-a7022be86f0d', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744318041', '1182410744517041', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('66ebf940-9217-11e8-aea5-810840f1c0fb', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744369042', '1182410744817042', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('66f18f00-9217-11e8-9194-fb8ebbf53195', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744343043', '1182410744654043', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('66f7ca10-9217-11e8-ace8-c9dfebe47945', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744313044', '1182410744710044', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('66fd95e0-9217-11e8-9b7b-07e2597b279e', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744383045', '1182410744587045', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('6703a040-9217-11e8-9864-f714827e040b', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744346046', '1182410744807046', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('670f0280-9217-11e8-b55e-93447de1fae9', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744349047', '1182410744604047', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('6717b910-9217-11e8-abd5-cb9775eaf6d8', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744381048', '1182410744959048', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('6720b610-9217-11e8-8de7-476b33871547', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744347049', '1182410744016049', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('672ca6e0-9217-11e8-8380-c3b58d886d78', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744388050', '1182410744460050', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('6736ff10-9217-11e8-83a5-ebded1fb67f6', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744336051', '1182410744266051', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('673d3060-9217-11e8-a589-83e8016b1f3a', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744312052', '1182410744425052', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('6742d5b0-9217-11e8-86dc-d10d8836b044', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744381053', '1182410744004053', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('67490aa0-9217-11e8-8036-d3f529e8ce80', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744330054', '1182410744471054', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('674eb370-9217-11e8-9dd0-81aad382f841', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '184744354055', '1182410744085055', NULL, '2018-07-28 03:36:24', '2018-07-28 03:36:24', NULL),
('6754e6b0-9217-11e8-b90c-7b78f1b5d4fe', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745394056', '1182510745324056', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('676663c0-9217-11e8-be28-9f7bd7f44b97', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745395057', '1182510745131057', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('67732ec0-9217-11e8-9f69-15df6b29df62', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745378058', '1182510745296058', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('678a0780-9217-11e8-a732-2d2c074e8f3d', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745321059', '1182510745472059', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('679434e0-9217-11e8-a56e-e77f6f236464', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745346060', '1182510745116060', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('67b7aac0-9217-11e8-b0b9-bf4ebf6b1b5b', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745377061', '1182510745204061', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('67bf95e0-9217-11e8-9f8c-ab045353d690', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745380062', '1182510745494062', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('67c954c0-9217-11e8-a6dc-977cbdde790c', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745374063', '1182510745991063', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('67d7e650-9217-11e8-b69e-15683eb1aa21', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745301064', '1182510745064064', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('67dfbf80-9217-11e8-b890-817e3dd56791', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '185745349065', '1182510745346065', NULL, '2018-07-28 03:36:25', '2018-07-28 03:36:25', NULL),
('67ea3c80-9217-11e8-8c7a-d9a4cf9c3545', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746352066', '1182610746076066', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('67fd0970-9217-11e8-bdbc-773cbe18b9ec', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746361067', '1182610746813067', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('6815b5c0-9217-11e8-a956-61cb90384a5f', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746367068', '1182610746210068', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('681d38c0-9217-11e8-8b14-b7ba7e5b215a', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746363069', '1182610746339069', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('68252590-9217-11e8-ba98-7ff11a136f53', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746301070', '1182610746607070', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('68306020-9217-11e8-bc4c-350867bf3249', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746323071', '1182610746228071', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('683a1b30-9217-11e8-ab46-9d58a60efb08', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746370072', '1182610746909072', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('68428190-9217-11e8-9700-59f9ced6205e', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746341073', '1182610746368073', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('6857b970-9217-11e8-a420-b739e91b5610', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746397074', '1182610746520074', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('68642e80-9217-11e8-ac36-3787542ee2a5', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746319075', '1182610746355075', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('686e1780-9217-11e8-a364-1906f4682c1a', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746331076', '1182610746616076', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('6874ea20-9217-11e8-afad-2fa272a2f27e', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746317077', '1182610746055077', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('687a6220-9217-11e8-b928-c7d5abf04a4d', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '186746320078', '1182610746190078', NULL, '2018-07-28 03:36:26', '2018-07-28 03:36:26', NULL),
('68815020-9217-11e8-a7a4-8b41524b3b37', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747306079', '1182710747371079', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('688fd7a0-9217-11e8-ae39-8da275cf780e', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747323080', '1182710747137080', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('68959ce0-9217-11e8-9b90-c1ce730fec91', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747330081', '1182710747896081', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('68ab8cd0-9217-11e8-b3ef-17b845aacf34', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747392082', '1182710747675082', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('68bf1c50-9217-11e8-8f69-5d14b2f190fa', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747362083', '1182710747774083', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('68cd9320-9217-11e8-bb9e-5934316377a4', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747357084', '1182710747277084', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('68dd45d0-9217-11e8-9c61-d9a94aebfc3d', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747306085', '1182710747856085', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('68e6c6b0-9217-11e8-81fd-b56afde55726', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747370086', '1182710747761086', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('68eb4450-9217-11e8-a486-4db803927195', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747333087', '1182710747143087', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('68f0f130-9217-11e8-80fd-f3cb2132dd94', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747347088', '1182710747582088', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('68f964c0-9217-11e8-8ba9-772db63eb145', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747334089', '1182710747309089', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('69018f60-9217-11e8-8fc9-63993110b945', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747350090', '1182710747943090', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('690bf8c0-9217-11e8-a6c1-6b3bdae94d20', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747300091', '1182710747509091', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('69141be0-9217-11e8-aa53-db0fb9497dd3', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747392092', '1182710747345092', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('69198e40-9217-11e8-b7be-95af260085b3', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '187747339093', '1182710747315093', NULL, '2018-07-28 03:36:27', '2018-07-28 03:36:27', NULL),
('691fc230-9217-11e8-92fb-e3bffed82bef', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '188748324094', '1182810748279094', NULL, '2018-07-28 03:36:28', '2018-07-28 03:36:28', NULL),
('692dcb50-9217-11e8-955c-b57847609ead', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '188748314095', '1182810748464095', NULL, '2018-07-28 03:36:28', '2018-07-28 03:36:28', NULL),
('69407c20-9217-11e8-a9ac-973f2297982d', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '188748366096', '1182810748601096', NULL, '2018-07-28 03:36:28', '2018-07-28 03:36:28', NULL),
('694a9220-9217-11e8-94d7-b38e4333bbe7', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '188748394097', '1182810748239097', NULL, '2018-07-28 03:36:28', '2018-07-28 03:36:28', NULL),
('69528a30-9217-11e8-8922-c556db4b4f69', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '188748336098', '1182810748372098', NULL, '2018-07-28 03:36:28', '2018-07-28 03:36:28', NULL),
('69582440-9217-11e8-a70c-ed8c5663920b', '65971c00-9217-11e8-b0eb-0f1428b1fabc', '188748372099', '1182810748894099', NULL, '2018-07-28 03:36:28', '2018-07-28 03:36:28', NULL),
('a7bf5eb0-9217-11e8-a201-d390da1861ae', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743377000', '1181310743137000', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('a7c79b10-9217-11e8-88f5-c1344d15197f', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743346001', '1181310743068001', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('a7cc3720-9217-11e8-bf55-a5dc1aa1e176', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743384002', '1181310743885002', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('a7d88a70-9217-11e8-8c54-f7f7b9e878b8', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743368003', '1181310743969003', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('a7f042c0-9217-11e8-8567-d1d2242b2f1c', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743305004', '1181310743859004', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('a7fa79c0-9217-11e8-9e66-95e1fcbe3b80', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743379005', '1181310743108005', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('a7ff00b0-9217-11e8-b524-0d0c682e32ea', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743336006', '1181310743024006', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('a8080520-9217-11e8-a767-b7fe058e84e8', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743379007', '1181310743329007', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('a80eb910-9217-11e8-be6d-25fae9efbaab', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743356008', '1181310743136008', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('a8150480-9217-11e8-acf6-4f034b9c56ec', 'a7a7b3c0-9217-11e8-b37f-f7a0d7fb5c08', '193743394009', '1181310743397009', NULL, '2018-07-28 03:38:13', '2018-07-28 03:38:13', NULL),
('f3819550-83d6-11e8-97d6-3967af57810d', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '195163567995', '9.54364061343258e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3821780-83d6-11e8-9093-7f5031866121', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '203665584481', '7.28874623049441e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38271a0-83d6-11e8-ab7d-09d9a8ef7dd2', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '319105645645', '1.82140498543928e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3830b40-83d6-11e8-a148-db4111c432bd', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '220587490256', '8.701754141704e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3834b40-83d6-11e8-bc9c-453517548f10', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '112771971281', '9.51048733477681e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3839dd0-83d6-11e8-aedb-7d4d223474c6', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '458049702809', '2.06442142574701e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f383d910-83d6-11e8-aa72-4b0b67a32467', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '456901233585', '4.03231483818266e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3843630-83d6-11e8-b9d8-4f68e0bca850', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '288794808996', '4.79569919346473e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3847ce0-83d6-11e8-8b7d-81565c68d939', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '546864995828', '4.28389951078652e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f384d7a0-83d6-11e8-b717-cde925155fa7', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '692649969487', '2.99730094730389e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38514f0-83d6-11e8-9f4d-a9f44d3c5691', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '758428813032', '5.4662791158842e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3856530-83d6-11e8-92ca-cbe01740ac3e', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '356696532317', '3.18592595159832e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3859a90-83d6-11e8-8b6c-81578773240a', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '957670272229', '1.59067351951633e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f385e830-83d6-11e8-82e6-298147cc42c4', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '267875383127', '4.02521781699242e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38635b0-83d6-11e8-9b24-ef1bd6299820', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '113957266725', '9.11983873563585e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3869b50-83d6-11e8-960b-bdbced4cf190', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '554578341466', '5.63385943572869e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f386e0e0-83d6-11e8-9759-4508e5957fff', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '998006668528', '3.63056973830966e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3873fe0-83d6-11e8-952f-592b8da02c73', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '277590166518', '4.66612589307788e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38776e0-83d6-11e8-b712-1feb6fafa0a2', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '358873624797', '9.45024026627205e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f387c5a0-83d6-11e8-bd2d-191f012f3c2f', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '698408395968', '9.87858849899869e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3880410-83d6-11e8-abce-0ff2a471c61a', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '543984333524', '7.46550474115893e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3883b00-83d6-11e8-abb8-c31c6c81cd1a', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '497767500526', '9.41141074477224e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f388a6c0-83d6-11e8-94ae-0f25da8d0d1d', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '758189487333', '6.8714710515845e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3891310-83d6-11e8-af9c-8bfc4c02adc4', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '549501899426', '2.28385537225567e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38965e0-83d6-11e8-aedd-5b174930876b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '241475314597', '1.28066301398832e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f389d6b0-83d6-11e8-8390-c908351e6f81', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '981793965444', '2.42374508288459e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38a44d0-83d6-11e8-aa4e-331da3262f77', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '118953533517', '7.34774243790672e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38a9df0-83d6-11e8-a283-df6c44b454b9', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '305185133184', '4.89947944603698e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38afe60-83d6-11e8-8f05-3b10caef99d8', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '437224516660', '1.54432419417902e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38b4b10-83d6-11e8-a218-51f2415a57a5', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '296108343938', '3.35734079696961e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38ba660-83d6-11e8-9ff5-1b798ba63e30', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '632260552284', '3.97667408147622e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38be200-83d6-11e8-a0c0-0373d963727b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '189274164563', '7.62087067359852e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38c4490-83d6-11e8-ac8f-f34e3b6f54e0', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '658294538924', '8.66133635652258e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38c9bc0-83d6-11e8-805a-65defba00700', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '962523484647', '2.33447321063354e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38cd820-83d6-11e8-bf9e-49b99d4a12bf', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '307830844902', '9.06683926263488e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38d11d0-83d6-11e8-ab7c-bfb9c46e5bf8', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '829925167921', '2.43337604064943e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38d6710-83d6-11e8-b282-254f6486ef13', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '100547718902', '6.86472514418468e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38da7e0-83d6-11e8-a00b-f768804d1954', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '600227552441', '1.31334196578174e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38df900-83d6-11e8-9816-e350082232b8', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '664704128974', '9.40279497313521e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38e4560-83d6-11e8-b306-470c7a421b4f', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '847752865297', '1.52369852912374e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38eac90-83d6-11e8-a6d5-21a4e814aa88', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '122018330209', '4.73650858020326e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38ef9a0-83d6-11e8-abb7-bbfd0283efec', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '798350462898', '8.57166073214592e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38f5d40-83d6-11e8-8b01-77d8d5a6fb84', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '455297496572', '6.67239414869156e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38fbb00-83d6-11e8-9185-e563b0ccf4c5', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '943606541234', '5.9698914439273e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f38ff7d0-83d6-11e8-8686-9d34fa63ff98', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '810114711874', '3.76324374277925e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3905620-83d6-11e8-b01a-4f96fb85376b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '291457468429', '9.2805731576523e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f390dd30-83d6-11e8-8b09-6d52f73037c4', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '137825598861', '7.90338285363781e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3914080-83d6-11e8-be68-dd42a6222a08', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '680560400677', '4.02723099667193e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39199a0-83d6-11e8-8148-6d99e7ce17b1', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '462928817926', '8.09382717579317e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f391d5f0-83d6-11e8-8813-af9445f310ad', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '687185829140', '1.81449786152426e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39229b0-83d6-11e8-a4a0-85bcdf64aa1b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '119627638993', '3.6957762143775e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39264a0-83d6-11e8-92ad-1f8b87301d17', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '592495525611', '3.09412497868729e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f392dde0-83d6-11e8-b401-afccea97ac9d', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '177930581742', '6.94232416131893e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3932330-83d6-11e8-93dc-af4b9ab6b504', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '180436467472', '8.88189504523396e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3938a20-83d6-11e8-9d18-4b782be220c4', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '851855689711', '9.57354409404676e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f393d7d0-83d6-11e8-ba8c-3f5eafa50f3b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '122417731052', '3.14373575868324e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3943600-83d6-11e8-aecc-377f3f38d8ca', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '962522926863', '9.65172753333509e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39497e0-83d6-11e8-ab15-e93389024ee5', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '449287289974', '8.49395006163624e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f394d6b0-83d6-11e8-844d-ed50fd04fa9b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '647365144753', '3.84786928113932e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3953ef0-83d6-11e8-8c45-631b24604a06', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '811938523072', '4.77341036053283e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3958150-83d6-11e8-a88f-718963d9da12', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '811433668812', '6.45396379773829e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f395df40-83d6-11e8-a9be-ff00dbaa3b7e', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '523404182375', '2.91370692446897e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39632a0-83d6-11e8-bcbe-e9832b5753ff', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '381491470336', '5.18385709572143e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39690a0-83d6-11e8-9394-19dd465e24e9', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '768473607550', '2.432137539151e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f396cdb0-83d6-11e8-9d75-d7d5865e617d', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '753949599438', '7.67990556025765e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3972080-83d6-11e8-ad13-9948f39a47c6', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '542619175242', '2.16962922032628e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3975bf0-83d6-11e8-a38d-29e560dc94b4', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '699169863698', '8.99911305499876e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f397c3d0-83d6-11e8-b702-51dadef9b8ae', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '803733886740', '1.08573754040299e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3980f80-83d6-11e8-b06b-c944107bd792', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '512996321437', '6.20956205881377e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3986870-83d6-11e8-a313-c37b6c507716', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '314994923376', '9.12052601921711e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f398b250-83d6-11e8-83ec-e1c13049b066', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '509021663251', '7.82056198715813e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3990990-83d6-11e8-8174-d9f485b94a59', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '443737718916', '6.38937121751785e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3995170-83d6-11e8-9db6-ff881cfe5eec', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '928251262437', '1.69928407681428e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f399aee0-83d6-11e8-a912-07abea0c83d7', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '259690198291', '4.80353556374117e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39a0bd0-83d6-11e8-aa89-2741b29c7c12', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '780016130989', '8.83519545273589e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39a4d90-83d6-11e8-9a68-e9a41e88ad90', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '756421434641', '3.49780094948815e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39aade0-83d6-11e8-b30b-454f2a145709', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '583836691323', '2.2794255971958e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39aee80-83d6-11e8-95b0-b51c1cf951c9', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '905796645279', '7.09928503555964e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39b4d00-83d6-11e8-8bd5-b9d41525f6ee', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '833851854657', '6.67461522355224e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39b8ea0-83d6-11e8-a986-9d48b5dd7e0f', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '116641462189', '3.72741221246471e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39be100-83d6-11e8-9d13-c549cd23aae7', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '577584652619', '8.9756273531268e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39c1e80-83d6-11e8-9d33-6d57d7e50b3c', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '363467982810', '5.53947932934159e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39c5b30-83d6-11e8-b36e-afb4bd15d013', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '954451457024', '5.67795719556532e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39cb810-83d6-11e8-babf-6f4f0b3dc725', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '278266105643', '3.79843966346235e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39d2270-83d6-11e8-a6f9-81689d7f154d', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '760154441031', '3.55652664407964e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39d6b20-83d6-11e8-92a7-0d2ce82bf5f4', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '938890661695', '8.66786784164662e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39dda00-83d6-11e8-a18f-05593a096e9a', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '354210700843', '6.43145799131724e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39e1fc0-83d6-11e8-9e27-47515888897b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '494433658037', '1.41171997903723e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39e7780-83d6-11e8-9d30-d13219a78c10', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '731732467421', '2.17077882049309e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39eae20-83d6-11e8-86dd-09aeac18a964', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '465998597214', '6.0809664288856e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39f01c0-83d6-11e8-9b32-f923e1e2fc83', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '967009169794', '1.5248504811762e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39f45c0-83d6-11e8-88ec-c5c2f1bb0808', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '452927490811', '2.77559535259868e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39fac60-83d6-11e8-b8d0-ed0b171a7b09', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '187565184548', '3.0162008628569e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f39fea50-83d6-11e8-91d4-67025534689a', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '912617569612', '1.31097211566345e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a04bc0-83d6-11e8-920a-09e859eebe4c', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '356019653749', '1.43182935036794e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a09620-83d6-11e8-8347-cb9de9bd0ce0', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '755639632761', '1.91284736180461e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a0fb10-83d6-11e8-9d5c-27ab6b681439', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '778807839713', '3.61037561306746e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a142b0-83d6-11e8-8118-7d3526de1e70', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '469318171794', '6.72094644193201e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a1a700-83d6-11e8-99a0-ff9d2f125d9a', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '902494670324', '5.26140576044409e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a20fa0-83d6-11e8-a3e6-4b4dbbf3773b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '189758236830', '8.94577624390953e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a253c0-83d6-11e8-8f82-0b648d3837b2', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '799496902169', '2.81435239192845e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a2b6d0-83d6-11e8-b98d-cfe4973a39c3', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '887646802958', '5.05927627876447e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a2fb90-83d6-11e8-be71-698cc2157c2a', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '540327484458', '8.7193346462227e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a355e0-83d6-11e8-b82c-b39245eae870', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '863461948267', '8.7614980786392e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a38e00-83d6-11e8-a391-b57b8e812f01', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '109678708979', '7.03614586939179e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a3dc40-83d6-11e8-ac7a-cb5d337fb8d9', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '369455808516', '5.8995967631935e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a41450-83d6-11e8-986d-9d14b4338569', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '956708523208', '8.70989185550715e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a44a40-83d6-11e8-9768-537884bc37ab', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '292327357939', '7.47057131173447e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a4b170-83d6-11e8-a883-2d67bd61e4f8', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '480172824013', '3.22941908183377e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a50af0-83d6-11e8-b9b0-a51051fd2447', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '330884564616', '9.84773615890347e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a54ee0-83d6-11e8-9852-2fdd1d87adf1', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '844194544184', '9.46477035944806e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a5ae10-83d6-11e8-b385-5f3f5be73a86', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '656520865386', '5.17591194750213e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a5f110-83d6-11e8-a02b-574566fc963b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '910556973479', '8.38369406844934e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL);
INSERT INTO `tbl_tiket` (`id`, `id_cetak_tiket`, `kap`, `pin`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
('f3a64b30-83d6-11e8-834c-e9b0f85fae5b', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '294979655903', '3.78416669528243e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a68f30-83d6-11e8-a439-57deafa64bdd', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '959657250268', '4.76047196870774e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a6eb60-83d6-11e8-b623-41c6b4bde477', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '958475590900', '9.90561792820574e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a76700-83d6-11e8-8183-4bbda2dc69b9', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '108440197510', '1.15613549885256e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a7ce20-83d6-11e8-8172-1b7fc85d42a8', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '537733502980', '5.98575821356271e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a82eb0-83d6-11e8-a809-5f0bde902161', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '727556393141', '5.06887266694712e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL),
('f3a86970-83d6-11e8-85c3-97b1c0f9245f', 'f3801a30-83d6-11e8-a295-f7e7aa62bf35', '110784659487', '6.57516046236965e15', NULL, '2018-07-09 17:19:46', '2018-07-09 17:19:46', NULL);

--
-- Triggers `tbl_tiket`
--
DELIMITER $$
CREATE TRIGGER `cetak_tiket_update_jumlah_tiket` AFTER INSERT ON `tbl_tiket` FOR EACH ROW UPDATE tbl_cetak_tiket SET jumlah_tiket=jumlah_tiket+1 WHERE id=new.id_cetak_tiket
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ujian`
--

CREATE TABLE `tbl_ujian` (
  `id` char(36) NOT NULL,
  `id_tingkat_sekolah` int(4) NOT NULL,
  `id_jenis_ujian` int(4) NOT NULL,
  `id_tingkat_kelas` int(4) DEFAULT NULL,
  `id_mata_pelajaran` int(4) DEFAULT NULL,
  `judul` varchar(100) NOT NULL,
  `peraturan` text,
  `durasi` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL,
  `jumlah_soal` int(11) NOT NULL DEFAULT '0',
  `link_pembahasan` text,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ujian`
--

INSERT INTO `tbl_ujian` (`id`, `id_tingkat_sekolah`, `id_jenis_ujian`, `id_tingkat_kelas`, `id_mata_pelajaran`, `judul`, `peraturan`, `durasi`, `harga`, `jumlah_soal`, `link_pembahasan`, `is_published`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1b3b6f80-9304-11e8-bf2c-efc2da0ea6f0', 1303, 1404, NULL, 1504, 'Soal SBMPTN 2017', NULL, 40, 100000, 3, NULL, 1, '2018-07-29 07:50:48', '2018-07-29 12:22:00', NULL),
('47e6edf0-92f3-11e8-9a60-dd5ad5b5070f', 1302, 1402, 1607, 1501, '2', NULL, 60, 20000, 0, NULL, 0, '2018-07-29 05:50:21', '2018-08-06 00:04:47', NULL),
('7b0688f0-98bd-11e8-9918-0fd496423e88', 1303, 1404, NULL, 1504, 'SBMPTN TES IPA', NULL, 60, 40000, 0, NULL, 1, '2018-08-05 14:40:21', '2018-08-06 00:05:26', NULL),
('95df7770-988a-11e8-afa8-b1ea191c948c', 1301, 1401, NULL, 1501, 'Ujian Nasional Tahun 2007', NULL, 40, 0, 0, NULL, 1, '2018-08-05 08:36:02', '2018-08-05 15:16:19', NULL),
('f56069f0-93a3-11e8-9960-e77dab41c15d', 1303, 1401, NULL, 1502, 'Bahasa Inggris', 'TES', 40, 10000, 3, NULL, 1, '2018-07-30 02:55:04', '2018-08-05 15:16:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_universitas`
--

CREATE TABLE `tbl_universitas` (
  `id` char(36) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_universitas`
--

INSERT INTO `tbl_universitas` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
('6e940130-9415-11e8-b198-4583f8d82b5f', 'Universitas Brawijaya', '2018-07-30 16:27:20', '2018-07-30 16:27:20', NULL),
('74bc03f0-940c-11e8-82d6-c39e578f8cd0', 'Universitas Lampung', '2018-07-30 15:23:05', '2018-07-30 15:23:05', NULL),
('8de2dfb0-940d-11e8-915d-8b900d7f77bf', 'Universitas Indonesia', '2018-07-30 15:30:57', '2018-07-30 15:30:57', NULL),
('9db96a10-9414-11e8-b59c-2f92a5b81684', 'Universitas Riau', '2018-07-30 16:21:30', '2018-07-30 16:21:30', NULL),
('a6537450-940d-11e8-9318-ad01b8183ce7', 'Institute Teknologi Bandung', '2018-07-30 15:31:38', '2018-07-30 16:28:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` char(36) NOT NULL,
  `id_role` int(4) NOT NULL,
  `kap` bigint(12) DEFAULT NULL,
  `pin` bigint(16) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(14) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `asal_sekolah` varchar(70) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `saldo` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `email_verification_code` varchar(255) DEFAULT NULL,
  `email_is_verified` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `id_role`, `kap`, `pin`, `nama`, `email`, `username`, `password`, `no_hp`, `alamat`, `asal_sekolah`, `tempat_lahir`, `foto`, `saldo`, `remember_token`, `email_verification_code`, `email_is_verified`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1ce92d60-77ae-11e8-a04d-8fb905f83ba3', 1004, NULL, NULL, 'Dodo Jasmadi', 'dodojasmadii@gmail.com', 'dodojasmadii', '$2y$10$/eze4sjPOEAdEASxU6KbiOarVGk.gzqcbo.yhJ8BhNQ2yjAdb7yhC', '085696667783', 'Jl. Imam Bonjol Gg. Durian', 'SMK 2 Mei Bandar Lampung', 'Bandar Lampung', NULL, 0, 'RNsXOgJmLG4GfhnU4oIFNYl43wdCSqTWVruRHhmwd98T17CeMpmQaOIJgjEi', NULL, 0, '2018-06-24 05:57:12', '2018-07-06 09:21:50', NULL),
('1d717530-77c6-11e8-a81e-8dd29351d318', 1004, NULL, NULL, 'Niki Rahmadi Wiharto', 'nikirahmadiwihart@gmail.com', 'nikirw', '$2y$10$8mN4ba6kFbdqwhfnaZMf5OidWUHDH4KnYFOB7KDnhF6wOmJwb5Ily', '085783104873', 'Jl. Senopati Blok 1A', 'Smk 2 Mei Bandar lamung', 'Bandar Lampung', NULL, 0, '6oe6Hai7YCK1Cq3ZnNnSy9skyE0zY6pAFg8aVNz3pgwtbAfd9RVyRg0mb6K0', '$2y$10$olf1cOqsQmRlbnntsEnNt.e1OoGwpyKEH84iAv6tmZGrjOmeL77YO', 0, '2018-06-24 08:49:01', '2018-07-19 00:28:08', NULL),
('2e4cb000-74b0-11e8-b897-4d5bdd8ac141', 1004, NULL, NULL, 'Saiful Anwar', 'saiful@gmail.com', 'saiful', '$2y$10$meyVRau4d.Pwjc84BWTEE.VYsnhjd0IdqEE6euAyG3qWUl8PCWD4i', '085696667783', 'Jl. Haji Mena', 'Smk 2 Mei Bandar lamung', 'Bandar Lampung', NULL, 900000, 'lnqSOA4bJtcuU6b9UdMWuoY8P7B2XUN8z37tU1DW8iZQZu98vsxLoBR5ZGqP', '$2y$10$P1FBP86yhNDcMc2l52nAS.xVLbuMUjZ3jrxRfUJbAcdV.2lbHELaO', 0, '2018-06-20 10:34:27', '2018-07-28 02:02:02', NULL),
('4bc22b70-7416-11e8-ab08-437417ec4b96', 1001, NULL, NULL, 'Niki Rahmadi Wiharto', 'niki@gmail.com', 'nikirahmadi', '$2y$10$M.9LOGLb5pMlNcSpo6045ehxYB1TQfB6SWp/moJOwQ0XA505q7Pyi', '', 'Bandar Lampung', 'SMK 2 Mei Bandar Lampung', 'Bandar Lampung', NULL, 0, 'Vw2iN9rt3duKlCw9dMbfD23iksnMHrilcXluRs8vW76yqi9QNeWNY9MrPeey', NULL, 0, '2018-06-19 16:12:54', '2018-06-19 18:18:34', NULL),
('51aec9f0-8b27-11e8-a7cf-c96bd96ef905', 1004, 113923314005, 1181303923958005, 'Niki Rahmadi Wiharto', 'nikirahmadiwiharto@gmail.com', 'nikirahmadir', '$2y$10$8mN4ba6kFbdqwhfnaZMf5OidWUHDH4KnYFOB7KDnhF6wOmJwb5Ily', '085696667783', 'jtm', '2 mei', 'bdl', NULL, 1920000, 'uaNcsUodSU8qPfQzGe71hHRJNyPVAPyPUE1RM0Y47gRVRt3tIV1OFHY3HJos', NULL, 1, '2018-07-19 00:42:42', '2018-07-19 00:48:02', NULL),
('5b24d370-7515-11e8-9b4b-4f79a4fceb2d', 1003, NULL, NULL, 'Admin Tiket', 'admintiket@gmail.com', 'admintiket', '$2y$10$dWejJn5Z8JN59xU4nBfxHujLUWeMtYI.BDADDFANwpjB4L56SGl7q', NULL, NULL, NULL, NULL, NULL, 0, 'h4lRHvmCXgll8OFTitmiylt1h9SpVZvuR7EnwdUGN9dTDLMitGeJVgX5g2ez', NULL, 0, '2018-06-20 22:38:41', '2018-06-24 05:17:54', NULL),
('d1ab8960-7428-11e8-84a9-a17f4599cb08', 1002, NULL, NULL, 'Lia San', 'lia@gmail.com', 'liasan', '$2y$10$CJNgwuWsD8R0beDfwVlPp./F9Wy3QD9xexJ4Vma3L4OR.uvIugPgG', '085696667783', 'Jl. Imam Bonjol Gg. Durian', 'SMK 2 Mei Bandar Lampung', 'Bandar Lampung', NULL, 0, 'SFJgehU5Jk4TBWXOYgJZOmJoWivIeeSVyoBLcR8xWlIhPHbe6wXjYuRmF7DN', '$2y$10$uUV2EMz7gHgf0oCJQAXsdOn9VjmO.NZvZUdtvxeRlrhKpO8AUoZ2e', 0, '2018-06-19 18:25:30', '2018-07-27 13:43:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `set_kategori`
--
ALTER TABLE `set_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_pustaka`
--
ALTER TABLE `set_pustaka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `tbl_attempt`
--
ALTER TABLE `tbl_attempt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indexes for table `tbl_attempt_correction`
--
ALTER TABLE `tbl_attempt_correction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_attempt` (`id_attempt`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `tbl_cetak_tiket`
--
ALTER TABLE `tbl_cetak_tiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_tiket` (`id_kategori_tiket`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_grup_chat`
--
ALTER TABLE `tbl_grup_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_grup_chat` (`id_kategori_grup_chat`);

--
-- Indexes for table `tbl_grup_chat_member`
--
ALTER TABLE `tbl_grup_chat_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grup_chat` (`id_grup_chat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kategori_grup_chat` (`id_kategori_grup_chat`);

--
-- Indexes for table `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_author` (`id_author`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_universitas` (`id_universitas`);

--
-- Indexes for table `tbl_password_reset`
--
ALTER TABLE `tbl_password_reset`
  ADD KEY `email` (`email`);

--
-- Indexes for table `tbl_pembelian_ujian`
--
ALTER TABLE `tbl_pembelian_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_pilihan_passing_grade`
--
ALTER TABLE `tbl_pilihan_passing_grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_attempt` (`id_attempt`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `pilihan_1` (`pilihan_1`),
  ADD KEY `pilihan_2` (`pilihan_2`),
  ADD KEY `pilihan_3` (`pilihan_3`),
  ADD KEY `jurusan` (`jurusan`);

--
-- Indexes for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ujian` (`id_ujian`);

--
-- Indexes for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kap_2` (`kap`),
  ADD UNIQUE KEY `pin_2` (`pin`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD KEY `kap` (`kap`),
  ADD KEY `pin` (`pin`),
  ADD KEY `id_user_2` (`id_user`),
  ADD KEY `id_cetak_tiket` (`id_cetak_tiket`);

--
-- Indexes for table `tbl_ujian`
--
ALTER TABLE `tbl_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tingkat_sekolah` (`id_tingkat_sekolah`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian`),
  ADD KEY `id_tingkat_kelas` (`id_tingkat_kelas`),
  ADD KEY `id_mata_pelajaran` (`id_mata_pelajaran`);

--
-- Indexes for table `tbl_universitas`
--
ALTER TABLE `tbl_universitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `kap` (`kap`),
  ADD KEY `pin` (`pin`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_attempt_correction`
--
ALTER TABLE `tbl_attempt_correction`
  ADD CONSTRAINT `tbl_attempt_correction_ibfk_1` FOREIGN KEY (`id_attempt`) REFERENCES `tbl_attempt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cetak_tiket`
--
ALTER TABLE `tbl_cetak_tiket`
  ADD CONSTRAINT `tbl_cetak_tiket_ibfk_1` FOREIGN KEY (`id_kategori_tiket`) REFERENCES `set_pustaka` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cetak_tiket_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tbl_grup_chat`
--
ALTER TABLE `tbl_grup_chat`
  ADD CONSTRAINT `tbl_grup_chat_ibfk_1` FOREIGN KEY (`id_kategori_grup_chat`) REFERENCES `set_pustaka` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_grup_chat_member`
--
ALTER TABLE `tbl_grup_chat_member`
  ADD CONSTRAINT `tbl_grup_chat_member_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_grup_chat_member_ibfk_2` FOREIGN KEY (`id_kategori_grup_chat`) REFERENCES `set_pustaka` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_grup_chat_member_ibfk_3` FOREIGN KEY (`id_grup_chat`) REFERENCES `tbl_grup_chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_password_reset`
--
ALTER TABLE `tbl_password_reset`
  ADD CONSTRAINT `tbl_password_reset_ibfk_1` FOREIGN KEY (`email`) REFERENCES `tbl_users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD CONSTRAINT `tbl_tiket_ibfk_1` FOREIGN KEY (`id_cetak_tiket`) REFERENCES `tbl_cetak_tiket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_tiket_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `set_pustaka` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
