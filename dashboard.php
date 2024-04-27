<?php 
include('header.php'); 

// Retrieve post information from the database
$sql = "SELECT * FROM accommodations";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $accommodations = $result->fetch_assoc();
} else {
    // Redirect to the accommodations page if the post is not found
    echo "NO accommodations exists.";
    exit();
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
<section class="content">


        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Accommodations</h3>
                    </div>
                    <div class="box-body">
                        <?php 
                        // Reset pointer to beginning of result set
                        $result->data_seek(0);

                        if ($result->num_rows > 0) {
                            while ($accommodation = $result->fetch_assoc()) { ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="upload/<?php echo $accommodation['image']; ?>" class="card-img-top img-thumbnail" alt="<?php echo $accommodation['name']; ?>" style="width: 200px; height: 200px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $accommodation['name']; ?></h5>
                                            <a href="accommodation_details.php?id=<?php echo $accommodation['id']; ?>" class="btn btn-primary">View Details</a>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="col-md-12">
                                <p>No accommodations available.</p>
                            </div>
                        <?php } ?>
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
