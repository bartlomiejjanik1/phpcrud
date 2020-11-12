-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2020 at 04:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `raporty`
--

CREATE TABLE `raporty` (
  `id_raport` int(11) NOT NULL,
  `nazwa_raport` text NOT NULL,
  `data` date NOT NULL,
  `liczbaEmisji` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `raporty`
--

INSERT INTO `raporty` (`id_raport`, `nazwa_raport`, `data`, `liczbaEmisji`, `id`) VALUES
(1, 'RMF FM', '2020-09-02', 23, 10),
(2, 'Radiofonia', '2010-03-11', 21, 5),
(3, 'Rekord FM', '2012-01-11', 88, 6),
(4, 'TVN', '1997-02-01', 87, 2),
(5, 'RMF FM', '1998-10-01', 35, 5),
(6, 'EskaTV', '2020-06-09', 49, 10),
(7, 'Radio Studencki', '2020-10-09', 90, 22),
(8, 'Radio Zet', '2020-10-15', 99, 4),
(9, 'Trójka Polskie Radio', '2020-10-29', 25, 5),
(10, 'Radio Zet', '2020-11-04', 21, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'adam', '$2y$10$7Eoz/riBNUEpoQAyakpTgeU/jrhc5HNSFyzXHu5uoif6hWG3/P.Gm'),
(2, 'bartek', '$2y$10$CMDpE4CapGQZxqFl6Ueg3e1SFovDOlqmr7rEcM4ozURLPiAad.iJK'),
(3, 'adam1', '$2y$10$Ds8xkin958/OkpD/QUTCReMWngl/7l6fSvqT9psCdYcowZ1FYwmj6'),
(4, 'Julia', '$2y$10$X2wyxBQ71uRYEt3fId7.e.WX4WjCYHS.99cCSjOkH6qXlb9WqHnJu'),
(5, 'Wojtek', '$2y$10$sIlIlIQ/XCxqW.e1XYPm2u7LSQB0sM/vFG18Xq3rMaCyMMFkrpSm.'),
(6, 'Ula', '$2y$10$XyGS4vp.9Yu0fhWexgpnAOLD/hjyMf5U3.9QwnKt2WeugCMT7Ukoe'),
(7, 'John', '$2y$10$sSFPQq6kugbDlPNxKnc8.O/7yzI36/KUVH8fTZiMwNlrRd6MTduVK');

-- --------------------------------------------------------

--
-- Table structure for table `utwory`
--

CREATE TABLE `utwory` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL,
  `tytul` varchar(50) DEFAULT NULL,
  `kodISRC` varchar(50) DEFAULT NULL,
  `kompozytor` varchar(50) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `autorOpracowania` varchar(50) DEFAULT NULL,
  `czasTrwania` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utwory`
--

INSERT INTO `utwory` (`id`, `nazwa`, `tytul`, `kodISRC`, `kompozytor`, `autor`, `autorOpracowania`, `czasTrwania`) VALUES
(1, 'Malomiastecz.mp3', 'Małomiasteckzowy', 'PL-DAW-18-95601', 'Dawid Podsiadło', 'Dawid Podsiadło', 'Dawid', 220),
(2, 'headshoulders.mp3', 'Head Shoulders', 'US-MIO-20-90701', 'Michael Ofenbach', 'Michael Ofenbach', 'Adam', 208),
(3, 'slawomir.mp3', 'Milosc w zakopanem', 'PL-SLA-17-33111', 'Sławomir Zapała', 'Sławomir Zapała', 'Adam', 316),
(4, 'spadochron.mp3', 'Spadochron', 'PL-MEL-13-55692', 'Mela Koteluk', 'Mela koteluk', 'Bartek', 240),
(5, 'yesterday.mp3', 'Yesterday', 'EN-THB-66-53229', 'The Beatles', 'The Beatles 2', 'Michal', 420),
(6, 'dancing.mp3', 'Dancing in the moonlight', 'US-TOP-32-3643', 'Matthew Connor', 'Toplander', 'Adam', 265),
(10, 'Trojkaty.mp3', 'Trójkąty i Kwadraty', 'PL-DAW-14-22155', 'Dawid Podsiadło', 'Dawid Podsiadło', 'Bartek', 198),
(22, 'blabla.mp3', 'Bla Bla', 'IT-GIG-01-2983', 'D\'Agostino', 'D\'Agostino', 'Kierownik', 180);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `raporty`
--
ALTER TABLE `raporty`
  ADD PRIMARY KEY (`id_raport`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utwory`
--
ALTER TABLE `utwory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `raporty`
--
ALTER TABLE `raporty`
  MODIFY `id_raport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `utwory`
--
ALTER TABLE `utwory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `raporty`
--
ALTER TABLE `raporty`
  ADD CONSTRAINT `raporty_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utwory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
