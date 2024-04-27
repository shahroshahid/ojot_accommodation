<?php
session_start();

// Check if item ID and quantity are provided
if (isset($_POST['item_id'], $_POST['quantity'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // Add the selected item to the user's cart (you'll need to implement this logic)
    // For example, you can use session variables to store the cart items
    $_SESSION['cart'][$item_id] = $quantity;

    // Redirect the user back to the item details page or any other page
    header("Location: cart.php");
    exit();
} else {
    // Item ID or quantity not provided, display error message or redirect
    echo "Item ID or quantity not provided";
}
?>
