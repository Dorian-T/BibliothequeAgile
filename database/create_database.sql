-- Database creation
DROP DATABASE IF EXISTS `bibliotheque_agile`;
CREATE DATABASE IF NOT EXISTS `bibliotheque_agile`;
USE `bibliotheque_agile`;


-- Category table
DROP TABLE IF EXISTS Category;
CREATE TABLE Category(
    id INT,
    name VARCHAR(64) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE(name)
);

-- Customer table
DROP TABLE IF EXISTS Customer;
CREATE TABLE Customer(
    id INT,
    first_name VARCHAR(64) NOT NULL,
    last_name VARCHAR(64) NOT NULL,
    birth_date DATE NOT NULL,
    phone INT NOT NULL,
    email VARCHAR(64) NOT NULL,
    password VARCHAR(64) NOT NULL,
    is_admin int NOT NULL,
    PRIMARY KEY(id)
);

-- Book table
DROP TABLE IF EXISTS Book;
CREATE TABLE Book(
    id INT,
    title VARCHAR(64) NOT NULL,
    author VARCHAR(128) NOT NULL,
    edition VARCHAR(64) NOT NULL,
    publishing_year INT NOT NULL,
    genre INT NOT NULL,
    location VARCHAR(64) NOT NULL,
    borrowed_by INT,
    PRIMARY KEY(id),
    FOREIGN KEY(genre) REFERENCES Category(id),
    FOREIGN KEY(borrowed_by) REFERENCES Customer(id)
);