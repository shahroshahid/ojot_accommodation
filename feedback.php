<?php
include('header.php');

$sql = "SELECT * FROM feedback ORDER BY id"; // Assuming 'id' is the primary key column
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $feedbackData = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $feedbackData = [];
}

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
                        <h3 class="box-title">Inventory</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="add_feedback.php" class="btn btn-success">Add New Feedback</a>
                            </div>
                        </div>
                        <br>
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>The taste of your food</th>
                                <th>The temperature of your food</th>
                                <th>The speed of service</th>
                                <th>The friendliness of the crew</th>
                                <th>The accuracy of your order</th>
                                <th>The cleanliness of your area</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($feedbackData as $feedback) : ?>
                                <tr>
                                    <td><?php echo $feedback['id']; ?></td>
                                    <td><?php echo $feedback['taste']; ?></td>
                                    <td><?php echo $feedback['temperature']; ?></td>
                                    <td><?php echo $feedback['service_speed']; ?></td>
                                    <td><?php echo $feedback['crew_friendliness']; ?></td>
                                    <td><?php echo $feedback['order_accuracy']; ?></td>
                                    <td><?php echo $feedback['cleanliness']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php'); ?>