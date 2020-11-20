-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2020 at 03:12 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u289140853_miplani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `comment_id` int(11) NOT NULL,
  `projection_id` int(11) DEFAULT NULL,
  `projection_type` enum('main','sub') DEFAULT 'sub',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `add_user_id` int(11) DEFAULT 0,
  `comment_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`comment_id`, `projection_id`, `projection_type`, `name`, `email`, `comments`, `add_user_id`, `comment_date`) VALUES
(1, 20, 'sub', 'Nilesh Vyas', 'Nileshkvyas04@gmail.com', 'test', 6, 1595858884),
(2, 6, 'sub', 'Viviane Komze', 'vivianekomze@gmail.com', 'great work!!', 3, 1596223021);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupons`
--

CREATE TABLE `tbl_coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_discount_type` set('percentage','fix') DEFAULT 'percentage',
  `coupon_discount_amount` double DEFAULT 0,
  `frequency` double DEFAULT NULL,
  `coupon_start_date` int(11) DEFAULT NULL,
  `coupon_expiry_date` int(11) DEFAULT NULL,
  `total_usage` double DEFAULT NULL,
  `add_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_coupons`
--

INSERT INTO `tbl_coupons` (`coupon_id`, `coupon_code`, `coupon_discount_type`, `coupon_discount_amount`, `frequency`, `coupon_start_date`, `coupon_expiry_date`, `total_usage`, `add_date`) VALUES
(1, 'AWS', 'percentage', 2, 5, 1595196000, 1596060000, 0, 1595241563),
(5, '324432ffds', 'percentage', 6, 5, 1595455200, 1596146400, 0, 1595323565),
(7, 'TRY', 'percentage', 2, 3, 1594677600, 1595023200, 0, 1595323619);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dream_projections`
--

CREATE TABLE `tbl_dream_projections` (
  `projection_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `annual_billing` double DEFAULT 0,
  `achieve_goal_year` double DEFAULT 0,
  `average_product_price` double DEFAULT 0,
  `operating_expenses` int(11) DEFAULT 0,
  `advertising_expenses` int(11) DEFAULT 0,
  `average_product_sold_cost` int(11) DEFAULT 0,
  `conversion_rate` int(11) DEFAULT 0,
  `conversion_rate_percentage` double DEFAULT 0,
  `currency` varchar(10) DEFAULT NULL,
  `projection_type` enum('Yearly','6 Months','3 Months') DEFAULT 'Yearly',
  `projection_status` enum('draft','active','block') DEFAULT 'draft',
  `add_date` int(11) DEFAULT NULL,
  `update_key_url` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_dream_projections`
--

INSERT INTO `tbl_dream_projections` (`projection_id`, `user_id`, `annual_billing`, `achieve_goal_year`, `average_product_price`, `operating_expenses`, `advertising_expenses`, `average_product_sold_cost`, `conversion_rate`, `conversion_rate_percentage`, `currency`, `projection_type`, `projection_status`, `add_date`, `update_key_url`, `parent_id`) VALUES
(3, 1, 3000, 2, 2, 4, 3, 6, 5, 0.05, 'EUR', 'Yearly', 'active', 1595510535, NULL, 1),
(4, 1, 3005, 2, 2, 4, 3, 6, 5, 0.05, 'EUR', 'Yearly', 'active', 1595510554, NULL, 3),
(5, 2, 30000, 5, 150, 10, 5, 5, 5, 0.05, 'EUR', 'Yearly', 'active', 1595527555, NULL, NULL),
(6, 2, 30000, 5, 150, 10, 5, 5, 5, 0.05, 'EUR', 'Yearly', 'active', 1595527567, NULL, 5),
(14, 6, 45, 4, 1, 1, 2, 2, 2, 0.02, 'EUR', 'Yearly', 'active', 1595856214, NULL, NULL),
(16, 6, 45, 0, 1, 1, 1, 1, 1, 0.01, 'EUR', '6 Months', 'active', 1595857110, NULL, NULL),
(18, 6, 45, 4, 1, 1, 1, 1, 1, 0.01, 'EUR', 'Yearly', 'active', 1595857746, NULL, NULL),
(19, 10, 30000, 1, 40, 20, 10, 60, 40, 0.4, 'EUR', 'Yearly', 'active', 1596121274, NULL, NULL),
(20, 10, 29000, 0, 50, 10, 5, 20, 70, 0.7, 'EUR', '6 Months', 'active', 1596121593, NULL, NULL),
(22, 1, 50000, 0, 33, 2, 8, 6, 4, 0.04, 'EUR', '6 Months', 'active', 1596611277, NULL, NULL),
(23, 2, 2, 0, 2, 12, 2, 2, 2, 0.02, 'EUR', '6 Months', 'active', 1596777806, NULL, NULL),
(24, 15, 25000, 0, 85, 10, 10, 10, 5, 0.05, 'EUR', '6 Months', 'active', 1596798408, NULL, NULL),
(25, 2, 30000, 0, 75, 3, 3, 3, 3, 0.03, 'EUR', '3 Months', 'active', 1597381936, NULL, NULL),
(26, 1, 300000, 0, 75, 3, 3, 3, 3, 0.03, 'EUR', '3 Months', 'active', 1597383343, NULL, NULL),
(27, 1, 30000, 3, 75, 3, 3, 3, 3, 0.03, 'EUR', 'Yearly', 'active', 1597383406, NULL, NULL),
(30, 24, 30000, 0, 50, 5, 5, 5, 5, 0.05, 'EUR', '6 Months', 'active', 1597641579, NULL, NULL),
(32, 24, 30000, 2, 5, 5, 5, 5, 5, 0.05, 'EUR', 'Yearly', 'active', 1597641614, NULL, NULL),
(33, 24, 30000, 0, 50, 3, 3, 3, 3, 0.03, 'EUR', '3 Months', 'active', 1597641640, NULL, NULL),
(36, 26, 45, 0, 1, 3, 3, 3, 3, 0.03, 'EUR', '6 Months', 'active', 1597733908, NULL, NULL),
(37, 27, 30000, 0, 50, 10, 10, 5, 10, 0.1, 'EUR', '6 Months', 'active', 1597768760, NULL, NULL),
(38, 27, 30000, 0, 50, 10, 10, 10, 20, 0.2, 'EUR', '3 Months', 'active', 1597768781, NULL, NULL),
(39, 27, 30000, 1, 50, 10, 10, 10, 10, 0.1, 'EUR', 'Yearly', 'active', 1597768966, NULL, NULL),
(40, 26, 34, 3, 3, 3, 3, 3, 3, 0.03, 'EUR', 'Yearly', 'active', 1597772014, NULL, NULL),
(41, 28, 30000, 1, 30, 2, 2, 2, 2, 0.02, 'EUR', 'Yearly', 'active', 1598032172, NULL, NULL),
(42, 13, 1200, 12, 12, 12, 12, 12, 12, 0.12, 'EUR', 'Yearly', 'active', 1603357698, NULL, NULL),
(43, 70, 1200, 13, 13, 13, 13, 13, 13, 0.13, 'EUR', 'Yearly', 'active', 1603377584, NULL, NULL),
(44, 70, 1200, 0, 1200, 12, 22, 12, 1, 0.01, 'EUR', '3 Months', 'active', 1603377753, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invite_projection_friends`
--

