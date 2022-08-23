-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mariaDB
-- Generation Time: Aug 18, 2022 at 08:20 AM
-- Server version: 10.7.3-MariaDB-1:10.7.3+maria~focal
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soc`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `properties` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1660707448),
('manager', '1', 1660707448),
('user', '1', 1660707448),
('user', '463', 1660710522);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1651810098, 1651810098),
('/site/*', 2, NULL, NULL, NULL, NULL, NULL),
('manager', 1, NULL, NULL, NULL, 1651810151, 1660704986),
('/usermanager/*', 2, NULL, NULL, NULL, NULL, NULL),
('/report/*', 2, NULL, NULL, NULL, NULL, NULL),
('user', 1, NULL, NULL, NULL, 1660704997, 1660704997),
('/soc/events/*', 2, NULL, NULL, NULL, NULL, NULL),
('/elfinder/*', 2, NULL, NULL, NULL, NULL, NULL),
('/gii/*', 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('manager', 'liff/*'),
('manager', 'site/*'),
('admin', '/usermanager/*'),
('manager', '/person/*'),
('manager', '/reader/*'),
('manager', '/category/*'),
('manager', '/type/*'),
('manager', '/person-task/*'),
('admin', 'manager'),
('manager', '/site/*'),
('manager', '/liff/*'),
('manager', '/category-type/*'),
('admin', '/report/*'),
('admin', '/tracking/*'),
('user', '/site/*'),
('user', '/soc/events/*'),
('user', '/elfinder/*'),
('admin', '/gii/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auto_number`
--

CREATE TABLE `auto_number` (
  `group` varchar(32) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `optimistic_lock` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auto_number`
--

INSERT INTO `auto_number` (`group`, `number`, `optimistic_lock`, `update_time`) VALUES
('20N???????', 1686, 1, 1609387877),
('21N???????', 486, 1, 1613192882),
('3c5efc507583c026f27897d7b4cfa6d5', 49808, 1, 1609420682),
('653426cc3620db3bb1080fb646af3b91', 1, 1, 1643795062),
('76f36000b6de17dac8d1650f155f4371', 1, 1, 1590943789),
('83d622a5eb2176f5240dd6df4875f70f', 8687, 1, 1638847147);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_type` varchar(255) NOT NULL COMMENT 'ประเภทข้อมูล',
  `name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_type`, `name`, `title`) VALUES
