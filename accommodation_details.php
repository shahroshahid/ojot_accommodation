<?php 
include('header.php'); 

// Check if accommodation ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to the accommodations page if accommodation ID is not provided
    header("Location: accommodations.php");
    exit();
}

$accommodation_id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT * FROM accommodations WHERE id = $accommodation_id";
$result_accommodations = $conn->query($sql);

if ($result_accommodations->num_rows > 0) {
    $accommodation = $result_accommodations->fetch_assoc();
} else {
    // Redirect to the accommodations page if the accommodation is not found
    header("Location: accommodations.php");
    exit();
}

// Retrieve inventory data
$sql_inventory = "SELECT id, item, item_img, quantity FROM inventory WHERE accommodation_id = $accommodation_id";
$result_inventory = $conn->query($sql_inventory);

// Prepare data for the chart
$labels = [];
$data = [];

while ($row = $result_inventory->fetch_assoc()) {
    $labels[] = $row['item'];
    $data[] = $row['quantity'];
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
                        <h3 class="box-title"><?php echo $accommodation['name']; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <!-- STUDENT -->
                        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "student"){ ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="upload/<?php echo $accommodation['image']; ?>" class="img-thumbnail" alt="<?php echo $accommodation['name']; ?>">
                                </div>
                                <div class="col-md-8">
                                    <?php if ($result_inventory->num_rows > 0): ?>
                                        <div class="row">
                                            <?php foreach ($result_inventory as $row): ?>
                                                <div class="col-md-4">
                                                    <div class="thumbnail">
                                                        <!-- Add a link around the image -->
                                                        <a href="item_details.php?item_id=<?php echo $row['id']; ?>">
                                                            <img style="width: 200px; height: 200px;" src="upload/<?php echo $row['item_img']; ?>" alt="<?php echo $row['item']; ?>">
                                                        </a>
                                                        <div class="caption">
                                                            <h5><?php echo $row['item']; ?></h5>
                                                            <!-- Form to add item to cart -->
                                                            <form action="add_to_cart.php" method="post">
                                                                <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <p>No inventory items found.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php } else { ?>


                             <!-- OTHER -->
                       
                                <div class="row">
                                    <div class="col-md-4">
                                        <img style="width: 600px; height: 400px;" src="upload/<?php echo $accommodation['image']; ?>" class="img-thumbnail" alt="<?php echo $accommodation['name']; ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <canvas id="barChart" width="400" height="200"></canvas>
                                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('barChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Quantity',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include('footer.php'); ?>
