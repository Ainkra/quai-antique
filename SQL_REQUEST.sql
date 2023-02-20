-- Create quai_antique database
CREATE DATABASE IF NOT EXISTS quai_antique;

-- writing All ENGINE=InnoDB is not necessarily necessary,
-- however, it may be useful to do so if I want to ensure
-- that the table is created with the correct options.
-- In general, it is good practice to specify the storage engine and charset when creating the table,
-- to avoid potential problems with unexpected default options.

-- Create customer table
CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, email LONGTEXT NOT NULL, password LONGTEXT NOT NULL, guest_number INT NOT NULL, allergies LONGTEXT NOT NULL COMMENT 'DC2Type:array', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

-- Create Booking table
CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, booking_time TIME NOT NULL, allergies VARCHAR(255) NOT NULL, guest_number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

-- Create Starter, Dish, Desserts, Drink, Aperitif and Cellar tables.

-- Starter table
CREATE TABLE starter (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

-- Cellar table
CREATE TABLE cellar (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

-- Desserts table
CREATE TABLE desserts (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

-- Dish table
CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

-- Drink table
CREATE TABLE drink (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

-- Starter table
CREATE TABLE starter (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

-- Add admin user
-- First in VSCODE type this: php bin/console security:hash-password, and enter your password. Copy your hashed password.
-- Now, type: USE quai_antique
-- And enter your SQL request:
INSERT INTO user (email, password, guest_number, allergies, roles) VALUES ('mon-mail@mon-mail.com', 'hashed_password', 'number_of_guest (max 8)', 'mes_allergies', '["ROLE_ADMIN"]');