(1, '1', 'นักศึกษา', 'นักศึกษา'),
(2, '1', 'บุคลากร', 'บุคลากร'),
(3, '1', 'ภายนอก', 'ภายนอก'),
(4, '2', 'ติดตามตรวจสอบ ยานพาหนะ', 'ติดตามตรวจสอบ ยานพาหนะ'),
(5, '2', 'ติดตามตรวจสอบ เหตุการณ์', 'ติดตามตรวจสอบ เหตุการณ์'),
(6, '2', 'โจรกรรมทรัพย์สิน', 'โจรกรรมทรัพย์สิน'),
(7, '2', 'อื่นๆ', 'อื่นๆ'),
(8, '2', 'โจรกรรมรถจักรยานยนต์', 'โจรกรรมรถจักรยานยนต์'),
(9, '2', 'เหตุทำลายทรัพย์สิน', 'เหตุทำลายทรัพย์สิน'),
(10, '2', 'อุบัติเหตุ', 'อุบัติเหตุ'),
(11, '2', 'งานวิจัยจราจร', 'งานวิจัยจราจร'),
(12, '2', 'ทรัพย์สินตกหล่น', 'ทรัพย์สินตกหล่น'),
(13, '2', 'โจรกรรมรถยนต์', 'โจรกรรมรถยนต์');

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE `category_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL COMMENT 'ประเภท',
  `title` varchar(255) NOT NULL COMMENT 'ชื่อ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`id`, `type_name`, `title`) VALUES
(1, 'person_type', 'ประเภทบุคคล'),
(2, 'even_type', 'เหตุการณ์');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `data_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_json`)),
  `fname` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `lname` varchar(255) NOT NULL COMMENT 'สกุล',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'ชื่อ-สกุล',
  `person_type` int(11) NOT NULL COMMENT 'ประเภทบุคคล',
  `department` varchar(255) DEFAULT NULL COMMENT 'คณะ/หน่วยงาน/สถานที่ทำงาน/สถานศึกษา',
  `address` varchar(255) NOT NULL COMMENT 'ที่อยู่ตามทะเบียนบ้าน',
  `phone` varchar(255) NOT NULL COMMENT 'หมายเลขโทรศัพท์',
  `event_date` datetime NOT NULL COMMENT 'วันและเวลาที่เกิดเหตุ',
  `event_type` int(11) DEFAULT NULL COMMENT 'เหตุการณ์',
  `orther` varchar(255) DEFAULT NULL COMMENT 'รายละเอียดเพิ่มเติม',
  `event_location_note` varchar(255) NOT NULL COMMENT 'บริเวณสถานที่เกิดเหตุ',
  `lat` varchar(255) DEFAULT NULL COMMENT 'latitude',
  `lng` varchar(255) DEFAULT NULL COMMENT 'longitude',
  `work_img` varchar(255) DEFAULT NULL COMMENT 'รูปภาพการปฏิบัติการ',
  `docs` varchar(255) DEFAULT NULL COMMENT 'เอกสารแนบใบคำขอ',
  `result` int(11) DEFAULT NULL COMMENT 'ผลการให้บริการดูกล้องวงจรปิด',
  `note` varchar(255) DEFAULT NULL COMMENT 'รายงานการดำเนินการ',
  `backup_to` int(11) DEFAULT NULL COMMENT 'การขอสำรองข้อมูลให้',
  `backup_type` int(11) DEFAULT NULL COMMENT 'ประเภทไฟล์ข้อมูล',
  `reporter` int(11) DEFAULT NULL COMMENT 'ผู้รายงานเหตุ',
  `worker` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'ผู้ร่วมปฏิบัติงาน' CHECK (json_valid(`worker`)),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) DEFAULT NULL COMMENT 'ผู้สร้าง',
  `updated_by` int(11) DEFAULT NULL COMMENT 'ผู้แก้ไข'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `ref`, `data_json`, `fname`, `lname`, `fullname`, `person_type`, `department`, `address`, `phone`, `event_date`, `event_type`, `orther`, `event_location_note`, `lat`, `lng`, `work_img`, `docs`, `result`, `note`, `backup_to`, `backup_type`, `reporter`, `worker`, `updated_at`, `created_at`, `created_by`, `updated_by`) VALUES
(9, 'ri2nA8CKt454_nipyIQufd', 'null', 'aa', '4334', 'aa 4334', 2, '77', 'mhgjh', '998', '2022-09-09 00:00:00', 4, '', '77', NULL, NULL, '', '', NULL, '', NULL, NULL, NULL, '\"\"', '2022-08-18 02:17:50', '2022-08-18 02:17:50', 1, 1),
(10, 'j_iX7ERAHq0l3q59AY3Lqx', 'null', 'qwer', 'qweqwe', 'qwer qweqwe', 2, '234234', '23423', '234', '2022-08-17 06:30:06', 11, '234', '234', NULL, NULL, '234234', '234', 1, '<p>sdfsdf</p>\r\n', NULL, NULL, NULL, '\"\"', '2022-08-18 04:37:32', '2022-08-18 04:37:32', 1, 1),
(11, 'NOKli5mbfkWxU6ORT7sgwX', 'null', 'qwe', '213123', 'qwe 213123', 1, '123123', '12312', '123', '2022-08-18 11:35:42', 13, '123123', '123', NULL, NULL, '123123', '', NULL, '<p>123123</p>\r\n', NULL, NULL, NULL, '\"\"', '2022-08-18 04:39:07', '2022-08-18 04:39:07', 1, 1),
(12, 'UekWUE9G6z0_sDbHuzZ6Ys', 'null', 'qwe', 'qweqwe', 'qwe qweqwe', 1, 'qweqwe', 'qweqwe', 'qweqwe', '2022-08-18 11:40:20', 7, 'qweqwe', 'qweqwe', NULL, NULL, 'qwe', 'qwe', 1, '<p>qweqwe</p>\r\n', NULL, NULL, NULL, '\"\"', '2022-08-18 04:40:49', '2022-08-18 04:40:49', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1655994422),
('m220418_131905_create_category_table', 1656557806),
('m220418_134516_create_category_type_table', 1656557806),
('m220629_063218_create_events_table', 1656557807);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(200) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL COMMENT 'เสลาที่ login เข้าระบบ',
  `platform` varchar(200) DEFAULT NULL,
  `os` varchar(200) DEFAULT NULL,
  `browser` varchar(200) DEFAULT NULL,
  `browserVersion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `system_data`
