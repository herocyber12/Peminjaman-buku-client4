-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Nov 2023 pada 10.54
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminajaman_buku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` varchar(15) NOT NULL,
  `cover` varchar(125) NOT NULL,
  `sinopsis` text NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `penerbit` varchar(25) NOT NULL,
  `penulis` varchar(25) NOT NULL,
  `tahun_terbit` mediumint(9) NOT NULL,
  `status_buku` enum('Tersedia','Dipinjam','Rusak') NOT NULL,
  `id_kategori` varchar(25) NOT NULL,
  `totalpeminjaman` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `cover`, `sinopsis`, `nama_buku`, `penerbit`, `penulis`, `tahun_terbit`, `status_buku`, `id_kategori`, `totalpeminjaman`, `created_at`, `updated_at`) VALUES
('ID-B5690', 'img/cover/iZzW3D73w30exq2FXkJWL87lSOLeAlLNR8uRVCEj.jpg', '<p>anjas</p>', 'kjdwanjkdwna', 'kwakd', 'wdbja', 2008, 'Dipinjam', 'Umum', 42, '2023-11-25 07:46:26', '2023-11-25 23:11:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(25) NOT NULL,
  `kategori` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
('ID-K5886', 'Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner` varchar(150) NOT NULL,
  `nama_kegiatan` varchar(75) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `banner`, `nama_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 'img/banner/9IzoYb3eArndWZoCWogdOJ0LcBA0TdswbWZoa7xS.jpg', 'ngetes', '2023-11-25 08:31:06', '2023-11-25 08:31:06'),
(2, 'img/banner/F7JdJL8nHyKmrvQmwySOAlW1XrItk0cbZ51zob8z.jpg', 'anjas bang', '2023-11-25 08:31:39', '2023-11-25 08:31:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(28, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(29, '2023_10_26_164726_profil', 1),
(30, '2023_10_26_171935_user', 1),
(31, '2023_10_27_055618_kategori', 1),
(32, '2023_10_27_055718_buku', 1),
(33, '2023_10_27_055857_review', 1),
(34, '2023_10_29_140028_reservasi', 1),
(35, '2023_11_08_101133_kegiatan', 1),
(36, '2023_11_19_083121_tamu', 1),
(37, '2023_11_19_092458_vieweer', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id_profil` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(75) NOT NULL,
  `no_hp` bigint(20) NOT NULL,
  `level` enum('Member','Admin') NOT NULL DEFAULT 'Member',
  `foto` varchar(175) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_profil`, `nama`, `alamat`, `no_hp`, `level`, `foto`, `created_at`, `updated_at`) VALUES
('ID-P3203', 'Luwe', 'surakarta', 85156078295, 'Member', NULL, '2023-11-25 08:01:41', '2023-11-25 08:01:41'),
('ID-P4235D', 'nyoba aja sih', 'mars', 8327367262, 'Admin', 'img/foto/wwyutW4qvwQoLBurcqOgb5xEATJ7gnjfRwH2D9D7.png', NULL, '2023-11-26 08:25:34'),
('ID-P5276', 'Jokerssss', 'surakarta', 851560782957, 'Member', 'img/foto/H3GMhyc5SZICVdjZr7EHh5cqFWhVV9KCyCZG4Gt5.jpg', '2023-11-25 08:03:46', '2023-11-26 08:11:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` varchar(15) NOT NULL,
  `tanggal_dipinjam` date DEFAULT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `status_reservasi` enum('Masih Dipinjam','Sudah Dikembalikan','Pengajuan Peminjaman') NOT NULL,
  `status_peminjaman` enum('Disetujui','Belum Disetujui','Tidak Di Setujui') NOT NULL,
  `id_profil` varchar(15) NOT NULL,
  `id_buku` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `tanggal_dipinjam`, `tanggal_dikembalikan`, `status_reservasi`, `status_peminjaman`, `id_profil`, `id_buku`, `created_at`, `updated_at`) VALUES
