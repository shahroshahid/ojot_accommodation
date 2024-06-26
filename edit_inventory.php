<?php 
ob_start();
include('header.php'); 


// Check if inventory ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to the inventory page if inventory ID is not provided
    header("Location: inventory.php");
    exit();
}

$post_id = mysqli_real_escape_string($conn, $_GET['id']);

// Retrieve post information from the database
$sql = "SELECT * FROM inventory WHERE id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    // Redirect to the inventory page if the post is not found
    header("Location: inventory.php");
    exit();
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs (you might want to add more validation)
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
	$accommodation_id = $_POST['accommodation'];
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	
	

    // Check if a new image file is uploaded
    if ($_FILES["item_img"]["name"]) {
        // File upload handling
        $targetDir = "upload/";
        $fileName = basename($_FILES["item_img"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if file is a valid image
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["item_img"]["tmp_name"], $targetFilePath)) {
                // Update data in the 'inventory' table
                if (!empty($post['item_img'])) {
                    $prevFilePath = $targetDir . $post['item_img'];
                    if (file_exists($prevFilePath)) {
                        unlink($prevFilePath);
                    }
                }

                $update_sql = "UPDATE inventory SET accommodation_id = '$accommodation_id',  item = '$item',  price = '$price', quantity = '$quantity', `desc` = '$desc', item_img = '$fileName' WHERE id = $post_id";
		

                if ($conn->query($update_sql) === TRUE) {
                    // Redirect to the inventory page after successful update
                    header("Location: inventory.php");
                    exit();
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file format.";
        }
    } else {
        // Update data in the 'inventory' table without changing the image
        $update_sql = "UPDATE inventory SET accommodation_id = '$accommodation_id', item = '$item' , price = '$price' , quantity = '$quantity', `desc` = '$desc' WHERE id = $post_id";

        if ($conn->query($update_sql) === TRUE) {
            // Redirect to the inventory page after successful update
            header("Location: inventory.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
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
                        <h3 class="box-title">Edit Inventory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $post_id); ?>" method="post" enctype="multipart/form-data">
						
						
							<div class="form-group">
								<label for="accommodation">Accommodation:</label>
								<select class="form-control" id="accommodation" name="accommodation" required>
									<option value="">Select Accommodation</option>
									<?php foreach ($accommodations as $accommodation) : ?>
										<?php if ($accommodation['id'] == $post['accommodation_id']) : ?>
											<!-- Set 'selected' attribute for the current accommodation -->
											<option value="<?php echo $accommodation['id']; ?>" selected><?php echo $accommodation['name']; ?></option>
										<?php else : ?>
											<option value="<?php echo $accommodation['id']; ?>"><?php echo $accommodation['name']; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
                            <div class="form-group">
                                <label for="item">Item:</label>
                                <input type="text" class="form-control" id="item" name="item" value="<?php echo $post['item']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" value="<?php echo $post['price']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $post['quantity']; ?>"  required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Description:</label>
                                <textarea class="form-control" name="desc" rows="5" required><?php echo $post['desc']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="desc">Image:</label>
                                <input type="text" class="form-control" id="prev_image" name="prev_image" value="<?php echo $post['item_img']; ?>" readonly>
                                <input type="file" name="item_img" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Inventory</button>
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

<?php include('footer.php'); ?>