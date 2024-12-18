-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 30, 2024 lúc 12:02 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `train`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bienthes`
--

CREATE TABLE `bienthes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `cost` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Áo Nam 1', NULL, '2024-10-21 22:55:37', '2024-11-01 07:07:09'),
(2, 'Quần Nam', NULL, '2024-10-21 22:55:37', '2024-10-21 22:55:37'),
(3, 'Tung', NULL, NULL, '2024-10-22 02:30:34'),
(4, 'Tung', NULL, NULL, '2024-10-30 10:01:40'),
(5, 'Maida Bednar1', NULL, NULL, NULL),
(6, 'iphone 16', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_22_051517_create_categories_table', 1),
(6, '2024_10_22_051547_create_tags_table', 1),
(7, '2024_10_22_051614_create_products_table', 1),
(8, '2024_10_22_051634_create_bienthes_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cost` varchar(255) NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `description`, `cost`, `tag_id`, `category_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Mr. Jordon Mann1', 'https://via.placeholder.com/640x480.png/005522?text=qui', 'Dolorem eius aut adipisci ratione. Quidem culpa commodi at dignissimos. Dolores iusto impedit itaque suscipit consectetur culpa.', '111', 6, 2, NULL, '2024-10-21 22:57:50', '2024-10-23 04:04:38'),
(2, 'Queen Ryan Jr.', 'https://via.placeholder.com/640x480.png/0088aa?text=aut', 'Itaque commodi laudantium et. Rem voluptas nam sapiente sunt voluptatem consectetur iure et. Ad ratione rerum quia ducimus assumenda ut dolore.', '237926', 8, 2, NULL, '2024-10-21 22:57:50', '2024-10-23 04:04:45'),
(3, 'Maxime Kunde', 'https://via.placeholder.com/640x480.png/001144?text=soluta', 'Deserunt illum possimus quasi perspiciatis cumque eos. Dolor omnis esse odio voluptatem et voluptatum consequuntur. Voluptas vero debitis aliquid magni. Reprehenderit ut quam nostrum accusamus rerum.', '150329', 10, 2, NULL, '2024-10-21 22:57:50', '2024-10-21 22:57:50'),
(4, 'Addison Corwin Sr.', 'https://via.placeholder.com/640x480.png/008811?text=officiis', 'Nisi adipisci eum rerum minus. Temporibus aspernatur aut aut et excepturi. Itaque facilis porro dolore dolor. Veritatis natus commodi asperiores voluptas.', '256917', 5, 2, NULL, '2024-10-21 22:57:50', '2024-10-21 22:57:50'),
(5, 'Mr. Isaac Rempel V', 'https://via.placeholder.com/640x480.png/0022bb?text=vitae', 'Odit illum enim cupiditate enim praesentium doloremque velit. Vel eum et asperiores necessitatibus quia ut a. Voluptatem pariatur veniam esse accusantium.', '255882', 4, 1, NULL, '2024-10-21 22:57:50', '2024-10-21 22:57:50'),
(6, 'Dr. Keenan Hansen', 'https://via.placeholder.com/640x480.png/004422?text=ab', 'Sit et aliquam architecto voluptas est. Sunt eos voluptas dolores ipsum nisi. Commodi voluptatem nisi voluptate sit.', '486969', 5, 2, NULL, '2024-10-21 22:57:50', '2024-10-21 22:57:50'),
(7, 'Dr. Coralie Hegmann', 'https://via.placeholder.com/640x480.png/00ee11?text=qui', 'Odit ut tenetur qui. Maiores soluta sed perferendis quasi quas voluptate maxime. Dolores vel ut consequuntur voluptas modi molestiae consequatur repellendus.', '335615', 2, 1, NULL, '2024-10-21 22:57:50', '2024-10-21 22:57:50'),
(8, 'Nestor Roob MD', 'https://via.placeholder.com/640x480.png/00aadd?text=et', 'A saepe repudiandae odit. Eius iusto ex mollitia aperiam quidem.', '369356', 2, 1, NULL, '2024-10-21 22:57:50', '2024-10-21 22:57:50'),
(9, 'Hudson Gibson', 'https://via.placeholder.com/640x480.png/00dd33?text=iste', 'Aut voluptatem aliquid sed et praesentium. Et est sint praesentium. Tenetur rem occaecati inventore praesentium quis animi eum.', '159883', 2, 1, NULL, '2024-10-21 22:57:50', '2024-10-21 22:57:50'),
(10, 'Fredy Dietrich', 'https://via.placeholder.com/640x480.png/00ff22?text=soluta', 'Nihil et ab vitae dicta fugit eum excepturi. Reiciendis asperiores inventore quam placeat et. Et aspernatur totam quam hic nihil. Eaque repudiandae sit est dolorum.', '355654', 10, 1, NULL, '2024-10-21 22:57:50', '2024-10-21 22:57:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `name`, `img`, `category_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Donald Torp II', 'https://via.placeholder.com/640x480.png/008855?text=atque', 2, '2024-11-01 07:08:45', '2024-10-21 22:55:54', '2024-11-01 07:08:45'),
(2, 'Julian Conn II', 'https://via.placeholder.com/640x480.png/000044?text=repellat', 1, NULL, '2024-10-21 22:55:54', '2024-10-22 06:36:36'),
(3, 'Miss Cecile Pfannerstill', 'https://via.placeholder.com/640x480.png/009933?text=ea', 1, NULL, '2024-10-21 22:55:54', '2024-10-21 22:55:54'),
(4, 'Price Kub', 'https://via.placeholder.com/640x480.png/000033?text=minima', 1, NULL, '2024-10-21 22:55:54', '2024-10-21 22:55:54'),
(5, 'Reva Schaefer', 'https://via.placeholder.com/640x480.png/00bb88?text=autem', 1, NULL, '2024-10-21 22:55:54', '2024-10-21 22:55:54'),
(6, 'Jayson Huel', 'https://via.placeholder.com/640x480.png/00bbff?text=consectetur', 2, NULL, '2024-10-21 22:55:54', '2024-10-21 22:55:54'),
(7, 'Hazel Feil', 'https://via.placeholder.com/640x480.png/00dd88?text=officiis', 2, NULL, '2024-10-21 22:55:54', '2024-10-21 22:55:54'),
(8, 'Harmony Bogan III', 'https://via.placeholder.com/640x480.png/0033cc?text=illo', 2, NULL, '2024-10-21 22:55:54', '2024-10-21 22:55:54'),
(9, 'Prof. Doug Schneider II', 'https://via.placeholder.com/640x480.png/00dd99?text=cum', 2, NULL, '2024-10-21 22:55:54', '2024-10-21 22:55:54'),
(10, 'Peyton Dietrich', 'https://via.placeholder.com/640x480.png/00ee77?text=voluptates', 1, NULL, '2024-10-21 22:55:54', '2024-10-21 22:55:54'),
(11, 'Tung', 'tag/z7wxdpLLlirt8XIzee8lmknkiCrZ33zOqroRhIH1.jpg', 1, NULL, NULL, NULL),
(12, 'Tung', 'tag/nT9i1g2en4zOV2ut4RzJvcOPxY06gcSxRUy51EkZ.jpg', 1, NULL, NULL, NULL),
(13, 'Magnolia Jast 123', 'tag/fKe47cb0xpVK91medwG2EEbN8WVX0ewSCVeQopVW.jpg', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bienthes`
--
ALTER TABLE `bienthes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bienthes_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_tag_id_foreign` (`tag_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_category_id_foreign` (`category_id`);

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
-- AUTO_INCREMENT cho bảng `bienthes`
--
ALTER TABLE `bienthes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bienthes`
--
ALTER TABLE `bienthes`
  ADD CONSTRAINT `bienthes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Các ràng buộc cho bảng `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
