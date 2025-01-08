-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2025 pada 05.40
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
-- Database: `dbmahasigma`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL,
  `nama_lapangan` varchar(100) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `fasilitas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `kategori`, `harga`, `gambar`, `deskripsi`, `fasilitas`) VALUES
(9, 'Lapangan Raja Ali Haji', 'Indoor Sintetis', 120000, 'pxfuel.jpg', 'Lapangan ini cocok untuk pertandingan futsal dengan kualitas lantai vinyl yang nyaman dan tidak biki luka.', 'rumput'),
(11, 'Lapangan Teuku umar', 'Indoor Vinyl', 160000, 'lapangan2.jpg', ' Lapangan ini cocok untuk pertandingan futsal dengan kualitas rumput sintetis terbaik dan fasilitas modern.', 'Rumput Sintetis, \r\nLampu Penerangan, \r\nTempat Duduk Penonton, \r\nKamar Ganti'),
(22, 'Lapangan engku putri', 'outdoor', 100000, 'lapangan3.jpg', 'Lapangan ini cocok untuk pertandingan futsal dengan kualitas \r\n lapangan dan rumput sintetis paling terbaik yang kami punytaterbaik dan fasilitas modern.', 'Rumput Sintetis, Lampu Penerangan, Tempat Duduk Penonton, Kamar Ganti');

-- --------------------------------------------------------

--
-- Struktur dari tabel `otp_code`
--

CREATE TABLE `otp_code` (
  `id` int(11) NOT NULL,
  `no_handphone` varchar(20) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `otp_code`
--

INSERT INTO `otp_code` (`id`, `no_handphone`, `otp`, `created_at`) VALUES
(27, '082279732844', 449601, '2024-12-31 08:58:43'),
(28, '082288667998', 991209, '2025-01-05 18:01:38'),
(31, '089509603739', 746396, '2025-01-06 07:10:52'),
(32, '089524003130', 565939, '2025-01-06 07:38:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_penyewa` int(10) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `no_handphone` varchar(15) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `tanggal_pesan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesan`
--

CREATE TABLE `pemesan` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `nama_pemesan` varchar(20) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `jam` varchar(20) NOT NULL,
  `nama_lapangan` varchar(30) NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status_bayar` enum('Belum Bayar','Sudah Bayar','Batal Pesan') DEFAULT 'Belum Bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesan`
--

INSERT INTO `pemesan` (`id`, `username`, `nama_pemesan`, `tanggal_pemesanan`, `jam`, `nama_lapangan`, `kategori`, `harga`, `gambar`, `status_bayar`) VALUES
(1, 'Zidan', 'Zidan', '2025-01-06 00:00:00', '16:00-17:00', 'Lapangan Teuku umar', 'Indoor Vinyl', 160000, 'lapangan2.jpg', 'Sudah Bayar'),
(2, 'Zidan', 'Zidan', '2025-01-06 00:00:00', '13:00-14:00', 'Lapangan Teuku umar', 'Indoor Vinyl', 160000, 'lapangan2.jpg', 'Batal Pesan'),
(3, 'Zidan', 'Zidan', '2025-01-07 00:00:00', '21:00-22:00', 'Lapangan Teuku umar', 'Indoor Vinyl', 160000, 'lapangan2.jpg', 'Belum Bayar'),
(4, 'ANDIKA', 'ANDIKA', '2025-01-06 00:00:00', '13:00-14:00', 'Lapangan Raja Ali Haji', 'Indoor Sintetis', 120000, 'pxfuel.jpg', 'Sudah Bayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `no_handphone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `no_handphone`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '089502016739', '$2y$10$DBsvZ7zZbryXlqxRCuf0ueFhx57Q1q3qXh1e5rLKPfvm4Ggp/4wPu', 'admin', '2025-01-06 06:30:27'),
(2, 'Zidan', '089509603739', '$2y$10$LzLnUMu4wQRKiXRI4rlxW.iyUyg5OflRGYgoZ321M0mYx3X7/26.O', 'user', '2025-01-06 06:31:26'),
(3, 'ANDIKA', '089524003130', '$2y$10$wZ0r6a1Ac/PUOVijfZgEIOdrbraEX6JcEL9tMFAjL49jBZkcQIRFW', 'user', '2025-01-06 07:34:03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`);

--
-- Indeks untuk tabel `otp_code`
--
ALTER TABLE `otp_code`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_penyewa`),
  ADD KEY `id_lapangan` (`id_lapangan`);

--
-- Indeks untuk tabel `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `otp_code`
--
ALTER TABLE `otp_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_penyewa` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id_lapangan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
