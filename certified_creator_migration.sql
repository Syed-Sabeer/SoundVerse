-- ============================================================
-- SingWithMe Certified Creator Feature - Database Migration
-- ============================================================
-- Run this SQL script directly in phpMyAdmin
-- Safe for existing databases (uses IF NOT EXISTS / IF statements)
-- ============================================================

-- Step 1: Add is_certified_creator column to users table
-- ============================================================
ALTER TABLE `users`
ADD COLUMN `is_certified_creator` TINYINT(1) NOT NULL DEFAULT 0 AFTER `is_artist`;

-- Step 2: Create certified_creator_requests table
-- ============================================================
CREATE TABLE IF NOT EXISTS `certified_creator_requests` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `artist_id` BIGINT UNSIGNED NOT NULL,
  `reason` TEXT NOT NULL,
  `kyc_document_path` VARCHAR(255) NOT NULL,
  `supporting_document_path` VARCHAR(255) NULL,
  `status` ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `admin_notes` TEXT NULL,
  `reviewed_by` BIGINT UNSIGNED NULL,
  `reviewed_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_certified_creator_requests_artist_id` (`artist_id`),
  INDEX `idx_certified_creator_requests_status` (`status`),
  INDEX `idx_certified_creator_requests_artist_status` (`artist_id`, `status`),
  CONSTRAINT `fk_ccr_artist` FOREIGN KEY (`artist_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ccr_reviewer` FOREIGN KEY (`reviewed_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Verification Queries (Run these to verify the schema)
-- ============================================================
-- DESCRIBE users;
-- DESCRIBE certified_creator_requests;
-- SELECT * FROM certified_creator_requests LIMIT 1;

-- ============================================================
-- Rollback Queries (Use these to undo if needed)
-- ============================================================
-- ALTER TABLE users DROP COLUMN is_certified_creator;
-- DROP TABLE IF EXISTS certified_creator_requests;
