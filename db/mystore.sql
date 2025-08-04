-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2025 at 06:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_image`) VALUES
(6, 'admin1', 'admin1@gmail.com', '$2y$10$q7qKfk3tczD6xrrxOV.Ob.6wGuBCldrJxtRwyv.rSHryMfogEvgky', 'IMG_0844[1].JPG');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(3, 'amazon'),
(4, 'zara'),
(8, 'spinneys'),
(9, 'LCwakiki'),
(10, 'Apple'),
(11, 'Samsung'),
(12, 'Adidas'),
(13, 'Sony'),
(14, 'LG'),
(15, 'Nestle'),
(16, 'Puma'),
(17, 'HP'),
(18, 'Dell'),
(19, 'Panasonic'),
(20, 'Asus'),
(21, 'Lenovo'),
(22, 'Canon'),
(23, 'Philips'),
(24, 'Rolex'),
(25, 'Red Bull'),
(26, 'Unilever'),
(27, 'Bosch'),
(28, 'Under Armour'),
(29, 'nike');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'fruits'),
(2, 'juice'),
(3, 'vegetables'),
(4, 'milk products'),
(5, 'books'),
(6, 'chips'),
(8, 'ice creams'),
(12, 'Electronics'),
(13, 'Clothing'),
(14, 'Shoes'),
(15, 'Home Appliances'),
(16, 'Mobile Phones'),
(17, 'Toys'),
(18, 'Books'),
(19, 'Personal Care'),
(20, 'Supermarket'),
(21, 'Furniture'),
(22, 'Gaming'),
(23, 'Kitchenware'),
(24, 'Watches'),
(25, 'Sports Equipment'),
(26, 'Cameras'),
(27, 'Pet Supplies'),
(28, 'Stationery'),
(29, 'Garden Tools'),
(30, 'Musical Instruments'),
(31, 'Car Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `contact_table`
--

CREATE TABLE `contact_table` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `message_text` text NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 6, 1004328414, 2, 1, 'pending'),
(2, 6, 491917792, 2, 1, 'pending'),
(3, 6, 896840527, 3, 1, 'pending'),
(4, 6, 75201493, 2, 1, 'pending'),
(5, 6, 470950756, 1, 1, 'pending'),
(6, 6, 828314534, 5, 1, 'pending'),
(7, 6, 476371014, 5, 1, 'pending'),
(8, 10, 1398334079, 2, 1, 'pending'),
(9, 9, 149917942, 2, 1, 'pending'),
(10, 6, 476696321, 1, 2, 'pending'),
(11, 6, 1311341005, 4, 1, 'pending'),
(12, 6, 1311341005, 5, 1, 'pending'),
(13, 9, 1817083176, 5, 1, 'pending'),
(14, 6, 312336196, 1, 1, 'pending'),
(15, 6, 755550179, 2, 1, 'pending'),
(16, 6, 1979076171, 3, 1, 'pending'),
(17, 6, 192382970, 5, 1, 'pending'),
(18, 6, 1049031947, 2, 1, 'pending'),
(19, 6, 132443250, 5, 1, 'pending'),
(20, 6, 433066386, 1, 1, 'pending'),
(21, 6, 1783491987, 2, 1, 'pending'),
(22, 6, 1877977427, 1, 1, 'pending'),
(23, 6, 1670332221, 1, 1, 'pending'),
(24, 6, 1589889682, 2, 1, 'pending'),
(26, 6, 175712099, 2, 1, 'pending'),
(27, 6, 2020219689, 2, 1, 'pending'),
(28, 6, 1757185362, 2, 1, 'pending'),
(29, 6, 400219151, 3, 1, 'pending'),
(30, 6, 1381103364, 2, 1, 'pending'),
(31, 6, 1388956403, 2, 1, 'pending'),
(32, 6, 1565645069, 3, 1, 'pending'),
(33, 6, 1468113643, 3, 1, 'pending'),
(34, 6, 452473554, 1, 1, 'pending'),
(35, 6, 1097375356, 5, 1, 'pending'),
(36, 6, 538717696, 1, 1, 'pending'),
(37, 6, 938735024, 2, 1, 'pending'),
(38, 6, 914567851, 2, 1, 'pending'),
(39, 6, 914567851, 3, 1, 'pending'),
(40, 6, 411981177, 2, 1, 'pending'),
(41, 6, 2005916108, 1, 1, 'pending'),
(42, 6, 1850030768, 1, 1, 'pending'),
(43, 6, 833153036, 2, 1, 'pending'),
(44, 6, 855397856, 15, 1, 'pending'),
(45, 6, 836815133, 22, 2, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `invoice_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `payment_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `invoice_id`, `name`, `amount`, `status`, `payment_date`) VALUES
(3, 'ORD469506', 'INV6938', 'farah', 333.00, 'paid', '2025-08-01 21:16:52'),
(4, 'ORD114538', 'INV2799', 'farah mohamed', 788.00, 'paid', '2025-08-01 21:31:24'),
(5, 'ORD888704', 'INV1574', 'farah mohamed', 788.00, 'pending', '2025-08-01 21:32:25'),
(6, 'ORD839961', 'INV9577', 'farah mohamed ahmed', 999.00, 'paid', '2025-08-01 21:47:14'),
(7, 'ORD502070', 'INV9719', 'farah mohamed ahmed', 999.00, 'paid', '2025-08-01 21:48:03'),
(8, 'ORD752958', 'INV9871', 'farah mohamed', 88.00, 'paid', '2025-08-02 21:07:13'),
(9, 'ORD569708', 'INV2532', 'uuueu', 99.00, 'paid', '2025-08-04 00:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) VALUES
(1, 'mango ', 'fresh mangoes', 'good,fresh mangoes', 20, 8, 'mango1.jpeg', 'mango2.png', 'mango3.jpg', '80', '2025-08-04 12:43:03', 'available'),
(2, 'chocolate', 'milky chocolate with extra huzelnuts', 'huzelnut chocolate  ', 20, 15, 'dairy.jpeg', 'dairy.jpeg', 'dairy.jpeg', '40', '2025-08-04 12:43:11', 'available'),
(3, 'apple', 'fresh,good apples', 'green,red apple', 20, 8, 'apple.jpeg', 'apple.jpeg', 'apple.jpeg', '70', '2025-08-04 12:43:23', 'available'),
(5, 'pringles chips', 'crispy chips with powerful flavors', 'chips crispy', 20, 0, 'chips.jpeg', 'chips.jpeg', 'chips.jpeg', '210', '2025-08-04 12:43:30', 'available'),
(8, 'Samsung Galaxy S23', 'Flagship Samsung phone with great camera', 'samsung galaxy phone', 16, 11, 'IMG_3028.PNG', '', '', '9999', '2025-08-04 12:49:30', 'available'),
(9, 'iPhone 14 Pro', ' Latest Apple smartphone with A16 chip', 'iphone smartphone apple', 16, 10, 'IMG_3027.PNG', '', '', '29000', '2025-08-04 12:49:38', 'available'),
(11, 'Nike Air Max', 'Comfortable shoes for running and casual use', 'nike shoes air max', 14, 29, 'IMG_3029.PNG', '', '', '2700', '2025-08-04 12:49:47', 'available'),
(12, 'Adidas Hoodie', 'Warm hoodie for winter sports', 'adidas hoodie clothing', 13, 12, 'IMG_3032.PNG', '', '', '1100', '2025-08-04 12:49:55', 'available'),
(13, 'Sony 4K TV', 'Smart TV with 4K HDR display', 'sony tv electronics', 12, 13, 'IMG_3033.PNG', '', '', '12000', '2025-08-04 12:50:08', 'available'),
(14, 'LG Washing Machine', 'Efficient front-load washer', 'washing machine lg home appliance', 15, 14, 'IMG_3034.PNG', '', '', '11000', '2025-08-04 12:50:21', 'available'),
(15, 'Nestle Nido Milk', 'Fortified milk powder for children', 'milk nestle powder', 4, 15, 'IMG_3035.PNG', '', '', '60', '2025-08-04 12:50:31', 'available'),
(16, 'HP Laptop', 'Reliable HP laptop for work and study', 'hp laptop electronics', 12, 17, 'IMG_3036.PNG', '', '', '21000', '2025-08-04 12:51:28', 'available'),
(17, 'Canon Camera', 'Beginner DSLR camera with lens kit', 'canon camera photography', 26, 22, 'IMG_3037.PNG', '', '', '7500', '2025-08-04 12:51:33', 'available'),
(18, 'Philips Hair Dryer', 'Powerful dryer with cool shot', 'hair dryer philips personal care', 19, 23, 'IMG_3038.PNG', '', '', '850', '2025-08-04 12:51:42', 'available'),
(19, 'Rolex Watch ', 'Luxury watch with timeless design', 'rolex watch luxury', 24, 24, 'IMG_3039.PNG', '', '', '7500', '2025-08-04 12:51:49', 'available'),
(20, 'Puma T-shirt', 'Comfortable cotton sports shirt', 'puma t-shirt clothing', 13, 16, 'IMG_3040.PNG', '', '', '600', '2025-08-04 12:52:00', 'available'),
(21, 'Asus Gaming Laptop', 'Powerful laptop for gamers', 'asus laptop gaming', 12, 20, 'IMG_3041.PNG', '', '', '45000', '2025-08-04 12:51:20', 'available'),
(22, 'Lenovo ThinkPad', 'Business-class productivity laptop', 'lenovo thinkpad laptop', 12, 21, 'IMG_3042.PNG', '', '', '43000', '2025-08-04 12:51:14', 'available'),
(23, 'Dell Monitor 24\"', 'Full HD monitor for home or office', 'dell monitor display', 12, 18, 'IMG_3043.PNG', '', '', '6000', '2025-08-04 12:51:07', 'available'),
(24, 'Red Bull Can', 'Energy drink for active lifestyle', 'energy drink red bull', 20, 25, 'IMG_3044.PNG', '', '', '70', '2025-08-04 12:51:00', 'available'),
(25, 'Dove Shampoo', 'Gentle shampoo for daily use', 'dove shampoo hair', 19, 26, 'IMG_3045.PNG', '', '', '210', '2025-08-04 12:50:55', 'available'),
(26, 'Bosch Drill', 'Cordless drill for home improvement', 'drill bosch tools', 29, 27, 'IMG_3046.PNG', '', '', '570', '2025-08-04 12:50:48', 'available'),
(27, 'Under Armour Cap', 'Lightweight training cap', 'cap under armour sports', 13, 28, 'IMG_3048.PNG', '', '', '230', '2025-08-04 12:50:42', 'available'),
(28, 'Gaming Chair', 'Comfortable ergonomic chair', 'gaming chair comfort', 22, 13, 'IMG_3047.PNG', '', '', '8000', '2025-08-04 12:49:06', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `detailed_address` varchar(255) NOT NULL,
  `phone` int(15) NOT NULL,
  `shipping_company` varchar(255) NOT NULL,
  `tracking_number` int(100) NOT NULL,
  `delivery_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

