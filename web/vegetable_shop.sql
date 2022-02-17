-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 11, 2022 lúc 09:13 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vegetable_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` bigint(20) NOT NULL,
  `cart_qty` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `pro_id` bigint(20) NOT NULL,
  `cart_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_qty`, `user_id`, `pro_id`, `cart_status`, `created_at`, `updated_at`) VALUES
(7, 2, 2, 1, 2, '2021-11-25 09:18:33', '2021-11-30 05:47:41'),
(8, 16, 2, 4, 2, '2021-11-25 09:18:36', '2021-11-26 08:57:44'),
(9, 2, 2, 7, 2, '2021-11-30 05:47:33', '2021-11-30 05:49:02'),
(10, 1, 2, 5, 2, '2021-11-30 05:53:40', '2021-12-28 05:11:37'),
(11, 3, 3, 6, 2, '2021-11-30 05:56:23', '2021-11-30 05:57:36'),
(12, 1, 1, 13, 2, '2021-12-28 01:05:41', '2021-12-28 01:07:30'),
(13, 1, 1, 13, 2, '2021-12-28 01:09:38', '2021-12-28 01:10:03'),
(14, 1, 1, 10, 2, '2021-12-28 01:23:14', '2021-12-28 01:23:28'),
(15, 1, 2, 4, 2, '2021-12-28 05:11:18', '2021-12-28 05:11:37'),
(16, 1, 6, 8, 1, '2021-12-28 05:16:14', '2021-12-28 05:16:14'),
(17, 1, 1, 4, 1, '2021-12-29 10:05:40', '2021-12-29 10:05:40'),
(18, 1, 1, 1, 1, '2022-01-06 07:39:00', '2022-01-06 07:39:00'),
(20, 2, 2, 5, 2, '2022-01-22 14:26:27', '2022-01-22 14:29:06'),
(24, 1, 1, 5, 1, '2022-01-24 12:59:51', '2022-01-24 12:59:51'),
(25, 1, 1, 24, 2, '2022-02-08 13:08:44', '2022-02-08 14:06:21'),
(26, 1, 1, 25, 2, '2022-02-08 13:08:47', '2022-02-08 14:06:22'),
(27, 2, 1, 10, 2, '2022-02-08 14:05:10', '2022-02-08 14:06:22'),
(28, 1, 1, 31, 1, '2022-02-08 14:09:43', '2022-02-08 14:09:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug`, `category_image`, `category_status`, `created_at`, `updated_at`) VALUES
(2, 'Giỏ Hoa Quả', 'gio-hoa-qua', '1641458731_gio-trai-cay-pleiku-gia-lai.jpg', 1, '2021-11-20 06:30:33', '2022-01-06 08:45:31'),
(3, 'Miền Trung', 'mien-trung', '1641458374_Trai-cay.jpg', 1, '2021-11-24 04:50:59', '2022-01-06 08:39:34'),
(5, 'Miền Bắc', 'mien-bac', '1641458343_khi-cac-loai-trai-cay-ket-hop-voi-nhau-01.jpg', 1, '2021-11-24 05:20:59', '2022-01-06 08:39:03'),
(9, 'Miền Nam', 'mien-nam', '1641005296_1641004307_le1bbb1a20che1bb8dn20trc3a1i20cc3a2y20c491e1bb8320c491e1baa3m20be1baa3o20dinh20dc6b0e1bba1ng20te1bb91t20nhe1baa5t-1626924648367-1626924649678706100128.jpg', 1, '2022-01-01 02:48:16', '2022-01-01 02:48:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_qty` int(11) NOT NULL,
  `coupon_date_start` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_date_end` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_used` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_condition` int(11) NOT NULL,
  `coupon_sale_number` int(11) NOT NULL,
  `coupon_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_code`, `coupon_qty`, `coupon_date_start`, `coupon_date_end`, `coupon_used`, `coupon_condition`, `coupon_sale_number`, `coupon_status`, `created_at`, `updated_at`) VALUES
(1, 'sale21', 21, '2021/11/21', '2021/11/27', NULL, 2, 3, 1, '2021-11-22 03:37:25', '2021-12-28 00:48:12'),
(2, 'sale123', 19, '2021/11/21', '2021/11/30', ',3', 1, 10000, 1, '2021-11-22 03:37:25', '2021-12-28 00:48:11'),
(3, 'mh', 12, '2022/01/01', '2022/01/02', NULL, 1, 12, 1, '2022-01-01 02:28:12', '2022-01-01 02:28:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_pay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_email`, `customer_address`, `customer_phone`, `customer_pay`, `customer_note`, `created_at`, `updated_at`) VALUES
(1, 'nguyễn văn a', 'user1@gmail.com', '123/456 tổ 6 khu 7 phú lợi', '0773654089', 'COD', NULL, '2021-11-26 08:57:44', '2021-11-26 08:57:44'),
(2, 'user1', 'user1@gmail.com', 'dcdcdcd', '0773654022', 'COD', NULL, '2021-11-30 05:49:02', '2021-11-30 05:49:02'),
(3, 'Nguyễn Văn A', 'user2@gmail.com', 'dsdsdsd', '0773654028', 'COD', NULL, '2021-11-30 05:57:36', '2021-11-30 05:57:36'),
(4, 'b s', 'admin@gmail.com', 'ha noi', '0965258010', 'COD', NULL, '2021-12-28 01:07:30', '2021-12-28 01:07:30'),
(5, 'Bùi Thị Thu Trang', 'admin@gmail.com', 'Tp. Vĩnh Yên', '0328013839', 'COD', NULL, '2021-12-28 01:10:03', '2021-12-28 01:10:03'),
(6, 'Bùi Thị Thu Trang', 'admin@gmail.com', 'Tp. Vĩnh Yên', '0328013839', 'COD', NULL, '2021-12-28 01:23:28', '2021-12-28 01:23:28'),
(7, 'Bùi Thị Thu Trang', 'user1@gmail.com', 'Tp. Vĩnh Yên', '0328013839', 'COD', NULL, '2021-12-28 05:11:37', '2021-12-28 05:11:37'),
(8, 'Bùi Thị Thu Trang', 'user1@gmail.com', '00', '0328013839', 'COD', NULL, '2022-01-22 14:29:06', '2022-01-22 14:29:06'),
(9, 'Bùi Thị Thu Trang', 'admin@gmail.com', 'Tp. Vĩnh Yên', '0328013839', 'COD', NULL, '2022-02-08 14:06:21', '2022-02-08 14:06:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `cus_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`order_id`, `cus_id`, `order_code`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 1, '1996506331', 3, '2021-11-26 08:57:44', '2021-11-28 06:19:52'),
(2, 2, '994609999', 3, '2021-11-30 05:49:02', '2021-12-28 01:24:37'),
(3, 3, '910487397', 3, '2021-11-30 05:57:36', '2021-11-30 05:59:13'),
(4, 4, '1598743612', 2, '2021-12-28 01:07:30', '2021-12-28 05:02:58'),
(7, 7, '910685728', 3, '2021-12-28 05:11:37', '2022-01-01 02:30:13'),
(8, 8, '1603394599', 1, '2022-01-22 14:29:06', '2022-01-22 14:29:06'),
(9, 9, '580842757', 1, '2022-02-08 14:06:21', '2022-02-08 14:06:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` bigint(20) UNSIGNED NOT NULL,
  `pro_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_de_price` int(11) NOT NULL,
  `order_de_qty` int(11) NOT NULL,
  `order_de_coupon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `pro_id`, `order_code`, `order_de_price`, `order_de_qty`, `order_de_coupon`, `created_at`, `updated_at`) VALUES
(7, 10, '1047199572', 80000, 1, 'no', '2021-12-28 01:23:28', '2021-12-28 01:23:28'),
(11, 24, '580842757', 30000, 1, 'no', '2022-02-08 14:06:21', '2022-02-08 14:06:21'),
(12, 25, '580842757', 30000, 1, 'no', '2022-02-08 14:06:22', '2022-02-08 14:06:22'),
(13, 10, '580842757', 80000, 2, 'no', '2022-02-08 14:06:22', '2022-02-08 14:06:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` bigint(20) NOT NULL,
  `product_price_sale` bigint(20) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_view` int(11) NOT NULL,
  `product_sold` int(11) NOT NULL,
  `product_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `product_slug`, `category_id`, `product_desc`, `product_price`, `product_price_sale`, `product_quantity`, `product_view`, `product_sold`, `product_status`, `created_at`, `updated_at`) VALUES
(8, 'Đào', '1641459152_dao-sapa-1-1.jpg', 'dao', 5, 'Đ&agrave;o Sapa c&oacute; h&igrave;nh d&aacute;ng mỏ quạ, tức l&agrave; phần đ&aacute;y quả thường c&oacute; chỗ nhọn l&ecirc;n v&agrave; hơi khoằm. H&igrave;nh d&aacute;ng kh&ocirc;ng bắt mắt, quả kh&ocirc;ng c&acirc;n đối, thường chỉ nhỏ, đường k&iacute;nh tầm 5-6 cm', 52000, 0, 136, 0, 0, 1, '2021-11-30 03:48:14', '2022-01-06 08:52:32'),
(10, 'Nhãn lồng', '1641458876_nhan-long-hung-yen-co-mau-vang-sam-da-tron-bong..jpg', 'nhan-long', 5, 'Nh&atilde;n Lồng Hưng Y&ecirc;n c&oacute; vỏ m&agrave;u v&agrave;ng sậm tự nhi&ecirc;n, c&ugrave;i gi&ograve;n, hạt nhỏ đen nh&aacute;y, m&ugrave;i thơm tự nhi&ecirc;n, đ&aacute;y c&oacute; hai dẻ c&ugrave;i lồng xếp kh&iacute;t v&agrave;o nhau.', 80000, 0, 119, 0, 0, 1, '2021-11-30 03:49:35', '2022-01-06 08:47:56'),
(21, 'Quả Thanh Mai', '1641459523_MB1.jpg', 'qua-thanh-mai', 5, 'Đặc Sản m&ugrave;a h&egrave; m&oacute;n ăn vặt kho&aacute;i khẩu', 30000, 0, 1, 0, 0, 1, '2022-01-06 08:58:43', '2022-01-06 08:58:43'),
(22, 'Chôm Chôm', '1641459957_kk.jpg', 'chom-chom', 9, 'Đặc sản miền nam', 30000, 0, 12, 0, 0, 1, '2022-01-06 09:05:57', '2022-01-06 09:05:57'),
(23, 'Dừa Sáp', '1641460021_coconut.jpg', 'dua-sap', 9, 'Dừa Tr&agrave; Vinh', 30000, 0, 15, 0, 0, 1, '2022-01-06 09:07:02', '2022-01-06 09:07:02'),
(24, 'Vú Sữa', '1641460103_07gRzXG8.jpg', 'vu-sua', 9, 'V&uacute; Sữa L&ograve; R&egrave;n', 30000, 0, 12, 0, 0, 1, '2022-01-06 09:08:23', '2022-01-06 09:08:23'),
(25, 'Xoài Tượng', '1641460158_img_1224-6633.jpg', 'xoai-tuong', 3, 'Xo&agrave;i Tượng B&igrave;nh Định', 30000, 0, 12, 0, 0, 1, '2022-01-06 09:09:18', '2022-01-06 09:09:18'),
(26, 'Bơ Sáp', '1641460312_images.jpg', 'bo-sap', 3, '<p>Bơ s&aacute;p Đắk Lắk.</p>', 30000, 0, 1, 0, 0, 1, '2022-01-06 09:11:52', '2022-01-06 09:11:52'),
(27, 'Lựu', '1641460402_mot_so_loai_trai_cay_giup_ban_tre_lau_0.jpg', 'luu', 3, 'Lựu Miền trung', 30000, 0, 13, 0, 0, 1, '2022-01-06 09:13:22', '2022-01-06 09:13:22'),
(28, 'Giỏ Cam', '1641460466_91103392_2584252665148367_2771744186557267968_n.jpg', 'gio-ca', 2, 'Giỏ Cam qu&agrave; tặng lễ tết', 100000, 0, 1, 0, 0, 1, '2022-01-06 09:14:26', '2022-01-06 09:14:26'),
(29, 'Giỏ Nho', '1641460513_gio-qua-trai-cay-bieu-tang-5.jpg', 'gio-nho', 2, 'D&agrave;nh tặng lễ tết&nbsp;', 80000, 0, 1, 0, 0, 1, '2022-01-06 09:15:13', '2022-01-06 09:15:13'),
(30, 'Giỏ Hoa quả nhiều loại', '1641460565_gio-trai-cay-pleiku-gia-lai.jpg', 'gio-hoa-qua-nhieu-loai', 2, 'Mix nhiều loại hoa quả&nbsp;', 300000, 0, 12, 0, 0, 1, '2022-01-06 09:16:05', '2022-01-06 09:16:05'),
(31, 'Măng Cụt', '1644240864_nhung-loai-trai-cay-chi-co-o-viet-nam.jpg', 'mang-cut', 9, 'Ngon m&aacute;t&nbsp;', 52000, 0, 15, 0, 0, 1, '2022-02-07 13:34:24', '2022-02-07 13:34:24'),
(32, 'Nho khô', '1644242068_1638247452_1632203699240.png', 'nho-kho', 5, 'Ngon', 30000, 0, 1, 0, 0, 1, '2022-02-07 13:54:28', '2022-02-07 13:54:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

CREATE TABLE `slider` (
  `slider_id` bigint(20) UNSIGNED NOT NULL,
  `slider_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_name`, `slider_desc`, `slider_url`, `slider_image`, `slider_status`, `created_at`, `updated_at`) VALUES
(1, 'We serve Fresh Vegestables & Fruits', 'We deliver organic vegetables & fruits', NULL, '1637556040_bg_3.jpg', 2, '2021-11-22 04:35:39', '2022-01-01 03:24:47'),
(2, 'We serve Fresh Vegestables & Fruits', 'We deliver organic vegetables & fruits', NULL, '1637555875_bg_1.jpg', 1, '2021-11-22 04:37:55', '2021-12-28 05:04:17'),
(3, '100% Fresh & Organic Foods', 'We deliver organic vegetables & fruits', NULL, '1637556102_bg_2.jpg', 1, '2021-11-22 04:41:42', '2021-12-28 00:30:13'),
(6, '100% Fresh & Organic Foods', 'We deliver organic vegetables & fruits', NULL, '1641004144_le1bbb1a20che1bb8dn20trc3a1i20cc3a2y20c491e1bb8320c491e1baa3m20be1baa3o20dinh20dc6b0e1bba1ng20te1bb91t20nhe1baa5t-1626924648367-1626924649678706100128.jpg', 1, '2022-01-01 02:29:04', '2022-01-01 02:29:04'),
(7, '100% Fresh & Organic Foods', 'We deliver organic vegetables & fruits', NULL, '1641007475_Trai-cay.jpg', 1, '2022-01-01 03:24:35', '2022-01-01 03:24:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `statistical`
--

CREATE TABLE `statistical` (
  `id_statistic` int(11) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `sales` varchar(255) NOT NULL,
  `profit` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `statistical`
--

INSERT INTO `statistical` (`id_statistic`, `order_date`, `sales`, `profit`, `quantity`, `total_order`, `created_at`, `updated_at`) VALUES
(1, '2021-02-06', '10000000', '9999000', 1, 1, NULL, NULL),
(2, '2021-03-01', '30000000', '29999000', 2, 1, NULL, NULL),
(3, '2021-03-02', '29000000', '28999000', 2, 1, NULL, NULL),
(4, '2021-03-03', '29000000', '28998000', 2, 2, NULL, NULL),
(5, '2021-03-09', '14500000', '14499000', 1, 1, NULL, NULL),
(6, '2021-03-11', '14500000', '14499000', 1, 1, NULL, NULL),
(7, '2021-03-13', '43500000', '43498000', 2, 2, NULL, NULL),
(8, '2021-04-01', '22000000', '21999000', 1, 1, NULL, NULL),
(9, '2021-04-02', '19000000', '18999000', 1, 1, NULL, NULL),
(10, '2021-05-03', '19000000', '18999000', 1, 1, NULL, NULL),
(11, '2021-05-04', '1500000', '1499000', 1, 1, NULL, NULL),
(12, '2021-05-02', '15000000', '14999000', 1, 1, NULL, NULL),
(13, '2021-06-29', '14500000', '14499000', 1, 1, NULL, NULL),
(14, '2021-07-15', '30000000', '29999000', 2, 1, NULL, NULL),
(15, '2021-07-16', '19000000', '18999000', 1, 1, NULL, NULL),
(16, '2021-08-24', '61000000', '60998000', 4, 2, NULL, NULL),
(17, '2021-09-25', '9000000', '8999000', 1, 1, NULL, NULL),
(18, '2021-09-27', '56000000', '55998000', 4, 2, NULL, NULL),
(19, '2021-10-06', '960000000', '959985000', 16, 19, NULL, NULL),
(20, '2021-10-13', '80000000', '79999000', 1, 1, NULL, NULL),
(21, '2021-10-21', '260000000', '259996000', 6, 6, NULL, NULL),
(22, '2021-10-23', '200000000', '199998000', 4, 2, NULL, NULL),
(23, '2021-10-28', '18000000', '17999000', 2, 1, NULL, NULL),
(24, '2021-11-12', '300000', '299000', 1, 1, NULL, NULL),
(25, '2021-11-17', '6600000', '6599000', 14, 2, NULL, NULL),
(26, '2021-11-28', '810000', '807000', 18, 6, '2021-11-28 06:09:15', '2021-11-28 06:19:52'),
(27, '2021-11-30', '200000', '199000', 2, 1, '2021-11-30 05:59:13', '2021-11-30 05:59:13'),
(28, '2021-12-28', '80000', '79000', 2, 1, '2021-12-28 01:24:37', '2021-12-28 01:24:37'),
(29, '2022-01-01', '110000', '109000', 2, 2, '2022-01-01 02:30:13', '2022-01-01 02:30:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `level`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 1, '$2y$10$NCUHalSt7EGHKAYt60U0UOCPK1dhb8Nz50UGSKVk.1ETzVePMQ4Zi', NULL, '2021-11-22 05:01:36', '2021-11-29 03:06:03'),
(2, 'user1', 'user1@gmail.com', 2, '$2y$10$NCUHalSt7EGHKAYt60U0UOCPK1dhb8Nz50UGSKVk.1ETzVePMQ4Zi', NULL, '2021-11-22 05:03:20', '2021-11-22 05:03:20'),
(3, 'Nguyễn Văn A', 'user2@gmail.com', 2, '$2y$10$ackVTi80jrFhN7GMUINgnuI3LfYFr1VYo7jjGzm4RrI.v.5MPph2i', 'g8GJup1TqMeHHe1HFqxsnaKzdWW0Cmn8TBhMLX6hLoayE7TuoUznIZVpKBpZ', '2021-11-24 09:33:35', '2021-11-24 09:33:35'),
(6, 'bt@gmail.com', 'bt@gmail.com', 1, '$2y$10$KTpZQ5GTxeakTw8opgZA7.DER80wQc9CSS1DxMt2uQ2hko1MmZ5ye', NULL, '2021-12-28 05:15:18', '2021-12-28 05:15:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` bigint(20) UNSIGNED NOT NULL,
  `pro_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `pro_id`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 29, 1, '2022-01-29 13:56:14', '2022-01-29 13:56:14');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_category_slug_unique` (`category_slug`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_detail_pro_id_foreign` (`pro_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_product_slug_unique` (`product_slug`),
  ADD KEY `product_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Chỉ mục cho bảng `statistical`
--
ALTER TABLE `statistical`
  ADD PRIMARY KEY (`id_statistic`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `wishlist_pro_id_foreign` (`pro_id`),
  ADD KEY `wishlist_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `statistical`
--
ALTER TABLE `statistical`
  MODIFY `id_statistic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `cus` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_pro_id_foreign` FOREIGN KEY (`pro_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_pro_id_foreign` FOREIGN KEY (`pro_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