--

CREATE TABLE `system_data` (
  `id` varchar(255) NOT NULL,
  `data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `system_data`
--

INSERT INTO `system_data` (`id`, `data`) VALUES
('system', '{\"his_api\":\"http://1dce-180-183-106-242.ngrok.io/HIS/index.php/\",\"barcode_api\":\"http://10.1.88.8:5000/barcode-him\",\"socket_api\":\"http://103.10.229.4:3000\"}');

-- --------------------------------------------------------

--
-- Table structure for table `sys_routing_log`
--

CREATE TABLE `sys_routing_log` (
  `id` int(36) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `routing_id` varchar(255) DEFAULT NULL,
  `data_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, '4m3JYwE_aHLavHnvPJspwGyJK1QcVSMp', 1536588091, 0),
(2, 'N2kymKNbNGiHrPb25847dKM-JV58g4th', 1536589096, 0),
(3, '2f74if5M0qmXWx1UG7sb8LS6F_zPryLd', 1536589140, 0),
(5, 'oeYesvnCZp7knSFgpnnrAICCbqby6ccB', 1536806652, 0),
(6, 'vT539geLI3UmSA8SI4BqiFMQEjbXSUE8', 1536806687, 0),
(7, 'TrJV_5PcL_2BggfZhQ0--wbQkqezXur-', 1536806723, 0),
(8, 'hTMlixlpPpQzF0rZCdUqDjClhOT6RYYg', 1536806748, 0),
(15, 'kiwerHVI2Rn9hedTufwzs5RCrEQEZgV_', 1122334433, 0),
(13, 'FSWxa3uHyYYL2Q3WD86YkkL6vYsiFI2e', 1554801550, 0);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `upload_id` int(11) NOT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `file_name` varchar(150) DEFAULT NULL COMMENT 'ชื่อไฟล์',
  `real_filename` varchar(150) DEFAULT NULL COMMENT 'ชื่อไฟล์จริง',
  `create_date` timestamp NULL DEFAULT current_timestamp(),
  `type` int(11) DEFAULT NULL COMMENT 'ประเภท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`upload_id`, `ref`, `file_name`, `real_filename`, `create_date`, `type`) VALUES