CREATE TABLE `user_payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payment`
--

INSERT INTO `user_payment` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(1, 11, 1311341005, 350, 'pay offline', '2025-07-18 19:25:46'),
(2, 10, 476696321, 160, 'pay offline', '2025-07-18 19:27:18'),
(3, 9, 149917942, 40, 'pay offline', '2025-07-25 17:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `conf_password` varchar(100) NOT NULL,
  `detailed_address` varchar(255) NOT NULL,
  `phone` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_username`, `user_password`, `user_image`, `user_email`, `user_ip`, `user_address`, `user_mobile`, `conf_password`, `detailed_address`, `phone`) VALUES
(6, 'farah', '$2y$10$BO..VekKd/pERxiOcLq0FuK9/j7HtLX8XTmRvZLAPuWeNROeA/9U2', 'IMG_0844[1].JPG', 'farahmohamedahmed976@gmail.com', '::1', 'obour', '01017172115', '', '', 0),
(9, 'hana', '$2y$10$fp1N1Z4qdYgGi.ylQz/lVezKyZOiVznLD5LfJfMPU5x6izegbJksi', 'admin.jpg', 'hana@gmail.com', '::1', 'alex', '0101818186', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_table`
--
ALTER TABLE `contact_table`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `contact_table`
--
ALTER TABLE `contact_table`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
