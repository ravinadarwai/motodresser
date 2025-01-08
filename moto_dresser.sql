-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 01:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moto_dresser`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_contact` varchar(255) NOT NULL,
  `admin_country` text NOT NULL,
  `admin_job` varchar(255) NOT NULL,
  `admin_about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_image`, `admin_contact`, `admin_country`, `admin_job`, `admin_about`) VALUES
(2, 'Administrator', 'admin@gmail.com', '123', 'user-profile-min.png', '7777775500', 'Morocco', 'Front-End Developer', ' Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical '),
(3, 'test', 'test@gmail.com', '123', 'teacher.jpg', '1772727222', 'india', 'admin', ' bas kam karge');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `category`, `title`, `description`, `image`, `date_created`, `date_updated`) VALUES
(4, '4', 'Drive Safely with MotoDresser: Essential Road Safety Tips', '<p dir=\"ltr\">When you&rsquo;re on the road, nothing is more important than your safety and the safety of those around you. Whether you&rsquo;re commuting to work or taking a long road trip, adhering to basic driving safety tips can make all the difference. At MotoDresser, we believe that being well-prepared and mindful on the road is key to preventing accidents. Here are some essential drive safety tips to ensure you reach your destination safely every time.</p>\r\n<h3 dir=\"ltr\">1. Wear Your Seatbelt</h3>\r\n<p dir=\"ltr\">This may seem obvious, but wearing your seatbelt is the single most effective way to protect yourself in a car. Whether you\'re driving or riding as a passenger, always buckle up. Seatbelts reduce the risk of death by about 45% in case of a crash, making them a simple yet crucial habit to adopt.</p>\r\n<h3 dir=\"ltr\">2. Obey Speed Limits</h3>\r\n<p dir=\"ltr\">Speed limits are designed to protect you and others on the road. Always follow posted speed limits and adjust your driving speed according to road conditions, weather, and traffic. Speeding not only puts you at risk but also increases the severity of accidents when they occur.</p>\r\n<h3 dir=\"ltr\">3. Avoid Distractions</h3>\r\n<p dir=\"ltr\">Distracted driving is one of the leading causes of accidents. Whether it\'s texting, adjusting your GPS, or eating while driving, these distractions can take your focus off the road. Keep your eyes on the road and hands on the wheel, and if something demands your attention, pull over safely before addressing it.</p>\r\n<h3 dir=\"ltr\">4. Maintain a Safe Following Distance</h3>\r\n<p dir=\"ltr\">Always keep a safe distance from the vehicle in front of you. A general rule of thumb is the \"three-second rule\" &ndash; leave at least three seconds of space between you and the car ahead. This gives you enough time to react if the driver in front of you brakes suddenly.</p>\r\n<h3 dir=\"ltr\">5. Check Blind Spots</h3>\r\n<p dir=\"ltr\">Before changing lanes or merging, always check your blind spots. Your mirrors don\'t show everything, and a quick glance over your shoulder can prevent a potential accident. Be particularly cautious in heavy traffic or when driving near large vehicles like trucks.</p>\r\n<h3 dir=\"ltr\">6. Avoid Driving Under the Influence</h3>\r\n<p dir=\"ltr\">Never drive under the influence of alcohol, drugs, or any substances that impair your judgment and reaction time. Even small amounts of alcohol can significantly reduce your ability to drive safely. If you plan to drink, arrange for a designated driver or use a ride-sharing service.</p>\r\n<h3 dir=\"ltr\">7. Be Prepared for Emergencies</h3>\r\n<p dir=\"ltr\">Always carry essential emergency items in your vehicle, such as a first aid kit, flashlight, jumper cables, and a spare tire. Familiarize yourself with changing a tire and basic car maintenance to avoid being stranded in the middle of nowhere. MotoDresser&rsquo;s line of safety accessories can help ensure you&rsquo;re always prepared.</p>\r\n<h3 dir=\"ltr\">8. Adjust for Weather Conditions</h3>\r\n<p dir=\"ltr\">Weather conditions such as rain, fog, snow, or ice can make driving more dangerous. Reduce your speed, increase your following distance, and use your headlights when visibility is low. In extreme weather, it&rsquo;s best to delay your trip until conditions improve.</p>\r\n<h3 dir=\"ltr\">9. Get Enough Rest Before Long Trips</h3>\r\n<p dir=\"ltr\">Drowsy driving is as dangerous as driving under the influence. If you\'re planning a long trip, make sure to get plenty of rest beforehand. Take breaks every two hours to stretch and recharge. If you feel too tired to continue driving, pull over and rest.</p>\r\n<h3 dir=\"ltr\">10. Regular Vehicle Maintenance</h3>\r\n<p dir=\"ltr\">Keeping your car in good condition is key to safe driving. Regularly check your brakes, tires, lights, and windshield wipers to ensure everything is functioning properly. Schedule regular tune-ups, and don&rsquo;t ignore warning lights on your dashboard.</p>\r\n<h3 dir=\"ltr\">Conclusion</h3>\r\n<p dir=\"ltr\">Driving is a responsibility that requires constant attention, awareness, and preparedness. By following these safety tips and staying vigilant on the road, you can greatly reduce the risk of accidents. MotoDresser is committed to promoting safe driving habits while offering products that enhance your driving experience and vehicle&rsquo;s safety. Safe travels!</p>\r\n<p>&nbsp;</p>', 'WhatsApp Image 2024-10-24 at 14.03.03_3692649b.jpg', '2024-10-24 08:36:39', '2024-10-24 08:36:39'),
(5, '5', 'Gear Up with MotoDresser: Your Ultimate Guide to Safe and Stylish Driving', '<p dir=\"ltr\">At MotoDresser, we believe that driving isn&rsquo;t just about getting from point A to point B&mdash;it&rsquo;s about the journey, the experience, and doing it in style. Whether you&rsquo;re an everyday commuter or a weekend road tripper, being well-prepared is essential to making every drive smooth, safe, and enjoyable. With our collection of premium driving accessories and gear, you can upgrade your driving experience while staying safe on the road. Here&rsquo;s how you can gear up with MotoDresser!</p>\r\n<h3 dir=\"ltr\">1. Stay Safe with Top-Notch Safety Gear</h3>\r\n<p dir=\"ltr\">Safety is the foundation of every good driving experience. With MotoDresser&rsquo;s wide range of safety products, you can hit the road with peace of mind. From durable seatbelt covers to high-quality emergency kits, we have everything you need to ensure that you\'re prepared for any situation.</p>\r\n<p dir=\"ltr\">Our safety gear includes:</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Emergency Roadside Kits: Packed with essentials like flares, first aid supplies, and jumper cables.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Reflective Vests and Triangles: Stay visible in low-light or emergency conditions.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Anti-Slip Steering Wheel Covers: Enhance grip for better control and comfort on long drives.</p>\r\n</li>\r\n</ul>\r\n<h3 dir=\"ltr\">2. Enhance Comfort with Premium Driving Accessories</h3>\r\n<p dir=\"ltr\">Long drives can be tiring, but with the right accessories, you can make your journey more comfortable. MotoDresser offers a selection of ergonomically designed products to improve your comfort behind the wheel.</p>\r\n<p dir=\"ltr\">Check out our:</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Memory Foam Seat Cushions: For better posture and support, especially on longer trips.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Customizable Headrest Pillows: Adjust to your perfect height and angle for optimal neck support.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Temperature-Controlled Seat Covers: For those hot summers or chilly winters, these covers keep you comfortable year-round.</p>\r\n</li>\r\n</ul>\r\n<h3 dir=\"ltr\">3. Style Meets Functionality</h3>\r\n<p dir=\"ltr\">At MotoDresser, we understand that looking good on the road is as important as feeling good. Our range of stylish, functional accessories allows you to customize your car to reflect your personal style.</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Luxury Steering Wheel Covers: Available in a range of colors and materials, these covers provide comfort with a touch of luxury.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Customized Floor Mats: Keep your car clean while adding a splash of personality with our wide selection of designs.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Sleek Dashboard Organizers: Stay organized without sacrificing style, with minimalist designs that blend seamlessly into any car interior.</p>\r\n</li>\r\n</ul>\r\n<h3 dir=\"ltr\">4. Stay Connected with Cutting-Edge Tech</h3>\r\n<p dir=\"ltr\">In today&rsquo;s world, staying connected while driving is more important than ever. Our collection of in-car technology keeps you plugged in without compromising safety.</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Bluetooth Hands-Free Devices: For seamless connectivity to your phone, keeping your hands on the wheel.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">GPS Mounts and Phone Holders: Securely hold your devices for easy navigation and quick access.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Fast-Charging USB Car Chargers: Keep all your devices powered up for long drives.</p>\r\n</li>\r\n</ul>\r\n<h3 dir=\"ltr\">5. Be Prepared for Every Weather Condition</h3>\r\n<p dir=\"ltr\">Weather can be unpredictable, but with the right gear from MotoDresser, you can face any storm. Prepare your vehicle with accessories designed to handle different weather conditions.</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Heavy-Duty Windshield Wipers: For maximum visibility during rain or snow.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">All-Weather Floor Mats: Protect your car&rsquo;s interior from mud, snow, and water.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Sunshades and Car Covers: Keep your car cool in the summer and protect it from harsh weather when parked outdoors.</p>\r\n</li>\r\n</ul>\r\n<h3 dir=\"ltr\">6. Stay Organized on the Go</h3>\r\n<p dir=\"ltr\">A cluttered car can make any journey feel chaotic. With MotoDresser&rsquo;s organizational accessories, you can keep your car neat and everything you need within easy reach.</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Backseat Organizers: Perfect for storing snacks, gadgets, and toys if you have kids.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Trunk Storage Solutions: Keep your tools, emergency gear, and other items organized in your trunk without losing space.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Cup Holders and Phone Caddies: Simple but effective accessories to make sure everything is in its place.</p>\r\n</li>\r\n</ul>\r\n<h3 dir=\"ltr\">Conclusion</h3>\r\n<p><strong id=\"docs-internal-guid-a4909f42-7fff-45c7-1499-d7f35b565bbf\">Gearing up with MotoDresser is about more than just outfitting your car&mdash;it&rsquo;s about elevating your driving experience. From safety gear to stylish accessories, we have everything you need to drive with confidence, comfort, and style. So whether you\'re prepping for a daily commute or an epic road trip, make sure you\'re equipped with the best. Gear up with MotoDresser and hit the road like never before!</strong></p>', 'WhatsApp Image 2024-10-24 at 14.03.03_e6b1cce6.jpg', '2024-10-24 08:37:23', '2024-10-24 08:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`id`, `category`, `description`, `date_created`) VALUES
(4, 'Drive Safely', 'Drive Safely', '2024-10-24 08:28:47'),
(5, 'Stylish Driving', 'Stylish Driving', '2024-10-24 08:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `customer_login_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `color` text NOT NULL,
  `size` text NOT NULL,
  `p_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `customer_login_id`, `qty`, `color`, `size`, `p_price`) VALUES
(54, 66, 3, 1, 'Black', 'XXL', 2999.00);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL,
  `p_cat_id` int(11) NOT NULL,
  `cat_title` text NOT NULL,
  `cat_top` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `p_cat_id`, `cat_title`, `cat_top`) VALUES
(1, 12, 'FULL FACE', 'yes'),
(2, 12, 'HALF FACE', 'yes'),
(3, 12, 'MODULAR', 'yes'),
(4, 12, 'HELMET LIGHTS', 'yes'),
(5, 12, 'ACCESSORIES', 'yes'),
(6, 13, 'JACKETS', 'yes'),
(7, 13, 'GLOVES', 'yes'),
(8, 13, 'PANTS', 'yes'),
(9, 13, 'RIDING BOOTS', 'yes'),
(10, 14, 'TANK BAGS', 'yes'),
(11, 14, 'TAIL BAGS', 'yes'),
(12, 14, 'CRASHBAR BAGS', 'yes'),
(13, 14, 'SADDLE BAGS', 'yes'),
(16, 15, 'RADIATOR GUARD', 'yes'),
(17, 15, 'BASH PLATE', 'yes'),
(18, 15, 'KNUCKLE GUARDS', 'yes'),
(19, 15, 'SADDLE STAY', 'yes'),
(20, 15, 'CRASH GUARD', 'yes'),
(21, 16, 'FOG LAMPS', 'yes'),
(22, 16, 'HARNESS', 'yes'),
(23, 16, 'SWITCHES', 'yes'),
(24, 16, 'FOG LIGHTS MOUNTS', 'yes'),
(25, 17, 'PHONE HOLDER', 'yes'),
(26, 17, 'GPS MOUNTS', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `comments_of_blog`
--

CREATE TABLE `comments_of_blog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `customer_login_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments_of_blog`
--

INSERT INTO `comments_of_blog` (`id`, `name`, `phone`, `message`, `blog_id`, `customer_login_id`, `date_created`) VALUES
(1, 'test', '6263966653', 'heleo', 2, 3, '2024-10-19 10:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `customer_login_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `customer_login_id`, `name`, `email`, `phone`, `message`, `date_created`) VALUES
(3, 0, 'test', 'vineet@gmail.csom', '6263966653', 'heelo', '2024-10-22 00:53:28'),
(4, 0, 'test', 'vineet@gmail.csom', '6263966653', 'heelo', '2024-10-22 00:53:47'),
(5, 40, 'bhabhi', 'test@gmail.com', '6263966653', 'hello', '2024-10-22 00:55:42'),
(6, 40, 'test', 'test@gmail.com', '6263966653', 'vhhuu', '2024-10-22 01:08:15'),
(7, 0, 'test55', 'admin@gmail.com', '6263966653', 'jkjik', '2024-10-22 01:11:43'),
(8, NULL, 'dota', 'dota@mggo.fd', '9999999999', 'jdokd', '2024-10-22 01:17:45'),
(9, NULL, 'gota', 'gota@gmail.com', '6263966653', 'gota hello', '2024-10-22 01:20:11'),
(10, 40, 'ckelu', 'admin@gmail.com', '9999999999', 'cksyle', '2024-10-22 01:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(10) NOT NULL,
  `coupon_title` varchar(255) NOT NULL,
  `coupon_price` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_limit` int(100) NOT NULL,
  `coupon_used` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `coupon_title`, `coupon_price`, `coupon_code`, `coupon_limit`, `coupon_used`) VALUES
(6, 'Sale', '65', 'CODEASTRO', 3, 2),
(7, 'Vineet 2312', '450', 'VINEET12 ', 50, 28),
(8, 'SALE', '20%', 'abc12', 200, 5);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_login_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_pass` varchar(255) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_pincode` int(11) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_confirm_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_login_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_pincode`, `customer_image`, `customer_ip`, `customer_confirm_code`) VALUES
(22, 2, 'test2', 'test@gmail.com2', '', 'India2', 'demo2', '62639666532', 'faridabad2', 45012022, 'profile_images/g1.jpg', '::1', ''),
(23, 3, 'vineet', 'admin@gmail.com', '123', 'ijso', 'kdod', '6263966653', 'papa', 882882, 'profile_images/about2.jpg', '::1', ''),
(24, 14, 'test', 'tesing@gmail.com', '123', 'india', 'indore hi hai', '2323232323', 'sarovi mein hu', 637773, 'profile_images/g7.jpg', '::1', ''),
(25, 15, 'ravina', 'ravina@gmail.com', '123', 'india', 'indore', '1281881622', 'faridabad', 450120, 'profile_images/g5.jpg', '::1', ''),
(26, 36, 'shivam', 'shivamprajapati15981@gmail.com', '$2y$10$LuxiOKXu0DgW6JAtG7umJ.HEr.h5omDVWChUvDsX4P8QQpPs/CckW', 'mp', 'indore', '6263966653', 'mujjafarabad', 452015, 'profile_images/g7.jpg', '::1', ''),
(27, 38, 'gorav', 'prajapatgulshan0@gmail.com', '$2y$10$RpbDxjPz9LMe6eaacZK8RO1Wj0F/VyTq6TJPP1irE8UAj2B9nK2/i', 'mp', 'ujjain', '7440304830', '240 jkaks', 456001, 'profile_images/g2.jpg', '::1', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `google_id` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `verifiedEmail` tinyint(1) DEFAULT 0,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_login`
--

INSERT INTO `customer_login` (`id`, `first_name`, `email`, `provider`, `provider_id`, `created_at`, `updated_at`, `google_id`, `full_name`, `verifiedEmail`, `phone`) VALUES
(6, '', 'darwairavina2002@gmail.com', '', '', '2024-11-28 11:13:29', '2024-11-28 11:13:29', NULL, '9098839256', 1, '9098839256'),
(8, '', '', '', '', '2024-11-28 11:21:42', '2024-11-28 11:21:42', NULL, '8827998679', 1, '8827998679');

-- --------------------------------------------------------

--
-- Table structure for table `landing_images`
--

CREATE TABLE `landing_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `show` enum('yes','no') DEFAULT 'no',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landing_images`
--

INSERT INTO `landing_images` (`id`, `image`, `title`, `show`, `date_created`) VALUES
(2, 'landing_1.png', 'Helmets', 'yes', '2024-10-22 05:35:19'),
(3, 'landing_2.webp', 'JACKETS', 'yes', '2024-10-22 05:36:01'),
(4, 'landing_3.webp', 'Pants', 'yes', '2024-10-22 05:36:39'),
(5, 'landing_4.webp', 'Communication', 'yes', '2024-10-22 05:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `manufacturer_id` int(10) NOT NULL,
  `manufacturer_title` text NOT NULL,
  `manufacturer_top` text NOT NULL,
  `manufacturer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer_title`, `manufacturer_top`, `manufacturer_image`) VALUES
(12, 'AXOR', 'yes', 'axor.jpeg'),
(13, 'SMK', 'yes', 'smk.png'),
(14, 'BISON', 'yes', 'bison.png'),
(15, 'GRAND PITSTOP', 'yes', 'Grandpitstop.png'),
(16, 'VEGA AUTO ACCESSORIES', 'yes', 'Vega.png'),
(17, 'POWER SHIFT', 'yes', 'Powershift.jpeg'),
(18, 'HJG', 'yes', 'HJG.jpeg'),
(19, 'STUDDS', 'yes', 'Studds.png'),
(20, 'STEELBIRD', 'yes', 'Steelbird.png'),
(21, 'MOTOTECH', 'yes', 'MOTO_tag.jpeg'),
(22, 'RAW STONE', 'yes', 'Rowsone.png'),
(23, 'RAHGEAR', 'yes', 'Rohgear.jpeg'),
(25, 'LGP', 'yes', 'LGP.png'),
(28, 'MOTUL', 'yes', 'Untitled-4-3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `my_orders`
--

CREATE TABLE `my_orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `payment_method` enum('cod','online') NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `order_status` enum('processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'processing',
  `order_date` datetime DEFAULT current_timestamp(),
  `products_ordered` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products_ordered`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `my_orders`
--

INSERT INTO `my_orders` (`order_id`, `customer_id`, `total_amount`, `invoice_no`, `qty`, `payment_method`, `payment_id`, `payment_status`, `order_status`, `order_date`, `products_ordered`) VALUES
(36, 3, 4004.00, 'INV-1730096822825', 2, 'cod', NULL, 'pending', 'processing', '2024-10-28 11:57:02', '[{\"productId\":\"51\",\"quantity\":1,\"color\":\"red\",\"size\":\"B\"},{\"productId\":\"52\",\"quantity\":1,\"color\":\"chota\",\"size\":\"mak\"}]'),
(37, 3, 4565.00, 'INV-1730102935722', 3, 'cod', NULL, 'pending', 'processing', '2024-10-28 13:38:55', '[{\"productId\":\"51\",\"quantity\":2,\"color\":\"red\",\"size\":\"B\"},{\"productId\":\"53\",\"quantity\":1,\"color\":\"green\",\"size\":\"aa\"}]'),
(38, 3, 3119.00, 'INV-1730804698037', 1, 'cod', NULL, 'pending', 'processing', '2024-11-05 16:34:58', '[{\"productId\":\"60\",\"quantity\":1,\"color\":\"green\",\"size\":\"B\"}]'),
(39, 3, 6019.20, 'INV-1730806422235', 1, 'cod', NULL, 'pending', 'processing', '2024-11-05 11:33:38', '[{\"productId\":\"62\",\"quantity\":1,\"color\":\"black\",\"size\":\"full Size\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `otp_verification`
--

CREATE TABLE `otp_verification` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(10) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `payment_mode` text NOT NULL,
  `ref_no` int(10) NOT NULL,
  `code` int(10) NOT NULL,
  `payment_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `invoice_no`, `amount`, `payment_mode`, `ref_no`, `code`, `payment_date`) VALUES
(2, 1607603019, 447, 'UBL/Omni', 5678, 33, '11/1/2016'),
(3, 314788500, 345, 'UBL/Omni', 443, 865, '11/1/2016'),
(4, 6906, 400, 'Western Union', 101025780, 696950, 'January 1'),
(5, 10023, 20, 'Bank Code', 1000010101, 6969, '09/14/2021'),
(6, 69088, 100, 'Bank Code', 1010101022, 88669, '09/14/2021'),
(7, 1835758347, 480, 'Western Union', 1785002101, 66990, '09-04-2021'),
(8, 1835758347, 480, 'Bank Code', 1012125550, 66500, '09-14-2021'),
(9, 1144520, 480, 'Bank Code', 1025000020, 66990, '09-14-2021'),
(10, 2145000000, 480, 'Bank Code', 2147483647, 66580, '09-14-2021'),
(20, 858195683, 100, 'Bank Code', 1400256000, 47850, '09-13-2021'),
(21, 2138906686, 120, 'Bank Code', 1455000020, 202020, '09-13-2021'),
(22, 2138906686, 120, 'Bank Code', 1450000020, 202020, '09-15-2021'),
(23, 361540113, 180, 'Western Union', 1470000020, 12001, '09-15-2021'),
(24, 361540113, 180, 'UBL/Omni', 1258886650, 200, '09-15-2021'),
(25, 901707655, 245, 'Western Union', 1200002588, 88850, '09-15-2021');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `p_cat_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `manufacturer_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_title` text NOT NULL,
  `product_desc` text NOT NULL,
  `product_short_desc` text NOT NULL,
  `product_features` text NOT NULL,
  `product_keywords` text NOT NULL,
  `product_label` text NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_psp_price` int(10) NOT NULL,
  `shipping_charges` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `p_cat_id`, `cat_id`, `manufacturer_id`, `date`, `product_title`, `product_desc`, `product_short_desc`, `product_features`, `product_keywords`, `product_label`, `product_price`, `product_psp_price`, `shipping_charges`) VALUES
(66, 13, 8, 21, '2024-11-08 05:53:13', 'Trailblazer TourPro Motorcycle Riding Pant v2.0 - Level 2', '<div>\r\n<div>\r\n<div>The NEW MotoTech Rain Overtrouser is a technical rain pant which offers comfort and protection from urban to the wild, on road to off road. The pant features fully seam-sealed waterproof performance to keep out the elements and a comfortable, easy-wearing elastic waistband.<br><br>This waterproof pant can be used anywhere in the outdoors while riding a motorbike or a cycle, on a hike or an expedition or even on any adventure or generic travel.<br><br></div>\r\n</div>\r\n<div>- Waterproof and lightweight fabric</div>\r\n</div>\r\n<p>- Elastic waist for comfort<br>- Reflective MOTOTECH branding on the pant<br>- Fully taped seams<br>- Regular Fit&nbsp;<strong><br></strong></p>\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Material:</strong></td>\r\n<td>PolyVinylChloride Coated Nylon (waterproof)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Elastic Waist:</strong></td>\r\n<td>Can go up by 1.5 inches of normal waist width of the pant</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Weight:</strong></td>\r\n<td>230g</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'A Best-Seller has been upgraded... MotoTech\'s version 2.0 of the Classic Trailblazer TourPro Riding Pant is now available.', '<div><strong>Newly Added Features:</strong></div>\r\n<div>- Knee Armour now comes in a versatile sleeve thus giving it a wide range to move vertically and horizontally.&nbsp;</div>\r\n<div>- Stretch Panel on the Crotch Area for added flexibility.</div>\r\n<div>- Wider Zipper Pocket giving ease of use.</div>\r\n<div>- Quilted detachable and Independently Wearable Warm Liner</div>\r\n<div>- Cool Grey Colour Rain Over-pants</div>\r\n<div><br>\r\n<div>\r\n<div>\r\n<div>\r\n<div><strong>Salient Features:</strong><br><br>-&nbsp;SAFETECH CE Level 2&nbsp;Knee and Hip Armour. All Armours are Removable.</div>\r\n<div>-&nbsp;Easy Access Knee Armour zipper pocket&nbsp;with adjustable velcro knee armour</div>\r\n<div>-&nbsp;1200D Polyester Oxford&nbsp;fabric used on lower buttocks and rear inner thighs to facilitate outstanding abrasion resistance and tear resistance for the safety of the rider.</div>\r\n<div>-&nbsp;4 External Pockets:&nbsp;2 zipper pockets + 2 cargo thigh pockets</div>\r\n<div>- Partly-Elastic waist + waist velcro straps and adjustable over-the-boot ankle velcro Fastener to assist in achieving accurate and comfortable fitting.</div>\r\n<div>-&nbsp;2 highly&nbsp;Reflective and Perforated Air Cooling Vents:&nbsp;on the Upper knee for adequate ventilation.</div>\r\n<div>- Reflective strips on upper knee for high visibility when the vents are closed.</div>\r\n<div>- Bright and Classy MotoTech branded buttons and Reflective Cord Zip Pullers</div>\r\n<div>- Stretch panels behind and above knee for easy full range movement.</div>\r\n<div>- Standard MotoTech Jacket-to-pant zipper panel.&nbsp;</div>\r\n<div>-&nbsp;Reflective MotoTech branding&nbsp;for high visibility in night / dark conditions.</div>\r\n<div>- Reflective \"TourPro\" series branding on side pocket flaps for high visibility in night / dark conditions.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 'best product', 'New', 2999, 1299, 120);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `p_cat_id` int(10) NOT NULL,
  `p_cat_title` text NOT NULL,
  `p_cat_top` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`p_cat_id`, `p_cat_title`, `p_cat_top`) VALUES
(12, 'HELMETS', 'yes'),
(13, 'RIDING GEARS', 'yes'),
(14, 'RIDING LUGGAGE', 'yes'),
(15, 'FRAMES & FITTINGS', 'yes'),
(16, 'FOG LAMPS', 'yes'),
(17, 'MOBILE MOUNTS', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color`) VALUES
(49, 66, 'Black'),
(50, 66, 'Blue');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `color`) VALUES
(55, 66, 'MT-0038---1200---2_da0f2376-8068-4a2d-aa0b-bb9ea005e081.webp', 'Black'),
(56, 66, 'MT-0038---1200---5_ed2d6094-ff24-4928-a118-fad9e26cedeb.webp', 'Blue'),
(57, 66, 'TrailblazerTourProRidingPantv2.0-Level2_6c509b28-f981-49ae-afca-f7b1575b4a19.webp', 'Black');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size`) VALUES
(47, 66, 'XL'),
(48, 66, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `product_suggestions`
--

CREATE TABLE `product_suggestions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `suggested_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `name`, `email`, `rating`, `comment`, `created_at`) VALUES
(12, 51, 'lele', 'last@gmail.com', 3, 'doogy', '2024-10-28 05:23:38'),
(13, 60, 'chunti tokiya', 'chu_ti____ya@gaml.com', 3, 'good product yarr such a nice one for me and my husband i am very thankful for motodresser bcz this is one of the best store for riding gears and all riding accesories.', '2024-11-04 11:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `customer_login_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `customer_login_id`, `email`, `date_created`) VALUES
(5, 0, 'vineet@gmail.com', '2024-10-22 00:54:04'),
(6, 0, 'vineet@gmail.commmkd', '2024-10-22 00:54:39'),
(7, 40, 'bhabhi@gmail.com', '2024-10-22 00:56:20'),
(8, NULL, 'test@gmail.com', '2024-10-22 01:30:06'),
(9, 40, 'ckay@ka.dd', '2024-10-22 01:31:34'),
(10, 3, 'chotabheem@gmail.com', '2024-10-23 07:52:16'),
(11, 3, 'xkskks@hs.f', '2024-10-23 08:27:28'),
(12, NULL, 'choala@gmail.com', '2024-11-04 11:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `term_id` int(10) NOT NULL,
  `term_title` varchar(100) NOT NULL,
  `term_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`term_id`, `term_title`, `term_desc`) VALUES
(13, 'motodresser Terms & Conditions', '<p><strong>Welcome to motodresser!</strong><br>By accessing our website, you agree to the following terms and conditions:</p>\r\n<ol>\r\n<li>\r\n<p><strong>General Information</strong><br>This site is operated by motodresser. &ldquo;We,&rdquo; &ldquo;us,&rdquo; and &ldquo;our&rdquo; refer to motodresser. Using our site or purchasing from us means you agree to our Terms.</p>\r\n</li>\r\n<li>\r\n<p><strong>Use of the Website</strong><br>You confirm that you are of majority age or have parental consent for use. You agree not to use our products for unlawful purposes.</p>\r\n</li>\r\n<li>\r\n<p><strong>Product Information</strong><br>We strive to display accurate colors but cannot guarantee monitor displays. Prices are subject to change.</p>\r\n</li>\r\n<li>\r\n<p><strong>Orders &amp; Payment</strong><br>We reserve the right to refuse or alter orders. Payment details must be accurate and current.</p>\r\n</li>\r\n<li>\r\n<p><strong>Shipping &amp; Delivery</strong><br>Estimated delivery times are not guaranteed. Customers are responsible for accurate shipping information.</p>\r\n</li>\r\n<li>\r\n<p><strong>Returns &amp; Refunds</strong><br>Please refer to our Return &amp; Refund Policy for return details.</p>\r\n</li>\r\n<li>\r\n<p><strong>Intellectual Property</strong><br>All website content is motodresser property and may not be used without permission.</p>\r\n</li>\r\n<li>\r\n<p><strong>Limitation of Liability</strong><br>motodresser is not liable for direct, indirect, or consequential damages. Liability is limited as allowed by law.</p>\r\n</li>\r\n<li>\r\n<p><strong>Governing Law</strong><br>These terms are governed by Indian law.</p>\r\n</li>\r\n<li>\r\n<p><strong>Changes to Terms</strong><br>We may update these terms without notice. Continued use signifies acceptance.</p>\r\n</li>\r\n<li>\r\n<p><strong>Contact Information</strong><br>Address: 10, Gulmarg Complex, Sapna Sangeeta Main Road. Inodore 452001. M.P.<br>Email: <a rel=\"noopener\">sales@motodresser.com</a><br>Phone: <a href=\"tel:919669196692\">+91 9669196692</a></p>\r\n</li>\r\n</ol>'),
(14, 'motodresser Policies', '<p><strong>Welcome to motodresser!</strong><br>Thank you for choosing motodresser. By accessing or using our website, you agree to comply with and be bound by the following policies.</p>\r\n<ol>\r\n<li>\r\n<p><strong>Return Period</strong><br>You have 7 days from the date of delivery to request a return or exchange. Items must be unused, in their original packaging, and include all tags.</p>\r\n</li>\r\n<li>\r\n<p><strong>Non-Returnable Items</strong><br>Returns are not accepted for:</p>\r\n<ul>\r\n<li>Perishable items (e.g., food, flowers)</li>\r\n<li>Personalized or custom-made products</li>\r\n<li>Gift cards and sale items</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Refund Process</strong><br>Once we receive and inspect your returned item, we will notify you of the approval status. Approved refunds will be issued to your original payment method within 5-7 business days.</p>\r\n</li>\r\n<li>\r\n<p><strong>Exchanges</strong><br>We offer free exchanges for defective or damaged items. Please contact us within 7 days of receiving your item for assistance.</p>\r\n</li>\r\n<li>\r\n<p><strong>Return Shipping Costs</strong><br>Return shipping is the customer\'s responsibility unless the return is due to our error. We can provide a prepaid return label, with the cost deducted from your refund.</p>\r\n</li>\r\n<li>\r\n<p><strong>How to Request a Return</strong><br>To initiate a return, please contact us at <a rel=\"noopener\">info@motodresser.com</a> or call <a href=\"tel:919669196692\">+91 9669196692</a> with your order number and reason for the return.</p>\r\n</li>\r\n</ol>\r\n<hr>\r\n<h2>Shipping Policy</h2>\r\n<ol>\r\n<li>\r\n<p><strong>Order Processing</strong><br>All orders are processed within 1-3 business days (excluding weekends and holidays). In case of high order volume, shipment delays may occur, and we will contact you if your order will be delayed significantly.</p>\r\n</li>\r\n<li>\r\n<p><strong>Shipping Rates &amp; Delivery Estimates</strong></p>\r\n<ul>\r\n<li><strong>Standard Shipping:</strong> 5-7 business days</li>\r\n<li><strong>Express Shipping:</strong> 2-3 business days (additional charges apply)<br>Delivery delays can occasionally occur due to unforeseen circumstances.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Order Tracking</strong><br>You will receive a Shipment Confirmation email with your tracking number(s) within 24-48 hours of your order being shipped.</p>\r\n</li>\r\n<li>\r\n<p><strong>Customs, Duties, and Taxes</strong><br>All customs, duties, and taxes are the customer&rsquo;s responsibility.</p>\r\n</li>\r\n<li>\r\n<p><strong>Damages</strong><br>motodresser is not liable for products damaged or lost during shipping. Please file a claim with the carrier and save all packaging for inspection if you received a damaged item.</p>\r\n</li>\r\n<li>\r\n<p><strong>Missing or Lost Packages</strong><br>If your package has not arrived within the estimated delivery timeframe, contact us at <a href=\"tel:919669196692\">+91 9669196692</a>, or&nbsp;<a rel=\"noopener\">info@motodresser.com</a> for assistance.</p>\r\n</li>\r\n<li>\r\n<p><strong>Contact Us</strong><br>For any shipping questions, please email <a rel=\"noopener\">info@motodresser.com</a>.</p>\r\n</li>\r\n</ol>\r\n<hr>\r\n<h2>Privacy Policy</h2>\r\n<p><strong>Your Privacy is Important to Us</strong><br>This Privacy Policy explains how motodresser collects, uses, and safeguards your information.</p>\r\n<ol>\r\n<li>\r\n<p><strong>Information We Collect</strong></p>\r\n<ul>\r\n<li><strong>Personal Information</strong>: Name, email, phone, shipping and billing address, payment details.</li>\r\n<li><strong>Order Information</strong>: Purchase history and details.</li>\r\n<li><strong>Usage Data</strong>: Website interactions, IP addresses, and browser information.</li>\r\n<li><strong>Cookies</strong>: Used to personalize and improve the website experience.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Use of Information</strong></p>\r\n<ul>\r\n<li><strong>To Process Orders</strong>: Use personal and payment info to fulfill orders.</li>\r\n<li><strong>To Communicate</strong>: Provide order updates and respond to inquiries.</li>\r\n<li><strong>To Improve Services</strong>: Analyze usage data to enhance the website experience.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Protection of Information</strong><br>We implement secure encryption methods (SSL) and restrict access to personal data to authorized personnel.</p>\r\n</li>\r\n<li>\r\n<p><strong>Sharing of Information</strong></p>\r\n<ul>\r\n<li><strong>Service Providers</strong>: Shared with third-party service providers as needed.</li>\r\n<li><strong>Legal Compliance</strong>: Disclosed if required by law.</li>\r\n<li><strong>Business Transfers</strong>: Information may transfer in the event of a merger or acquisition.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Your Rights</strong></p>\r\n<ul>\r\n<li><strong>Access and Update</strong>: Review and update information in your account.</li>\r\n<li><strong>Opt-Out</strong>: Unsubscribe from marketing communications.</li>\r\n<li><strong>Request Deletion</strong>: Contact us to request data deletion, subject to legal requirements.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Cookies</strong><br>You can manage cookie preferences through your browser, though disabling cookies may limit site functionality.</p>\r\n</li>\r\n<li>\r\n<p><strong>Third-Party Links</strong><br>Our site may contain links to other sites. We are not responsible for their privacy practices.</p>\r\n</li>\r\n<li>\r\n<p><strong>Children&rsquo;s Privacy</strong><br>We do not collect data from children under 13. If you believe we have data from a child, please contact us.</p>\r\n</li>\r\n<li>\r\n<p><strong>Policy Updates</strong><br>We may update this policy. Continued site use signifies acceptance of changes.</p>\r\n</li>\r\n<li>\r\n<p><strong>Contact Us</strong><br>Email: <a rel=\"noopener\">info@motodresser.com</a><br>Phone: <a href=\"tel:919669196692\">+91 9669196692</a><br>Address: 10, Gulmarg Complex, Sapna Sangeeta Main Road. Inodore 452001. M.P.</p>\r\n</li>\r\n</ol>');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `t_name` varchar(100) NOT NULL,
  `t_message` text NOT NULL,
  `t_date_created` datetime DEFAULT current_timestamp(),
  `t_date_updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `t_name`, `t_message`, `t_date_created`, `t_date_updated`) VALUES
(1, 'John Doe', 'Amazing service! I loved the quality of the products I purchased. Highly recommend motodresser.', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(2, 'Jane Smith', 'Great selection of bike gear and accessories. The customer service was outstanding.', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(3, 'Alex Johnson', 'I am impressed with the fast delivery and the top-notch quality of the helmet I bought. Will shop again!', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(4, 'Emily Davis', 'motodresser is my go-to store for all bike-related accessories. Very satisfied with my purchase.', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(5, 'Michael Brown', 'The variety and quality of products are impressive. Plus, the website is easy to navigate.', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(6, 'Sarah Wilson', 'Excellent products and swift customer service. My riding experience has improved greatly thanks to motodresser.', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(7, 'David Lee', 'Really happy with my purchase! The team at motodresser was helpful and attentive to my needs.', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(8, 'Jessica Kim', 'The best online store for bike enthusiasts. Quality is top-notch, and prices are reasonable.', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(9, 'Chris Evans', 'I bought a new helmet from motodresser, and I couldn’t be more satisfied. Highly recommended!', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(10, 'Nancy White', 'Shopping at motodresser was a smooth experience. The staff was knowledgeable and friendly.', '2024-10-23 10:58:44', '2024-10-23 10:58:44'),
(12, 'vineet', 'testing', '2024-10-23 11:39:43', '2024-10-23 11:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `customer_id`, `product_id`) VALUES
(22, 14, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments_of_blog`
--
ALTER TABLE `comments_of_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `landing_images`
--
ALTER TABLE `landing_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `my_orders`
--
ALTER TABLE `my_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`p_cat_id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_suggestions`
--
ALTER TABLE `product_suggestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `suggested_product_id` (`suggested_product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `comments_of_blog`
--
ALTER TABLE `comments_of_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `landing_images`
--
ALTER TABLE `landing_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `manufacturer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `my_orders`
--
ALTER TABLE `my_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `otp_verification`
--
ALTER TABLE `otp_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `p_cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `product_suggestions`
--
ALTER TABLE `product_suggestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `term_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `product_suggestions`
--
ALTER TABLE `product_suggestions`
  ADD CONSTRAINT `product_suggestions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_suggestions_ibfk_2` FOREIGN KEY (`suggested_product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