(1, 'XSC0WeoLbMMF13KwJH_AnY', '810.png', '9c750a9bf5751bcbe97b2b4ba2685e08.png', '2022-07-06 12:10:48', NULL),
(2, 'XSC0WeoLbMMF13KwJH_AnY', 'bba.mp4', 'ca6f99eb3e8aa043fd2035bbb8ec8afc.mp4', '2022-07-06 12:14:15', NULL),
(3, 'y9RIH3nuE-lkL-uU2lv7VL', 'Screen Shot 2565-07-12 at 11.16.11.png', 'cdf9c9513cec0442e2daa1ec7ecd1844.png', '2022-07-14 08:10:00', NULL),
(4, 'zj7q2CLdP33O5uVS8l6Icg', 'Screen Shot 2565-07-12 at 11.16.11.png', '91923d1ad0e1cce0d7bdeecf85865118.png', '2022-07-14 08:10:24', NULL),
(5, 'zj7q2CLdP33O5uVS8l6Icg', 'Screen Shot 2565-07-12 at 11.16.11.png', '768b329a931dd21220538b829dbddb7e.png', '2022-07-14 08:11:00', NULL),
(6, '2C4hUUNr6RrxpTzOX0RHuD', 'Screen Shot 2565-07-12 at 11.16.11.png', 'cb508b2d5876d375dddb41dd64d66876.png', '2022-07-14 08:12:27', NULL),
(7, 'yb2r52FlzUaeNpIrcWwiuG', 'Screen Shot 2565-07-12 at 11.16.11.png', 'd7c68078a20e15e00bfd54008bc47af3.png', '2022-07-14 08:24:10', NULL),
(8, 'yb2r52FlzUaeNpIrcWwiuG', 'Screen Shot 2565-07-14 at 15.22.50.png', '5275d348d904f34e5ccd199eec22f66e.png', '2022-07-14 08:24:10', NULL),
(9, 'yb2r52FlzUaeNpIrcWwiuG', 'y2mate.com - Harry Maguire Sound Effect The best quality_1080p.mp4', 'a3d30927f076c84276686336c01596a6.mp4', '2022-07-15 08:19:24', NULL),
(17, 'ZQ-OkAx89PYH1PJ2Fs6H0Y', 'สำเนาของ CCTV กำลังทำงาน.png', '7bd1c1dff29a63fd73ab4e2b7a14df57.png', '2022-08-15 08:36:46', NULL),
(18, 'ZQ-OkAx89PYH1PJ2Fs6H0Y', 'Screen Shot 2565-08-05 at 14.40.53.png', '1d082eaa351c8374599d718fd3751c03.png', '2022-08-15 15:07:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `flags` int(11) DEFAULT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `pname` varchar(20) DEFAULT NULL COMMENT 'คำนำหน้า',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'ชื่อ-สกุล',
  `dep_id` int(11) DEFAULT NULL COMMENT 'หน่วงาน',
  `occ_id` int(11) DEFAULT NULL COMMENT 'อาชีพ',
  `occ_no` varchar(20) DEFAULT NULL COMMENT 'เลขที่ใบประกอบวิชาชีพ',
  `pos_id` int(11) DEFAULT NULL COMMENT 'ตำแหน่ง',
  `pos_no` varchar(20) DEFAULT NULL COMMENT 'เลขที่ประจำตำแหน่ง',
  `role` varchar(5) DEFAULT NULL,
  `doctor_id` varchar(10) DEFAULT NULL COMMENT 'รหัสแพทย์',
  `license_number` varchar(255) DEFAULT NULL COMMENT 'เลขใบประกอบฯ',
  `fullname_en` varchar(255) DEFAULT NULL COMMENT 'ชื่อ - สกุลแพทย์(อังกฤษ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`, `status`, `password_reset_token`, `pname`, `fullname`, `dep_id`, `occ_id`, `occ_no`, `pos_id`, `pos_no`, `role`, `doctor_id`, `license_number`, `fullname_en`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$13$u5UX2ZHrwuKM2tS7eERumuRGVcK5gYdsJ2R6xc6EhekfvEC0aZOoS', 'E91fe3GZnto9i-qnNMR0vK5yniMZBnuF', NULL, NULL, NULL, '::1', 1536588090, 1660707448, NULL, 1581400404, 10, NULL, NULL, 'ปัจวัฒน์ ศรีบุญเรือง', NULL, NULL, NULL, NULL, NULL, '10', '9999', '1400908-009', 'patjawat'),
(463, 'user1', '', '$2y$13$FE6VyxtqzsDn/GdWSYbfbeTYUf2EJwIfdJzy11R9Op0zNTopc3g4C', '2sAOXEKtbBF1ugOFjrVBNoLc-TRM2bMw', NULL, NULL, NULL, NULL, 1656129754, 1660710522, NULL, NULL, 10, NULL, NULL, 'user1', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `auto_number`
--
ALTER TABLE `auto_number`
  ADD PRIMARY KEY (`group`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_type`
--
ALTER TABLE `category_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_data`
--
ALTER TABLE `system_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_routing_log`
--
ALTER TABLE `sys_routing_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `doctor_id` (`doctor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category_type`
--
ALTER TABLE `category_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sys_routing_log`
--
ALTER TABLE `sys_routing_log`
  MODIFY `id` int(36) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
