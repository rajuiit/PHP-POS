-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2017 at 09:27 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hasib_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_products_added`
--

CREATE TABLE IF NOT EXISTS `acc_products_added` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `product_id` int(5) NOT NULL,
  `item_added` varchar(200) NOT NULL,
  `purchases_price` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `acc_products_added`
--

INSERT INTO `acc_products_added` (`id`, `username`, `product_id`, `item_added`, `purchases_price`, `price`, `quantity`, `amount`, `date`) VALUES
(6, '1', 1, 'Symphoney V60', '5500.00', '5500.00', '1', '5500.00', '2017-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `shop_cash_sales`
--

CREATE TABLE IF NOT EXISTS `shop_cash_sales` (
  `sales_id` int(20) NOT NULL AUTO_INCREMENT,
  `showroom_id` int(8) NOT NULL,
  `customer_id` int(15) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `product_id` int(15) NOT NULL,
  `invoice_id` int(15) NOT NULL,
  `add_date` date NOT NULL,
  `quantity` int(5) NOT NULL,
  `invoice_amount` decimal(8,2) NOT NULL,
  `discount` int(8) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shop_cash_sales`
--

INSERT INTO `shop_cash_sales` (`sales_id`, `showroom_id`, `customer_id`, `customer_name`, `product_id`, `invoice_id`, `add_date`, `quantity`, `invoice_amount`, `discount`, `net_amount`) VALUES
(1, 1, 0, 'Zubair', 1, 1, '2017-11-26', 1, '5800.00', 100, '5700.00'),
(2, 1, 0, 'Mousumi', 1, 2, '2017-11-27', 2, '5500.00', 50, '5450.00'),
(3, 1, 0, 'Mousumi', 2, 2, '2017-11-26', 5, '22000.00', 50, '21950.00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

CREATE TABLE IF NOT EXISTS `shop_category` (
  `category_id` int(15) NOT NULL AUTO_INCREMENT,
  `parent_id` int(15) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_slug` varchar(100) NOT NULL,
  `category_note` text,
  `add_date` date NOT NULL,
  `hits` int(15) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_company`
--

CREATE TABLE IF NOT EXISTS `shop_company` (
  `company_id` int(5) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `company_phone` varchar(20) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `contact_person_name` varchar(50) NOT NULL,
  `contact_person_phone` varchar(20) NOT NULL,
  `salary_status` int(1) NOT NULL,
  `salary_update` date NOT NULL,
  `add_date` date NOT NULL,
  `added_by` int(3) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `company_name` (`company_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_company_ledger`
--

CREATE TABLE IF NOT EXISTS `shop_company_ledger` (
  `ledger_id` int(10) NOT NULL AUTO_INCREMENT,
  `company_id` int(5) NOT NULL,
  `invoice_id` int(10) NOT NULL,
  `add_date` date NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `debit` float(12,2) NOT NULL,
  `credit` float(12,2) NOT NULL,
  `balance` decimal(12,2) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_credit_customer`
--

CREATE TABLE IF NOT EXISTS `shop_credit_customer` (
  `customer_id` int(15) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) NOT NULL,
  `customer_code` varchar(100) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `referance_name` varchar(100) NOT NULL,
  `referance_mobile` varchar(50) NOT NULL,
  `add_date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_credit_customer_ledger`
--

CREATE TABLE IF NOT EXISTS `shop_credit_customer_ledger` (
  `ledger_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(5) NOT NULL,
  `invoice_id` int(10) NOT NULL,
  `add_date` date NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `debit` float(12,2) NOT NULL,
  `credit` float(12,2) NOT NULL,
  `balance` decimal(12,2) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_customer`
--

CREATE TABLE IF NOT EXISTS `shop_customer` (
  `customer_id` int(20) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `added_by` int(2) NOT NULL,
  `add_datetime` date NOT NULL,
  `modified_by` int(2) NOT NULL,
  `modify_datetime` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_debits`
--

CREATE TABLE IF NOT EXISTS `shop_debits` (
  `debit_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(3) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `add_date` date NOT NULL,
  PRIMARY KEY (`debit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shop_debits`
--

INSERT INTO `shop_debits` (`debit_id`, `category_id`, `invoice_id`, `amount`, `remarks`, `add_date`) VALUES
(1, 1, 0, '500.00', 'office tea', '2017-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `shop_expense_category`
--

CREATE TABLE IF NOT EXISTS `shop_expense_category` (
  `category_id` int(15) NOT NULL AUTO_INCREMENT,
  `parent_id` int(15) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_slug` varchar(100) NOT NULL,
  `category_note` text,
  `add_date` date NOT NULL,
  `hits` int(15) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `shop_expense_category`
--

INSERT INTO `shop_expense_category` (`category_id`, `parent_id`, `category_name`, `category_slug`, `category_note`, `add_date`, `hits`, `status`) VALUES
(1, 0, 'Tea', 'tea', '', '2016-06-12', 1, 1),
(2, 0, 'dokan vara ', 'dokan-vara', '', '2017-06-19', 1, 1),
(3, 0, 'Staf ', 'staf', '', '2017-06-20', 1, 1),
(4, 0, 'Basa Vara', 'basa-vara', '', '2017-06-20', 1, 1),
(6, 0, 'Bunas', 'bunas', '', '2017-06-20', 1, 1),
(8, 0, 'Nasta', 'nasta', '', '2017-06-20', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_invoice`
--

CREATE TABLE IF NOT EXISTS `shop_invoice` (
  `invoice_id` int(20) NOT NULL AUTO_INCREMENT,
  `showroom_id` int(8) NOT NULL,
  `customer_id` int(15) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `discount` int(8) NOT NULL,
  `invoice_amount` float(10,2) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `cash_pay` decimal(10,2) NOT NULL,
  `return_pay` decimal(10,2) NOT NULL,
  `added_by` int(2) NOT NULL,
  `add_date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_invoice`
--

INSERT INTO `shop_invoice` (`invoice_id`, `showroom_id`, `customer_id`, `customer_name`, `remarks`, `discount`, `invoice_amount`, `amount`, `cash_pay`, `return_pay`, `added_by`, `add_date`, `status`) VALUES
(1, 1, 0, 'Zubair', 'Cash Sales', 100, 5800.00, '5700.00', '6000.00', '300.00', 1, '2017-11-26', 1),
(2, 1, 0, 'Mousumi', 'Cash Sales', 50, 27500.00, '27450.00', '27500.00', '50.00', 1, '2017-11-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_login_qus`
--

CREATE TABLE IF NOT EXISTS `shop_login_qus` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_logip`
--

CREATE TABLE IF NOT EXISTS `shop_logip` (
  `log_id` bigint(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `user_mac` varchar(100) NOT NULL,
  `lagin_datetime` datetime NOT NULL,
  `login_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shop_logip`
--

INSERT INTO `shop_logip` (`log_id`, `user_id`, `user_mac`, `lagin_datetime`, `login_ip`) VALUES
(1, 1, '', '2017-11-26 19:25:15', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `shop_logs`
--

CREATE TABLE IF NOT EXISTS `shop_logs` (
  `log_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL,
  `log_ip` varchar(100) NOT NULL,
  `log_date` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_memo`
--

CREATE TABLE IF NOT EXISTS `shop_memo` (
  `sm_id` int(20) NOT NULL AUTO_INCREMENT,
  `memo_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_quantity` int(5) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `add_date` date NOT NULL,
  PRIMARY KEY (`sm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product`
--

CREATE TABLE IF NOT EXISTS `shop_product` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(5) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_details` varchar(200) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `purchases_price` decimal(10,2) NOT NULL,
  `add_date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_product`
--

INSERT INTO `shop_product` (`product_id`, `category_id`, `product_name`, `product_code`, `product_details`, `product_price`, `purchases_price`, `add_date`, `status`) VALUES
(1, 0, 'Symphoney V60', '1', 'Symphoney V60', '5500.00', '5000.00', '2017-11-26', 1),
(2, 0, 'Samsung Tab10', '2', 'Samsung Tab10', '22000.00', '20000.00', '2017-11-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_memo`
--

CREATE TABLE IF NOT EXISTS `shop_products_memo` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `product_id` int(5) NOT NULL,
  `item_added` varchar(200) NOT NULL,
  `purchases_price` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_price`
--

CREATE TABLE IF NOT EXISTS `shop_products_price` (
  `price_id` int(15) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `product_price` float NOT NULL,
  `sell_price` float NOT NULL,
  `added_by` int(1) NOT NULL,
  `add_date` date NOT NULL,
  `modify_by` int(1) NOT NULL,
  `modify_datetime` datetime NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_settings`
--

CREATE TABLE IF NOT EXISTS `shop_settings` (
  `site_id` int(1) NOT NULL DEFAULT '0',
  `site_url` varchar(100) DEFAULT NULL,
  `site_nick` varchar(250) NOT NULL,
  `site_title` text,
  `site_desc` text,
  `site_keywords` text,
  `site_theme` varchar(100) NOT NULL DEFAULT 'default',
  `site_address` varchar(255) DEFAULT NULL,
  `site_phone` varchar(100) DEFAULT NULL,
  `site_email` varchar(255) NOT NULL,
  `paypal_id` varchar(255) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `currency_rate` float NOT NULL DEFAULT '1',
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_settings`
--

INSERT INTO `shop_settings` (`site_id`, `site_url`, `site_nick`, `site_title`, `site_desc`, `site_keywords`, `site_theme`, `site_address`, `site_phone`, `site_email`, `paypal_id`, `currency`, `currency_rate`) VALUES
(0, 'http://sscollection.online/', 'Mobile City', 'Mobile City', 'Mobile City', '', 'default', '25 No Hazi Markat, Rajbari', '01727028899', 'zubaireye@gmail.com', 'zubaireye@gmail.com', 'Tk.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_showroom`
--

CREATE TABLE IF NOT EXISTS `shop_showroom` (
  `showroom_id` int(2) NOT NULL AUTO_INCREMENT,
  `showroom_name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`showroom_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `shop_showroom`
--

INSERT INTO `shop_showroom` (`showroom_id`, `showroom_name`, `status`) VALUES
(1, 'Showroom 1', 1),
(2, 'Showroom 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_stock`
--

CREATE TABLE IF NOT EXISTS `shop_stock` (
  `stock_id` int(20) NOT NULL AUTO_INCREMENT,
  `product_id` int(15) NOT NULL,
  `showroom_id` int(8) NOT NULL,
  `client_id` int(10) NOT NULL,
  `purchases_invoice_id` int(10) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `stock_in` int(10) NOT NULL,
  `stock_out` int(10) NOT NULL,
  `sales` int(10) NOT NULL,
  `current_stock` int(10) NOT NULL,
  `add_date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `shop_stock`
--

INSERT INTO `shop_stock` (`stock_id`, `product_id`, `showroom_id`, `client_id`, `purchases_invoice_id`, `remarks`, `stock_in`, `stock_out`, `sales`, `current_stock`, `add_date`, `status`) VALUES
(1, 1, 1, 0, 0, 'Cash Sales', 0, 0, 1, -1, '2017-11-26', 1),
(2, 1, 1, 0, 0, 'Cash Sales', 0, 0, 2, -1, '2017-11-26', 1),
(3, 1, 1, 0, 0, 'Cash Sales', 0, 0, 1, 2, '2017-11-26', 1),
(4, 1, 1, 0, 0, 'Cash Sales', 0, 0, 1, 3, '2017-11-26', 1),
(5, 2, 1, 0, 0, 'Cash Sales', 0, 0, 1, -1, '2017-11-26', 1),
(6, 1, 1, 0, 0, 'New Stock Symphoney V60', 10, 0, 0, 15, '2017-11-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_users`
--

CREATE TABLE IF NOT EXISTS `shop_users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `company_id` int(5) NOT NULL,
  `showroom_id` int(8) NOT NULL,
  `user_name` varchar(255) NOT NULL DEFAULT '',
  `user_address` text NOT NULL,
  `country_id` int(3) NOT NULL DEFAULT '0',
  `telephone` varchar(100) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `login_name` varchar(50) NOT NULL,
  `qus_id` int(2) NOT NULL,
  `qus_name` varchar(50) NOT NULL,
  `user_password` varchar(64) NOT NULL DEFAULT '',
  `add_date` date NOT NULL DEFAULT '0000-00-00',
  `lastlogin_ip` varchar(50) NOT NULL DEFAULT '',
  `lastlogin_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `news_letter` int(1) NOT NULL,
  `news_letter_sent` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `login_name` (`login_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shop_users`
--

INSERT INTO `shop_users` (`user_id`, `company_id`, `showroom_id`, `user_name`, `user_address`, `country_id`, `telephone`, `user_email`, `login_name`, `qus_id`, `qus_name`, `user_password`, `add_date`, `lastlogin_ip`, `lastlogin_date`, `timestamp`, `news_letter`, `news_letter_sent`, `status`) VALUES
(1, 1, 1, 'Zubair', 'Dhaka', 1, '01911944573', 'zubaireye@gmail.com', 'zubaireye', 0, '', '202cb962ac59075b964b07152d234b70', '0000-00-00', '', '2017-11-19 00:00:00', '2017-11-18 18:00:00', 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
