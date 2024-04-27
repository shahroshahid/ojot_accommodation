<?php
include('header.php'); 
include('db_connection.php');

// Start session to access cart items
session_start();

// Variable to store notification message
$notification = "";

// Function to remove item from cart
function removeFromCart($item_id) {
    if (isset($_SESSION['cart'][$item_id])) {
        unset($_SESSION['cart'][$item_id]);
        return true;
    }
    return false;
}

// Check if item ID is provided for removal
if (isset($_GET['remove_item_id'])) {
    $remove_item_id = $_GET['remove_item_id'];
    if (removeFromCart($remove_item_id)) {
        // Set notification message
        $notification = "Item has been removed from the cart.";
    } else {
        // Set notification message if item not found
        $notification = "Item not found in the cart.";
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
                        <h3 class="box-title">Shopping Cart</h3>
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
                                                <!-- Button to remove item from cart -->
                                                <a href="cart.php?remove_item_id=<?php echo $item_id; ?>" class="btn btn-danger">Remove</a>
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
                        <!-- Checkout button -->
                        <a href="checkout.php" class="btn btn-primary">Checkout</a>
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
