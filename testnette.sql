-- Adminer 4.8.1 MySQL 8.0.32 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_52EA1F094584665A` (`product_id`),
  KEY `IDX_52EA1F098D9F6D38` (`order_id`),
  CONSTRAINT `FK_52EA1F094584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_52EA1F098D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `order_item` (`id`, `product_id`, `order_id`, `price`) VALUES
(1,	1,	13,	1200.00),
(2,	2,	13,	12.00),
(3,	3,	13,	333.00),
(4,	1,	14,	1200.00),
(5,	2,	14,	12.00),
(6,	3,	14,	333.00),
(7,	1,	15,	1200.00),
(8,	2,	15,	12.00),
(9,	3,	15,	333.00),
(10,	1,	17,	1200.00),
(11,	2,	17,	12.00),
(12,	3,	17,	333.00),
(13,	1,	18,	1200.00),
(14,	2,	18,	12.00),
(15,	3,	18,	333.00),
(16,	1,	19,	1200.00),
(17,	2,	19,	12.00),
(18,	3,	19,	333.00),
(19,	1,	20,	1200.00),
(20,	2,	20,	12.00),
(21,	3,	20,	333.00),
(22,	1,	21,	1200.00),
(23,	2,	21,	12.00),
(24,	1,	22,	1200.00),
(25,	2,	22,	12.00),
(26,	1,	23,	1200.00),
(27,	2,	23,	12.00),
(28,	4,	23,	33333.00),
(29,	1,	24,	1200.00),
(30,	2,	24,	12.00),
(31,	4,	24,	33333.00),
(32,	3,	24,	333.00);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `orders` (`id`, `price`, `email`, `name`, `surname`, `phone`) VALUES
(12,	111.00,	'yyyy',	'yyyy',	'yyyy',	'yyyy'),
(13,	333.00,	'mavlasak@email.czfefef',	'Martin',	'Vlasák',	'608960495'),
(14,	333.00,	'mavlasak@email.czvfdvdfv',	'Martin',	'Vlasák',	'608960495'),
(15,	333.00,	'mavlasak7888@email.czfefef',	'Martin',	'Vlasák',	'fef'),
(17,	333.00,	'mavlasak@email.czgrgreg',	'Martin',	'Vlasák',	'608960495'),
(18,	333.00,	'mavlasak@email.cz',	'Martin',	'Vlasákfefefef',	'608960495'),
(19,	333.00,	'mavlasak@email.czvrvrvr',	'Martin',	'Vlasák',	'608960495'),
(20,	5157.00,	'mavlasak@email.czfewfe',	'Martin',	'Vlasák',	'608960495'),
(21,	4824.00,	'mavlasak@email.czfewfewewf',	'Martin',	'Vlasák',	'608960495'),
(22,	3624.00,	'mavlasak@email.czfrfrfr',	'Martin',	'Vlasák',	'608960495'),
(23,	36957.00,	'mavlasak@email.czfewfwefewf',	'Martin',	'Vlasák',	'608960495'),
(24,	38502.00,	'mavlasak@email.cz',	'Martin',	'Vlasák',	'608960495');

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `product` (`id`, `name`, `price`) VALUES
(1,	'product1',	1200.00),
(2,	'Raketa',	12.00),
(3,	'koloběžka',	333.00),
(4,	'Letadlo',	33333.00),
(5,	'Auto',	3333.00),
(6,	'666',	6.00);

DROP TABLE IF EXISTS `product_tag`;
CREATE TABLE `product_tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E3A6E39CBAD26311` (`tag_id`),
  KEY `IDX_E3A6E39C4584665A` (`product_id`),
  CONSTRAINT `FK_E3A6E39C4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_E3A6E39CBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `product_tag` (`id`, `tag_id`, `product_id`) VALUES
(1,	1,	2),
(2,	1,	3),
(3,	3,	1),
(4,	4,	1);

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `tag` (`id`, `name`) VALUES
(1,	'Tag1'),
(2,	'Tag2'),
(3,	'Tag3'),
(4,	'Tag4'),
(5,	'Tag5');

INSERT INTO `trademark` (`id`, `name`, `product_id`) VALUES
(1,	'Carraa1111111',	1),
(2,	'Keller',	NULL),
(3,	'Nike',	NULL),
(4,	'Harrows',	NULL),
(6,	'002Značka1111414',	NULL),
(7,	'Značka008',	NULL),
(8,	'Značka14',	NULL),
(9,	'Sportisimo',	NULL),
(10,	'008Značka',	NULL),
(11,	'Značka19',	NULL),
(12,	'Sportisimo002',	NULL),
(14,	'Sportisimo00777',	NULL),
(15,	'Nike002',	NULL),
(16,	'Nike14',	NULL),
(17,	'Nike15',	NULL),
(18,	'Značka4444',	NULL),
(19,	'005Značka12123',	NULL),
(21,	'4444',	NULL),
(25,	'4141414',	NULL),
(26,	'111',	NULL),
(27,	'111',	NULL),
(28,	'1515',	NULL),
(30,	'15151',	NULL),
(31,	'15156165165',	NULL),
(32,	'Nike1236',	NULL),
(33,	'NIkedefef',	NULL),
(34,	'NIkedefefršršr',	NULL),
(36,	'444444444',	NULL);

-- 2023-07-21 14:05:23
