-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2020 pada 11.45
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

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
-- Struktur dari tabel `akunbank`
--

CREATE TABLE `akunbank` (
  `kode_akunbank` varchar(16) NOT NULL,
  `nama_rek` varchar(50) NOT NULL,
  `nama_bank` varchar(15) NOT NULL,
  `no_rek` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akunbank`
--

INSERT INTO `akunbank` (`kode_akunbank`, `nama_rek`, `nama_bank`, `no_rek`) VALUES
('askdnsadajk12189', 'Admin', 'BRI', '2109381920'),
('jhdkashduy128621', 'Admin', 'BNI', '21389271389');

-- --------------------------------------------------------

--
-- Struktur dari tabel `otp`
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
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(16) NOT NULL,
  `id_produk` int(4) NOT NULL,
  `id_customer` int(4) NOT NULL,
  `kode_akunbank` varchar(16) NOT NULL,
  `qty` int(4) NOT NULL,
  `last_price` int(7) NOT NULL,
  `unik` int(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 = batal 1 = wait bayar 2=wait acc admin 3=proses 4 = tolak 5 = selesai',
  `alamat_kirim` varchar(125) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `catatan_member` varchar(100) NOT NULL,
  `bukti_tf` varchar(75) NOT NULL,
  `catatan_status` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reset_akun`
--

CREATE TABLE `reset_akun` (
  `kode_reset` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipe_reset` int(1) NOT NULL COMMENT '1 = aktivasi akun 2 = reset pass',
  `keterangan` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 = tidak aktif 1 = aktif',
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Admin SiLaper', 'adynugrahaputra@gmail.com', 'default.jpg', '$2y$10$vSw71VVkCS2BTrD/ZlsR0e9WLIrcJUQE0iSYtgukShagSIvpHYC8y', 1, 1, 1593752001);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbcustomer`
--

CREATE TABLE `tbcustomer` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `daftar_via` int(1) NOT NULL DEFAULT '1' COMMENT '1 = form daftar 2 =google'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbkalender`
--

CREATE TABLE `tbkalender` (
  `id_kalender` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nama_kalender` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbkalender`
--

INSERT INTO `tbkalender` (`id_kalender`, `image`, `nama_kalender`, `deskripsi`, `harga`) VALUES
(1, 'ExecutiveFullColor.jpg', 'Executive Full Color', 'Bentuk Kalender : 12 lembar X 1 bulanan\r\nUkuran Kertas : 50.5 X 71.5 cm\r\nRuang Iklan : 13 X 50.5 cm \r\nBahan Isi Kalender : hvs', 20000),
(2, 'LuxExecutive.jpg', 'Lux Executive', 'Bentuk Kalender : 12 lembar X 1 bulanan\r\nUkuran Kertas : 49 X 64 cm\r\nRuang Iklan : 13 X 49 cm \r\nBahan Isi Kalender : hvs', 15000),
(3, 'DreamCar.jpg', 'Dream Car', 'Bentuk Kalender : 6 lembar X 1 bulanan\r\nUkuran Kertas : 21 X 16 cm\r\nRuang Iklan : 21 X 3.5 cm \r\nBahan Isi Kalender : Kunsdruk Karton', 7500),
(4, 'BabyCeria.jpg', 'Baby Ceria', 'Bentuk Kalender : 4 lembar X 1 bulanan\r\nUkuran Kertas : 32 X 48 cm\r\nRuang Iklan : 10 X 32 cm \r\nBahan Isi Kalender : Kunsdruk 2 Muka', 6000),
(5, 'SuperFullColor.jpg', 'Super Full Color', 'Bentuk Kalender : 12 lembar X 1 bulanan\r\nUkuran Kertas : 46 X 64 cm\r\nRuang Iklan : 13 X 46 cm \r\nBahan Isi Kalender : hvs', 11000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbkatalog`
--

CREATE TABLE `tbkatalog` (
  `id_katalog` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `ikon` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbkatalog`
--

INSERT INTO `tbkatalog` (`id_katalog`, `nama`, `ikon`) VALUES
(1, 'Kalender', 'assets/upload/katalog/calendar.png'),
(2, 'Undangan', 'assets/upload/katalog/invit.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbproduk`
--

CREATE TABLE `tbproduk` (
  `id_produk` int(4) NOT NULL,
  `id_katalog` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbproduk`
--

INSERT INTO `tbproduk` (`id_produk`, `id_katalog`, `image`, `nama_produk`, `deskripsi`, `harga`) VALUES
(1, 1, 'assets/upload/produk/ExecutiveFullColor.jpg', 'Executive Full Color', 'Bentuk kalender : 12 lembar X 1 bulanan', 2000),
(2, 1, 'assets/upload/produk/LuxExecutive.jpg', 'Lux Executive', 'Bentuk kalender : 12 lembar X 1 bulanan', 15000),
(3, 1, 'assets/upload/produk/DreamCar.jpg', 'Dream Car', 'Bentuk kalender : 6 lembar X 1 bulanan', 7500),
(4, 1, 'assets/upload/produk/SuperFullColor.jpg', 'Super Full Color', 'Bentuk kalender : 12 lembar X 1 bulanan', 11000),
(5, 2, 'assets/upload/produk/Undangan1.jpg', 'Undangan Amplop', 'Unik', 6000),
(6, 2, 'assets/upload/produk/Undangan2.jpg', 'Undangan Ekslusif', 'Mewah', 15000),
(7, 2, 'assets/upload/produk/Undangan6.jpg', 'Undangan Khitanan', 'Khusus Acara Khitanan', 6000),
(8, 2, 'assets/upload/produk/Undangan8.jpg', 'Undangan Jawa', 'Adat', 7000);

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
  `id_undangan` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `nama_undangan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbundangan`
--

INSERT INTO `tbundangan` (`id_undangan`, `image`, `nama_undangan`, `deskripsi`, `harga`) VALUES
(1, 'Undangan1.jpg', 'Undangan Amplop', 'Kertas Berbentuk Amplop Map', 6000),
(2, 'Undangan2.jpg', 'Undangan Eksklusif', 'Terdapat Tempat untuk Kartu Undangan', 15000),
(3, 'Undangan3.jpg', 'Undangan Semi Eksklusif', 'Terdapat Tempat untuk Kartu Undangan', 12000),
(4, 'Undangan4.jpg', 'Undangan Hijau', 'Satu sisi terbuat dari bhan yang tebal', 10000),
(5, 'Undangan5.jpg', 'Undangan Bunga', 'Hanya satu warna', 5000),
(6, 'Undangan6.jpg', 'Undangan Khitanan', 'Khusus untuk Khitanan', 5000),
(7, 'Undangan7.jpg', 'Undangan Super', 'Model Timbul', 8000),
(8, 'Undangan8.jpg', 'Undangan Jawa', 'Bisa untuk acara pernikahan, acara resmi lainnya', 7000),
(9, 'Undangan9.jpg', 'Undangan Super 2', 'Bahannya Tebal', 8000),
(10, 'Undangan10.jpg', 'Undangan Bunga 2', 'Hanya 1 Warna', 5500);

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
(3, 1, 3),
(4, 2, 2);

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
(2, 'Menu'),
(3, 'Management');

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
(5, 2, 'Katalog', 'katalog', 'fas fa-fw fa-folder-open', 1),
(6, 2, 'Data Pemesanan', 'datapemesanan', 'fas fa-fw fa-clipboard-list', 1),
(7, 3, 'Management', 'management', 'fas fa-fw fa-folder', 1),
(8, 3, 'Submenu Management', 'management/submenu', 'fas fa-fw fa-folder', 1),
(9, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(12, 1, 'User Karyawan', 'userkaryawan', 'fas fa-fw fa-users', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akunbank`
--
ALTER TABLE `akunbank`
  ADD PRIMARY KEY (`kode_akunbank`);

--
-- Indeks untuk tabel `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`kode_otp`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- Indeks untuk tabel `reset_akun`
--
ALTER TABLE `reset_akun`
  ADD PRIMARY KEY (`kode_reset`);

--
-- Indeks untuk tabel `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbcustomer`
--
ALTER TABLE `tbcustomer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbkalender`
--
ALTER TABLE `tbkalender`
  ADD PRIMARY KEY (`id_kalender`);

--
-- Indeks untuk tabel `tbkatalog`
--
ALTER TABLE `tbkatalog`
  ADD PRIMARY KEY (`id_katalog`);

--
-- Indeks untuk tabel `tbproduk`
--
ALTER TABLE `tbproduk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_katalog` (`id_katalog`);

--
-- Indeks untuk tabel `tbrole`
--
ALTER TABLE `tbrole`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbundangan`
--
ALTER TABLE `tbundangan`
  ADD PRIMARY KEY (`id_undangan`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbcustomer`
--
ALTER TABLE `tbcustomer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbkalender`
--
ALTER TABLE `tbkalender`
  MODIFY `id_kalender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbkatalog`
--
ALTER TABLE `tbkatalog`
  MODIFY `id_katalog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbproduk`
--
ALTER TABLE `tbproduk`
  MODIFY `id_produk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbrole`
--
ALTER TABLE `tbrole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbundangan`
--
ALTER TABLE `tbundangan`
  MODIFY `id_undangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
