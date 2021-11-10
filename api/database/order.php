<?php
require 'Database.php';

$database = new Database();

$json = file_get_contents('php://input');
$obj = json_decode($json, TRUE);

switch ($obj['type']){
    case 'save': {
        $customer = $database->doRequestWithVar('
            SELECT customer_id FROM customers WHERE tel = :tel;
        ', ['tel' => $obj['tel']], false, false);
        if($customer && $customer[0]){
            $customer_id = $customer[0]['customer_id'];
        } else {
            $customer_id = $database->doRequestWithVar('
                INSERT INTO customers(name, tel) VALUES(:name, :tel);
            ', ['tel' => $obj['tel'], 'name' => $obj['name']], false, true);
        }
        $order_id = $database->doRequestWithVar('
                INSERT INTO orders(customer_id) VALUES (:id);
                SELECT LAST_INSERT_ID();
            ', ['id' => $customer_id], false, true);
        $database->doRequestWithVar('
            INSERT INTO order_items(order_id, product_id, quantity) VALUES (:order, :product, 1);
        ', ['order' => $order_id, 'product' => (int)$obj['product']], true, false);
        echo json_encode(['status' => 'success', 'data' => $order_id]);
        break;
    }
    case 'get': {
        $orders = $database->doRequest('
            SELECT customers.tel as tel, 
                   orders.order_id as order_id,
                   orders.date as date,
                   customers.email as email,
                   customers.name as name,
                   products.name as order_item_name
            FROM orders 
                JOIN order_items using(order_id) 
                JOIN customers using(customer_id) 
                JOIN products using(product_id)
                ', true, true);
        echo json_encode(['status' => 'success', 'data' => $orders]);
        break;
    }
}
