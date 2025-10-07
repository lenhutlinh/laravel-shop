-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 07, 2025 lúc 04:57 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thuongmaidientu`
--
CREATE DATABASE IF NOT EXISTS `thuongmaidientu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `thuongmaidientu`;

-- Disable checks to allow import without FK/unique constraint errors; will be re-enabled at end of file
SET FOREIGN_KEY_CHECKS=0;
SET UNIQUE_CHECKS=0;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `combination` varchar(255) DEFAULT NULL,
  `combination_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_image` varchar(255) NOT NULL,
  `avaiable_stock` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `shop_id`, `product_id`, `productName`, `quantity`, `product_price`, `combination`, `combination_id`, `product_image`, `avaiable_stock`, `created_at`, `updated_at`) VALUES
(10, 9, 8, 7, 'Áo sơ mi trắng của nam siêu đẹp', '1', '350000', 'S', 23, 'images_product/H3uyHuHsEGofD1yigdH6O7DNbF2LebJqmiZuMajX.jpg', '14', NULL, NULL),
(11, 9, 1, 13, 'Quần short thun nam nhiều màu', '1', '225000', 'Be M', 44, 'images_product/hg3UdNaNr5eBdw0WoKXa3kY4cUBiRC3YCAxgWtWH.jpg', '49', NULL, NULL),
(12, 10, 13, 23, 'Thắt lưng nam da cao cấp, dây lưng nam mặt khóa tự động sang trọng, nịt da màu đen TLĐ01', '1', '26000', 'Họa tiết đen mẫu 1 20cm', 101, 'images_product/kjxzeRHDE1HKNKSKigOdgRQYoI9KPSiEgIdE2Yp1.webp', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryIcon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `categoryIcon`, `created_at`, `updated_at`) VALUES
(1, 'Thời Trang Nam', 'logo_category/687f3967b7c2fe6a134a2c11894eea4b_tn.png', NULL, '2025-10-07 12:47:48'),
(2, 'Thời Trang Nữ', 'logo_category/75ea42f9eca124e9cb3cde744c060e4d_tn.png', NULL, NULL),
(3, 'Điện Thoại & Phụ Kiện', 'logo_category/31234a27876fb89cd522d7e3db1ba5ca_tn.png', NULL, NULL),
(4, 'Đồ Chơi', 'logo_category/ce8f8abc726cafff671d0e5311caa684_tn.png', NULL, NULL),
(5, 'Thiết Bị Điện Tử', 'logo_category/978b9e4cb61c611aaaf58664fae133c5_tn.png', NULL, NULL),
(6, 'Nhà Cửa & Đời Sống', 'logo_category/24b194a695ea59d384768b7b471d563f_tn.png', NULL, NULL),
(7, 'Máy Tính Laptop', 'logo_category/c3f3edfaa9f6dafc4825b77d8449999d_tn.png', NULL, NULL),
(8, 'Sức Khỏe', 'logo_category/49119e891a44fa135f5f6f5fd4cfc747_tn.png', NULL, NULL),
(9, 'Máy Ảnh & Máy Quay Phim', 'logo_category/ec14dd4fc238e676e43be2a911414d4d_tn.png', NULL, NULL),
(10, 'Sắc Đẹp', 'logo_category/ef1f336ecc6f97b790d5aae9916dcb72_tn.png', NULL, NULL),
(11, 'Đồng Hồ', 'logo_category/86c294aae72ca1db5f541790f7796260_tn.png', NULL, NULL),
(12, 'Giày Dép Nữ', 'logo_category/48630b7c76a7b62bc070c9e227097847_tn.png', NULL, NULL),
(13, 'Giày Dép Nam', 'logo_category/74ca517e1fa74dc4d974e5d03c3139de_tn.png', NULL, NULL),
(14, 'Thiết Bị Gia Dụng', 'logo_category/7abfbfee3c4844652b4a8245e473d857_tn.png', NULL, NULL),
(15, 'Nhà Sách Online', 'logo_category/36013311815c55d303b0e6c62d6a8139_tn.png', NULL, NULL),
(16, 'Thể Thao & Du Lịch', 'logo_category/6cb7e633f8b63757463b676bd19a50e4_tn.png', NULL, NULL),
(17, 'Thời Trang Trẻ Em', 'logo_category/4540f87aa3cbe99db739f9e8dd2cdaf0_tn.png', NULL, NULL),
(18, 'Balo & Túi Ví Nam', 'logo_category/18fd9d878ad946db2f1bf4e33760c86f_tn.png', NULL, NULL),
(19, 'Phụ Kiện & Trang Sức', 'logo_category/8e71245b9659ea72c1b4e737be5cf42e_tn.png', NULL, NULL),
(20, 'Túi Ví Nữ', 'logo_category/fa6ada2555e8e51f369718bbc92ccc52_tn.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_type` varchar(255) NOT NULL,
  `coupon_condition` varchar(255) NOT NULL,
  `coupon_value` varchar(255) NOT NULL,
  `coupon_amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`id`, `coupon_code`, `coupon_name`, `coupon_type`, `coupon_condition`, `coupon_value`, `coupon_amount`, `created_at`, `updated_at`) VALUES
(1, 'CTU1', 'Khuyến mãi cuối năm giảm 100000VND cho đơn trên 900000VNĐ', '1', '900000', '100000', '69', '2025-10-07 13:57:58', '2025-10-07 13:57:58'),
(3, 'CTU203', 'Giảm 10% đơn hàng trên 100000VNĐ', '2', '100000', '10', '43', '2025-10-07 02:27:22', '2025-10-07 02:27:22'),
(4, 'freship12', 'Freeship khi đơn hàng trên 300000 VND', '1', '300000', '30000', '99', '2025-10-07 02:37:55', '2025-10-07 02:37:55'),
(5, 'CHAOHE', 'Giảm 15% Giảm tối đa ₫40k Đơn Tối Thiểu ₫50k', '2', '50000', '15', '10', '2025-10-07 13:34:37', '2025-10-07 13:34:37'),
(6, 'FREESHIP', 'Giảm tối đa ₫20k Đơn Tối Thiểu ₫50k', '1', '50000', '20000', '5', '2025-10-07 13:35:18', '2025-10-07 13:35:18'),
(7, 'KHUYENMAITHANG5', 'Giảm 8% Giảm tối đa ₫300k Đơn Tối Thiểu ₫350k', '2', '3500000', '8', '10', '2025-10-07 13:46:21', '2025-10-07 13:46:21'),
(8, 'HELLOTHANG6', 'Giảm 12% Giảm tối đa ₫3tr Đơn Tối Thiểu ₫4,5tr', '2', '4500000', '12', '2', '2025-10-07 13:53:12', '2025-10-07 13:53:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `sender` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `shop_id`, `sender`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 8, 2, 'Shop ơi cho mình hỏi', '1', '2025-10-07 18:09:59', NULL),
(2, 2, 8, 1, 'Chào bạn Kiệt tôi có thể giúp gì cho bạn', '1', '2025-10-07 18:10:05', NULL),
(45, 2, 1, 2, 'Chào shop ạ! cho mình hỏi về sản phẩm của shop', '1', '2025-10-07 02:30:12', NULL),
(46, 2, 8, 2, 'Alo alo alo', '1', '2025-10-07 02:37:24', NULL),
(49, 7, 8, 2, 'Xin chào shop mình có câu hỏi', '1', '2025-10-07 02:23:54', NULL),
(50, 7, 8, 1, 'Mình có thể giúp gì cho bạn?', '0', '2025-10-07 02:42:51', NULL),
(51, 7, 8, 2, 'Mình có thắc mắc tai nghe của cửa hàng ạ', '1', '2025-10-07 02:45:26', NULL),
(52, 2, 1, 2, 'Mình muốn được shop tư vấn', '1', '2025-10-07 10:24:26', NULL),
(53, 2, 1, 1, 'Mình có thể giúp gì được cho bạn ạ', '1', '2025-10-07 10:24:42', NULL),
(54, 3, 1, 2, 'Hello shop mình có vấn đề thắc mắc', '1', '2025-10-07 12:56:08', NULL),
(55, 3, 1, 1, 'Mình có thể giúp gì được cho bạn', '1', '2025-10-07 12:56:29', NULL),
(56, 2, 1, 2, 'Mình muốn hỏi về sản phẩm áo sơ mi nam của shop', '1', '2025-10-07 12:01:13', NULL),
(57, 2, 8, 1, 'Bạn có thắc mắc gì ạ', '1', '2025-10-07 12:49:35', NULL),
(58, 2, 8, 1, 'Hello World', '1', '2025-10-07 13:20:32', NULL),
(59, 2, 8, 1, 'Liên lạc lại với bên mình sau nhé bạn', '1', '2025-10-07 13:34:30', NULL),
(60, 2, 8, 2, 'Đây ạ', '1', '2025-10-07 13:34:56', NULL),
(61, 2, 8, 1, 'Bạn cần gì', '1', '2025-10-07 13:35:42', NULL),
(62, 2, 8, 2, 'Tôi cần tư vấn sản phẩm quần jeans', '1', '2025-10-07 13:37:42', NULL),
(63, 4, 1, 2, 'Mình muốn được shop tư vấn', '1', '2025-10-07 00:15:32', NULL),
(64, 4, 1, 1, 'Mình có thể hỗ trợ gì cho bạn?', '1', '2025-10-07 13:41:23', NULL),
(65, 4, 1, 2, 'Mình muốn hỏi tư vấn về sản phẩm áo thun của shop', '1', '2025-10-07 13:41:57', NULL),
(66, 4, 1, 1, 'Bạn có thắc mắc gì về sản phẩm trên ạ?', '0', '2025-10-07 13:42:17', NULL),
(67, 3, 8, 2, 'Mình muốn được shop tư vấn', '1', '2025-10-07 10:00:28', NULL),
(68, 3, 8, 2, 'http://127.0.0.1:8000/detail_product/14', '1', '2025-10-07 10:00:43', NULL),
(69, 3, 8, 1, 'Dạ bạn ơi đây không phải là sản phẩm bên mình ạ', '1', '2025-10-07 10:01:20', NULL),
(70, 3, 8, 2, 'Mình muốn được shop tư vấn', '1', '2025-10-07 10:08:40', NULL),
(71, 3, 8, 2, 'message', '1', '2025-10-07 10:08:51', NULL),
(72, 3, 8, 2, 'Dạ là vậy à', '1', '2025-10-07 10:12:11', NULL),
(73, 3, 8, 2, 'Dạ là vậy à', '1', '2025-10-07 10:12:18', NULL),
(74, 3, 8, 2, 'Mình muốn được shop tư vấn', '1', '2025-10-07 10:12:38', NULL),
(75, 3, 8, 2, 'Mình muốn được shop tư vấn', '1', '2025-10-07 10:12:50', NULL),
(76, 3, 8, 2, 'Mình muốn được shop tư vấn', '1', '2025-10-07 10:12:51', NULL),
(77, 3, 8, 2, 'Dạ là vậy à', '1', '2025-10-07 10:15:44', NULL),
(78, 3, 8, 1, 'ads', '1', '2025-10-07 10:21:35', NULL),
(79, 2, 8, 2, 'lUẬN VĂN THÁNG 12 XIN CHÀO', '1', '2025-10-07 19:50:22', NULL),
(80, 2, 8, 1, 'cHÀO BẠN mình là kiệt', '1', '2025-10-07 19:50:45', NULL),
(81, 2, 8, 1, 'Con đĩ mẹ mày', '1', '2025-10-07 03:40:11', NULL),
(82, 2, 8, 2, 'Con cặc chửi gì con đĩ', '1', '2025-10-07 03:40:21', NULL),
(83, 2, 8, 2, 'Alo', '0', '2025-10-07 04:10:58', NULL),
(84, 2, 1, 1, 'ccc', '1', '2025-10-07 20:42:11', NULL),
(85, 2, 1, 1, 'ccc', '1', '2025-10-07 20:42:17', NULL),
(86, 2, 1, 1, 'ccc', '1', '2025-10-07 20:42:18', NULL),
(87, 2, 1, 1, 'ccc', '1', '2025-10-07 20:42:19', NULL),
(88, 2, 1, 1, 'ccc', '1', '2025-10-07 20:42:19', NULL),
(89, 2, 1, 1, 'ccc', '1', '2025-10-07 20:42:20', NULL),
(90, 2, 8, 2, 'dmm', '0', '2025-10-07 20:42:36', NULL),
(91, 2, 1, 2, 'ccc', '0', '2025-10-07 20:43:12', NULL),
(92, 9, 8, 2, 'hêlo', '1', '2025-10-07 05:10:12', NULL),
(93, 9, 8, 2, 'hi', '1', '2025-10-07 00:20:58', NULL),
(94, 9, 8, 1, 'Gi em', '1', '2025-10-07 00:22:17', NULL),
(95, 9, 8, 2, 'shop oi', '1', '2025-10-07 00:22:27', NULL),
(96, 9, 13, 2, 'ALO', '1', '2025-10-07 15:50:16', NULL),
(97, 9, 8, 2, 'ANH ƠI', '0', '2025-10-07 15:50:26', NULL),
(98, 9, 13, 2, 'ANH ƠI', '1', '2025-10-07 15:50:39', NULL),
(99, 9, 13, 1, 'ANH NGHE', '0', '2025-10-07 15:51:04', NULL),
(100, 10, 8, 2, 'Chao shop 9/6', '1', '2025-10-07 19:38:38', NULL),
(101, 10, 8, 1, 'da', '0', '2025-10-07 19:39:07', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_11_29_082119_coupon', 1),
(2, '2023_03_28_095643_cart', 2),
(3, '2025_05_28_115352_add_combination_id_to_cart_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `order_total` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shop_id`, `shipping_id`, `payment_id`, `order_total`, `order_status`, `created_at`, `updated_at`) VALUES
(2, 2, 8, 2, 2, '600000', 1, '2025-10-07 12:29:02', '2025-10-07 12:29:02'),
(3, 2, 8, 3, 3, '380000', 1, '2025-10-07 03:36:10', '2025-10-07 03:36:10'),
(7, 3, 1, 7, 7, '1550000', 1, '2025-10-07 13:19:20', '2025-10-07 13:19:20'),
(8, 3, 8, 8, 9, '80000', 1, '2025-10-07 13:34:01', '2025-10-07 13:34:01'),
(9, 3, 1, 9, 10, '430000', 1, '2025-10-07 13:35:02', '2025-10-07 13:35:02'),
(10, 2, 1, 10, 11, '480000', 1, '2025-10-07 03:15:08', '2025-10-07 03:15:08'),
(11, 2, 1, 11, 12, '24970000', 1, '2025-10-07 08:04:35', '2025-10-07 08:04:35'),
(12, 2, 1, 12, 13, '24930000', 1, '2025-10-07 08:07:54', '2025-10-07 08:07:54'),
(13, 3, 1, 13, 14, '714000', 1, '2025-10-07 10:48:50', '2025-10-07 10:48:50'),
(14, 3, 8, 14, 15, '400000', 1, '2025-10-07 12:08:17', '2025-10-07 12:08:17'),
(16, 4, 1, 16, 17, '570000', 1, '2025-10-07 02:19:20', '2025-10-07 02:19:20'),
(17, 4, 1, 17, 18, '680000', 1, '2025-10-07 02:26:37', '2025-10-07 02:26:37'),
(18, 4, 1, 18, 19, '232500', 1, '2025-10-07 02:42:05', '2025-10-07 12:18:13'),
(19, 4, 1, 19, 20, '331500', 1, '2025-10-07 08:11:07', '2025-10-07 08:11:07'),
(20, 2, 8, 20, 21, '1830000', 1, '2025-10-07 19:48:08', '2025-10-07 19:48:50'),
(21, 9, 8, 21, 22, '315000', 2, '2025-10-07 02:48:45', '2025-10-07 02:48:45'),
(22, 9, 1, 22, 23, '365000', 2, '2025-10-07 03:06:15', '2025-10-07 03:06:15'),
(23, 9, 8, 23, 24, '730000', 2, '2025-10-07 05:09:57', '2025-10-07 05:09:57'),
(24, 9, 13, 24, 25, '530000', 1, '2025-10-07 05:57:29', '2025-10-07 05:58:30'),
(25, 9, 13, 25, 26, '165000', 0, '2025-10-07 02:33:32', '2025-10-07 02:33:32'),
(26, 9, 8, 26, 27, '380000', 2, '2025-10-07 03:10:57', '2025-10-07 03:10:57'),
(27, 9, 8, 27, 28, '345000', 1, '2025-10-07 03:28:54', '2025-10-07 03:29:07'),
(28, 9, 13, 28, 29, '180000', 0, '2025-10-07 03:46:14', '2025-10-07 03:46:14'),
(29, 9, 13, 29, 30, '180000', 0, '2025-10-07 03:46:36', '2025-10-07 03:46:36'),
(30, 9, 13, 30, 31, '180000', 2, '2025-10-07 12:57:53', '2025-10-07 12:57:53'),
(31, 10, 8, 31, 32, '345000', 0, '2025-10-07 19:37:43', '2025-10-07 19:37:43'),
(32, 10, 14, 32, 33, '330000', 1, '2025-10-07 19:44:21', '2025-10-07 19:44:51'),
(33, 10, 14, 33, 34, '180000', 2, '2025-10-07 19:45:52', '2025-10-07 19:45:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_combination` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `combination_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `user_id`, `shop_id`, `product_name`, `product_quantity`, `product_price`, `product_combination`, `created_at`, `updated_at`, `combination_id`) VALUES
(3, 2, 12, 2, 8, 'Áo sơ mi nam sọc caro', '2', '285000', 'M', '2025-10-07 12:29:02', '2025-10-07 12:29:02', NULL),
(4, 3, 7, 2, 8, 'Áo sơ mi trắng của nam siêu đẹp', '1', '350000', 'M', '2025-10-07 03:36:10', '2025-10-07 03:36:10', NULL),
(7, 7, 16, 3, 1, 'Set đồ công sở nữ siêu đẹp nữ tính', '2', '760000', 'L', '2025-10-07 13:19:20', '2025-10-07 13:19:20', NULL),
(8, 8, 8, 3, 8, 'Ốp lưng điện thoại Iphone15', '1', '50000', '', '2025-10-07 13:34:01', '2025-10-07 13:34:01', NULL),
(9, 9, 18, 3, 1, 'Áo thun ngắn tay nam basic', '2', '200000', 'Trắng M', '2025-10-07 13:35:02', '2025-10-07 13:35:02', NULL),
(10, 10, 13, 2, 1, 'Quần short thun nam nhiều màu', '2', '225000', 'Be L', '2025-10-07 03:15:08', '2025-10-07 03:15:08', NULL),
(11, 11, 17, 2, 1, 'Điện thoại IP14 ProMax', '1', '25000000', 'Đen', '2025-10-07 08:04:35', '2025-10-07 08:04:35', NULL),
(12, 12, 17, 2, 1, 'Điện thoại IP14 ProMax', '1', '25000000', 'Đen', '2025-10-07 08:07:54', '2025-10-07 08:07:54', 67),
(13, 13, 16, 3, 1, 'Set đồ công sở nữ siêu đẹp nữ tính', '1', '760000', 'M', '2025-10-07 10:48:50', '2025-10-07 10:48:50', NULL),
(14, 14, 8, 3, 8, 'Ốp lưng điện thoại Iphone15', '1', '50000', '', '2025-10-07 12:08:17', '2025-10-07 12:08:17', NULL),
(15, 14, 7, 3, 8, 'Áo sơ mi trắng của nam siêu đẹp', '1', '350000', 'XL', '2025-10-07 12:08:17', '2025-10-07 12:08:17', NULL),
(16, 16, 18, 4, 1, 'Áo thun ngắn tay nam basic', '1', '200000', 'Đen S', '2025-10-07 02:19:20', '2025-10-07 02:19:20', 69),
(17, 16, 18, 4, 1, 'Áo thun ngắn tay nam basic', '2', '200000', 'Đen M', '2025-10-07 02:19:20', '2025-10-07 02:19:20', 70),
(18, 17, 18, 4, 1, 'Áo thun ngắn tay nam basic', '1', '200000', 'Trắng S', '2025-10-07 02:26:37', '2025-10-07 02:26:37', 73),
(19, 17, 13, 4, 1, 'Quần short thun nam nhiều màu', '2', '225000', 'Be M', '2025-10-07 02:26:37', '2025-10-07 02:26:37', 44),
(20, 18, 13, 4, 1, 'Quần short thun nam nhiều màu', '1', '225000', 'Be L', '2025-10-07 02:42:05', '2025-10-07 02:42:05', 45),
(21, 19, 19, 4, 1, 'Trang phục bé gái xinh xắn', '1', '335000', 'XL', '2025-10-07 08:11:07', '2025-10-07 08:11:07', 80),
(22, 20, 20, 2, 8, 'Luận văn tháng 12', '2', '500000', 'Đen S', '2025-10-07 19:48:08', '2025-10-07 19:48:08', 81),
(23, 20, 20, 2, 8, 'Luận văn tháng 12', '2', '500000', 'Đen M', '2025-10-07 19:48:08', '2025-10-07 19:48:08', 82),
(24, 21, 12, 9, 8, 'Áo sơ mi nam sọc caro', '1', '285000', 'M', '2025-10-07 02:48:45', '2025-10-07 02:48:45', 36),
(25, 22, 19, 9, 1, 'Trang phục bé gái xinh xắn', '1', '335000', 'M', '2025-10-07 03:06:15', '2025-10-07 03:06:15', 78),
(26, 23, 7, 9, 8, 'Áo sơ mi trắng của nam siêu đẹp', '1', '350000', 'S', '2025-10-07 05:09:57', '2025-10-07 05:09:57', 23),
(27, 23, 7, 9, 8, 'Áo sơ mi trắng của nam siêu đẹp', '1', '350000', 'L', '2025-10-07 05:09:57', '2025-10-07 05:09:57', 25),
(28, 24, 22, 9, 13, 'Áo sơ mi nữ za', '1', '500000', 'Xanh XL', '2025-10-07 05:57:29', '2025-10-07 05:57:29', 96),
(29, 25, 21, 9, 13, 'Áo Thun BiGSIZE', '1', '150000', 'Áo A', '2025-10-07 02:33:32', '2025-10-07 02:33:32', 85),
(30, 26, 7, 9, 8, 'Áo sơ mi trắng của nam siêu đẹp', '1', '350000', 'S', '2025-10-07 03:10:57', '2025-10-07 03:10:57', 23),
(31, 27, 7, 9, 8, 'Áo sơ mi trắng của nam siêu đẹp', '1', '350000', 'S', '2025-10-07 03:28:54', '2025-10-07 03:28:54', 23),
(32, 28, 21, 9, 13, 'Áo Thun BiGSIZE', '1', '150000', 'Áo A', '2025-10-07 03:46:14', '2025-10-07 03:46:14', 85),
(33, 29, 21, 9, 13, 'Áo Thun BiGSIZE', '1', '150000', 'Áo A', '2025-10-07 03:46:36', '2025-10-07 03:46:36', 85),
(34, 30, 21, 9, 13, 'Áo Thun BiGSIZE', '1', '150000', 'Áo A', '2025-10-07 12:57:53', '2025-10-07 12:57:53', 85),
(35, 31, 7, 10, 8, 'Áo sơ mi trắng của nam siêu đẹp', '1', '350000', 'M', '2025-10-07 19:37:43', '2025-10-07 19:37:43', 24),
(36, 32, 82, 10, 14, 'Áo thun nam 9/6', '2', '150000', 'ĐEN L', '2025-10-07 19:44:21', '2025-10-07 19:44:21', 178),
(37, 33, 82, 10, 14, 'Áo thun nam 9/6', '1', '150000', 'ĐEN XL', '2025-10-07 19:45:52', '2025-10-07 19:45:52', 179);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`id`, `shop_id`, `user_id`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(2, 8, 2, 0, 0, NULL, NULL),
(3, 8, 2, 0, 0, NULL, NULL),
(7, 1, 3, 0, 0, NULL, NULL),
(8, 8, 3, 0, 0, NULL, NULL),
(9, 8, 3, 0, 0, NULL, NULL),
(10, 1, 3, 0, 0, NULL, NULL),
(11, 1, 2, 0, 0, NULL, NULL),
(12, 1, 2, 0, 0, NULL, NULL),
(13, 1, 2, 0, 0, NULL, NULL),
(14, 1, 3, 0, 0, NULL, NULL),
(15, 8, 3, 0, 0, NULL, NULL),
(16, 1, 4, 0, 0, NULL, NULL),
(17, 1, 4, 0, 0, NULL, NULL),
(18, 1, 4, 0, 0, NULL, NULL),
(19, 1, 4, 0, 0, NULL, NULL),
(20, 1, 4, 0, 0, NULL, NULL),
(21, 8, 2, 0, 0, NULL, NULL),
(22, 8, 9, 0, 0, NULL, NULL),
(23, 1, 9, 0, 0, NULL, NULL),
(24, 8, 9, 0, 0, NULL, NULL),
(25, 13, 9, 0, 0, NULL, NULL),
(26, 13, 9, 0, 0, NULL, NULL),
(27, 8, 9, 0, 0, NULL, NULL),
(28, 8, 9, 0, 0, NULL, NULL),
(29, 13, 9, 0, 0, NULL, NULL),
(30, 13, 9, 0, 0, NULL, NULL),
(31, 13, 9, 0, 0, NULL, NULL),
(32, 8, 10, 0, 0, NULL, NULL),
(33, 14, 10, 0, 0, NULL, NULL),
(34, 14, 10, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `subCategoryName` varchar(255) NOT NULL,
  `previewImage` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `shop_id`, `category_id`, `subcategory_id`, `productName`, `price`, `description`, `categoryName`, `subCategoryName`, `previewImage`, `status`, `created_at`, `updated_at`) VALUES
(7, 8, 1, 7, 'Áo sơ mi trắng của nam siêu đẹp', 350000, 'Áo sơ mi trắng của nam siêu đẹp hợp thời trang giới trẻ', 'Thời Trang Nam', 'Áo sơ mi nam', 'images_product/H3uyHuHsEGofD1yigdH6O7DNbF2LebJqmiZuMajX.jpg', 1, NULL, NULL),
(8, 8, 12, 43, 'Ốp lưng điện thoại Iphone15', 50000, 'Ốp lưng điện thoại', 'Giày Dép Nữ', 'Giày đế bằng', 'images_product/tOsa8P6Q1jWFflEbvZ6MfPUjJ4pxsM9lnyZyANTB.jpg', 1, NULL, NULL),
(9, 8, 7, 28, 'Laptop gaming MSI Bravo 15', 20000000, 'laptop gaming cực chấtt', 'Máy Tính Laptop', 'Laptop', 'images_product/ZFoaTABpu5n6I6nZG5p7pnuHH5mzmM3DHFRXexpd.png', 1, NULL, NULL),
(10, 8, 5, 84, 'Tai nghe úp tai bluetooh Philips', 800000, 'Tai nghe không dây của hãng philips', 'Thiết Bị Điện Tử', 'Tai nghe bluetooh', 'images_product/HQdOfLN16wyepLbBQKxDg7RyY6JNL1pEggYVkstN.jpg', 1, NULL, NULL),
(11, 8, 2, 86, 'Quần jean đen nữ cá tính', 475000, 'Quần jean nữ cá tính siêu đẹp', 'Thời Trang Nữ', 'Quần jean nữ', 'images_product/hC8oaCBYxqLfI1ACKqwvY9GZVscFspwH0OKffmXl.jpg', 1, NULL, NULL),
(12, 8, 1, 7, 'Áo sơ mi nam sọc caro', 285000, 'Áo sơ mi nam sọc caro thời trang giới trẻ 2023', 'Thời Trang Nam', 'Áo sơ mi nam', 'images_product/qYf1Z9x6DUGcEjslciu98MSZ2sXQFQPY0AMnaxu3.png', 1, NULL, NULL),
(13, 1, 1, 78, 'Quần short thun nam nhiều màu', 225000, 'Quần short thun nam nhiều màu siêu cute', 'Thời Trang Nam', 'Quần short nam', 'images_product/hg3UdNaNr5eBdw0WoKXa3kY4cUBiRC3YCAxgWtWH.jpg', 1, NULL, NULL),
(14, 1, 2, 8, 'Áo sơ mi công sở nữ cao cấp', 499000, 'Áo sơ mi công sở nữ cao cấpÁo sơ mi công sở nữ cao cấp', 'Thời Trang Nữ', 'Áo sơ mi nữ', 'images_product/tmV7v0DnrRM8kCnRpbxW1AiCw4q18LTmwpDAUGbi.jpg', 1, NULL, NULL),
(15, 1, 1, 6, 'Quần Jean baggy nam xanh', 435000, 'Quần Jean baggy nam xanh Quần Jean baggy nam xanh', 'Thời Trang Nam', 'Quần Jeans', 'images_product/djcF3wGaKJW50h3u8XfKHI0BJAtsr2R37OTohS6M.png', 1, NULL, NULL),
(16, 1, 2, 8, 'Set đồ công sở nữ siêu đẹp nữ tính', 760000, 'Set đồ công sở nữ siêu đẹp nữ tính Set đồ công sở nữ siêu đẹp nữ tính', 'Thời Trang Nữ', 'Áo sơ mi nữ', 'images_product/g4wQeLsDoC692APxUkT6UsfsX6LKetz21S3tjKZu.jpg', 1, NULL, NULL),
(17, 1, 3, 87, 'Điện thoại IP14 ProMax', 25000000, 'Điện thoại IP14 ProMax Điện thoại IP14 ProMax siêu xịn', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/AS8cBTWTayMjwwVLbAlWaZgS06vv03535J4PzbcS.jpg', 1, NULL, NULL),
(18, 1, 1, 76, 'Áo thun ngắn tay nam basic', 200000, 'Áo thun ngắn tay nam basic dễ mặc ngày thường', 'Thời Trang Nam', 'Áo thun', 'images_product/8BFd54OwDEZP2N2jctlYsRvJz781LPbkYXw67h3c.jpg', 1, NULL, NULL),
(19, 1, 17, 59, 'Trang phục bé gái xinh xắn', 335000, 'Trang phục bé gái xinh xắn siêu đáng iu ba mẹ nên mua', 'Thời Trang Trẻ Em', 'Trang phục bé gái', 'images_product/xGk2BDGQ21jCWsN9ap3etC1LrAOmUAnIZ46Dmgnb.jpg', 1, NULL, NULL),
(20, 8, 1, 6, 'Luận văn tháng 12', 500000, 'Luận văn tháng 12Luận văn tháng 12Luận văn tháng 12Luận văn tháng 12', 'Thời Trang Nam', 'Quần Jeans', 'images_product/xeC3u2I75aje1oq2xYEWikrw78ePhETHO2vfnq4j.jpg', 1, NULL, NULL),
(21, 13, 1, 76, 'Áo Thun BiGSIZE', 150000, 'Áo Thun Nam dành cho BIGBoy', 'Thời Trang Nam', 'Áo thun', 'images_product/t5nf5K3WSuZUPrIh5f0XvcU9iycsrso9WHTw2xjs.jpg', 1, NULL, NULL),
(22, 13, 2, 8, 'Áo sơ mi nữ za', 500000, 'áo sơ mi nữ za', 'Thời Trang Nữ', 'Áo sơ mi nữ', 'images_product/5WvgDwiU64Bx4EOWmEGb5o7PzBiMUcDPHklOSxUM.jpg', 1, NULL, NULL),
(23, 13, 1, 88, 'Thắt lưng nam da cao cấp, dây lưng nam mặt khóa tự động sang trọng, nịt da màu đen TLĐ01', 26000, 'Thắt lưng nam da cao cấp, dây lưng nam mặt khóa tự động sang trọng, nịt da màu đen TLĐ01.\r\nKích thước thắt lưng da nam: 3,5x120cm', 'Thời Trang Nam', 'THẮT LƯNG', 'images_product/kjxzeRHDE1HKNKSKigOdgRQYoI9KPSiEgIdE2Yp1.webp', 1, NULL, NULL),
(24, 13, 1, 90, 'Kính râm nam đổi màu Seisen Kr13 kính mát gọng vuông retro đơn giản thời trang gọng kính chống ánh sáng xanh', 31000, 'THÔNG TIN SẢN PHẨM\r\n+ Tên sản phẩm: Kính râm nam đổi màu Seisen Kr13 kính mát gọng vuông retro đơn giản thời trang gọng kính chống ánh sáng xanh\r\n+ Nguyên liệu khung: nhựa + kim loại\r\n+ Chức năng ống kính: Chống ánh sáng xanh', 'Thời Trang Nam', 'Kính Mắt Nam', 'images_product/lPg4pCZfwiyuEy6ULYttolSBRTXk1Ohf4zElgoSy.webp', 0, NULL, NULL),
(25, 13, 1, 90, 'Kính râm nam đổi màu Seisen Kr13 kính mát gọng vuông retro đơn giản thời trang gọng kính chống ánh sáng xanh', 31000, 'THÔNG TIN SẢN PHẨM\r\n+ Tên sản phẩm: Kính râm nam đổi màu Seisen Kr13 kính mát gọng vuông retro đơn giản thời trang gọng kính chống ánh sáng xanh\r\n+ Nguyên liệu khung: nhựa + kim loại\r\n+ Chức năng ống kính: Chống ánh sáng xanh', 'Thời Trang Nam', 'Kính Mắt Nam', 'images_product/y7uBlFrm752hWCOFjPTdFRIgpY7sIDYg4PubYjD6.webp', 1, NULL, NULL),
(26, 13, 1, 90, 'Mắt kính Samjune chống ánh sáng xanh giảm tiếng ồn thoải mái cho nam nữ', 32000, 'Giá thấp nhất!\r\nChất lượng cao nhất\r\nChúng tôi có nhà máy sản xuất kính nên sẽ không bao giờ hết hàng!\r\nTất cả sản phẩm của shop đều là hàng có sẵn!\r\nCod: Thanh toán bằng tiền mặt khi giao\r\nVận chuyển nhanh chóng', 'Thời Trang Nam', 'Kính Mắt Nam', 'images_product/8lMKjhXw7RPJ1wB46jz0sT3s8EvMQy1ubyQaldXc.webp', 1, NULL, NULL),
(27, 13, 1, 78, '(Combo 2 Quần Short) Kaki Dù PN.STORE 1993 dáng Trên Gối Bản Nâng Cấp đường May Menswear Nam', 80000, '1993 - Dáng Trên Gối, Bản Nâng Cấp Đường May Menswear Nam \r\nChất liệu cao cấp:', 'Thời Trang Nam', 'Quần short nam', 'images_product/mTjiFORBpdHl2jIiKScdiJAGh1fUL9b4c5vzVUuq.webp', 1, NULL, NULL),
(28, 13, 1, 78, 'Quần Đùi Nam Nữ Thun Cotton AmericanStyle Đập Tan Nóng Bức Mặc Nhà, Mặc Làm Quần Ngủ Có Bigsize', 100000, '- Quần đùi nam nữ mặc nhà là những chiếc quần đùi nam, quần ngủ cotton 100%  cao cấp chất mát thông thoáng mặc hàng ngày hay mặc ngủ thỏa mái siêu dễ thương và có lợi cho sức khỏe', 'Thời Trang Nam', 'Quần short nam', 'images_product/jtY22wfisRzLHWygu7iaAJgmHRBsglqy5sYbxEYH.webp', 1, NULL, NULL),
(29, 13, 3, 87, 'Điện thoại HONOR X5b Plus (4+4)GB+128GB | Pin 5200mAh 90Hz | Màn hình 6.56\" | Bảo Hành 13 Tháng', 2490000, 'Thương hiệU  HONOR', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/sQzAt5rD34xvg3J9ar4KJukumLrj6ssYAUxc5BiB.webp', 1, NULL, NULL),
(30, 13, 3, 87, 'iện thoại Gaming Nubia Neo 2| 20(8+12)GB/256GB| 6.72\'\' 120Hz | Sạc nhanh 33W| Bảo hành 18 tháng', 4429000, 'Thương hiệu nubia', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/6myGiYNeJhIDqkxwgmTXYfNPCLqW3Wv5WhmowCLH.webp', 1, NULL, NULL),
(31, 13, 3, 87, 'Điện Thoại Samsung Galaxy A26 5G 8GB/128GB', 6940000, 'Điện Thoại Samsung Galaxy A26 5G 8GB/128GB', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/nTeoiW3wo8IiezNeV9OJQ8PAxkBVoNFAbdKRldCO.webp', 1, NULL, NULL),
(32, 13, 3, 87, '[ Chính Hãng ] Mới 100% Điện thoại Oppo F11 6GB/128GB nguyên đẹp keng kèm Gửi toàn bộ hộp', 1280000, '[ Chính Hãng ] Mới 100% Điện thoại Oppo F11 6GB/128GB nguyên đẹp keng kèm Gửi toàn bộ hộp', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/3Dwdb2eJZhhmcg2MUq5z22P9CSrngxVZR3OECYvg.webp', 1, NULL, NULL),
(33, 13, 5, 85, 'Micro Máy Tính, Laptop Ziyou MK10 LED RGB Thu Âm Chống Nhiễu Kết Nối Jack USB Hoặc 3.5mm Dùng Live Stream, Học Online', 105000, 'Micro Máy Tính, Laptop Ziyou MK10 LED RGB Thu Âm Chống Nhiễu Kết Nối Jack USB Hoặc 3.5mm Dùng Live Stream, Học Online', 'Thiết Bị Điện Tử', 'Tai nghe có dây', 'images_product/n4iGu3Xqd8Es2L7YbNG36pUJZ0ZNWqG4oKookqMY.webp', 1, NULL, NULL),
(34, 13, 2, 8, 'Áo Thun AM Nam Nữ Tay Lỡ Form Rộng ALTHOUGH Ullzang', 41000, 'Áo Thun AM Nam Nữ Tay Lỡ Form Rộng ALTHOUGH Ullzang', 'Thời Trang Nữ', 'Áo sơ mi nữ', 'images_product/RU5A8QPBrZ2h46rkiDgQthMQRfM3ghPDFK3vTMdO.webp', 1, NULL, NULL),
(35, 13, 2, 92, 'Áo thun tay nữ lỡ form rộng chất cotton số 99phong cách Hàn Quốc COLASTORE M09', 23000, 'Áo thun tay nữ lỡ form rộng chất cotton số 99phong cách Hàn Quốc COLASTORE M09', 'Thời Trang Nữ', 'Áo thun', 'images_product/sQ2ccIJx6yKciq0Lp0WTbQp4d6zEzpJNUFFY7MaF.webp', 1, NULL, NULL),
(36, 13, 8, 31, '100 Cái Khẩu Trang 5D 3 Lớp Cao Cấp Chống Nắng Chống UV', 50000, '100 Cái Khẩu Trang 5D 3 Lớp Cao Cấp Chống Nắng Chống UV', 'Sức Khỏe', 'Vật tư y tế', 'images_product/Iocq9bRoEfFL5Lo3mIq3nk2GIpjogxDQIJr52uyI.webp', 1, NULL, NULL),
(37, 13, 9, 93, '-CLUBLU- Máy Ảnh Kỹ Thuật Số Selfie LK-003 Camera Kép Mini Digital 4K Video Cho Học Sinh Retro', 345000, '-CLUBLU- Máy Ảnh Kỹ Thuật Số Selfie LK-003 Camera Kép Mini Digital 4K Video Cho Học Sinh Retro', 'Máy Ảnh & Máy Quay Phim', 'MÁY ẢNH', 'images_product/lQU5fAL8c7c7GSYf1ATZmbPEZTKy1REJKzukDVsa.webp', 1, NULL, NULL),
(38, 13, 9, 93, '[Tặng thẻ nhớ] Máy ảnh kĩ thuật số digital mini camera v2 - quay, chụp 48MP, siêu mỏng nhỏ gọn', 745000, '[Tặng thẻ nhớ] Máy ảnh kĩ thuật số digital mini camera v2 - quay, chụp 48MP, siêu mỏng nhỏ gọn', 'Máy Ảnh & Máy Quay Phim', 'MÁY ẢNH', 'images_product/cILUWob7yrgfMCPUwHaFvij2qyEe2LCA38VkvyAn.webp', 1, NULL, NULL),
(39, 13, 9, 93, 'Máy ảnh kỹ thuật số YMX H16, Máy ảnh kỹ thuật số điểm và bắn FHD 4K 48MP cho trẻ em với Zoom 16X, Thẻ 32GB, Chống rung', 915000, 'Máy ảnh kỹ thuật số YMX H16, Máy ảnh kỹ thuật số điểm và bắn FHD 4K 48MP cho trẻ em với Zoom 16X, Thẻ 32GB, Chống rung', 'Máy Ảnh & Máy Quay Phim', 'MÁY ẢNH', 'images_product/UmDBPXaQY9wOGTPmQnQIbFKDIYdWRoI01OMf5aSB.webp', 1, NULL, NULL),
(40, 13, 9, 93, 'Máy ảnh lấy liền FUJIFILM Instax Mini Evo Hybrid - Hàng chính hãng', 7500000, 'Máy ảnh lấy liền FUJIFILM Instax Mini Evo Hybrid - Hàng chính hãng', 'Máy Ảnh & Máy Quay Phim', 'MÁY ẢNH', 'images_product/NeqneE4tv2acMUFmlGaVZFfq1SF4TTtWNsOk5GUZ.webp', 1, NULL, NULL),
(41, 13, 9, 36, 'Film chụp lấy liền Fujifilm Instax Mini viền trắng - Hàng chính hãng', 500000, 'Film chụp lấy liền Fujifilm Instax Mini viền trắng - Hàng chính hãng', 'Máy Ảnh & Máy Quay Phim', 'Phụ kiện máy ảnh', 'images_product/7JuQbIxzrmo0HBchmAQoJDDbRbGL347K1HB9eMhU.webp', 1, NULL, NULL),
(42, 13, 9, 93, 'Xác máy ảnh digital cổ, máy film cổ không đảm bảo hoạt động (mẫu ngẫu nhiên random)', 521000, 'Xác máy ảnh digital cổ, máy film cổ không đảm bảo hoạt động (mẫu ngẫu nhiên random)', 'Máy Ảnh & Máy Quay Phim', 'MÁY ẢNH', 'images_product/49kqJDKfv1TEUUYo8OyHQa3O6ydTtLPnkgroYJFU.webp', 1, NULL, NULL),
(43, 13, 1, 77, 'Quần Jean Nam Dáng Baggy Ống Suông Wash Smoke 2 Màu Chất Vải Dày Dặn The Jeans', 145000, 'Quần Jean Nam Dáng Baggy Ống Suông Wash Smoke 2 Màu Chất Vải Dày Dặn The Jeans', 'Thời Trang Nam', 'Quần dài & quần âu', 'images_product/XiXRRdXin6gd6QzQx15Y43SC7wUTSMhfBDGbZEtE.webp', 1, NULL, NULL),
(44, 13, 1, 75, 'Áo Khoác Jean Unisex Màu Đen Phong Cách Trẻ Trung Chất Vải Jean Dày Dặn The Jeans', 239000, 'Áo Khoác Jean Unisex Màu Đen Phong Cách Trẻ Trung Chất Vải Jean Dày Dặn The Jeans', 'Thời Trang Nam', 'Áo khoác', 'images_product/v9OkTxiZvMegsTE9SehnJ9eCvE38qP43Cpkobl1t.webp', 1, NULL, NULL),
(45, 13, 1, 75, 'Áo Khoác Kaki Unisex Form Rộng 2 Màu Trơn Phong Cách Thời Trang Hàn Quốc The Jeans', 219000, 'Áo Khoác Kaki Unisex Form Rộng 2 Màu Trơn Phong Cách Thời Trang Hàn Quốc The Jeans', 'Thời Trang Nam', 'Áo khoác', 'images_product/uI7ZiXHF8GCE7WwktgzvNjs9UWltg62fhUqXflKo.webp', 1, NULL, NULL),
(46, 13, 1, 7, 'SIXHUMAN - Áo sơ mi Unisex nam nữ dài tay oxford kẻ sọc phối line Boiz HM1115', 138000, 'SIXHUMAN - Áo sơ mi Unisex nam nữ dài tay oxford kẻ sọc phối line Boiz HM1115', 'Thời Trang Nam', 'Áo sơ mi nam', 'images_product/At2C8qsKX746pmYWyPlCzpLNGr4ZOWPYNmUTolXx.webp', 1, NULL, NULL),
(47, 13, 1, 7, 'Áo Sơ Mi Streetwear Xuân Hè, Phong Cách Thể Thao thêu logo, Form Rộng Thoáng Khí SIXHUMAN HM236', 149000, 'Áo Sơ Mi Streetwear Xuân Hè, Phong Cách Thể Thao thêu logo, Form Rộng Thoáng Khí SIXHUMAN HM236', 'Thời Trang Nam', 'Áo sơ mi nam', 'images_product/PsKaLBJrR4rWyxNbZMmodyisNT2VckMpTsaJL2aV.webp', 1, NULL, NULL),
(48, 13, 1, 7, 'SIXHUMAN - Áo sơ mi Tuytsi kẻ sọc chéo in chữ phong cách hiện đại độc đáo HM201', 159300, 'SIXHUMAN - Áo sơ mi Tuytsi kẻ sọc chéo in chữ phong cách hiện đại độc đáo HM201', 'Thời Trang Nam', 'Áo sơ mi nam', 'images_product/cewnsysPV1WCd9Y9VoXIwkxi8NkQTIX7FUTJPx27.webp', 1, NULL, NULL),
(49, 13, 1, 75, 'Áo Khoác Gió Nam Nữ Mặc Được 2 Mặt,Chất Liệu Gió Tráng Bạc Chống Nước Cản Gió Bụi', 118000, 'Áo Khoác Gió Nam Nữ Mặc Được 2 Mặt,Chất Liệu Gió Tráng Bạc Chống Nước Cản Gió Bụi', 'Thời Trang Nam', 'Áo khoác', 'images_product/rkIX5DY9X0XeOCDhqEJ5rIHHNANBw3zRrG7suqks.webp', 1, NULL, NULL),
(50, 13, 3, 87, 'Điện thoại Apple iPhone 16 Plus 256GB', 26290000, 'Điện thoại Apple iPhone 16 Plus 256GB', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/DMA4FxsERCNapO3FPRQh9LSLKIGLsQWNWYPqhGAV.webp', 1, NULL, NULL),
(51, 13, 3, 87, 'iPhone 16 Plus 256GB Chính Hãng VN/A', 26290000, 'iPhone 16 Plus 256GB Chính Hãng VN/A', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/z9eUrfrDvNfpBJFZQo20jsQ88OE9tBiNMQbis0Aa.webp', 1, NULL, NULL),
(52, 13, 3, 87, 'iPhone 11 128GB Chính Hãng VN/A', 10200000, 'iPhone 11 128GB Chính Hãng VN/A', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/tTAOVL134r9v2YPk0ZIvwJUvdkaDPu7yLb1S8pB4.webp', 1, NULL, NULL),
(53, 13, 3, 87, 'ĐT 𝟭2 64GB/128/256GB Sang trọng,nhỏ gọn - 2 Camera chéo sắc nét - Cấu hình mạnh mẽ - BH 6 THÁNG', 6950000, 'ĐT 𝟭2 64GB/128/256GB Sang trọng,nhỏ gọn - 2 Camera chéo sắc nét - Cấu hình mạnh mẽ - BH 6 THÁNG', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/ve0OmCCu4auvxRBgvz9MOBoSHoBEzIMAqprqPQGY.webp', 1, NULL, NULL),
(54, 13, 3, 87, 'ĐT 𝟭𝟱 128GB/256GB Thiết kế cao cấp - Mượt mà - Ổn định - Camera sắc nét - Zin all - BH 6 tháng', 14650000, 'ĐT 𝟭𝟱 128GB/256GB Thiết kế cao cấp - Mượt mà - Ổn định - Camera sắc nét - Zin all - BH 6 tháng', 'Điện Thoại & Phụ Kiện', 'Điện thoại thông minh', 'images_product/rJp2FLdTltrbxSHMgUkzJs3RDkuMzSBx6jsJqAfH.webp', 1, NULL, NULL),
(55, 13, 4, 17, 'Lưu Chim Cánh Cụt Gõ Đồ Chơi Đá, Máy Phá Băng Gõ Và Tháo Lắp Bảng Tường Trò Chơi Mới Lạ Trò Chơi Tương Tác Đồ Chơi', 20000, 'Lưu Chim Cánh Cụt Gõ Đồ Chơi Đá, Máy Phá Băng Gõ Và Tháo Lắp Bảng Tường Trò Chơi Mới Lạ Trò Chơi Tương Tác Đồ Chơi', 'Đồ Chơi', 'Đồ chơi giải trí', 'images_product/Afniqud63AmnJLKA3ALWwYNOq6V0Il8RqtXtQCdo.webp', 1, NULL, NULL),
(56, 13, 4, 17, 'Xe ô tô điện trẻ em Mec G63 AMG 4 bánh 2 động cơ có điều khiển từ xa an toàn cho bé tải trọng 60kg xe ô tô điện Bibocar', 2300000, 'Xe ô tô điện trẻ em Mec G63 AMG 4 bánh 2 động cơ có điều khiển từ xa an toàn cho bé tải trọng 60kg xe ô tô điện Bibocar', 'Đồ Chơi', 'Đồ chơi giải trí', 'images_product/YnCpXok81xLEQo4ApKTB6xQMUMRYzDE1xaHlRLyQ.webp', 1, NULL, NULL),
(57, 13, 4, 17, 'Xe ô tô điện, xe ô tô bán tải F-150 cho bé siêu ngầu tải trọng lớn 4 động cơ, có điều khiển từ xa_Hulk.Kids', 3254000, 'Xe ô tô điện, xe ô tô bán tải F-150 cho bé siêu ngầu tải trọng lớn 4 động cơ, có điều khiển từ xa_Hulk.Kids', 'Đồ Chơi', 'Đồ chơi giải trí', 'images_product/78RVyydJhKGumUyt0psda4FFDEDJcJfL40uCMNHU.webp', 1, NULL, NULL),
(58, 13, 4, 17, 'Đồ chơi cầu trượt Vịt vàng leo cầu thang với âm thanh vui nhộn + Đèn nháy đẹp mắt', 39000, 'Đồ chơi cầu trượt Vịt vàng leo cầu thang với âm thanh vui nhộn + Đèn nháy đẹp mắt', 'Đồ Chơi', 'Đồ chơi giải trí', 'images_product/8sjSeaF3yQYQQDChXaPy0iSjZ7Go0L9bbQD0zvru.webp', 1, NULL, NULL),
(59, 13, 7, 26, 'Bộ Máy Tính PC Mới 100% Dùng Văn Phòng i3,i5,i7 ram 8G 16G SSD 128G Cài Sẵn Win Và Ứng Dụng Cơ Bản - Bảo Hành 3 Năm', 6500000, 'Bộ Máy Tính PC Mới 100% Dùng Văn Phòng i3,i5,i7 ram 8G 16G SSD 128G Cài Sẵn Win Và Ứng Dụng Cơ Bản - Bảo Hành 3 Năm', 'Máy Tính Laptop', 'Máy tình bàn', 'images_product/WVu0TNPMe5rNKQwoAM8lyAY9EqcOQdg8mKPknzuN.webp', 1, NULL, NULL),
(60, 13, 7, 28, 'Laptop Dell Latitude 7300 I5-8250U/32GB/512GB SSD/13.3 inch FHD mỏng nhẹ, pin trâu, màn đẹp, văn phòng giải trí OK', 8365000, 'Laptop Dell Latitude 7300 I5-8250U/32GB/512GB SSD/13.3 inch FHD mỏng nhẹ, pin trâu, màn đẹp, văn phòng giải trí OK', 'Máy Tính Laptop', 'Laptop', 'images_product/DnIBr7rCoR3XiEFgSOAu4HKSbk3jhBgNHXoKpvqk.webp', 1, NULL, NULL),
(61, 13, 7, 28, 'Laptop ASUS Laptop Chơi Game Intel Core i7 8086K Windows 11 RAM 16GB SSD 256GB / 512GB 15.6 Inch Hỗ Trợ Mở Khóa Vân Tay', 7339000, 'Laptop ASUS Laptop Chơi Game Intel Core i7 8086K Windows 11 RAM 16GB SSD 256GB / 512GB 15.6 Inch Hỗ Trợ Mở Khóa Vân Tay', 'Máy Tính Laptop', 'Laptop', 'images_product/L1G1vZLE5dj4QR3k3casIMWGBh90dYQLSoWfrvHS.webp', 1, NULL, NULL),
(62, 13, 7, 26, 'Bộ Máy Tính Bể Cá Hai Mặt Kính HNQ Core i7 i5 i3, Ram 8Gb/16Gb, SSD 256 GB Card Rời GT7xx Chơi Mượt Mọi Game Online', 3250000, 'Bộ Máy Tính Bể Cá Hai Mặt Kính HNQ Core i7 i5 i3, Ram 8Gb/16Gb, SSD 256 GB Card Rời GT7xx Chơi Mượt Mọi Game Online', 'Máy Tính Laptop', 'Máy tình bàn', 'images_product/yoHhFywRg3X3Ctm8t7E36ivmAAMScKkhg0p49GPv.webp', 1, NULL, NULL),
(63, 13, 7, 26, 'Bộ máy tính I5 Siêu nhanh chơi game Liên Minh, Đột Kích ,Free Fire ,Truy Kích, Audition MỚI 99%', 3791000, 'Bộ máy tính I5 Siêu nhanh chơi game Liên Minh, Đột Kích ,Free Fire ,Truy Kích, Audition MỚI 99%', 'Máy Tính Laptop', 'Máy tình bàn', 'images_product/KlJwWYgOwHLFnM3UcBH3kACGbnMqBooNnx4L4EEh.webp', 1, NULL, NULL),
(64, 13, 7, 28, 'Laptop Gamming Asus TUF FX506, Core i5-10300H, Ram 16GB, SSD 512GB, màn hình 15.6 inch Full HD 144hz, VGA GTX 1660Ti', 15900000, 'Laptop Gamming Asus TUF FX506, Core i5-10300H, Ram 16GB, SSD 512GB, màn hình 15.6 inch Full HD 144hz, VGA GTX 1660Ti', 'Máy Tính Laptop', 'Laptop', 'images_product/VN4lu0RwCki2uOaq27nsinM1whV3oPmxdn5sWJUy.webp', 1, NULL, NULL),
(65, 13, 10, 37, 'COMBO 3 BƯỚC DƯỠNG SIMPLE NƯỚC TẨY TRANG 200ML + SỮA RỬA MẶT 150ML + NƯỚC HOA HỒNG 200ML', 217550, 'COMBO 3 BƯỚC DƯỠNG SIMPLE NƯỚC TẨY TRANG 200ML + SỮA RỬA MẶT 150ML + NƯỚC HOA HỒNG 200ML', 'Sắc Đẹp', 'Chăm sóc da mặt', 'images_product/iVCm2Qh6wNydGcUrnHKBCsEEFBR1oCdSJYqRF3bd.webp', 1, NULL, NULL),
(66, 13, 15, 94, 'Sách Hoàng tử bé (Phiên bản minh họa màu đặc biệt) - Nhà Xuất bản Đồng Nai', 24000, 'Sách Hoàng tử bé (Phiên bản minh họa màu đặc biệt) - Nhà Xuất bản Đồng Nai', 'Nhà Sách Online', 'SÁCH TIỂU THUYẾT', 'images_product/F2hH3luQFKeb5VJajS3k0ZdA8oEuZtyyG8vfmhuf.webp', 1, NULL, NULL),
(67, 13, 15, 94, 'Combo Sách Trốn Lên Mái Nhà Để Khóc - Thưa ngoại con đã về, Mẹ làm gì có ước mơ', 44000, 'Combo Sách Trốn Lên Mái Nhà Để Khóc - Thưa ngoại con đã về, Mẹ làm gì có ước mơ', 'Nhà Sách Online', 'SÁCH TIỂU THUYẾT', 'images_product/5EsujOKorrXsPkWSwb0syLr7lyIkaKb2P8NY7PJP.webp', 1, NULL, NULL),
(68, 13, 15, 94, 'Sách - Một Đời Dài Rộng Hãy Thương Lấy Mình', 84000, 'Sách - Một Đời Dài Rộng Hãy Thương Lấy Mình', 'Nhà Sách Online', 'SÁCH TIỂU THUYẾT', 'images_product/jHUM3A4LteEihZPlXIF9eOg7EK0YxrP6ZGOZQkXc.webp', 1, NULL, NULL),
(69, 13, 5, 20, 'Smart tivi 55 inch Qled 4K tivi Khung Tranh Google Frame tivi coocaa - 55LN7000G', 9949000, 'Smart tivi 55 inch Qled 4K tivi Khung Tranh Google Frame tivi coocaa - 55LN7000G', 'Thiết Bị Điện Tử', 'Tivi', 'images_product/N7w93eEE96SD3jJEiMgFRXmA60SbX5GRHN9Fyvqq.webp', 1, NULL, NULL),
(70, 13, 5, 20, 'Google Tivi Coocaa Qled 55\"-55Y73 Pro-tặng 4 gói truyền hình 12 tháng', 8549000, 'Google Tivi Coocaa Qled 55\"-55Y73 Pro-tặng 4 gói truyền hình 12 tháng', 'Thiết Bị Điện Tử', 'Tivi', 'images_product/J66dhk0X6Nnb9JuvDkYn6jkBlQJqGjrXY3TbMrSN.webp', 1, NULL, NULL),
(71, 13, 5, 20, 'Smart TV HD Coocaa 32 Inch Wifi - Model 32S3U+', 3149000, 'Smart TV HD Coocaa 32 Inch Wifi - Model 32S3U+', 'Thiết Bị Điện Tử', 'Tivi', 'images_product/068kbe270R8ZCTym3qPcXtxf2rx0ZKwC6u4RMCXP.webp', 1, NULL, NULL),
(72, 13, 5, 20, 'Smart Tivi Samsung 4K DU7000KXXV - Miễn phí lắp đặt', 6999000, 'Smart Tivi Samsung 4K DU7000KXXV - Miễn phí lắp đặt', 'Thiết Bị Điện Tử', 'Tivi', 'images_product/NqIv0KoxGs8EVXh9eVV9VYO3HSUsc5gpBppsONOq.webp', 1, NULL, NULL),
(73, 13, 5, 20, 'SMART Tivi FHD 43 Inch 43S3U+ Coocaa inch - tivi giá rẻ', 4339000, 'SMART Tivi FHD 43 Inch 43S3U+ Coocaa inch - tivi giá rẻ', 'Thiết Bị Điện Tử', 'Tivi', 'images_product/uuClQcXq5AOUoS1w8mK6GAtpYUI9Fe1RgxpYwstY.webp', 1, NULL, NULL),
(74, 13, 5, 20, 'Google Tivi Coocaa 4K 55 Inch - Model 55Y73', 7949000, 'Google Tivi Coocaa 4K 55 Inch - Model 55Y73', 'Thiết Bị Điện Tử', 'Tivi', 'images_product/dePUfnJQp6a50FEHGCUjsCYz8oLpEjzmWHhYWUaF.webp', 1, NULL, NULL),
(75, 13, 5, 20, 'Smart Tivi Samsung QLED Q60DAKXXV - Miễn phí lắp đặt', 12940000, 'Smart Tivi Samsung QLED Q60DAKXXV - Miễn phí lắp đặt', 'Thiết Bị Điện Tử', 'Tivi', 'images_product/fQkqaQHsrrGmtUzTKCJLcWBjESYlBtXH9zj2h8NR.webp', 1, NULL, NULL),
(76, 13, 9, 30, 'Máy in đơn hàng AYIN in từ điện thoại khổ A6 A7 in đơn GHTK,mã vận đơn,phiếu gửi hàng,logo BH 15 tháng', 607000, 'Máy in đơn hàng AYIN in từ điện thoại khổ A6 A7 in đơn GHTK,mã vận đơn,phiếu gửi hàng,logo BH 15 tháng', 'Máy Ảnh & Máy Quay Phim', 'Máy in & Scan', 'images_product/AlydVYTI3OCyN7W6honSi6Cm2qC5IJ7wzlZjwzAq.webp', 1, NULL, NULL),
(77, 13, 6, 21, 'Ruột gối đầu pillow kích cỡ 45cmx65cm Cao Cấp mềm mại chống mỏi cổ', 25000, 'Ruột gối đầu pillow kích cỡ 45cmx65cm Cao Cấp mềm mại chống mỏi cổ', 'Nhà Cửa & Đời Sống', 'Chăn ga gối đệm', 'images_product/QqTV2ot96zDS0Sj7HHQYiz68nbEJ8H1Ozze1mlFh.webp', 1, NULL, NULL),
(78, 13, 6, 24, 'Móc Dán Tường Inox Móc Đơn Treo Dán Tường Nhà Tắm Nhà Bếp Đa Năng Kèm Móc Inox treo đồ tiện lợi', 1500, 'Móc Dán Tường Inox Móc Đơn Treo Dán Tường Nhà Tắm Nhà Bếp Đa Năng Kèm Móc Inox treo đồ tiện lợi', 'Nhà Cửa & Đời Sống', 'Dụng cụ & thiết bị tiện ích', 'images_product/gPw6mr72vxm3Xi2Vxq9lgZrGOegTaWqQAPH8KQpf.webp', 1, NULL, NULL),
(79, 13, 6, 24, 'Thùng rác lưới thép màu đen,công nghệ nướng kim loại,giỏ đựng giấy vụn văn phòng/sọt đựng quần áo bẩn，tặng túi đựng rác', 30000, 'Thùng rác lưới thép màu đen,công nghệ nướng kim loại,giỏ đựng giấy vụn văn phòng/sọt đựng quần áo bẩn，tặng túi đựng rác', 'Nhà Cửa & Đời Sống', 'Dụng cụ & thiết bị tiện ích', 'images_product/mz4GenLQThaFIhvLpFsm4faXIvG4GSz7Xyp2qKV1.webp', 1, NULL, NULL),
(80, 13, 6, 24, 'Bông Tắm Tròn Cao Cấp 2 Màu - Siêu Tạo Bọt Kì Cọ Tẩy Da Chết 2458-THẾ GIỚI TIỆN ÍCH', 1000, 'Bông Tắm Tròn Cao Cấp 2 Màu - Siêu Tạo Bọt Kì Cọ Tẩy Da Chết 2458-THẾ GIỚI TIỆN ÍCH', 'Nhà Cửa & Đời Sống', 'Dụng cụ & thiết bị tiện ích', 'images_product/ZxiFL7Nk8NGtxIn7SsY1LScfSoEtz9uTetd8pqbQ.webp', 1, NULL, NULL),
(81, 13, 6, 24, 'Thanh Chặn Khe Cửa Đa Năng Ngăn Côn Trùng,Chắn Gió Mùa,Ngừa Bụi Bẩn,Giảm Ồn', 7500, 'Thanh Chặn Khe Cửa Đa Năng Ngăn Côn Trùng,Chắn Gió Mùa,Ngừa Bụi Bẩn,Giảm Ồn', 'Nhà Cửa & Đời Sống', 'Dụng cụ & thiết bị tiện ích', 'images_product/eZlRw6OZBeTH372i6BuVBJ6lOYhGShA6V5HkXdKR.webp', 1, NULL, NULL),
(82, 14, 1, 76, 'Áo thun nam 9/6', 150000, 'áo thun cơ dãn', 'Thời Trang Nam', 'Áo thun', 'images_product/BAYxr4q25esrRsZ0ol46y6RdzEMKRDEuHW7OWr18.webp', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_combinations`
--

CREATE TABLE `products_combinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `combination_string` varchar(255) NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `avaiable_stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_combinations`
--

INSERT INTO `products_combinations` (`id`, `product_id`, `combination_string`, `price`, `avaiable_stock`, `created_at`, `updated_at`) VALUES
(23, 7, 'S', NULL, 14, '2025-10-07 05:08:52', '2025-10-07 05:08:52'),
(24, 7, 'M', NULL, 12, '2025-10-07 05:08:52', '2025-10-07 05:08:52'),
(25, 7, 'L', NULL, 13, '2025-10-07 05:08:52', '2025-10-07 05:08:52'),
(26, 7, 'XL', NULL, 14, '2025-10-07 05:08:52', '2025-10-07 05:08:52'),
(27, 8, '', NULL, 100, '2025-10-07 07:27:09', '2025-10-07 07:27:09'),
(28, 9, '', NULL, 100, '2025-10-07 09:16:14', '2025-10-07 09:16:14'),
(29, 10, 'Đen', NULL, 50, '2025-10-07 09:19:34', '2025-10-07 09:19:34'),
(30, 10, 'Xanh', NULL, 46, '2025-10-07 09:19:34', '2025-10-07 09:19:34'),
(31, 11, 'S', NULL, 15, '2025-10-07 12:08:56', '2025-10-07 12:08:56'),
(32, 11, 'M', NULL, 12, '2025-10-07 12:08:56', '2025-10-07 12:08:56'),
(33, 11, 'L', NULL, 13, '2025-10-07 12:08:56', '2025-10-07 12:08:56'),
(34, 11, 'XL', NULL, 14, '2025-10-07 12:08:56', '2025-10-07 12:08:56'),
(35, 12, 'S', NULL, 15, '2025-10-07 12:11:20', '2025-10-07 12:11:20'),
(36, 12, 'M', NULL, 12, '2025-10-07 12:11:20', '2025-10-07 12:11:20'),
(37, 12, 'L', NULL, 13, '2025-10-07 12:11:20', '2025-10-07 12:11:20'),
(38, 12, 'XL', NULL, 14, '2025-10-07 12:11:20', '2025-10-07 12:11:20'),
(39, 13, 'Xanh rêu S', NULL, 78, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(40, 13, 'Xanh rêu M', NULL, 167, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(41, 13, 'Xanh rêu L', NULL, 145, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(42, 13, 'Xanh rêu XL', NULL, 132, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(43, 13, 'Be S', NULL, 145, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(44, 13, 'Be M', NULL, 49, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(45, 13, 'Be L', NULL, 0, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(46, 13, 'Be XL', NULL, 146, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(47, 13, 'Đen S', NULL, 46, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(48, 13, 'Đen M', NULL, 66, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(49, 13, 'Đen L', NULL, 77, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(50, 13, 'Đen XL', NULL, 0, '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(51, 14, 'Xanh lam S', NULL, 10, '2025-10-07 01:12:08', '2025-10-07 01:12:08'),
(52, 14, 'Xanh lam M', NULL, 9, '2025-10-07 01:12:08', '2025-10-07 01:12:08'),
(53, 14, 'Xanh lam L', NULL, 12, '2025-10-07 01:12:08', '2025-10-07 01:12:08'),
(54, 14, 'Xanh lam XL', NULL, 15, '2025-10-07 01:12:08', '2025-10-07 01:12:08'),
(55, 14, 'Hồng S', NULL, 26, '2025-10-07 01:12:08', '2025-10-07 01:12:08'),
(56, 14, 'Hồng M', NULL, 25, '2025-10-07 01:12:09', '2025-10-07 01:12:09'),
(57, 14, 'Hồng L', NULL, 19, '2025-10-07 01:12:09', '2025-10-07 01:12:09'),
(58, 14, 'Hồng XL', NULL, 31, '2025-10-07 01:12:09', '2025-10-07 01:12:09'),
(59, 15, 'S', NULL, 15, '2025-10-07 04:47:58', '2025-10-07 04:47:58'),
(60, 15, 'M', NULL, 12, '2025-10-07 04:47:58', '2025-10-07 04:47:58'),
(61, 15, 'L', NULL, 13, '2025-10-07 04:47:58', '2025-10-07 04:47:58'),
(62, 15, 'XL', NULL, 14, '2025-10-07 04:47:58', '2025-10-07 04:47:58'),
(63, 16, 'S', NULL, 15, '2025-10-07 04:49:04', '2025-10-07 04:49:04'),
(64, 16, 'M', NULL, 12, '2025-10-07 04:49:04', '2025-10-07 04:49:04'),
(65, 16, 'L', NULL, 13, '2025-10-07 04:49:04', '2025-10-07 04:49:04'),
(66, 16, 'XL', NULL, 14, '2025-10-07 04:49:04', '2025-10-07 04:49:04'),
(67, 17, 'Đen', NULL, 9, '2025-10-07 04:51:54', '2025-10-07 04:51:54'),
(68, 17, 'Be', NULL, 11, '2025-10-07 04:51:54', '2025-10-07 04:51:54'),
(69, 18, 'Đen S', NULL, 18, '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(70, 18, 'Đen M', NULL, 27, '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(71, 18, 'Đen L', NULL, 19, '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(72, 18, 'Đen XL', NULL, 29, '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(73, 18, 'Trắng S', NULL, 25, '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(74, 18, 'Trắng M', NULL, 26, '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(75, 18, 'Trắng L', NULL, 25, '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(76, 18, 'Trắng XL', NULL, 24, '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(77, 19, 'S', NULL, 15, '2025-10-07 12:42:24', '2025-10-07 12:42:24'),
(78, 19, 'M', NULL, 12, '2025-10-07 12:42:24', '2025-10-07 12:42:24'),
(79, 19, 'L', NULL, 13, '2025-10-07 12:42:24', '2025-10-07 12:42:24'),
(80, 19, 'XL', NULL, 14, '2025-10-07 12:42:24', '2025-10-07 12:42:24'),
(81, 20, 'Đen S', NULL, 8, '2025-10-07 19:45:42', '2025-10-07 19:45:42'),
(82, 20, 'Đen M', NULL, 9, '2025-10-07 19:45:42', '2025-10-07 19:45:42'),
(83, 20, 'Trắng S', NULL, 12, '2025-10-07 19:45:42', '2025-10-07 19:45:42'),
(84, 20, 'Trắng M', NULL, 0, '2025-10-07 19:45:42', '2025-10-07 19:45:42'),
(85, 21, 'Áo A', NULL, 2, '2025-10-07 05:47:29', '2025-10-07 05:47:29'),
(86, 21, 'B', NULL, 4, '2025-10-07 05:47:29', '2025-10-07 05:47:29'),
(87, 21, 'Áo C', NULL, 1, '2025-10-07 05:47:29', '2025-10-07 05:47:29'),
(88, 21, 'D', NULL, 7, '2025-10-07 05:47:29', '2025-10-07 05:47:29'),
(89, 22, 'Đỏ S', NULL, 2, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(90, 22, 'Đỏ M', NULL, 1, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(91, 22, 'Đỏ L', NULL, 3, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(92, 22, 'Đỏ XL', NULL, 2, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(93, 22, 'Xanh S', NULL, 1, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(94, 22, 'Xanh M', NULL, 4, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(95, 22, 'Xanh L', NULL, 5, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(96, 22, 'Xanh XL', NULL, 5, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(97, 22, 'Đen S', NULL, 1, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(98, 22, 'Đen M', NULL, 2, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(99, 22, 'Đen L', NULL, 3, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(100, 22, 'Đen XL', NULL, 4, '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(101, 23, 'Họa tiết đen mẫu 1 20cm', NULL, 1, '2025-10-07 14:00:26', '2025-10-07 14:00:26'),
(102, 23, 'Họa tiết đen mẫu 1 25cm', NULL, 1, '2025-10-07 14:00:26', '2025-10-07 14:00:26'),
(103, 23, 'Họa tiết đen mẫu số 2 20cm', NULL, 1, '2025-10-07 14:00:26', '2025-10-07 14:00:26'),
(104, 23, 'Họa tiết đen mẫu số 2 25cm', NULL, 1, '2025-10-07 14:00:26', '2025-10-07 14:00:26'),
(105, 24, 'Kính trong nhà', NULL, 1, '2025-10-07 14:51:28', '2025-10-07 14:51:28'),
(106, 24, 'Kính ngoài trời', NULL, 1, '2025-10-07 14:51:28', '2025-10-07 14:51:28'),
(107, 25, 'Kính trong nhà', NULL, 100, '2025-10-07 14:52:06', '2025-10-07 14:52:06'),
(108, 25, 'Kính ngoài trời', NULL, 100, '2025-10-07 14:52:06', '2025-10-07 14:52:06'),
(109, 26, 'BLACK', NULL, 100, '2025-10-07 15:00:42', '2025-10-07 15:00:42'),
(110, 26, 'BLUE', NULL, 100, '2025-10-07 15:00:42', '2025-10-07 15:00:42'),
(111, 26, 'GRAY', NULL, 100, '2025-10-07 15:00:42', '2025-10-07 15:00:42'),
(112, 26, 'LEOPARD', NULL, 100, '2025-10-07 15:00:42', '2025-10-07 15:00:42'),
(113, 27, 'ĐEN', NULL, 100, '2025-10-07 15:08:39', '2025-10-07 15:08:39'),
(114, 27, 'BE', NULL, 100, '2025-10-07 15:08:39', '2025-10-07 15:08:39'),
(115, 27, 'TRẮNG', NULL, 100, '2025-10-07 15:08:39', '2025-10-07 15:08:39'),
(116, 27, 'RÊU', NULL, 100, '2025-10-07 15:08:39', '2025-10-07 15:08:39'),
(117, 28, 'QUẦN ĐÙI 1', NULL, 100, '2025-10-07 15:12:11', '2025-10-07 15:12:11'),
(118, 28, 'QUẦN ĐÙI 2', NULL, 100, '2025-10-07 15:12:12', '2025-10-07 15:12:12'),
(119, 28, 'QUẦN ĐÙI 3', NULL, 100, '2025-10-07 15:12:12', '2025-10-07 15:12:12'),
(120, 28, 'QUẦN ĐÙI 4', NULL, 100, '2025-10-07 15:12:12', '2025-10-07 15:12:12'),
(121, 29, '', NULL, 10, '2025-10-07 15:15:18', '2025-10-07 15:15:18'),
(122, 30, '', NULL, 10, '2025-10-07 15:16:36', '2025-10-07 15:16:36'),
(123, 31, '', NULL, 1, '2025-10-07 15:17:42', '2025-10-07 15:17:42'),
(124, 32, '', NULL, 100, '2025-10-07 15:18:54', '2025-10-07 15:18:54'),
(125, 33, '', NULL, 100, '2025-10-07 15:20:38', '2025-10-07 15:20:38'),
(126, 34, '', NULL, 100, '2025-10-07 15:22:49', '2025-10-07 15:22:49'),
(127, 35, '', NULL, 100, '2025-10-07 15:25:05', '2025-10-07 15:25:05'),
(128, 36, '', NULL, 100, '2025-10-07 15:27:25', '2025-10-07 15:27:25'),
(129, 37, '', NULL, 100, '2025-10-07 15:29:20', '2025-10-07 15:29:20'),
(130, 38, 'SILVEL', NULL, 100, '2025-10-07 15:31:24', '2025-10-07 15:31:24'),
(131, 38, 'BLACK', NULL, 100, '2025-10-07 15:31:24', '2025-10-07 15:31:24'),
(132, 38, 'PINK', NULL, 100, '2025-10-07 15:31:24', '2025-10-07 15:31:24'),
(133, 39, 'SILVEL', NULL, 100, '2025-10-07 15:33:44', '2025-10-07 15:33:44'),
(134, 39, 'BLACK', NULL, 100, '2025-10-07 15:33:44', '2025-10-07 15:33:44'),
(135, 39, 'PINK', NULL, 100, '2025-10-07 15:33:44', '2025-10-07 15:33:44'),
(136, 40, '', NULL, 100, '2025-10-07 15:35:24', '2025-10-07 15:35:24'),
(137, 41, '', NULL, 1000, '2025-10-07 15:36:20', '2025-10-07 15:36:20'),
(138, 42, '', NULL, 100, '2025-10-07 15:37:49', '2025-10-07 15:37:49'),
(139, 43, '', NULL, 100, '2025-10-07 15:40:16', '2025-10-07 15:40:16'),
(140, 44, '', NULL, 100, '2025-10-07 15:41:27', '2025-10-07 15:41:27'),
(141, 45, '', NULL, 100, '2025-10-07 15:42:24', '2025-10-07 15:42:24'),
(142, 46, '', NULL, 100, '2025-10-07 15:44:40', '2025-10-07 15:44:40'),
(143, 47, '', NULL, 100, '2025-10-07 15:45:43', '2025-10-07 15:45:43'),
(144, 48, '', NULL, 100, '2025-10-07 15:47:02', '2025-10-07 15:47:02'),
(145, 49, '', NULL, 100, '2025-10-07 15:49:09', '2025-10-07 15:49:09'),
(146, 50, '', NULL, 100, '2025-10-07 15:52:26', '2025-10-07 15:52:26'),
(147, 51, '', NULL, 100, '2025-10-07 15:53:25', '2025-10-07 15:53:25'),
(148, 52, '', NULL, 100, '2025-10-07 15:54:08', '2025-10-07 15:54:08'),
(149, 53, '', NULL, 100, '2025-10-07 15:55:22', '2025-10-07 15:55:22'),
(150, 54, '', NULL, 100, '2025-10-07 15:56:21', '2025-10-07 15:56:21'),
(151, 55, '', NULL, 100, '2025-10-07 15:57:40', '2025-10-07 15:57:40'),
(152, 56, '', NULL, 100, '2025-10-07 15:58:33', '2025-10-07 15:58:33'),
(153, 57, '', NULL, 100, '2025-10-07 15:59:53', '2025-10-07 15:59:53'),
(154, 58, '', NULL, 100, '2025-10-07 16:00:43', '2025-10-07 16:00:43'),
(155, 59, '', NULL, 100, '2025-10-07 16:01:52', '2025-10-07 16:01:52'),
(156, 60, '', NULL, 100, '2025-10-07 16:03:38', '2025-10-07 16:03:38'),
(157, 61, '', NULL, 100, '2025-10-07 16:04:25', '2025-10-07 16:04:25'),
(158, 62, '', NULL, 100, '2025-10-07 16:05:11', '2025-10-07 16:05:11'),
(159, 63, '', NULL, 100, '2025-10-07 16:06:24', '2025-10-07 16:06:24'),
(160, 64, '', NULL, 100, '2025-10-07 16:07:32', '2025-10-07 16:07:32'),
(161, 65, '', NULL, 100, '2025-10-07 16:08:38', '2025-10-07 16:08:38'),
(162, 66, '', NULL, 100, '2025-10-07 16:11:05', '2025-10-07 16:11:05'),
(163, 67, '', NULL, 100, '2025-10-07 16:12:10', '2025-10-07 16:12:10'),
(164, 68, '', NULL, 100, '2025-10-07 16:13:46', '2025-10-07 16:13:46'),
(165, 69, '', NULL, 100, '2025-10-07 16:15:50', '2025-10-07 16:15:50'),
(166, 70, '', NULL, 100, '2025-10-07 16:16:51', '2025-10-07 16:16:51'),
(167, 71, '', NULL, 100, '2025-10-07 16:17:54', '2025-10-07 16:17:54'),
(168, 72, '', NULL, 100, '2025-10-07 16:19:17', '2025-10-07 16:19:17'),
(169, 73, '', NULL, 100, '2025-10-07 16:20:28', '2025-10-07 16:20:28'),
(170, 74, '', NULL, 100, '2025-10-07 16:21:31', '2025-10-07 16:21:31'),
(171, 75, '', NULL, 100, '2025-10-07 16:23:39', '2025-10-07 16:23:39'),
(172, 76, '', NULL, 100, '2025-10-07 16:26:00', '2025-10-07 16:26:00'),
(173, 77, '', NULL, 100, '2025-10-07 16:33:23', '2025-10-07 16:33:23'),
(174, 78, '', NULL, 100, '2025-10-07 16:34:28', '2025-10-07 16:34:28'),
(175, 79, '', NULL, 100, '2025-10-07 16:36:11', '2025-10-07 16:36:11'),
(176, 80, '', NULL, 1000, '2025-10-07 16:38:17', '2025-10-07 16:38:17'),
(177, 81, '', NULL, 100, '2025-10-07 16:39:25', '2025-10-07 16:39:25'),
(178, 82, 'ĐEN L', NULL, 3, '2025-10-07 19:43:25', '2025-10-07 19:43:25'),
(179, 82, 'ĐEN XL', NULL, 2, '2025-10-07 19:43:25', '2025-10-07 19:43:25'),
(180, 82, 'Xanh L', NULL, 6, '2025-10-07 19:43:25', '2025-10-07 19:43:25'),
(181, 82, 'Xanh XL', NULL, 1, '2025-10-07 19:43:25', '2025-10-07 19:43:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `imageProduct` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `imageProduct`, `created_at`, `updated_at`) VALUES
(10, 7, 'images_product/H3uyHuHsEGofD1yigdH6O7DNbF2LebJqmiZuMajX.jpg', '2025-10-07 05:08:52', '2025-10-07 05:08:52'),
(11, 8, 'images_product/tOsa8P6Q1jWFflEbvZ6MfPUjJ4pxsM9lnyZyANTB.jpg', '2025-10-07 07:27:09', '2025-10-07 07:27:09'),
(12, 9, 'images_product/ZFoaTABpu5n6I6nZG5p7pnuHH5mzmM3DHFRXexpd.png', '2025-10-07 09:16:14', '2025-10-07 09:16:14'),
(13, 10, 'images_product/HQdOfLN16wyepLbBQKxDg7RyY6JNL1pEggYVkstN.jpg', '2025-10-07 09:19:34', '2025-10-07 09:19:34'),
(14, 10, 'images_product/H7GYEvEQAHMQGcXhuHZa7KN5TYDCRBUZ0cC5LhA5.png', '2025-10-07 09:19:34', '2025-10-07 09:19:34'),
(15, 11, 'images_product/hC8oaCBYxqLfI1ACKqwvY9GZVscFspwH0OKffmXl.jpg', '2025-10-07 12:08:56', '2025-10-07 12:08:56'),
(16, 12, 'images_product/qYf1Z9x6DUGcEjslciu98MSZ2sXQFQPY0AMnaxu3.png', '2025-10-07 12:11:20', '2025-10-07 12:11:20'),
(17, 13, 'images_product/hg3UdNaNr5eBdw0WoKXa3kY4cUBiRC3YCAxgWtWH.jpg', '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(18, 13, 'images_product/N9v2GRm2SkQUuBawAr9I4RGGfRFKBYNdyfsxdolM.jpg', '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(19, 13, 'images_product/SEpj7v8BaaEsPOq7OLhu9wgeJS1tLXOzZw8phA59.jpg', '2025-10-07 02:13:57', '2025-10-07 02:13:57'),
(20, 14, 'images_product/tmV7v0DnrRM8kCnRpbxW1AiCw4q18LTmwpDAUGbi.jpg', '2025-10-07 01:12:08', '2025-10-07 01:12:08'),
(21, 15, 'images_product/djcF3wGaKJW50h3u8XfKHI0BJAtsr2R37OTohS6M.png', '2025-10-07 04:47:58', '2025-10-07 04:47:58'),
(22, 16, 'images_product/g4wQeLsDoC692APxUkT6UsfsX6LKetz21S3tjKZu.jpg', '2025-10-07 04:49:04', '2025-10-07 04:49:04'),
(23, 17, 'images_product/AS8cBTWTayMjwwVLbAlWaZgS06vv03535J4PzbcS.jpg', '2025-10-07 04:51:54', '2025-10-07 04:51:54'),
(24, 17, 'images_product/pTvifHqzEkI3bBEzHWNW6YtWDqmAc8tKFlmJaEc2.jpg', '2025-10-07 04:51:54', '2025-10-07 04:51:54'),
(25, 18, 'images_product/8BFd54OwDEZP2N2jctlYsRvJz781LPbkYXw67h3c.jpg', '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(26, 18, 'images_product/GpBnCkrW2KX2mgBMbJ0cynViZWpgdOnQCY1ibdAB.jpg', '2025-10-07 04:54:21', '2025-10-07 04:54:21'),
(27, 19, 'images_product/xGk2BDGQ21jCWsN9ap3etC1LrAOmUAnIZ46Dmgnb.jpg', '2025-10-07 12:42:24', '2025-10-07 12:42:24'),
(28, 20, 'images_product/xeC3u2I75aje1oq2xYEWikrw78ePhETHO2vfnq4j.jpg', '2025-10-07 19:45:42', '2025-10-07 19:45:42'),
(29, 20, 'images_product/JLGtPUAfzjASjXRQuO6OuU4ceRtaLnNVblQVtPxJ.png', '2025-10-07 19:45:42', '2025-10-07 19:45:42'),
(30, 20, 'images_product/5xXEJ9pSPxtQDgXUUTKLZ1RhMtc2OeBqw936NkAv.jpg', '2025-10-07 19:45:42', '2025-10-07 19:45:42'),
(31, 21, 'images_product/t5nf5K3WSuZUPrIh5f0XvcU9iycsrso9WHTw2xjs.jpg', '2025-10-07 05:47:29', '2025-10-07 05:47:29'),
(32, 21, 'images_product/z2oWfuqtu4vz0iNXxGweXlErseOKtRZcfCI42w9k.jpg', '2025-10-07 05:47:29', '2025-10-07 05:47:29'),
(33, 22, 'images_product/5WvgDwiU64Bx4EOWmEGb5o7PzBiMUcDPHklOSxUM.jpg', '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(34, 22, 'images_product/XlvYwkvCppu365ZwoxK2U7GDY5oaLdDLFb73z1hM.jpg', '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(35, 22, 'images_product/lsdaEVFpAfW7NDPFMv8rzTlaVOtyA88DnKg4Y183.jpg', '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(36, 22, 'images_product/eO0UuGSpGADpTuphLajPA5lOKndVeEKgBQTVLGgJ.jpg', '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(37, 22, 'images_product/1dyCIk5zAvKwhui9PHfkpewsswKna5YlRxKrb0hq.jpg', '2025-10-07 05:53:30', '2025-10-07 05:53:30'),
(38, 23, 'images_product/kjxzeRHDE1HKNKSKigOdgRQYoI9KPSiEgIdE2Yp1.webp', '2025-10-07 14:00:26', '2025-10-07 14:00:26'),
(39, 23, 'images_product/7xT0fDQC0UYBrittMD5lHVYQKriSCkaalrnmfRf0.webp', '2025-10-07 14:00:26', '2025-10-07 14:00:26'),
(40, 24, 'images_product/lPg4pCZfwiyuEy6ULYttolSBRTXk1Ohf4zElgoSy.webp', '2025-10-07 14:51:28', '2025-10-07 14:51:28'),
(41, 24, 'images_product/h7gs6gJRgrFRshlZkNBKpuaF0k7oHZQccL8rfEh9.webp', '2025-10-07 14:51:28', '2025-10-07 14:51:28'),
(42, 24, 'images_product/LVHVphXgE9jXBvh9mI0Pc0D3YMhaUYRJx9WUVgdb.webp', '2025-10-07 14:51:28', '2025-10-07 14:51:28'),
(43, 25, 'images_product/y7uBlFrm752hWCOFjPTdFRIgpY7sIDYg4PubYjD6.webp', '2025-10-07 14:52:06', '2025-10-07 14:52:06'),
(44, 25, 'images_product/Nvw9nYNiDWOBg0RT59p6pYbxN88Yb9OCnQthAs6p.webp', '2025-10-07 14:52:06', '2025-10-07 14:52:06'),
(45, 25, 'images_product/WohypJYjW3qmp2uY31VmMdqXCoXWFnWkDIc4sGu1.webp', '2025-10-07 14:52:06', '2025-10-07 14:52:06'),
(46, 26, 'images_product/8lMKjhXw7RPJ1wB46jz0sT3s8EvMQy1ubyQaldXc.webp', '2025-10-07 15:00:42', '2025-10-07 15:00:42'),
(47, 26, 'images_product/1QXZ8J0BMtc5kFEG3QRFSHUXCTU67b52ZOEJeE2T.webp', '2025-10-07 15:00:42', '2025-10-07 15:00:42'),
(48, 26, 'images_product/Rqm9cXncuWXgnQVaIgPJ52xaR68nL5lLWUuPt3qd.webp', '2025-10-07 15:00:42', '2025-10-07 15:00:42'),
(49, 26, 'images_product/B2w2aC3mHYfP4hXL0U0SnNsEaGLOo3r3YOPVYxa6.webp', '2025-10-07 15:00:42', '2025-10-07 15:00:42'),
(50, 26, 'images_product/yvHlx4nxrouHdZQh1teDpa8jyecikZCK1mFKDGdi.webp', '2025-10-07 15:00:42', '2025-10-07 15:00:42'),
(51, 27, 'images_product/mTjiFORBpdHl2jIiKScdiJAGh1fUL9b4c5vzVUuq.webp', '2025-10-07 15:08:39', '2025-10-07 15:08:39'),
(52, 27, 'images_product/LvmboREEZa1fM4tOGqqtUg3u6o22ky8ITERA1RS0.webp', '2025-10-07 15:08:39', '2025-10-07 15:08:39'),
(53, 27, 'images_product/NmoZPqzXfyVYKVftseGUUtdDEmXIMD8uG2LpD4ba.webp', '2025-10-07 15:08:39', '2025-10-07 15:08:39'),
(54, 27, 'images_product/afjj60Qa2fQMr4nwLs3eJyWaLrt5LXLOM5E4Pt6Y.webp', '2025-10-07 15:08:39', '2025-10-07 15:08:39'),
(55, 27, 'images_product/JKj7H098MnlKkzKh8rn4MzG8mdQLaausM3Cuamrs.webp', '2025-10-07 15:08:39', '2025-10-07 15:08:39'),
(56, 28, 'images_product/jtY22wfisRzLHWygu7iaAJgmHRBsglqy5sYbxEYH.webp', '2025-10-07 15:12:11', '2025-10-07 15:12:11'),
(57, 28, 'images_product/GMGra8ZfKzEEdzKeWYZwKPIWbHzyO8px3pn7CsaX.webp', '2025-10-07 15:12:11', '2025-10-07 15:12:11'),
(58, 28, 'images_product/GAr3cgw7V1ApmUEGEK23hbIKsPVKnfR2JCDRjdtb.webp', '2025-10-07 15:12:11', '2025-10-07 15:12:11'),
(59, 28, 'images_product/PNffAKtH3nlfuVBr1wd8zw0ZYlJtGsAAt9i7kVl6.webp', '2025-10-07 15:12:11', '2025-10-07 15:12:11'),
(60, 29, 'images_product/sQzAt5rD34xvg3J9ar4KJukumLrj6ssYAUxc5BiB.webp', '2025-10-07 15:15:18', '2025-10-07 15:15:18'),
(61, 30, 'images_product/6myGiYNeJhIDqkxwgmTXYfNPCLqW3Wv5WhmowCLH.webp', '2025-10-07 15:16:36', '2025-10-07 15:16:36'),
(62, 31, 'images_product/nTeoiW3wo8IiezNeV9OJQ8PAxkBVoNFAbdKRldCO.webp', '2025-10-07 15:17:42', '2025-10-07 15:17:42'),
(63, 32, 'images_product/3Dwdb2eJZhhmcg2MUq5z22P9CSrngxVZR3OECYvg.webp', '2025-10-07 15:18:54', '2025-10-07 15:18:54'),
(64, 33, 'images_product/n4iGu3Xqd8Es2L7YbNG36pUJZ0ZNWqG4oKookqMY.webp', '2025-10-07 15:20:38', '2025-10-07 15:20:38'),
(65, 34, 'images_product/RU5A8QPBrZ2h46rkiDgQthMQRfM3ghPDFK3vTMdO.webp', '2025-10-07 15:22:49', '2025-10-07 15:22:49'),
(66, 34, 'images_product/d4gkBqdnK1o6lHcmPYfAptIwf2u5i71ZK4QSjt7E.webp', '2025-10-07 15:22:49', '2025-10-07 15:22:49'),
(67, 34, 'images_product/cR7yA9Bg3hjOnKyGoSQvPxm3Ig3Nipi79Q3uaOPt.webp', '2025-10-07 15:22:49', '2025-10-07 15:22:49'),
(68, 35, 'images_product/sQ2ccIJx6yKciq0Lp0WTbQp4d6zEzpJNUFFY7MaF.webp', '2025-10-07 15:25:05', '2025-10-07 15:25:05'),
(69, 35, 'images_product/7YcWrQPySQK9rE2iIZWktWNJfVI5G8ZOkfF4As2f.jpg', '2025-10-07 15:25:05', '2025-10-07 15:25:05'),
(70, 36, 'images_product/Iocq9bRoEfFL5Lo3mIq3nk2GIpjogxDQIJr52uyI.webp', '2025-10-07 15:27:25', '2025-10-07 15:27:25'),
(71, 37, 'images_product/lQU5fAL8c7c7GSYf1ATZmbPEZTKy1REJKzukDVsa.webp', '2025-10-07 15:29:20', '2025-10-07 15:29:20'),
(72, 38, 'images_product/cILUWob7yrgfMCPUwHaFvij2qyEe2LCA38VkvyAn.webp', '2025-10-07 15:31:24', '2025-10-07 15:31:24'),
(73, 38, 'images_product/C34e1CtG0dWy7nu8kMoOrAGlAagbSrRoa4GxX4xn.webp', '2025-10-07 15:31:24', '2025-10-07 15:31:24'),
(74, 38, 'images_product/LjnCEUTAVnSHJoEiNMErnfq8dyUX0a5J2trcyIZy.webp', '2025-10-07 15:31:24', '2025-10-07 15:31:24'),
(75, 39, 'images_product/UmDBPXaQY9wOGTPmQnQIbFKDIYdWRoI01OMf5aSB.webp', '2025-10-07 15:33:44', '2025-10-07 15:33:44'),
(76, 39, 'images_product/B4wgltfQE88d3DXln23Q2Kdd49EGQMm6PcEZcHaw.webp', '2025-10-07 15:33:44', '2025-10-07 15:33:44'),
(77, 39, 'images_product/QSAHS5K6doXrAAv2aJyfXAPFPCqz75WfIGoO9esn.webp', '2025-10-07 15:33:44', '2025-10-07 15:33:44'),
(78, 40, 'images_product/NeqneE4tv2acMUFmlGaVZFfq1SF4TTtWNsOk5GUZ.webp', '2025-10-07 15:35:24', '2025-10-07 15:35:24'),
(79, 41, 'images_product/7JuQbIxzrmo0HBchmAQoJDDbRbGL347K1HB9eMhU.webp', '2025-10-07 15:36:20', '2025-10-07 15:36:20'),
(80, 42, 'images_product/49kqJDKfv1TEUUYo8OyHQa3O6ydTtLPnkgroYJFU.webp', '2025-10-07 15:37:49', '2025-10-07 15:37:49'),
(81, 43, 'images_product/XiXRRdXin6gd6QzQx15Y43SC7wUTSMhfBDGbZEtE.webp', '2025-10-07 15:40:16', '2025-10-07 15:40:16'),
(82, 44, 'images_product/v9OkTxiZvMegsTE9SehnJ9eCvE38qP43Cpkobl1t.webp', '2025-10-07 15:41:27', '2025-10-07 15:41:27'),
(83, 45, 'images_product/uI7ZiXHF8GCE7WwktgzvNjs9UWltg62fhUqXflKo.webp', '2025-10-07 15:42:24', '2025-10-07 15:42:24'),
(84, 46, 'images_product/At2C8qsKX746pmYWyPlCzpLNGr4ZOWPYNmUTolXx.webp', '2025-10-07 15:44:40', '2025-10-07 15:44:40'),
(85, 47, 'images_product/PsKaLBJrR4rWyxNbZMmodyisNT2VckMpTsaJL2aV.webp', '2025-10-07 15:45:43', '2025-10-07 15:45:43'),
(86, 48, 'images_product/cewnsysPV1WCd9Y9VoXIwkxi8NkQTIX7FUTJPx27.webp', '2025-10-07 15:47:02', '2025-10-07 15:47:02'),
(87, 49, 'images_product/rkIX5DY9X0XeOCDhqEJ5rIHHNANBw3zRrG7suqks.webp', '2025-10-07 15:49:09', '2025-10-07 15:49:09'),
(88, 50, 'images_product/DMA4FxsERCNapO3FPRQh9LSLKIGLsQWNWYPqhGAV.webp', '2025-10-07 15:52:26', '2025-10-07 15:52:26'),
(89, 51, 'images_product/z9eUrfrDvNfpBJFZQo20jsQ88OE9tBiNMQbis0Aa.webp', '2025-10-07 15:53:25', '2025-10-07 15:53:25'),
(90, 52, 'images_product/tTAOVL134r9v2YPk0ZIvwJUvdkaDPu7yLb1S8pB4.webp', '2025-10-07 15:54:08', '2025-10-07 15:54:08'),
(91, 53, 'images_product/ve0OmCCu4auvxRBgvz9MOBoSHoBEzIMAqprqPQGY.webp', '2025-10-07 15:55:22', '2025-10-07 15:55:22'),
(92, 54, 'images_product/rJp2FLdTltrbxSHMgUkzJs3RDkuMzSBx6jsJqAfH.webp', '2025-10-07 15:56:21', '2025-10-07 15:56:21'),
(93, 55, 'images_product/Afniqud63AmnJLKA3ALWwYNOq6V0Il8RqtXtQCdo.webp', '2025-10-07 15:57:40', '2025-10-07 15:57:40'),
(94, 56, 'images_product/YnCpXok81xLEQo4ApKTB6xQMUMRYzDE1xaHlRLyQ.webp', '2025-10-07 15:58:33', '2025-10-07 15:58:33'),
(95, 57, 'images_product/78RVyydJhKGumUyt0psda4FFDEDJcJfL40uCMNHU.webp', '2025-10-07 15:59:53', '2025-10-07 15:59:53'),
(96, 58, 'images_product/8sjSeaF3yQYQQDChXaPy0iSjZ7Go0L9bbQD0zvru.webp', '2025-10-07 16:00:43', '2025-10-07 16:00:43'),
(97, 59, 'images_product/WVu0TNPMe5rNKQwoAM8lyAY9EqcOQdg8mKPknzuN.webp', '2025-10-07 16:01:52', '2025-10-07 16:01:52'),
(98, 60, 'images_product/DnIBr7rCoR3XiEFgSOAu4HKSbk3jhBgNHXoKpvqk.webp', '2025-10-07 16:03:38', '2025-10-07 16:03:38'),
(99, 61, 'images_product/L1G1vZLE5dj4QR3k3casIMWGBh90dYQLSoWfrvHS.webp', '2025-10-07 16:04:25', '2025-10-07 16:04:25'),
(100, 62, 'images_product/yoHhFywRg3X3Ctm8t7E36ivmAAMScKkhg0p49GPv.webp', '2025-10-07 16:05:11', '2025-10-07 16:05:11'),
(101, 63, 'images_product/KlJwWYgOwHLFnM3UcBH3kACGbnMqBooNnx4L4EEh.webp', '2025-10-07 16:06:24', '2025-10-07 16:06:24'),
(102, 64, 'images_product/VN4lu0RwCki2uOaq27nsinM1whV3oPmxdn5sWJUy.webp', '2025-10-07 16:07:32', '2025-10-07 16:07:32'),
(103, 65, 'images_product/iVCm2Qh6wNydGcUrnHKBCsEEFBR1oCdSJYqRF3bd.webp', '2025-10-07 16:08:38', '2025-10-07 16:08:38'),
(104, 66, 'images_product/F2hH3luQFKeb5VJajS3k0ZdA8oEuZtyyG8vfmhuf.webp', '2025-10-07 16:11:05', '2025-10-07 16:11:05'),
(105, 67, 'images_product/5EsujOKorrXsPkWSwb0syLr7lyIkaKb2P8NY7PJP.webp', '2025-10-07 16:12:10', '2025-10-07 16:12:10'),
(106, 68, 'images_product/jHUM3A4LteEihZPlXIF9eOg7EK0YxrP6ZGOZQkXc.webp', '2025-10-07 16:13:46', '2025-10-07 16:13:46'),
(107, 69, 'images_product/N7w93eEE96SD3jJEiMgFRXmA60SbX5GRHN9Fyvqq.webp', '2025-10-07 16:15:50', '2025-10-07 16:15:50'),
(108, 70, 'images_product/J66dhk0X6Nnb9JuvDkYn6jkBlQJqGjrXY3TbMrSN.webp', '2025-10-07 16:16:51', '2025-10-07 16:16:51'),
(109, 71, 'images_product/068kbe270R8ZCTym3qPcXtxf2rx0ZKwC6u4RMCXP.webp', '2025-10-07 16:17:54', '2025-10-07 16:17:54'),
(110, 72, 'images_product/NqIv0KoxGs8EVXh9eVV9VYO3HSUsc5gpBppsONOq.webp', '2025-10-07 16:19:17', '2025-10-07 16:19:17'),
(111, 73, 'images_product/uuClQcXq5AOUoS1w8mK6GAtpYUI9Fe1RgxpYwstY.webp', '2025-10-07 16:20:28', '2025-10-07 16:20:28'),
(112, 74, 'images_product/dePUfnJQp6a50FEHGCUjsCYz8oLpEjzmWHhYWUaF.webp', '2025-10-07 16:21:31', '2025-10-07 16:21:31'),
(113, 75, 'images_product/fQkqaQHsrrGmtUzTKCJLcWBjESYlBtXH9zj2h8NR.webp', '2025-10-07 16:23:39', '2025-10-07 16:23:39'),
(114, 76, 'images_product/AlydVYTI3OCyN7W6honSi6Cm2qC5IJ7wzlZjwzAq.webp', '2025-10-07 16:26:00', '2025-10-07 16:26:00'),
(115, 77, 'images_product/QqTV2ot96zDS0Sj7HHQYiz68nbEJ8H1Ozze1mlFh.webp', '2025-10-07 16:33:23', '2025-10-07 16:33:23'),
(116, 78, 'images_product/gPw6mr72vxm3Xi2Vxq9lgZrGOegTaWqQAPH8KQpf.webp', '2025-10-07 16:34:28', '2025-10-07 16:34:28'),
(117, 79, 'images_product/mz4GenLQThaFIhvLpFsm4faXIvG4GSz7Xyp2qKV1.webp', '2025-10-07 16:36:11', '2025-10-07 16:36:11'),
(118, 80, 'images_product/ZxiFL7Nk8NGtxIn7SsY1LScfSoEtz9uTetd8pqbQ.webp', '2025-10-07 16:38:17', '2025-10-07 16:38:17'),
(119, 81, 'images_product/eZlRw6OZBeTH372i6BuVBJ6lOYhGShA6V5HkXdKR.webp', '2025-10-07 16:39:25', '2025-10-07 16:39:25'),
(120, 82, 'images_product/BAYxr4q25esrRsZ0ol46y6RdzEMKRDEuHW7OWr18.webp', '2025-10-07 19:43:25', '2025-10-07 19:43:25'),
(121, 82, 'images_product/eVILdyVHJ3exkMzzra6C07T5H9VwpVG8CfeGHG4L.webp', '2025-10-07 19:43:25', '2025-10-07 19:43:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_variations_options`
--

CREATE TABLE `products_variations_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variationName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_variations_options`
--

INSERT INTO `products_variations_options` (`id`, `product_id`, `variationName`, `created_at`, `updated_at`) VALUES
(9, 7, 'Size', NULL, NULL),
(10, 10, 'Màu Sắc', NULL, NULL),
(11, 11, 'Size', NULL, NULL),
(12, 12, 'Size', NULL, NULL),
(13, 13, 'Màu Sắc', NULL, NULL),
(14, 13, 'Size', NULL, NULL),
(15, 14, 'Màu Sắc', NULL, NULL),
(16, 14, 'Size', NULL, NULL),
(17, 15, 'Size', NULL, NULL),
(18, 16, 'Size', NULL, NULL),
(19, 17, 'Màu Sắc', NULL, NULL),
(20, 18, 'Màu Sắc', NULL, NULL),
(21, 18, 'Size', NULL, NULL),
(22, 19, 'Size', NULL, NULL),
(23, 20, 'Màu Sắc', NULL, NULL),
(24, 20, 'Size', NULL, NULL),
(25, 21, 'Xanh', NULL, NULL),
(26, 22, 'Loại', NULL, NULL),
(27, 22, 'Size', NULL, NULL),
(28, 23, 'Loại', NULL, NULL),
(29, 23, 'Size', NULL, NULL),
(30, 24, 'Loại', NULL, NULL),
(31, 25, 'Loại', NULL, NULL),
(32, 26, 'Màu sắc', NULL, NULL),
(33, 27, 'Màu sắc', NULL, NULL),
(34, 28, 'LOẠI', NULL, NULL),
(35, 38, 'Loại', NULL, NULL),
(36, 39, 'Loại', NULL, NULL),
(37, 82, 'Loại', NULL, NULL),
(38, 82, 'Size', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_variations_options_value`
--

CREATE TABLE `products_variations_options_value` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `products_variation_id` bigint(20) UNSIGNED NOT NULL,
  `variationName` varchar(255) NOT NULL,
  `variationImg` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_variations_options_value`
--

INSERT INTO `products_variations_options_value` (`id`, `products_variation_id`, `variationName`, `variationImg`, `created_at`, `updated_at`) VALUES
(22, 9, 'S', NULL, NULL, NULL),
(23, 9, 'M', NULL, NULL, NULL),
(24, 9, 'L', NULL, NULL, NULL),
(25, 9, 'XL', NULL, NULL, NULL),
(26, 10, 'Đen', NULL, NULL, NULL),
(27, 10, 'Xanh', NULL, NULL, NULL),
(28, 11, 'S', NULL, NULL, NULL),
(29, 11, 'M', NULL, NULL, NULL),
(30, 11, 'L', NULL, NULL, NULL),
(31, 11, 'XL', NULL, NULL, NULL),
(32, 12, 'S', NULL, NULL, NULL),
(33, 12, 'M', NULL, NULL, NULL),
(34, 12, 'L', NULL, NULL, NULL),
(35, 12, 'XL', NULL, NULL, NULL),
(36, 13, 'Xanh rêu', NULL, NULL, NULL),
(37, 13, 'Be', NULL, NULL, NULL),
(38, 13, 'Đen', NULL, NULL, NULL),
(39, 14, 'S', NULL, NULL, NULL),
(40, 14, 'M', NULL, NULL, NULL),
(41, 14, 'L', NULL, NULL, NULL),
(42, 14, 'XL', NULL, NULL, NULL),
(43, 15, 'Xanh lam', NULL, NULL, NULL),
(44, 15, 'Hồng', NULL, NULL, NULL),
(45, 16, 'S', NULL, NULL, NULL),
(46, 16, 'M', NULL, NULL, NULL),
(47, 16, 'L', NULL, NULL, NULL),
(48, 16, 'XL', NULL, NULL, NULL),
(49, 17, 'S', NULL, NULL, NULL),
(50, 17, 'M', NULL, NULL, NULL),
(51, 17, 'L', NULL, NULL, NULL),
(52, 17, 'XL', NULL, NULL, NULL),
(53, 18, 'S', NULL, NULL, NULL),
(54, 18, 'M', NULL, NULL, NULL),
(55, 18, 'L', NULL, NULL, NULL),
(56, 18, 'XL', NULL, NULL, NULL),
(57, 19, 'Đen', NULL, NULL, NULL),
(58, 19, 'Be', NULL, NULL, NULL),
(59, 20, 'Đen', NULL, NULL, NULL),
(60, 20, 'Trắng', NULL, NULL, NULL),
(61, 21, 'S', NULL, NULL, NULL),
(62, 21, 'M', NULL, NULL, NULL),
(63, 21, 'L', NULL, NULL, NULL),
(64, 21, 'XL', NULL, NULL, NULL),
(65, 22, 'S', NULL, NULL, NULL),
(66, 22, 'M', NULL, NULL, NULL),
(67, 22, 'L', NULL, NULL, NULL),
(68, 22, 'XL', NULL, NULL, NULL),
(69, 23, 'Đen', NULL, NULL, NULL),
(70, 23, 'Trắng', NULL, NULL, NULL),
(71, 24, 'S', NULL, NULL, NULL),
(72, 24, 'M', NULL, NULL, NULL),
(73, 25, 'Áo A', NULL, NULL, NULL),
(74, 25, 'B', NULL, NULL, NULL),
(75, 25, 'Áo C', NULL, NULL, NULL),
(76, 25, 'D', NULL, NULL, NULL),
(77, 26, 'Đỏ', NULL, NULL, NULL),
(78, 26, 'Xanh', NULL, NULL, NULL),
(79, 26, 'Đen', NULL, NULL, NULL),
(80, 27, 'S', NULL, NULL, NULL),
(81, 27, 'M', NULL, NULL, NULL),
(82, 27, 'L', NULL, NULL, NULL),
(83, 27, 'XL', NULL, NULL, NULL),
(84, 28, 'Họa tiết đen mẫu 1', NULL, NULL, NULL),
(85, 28, 'Họa tiết đen mẫu số 2', NULL, NULL, NULL),
(86, 29, '20cm', NULL, NULL, NULL),
(87, 29, '25cm', NULL, NULL, NULL),
(88, 30, 'Kính trong nhà', NULL, NULL, NULL),
(89, 30, 'Kính ngoài trời', NULL, NULL, NULL),
(90, 31, 'Kính trong nhà', NULL, NULL, NULL),
(91, 31, 'Kính ngoài trời', NULL, NULL, NULL),
(92, 32, 'BLACK', NULL, NULL, NULL),
(93, 32, 'BLUE', NULL, NULL, NULL),
(94, 32, 'GRAY', NULL, NULL, NULL),
(95, 32, 'LEOPARD', NULL, NULL, NULL),
(96, 33, 'ĐEN', NULL, NULL, NULL),
(97, 33, 'BE', NULL, NULL, NULL),
(98, 33, 'TRẮNG', NULL, NULL, NULL),
(99, 33, 'RÊU', NULL, NULL, NULL),
(100, 34, 'QUẦN ĐÙI 1', NULL, NULL, NULL),
(101, 34, 'QUẦN ĐÙI 2', NULL, NULL, NULL),
(102, 34, 'QUẦN ĐÙI 3', NULL, NULL, NULL),
(103, 34, 'QUẦN ĐÙI 4', NULL, NULL, NULL),
(104, 35, 'SILVEL', NULL, NULL, NULL),
(105, 35, 'BLACK', NULL, NULL, NULL),
(106, 35, 'PINK', NULL, NULL, NULL),
(107, 36, 'SILVEL', NULL, NULL, NULL),
(108, 36, 'BLACK', NULL, NULL, NULL),
(109, 36, 'PINK', NULL, NULL, NULL),
(110, 37, 'ĐEN', NULL, NULL, NULL),
(111, 37, 'Xanh', NULL, NULL, NULL),
(112, 38, 'L', NULL, NULL, NULL),
(113, 38, 'XL', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping`
--

CREATE TABLE `shipping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `ship_name` varchar(255) NOT NULL,
  `ship_phonenumber` int(11) NOT NULL,
  `ship_address` varchar(255) NOT NULL,
  `ship_email` varchar(255) DEFAULT NULL,
  `ship_status` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping`
--

INSERT INTO `shipping` (`id`, `user_id`, `shop_id`, `ship_name`, `ship_phonenumber`, `ship_address`, `ship_email`, `ship_status`, `note`, `total_price`, `created_at`, `updated_at`) VALUES
(2, 2, 8, 'Nguyễn Đỗ Tuấn Kiệt', 772120961, 'Tỉnh Hải Dương - Huyện Gia Lộc - Xã Thống Kênh -Ấp bình hòa', 'kiet@gmail.com', 0, '', '600000', NULL, NULL),
(3, 2, 8, 'Nguyễn Đỗ Tuấn Kiệt', 772120961, 'Tỉnh Bắc Ninh - Thành phố Từ Sơn - Phường Châu Khê -Ấp bình hòa', 'kiet@gmail.com', 0, '', '380000', NULL, NULL),
(7, 3, 1, 'Nguyễn Thị Thúy Loan', 772120961, 'Tỉnh Lào Cai - Huyện Mường Khương - Xã Lùng Vai -ấp đông', 'loan@gmail.com', 0, 'giao ngày thứ', '1550000', NULL, NULL),
(8, 3, 8, 'Nguyễn Thị Thúy Loan', 999125121, 'Tỉnh Hải Dương - Huyện Gia Lộc - Xã Đồng Quang -Ấp bình hòa', '', 0, '', '80000', NULL, NULL),
(9, 3, 1, 'Nguyễn Đỗ Tuấn Kiệt', 772120123, 'Thành phố Hải Phòng - Huyện Vĩnh Bảo - Xã Hưng Nhân -ấp đông', 'loan@gmail.com', 0, '', '430000', NULL, NULL),
(10, 2, 1, 'Nguyễ Tuấn Kiệt', 772120961, 'Thành phố Cần Thơ - Quận Ninh Kiều - Phường An Khánh -hẻm 51', 'kiet@gmail.com', 0, 'Nhận hàng vào ngày nghỉ', '480000', NULL, NULL),
(11, 2, 1, 'Nguyễn Đỗ Tuấn Kiệt', 772120961, 'Thành phố Hà Nội - Quận Hà Đông - Phường Phú Lương -Ấp bình hòa', 'kiet@gmail.com', 0, '', '24970000', NULL, NULL),
(12, 2, 1, 'Nguyễn Thị Thúy Loan', 772120123, 'Tỉnh Lai Châu - Huyện Tam Đường - Xã Bản Giang -ấp đông', 'loan@gmail.com', 0, '', '24930000', NULL, NULL),
(13, 3, 1, 'Nguyễn Thị Thúy Loan', 772120123, 'Thành phố Cần Thơ - Quận Ninh Kiều - Phường An Khánh -hẻm 51', 'loan@gmail.com', 0, '', '714000', NULL, NULL),
(14, 3, 8, 'Nguyễn Thị Thúy Loan', 772120123, 'Tỉnh Vĩnh Phúc - Huyện Tam Đảo - Thị trấn Đại Đình -ấp đông', '', 0, '', '400000', NULL, NULL),
(15, 4, 1, 'Nguyễn Đỗ Tuấn Kiệt', 772120961, 'Thành phố Cần Thơ - Huyện Phong Điền - Xã Trường Long -Ấp bình hòa', '', 0, '', '570000', NULL, NULL),
(16, 4, 1, 'Nguyễn Đỗ Tuấn Kiệt', 772120961, 'Thành phố Cần Thơ - Huyện Phong Điền - Xã Trường Long -Ấp bình hòa', '', 0, '', '570000', NULL, NULL),
(17, 4, 1, 'Nguyễn Đỗ Tuấn Kiệt', 772120961, 'Tỉnh Bắc Ninh - Thị xã Quế Võ - Xã Mộ Đạo -Ấp bình hòa', '', 0, '', '680000', NULL, NULL),
(18, 4, 1, 'Nguyễn Tuấn Kiệt', 772120961, 'Thành phố Hà Nội - Quận Tây Hồ - Phường Tứ Liên -ấp đông', 'kiet@gmail.com', 0, 'Giao hàng tránh ngày thứ 2', '232500', NULL, NULL),
(19, 4, 1, 'Nguyễn Đỗ Tuấn Kiệt', 999125121, 'Tỉnh Cao Bằng - Huyện Hà Quảng - Xã Hồng Sỹ -Ấp bình hòa', 'kiet@gmail.com', 0, '', '331500', NULL, NULL),
(20, 2, 8, 'Nguyễn Đỗ Tuấn Kiệt', 772120961, 'Thành phố Hải Phòng - Huyện Tiên Lãng - Xã Bắc Hưng -Ấp bình hòa', '', 0, '', '1830000', NULL, NULL),
(21, 9, 8, 'Hoàng Việt', 783809640, 'Tỉnh Đồng Tháp - Huyện Thanh Bình - Xã Bình Thành -QL30', 'chauviet350@gmail.com', 0, 'Nhanh nha Shopp', '315000', NULL, NULL),
(22, 9, 1, 'Châu Hoàng Việt', 783809640, 'Tỉnh Đồng Tháp - Huyện Thanh Bình - Xã Bình Thành -QL30', 'chauviet350@gmail.com', 0, '', '365000', NULL, NULL),
(23, 9, 8, 'Châu Hoàng Việt', 783809640, 'Tỉnh Đồng Tháp - Thành phố Sa Đéc - Phường 1 -QL30', 'chauviet350@gmail.com', 0, 'ssss', '730000', NULL, NULL),
(24, 9, 13, 'Châu Hoàng Việt', 783809640, 'Tỉnh Đồng Tháp - Thành phố Sa Đéc - Phường 1 -QL30', 'chauviet350@gmail.com', 0, 'sssssssssssssss', '530000', NULL, NULL),
(25, 9, 13, 'Châu Hoàng Việt', 783809640, 'Tỉnh Đồng Tháp - Thành phố Cao Lãnh - Xã Hòa An -QL30', 'chauviet350@gmail.com', 0, '', '165000', NULL, NULL),
(26, 9, 8, 'Châu Hoàng Việt', 783809640, 'Tỉnh Đồng Tháp - Thành phố Cao Lãnh - Xã Hòa An -QL30', 'chauviet350@gmail.com', 0, '', '380000', NULL, NULL),
(27, 9, 8, 'Châu Hoàng Việt', 783809640, 'Tỉnh Đồng Tháp - Thành phố Sa Đéc - Phường 1 -QL30', 'chauviet350@gmail.com', 0, '', '345000', NULL, NULL),
(28, 9, 13, 'Châu Hoàng Việt', 783809640, 'Tỉnh Đồng Tháp - Thành phố Cao Lãnh - Xã Tịnh Thới -QL30', 'chauviet350@gmail.com', 0, '', '180000', NULL, NULL),
(29, 9, 13, 'Châu Hoàng Việt', 783809640, 'Tỉnh Đồng Tháp - Thành phố Cao Lãnh - Xã Tân Thuận Đông -QL30', 'chauviet350@gmail.com', 0, '', '180000', NULL, NULL),
(30, 9, 13, 'Châu Hoàng Việt', 783809640, 'Tỉnh Bắc Giang - Huyện Yên Thế - Thị trấn Phồn Xương -QL30', 'chauviet350@gmail.com', 0, '', '180000', NULL, NULL),
(31, 10, 8, 'Châu Hoàng Việt', 783809640, 'Tỉnh Lâm Đồng - Huyện Đơn Dương - Xã Lạc Lâm -QL30', 'chauviet360@gmail.com', 0, '', '345000', NULL, NULL),
(32, 10, 14, 'Châu Hoàng Việt', 783809640, 'Thành phố Đà Nẵng - Quận Liên Chiểu - Phường Hòa Hiệp Bắc -QL30', 'chauviet360@gmail.com', 0, '', '330000', NULL, NULL),
(33, 10, 14, 'Châu Hoàng Việt', 783809640, 'Tỉnh Bắc Ninh - Huyện Yên Phong - Xã Đông Phong -QL30', 'chauviet360@gmail.com', 0, '', '180000', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shop`
--

CREATE TABLE `shop` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shopname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `shopImg` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shop`
--

INSERT INTO `shop` (`id`, `shopname`, `email`, `email_verified_at`, `password`, `role_id`, `status`, `shopImg`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kenji shop', 'kiet@gmail.com', NULL, '$2y$10$wc2D2LZI6bNT8lNZMU6HvOj5HxLwiJpgD0NfvToDEh4u7p/Z/f07.', '1', '1', 'logo_shop/tosnhRplaBjNoXt8yYigwMUI9nusntxMNg8ygEfg.jpg', NULL, '2025-10-07 02:29:57', '2025-10-07 06:00:08'),
(8, 'smart store', 'kiet123@gmail.com', NULL, '$2y$10$2AmcZA74JY5e3soBY/sqyel249R6oCkACL9UgaXD2JdlxFYt1N6/m', '1', '1', 'logo_shop/9iW2MNgMOf8LsGx1943KAaxYKlZSK3kIHmDqBCsz.jpg', NULL, '2025-10-07 14:11:40', '2025-10-07 05:41:37'),
(11, 'Clothing Shop', 'loan@gmail.com', NULL, '$2y$10$sfWJlyXMMjZCkd3NTDYj8uUTuphGioxZ5fre00VDItNCRihzvw2SG', '1', '1', 'logo_shop/4x2SCitPLb70JuZyLeddyq17LkgPIaGWdbmwugO7.jpg', NULL, '2025-10-07 14:14:48', '2025-10-07 06:00:43'),
(12, 'Shop bán đồ', 'loan1@gmail.com', NULL, '$2y$10$BlYvhg4kzurLEPfpmR1Ybu7V9LxKfY2TxEKlKVMtdCHtu6/WooP/O', '1', '1', NULL, NULL, '2025-10-07 19:42:36', '2025-10-07 06:01:06'),
(13, 'VietKO', '21004065@st.vlute.edu.vn', NULL, '$2y$10$.A8Fr0BBbUUco9HIsCvQuuAM56hPKv30MmBEgSPFycN9lIIkPgzWS', '1', '1', 'logo_shop/S8jieOAvvjAMzZPCMxQWDrPltDIAl3KIppQjUitr.jpg', NULL, '2025-10-07 05:12:30', '2025-10-07 12:56:20'),
(14, 'bao', 'bao123@gmail.com', NULL, '$2y$10$jIa3ZtGhJGVlNWc4qJyk1epny9qhUa20CDtpNbTLtY/fzBegFEnMK', '1', '1', 'logo_shop/vploNvECZFjdvYasRXcan1UDS8rquoCp7cOVXg01.webp', NULL, '2025-10-07 19:40:28', '2025-10-07 19:41:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subCategoryName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subCategoryName`, `created_at`, `updated_at`) VALUES
(6, 1, 'Quần Jeans', '2025-10-07 23:06:52', '2025-10-07 12:05:59'),
(7, 1, 'Áo sơ mi nam', '2025-10-07 23:07:01', '2025-10-07 23:07:01'),
(8, 2, 'Áo sơ mi nữ', '2025-10-07 23:07:10', '2025-10-07 23:07:10'),
(9, 2, 'Quần dài nữ', '2025-10-07 23:07:26', '2025-10-07 23:07:26'),
(10, 3, 'Ốp lưng điện thoại', '2025-10-07 05:22:58', '2025-10-07 05:22:58'),
(11, 3, 'Tai nghe Airpod', '2025-10-07 05:23:23', '2025-10-07 05:23:23'),
(12, 3, 'Cáp sạc Type C', '2025-10-07 05:23:42', '2025-10-07 05:23:42'),
(13, 3, 'Củ sạc điện thoại', '2025-10-07 05:23:55', '2025-10-07 05:23:55'),
(14, 4, 'Mô hình anime', '2025-10-07 05:24:09', '2025-10-07 05:24:09'),
(15, 3, 'Đồ chơi lắp ráp', '2025-10-07 05:24:17', '2025-10-07 05:24:17'),
(16, 4, 'Đồ chơi giáo dục', '2025-10-07 05:25:20', '2025-10-07 05:25:20'),
(17, 4, 'Đồ chơi giải trí', '2025-10-07 05:25:27', '2025-10-07 05:25:27'),
(18, 5, 'Máy game console', '2025-10-07 05:26:08', '2025-10-07 05:26:08'),
(19, 5, 'Đĩa game Console', '2025-10-07 05:26:17', '2025-10-07 05:26:17'),
(20, 5, 'Tivi', '2025-10-07 05:26:32', '2025-10-07 05:26:32'),
(21, 6, 'Chăn ga gối đệm', '2025-10-07 05:27:27', '2025-10-07 05:27:27'),
(22, 6, 'Trang trí nhà cửa', '2025-10-07 05:27:39', '2025-10-07 05:27:39'),
(23, 6, 'Đồ dùng bếp', '2025-10-07 05:28:45', '2025-10-07 05:28:45'),
(24, 6, 'Dụng cụ & thiết bị tiện ích', '2025-10-07 05:29:00', '2025-10-07 05:29:00'),
(25, 6, 'Đồ dùng nhà bếp', '2025-10-07 05:29:20', '2025-10-07 05:29:20'),
(26, 7, 'Máy tình bàn', '2025-10-07 05:29:52', '2025-10-07 05:29:52'),
(27, 7, 'Màn hình', '2025-10-07 05:30:09', '2025-10-07 05:30:09'),
(28, 7, 'Laptop', '2025-10-07 05:30:24', '2025-10-07 05:30:24'),
(29, 7, 'Phụ kiện máy tính', '2025-10-07 05:30:34', '2025-10-07 05:30:34'),
(30, 9, 'Máy in & Scan', '2025-10-07 05:30:57', '2025-10-07 05:30:57'),
(31, 8, 'Vật tư y tế', '2025-10-07 05:31:18', '2025-10-07 05:31:18'),
(32, 8, 'Sản phẩm làm đẹp', '2025-10-07 05:31:26', '2025-10-07 05:31:26'),
(33, 8, 'Thực phẩm chức năng', '2025-10-07 05:31:44', '2025-10-07 05:31:44'),
(34, 9, 'Thẻ nhớ', '2025-10-07 05:32:17', '2025-10-07 05:32:17'),
(35, 9, 'Ống kính', '2025-10-07 05:32:28', '2025-10-07 05:32:28'),
(36, 9, 'Phụ kiện máy ảnh', '2025-10-07 05:32:35', '2025-10-07 05:32:35'),
(37, 10, 'Chăm sóc da mặt', '2025-10-07 05:33:08', '2025-10-07 05:33:08'),
(38, 10, 'Chăm sóc tóc', '2025-10-07 05:33:16', '2025-10-07 05:33:16'),
(39, 10, 'Trang điểm', '2025-10-07 05:33:25', '2025-10-07 05:33:25'),
(40, 11, 'Đồng hồ nam', '2025-10-07 05:33:43', '2025-10-07 05:33:43'),
(41, 11, 'Đồng hồ nữ', '2025-10-07 05:33:50', '2025-10-07 05:33:50'),
(42, 11, 'Đồng hồ trẻ em', '2025-10-07 05:33:58', '2025-10-07 05:33:58'),
(43, 12, 'Giày đế bằng', '2025-10-07 05:34:37', '2025-10-07 05:34:37'),
(44, 12, 'Giày cao gót', '2025-10-07 05:34:53', '2025-10-07 05:34:53'),
(45, 12, 'Giày thể thao', '2025-10-07 05:35:02', '2025-10-07 05:35:02'),
(46, 13, 'Dép quai ngang', '2025-10-07 05:35:18', '2025-10-07 05:35:18'),
(47, 13, 'Giày thể thao', '2025-10-07 05:35:29', '2025-10-07 05:35:29'),
(48, 13, 'Giày tây', '2025-10-07 05:35:40', '2025-10-07 05:35:40'),
(49, 14, 'Đồ gia dụng nhà bếp', '2025-10-07 05:36:07', '2025-10-07 05:36:07'),
(50, 14, 'Quạt & máy nóng lạnh', '2025-10-07 05:36:19', '2025-10-07 05:36:19'),
(51, 14, 'Bếp điện', '2025-10-07 05:36:28', '2025-10-07 05:36:28'),
(52, 15, 'Sách tiếng việt', '2025-10-07 05:36:45', '2025-10-07 05:36:45'),
(53, 15, 'Sách ngoại văn', '2025-10-07 05:36:54', '2025-10-07 05:36:54'),
(54, 15, 'Bút viết & sách vở', '2025-10-07 05:37:06', '2025-10-07 05:37:06'),
(55, 15, 'Dụng cụ văn phòng', '2025-10-07 05:37:17', '2025-10-07 05:37:17'),
(56, 16, 'Phụ kiện du lịch', '2025-10-07 05:37:44', '2025-10-07 05:37:44'),
(57, 16, 'Phụ kiện thể thao', '2025-10-07 05:38:04', '2025-10-07 05:38:04'),
(58, 16, 'Thời trang thể thao', '2025-10-07 05:38:18', '2025-10-07 05:38:18'),
(59, 17, 'Trang phục bé gái', '2025-10-07 05:39:21', '2025-10-07 05:39:21'),
(60, 17, 'Trang phục bé trai', '2025-10-07 05:39:30', '2025-10-07 05:39:30'),
(61, 17, 'Giày dép bé gái', '2025-10-07 05:39:37', '2025-10-07 05:39:37'),
(62, 17, 'Giày dép bé trai', '2025-10-07 05:39:46', '2025-10-07 05:39:46'),
(63, 18, 'Balo nam', '2025-10-07 05:40:06', '2025-10-07 05:40:06'),
(64, 18, 'Balo laptop nam', '2025-10-07 05:40:16', '2025-10-07 05:40:16'),
(65, 18, 'Túi đeo chéo nam', '2025-10-07 05:40:25', '2025-10-07 05:40:25'),
(66, 20, 'Balo nữ', '2025-10-07 05:40:47', '2025-10-07 05:40:47'),
(67, 20, 'Ví dự tiệc', '2025-10-07 05:41:07', '2025-10-07 05:41:07'),
(68, 20, 'Ví cầm tay', '2025-10-07 05:41:13', '2025-10-07 05:41:13'),
(69, 20, 'Túi tote', '2025-10-07 05:41:23', '2025-10-07 05:41:23'),
(70, 19, 'Nhẫn', '2025-10-07 05:41:42', '2025-10-07 05:41:42'),
(71, 19, 'Dây chuyền', '2025-10-07 05:41:48', '2025-10-07 05:41:48'),
(72, 19, 'Găng tay', '2025-10-07 05:41:54', '2025-10-07 05:41:54'),
(73, 19, 'Bông tai', '2025-10-07 05:42:05', '2025-10-07 05:42:05'),
(74, 19, 'Khăn choàng', '2025-10-07 05:42:13', '2025-10-07 05:42:13'),
(75, 1, 'Áo khoác', '2025-10-07 05:42:41', '2025-10-07 05:42:41'),
(76, 1, 'Áo thun', '2025-10-07 05:42:47', '2025-10-07 05:42:47'),
(77, 1, 'Quần dài & quần âu', '2025-10-07 05:42:58', '2025-10-07 05:42:58'),
(78, 1, 'Quần short nam', '2025-10-07 05:43:11', '2025-10-07 05:43:11'),
(79, 2, 'Đầm & Váy', '2025-10-07 05:43:40', '2025-10-07 05:48:46'),
(80, 2, 'Quần đùi', '2025-10-07 05:43:51', '2025-10-07 05:43:51'),
(81, 2, 'Chân váy', '2025-10-07 05:43:56', '2025-10-07 05:43:56'),
(82, 2, 'Váy cưới', '2025-10-07 05:44:31', '2025-10-07 05:44:31'),
(83, 2, 'Đồ liền thân', '2025-10-07 05:44:37', '2025-10-07 05:44:37'),
(84, 5, 'Tai nghe bluetooh', '2025-10-07 09:17:59', '2025-10-07 09:18:36'),
(85, 5, 'Tai nghe có dây', '2025-10-07 09:18:09', '2025-10-07 09:18:09'),
(86, 2, 'Quần jean nữ', '2025-10-07 10:59:39', '2025-10-07 10:59:39'),
(87, 3, 'Điện thoại thông minh', '2025-10-07 04:51:09', '2025-10-07 04:51:09'),
(88, 1, 'THẮT LƯNG', '2025-10-07 13:36:15', '2025-10-07 13:36:15'),
(89, 1, 'Trang Sức Nam', '2025-10-07 13:48:03', '2025-10-07 13:48:03'),
(90, 1, 'Kính Mắt Nam', '2025-10-07 13:48:21', '2025-10-07 13:48:21'),
(91, 1, 'Phụ kiện nam', '2025-10-07 13:49:59', '2025-10-07 13:49:59'),
(92, 2, 'Áo thun', '2025-10-07 15:23:44', '2025-10-07 15:23:44'),
(93, 9, 'MÁY ẢNH', '2025-10-07 15:28:25', '2025-10-07 15:28:25'),
(94, 15, 'SÁCH TIỂU THUYẾT', '2025-10-07 16:10:21', '2025-10-07 16:10:21'),
(95, 11, 'FAKE', '2025-10-07 19:52:32', '2025-10-07 19:52:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `userImg` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `email_verified_at`, `password`, `role_id`, `status`, `userImg`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Quản Trị', 'Viên', 'admin@gmail.com', NULL, '$2y$10$RL1hlA59rQnxxpUrdyLMjOB31Dy0HADkbUoV1ILXPqo4tzojLKiRC', '0', '1', NULL, NULL, '2025-10-07 02:42:30', '2025-10-07 02:42:30'),
(2, 'User', 'Two', 'user2@example.com', NULL, '$2y$10$87A0WgduS022sBdO6bWyOegXist0Huj.i3XcRIXyAr40OmcPDkgXC', '2', '1', NULL, NULL, '2025-10-07 00:00:00', '2025-10-07 00:00:00'),
(3, 'User', 'Three', 'user3@example.com', NULL, '$2y$10$87A0WgduS022sBdO6bWyOegXist0Huj.i3XcRIXyAr40OmcPDkgXC', '2', '1', NULL, NULL, '2025-10-07 00:00:00', '2025-10-07 00:00:00'),
(4, 'User', 'Four', 'user4@example.com', NULL, '$2y$10$87A0WgduS022sBdO6bWyOegXist0Huj.i3XcRIXyAr40OmcPDkgXC', '2', '1', NULL, NULL, '2025-10-07 00:00:00', '2025-10-07 00:00:00'),
(5, 'User', 'Five', 'user5@example.com', NULL, '$2y$10$87A0WgduS022sBdO6bWyOegXist0Huj.i3XcRIXyAr40OmcPDkgXC', '2', '1', NULL, NULL, '2025-10-07 00:00:00', '2025-10-07 00:00:00'),
(6, 'User', 'Six', 'user6@example.com', NULL, '$2y$10$87A0WgduS022sBdO6bWyOegXist0Huj.i3XcRIXyAr40OmcPDkgXC', '2', '1', NULL, NULL, '2025-10-07 00:00:00', '2025-10-07 00:00:00'),
(7, 'User', 'Seven', 'user7@example.com', NULL, '$2y$10$87A0WgduS022sBdO6bWyOegXist0Huj.i3XcRIXyAr40OmcPDkgXC', '2', '1', NULL, NULL, '2025-10-07 00:00:00', '2025-10-07 00:00:00'),
(8, 'User', 'Eight', 'user8@example.com', NULL, '$2y$10$87A0WgduS022sBdO6bWyOegXist0Huj.i3XcRIXyAr40OmcPDkgXC', '2', '1', NULL, NULL, '2025-10-07 00:00:00', '2025-10-07 00:00:00'),
(9, 'User', 'Nine', 'user9@example.com', NULL, '$2y$10$87A0WgduS022sBdO6bWyOegXist0Huj.i3XcRIXyAr40OmcPDkgXC', '2', '1', NULL, NULL, '2025-10-07 00:00:00', '2025-10-07 00:00:00'),
(10, 'hoang', 'viet', 'chauviet360@gmail.com', NULL, '$2y$10$u5oaJH22OEPlpgOUUxlesuKrcnblQ9ZMmh5gQDQlRAJ8IZY1hBDQe', '2', '1', 'users_img/oNXH16XfQmUssXJfyTIhLdEsf9cVQ613ZrUziNXS.jpg', NULL, '2025-10-07 19:34:19', '2025-10-07 19:35:08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user_id_foreign` (`user_id`),
  ADD KEY `cart_shop_id_foreign` (`shop_id`),
  ADD KEY `cart_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupon_code` (`coupon_code`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_shop_id_foreign` (`shop_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_shop_id_foreign` (`shop_id`),
  ADD KEY `orders_shipping_id_foreign` (`shipping_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_order_id_foreign` (`order_id`),
  ADD KEY `order_detail_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_shop_id_foreign` (`shop_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`);

--
-- Chỉ mục cho bảng `products_combinations`
--
ALTER TABLE `products_combinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_combinations_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_images_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `products_variations_options`
--
ALTER TABLE `products_variations_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_variations_options_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `products_variations_options_value`
--
ALTER TABLE `products_variations_options_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_variations_options_value_products_variation_id_foreign` (`products_variation_id`);

--
-- Chỉ mục cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_user_id_foreign` (`user_id`),
  ADD KEY `shipping_shop_id_foreign` (`shop_id`);

--
-- Chỉ mục cho bảng `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shop_shopname_unique` (`shopname`),
  ADD UNIQUE KEY `shop_email_unique` (`email`);

--
-- Chỉ mục cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `products_combinations`
--
ALTER TABLE `products_combinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT cho bảng `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT cho bảng `products_variations_options`
--
ALTER TABLE `products_variations_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `products_variations_options_value`
--
ALTER TABLE `products_variations_options_value`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT cho bảng `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `shop`
--
ALTER TABLE `shop`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`),
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`),
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`),
  ADD CONSTRAINT `orders_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`),
  ADD CONSTRAINT `orders_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`),
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Các ràng buộc cho bảng `products_combinations`
--
ALTER TABLE `products_combinations`
  ADD CONSTRAINT `products_combinations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `products_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products_variations_options`
--
ALTER TABLE `products_variations_options`
  ADD CONSTRAINT `products_variations_options_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products_variations_options_value`
--
ALTER TABLE `products_variations_options_value`
  ADD CONSTRAINT `products_variations_options_value_products_variation_id_foreign` FOREIGN KEY (`products_variation_id`) REFERENCES `products_variations_options` (`id`);

--
-- Các ràng buộc cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`),
  ADD CONSTRAINT `shipping_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
--
-- Cơ sở dữ liệu: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__bookmark`
--

CREATE TABLE IF NOT EXISTS `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__central_columns`
--

CREATE TABLE IF NOT EXISTS `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__column_info`
--

CREATE TABLE IF NOT EXISTS `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__designer_settings`
--

CREATE TABLE IF NOT EXISTS `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__export_templates`
--

CREATE TABLE IF NOT EXISTS `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__favorite`
--

CREATE TABLE IF NOT EXISTS `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__history`
--

CREATE TABLE IF NOT EXISTS `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__navigationhiding`
--

CREATE TABLE IF NOT EXISTS `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__recent`
--

CREATE TABLE IF NOT EXISTS `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__relation`
--

CREATE TABLE IF NOT EXISTS `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__savedsearches`
--

CREATE TABLE IF NOT EXISTS `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__table_coords`
--

CREATE TABLE IF NOT EXISTS `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__table_info`
--

CREATE TABLE IF NOT EXISTS `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__table_uiprefs`
--

CREATE TABLE IF NOT EXISTS `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__tracking`
--

CREATE TABLE IF NOT EXISTS `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__userconfig`
--

CREATE TABLE IF NOT EXISTS `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Đang đổ dữ liệu cho bảng `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-10-07 13:37:09', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__usergroups`
--

CREATE TABLE IF NOT EXISTS `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__users`
--

CREATE TABLE IF NOT EXISTS `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Chỉ mục cho bảng `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Chỉ mục cho bảng `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Chỉ mục cho bảng `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Chỉ mục cho bảng `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Chỉ mục cho bảng `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Chỉ mục cho bảng `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Chỉ mục cho bảng `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Chỉ mục cho bảng `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Chỉ mục cho bảng `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Chỉ mục cho bảng `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Chỉ mục cho bảng `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Chỉ mục cho bảng `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Chỉ mục cho bảng `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Cơ sở dữ liệu: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
-- Re-enable checks after import
SET UNIQUE_CHECKS=1;
SET FOREIGN_KEY_CHECKS=1;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

