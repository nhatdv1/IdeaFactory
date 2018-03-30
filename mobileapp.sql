-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2016 at 09:34 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mobileapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE IF NOT EXISTS `categorys` (
`id` int(10) unsigned NOT NULL,
  `category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'technology & science', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'life', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'art', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'invention', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
`id` int(10) unsigned NOT NULL,
  `deviceType` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `screenWidth` int(10) unsigned NOT NULL,
  `screenHeight` int(10) unsigned NOT NULL,
  `deviceName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `deviceType`, `screenWidth`, `screenHeight`, `deviceName`, `created_at`, `updated_at`) VALUES
(1, 'ios', 100, 150, 'iphone 5', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'android', 150, 250, 'zenfone 5', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'ios', 130, 200, 'iphone 5s', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'android', 120, 150, 'Galaxy Y', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE IF NOT EXISTS `ideas` (
`id` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `number_like` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`id`, `id_user`, `category_id`, `title`, `description`, `date`, `number_like`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Liệu có khi nào Samsung từ bỏ Android?', 'Tên tuổi của Samsung đã gắn liền với hệ điều hành Android, nhưng với sự cạnh tranh ngày càng gia tăng trong nền tảng này, liệu có tương lai nào cho Samsung khi rời khỏi đây?', '2016-03-29', 0, '2016-03-29 00:33:37', '2016-03-29 00:33:37'),
(2, 1, 1, 'Lionel Messi trở thành đại sứ thương hiệu Huawei toàn cầu', 'Lionel Messi cầu thủ xuất sắc nhất thế giới trở thành đại sứ thương hiệu mới của một trong những thương hiệu hàng đầu ngành hàng điện thoại di động thông minh - Huawei.', '2016-03-29', 0, '2016-03-29 00:33:50', '2016-03-29 00:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_03_23_155208_create_users_table', 1),
('2016_03_23_155655_create_categorys_table', 1),
('2016_03_23_155730_create_devices_table', 1),
('2016_03_23_172300_create_ideas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `remember_token`, `token`, `image`, `created_at`, `updated_at`) VALUES
(1, 'dovannhat12g@gmail.com', 'Nhất', '$2y$10$NHfbWxfeyocpJSzxRlxrf.CUwFpY2b/cIfS4KZBGdaVr7zPSavw86', '', '1459236711eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXUyJ9.eyJzdWIiOjE0LCJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL01vYmlsZUFwcFwvcHVibGljXC9sb2dpbiIsImlhdCI6IjE0NTkyMzY3MTEiLCJleHAiOiIxNDU5MjQwMzExIiwibmJmIjoiMTQ1OTIzNjcxMSIsImp0aSI6IjZjZDAwMGEzMzU2YzY4ODYyMTA1OTQ1YTYyYTQyNzNlIn0.MmYzZWQwNzJhYThiYjVkODk1MGY2ZTBjMDM1YTI1N2M5MjRhYTE0MWQyNDRjZDU1MTUzNWQzNWI0MjYwMjk0YQ', '20160329073022-0', '2016-03-29 00:03:23', '0000-00-00 00:00:00'),
(2, 'dovannhat12g1@gmail.com', 'Đỗ Văn Nhất', '$2y$10$ZPzFRYM.xJcYFRrdFcO5xu.FcIIeMBlXR6ZONU9NxcjA8cZU8lJri', '', '1459236714eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXUyJ9.eyJzdWIiOjE1LCJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL01vYmlsZUFwcFwvcHVibGljXC9sb2dpbiIsImlhdCI6IjE0NTkyMzY3MTUiLCJleHAiOiIxNDU5MjQwMzE1IiwibmJmIjoiMTQ1OTIzNjcxNSIsImp0aSI6IjdiMzU3ODJhMzFkMDhlN2MyZWExNTA0OGNiNmY4MjhkIn0.NDJiNTg0ODQzMTMyOGM2YzBmNDBjMTNhZDM2ODQ4YjdkYmMyMzMyZTUxZjRjNTE4ZmU2MTY2MmRkY2I4MGMwNg', '20160329073042-0;20160329073042-1', '2016-03-29 00:03:42', '0000-00-00 00:00:00'),
(3, 'dovannhat12g2@gmail.com', 'Nhumot_congio', '$2y$10$oYo5ZsX/6nv5Lq4Vpxa4T.84D3aRySf0.Pw80ikm5SfKPFZztbkvi', '', '1459236705eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXUyJ9.eyJzdWIiOjE2LCJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL01vYmlsZUFwcFwvcHVibGljXC9sb2dpbiIsImlhdCI6IjE0NTkyMzY3MDUiLCJleHAiOiIxNDU5MjQwMzA1IiwibmJmIjoiMTQ1OTIzNjcwNSIsImp0aSI6ImNkYmE5ZTM1MDkzODQ4MGNhNGM2OTQ2NzE2ZWIxZTdmIn0.MTgxMzQwN2FkMzU0MTg0Y2Q4YzBmOWFlNDZiNmM1MTMxYWQzNDJhMDAxZjQwM2VkZDA5YWY5MjQ0NjM0ZmM4NA', '20160329073120-0', '2016-03-29 00:03:20', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
 ADD PRIMARY KEY (`id`), ADD KEY `ideas_id_user_foreign` (`id_user`), ADD KEY `ideas_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ideas`
--
ALTER TABLE `ideas`
ADD CONSTRAINT `ideas_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categorys` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `ideas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
