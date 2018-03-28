-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2018 at 11:47 AM
-- Server version: 10.0.34-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fictions_email_marketing_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_brands`
--

CREATE TABLE `fit_f2lt_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(222) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fit_f2lt_brands`
--

INSERT INTO `fit_f2lt_brands` (`id`, `name`, `status`, `created`, `modified`) VALUES
(7, 'Infinity', 1, '2015-11-23 08:56:00', '2015-11-26 10:49:51'),
(6, 'Yellow', 1, '2015-11-23 08:53:54', '2015-11-26 10:50:03'),
(13, 'Apple', 1, '2017-07-27 21:23:24', '2017-07-27 21:23:24'),
(8, 'Indego', 1, '2015-11-23 09:08:28', '2015-11-26 10:49:45'),
(14, 'Samphony', 1, '2017-07-27 21:27:04', '2017-07-27 21:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_categories`
--

CREATE TABLE `fit_f2lt_categories` (
  `id` int(11) NOT NULL,
  `main_category_id` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(222) NOT NULL DEFAULT '0',
  `name` varchar(222) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fit_f2lt_categories`
--

INSERT INTO `fit_f2lt_categories` (`id`, `main_category_id`, `slug`, `name`, `order`, `status`, `created`, `modified`, `photo`) VALUES
(1, 1, 'users-product', 'Users Product', 1, 1, '2017-05-03 07:21:24', '2017-05-03 07:21:24', '');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_category_sizes`
--

CREATE TABLE `fit_f2lt_category_sizes` (
  `id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fit_f2lt_category_sizes`
--

INSERT INTO `fit_f2lt_category_sizes` (`id`, `size_id`, `category_id`) VALUES
(25, 1, 2),
(26, 2, 2),
(27, 3, 2),
(33, 1, 14),
(34, 2, 14),
(35, 3, 14),
(38, 4, 15),
(39, 5, 15),
(40, 2, 23),
(41, 3, 24),
(52, 1, 1),
(53, 2, 1),
(54, 3, 1),
(56, 1, 25),
(57, 2, 25);

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_comments`
--

CREATE TABLE `fit_f2lt_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fit_f2lt_comments`
--

INSERT INTO `fit_f2lt_comments` (`id`, `user_id`, `product_id`, `comment`, `created`, `updated`) VALUES
(1, 114, 21, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2015-10-18 14:13:28', '2015-10-18 14:13:28'),
(2, 114, 21, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', '2015-10-18 14:16:37', '2015-10-18 14:16:37'),
(3, 114, 23, 'good', '2015-11-05 03:37:59', '2015-11-05 03:37:59'),
(4, 114, 24, 'vary nice', '2015-11-07 14:46:29', '2015-11-07 14:46:29'),
(5, 114, 46, 'fgdf', '2015-11-28 14:47:28', '2015-11-28 14:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_countries`
--

CREATE TABLE `fit_f2lt_countries` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `iso_code_2` char(2) NOT NULL DEFAULT '',
  `iso_code_3` char(3) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fit_f2lt_countries`
--

INSERT INTO `fit_f2lt_countries` (`id`, `name`, `iso_code_2`, `iso_code_3`) VALUES
(240, 'Aaland Islands', 'AX', 'ALA'),
(1, 'Afghanistan', 'AF', 'AFG'),
(2, 'Albania', 'AL', 'ALB'),
(3, 'Algeria', 'DZ', 'DZA'),
(4, 'American Samoa', 'AS', 'ASM'),
(5, 'Andorra', 'AD', 'AND'),
(6, 'Angola', 'AO', 'AGO'),
(7, 'Anguilla', 'AI', 'AIA'),
(8, 'Antarctica', 'AQ', 'ATA'),
(9, 'Antigua and Barbuda', 'AG', 'ATG'),
(10, 'Argentina', 'AR', 'ARG'),
(11, 'Armenia', 'AM', 'ARM'),
(12, 'Aruba', 'AW', 'ABW'),
(13, 'Australia', 'AU', 'AUS'),
(14, 'Austria', 'AT', 'AUT'),
(15, 'Azerbaijan', 'AZ', 'AZE'),
(16, 'Bahamas', 'BS', 'BHS'),
(17, 'Bahrain', 'BH', 'BHR'),
(18, 'Bangladesh', 'BD', 'BGD'),
(19, 'Barbados', 'BB', 'BRB'),
(20, 'Belarus', 'BY', 'BLR'),
(21, 'Belgium', 'BE', 'BEL'),
(22, 'Belize', 'BZ', 'BLZ'),
(23, 'Benin', 'BJ', 'BEN'),
(24, 'Bermuda', 'BM', 'BMU'),
(25, 'Bhutan', 'BT', 'BTN'),
(26, 'Bolivia', 'BO', 'BOL'),
(27, 'Bosnia and Herzegowina', 'BA', 'BIH'),
(28, 'Botswana', 'BW', 'BWA'),
(29, 'Bouvet Island', 'BV', 'BVT'),
(30, 'Brazil', 'BR', 'BRA'),
(31, 'British Indian Ocean Territory', 'IO', 'IOT'),
(32, 'Brunei Darussalam', 'BN', 'BRN'),
(33, 'Bulgaria', 'BG', 'BGR'),
(34, 'Burkina Faso', 'BF', 'BFA'),
(35, 'Burundi', 'BI', 'BDI'),
(36, 'Cambodia', 'KH', 'KHM'),
(37, 'Cameroon', 'CM', 'CMR'),
(38, 'Canada', 'CA', 'CAN'),
(39, 'Cape Verde', 'CV', 'CPV'),
(40, 'Cayman Islands', 'KY', 'CYM'),
(41, 'Central African Republic', 'CF', 'CAF'),
(42, 'Chad', 'TD', 'TCD'),
(43, 'Chile', 'CL', 'CHL'),
(44, 'China', 'CN', 'CHN'),
(45, 'Christmas Island', 'CX', 'CXR'),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK'),
(47, 'Colombia', 'CO', 'COL'),
(48, 'Comoros', 'KM', 'COM'),
(49, 'Congo', 'CG', 'COG'),
(50, 'Cook Islands', 'CK', 'COK'),
(51, 'Costa Rica', 'CR', 'CRI'),
(52, 'Cote D\'Ivoire', 'CI', 'CIV'),
(53, 'Croatia', 'HR', 'HRV'),
(54, 'Cuba', 'CU', 'CUB'),
(55, 'Cyprus', 'CY', 'CYP'),
(56, 'Czech Republic', 'CZ', 'CZE'),
(57, 'Denmark', 'DK', 'DNK'),
(58, 'Djibouti', 'DJ', 'DJI'),
(59, 'Dominica', 'DM', 'DMA'),
(60, 'Dominican Republic', 'DO', 'DOM'),
(61, 'Timor-Leste', 'TL', 'TLS'),
(62, 'Ecuador', 'EC', 'ECU'),
(63, 'Egypt', 'EG', 'EGY'),
(64, 'El Salvador', 'SV', 'SLV'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ'),
(66, 'Eritrea', 'ER', 'ERI'),
(67, 'Estonia', 'EE', 'EST'),
(68, 'Ethiopia', 'ET', 'ETH'),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK'),
(70, 'Faroe Islands', 'FO', 'FRO'),
(71, 'Fiji', 'FJ', 'FJI'),
(72, 'Finland', 'FI', 'FIN'),
(73, 'France', 'FR', 'FRA'),
(75, 'French Guiana', 'GF', 'GUF'),
(76, 'French Polynesia', 'PF', 'PYF'),
(77, 'French Southern Territories', 'TF', 'ATF'),
(78, 'Gabon', 'GA', 'GAB'),
(79, 'Gambia', 'GM', 'GMB'),
(80, 'Georgia', 'GE', 'GEO'),
(81, 'Germany', 'DE', 'DEU'),
(82, 'Ghana', 'GH', 'GHA'),
(83, 'Gibraltar', 'GI', 'GIB'),
(84, 'Greece', 'GR', 'GRC'),
(85, 'Greenland', 'GL', 'GRL'),
(86, 'Grenada', 'GD', 'GRD'),
(87, 'Guadeloupe', 'GP', 'GLP'),
(88, 'Guam', 'GU', 'GUM'),
(89, 'Guatemala', 'GT', 'GTM'),
(90, 'Guinea', 'GN', 'GIN'),
(91, 'Guinea-bissau', 'GW', 'GNB'),
(92, 'Guyana', 'GY', 'GUY'),
(93, 'Haiti', 'HT', 'HTI'),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD'),
(95, 'Honduras', 'HN', 'HND'),
(96, 'Hong Kong', 'HK', 'HKG'),
(97, 'Hungary', 'HU', 'HUN'),
(98, 'Iceland', 'IS', 'ISL'),
(99, 'India', 'IN', 'IND'),
(100, 'Indonesia', 'ID', 'IDN'),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN'),
(102, 'Iraq', 'IQ', 'IRQ'),
(103, 'Ireland', 'IE', 'IRL'),
(104, 'Israel', 'IL', 'ISR'),
(105, 'Italy', 'IT', 'ITA'),
(106, 'Jamaica', 'JM', 'JAM'),
(107, 'Japan', 'JP', 'JPN'),
(108, 'Jordan', 'JO', 'JOR'),
(109, 'Kazakhstan', 'KZ', 'KAZ'),
(110, 'Kenya', 'KE', 'KEN'),
(111, 'Kiribati', 'KI', 'KIR'),
(112, 'Korea, Democratic People\'s Republic of', 'KP', 'PRK'),
(113, 'Korea, Republic of', 'KR', 'KOR'),
(114, 'Kuwait', 'KW', 'KWT'),
(115, 'Kyrgyzstan', 'KG', 'KGZ'),
(116, 'Lao People\'s Democratic Republic', 'LA', 'LAO'),
(117, 'Latvia', 'LV', 'LVA'),
(118, 'Lebanon', 'LB', 'LBN'),
(119, 'Lesotho', 'LS', 'LSO'),
(120, 'Liberia', 'LR', 'LBR'),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY'),
(122, 'Liechtenstein', 'LI', 'LIE'),
(123, 'Lithuania', 'LT', 'LTU'),
(124, 'Luxembourg', 'LU', 'LUX'),
(125, 'Macao', 'MO', 'MAC'),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD'),
(127, 'Madagascar', 'MG', 'MDG'),
(128, 'Malawi', 'MW', 'MWI'),
(129, 'Malaysia', 'MY', 'MYS'),
(130, 'Maldives', 'MV', 'MDV'),
(131, 'Mali', 'ML', 'MLI'),
(132, 'Malta', 'MT', 'MLT'),
(133, 'Marshall Islands', 'MH', 'MHL'),
(134, 'Martinique', 'MQ', 'MTQ'),
(135, 'Mauritania', 'MR', 'MRT'),
(136, 'Mauritius', 'MU', 'MUS'),
(137, 'Mayotte', 'YT', 'MYT'),
(138, 'Mexico', 'MX', 'MEX'),
(139, 'Micronesia, Federated States of', 'FM', 'FSM'),
(140, 'Moldova', 'MD', 'MDA'),
(141, 'Monaco', 'MC', 'MCO'),
(142, 'Mongolia', 'MN', 'MNG'),
(143, 'Montserrat', 'MS', 'MSR'),
(144, 'Morocco', 'MA', 'MAR'),
(145, 'Mozambique', 'MZ', 'MOZ'),
(146, 'Myanmar', 'MM', 'MMR'),
(147, 'Namibia', 'NA', 'NAM'),
(148, 'Nauru', 'NR', 'NRU'),
(149, 'Nepal', 'NP', 'NPL'),
(150, 'Netherlands', 'NL', 'NLD'),
(151, 'Netherlands Antilles', 'AN', 'ANT'),
(152, 'New Caledonia', 'NC', 'NCL'),
(153, 'New Zealand', 'NZ', 'NZL'),
(154, 'Nicaragua', 'NI', 'NIC'),
(155, 'Niger', 'NE', 'NER'),
(156, 'Nigeria', 'NG', 'NGA'),
(157, 'Niue', 'NU', 'NIU'),
(158, 'Norfolk Island', 'NF', 'NFK'),
(159, 'Northern Mariana Islands', 'MP', 'MNP'),
(160, 'Norway', 'NO', 'NOR'),
(161, 'Oman', 'OM', 'OMN'),
(162, 'Pakistan', 'PK', 'PAK'),
(163, 'Palau', 'PW', 'PLW'),
(164, 'Panama', 'PA', 'PAN'),
(165, 'Papua New Guinea', 'PG', 'PNG'),
(166, 'Paraguay', 'PY', 'PRY'),
(167, 'Peru', 'PE', 'PER'),
(168, 'Philippines', 'PH', 'PHL'),
(169, 'Pitcairn', 'PN', 'PCN'),
(170, 'Poland', 'PL', 'POL'),
(171, 'Portugal', 'PT', 'PRT'),
(172, 'Puerto Rico', 'PR', 'PRI'),
(173, 'Qatar', 'QA', 'QAT'),
(174, 'Reunion', 'RE', 'REU'),
(175, 'Romania', 'RO', 'ROU'),
(176, 'Russian Federation', 'RU', 'RUS'),
(177, 'Rwanda', 'RW', 'RWA'),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA'),
(179, 'Saint Lucia', 'LC', 'LCA'),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT'),
(181, 'Samoa', 'WS', 'WSM'),
(182, 'San Marino', 'SM', 'SMR'),
(183, 'Sao Tome and Principe', 'ST', 'STP'),
(184, 'Saudi Arabia', 'SA', 'SAU'),
(185, 'Senegal', 'SN', 'SEN'),
(186, 'Seychelles', 'SC', 'SYC'),
(187, 'Sierra Leone', 'SL', 'SLE'),
(188, 'Singapore', 'SG', 'SGP'),
(189, 'Slovakia (Slovak Republic)', 'SK', 'SVK'),
(190, 'Slovenia', 'SI', 'SVN'),
(191, 'Solomon Islands', 'SB', 'SLB'),
(192, 'Somalia', 'SO', 'SOM'),
(193, 'South Africa', 'ZA', 'ZAF'),
(194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS'),
(195, 'Spain', 'ES', 'ESP'),
(196, 'Sri Lanka', 'LK', 'LKA'),
(197, 'St. Helena', 'SH', 'SHN'),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM'),
(199, 'Sudan', 'SD', 'SDN'),
(200, 'Suriname', 'SR', 'SUR'),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM'),
(202, 'Swaziland', 'SZ', 'SWZ'),
(203, 'Sweden', 'SE', 'SWE'),
(204, 'Switzerland', 'CH', 'CHE'),
(205, 'Syrian Arab Republic', 'SY', 'SYR'),
(206, 'Taiwan', 'TW', 'TWN'),
(207, 'Tajikistan', 'TJ', 'TJK'),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA'),
(209, 'Thailand', 'TH', 'THA'),
(210, 'Togo', 'TG', 'TGO'),
(211, 'Tokelau', 'TK', 'TKL'),
(212, 'Tonga', 'TO', 'TON'),
(213, 'Trinidad and Tobago', 'TT', 'TTO'),
(214, 'Tunisia', 'TN', 'TUN'),
(215, 'Turkey', 'TR', 'TUR'),
(216, 'Turkmenistan', 'TM', 'TKM'),
(217, 'Turks and Caicos Islands', 'TC', 'TCA'),
(218, 'Tuvalu', 'TV', 'TUV'),
(219, 'Uganda', 'UG', 'UGA'),
(220, 'Ukraine', 'UA', 'UKR'),
(221, 'United Arab Emirates', 'AE', 'ARE'),
(222, 'United Kingdom', 'GB', 'GBR'),
(223, 'United States', 'US', 'USA'),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI'),
(225, 'Uruguay', 'UY', 'URY'),
(226, 'Uzbekistan', 'UZ', 'UZB'),
(227, 'Vanuatu', 'VU', 'VUT'),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT'),
(229, 'Venezuela', 'VE', 'VEN'),
(230, 'Viet Nam', 'VN', 'VNM'),
(231, 'Virgin Islands (British)', 'VG', 'VGB'),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR'),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF'),
(234, 'Western Sahara', 'EH', 'ESH'),
(235, 'Yemen', 'YE', 'YEM'),
(236, 'Serbia', 'RS', 'SRB'),
(238, 'Zambia', 'ZM', 'ZMB'),
(239, 'Zimbabwe', 'ZW', 'ZWE'),
(241, 'Palestinian Territory', 'PS', 'PSE'),
(242, 'Montenegro', 'ME', 'MNE'),
(243, 'Guernsey', 'GG', 'GGY'),
(244, 'Isle of Man', 'IM', 'IMN'),
(245, 'Jersey', 'JE', 'JEY');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_dashboards`
--

CREATE TABLE `fit_f2lt_dashboards` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fit_f2lt_dashboards`
--

INSERT INTO `fit_f2lt_dashboards` (`id`, `name`, `url`, `image`, `order`, `status`) VALUES
(9, 'Users', 'users/reset_file_id', '1428675836_MESSENGER_-_MSN.png', 6, 1),
(16, 'Settings', 'settings', 'settings.png', 9, 1),
(3, 'Categories', 'categories', 'category.png', 3, 0),
(17, 'Products', 'products', 'products.png', 5, 0),
(18, 'Faq', 'faqs', 'faq.png', 8, 0),
(19, 'FAQ Category', 'faq_categories', 'faq_category.png', 7, 0),
(20, 'Product Size', 'sizes', 'size.png', 1, 0),
(21, 'Main Category', 'main_categories', 'main_category.png', 2, 0),
(22, 'Brands', 'brands', '1448169359_brand_icon.png', 4, 0),
(23, 'Departments', 'departments', 'departments.png', 8, 0),
(24, 'Upload File', 'upload_files', 'folder_upload_data-128.png', 3, 1),
(25, 'Email Templates', 'email_templates', '1501171140_emai_templates.png', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_departments`
--

CREATE TABLE `fit_f2lt_departments` (
  `id` int(11) NOT NULL,
  `name` varchar(222) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fit_f2lt_departments`
--

INSERT INTO `fit_f2lt_departments` (`id`, `name`, `status`, `created`, `modified`) VALUES
(7, 'Executive', 1, '2015-11-23 08:56:00', '2017-05-03 11:25:59'),
(6, 'Worker', 1, '2015-11-23 08:53:54', '2017-05-03 11:26:46'),
(5, 'Users', 1, '2015-11-23 08:50:53', '2017-05-03 11:26:33'),
(8, 'Adminstrator', 1, '2015-11-23 09:08:28', '2017-05-03 11:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_email_templates`
--

CREATE TABLE `fit_f2lt_email_templates` (
  `id` int(11) NOT NULL,
  `template_name` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `subject` varchar(222) NOT NULL,
  `message` text NOT NULL,
  `special_note` text NOT NULL,
  `image` varchar(222) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fit_f2lt_email_templates`
--

INSERT INTO `fit_f2lt_email_templates` (`id`, `template_name`, `url`, `subject`, `message`, `special_note`, `image`, `status`, `created`, `modified`) VALUES
(1, 'Email Template 2', 'https://stackoverflow.com/', 'Email Subject 2', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '1501250361_nextgov-medium.jpg', 1, '2017-07-28 07:56:05', '2017-07-28 20:11:30'),
(2, 'Email Template 1', 'https://www.w3schools.com/', 'Subject 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '1501250587_cache_clear_laravel_5.PNG', 1, '2017-07-28 07:57:26', '2017-07-31 07:39:39'),
(3, 'New Offer', 'http://amzn.to/2sSEynV', 'Hello Great News', 'Hello \r\nOur premium Slim Wallet is back in stock on Amazon.com. We\'re trying to do a big marketing push to increase awareness about the importance of Minimalist Slim Wallet- so for a limited time only we\'re giving away Up To 15% Off  for our product on Amazon.com\r\n', 'Please see our amazon store: http://amzn.to/2sSEynV', '1501465456_nextgov-medium.jpg', 1, '2017-07-31 07:44:16', '2017-08-01 05:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_faqs`
--

CREATE TABLE `fit_f2lt_faqs` (
  `id` int(11) NOT NULL,
  `faq_category_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `answer` text,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fit_f2lt_faqs`
--

INSERT INTO `fit_f2lt_faqs` (`id`, `faq_category_id`, `question`, `slug`, `answer`, `status`) VALUES
(82, 10, 'Is it possible to give an add in usersasset?', 'is-it-possible-to-give-an-add-in-usersasset', 'No, it is not possible yet to give add post in usersasset, but this feature will be added soon', 1),
(83, 1, 'What is usersasset payment policy?', 'what-is-usersasset-payment-policy', 'usersasset payment is very easy. You can pay using any Back Cart like (VISA, MASTER,American Express) and other. usersasset payment is very easy. You can pay using any Back Cart like (VISA, MASTER,American Express) and other.', 1),
(84, 9, 'What is usersasset refund policy?', 'what-is-usersasset-refund-policy', 'usersasset refund policy is very easy. usersasset will refund your cash within 7 days for any valid case.usersasset refund policy is very easy. usersasset will refund your cash within 7 days for any valid case.usersasset refund policy is very easy. usersasset will refund your cash within 7 days for any valid case.', 1),
(85, 1, 'How can i make payment online?', 'how-can-i-make-payment-online', 'You can make payment thought usersasset payment method in directly. You can make payment thought usersasset payment method in directly. You can make payment thought usersasset payment method in directly. You can make payment thought usersasset payment method in directly. ', 1),
(86, 9, 'Is it possible to get refund after buy a product from usersasset', 'is-it-possible-to-get-refund-after-buy-a-product-from-usersasset', 'Yes possible.', 1),
(88, 2, 'How to pament method', 'how-to-pament-method', 'what is answer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_faq_categories`
--

CREATE TABLE `fit_f2lt_faq_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `slug` varchar(222) NOT NULL,
  `note` text NOT NULL,
  `order` tinyint(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fit_f2lt_faq_categories`
--

INSERT INTO `fit_f2lt_faq_categories` (`id`, `name`, `type`, `slug`, `note`, `order`, `status`) VALUES
(1, 'Payment  Policy', 'Payment', 'payment-policy', '', 2, 1),
(2, 'Account', 'General', 'account', '', 1, 1),
(9, 'Refund Policy', 'Payment', 'refund-policy', '', 3, 1),
(10, 'Add Posting', 'General', 'add-posting', '', 1, 1),
(15, 'dfgsdg', 'General', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_main_categories`
--

CREATE TABLE `fit_f2lt_main_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(222) NOT NULL,
  `order` tinyint(2) DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fit_f2lt_main_categories`
--

INSERT INTO `fit_f2lt_main_categories` (`id`, `name`, `slug`, `order`, `status`, `created`, `updated`) VALUES
(1, 'All Product', 'all-product', 1, 1, '2017-05-03 07:18:09', '2017-05-03 07:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_payments`
--

CREATE TABLE `fit_f2lt_payments` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `payment_method_name` varchar(100) DEFAULT NULL,
  `payment_method_code` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `vendor_email` varchar(100) DEFAULT NULL,
  `vendor_name` varchar(50) DEFAULT NULL,
  `vendor_password` varchar(50) DEFAULT NULL,
  `transaction_mode` varchar(50) DEFAULT NULL,
  `test_url` varchar(255) DEFAULT NULL,
  `production_url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fit_f2lt_payments`
--

INSERT INTO `fit_f2lt_payments` (`id`, `title`, `payment_method_name`, `payment_method_code`, `status`, `vendor_email`, `vendor_name`, `vendor_password`, `transaction_mode`, `test_url`, `production_url`) VALUES
(1, 'Credit Card', 'Direct One', 'direct_one', 1, '', '', '', '0', '', ''),
(2, 'Coin', 'iXenCenter', 'coin', 1, 'admin@ixencenter.com', '', '', '1', '', ''),
(3, 'Cash', 'Cash', 'cash', 1, NULL, NULL, NULL, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_photos`
--

CREATE TABLE `fit_f2lt_photos` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(222) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fit_f2lt_photos`
--

INSERT INTO `fit_f2lt_photos` (`id`, `product_id`, `name`, `created`, `modified`) VALUES
(1, 20, '1443846080_404.png', '2015-10-02 21:21:20', '2015-10-02 21:21:20'),
(23, 20, 'gallery2.jpg', '2015-10-03 00:45:36', '2015-10-03 00:45:36'),
(24, 21, 'create-your-own-website.gif', '2015-10-31 11:19:57', '2015-10-31 11:19:57'),
(26, 23, '1446607404_girl1.jpg', '2015-11-04 03:23:24', '2015-11-04 03:23:24'),
(27, 23, 'gallery3.jpg', '2015-11-04 03:23:33', '2015-11-04 03:23:33'),
(29, 24, '1446705651_gallery1.jpg', '2015-11-05 06:40:51', '2015-11-05 06:40:51'),
(30, 25, '1446709842_girl3.jpg', '2015-11-05 07:50:42', '2015-11-05 07:50:42'),
(31, 26, '1446710003_girl3.jpg', '2015-11-05 07:53:23', '2015-11-05 07:53:23'),
(32, 27, 'recommend1.jpg', '2015-11-05 08:02:26', '2015-11-05 08:02:26'),
(33, 37, '1448096941_shirt3.jpg', '2015-11-21 09:09:01', '2015-11-21 09:09:01'),
(34, 37, '1448096946_shirt4.jpg', '2015-11-21 09:09:06', '2015-11-21 09:09:06'),
(35, 37, '1448096951_shirt5.jpg', '2015-11-21 09:09:11', '2015-11-21 09:09:11'),
(36, 39, '1448097173_shirt1.jpg', '2015-11-21 09:12:53', '2015-11-21 09:12:53'),
(37, 39, '1448097181_shirt4.jpg', '2015-11-21 09:13:01', '2015-11-21 09:13:01'),
(38, 45, '1448623816_1448092761_shirt5.jpg', '2015-11-27 11:30:16', '2015-11-27 11:30:16'),
(39, 45, '1448624020_1448096931_shirt2.jpg', '2015-11-27 11:33:40', '2015-11-27 11:33:40'),
(40, 50, 'singal_flaower.gif', '2015-11-30 06:06:43', '2015-11-30 06:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_products`
--

CREATE TABLE `fit_f2lt_products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `availability` varchar(222) NOT NULL,
  `condition` varchar(222) NOT NULL,
  `slug` varchar(222) NOT NULL DEFAULT '0',
  `name` varchar(222) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cover_photo` varchar(222) NOT NULL DEFAULT '0',
  `product_size_photo` varchar(222) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fit_f2lt_products`
--

INSERT INTO `fit_f2lt_products` (`id`, `category_id`, `brand_id`, `availability`, `condition`, `slug`, `name`, `price`, `cover_photo`, `product_size_photo`, `description`, `status`, `created`, `modified`) VALUES
(1, 1, 8, 'in stock', 'old', 'laptop', 'Laptop', '45000.00', 'images.jpg', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 1, '2017-05-03 08:56:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_product_brands`
--

CREATE TABLE `fit_f2lt_product_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(222) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_roles`
--

CREATE TABLE `fit_f2lt_roles` (
  `id` int(10) NOT NULL,
  `name` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_settings`
--

CREATE TABLE `fit_f2lt_settings` (
  `id` int(11) NOT NULL,
  `key` varchar(222) NOT NULL,
  `value` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fit_f2lt_settings`
--

INSERT INTO `fit_f2lt_settings` (`id`, `key`, `value`) VALUES
(1, 'site_name', 'AMZ Rokckets'),
(2, 'site_email', 'info@amzrockets.com');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_sizes`
--

CREATE TABLE `fit_f2lt_sizes` (
  `id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fit_f2lt_sizes`
--

INSERT INTO `fit_f2lt_sizes` (`id`, `size`, `order`, `status`, `created`, `modified`) VALUES
(1, 'S', 1, 1, '0000-00-00 00:00:00', '2015-11-07 16:02:38'),
(2, 'M', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'L', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '32', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '34', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_upload_files`
--

CREATE TABLE `fit_f2lt_upload_files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(222) NOT NULL DEFAULT '0',
  `name` varchar(222) NOT NULL DEFAULT '0',
  `total_row` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fit_f2lt_upload_files`
--

INSERT INTO `fit_f2lt_upload_files` (`id`, `file_name`, `name`, `total_row`, `status`, `created`, `updated`) VALUES
(1, 'file2.txt', 'File Name', 0, 0, '2017-07-28 11:03:29', '2017-07-28 11:03:29'),
(2, 'file1.txt', 'File Name 2', 0, 0, '2017-07-28 11:06:39', '2017-07-28 11:06:39'),
(3, 'file3.txt', 'File Name 3', 0, 0, '2017-07-28 11:37:06', '2017-07-28 11:37:06'),
(7, '1501220832_file3.txt', 'File Name 4', 0, 0, '2017-07-28 11:47:12', '2017-07-28 11:47:12'),
(8, 'fictionsoft_programmer.txt', 'Fictionsoft Programmer', 0, 0, '2017-07-31 21:06:05', '2017-07-31 21:06:05'),
(9, 'MYEMAIL.txt', 'My Email', 0, 0, '2017-08-01 04:04:59', '2017-08-01 04:04:59'),
(10, '1502297780_file1.txt', '9_8_2017_1', 0, 0, '2017-08-09 22:56:20', '2017-08-09 22:56:20'),
(11, '1502298090_file1.txt', 'sdf', 0, 0, '2017-08-09 23:01:30', '2017-08-09 23:01:30'),
(12, '1502298181_file1.txt', 'asf', 0, 0, '2017-08-09 23:03:01', '2017-08-09 23:03:01'),
(13, '1502298600_file1.txt', 'asf', 0, 0, '2017-08-09 23:10:00', '2017-08-09 23:10:00'),
(14, '1502298720_file1.txt', 'asf', 0, 0, '2017-08-09 23:12:00', '2017-08-09 23:12:00'),
(15, '1502299171_file1.txt', 'First file with 5000 emails', 0, 0, '2017-08-09 23:19:31', '2017-08-09 23:19:31'),
(16, '1502450344_file1.txt', 'First file with 5000 emails', 0, 0, '2017-08-11 17:19:04', '2017-08-11 17:19:04'),
(17, '1502463013_file1.txt', 'First file with 5000 emails', 0, 0, '2017-08-11 20:50:13', '2017-08-11 20:50:13'),
(18, '1502464422_file1.txt', 'First file with 5000 emails', 0, 0, '2017-08-11 21:13:42', '2017-08-11 21:13:42'),
(19, '1502470370_file1.txt', 'First file with 5000 emails', 0, 0, '2017-08-11 22:52:50', '2017-08-11 22:52:50'),
(20, 'file5000.txt', 'First file with 5000 emails', 0, 0, '2017-08-12 14:53:08', '2017-08-12 14:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_users`
--

CREATE TABLE `fit_f2lt_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT '2',
  `upload_file_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(222) DEFAULT NULL,
  `last_name` varchar(222) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `email` varchar(222) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `password` varchar(222) DEFAULT NULL,
  `username` varchar(222) DEFAULT NULL,
  `photo` varchar(222) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT NULL,
  `in_invalid` tinyint(1) NOT NULL DEFAULT '0',
  `is_email_sent` tinyint(1) DEFAULT '0',
  `token` varchar(255) DEFAULT NULL,
  `token_generated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fit_f2lt_users`
--

INSERT INTO `fit_f2lt_users` (`id`, `role_id`, `upload_file_id`, `first_name`, `last_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `zip`, `country`, `email`, `fb_link`, `password`, `username`, `photo`, `status`, `is_paid`, `in_invalid`, `is_email_sent`, `token`, `token_generated`, `created`, `updated`) VALUES
(1, 1, 0, 'Iqbal', 'Mirza', '2345678', 'Dhaka', NULL, NULL, NULL, NULL, NULL, 'info@amzrockets.com', NULL, '5a2007541c6a802176bb5aa41c9c7311e38d3c41', 'info@amzrockets.com', NULL, 1, NULL, 0, 1, NULL, NULL, '2017-07-22 18:40:15', '2017-08-06 21:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `fit_f2lt_wish_lists`
--

CREATE TABLE `fit_f2lt_wish_lists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `fit_f2lt_wish_lists`
--

INSERT INTO `fit_f2lt_wish_lists` (`id`, `user_id`, `product_id`, `status`, `created`, `modified`) VALUES
(1, 0, 0, 0, '2015-10-16 15:58:39', '2015-10-16 15:58:39'),
(2, 0, 0, 0, '2015-10-16 15:59:11', '2015-10-16 15:59:11'),
(3, 0, 0, 0, '2015-10-16 16:00:36', '2015-10-16 16:00:36'),
(4, 0, 0, 0, '2015-10-16 16:00:54', '2015-10-16 16:00:54'),
(5, 0, 0, 0, '2015-10-16 16:01:58', '2015-10-16 16:01:58'),
(6, 0, 13, 0, '2015-10-16 16:15:24', '2015-10-16 16:15:24'),
(7, 0, 13, 0, '2015-10-16 16:26:01', '2015-10-16 16:26:01'),
(8, 0, 13, 0, '2015-10-16 16:26:09', '2015-10-16 16:26:09'),
(9, 0, 12, 0, '2015-10-16 16:26:21', '2015-10-16 16:26:21'),
(27, 114, 23, 0, '2015-11-04 15:13:43', '2015-11-04 15:13:43'),
(33, 114, 14, 0, '2015-11-10 16:50:20', '2015-11-10 16:50:20'),
(34, 114, 46, 0, '2015-11-25 11:04:01', '2015-11-25 11:04:01'),
(35, 114, 12, 0, '2015-11-25 11:05:13', '2015-11-25 11:05:13'),
(36, 145, 23, 0, '2015-12-14 00:42:19', '2015-12-14 00:42:19'),
(37, 149, 45, 0, '2015-12-16 16:34:18', '2015-12-16 16:34:18'),
(38, 149, 23, 0, '2015-12-16 16:35:13', '2015-12-16 16:35:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fit_f2lt_brands`
--
ALTER TABLE `fit_f2lt_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_categories`
--
ALTER TABLE `fit_f2lt_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_category_sizes`
--
ALTER TABLE `fit_f2lt_category_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_comments`
--
ALTER TABLE `fit_f2lt_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_countries`
--
ALTER TABLE `fit_f2lt_countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_countries_name_zen` (`name`),
  ADD KEY `idx_iso_2_zen` (`iso_code_2`),
  ADD KEY `idx_iso_3_zen` (`iso_code_3`);

--
-- Indexes for table `fit_f2lt_dashboards`
--
ALTER TABLE `fit_f2lt_dashboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_departments`
--
ALTER TABLE `fit_f2lt_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_email_templates`
--
ALTER TABLE `fit_f2lt_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_faqs`
--
ALTER TABLE `fit_f2lt_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_faq_categories`
--
ALTER TABLE `fit_f2lt_faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_main_categories`
--
ALTER TABLE `fit_f2lt_main_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_payments`
--
ALTER TABLE `fit_f2lt_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_photos`
--
ALTER TABLE `fit_f2lt_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_products`
--
ALTER TABLE `fit_f2lt_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_product_brands`
--
ALTER TABLE `fit_f2lt_product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_roles`
--
ALTER TABLE `fit_f2lt_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_settings`
--
ALTER TABLE `fit_f2lt_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_sizes`
--
ALTER TABLE `fit_f2lt_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_upload_files`
--
ALTER TABLE `fit_f2lt_upload_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_users`
--
ALTER TABLE `fit_f2lt_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fit_f2lt_wish_lists`
--
ALTER TABLE `fit_f2lt_wish_lists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fit_f2lt_brands`
--
ALTER TABLE `fit_f2lt_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fit_f2lt_categories`
--
ALTER TABLE `fit_f2lt_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fit_f2lt_category_sizes`
--
ALTER TABLE `fit_f2lt_category_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `fit_f2lt_comments`
--
ALTER TABLE `fit_f2lt_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fit_f2lt_countries`
--
ALTER TABLE `fit_f2lt_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `fit_f2lt_dashboards`
--
ALTER TABLE `fit_f2lt_dashboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `fit_f2lt_departments`
--
ALTER TABLE `fit_f2lt_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fit_f2lt_email_templates`
--
ALTER TABLE `fit_f2lt_email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fit_f2lt_faqs`
--
ALTER TABLE `fit_f2lt_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `fit_f2lt_faq_categories`
--
ALTER TABLE `fit_f2lt_faq_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fit_f2lt_main_categories`
--
ALTER TABLE `fit_f2lt_main_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fit_f2lt_payments`
--
ALTER TABLE `fit_f2lt_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fit_f2lt_photos`
--
ALTER TABLE `fit_f2lt_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `fit_f2lt_products`
--
ALTER TABLE `fit_f2lt_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fit_f2lt_product_brands`
--
ALTER TABLE `fit_f2lt_product_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fit_f2lt_roles`
--
ALTER TABLE `fit_f2lt_roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fit_f2lt_settings`
--
ALTER TABLE `fit_f2lt_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fit_f2lt_sizes`
--
ALTER TABLE `fit_f2lt_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fit_f2lt_upload_files`
--
ALTER TABLE `fit_f2lt_upload_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `fit_f2lt_users`
--
ALTER TABLE `fit_f2lt_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fit_f2lt_wish_lists`
--
ALTER TABLE `fit_f2lt_wish_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
