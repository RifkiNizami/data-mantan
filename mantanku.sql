-- =========================================================
-- Database: mantanku
-- Tables  : makanan_favorit, mantan_terindah
-- =========================================================

CREATE DATABASE IF NOT EXISTS `mantanku`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `mantanku`;

-- ---------------------------------------------------------
-- Table: makanan_favorit
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `makanan_favorit`;

CREATE TABLE `makanan_favorit` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_makanan` VARCHAR(255) NOT NULL,
  `deskripsi` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3 Makanan Favorit default
INSERT INTO `makanan_favorit` (`nama_makanan`, `deskripsi`, `created_at`, `updated_at`) VALUES
('Nasi Goreng Spesial', 'Nasi goreng lezat dengan telur dan ayam suwir', NOW(), NOW()),
('Mie Ayam Bakso', 'Mie ayam gurih dengan kuah kaldu dan bakso sapi', NOW(), NOW()),
('Sate Ayam Madura', 'Sate ayam empuk bumbu kacang khas Madura', NOW(), NOW());

-- ---------------------------------------------------------
-- Table: mantan_terindah
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `mantan_terindah`;

CREATE TABLE `mantan_terindah` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(255) NOT NULL,
  `no_hp` VARCHAR(20) NOT NULL,
  `alamat` TEXT NULL,
  `makanan_favorit` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample data mantan terindah
INSERT INTO `mantan_terindah` (`nama`, `no_hp`, `alamat`, `makanan_favorit`, `created_at`, `updated_at`) VALUES
('Siti Aminah', '081234567890', 'Jl. Merdeka No. 1, Jember', 'Nasi Goreng Spesial', NOW(), NOW()),
('Rina Wulandari', '081298765432', 'Jl. Sudirman No. 12, Jember', 'Mie Ayam Bakso', NOW(), NOW()),
('Dewi Lestari', '082112345678', 'Jl. Gajah Mada No. 5, Jember', 'Sate Ayam Madura', NOW(), NOW());
