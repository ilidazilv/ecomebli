<?php


require 'Database.php';

$database = new Database();

$database->doRequestWithNoAnswer('CREATE DATABASE IF NOT EXISTS ecomebli', false);
$database->doRequestWithNoAnswer('
                                        CREATE TABLE IF NOT EXISTS products (
                                            product_id int NOT NULL AUTO_INCREMENT,
                                            name varchar(255) NOT NULL,
                                            image_src varchar(255) NOT NULL,
                                            PRIMARY KEY (product_id)
                                        )
                                        ', true);
$database->doRequestWithNoAnswer('
                                        CREATE TABLE IF NOT EXISTS types (
                                            type_id int NOT NULL AUTO_INCREMENT,
                                            name varchar(255) NOT NULL,
                                            price float,
                                            currency varchar(255),
                                            product_id int NOT NULL,
                                            PRIMARY KEY (type_id),
                                            FOREIGN KEY (product_id) REFERENCES products(product_id)
                                        )
                                        ', true);

