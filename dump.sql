-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 24, 2020 at 11:32 AM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MYhKZzhICc`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Wilburn Brekke', '2020-03-24 11:08:58', '2020-03-24 11:08:58'),
(2, 'Tamara Fisher V', '2020-03-24 11:08:59', '2020-03-24 11:08:59'),
(3, 'Mandy Bashirian', '2020-03-24 11:08:59', '2020-03-24 11:08:59'),
(4, 'Prof. Lyric Huel PhD', '2020-03-24 11:08:59', '2020-03-24 11:08:59'),
(5, 'Prof. Janick Kohler I', '2020-03-24 11:08:59', '2020-03-24 11:08:59'),
(6, 'Estel Bins', '2020-03-24 11:08:59', '2020-03-24 11:08:59'),
(7, 'Miss Tianna Schultz II', '2020-03-24 11:08:59', '2020-03-24 11:08:59'),
(8, 'Lottie Veum', '2020-03-24 11:09:00', '2020-03-24 11:09:00'),
(9, 'Patsy Wyman', '2020-03-24 11:09:00', '2020-03-24 11:09:00'),
(10, 'Else Marvin', '2020-03-24 11:09:00', '2020-03-24 11:09:00'),
(11, 'Jennings Tremblay', '2020-03-24 11:09:00', '2020-03-24 11:09:00'),
(12, 'Dr. Gonzalo Leannon I', '2020-03-24 11:09:00', '2020-03-24 11:09:00'),
(13, 'Prof. Rory Howell I', '2020-03-24 11:09:00', '2020-03-24 11:09:00'),
(14, 'Cleve Bode', '2020-03-24 11:09:01', '2020-03-24 11:09:01'),
(15, 'Shanon Yundt', '2020-03-24 11:09:01', '2020-03-24 11:09:01'),
(16, 'Ford Bartoletti', '2020-03-24 11:09:01', '2020-03-24 11:09:01'),
(17, 'Jasen Kohler', '2020-03-24 11:09:01', '2020-03-24 11:09:01'),
(18, 'Arianna Balistreri', '2020-03-24 11:09:01', '2020-03-24 11:09:01'),
(19, 'Ryan Renner', '2020-03-24 11:09:01', '2020-03-24 11:09:01'),
(20, 'Isidro Yost', '2020-03-24 11:09:02', '2020-03-24 11:09:02'),
(21, 'Roselyn Ortiz', '2020-03-24 11:09:02', '2020-03-24 11:09:02'),
(22, 'Janae Kessler', '2020-03-24 11:09:02', '2020-03-24 11:09:02'),
(23, 'Oral Ernser', '2020-03-24 11:09:02', '2020-03-24 11:09:02'),
(24, 'Alden Lebsack', '2020-03-24 11:09:02', '2020-03-24 11:09:02'),
(25, 'Mr. Sam Bauch PhD', '2020-03-24 11:09:02', '2020-03-24 11:09:02'),
(26, 'New Customer', '2020-03-24 11:17:37', '2020-03-24 11:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_03_18_084903_create_customers_table', 1),
(4, '2020_03_18_085011_create_sizes_table', 1),
(5, '2020_03_18_085103_create_pizzas_table', 1),
(6, '2020_03_18_085202_create_orders_table', 1),
(7, '2020_03_19_164937_create_ordered_pizzas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_pizzas`
--

