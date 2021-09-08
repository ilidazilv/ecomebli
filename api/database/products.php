<?php

require 'Database.php';

$database = new Database();

$products = $database->doRequest('SELECT * FROM products', true);

echo json_encode($products);