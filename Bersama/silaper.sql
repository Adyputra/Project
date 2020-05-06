-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2020 at 06:10 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silaper`
--

-- --------------------------------------------------------

--
-- Table structure for table `akunbank`
--

CREATE TABLE `akunbank` (
  `kode_akunbank` varchar(16) NOT NULL,
  `nama_rek` varchar(50) NOT NULL,
  `nama_bank` varchar(15) NOT NULL,
  `no_rek` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akunbank`
--

INSERT INTO `akunbank` (`kode_akunbank`, `nama_rek`, `nama_bank`, `no_rek`) VALUES
('askdnsadajk12189', 'Admin 2', 'BRI', '2i109381920'),
('jhdkashduy128621', 'Admin 1', 'BCA', '21389271389');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `kode_otp` varchar(8) NOT NULL,
  `id_customer` int(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `key_otp` varchar(6) NOT NULL,
  `create_at` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = tidak aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(16) NOT NULL,
  `id_kalender` int(4) NOT NULL,
  `id_customer` int(4) NOT NULL,
  `kode_akunbank` varchar(16) NOT NULL,
  `qty` int(4) NOT NULL,
  `last_price` int(7) NOT NULL,
  `unik` int(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 = batal 1 = wait bayar 2=wait acc admin 3=proses 4 = tolak 5 = selesai',
  `alamat_kirim` varchar(125) NOT NULL,
  `catatan_member` varchar(100) NOT NULL,
  `bukti_tf` varchar(75) NOT NULL,
  `catatan_status` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kode_penjualan`, `id_kalender`, `id_customer`, `kode_akunbank`, `qty`, `last_price`, `unik`, `status`, `alamat_kirim`, `catatan_member`, `bukti_tf`, `catatan_status`, `create_at`) VALUES
('YPRTH3aT8pvqn9S6', 2, 0, 'askdnsadajk12189', 2, 10000, 654, 0, 'jalan pelita', '', 'assets/upload/bukti/2605800a6a37afe589196b70a67d56a8.jpeg', '', '2020-05-05 17:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Coba', 'coba@gmail.com', 'default.jpg', '$2y$10$l02Uf7ujrhreev/C.MDd2.4zovriQJjCWOo8O6D42cJbHXGVWH/gq', 1, 1, 1586351026),
(2, 'Akun 1', 'coba1@gmail.com', 'default.jpg', '$2y$10$dx/AIhaabEbdxwsA5TjuAeU0IUNxFne8AWr8d6iW0csdueiLpdF8e', 2, 1, 1587441817),
(3, 'Fortuna', 'fortuna@gmail.com', 'default.jpg', '$2y$10$f9ZbVyaF.FTk4QyLSlKrnueVzuqT2Uf8rnx0bFLWFknUbShc4TsO.', 2, 1, 1587460957),
(4, 'Huhuhu', 'huhu@gmail.com', 'default.jpg', '$2y$10$8r.jGvFCL7SmxS8Q.phOkOx77aP.gTHSwMJ6WJ/wAr0lyKDHAc.dq', 2, 1, 1587461124);

-- --------------------------------------------------------

--
-- Table structure for table `tbcustomer`
--

CREATE TABLE `tbcustomer` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `daftar_via` int(1) NOT NULL DEFAULT '1' COMMENT '1 = form daftar 2 =google'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbcustomer`
--

INSERT INTO `tbcustomer` (`id`, `nama`, `email`, `password`, `daftar_via`) VALUES
(1, 'Bro', 'bro@gmail.com', '123', 1),
(2, 'Yoks', 'yoks@gmail.com', '00000', 1),
(3, 'Zur', 'zur@gmail.com', '121212', 1),
(4, 'Rahmad', 'rahmad@gmail.com', '232323', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbkalender`
--

CREATE TABLE `tbkalender` (
  `id_kalender` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nama_kalender` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbkalender`
--

INSERT INTO `tbkalender` (`id_kalender`, `image`, `nama_kalender`, `deskripsi`, `harga`) VALUES
(1, 'default.jpg', 'Kalender 1', 'Kalender dijual satuan', 8000),
(2, 'default.jpg', 'kalender 2', 'Kalender sangat berguna bagi kehidupan', 10000),
(3, 'default.jpg', 'kalender 3', 'Kalender the best', 14000),
(4, 'default.jpg', 'kalender 4', 'kalender nomor satu', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `tbkatalog`
--

CREATE TABLE `tbkatalog` (
  `id_katalog` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbkatalog`
--

INSERT INTO `tbkatalog` (`id_katalog`, `nama`) VALUES
(1, 'Kalender'),
(2, 'Undangan');

-- --------------------------------------------------------

--
-- Table structure for table `tbrole`
--

CREATE TABLE `tbrole` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbrole`
--

INSERT INTO `tbrole` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `tbundangan`
--

CREATE TABLE `tbundangan` (
  `id_undangan` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nama_undangan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbundangan`
--

INSERT INTO `tbundangan` (`id_undangan`, `image`, `nama_undangan`, `deskripsi`, `harga`) VALUES
(1, 'undangan.jpg', 'undangan 1', 'undangan sangat dibutuhkan', 6000),
(2, 'undangan.jpg', 'undangan 2', 'undangan number one', 8000),
(3, 'undangan.jpg', 'undangan 3', 'undangan normal', 6000),
(4, 'undangan.jpg', 'undangan 4', 'undangan super', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Administrator'),
(2, 'Menu'),
(3, 'Management');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 1, 'Laporan Pemesanan', 'laporanpemesanan', 'far fa-fw fas fa-file', 1),
(3, 2, 'My Profile', 'profile', 'far fa-fw fa-user', 1),
(4, 2, 'Profile Percetakan', 'profilepercetakan', 'fas fa-fw fa-home', 1),
(5, 2, 'Calendar', 'calendar', 'fas fa-fw fa-calendar-alt', 1),
(6, 2, 'Katalog', 'katalog', 'fas fa-fw fa-folder-open', 1),
(7, 2, 'Data Pemesanan', 'datapemesanan', 'fas fa-fw fa-clipboard-list', 1),
(8, 2, 'Inbox', 'inbox', 'fab fa-fw fa-whatsapp', 1),
(9, 3, 'Management', 'management', 'fas fa-fw fa-folder', 1),
(10, 3, 'Submenu Management', 'management/submenu', 'fas fa-fw fa-folder', 1),
(11, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akunbank`
--
ALTER TABLE `akunbank`
  ADD PRIMARY KEY (`kode_akunbank`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`kode_otp`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- Indexes for table `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbcustomer`
--
ALTER TABLE `tbcustomer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbkalender`
--
ALTER TABLE `tbkalender`
  ADD PRIMARY KEY (`id_kalender`);

--
-- Indexes for table `tbrole`
--
ALTER TABLE `tbrole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbundangan`
--
ALTER TABLE `tbundangan`
  ADD PRIMARY KEY (`id_undangan`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbcustomer`
--
ALTER TABLE `tbcustomer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbkalender`
--
ALTER TABLE `tbkalender`
  MODIFY `id_kalender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbrole`
--
ALTER TABLE `tbrole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbundangan`
--
ALTER TABLE `tbundangan`
  MODIFY `id_undangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
