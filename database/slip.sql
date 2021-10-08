-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Okt 2021 pada 10.19
-- Versi server: 8.0.18
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `masuk` int(11) NOT NULL,
  `absen` int(11) NOT NULL,
  `sakit_skd` int(11) NOT NULL,
  `sakit_non_skd` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `cuti` int(11) NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absen`, `id_user`, `masuk`, `absen`, `sakit_skd`, `sakit_non_skd`, `izin`, `cuti`, `bulan`, `tahun`) VALUES
(1, 2, 26, 1, 1, 1, 1, 1, '9', 2021);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(10) NOT NULL,
  `nama` text COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_general_ci NOT NULL,
  `id_jabatan` int(10) NOT NULL,
  `id_jenjang` int(10) NOT NULL,
  `nip` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama`, `alamat`, `jenis_kelamin`, `id_jabatan`, `id_jenjang`, `nip`) VALUES
(1, 'Aji Arian Nofa', 'Kota Bengkulu', 'laki-laki', 1, 1, '19200018'),
(4, 'Zulva Priska', 'Kota Bengkulu', 'perempuan', 2, 2, '19200019');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Wakil Rektor Kemahasiswaan'),
(2, 'Wakil Rektor Akademik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenjang`
--

CREATE TABLE `jenjang` (
  `id_jenjang` int(11) NOT NULL,
  `nama_jenjang` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenjang`
--

INSERT INTO `jenjang` (`id_jenjang`, `nama_jenjang`) VALUES
(1, 'Aselon 1'),
(2, 'Aselon 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendapatan`
--

CREATE TABLE `pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int(11) NOT NULL,
  `lembur` text COLLATE utf8mb4_general_ci NOT NULL,
  `gapok` text COLLATE utf8mb4_general_ci NOT NULL,
  `tj_jabatan` text COLLATE utf8mb4_general_ci NOT NULL,
  `uang_makan` text COLLATE utf8mb4_general_ci NOT NULL,
  `transport` text COLLATE utf8mb4_general_ci NOT NULL,
  `bonus` text COLLATE utf8mb4_general_ci NOT NULL,
  `thr` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan`
--

CREATE TABLE `potongan` (
  `id_potong` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `cicilan_pinjaman` text COLLATE utf8mb4_general_ci NOT NULL,
  `jamsostek` text COLLATE utf8mb4_general_ci NOT NULL,
  `pt_telat` text COLLATE utf8mb4_general_ci NOT NULL,
  `pt_absen` text COLLATE utf8mb4_general_ci NOT NULL,
  `pph21` text COLLATE utf8mb4_general_ci NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(10) NOT NULL,
  `nama` int(11) NOT NULL,
  `alamat` int(11) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_general_ci NOT NULL,
  `id_jabatan` int(10) NOT NULL,
  `id_jenjang` int(10) NOT NULL,
  `nip` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_data` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `role_user` enum('admin','dosen','staff') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_data`, `id_user`, `username`, `password`, `role_user`) VALUES
(1, 2, 'admin', '$2y$10$Tk6CNsC/RVH0irQIA6npPuOFG7MK5LzH8cuxYPhM/jfEy6TjywLh6', 'admin'),
(2, 1, 'dosen', '$2y$10$Tk6CNsC/RVH0irQIA6npPuOFG7MK5LzH8cuxYPhM/jfEy6TjywLh6', 'dosen'),
(4, 4, 'zpm', '$2y$10$fCQwlMsXNCDKHkJybrfLw.RBqQ4ot7kazQET.cbkdzUIfZud9RMW2', 'dosen');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id_jenjang`);

--
-- Indeks untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indeks untuk tabel `potongan`
--
ALTER TABLE `potongan`
  ADD PRIMARY KEY (`id_potong`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_data`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenjang`
--
ALTER TABLE `jenjang`
  MODIFY `id_jenjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `potongan`
--
ALTER TABLE `potongan`
  MODIFY `id_potong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
