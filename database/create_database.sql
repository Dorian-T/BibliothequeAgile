-- Database creation
DROP DATABASE IF EXISTS `bibliotheque_agile`;
CREATE DATABASE IF NOT EXISTS `bibliotheque_agile`;
USE `bibliotheque_agile`;

-- Category table
CREATE TABLE Category(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE(name)
);

-- Customer table
CREATE TABLE Customer(
    id INT NOT NULL AUTO_INCREMENT,
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
CREATE TABLE Book(
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    author VARCHAR(128) NOT NULL,
    edition VARCHAR(64) NOT NULL,
    publication_year INT NOT NULL,
    genre INT NOT NULL,
    location VARCHAR(64) NOT NULL,
    borrowed_by INT,
    PRIMARY KEY(id),
    FOREIGN KEY(genre) REFERENCES Category(id),
    FOREIGN KEY(borrowed_by) REFERENCES Customer(id)
);

-- Borrowing table
CREATE TABLE Borrowing(
    book_id INT NOT NULL,
    customer_id INT NOT NULL,
    PRIMARY KEY(book_id, customer_id),
    FOREIGN KEY(book_id) REFERENCES Book(id),
    FOREIGN KEY(customer_id) REFERENCES Customer(id),
    UNIQUE(book_id)
);

-- Reservation table
CREATE TABLE Reservation(
    book_id INT NOT NULL,
    customer_id INT NOT NULL,
    PRIMARY KEY(book_id, customer_id),
    FOREIGN KEY(book_id) REFERENCES Book(id),
    FOREIGN KEY(customer_id) REFERENCES Customer(id),
    UNIQUE(book_id)
);