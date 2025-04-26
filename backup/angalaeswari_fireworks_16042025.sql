-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 05:02 PM
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
-- Database: `angalaeswari_fireworks_16042025`
--

-- --------------------------------------------------------

--
-- Table structure for table `af_agent`
--

CREATE TABLE `af_agent` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `agent_details` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `commission` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_agent`
--

INSERT INTO `af_agent` (`id`, `created_date_time`, `creator`, `creator_name`, `agent_id`, `agent_name`, `lower_case_name`, `email`, `address`, `city`, `district`, `state`, `pincode`, `identification`, `mobile_number`, `others_city`, `agent_details`, `name_mobile_city`, `commission`, `deleted`) VALUES
(1, '2025-01-10 12:27:01', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d6a49334d4446664d44453d', '546d6c795957743162474675', '626d6c795957743162474675', 'NULL', 'NULL', '56484a706348567959513d3d', '546d39796447676756484a706348567959513d3d', '56484a706348567959513d3d', 'NULL', 'NULL', '4e6a4d344f5449354e4463344d773d3d', 'Tripura', '546d6c79595774316247467550474a79506c527961584231636d4538596e492b546d39796447676756484a706348567959547869636a3555636d6c7764584a6850474a795069424e62324a70624755674f6941324d7a67354d6a6b304e7a677a', '546d6c795957743162474675494367324d7a67354d6a6b304e7a677a4b5341744946527961584231636d453d', '10%', 0),
(2, '2025-01-10 13:17:11', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55774d5445334d5446664d44493d', '566d6c756233526f', '646d6c756233526f', 'NULL', 'NULL', 'NULL', 'NULL', '5647467461577767546d466b64513d3d', 'NULL', 'NULL', '4e7a4d344f5449354d7a67304e773d3d', '', '566d6c756233526f50474a79506c526862576c73494535685a485538596e492b49453176596d6c735a5341364944637a4f446b794f544d344e44633d', '566d6c756233526f494367334d7a67354d6a6b7a4f4451334b513d3d', '10%', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_bank_account`
--

CREATE TABLE `af_bank_account` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `account_name` mediumtext NOT NULL,
  `account_number` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `ifsc_code` mediumtext NOT NULL,
  `account_type` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `bank_name_account_number` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_bank_account`
--

INSERT INTO `af_bank_account` (`id`, `created_date_time`, `creator`, `creator_name`, `account_name`, `account_number`, `bank_name`, `ifsc_code`, `account_type`, `bank_id`, `lower_case_name`, `bank_name_account_number`, `payment_mode_id`, `deleted`) VALUES
(1, '2025-01-10 12:16:17', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '536b4a5349455a70636d563362334a7263773d3d', '4d4441774e4441314d4441334f446b35', '5645314349454a755957733d', '53554e4a517a41774d4441774d44513d', '51335679636d56756443426859324d3d', '4d5441774d5449774d6a55784d6a45324d5464664d44453d', '', '5645314349454a75595773674b4441774d4451774e5441774e7a67354f536b3d', '4d5441774d5449774d6a55784d6a45314d6a42664d44453d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_category`
--

CREATE TABLE `af_category` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `category_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_category`
--

