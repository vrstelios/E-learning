-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 14 Ιαν 2022 στις 14:58:07
-- Έκδοση διακομιστή: 10.4.22-MariaDB
-- Έκδοση PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `ergasiaepdmerosb`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `account`
--

CREATE TABLE `account` (
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `login_name` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `roles` set('student','tutor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `account`
--

INSERT INTO `account` (`first_name`, `last_name`, `login_name`, `password`, `roles`) VALUES
('stelios', 'xri', 'pp', '2310', 'tutor'),
('stylverr', 'verros', 'aa', '123', 'student'),
('ste', 'verrrrrrr', 'vr', '13', 'tutor'),
('maria', 'omikron', 'tt', '153', 'student');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `communications`
--

CREATE TABLE `communications` (
  `id` int(100) NOT NULL,
  `dates` date NOT NULL,
  `subject` mediumtext NOT NULL,
  `main_text` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `communications`
--

INSERT INTO `communications` (`id`, `dates`, `subject`, `main_text`) VALUES
(1, '2020-10-10', 'Ανακοίνωση', ' Έναρξη μαθημάτων<br><br>            Τα μαθήματα αρχίζουν την Δευτέρα 17/10/2020<br>        '),
(2, '2020-10-20', 'Ανακοίνωση', ' ανακοίνωση πρώτης εργασίας!!<br><br>            Η 1η εργασία έχει ανακοινωθεί στην ιστοσελίδα Εργασίες με ημερομηνία παράδοσης στις 17/11/2020                '),
(3, '2020-11-21', 'Ανακοίνωση', ' ανακοίνωση μπόνους εργασίας<br><br>\r\n            Η εργασία έχει ανακοινωθεί στην ιστοσελίδα(μια μονάδα μπόνους)με ημερομηνία παράδοσης στις 1/12/2020\r\n        \r\n        '),
(40, '2022-08-01', 'πτυχίο', 'θα πάρω πτυχίο');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `home_work`
--

CREATE TABLE `home_work` (
  `id` int(100) NOT NULL,
  `objectives` mediumtext NOT NULL,
  `name_file` mediumtext NOT NULL,
  `deliverable` longtext NOT NULL,
  `date_deliveries` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `home_work`
--

INSERT INTO `home_work` (`id`, `objectives`, `name_file`, `deliverable`, `date_deliveries`) VALUES
(1, '<li>Να φτιάξετε το πρώτο πρόγραμμα σας σε C</li>\r\n            <li>Να δείτε πως χρησιμοποιούνται οι Τελεστές – Μεταβλητές - Σταθερές</li>', 'Ασκήσεις0.pdf    ', '<li>Γραπτή αναφορά σε word το αρχείο .c που φταίξατε τα προγράμματα σας</li>\r\n            <li>το αρχείο .c που φταίξατε τα προγράμματα σας (σχολιασμένο)</li>', '2020-11-17'),
(2, '<li>να κατανοήσετε πως χρησιμοποιούνται οι εντολές συνθήκης</li>', 'Ασκήσεις1.pdf\r\n            ', '<li>Γραπτή αναφορά σε word</li>\r\n            <li>το αρχείο .c που φταίξατε τα προγράμματα σας(σχολιασμένο)</li>', '2020-12-01'),
(18, 'stelios', 'Ασκήσεις1.pdf', 'se papiro', '2022-01-15'),
(19, 'ωεροσδ', 'Ασκήσεις0.pdf', 'σσσ', '2021-12-31');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `writing`
--

CREATE TABLE `writing` (
  `id` int(11) NOT NULL,
  `title` varchar(10000) NOT NULL,
  `description` mediumtext NOT NULL,
  `name_file` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `writing`
--

INSERT INTO `writing` (`id`, `title`, `description`, `name_file`) VALUES
(10, 'Η γλώσσα C', ' Σε αυτό το αρχείο περιέχονται όλα τα βασικά πράγματα που             χρειάζεται  να γνωρίζει κάποιος ώστε να κάνει το πρώτο πρόγραμμα του σε γλώσσα c άλλα             και κάποια μικρά μυστικά που θα σας κάνουν καλυτέρους προγραμματιστές             <br><br>', 0xce9720ceb3cebbcf8ecf83cf83ceb120432e706466),
(11, 'Αναζήτηση & Ταξινόμηση', ' Σε αυτό το pdf θα μάθεις πως να κάνεις αναζήτηση και             ταξινόμηση σε έναν πινάκα στην γλώσσα c             <br><br>', 0xce91cebdceb1ceb6ceaecf84ceb7cf83ceb7202620cea4ceb1cebeceb9cebdcf8ccebcceb7cf83ceb72e706466),
(14, 'add', 'secont add', 0xce91cebdceb1ceb6ceaecf84ceb7cf83ceb7202620cea4ceb1cebeceb9cebdcf8ccebcceb7cf83ceb72e706466);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `communications`
--
ALTER TABLE `communications`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `home_work`
--
ALTER TABLE `home_work`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `writing`
--
ALTER TABLE `writing`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `communications`
--
ALTER TABLE `communications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT για πίνακα `home_work`
--
ALTER TABLE `home_work`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT για πίνακα `writing`
--
ALTER TABLE `writing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
