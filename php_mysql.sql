-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 06, 2021 lúc 12:10 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php_mysql`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `category_name`, `create_at`, `update_at`) VALUES
(1, 'Điện thoại', '2021-05-28 07:35:37', '2021-06-09 23:04:31'),
(2, 'Máy tính', '2021-05-28 03:53:06', '2021-05-28 04:53:06'),
(14, 'Balo18', '2021-05-28 04:53:06', '2021-05-28 04:53:06'),
(16, '22222222222222', '2021-05-28 04:53:06', '2021-05-28 03:04:01'),
(17, 'IPhone 899', '2021-05-28 04:53:06', '2021-05-28 02:52:07'),
(32, 'gfgfg56565', '2021-05-28 05:45:07', '2021-05-28 02:45:07'),
(34, 'dsa343', '2021-07-06 04:05:05', '2021-07-06 04:05:05'),
(35, 'gfdgfd6565', '2021-07-06 04:05:21', '2021-07-06 04:05:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`) VALUES
(11, 'duong9294.nta@gmail.com', '60a5e5a3ce053');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `category_id`, `product_name`, `picture`, `price`, `create_at`, `update_at`) VALUES
(1, 1, 'Iphone 6', '0', '111$', '2021-05-28 04:54:13', '2021-05-28 04:54:13'),
(2, 2, 'Sam Sum G6', '0', '555$', '2021-05-28 04:54:13', '2021-05-28 04:54:13'),
(4, 1, 'Galaxy s655', 'ooo-1622168503.jpg', '554678', '2021-05-28 04:54:13', '2021-05-28 04:54:13'),
(19, 1, 'bbbttt5555', 'image_2021_4_27-1622190613.png', '543534534', '2021-05-28 03:30:13', '2021-07-06 04:06:23'),
(20, 1, 'fdsfdsfds45454', 'image_2021_4_27-1622191118.png', '32432', '2021-05-28 03:38:38', '2021-05-28 03:38:38'),
(23, 1, 'Galaxy S83333', 'del-1625562353.jpg', '32324', '2021-07-06 04:05:53', '2021-07-06 04:05:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `role_name`, `create_at`, `update_at`) VALUES
(1, 'Admin', '2021-05-28 04:54:53', '2021-06-09 22:49:03'),
(2, 'User', '2021-05-28 04:54:53', '2021-05-28 04:54:53'),
(5, 'Manager11', '2021-05-28 04:54:53', '2021-05-28 04:54:53'),
(12, '4413211', '2021-05-28 04:54:53', '2021-05-28 04:54:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `full_name`, `avatar`, `role_id`, `email`, `create_at`, `update_at`) VALUES
(1, 'duong123', '123123', 'duongtruong', '', 1, 'duong9294@gmail.com', '2021-05-28 04:55:29', '2021-05-28 04:55:29'),
(2, 'duongtruong', '123456789', 'duong123', 'user-1625562988.png', 1, 'duongtruong@gmail.com', '2021-05-28 04:55:29', '2021-07-06 04:16:28'),
(6, 'duong123456', '123123123', 'Trương Văn Dương', 'pppp-1620964595.jpg', 2, 'kjovin@cvinfotech.com', '2021-05-28 04:55:29', '2021-05-28 04:55:29'),
(12, 'duong9294.nta@gmail.com', '12341234', 'Trương Văn Dương', 'image_2021_4_27-1621484343.png', 1, 'duong9294.nta@gmail.com', '2021-05-28 04:55:29', '2021-05-28 04:55:29'),
(19, 'dsfdsfsd', 'Quang@123', 'fhdsjfds', 'image_2021_4_27-1622192929.png', 1, 'fdsfdsf@gmail.com', '2021-05-28 04:08:49', '2021-05-28 04:08:49'),
(20, 'duong123123123', '1234454', 'hjfdsfds', 'iphone7-1623313336.jpg', 1, 'gbfdgd@gmail.com', '2021-06-09 23:51:06', '2021-06-10 03:22:16'),
(21, 'duongtruong9294', '123456789', 'duongtruong', 'user-1625562968.png', 1, 'duongtruong@gmail.com', '2021-07-06 04:16:08', '2021-07-06 04:16:08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
