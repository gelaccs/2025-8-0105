-- DATABASE NG GELACSO TRAVEL & TOURS
-- I-import ito sa phpMyAdmin (Import tab) o i-paste sa SQL tab

CREATE DATABASE IF NOT EXISTS gelacso_db;
USE gelacso_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login DATETIME NULL,
    last_activity DATETIME NULL
);