INSERT INTO `af_category` (`id`, `created_date_time`, `creator`, `creator_name`, `category_id`, `name`, `lower_case_name`, `deleted`) VALUES
(1, '2024-12-10 13:19:18', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d5468664d44453d', '526d6c7561584e6f5a57513d', '5a6d6c7561584e6f5a57513d', 0),
(2, '2024-12-10 13:19:33', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d7a4e664d44493d', '5532567461534247615735706332686c5a413d3d', '633256746153426d615735706332686c5a413d3d', 0),
(3, '2024-12-10 13:19:44', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354e4452664d444d3d', '556d4633494531686447567961574673', '636d4633494731686447567961574673', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_consumption_entry`
--

CREATE TABLE `af_consumption_entry` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `consumption_entry_id` mediumtext NOT NULL,
  `consumption_entry_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `bill_date` date NOT NULL,
  `party_type` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name_city` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name_city` mediumtext NOT NULL,
  `godown_details` mediumtext NOT NULL,
  `contractor_id` mediumtext NOT NULL,
  `contractor_name_mobile_city` mediumtext NOT NULL,
  `contractor_details` mediumtext NOT NULL,
  `outsourceparty_id` mediumtext NOT NULL,
  `outsourceparty_name_mobile_city` mediumtext NOT NULL,
  `outsourceparty_details` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_contractor`
--

CREATE TABLE `af_contractor` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `contractor_id` mediumtext NOT NULL,
  `contractor_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `contractor_details` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `cooly` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_contractor`
--

INSERT INTO `af_contractor` (`id`, `created_date_time`, `creator`, `creator_name`, `contractor_id`, `contractor_name`, `lower_case_name`, `address`, `city`, `district`, `state`, `pincode`, `mobile_number`, `others_city`, `contractor_details`, `opening_balance`, `opening_balance_type`, `name_mobile_city`, `product_id`, `product_name`, `unit_id`, `unit_name`, `cooly`, `identification`, `email`, `deleted`) VALUES
(1, '2025-01-29 14:16:30', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d6a6b774d5449774d6a55774d6a45324d7a42664d44453d', '546d46325a575675', '626d46325a575675', 'NULL', 'NULL', 'NULL', '5647467461577767546d466b64513d3d', 'NULL', '4f546b344f5467354f446b344f513d3d', '', '546d46325a57567550474a79506c526862576c73494535685a485538596e492b49453176596d6c735a53413649446b354f446b344f5467354f446b3d', '', '', '546d46325a575675494367354f5467354f446b344f5467354b513d3d', '4d6a6b774d5449774d6a55774d6a45314d4456664d44593d', '5269395149454a4a52773d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '200', 'NULL', 'NULL', 0),
(2, '2025-04-12 13:27:05', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55774d5449334d4456664d44493d', '546d6c79595746726457786862673d3d', '626d6c79595746726457786862673d3d', 'NULL', 'NULL', 'NULL', '5647467461577767546d466b64513d3d', 'NULL', '4f5467344e6a51334e4467314e413d3d', '', '546d6c795957467264577868626a7869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941354f4467324e4463304f445530', '100', 'Debit', '546d6c7959574672645778686269416f4f5467344e6a51334e4467314e436b3d', '4d5449774e4449774d6a55784d5449354e4446664d54493d', '516e56736247563049454a766257493d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '200', 'NULL', 'NULL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_customer`
--

CREATE TABLE `af_customer` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `customer_id` mediumtext NOT NULL,
  `customer_type` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name` mediumtext NOT NULL,
  `customer_details` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_customer`
--

INSERT INTO `af_customer` (`id`, `created_date_time`, `creator`, `creator_name`, `customer_id`, `customer_type`, `name`, `lower_case_name`, `email`, `address`, `city`, `district`, `state`, `pincode`, `identification`, `mobile_number`, `others_city`, `agent_id`, `agent_name`, `customer_details`, `opening_balance`, `opening_balance_type`, `name_mobile_city`, `deleted`) VALUES
(1, '2025-03-17 09:40:31', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5463774d7a49774d6a55774f5451774d7a46664d44453d', '2', '5457466f5a584e6f', '6257466f5a584e6f', 'NULL', 'NULL', '515735686157316862474670', '5132397062574a68644739795a513d3d', '5647467461577767546d466b64513d3d', 'NULL', 'NULL', '4e7a6b344e7a6b344f446b354f413d3d', '', '', '', '5457466f5a584e6f50474a79506b467559576c745957786861547869636a354462326c74596d463062334a6c4b455270633351754b547869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941334f5467334f5467344f546b34', '', '', '5457466f5a584e6f494367334f5467334f5467344f546b344b5341744945467559576c745957786861513d3d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_daily_production`
--

CREATE TABLE `af_daily_production` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `daily_production_id` mediumtext NOT NULL,
  `daily_production_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `bill_date` date NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name_city` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `magazine_name_city` mediumtext NOT NULL,
  `magazine_details` mediumtext NOT NULL,
  `contractor_id` mediumtext NOT NULL,
  `contractor_name_mobile_city` mediumtext NOT NULL,
  `contractor_details` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `cooly_per_qty` mediumtext NOT NULL,
  `total_cooly` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_estimate`
--

CREATE TABLE `af_estimate` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `estimate_id` mediumtext NOT NULL,
  `estimate_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name_mobile_city` mediumtext NOT NULL,
  `agent_details` mediumtext NOT NULL,
  `customer_id` mediumtext NOT NULL,
  `customer_name_mobile_city` mediumtext NOT NULL,
  `customer_details` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name_account_number` mediumtext NOT NULL,
  `gst_option` int(100) NOT NULL,
  `company_state` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `case_value` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `per` mediumtext NOT NULL,
  `per_type` mediumtext NOT NULL,
  `rate_per_qty` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `discount` mediumtext NOT NULL,
  `discount_value` mediumtext NOT NULL,
  `discounted_total` mediumtext NOT NULL,
  `delivery_charges` mediumtext NOT NULL,
  `delivery_charges_value` mediumtext NOT NULL,
  `delivery_charges_total` mediumtext NOT NULL,
  `loading_charges` mediumtext NOT NULL,
  `loading_charges_value` mediumtext NOT NULL,
  `loading_charges_total` mediumtext NOT NULL,
  `taxable_charges` mediumtext NOT NULL,
  `taxable_charges_value` mediumtext NOT NULL,
  `taxable_charges_total` mediumtext NOT NULL,
  `cgst_value` mediumtext NOT NULL,
  `sgst_value` mediumtext NOT NULL,
  `igst_value` mediumtext NOT NULL,
  `total_tax_value` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `total_cases` mediumtext NOT NULL,
  `commission` mediumtext NOT NULL,
  `commission_value` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_expense`
--

CREATE TABLE `af_expense` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `expense_id` mediumtext NOT NULL,
  `expense_number` mediumtext NOT NULL,
  `expense_date` date NOT NULL,
  `expense_category_id` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_expense_category`
--

CREATE TABLE `af_expense_category` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `expense_category_id` mediumtext NOT NULL,
  `expense_category_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_factory`
--

CREATE TABLE `af_factory` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `incharge_name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `name_city` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_factory`
--

INSERT INTO `af_factory` (`id`, `created_date_time`, `creator`, `creator_name`, `factory_id`, `factory_name`, `lower_case_name`, `state`, `district`, `city`, `incharge_name`, `mobile_number`, `user_id`, `password`, `name_city`, `factory_details`, `deleted`) VALUES
(1, '2025-01-10 11:58:09', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d5455344d446c664d44453d', '526d466a6447397965534242', '5a6d466a6447397965534268', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '5532463064485679', '523246755a584e6f', '4f5467334e6a55304d7a49784e413d3d', '526d466a644739796557453d', '526d466a64473979655745784d6a4e41', '526d466a6447397965534242494330675532463064485679', '526d466a644739796553424250474a79506c4e6864485231636a7869636a355761584a315a476831626d466e5958496f52476c7a6443347050474a79506c526862576c73494535685a485538596e492b5357356a614746795a3255674c5342485957356c633267674b446b344e7a59314e444d794d545170', 0),
(2, '2025-01-10 11:59:06', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d5455354d445a664d44493d', '526d466a6447397965534243', '5a6d466a6447397965534269', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', '5533567961586c68', '4f5467334e6a55304d7a49784e773d3d', '526d466a644739796557493d', '526d466a64473979655749784d6a4e41', '526d466a64473979655342434943306755326c325957746863326b3d', '526d466a644739796553424350474a79506c4e70646d467259584e7050474a79506c5a70636e566b61485675595764686369684561584e304c696b38596e492b5647467461577767546d466b64547869636a354a626d4e6f59584a6e5a53417449464e31636d6c355953416f4f5467334e6a55304d7a49784e796b3d', 0),
(3, '2025-01-10 12:00:33', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d', '526d466a6447397965534244', '5a6d466a644739796553426a', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', '553246755a47687663773d3d', '4f446b334e6a55304d7a49784e673d3d', '526d466a6447397965574d3d', '526d466a6447397965574d784d6a4e41', '526d466a64473979655342444943306755326c325957746863326b3d', '526d466a644739796553424450474a79506c4e70646d467259584e7050474a79506c5a70636e566b61485675595764686369684561584e304c696b38596e492b5647467461577767546d466b64547869636a354a626d4e6f59584a6e5a53417449464e68626d526f62334d674b4467354e7a59314e444d794d545970', 0),
(4, '2025-04-12 10:14:23', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55784d4445304d6a4e664d44513d', '526d466a644739796553417452413d3d', '5a6d466a64473979655341745a413d3d', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', '556d4671', '4f5451344f4455334e4467314f413d3d', '55334a706332396d64486468636d5636556d4671', '55334a706332396d64486468636d5636556d4671514445794d773d3d', '526d466a64473979655341745243417449464e70646d467259584e70', '526d466a644739796553417452447869636a355461585a686132467a61547869636a355761584a315a476831626d466e5958496f52476c7a6443347050474a79506c526862576c73494535685a485538596e492b5357356a614746795a3255674c53425359576f674b446b304f4467314e7a51344e546770', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_godown`
--

CREATE TABLE `af_godown` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `contact_person` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `name_city` mediumtext NOT NULL,
  `godown_details` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_godown`
--

INSERT INTO `af_godown` (`id`, `created_date_time`, `creator`, `creator_name`, `godown_id`, `godown_name`, `lower_case_name`, `state`, `district`, `city`, `contact_person`, `mobile_number`, `user_id`, `password`, `name_city`, `godown_details`, `factory_id`, `deleted`) VALUES
(1, '2025-01-10 11:58:09', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d5455344d446c664d44453d', '526d466a6447397965534242', '5a6d466a6447397965534268', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '5532463064485679', '523246755a584e6f', '4f5467334e6a55304d7a49784e413d3d', '526d466a644739796557453d', '526d466a64473979655745784d6a4e41', '526d466a6447397965534242494330675532463064485679', '526d466a644739796553424250474a79506c4e6864485231636a7869636a355761584a315a476831626d466e5958496f52476c7a6443347050474a79506c526862576c73494535685a485538596e492b5357356a614746795a3255674c5342485957356c633267674b446b344e7a59314e444d794d545170', '4d5441774d5449774d6a55784d5455344d446c664d44453d', 0),
(2, '2025-01-10 11:59:06', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d5455354d445a664d44493d', '526d466a6447397965534243', '5a6d466a6447397965534269', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', '5533567961586c68', '4f5467334e6a55304d7a49784e773d3d', '526d466a644739796557493d', '526d466a64473979655749784d6a4e41', '526d466a64473979655342434943306755326c325957746863326b3d', '526d466a644739796553424350474a79506c4e70646d467259584e7050474a79506c5a70636e566b61485675595764686369684561584e304c696b38596e492b5647467461577767546d466b64547869636a354a626d4e6f59584a6e5a53417449464e31636d6c355953416f4f5467334e6a55304d7a49784e796b3d', '4d5441774d5449774d6a55784d5455354d445a664d44493d', 0),
(3, '2025-01-10 12:00:33', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d', '526d466a6447397965534244', '5a6d466a644739796553426a', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', '553246755a47687663773d3d', '4f446b334e6a55304d7a49784e673d3d', '526d466a6447397965574d3d', '526d466a6447397965574d784d6a4e41', '526d466a64473979655342444943306755326c325957746863326b3d', '526d466a644739796553424450474a79506c4e70646d467259584e7050474a79506c5a70636e566b61485675595764686369684561584e304c696b38596e492b5647467461577767546d466b64547869636a354a626d4e6f59584a6e5a53417449464e68626d526f62334d674b4467354e7a59314e444d794d545970', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d', 0),
(4, '2025-01-10 15:34:57', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55774d7a4d304e5464664d44513d', '5457467062694248623252766432343d', '625746706269426e623252766432343d', '5647467461577767546d466b64513d3d', 'NULL', 'NULL', '566d6c6a61336b3d', '4e7a67304f4463304e4459324e413d3d', '5232396b62336475', '5232396b623364754d54497a51413d3d', '5457467062694248623252766432343d', '54574670626942486232527664323438596e492b5647467461577767546d466b64547869636a354a626d4e6f59584a6e5a53417449465a7059327435494367334f4451344e7a51304e6a59304b513d3d', 'NULL', 0),
(5, '2025-04-12 10:14:23', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55784d4445304d6a4e664d44553d', '526d466a644739796553417452413d3d', '5a6d466a64473979655341745a413d3d', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', '556d4671', '4f5451344f4455334e4467314f413d3d', '55334a706332396d64486468636d5636556d4671', '55334a706332396d64486468636d5636556d4671514445794d773d3d', '526d466a64473979655341745243417449464e70646d467259584e70', '526d466a644739796553417452447869636a355461585a686132467a61547869636a355761584a315a476831626d466e5958496f52476c7a6443347050474a79506c526862576c73494535685a485538596e492b5357356a614746795a3255674c53425359576f674b446b304f4467314e7a51344e546770', '4d5449774e4449774d6a55784d4445304d6a4e664d44513d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_group`
--

CREATE TABLE `af_group` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_group`
--

INSERT INTO `af_group` (`id`, `created_date_time`, `creator`, `creator_name`, `group_id`, `name`, `lower_case_name`, `deleted`) VALUES
(1, '2025-04-12 10:52:32', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55784d4455794d7a4e664d44453d', '526d6c7561584e6f5a57513d', '5a6d6c7561584e6f5a57513d', 0),
(2, '2025-04-12 10:52:47', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55784d4455794e4464664d44493d', '5532567461534247615735706332686c5a413d3d', '633256746153426d615735706332686c5a413d3d', 0),
(3, '2025-04-12 10:53:02', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55784d44557a4d444a664d444d3d', '556d4633494531686447567961574673', '636d4633494731686447567961574673', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_inward_entry`
--

CREATE TABLE `af_inward_entry` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `inward_entry_id` mediumtext NOT NULL,
  `inward_entry_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `bill_number` mediumtext NOT NULL,
  `bill_date` date NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name_city` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name_city` mediumtext NOT NULL,
  `godown_details` mediumtext NOT NULL,
  `supplier_id` mediumtext NOT NULL,
  `supplier_name_mobile_city` mediumtext NOT NULL,
  `supplier_details` mediumtext NOT NULL,
  `vehicle_details` mediumtext NOT NULL,
  `gst_option` int(100) NOT NULL,
  `tax_type` int(100) NOT NULL,
  `tax_option` int(100) NOT NULL,
  `overall_tax` mediumtext NOT NULL,
  `company_state` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `price` mediumtext NOT NULL,
  `final_price` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `discount` mediumtext NOT NULL,
  `discount_value` mediumtext NOT NULL,
  `discounted_total` mediumtext NOT NULL,
  `delivery_charges` mediumtext NOT NULL,
  `delivery_charges_value` mediumtext NOT NULL,
  `delivery_charges_total` mediumtext NOT NULL,
  `loading_charges` mediumtext NOT NULL,
  `loading_charges_value` mediumtext NOT NULL,
  `loading_charges_total` mediumtext NOT NULL,
  `cgst_value` mediumtext NOT NULL,
  `sgst_value` mediumtext NOT NULL,
  `igst_value` mediumtext NOT NULL,
  `total_tax_value` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_inward_entry`
--

INSERT INTO `af_inward_entry` (`id`, `created_date_time`, `creator`, `creator_name`, `inward_entry_id`, `inward_entry_number`, `entry_date`, `bill_number`, `bill_date`, `factory_id`, `factory_name_city`, `factory_details`, `godown_id`, `godown_name_city`, `godown_details`, `supplier_id`, `supplier_name_mobile_city`, `supplier_details`, `vehicle_details`, `gst_option`, `tax_type`, `tax_option`, `overall_tax`, `company_state`, `party_state`, `product_id`, `product_name`, `unit_id`, `unit_name`, `quantity`, `price`, `final_price`, `product_tax`, `product_amount`, `sub_total`, `discount`, `discount_value`, `discounted_total`, `delivery_charges`, `delivery_charges_value`, `delivery_charges_total`, `loading_charges`, `loading_charges_value`, `loading_charges_total`, `cgst_value`, `sgst_value`, `igst_value`, `total_tax_value`, `round_off`, `total_amount`, `total_quantity`, `cancelled`, `deleted`) VALUES
(1, '2025-03-05 15:41:27', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d4455774d7a49774d6a55774d7a51784d6a68664d44453d', 'INW001/24-25', '2025-03-05', '4e7a59334f413d3d', '2025-03-05', 'NULL', 'NULL', 'NULL', '4d5441774d5449774d6a55774d7a4d304e5464664d44513d', '5457467062694248623252766432343d', '54574670626942486232527664323438596e492b5647467461577767546d466b64547869636a354a626d4e6f59584a6e5a53417449465a7059327435494367334f4451344e7a51304e6a59304b513d3d', '4d5441774d5449774d6a55774d7a4d324d7a56664d44493d', '6257463061476b6764484a685a4756796379416f4e7a51344f4451334e6a4d794e796b3d', '6257463061476b6764484a685a475679637a7869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941334e4467344e4463324d7a4933', 'NULL', 2, 0, 0, 'NULL', '5647467461577767546d466b64513d3d', '5647467461577767546d466b64513d3d', '4d7a45774d5449774d6a55784d5441314e5452664d446b3d', '546d5633', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '19', '29', '29', 'NULL', '551.00', '551', 'NULL', '0', '551', 'NULL', '0', '551', 'NULL', '0', '551', '0', '0', '0', '0', '0', '551.00', '19', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_login`
--

CREATE TABLE `af_login` (
  `id` int(100) NOT NULL,
  `loginer_name` mediumtext NOT NULL,
  `login_date_time` datetime NOT NULL,
  `logout_date_time` datetime NOT NULL,
  `ip_address` mediumtext NOT NULL,
  `browser` mediumtext NOT NULL,
  `os_detail` mediumtext NOT NULL,
  `type` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_login`
--

INSERT INTO `af_login` (`id`, `loginer_name`, `login_date_time`, `logout_date_time`, `ip_address`, `browser`, `os_detail`, `type`, `user_id`, `deleted`) VALUES
(1, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 11:53:46', '2025-01-10 11:53:46', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(2, '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '2025-01-10 12:29:08', '2025-01-10 12:29:08', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', 0),
(3, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 12:30:41', '2025-01-10 12:30:41', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(4, '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '2025-01-10 12:33:21', '2025-01-10 12:33:21', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', 0),
(5, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 12:39:26', '2025-01-10 12:39:26', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(6, '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '2025-01-10 12:40:24', '2025-01-10 12:40:24', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', 0),
(7, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 12:51:24', '2025-01-10 12:51:24', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(8, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 12:52:17', '2025-01-10 12:52:17', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(9, '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '2025-01-10 12:52:38', '2025-01-10 12:52:38', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', 0),
(10, '5533567961586c68494367354f4463324e54517a4d6a45334b513d3d', '2025-01-10 13:07:06', '2025-01-10 13:07:06', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455354d445a664d7a633d', 0),
(11, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 13:12:04', '2025-01-10 13:12:04', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(12, '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '2025-01-10 13:48:50', '2025-01-10 13:48:50', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', 0),
(13, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 13:49:46', '2025-01-10 13:49:46', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(14, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 14:01:25', '2025-01-10 14:01:25', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(15, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 15:33:18', '2025-01-10 15:33:18', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(16, '566d6c6a61336b674b4463344e4467334e4451324e6a5170', '2025-01-10 15:36:08', '2025-01-10 15:36:08', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Godown Staff', '4d5441774d5449774d6a55774d7a4d304e5464664d7a6b3d', 0),
(17, '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '2025-01-10 15:38:52', '2025-01-10 15:38:52', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', 0),
(18, '566d6c6a61336b674b4463344e4467334e4451324e6a5170', '2025-01-10 15:39:20', '2025-01-10 15:39:20', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Godown Staff', '4d5441774d5449774d6a55774d7a4d304e5464664d7a6b3d', 0),
(19, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 15:46:35', '2025-01-10 15:46:35', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(20, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 15:53:58', '2025-01-10 15:53:58', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(21, '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '2025-01-10 16:29:05', '2025-01-10 16:29:05', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', 0),
(22, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 16:36:46', '2025-01-10 16:36:46', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(23, '566d6c6a61336b674b4463344e4467334e4451324e6a5170', '2025-01-10 16:52:01', '2025-01-10 16:52:01', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Godown Staff', '4d5441774d5449774d6a55774d7a4d304e5464664d7a6b3d', 0),
(24, '566d6c6a61336b674b4463344e4467334e4451324e6a5170', '2025-01-10 16:56:48', '2025-01-10 16:56:48', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Godown Staff', '4d5441774d5449774d6a55774d7a4d304e5464664d7a6b3d', 0),
(25, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 16:59:36', '2025-01-10 16:59:36', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(26, '566d6c6a61336b674b4463344e4467334e4451324e6a5170', '2025-01-10 17:02:33', '2025-01-10 17:02:33', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Godown Staff', '4d5441774d5449774d6a55774d7a4d304e5464664d7a6b3d', 0),
(27, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 17:22:43', '2025-01-10 17:22:43', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(28, '566d6c6a61336b674b4463344e4467334e4451324e6a5170', '2025-01-10 17:23:18', '2025-01-10 17:23:18', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Godown Staff', '4d5441774d5449774d6a55774d7a4d304e5464664d7a6b3d', 0),
(29, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 17:31:08', '2025-01-10 17:31:08', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(30, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 17:45:18', '2025-01-10 17:45:18', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(31, '566d6c6a61336b674b4463344e4467334e4451324e6a5170', '2025-01-10 18:02:36', '2025-01-10 18:02:36', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Godown Staff', '4d5441774d5449774d6a55774d7a4d304e5464664d7a6b3d', 0),
(32, '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '2025-01-10 18:03:19', '2025-01-10 18:03:19', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', 0),
(33, '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '2025-01-10 18:37:58', '2025-01-10 18:37:58', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', 0),
(34, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-10 18:43:26', '2025-01-10 18:43:26', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(35, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-11 10:45:04', '2025-01-11 10:45:04', '103.104.58.164', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Linux sg2plmcpnl486913.prod.sin2.secureserver.net 4.18.0-553.27.1.lve.el8.x86_64 #1 SMP Fri Nov 8 15:09:45 UTC 2024 x86_64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(36, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-22 19:31:32', '2025-01-22 20:07:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(37, '553246755a4768766379416f4f446b334e6a55304d7a49784e696b3d', '2025-01-22 20:07:30', '2025-01-22 20:07:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Factory Staff', '4d5441774d5449774d6a55784d6a41774d7a4e664d7a673d', 0),
(38, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-22 20:23:48', '2025-01-22 20:23:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(39, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-23 15:09:08', '2025-01-23 15:09:08', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(40, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-25 11:50:30', '2025-01-25 11:50:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(41, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-25 12:08:04', '2025-01-25 12:08:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(42, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-27 20:00:42', '2025-01-27 20:00:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(43, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-28 10:06:05', '2025-01-28 10:06:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(44, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-28 17:09:30', '2025-01-28 17:09:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(45, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-28 18:26:20', '2025-01-28 18:26:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(46, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-29 12:59:10', '2025-01-29 12:59:10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(47, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-29 13:42:21', '2025-01-29 13:42:21', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(48, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-29 18:09:14', '2025-01-29 18:09:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(49, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-30 11:23:13', '2025-01-30 11:23:13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(50, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-30 15:35:05', '2025-01-30 15:35:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(51, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-30 15:48:32', '2025-01-30 15:48:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(52, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-30 19:27:53', '2025-01-30 19:27:53', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(53, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-31 10:13:03', '2025-01-31 10:13:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(54, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-31 10:52:02', '2025-01-31 10:52:02', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(55, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-01-31 11:05:15', '2025-01-31 11:05:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(56, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-02-01 10:26:58', '2025-02-01 10:26:58', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(57, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-02-04 18:07:56', '2025-02-04 18:07:56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:134.0) Gecko/20100101 Firefox/134.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(58, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-02-21 15:33:08', '2025-02-21 15:33:08', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(59, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-02-22 12:57:37', '2025-02-22 12:57:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(60, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-02-26 15:20:10', '2025-02-26 15:20:10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(61, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-03-01 18:56:43', '2025-03-01 18:56:43', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(62, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-03-05 15:40:33', '2025-03-05 15:40:33', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(63, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-03-15 12:21:04', '2025-03-15 12:21:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(64, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-03-17 09:39:33', '2025-03-17 09:39:33', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(65, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-03-22 09:52:36', '2025-03-22 09:52:36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(66, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-03-22 14:41:27', '2025-03-22 14:41:27', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(67, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-03-22 14:46:46', '2025-03-22 14:46:46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0', 'Windows NT DESKTOP-CO15G4U 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(68, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-04-12 10:02:01', '2025-04-12 10:02:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'Windows NT DESKTOP-2I9F2HQ 10.0 build 22631 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(69, '556d4671494367354e4467344e5463304f4455344b513d3d', '2025-04-12 10:38:03', '2025-04-12 10:38:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'Windows NT DESKTOP-2I9F2HQ 10.0 build 22631 (Windows 11) AMD64', 'Factory Staff', '4d5449774e4449774d6a55784d4445304d6a4e664e44413d', 0),
(70, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-04-12 10:40:43', '2025-04-12 10:40:43', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'Windows NT DESKTOP-2I9F2HQ 10.0 build 22631 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(71, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-04-12 13:05:23', '2025-04-12 13:05:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'Windows NT DESKTOP-2I9F2HQ 10.0 build 22631 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(72, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-04-16 18:08:52', '2025-04-16 18:08:52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(73, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-04-16 20:30:28', '2025-04-16 20:30:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0),
(74, '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '2025-04-16 20:31:55', '2025-04-16 20:31:55', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:137.0) Gecko/20100101 Firefox/137.0', 'Windows NT LAPTOP-0MSDTOP1 10.0 build 26100 (Windows 11) AMD64', 'Super Admin', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_magazine`
--

CREATE TABLE `af_magazine` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `magazine_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `contact_person` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `name_city` mediumtext NOT NULL,
  `magazine_details` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_magazine`
--

INSERT INTO `af_magazine` (`id`, `created_date_time`, `creator`, `creator_name`, `magazine_id`, `magazine_name`, `lower_case_name`, `state`, `district`, `city`, `contact_person`, `mobile_number`, `user_id`, `password`, `name_city`, `magazine_details`, `factory_id`, `deleted`) VALUES
(1, '2025-01-10 11:58:09', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d5455344d446c664d44453d', '526d466a6447397965534242', '5a6d466a6447397965534268', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '5532463064485679', '523246755a584e6f', '4f5467334e6a55304d7a49784e413d3d', '526d466a644739796557453d', '526d466a64473979655745784d6a4e41', '526d466a6447397965534242494330675532463064485679', '526d466a644739796553424250474a79506c4e6864485231636a7869636a355761584a315a476831626d466e5958496f52476c7a6443347050474a79506c526862576c73494535685a485538596e492b5357356a614746795a3255674c5342485957356c633267674b446b344e7a59314e444d794d545170', '4d5441774d5449774d6a55784d5455344d446c664d44453d', 0),
(2, '2025-01-10 11:59:06', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d5455354d445a664d44493d', '526d466a6447397965534243', '5a6d466a6447397965534269', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', '5533567961586c68', '4f5467334e6a55304d7a49784e773d3d', '526d466a644739796557493d', '526d466a64473979655749784d6a4e41', '526d466a64473979655342434943306755326c325957746863326b3d', '526d466a644739796553424350474a79506c4e70646d467259584e7050474a79506c5a70636e566b61485675595764686369684561584e304c696b38596e492b5647467461577767546d466b64547869636a354a626d4e6f59584a6e5a53417449464e31636d6c355953416f4f5467334e6a55304d7a49784e796b3d', '4d5441774d5449774d6a55784d5455354d445a664d44493d', 0),
(3, '2025-01-10 12:00:33', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d', '526d466a6447397965534244', '5a6d466a644739796553426a', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', '553246755a47687663773d3d', '4f446b334e6a55304d7a49784e673d3d', '526d466a6447397965574d3d', '526d466a6447397965574d784d6a4e41', '526d466a64473979655342444943306755326c325957746863326b3d', '526d466a644739796553424450474a79506c4e70646d467259584e7050474a79506c5a70636e566b61485675595764686369684561584e304c696b38596e492b5647467461577767546d466b64547869636a354a626d4e6f59584a6e5a53417449464e68626d526f62334d674b4467354e7a59314e444d794d545970', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d', 0),
(4, '2025-04-12 10:14:23', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55784d4445304d6a4e664d44513d', '526d466a644739796553417452413d3d', '5a6d466a64473979655341745a413d3d', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', '556d4671', '4f5451344f4455334e4467314f413d3d', '55334a706332396d64486468636d5636556d4671', '55334a706332396d64486468636d5636556d4671514445794d773d3d', '526d466a64473979655341745243417449464e70646d467259584e70', '526d466a644739796553417452447869636a355461585a686132467a61547869636a355761584a315a476831626d466e5958496f52476c7a6443347050474a79506c526862576c73494535685a485538596e492b5357356a614746795a3255674c53425359576f674b446b304f4467314e7a51344e546770', '4d5449774e4449774d6a55784d4445304d6a4e664d44513d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_material_transfer`
--

CREATE TABLE `af_material_transfer` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `material_transfer_id` mediumtext NOT NULL,
  `material_transfer_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `bill_date` date NOT NULL,
  `stock_type` mediumtext NOT NULL,
  `from_location_id` mediumtext NOT NULL,
  `from_location_name_city` mediumtext NOT NULL,
  `from_location_details` mediumtext NOT NULL,
  `from_factory_id` mediumtext NOT NULL,
  `from_factory_name_city` mediumtext NOT NULL,
  `from_factory_details` mediumtext NOT NULL,
  `to_location_id` mediumtext NOT NULL,
  `to_location_name_city` mediumtext NOT NULL,
  `to_location_details` mediumtext NOT NULL,
  `to_factory_id` mediumtext NOT NULL,
  `to_factory_name_city` mediumtext NOT NULL,
  `to_factory_details` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_company`
--

CREATE TABLE `af_company` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `company_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address1` mediumtext NOT NULL,
  `address2` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `company_details` mediumtext NOT NULL,
  `logo` mediumtext NOT NULL,
  `primary_company` int(100) NOT NULL,
  `sms_on_off` int(100) NOT NULL,
  `tax_on_off` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_company`
--

INSERT INTO `af_company` (`id`, `created_date_time`, `creator`, `creator_name`, `company_id`, `name`, `lower_case_name`, `address1`, `address2`, `state`, `district`, `city`, `others_city`, `pincode`, `gst_number`, `mobile_number`, `company_details`, `logo`, `primary_company`, `sms_on_off`, `tax_on_off`, `deleted`) VALUES
(3, '2024-12-09 15:53:15', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d446b784d6a49774d6a51774d7a557a4d5456664d444d3d', '5157356e595778685a584e3359584a7049455a70636d563362334a7263773d3d', '5957356e595778685a584e3359584a7049475a70636d563362334a7263773d3d', '4d6938324e6a5573494563674c53424c4c6c4d7551533553595770685a48567959576b67546d466e595849734945356c5958496753324679645731686269424c62335a7062437767566d6c735957317759585230615342536232466b', '4d6a68306143425464484a6c5a585167516e4a70626d5268646d4675494535685a3246794c43425859586b676447386755326c306148567959577068634856795957303d', '5647467461577767546d466b64513d3d', '566d6c796457526f645735685a324679', '55326c325957746863326b3d', 'NULL', '4e6a49324d546735', '4d6a4a4251554642515441774d4442424d566f31', '4e6a4d344d6a4d7a4d5451774f413d3d', '5157356e595778685a584e3359584a7049455a70636d563362334a72637a7869636a34794c7a59324e5377675279417449457375557935424c6c4a68616d466b64584a686153424f5957646863697767546d56686369424c59584a316257467549457476646d6c734c43425761577868625842686448527049464a7659575138596e492b4d6a68306143425464484a6c5a585167516e4a70626d5268646d4675494535685a3246794c43425859586b676447386755326c3061485679595770686348567959573038596e492b55326c325957746863326b674c5341324d6a59784f446b38596e492b566d6c796457526f645735685a32467950474a79506c526862576c73494535685a485538596e492b545739696157786c49446f324d7a67794d7a4d784e44413450474a79506b64545643424a546941364d6a4a4251554642515441774d4442424d566f31', 'logo_12_04_2025_05_12_37.jpeg', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_outsourceparty`
--

CREATE TABLE `af_outsourceparty` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `outsourceparty_id` mediumtext NOT NULL,
  `outsourceparty_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `outsourceparty_details` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `cooly` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_party_cooly`
--

CREATE TABLE `af_party_cooly` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `contractor_id` mediumtext NOT NULL,
  `contractor_name` mediumtext NOT NULL,
  `outsourceparty_id` mediumtext NOT NULL,
  `outsourceparty_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `rate_per_unit` mediumtext NOT NULL,
  `rate_per_subunit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_party_cooly`
--

INSERT INTO `af_party_cooly` (`id`, `created_date_time`, `creator`, `creator_name`, `contractor_id`, `contractor_name`, `outsourceparty_id`, `outsourceparty_name`, `product_id`, `product_name`, `unit_id`, `unit_name`, `amount`, `rate_per_unit`, `rate_per_subunit`, `deleted`) VALUES
(1, '2025-01-29 14:16:30', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '4d6a6b774d5449774d6a55774d6a45324d7a42664d44453d', '546d46325a575675', 'NULL', 'NULL', '4d6a6b774d5449774d6a55774d6a45314d4456664d44593d', '5269395149454a4a52773d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '200', '200', 'NULL', 0),
(2, '2025-04-12 13:27:05', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '4d5449774e4449774d6a55774d5449334d4456664d44493d', '546d6c79595746726457786862673d3d', 'NULL', 'NULL', '4d5449774e4449774d6a55784d5449354e4446664d54493d', '516e56736247563049454a766257493d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '200', '200', '6.6666666666667', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_payment_mode`
--

CREATE TABLE `af_payment_mode` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `lower_case_number` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_payment_mode`
--

INSERT INTO `af_payment_mode` (`id`, `created_date_time`, `creator`, `creator_name`, `payment_mode_id`, `payment_mode_name`, `lower_case_name`, `lower_case_number`, `deleted`) VALUES
(1, '2025-01-10 12:15:20', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d6a45314d6a42664d44453d', '5233426865513d3d', '5a33426865513d3d', '', 0),
(2, '2025-01-10 12:15:20', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d6a45314d6a42664d44493d', '5132467a61413d3d', '5932467a61413d3d', '', 0),
(3, '2025-04-12 13:04:01', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55774d5441304d4446664d444d3d', '55476876626d567759586b3d', '63476876626d567759586b3d', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_performa_invoice`
--

CREATE TABLE `af_performa_invoice` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `performa_invoice_id` mediumtext NOT NULL,
  `performa_invoice_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name_mobile_city` mediumtext NOT NULL,
  `agent_details` mediumtext NOT NULL,
  `customer_id` mediumtext NOT NULL,
  `customer_name_mobile_city` mediumtext NOT NULL,
  `customer_details` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name_account_number` mediumtext NOT NULL,
  `gst_option` int(100) NOT NULL,
  `company_state` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `case_value` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `per` mediumtext NOT NULL,
  `per_type` mediumtext NOT NULL,
  `rate_per_qty` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `discount` mediumtext NOT NULL,
  `discount_value` mediumtext NOT NULL,
  `discounted_total` mediumtext NOT NULL,
  `delivery_charges` mediumtext NOT NULL,
  `delivery_charges_value` mediumtext NOT NULL,
  `delivery_charges_total` mediumtext NOT NULL,
  `loading_charges` mediumtext NOT NULL,
  `loading_charges_value` mediumtext NOT NULL,
  `loading_charges_total` mediumtext NOT NULL,
  `cgst_value` mediumtext NOT NULL,
  `sgst_value` mediumtext NOT NULL,
  `igst_value` mediumtext NOT NULL,
  `total_tax_value` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `total_cases` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_product`
--

CREATE TABLE `af_product` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `category_id` mediumtext NOT NULL,
  `category_name` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `group_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `subunit_need` mediumtext NOT NULL,
  `subunit_id` mediumtext NOT NULL,
  `subunit_name` mediumtext NOT NULL,
  `subunit_contains` mediumtext NOT NULL,
  `sales_rate` mediumtext NOT NULL,
  `per` mediumtext NOT NULL,
  `per_type` mediumtext NOT NULL,
  `opening_stock` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `unit_type_name` mediumtext NOT NULL,
  `stock_date` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `magazine_name` mediumtext NOT NULL,
  `hsn_code` mediumtext NOT NULL,
  `tax_slab` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_product`
--

INSERT INTO `af_product` (`id`, `created_date_time`, `creator`, `creator_name`, `category_id`, `category_name`, `group_id`, `group_name`, `product_id`, `product_name`, `lower_case_name`, `unit_id`, `unit_name`, `subunit_need`, `subunit_id`, `subunit_name`, `subunit_contains`, `sales_rate`, `per`, `per_type`, `opening_stock`, `unit_type`, `unit_type_name`, `stock_date`, `godown_id`, `godown_name`, `magazine_id`, `magazine_name`, `hsn_code`, `tax_slab`, `deleted`) VALUES
(1, '2025-01-29 14:08:50', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d5468664d44453d', '526d6c7561584e6f5a57513d', '4d5441774d5449774d6a55784d6a417a4d6a4a664d44553d', '526d7876643256794946427664484d3d', '4d6a6b774d5449774d6a55774d6a41344e5442664d44453d', '5269395149454a4a52773d3d', '5a69397749474a705a773d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '3604', '18%', 1),
(2, '2025-01-29 14:08:51', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d5468664d44453d', '526d6c7561584e6f5a57513d', '4d5441774d5449774d6a55784d6a417a4d6a4a664d44553d', '526d7876643256794946427664484d3d', '4d6a6b774d5449774d6a55774d6a41344e5446664d44493d', '5269395149464e5154413d3d', '5a69397749484e7762413d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '3604', '18%', 1),
(3, '2025-01-29 14:13:33', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d5468664d44453d', '526d6c7561584e6f5a57513d', '4d5441774d5449774d6a55784d6a417a4d6a4a664d44553d', '526d7876643256794946427664484d3d', '4d6a6b774d5449774d6a55774d6a457a4d7a4e664d444d3d', '5269395149454a4a52773d3d', '5a69397749474a705a773d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '3604', '18%', 1),
(4, '2025-01-29 14:13:34', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d5468664d44453d', '526d6c7561584e6f5a57513d', '4d5441774d5449774d6a55784d6a417a4d6a4a664d44553d', '526d7876643256794946427664484d3d', '4d6a6b774d5449774d6a55774d6a457a4d7a52664d44513d', '5269395149464e5154413d3d', '5a69397749484e7762413d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '3604', '18%', 1),
(5, '2025-01-29 14:14:59', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d5468664d44453d', '526d6c7561584e6f5a57513d', '4d5441774d5449774d6a55784d6a417a4d6a4a664d44553d', '526d7876643256794946427664484d3d', '4d6a6b774d5449774d6a55774d6a45314d4442664d44553d', '5269395149454a4a52773d3d', '5a69397749474a705a773d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '3604', '18%', 1),
(6, '2025-01-29 14:15:05', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d5468664d44453d', '526d6c7561584e6f5a57513d', '4d5441774d5449774d6a55784d6a417a4d6a4a664d44553d', '526d7876643256794946427664484d3d', '4d6a6b774d5449774d6a55774d6a45314d4456664d44593d', '5269395149454a4a52773d3d', '5a69397749474a705a773d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '3604', '18%', 0),
(7, '2025-01-29 14:16:56', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d5468664d44453d', '526d6c7561584e6f5a57513d', '4d5441774d5449774d6a55784d6a417a4d6a4a664d44553d', '526d7876643256794946427664484d3d', '4d6a6b774d5449774d6a55774d6a45324e545a664d44633d', '526939514945314652456c5654513d3d', '5a6939774947316c5a476c3162513d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '3604', '18%', 0),
(8, '2025-01-29 14:16:56', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354d5468664d44453d', '526d6c7561584e6f5a57513d', '4d5441774d5449774d6a55784d6a417a4d6a4a664d44553d', '526d7876643256794946427664484d3d', '4d6a6b774d5449774d6a55774d6a45324e5464664d44673d', '5269395149464e5154413d3d', '5a69397749484e7762413d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '3605', '18%', 0),
(9, '2025-01-31 11:05:54', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441784d6a49774d6a51774d5445354e4452664d444d3d', '556d4633494531686447567961574673', '4d5441774d5449774d6a55784d6a41784d4464664d44453d', '556d463349453168644756796157467349464279623252315933513d', '4d7a45774d5449774d6a55784d5441314e5452664d446b3d', '546d5633', '626d5633', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '8788', '5%', 0),
(10, '2025-04-12 11:25:54', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '', '', '4d5449774e4449774d6a55784d44557a4d444a664d444d3d', '556d4633494531686447567961574673', '4d5449774e4449774d6a55784d5449314e5452664d54413d', '536e5674596d3867516d6c7161577870', '616e5674596d3867596d6c7161577870', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '', '500', '1', 'Unit', '2025-04-12', '4d5449774e4449774d6a55784d4445304d6a4e664d44553d', '526d466a644739796553417452413d3d', 'NULL', 'NULL', '10477', '18%', 0),
(11, '2025-04-12 11:27:31', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '', '', '4d5449774e4449774d6a55784d44557a4d444a664d444d3d', '556d4633494531686447567961574673', '4d5449774e4449774d6a55784d5449334d7a46664d54453d', '536e5674596d38676232356c49484e766457356b', '616e5674596d38676232356c49484e766457356b', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '0', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '', '500', '1', 'Unit', '2025-04-12', '4d5449774e4449774d6a55784d4445304d6a4e664d44553d', '526d466a644739796553417452413d3d', 'NULL', 'NULL', '10477', '18%', 0),
(12, '2025-04-12 11:29:41', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '', '', '4d5449774e4449774d6a55784d4455794d7a4e664d44453d', '526d6c7561584e6f5a57513d', '4d5449774e4449774d6a55784d5449354e4446664d54493d', '516e56736247563049454a766257493d', '596e56736247563049474a766257493d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '1', '4d5449774e4449774d6a55784d5449344e545a664d44493d', '55474e7a', '30', '200', '2', '1', '200,400', '2,2', 'Subunit,Subunit', '2025-04-12,2025-04-12', 'NULL', 'NULL', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d,4d5449774e4449774d6a55784d4445304d6a4e664d44513d', '526d466a6447397965534244,526d466a644739796553417452413d3d', '3604', '18%', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_receipt`
--

CREATE TABLE `af_receipt` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `receipt_id` mediumtext NOT NULL,
  `receipt_number` mediumtext NOT NULL,
  `receipt_date` date NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_receipt`
--

INSERT INTO `af_receipt` (`id`, `created_date_time`, `creator`, `creator_name`, `receipt_id`, `receipt_number`, `receipt_date`, `party_id`, `party_name`, `amount`, `narration`, `payment_mode_id`, `payment_mode_name`, `bank_id`, `bank_name`, `total_amount`, `deleted`) VALUES
(1, '2025-01-10 16:08:23', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55774e4441344d6a4e664d44453d', 'RCT001/24-25', '2025-01-10', '4d5441774d5449774d6a55784d6a49334d7a5a664d44453d', '614746796153416f4f4449334e6a49344e7a4d344d696b674c534253595770686347467359586c6862513d3d', '12100', '6347463562575675644342795a574d3d', '4d5441774d5449774d6a55784d6a45314d6a42664d44493d', '5132467a61413d3d', '', 'NULL', '12100', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_sales_invoice`
--

CREATE TABLE `af_sales_invoice` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `sales_invoice_id` mediumtext NOT NULL,
  `sales_invoice_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `magazine_type` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name_mobile_city` mediumtext NOT NULL,
  `agent_details` mediumtext NOT NULL,
  `customer_id` mediumtext NOT NULL,
  `customer_name_mobile_city` mediumtext NOT NULL,
  `customer_details` mediumtext NOT NULL,
  `address_btn` mediumtext NOT NULL,
  `transport_details` mediumtext NOT NULL,
  `delivery_address` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name_account_number` mediumtext NOT NULL,
  `company_state` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `marks_no` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `magazine_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `case_value` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `per` mediumtext NOT NULL,
  `per_type` mediumtext NOT NULL,
  `rate_per_qty` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `discount` mediumtext NOT NULL,
  `discount_value` mediumtext NOT NULL,
  `discounted_total` mediumtext NOT NULL,
  `delivery_charges` mediumtext NOT NULL,
  `delivery_charges_value` mediumtext NOT NULL,
  `delivery_charges_total` mediumtext NOT NULL,
  `loading_charges` mediumtext NOT NULL,
  `loading_charges_value` mediumtext NOT NULL,
  `loading_charges_total` mediumtext NOT NULL,
  `cgst_value` mediumtext NOT NULL,
  `sgst_value` mediumtext NOT NULL,
  `igst_value` mediumtext NOT NULL,
  `total_tax_value` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `total_cases` mediumtext NOT NULL,
  `starting_number` mediumtext NOT NULL,
  `maximum_count` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_semifinished_inward`
--

CREATE TABLE `af_semifinished_inward` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `semifinished_inward_id` mediumtext NOT NULL,
  `semifinished_inward_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `bill_date` date NOT NULL,
  `party_type` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name_city` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name_city` mediumtext NOT NULL,
  `godown_details` mediumtext NOT NULL,
  `contractor_id` mediumtext NOT NULL,
  `contractor_name_mobile_city` mediumtext NOT NULL,
  `contractor_details` mediumtext NOT NULL,
  `outsourceparty_id` mediumtext NOT NULL,
  `outsourceparty_name_mobile_city` mediumtext NOT NULL,
  `outsourceparty_details` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `cooly_per_qty` mediumtext NOT NULL,
  `total_cooly` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_stock`
--

CREATE TABLE `af_stock` (
  `id` int(100) NOT NULL,
  `created_date_time` mediumtext NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `stock_date` date NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `contractor_id` mediumtext NOT NULL,
  `outsourceparty_id` mediumtext NOT NULL,
  `supplier_id` mediumtext NOT NULL,
  `category_id` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `inward_unit` mediumtext NOT NULL,
  `inward_subunit` mediumtext NOT NULL,
  `outward_unit` mediumtext NOT NULL,
  `outward_subunit` mediumtext NOT NULL,
  `stock_type` mediumtext NOT NULL,
  `stock_action` mediumtext NOT NULL,
  `bill_unique_id` mediumtext NOT NULL,
  `bill_unique_number` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_stock`
--

INSERT INTO `af_stock` (`id`, `created_date_time`, `creator`, `creator_name`, `stock_date`, `factory_id`, `godown_id`, `magazine_id`, `contractor_id`, `outsourceparty_id`, `supplier_id`, `category_id`, `group_id`, `product_id`, `unit_id`, `case_contains`, `inward_unit`, `inward_subunit`, `outward_unit`, `outward_subunit`, `stock_type`, `stock_action`, `bill_unique_id`, `bill_unique_number`, `remarks`, `deleted`) VALUES
(1, '2025-03-05 15:41:27', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '2025-03-05', 'NULL', '4d5441774d5449774d6a55774d7a4d304e5464664d44513d', 'NULL', 'NULL', 'NULL', '4d5441774d5449774d6a55774d7a4d324d7a56664d44493d', '4d5441784d6a49774d6a51774d5445354e4452664d444d3d', '4d5441774d5449774d6a55784d6a41784d4464664d44453d', '4d7a45774d5449774d6a55784d5441314e5452664d446b3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', 'NULL', '19', 'NULL', '0', 'NULL', 'Inward Entry', 'Plus', '4d4455774d7a49774d6a55774d7a51784d6a68664d44453d', 'INW001/24-25', '4e7a59334f413d3d', 0),
(2, '2025-04-12 11:27:31', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '2025-04-12', '4d5449774e4449774d6a55784d4445304d6a4e664d44513d', '4d5449774e4449774d6a55784d4445304d6a4e664d44553d', 'NULL', 'NULL', 'NULL', 'NULL', '', '4d5449774e4449774d6a55784d44557a4d444a664d444d3d', '4d5449774e4449774d6a55784d5449334d7a46664d54453d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', 'NULL', '500', 'NULL', '0', 'NULL', 'Opening Stock', 'Plus', '4d5449774e4449774d6a55784d5449334d7a46664d54453d', 'NULL', '5433426c626d6c755a7942546447396a61773d3d', 0),
(3, '2025-04-12 11:29:41', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '2025-04-12', '4d5449774e4449774d6a55784d4445304d6a4e664d44513d', 'NULL', '4d5449774e4449774d6a55784d4445304d6a4e664d44513d', 'NULL', 'NULL', 'NULL', '', '4d5449774e4449774d6a55784d4455794d7a4e664d44453d', '4d5449774e4449774d6a55784d5449354e4446664d54493d', '4d5449774e4449774d6a55784d5449344e545a664d44493d', '30', '13.33', '400', '0', '0', 'Opening Stock', 'Plus', '4d5449774e4449774d6a55784d5449354e4446664d54493d', 'NULL', '5433426c626d6c755a7942546447396a61773d3d', 0),
(4, '2025-04-12 11:31:38', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '2025-04-12', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d', 'NULL', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d', 'NULL', 'NULL', 'NULL', '', '4d5449774e4449774d6a55784d4455794d7a4e664d44453d', '4d5449774e4449774d6a55784d5449354e4446664d54493d', '4d5449774e4449774d6a55784d5449344e545a664d44493d', '30', '6.67', '200', '0', '0', 'Opening Stock', 'Plus', '4d5449774e4449774d6a55784d5449354e4446664d54493d', 'NULL', '5433426c626d6c755a7942546447396a61773d3d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_stock_adjustment`
--

CREATE TABLE `af_stock_adjustment` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `stock_adjustment_id` mediumtext NOT NULL,
  `stock_adjustment_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `bill_date` date NOT NULL,
  `category_id` mediumtext NOT NULL,
  `category_name` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name_city` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name_city` mediumtext NOT NULL,
  `godown_details` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `magazine_name_city` mediumtext NOT NULL,
  `magazine_details` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `stock_action` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `af_stock_by_godown`
--

CREATE TABLE `af_stock_by_godown` (
  `id` int(100) NOT NULL,
  `created_date_time` mediumtext NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `category_id` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `subunit_id` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `current_stock_unit` mediumtext NOT NULL,
  `current_stock_subunit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_stock_by_godown`
--

INSERT INTO `af_stock_by_godown` (`id`, `created_date_time`, `creator`, `creator_name`, `godown_id`, `category_id`, `group_id`, `product_id`, `unit_id`, `subunit_id`, `case_contains`, `current_stock_unit`, `current_stock_subunit`, `deleted`) VALUES
(1, '2025-03-05 15:41:27', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '4d5441774d5449774d6a55774d7a4d304e5464664d44513d', '4d5441784d6a49774d6a51774d5445354e4452664d444d3d', '4d5441774d5449774d6a55784d6a41784d4464664d44453d', '4d7a45774d5449774d6a55784d5441314e5452664d446b3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', 'NULL', 'NULL', '19.00', 'NULL', 0),
(2, '2025-04-12 11:27:31', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '4d5449774e4449774d6a55784d4445304d6a4e664d44553d', '', '4d5449774e4449774d6a55784d44557a4d444a664d444d3d', '4d5449774e4449774d6a55784d5449334d7a46664d54453d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', 'NULL', 'NULL', '500.00', 'NULL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_stock_by_magazine`
--

CREATE TABLE `af_stock_by_magazine` (
  `id` int(100) NOT NULL,
  `created_date_time` mediumtext NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `category_id` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `subunit_id` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `current_stock_unit` mediumtext NOT NULL,
  `current_stock_subunit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_stock_by_magazine`
--

INSERT INTO `af_stock_by_magazine` (`id`, `created_date_time`, `creator`, `creator_name`, `magazine_id`, `category_id`, `group_id`, `product_id`, `unit_id`, `subunit_id`, `case_contains`, `current_stock_unit`, `current_stock_subunit`, `deleted`) VALUES
(1, '2025-04-12 11:29:41', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '4d5449774e4449774d6a55784d4445304d6a4e664d44513d', '', '4d5449774e4449774d6a55784d4455794d7a4e664d44453d', '4d5449774e4449774d6a55784d5449354e4446664d54493d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '4d5449774e4449774d6a55784d5449344e545a664d44493d', '30', '13.33', '399.90', 0),
(2, '2025-04-12 11:31:38', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4d6a526b4e3245324e7a63354e4751335954526b4e7a67305a5451304e44457a4e4452694e54457a5a444e6b', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d', '', '4d5449774e4449774d6a55784d4455794d7a4e664d44453d', '4d5449774e4449774d6a55784d5449354e4446664d54493d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '4d5449774e4449774d6a55784d5449344e545a664d44493d', '30', '6.67', '200.10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_supplier`
--

CREATE TABLE `af_supplier` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `supplier_id` mediumtext NOT NULL,
  `supplier_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `supplier_details` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_supplier`
--

INSERT INTO `af_supplier` (`id`, `created_date_time`, `creator`, `creator_name`, `supplier_id`, `supplier_name`, `lower_case_name`, `address`, `city`, `district`, `state`, `pincode`, `identification`, `mobile_number`, `others_city`, `opening_balance`, `opening_balance_type`, `supplier_details`, `gst_number`, `name_mobile_city`, `email`, `deleted`) VALUES
(1, '2025-01-10 12:17:02', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d6a45334d444a664d44453d', '5647686862474670494652795957526c636e4d3d', '6447686862474670494852795957526c636e4d3d', '4d54497a49484e30636d566c64413d3d', '51573170626d70706132467959576b3d', '5132686c626d356861513d3d', '5647467461577767546d466b64513d3d', 'NULL', 'NULL', '4f5467334d7a63344d7a63304e673d3d', '', '', '', '5647686862474670494652795957526c636e4d38596e492b4d54497a49484e30636d566c64447869636a354262576c75616d6c7259584a6861547869636a354461475675626d46704b455270633351754b547869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941354f44637a4e7a677a4e7a5132', 'NULL', '5647686862474670494652795957526c636e4d674b446b344e7a4d334f444d334e4459704943306751573170626d70706132467959576b3d', 'NULL', 0),
(2, '2025-01-10 15:36:35', '4d5441774d5449774d6a55774d7a4d304e5464664d7a6b3d', '566d6c6a61336b674b4463344e4467334e4451324e6a5170', '4d5441774d5449774d6a55774d7a4d324d7a56664d44493d', '6257463061476b6764484a685a47567963773d3d', '6257463061476b6764484a685a47567963773d3d', 'NULL', 'NULL', 'NULL', '5647467461577767546d466b64513d3d', 'NULL', 'NULL', '4e7a51344f4451334e6a4d794e773d3d', '', '1000', 'Debit', '6257463061476b6764484a685a475679637a7869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941334e4467344e4463324d7a4933', 'NULL', '6257463061476b6764484a685a4756796379416f4e7a51344f4451334e6a4d794e796b3d', 'NULL', 0),
(3, '2025-04-12 13:04:22', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55774d5441304d6a4a664d444d3d', '51584a3162413d3d', '59584a3162413d3d', 'NULL', 'NULL', 'NULL', '5647467461577767546d466b64513d3d', 'NULL', 'NULL', '4f4463324e6a51344e7a51314e773d3d', '', '', '', '51584a3162447869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941344e7a59324e4467334e445533', 'NULL', '51584a316243416f4f4463324e6a51344e7a51314e796b3d', 'NULL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_unit`
--

CREATE TABLE `af_unit` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_unit`
--

INSERT INTO `af_unit` (`id`, `created_date_time`, `creator`, `creator_name`, `unit_id`, `unit_name`, `lower_case_name`, `deleted`) VALUES
(1, '2025-01-29 14:05:10', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d6a6b774d5449774d6a55774d6a41314d5442664d44453d', '5132467a5a513d3d', '5932467a5a513d3d', 0),
(2, '2025-04-12 11:28:56', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55784d5449344e545a664d44493d', '55474e7a', '63474e7a', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_user`
--

CREATE TABLE `af_user` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `name_mobile` mediumtext NOT NULL,
  `login_id` mediumtext NOT NULL,
  `lower_case_login_id` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `admin` int(100) NOT NULL,
  `type` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `access_pages` mediumtext NOT NULL,
  `access_page_actions` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_user`
--

INSERT INTO `af_user` (`id`, `created_date_time`, `creator`, `creator_name`, `user_id`, `name`, `mobile_number`, `name_mobile`, `login_id`, `lower_case_login_id`, `password`, `admin`, `type`, `factory_id`, `godown_id`, `magazine_id`, `access_pages`, `access_page_actions`, `deleted`) VALUES
(4, '2024-12-09 13:36:28', '', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636', '4e6a4d344d6a4d7a4d5451774f413d3d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '55334a706332396d64486468636d5636', '63334a706332396d64486468636d5636', '51575274615734784d6a4e41', 1, 'Super Admin', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 0),
(32, '2025-01-02 16:26:00', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d4449774d5449774d6a55774e4449324d4442664d7a493d', '523246755a584e6f', '4f5467334e6a55304d7a49784d413d3d', '523246755a584e6f494367354f4463324e54517a4d6a45774b513d3d', '523246755a584e6f', '5a3246755a584e6f', '523246755a584e6f514445794d773d3d', 0, 'Factory Staff', '4d4449774d5449774d6a55774e4449324d4442664d44453d', 'NULL', 'NULL', '', '', 0),
(33, '2025-01-02 16:27:25', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d4449774d5449774d6a55774e4449334d6a56664d7a4d3d', '56476870636e56745a573570', '4f5467334e6a55304d7a49784d773d3d', '56476870636e56745a573570494367354f4463324e54517a4d6a457a4b513d3d', '5647567a64476c755a773d3d', '6447567a64476c755a773d3d', '5647567a64476c755a7a45794d30413d', 0, 'Factory Staff', '4d4449774d5449774d6a55774e4449334d6a56664d44493d', 'NULL', 'NULL', '', '', 0),
(34, '2025-01-02 16:28:14', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d4449774d5449774d6a55774e4449344d5452664d7a513d', '5533567961586c68', '4e7a677a4f4449344d7a63324e413d3d', '5533567961586c68494367334f444d344d6a677a4e7a59304b513d3d', '5533567961586c68', '6333567961586c68', '5533567961586c684d54497a51413d3d', 0, 'Godown Staff', 'NULL', '4d4449774d5449774d6a55774e4449344d5452664d444d3d', 'NULL', '', '', 0),
(35, '2025-01-02 16:43:01', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d4449774d5449774d6a55774e44517a4d444a664d7a553d', '52476870626d567a61413d3d', '4e6a677a4f5441794d7a6b304f413d3d', '52476870626d567a6143416f4e6a677a4f5441794d7a6b304f436b3d', '55334a706332396d64486468636d563665673d3d', '63334a706332396d64486468636d563665673d3d', '51575274615734784d6a4e4151413d3d', 0, 'Magazine Staff', 'NULL', 'NULL', '4d4449774d5449774d6a55774e44517a4d4446664d444d3d', '', '', 0),
(36, '2025-01-10 11:58:09', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d5455344d446c664d7a593d', '523246755a584e6f', '4f5467334e6a55304d7a49784e413d3d', '523246755a584e6f494367354f4463324e54517a4d6a45304b513d3d', '526d466a644739796557453d', '5a6d466a644739796557453d', '526d466a64473979655745784d6a4e41', 0, 'Factory Staff', '4d5441774d5449774d6a55784d5455344d446c664d44453d', 'NULL', 'NULL', '5357353359584a6b4945567564484a35,5132397563335674634852706232346752573530636e6b3d,55335276593273675157527164584e306257567564413d3d,5247467062486b6755484a765a48566a64476c7662673d3d,5532567461575a70626d6c7a6147566b4945567564484a35,545746305a584a705957776756484a68626e4e6d5a58493d,556d567762334a30', '566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d', 0),
(37, '2025-01-10 11:59:06', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d5455354d445a664d7a633d', '5533567961586c68', '4f5467334e6a55304d7a49784e773d3d', '5533567961586c68494367354f4463324e54517a4d6a45334b513d3d', '526d466a644739796557493d', '5a6d466a644739796557493d', '526d466a64473979655749784d6a4e41', 0, 'Factory Staff', '4d5441774d5449774d6a55784d5455354d445a664d44493d', 'NULL', 'NULL', '5357353359584a6b4945567564484a35,5132397563335674634852706232346752573530636e6b3d,55335276593273675157527164584e306257567564413d3d,5247467062486b6755484a765a48566a64476c7662673d3d,5532567461575a70626d6c7a6147566b4945567564484a35,545746305a584a705957776756484a68626e4e6d5a58493d,52584e30615731686447553d,556d567762334a30', '566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d', 0),
(38, '2025-01-10 12:00:33', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55784d6a41774d7a4e664d7a673d', '553246755a47687663773d3d', '4f446b334e6a55304d7a49784e673d3d', '553246755a4768766379416f4f446b334e6a55304d7a49784e696b3d', '526d466a6447397965574d3d', '5a6d466a6447397965574d3d', '526d466a6447397965574d784d6a4e41', 0, 'Factory Staff', '4d5441774d5449774d6a55784d6a41774d7a4e664d444d3d', 'NULL', 'NULL', '5357353359584a6b4945567564484a35,5132397563335674634852706232346752573530636e6b3d,55335276593273675157527164584e306257567564413d3d,5247467062486b6755484a765a48566a64476c7662673d3d,5532567461575a70626d6c7a6147566b4945567564484a35,545746305a584a705957776756484a68626e4e6d5a58493d,52584e30615731686447553d,556d567762334a30', '566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d', 0),
(39, '2025-01-10 15:34:57', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55774d7a4d304e5464664d7a6b3d', '566d6c6a61336b3d', '4e7a67304f4463304e4459324e413d3d', '566d6c6a61336b674b4463344e4467334e4451324e6a5170', '5232396b62336475', '5a32396b62336475', '5232396b623364754d54497a51413d3d', 0, 'Godown Staff', 'NULL', '4d5441774d5449774d6a55774d7a4d304e5464664d44513d', 'NULL', '55335677634778705a58493d,5357353359584a6b4945567564484a35,545746305a584a705957776756484a68626e4e6d5a58493d,556d567762334a30', '566d6c6c64773d3d$$$5157526b$$$5257527064413d3d,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d', 0),
(40, '2025-04-12 10:14:23', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5449774e4449774d6a55784d4445304d6a4e664e44413d', '556d4671', '4f5451344f4455334e4467314f413d3d', '556d4671494367354e4467344e5463304f4455344b513d3d', '55334a706332396d64486468636d5636556d4671', '63334a706332396d64486468636d5636636d4671', '55334a706332396d64486468636d5636556d4671514445794d773d3d', 0, 'Factory Staff', '4d5449774e4449774d6a55784d4445304d6a4e664d44513d', 'NULL', 'NULL', '526d466a6447397965513d3d,5232396b62336475,5457466e59587070626d553d,513246305a576476636e6b3d', '566d6c6c64773d3d$$$5257527064413d3d,566d6c6c64773d3d$$$5257527064413d3d,566d6c6c64773d3d$$$5257527064413d3d,566d6c6c64773d3d', 0);

-- --------------------------------------------------------

--
-- Table structure for table `af_voucher`
--

CREATE TABLE `af_voucher` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `voucher_id` mediumtext NOT NULL,
  `voucher_number` mediumtext NOT NULL,
  `voucher_date` date NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `af_voucher`
--

INSERT INTO `af_voucher` (`id`, `created_date_time`, `creator`, `creator_name`, `voucher_id`, `voucher_number`, `voucher_date`, `party_id`, `party_type`, `party_name`, `amount`, `narration`, `payment_mode_id`, `payment_mode_name`, `bank_id`, `bank_name`, `total_amount`, `deleted`) VALUES
(1, '2025-01-10 15:47:26', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55774d7a51334d6a5a664d44453d', 'VOC001/24-25', '2025-01-10', '4d5441774d5449774d6a55774d7a4d324d7a56664d44493d', '1', '6257463061476b6764484a685a4756796379416f4e7a51344f4451334e6a4d794e796b3d', '500,200', '55474635625756756443426e61585a6c62673d3d', '4d5441774d5449774d6a55784d6a45314d6a42664d44453d,4d5441774d5449774d6a55784d6a45314d6a42664d44493d', '5233426865513d3d,5132467a61413d3d', '4d5441774d5449774d6a55784d6a45324d5464664d44453d,', '5645314349454a755957733d', '700', 1),
(2, '2025-01-10 15:48:22', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55774d7a51344d6a4a664d44493d', 'VOC002/24-25', '2025-01-10', '4d5441774d5449774d6a55774d7a4d324d7a56664d44493d', '1', '6257463061476b6764484a685a4756796379416f4e7a51344f4451334e6a4d794e796b3d', '500', '55474635625756756443426e61585a6c62673d3d', '4d5441774d5449774d6a55784d6a45314d6a42664d44493d', '5132467a61413d3d', '', 'NULL', '500', 0),
(3, '2025-01-10 15:49:16', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55774d7a51354d545a664d444d3d', 'VOC003/24-25', '2025-01-10', '4d5441774d5449774d6a55774d7a4d324d7a56664d44493d', '1', '6257463061476b6764484a685a4756796379416f4e7a51344f4451334e6a4d794e796b3d', '300,400', '55474635625756756443426e61585a6c62673d3d', '4d5441774d5449774d6a55784d6a45314d6a42664d44493d,4d5441774d5449774d6a55784d6a45314d6a42664d44453d', '5132467a61413d3d,5233426865513d3d', ',4d5441774d5449774d6a55784d6a45324d5464664d44453d', '5645314349454a755957733d', '700', 0),
(4, '2025-01-10 15:57:37', '4d446b784d6a49774d6a51774d544d324d6a68664d44513d', '55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d', '4d5441774d5449774d6a55774d7a55334d7a64664d44513d', 'VOC004/24-25', '2025-01-10', '4d5441774d5449774d6a55784d6a49334d4446664d44453d', '4', '546d6c795957743162474675494367324d7a67354d6a6b304e7a677a4b5341744946527961584231636d453d', '10000', '5157646c626e51675957317664573530', '4d5441774d5449774d6a55784d6a45314d6a42664d44493d', '5132467a61413d3d', '', 'NULL', '10000', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `af_agent`
--
ALTER TABLE `af_agent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_bank_account`
--
ALTER TABLE `af_bank_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_category`
--
ALTER TABLE `af_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_consumption_entry`
--
ALTER TABLE `af_consumption_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_contractor`
--
ALTER TABLE `af_contractor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_customer`
--
ALTER TABLE `af_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_daily_production`
--
ALTER TABLE `af_daily_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_estimate`
--
ALTER TABLE `af_estimate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_expense`
--
ALTER TABLE `af_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_expense_category`
--
ALTER TABLE `af_expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_factory`
--
ALTER TABLE `af_factory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_godown`
--
ALTER TABLE `af_godown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_group`
--
ALTER TABLE `af_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_inward_entry`
--
ALTER TABLE `af_inward_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_login`
--
ALTER TABLE `af_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_magazine`
--
ALTER TABLE `af_magazine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_material_transfer`
--
ALTER TABLE `af_material_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_company`
--
ALTER TABLE `af_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_outsourceparty`
--
ALTER TABLE `af_outsourceparty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_party_cooly`
--
ALTER TABLE `af_party_cooly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_payment_mode`
--
ALTER TABLE `af_payment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_performa_invoice`
--
ALTER TABLE `af_performa_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_product`
--
ALTER TABLE `af_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_receipt`
--
ALTER TABLE `af_receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_sales_invoice`
--
ALTER TABLE `af_sales_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_semifinished_inward`
--
ALTER TABLE `af_semifinished_inward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_stock`
--
ALTER TABLE `af_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_stock_adjustment`
--
ALTER TABLE `af_stock_adjustment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_stock_by_godown`
--
ALTER TABLE `af_stock_by_godown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_stock_by_magazine`
--
ALTER TABLE `af_stock_by_magazine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_supplier`
--
ALTER TABLE `af_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_unit`
--
ALTER TABLE `af_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_user`
--
ALTER TABLE `af_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `af_voucher`
--
ALTER TABLE `af_voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `af_agent`
--
ALTER TABLE `af_agent`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `af_bank_account`
--
ALTER TABLE `af_bank_account`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `af_category`
--
ALTER TABLE `af_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `af_consumption_entry`
--
ALTER TABLE `af_consumption_entry`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_contractor`
--
ALTER TABLE `af_contractor`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `af_customer`
--
ALTER TABLE `af_customer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `af_daily_production`
--
ALTER TABLE `af_daily_production`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_estimate`
--
ALTER TABLE `af_estimate`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_expense`
--
ALTER TABLE `af_expense`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_expense_category`
--
ALTER TABLE `af_expense_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_factory`
--
ALTER TABLE `af_factory`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `af_godown`
--
ALTER TABLE `af_godown`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `af_group`
--
ALTER TABLE `af_group`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `af_inward_entry`
--
ALTER TABLE `af_inward_entry`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `af_login`
--
ALTER TABLE `af_login`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `af_magazine`
--
ALTER TABLE `af_magazine`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `af_material_transfer`
--
ALTER TABLE `af_material_transfer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_company`
--
ALTER TABLE `af_company`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `af_outsourceparty`
--
ALTER TABLE `af_outsourceparty`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_party_cooly`
--
ALTER TABLE `af_party_cooly`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `af_payment_mode`
--
ALTER TABLE `af_payment_mode`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `af_performa_invoice`
--
ALTER TABLE `af_performa_invoice`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_product`
--
ALTER TABLE `af_product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `af_receipt`
--
ALTER TABLE `af_receipt`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `af_sales_invoice`
--
ALTER TABLE `af_sales_invoice`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_semifinished_inward`
--
ALTER TABLE `af_semifinished_inward`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_stock`
--
ALTER TABLE `af_stock`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `af_stock_adjustment`
--
ALTER TABLE `af_stock_adjustment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `af_stock_by_godown`
--
ALTER TABLE `af_stock_by_godown`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `af_stock_by_magazine`
--
ALTER TABLE `af_stock_by_magazine`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `af_supplier`
--
ALTER TABLE `af_supplier`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `af_unit`
--
ALTER TABLE `af_unit`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `af_user`
--
ALTER TABLE `af_user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `af_voucher`
--
ALTER TABLE `af_voucher`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
