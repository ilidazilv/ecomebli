<?php

require 'Database.php';

$database = new Database();

$products = $database->doRequest('
                                        SELECT 
                                               products.name as product_name,
                                               products.product_id,
                                               products.locale_unit,
                                               products.locale_quantity,
                                               products.calculation_type,
                                               products.locale_calculation_unit,
                                               products.proportion,
                                               types.name as type_name,
                                               types.price,
                                               types.currency,
                                               products.image_src
                                        FROM products JOIN types using(product_id)', true, true);

echo json_encode($products);
