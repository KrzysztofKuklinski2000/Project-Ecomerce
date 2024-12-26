-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 26, 2024 at 07:37 PM
-- Wersja serwera: 8.0.35
-- Wersja PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `E-commerce`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_polish_ci,
  `price` float DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `product_size` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `image_url` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `product_size`, `image_url`, `category_id`, `created_at`) VALUES
(1, 'ALUMINIOWE MODEL-1', 'Odkryj nową generację okien PVC z trzema szybami, oferującą doskonałą izolację cieplną (U=0.9W/m²K) i akustyczną (31dB). Zaprojektowane z myślą o wygodzie, nasze okna otwierają się rozwierno-uchylnie, a solidna konstrukcja (81mm grubości stelaża) oraz wysoka jakość PVC i szkła gwarantują trwałość i odporność na warunki atmosferyczne.', 1250, 10, '1222x1234', 'aluminiowe1.webp', 1, '2024-12-26'),
(2, 'ALUMINIOWE MODEL-2\r\n', 'Odkryj nową generację okien PVC z trzema szybami, oferującą doskonałą izolację cieplną (U=0.9W/m²K) i akustyczną (31dB). Zaprojektowane z myślą o wygodzie, nasze okna otwierają się rozwierno-uchylnie, a solidna konstrukcja (81mm grubości stelaża) oraz wysoka jakość PVC i szkła gwarantują trwałość i odporność na warunki atmosferyczne.', 2100, 21, '1222x1234', 'aluminiowe2.jpeg', 1, '2024-12-26'),
(3, 'DREWNIANE MODEL-1', 'Odkryj nową generację okien PVC z trzema szybami, oferującą doskonałą izolację cieplną (U=0.9W/m²K) i akustyczną (31dB). Zaprojektowane z myślą o wygodzie, nasze okna otwierają się rozwierno-uchylnie, a solidna konstrukcja (81mm grubości stelaża) oraz wysoka jakość PVC i szkła gwarantują trwałość i odporność na warunki atmosferyczne.', 1100, 3, '1234x1123', 'drewniane1.png', 2, '2024-12-26'),
(4, 'DREWNIANE MODEL-2', 'Odkryj nową generację okien PVC z trzema szybami, oferującą doskonałą izolację cieplną (U=0.9W/m²K) i akustyczną (31dB). Zaprojektowane z myślą o wygodzie, nasze okna otwierają się rozwierno-uchylnie, a solidna konstrukcja (81mm grubości stelaża) oraz wysoka jakość PVC i szkła gwarantują trwałość i odporność na warunki atmosferyczne.\r\n', 1800, 22, '1100x600', 'drewniane2.jpeg', 2, '2024-12-26'),
(5, 'DREWNIANE MODEL-3', 'Odkryj nową generację okien PVC z trzema szybami, oferującą doskonałą izolację cieplną (U=0.9W/m²K) i akustyczną (31dB). Zaprojektowane z myślą o wygodzie, nasze okna otwierają się rozwierno-uchylnie, a solidna konstrukcja (81mm grubości stelaża) oraz wysoka jakość PVC i szkła gwarantują trwałość i odporność na warunki atmosferyczne.\r\n', 2400, 82, '300x1200', 'drewniane3.png', 2, '2024-12-26'),
(6, 'PCV MODEL-1', 'Odkryj nową generację okien PVC z trzema szybami, oferującą doskonałą izolację cieplną (U=0.9W/m²K) i akustyczną (31dB). Zaprojektowane z myślą o wygodzie, nasze okna otwierają się rozwierno-uchylnie, a solidna konstrukcja (81mm grubości stelaża) oraz wysoka jakość PVC i szkła gwarantują trwałość i odporność na warunki atmosferyczne.', 2400, 21, '1100x1300', 'pcv.png', 0, '2024-12-26'),
(7, 'PCV MODEL-2', 'Odkryj nową generację okien PVC z trzema szybami, oferującą doskonałą izolację cieplną (U=0.9W/m²K) i akustyczną (31dB). Zaprojektowane z myślą o wygodzie, nasze okna otwierają się rozwierno-uchylnie, a solidna konstrukcja (81mm grubości stelaża) oraz wysoka jakość PVC i szkła gwarantują trwałość i odporność na warunki atmosferyczne.', 3200, 22, '2000x1000', 'pcv2.jpeg', 0, '2024-12-26');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
