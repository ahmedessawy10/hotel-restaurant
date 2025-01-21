<?php
$dbtype = 'mysql';
$host = '127.0.0.1:3307';
$dbname = 'laravel_tasks';
$password = '';
$username = 'root';

try {
    $connection = new PDO("$dbtype:host=$host;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['from']) && isset($_GET['to'])) {
        $from = $_GET['from'];
        $to = $_GET['to'];
        // Validate date format if necessary
        if (!DateTime::createFromFormat('Y-m-d', $from) || !DateTime::createFromFormat('Y-m-d', $to)) {
            die("Invalid date format.");
        }
        $query = "SELECT users.id AS user_id, users.name AS user_name, orders.id AS order_id, orders.total, orders_items.price, orders_items.quantity, products.name AS product_name 
                  FROM users 
                  JOIN orders ON users.id = orders.order_by 
                  JOIN orders_items ON orders.id = orders_items.order_id
                  JOIN products ON products.id = orders_items.product_id
                  WHERE orders.created_at BETWEEN :from AND :to";
        $statement = $connection->prepare($query);
        $statement->bindParam(':from', $from);
        $statement->bindParam(':to', $to);
    } else {
        $query = "SELECT users.id AS user_id, users.name AS user_name, orders.id AS order_id, orders.total, orders_items.price, orders_items.quantity, products.name AS product_name 
                  FROM users 
                  JOIN orders ON users.id = orders.order_by 
                  JOIN orders_items ON orders.id = orders_items.order_id
                  JOIN products ON products.id = orders_items.product_id";
        $statement = $connection->prepare($query);
    }
    
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $users = [];
    foreach ($results as $result) {
        $users[$result['user_id']]['name'] = $result['user_name'];
        $users[$result['user_id']]['orders'][] = $result;
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <form method="GET" action="">
            <div class="row">
                <div class="col d-flex justify-content-between">
                    <label class="my-5 p-3" for="from">From</label>
                    <input id="from" name="from" type="date" class="form-control my-5 mx-3"/>
                </div>
                <div class="col d-flex justify-content-between">
                    <label class="my-5 p-3" for="to">To</label>
                    <input id="to" name="to" type="date" class="form-control my-5 mx-3"/>
                </div>
                <div class="col d-flex align-items-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="accordion" id="accordionExample">
        <?php if (isset($users) && is_array($users)) {
          $query = "SELECT orders_items.price, orders_items.quantity, products.name AS product_name 
                  JOIN orders ON users.id = orders.order_by 
                  JOIN orders_items ON orders.id = orders_items.order_id
                  JOIN products ON products.id = orders_items.product_id where users.id = $users[]";
        $statement = $connection->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user_id => $user) { ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $user_id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $user_id; ?>">
                            <?php echo "User: " . $user['name']; ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $user_id; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <?php 
                            
                            foreach ($user['orders'] as $order) { ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $order['order_id']; ?>">
                                    <?php echo "Order #" . $order['order_id']; ?>
                                </button>

                                <div class="modal fade" id="exampleModal<?php echo $order['order_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $order['order_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel<?php echo $order['order_id']; ?>">Order number <?php echo $order['order_id']; ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-between">
                                                <div class="mx-5 w-75 p-4">
                                                    <p><?php echo $order['product_name']; ?> (<?php echo $order['price']; ?>$)</p>
                                                    <p>Quantity: <?php echo $order['quantity']; ?></p>
                                                </div>
                                                <div>
                                                    <img class="w-75 mx-5 rounded-2" src="./item_1.jpg" alt="Product Image"/>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" aria-expanded="true">
                        No Data Found
                    </button>
                </h2>
            </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>