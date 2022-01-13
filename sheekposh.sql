-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 04:48 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sheekposh`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `activity_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `activity_description`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(3, 2, '&lt;span class=&quot;success&quot; &gt;  کارمند وارد حساب خود ( Login ) شد  &lt;/span&gt; ', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:32:22', '2022-01-14 03:32:22'),
(4, 2, '&lt;span class=&quot;success&quot; &gt;مشتری جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام : Hermione Hudson / شماره تماس : 0-151-111-977 / ولایت :فراه&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;customers/info/1 &quot; target=&quot;_blank&quot; &gt; دیدن مشتری &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:32:51', '2022-01-14 03:32:51'),
(5, 2, '&lt;span class=&quot;success&quot; &gt;مشتری جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام : مهدی علوی / شماره تماس : 0-123-350-626 / ولایت :لوگر&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;customers/info/2 &quot; target=&quot;_blank&quot; &gt; دیدن مشتری &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:33:27', '2022-01-14 03:33:27'),
(6, 2, '&lt;span class=&quot;danger lighten-1&quot;&gt; مشتری را با مشخصات (&lt;span class=&quot;blue-grey&quot; &gt;  نام : Hermione Hudson / شماره تماس : 0-151-111-977 / ولایت :فراه&lt;/span&gt; ) حذف کرد &lt;/span&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:33:35', '2022-01-14 03:33:35'),
(7, 2, '&lt;span class=&quot;success&quot; &gt;مشتری جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام : اجمل حیدری / شماره تماس : 0-787-474-747 / ولایت :بادغیس&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;customers/info/3 &quot; target=&quot;_blank&quot; &gt; دیدن مشتری &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:34:11', '2022-01-14 03:34:11'),
(8, 2, '&lt;span class=&quot;success&quot; &gt;مشتری جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام : احسان احمدزی / شماره تماس : 0-132-659-332 / ولایت :زابل&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;customers/info/4 &quot; target=&quot;_blank&quot; &gt; دیدن مشتری &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:34:47', '2022-01-14 03:34:47'),
(9, 2, 'عکس مشتری را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام : احسان احمدزی / شماره تماس : 0-132-659-332 / ولایت :زابل&lt;/span&gt; ) تبدیل کرد &lt;br/&gt;&lt;a href=&quot;customers/info/4 &quot; target=&quot;_blank&quot; &gt; دیدن مشتری &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:35:06', '2022-01-14 03:35:06'),
(10, 2, '&lt;span class=&quot;success&quot; &gt;کتگوری جدیدی را بنام  (&lt;span class=&quot;blue-grey&quot;&gt; واسکت &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods_category&quot; target=&quot;_blank&quot; &gt; دیدن کتگوری جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:37:25', '2022-01-14 03:37:25'),
(11, 2, '&lt;span class=&quot;success&quot; &gt;کتگوری جدیدی را بنام  (&lt;span class=&quot;blue-grey&quot;&gt; جاکت &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods_category&quot; target=&quot;_blank&quot; &gt; دیدن کتگوری جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:37:31', '2022-01-14 03:37:31'),
(12, 2, '&lt;span class=&quot;success&quot; &gt;کتگوری جدیدی را بنام  (&lt;span class=&quot;blue-grey&quot;&gt; جمپر &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods_category&quot; target=&quot;_blank&quot; &gt; دیدن کتگوری جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:37:40', '2022-01-14 03:37:40'),
(13, 2, '&lt;span class=&quot;success&quot; &gt;جنس جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : واسکت کنفیس مردانه /  سایز جنس : 3 / رنگ جنس :4&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods&quot; target=&quot;_blank&quot; &gt; دیدن جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:38:20', '2022-01-14 03:38:20'),
(14, 2, '&lt;span class=&quot;success&quot; &gt;جنس جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : واسکت واسکت بجه گانه /  سایز جنس : 3 / رنگ جنس :4&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods&quot; target=&quot;_blank&quot; &gt; دیدن جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:38:49', '2022-01-14 03:38:49'),
(15, 2, '&lt;span class=&quot;success&quot; &gt;جنس جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : واسکت کنفیس نوجوان بچه گانه /  سایز جنس : 4 / رنگ جنس :3&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods&quot; target=&quot;_blank&quot; &gt; دیدن جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:39:14', '2022-01-14 03:39:14'),
(16, 2, '&lt;span class=&quot;success&quot; &gt;جنس جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : جاکت Aurora Browning نوجوان بچه گانه /  سایز جنس : 4 / رنگ جنس :4&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods&quot; target=&quot;_blank&quot; &gt; دیدن جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:39:27', '2022-01-14 03:39:27'),
(17, 2, '&lt;span &gt;جنس را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : جاکت Aurora Browning نوجوان بچه گانه /  سایز جنس : 4 / رنگ جنس :4&lt;/span&gt; ) ویرایش کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods&quot; target=&quot;_blank&quot; &gt; دیدن جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:40:02', '2022-01-14 03:40:02'),
(18, 2, '&lt;span class=&quot;success&quot; &gt;جنس جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : جاکت Kennedy Slater بجه گانه /  سایز جنس : 4 / رنگ جنس :4&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods&quot; target=&quot;_blank&quot; &gt; دیدن جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:40:15', '2022-01-14 03:40:15'),
(19, 2, '&lt;span class=&quot;danger&quot; &gt;جنس را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : جاکت Kennedy Slater بجه گانه /  سایز جنس : 4 / رنگ جنس :4&lt;/span&gt; ) حذف کرد &lt;/span&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:40:20', '2022-01-14 03:40:20'),
(20, 2, '&lt;span class=&quot;success&quot; &gt;جنس جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : جاکت اندامی مردانه /  سایز جنس : 1 / رنگ جنس :8&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods&quot; target=&quot;_blank&quot; &gt; دیدن جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:40:48', '2022-01-14 03:40:48'),
(21, 2, '&lt;span class=&quot;success&quot; &gt;جنس جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : جمپر چرمی زنانه /  سایز جنس : 3 / رنگ جنس :4&lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;goods&quot; target=&quot;_blank&quot; &gt; دیدن جنس &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:41:27', '2022-01-14 03:41:27'),
(22, 2, '&lt;span class=&quot;success&quot; &gt;شرکت جدیدی را بنام  (&lt;span class=&quot;blue-grey&quot;&gt; Marcia Love &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;companies/info/1&quot; target=&quot;_blank&quot; &gt;  دیدن شرکت &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:41:55', '2022-01-14 03:41:55'),
(23, 2, '&lt;span class=&quot;success&quot; &gt;شرکت جدیدی را بنام  (&lt;span class=&quot;blue-grey&quot;&gt; Aileen Merrill &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;companies/info/2&quot; target=&quot;_blank&quot; &gt;  دیدن شرکت &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:42:01', '2022-01-14 03:42:01'),
(24, 2, '&lt;span class=&quot;success&quot; &gt;شرکت جدیدی را بنام  (&lt;span class=&quot;blue-grey&quot;&gt; Nomlanga Ball &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;companies/info/3&quot; target=&quot;_blank&quot; &gt;  دیدن شرکت &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:42:14', '2022-01-14 03:42:14'),
(25, 2, '&lt;span class=&quot;success&quot;&gt; خرید جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt; بل نمبر :  Bill-957 / برای شرکت : Nomlanga Ball &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;purchases/info-item/1&quot; target=&quot;_blank&quot; &gt;  دیدن خرید &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:42:54', '2022-01-14 03:42:54'),
(26, 2, '&lt;span class=&quot;success&quot;&gt; خرید جدیدی را با مشخصات (&lt;span class=&quot;blue-grey&quot;&gt; بل نمبر :  Bill-529 / برای شرکت : Aileen Merrill &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;purchases/info-item/2&quot; target=&quot;_blank&quot; &gt;  دیدن خرید &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:43:23', '2022-01-14 03:43:23'),
(27, 2, '&lt;span class=&quot;success&quot;&gt; جنس جدیدی را در گدام  (&lt;span class=&quot;blue-grey&quot;&gt;جمپر چرمی زنانه / تعداد جنس : 1000 دانه  &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;stock&quot; target=&quot;_blank&quot; &gt;  دیدن گدام &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:43:49', '2022-01-14 03:43:49'),
(28, 2, '&lt;span class=&quot;success&quot;&gt; جنس جدیدی را در گدام  (&lt;span class=&quot;blue-grey&quot;&gt;جاکت اندامی مردانه / تعداد جنس : 600 دانه  &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;stock&quot; target=&quot;_blank&quot; &gt;  دیدن گدام &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:44:02', '2022-01-14 03:44:02'),
(29, 2, '&lt;span class=&quot;success&quot;&gt; جنس جدیدی را در گدام  (&lt;span class=&quot;blue-grey&quot;&gt;واسکت کنفیس نوجوان بچه گانه / تعداد جنس : 200 دانه  &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;stock&quot; target=&quot;_blank&quot; &gt;  دیدن گدام &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:44:16', '2022-01-14 03:44:16'),
(30, 2, '&lt;span class=&quot;success&quot;&gt; جنس جدیدی را در گدام  (&lt;span class=&quot;blue-grey&quot;&gt;واسکت سه خطه مردانه / تعداد جنس : 300 دانه  &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;stock&quot; target=&quot;_blank&quot; &gt;  دیدن گدام &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:44:28', '2022-01-14 03:44:28'),
(31, 2, '&lt;span class=&quot;success&quot;&gt; جمپر چرمی زنانه را در قسمت خارج شده گدام به  (&lt;span class=&quot;blue-grey&quot;&gt; تعداد 100 دانه  &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;stock_out&quot; target=&quot;_blank&quot; &gt;  دیدن جنس های خارج شده از گدام &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:44:49', '2022-01-14 03:44:49'),
(32, 2, '&lt;span class=&quot;success&quot; &gt;  کارمند جدید اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;employees/profile/2&quot; target=&quot;_blank&quot; &gt; دیدن  پروفایل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:45:52', '2022-01-14 03:45:52'),
(33, 2, '&lt;span class=&quot;success&quot; &gt;  کارمند جدید اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;employees/profile/3&quot; target=&quot;_blank&quot; &gt; دیدن  پروفایل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:47:15', '2022-01-14 03:47:15'),
(34, 2, '&lt;span class=&quot;success&quot;&gt; ماش جدیدی را  برای  (&lt;span class=&quot;blue-grey&quot;&gt; نام کارمند : Reza Hussaini / ایمل : rezahussaini@gmail.com / مقدار ماش  : 20000 افغانی  / تاریخ پرداخت ماش  : 2022-01-26  &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;employees/profile/2&quot; target=&quot;_blank&quot; &gt; دیدن مشخضات کارمند &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:47:40', '2022-01-14 03:47:40'),
(35, 2, '&lt;span class=&quot;success&quot;&gt; ماش جدیدی را  برای  (&lt;span class=&quot;blue-grey&quot;&gt; نام کارمند : Khalil Hotaki / ایمل : khalilhotaki33@mailinator.com / مقدار ماش  : 50000 افغانی  / تاریخ پرداخت ماش  : 2022-01-22  &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;employees/profile/3&quot; target=&quot;_blank&quot; &gt; دیدن مشخضات کارمند &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:48:01', '2022-01-14 03:48:01'),
(36, 2, '&lt;span class=&quot;success&quot;&gt; ماش جدیدی را  برای  (&lt;span class=&quot;blue-grey&quot;&gt; نام کارمند : Khalil Hotaki / ایمل : khalilhotaki33@mailinator.com / مقدار ماش  : 941 افغانی  / تاریخ پرداخت ماش  : 2014-10-31  &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;employees/profile/3&quot; target=&quot;_blank&quot; &gt; دیدن مشخضات کارمند &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:48:13', '2022-01-14 03:48:13'),
(37, 2, '&lt;span class=&quot;success&quot;&gt; ماش جدیدی را  برای  (&lt;span class=&quot;blue-grey&quot;&gt; نام کارمند : Reza Hussaini / ایمل : rezahussaini@gmail.com / مقدار ماش  : 67 افغانی  / تاریخ پرداخت ماش  : 2021-01-16  &lt;/span&gt; ) اضافه کرد &lt;/span&gt; &lt;br/&gt;&lt;a href=&quot;employees/profile/2&quot; target=&quot;_blank&quot; &gt; دیدن مشخضات کارمند &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:48:22', '2022-01-14 03:48:22'),
(38, 2, '&lt;span class=&quot;success&quot;&gt; مصارف مالی جدیدی را با مشخضات  (&lt;span class=&quot;blue-grey&quot;&gt; نوعیت کار : Quia eiusmod aliquam / مقدار پول  : 576 افغانی  / تاریخ پرداخت شده  : 2002-05-19  &lt;/span&gt; ) اضافه کرد &lt;/span&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:48:34', '2022-01-14 03:48:34'),
(39, 2, '&lt;span class=&quot;success&quot;&gt; مصارف مالی جدیدی را با مشخضات  (&lt;span class=&quot;blue-grey&quot;&gt; نوعیت کار : Aut commodi quos par / مقدار پول  : 229 افغانی  / تاریخ پرداخت شده  : 2021-12-31  &lt;/span&gt; ) اضافه کرد &lt;/span&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:48:40', '2022-01-14 03:48:40'),
(40, 2, '&lt;span class=&quot;success&quot;&gt; مصارف مالی جدیدی را با مشخضات  (&lt;span class=&quot;blue-grey&quot;&gt; نوعیت کار : Non corporis ut sunt / مقدار پول  : 460 افغانی  / تاریخ پرداخت شده  : 2016-05-29  &lt;/span&gt; ) اضافه کرد &lt;/span&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:48:48', '2022-01-14 03:48:48'),
(41, 2, '&lt;span class=&quot;success&quot;&gt; کرایه جدیدی را با مشخضات  (&lt;span class=&quot;blue-grey&quot;&gt; مکان : دفتر / مقدار کرایه  : 126 افغانی  / تاریخ پرداخت کرایه  : 2015-01-01  &lt;/span&gt; ) اضافه کرد &lt;/span&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:49:06', '2022-01-14 03:49:06'),
(42, 2, '&lt;span class=&quot;success&quot;&gt; کرایه جدیدی را با مشخضات  (&lt;span class=&quot;blue-grey&quot;&gt; مکان : دفتر / مقدار کرایه  : 933 افغانی  / تاریخ پرداخت کرایه  : 2015-08-12  &lt;/span&gt; ) اضافه کرد &lt;/span&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:49:12', '2022-01-14 03:49:12'),
(43, 2, '&lt;span class=&quot;success&quot;&gt; کرایه جدیدی را با مشخضات  (&lt;span class=&quot;blue-grey&quot;&gt; مکان : گدام / مقدار کرایه  : 194 افغانی  / تاریخ پرداخت کرایه  : 2005-02-14  &lt;/span&gt; ) اضافه کرد &lt;/span&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:49:18', '2022-01-14 03:49:18'),
(44, 2, '&lt;span class=&quot;success&quot;&gt; برای بل نمبر Bill-1 جنس جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : واسکت کنفیس نوجوان بچه گانه  / قیمت جنس :   891 دالر / تعداد جنس : 100 دانه &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;bills/info_bill/1&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:49:43', '2022-01-14 03:49:43'),
(45, 2, '&lt;span class=&quot;success&quot;&gt; برای بل نمبر Bill-1 جنس جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : جاکت اندامی مردانه  / قیمت جنس :   765 دالر / تعداد جنس : 400 دانه &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;bills/info_bill/1&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:50:00', '2022-01-14 03:50:00'),
(46, 2, '&lt;span class=&quot;success&quot;&gt; بل جدیدی را با  (&lt;span class=&quot;blue-grey&quot;&gt; بل نمبر : Bill-1   &lt;/span&gt; ) اضافه کرد &lt;/span&gt;  &lt;br/&gt;&lt;a href=&quot;bills/info_bill/1&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:50:09', '2022-01-14 03:50:09'),
(47, 2, '&lt;span class=&quot;success&quot;&gt; برای بل نمبر Bill-2 جنس جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : جاکت اندامی مردانه  / قیمت جنس :   32 افغانی / تعداد جنس : 44 دانه &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;bills/info_bill/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:50:49', '2022-01-14 03:50:49'),
(48, 2, '&lt;span class=&quot;success&quot;&gt; برای بل نمبر Bill-2 جنس جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : واسکت کنفیس نوجوان بچه گانه  / قیمت جنس :   97 افغانی / تعداد جنس : 88 دانه &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;bills/info_bill/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:51:00', '2022-01-14 03:51:00'),
(49, 2, '&lt;span class=&quot;success&quot;&gt; برای بل نمبر Bill-2 جنس جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  نام جنس : واسکت سه خطه مردانه  / قیمت جنس :   77 افغانی / تعداد جنس : 66 دانه &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;bills/info_bill/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:51:21', '2022-01-14 03:51:21'),
(50, 2, '&lt;span class=&quot;success&quot;&gt; بل جدیدی را با  (&lt;span class=&quot;blue-grey&quot;&gt; بل نمبر : Bill-2   &lt;/span&gt; ) اضافه کرد &lt;/span&gt;  &lt;br/&gt;&lt;a href=&quot;bills/info_bill/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:51:30', '2022-01-14 03:51:30'),
(51, 2, '&lt;span class=&quot;success&quot;&gt; برای شرکت Aileen Merrill با بل نمبر Bill-529 پرداخت جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  مقدار پرداخت شده : 24 دالر   /  تاریخ پرداخت :   1975-09-08 &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;purchases/info-item/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل خرید &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:52:15', '2022-01-14 03:52:15'),
(52, 2, '&lt;span class=&quot;success&quot;&gt; برای شرکت Aileen Merrill با بل نمبر Bill-529 پرداخت جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  مقدار پرداخت شده : 60 دالر   /  تاریخ پرداخت :   1999-09-21 &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;purchases/info-item/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل خرید &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:52:28', '2022-01-14 03:52:28'),
(53, 2, '&lt;span class=&quot;success&quot;&gt; برای مشتری ( احسان احمدزی ) با بل نمبر Bill-2 رسید جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  مقدار پرداخت شده : 920 افغانی   /  تاریخ پرداخت :   1985-06-20 &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;bills/info_bill/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:52:58', '2022-01-14 03:52:58'),
(54, 2, '&lt;span class=&quot;success&quot;&gt; برای مشتری ( احسان احمدزی ) با بل نمبر Bill-2 رسید جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  مقدار پرداخت شده : 6495 افغانی   /  تاریخ پرداخت :   2012-02-28 &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;bills/info_bill/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:53:09', '2022-01-14 03:53:09'),
(55, 2, '&lt;span class=&quot;danger&quot;&gt; برای مشتری ( احسان احمدزی ) با بل نمبر Bill-2 رسید با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  مقدار پرداخت شده : 920 افغانی   /  تاریخ پرداخت :   1985-06-20 &lt;/span&gt; )  را حذف کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;bills/info_bill/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:53:16', '2022-01-14 03:53:16'),
(56, 2, '&lt;span class=&quot;success&quot;&gt; برای مشتری ( احسان احمدزی ) با بل نمبر Bill-2 رسید جدیدی با مشخضات (&lt;span class=&quot;blue-grey&quot;&gt;  مقدار پرداخت شده : 920 افغانی   /  تاریخ پرداخت :   2022-01-14 &lt;/span&gt; ) اضافه کرد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;bills/info_bill/2&quot; target=&quot;_blank&quot; &gt; دیدن  بل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:53:34', '2022-01-14 03:53:34'),
(57, 2, '&lt;span&gt; عکس پروفایل خود را تغییر داد &lt;/span&gt;    &lt;br/&gt;&lt;a href=&quot;employees/profile/1&quot; target=&quot;_blank&quot; &gt; دیدن  پروفایل &lt;/a&gt;', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', '2022-01-14 03:54:35', '2022-01-14 03:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_num` bigint(20) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity_goods` int(11) DEFAULT NULL,
  `total_price` bigint(20) DEFAULT NULL,
  `money_paid` bigint(20) DEFAULT NULL,
  `money_remaining` bigint(20) DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `bill_num`, `customer_id`, `quantity_goods`, `total_price`, `money_paid`, `money_remaining`, `currency`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 500, 395100, 395100, 0, 'دالر', 'تکمیل', '2022-01-14 03:49:29', '2022-01-14 03:50:09'),
(2, 2, 4, 198, 15026, 7611, 7415, 'افغانی', 'تکمیل', '2022-01-14 03:50:37', '2022-01-14 03:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `bill_documents`
--

CREATE TABLE `bill_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED DEFAULT NULL,
  `goods_id` bigint(20) UNSIGNED DEFAULT NULL,
  `goods_price` bigint(20) DEFAULT NULL,
  `quantity_goods` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_documents`
--

INSERT INTO `bill_documents` (`id`, `bill_id`, `goods_id`, `goods_price`, `quantity_goods`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 891, 100, '2022-01-14 03:49:43', '2022-01-14 03:49:43'),
(2, 1, 6, 765, 400, '2022-01-14 03:50:00', '2022-01-14 03:50:00'),
(3, 2, 6, 32, 44, '2022-01-14 03:50:49', '2022-01-14 03:50:49'),
(4, 2, 3, 97, 88, '2022-01-14 03:51:00', '2022-01-14 03:51:00'),
(5, 2, 4, 77, 66, '2022-01-14 03:51:20', '2022-01-14 03:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_photo` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `phone_number`, `location`, `company_photo`, `created_at`, `updated_at`) VALUES
(1, 'Marcia Love', '00-183-930-689-034', 'Accusamus quos id et', NULL, '2022-01-14 03:41:54', '2022-01-14 03:41:54'),
(2, 'Aileen Merrill', '00-157-620-631-75_', 'Possimus deserunt e', NULL, '2022-01-14 03:42:01', '2022-01-14 03:42:01'),
(3, 'Nomlanga Ball', '00-129-823-867-65_', 'Quia sed eum repelle', 'companies-img/xxqkayHfjY6uXzQfQr5TL2wGc4pwvVj102WkmUWe.jpg', '2022-01-14 03:42:14', '2022-01-14 03:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `phone_number`, `province`, `photo`, `created_at`, `updated_at`) VALUES
(2, 'مهدی', 'علوی', '0-123-350-626', 'لوگر', 'customers-img/2xt448UCY82D0EmE4temfhAnx696ffvOF15egbAE.jpg', '2022-01-14 03:33:27', '2022-01-14 03:33:27'),
(3, 'اجمل', 'حیدری', '0-787-474-747', 'بادغیس', NULL, '2022-01-14 03:34:11', '2022-01-14 03:34:11'),
(4, 'احسان', 'احمدزی', '0-132-659-332', 'زابل', 'customers-img/KEam2nK6D0WqgTY72tqIviWpAf9Db5hhhdWLQe7y.jpg', '2022-01-14 03:34:46', '2022-01-14 03:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `phone_number`, `salary`, `created_at`, `updated_at`) VALUES
(1, 2, '0-136-349-870', 238784, '2022-01-14 03:30:33', '2022-01-14 03:30:33'),
(2, 3, '0-898-798-798', 20000, '2022-01-14 03:45:52', '2022-01-14 03:45:52'),
(3, 4, '0-128-563-387', 50000, '2022-01-14 03:47:15', '2022-01-14 03:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salaries`
--

CREATE TABLE `employee_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salary_quantity` bigint(20) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_salaries`
--

INSERT INTO `employee_salaries` (`id`, `employee_id`, `salary_quantity`, `currency`, `pay_date`, `created_at`, `updated_at`) VALUES
(1, 2, 20000, 'افغانی', '2022-01-26', '2022-01-14 03:47:40', '2022-01-14 03:47:40'),
(2, 3, 50000, 'افغانی', '2022-01-22', '2022-01-14 03:48:01', '2022-01-14 03:48:01'),
(3, 3, 941, 'افغانی', '2014-10-31', '2022-01-14 03:48:13', '2022-01-14 03:48:13'),
(4, 2, 67, 'افغانی', '2021-01-16', '2022-01-14 03:48:22', '2022-01-14 03:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_expenses`
--

CREATE TABLE `financial_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_of_work` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money_quantity` bigint(20) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_expenses`
--

INSERT INTO `financial_expenses` (`id`, `type_of_work`, `money_quantity`, `currency`, `payment_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Quia eiusmod aliquam', 576, 'افغانی', '2002-05-19', 'Rerum consequatur te', '2022-01-14 03:48:34', '2022-01-14 03:48:34'),
(2, 'Aut commodi quos par', 229, 'افغانی', '2021-12-31', 'Obcaecati hic eaque', '2022-01-14 03:48:40', '2022-01-14 03:48:40'),
(3, 'Non corporis ut sunt', 460, 'افغانی', '2016-05-29', 'Nobis provident non', '2022-01-14 03:48:48', '2022-01-14 03:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `size` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `name`, `type_of`, `category_id`, `size`, `color`, `created_at`, `updated_at`) VALUES
(1, 'کنفیس', 'مردانه', 1, 3, 4, '2022-01-14 03:38:20', '2022-01-14 03:38:20'),
(2, 'واسکت', 'بجه گانه', 1, 3, 4, '2022-01-14 03:38:49', '2022-01-14 03:38:49'),
(3, 'کنفیس', 'نوجوان بچه گانه', 1, 4, 3, '2022-01-14 03:39:14', '2022-01-14 03:39:14'),
(4, 'سه خطه', 'مردانه', 1, 4, 4, '2022-01-14 03:39:27', '2022-01-14 03:40:02'),
(6, 'اندامی', 'مردانه', 2, 1, 8, '2022-01-14 03:40:48', '2022-01-14 03:40:48'),
(7, 'چرمی', 'زنانه', 3, 3, 4, '2022-01-14 03:41:27', '2022-01-14 03:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `goods_categories`
--

CREATE TABLE `goods_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goods_categories`
--

INSERT INTO `goods_categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'واسکت', NULL, '2022-01-14 03:37:24', '2022-01-14 03:37:24'),
(2, 'جاکت', NULL, '2022-01-14 03:37:31', '2022-01-14 03:37:31'),
(3, 'جمپر', NULL, '2022-01-14 03:37:40', '2022-01-14 03:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bill_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity_loan` bigint(20) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `purchase_id`, `bill_id`, `quantity_loan`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 84, 'گرفته', '2022-01-14 03:43:23', '2022-01-14 03:43:23'),
(2, NULL, 2, 7415, 'داده', '2022-01-14 03:51:29', '2022-01-14 03:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_07_18_063814_create_sessions_table', 1),
(7, '2021_07_26_060801_add_column_to_users_table', 1),
(8, '2021_07_26_175534_create_employees_table', 1),
(9, '2021_08_02_113600_create_customers_table', 1),
(10, '2021_08_03_224559_create_goods_categories_table', 1),
(11, '2021_08_04_110037_create_goods_table', 1),
(12, '2021_08_04_194246_create_companies_table', 1),
(13, '2021_08_05_130749_create_purchases_table', 1),
(14, '2021_08_07_213107_create_purchase_documents_table', 1),
(15, '2021_08_08_222538_create_stocks_table', 1),
(16, '2021_08_09_180901_create_stock_histories_table', 1),
(17, '2021_08_12_104449_create_employee_salaries_table', 1),
(18, '2021_08_14_001208_create_financial_expenses_table', 1),
(19, '2021_08_14_011833_create_rents_table', 1),
(20, '2021_08_23_140711_create_bills_table', 1),
(21, '2021_08_24_211157_create_bill_documents_table', 1),
(22, '2021_08_28_105153_create_loans_table', 1),
(23, '2021_08_28_172723_create_payments_table', 1),
(24, '2021_09_12_230815_create_activity_logs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pay_quantity` bigint(20) NOT NULL,
  `pay_date` date DEFAULT NULL,
  `referral_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `loan_id`, `pay_quantity`, `pay_date`, `referral_number`, `created_at`, `updated_at`) VALUES
(1, 1, 24, '1975-09-08', '482', '2022-01-14 03:52:15', '2022-01-14 03:52:15'),
(2, 1, 60, '1999-09-21', '553', '2022-01-14 03:52:28', '2022-01-14 03:52:28'),
(4, 2, 6495, '2012-02-28', '230', '2022-01-14 03:53:09', '2022-01-14 03:53:09'),
(5, 2, 920, '2022-01-14', '234', '2022-01-14 03:53:34', '2022-01-14 03:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity_goods` bigint(20) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `money_paid` bigint(20) NOT NULL,
  `purchase_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `bill_number`, `company_id`, `quantity_goods`, `total_price`, `money_paid`, `purchase_date`, `currency`, `photo`, `created_at`, `updated_at`) VALUES
(1, '957', 3, 405, 315, 315, '22/12/2022', 'افغانی', NULL, '2022-01-14 03:42:54', '2022-01-14 03:42:54'),
(2, '529', 2, 723, 181, 97, '12/12/2022', 'دالر', NULL, '2022-01-14 03:43:23', '2022-01-14 03:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_documents`
--

CREATE TABLE `purchase_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `goods_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `goods_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money_quantity` bigint(20) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`id`, `location`, `money_quantity`, `currency`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 'دفتر', 126, 'افغانی', '2015-01-01', '2022-01-14 03:49:06', '2022-01-14 03:49:06'),
(2, 'دفتر', 933, 'افغانی', '2015-08-12', '2022-01-14 03:49:12', '2022-01-14 03:49:12'),
(3, 'گدام', 194, 'افغانی', '2005-02-14', '2022-01-14 03:49:18', '2022-01-14 03:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('H9fue2hrvg851OrgQ5iEKlLY4amc8SQQrgmlGFIq', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZGNkaldPanY1WmhLYnU5eTRkaXpLVDBScjJMSTZTVGlBNlFTZG1yMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Qvc2hlZWtwb3NoL2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRJdnd3T3VWQWovOXNGcDV5QWN4NC5lZ1ZhQzNrM3p0UFJ2d0NzMmgxb2gyQVplbkc5Y2U1YSI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkSXZ3d091VkFqLzlzRnA1eUFjeDQuZWdWYUMzazN6dFBSdndDczJoMW9oMkFaZW5HOWNlNWEiO30=', 1642087513);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `goods_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity_goods` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `goods_id`, `quantity_goods`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2022-01-14 03:38:20', '2022-01-14 03:38:20'),
(2, 2, 0, '2022-01-14 03:38:50', '2022-01-14 03:38:50'),
(3, 3, 12, '2022-01-14 03:39:14', '2022-01-14 03:51:30'),
(4, 4, 234, '2022-01-14 03:39:27', '2022-01-14 03:51:30'),
(6, 6, 156, '2022-01-14 03:40:48', '2022-01-14 03:51:29'),
(7, 7, 900, '2022-01-14 03:41:27', '2022-01-14 03:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `stock_histories`
--

CREATE TABLE `stock_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `goods_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity_goods` bigint(20) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_histories`
--

INSERT INTO `stock_histories` (`id`, `goods_id`, `quantity_goods`, `status`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, 7, 1000, 'store', 1, '2022-01-14 03:43:49', '2022-01-14 03:43:49'),
(2, 6, 600, 'store', 1, '2022-01-14 03:44:02', '2022-01-14 03:44:02'),
(3, 3, 200, 'store', 1, '2022-01-14 03:44:16', '2022-01-14 03:44:16'),
(4, 4, 300, 'store', 1, '2022-01-14 03:44:28', '2022-01-14 03:44:28'),
(5, 7, 100, 'out', 1, '2022-01-14 03:44:49', '2022-01-14 03:44:49'),
(6, 3, 100, 'out', 1, '2022-01-14 03:50:09', '2022-01-14 03:50:09'),
(7, 6, 400, 'out', 1, '2022-01-14 03:50:09', '2022-01-14 03:50:09'),
(8, 6, 44, 'out', 1, '2022-01-14 03:51:30', '2022-01-14 03:51:30'),
(9, 3, 88, 'out', 1, '2022-01-14 03:51:30', '2022-01-14 03:51:30'),
(10, 4, 66, 'out', 1, '2022-01-14 03:51:30', '2022-01-14 03:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `lastname`, `username`, `role`) VALUES
(2, 'Mustafa', 'mustafasadat338@gmail.com', '2022-01-14 03:30:33', '$2y$10$IvwwOuVAj/9sFp5yAcx4.egVaC3k3ztPRvwCs2h1oh2AZenG9ce5a', NULL, NULL, NULL, NULL, 'employees-img/wOh3f1AIIDxz1NdhW9MYTiHDj1QFWTLFiNkuMg5c.jpg', '2022-01-14 03:30:33', '2022-01-14 03:54:35', 'Sadat', 'mustafasadat', 'admin'),
(3, 'Reza', 'rezahussaini@gmail.com', '2022-01-14 03:45:52', '$2y$10$JYktC7Z4bEVBMMphT/SbO.HSFJY22I9b3Lx3y3UqXjsvTGzfeFqFW', NULL, NULL, NULL, NULL, NULL, '2022-01-14 03:45:52', '2022-01-14 03:45:52', 'Hussaini', 'reza', 'staff'),
(4, 'Khalil', 'khalilhotaki33@mailinator.com', '2022-01-14 03:47:15', '$2y$10$p0gasBEfxIcgGXe0LBWFBO7cVpVO7CE0Cr4zRxovXLFeUv5VLpzmC', NULL, NULL, NULL, NULL, 'employees-img/H8i5indSwGiVjreMTkLJ35Ep4V5MiR32Il7Icy0y.jpg', '2022-01-14 03:47:15', '2022-01-14 03:47:15', 'Hotaki', 'khalil', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `bill_documents`
--
ALTER TABLE `bill_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_documents_bill_id_foreign` (`bill_id`),
  ADD KEY `bill_documents_goods_id_foreign` (`goods_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_number_unique` (`phone_number`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_user_id_foreign` (`user_id`);

--
-- Indexes for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_salaries_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `financial_expenses`
--
ALTER TABLE `financial_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_category_id_foreign` (`category_id`);

--
-- Indexes for table `goods_categories`
--
ALTER TABLE `goods_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_purchase_id_foreign` (`purchase_id`),
  ADD KEY `loans_bill_id_foreign` (`bill_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_loan_id_foreign` (`loan_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_company_id_foreign` (`company_id`);

--
-- Indexes for table `purchase_documents`
--
ALTER TABLE `purchase_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_documents_goods_id_foreign` (`goods_id`),
  ADD KEY `purchase_documents_purchase_id_foreign` (`purchase_id`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_goods_id_foreign` (`goods_id`);

--
-- Indexes for table `stock_histories`
--
ALTER TABLE `stock_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_histories_goods_id_foreign` (`goods_id`),
  ADD KEY `stock_histories_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill_documents`
--
ALTER TABLE `bill_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_expenses`
--
ALTER TABLE `financial_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `goods_categories`
--
ALTER TABLE `goods_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_documents`
--
ALTER TABLE `purchase_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_histories`
--
ALTER TABLE `stock_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bill_documents`
--
ALTER TABLE `bill_documents`
  ADD CONSTRAINT `bill_documents_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_documents_goods_id_foreign` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD CONSTRAINT `employee_salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `goods_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

--
-- Constraints for table `purchase_documents`
--
ALTER TABLE `purchase_documents`
  ADD CONSTRAINT `purchase_documents_goods_id_foreign` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_documents_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_goods_id_foreign` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_histories`
--
ALTER TABLE `stock_histories`
  ADD CONSTRAINT `stock_histories_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_histories_goods_id_foreign` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
