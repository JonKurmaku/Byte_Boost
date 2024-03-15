CREATE DATABASE IF NOT EXISTS byteboost_db;

USE byteboost_db;

CREATE TABLE IF NOT EXISTS students (
    std_id INT AUTO_INCREMENT PRIMARY KEY,
    std_username VARCHAR(255) NOT NULL,
    std_email VARCHAR(255) NOT NULL,
    std_password VARCHAR(255) NOT NULL,
    std_firstname VARCHAR(255) NOT NULL,
    std_lastname VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS lecturer (
    l_id INT AUTO_INCREMENT PRIMARY KEY,
    l_username VARCHAR(255) NOT NULL,
    l_email VARCHAR(255) NOT NULL,
    l_password VARCHAR(255) NOT NULL,
    l_firstname VARCHAR(255) NOT NULL,
    l_lastname VARCHAR(255) NOT NULL,
    l_qualification VARCHAR(255),
    l_specialization VARCHAR(255),
    l_experience INT
);
