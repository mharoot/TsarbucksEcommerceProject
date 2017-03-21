<?php
/* for customers only */
define('SP_GET_ALL_MENU_ITEMS', 'SELECT * FROM products');
define('SP_GET_LAST_ORDER_ID', 'SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1');
define('SP_INSERT_ORDER', 'INSERT INTO orders (order_id, user_id, product_id, quantity, completed, created_at, updated_at) VALUES(:order_id, :user_id, :product_id, :quantity, 0, now(), now())');
define('SP_GET_ORDERS_OF_CUSTOMER', 'SELECT * FROM orders WHERE user_id=:user_id');
define('SP_GET_ORDERS_OF_CUSTOMER_WITH_PRODUCT_DISPLAY_NAME', 
'SELECT orders.*, products.display_name
FROM orders INNER JOIN products
ON orders.product_id=products.product_id
WHERE user_id = :user_id');
define('SP_GET_ORDERS_OF_CUSTOMER_WITH_PRODUCT_DISPLAY_NAME_AND_PRICE', 
'SELECT orders.*, products.display_name, products.price
FROM orders INNER JOIN products
ON orders.product_id=products.product_id
WHERE user_id = :user_id');

/* for baristas only*/
define('SP_COMPLETE_ORDER', 'UPDATE orders SET completed = 1, updated_at = NOW() WHERE order_id=:order_id  AND product_id=:product_id');
define('SP_GET_ALL_CUSTOMER_ORDERS', 'SELECT * FROM orders');
define('SP_GET_ALL_ORDERS_WITH_PRODUCT_DISPLAY_NAME_AND_PRICE',
'SELECT orders.*, products.display_name, products.price
FROM orders INNER JOIN products
ON orders.product_id=products.product_id');


/* for both baristas and customers only */
define('SP_GET_ROW_BY_USERNAME', 'SELECT * FROM users WHERE username = :username');
/* note: I am using spaces otherwise it won't run*/
define('SP_GET_ROW_WITH_ROLE_BY_USERNAME', 
'SELECT users.*, user_roles.role 
FROM users 
INNER JOIN user_roles 
ON users.user_id=user_roles.user_id 
WHERE username = :username');





/* for admin only*/
define('SP_GET_ALL_USERS_AND_ROLES', 
'SELECT users.*, user_roles.role 
FROM users INNER JOIN user_roles 
ON users.user_id=user_roles.user_id');

define('SP_GET_ALL_ORDERS_AND_DISPLAY_NAME',
'SELECT orders.*, products.display_name
FROM orders INNER JOIN products
ON orders.product_id=products.product_id');

?>