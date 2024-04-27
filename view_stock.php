<?php
// Include header file
include('header.php');

// Fetch inventory data from the database
$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);


?>
<aside class="main-sidebar">
    <section class="sidebar">
        <?php include('sidebar.php'); ?>
    </section>
</aside>
<?php

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    ?>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
					
                        <div class="box-header">
                            <h3 class="box-title">Real-Time Inventory Stock</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            
							<div class="row">
								<?php
								while ($row = $result->fetch_assoc()) {
								?>
									<div class="col-md-4 mb-4">
										<div class="card">
											<img src="upload/<?php echo $row['item_img']; ?>" class="card-img-top" alt="<?php echo $row['item']; ?>" style="max-height: 200px;">
											<div class="card-body">
												<h5 class="card-title"><?php echo $row['item']; ?></h5>
												<p class="card-text">Quantity: <?php echo $row['quantity']; ?></p>
											</div>
										</div>
									</div>
								<?php
								}
								?>
							</div>
                                
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <?php
} else {
    // If no inventory data found
    echo "No inventory data available.";
}

// Close database connection
$conn->close();

// Include footer file
include('footer.php');
?>
