-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2024 pada 15.20
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bkk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumnis`
--

CREATE TABLE `alumnis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nisn` bigint(20) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tahun_kelulusan` year(4) NOT NULL,
  `sasaran` varchar(255) NOT NULL,
  `tempat_sasaran` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alumnis`
--

INSERT INTO `alumnis` (`id`, `user_id`, `nisn`, `nama_siswa`, `jenis_kelamin`, `jurusan`, `tahun_kelulusan`, `sasaran`, `tempat_sasaran`, `nomor_telepon`, `email`, `photo`, `created_at`, `updated_at`) VALUES
(6, 1, 12321312, 'Wawan Hendrawan', 'Laki-laki', 'Bisnis Retail', '2024', 'Bekerja', 'adsadas', '12345678912', 'a@gmail.com', '1730095728.jpg', '2024-08-19 08:31:38', '2024-11-04 08:00:03'),
(8, 1, 123213122, 'Andi Santoso', 'Laki-laki', 'Akuntansi dan Keuangan Lembaga', '2023', 'Bekerja', 'Jakarta', '12345678901', 'andi@gmail.com', NULL, NULL, '2024-11-04 07:40:59'),
(9, 1, 223344556, 'Budi Kurniawan', 'Laki-laki', 'Teknik Komputer', '2021', 'Bekerja', 'Bandung', '12345678902', 'budi@gmail.com', NULL, NULL, NULL),
(10, 1, 334455667, 'Cici Ananda', 'Perempuan', 'Multimedia', '2020', 'Kuliah', 'Jakarta', '12345678903', 'cici@gmail.com', NULL, NULL, NULL),
(11, 1, 445566778, 'Dedi Supriyadi', 'Laki-laki', 'Teknik Mesin', '2022', 'Belum Kerja', 'Surabaya', '12345678904', 'dedi@gmail.com', NULL, NULL, NULL),
(12, 1, 556677889, 'Eka Saputra', 'Laki-laki', 'Teknik Elektro', '2019', 'Bekerja', 'Medan', '12345678905', 'eka@gmail.com', NULL, NULL, NULL),
(13, 1, 667788990, 'Fira Handayani', 'Perempuan', 'Multimedia', '2021', 'Kuliah', 'Yogyakarta', '12345678906', 'fira@gmail.com', NULL, NULL, NULL),
(14, 1, 778899001, 'Gilang Pratama', 'Laki-laki', 'Teknik Otomotif', '2020', 'Bekerja', 'Bali', '12345678907', 'gilang@gmail.com', NULL, NULL, NULL),
(15, 1, 889900112, 'Hani Nurdin', 'Perempuan', 'Multimedia', '2023', 'Kuliah', 'Semarang', '12345678908', 'hani@gmail.com', NULL, NULL, NULL),
(16, 1, 990011223, 'Irfan Setiawan', 'Laki-laki', 'Teknik Sipil', '2022', 'Bekerja', 'Malang', '12345678909', 'irfan@gmail.com', NULL, NULL, NULL),
(17, 1, 101122334, 'Joko Widodo', 'Laki-laki', 'Teknik Mesin', '2021', 'Belum Kerja', 'Depok', '12345678910', 'joko@gmail.com', NULL, NULL, NULL),
(19, 2, 1829393012839, 'Ujang', 'Laki-laki', 'Manajemen Perkantoran', '2024', 'Kuliah', 'Semarang', '081722928849', 'ujang@gmail.com', '1730095728.jpg', '2024-10-28 06:13:33', '2024-10-28 06:13:33'),
(20, 1, 1829393012840, 'Rina', 'Perempuan', 'Akuntansi dan Keuangan Lembaga', '2024', 'Bekerja', 'Jakarta', '081322933449', 'rina@gmail.com', NULL, NULL, NULL),
(21, 1, 1829393012841, 'Dodi', 'Laki-laki', 'Broadcasting dan Perfilman', '2024', 'Kuliah', 'Bandung', '081422934559', 'dodi@gmail.com', NULL, NULL, NULL),
(22, 1, 1829393012842, 'Siti', 'Perempuan', 'Bisnis Retail', '2024', 'Wirausaha', 'Surabaya', '081522935669', 'siti@gmail.com', NULL, NULL, NULL),
(23, 1, 1829393012843, 'Ahmad', 'Laki-laki', 'Manajemen Perkantoran', '2024', 'Bekerja', 'Yogyakarta', '081622936779', 'ahmad@gmail.com', NULL, NULL, NULL),
(24, 1, 1829393012844, 'Lina', 'Perempuan', 'Akuntansi dan Keuangan Lembaga', '2024', 'Kuliah', 'Malang', '081722937889', 'lina@gmail.com', NULL, NULL, NULL),
(25, 1, 1829393012845, 'Budi', 'Laki-laki', 'Broadcasting dan Perfilman', '2024', 'Belum Kerja', 'Semarang', '081822938999', 'budii@gmail.com', NULL, NULL, NULL),
(26, 1, 1829393012846, 'Nurul', 'Perempuan', 'Bisnis Retail', '2024', 'Kuliah', 'Jakarta', '081922930109', 'nurul@gmail.com', NULL, NULL, NULL),
(27, 1, 1829393012847, 'Samsul', 'Laki-laki', 'Manajemen Perkantoran', '2024', 'Bekerja', 'Surabaya', '082022931219', 'samsul@gmail.com', NULL, NULL, NULL),
(28, 1, 1829393012848, 'Ratna', 'Perempuan', 'Akuntansi dan Keuangan Lembaga', '2024', 'Kuliah', 'Yogyakarta', '082122932329', 'ratna@gmail.com', NULL, NULL, NULL),
(29, 6, 81828392999, 'Tama', 'Laki-laki', 'Broadcasting dan Perfilman', '2024', 'KULIAH', 'Bogor', '081927276245', 'tama@gmail.com', NULL, '2024-11-03 00:09:33', '2024-11-03 00:09:33'),
(30, 2, 1928391982, 'mamsoas', 'Laki-laki', 'Akuntansi dan Keuangan Lembaga', '2021', 'Bekerja', 'Jogja', '081299120932', 'mamaows@gmail.com', NULL, '2024-11-04 03:13:46', '2024-11-04 03:13:46'),
(31, 2, 8812919821, 'hasuajwam', 'Perempuan', 'Bisnis Retail', '2024', 'Kuliah', 'Bekasi', '081571729102', 'gahshaiw@gmail.com', NULL, '2024-11-04 04:11:56', '2024-11-04 04:11:56'),
(32, 2, 99182821, 'mamsmmsa', 'Perempuan', 'Multimedia', '2021', 'Kuliah', 'Karawang', '081299197726', 'mansaj@gmail.com', NULL, '2024-11-04 07:19:50', '2024-11-04 07:19:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `job_id`, `created_at`, `updated_at`) VALUES
(18, 2, 4, '2024-10-29 07:29:25', '2024-10-29 07:29:25'),
(26, 6, 3, NULL, NULL),
(28, 2, 1, '2024-11-03 01:08:26', '2024-11-03 01:08:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan`
--

