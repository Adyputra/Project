-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Apr 2020 pada 10.19
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

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
-- Struktur dari tabel `tbadmin`
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
-- Dumping data untuk tabel `tbadmin`
--

INSERT INTO `tbadmin` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Coba', 'coba@gmail.com', 'default.jpg', '$2y$10$l02Uf7ujrhreev/C.MDd2.4zovriQJjCWOo8O6D42cJbHXGVWH/gq', 1, 1, 1586351026),
(2, 'Akun 1', 'coba1@gmail.com', 'default.jpg', '$2y$10$dx/AIhaabEbdxwsA5TjuAeU0IUNxFne8AWr8d6iW0csdueiLpdF8e', 2, 1, 1587441817),
(3, 'Fortuna', 'fortuna@gmail.com', 'default.jpg', '$2y$10$f9ZbVyaF.FTk4QyLSlKrnueVzuqT2Uf8rnx0bFLWFknUbShc4TsO.', 2, 1, 1587460957),
(4, 'Huhuhu', 'huhu@gmail.com', 'default.jpg', '$2y$10$8r.jGvFCL7SmxS8Q.phOkOx77aP.gTHSwMJ6WJ/wAr0lyKDHAc.dq', 2, 1, 1587461124);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbcustomer`
--

CREATE TABLE `tbcustomer` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbcustomer`
--

INSERT INTO `tbcustomer` (`Id`, `Nama`, `Email`, `Password`) VALUES
(1, 'Bro', 'bro@gmail.com', '12345'),
(2, 'Yoks', 'yoks@gmail.com', '00000'),
(3, 'Zur', 'zur@gmail.com', '121212'),
(4, 'Rahmad', 'rahmad@gmail.com', '232323');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbkalender`
--

CREATE TABLE `tbkalender` (
  `Id_Kalender` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Nama_Kalender` varchar(255) NOT NULL,
  `Deskripsi` varchar(255) NOT NULL,
  `Harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbkalender`
--

INSERT INTO `tbkalender` (`Id_Kalender`, `Image`, `Nama_Kalender`, `Deskripsi`, `Harga`) VALUES
(1, 'default.jpg', 'Kalender 1', 'Kalender dijual satuan', 8000),
(2, 'default.jpg', 'kalender 2', 'Kalender sangat berguna bagi kehidupan', 10000),
(3, 'default.jpg', 'kalender 3', 'Kalender the best', 14000),
(4, 'default.jpg', 'kalender 4', 'kalender nomor satu', 8000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbkatalog`
--

CREATE TABLE `tbkatalog` (
  `Id_Katalog` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbkatalog`
--

INSERT INTO `tbkatalog` (`Id_Katalog`, `Nama`) VALUES
(1, 'Kalender'),
(2, 'Undangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbrole`
--

CREATE TABLE `tbrole` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbrole`
--

INSERT INTO `tbrole` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Karyawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbundangan`
--

CREATE TABLE `tbundangan` (
  `Id_Undangan` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Nama_Undangan` varchar(255) NOT NULL,
  `Deskripsi` varchar(255) NOT NULL,
  `Harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbundangan`
--

INSERT INTO `tbundangan` (`Id_Undangan`, `Image`, `Nama_Undangan`, `Deskripsi`, `Harga`) VALUES
(1, 'undangan.jpg', 'undangan 1', 'undangan sangat dibutuhkan', 6000),
(2, 'undangan.jpg', 'undangan 2', 'undangan number one', 8000),
(3, 'undangan.jpg', 'undangan 3', 'undangan normal', 6000),
(4, 'undangan.jpg', 'undangan 4', 'undangan super', 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Administrator'),
(2, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
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
-- Dumping data untuk tabel `user_sub_menu`
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
(9, 1, 'Management', 'management', 'fas fa-fw fa-folder', 1),
(10, 1, 'Submenu Management', 'management/submenu', 'fas fa-fw fa-folder', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbcustomer`
--
ALTER TABLE `tbcustomer`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `tbkalender`
--
ALTER TABLE `tbkalender`
  ADD PRIMARY KEY (`Id_Kalender`);

--
-- Indeks untuk tabel `tbrole`
--
ALTER TABLE `tbrole`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbundangan`
--
ALTER TABLE `tbundangan`
  ADD PRIMARY KEY (`Id_Undangan`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbcustomer`
--
ALTER TABLE `tbcustomer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbkalender`
--
ALTER TABLE `tbkalender`
  MODIFY `Id_Kalender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbrole`
--
ALTER TABLE `tbrole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbundangan`
--
ALTER TABLE `tbundangan`
  MODIFY `Id_Undangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
