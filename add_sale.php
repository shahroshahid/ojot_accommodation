<?php include('header.php'); ?>

<?php
// Initialize error message variable
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs (you might want to add more validation)
    $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $quantity_sold = mysqli_real_escape_string($conn, $_POST['quantity_sold']);

    // Check if the user is logged in
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];

        // Check if requested quantity is greater than available quantity
        $check_quantity_sql = "SELECT quantity FROM inventory WHERE id = $item_id";
        $result_quantity = $conn->query($check_quantity_sql);

        if ($result_quantity->num_rows > 0) {
            $row = $result_quantity->fetch_assoc();
            $available_quantity = $row['quantity'];

            if ($quantity_sold > $available_quantity) {
                // Set error message
                $error_message = "Error: Requested quantity exceeds available quantity.";
            } else {
                // Insert data into the 'sales' table with the associated user_id
                $sql = "INSERT INTO sales (item_id, quantity_sold, user_id, transaction_date) VALUES ('$item_id', '$quantity_sold', '$user_id', NOW())";

                if ($conn->query($sql) === TRUE) {
                    // Deduct the quantity sold from the inventory
                    $update_inventory_sql = "UPDATE inventory SET quantity = quantity - $quantity_sold WHERE id = $item_id";
                    if ($conn->query($update_inventory_sql) === FALSE) {
                        $error_message = "Error updating inventory: " . $conn->error;
                    } else {

                        // Redirect to the sales page after successful insertion
                        //header("Location: sales.php");
                        //exit();

                        $success_message = "Added successfully";
                    }
                } else {
                    $error_message = "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            $error_message = "Error: Inventory item not found.";
        }
    } else {
        // Handle the case where the user is not logged in
        $error_message = "User not logged in.";
    }
}


$sql = "SELECT * FROM accommodations";
$result = $conn->query($sql);

// Initialize an empty array to store accommodations
$accommodations = array();

// Check if any accommodations were found
if ($result->num_rows > 0) {
    // Fetch data and store in array
    while($row = $result->fetch_assoc()) {
        $accommodations[] = $row;
    }
} else {
    // If no accommodations found, you can handle it accordingly
    echo "No accommodations found.";
}

// Fetch items from the inventory table to populate the dropdown
$sql_items = "SELECT id, item FROM inventory WHERE quantity > 0";
$result_items = $conn->query($sql_items);
$items = [];
if ($result_items->num_rows > 0) {
    while ($row = $result_items->fetch_assoc()) {
        $items[$row['id']] = $row['item'];
    }
} else {
    $error_message = "No items available.";
}


// Close the database connection
$conn->close();
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
                        <h3 class="box-title">Add New Sale</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
						<?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
								<label for="accommodation">Accommodation:</label>
								<select class="form-control" id="accommodation" name="accommodation" required>
									<option value="">Select Accommodation</option>
									<?php foreach ($accommodations as $accommodation) : ?>
										<option value="<?php echo $accommodation['id']; ?>"><?php echo $accommodation['name']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
                            <div class="form-group">
                                <label for="item_id">Item:</label>
                                <select class="form-control" id="item_id" name="item_id" required>
                                    <option value="">Select Item</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity_sold">Quantity:</label>
                                <input type="number" class="form-control" id="quantity_sold" name="quantity_sold" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Insert Sale</button>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#accommodation').change(function() {
            var accommodationId = $(this).val();
            $.ajax({
                url: 'fetch_items.php',
                type: 'GET',
                data: { accommodation_id: accommodationId },
                dataType: 'json',
                success: function(data) {
                    $('#item_id').empty();
                    $('#item_id').append('<option value="">Select Item</option>');
                    $.each(data, function(index, item) {
                        $('#item_id').append('<option value="' + item.id + '">' + item.item + ' - Price: ' + item.price  +  '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching items:', error);
                }
            });
        });
    });
</script>

<?php include('footer.php'); ?>
