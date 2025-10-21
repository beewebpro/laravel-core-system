/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50739
 Source Host           : localhost:3306
 Source Schema         : laravel-core-system

 Target Server Type    : MySQL
 Target Server Version : 50739
 File Encoding         : 65001

 Date: 21/10/2025 08:55:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activations
-- ----------------------------
DROP TABLE IF EXISTS `activations`;
CREATE TABLE `activations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `activations_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activations
-- ----------------------------
INSERT INTO `activations` VALUES (1, 1, 'adasd', 1, '2024-12-19 17:26:07', '2024-12-19 17:26:10', '2024-12-19 17:26:12');
INSERT INTO `activations` VALUES (2, 2, 'p3eANYcJmbTiiQybbROuAuXRovviJUzH', 1, '2025-01-15 03:18:36', '2025-01-15 03:18:36', '2025-01-15 03:18:36');
INSERT INTO `activations` VALUES (3, 3, 'XhZoyRPKQOmtJjdGEJFUGfK7HRXJHijs', 1, '2025-01-15 03:19:46', '2025-01-15 03:19:46', '2025-01-15 03:19:46');
INSERT INTO `activations` VALUES (4, 4, 'vQd0Us6QuvZmUcrx6jJA4K8sQgkKeZ42', 1, '2025-01-15 03:21:45', '2025-01-15 03:21:45', '2025-01-15 03:21:45');
INSERT INTO `activations` VALUES (5, 5, 'qIHb5yMcSkZhBntJQfgEgRXRtUxWoAyr', 1, '2025-01-15 03:28:46', '2025-01-15 03:28:46', '2025-01-15 03:28:46');
INSERT INTO `activations` VALUES (6, 6, 'SiRr37GrSYzcmpIFIem2ORo2oRWhJemR', 1, '2025-01-15 09:42:22', '2025-01-15 09:42:22', '2025-01-15 09:42:22');
INSERT INTO `activations` VALUES (7, 7, 'XLMzmiV5BkkwEGQqC0KjPAyzXvqctvUU', 1, '2025-01-16 04:27:33', '2025-01-16 04:27:33', '2025-01-16 04:27:33');
INSERT INTO `activations` VALUES (8, 8, 'UfgGOI2kzNuMjou43IyhYBq7o4DVRY4i', 1, '2025-01-16 04:29:12', '2025-01-16 04:29:12', '2025-01-16 04:29:12');
INSERT INTO `activations` VALUES (9, 9, 'Wc1MMDLjrc5t7HCc54ajU2K3No8cIqVO', 1, '2025-01-16 04:29:42', '2025-01-16 04:29:42', '2025-01-16 04:29:42');
INSERT INTO `activations` VALUES (10, 10, 'x1WytlOqWZCWqZNfIhml3zOS6sFP0J3x', 1, '2025-01-16 04:55:54', '2025-01-16 04:55:54', '2025-01-16 04:55:54');
INSERT INTO `activations` VALUES (11, 11, '2YPzmjIoCWBE1FDfIidI8cDtye6kuVnv', 1, '2025-01-16 04:56:41', '2025-01-16 04:56:41', '2025-01-16 04:56:41');
INSERT INTO `activations` VALUES (12, 12, 'ZSSfehGbN3Dxutzb0G13PdHvy1TYBcpf', 1, '2025-01-16 04:57:54', '2025-01-16 04:57:54', '2025-01-16 04:57:54');
INSERT INTO `activations` VALUES (13, 13, 'HQfULWdvYzJ5yylrdqpz3riAiNxdeyDf', 1, '2025-01-16 04:58:56', '2025-01-16 04:58:56', '2025-01-16 04:58:56');
INSERT INTO `activations` VALUES (14, 14, 'UrvPNL4CkqNMyS2xKtCPTv4JuSrcwOGY', 1, '2025-01-16 05:00:45', '2025-01-16 05:00:45', '2025-01-16 05:00:45');
INSERT INTO `activations` VALUES (15, 15, 'vyTdRnXiwmmbvOYg3ylBznwYUBsZyGjO', 1, '2025-01-16 05:01:36', '2025-01-16 05:01:36', '2025-01-16 05:01:36');
INSERT INTO `activations` VALUES (16, 16, 'e8LvOUuUW0ZEvrCFChxITkRj8xOo6jKC', 1, '2025-01-16 05:02:40', '2025-01-16 05:02:40', '2025-01-16 05:02:40');
INSERT INTO `activations` VALUES (17, 17, 'VZ5xFVEFrzhKSRCy4JIfhBKoQiORH958', 1, '2025-01-16 06:28:56', '2025-01-16 06:28:56', '2025-01-16 06:28:56');
INSERT INTO `activations` VALUES (18, 18, 'jEYlgroQmeoNztsFRXdP4CFnA83mJla2', 1, '2025-01-16 06:29:49', '2025-01-16 06:29:49', '2025-01-16 06:29:49');
INSERT INTO `activations` VALUES (19, 19, 'BYCEOQBaWbbHInlldLDOXQs3CI42wCo2', 1, '2025-01-16 06:53:35', '2025-01-16 06:53:35', '2025-01-16 06:53:35');
INSERT INTO `activations` VALUES (20, 20, 'fRDq7zb6Y03dZ7kNHOljIdv1zWPL0iid', 1, '2025-01-16 06:58:09', '2025-01-16 06:58:09', '2025-01-16 06:58:09');
INSERT INTO `activations` VALUES (21, 21, 'Wip5DVjH1yEeKiQ8LnZ7G78WL9vc1qVH', 1, '2025-01-16 07:00:36', '2025-01-16 07:00:36', '2025-01-16 07:00:36');
INSERT INTO `activations` VALUES (22, 22, 'cnJuEG80xCrDc8iWJbyIGTWtl4ppcMI8', 1, '2025-01-16 07:02:38', '2025-01-16 07:02:38', '2025-01-16 07:02:38');
INSERT INTO `activations` VALUES (23, 23, 'Qojy0DT52nBRExsXLevF7GPuVl3e76Vv', 1, '2025-01-16 07:04:32', '2025-01-16 07:04:32', '2025-01-16 07:04:32');
INSERT INTO `activations` VALUES (24, 24, 'sbQPb25FtuXUavHWir8FjFAFRjlboybK', 1, '2025-01-16 07:08:16', '2025-01-16 07:08:16', '2025-01-16 07:08:16');
INSERT INTO `activations` VALUES (25, 25, 'Jo9V9MMMMPpxMe1gOyt8qOcOShdzhx29', 1, '2025-01-16 07:09:04', '2025-01-16 07:09:04', '2025-01-16 07:09:04');
INSERT INTO `activations` VALUES (26, 26, 'wo3Q70OR0NAlLzTepnji5ue9lIIfMf2I', 1, '2025-01-16 07:09:47', '2025-01-16 07:09:47', '2025-01-16 07:09:47');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for media_files
-- ----------------------------
DROP TABLE IF EXISTS `media_files`;
CREATE TABLE `media_files`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `folder_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `mime_type` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `media_files_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of media_files
-- ----------------------------