CREATE TABLE `tbl_invite_projection_friends` (
  `main_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `friend_email` varchar(255) DEFAULT NULL,
  `projection_id` int(11) DEFAULT NULL,
  `projection_type` enum('main','sub','dream') DEFAULT 'sub',
  `permission` enum('all','view','update','delete') DEFAULT 'view',
  `invite_date` int(11) DEFAULT NULL,
  `key_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_invite_projection_friends`
--

INSERT INTO `tbl_invite_projection_friends` (`main_id`, `user_id`, `friend_email`, `projection_id`, `projection_type`, `permission`, `invite_date`, `key_url`) VALUES
(1, 3, 'vivianekomze@gmail.com', 5, 'sub', 'view', 1595533614, 'My01LTE='),
(2, 6, 'hiralgodani@gmail.com', 14, 'dream', 'view', 1595856588, 'Ni0xNC0y'),
(3, 3, 'antiabertrand@gmail.com', 6, 'sub', 'view', 1596223093, 'My02LTM='),
(4, 3, 'vivianekomze@gmail.com', 6, 'sub', 'update', 1596223206, 'My02LTQ='),
(5, 3, 'dariofalbert@gmail.com', 6, 'sub', 'view', 1596223306, 'My02LTU='),
(6, 2, 'emma.red987@gmail.com', 23, 'dream', 'view', 1596777840, 'Mi0yMy02'),
(7, 15, 'zoey.amanda009@gmail.com', 24, 'dream', 'view', 1596798854, 'MTUtMjQtNw=='),
(8, 2, 'scarlettjohansson124@gmail.com', 23, 'dream', 'update', 1597384716, 'Mi0yMy04'),
(10, 27, 'sayedsarkar2020@gmail.com', 34, 'sub', 'update', 1597771429, 'MjctMzQtMTA='),
(11, 28, 'vivianekomze@gmail.com', 41, 'dream', 'view', 1598032208, 'MjgtNDEtMTE='),
(12, 11, 'vivianekomze@gmail.com', 38, 'sub', 'update', 1600251104, 'MTEtMzgtMTI='),
(14, 13, 'aaron.smith2981@gmail.com', 29, 'sub', 'view', 1603089310, 'MTMtMjktMTQ=');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_main_projections`
--

CREATE TABLE `tbl_main_projections` (
  `projection_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `annual_billing` double DEFAULT 0,
  `achieve_goal_year` double DEFAULT 0,
  `average_product_price` double DEFAULT 0,
  `operating_expenses` int(11) DEFAULT 0,
  `advertising_expenses` int(11) DEFAULT 0,
  `average_product_sold_cost` int(11) DEFAULT 0,
  `conversion_rate` int(11) DEFAULT 0,
  `conversion_rate_percentage` double DEFAULT 0,
  `second_annual_billing` double DEFAULT 0,
  `second_achieve_goal_year` double DEFAULT 0,
  `second_average_product_price` double DEFAULT 0,
  `second_operating_expenses` int(11) DEFAULT 0,
  `second_advertising_expenses` int(11) DEFAULT 0,
  `second_average_product_sold_cost` int(11) DEFAULT 0,
  `second_conversion_rate` int(11) DEFAULT 0,
  `second_conversion_rate_percentage` double DEFAULT 0,
  `third_annual_billing` double DEFAULT 0,
  `third_achieve_goal_year` double DEFAULT 0,
  `third_average_product_price` double DEFAULT 0,
  `third_operating_expenses` int(11) DEFAULT 0,
  `third_advertising_expenses` int(11) DEFAULT 0,
  `third_average_product_sold_cost` int(11) DEFAULT 0,
  `third_conversion_rate` int(11) DEFAULT 0,
  `third_conversion_rate_percentage` double DEFAULT 0,
  `currency` varchar(10) DEFAULT NULL,
  `completed_step` int(11) DEFAULT 0,
  `projection_status` enum('draft','active','block') DEFAULT 'draft',
  `add_date` int(11) DEFAULT NULL,
  `update_key_url` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter_subscriptions`
--

CREATE TABLE `tbl_newsletter_subscriptions` (
  `sub_news_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sub_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pricing_plans`
--

CREATE TABLE `tbl_pricing_plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) DEFAULT NULL,
  `plan_type` enum('free','monthly','annual','life time') DEFAULT 'monthly',
  `plan_price` double DEFAULT NULL,
  `plan_key` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_pricing_plans`
--

INSERT INTO `tbl_pricing_plans` (`plan_id`, `plan_name`, `plan_type`, `plan_price`, `plan_key`, `description`) VALUES
(1, 'Free', 'free', 0, '1', ' Try for free, zero risk '),
(2, 'Monthly', 'monthly', 19.97, '2', ' Per month, billed once a year '),
(3, 'Annual', 'annual', 191.64, '3', ' Per month, billed once a year '),
(4, 'Lifetime', 'life time', 495, '4', ' Unlimited software forever ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projections`
--

CREATE TABLE `tbl_projections` (
  `projection_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `projection_name` varchar(255) DEFAULT NULL,
  `annual_billing` double DEFAULT NULL COMMENT 'Sheet:D; C5 from excel',
  `average_product_price` double DEFAULT NULL COMMENT 'Sheet:E; B27 from excel',
  `operating_expenses` int(11) DEFAULT NULL COMMENT 'Sheet:H; B8 & B14 From Excel',
  `advertising_expenses` int(11) DEFAULT NULL COMMENT 'Sheet:I; B8 & B15 From Excel',
  `average_product_sold_cost` int(11) DEFAULT NULL COMMENT 'Sheet:I(2); B8 & B14',
  `conversion_rate` int(11) DEFAULT NULL COMMENT 'Sheet:G; B8, B18, B21, B24, B27 from excel',
  `conversion_rate_percentage` double DEFAULT 0 COMMENT 'Sheet G',
  `annual_qualified_web_traffic_volume` double DEFAULT 0 COMMENT 'Sheet G',
  `quarterly_qualified_web_traffic_volume` double DEFAULT 0 COMMENT 'Sheet G;Sheet L',
  `monthly_qualified_web_traffic_volume` double DEFAULT 0 COMMENT 'Sheet G;Sheet L',
  `weekly_qualified_web_traffic_volume` double DEFAULT 0 COMMENT 'Sheet G;Sheet L',
  `daily_qualified_web_traffic_volume` double DEFAULT 0 COMMENT 'Sheet G;Sheet L',
  `annual_potential_customer_buy_one_item` double DEFAULT 0 COMMENT 'Sheet G',
  `quarterly_potential_customer_buy_one_item` double DEFAULT 0 COMMENT 'Sheet G;Sheet L',
  `monthly_potential_customer_buy_one_item` double DEFAULT 0 COMMENT 'Sheet G;Sheet L',
  `weekly_potential_customer_buy_one_item` double DEFAULT 0 COMMENT 'Sheet G;Sheet L',
  `daily_potential_customer_buy_one_item` double DEFAULT 0 COMMENT 'Sheet G;Sheet L',
  `completed_step` int(11) DEFAULT NULL,
  `projection_status` enum('draft','active','block') DEFAULT 'draft',
  `add_date` int(11) DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL,
  `operating_daily_expenses` double DEFAULT NULL,
  `operating_weekly_expenses` double DEFAULT NULL,
  `operating_monthly_expenses` double DEFAULT NULL,
  `operating_quaterly_expenses` double DEFAULT NULL,
  `operating_annual_expenses` double DEFAULT NULL,
  `advertising_daily_expenses` double DEFAULT NULL,
  `advertising_weekly_expenses` double DEFAULT NULL,
  `advertising_monthly_expenses` double DEFAULT NULL,
  `advertising_quaterly_expenses` double DEFAULT NULL,
  `advertising_annual_expenses` double DEFAULT NULL,
  `daily_product_sold_cost` double DEFAULT NULL,
  `weekly_product_sold_cost` double DEFAULT NULL,
  `monthly_product_sold_cost` double DEFAULT NULL,
  `quaterly_product_sold_cost` double DEFAULT NULL,
  `annual_product_sold_cost` double DEFAULT NULL,
  `daily_revenue` decimal(10,0) DEFAULT NULL,
  `weekly_revenue` double DEFAULT NULL,
  `monthly_revenue` double DEFAULT NULL,
  `quaterly_revenue` double DEFAULT NULL,
  `annual_revenue` double DEFAULT NULL,
  `total_daily_expenses` double DEFAULT NULL,
  `total_weekly_expenses` double DEFAULT NULL,
  `total_monthly_expenses` double DEFAULT NULL,
  `total_quaterly_expenses` double DEFAULT NULL,
  `total_annual_expenses` double DEFAULT NULL,
  `global_analysis_annual_profit` double DEFAULT 0 COMMENT 'sheet K',
  `global_analysis_monthly_profit` double DEFAULT 0 COMMENT 'sheet K',
  `global_analysis_quarterly_profit` double DEFAULT 0 COMMENT 'sheet K',
  `global_analysis_weekly_profit` double DEFAULT 0 COMMENT 'sheet K',
  `global_analysis_daily_profit` double DEFAULT 0 COMMENT 'sheet K',
  `global_analysis_rio` double DEFAULT 0 COMMENT 'sheet K',
  `scenario_one_total_expenses_ratio` int(11) DEFAULT NULL COMMENT 'Sheet M',
  `scenario_two_conversion` double DEFAULT NULL,
  `scenario_three_product_buyer_ratio` int(11) DEFAULT NULL,
  `scenario_three_additional_product_price` double DEFAULT NULL,
  `scenario_multiple_product_buyer_ratio` int(11) DEFAULT NULL,
  `scenario_multiple_product_price` double DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `update_key_url` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_projections`
--

INSERT INTO `tbl_projections` (`projection_id`, `user_id`, `projection_name`, `annual_billing`, `average_product_price`, `operating_expenses`, `advertising_expenses`, `average_product_sold_cost`, `conversion_rate`, `conversion_rate_percentage`, `annual_qualified_web_traffic_volume`, `quarterly_qualified_web_traffic_volume`, `monthly_qualified_web_traffic_volume`, `weekly_qualified_web_traffic_volume`, `daily_qualified_web_traffic_volume`, `annual_potential_customer_buy_one_item`, `quarterly_potential_customer_buy_one_item`, `monthly_potential_customer_buy_one_item`, `weekly_potential_customer_buy_one_item`, `daily_potential_customer_buy_one_item`, `completed_step`, `projection_status`, `add_date`, `update_date`, `operating_daily_expenses`, `operating_weekly_expenses`, `operating_monthly_expenses`, `operating_quaterly_expenses`, `operating_annual_expenses`, `advertising_daily_expenses`, `advertising_weekly_expenses`, `advertising_monthly_expenses`, `advertising_quaterly_expenses`, `advertising_annual_expenses`, `daily_product_sold_cost`, `weekly_product_sold_cost`, `monthly_product_sold_cost`, `quaterly_product_sold_cost`, `annual_product_sold_cost`, `daily_revenue`, `weekly_revenue`, `monthly_revenue`, `quaterly_revenue`, `annual_revenue`, `total_daily_expenses`, `total_weekly_expenses`, `total_monthly_expenses`, `total_quaterly_expenses`, `total_annual_expenses`, `global_analysis_annual_profit`, `global_analysis_monthly_profit`, `global_analysis_quarterly_profit`, `global_analysis_weekly_profit`, `global_analysis_daily_profit`, `global_analysis_rio`, `scenario_one_total_expenses_ratio`, `scenario_two_conversion`, `scenario_three_product_buyer_ratio`, `scenario_three_additional_product_price`, `scenario_multiple_product_buyer_ratio`, `scenario_multiple_product_price`, `currency`, `update_key_url`, `parent_id`) VALUES
(1, 2, 'projection 23/07/20', 30000, 150, 10, 2, 5, 2, 0.02, 10000, 2500, 833, 192, 27, 200, 50, 17, 4, 1, 12, 'active', 1595511564, 1595512343, 8, 58, 250, 750, 3000, 2, 12, 50, 150, 600, 4, 29, 125, 375, 1500, '82', 577, 2500, 7500, 30000, 14, 99, 425, 1275, 5100, 24900, 2075, 6225, 479, 68, 488, 14, 5, 5, 155, 6, 90, 'EUR', NULL, NULL),
(2, 2, 'projection 23/07/20 Copy 1', 30000, 150, 10, 2, 5, 2, 0.02, 10000, 2500, 833, 192, 27, 200, 50, 17, 4, 1, 12, 'active', 1595511855, 1595511822, 8, 58, 250, 750, 3000, 2, 12, 50, 150, 600, 4, 29, 125, 375, 1500, '82', 577, 2500, 7500, 30000, 14, 99, 425, 1275, 5100, 24900, 2075, 6225, 479, 68, 488, 14, 5, 5, 155, 6, 90, 'EUR', NULL, 1),
(3, 2, 'projection 23/07/20 Copy 1', 30000, 150, 10, 2, 5, 2, 0.02, 10000, 2500, 833, 192, 27, 200, 50, 17, 4, 1, 12, 'active', 1595511867, 1595511822, 8, 58, 250, 750, 3000, 2, 12, 50, 150, 600, 4, 29, 125, 375, 1500, '82', 577, 2500, 7500, 30000, 14, 99, 425, 1275, 5100, 24900, 2075, 6225, 479, 68, 488, 14, 5, 5, 155, 6, 90, 'EUR', NULL, 1),
(8, 2, 'projection check', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1595570840, 1595570843, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 2, 'projection 24/07/20', 1000000, 150, 5, 10, 10, 4, 0.04, 166667, 41667, 13889, 3205, 457, 6667, 1667, 556, 128, 18, 11, 'active', 1595584777, 1595585452, 137, 962, 4167, 12500, 50000, 274, 1923, 8333, 25000, 100000, 274, 1923, 8333, 25000, 100000, '2740', 19231, 83333, 250000, 1000000, 685, 4808, 20833, 62500, 250000, 750000, 62500, 187500, 14423, 2055, 300, 10, 5, 5, 155, 6, 45, NULL, NULL, NULL),
(10, 2, 'projection 24/07/20 Copy 1', 1000000, 150, 5, 10, 10, 4, 0.04, 166667, 41667, 13889, 3205, 457, 6667, 1667, 556, 128, 18, 11, 'active', 1595587272, 1595585452, 137, 962, 4167, 12500, 50000, 274, 1923, 8333, 25000, 100000, 274, 1923, 8333, 25000, 100000, '2740', 19231, 83333, 250000, 1000000, 685, 4808, 20833, 62500, 250000, 750000, 62500, 187500, 14423, 2055, 300, 10, 5, 5, 155, 6, 45, NULL, NULL, 9),
(11, 2, 'projection 24/07/20 Copy 2', 1000000, 150, 5, 10, 10, 4, 0.04, 166667, 41667, 13889, 3205, 457, 6667, 1667, 556, 128, 18, 11, 'active', 1595587277, 1595585452, 137, 962, 4167, 12500, 50000, 274, 1923, 8333, 25000, 100000, 274, 1923, 8333, 25000, 100000, '2740', 19231, 83333, 250000, 1000000, 685, 4808, 20833, 62500, 250000, 750000, 62500, 187500, 14423, 2055, 300, 10, 5, 5, 155, 6, 45, NULL, NULL, 9),
(12, 2, 'projection 24/07/20 Copy 3', 1000000, 150, 5, 10, 10, 4, 0.04, 166667, 41667, 13889, 3205, 457, 6667, 1667, 556, 128, 18, 11, 'active', 1595587286, 1595585452, 137, 962, 4167, 12500, 50000, 274, 1923, 8333, 25000, 100000, 274, 1923, 8333, 25000, 100000, '2740', 19231, 83333, 250000, 1000000, 685, 4808, 20833, 62500, 250000, 750000, 62500, 187500, 14423, 2055, 300, 10, 5, 5, 155, 6, 45, NULL, NULL, 9),
(13, 2, 'projection 24/07/20 Copy 1 Copy 1', 1000000, 150, 5, 10, 10, 4, 0.04, 166667, 41667, 13889, 3205, 457, 6667, 1667, 556, 128, 18, 11, 'active', 1595587291, 1595585452, 137, 962, 4167, 12500, 50000, 274, 1923, 8333, 25000, 100000, 274, 1923, 8333, 25000, 100000, '2740', 19231, 83333, 250000, 1000000, 685, 4808, 20833, 62500, 250000, 750000, 62500, 187500, 14423, 2055, 300, 10, 5, 5, 155, 6, 45, NULL, NULL, 10),
(14, 2, 'projection 24/07/20 Copy 1 Copy 2', 1000000, 150, 5, 10, 10, 4, 0.04, 166667, 41667, 13889, 3205, 457, 6667, 1667, 556, 128, 18, 11, 'active', 1595587297, 1595585452, 137, 962, 4167, 12500, 50000, 274, 1923, 8333, 25000, 100000, 274, 1923, 8333, 25000, 100000, '2740', 19231, 83333, 250000, 1000000, 685, 4808, 20833, 62500, 250000, 750000, 62500, 187500, 14423, 2055, 300, 10, 5, 5, 155, 6, 45, NULL, NULL, 10),
(15, 2, 'projection input ', 1000000, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 'draft', 1595596289, 1595596306, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 2, 'projection 27/07/20', 1000000, 150, 5, 10, 10, 4, 0.04, 166667, 41667, 13889, 3205, 457, 6667, 1667, 556, 128, 18, 6, 'draft', 1595596488, 1595596546, 137, 962, 4167, 12500, 50000, 274, 1923, 8333, 25000, 100000, 274, 1923, 8333, 25000, 100000, '2740', 19231, 83333, 250000, 1000000, 685, 4808, 20833, 62500, 250000, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 5, 'Seo', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1595614161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 6, 'goal', 6000, -2, 4, 5, 4, 5, 0.05, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 12, 'active', 1595858449, 1595858585, 1, 5, 20, 60, 240, 1, 6, 25, 75, 300, 1, 5, 20, 60, 240, '16', 115, 500, 1500, 6000, 3, 16, 65, 195, 780, 5220, 435, 1305, 100, 14, 669, 0, 0, 0, 0, 0, 0, 'USD', NULL, NULL),
(20, 6, 'goal Copy 1', 6000, -2, 4, 5, 4, 5, 0.05, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 12, 'active', 1595858853, 1595858585, 1, 5, 20, 60, 240, 1, 6, 25, 75, 300, 1, 5, 20, 60, 240, '16', 115, 500, 1500, 6000, 3, 16, 65, 195, 780, 5220, 435, 1305, 100, 14, 669, 0, 0, 0, 0, 0, 0, 'USD', NULL, 19),
(21, 6, 'Ios', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1595924551, 1595924982, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 9, 'New Projection 01', 300, 50, 90, 80, 99, 39, 0.39, 15, 4, 1, 0, 0, 6, 2, 1, 0, 0, 12, 'active', 1595965067, 1595965389, 1, 5, 23, 68, 270, 1, 5, 20, 60, 240, 1, 6, 25, 74, 297, '1', 6, 25, 75, 300, 3, 16, 68, 202, 807, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'USD', NULL, NULL),
(23, 10, 'TestProjection', 30000, 40, 10, 10, 5, 60, 0.6, 1250, 313, 104, 24, 3, 750, 188, 63, 14, 2, 12, 'active', 1596121340, 1596121482, 8, 58, 250, 750, 3000, 8, 58, 250, 750, 3000, 4, 29, 125, 375, 1500, '82', 577, 2500, 7500, 30000, 20, 145, 625, 1875, 7500, 22500, 1875, 5625, 433, 62, 300, 0, 0, 0, 0, 0, 0, 'USD', NULL, NULL),
(24, 11, '1000000', 100000, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 'draft', 1596220305, 1600250621, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 2, 'abc', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1596617928, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 2, 'abc', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1596618055, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 2, 'Ggg', 4000, 500, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 'draft', 1596717719, 1596717739, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 2, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1596717960, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 13, 'Nick test', 30000, 115, 5, 7, 9, 5, 0.05, 5217, 1304, 435, 100, 14, 261, 65, 22, 5, 1, 12, 'active', 1596776013, 1603450130, 4, 29, 125, 375, 1500, 6, 40, 175, 525, 2100, 7, 52, 225, 675, 2700, '82', 577, 2500, 7500, 30000, 17, 121, 525, 1575, 6300, 23700, 1975, 5925, 456, 65, 376, 10, 5, 10, 12, 36, 5, 'EUR', NULL, NULL),
(30, 15, 'projection 07/08/20', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1596799924, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 2, 'test', 30000, 30000, 20, 10, 10, 1, 0.01, 100, 25, 8, 2, 0, 1, 0, 0, 0, 0, 11, 'active', 1597728892, 1597729207, 16, 115, 500, 1500, 6000, 8, 58, 250, 750, 3000, 8, 58, 250, 750, 3000, '82', 577, 2500, 7500, 30000, 32, 231, 1000, 3000, 12000, 18000, 1500, 4500, 346, 49, 150, 2, 2, 2, 2, 2, 2, NULL, NULL, NULL),
(33, 2, 'test', 2, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 'draft', 1597729544, 1597733002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 27, 'P', 30000, 50, 10, 10, 10, 10, 0.1, 6000, 1500, 500, 115, 16, 600, 150, 50, 12, 2, 11, 'active', 1597768862, 1597771567, 8, 58, 250, 750, 3000, 8, 58, 250, 750, 3000, 8, 58, 250, 750, 3000, '82', 577, 2500, 7500, 30000, 24, 174, 750, 2250, 9000, 21000, 1750, 5250, 404, 58, 233, 0, 0, 0, 0, 0, 0, NULL, 'MjctMzQtMTA=', NULL),
(36, 3, 'setiembre 1', 250000, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 'draft', 1598969458, 1598969667, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 3, 'setiembre', 100000, 150, 15, 20, 30, 1, 0.01, 66667, 16667, 5556, 1282, 183, 667, 167, 56, 13, 2, 11, 'active', 1598969726, 1598972654, 41, 288, 1250, 3750, 15000, 55, 385, 1667, 5000, 20000, 82, 577, 2500, 7500, 30000, '274', 1923, 8333, 25000, 100000, 178, 1250, 5417, 16250, 65000, 35000, 2917, 8750, 673, 96, 54, 50, 8, 5, 300, 30, 75, NULL, NULL, NULL),
(38, 11, 'Prueba', 100000, 350, 5, 10, 10, 3, 0.03, 9524, 2381, 794, 183, 26, 286, 72, 24, 6, 1, 11, 'active', 1600250648, 1600251327, 14, 96, 417, 1250, 5000, 27, 192, 833, 2500, 10000, 27, 192, 833, 2500, 10000, '274', 1923, 8333, 25000, 100000, 68, 480, 2083, 6250, 25000, 75000, 6250, 18750, 1442, 205, 300, 15, 5, 15, 450, 25, 150, NULL, 'MTEtMzgtMTI=', NULL),
(39, 3, 'SETIEMBRE', 100000, 300, 10, 10, 8, 1, 0.01, 33333, 8333, 2778, 641, 91, 333, 83, 28, 6, 1, 9, 'draft', 1600334740, 1600335170, 27, 192, 833, 2500, 10000, 27, 192, 833, 2500, 10000, 22, 154, 667, 2000, 8000, '274', 1923, 8333, 25000, 100000, 76, 538, 2333, 7000, 28000, 72000, 6000, 18000, 1385, 197, 257, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 3, '22 set', 100000, 1000, 20, 5, 50, 7, 0.07, 1429, 357, 119, 27, 4, 100, 25, 8, 2, 0, 11, 'active', 1600776077, 1600777275, 55, 385, 1667, 5000, 20000, 14, 96, 417, 1250, 5000, 137, 962, 4167, 12500, 50000, '274', 1923, 8333, 25000, 100000, 206, 1443, 6251, 18750, 75000, 25000, 2083, 6250, 481, 68, 33, 30, 10, 3, 1200, 15, 250, NULL, NULL, NULL),
(41, 3, 'setiembre 22-a', 100000, 500, 30, 30, 40, 10, 0.1, 2000, 500, 167, 38, 5, 200, 50, 17, 4, 1, 11, 'active', 1600808548, 1600809769, 82, 577, 2500, 7500, 30000, 82, 577, 2500, 7500, 30000, 110, 769, 3333, 10000, 40000, '274', 1923, 8333, 25000, 100000, 274, 1923, 8333, 25000, 100000, 0, 0, 0, 0, 0, 0, 80, 15, 5, 700, 20, 250, NULL, NULL, NULL),
(42, 3, 'Setiembre 23', 100000, 1000, 20, 20, 30, 5, 0.05, 2000, 500, 167, 38, 5, 100, 25, 8, 2, 0, 11, 'active', 1600859997, 1600860683, 55, 385, 1667, 5000, 20000, 55, 385, 1667, 5000, 20000, 82, 577, 2500, 7500, 30000, '274', 1923, 8333, 25000, 100000, 192, 1347, 5834, 17500, 70000, 30000, 2500, 7500, 577, 82, 43, 50, 10, 2, 500, 0, 0, NULL, NULL, NULL),
(43, 3, 'setiembre 2020', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1600870520, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 3, 'setiembre', 100000, 200, 20, 5, 40, 2, 0.02, 25000, 6250, 2083, 481, 68, 500, 125, 42, 10, 1, 11, 'active', 1600870547, 1600871942, 55, 385, 1667, 5000, 20000, 14, 96, 417, 1250, 5000, 110, 769, 3333, 10000, 40000, '274', 1923, 8333, 25000, 100000, 179, 1250, 5417, 16250, 65000, 35000, 2917, 8750, 673, 96, 54, 50, 3, 2, 300, 20, 25, NULL, NULL, NULL),
(45, 3, 'SET 24', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1601046060, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 3, 'SET 24', 150000, 2000, 30, 18, 30, 10, 0.1, 750, 188, 63, 14, 2, 75, 19, 6, 1, 0, 11, 'active', 1601046060, 1601047901, 123, 865, 3750, 11250, 45000, 74, 519, 2250, 6750, 27000, 123, 865, 3750, 11250, 45000, '411', 2885, 12500, 37500, 150000, 320, 2249, 9750, 29250, 117000, 33000, 2750, 8250, 635, 90, 28, 60, 11, 10, 30, 25, 10, NULL, NULL, NULL),
(48, 29, 'Test Projection', 5000, 1250, 5, 20, 12, 6, 0.06, 67, 17, 6, 1, 0, 4, 1, 0, 0, 0, 12, 'active', 1601458779, 1601459833, 1, 5, 21, 63, 250, 3, 19, 83, 250, 1000, 2, 12, 50, 150, 600, '14', 96, 417, 1250, 5000, 6, 36, 154, 463, 1850, 3150, 263, 788, 61, 9, 170, 4, 6, 5, 6, 7, 8, 'USD', NULL, NULL),
(50, 13, 'Nick test2', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1603099129, 1603871252, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 13, 'Nick test3', 30000, 12000, 40, 12, 30, 20, 0.2, 13, 3, 1, 0, 0, 3, 1, 0, 0, 0, 9, 'draft', 1603099171, 1603099320, 33, 231, 1000, 3000, 12000, 10, 69, 300, 900, 3600, 25, 173, 750, 2250, 9000, '82', 577, 2500, 7500, 30000, 68, 473, 2050, 6150, 24600, 5400, 450, 1350, 104, 15, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 13, 'nick test4', 30000, 200, 20, 30, 40, 20, 0.2, 750, 188, 63, 14, 2, 150, 38, 13, 3, 0, 12, 'active', 1603448270, 1603448383, 16, 115, 500, 1500, 6000, 25, 173, 750, 2250, 9000, 33, 231, 1000, 3000, 12000, '82', 577, 2500, 7500, 30000, 74, 519, 2250, 6750, 27000, 3000, 250, 750, 58, 8, 11, 40, 30, 20, 20, 20, 30, 'USD', NULL, NULL),
(77, 13, '45645', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1603460094, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 13, '123', 30000, 25, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 'draft', 1603461440, 1603461599, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 13, 'testing', 50000, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 'draft', 1603891362, 1603892032, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 13, 'testing1', 50000, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 'draft', 1603892051, 1603892057, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 13, 'testing3', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'draft', 1603892137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_details` text DEFAULT NULL,
  `review_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`review_id`, `user_id`, `rating`, `review_details`, `review_date`) VALUES
(1, 10, 5, 'This is a Test Review.', 1596120345),
(2, 2, 3, 'review added', 1597641893),
(3, 26, 4, 'test', 1597757093);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_users`
--

CREATE TABLE `tbl_system_users` (
  `user_id` int(11) NOT NULL,
  `user_type` enum('ad','user') NOT NULL DEFAULT 'user',
  `user_full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_picture` varchar(255) NOT NULL,
  `user_status` enum('active','block') NOT NULL DEFAULT 'active',
  `add_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_system_users`
--

INSERT INTO `tbl_system_users` (`user_id`, `user_type`, `user_full_name`, `username`, `user_email`, `user_password`, `user_picture`, `user_status`, `add_date`) VALUES
(1, 'ad', 'James Noah', 'james', 'james.noah1172@gmail.com', '3bb899a063a0cf837f5fdb45fa8932c5', '', 'active', 1551692767);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_picture` varchar(255) DEFAULT NULL,
  `user_status` enum('pending','active','block') DEFAULT 'pending',
  `add_date` int(11) DEFAULT NULL,
  `oauth_provider` enum('website','admin','facebook','twitter','linkedin','gmail','yahoo') DEFAULT 'website',
  `oauth_uid` varchar(255) DEFAULT NULL,
  `is_verify_email` enum('No','Yes') DEFAULT 'No',
  `verification_code` varchar(255) DEFAULT NULL,
  `verification_link` varchar(255) DEFAULT NULL,
  `current_subscription_type` varchar(255) DEFAULT 'Free',
  `plan_id` int(11) DEFAULT NULL,
  `subscription_start_date` int(11) DEFAULT NULL,
  `subscription_end_date` int(11) DEFAULT NULL,
  `user_payment_status` enum('active','free','expired') DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `user_email`, `user_password`, `first_name`, `last_name`, `user_picture`, `user_status`, `add_date`, `oauth_provider`, `oauth_uid`, `is_verify_email`, `verification_code`, `verification_link`, `current_subscription_type`, `plan_id`, `subscription_start_date`, `subscription_end_date`, `user_payment_status`) VALUES
(1, 'james', 'james.noah.test@gmail.com', '0192023a7bbd73250516f069df18b500', 'James', 'noah', 'https://lh6.googleusercontent.com/-tsfWPLD-NH4/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucm_izVzx1GHadBzhk3dvdi7RHQ5Pg/photo.jpg', 'active', 1595510344, 'gmail', '112600153392183427919', 'Yes', '', '', 'monthly', 2, 1595584713, 0, 'active'),
(2, 'zoey.amanda009', 'zoey.amanda009@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'zoey', 'amanda', NULL, 'active', 1595511235, 'website', NULL, 'No', '623609068', 'Mk1pUGxhbmlUaGUgcXVpY2sgYnJvd24gZm94IGp1bXBzIG92ZXIgdGhlIGxhenkgZG9nMTU5NTUxMTIzNQ==', 'monthly', 2, 1595570577, 0, 'active'),
(3, 'antia', 'antiabertrand@gmail.com', '15cfda429ed71c396639d6e87fa05b51', 'antia', 'bertrand', NULL, 'active', 1595532688, 'website', NULL, 'No', '680444363', 'M01pUGxhbmlUaGUgcXVpY2sgYnJvd24gZm94IGp1bXBzIG92ZXIgdGhlIGxhenkgZG9nMTU5NTUzMjY4OA==', 'Free', NULL, NULL, NULL, 'free'),
(4, 'nickkurat', 'nick@user.com', '25d55ad283aa400af464c76d713c07ad', 'nick', 'kurat', NULL, 'active', 1595575326, 'website', NULL, 'No', '1026616761', 'NE1pUGxhbmlUaGUgcXVpY2sgYnJvd24gZm94IGp1bXBzIG92ZXIgdGhlIGxhenkgZG9nMTU5NTU3NTMyNg==', 'Free', NULL, NULL, NULL, 'free'),
(5, 'georgeseotest', 'gtrapmeister@gmail.com', '31b830af414ed3e9088bd26446fe1af3', 'George', 'seo', NULL, 'active', 1595613444, 'website', NULL, 'Yes', '', '', 'Free', NULL, NULL, NULL, 'free'),
(6, 'nilesh', 'nileshkvyas04@gmail.com', '12bce374e7be15142e8172f668da00d8', 'nilesh', 'vyas', 'https://lh5.googleusercontent.com/-OoFTjiUehfs/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuckA0oVqOppOcWjD2YPK43-_IiaOiw/photo.jpg', 'active', 1595744023, 'gmail', '103537195448392726384', 'Yes', '631439979', 'Nk1pUGxhbmlUaGUgcXVpY2sgYnJvd24gZm94IGp1bXBzIG92ZXIgdGhlIGxhenkgZG9nMTU5NTc0NDAyMw==', 'Free', NULL, NULL, NULL, 'free'),
(7, 'Chris77', 'komze@hotmail.com', '633ccdfe93884f234ee956c929605d05', 'Christian', 'Komze', NULL, 'active', 1595801283, 'website', NULL, 'No', '273023880', 'N01pUGxhbmlUaGUgcXVpY2sgYnJvd24gZm94IGp1bXBzIG92ZXIgdGhlIGxhenkgZG9nMTU5NTgwMTI4Mw==', 'Free', NULL, NULL, NULL, 'free'),
(8, 'Daniel', 'TORTONESE@GMAIL.COM', '8bb1f5cffc4af66627c1f116a8e8a797', 'Daniel', 'Tortonese', NULL, 'active', 1595809572, 'website', NULL, 'Yes', '', '', 'Free', NULL, NULL, NULL, 'free'),
(9, 'adeelsajjad', 'adeelsajjad2013@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Adeel', 'Sajjad', NULL, 'active', 1595964854, 'website', NULL, 'No', '1576205741', 'OU1pUGxhbmlUaGUgcXVpY2sgYnJvd24gZm94IGp1bXBzIG92ZXIgdGhlIGxhenkgZG9nMTU5NTk2NDg1NA==', 'Free', NULL, NULL, NULL, 'free'),
(10, 'priyanyma', 'nymapriya@gmail.com', 'a9c95f8e52b46d0bf04f82be5e91caf7', 'NYMA', 'PRIYA', NULL, 'active', 1596040449, 'website', NULL, 'No', '300776302', 'MTBNaVBsYW5pVGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZzE1OTYwNDA0NDk=', 'Free', NULL, NULL, NULL, 'free'),
(11, 'WEBBB', 'discountyclub@gmail.com', '15cfda429ed71c396639d6e87fa05b51', 'ANITA', 'ANITA', NULL, 'active', 1596216728, 'website', NULL, 'No', '543164387', 'MTFNaVBsYW5pVGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZzE1OTYyMTY3Mjg=', 'Free', NULL, NULL, NULL, 'free'),
(12, 'dario', 'darifalbert@gmail.com', '15cfda429ed71c396639d6e87fa05b51', 'dario', 'albert', NULL, 'active', 1596724589, 'website', NULL, 'No', '939930592', 'MTJNaVBsYW5pVGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZzE1OTY3MjQ1ODk=', 'Free', NULL, NULL, NULL, 'free'),
(13, 'Nick', 'nickkurat017@gmail.com', '0192023a7bbd73250516f069df18b500', 'Nick', 'Kurat', 'https://lh3.googleusercontent.com/a-/AOh14GhG8n7j8r8unq8-GvlJX2nOlqBzQBynhhVnuPUB', 'active', 1596775651, 'gmail', '104632705808121729913', 'Yes', '', '', 'Free', 0, 0, 0, 'free'),
(14, 'scarletjohanson', 'scarlettjohansson124@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'scarlet', 'johanson', NULL, 'active', 1596794666, 'website', NULL, 'No', '1261588232', 'MTRNaVBsYW5pVGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZzE1OTY3OTQ2NjY=', 'Free', NULL, NULL, NULL, 'free'),
(15, 'jeffbosken', 'zoey1@gocharli.com', '25d55ad283aa400af464c76d713c07ad', 'jeff', 'bosken', NULL, 'active', 1596797111, 'website', NULL, 'No', '1964591402', 'MTVNaVBsYW5pVGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZzE1OTY3OTcxMTE=', 'monthly', 2, 1596798727, 0, 'active'),
(16, 'zoey2gocharli', 'zoey2@gocharli.com', '25d55ad283aa400af464c76d713c07ad', 'zoey2', 'Gocharli', NULL, 'pending', 1596803358, 'website', NULL, 'No', '964859011', 'MTZNaVBsYW5pVGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZzE1OTY4MDMzNTg=', 'Free', NULL, NULL, NULL, 'free'),
(17, 'emma.red', 'emma.red987@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'emma', 'red', NULL, 'pending', 1596804382, 'website', NULL, 'No', '2119251381', 'MTdNaVBsYW5pVGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZzE1OTY4MDQzODI=', 'Free', NULL, NULL, NULL, 'free'),
(18, 'zoey3gocharli', 'zoey3@gocharli.com', '25d55ad283aa400af464c76d713c07ad', 'zoey3', 'gocharli', NULL, 'pending', 1596804637, 'website', NULL, 'No', '488907647', 'MThNaVBsYW5pVGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZzE1OTY4MDQ2Mzc=', 'Free', NULL, NULL, NULL, 'free'),
(19, 'zoeyamanda123@gmail.com', 'zoeyamanda123@gmail.com', NULL, 'Zoey Amanda', NULL, 'https://lh6.googleusercontent.com/-26iWmAhgYiQ/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuck2dO0mjFN0AArpKHulDuDlIQ0R-w/photo.jpg', 'active', NULL, 'gmail', '116810027303303651220', 'Yes', NULL, NULL, 'Free', NULL, NULL, NULL, 'free'),
(20, 'amandamark', 'zoey5@gocharli.com', '25d55ad283aa400af464c76d713c07ad', 'amanda', 'mark', NULL, 'pending', 1597385196, 'website', NULL, 'Yes', '', '', 'Free', NULL, NULL, NULL, 'free'),
(21, 'jm-nh', 'james.noah1172@gmail.com', 'b4af804009cb036a4ccdc33431ef9ac9', 'jM', 'NH', NULL, 'active', 1597388507, 'website', NULL, 'Yes', '', '', 'Free', NULL, NULL, NULL, 'free'),
(22, 'eric', 'ericshowell388@gmail.com', 'b4af804009cb036a4ccdc33431ef9ac9', 'Eric', 'Showell', NULL, 'active', 1597389858, 'website', NULL, 'Yes', '', '', 'Free', NULL, NULL, NULL, 'free'),
(23, 'vivthoussi@gmail.com', 'vivthoussi@gmail.com', NULL, 'Viviane K.', NULL, 'https://lh5.googleusercontent.com/-PGmhmCOMtoE/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuckGX5_OoNdLkvB-ydBAbzNjTTFueA/photo.jpg', 'active', NULL, 'gmail', '113260370275841648860', 'Yes', NULL, NULL, 'Free', NULL, NULL, NULL, 'free'),
(24, 'micheal_clark', 'zoey4@gocharli.com', '25d55ad283aa400af464c76d713c07ad', 'micheal', 'clark', NULL, 'active', 1597641258, 'website', NULL, 'Yes', '', '', 'Free', NULL, NULL, NULL, 'free'),
(25, 'nileshkvyas04@gmail.com', 'nileshkvyas0412@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'nilesh', 'vyas', NULL, 'pending', 1597726163, 'website', NULL, 'No', '1872494105', 'MjVNaVBsYW5pVGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZzE1OTc3MjYxNjM=', 'Free', NULL, NULL, NULL, 'free'),
(26, 'hiralgodani@gmail.com', 'hiralgodani@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'nilesh', 'vyas', NULL, 'active', 1597730410, 'website', NULL, 'Yes', '', '', 'Free', NULL, NULL, NULL, 'free'),
(27, 'nymapriya', 'nymapriya1@gmail.com', 'a9c95f8e52b46d0bf04f82be5e91caf7', 'Nyma', 'Priya', NULL, 'active', 1597764289, 'website', NULL, 'Yes', '', '', 'Free', NULL, NULL, NULL, 'free'),
(28, 'vivianekomze@gmail.com', 'vivianekomze@gmail.com', NULL, 'Viviane', 'KOMZE', 'https://lh3.googleusercontent.com/a-/AOh14Ggur99fDn3HySfkHcDQWA60DNfcwouSO4o2X2VTxw', 'active', NULL, 'gmail', '109292859620727425690', 'Yes', NULL, NULL, 'Free', NULL, NULL, NULL, 'free'),
(29, 'parkerrosan001@gmail.com', 'parkerrosan001@gmail.com', NULL, 'Parker Rosan', NULL, 'https://lh4.googleusercontent.com/-pVSjXSMXLYo/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucn07Y_dULSASI3cyEVROUd7OjSX0Q/photo.jpg', 'active', NULL, 'gmail', '115724146772751207764', 'Yes', NULL, NULL, 'Free', NULL, NULL, NULL, 'free'),
(31, '31', '', '25d55ad283aa400af464c76d713c07ad', '', '', '', 'active', 1603109563, 'website', '', 'Yes', NULL, NULL, 'Free', NULL, NULL, NULL, 'free'),
(70, 'Aaron Smith', 'aaron.smith2981@gmail.com', 'Null', 'Aaron', 'Smith', NULL, 'active', 1603288387, 'gmail', '100847547701401909505', 'Yes', NULL, NULL, 'Free', NULL, NULL, NULL, 'free'),
(76, 'Iqrar Bangash', 'b.iqrar15@gmail.com', 'Null', 'Iqrar', 'Bangash', NULL, 'active', 1603373567, 'linkedin', 'erMDndtJ8T', 'Yes', NULL, NULL, 'Free', NULL, NULL, NULL, 'free');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_reset_password`
--

CREATE TABLE `tbl_users_reset_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` enum('admin user','user') DEFAULT 'user',
  `reset_access_token` varchar(50) NOT NULL,
  `add_timestamp` int(11) NOT NULL,
  `expiry_timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_coupon_statistics`
--

CREATE TABLE `tbl_user_coupon_statistics` (
  `stat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `apply_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_payments`
--

CREATE TABLE `tbl_user_payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `plan_type` enum('free','monthly','annual','life time') DEFAULT 'free',
  `plan_price` double DEFAULT NULL,
  `user_paid_amount` double DEFAULT NULL,
  `promo_code` varchar(255) DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `payment_start_date` int(11) DEFAULT NULL,
  `payment_expiry_date` int(11) DEFAULT NULL,
  `payment_date` int(11) DEFAULT NULL,
  `payment_status` enum('active','expired','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_payments`
--

INSERT INTO `tbl_user_payments` (`payment_id`, `user_id`, `plan_id`, `plan_type`, `plan_price`, `user_paid_amount`, `promo_code`, `discount_amount`, `payment_start_date`, `payment_expiry_date`, `payment_date`, `payment_status`) VALUES
(1, 2, 2, 'monthly', 19.97, 19.97, '', 0, 1595570577, 1598306399, 1595570577, 'inactive'),
(2, 1, 2, 'monthly', 19.97, 19.97, '', 0, 1595584713, 1598306399, 1595584713, 'inactive'),
(3, NULL, 2, 'monthly', 19.97, 19.97, '', 0, 1595686146, 1598392799, 1595686146, 'active'),
(4, NULL, 3, 'annual', 191.64, 191.64, '', 0, 1596218448, 1627768799, 1596218448, ''),
(5, NULL, 3, 'annual', 191.64, 191.64, '', 0, 1596220625, 1627768799, 1596220625, ''),
(6, 15, 2, 'monthly', 19.97, 19.97, '', 0, 1596798727, 1599515999, 1596798727, ''),
(7, 13, 3, 'annual', 191.64, 191.64, '', 0, 1603880055, 1635458399, 1603880055, 'inactive'),
(8, 13, 2, 'monthly', 19.97, 19.97, '', 0, 1603881858, 1606604399, 1603881858, 'inactive'),
(9, 13, 3, 'annual', 191.64, 191.64, '', 0, 1603886305, 1635458399, 1603886305, 'inactive'),
(10, 13, 2, 'monthly', 19.97, 19.97, '', 0, 1603950488, 1606690799, 1603950488, 'inactive'),
(11, 13, 2, 'monthly', 19.97, 19.97, '', 0, 1603971046, 1606690799, 1603971046, 'inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_coupons`
--
ALTER TABLE `tbl_coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `tbl_dream_projections`
--
ALTER TABLE `tbl_dream_projections`
  ADD PRIMARY KEY (`projection_id`);

--
-- Indexes for table `tbl_invite_projection_friends`
--
ALTER TABLE `tbl_invite_projection_friends`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `tbl_main_projections`
--
ALTER TABLE `tbl_main_projections`
  ADD PRIMARY KEY (`projection_id`);

--
-- Indexes for table `tbl_newsletter_subscriptions`
--
ALTER TABLE `tbl_newsletter_subscriptions`
  ADD PRIMARY KEY (`sub_news_id`);

--
-- Indexes for table `tbl_pricing_plans`
--
ALTER TABLE `tbl_pricing_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `tbl_projections`
--
ALTER TABLE `tbl_projections`
  ADD PRIMARY KEY (`projection_id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_system_users`
--
ALTER TABLE `tbl_system_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_users_reset_password`
--
ALTER TABLE `tbl_users_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_coupon_statistics`
--
ALTER TABLE `tbl_user_coupon_statistics`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `tbl_user_payments`
--
ALTER TABLE `tbl_user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_coupons`
--
ALTER TABLE `tbl_coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_dream_projections`
--
ALTER TABLE `tbl_dream_projections`
  MODIFY `projection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_invite_projection_friends`
--
ALTER TABLE `tbl_invite_projection_friends`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_main_projections`
--
ALTER TABLE `tbl_main_projections`
  MODIFY `projection_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_newsletter_subscriptions`
--
ALTER TABLE `tbl_newsletter_subscriptions`
  MODIFY `sub_news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pricing_plans`
--
ALTER TABLE `tbl_pricing_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_projections`
--
ALTER TABLE `tbl_projections`
  MODIFY `projection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_system_users`
--
ALTER TABLE `tbl_system_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tbl_users_reset_password`
--
ALTER TABLE `tbl_users_reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_coupon_statistics`
--
ALTER TABLE `tbl_user_coupon_statistics`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_payments`
--
ALTER TABLE `tbl_user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
