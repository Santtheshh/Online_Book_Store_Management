-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2023 at 07:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `pass`) VALUES
('admin', 'f865b53623b121fd34ee5426c792e5c33af8c227');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_isbn` varchar(20) NOT NULL,
  `book_title` varchar(60) DEFAULT NULL,
  `book_author` varchar(60) DEFAULT NULL,
  `book_image` varchar(40) DEFAULT NULL,
  `book_descr` text DEFAULT NULL,
  `book_price` decimal(6,2) NOT NULL,
  `publisherid` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_isbn`, `book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `publisherid`, `created_at`) VALUES
('1234523 -255577', 'dcdc', 'efvwfv fv', '2.jpg', '0edp', 100.00, 4, '2023-06-09 10:31:03'),
('12345231', 'comic', 'jung jung', '1.jpg', 'this is a comic book', 30.00, 4, '2023-06-08 15:48:04'),
('978-0-321-94786-1414', 'Learning Mobile App Development', 'Jakob Iversen, Michael Eierman', 'mobile_app.jpg', 'Now, one book can help you master mobile app development with both market-leading platforms: Apple\'s iOS and Google\'s Android. Perfect for both students and professionals, Learning Mobile App Development is the only tutorial with complete parallel coverage of both iOS and Android. With this guide, you can master either platform, or both - and gain a deeper understanding of the issues associated with developing mobile apps.\r\n\r\nYou\'ll develop an actual working app on both iOS and Android, mastering the entire mobile app development lifecycle, from planning through licensing and distribution.\r\n\r\nEach tutorial in this book has been carefully designed to support readers with widely varying backgrounds and has been extensively tested in live developer training courses. If you\'re new to iOS, you\'ll also find an easy, practical introduction to Objective-C, Apple\'s native language.', 20.00, 6, '2022-06-21 16:44:25'),
('978-1-118-94924-5', 'Programmable Logic Controllers', 'Dag H. Hanssen', 'logic_program.jpg', 'Widely used across industrial and manufacturing automation, Programmable Logic Controllers (PLCs) perform a broad range of electromechanical tasks with multiple input and output arrangements, designed specifically to cope in severe environmental conditions such as automotive and chemical plants.Programmable Logic Controllers: A Practical Approach using CoDeSys is a hands-on guide to rapidly gain proficiency in the development and operation of PLCs based on the IEC 61131-3 standard. Using the freely-available* software tool CoDeSys, which is widely used in industrial design automation projects, the author takes a highly practical approach to PLC design using real-world examples. The design tool, CoDeSys, also features a built in simulator / soft PLC enabling the reader to undertake exercises and test the examples.', 20.00, 2, '2022-06-21 16:44:25'),
('978-1-1180-2669-4', 'Professional JavaScript.', 'Nicholas C. Zakas', 'pro_js.jpg', 'If you want to achieve JavaScript\'s full potential, it is critical to understand its nature, history, and limitations. To that end, this updated version of the bestseller by veteran author and JavaScript guru Nicholas C. Zakas covers JavaScript from its very beginning to the present-day incarnations including the DOM, Ajax, and HTML5. Zakas shows you how to extend this powerful language to meet specific needs and create dynamic user interfaces for the web that blur the line between desktop and internet. By the end of the book, you\'ll have a strong understanding of the significant advances in web development as they relate to JavaScript so that you can apply them to your next website.', 20.00, 6, '2022-06-21 16:44:25'),
('978-1-44937-019-0', 'Learning Web App Development', 'Semmy Purewal', 'web_app_dev.jpg', 'Grasp the fundamentals of web application development by building a simple database-backed app from scratch, using HTML, JavaScript, and other open source tools. Through hands-on tutorials, this practical guide shows inexperienced web app developers how to create a user interface, write a server, build client-server communication, and use a cloud-based service to deploy the application.\r\n\r\nEach chapter includes practice problems, full examples, and mental models of the development workflow. Ideal for a college-level course, this book helps you get started with web app development by providing you with a solid grounding in the process.', 20.00, 3, '2022-06-21 16:44:25'),
('978-1-4571-0402-2', 'Professional ASP.NET 4 in C# and VB', 'Scott sou', 'pro_asp4.jpg', 'ASP.NET is about making you as productive as possible when building fast and secure web applications. Each release of ASP.NET gets better and removes a lot of the tedious code that you previously needed to put in place, making common ASP.NET tasks easier. With this book, an unparalleled team of authors walks you through the full breadth of ASP.NET and the new and exciting capabilities of ASP.NET 4. The authors also show you how to maximize the abundance of features that ASP.NET offers to make your development process smoother and more efficient.', 30.00, 6, '2022-06-21 16:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerid` int(10) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `country` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerid`, `email`, `address`, `city`, `zip_code`, `country`) VALUES
(31, 'sankethpoojary77@gmail.com', 'gangolli', 'kundapura', '77888', 'India'),
(32, 'vandeepapoojary@gmail.com', 'gangolli', 'kundapura', '576216', 'india'),
(33, 'sanchithaspoojary77@gmail.com', 'gangolli', 'kundapura', '77888', 'India'),
(34, 'san@mail.com', 'gangolli', 'kundapura', '77888', 'India'),
(35, 'sapo@gmail.com', 'jhj', 'nlkcnl', '87014', 'India'),
(36, 'spoo@gmail.com', 'jhj', 'nlkcnl', '87014', 'India'),
(37, '', '', '', '', ''),
(38, 'sapoo@gmail.com', 'jhj', 'nlkcnl', '87014', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `email` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `customerid` int(10) UNSIGNED NOT NULL,
  `amount` decimal(6,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `e-mail` char(60) NOT NULL,
  `ship_address` char(80) NOT NULL,
  `ship_city` char(30) NOT NULL,
  `ship_zip_code` char(10) NOT NULL,
  `ship_country` char(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `customerid`, `amount`, `date`, `e-mail`, `ship_address`, `ship_city`, `ship_zip_code`, `ship_country`, `status`) VALUES
(42, 31, 60.00, '2023-07-03 09:04:12', 'sankethpoojary77@gmail.com', 'gangolli', 'kundapura', '77888', 'India', 'pending'),
(43, 32, 90.00, '2023-07-03 09:15:13', 'vandeepapoojary@gmail.com', 'gangolli', 'kundapura', '576216', 'india', 'pending'),
(44, 31, 20.00, '2023-07-03 09:18:38', 'sankethpoojary77@gmail.com', 'gangolli', 'kundapura', '77888', 'India', 'pending'),
(45, 33, 20.00, '2023-07-03 09:33:53', 'sanchithaspoojary77@gmail.com', 'gangolli', 'kundapura', '77888', 'India', 'pending'),
(46, 31, 70.00, '2023-07-05 05:29:59', 'sankethpoojary77@gmail.com', 'gangolli', 'kundapura', '77888', 'India', 'pending'),
(47, 35, 40.00, '2023-07-05 08:08:02', 'sapo@gmail.com', 'jhj', 'nlkcnl', '87014', 'India', 'pending'),
(48, 36, 20.00, '2023-07-05 08:12:51', 'spoo@gmail.com', 'jhj', 'nlkcnl', '87014', 'India', ''),
(50, 38, 20.00, '2023-07-05 08:19:22', 'sapoo@gmail.com', 'jhj', 'nlkcnl', '87014', 'India', ''),
(51, 31, 30.00, '2023-07-05 08:20:15', 'sankethpoojary77@gmail.com', 'gangolli', 'kundapura', '77888', 'India', 'pending'),
(52, 38, 20.00, '2023-07-06 01:07:42', 'sapoo@gmail.com', 'jhj', 'nlkcnl', '87014', 'India', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `book_isbn` varchar(20) NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`orderid`, `book_isbn`, `item_price`, `quantity`) VALUES
(42, '12345231', 30.00, 2),
(43, '12345231', 30.00, 3),
(42, '978-0-321-94786-1414', 20.00, 1),
(45, '978-0-321-94786-1414', 20.00, 1),
(42, '12345231', 30.00, 1),
(42, '978-0-321-94786-1414', 20.00, 2),
(47, '978-0-321-94786-1414', 20.00, 2),
(48, '978-0-321-94786-1414', 20.00, 1),
(49, '12345231', 30.00, 1),
(49, '978-0-321-94786-1414', 20.00, 1),
(42, '12345231', 30.00, 1),
(49, '978-0-321-94786-1414', 20.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisherid` int(10) UNSIGNED NOT NULL,
  `publisher_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisherid`, `publisher_name`) VALUES
