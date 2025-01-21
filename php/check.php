<?php
$dbtype='mysql';
$host='127.0.0.1:3307';
$dbname='laravel_tasks';
$password='';
$username='root';
 

$connection = new PDO("$dbtype:host=$host; dbname=$dbname",$username,$password);
var_dump($connection); 
$query="SELECT users.name, orders.total,orders_items.price,quantity ,products.name 
          FROM users 
          JOIN orders ON users.id = orders.order_by 
          JOIN orders_items ON orders.id = orders_items.order_id
          join products ON products.id = orders_items.id
          WHERE orders_items.product_id = product_id";
          // WHERE orders.created_at BETWEEN :from AND :to"
$statment=$connection->prepare($query);

$statment->execute();

$results=$statment->fetchAll(PDO::FETCH_ASSOC);

print_r($results);
?>



  














 