-- Create the database
CREATE DATABASE IF NOT EXISTS user_system;
USE user_system;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    gender VARCHAR(10) DEFAULT NULL,
    hobbies TEXT DEFAULT NULL,
    country VARCHAR(50) DEFAULT NULL
);