(1, 'Publisher 1'),
(2, 'Publisher 2'),
(3, 'Publisher 3'),
(4, 'Publisher 4'),
(5, 'Publisher 5'),
(6, 'Publisher 6');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `card_type` varchar(10) NOT NULL,
  `card_number` int(10) NOT NULL,
  `card_PID` int(10) NOT NULL,
  `card_expire` date NOT NULL,
  `customerid` int(10) NOT NULL,
  `card_owner` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`card_type`, `card_number`, `card_PID`, `card_expire`, `customerid`, `card_owner`) VALUES
('MasterCard', 123, 1234, '0000-00-00', 16, 'sapoo@gmail.com'),
('VISA', 123, 1234, '0000-00-00', 22, 'sankethpoojary77@gma'),
('VISA', 123, 1234, '0000-00-00', 16, 'sapoo@gmail.com'),
('VISA', 123, 1234, '2023-06-24', 16, 'sapoo@gmail.com'),
('VISA', 123, 123, '2023-07-18', 13, 'ashishpadukone367@gm'),
('VISA', 123, 123, '2023-07-18', 23, 'ashishpadukone367@gm'),
('VISA', 123, 123, '2023-07-22', 1, 'sukeshrg7@gmail.com'),
('VISA', 123, 123, '2023-07-06', 0, 'Santhesh@gmail.com'),
('VISA', 123, 123, '0000-00-00', 26, 'Santhesh@gmail.com'),
('VISA', 123, 123, '2023-07-11', 25, 'sukeshrg7@gmail.com'),
('VISA', 78978, 1234, '2023-06-29', 0, 'santhesh@gamil.com'),
('VISA', 123, 1234, '2023-07-25', 30, 'sankethpoojary77@gma'),
('VISA', 78978, 1234, '0000-00-00', 32, 'vandeepapoojary@gmai'),
('VISA', 78978, 1234, '2023-07-05', 33, 'sankethpoojary77@gma'),
('VISA', 78978, 1234, '2023-07-12', 33, 'sanchithaspoojary77@'),
('VISA', 78978, 1234, '2023-07-20', 34, 'sankethpoojary77@gma'),
('VISA', 78978, 1234, '0000-00-00', 34, 'sankethpoojary77@gma'),
('VISA', 78978, 1234, '0000-00-00', 34, 'sankethpoojary77@gma'),
('VISA', 78978, 1234, '2023-07-12', 34, 'san@mail.com'),
('VISA', 78978, 1234, '2023-07-12', 34, 'san@mail.com'),
('VISA', 78978, 1234, '2023-07-12', 34, 'san@mail.com'),
('VISA', 78978, 1234, '0000-00-00', 35, 'san@mail.com'),
('VISA', 78978, 0, '2023-07-22', 35, 'san@mail.com'),
('VISA', 78978, 0, '2023-07-22', 35, 'san@mail.com'),
('VISA', 78978, 0, '2023-07-22', 35, 'san@mail.com'),
('VISA', 78978, 0, '2023-07-22', 35, 'san@mail.com'),
('VISA', 78978, 1234, '2023-07-28', 35, 'sapo@gmail.com'),
('VISA', 78978, 1234, '2023-07-24', 36, 'spoo@gmail.com'),
('VISA', 78978, 1234, '2023-07-24', 36, 'spoo@gmail.com'),
('VISA', 78978, 1234, '2023-07-24', 36, 'spoo@gmail.com'),
('VISA', 78978, 1234, '2023-07-13', 38, 'sapoo@gmail.com'),
('VISA', 78978, 1234, '0000-00-00', 39, 'sapoo@gmail.com'),
('VISA', 78978, 1234, '2023-07-26', 39, 'sankethpoojary77@gma'),
('VISA', 78978, 1234, '0000-00-00', 39, 'sapoo@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`name`,`pass`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_isbn`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisherid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisherid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
