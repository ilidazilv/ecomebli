<?php


require 'Database.php';

$database = new Database();

$database->doRequestWithNoAnswer('CREATE DATABASE IF NOT EXISTS ecomebli', false);
$database->doRequestWithNoAnswer('
                                        CREATE TABLE IF NOT EXISTS products (
                                            product_id int NOT NULL AUTO_INCREMENT,
                                            name varchar(255) NOT NULL,
                                            price float,
                                            currency varchar(255),
                                            types varchar(255),
                                            PRIMARY KEY (product_id)
                                        )
                                        ', true);

