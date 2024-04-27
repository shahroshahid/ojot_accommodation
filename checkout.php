<?php
include('header.php'); 
include('db_connection.php');

// Start session to access cart items
session_start();

// Variable to store notification message
$notification = "";


// Function to save reservation details
function reserveOrder($conn, $user_id, $reserved_items) {
    // Start a transaction
    $conn->begin_transaction();

    // Insert reservation details into the reservations table
    $stmt_reservations = $conn->prepare("INSERT INTO reservations (user_id, reserved_items) VALUES (?, ?)");
    $stmt_reservations->bind_param("is", $user_id, $reserved_items); // Updated bind_param

    if ($stmt_reservations->execute()) {
        // Get the last inserted reservation ID
        $reservation_id = $conn->insert_id;

        // Commit the transaction
        $conn->commit();

        // Clear the cart
        unset($_SESSION['cart']);

         // Set the success message
         $notification = "Your order has been successfully reserved. Reservation ID: $reservation_id";

         return $notification;

    } else {
        // Roll back the transaction and display an error message
        $conn->rollback();
        return "Failed to reserve the order. Please try again.";
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserve_order'])) {
    // Validate form fields
    $user_id = $_POST['user_id']; // Get the user ID
    // Serialize the cart items
    $reserved_items = serialize($_SESSION['cart']);
    // Call the reserveOrder function to save reservation details
    $notification = reserveOrder($conn, $user_id, $reserved_items);
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['reserve_order'])) {
    // Validate form fields
    $user_id = $_POST['user_id']; // Get the user ID
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $payment_method = $_POST['payment'];

    // Simple validation example (you can add more complex validation as needed)
    if (empty($fullname) || empty($email) || empty($address) || empty($phone) || empty($payment_method)) {
        $notification = "Please fill out all fields.";
    } else {
        // Start a transaction
        $conn->begin_transaction();

        // Save order details to the database (assuming you have a table called 'orders')
        $stmt_orders = $conn->prepare("INSERT INTO orders (user_id, fullname, email, address, phone, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_orders->bind_param("isssss", $user_id, $fullname, $email, $address, $phone, $payment_method);

        if ($stmt_orders->execute()) {
            // Get the last inserted order ID
            $order_id = $conn->insert_id;

            // Iterate through cart items and insert into order_details
            foreach ($_SESSION['cart'] as $item_id => $quantity) {
                // Fetch item details including price and current quantity from the inventory table
                $stmt_inventory = $conn->prepare("SELECT price, quantity FROM inventory WHERE id = ?");
                $stmt_inventory->bind_param("i", $item_id);
                $stmt_inventory->execute();
                $result_inventory = $stmt_inventory->get_result();

                if ($result_inventory->num_rows > 0) {
                    $item = $result_inventory->fetch_assoc();
                    $price = $item['price'];
                    $current_quantity = $item['quantity'];
                    
                    // Calculate new quantity after placing the order
                    $new_quantity = $current_quantity - $quantity;

                    // Update the inventory with the new quantity
                    $stmt_update_inventory = $conn->prepare("UPDATE inventory SET quantity = ? WHERE id = ?");
                    $stmt_update_inventory->bind_param("ii", $new_quantity, $item_id);
                    $stmt_update_inventory->execute();

                    // Insert order details into the order_details table
                    $stmt_order_details = $conn->prepare("INSERT INTO order_details (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)");
                    $stmt_order_details->bind_param("iiid", $order_id, $item_id, $quantity, $price);

                    if (!$stmt_order_details->execute()) {
                        $notification = "Failed to insert order details.";
                        $conn->rollback(); // Roll back the transaction
                        break;
                    }
                } else {
                    $notification = "Item details not found.";
                    $conn->rollback(); // Roll back the transaction
                    break;
                }
            }

            // Clear the cart if all order details are successfully inserted
            if (empty($notification)) {
                unset($_SESSION['cart']);
                $conn->commit(); // Commit the transaction
                $notification = "Your order has been placed successfully!";
            }
        } else {
            $notification = "Failed to place the order. Please try again.";
        }

        // Close the statements
        $stmt_orders->close();
        if (isset($stmt_order_details)) {
            $stmt_order_details->close();
        }
        if (isset($stmt_inventory)) {
            $stmt_inventory->close();
        }
    }
}



?>

<aside class="main-sidebar">
    <section class="sidebar">
        <?php include('sidebar.php'); ?>
    </section>
</aside>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Place Order</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Display notification message -->
                        <?php if (!empty($notification)): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $notification; ?>
                            </div>
                        <?php endif; ?> 
                        <?php     
                        // Check if cart is not empty
                        if (!empty($_SESSION['cart'])) {
                            // Loop through cart items and display details
                            foreach ($_SESSION['cart'] as $item_id => $quantity) {
                                // Fetch item details from the database based on the item ID
                                $stmt = $conn->prepare("SELECT * FROM inventory WHERE id = ?");
                                $stmt->bind_param("i", $item_id);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    $item = $result->fetch_assoc();
                                    // Display item details
                                    ?>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img style="width: 200px; height: 200px;" src="upload/<?php echo $item['item_img']; ?>" alt="<?php echo $item['item']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <h2><?php echo $item['item']; ?></h2>
                                                <p>Price: $<?php echo $item['price']; ?></p>
                                                <p>Quantity: <?php echo $quantity; ?></p>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <?php
                                } else {
                                    echo "Item not found";
                                }
                            }
                        } else {
                            echo "Your cart is empty.";
                        }
                        ?>
                    </div>
                    <!-- /.box-body -->
                    <?php if (!empty($_SESSION['cart'])) { ?>
                    <div class="box-footer">
                        <!-- Back to Cart button -->
                        <a href="cart.php" class="btn btn-default">Back to Cart</a><br><br>
                       

                        <!-- Checkout form -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="fullname">Full Name:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="payment">Payment Method:</label>
                                <select class="form-control" id="payment" name="payment" required>
                                    <option value="card">Credit Card</option>
                                    <option value="cash">Cash on Delivery</option>
                                </select>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <button type="submit" class="btn btn-primary">Place Order</button>
                        </form>

                        <br>
                        <!-- Reserved Order form -->
                       <!-- Reserved Order form -->
                        <form action="" method="post">
                            <!-- Include the reserve_order hidden input -->
                            <input type="hidden" name="reserve_order" value="1">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <button type="submit" class="btn btn-primary">Reserved Order</button>
                        </form>


                    </div>
                    <?php } ?>
                    
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>

<?php include('footer.php'); ?>
