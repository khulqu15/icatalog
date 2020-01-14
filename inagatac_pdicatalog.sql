-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2020 pada 06.36
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inagatac_pdicatalog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `username`, `password`, `token`) VALUES
(1, 'inagata', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2810045c4c77da80aec03dd6a40088e1'),
(2, 'asroriasrori', '202cb962ac59075b964b07152d234b70', 'fd32e01611ebd47d750b6736d483ac5c'),
(3, 'demos', '9e8e2db3bc5ed9dbf33f7bcd0ce401a7', '02be97f2990c10b9a73b7a60eb6622e9'),
(4, 'tester', 'f5d1278e8109edd94e1e4197e04873b9', '9788763246f1ff52144e166427533ac2'),
(5, 'Ninno', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'sjahhajbcjahjcancuabcuau'),
(6, 'Khusnul', 'eeb89a76c9fc0afa47d076d6de005fa283962c9f131340325ab2fab8aaaaa801', 'ajahcaigcakjbcawecuawefhuiewfu182757'),
(7, 'Matiin', 'eeb89a76c9fc0afa47d076d6de005fa283962c9f131340325ab2fab8aaaaa801', 'NnyAwMz2rbTWHkSdO5coiRIhU'),
(8, 'ONinno', '$2y$10$8lWuPTak0pZ7rCjUoX4EDOvBKx9EEa1R9aEjoJobs2mhuUDQbEke6', 'bikeomD8w7t9hYu0pQHjFGXN2BqWJV'),
(9, 'ONinnoKhusnul', '$2y$10$YxGJCQyUR9o2HjLeSD1u9O4aNSLUqlYH8BpNOkk4P/6IfHdG.Z0UW', 'wpEi47hGycS5exdWjaRkf8NTDXBZ1r'),
(10, 'ONinnoKhusnul1', '$2y$10$MQZKNEBnXHZMrBpr9O4ye.mnHBh4z6dGBnQHCKHtwXQ8Iza6s9LCm', 'fuE6pah2jJk0qxUcwOdBSlPXobQzG1'),
(11, 'ONinnoKhusnul2', '$2y$10$cjzeEZSGVByypuYF8RA2guwoeA0N1RlAilswBm1N8SNMv19TFFOL.', 'fIZua6FgKC4DJjnwVqS82y5HQ9t0bi'),
(12, 'Halim', '$2y$10$oHjuM5N4RMCWBLoQBziF0.p05G78WJZeSREZdc54bj3HyPRe6CoIq', 'DTHAdSUsubPIygqf1ovi2p8JcMWLkm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_banner`
--

CREATE TABLE `tb_banner` (
  `id` varchar(100) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_banner`
--

INSERT INTO `tb_banner` (`id`, `id_akun`, `nama`, `gambar`, `id_produk`) VALUES
('', 2, 'Ukhtieku', '1578916508_af5340fc41a7a397677c.jpg', 2),
('20190221102326144', 1, '\'Cobak\'', 'Array', 2),
('20190226132419605', 1, 'tes 2', 'bannerpd_20190226132419605.jpeg', 19),
('20190313105456705', 1, 'Star', 'bannerpd_20190313105456705.jpg', 25),
('20190314154441014', 1, 'ui layer', 'bannerpd_20190314154441014.png', 10),
('20190423160119746', 3, 'Ayam Geprek', 'bannerpd_20190423160119746.jpg', 53),
('20190423160210031', 3, 'Martabak', 'bannerpd_20190423160210031.jpg', 68),
('20190423160239599', 3, 'Jamu', 'bannerpd_20190423160239599.jpg', 70),
('20190423160314704', 3, 'Bandeng Presto', 'bannerpd_20190423160314704.jpg', 54);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `kategori`, `id_akun`) VALUES
(1, 'uncategorized', 1),
(2, 'Website', 1),
(3, 'Android', 1),
(5, 'Game', 1),
(11, 'Mobile', 4),
(12, 'Website', 4),
(13, 'Lalapan', 3),
(14, 'Minuman', 3),
(15, 'Cemilan', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_kate` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `gambar1` varchar(100) DEFAULT NULL,
  `gambar2` varchar(100) DEFAULT NULL,
  `gambar3` varchar(100) DEFAULT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id`, `nama`, `deskripsi`, `id_kate`, `link`, `gambar1`, `gambar2`, `gambar3`, `id_akun`) VALUES
(2, 'Explorer', '', 2, 'http://facebook.com', 'produk.jpg', 'file_Explorer_2.png', '', 1),
(3, 'Agung Trans Web', '', 3, 'http://', 'produk.jpg', '', '', 1),
(4, 'BevlourWeb', '', 3, 'http://', 'produk.jpg', '', '', 1),
(5, 'Butik', '', 3, 'http://', 'produk.jpg', '', '', 1),
(6, 'Depo Loundry Web', '', 3, 'http://', 'produk.jpg', '', '', 1),
(7, 'Easy Teacher', '', 3, 'http://', 'produk.jpg', '', '', 1),
(8, 'Edupongo', '', 3, 'http://', 'produk.jpg', '', '', 1),
(10, 'Inagiude', '', 3, 'http://', 'produk.jpg', '', '', 1),
(11, 'iOS Downloader', '', 3, 'http://', 'produk.jpg', '', '', 1),
(12, 'Kebun Bibit App', '', 3, 'http://', 'produk.jpg', '', '', 1),
(13, 'Nobook', '', 3, 'http://', 'produk.jpg', '', '', 1),
(14, 'Omah Nyewo', '', 3, 'http://', 'produk.jpg', '', '', 1),
(15, 'Pajang Barang Network', '', 3, 'http://', 'produk.jpg', '', '', 1),
(16, 'Paradise Group Web', '', 3, 'http://', 'produk.jpg', '', '', 1),
(17, 'Parenting Control', '', 3, 'http://', 'produk.jpg', '', '', 1),
(18, 'PSB SMK Telkom Malang Web', '', 3, 'http://', 'produk.jpg', '', '', 1),
(19, 'Si Monev', '', 3, 'http://', 'produk.jpg', '', '', 1),
(20, 'Taqorrubat', '', 3, 'http://', 'produk.jpg', '', '', 1),
(21, 'True Face', '', 3, 'http://', 'produk.jpg', '', '', 1),
(22, 'Wiratama Web', '', 3, 'http://', 'produk.jpg', '', '', 1),
(24, 'gundam', '', 2, 'http://', 'produk.jpg', '', '', 1),
(25, 'Bug ', 'Mengatasi bug', 2, 'http://', 'produk.jpg', '', '', 1),
(26, 'Test', 'tanda', 2, 'http://', 'produk.jpg', 'product_inagata_Test_2.png', 'product_inagata_Test_3.png', 1),
(38, 'QA', '', 1, 'http://', 'produk.jpg', '', '', 4),
(39, 'Bug', 'mengenai error ', 11, 'http://', 'produk.jpg', '', '', 4),
(40, 'Art', 'Art', 11, 'http://', 'produk.jpg', 'product_tester_Art_2.png', 'product_tester_Art_3.jpg', 4),
(41, 'Sekolahku', '', 12, 'http://', 'produk.jpg', '', '', 4),
(50, 'Ayam Bakar', '', 13, 'http://', 'produk.jpg', '', '', 3),
(51, 'Ayam Goreng', '', 13, 'http://', 'produk.jpg', '', '', 3),
(52, 'Ayam Krispi', '', 13, 'http://', 'produk.jpg', '', '', 3),
(53, 'Ayam Geprek', 'Ayam Geprek Mbok enak lezat dengan 3 pilihan sambel (hijau, merah, dan tomat). Rasa nyuss bikin ketagihan, 1 porsi bisa kamu dapatkan hanya dengan seharga Rp6000,- (tanpa nasi). Yuk nikmati bareng sambil ngobrol asyik dengan temen kamu. ', 13, 'http://', 'produk.jpg', 'product_demos_Ayam_Geprek_2.jpg', 'product_demos_Ayam_Geprek_3.jpg', 3),
(54, 'Bandeng Presto', '', 13, 'http://', 'produk.jpg', '', '', 3),
(55, 'Ikan Lele', '', 13, 'http://', 'produk.jpg', '', '', 3),
(56, 'Ikan Mujaer', '', 13, 'http://', 'produk.jpg', '', '', 3),
(57, 'Jamur Krispi', '', 13, 'http://', 'produk.jpg', '', '', 3),
(58, 'Angsle', '', 15, 'http://', 'produk.jpg', '', '', 3),
(59, 'Batagor', '', 15, 'http://', 'produk.jpg', '', '', 3),
(60, 'Burger', '', 15, 'http://', 'produk.jpg', '', '', 3),
(61, 'Gorengan', '', 15, 'http://', 'produk.jpg', '', '', 3),
(62, 'Semur Jengkol', '', 15, 'http://', 'produk.jpg', '', '', 3),
(63, 'Kebab', '', 15, 'http://', 'produk.jpg', '', '', 3),
(64, 'Kentang Goreng', '', 15, 'http://', 'produk.jpg', '', '', 3),
(65, 'Seblak', '', 15, 'http://', 'produk.jpg', '', '', 3),
(66, 'Siomay', '', 15, 'http://', 'produk.jpg', '', '', 3),
(67, 'Terang Bulan', '', 15, 'http://', 'produk.jpg', '', '', 3),
(68, 'Martabak', '', 15, 'http://', 'produk.jpg', '', '', 3),
(69, 'Pisang Keju', '', 15, 'http://', 'produk.jpg', '', '', 3),
(70, 'Jamu', '', 14, 'http://', 'produk.jpg', '', '', 3),
(71, 'Jus Buah', '', 14, 'http://', 'produk.jpg', '', '', 3),
(72, 'Kopi', '', 14, 'http://', 'produk.jpg', '', '', 3),
(73, 'Susu', '', 14, 'http://', 'produk.jpg', '', '', 3),
(74, 'Teh', '', 14, 'http://', 'produk.jpg', '', '', 3),
(75, 'Cokelat', '', 14, 'http://', 'produk.jpg', '', '', 3),
(76, 'Produk1Coba', 'Produk1Coba Deskripis', 1, 'google.com', 'produk.jpg', 'user.jpg', 'avatar.png', 1),
(77, 'Produk1Coba', 'Produk1Coba Deskripis', 1, 'google.com', 'produk.jpg', 'user.jpg', 'avatar.png', 1),
(81, 'Samsul A827', 'Hpne Samsule Apik Saiki Cak', 2, 'google.com', 'produk.jpg', '1578972447_74c9abeb8e295f6c3416.jpg', '1578972447_a74c529f87fe582c4923.jpg', 2),
(82, 'Samsul A827', 'Hpne Samsule Apik Saiki Cak', 2, 'google.com', 'produk.jpg', '1578972536_cff5ddb573adf724847e.jpg', '1578972536_bd1d1c6e4681517baa0e.jpg', 2),
(83, 'Samsul A827', 'Hpne Samsule Apik Saiki Cak', 2, 'google.com', '1578973225_b4f3384e933ee92f542f.jpg', '1578973225_c2171e6ba31829796131.jpg', NULL, 2),
(84, 'Samsul A827', 'Hpne Samsule Apik Saiki Cak', 2, 'google.com', '1578973421_e7d67c44a1675cd3bd94.jpg', NULL, NULL, 2),
(85, 'Samsul A827', 'Hpne Samsule Apik Saiki Cak', 2, 'google.com', NULL, NULL, NULL, 2),
(86, 'Samsul A827', 'Hpne Samsule Apik Saiki Cak', 2, 'google.com', '1578974169_0c8f1f504b9d56c5ca21.png', '1578974169_00f016d805209a3716dc.jpg', '1578974169_66b504bce6aaaf809ba9.jpg', 2),
(88, 'Samsul A827', 'Hpne Samsule Apik Saiki Cak', 2, 'google.com', '1578974612_cd54729b9fa2a4619a7d.jpg', '1578974612_715b9d1e6c373b5cc980.png', '1578974612_142764da70f5de9da0fd.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `visi` varchar(100) NOT NULL,
  `misi` varchar(100) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  `banner` varchar(100) DEFAULT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_profil`
--

INSERT INTO `tb_profil` (`id`, `nama_perusahaan`, `deskripsi`, `visi`, `misi`, `logo`, `alamat`, `telp`, `email`, `instagram`, `facebook`, `youtube`, `banner`, `id_akun`) VALUES
(1, 'inagata technosmith', 'ini deskripsi perusahaan', '', '', 'file_Inagata_Technosmith.png', 'Griyashanta L.110 lowokwaru', '0867812979', 'inagata@contact.com', 'https://instagram.com/inagatatechno?utm_source=ig_profile_share&igshid=1dbppx2kkxwx6', 'https://www.facebook.com/inagatatechno/', 'https://www.youtube.com/channel/UCx17brpNulHSMoJBkRlC3Kg', 'banner_Inagata_Technosmith.jpg', 1),
(2, 'Samsul', 'Hpne Samsule Apik Saiki Cak', 'Mensejahterakan masyarakat Indonesia', 'mengejar big smoke', 'Samsul-1578979422.jpg', 'bikini bottom', '088217262025', 'samsul12@gmail.com', '1cak', 'nanime', 'oplovers', 'Samsul-1578979422-banner-.jpg', 1),
(3, 'demos', 'Warung makan enak sedia pemesan online', 'Makanan Penyemangat Jiwa', 'Membuat semua orang menikmati makanan dengan senyuman', 'logo_demos.png', 'Jl. Negara Km. 82', '082114833338', 'demos@gmail.com', '', '', '', 'bannerpf_demos.jpg', 3),
(4, 'Berlian Gita Cahyani', '', '', '', '', '', '082264487868', 'berliangita.cahyani45@gma', '', '', '', '', 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kate` (`id_kate`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indeks untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD CONSTRAINT `tb_banner_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id`),
  ADD CONSTRAINT `tb_banner_ibfk_2` FOREIGN KEY (`id_akun`) REFERENCES `tb_akun` (`id_akun`);

--
-- Ketidakleluasaan untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_kate`) REFERENCES `tb_kategori` (`id`),
  ADD CONSTRAINT `tb_produk_ibfk_2` FOREIGN KEY (`id_akun`) REFERENCES `tb_akun` (`id_akun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
