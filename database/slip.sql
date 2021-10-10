-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 10 Okt 2021 pada 06.36
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
  `bulan` enum('01','02','03','04','05','06','07','08','09','10','11','12') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int(10) NOT NULL,
  `type` enum('dosen','staff') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absen`, `id_user`, `masuk`, `absen`, `sakit_skd`, `sakit_non_skd`, `izin`, `cuti`, `bulan`, `tahun`, `type`) VALUES
(1, 1, 26, 1, 1, 0, 1, 1, '10', 2021, 'dosen'),
(2, 1, 25, 2, 0, 0, 0, 3, '09', 2021, 'dosen'),
(7, 3, 30, 0, 0, 0, 0, 0, '10', 2021, 'staff'),
(8, 2, 29, 0, 0, 0, 0, 1, '10', 2021, 'staff'),
(9, 8, 28, 0, 0, 0, 0, 0, '10', 2021, 'dosen');

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
(1, 'Zulva Priska Muzairi', 'Kota Lubuklinggau', 'perempuan', 2, 1, '1920022'),
(8, 'Rahmat Riadi SH', 'Kota Bengkulu', 'laki-laki', 1, 1, '1920001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_pendapatan` int(10) NOT NULL,
  `id_potongan` int(10) NOT NULL,
  `bulan` enum('01','02','03','04','05','06','07','08','09','10','11','12') COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int(10) NOT NULL,
  `type` enum('dosen','staff') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `id_user`, `id_pendapatan`, `id_potongan`, `bulan`, `tahun`, `type`) VALUES
(1, 8, 1, 1, '10', 2021, 'dosen'),
(3, 1, 3, 2, '10', 2021, 'dosen');

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
  `lembur` int(50) NOT NULL,
  `gapok` int(50) NOT NULL,
  `tj_jabatan` int(50) NOT NULL,
  `uang_makan` int(50) NOT NULL,
  `transport` int(50) NOT NULL,
  `bonus` int(50) NOT NULL,
  `thr` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendapatan`
--

INSERT INTO `pendapatan` (`id_pendapatan`, `lembur`, `gapok`, `tj_jabatan`, `uang_makan`, `transport`, `bonus`, `thr`) VALUES
(1, 0, 2300000, 500000, 0, 0, 0, 0),
(3, 0, 3000000, 100000, 50000, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan`
--

CREATE TABLE `potongan` (
  `id_potong` int(11) NOT NULL,
  `cicilan_pinjaman` int(50) NOT NULL,
  `jamsostek` int(50) NOT NULL,
  `pt_telat` int(50) NOT NULL,
  `pt_absen` int(50) NOT NULL,
  `pph21` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `potongan`
--

INSERT INTO `potongan` (`id_potong`, `cicilan_pinjaman`, `jamsostek`, `pt_telat`, `pt_absen`, `pph21`) VALUES
(1, 200000, 150000, 0, 0, 0),
(2, 0, 50000, 0, 0, 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(10) NOT NULL,
  `nama` text COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_general_ci NOT NULL,
  `id_jabatan` int(10) NOT NULL,
  `id_jenjang` int(10) NOT NULL,
  `nip` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `staff`
--

INSERT INTO `staff` (`id_staff`, `nama`, `alamat`, `jenis_kelamin`, `id_jabatan`, `id_jenjang`, `nip`) VALUES
(2, 'Dilan Oh Dilan', 'Karawang City', 'laki-laki', 2, 2, '182000012'),
(3, 'Aan Wicaksono', 'Jakarta Selatan', 'laki-laki', 1, 2, '129000123');

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
(8, 1, 'dosen', '$2y$10$Y2wENPirmPwB1osR1zL..eTKEyrU4VGt05sL3WsQsffTrXR2aWIkG', 'dosen'),
(9, 2, 'dilan', '$2y$10$n6qigIQeQcjid3YHjH/Inea8Ubrz.4jChmZ7OTvAlkNLT1SN6ex6K', 'staff'),
(10, 3, 'aan', '$2y$10$/cIcnSsM36G6KJGb5gav3.b6IVd5VoEYWrOJZOnlCDmgMBIQ59P4a', 'staff'),
(11, 0, 'dolan', '$2y$10$wbjSS.T87ZFhfND0PrFTW.HFrVK8Ryhi/QCdPKLFnt0uP4jPVDWSm', 'admin'),
(13, 0, 'wika univbi', '$2y$10$oR2u8f5rfwYCULiSpTt6iuHLq3bPlHNajJ6e7meIZ0yGAnkabVfUu', 'admin'),
(14, 8, 'rahmat', '$2y$10$REtUzW56JafgkMVKLy9Mt.C2uNJf5TvFim.DguTi5PeVrwfbCt26G', 'dosen');

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
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

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
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `potongan`
--
ALTER TABLE `potongan`
  MODIFY `id_potong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