('ID-R5767', '2023-11-25', '2023-11-28', 'Masih Dipinjam', 'Disetujui', 'ID-P5276', 'ID-B5690', '2023-11-25 08:11:05', '2023-11-25 08:34:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id_review` varchar(15) NOT NULL,
  `rate` enum('1','2','3','4','5') NOT NULL,
  `komentar` text DEFAULT NULL,
  `id_profil` varchar(15) NOT NULL,
  `id_buku` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `review`
--

INSERT INTO `review` (`id_review`, `rate`, `komentar`, `id_profil`, `id_buku`, `created_at`, `updated_at`) VALUES
('ID-R8318', '1', 'dwawa', 'ID-P5276', 'ID-B5690', '2023-11-25 20:34:16', '2023-11-25 20:34:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(75) NOT NULL,
  `asal` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `id_profil` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `id_profil`, `created_at`, `updated_at`) VALUES
(1, 'herocyber123', 'herocyber00@gmail.com', '$2y$10$3g42.T1hfq9zEg2MgQG.g..0NrzrOaDJysPG0ncJIpy0ZMPwZ3ptC', 'ID-P4235D', NULL, '2023-11-26 08:25:34'),
(3, 'herocyber98', 'anjas@gmail.com', '$2y$10$IxZalINvTiaBSrcy/RyUDeFWUZ0rVtV.dL7hRnAeOW0MNIDuow51y', 'ID-P5276', '2023-11-25 08:03:46', '2023-11-26 08:11:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `viewer`
--

CREATE TABLE `viewer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cache` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `viewer`
--

INSERT INTO `viewer` (`id`, `id_cache`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'eyJpdiI6IkVJV1ZKNkxGazUrWC9HU3JZQXlnOGc9PSIsInZhbHVlIjoiVnZWVEV3QmJtQkd2dFFuRzdYSjFQUT09IiwibWFjIjoiYTA0YmI3NDk3OGYxMGFjMDJhMTllYzQ0ZmFjNmMyNjlhMTM1NDg1ZTdjZDExNThhYWIxYzA1ZjdhMzQ5YjE4YiIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:24:44', '2023-11-24 23:24:44'),
(2, 'eyJpdiI6IjBIQmY1aHU5OWI4RWQ2cVZiVWZqcUE9PSIsInZhbHVlIjoibXl3bTVKSmJJRVpwR3FjS090ZlAxQT09IiwibWFjIjoiODZkYWMwMmQxYzEwOWIzZmFmNDBiZDg1MTBlNTlkODBkYzMyMTgwNGFkMmJkNmZjMGU4MDhkODI0ZmZhZjY2ZiIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:39:11', '2023-11-24 23:39:11'),
(3, 'eyJpdiI6InRPUmJrRFVNN1lQMzBMNEhHMkRXeWc9PSIsInZhbHVlIjoiL3IyeHZ6dTMzUFd5QXFUTDgrWmhjZz09IiwibWFjIjoiYmExMTE4ZDM2MTJjNWI1ZWIxZmM5Njc5YjJmNDQ5N2U5NTA0MTFlMWFjZWMyNTU3ZWNlZTY2MjlmZjdiM2Q3NCIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:39:33', '2023-11-24 23:39:33'),
(4, 'eyJpdiI6IkNXVkFGNWVHbE5zM0h6Ry8yWnBnNlE9PSIsInZhbHVlIjoiRGxYOHBUSWFXa1FiYlV5UnNRM2MzZz09IiwibWFjIjoiNzQ4YTcwZjExOGZjZmI5MDI1ZDg1YzIzZDE0ZmI5YTA5ZmE0MjM3NmU1M2NhOGE0NGI2ODE4NzE1ZjRmNzdlMiIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:40:00', '2023-11-24 23:40:00'),
(5, 'eyJpdiI6ImY0M0dYTVZaUmJVRFpMbmc3QjRqT3c9PSIsInZhbHVlIjoiRXo5OFltSG9PWjdaYTkrNnBnb0F3QT09IiwibWFjIjoiYmRjMjcxMDRiNDcxNjEzZTI2M2QyYTk0MjE1MGFkZjZhNGY1OTFhMzY3Y2I2MDg1OTc2MGVkMDhiODQwMjRkOSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:41:15', '2023-11-24 23:41:15'),
(6, 'eyJpdiI6IkRweUZ3cFFBU2VKMjUyTnUrMDhLaFE9PSIsInZhbHVlIjoiaFNhbG1DaUVObm5MRk5PUnVMdWtrdz09IiwibWFjIjoiOGIwMzM4MTYxM2ZlZGZkZjFkMDExY2E2ZmY2NWJjN2ZmZjQzNWNhNzQwMzZlMjgzNGU2NjQ1ZjViMWY2OGJmOCIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:41:41', '2023-11-24 23:41:41'),
(7, 'eyJpdiI6IlJ3cy96YkVkVG5JeXpSbjlSUTRVbmc9PSIsInZhbHVlIjoiS3lPS1N0RkZObHE1RHlZaXRiVWJjZz09IiwibWFjIjoiOTYzZmI5ODhjNjE2M2Q0NzA3OWFlZDg4NWQxNzJmMGZiNDNjZWU4OTEzMjNmOTY0MmUwZmVlZTk1Zjc0YWZiZCIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:41:42', '2023-11-24 23:41:42'),
(8, 'eyJpdiI6ImFWU0w4R2VUclZvNlhpQkROU010SGc9PSIsInZhbHVlIjoiV0JPamJucmhNZHRuVk9ld3BneXhSZz09IiwibWFjIjoiN2UyZDY3YjJmMWE2ODA4MjcwM2NmYzY5ODBkM2Q5OTg3M2NhNjQxOGMzZDJhMTEzNGY3YjgwNjA0MmM2ZWM2NiIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:42:37', '2023-11-24 23:42:37'),
(9, 'eyJpdiI6ImViajBsaDhPMnN2WGdSSGFTRUhQOWc9PSIsInZhbHVlIjoiS3dHL280a2NBNVJMZTQzVTRqdE9ydz09IiwibWFjIjoiYzFhYjE4ZDE4MWI1MzBkZjQ4ZTBkMTlmYjM5MWFiNDQ0MmUyNDM2ZTU3YmM2YjMxMGY5MmRlY2Y1MDUxN2JhMyIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:43:03', '2023-11-24 23:43:03'),
(10, 'eyJpdiI6Im5lZW5iWjZWT082U3JXektxUXR6dGc9PSIsInZhbHVlIjoiNWJ0bTZJenYweGRIVHg1c05LWXc5QT09IiwibWFjIjoiOTVjNzY4N2QxZjBkYWRiZTA2ZDcyNmVjMjhiMjRjZjJiOGIwNTEwMzQ3MThmMDI4ZjAyM2EzZDUwYmRlZTRjMiIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:43:28', '2023-11-24 23:43:28'),
(11, 'eyJpdiI6IlBrWnNxRDB5T3NOTXJUUS9leXE3Ymc9PSIsInZhbHVlIjoieTRMNmRPQ3AzUzQ5clEvQzNzdjVIQT09IiwibWFjIjoiM2RiZTQ0ODJjOGU5MTNjNjAwODM4YjVkMTQzODRkYmM0ZTIwMjBmNGU1ZTZiNTFmZjI3OTJlZTZkMDI1NWE2MSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:43:47', '2023-11-24 23:43:47'),
(12, 'eyJpdiI6IjYyak1adVoyYU1BWVhGa211T1pqS3c9PSIsInZhbHVlIjoiT3pSWFZjMlpjN2JZM2VlemZRaG5Sdz09IiwibWFjIjoiZjdjMGFkYWM2NThkZTFjNzdjMzg4YmRhNTQ5YmRlOWEwMTYzNjk4ZDMwMWZiOGYxZGRjOWIxMjQyZTI5NDgxMyIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:45:20', '2023-11-24 23:45:20'),
(13, 'eyJpdiI6Ik84UUR2VzNyalJtT0xwOGhLWGI2N1E9PSIsInZhbHVlIjoiTEcxOFp1SHJqV0lWQ0puREUyYzBOdz09IiwibWFjIjoiYjk2ODJjYWMxMWQ1OGY2YjdmOWZmNDhlZTk0NDA3NWY3NDhiN2RlY2M1NmE3OWFkZjMyZDJmNzRjNDU2ZGJiYSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:45:47', '2023-11-24 23:45:47'),
(14, 'eyJpdiI6Ii9JL24wVlZqK1hXTXhzSUdCUUZMOUE9PSIsInZhbHVlIjoiYitjWG81K0VFckVuVGdwaG1SekdiQT09IiwibWFjIjoiNTA3OWUyZWMyYWE0YzA3NzFkNTk4YmZlYjlhMTg5N2FiZjExZDU5NGJiNzRiOWFmMTlmOWY4NjdkN2IzM2U3NSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:48:51', '2023-11-24 23:48:51'),
(15, 'eyJpdiI6IjVBY3lZWGd2MlpKamRwOFhubml4NUE9PSIsInZhbHVlIjoiaVJUdW5JdHYwWUQyc1NTNlpacUJ5dz09IiwibWFjIjoiNWUxMzZhODA4YWFmYzU4YjIxMDk0YTY1MjJjZmU5ZTRhZmZmYzExNzllM2E1YmVlODM2NmFlMjE3MmFjZTVkNyIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:49:06', '2023-11-24 23:49:06'),
(16, 'eyJpdiI6ImdJSU5QZ01laS9qNEplSjAzVEFnM1E9PSIsInZhbHVlIjoiM0EwU1J3N0dXeSsrWFAzOWUxWjJZdz09IiwibWFjIjoiMzJhODhmNDM3ODM3NmNiNTA4NWRmYzAzZGQ4ZTMyODI3ZTdmZDU5ZGFmODVmNzRhOGRmMzg3ZDcxMDFkY2I0NCIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:49:23', '2023-11-24 23:49:23'),
(17, 'eyJpdiI6IlZtdGY2TzU0SWdqS2I3OVRqQTM5L3c9PSIsInZhbHVlIjoibXhQS0JYUnZOZkpCaTBUeWkvSWlrUT09IiwibWFjIjoiNGJiN2FlZDY2MjQyNzM3YjkxNjRjZmI5OTY5N2RmMmU4YzlmZjA4NzEzYzczODQ4N2NmMzc0MDJiMDNhM2RmNCIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:50:38', '2023-11-24 23:50:38'),
(18, 'eyJpdiI6InNUaTR6SmdmVXFTckZUQTJ2RVFLUmc9PSIsInZhbHVlIjoiRTFTa3M1dDJEZUh2ZkJDTVJqN3p1dz09IiwibWFjIjoiYTVjNTZlNjNiZWU2YTlmMThmYjQ5MTIwOGRiZTNkM2VkYWUxNjhlMjU2OWQwZjc2OGEzYWZlYmUyN2U2NDY0NSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-24 23:51:04', '2023-11-24 23:51:04'),
(19, 'eyJpdiI6Im1VZytkcVB1VFp0TjZtVnNVOVlOM1E9PSIsInZhbHVlIjoiWUkzcW91c2dFdTJReTJ0MnZhY1pPUT09IiwibWFjIjoiMDdmZmU4ZTFkZjhmMGExZWE2NzY1MDU4NGQwOGY2OTUwZTFkNDUwNzI2MWJlZmZmN2QwNzAzYjdhNzUzOGU2MyIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 07:35:28', '2023-11-25 07:35:28'),
(20, 'eyJpdiI6ImlWdVRNcTRJTDNOc2MyQ0lsSU91d2c9PSIsInZhbHVlIjoiWXVVZWpiaHFLYkMvUExGdFQwajVadz09IiwibWFjIjoiYTkyOTQ5Mjg5OGFjZjhhMTk2OWM2NzY1NDFjMmRiNWE1ODlkMmYxYTljZjU3NWZhZWRkNmUyZmQzMjI0MGZkZSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:04:08', '2023-11-25 08:04:08'),
(21, 'eyJpdiI6Iko5R2VCNTZxREJ6ZSs4L1o2eC9FQ2c9PSIsInZhbHVlIjoiaFk4SU5zakhrOEhmZk8wWHZTUzdMZz09IiwibWFjIjoiYTc5NGY3NTlmOTE4ZjQ0ZDQ5NzhjMjA0YjllZDc3MWQ5MTI4YjY4OGQ5YjM3MjMwOWJjY2M3MDM2NGIzODMxYyIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:05:44', '2023-11-25 08:05:44'),
(22, 'eyJpdiI6InZ3TDB3a2N1SFlGenZNUkQyaHF2WGc9PSIsInZhbHVlIjoiWXBJc3pVVnJ2QTN4aU1UUzN5NE0wUT09IiwibWFjIjoiNTVmNDRlYzBjOTZkMGQyMTExYTg5YzJhMWU5NzhiMWQyYWFjYTQ1OWUzN2MyNzEwNzRiMDBhMzRkMWY2MTY4ZCIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:06:00', '2023-11-25 08:06:00'),
(23, 'eyJpdiI6IlFQM1Fzb1FSZTd4NzhHWjl6NlhNWVE9PSIsInZhbHVlIjoiREFWR1liV1psSmJTTk9JY2w4S3IvUT09IiwibWFjIjoiNjdkZjRjMThhNDM5ZGZmYmUwZDEzNGQ3OTU1OGM2NWY5MjBhNWI5Y2M1MGVkYmI5YmU5ZWVjZWU0MWE5MDQyNiIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:07:37', '2023-11-25 08:07:37'),
(24, 'eyJpdiI6IlYyd0hLM3owM2QyeHJ5VWs0QWtudEE9PSIsInZhbHVlIjoiVnJJTVRWS1gwZnhHRHVQYUdWcWFTdz09IiwibWFjIjoiMzhhOWZjYjY5NDFmOTJmMWJlYjkxNWE4Y2U3OWM3ZmIzYTcxYjM3OWE2NTdlOGRmZTcyMGQzZjg2YzdlOTVmMSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:09:55', '2023-11-25 08:09:55'),
(25, 'eyJpdiI6IjQzTzljdjE3ZDc4bWNrNkQwZlluekE9PSIsInZhbHVlIjoieXM0NFVxWDEyTkJJYzV1SnpYQmdBUT09IiwibWFjIjoiMzFmN2M4MjRjNzcxMzMxZWMxMGYyYTE0NWY4NmJjYmVkODc5NWQzZjc0MjZkMmEyYWZjNGRmNzE1NzgxNzk2ZSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:10:07', '2023-11-25 08:10:07'),
(26, 'eyJpdiI6IklsaytNb0JpdGI0WEljT2JnSVkxamc9PSIsInZhbHVlIjoiNUZoYmNmbHFGNTFuK2RNaFY4Ry9Hdz09IiwibWFjIjoiYTlmZGY5ZmI3NDBhNjEwM2E2NTg5ZWQ1MTI3MmMwOTQ1ZGJiZTZlZDVhNjM2NGYwNjQ0NDMwOWEyOGVmZTNhMSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:10:32', '2023-11-25 08:10:32'),
(27, 'eyJpdiI6InU0ZUtmb1A2ZFlvL29tbXh0dUtyYUE9PSIsInZhbHVlIjoidzVuRDRaUTFYYkNMRHJDZ0ZCbzRGdz09IiwibWFjIjoiYzAxMWVhOGRiYmQ3ZDhjY2ZiOTE5NTZlMzA1YzQ0MDhmOThjMmM4OGU1YTI2OTc4Y2VkN2RlODk5ZGYwNGZiZCIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:15:25', '2023-11-25 08:15:25'),
(28, 'eyJpdiI6ImxxeXcxbzdPaE55MmdrMFI2d0hxbVE9PSIsInZhbHVlIjoib0NNN0hQZXcrbDBWcWNnYVdzR2lSdz09IiwibWFjIjoiNjA0OGRhZGVkY2ViZGYzMzgxYzE5ODkxMmNiYjM4YjkyZDM4MTYxNmRlZmZkODNjNjBlMWY5ODFmMzI1NjJmMyIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:23:07', '2023-11-25 08:23:07'),
(29, 'eyJpdiI6IlV2OWMrcTJpWHVuVkVPTEIxMDVWVUE9PSIsInZhbHVlIjoiOGl6MEFEalY0bVpGYVJLcFpTbWlLUT09IiwibWFjIjoiNDg2NmQ3YmQ0YzYwMThjYTdmYzVjOTBhMWUyOGViZDk1OTMyNmM4YTVhZDNmNGNjMTY5YTM3NWZiYThjM2EwMyIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:29:01', '2023-11-25 08:29:01'),
(30, 'eyJpdiI6ImZZdUNJTmtQSE5YM21rQllKQkFSZ3c9PSIsInZhbHVlIjoiMS9Ud0ZNdzArcE1sdmtnWXZHZFNldz09IiwibWFjIjoiYzJlOTA4YjFlYmRlYmYxYTIwODgzYTQxOGU0NDJhODIwYzIyOTJmYTJkMTlmMGRlMDAzNDZmMmZkNDBlMzY0YyIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:30:02', '2023-11-25 08:30:02'),
(31, 'eyJpdiI6InhUWFlEVmttMTVWNjNYN0Z2c0E4N3c9PSIsInZhbHVlIjoiVDQrSTdtdzFmVVd5dnYxbC9LZDNLUT09IiwibWFjIjoiMjJlZGM3NmZkYTZiNDY1YmZjYmQ4YzJhMGYwMzkzMzgxZDIxNGMwNTIyZWViZGFmOGQxODQwZWQ4YmI3OWU1NiIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:31:22', '2023-11-25 08:31:22'),
(32, 'eyJpdiI6ImYxRk9QT2g1bGhtMG96UytMMkpaVnc9PSIsInZhbHVlIjoiZkRwMWYvRzA1OU5DaTFibGJQNkp4QT09IiwibWFjIjoiY2U5OWQwODY2ODZlODViODRiMWU0NzU3MjcyNWZiNGVhYzBjN2Q2ODc4ZDM4MmVlNTdlMGJjNzNmNDUyZTJhZSIsInRhZyI6IiJ9', '2023-11-25', '2023-11-25 08:31:52', '2023-11-25 08:31:52'),
(33, 'eyJpdiI6Ik9JVGdZTERCYVdKVytNQlF2aHZ3MFE9PSIsInZhbHVlIjoiYURFOHpGTjZVUjRiT2dFYWZhWE5xdz09IiwibWFjIjoiNmFmNDQ0YTNmNWM4ZDUyOGE1MmFmODYxZTI5MmZlN2FhNGFmZWZhMDBkMTZkZDc1YzE3ZDJkZmNiNDgyMjZiMSIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 20:10:08', '2023-11-25 20:10:08'),
(34, 'eyJpdiI6Im5VVHN3ZUhYUlZJZnpRV2F3VnBUYlE9PSIsInZhbHVlIjoiYmg4a1M1SlVJazRmTVdxdVY3cTNiUT09IiwibWFjIjoiODIzMzA2NzhlZDA3ZjQ3NGNkMDI4ZGQwYzE5OWQ2M2U5M2YwNmU1ZjYzNmNhZTM4YzNkNGVjOTVkMDU2YTNiYSIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 20:11:43', '2023-11-25 20:11:43'),
(35, 'eyJpdiI6ImZwMHl1UkIyNDdKVTVCSzBDUjlxbkE9PSIsInZhbHVlIjoiZXRxSGdXNmJvM08vdVhJN21FN3FVZz09IiwibWFjIjoiNTQxNDljNzZkOWU0MzU1NDFjOGFiZGJhNDQ5YjY1NzNiMDMwMjczZWQyNjkxYzBiNGI2MmQ3MzZhZjhmYjhlZCIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:25:24', '2023-11-25 22:25:24'),
(36, 'eyJpdiI6Imx3REdBcVFiWTJRempKNTNDT2Nlb3c9PSIsInZhbHVlIjoiVUZzSzdJQWVwQW9sT3B5Z2hlSThIUT09IiwibWFjIjoiMDBlODRiM2UyMzJmMmI0OWU0YWVmMzNiNjNmYzNiMzgzOGVkYTcwYWU0MWUwZjNlNGRkNzk3YjlhNjcyNzQ1NSIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:33:28', '2023-11-25 22:33:28'),
(37, 'eyJpdiI6IkxQbXQxci85amRLU1VBdmU3c1VTR3c9PSIsInZhbHVlIjoiUXNmRVRtcWpHR1RqeUVhcllxTVhoQT09IiwibWFjIjoiMTNiNWU2NzBiNTEwNTc1MTE4YzY2NDliNzc3M2ZhMWMxOGU4MWNkM2VjMzkyZWZiMjVlODEzYjI5MzA0MWUxZSIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:36:04', '2023-11-25 22:36:04'),
(38, 'eyJpdiI6IkVzZTU2UEszY0ZvN1BZdjlobmhjNGc9PSIsInZhbHVlIjoiUEt6VFFXM0ZaN3krZXg2NEpGK3hjQT09IiwibWFjIjoiNWViMDQzYjE0NTJjYWU5OWY3YTEzZjY5MTgxMWIxYmM3MmQ4OWE0NDIyYTdkNzg0NWE1MWQyZTRmOWIzNWI1YyIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:36:37', '2023-11-25 22:36:37'),
(39, 'eyJpdiI6Imt6TzNkdk50TVZNelY0cXp0MWpFUUE9PSIsInZhbHVlIjoiQ1BsK1dSR0VnUjlXV0plWmVEUmc1Zz09IiwibWFjIjoiNWY3NmFhMWYxZDU5MDhiMzlmMDg0OWExOGJlODkwZDkxMjQzM2UzMzJmZGE4NjVkODc0MjQyMDdhYWIxZDc4YSIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:36:43', '2023-11-25 22:36:43'),
(40, 'eyJpdiI6IkdybXY1U0dEUnpzck9vMnVDM3ZLZnc9PSIsInZhbHVlIjoiTitHL0pNSDdTTU1xUkUyY3p2SzJXQT09IiwibWFjIjoiYTU2ZmU2NmY2NzIzODQwNTEwYzdiZWU5MTk0Y2IzMGE0M2UwMjM2N2U3ZDI0ZTQ0M2YyM2U2YjkxNDVkOGM5YyIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:36:44', '2023-11-25 22:36:44'),
(41, 'eyJpdiI6IlIxMmo1TkhRa1BEaGU4NVlvMUV1S2c9PSIsInZhbHVlIjoiNmdRSXRJdGtLd2l3N0ErZmN1dFlsdz09IiwibWFjIjoiYmRlYzMyYmZiNzY2NGZlNDBjMTZiOWQwMzY2NDAxYzI4Yjg3YTBkMDY3Y2M3ZjdhZjdjMjFmYmNkZTJjNGQ5NCIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:36:59', '2023-11-25 22:36:59'),
(42, 'eyJpdiI6IkpnaHErbWI1MTRpZEdEb1FJUndQdWc9PSIsInZhbHVlIjoidjdvZDJiL1YvWElLZnVmbTR0aVNmQT09IiwibWFjIjoiNzA4NGNjNjdlNTk5YjEwMDA0ZTBlYWNjM2ZiODVkYzgzNzdiMGUxMmI2Y2IxM2I1ZjkyOGM0NWU1NmVkY2VhMiIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:37:13', '2023-11-25 22:37:13'),
(43, 'eyJpdiI6ImpBem92UlhlQ1Z0WG0wK0RITTEwZWc9PSIsInZhbHVlIjoiWGRtYmJXU0pMdHpZQzhJMVAxZVladz09IiwibWFjIjoiZjRkZTc5NzNiODhiZTVjNmExODUyMzhjZTY3YWY4MzZkZGU1ZjNmYjA1YjRmNTc4YzEwNWVhZWU2NzFkZDg1MiIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:37:25', '2023-11-25 22:37:25'),
(44, 'eyJpdiI6ImJwbUI5M0ttOXhVTlVadERyM01oeGc9PSIsInZhbHVlIjoiUEhTNTMvaXdiTVFjVlUrck1sSWp1dz09IiwibWFjIjoiNjRhOTgxOGJhYzJiMmU2OGZlNzg1ODc5MDRiYzY5ZWZkNjUwZGZkYTk0MjgzMmRhY2EzZWVjOTRkYjc1Yzc2ZiIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:41:43', '2023-11-25 22:41:43'),
(45, 'eyJpdiI6IlZWaTJuUWZSN1BkbXFYb0Y1LzZkQ2c9PSIsInZhbHVlIjoiWitOMzV0TzdHZmZjTnBnRGtCaEhWZz09IiwibWFjIjoiZmMzOTI1Y2QxYmZjNTU4MmI0MTkxYjVjYWQyYWQ4MzZmMDhmOWNlODM4YjZkODljZWZhMmE1N2I0NDBmMDNhYSIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:42:05', '2023-11-25 22:42:05'),
(46, 'eyJpdiI6IkZhSnlONzRkeFBpK1lUTDd4U2o4aEE9PSIsInZhbHVlIjoiajJVMlpmZVZwdC9KZ044Um03SVZsZz09IiwibWFjIjoiMzdhYTcxOTJmNTQwMTRmNmM3MjU4MTE3MGZmNWI0YmQzOWM5ZDdiNjliZjU2OTE5ZDMzYzkzMGIwN2UzZDZiYiIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:42:15', '2023-11-25 22:42:15'),
(47, 'eyJpdiI6ImJ2OW1mVVF4V2o0MTVJeHl4azdZeHc9PSIsInZhbHVlIjoiM21KVXFQTTh0MWpheDIxRnEyNW41QT09IiwibWFjIjoiZGM3MzExNTZjYzgyNjViMTFhY2UwMWJhYWFmYzNlNzNlMTIzNWNlNWM5ODJhZmFmYTkwODI5NDAxMGNiYWM2YSIsInRhZyI6IiJ9', '2023-11-26', '2023-11-25 22:42:25', '2023-11-25 22:42:25'),
(48, 'eyJpdiI6Img3c05PSGt5SXUza3NrVkxncFdKd3c9PSIsInZhbHVlIjoiR3JrVGo5UHY5MHloY0Yxa3hSeWY4QT09IiwibWFjIjoiM2YyNmVjMmIxYmM1ZmVlMmM1MTc0MWJkOWY2NDZhYTgyOTY3NTQzZjk5MDBhZDYzZDQ5NzIyZWZmYTE2NDAwMCIsInRhZyI6IiJ9', '2023-11-26', '2023-11-26 07:21:14', '2023-11-26 07:21:14'),
(49, 'eyJpdiI6InAyNmo5TFY0YVFTN0VqQkxBRmxEWkE9PSIsInZhbHVlIjoib0craUhIY2hoOUpvZmhyODlBd1BEUT09IiwibWFjIjoiZmU0NWNiZGEzYTk0OWQ1MDZjOTBjOWRiMDc5YjNmMjIyMzYwMDQ3NjZhMDdhNTg5MzgxOTk4MWYwMGU0YzIzZiIsInRhZyI6IiJ9', '2023-11-26', '2023-11-26 07:30:00', '2023-11-26 07:30:00'),
(50, 'eyJpdiI6IlNiYjNWSHlkZXo0YnVhSDBNcUhFU0E9PSIsInZhbHVlIjoiNjhLUktad09XYzRGWDR1WUpJY21YZz09IiwibWFjIjoiZTExZmNlMGM5OGU3YWM5NmYxYjdiZWU5YTQwMmRlZWU3Y2M4NzU5ZGM5NDZhYzI0OTUwNDMyNjQ1ZjYyMjY1YyIsInRhZyI6IiJ9', '2023-11-26', '2023-11-26 08:11:53', '2023-11-26 08:11:53'),
(51, 'eyJpdiI6Inc4TkpDNU9JV292T0F0ck9aYXpxTnc9PSIsInZhbHVlIjoiS3NmeVlBcElWUlhGMDRYaCtsODFIQT09IiwibWFjIjoiZGI1OWUzY2RmNzhkY2JiYmU2NTNlZmEzM2YxN2Y5NjQyMWYzYTI3MmY4NzQ0MWMzZjYwZjdjOTdhOTc2NzYzNCIsInRhZyI6IiJ9', '2023-11-26', '2023-11-26 08:22:04', '2023-11-26 08:22:04'),
(52, 'eyJpdiI6ImFSMXRheDVXcjRLUzJsU0JJQ21Eb1E9PSIsInZhbHVlIjoibnJOR0pSQ0F0WDJWM0QvZFdXcWg1QT09IiwibWFjIjoiZGQ4ZTgwZTI0OTQ2OWM5ZjM0MThkYmQyN2Y0OWViN2FjZWU1Zjk3NGNhZGJlNjNmMTZjZDVmMWU0NTcxMzM0OSIsInRhZyI6IiJ9', '2023-11-26', '2023-11-26 08:22:31', '2023-11-26 08:22:31'),
(53, 'eyJpdiI6IjhOT1ZXZHVWNUpUcng5emJ3N3Jjd2c9PSIsInZhbHVlIjoicHROL09PSkdLdWNIdDBrRDFoNkFIZz09IiwibWFjIjoiZjdiNWU0ZWRmMGI0MzdkNmQ1ZTdmYmQ5ODhhNmU1ZmI1MjFhMzJhNmJkZDNiNzI5OTg0YWZhZmQxMDkxNmE3ZCIsInRhZyI6IiJ9', '2023-11-27', '2023-11-26 23:50:30', '2023-11-26 23:50:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indeks untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`);

--
-- Indeks untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_profil_foreign` (`id_profil`);

--
-- Indeks untuk tabel `viewer`
--
ALTER TABLE `viewer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `viewer`
--
ALTER TABLE `viewer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_profil_foreign` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id_profil`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
