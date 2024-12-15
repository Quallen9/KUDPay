-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Des 2024 pada 12.01
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kudpay`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `ussername` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `ussername`, `nama`, `password`) VALUES
(1, 'admin1', 'Admin 1', '1234'),
(2, 'admin2', 'Admin 2', '$2y$10$U76SY0GYsRgTgRd03Z6KOerjBib/VaWkGrb.9Wh7SW98KIhAYvMWi'),
(3, 'admin3', 'Admin 3', '$2y$10$oPgVC69C8lQvpulm8pjbG.3YT6tmyGLbmO2CPMQHoYM9d1pyd/A3m');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `idKartu` varchar(15) NOT NULL,
  `noRekening` varchar(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `voucher` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`idKartu`, `noRekening`, `nama`, `voucher`, `saldo`, `alamat`, `password`) VALUES
('000000001', '', 'Customer 1', 0, 1005000, 'JL. Customer', '1111'),
('000000002', '', 'Customer 2', 0, 1000000, 'JL. Customer ', '1111'),
('000000003', '', 'Customer 3', 0, 0, 'JL. Customer', '1234'),
('000000004', '', 'Customer', 0, 0, 'JL. Customer', '1234'),
('000000005', '', 'Customer 5', 0, 0, 'JL. Customer', '1234'),
('000000006', '', 'Customer 6', 0, 0, 'Jl. Customer', '1234'),
('PAY196550334415', 'KUD12345', 'Yeti', 1000, 118000, 'fsdfdsfd', '$2y$10$hYGrI8zWALH1bVZgVhlntumkTvm9GQOm4kJjZ8bjkL9NjBF0X6ub.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_transaksi`
--

CREATE TABLE `riwayat_transaksi` (
  `idTransaksi` int(11) NOT NULL,
  `customer` varchar(15) NOT NULL,
  `admin` varchar(11) NOT NULL,
  `jenisTransaksi` varchar(100) NOT NULL,
  `nominalTransaksi` int(100) NOT NULL,
  `waktuTransaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_transaksi`
--

INSERT INTO `riwayat_transaksi` (`idTransaksi`, `customer`, `admin`, `jenisTransaksi`, `nominalTransaksi`, `waktuTransaksi`) VALUES
(1, 'PAY196550334415', '0', 'Top UP', 1000, '2024-12-14'),
(2, 'PAY196550334415', 'admin3', 'Top UP', 1000, '2024-12-14'),
(3, 'PAY196550334415', 'admin2', 'Input Voucher', 1000, '2024-12-14'),
(4, 'PAY196550334415', 'admin2', 'Top UP', 1000, '2024-12-14'),
(5, 'PAY196550334415', 'admin2', 'Top UP', 1000, '2024-12-14'),
(6, 'PAY196550334415', 'admin2', 'Top UP', 1000, '2024-12-14'),
(7, 'PAY196550334415', 'admin2', 'Top UP', 1000, '2024-12-14'),
(8, 'PAY196550334415', 'admin2', 'Top UP', 1000, '2024-12-15'),
(9, 'PAY196550334415', 'admin3', 'Input Voucher', 1000, '2024-12-15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idKartu`);

--
-- Indeks untuk tabel `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  MODIFY `idTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
