-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jun 2026 pada 09.06
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
-- Database: `haksosial`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `peran` enum('admin') DEFAULT 'admin',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `peran`, `dibuat_pada`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '2026-06-28 06:57:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pengetahuan`
--

CREATE TABLE `data_pengetahuan` (
  `id_pengetahuan` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `isi` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diupdate_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_pengetahuan`
--

INSERT INTO `data_pengetahuan` (`id_pengetahuan`, `judul`, `kategori`, `isi`, `dibuat_pada`, `diupdate_pada`) VALUES
(1, 'Syarat Program Keluarga Harapan', 'PKH', 'Program Keluarga Harapan diberikan kepada keluarga miskin yang terdaftar dalam DTKS.', '2026-06-28 07:00:12', '2026-06-28 07:00:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_pengaduan`
--

CREATE TABLE `laporan_pengaduan` (
  `id_laporan` int(11) NOT NULL,
  `nama_pelapor` varchar(100) DEFAULT NULL,
  `nama_terlapor` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `deskripsi_laporan` text DEFAULT NULL,
  `status_laporan` enum('menunggu','diproses','selesai') DEFAULT 'menunggu',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan_pengaduan`
--

INSERT INTO `laporan_pengaduan` (`id_laporan`, `nama_pelapor`, `nama_terlapor`, `alamat`, `deskripsi_laporan`, `status_laporan`, `dibuat_pada`) VALUES
(1, 'raihan', 'arep', 'jln. perintis baru', 'arep diduga korupsi untuk bantuan PKH', 'menunggu', '2026-06-28 07:05:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_percakapan`
--

CREATE TABLE `riwayat_percakapan` (
  `id_percakapan` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `nama_pengguna` (`username`);

--
-- Indeks untuk tabel `data_pengetahuan`
--
ALTER TABLE `data_pengetahuan`
  ADD PRIMARY KEY (`id_pengetahuan`);
ALTER TABLE `data_pengetahuan` ADD FULLTEXT KEY `judul` (`judul`,`isi`);

--
-- Indeks untuk tabel `laporan_pengaduan`
--
ALTER TABLE `laporan_pengaduan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `riwayat_percakapan`
--
ALTER TABLE `riwayat_percakapan`
  ADD PRIMARY KEY (`id_percakapan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_pengetahuan`
--
ALTER TABLE `data_pengetahuan`
  MODIFY `id_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `laporan_pengaduan`
--
ALTER TABLE `laporan_pengaduan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `riwayat_percakapan`
--
ALTER TABLE `riwayat_percakapan`
  MODIFY `id_percakapan` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
