CREATE DATABASE IF NOT EXISTS autorent CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE autorent;

DROP TABLE IF EXISTS reservations;
DROP TABLE IF EXISTS cars;
DROP TABLE IF EXISTS users;

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mark VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    engine VARCHAR(50),
    fuel VARCHAR(50),
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    year INT,
    transmission VARCHAR(50),
    seats INT,
    description TEXT,
    status ENUM('vaba','renditud','hoolduses') DEFAULT 'vaba',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('active','cancelled') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE,
    INDEX idx_reservations_overlap (car_id, status, start_date, end_date)
);
