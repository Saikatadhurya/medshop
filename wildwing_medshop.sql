-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2020 at 07:23 AM
-- Server version: 10.2.32-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wildwing_medshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `city`, `state`) VALUES
(1, 'Fuljhore', 'Durgapur', 'West Bengal'),
(2, 'City Center', 'Durgapur', 'West Bengal'),
(3, 'Mamra', 'Durgapur', 'West Bengal'),
(4, 'Sepco', 'Durgapur', 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `tokenno` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  `date` date NOT NULL,
  `transid` text NOT NULL,
  `doc` text NOT NULL,
  `name` text NOT NULL,
  `age` text NOT NULL,
  `gender` text NOT NULL,
  `relation` text NOT NULL,
  `phone` text NOT NULL,
  `problem` text NOT NULL,
  `paystatus` int(11) NOT NULL,
  `purpose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `tokenno`, `userid`, `doctorid`, `shopid`, `date`, `transid`, `doc`, `name`, `age`, `gender`, `relation`, `phone`, `problem`, `paystatus`, `purpose`) VALUES
(65, 1, 5, 1, 3, '2020-07-13', '', 'No doc', 'Rohan Kumar', '22', 'male', 'Self', '9876543210', 'Pain in chest from 7 days.', 1, 'Rohan Kumar is booking Dr. Sovan Chatterjee at Riya Medical Hall dated 2020-07-13 with token no. 1'),
(67, 2, 4, 1, 3, '2020-07-13', '', 'No doc', 'Sagar Adhurya', '22', 'male', 'child', '9093222034', 'Cough in chest', 1, 'Sagar Adhurya is booking Dr. Sovan Chatterjee at Riya Medical Hall dated 2020-07-13 with token no. 2');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `state` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `state`) VALUES
(1, 'Durgapur', 'West Bengal'),
(2, 'Asansol', 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `id` int(11) NOT NULL,
  `shopname` text NOT NULL,
  `mobile` text NOT NULL,
  `regno` text NOT NULL,
  `area` text NOT NULL,
  `city` text NOT NULL,
  `address` text NOT NULL,
  `openhours` text NOT NULL,
  `status` int(1) NOT NULL,
  `token` text NOT NULL,
  `verified` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`id`, `shopname`, `mobile`, `regno`, `area`, `city`, `address`, `openhours`, `status`, `token`, `verified`, `email`, `password`, `image`) VALUES
(2, 'Raj Medical Hall', '9905544989', '', 'Fuljhore', 'Durgapur', 'Fuljhore more, Durgapur', '24', 0, '', 0, 'nsk930@gmail.com', '202cb962ac59075b964b07152d234b70', 'shop2.jpg'),
(3, 'Riya Medical Hall', '09093222034', '', 'Mamra', 'Durgapur', 'M/6, Bidhan Park, sec-1, Fuljhore', '24', 0, '', 0, 'sakatadhuryabird@gmail.com', '202cb962ac59075b964b07152d234b70', 'shop3.jpg'),
(4, 'Swamiji Medical Store', '876543210', '', 'Sepco', 'Durgapur', 'Sepco, Durgapur', '24', 1, '', 0, 'swamiji@gmail.com', '202cb962ac59075b964b07152d234b70', '24-hour-open-medical-store.jpg'),
(5, 'General Medical Store', '9876543210', '', 'Mamra', 'Durgapur', 'Mamra Bazar, Durgapur', '24', 0, '', 0, 'general@gmail.com', '202cb962ac59075b964b07152d234b70', 'download (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `degree` text NOT NULL,
  `specialization` text NOT NULL,
  `regno` text NOT NULL,
  `mobile` text NOT NULL,
  `token` text NOT NULL,
  `verified` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `degree`, `specialization`, `regno`, `mobile`, `token`, `verified`, `email`, `password`, `image`, `status`) VALUES
(1, 'Dr. Sovan Chatterjee', 'MBBS, MD', 'Cardiologist', 'DCR56432', '9093222034', '', '', 'sakatadhuryabirds@gmail.com', '202cb962ac59075b964b07152d234b70', 'doctor1.jpg', 0),
(2, 'Dr. Karun Roy', 'BDS', 'Dentist', 'DCR98762', '09905544989', '', '', 'nsk930@gmail.com', '202cb962ac59075b964b07152d234b70', 'doctor2.jpg', 0),
(3, 'Dr. Anirban Patra', 'MBBS, MS', 'Cardiologist', 'DCR47561', '9876543210', '', '', 'anirban@gmail.com', '202cb962ac59075b964b07152d234b70', 'download.jpg', 0),
(4, 'Dr. Luna Adhurya', 'MBBS', 'General Physician', 'DCR567422', '8900312295', '996e055334e0f1fb6732dfec5e3f23ad71a40058dd24fa28f56db37596cadbbaab848abd2e037e8e0cab51ca1d42804c9096', '', 'lunaadhurya@gmail.com', '202cb962ac59075b964b07152d234b70', 'download (2).jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `masteradmin`
--

CREATE TABLE `masteradmin` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `city` text NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masteradmin`
--

INSERT INTO `masteradmin` (`id`, `email`, `name`, `city`, `password`) VALUES
(1, 'masteradmin', '', '', '202cb962ac59075b964b07152d234b70'),
(2, 'sakatadhuryabirds@gmail.com', 'Saikat Adhurya', 'Durgapur', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `verified` int(11) NOT NULL,
  `token` text NOT NULL,
  `mobile` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `verified`, `token`, `mobile`, `password`) VALUES
(1, 'SAIKAT ADHURYA', 'sakatadhuryabirds@gmail.com', 0, '83ca04e5cc37b86bd7bd2eff6467ba6877c4bd2b924acc6423424acb6f00e858fa6580748cfdb457b3d2ff1158037eea73b0', '9093222034', '202cb962ac59075b964b07152d234b70'),
(2, 'Sagar Adhurya', 'sagaradhurya@gmail.com', 0, '988b91e2a26e727a48c077cc73eeb1a43e463971e11135fa0737bb57eb5dbbd72b1283dacc138261a35903ed02938301445a', '9876543210', '202cb962ac59075b964b07152d234b70'),
(3, 'Phani Sankar Adhurya', 'birdsakatadhurya@gmail.com', 0, '81575242ea68865a97f43c6f1d692b8a52c1a017b3e26deae81e66bff74170ddbbfc650ea04e9ea6917f74e511b37fa70cb1', '9093222034', '202cb962ac59075b964b07152d234b70'),
(4, 'Luna Tewary Adhurya', 'lunaadhurya@gmail.com', 0, '9a01b2398d8c625dbfb231957b02b99de8b06bcbbc84c921554f02ae431353bb4ae7386a08bc513b06cf6fac5a707f3fb1f7', '8900312295', '202cb962ac59075b964b07152d234b70'),
(5, 'Rohan Kumar', 'rohan@gmail.com', 0, 'd5c3d38d3bd234d7695ef4ed802ad3b70d8af12260073e30a3d202c6818c4f978e39078870c9d03dba5ed8444b1062657f33', '8765432109', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(11) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  `slot` text NOT NULL,
  `charge` text NOT NULL,
  `mon` text NOT NULL,
  `tue` text NOT NULL,
  `wed` text NOT NULL,
  `thurs` text NOT NULL,
  `fri` text NOT NULL,
  `sat` text NOT NULL,
  `sun` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `doctorid`, `shopid`, `slot`, `charge`, `mon`, `tue`, `wed`, `thurs`, `fri`, `sat`, `sun`) VALUES
(2, 1, 2, '5', '100', '8pm to 9pm', '', '', '', '', '11am to 12am', ''),
(5, 2, 2, '5', '200', '6pm to 7pm', '', '', '', '', '8pm to 9pm', ''),
(6, 1, 3, '10', '150', '10am to 11am', '', '', '', '8pm to 9pm', '', ''),
(7, 3, 4, '10', '300', '', '8am to 10am', '', '8pm to 9pm', '', '10am to 11am', ''),
(8, 3, 2, '10', '300', '10am to 11am', '', '', '', '', '1pm to 2pm', ''),
(9, 3, 3, '10', '400', '', '', '8am to 9am', '', '7pm to 8pm', '', ''),
(10, 1, 5, '10', '100', '', '11am to 12pm', '6pm to 7pm', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masteradmin`
--
ALTER TABLE `masteradmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `masteradmin`
--
ALTER TABLE `masteradmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
