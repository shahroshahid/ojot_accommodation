<?php
include('header.php'); 
// Include necessary files and retrieve item details from the database
include 'db_connection.php';


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
                        <h3 class="box-title"><?php echo $accommodation['name']; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                    <?php   
                    // Check if the item ID is provided in the URL
                    if (isset($_GET['item_id'])) {
                        $item_id = $_GET['item_id'];

                        // Fetch item details from the database based on the item ID
                        // Use prepared statements to prevent SQL injection
                        $stmt = $conn->prepare("SELECT * FROM inventory WHERE id = ?");
                        $stmt->bind_param("i", $item_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // If the item is found, display its details
                        if ($result->num_rows > 0) {
                            $item = $result->fetch_assoc();
                    ?>
                    <!-- HTML code to display item details -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <img style="width: 200px; height: 200px;" src="upload/<?php echo $item['item_img']; ?>" alt="<?php echo $item['item']; ?>">
                            </div>
                            <div class="col-md-6">
                                <h2><?php echo $item['item']; ?></h2>
                                <p>Price: $<?php echo $item['price']; ?></p>
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                                <!-- Form to add item to cart -->
                                <form action="add_to_cart.php" method="post">
                                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="quantity" value="1" min="1" max="<?php echo $item['quantity']; ?>">
                                    <button type="submit">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        } else {
                            // Item not found, display error message or redirect
                            echo "Item not found";
                        }
                    } else {
                        // Item ID not provided in the URL, display error message or redirect
                        echo "Item ID not provided";
                    }
                    ?>




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