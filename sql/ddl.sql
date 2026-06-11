DROP DATABASE IF EXISTS `bouw3d_db`;
CREATE DATABASE `bouw3d_db`;
USE `bouw3d_db`;

CREATE TABLE `companies`(
    `kvk` CHAR(8) PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `roles`
(
    `role_code` VARCHAR(20) PRIMARY KEY,
    `label` VARCHAR(50) NOT NULL
);

CREATE TABLE `order_statuses`
(
    `status_code` VARCHAR(20) PRIMARY KEY,
    `label` VARCHAR(50) NOT NULL
);

CREATE TABLE `materials`
(
    `material_id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `price_per_gram` DECIMAL(10, 2) NOT NULL,
    `description` TEXT,
    `stock_quantity` DECIMAL(10,2) NOT NULL
);

CREATE TABLE `users` 
(
    `user_id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `kvk` CHAR(8) NOT NULL,
    `role_code` VARCHAR(20) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT `fk_users_company`
        FOREIGN KEY (`kvk`) REFERENCES `companies` (`kvk`),

    CONSTRAINT `fk_users_role`
        FOREIGN KEY (`role_code`) REFERENCES `roles` (`role_code`)
        ON UPDATE CASCADE
);

CREATE TABLE `password_reset_tokens`
(
    `token_id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL,
    `token_hash` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `expires_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT `fk_password_reset_tokens_user`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
        ON DELETE CASCADE
);

CREATE TABLE `products`
(
    `product_id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `material_id` INT UNSIGNED,
    `name` VARCHAR(100) NOT NULL,
    `product_type` ENUM('standard', 'custom') NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT `fk_products_material`
        FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`)
);

CREATE TABLE `orders` (
    `order_id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL,
    `status_code` VARCHAR(20) NOT NULL,
    `delivery_method` ENUM('pickup', 'standard', 'express'),
    `delivery_address` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT `fk_orders_user`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),

    CONSTRAINT `fk_orders_order_status`
        FOREIGN KEY (`status_code`) REFERENCES `order_statuses`(`status_code`)
        ON UPDATE CASCADE
);

CREATE TABLE `order_line_items` 
(
    `order_id` INT UNSIGNED,
    `product_id` INT UNSIGNED,
    `quantity` SMALLINT UNSIGNED NOT NULL,
    `unit_price` DECIMAL(10, 2) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`order_id`, `product_id`),

    CONSTRAINT `chk_order_line_items_quantity`
        CHECK (`quantity` > 0),

    CONSTRAINT `chk_order_line_items_unit_price`
        CHECK (`unit_price` > 0),

    CONSTRAINT `fk_order_line_items_order`
        FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
        ON DELETE CASCADE,

    CONSTRAINT `fk_order_line_items_product`
        FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
);

CREATE TABLE `custom_products`
(
    `product_id` INT UNSIGNED PRIMARY KEY,
    `file_path` VARCHAR(255) NOT NULL,
    `weight_grams` DECIMAL(8, 2) NOT NULL,
    `color` VARCHAR(50) NOT NULL,
    `notes` TEXT,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT `chk_custom_products_weight_grams`
        CHECK (`weight_grams` > 0),

    CONSTRAINT `fk_custom_products_product`
        FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)
        ON DELETE CASCADE
);

CREATE TABLE `catalog_products`
(
    `product_id` INT UNSIGNED PRIMARY KEY,
    `sku` VARCHAR(20) NOT NULL UNIQUE,
    `stock_quantity` SMALLINT UNSIGNED NOT NULL,  ---trigger here when order gets made. after orderlineitem insert with same id
    `description` TEXT,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT `fk_catalog_products_product`
        FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)
        ON DELETE CASCADE
);

-- VIEW voor data_analyst
CREATE VIEW `view_users` AS
SELECT `user_id`, `kvk`, `role_code`, `created_at`
FROM `users`;

DELIMITER $$

CREATE TRIGGER trg_after_orderline_insert
AFTER INSERT ON order_line_items
FOR EACH ROW
BEGIN
    -- Reduce stock when a new order line is inserted
    UPDATE catalog_products
    SET stock_quantity = stock_quantity - NEW.quantity
    WHERE product_id = NEW.product_id;
END$$

DELIMITER ;

-- altered table in order to complete products page and replace placeholder img with actual img
ALTER TABLE `catalog_products` ADD `img_url` VARCHAR(255);

-- added table for fr008
-- failed_search_logs tabel aanmaken
-- kolom: log_id: INT
-- kolom: search_string: VARCHAR255
-- kolom: TIMESTAMP: TIMESTAMP
CREATE TABLE `failed_search_logs`
(
    `log_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `search_string` VARCHAR(255) NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

);
