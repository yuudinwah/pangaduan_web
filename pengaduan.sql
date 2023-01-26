-- phpMyAdmin SQL Dump
-- version 5.0.4deb2ubuntu5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Jan 2023 pada 19.33
-- Versi server: 8.0.29
-- Versi PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `caseResponses`
--

CREATE TABLE `caseResponses` (
  `id` int NOT NULL,
  `caseID` int NOT NULL,
  `userID` int NOT NULL,
  `response` text NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `caseResponses`
--

INSERT INTO `caseResponses` (`id`, `caseID`, `userID`, `response`, `createdAt`, `updatedAt`) VALUES
(2, 4, 1, 'Kerusakan sngat parah sehingga harus menunggu hujan reda terlebih dahulu', '2023-01-23 04:41:11', NULL),
(3, 4, 1, 'Kemungkinan harus meminta anggaran terlebih dahulu', '2023-01-23 05:00:54', NULL),
(4, 5, 1, 'Ini benar', '2023-01-23 06:43:23', NULL),
(5, 5, 1, 'asas', '2023-01-23 06:43:34', NULL),
(6, 6, 16, 'Si penendang sudah di proses dan diberitahu, jika masih seperti itu maka akan ditindak lanjuti', '2023-01-26 12:18:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cases`
--

CREATE TABLE `cases` (
  `id` int NOT NULL,
  `userID` int DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `detail` text,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Menunggu',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `cases`
--

INSERT INTO `cases` (`id`, `userID`, `name`, `email`, `title`, `detail`, `status`, `createdAt`, `updatedAt`) VALUES
(1, NULL, 'Wahyu Wahyudin', 'yuudinwah@mail.com', 'Testing', 'Detail', 'Proses', NULL, '2023-01-22 01:00:32'),
(2, NULL, 'Wahyu Wahyudin', 'yuudinwah@mail.com', 'Testing', 'Detail', NULL, NULL, NULL),
(3, NULL, 'Wahyu Wahyudin', 'yuudinwah@mail.com', 'Testing', 'Detail', 'Proses', '2023-01-22 13:01:43', '2023-01-23 02:02:34'),
(4, 1, 'Wahyu Wahyudin', 'wahyuwahyudin443@gmail.com', 'Tanggul Rusak', '(index):62 cdn.tailwindcss.com should not be used in production. To use Tailwind CSS in production, install it as a PostCSS plugin or use the Tailwind CLI: https://tailwindcss.com/docs/installation', 'Selesai', '2023-01-23 01:08:18', '2023-01-23 05:02:28'),
(5, NULL, 'Wahyu Wahyudin', 'wahyuwahyudin443@gmail.com', 'Jalan berlobang', 'asdhj asdhjkasd hjasdkjh asdhjka sdhjka sd', 'Proses', '2023-01-23 06:42:01', '2023-01-22 18:42:37'),
(6, NULL, 'Wahyudin', 'testing@mail.com', 'Bak Sampah sering ditendang oleh tetangga', 'Bak Sampah sering ditendang oleh tetangga, dan cctv menjadi buktinya, dan itu meresahkan bagi saya.', 'Selesai', '2023-01-26 12:15:44', '2023-01-26 00:18:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `action` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id`, `userID`, `action`, `detail`, `createdAt`) VALUES
(2, 1, 'response', 'asdasd', '2023-01-24 04:20:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'Developer', 'Active', '2023-01-22 11:02:51', NULL),
(2, 'Petugas', 'Active', '2023-01-22 11:03:13', NULL),
(3, 'Masyarakat', 'Active', '2023-01-22 11:03:37', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tokens`
--

CREATE TABLE `tokens` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `token` varchar(50) NOT NULL,
  `expiredAt` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tokens`
--

INSERT INTO `tokens` (`id`, `userID`, `token`, `expiredAt`, `createdAt`) VALUES
(1, 1, '654893a9e8c19b00936d5a3db5527a61', '2023-01-22 17:00:00', NULL),
(2, 1, '661fcda2827a2ec563747ceb90a69b58', '2023-01-22 17:00:00', NULL),
(3, 1, '2ca3879bd2115bce669b94ffeb0f50d8', '2023-01-22 17:00:00', NULL),
(4, 1, 'beb86b48598ddc06186a5213bdd1c6f7', '2023-01-22 17:00:00', NULL),
(5, 1, 'b0be13af55b6658c0a35b9bf05d87bda', '2023-01-22 17:00:00', NULL),
(6, 1, '181c5a0b27489839cb5fe0733d8f3d4b', '2023-01-22 17:00:00', NULL),
(7, 1, '57eb27b3919eba0c357904ae99341f7c', '2023-01-22 17:00:00', NULL),
(8, 1, 'd367fa01e3d85125edb17ebaa92a4d54', '2023-01-22 17:00:00', NULL),
(9, 1, '523d0fcfaedc30dbd2ba27b06124eda0', '2023-01-22 17:00:00', NULL),
(10, 1, '7a6ca442408384665d113c6ded669626', '2023-01-23 17:00:00', '2023-01-23 06:42:11'),
(11, 17, 'd89b2ac008523559f60684288942b1bf', '2023-01-25 17:00:00', '2023-01-25 12:18:21'),
(12, 17, 'fc875bef0abdafb985e43066967eaade', '2023-01-25 17:00:00', '2023-01-25 12:18:30'),
(13, 17, '1abdf277be23b55197b5b15ab3976015', '2023-01-25 17:00:00', '2023-01-25 12:20:25'),
(14, 17, 'd1c2aff8f0ff31809adf421593e1b523', '2023-01-25 17:00:00', '2023-01-25 12:21:07'),
(15, 17, '5fae1b3b3b6b2bd2462b5fe8cd7f4df1', '2023-01-25 17:00:00', '2023-01-25 12:21:33'),
(16, 16, 'ea6767dd9bd8184605582624b1dd8c69', '2023-01-26 17:00:00', '2023-01-26 12:16:13'),
(17, 7, '886e471534eacccdccfce3895a46be5b', '2023-01-26 17:00:00', '2023-01-26 12:26:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `handphone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Active',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `handphone`, `status`, `createdAt`, `updatedAt`) VALUES
(2, 'Wahyu Wahyudin', NULL, NULL, NULL, NULL, NULL, '2023-01-22 12:27:11', NULL),
(3, 'Wahyu Wahyudin', NULL, NULL, NULL, NULL, NULL, '2023-01-22 12:28:15', NULL),
(4, 'Wahyu Wahyudin', 'yuudinwah@mail.com', NULL, '123', NULL, NULL, '2023-01-22 12:29:09', NULL),
(5, 'Wahyu Wahyudin', 'yuudinwah@mail.com', NULL, '123', NULL, NULL, '2023-01-22 12:29:46', NULL),
(6, 'Wahyu Wahyudin', 'yuudinwah@mail.com', 'asdasd', '123', NULL, NULL, NULL, NULL),
(7, 'Wahyudin', 'yuudinwah@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(8, 'Wahyudin', 'yuudinwah1@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(9, 'Wahyudin', 'yuudinwah2@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(10, 'Wahyudin', 'yuudinwah3@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(11, 'Wahyudin', 'yuudinwah4@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(12, 'Wahyudin', 'yuudinwah5@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(13, 'Wahyudin', 'yuudinwah6@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(14, 'Wahyudin', 'yuudinwah7@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(15, 'Wahyudin', 'yuudinwah8@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(16, 'Wahyudin', 'yuudinwah9@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, NULL, NULL),
(17, 'Wahyudin', 'admin@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, NULL, '2023-01-25 12:14:45', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `usersRoles`
--

CREATE TABLE `usersRoles` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `roleID` int NOT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `usersRoles`
--

INSERT INTO `usersRoles` (`id`, `userID`, `roleID`, `createdAt`) VALUES
(1, 16, 3, '2023-01-22 12:40:50'),
(2, 17, 3, '2023-01-25 12:14:45');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `caseResponses`
--
ALTER TABLE `caseResponses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `usersRoles`
--
ALTER TABLE `usersRoles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `caseResponses`
--
ALTER TABLE `caseResponses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `usersRoles`
--
ALTER TABLE `usersRoles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
