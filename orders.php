<?php
include('header.php');
include('db_connection.php');



// Function to get item name from inventory based on item ID
function getItemName($conn, $item_id) {
    // Prepare and execute a query to fetch the item name
    $stmt = $conn->prepare("SELECT item FROM inventory WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query executed successfully and if the item exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['item']; // Return the item name
    } else {
        return "Item not found"; // Return a default message if item not found
    }
}



// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "student"){

    // Fetch orders for the logged-in user from the database
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT o.*, od.item_id, od.quantity FROM orders o JOIN order_details od ON o.id = od.order_id WHERE o.user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

} else {

    $stmt = $conn->prepare("SELECT o.*, od.item_id, od.quantity FROM orders o JOIN order_details od ON o.id = od.order_id ");
    $stmt->execute();
    $result = $stmt->get_result();


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
                        <h3 class="box-title">Orders</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php if ($result->num_rows > 0): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Payment Method</th>
                                        <th>Item ID</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['fullname']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td><?php echo $row['payment_method']; ?></td>
                                            <td>
                                                <?php 
                                                    $item_name = getItemName($conn, $row['item_id']); 
                                                    echo $item_name; 
                                                ?>
                                            </td>
                                            <td><?php echo $row['quantity']; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                        <?php else: ?>
                            <p>No orders found.</p>
                        <?php endif; ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>

<?php include('footer.php'); ?>