CREATE TABLE `ordered_pizzas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pizza__id` int(10) UNSIGNED NOT NULL,
  `order__id` int(10) UNSIGNED NOT NULL,
  `pizza__size_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `pizza__quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordered_pizzas`
--

INSERT INTO `ordered_pizzas` (`id`, `pizza__id`, `order__id`, `pizza__size_id`, `pizza__quantity`, `created_at`, `updated_at`) VALUES
(1, 9, 3, 7, 5, '2020-03-24 11:09:07', '2020-03-24 11:09:07'),
(2, 1, 15, 1, 4, '2020-03-24 11:09:08', '2020-03-24 11:09:08'),
(3, 14, 12, 7, 3, '2020-03-24 11:09:08', '2020-03-24 11:09:08'),
(4, 1, 7, 5, 5, '2020-03-24 11:09:08', '2020-03-24 11:09:08'),
(5, 2, 5, 8, 2, '2020-03-24 11:09:08', '2020-03-24 11:09:08'),
(6, 8, 5, 5, 4, '2020-03-24 11:09:08', '2020-03-24 11:09:08'),
(7, 14, 14, 3, 1, '2020-03-24 11:09:08', '2020-03-24 11:09:08'),
(8, 8, 4, 8, 1, '2020-03-24 11:09:09', '2020-03-24 11:09:09'),
(9, 15, 13, 1, 4, '2020-03-24 11:09:09', '2020-03-24 11:09:09'),
(10, 7, 9, 5, 1, '2020-03-24 11:09:09', '2020-03-24 11:09:09'),
(11, 3, 10, 6, 1, '2020-03-24 11:09:09', '2020-03-24 11:09:09'),
(12, 2, 11, 7, 5, '2020-03-24 11:09:09', '2020-03-24 11:09:09'),
(13, 11, 5, 6, 2, '2020-03-24 11:09:09', '2020-03-24 11:09:09'),
(14, 3, 4, 2, 3, '2020-03-24 11:09:10', '2020-03-24 11:09:10'),
(15, 11, 14, 7, 2, '2020-03-24 11:09:10', '2020-03-24 11:09:10'),
(16, 3, 16, 1, 1, '2020-03-24 11:17:38', '2020-03-24 11:17:38'),
(17, 9, 16, 6, 1, '2020-03-24 11:17:38', '2020-03-24 11:17:38'),
(18, 10, 16, 4, 3, '2020-03-24 11:17:38', '2020-03-24 11:17:38'),
(19, 2, 17, 1, 3, '2020-03-24 11:26:25', '2020-03-24 11:26:25'),
(20, 8, 17, 4, 1, '2020-03-24 11:26:25', '2020-03-24 11:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer__id` int(10) UNSIGNED NOT NULL,
  `open` tinyint(1) NOT NULL,
  `payment` int(10) UNSIGNED NOT NULL DEFAULT '2',
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer__id`, `open`, `payment`, `comments`, `created_at`, `updated_at`) VALUES
(1, 10, 0, 1, 'Nisi dolores officiis laborum modi. Autem occaecati voluptas ut qui. Architecto rerum fugiat error qui recusandae.', '2020-03-24 11:09:05', '2020-03-24 11:09:05'),
(2, 9, 0, 1, 'Sint minima non cum natus amet soluta. Dicta eos quia et et nesciunt atque. Accusamus magni autem sit excepturi officiis totam repellat.', '2020-03-24 11:09:05', '2020-03-24 11:09:05'),
(3, 14, 0, 1, 'Sit soluta fugit sapiente eveniet. Assumenda doloribus ut quaerat adipisci voluptatem ut. Velit unde blanditiis sit dolor deleniti.', '2020-03-24 11:09:05', '2020-03-24 11:09:05'),
(4, 15, 0, 1, 'Voluptatem molestiae non rerum qui. Ut quis mollitia exercitationem blanditiis ipsam.', '2020-03-24 11:09:05', '2020-03-24 11:09:05'),
(5, 2, 0, 2, 'Ut voluptatem dolor sed quisquam et quo consequatur et. Aspernatur a molestiae excepturi libero sit quia voluptatem. Et nulla ea qui quidem autem quae recusandae ut. Recusandae inventore id est ut voluptatem est ex voluptatem.', '2020-03-24 11:09:06', '2020-03-24 11:09:06'),
(6, 19, 0, 2, 'Occaecati a repellat numquam reprehenderit. Deleniti qui quia ipsum aut perspiciatis et a accusamus. Facilis consequatur aut alias dolor sed placeat.', '2020-03-24 11:09:06', '2020-03-24 11:09:06'),
(7, 7, 0, 2, 'Accusamus vel quaerat magni. Adipisci veniam ut voluptatem officiis impedit iure laborum. At ex voluptas a eum sint dolores. Sed non sunt deleniti voluptas ex.', '2020-03-24 11:09:06', '2020-03-24 11:09:06'),
(8, 20, 0, 1, 'Quisquam sint hic laborum blanditiis omnis velit qui. Ut nobis iure sed hic et. Sint itaque architecto aut optio. Molestias perspiciatis nemo facilis. Vel et illum non sunt quas et dolor.', '2020-03-24 11:09:06', '2020-03-24 11:09:06'),
(9, 24, 0, 1, 'Cupiditate natus explicabo reprehenderit ut eius id ex. Quos qui quia impedit nostrum sequi magni eum. Ducimus ipsa corrupti quo quia nostrum asperiores.', '2020-03-24 11:09:06', '2020-03-24 11:09:06'),
(10, 16, 0, 2, 'Dolor ut magni sunt et sint vero. Reiciendis saepe ut nihil quia. Voluptas dolorum harum minus officiis qui. Sed doloribus velit doloribus qui et quibusdam.', '2020-03-24 11:09:06', '2020-03-24 11:09:06'),
(11, 1, 0, 2, 'Dolore voluptatem nihil nesciunt ut commodi quidem laboriosam voluptatibus. Numquam qui voluptas perspiciatis. Eum voluptatem dolorum nobis est. Cumque ut illum et aut voluptatem.', '2020-03-24 11:09:07', '2020-03-24 11:09:07'),
(12, 4, 0, 1, 'Aut architecto est ut excepturi. Qui totam sunt voluptate. Nobis vel fugiat dolore. Consequuntur minima et tenetur inventore consequatur amet eos.', '2020-03-24 11:09:07', '2020-03-24 11:09:07'),
(13, 12, 0, 2, 'Cupiditate laudantium deserunt voluptas alias provident aliquam. Nostrum enim sequi architecto perspiciatis magnam doloribus atque. Consequatur dolor eum corporis et corporis quidem architecto.', '2020-03-24 11:09:07', '2020-03-24 11:09:07'),
(14, 14, 0, 1, 'Aut dolor fugiat ullam earum sed nihil aut. Exercitationem commodi excepturi itaque quia fugiat. Molestias sapiente neque laborum eum ex provident possimus.', '2020-03-24 11:09:07', '2020-03-24 11:09:07'),
(15, 23, 0, 1, 'Eum eos quia laborum. Accusantium in quaerat consequatur fugiat nam. Voluptatem voluptate voluptatem et explicabo temporibus et.', '2020-03-24 11:09:07', '2020-03-24 11:09:07'),
(16, 26, 1, 1, '', '2020-03-24 11:17:38', '2020-03-24 11:17:38'),
(17, 26, 1, 1, 'sdgft', '2020-03-24 11:26:25', '2020-03-24 11:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `pizzas`
--

CREATE TABLE `pizzas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pizzas`
--

INSERT INTO `pizzas` (`id`, `name`, `img_url`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Steak & Blue Cheese ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/11970.png', 'Topped with garlic spread base, steak strips, fresh mushrooms, mozzarella cheese and sprinkled with crumbles of blue cheese ', 12.29, '2020-03-23 20:47:07', '2020-03-23 20:47:07'),
(2, 'Buffalo Chicken ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/buffalo-chicken-pizza.png', 'All the Zing, without the wing - This tangy, spicy pie is made for Game Day. Kick off with Buffalo blue cheese sauce, grilled chicken, red onions, fire-roasted red peppers and mozzarella cheese.', 9.29, '2020-03-23 20:47:07', '2020-03-23 20:47:07'),
(3, 'Chipotle Chicken', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/Chipotle-Chicken.png', 'Smoky, zesty and bold - This Southwest-style flavor-bomb is set off with smoky chipotle sauce, then topped with chipotle chicken, zesty red onions, and melty mozzarella. Me gusta?', 11.99, '2020-03-23 20:47:07', '2020-03-23 20:47:07'),
(4, 'Chicken Bruschetta ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/chickenbruschetta.png', 'A Twist on Italian Taste - What can make bruschetta better? How about grilled chicken? Add roasted garlic, Italiano Blend Seasoning, parmesan and mozzarella, and it\'s molto deliziosa.', 13.29, '2020-03-23 20:47:07', '2020-03-23 20:47:07'),
(5, 'Chipotle Steak ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/Chipotle-Steak.png', 'Smoky chipotle meets sizzling steak - his hearty Southwest-inspired pie combines smoky chipotle sauce, tender steak, zesty red onions, and melty mozzarella.VIVA CHIPOTLE!', 11.69, '2020-03-23 20:47:08', '2020-03-23 20:47:08'),
(6, 'Bacon Double Cheeseburger ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/bacondblchburg.png', 'Cheeseburger. Pizza. Enough Said - Yeah, we did it. Crush two comfort-food classics in one, with ground beef, bacon crumble and four-cheese blend. Try it with Honey Mustard dipping sauce for extra burger bite!', 14.79, '2020-03-23 20:47:08', '2020-03-23 20:47:08'),
(7, 'Classic Super ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/12400.png', 'The Pizza Pizza original - A staple since 1967, this one never goes out of style! A classic combo of pepperoni, fresh mushrooms, green peppers, and mozzarella cheese.', 10.69, '2020-03-23 20:47:08', '2020-03-23 20:47:08'),
(8, 'Sausage Mushroom Melt', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/SausageMelt.png', 'Creamy, dreamy and melty - Meet your dream pizza: rich, tasteful and?savoury. Made with creamy garlic sauce, spicy Italian sausage, fresh mushrooms, Italiano blend seasoning, and ooey-gooey mozzarella cheese. ', 12.19, '2020-03-23 20:47:08', '2020-03-23 20:47:08'),
(9, 'Spicy BBQ Chicken ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/bbqchicken.png', 'Saddle up for a slice - It\'s a showdown at Flavour Corral, with grilled chicken, hot banana peppers, red onions, Texas BBQ sauce and mozzarella cheese. Wanna amp it up even more? Add Frank\'s Red Hot!', 10.69, '2020-03-23 20:47:08', '2020-03-23 20:47:08'),
(10, 'Tropical Hawaiian ', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/12700.png', 'Grab your floral shirt and dip in - Don\'t let anyone tell you it isn\'t amazing. This taste of the tropics brings together sweet pineapple, bacon crumble, bacon strips, and mozzarella cheese for a beach vacation on Flavour Island! ', 13.29, '2020-03-23 20:47:09', '2020-03-23 20:47:09'),
(11, 'Sweet Heat', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/13830.png', 'A fiery bite with a sweet twist - Sometimes opposites attract and make sweet, spicy magic! Trust us, the combo of grilled chicken, pineapple, hot banana peppers and mozzarella cheese is totally amazing.', 13.29, '2020-03-23 20:47:11', '2020-03-23 20:47:11'),
(12, 'Pepperoni', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/Pepperoni.png', 'The all-time favourite - It doesn\'t get any more iconic than this. Savoury pepperoni, homestyle sauce, and ooey-gooey, stretchy mozzarella. Perfection!', 9.19, '2020-03-23 20:47:11', '2020-03-23 20:47:11'),
(13, 'Hot and Spicy', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/SHIS.png', 'Is it getting warm in here? - Some people just love to brave the heat. Well, step-up you spice-monsters. This slice of fire combines spicy Italian sausage, hot banana peppers, and mozzarella cheese.', 10.69, '2020-03-23 20:47:11', '2020-03-23 20:47:11'),
(14, 'Bacon Chicken Mushroom Melt', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/baconchicken.png', 'Voluptates rem error in nihil magnam. Odit sequi est voluptatem doloremque aut. Suscipit dolor cum rem asperiores nesciunt provident nihil. Voluptates sed ut unde veritatis laborum.Topped with grilled chicken, fresh mushrooms, red onions, bacon crumble, Italiano blend seasoning, and made with creamy garlic sauce and mozzarella cheese. Tip: Try customizing to a thick crust.', 14.79, '2020-03-23 20:47:11', '2020-03-23 20:47:11'),
(15, 'Meat Supreme', 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/meat-supreme.png', 'Topped with classic pepperoni, bacon crumble, salami, spicy Italian sausage, mozzarella cheese, and Italiano blend seasoning. For the meat-lover in you.', 13.79, '2020-03-23 20:47:12', '2020-03-23 20:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` double(8,2) NOT NULL DEFAULT '1.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `weight`, `created_at`, `updated_at`) VALUES
(1, '18', 1.00, '2020-03-24 11:00:36', '2020-03-24 11:00:36'),
(2, '19', 1.10, '2020-03-24 11:00:36', '2020-03-24 11:00:36'),
(3, '20', 1.20, '2020-03-24 11:00:36', '2020-03-24 11:00:36'),
(4, '21', 1.30, '2020-03-24 11:00:36', '2020-03-24 11:00:36'),
(5, '22', 1.40, '2020-03-24 11:00:37', '2020-03-24 11:00:37'),
(6, '23', 1.50, '2020-03-24 11:00:37', '2020-03-24 11:00:37'),
(7, '24', 1.60, '2020-03-24 11:00:37', '2020-03-24 11:00:37'),
(8, '30', 2.00, '2020-03-24 11:00:37', '2020-03-24 11:00:37');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_pizzas`
--
ALTER TABLE `ordered_pizzas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordered_pizzas_pizza__id_foreign` (`pizza__id`),
  ADD KEY `ordered_pizzas_order__id_foreign` (`order__id`),
  ADD KEY `ordered_pizzas_pizza__size_id_foreign` (`pizza__size_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer__id_foreign` (`customer__id`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ordered_pizzas`
--
ALTER TABLE `ordered_pizzas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordered_pizzas`
--
ALTER TABLE `ordered_pizzas`
  ADD CONSTRAINT `ordered_pizzas_order__id_foreign` FOREIGN KEY (`order__id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `ordered_pizzas_pizza__id_foreign` FOREIGN KEY (`pizza__id`) REFERENCES `pizzas` (`id`),
  ADD CONSTRAINT `ordered_pizzas_pizza__size_id_foreign` FOREIGN KEY (`pizza__size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer__id_foreign` FOREIGN KEY (`customer__id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