-- ----------------------------
-- Table structure for media_folders
-- ----------------------------
DROP TABLE IF EXISTS `media_folders`;
CREATE TABLE `media_folders`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `media_folders_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of media_folders
-- ----------------------------

-- ----------------------------
-- Table structure for media_settings
-- ----------------------------
DROP TABLE IF EXISTS `media_settings`;
CREATE TABLE `media_settings`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `media_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of media_settings
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (14, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (15, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (16, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (17, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (18, '2024_12_19_075535_create_acp_table', 1);
INSERT INTO `migrations` VALUES (19, '2014_10_12_100000_create_password_reset_tokens_table', 2);
INSERT INTO `migrations` VALUES (20, '2025_01_18_044712_create_media_tables', 2);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for role_users
-- ----------------------------
DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_users_user_id_index`(`user_id`) USING BTREE,
  INDEX `role_users_role_id_index`(`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_users
-- ----------------------------
INSERT INTO `role_users` VALUES (1, 1, 1, NULL, NULL);
INSERT INTO `role_users` VALUES (2, 3, 1, NULL, NULL);
INSERT INTO `role_users` VALUES (3, 4, 1, NULL, NULL);
INSERT INTO `role_users` VALUES (4, 5, 1, NULL, NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `description` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_slug_unique`(`slug`) USING BTREE,
  INDEX `roles_created_by_index`(`created_by`) USING BTREE,
  INDEX `roles_updated_by_index`(`updated_by`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'admin', 'admin', NULL, NULL, 0, 1, 1, '2025-01-14 17:23:28', '2025-01-14 17:23:30');

-- ----------------------------
-- Table structure for user_meta
-- ----------------------------
DROP TABLE IF EXISTS `user_meta`;
CREATE TABLE `user_meta`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_meta_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_meta
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `username` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT 0,
  `manage_supers` tinyint(1) NOT NULL DEFAULT 0,
  `permissions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', 'admin@gmail.com', NULL, NULL, 'admin', '$2y$12$EXzcOMrhaCcRai3Mnt.nXub7BSy.02386j0GGiuggTHCCGRPaefbi', NULL, 1, 1, NULL, NULL, '2024-12-19 17:25:10', '2024-12-19 17:25:14');
INSERT INTO `users` VALUES (2, 'User', 'user@gmail.com', NULL, NULL, 'user', '$2y$10$/iFNptLtSzVmB3HpEfZLeeOC52qwrMbkVtOfu2sKI0mqkhdApFSsS', NULL, 0, 0, NULL, NULL, '2025-01-17 02:39:05', '2025-01-17 03:59:02');

SET FOREIGN_KEY_CHECKS = 1;