CREATE TABLE `lowongan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `perusahaan` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `gaji` decimal(10,2) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `requirement` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`requirement`)),
  `photo` varchar(255) DEFAULT NULL,
  `link_lamaran` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lowongan`
--

INSERT INTO `lowongan` (`id`, `judul`, `perusahaan`, `lokasi`, `kategori`, `tipe`, `gaji`, `deskripsi`, `requirement`, `photo`, `link_lamaran`, `created_at`, `updated_at`) VALUES
(1, 'Software Engineer', 'PT. Teknologi Canggih', 'Jakarta, Indonesia', 'Desain Web dan Interaksi (Desain dan Arsitektur)', 'Kontrak', 10000000.00, 'Bertanggung jawab untuk mengembangkan aplikasi dan sistem perangkat lunak.', '[\"Pengalaman minimal 2 tahun di bidang pengembangan perangkat lunak\",\"Menguasai bahasa pemrograman PHP dan Laravel\",\"Kemampuan bekerja dalam tim dan berkomunikasi dengan baik\"]', 'software_engineer.jpg', 'https://id.jobstreet.com/id/job/79810306?ref=search-standalone&type=standout&origin=showNewTab#sol=8ed2628576fd8b350ef7dab13cc463db33095dde', '2024-10-25 12:24:00', '2024-11-04 03:51:36'),
(2, 'Data Scientist', 'PT. Data Analytics', 'Bandung, Indonesia', 'Analisis Data dan Machine Learning', 'Penuh Waktu', 15000000.00, 'Menganalisis data besar untuk memberikan wawasan yang dapat ditindaklanjuti.', '[\"Pengalaman minimal 3 tahun di bidang data science\",\"Menguasai Python dan alat analisis data seperti Pandas dan NumPy\",\"Kemampuan untuk berkomunikasi hasil analisis dengan baik\"]', NULL, 'https://id.jobstreet.com/id/job/79804862?ref=search-standalone&type=standard&origin=showNewTab#sol=8dca422379ede8466507d2e57154272f09cf21b9', '2024-10-25 12:24:21', '2024-10-25 12:24:21'),
(3, 'UI/UX Designer', 'PT. Kreatif Digital', 'Yogyakarta, Indonesia', 'Desain dan Pengalaman Pengguna', 'Freelance', 8000000.00, 'Merancang antarmuka dan pengalaman pengguna yang menarik dan intuitif.', '[\"Pengalaman minimal 2 tahun dalam desain UI\\/UX\",\"Familiar dengan alat desain seperti Figma dan Adobe XD\",\"Kemampuan untuk melakukan penelitian pengguna dan pengujian usability\"]', NULL, 'https://id.jobstreet.com/id/job/79853987?ref=search-standalone&type=standout&origin=showNewTab#sol=895de63d36a141346bf11634d449245ab149c200', '2024-10-25 12:24:32', '2024-10-25 12:24:32'),
(4, 'Hengker', 'PT HengkerTzy', 'Moskow', 'Hengker Jahat', 'Penuh Waktu', 50000000.00, 'Ngehack NASA', '[\"Bisa hack pake HTML\",\"Bisa benerin AC\",\"Bisa balikin akun Facebook yang dihack\"]', NULL, NULL, '2024-10-27 15:27:38', '2024-10-27 15:27:38');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_05_131050_create_alumnis_table', 1),
(6, '2024_10_25_180640_create_lowongan_table', 2),
(7, '2024_10_25_191846_add_requirement_to_lowongan_table', 3),
(8, '2024_10_26_053922_add_user_id_to_alumni_table', 4),
(9, '2024_10_28_055203_add_photo_to_alumnis_and_lowongan_tables', 5),
(10, '2024_10_29_095707_add_link_lamaran_to_lowongan_table', 6),
(11, '2024_10_29_132653_create_bookmarks_table', 7),
(12, '2024_11_04_101219_add_role_to_users_table', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'YourAppName', 'ac0a11020f677123655509a62a4d22d850e477fde596358167b7a314aa2d62b2', '[\"*\"]', '2024-10-25 22:53:41', NULL, '2024-10-25 10:53:43', '2024-10-25 22:53:41'),
(2, 'App\\Models\\User', 2, 'YourAppName', '6a62f05c2aa876ba6b715b3310d767dcdbec84e95bc6fd395498476ef95c9908', '[\"*\"]', '2024-10-26 10:07:01', NULL, '2024-10-25 22:54:18', '2024-10-26 10:07:01'),
(3, 'App\\Models\\User', 2, 'YourAppName', 'ed667bd215f446fb63f6a34c9e9324643a61c8b525154e0313ac96e57903bd86', '[\"*\"]', '2024-10-27 23:08:48', NULL, '2024-10-27 23:02:36', '2024-10-27 23:08:48'),
(4, 'App\\Models\\User', 2, 'YourAppName', '9915258d6fb56277336358c6aed221b7fe45ae6e28d636ced413fd2be13b5737', '[\"*\"]', NULL, NULL, '2024-10-28 03:01:51', '2024-10-28 03:01:51'),
(5, 'App\\Models\\User', 2, 'YourAppName', '202b28045cdef08b51d2f6480df7891237521f0efe3c7512e3255456059dbe3a', '[\"*\"]', NULL, NULL, '2024-10-28 03:01:57', '2024-10-28 03:01:57'),
(6, 'App\\Models\\User', 2, 'YourAppName', 'c66aece9f7ba3d6e6562468fde2721a3f2ee2fbae796e63d62f79bc94836a37a', '[\"*\"]', NULL, NULL, '2024-10-28 03:07:13', '2024-10-28 03:07:13'),
(7, 'App\\Models\\User', 2, 'YourAppName', '0b91facad4a8f5e56520d0ea2331d88797be40908a0ab8afa047c1fd4ad62a20', '[\"*\"]', NULL, NULL, '2024-10-28 03:16:44', '2024-10-28 03:16:44'),
(8, 'App\\Models\\User', 2, 'YourAppName', 'b6f860c63655e165e002d053b465cc09f30a574b62627711bb5bb54476e82e10', '[\"*\"]', '2024-11-03 00:42:10', NULL, '2024-10-28 03:25:14', '2024-11-03 00:42:10'),
(9, 'App\\Models\\User', 2, 'YourAppName', 'accd9e86667e8e369fe09d9b01f92ef39453054fd5cb382476160a7134d7ccca', '[\"*\"]', NULL, NULL, '2024-10-28 03:28:10', '2024-10-28 03:28:10'),
(10, 'App\\Models\\User', 2, 'YourAppName', '12c29db354fc45127ca29e5bcbdadb9278756fcc8d7be252226a982fb02216bd', '[\"*\"]', '2024-10-28 03:29:05', NULL, '2024-10-28 03:29:04', '2024-10-28 03:29:05'),
(11, 'App\\Models\\User', 2, 'YourAppName', 'c35ec8f73fcf88937cefcd2daec5c8bcbdb6f655b91686129187a2d830194492', '[\"*\"]', '2024-10-28 03:33:56', NULL, '2024-10-28 03:30:55', '2024-10-28 03:33:56'),
(12, 'App\\Models\\User', 2, 'YourAppName', '91e768382a2e31b0f3a856717a1b8f843c0d795520159a1cfad488657585531d', '[\"*\"]', '2024-10-28 03:39:34', NULL, '2024-10-28 03:34:42', '2024-10-28 03:39:34'),
(13, 'App\\Models\\User', 2, 'YourAppName', 'd7a387f8c92399a019b6927eddb2ebe69a86d580e45898aaf26444e6dfd3d727', '[\"*\"]', '2024-10-28 03:40:16', NULL, '2024-10-28 03:40:14', '2024-10-28 03:40:16'),
(14, 'App\\Models\\User', 2, 'YourAppName', '6c45fb4a93e52892328ce83eb6b3fba9c6dc6c02c634478a88a3b86e7c53c6a6', '[\"*\"]', '2024-10-28 03:44:58', NULL, '2024-10-28 03:42:37', '2024-10-28 03:44:58'),
(15, 'App\\Models\\User', 2, 'YourAppName', '9ea6000992d7834c417ddfb161a271920419393bb7535742f266c11c832e9752', '[\"*\"]', '2024-10-28 03:56:00', NULL, '2024-10-28 03:45:56', '2024-10-28 03:56:00'),
(16, 'App\\Models\\User', 2, 'YourAppName', '4e44d291c6ef4d8fd561a7a78a5821a9d1da971851887d49bf550d38e811107b', '[\"*\"]', '2024-10-28 04:21:44', NULL, '2024-10-28 04:21:42', '2024-10-28 04:21:44'),
(17, 'App\\Models\\User', 2, 'YourAppName', '2d4f093124d7a617b3a72919dbe51fdd10f3dfa014c8b86df7045db60505385d', '[\"*\"]', '2024-10-28 04:29:15', NULL, '2024-10-28 04:24:06', '2024-10-28 04:29:15'),
(18, 'App\\Models\\User', 2, 'YourAppName', 'a966df941cf91d662a40dadd5cc77f8f8cc5dcf4dddfe7f07b43b30ece30fb00', '[\"*\"]', '2024-10-28 06:05:51', NULL, '2024-10-28 04:39:44', '2024-10-28 06:05:51'),
(19, 'App\\Models\\User', 2, 'YourAppName', '1293dadd218498c4a82f7b9a1797dd7d5361affaa365d26ddf6455506da8b50e', '[\"*\"]', '2024-10-28 06:20:02', NULL, '2024-10-28 06:12:54', '2024-10-28 06:20:02'),
(20, 'App\\Models\\User', 2, 'YourAppName', 'ef73e96053f7da2c7a92d231bbd08fb6191924682eb8186b472934e6de1914ce', '[\"*\"]', '2024-10-28 06:56:30', NULL, '2024-10-28 06:21:20', '2024-10-28 06:56:30'),
(21, 'App\\Models\\User', 2, 'YourAppName', 'c352a0d872c50db100ca7cc443011266f481f2fa9f89a0bb6d0a145792e5cf60', '[\"*\"]', '2024-10-28 08:38:56', NULL, '2024-10-28 08:38:41', '2024-10-28 08:38:56'),
(22, 'App\\Models\\User', 2, 'YourAppName', '136b60e5d79435de957bb8440d7c2624c59b394112df635ea202ac650cc1e575', '[\"*\"]', '2024-10-28 08:51:02', NULL, '2024-10-28 08:48:43', '2024-10-28 08:51:02'),
(23, 'App\\Models\\User', 2, 'YourAppName', '386fa75cb6667d49a89b2c251787270546023db4e64178c85028ff86d305675e', '[\"*\"]', '2024-10-28 08:51:36', NULL, '2024-10-28 08:48:47', '2024-10-28 08:51:36'),
(24, 'App\\Models\\User', 2, 'YourAppName', '313fed8dc3ee26143837298c6520e0216fd6e1aa870ed847471bafd31f3fc4ad', '[\"*\"]', '2024-10-28 17:31:00', NULL, '2024-10-28 16:59:57', '2024-10-28 17:31:00'),
(25, 'App\\Models\\User', 2, 'YourAppName', 'fb5335babe1af4fd4cced9b6f47a8b0032a16b965457cc10f5c403ff77ea18d8', '[\"*\"]', '2024-10-29 03:56:52', NULL, '2024-10-29 03:48:08', '2024-10-29 03:56:52'),
(26, 'App\\Models\\User', 2, 'YourAppName', '180c23efd0c41f9cc0a8c625544f72a174fe95f5717530819f0c143abe284373', '[\"*\"]', '2024-10-29 04:04:16', NULL, '2024-10-29 04:04:15', '2024-10-29 04:04:16'),
(27, 'App\\Models\\User', 2, 'YourAppName', '1311c081ca2376a2b3e01877fd4fbbe7f517951e90cf9a2ea5827025c18fad24', '[\"*\"]', '2024-10-29 04:07:13', NULL, '2024-10-29 04:07:12', '2024-10-29 04:07:13'),
(28, 'App\\Models\\User', 2, 'YourAppName', '12f9f7f7d51bc67abac78ed51aa35b59a7c94a24081211bd7008b75ae9c7f998', '[\"*\"]', '2024-10-29 04:20:23', NULL, '2024-10-29 04:20:22', '2024-10-29 04:20:23'),
(29, 'App\\Models\\User', 2, 'YourAppName', '0eb996a0c952f37d2a5b081f3d2116bd3f8ad8e2b0ce4b4c222fc3af679032b8', '[\"*\"]', '2024-10-29 04:22:54', NULL, '2024-10-29 04:22:53', '2024-10-29 04:22:54'),
(30, 'App\\Models\\User', 2, 'YourAppName', 'af18d1fe36893b94b08798bee413759b5f03070e590147c056e4a760dd4341b4', '[\"*\"]', '2024-10-29 04:39:08', NULL, '2024-10-29 04:39:07', '2024-10-29 04:39:08'),
(31, 'App\\Models\\User', 2, 'YourAppName', '376c1efeb9b560dbd1314890cb46202070ddcb573251d231039aef5d6dd99359', '[\"*\"]', '2024-10-29 04:57:54', NULL, '2024-10-29 04:57:53', '2024-10-29 04:57:54'),
(32, 'App\\Models\\User', 2, 'YourAppName', 'e7eb7f60db3a2eae10b57f7b04013f226b1c43542b513683b3c46c64eb301cd9', '[\"*\"]', '2024-10-29 06:20:25', NULL, '2024-10-29 06:16:14', '2024-10-29 06:20:25'),
(33, 'App\\Models\\User', 2, 'YourAppName', '45eec8c5e15c8822f678e86253982bc0ab0bf9a1b76b9d00d367f33892acd148', '[\"*\"]', '2024-10-29 06:56:35', NULL, '2024-10-29 06:43:09', '2024-10-29 06:56:35'),
(34, 'App\\Models\\User', 2, 'YourAppName', 'f1fc108ad3ba4a242cb91c98403696f0dda48c5771f4dc54bf864bcec604b9b0', '[\"*\"]', '2024-10-29 07:04:14', NULL, '2024-10-29 07:02:00', '2024-10-29 07:04:14'),
(35, 'App\\Models\\User', 2, 'YourAppName', '72181bb0f3730f31e86faddd042bdaf296ad6b8cc67d922e5a9a9f9a58cb5e73', '[\"*\"]', '2024-10-29 07:32:38', NULL, '2024-10-29 07:28:32', '2024-10-29 07:32:38'),
(36, 'App\\Models\\User', 2, 'YourAppName', '02e218ca24b928c80283ec16e3003cac705f185d9425d77c77c2456ed9e164cd', '[\"*\"]', '2024-10-31 00:29:50', NULL, '2024-10-31 00:28:25', '2024-10-31 00:29:50'),
(37, 'App\\Models\\User', 2, 'YourAppName', 'a66f8427495439f87db50af4509d2e1645eca073b1f4f29f12135f968135519b', '[\"*\"]', '2024-11-02 23:43:28', NULL, '2024-11-02 23:43:17', '2024-11-02 23:43:28'),
(38, 'App\\Models\\User', 2, 'YourAppName', '3a2b27fbe4b9d074badd31eed73d05aa4cc890682804cce19a262f79e622215a', '[\"*\"]', '2024-11-02 23:48:27', NULL, '2024-11-02 23:48:26', '2024-11-02 23:48:27'),
(39, 'App\\Models\\User', 6, 'YourAppName', '2e97bbb151f539ec3bff28314b1cb6d79d3cd6743ea89294b9bd894a0be749ce', '[\"*\"]', '2024-11-03 00:09:39', NULL, '2024-11-03 00:07:22', '2024-11-03 00:09:39'),
(40, 'App\\Models\\User', 6, 'YourAppName', 'fabb32e277f64c620bd0a29562af3532eaade3d22e6450042763ad1d1506fba7', '[\"*\"]', '2024-11-03 00:23:09', NULL, '2024-11-03 00:23:04', '2024-11-03 00:23:09'),
(41, 'App\\Models\\User', 2, 'YourAppName', '8489eed2de3f5ba8d54bd43542cfb6e4c0e42b1622f03ed3ae6abaf7a831e758', '[\"*\"]', '2024-11-03 00:23:49', NULL, '2024-11-03 00:23:17', '2024-11-03 00:23:49'),
(42, 'App\\Models\\User', 2, 'YourAppName', '31d6e787980cf38f22d7372104f11bf99f03e20f0bc87b318c3e7ca9e9c741cb', '[\"*\"]', NULL, NULL, '2024-11-03 00:26:44', '2024-11-03 00:26:44'),
(43, 'App\\Models\\User', 2, 'YourAppName', '6a54a5a8a259f30c32a3bff03dfff0619e0a926eb31d15d9989b26afb8215a60', '[\"*\"]', '2024-11-03 00:27:57', NULL, '2024-11-03 00:27:39', '2024-11-03 00:27:57'),
(44, 'App\\Models\\User', 2, 'YourAppName', '8840e8adf3100d388e41bf9c32d460b079d83807442a7d2427898c2757fc0aac', '[\"*\"]', '2024-11-03 00:29:23', NULL, '2024-11-03 00:29:21', '2024-11-03 00:29:23'),
(45, 'App\\Models\\User', 2, 'YourAppName', 'b41ca194e5f223ab4504ec0b78e692dc3f06aa50f810eacf31817412f2a37013', '[\"*\"]', '2024-11-03 01:08:26', NULL, '2024-11-03 01:05:27', '2024-11-03 01:08:26'),
(46, 'App\\Models\\User', 2, 'YourAppName', '51dbbd6714bc8f3fb5984e274ada4ac08b6975dd7024655d180ba3df6c477ed2', '[\"*\"]', '2024-11-03 01:11:19', NULL, '2024-11-03 01:11:16', '2024-11-03 01:11:19'),
(47, 'App\\Models\\User', 2, 'YourAppName', 'cba3422b8812ab275795599406a62d45dacadf7ebf47e3d1533baaad91cef43e', '[\"*\"]', '2024-11-03 01:14:29', NULL, '2024-11-03 01:11:30', '2024-11-03 01:14:29'),
(48, 'App\\Models\\User', 2, 'YourAppName', 'e4954a05e4c916354a70a51fe3f7a659579db1a697067cea6e3861ad985cf02a', '[\"*\"]', '2024-11-03 01:27:22', NULL, '2024-11-03 01:24:52', '2024-11-03 01:27:22'),
(49, 'App\\Models\\User', 2, 'YourAppName', 'd088564e512f219e82d63c00924d7dafaa3bf49baa31c03f3ad502902aa9808d', '[\"*\"]', '2024-11-03 01:33:38', NULL, '2024-11-03 01:28:14', '2024-11-03 01:33:38'),
(50, 'App\\Models\\User', 6, 'YourAppName', '2ae38d44e35b3fbebf85cd320d0b9f24e0eba56f904cdbaf6ea0058a230955d5', '[\"*\"]', '2024-11-03 01:33:53', NULL, '2024-11-03 01:33:48', '2024-11-03 01:33:53'),
(51, 'App\\Models\\User', 2, 'YourAppName', '8cf8e84ddd71a0ddd82d29f4922c0074f6db7e03085b85c5a597e4475effcebd', '[\"*\"]', '2024-11-03 02:42:51', NULL, '2024-11-03 02:41:30', '2024-11-03 02:42:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nasywa Rayhan', 'b@gmail.com', NULL, '$2y$10$CboMya331VvrsPMkzXQaee6MAd8FKEQ/pG9d4jdFyLVtRGQi10eQG', 'admin', NULL, '2024-07-29 00:22:13', '2024-07-29 00:22:13'),
(2, 'rayhan', 'a@gmail.com', NULL, '$2y$10$nfkowaUObVt0FzQ0F0qADebjv7pHymqaDnMeQ4.PBU2qHEBdGfBvi', 'admin', NULL, '2024-10-20 07:16:53', '2024-10-28 10:26:30'),
(6, 'Tama', 'tama@gmail.com', NULL, '$2y$10$wsyPv7Dijx5a0l3/8iC4kOyeVlFWJ2JoB9e5/D77fThMtdBjxvMjC', 'user', NULL, '2024-11-03 00:07:10', '2024-11-03 00:07:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alumnis`
--
ALTER TABLE `alumnis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alumnis_nisn_unique` (`nisn`),
  ADD UNIQUE KEY `alumnis_email_unique` (`email`),
  ADD KEY `alumnis_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookmarks_user_id_foreign` (`user_id`),
  ADD KEY `bookmarks_job_id_foreign` (`job_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alumnis`
--
ALTER TABLE `alumnis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alumnis`
--
ALTER TABLE `alumnis`
  ADD CONSTRAINT `alumnis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `lowongan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
