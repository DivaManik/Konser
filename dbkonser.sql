-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2024 pada 16.55
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkonser`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `konser`
--

CREATE TABLE `konser` (
  `id` int(11) NOT NULL,
  `nama_artis` varchar(255) NOT NULL,
  `nama_konser` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `waktu_konser` date NOT NULL,
  `jam_konser` time NOT NULL,
  `stock_supervip` int(11) NOT NULL,
  `stock_vip` int(11) NOT NULL,
  `stock_reguler` int(11) NOT NULL,
  `harga_reguler` int(11) NOT NULL,
  `harga_vip` int(11) NOT NULL,
  `harga_supervip` int(11) NOT NULL,
  `deskripsi_konser` varchar(255) NOT NULL,
  `gambar_konser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konser`
--

INSERT INTO `konser` (`id`, `nama_artis`, `nama_konser`, `lokasi`, `waktu_konser`, `jam_konser`, `stock_supervip`, `stock_vip`, `stock_reguler`, `harga_reguler`, `harga_vip`, `harga_supervip`, `deskripsi_konser`, `gambar_konser`) VALUES
(4, 'Bruno Mars', 'Bruno Mars : Lazy Day Concert In Jakarta', 'Indonesia', '2025-05-15', '18:00:00', 50, 100, 130, 300000, 500000, 800000, '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi minus eveniet suscipit perferendis quia incidunt est rem modi provident id dolorum, possimus laboriosam enim distinctio maiores ullam quae beatae dicta!\n', 'img/konser_img/bruno.jpg'),
(5, 'Taylor Swift', 'Taylor Swift Love You All', 'Singapore', '2025-05-31', '17:00:00', 80, 90, 50, 2000000, 3000000, 5000000, '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi minus eveniet suscipit perferendis quia incidunt est rem modi provident id dolorum, possimus laboriosam enim distinctio maiores ullam quae beatae dicta!\r\n', 'img/konser_img/taylor.jpg'),
(6, 'Ed Sheeran', 'Ed Sheeran World Tour ', 'Australia', '2024-09-28', '17:00:00', 60, 70, 90, 5000000, 7000000, 10000000, '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi minus eveniet suscipit perferendis quia incidunt est rem modi provident id dolorum, possimus laboriosam enim distinctio maiores ullam quae beatae dicta!\r\n', 'img\\konser_img\\ed.jpg'),
(7, 'JKT48', 'JKT48 Rapsodi', 'Jakarta', '2024-06-29', '19:00:00', 90, 80, 150, 300000, 600000, 1000000, 'uigkiashdklajsdkjagsdaslkjdgbkjavskjhasjhasfdkjagskjagsdkjhahgsdkjaghsvkjhagsvdjhasd', 'img\\konser_img\\jkt48.jpg'),
(8, 'Alan Walker', 'Alan Walker World Tour : Mexico', 'Mexico', '2024-11-29', '19:30:00', 100, 200, 1000, 250000, 500000, 700000, 'fdtghjklygiyvklgutgkggkhhkgjhbj', 'img\\konser_img\\aw.jpeg'),
(9, 'Avenged Sevenfold', 'Avenged Sevenfold World Tour : Japan', 'Tokyo', '2025-02-01', '17:00:00', 119, 148, 199, 1000000, 2000000, 3000000, 'gjhkjhkjgdakjgsakdgkjagdkasgdakjsdbaskad', 'img\\konser_img\\as.jpeg'),
(10, 'BTS', 'BTS World Tour: Seoul', 'Seoul', '2025-07-20', '19:00:00', 200, 400, 800, 1500000, 2500000, 4000000, 'BTS kembali dengan tur dunia mereka di Seoul. Jangan lewatkan aksi panggung mereka yang spektakuler!', 'img/konser_img/bts.jpg'),
(11, 'Coldplay', 'Coldplay Music of the Spheres Tour', 'London', '2025-08-05', '20:00:00', 150, 300, 600, 1000000, 2000000, 3500000, 'Coldplay hadir dengan tur terbaru mereka di London. Pengalaman musik yang tak terlupakan!', 'img/konser_img/coldplay.jpg'),
(12, 'Ariana Grande', 'Ariana Grande Sweetener World Tour', 'New York', '2025-09-15', '21:00:00', 120, 250, 500, 1200000, 2200000, 3700000, 'Ariana Grande akan menyapa penggemar di New York dengan konser yang memukau!', 'img/konser_img/ariana.jpg'),
(13, 'Imagine Dragons', 'Imagine Dragons Mercury World Tour', 'Las Vegas', '2025-10-10', '18:30:00', 100, 200, 400, 1100000, 2100000, 3600000, 'Imagine Dragons akan mengguncang Las Vegas dengan hits mereka!', 'img/konser_img/imagine_dragons.jpg'),
(14, 'Billie Eilish', 'Billie Eilish Happier Than Ever Tour', 'Los Angeles', '2025-11-25', '20:00:00', 80, 160, 320, 1300000, 2300000, 3800000, 'Billie Eilish hadir dengan tur Happier Than Ever di Los Angeles!', 'img/konser_img/billie.jpg'),
(15, 'The Weeknd', 'The Weeknd After Hours Til Dawn Tour', 'Toronto', '2025-12-10', '19:30:00', 110, 220, 440, 1400000, 2400000, 3900000, 'The Weeknd akan tampil di Toronto dengan konser After Hours Til Dawn.', 'img/konser_img/weeknd.jpg'),
(16, 'Blackpink', 'Blackpink The Show', 'Bangkok', '2026-01-15', '18:00:00', 90, 180, 360, 1250000, 2250000, 3750000, 'Blackpink mengadakan konser spektakuler mereka di Bangkok.', 'img/konser_img/blackpink.jpg'),
(17, 'Post Malone', 'Post Malone Runaway Tour', 'Sydney', '2026-02-20', '20:00:00', 75, 150, 300, 1100000, 2100000, 3600000, 'Post Malone akan tampil di Sydney dengan tur Runaway.', 'img/konser_img/post_malone.jpg'),
(18, 'Shawn Mendes', 'Shawn Mendes Wonder Tour', 'Paris', '2026-03-25', '19:00:00', 85, 170, 340, 1300000, 2300000, 3800000, 'Shawn Mendes akan menyapa penggemarnya di Paris dengan konser Wonder.', 'img/konser_img/shawn_mendes.jpg'),
(19, 'Dua Lipa', 'Dua Lipa Future Nostalgia Tour', 'Berlin', '2026-04-10', '20:30:00', 95, 190, 380, 1350000, 2350000, 3850000, 'Dua Lipa akan hadir dengan konser Future Nostalgia di Berlin.', 'img/konser_img/dua_lipa.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `konser_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `konser_id`, `type`, `first_name`, `last_name`, `phone_number`, `email`, `purchase_date`, `user_id`) VALUES
(5, 9, 'Super VIP', 'a', 'a', '0882', 'a@gmail.com', '2024-06-08 03:30:21', 1),
(6, 9, 'Super VIP', 'asd', 'io', '0987', 'op@gmail.com', '2024-06-08 03:55:10', 7),
(7, 9, 'VIP', 'uia', 'ghjkl', '09876', 'asda@gmail.com', '2024-06-08 11:03:04', 1),
(8, 9, 'Reguler', 'a', 'a', '09876', 'asd@gmail.com', '2024-06-08 11:42:20', 1),
(10, 9, 'Super VIP', 'asd', 'asde', '09876', 'asd@gmail.com', '2024-06-08 11:42:20', 1),
(12, 9, 'VIP', 'op', 'mc', '09090', 'op@gmail.com', '2024-06-09 05:17:12', 1),
(13, 9, 'Reguler', 'asd', 'asds', '09', 'lll@gmail.com', '2024-06-09 14:07:27', 1),
(17, 9, 'Reguler', 'asd', 'asd', '08', 'asd@gmail.com', '2024-06-09 14:18:10', 9),
(18, 9, 'Reguler', 'asd', 'asd', '0987', 'a@gmail.com', '2024-06-09 14:20:56', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'asd', 'asd@gmail.com', '$2y$10$L5i3UGZkFYYXK2t/QOoik.a3vghnnKwJaoPaNlsWArfHpq7t2KgOO'),
(3, 'a', 'a@gmail.com', '$2y$10$8WMi6GUg1Wsvo9y0CqQMGObhiy.YUpDnw/MepZ6atUponPMKKsSUS'),
(4, 'b', 'beta@gmail.com', '$2y$10$g3Qj8GeOqZxgdG2KIPevEOPtqtP9raGnDiBodjcm1OZb8wwFv.F56'),
(5, 'c', 'coba1@gmail.com', '$2y$10$6Qw8GtaAVeU6vEULM3J/Mu/3gS928GeloZrr76RFDoq5gd1vcyAKa'),
(6, 'ca', 'coba2@gmail.com', '$2y$10$VMlePfonJzB1mUIlpVOGW.mkFt9L1.bNjZrOcTy52ZMOuyJ.jeVJe'),
(7, 'op', 'op@gmail.cim', '$2y$10$YdoStx/NFCAwqu.A9KmKguSgCLWMvUOnLWegp.O6U3yO0hTsrca.6'),
(8, 'ada', 'ada@gmail.com', '$2y$10$aGn9K0v2nrg7QvwNyQu8Be28e0dCFBW8N5.L8f5DLnpcT/DI5oH5a'),
(9, 'coba5', 'coba5@gmail.com', '$2y$10$AxD/OCDRzc1Rq8w8s.FiYekCyc/pAIwzKy07.qCYUWSPnOtvNVKqa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `konser`
--
ALTER TABLE `konser`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konser_id` (`konser_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `konser`
--
ALTER TABLE `konser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`konser_id`) REFERENCES `konser` (`id`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
