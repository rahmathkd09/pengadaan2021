-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2021 at 03:00 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengadaan2021`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `token` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama`, `email`, `alamat`, `password`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'Jl. Ahmad Yani Nomor 1', 'eyJpdiI6InR2XC9VYlFrVFwvWEtWVmFQQWJrQjBqdz09IiwidmFsdWUiOiJVMVlMWlpsWTBhanFEclRiRmVaQlNBPT0iLCJtYWMiOiI1ZWQxNDJhZGQ1MzVjYTM4MDBlMzRlNzgwNmY4YWVmYWRkZTRmMGY5Njg0MTZmNTZmNTQ2YjI2YWQ1OGVkNDI5In0=', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hZG1pbiI6MX0.cr9_zKTZIpmU-90E2jFI88laIfhGhgZjQ-SO5bzQ2QE', '2021-08-01 20:37:38', '2021-08-22 17:35:33'),
(2, 'admin2@gmail.com', 'admin2@gmail.com', 'Jl Hayamwuruk Nomor 5 Karawang', 'eyJpdiI6IlpQOTdjeTlRZmtWMGl2VElidmFhWEE9PSIsInZhbHVlIjoiT2x5RVlnam9FNHlcLzR2cVg1TWhsbTZYWWVBSU9xMVcyYzJcL3crakIxbTJzPSIsIm1hYyI6IjM3ZTVjM2ZjNmE5MzYxNjhjNjA4M2RhNjljMjM5YzkxOGY5ODlmNzE2ODZhN2QyYTk0ZTQwM2RhN2E5Njc3OTIifQ==', 1, 'keluar', '2021-08-03 05:17:02', '2021-08-18 17:54:55'),
(8, 'admin3', 'admin3@gmail.com', 'Jl Dr Taruni No 110 Karawang', 'eyJpdiI6IjRRc2NJZmNKejFNaFJjVE5jNTFDNWc9PSIsInZhbHVlIjoiN2hcL294RU5NYm5INzlxMjJ4WUxMelNDdGlBcm5reFkzR0ZxYVwvSExxVHVRPSIsIm1hYyI6IjAxMmY3NDU1YTM5YmFkNWNmODFkZmMwYzMxMWFkNTRhNzYwODM5MmEwMzkyZmQ4OTNjZmZmZGYxMmY2ZWYyZjUifQ==', 1, NULL, '2021-08-08 17:56:40', '2021-08-08 17:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `id_suplier` int(11) NOT NULL,
  `laporan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_laporan`
--

INSERT INTO `tbl_laporan` (`id_laporan`, `id_pengajuan`, `id_suplier`, `laporan`, `created_at`, `updated_at`) VALUES
(2, 2, 3, 'public/laporan/gyHqnZDIt0vFKtRqG2eWpRvOYlh2s6vbhgcsr6DJ.pdf', '2021-08-15 21:13:39', '2021-08-15 21:13:39'),
(4, 3, 3, 'public/laporan/ERUhHAniCkBMyBrZ7UVDwbcYwgxqyYwcBUZTqjmh.pdf', '2021-08-16 00:09:16', '2021-08-16 00:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengadaan`
--

CREATE TABLE `tbl_pengadaan` (
  `id_pengadaan` int(11) NOT NULL,
  `nama_pengadaan` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL,
  `anggaran` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pengadaan`
--

INSERT INTO `tbl_pengadaan` (`id_pengadaan`, `nama_pengadaan`, `deskripsi`, `gambar`, `anggaran`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pengadaan Gedung Disdikpora', 'https://www.google.com/search?q=meja&tbm=isch&source=iu&ictx=1&fir=TPVUaY7PPMqrmM%252Cx8o9nEaCP9mCDM%252C_&vet=1&usg=AI4_-kShVs5CALwQbsfl2Ngm7lxWaSLhFQ&sa=X&ved=2ahUKEwjyjbD_8ZjyAhU5lEsFHVwUBx0Q9QF6BAgQEAE&biw=1280&bih=595#imgrc=TPVUaY7PPMqrmM', 'public/gambar/L2oAGVQmWYdI7iw5mlTegnRhXfwB5Qz14ROtisZX.jpg', 2500000000, 1, '2021-08-04 20:06:37', '2021-08-08 21:31:38'),
(3, 'Pengadaan Rumah DInas', 'http://dukcapil.gunungkidulkab.go.id/lelang-pengadaan-blanko-e-ktp-gagal-mendagri-minta-maaf/', 'public/gambar/nSF8mcGdCsc9aVqX6AHj0tQtNU9Bs67jQPMrtV2q.jpg', 1250000000, 1, '2021-08-08 19:19:46', '2021-08-08 21:32:11'),
(4, 'Pengadaan Tempat isolasi', 'http://pengadaan.net/eproc/241563/6/pengadaan-motor-kecil.html', 'public/gambar/4bzAoZFu5NRfJ0SQO3PdzTqvfj4N0f9TyvxWVbNR.jpg', 400000000, 1, '2021-08-08 21:02:47', '2021-08-08 21:32:44'),
(5, 'Pengadaan mobil Ambulance', 'http://pengadaan.info/detail/pengadaan-kendaraan-bermotor-berupa-mobil-ambulance-ta-2021', 'public/gambar/CVbHQRcA6IWT61jUfX3xntSWNtloKlxVZ2dvMMcY.jpg', 3000000000, 1, '2021-08-15 19:01:33', '2021-08-15 19:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengajuan`
--

CREATE TABLE `tbl_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_suplier` int(11) NOT NULL,
  `id_pengadaan` int(11) NOT NULL,
  `anggaran` double NOT NULL,
  `proposal` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pengajuan`
--

INSERT INTO `tbl_pengajuan` (`id_pengajuan`, `id_suplier`, `id_pengadaan`, `anggaran`, `proposal`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 1250000000, 'public/proposal/skSmCODca6L2zcWjUShQYiSjxgpfZx6IMmzNPkvK.pdf', 3, '2021-08-09 18:59:38', '2021-08-11 21:16:44'),
(2, 3, 1, 2500000000, 'public/proposal/VCAXJzcomZ4FicwMmW2XzuLgH2c5gQhR1KoN6tTR.pdf', 3, '2021-08-09 18:59:54', '2021-08-15 23:02:52'),
(3, 3, 4, 400000000, 'public/proposal/qZFI5V6b3chFZY2P7901YejV2RsLUJoOpF6JGElm.pdf', 2, '2021-08-10 19:03:47', '2021-08-10 19:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suplier`
--

CREATE TABLE `tbl_suplier` (
  `id_suplier` int(11) NOT NULL,
  `nama_suplier` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `no_npwp` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `token` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_suplier`
--

INSERT INTO `tbl_suplier` (`id_suplier`, `nama_suplier`, `email`, `alamat`, `no_npwp`, `password`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 'CV Berdikari', 'berdikari@gmail.com', 'Jalan Tangkuban Perahu Nomor 5 Bandung', '01.23345643.345.000', 'eyJpdiI6ImE2XC9PeU16OHcxNnQ1NWtMcXZxQ3dBPT0iLCJ2YWx1ZSI6Im5LMFg2U3ZPNDFNWEtLWjRRZzBOMGc9PSIsIm1hYyI6IjVhNzgwYjVkOTgxYTI2MTM1MjgyNjljNGE3ZTNjYWVjMDVmN2NiZjIyNmQ4NDZkZDQ0YWJjYmMzYmYxYjFmOTIifQ==', 0, 'keluar', '2021-07-27 20:32:56', '2021-08-18 23:08:50'),
(2, 'PT Angin Ribut', 'rahmathkd09@gmail.com', 'Terusan suez mesir', '8492004420.424.54545.001', 'eyJpdiI6InFrYlpBMzN5TkZXd1FlV2tBSlJGeGc9PSIsInZhbHVlIjoiSjR4cWlmeHRsOXRpbDk4S3RibVQ3Zz09IiwibWFjIjoiNDcwMjQ5YzlmYTdiMjM5Y2ExYTliODk1YjQwMWU1MjlmMjQ0ODkxOTM5MzA3OTliYTExOWE4OTlhOTE1ZWRmOSJ9', 0, 'keluar', '2021-07-28 18:09:30', '2021-08-17 19:24:26'),
(3, 'lpse', 'lpsekarawangkab@gmail.com', 'karawang', '2423434242.423423..5353', 'eyJpdiI6Ikx6azEwOGVNV3ZsR3h5QjhPd25yN1E9PSIsInZhbHVlIjoiOENMeWl1cEtUdTJcL1pHMkt4cUVGblE9PSIsIm1hYyI6ImVlMzI3MjYwMDgwZmQ5NjRhYzA1YTIzNTI0NjQ3MmFjZjkzZGE0NDhjMTI5ODM5MzkwNzAzYjc1Yzg5OTVjMWQifQ==', 1, 'keluar', '2021-07-28 20:30:09', '2021-08-18 21:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suplier2`
--

CREATE TABLE `tbl_suplier2` (
  `id_suplier` int(11) NOT NULL,
  `nama_suplier` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `no_npwp` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `token` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tbl_pengadaan`
--
ALTER TABLE `tbl_pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`);

--
-- Indexes for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indexes for table `tbl_suplier2`
--
ALTER TABLE `tbl_suplier2`
  ADD PRIMARY KEY (`id_suplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pengadaan`
--
ALTER TABLE `tbl_pengadaan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_suplier2`
--
ALTER TABLE `tbl_suplier2`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
