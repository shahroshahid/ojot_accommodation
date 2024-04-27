<?php
include('header.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $message = "";
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO feedback (taste, temperature, service_speed, crew_friendliness, order_accuracy, cleanliness) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiii", $taste, $temperature, $service_speed, $crew_friendliness, $order_accuracy, $cleanliness);

    // Set parameters and execute the statement
    $taste = $_POST['taste'];
    $temperature = $_POST['temperature'];
    $service_speed = $_POST['service_speed'];
    $crew_friendliness = $_POST['crew_friendliness'];
    $order_accuracy = $_POST['order_accuracy'];
    $cleanliness = $_POST['cleanliness'];

    $stmt->execute();

    $message = "Feedback submitted successfully";

    $stmt->close();
    $conn->close();

}
?>
<style>

.emoji-radio {
  position: relative;
}

.emoji-radio input[type="radio"] {
  position: absolute;
  opacity: 0;
  pointer-events: none;
}

.emoji-radio span {
  display: inline-block;
  cursor: pointer;
  padding: 5px;
}

/* Style for selected emoji */
.emoji-radio input[type="radio"]:checked + span {
  background-color: #f0f0f0; /* Change to your desired background color */
  border: 1px solid #ccc; /* Optional: Add a border around the selected emoji */
}

/* Optional styling */
.emoji-radio span:hover {
  text-decoration: underline;
}


</style>
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
                        <h3 class="box-title">Feedback</h3>
                    </div>
                    <div class="box-body">
                        
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-success"><?php echo $message; ?></div>
                        <?php endif; ?>

                    <form method="post" action="">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Feedback Criteria</th>
                                <th>Highly satisfied</th>
                                <th>Satisfied</th>
                                <th>Neither Satisfied nor Disappointed</th>
                                <th>Disappointed</th>
                                <th>Highly Disappointed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>The taste of your food</td>
                                <td><label class="emoji-radio"><input type="radio" name="taste" value="5" required><span>😍</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="taste" value="4" required><span>😊</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="taste" value="3" required><span>😐</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="taste" value="2" required><span>😞</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="taste" value="1" required><span>😢</span></label></td>
                            </tr>
                            <tr>
                                <td>The temperature of your food</td>
                                <td><label class="emoji-radio"><input type="radio" name="temperature" value="5" required><span>😍</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="temperature" value="4" required><span>😊</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="temperature" value="3" required><span>😐</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="temperature" value="2" required><span>😞</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="temperature" value="1" required><span>😢</span></label></td>                             
                            </tr>
                            <tr>
                                <td>The speed of service</td>
                                <td><label class="emoji-radio"><input type="radio" name="service_speed" value="5" required><span>😍</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="service_speed" value="4" required><span>😊</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="service_speed" value="3" required><span>😐</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="service_speed" value="2" required><span>😞</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="service_speed" value="1" required><span>😢</span></label></td>   
                            </tr>
                            <tr>
                                <td>The friendliness of the crew</td>
                                <td><label class="emoji-radio"><input type="radio" name="crew_friendliness" value="5" required><span>😍</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="crew_friendliness" value="4" required><span>😊</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="crew_friendliness" value="3" required><span>😐</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="crew_friendliness" value="2" required><span>😞</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="crew_friendliness" value="1" required><span>😢</span></label></td>  
                            </tr>
                            <tr>
                                <td>The accuracy of your order</td>
                                <td><label class="emoji-radio"><input type="radio" name="order_accuracy" value="5" required><span>😍</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="order_accuracy" value="4" required><span>😊</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="order_accuracy" value="3" required><span>😐</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="order_accuracy" value="2" required><span>😞</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="order_accuracy" value="1" required><span>😢</span></label></td> 
                            </tr>
                            <tr>
                                <td>The cleanliness of your area</td>
                                <td><label class="emoji-radio"><input type="radio" name="cleanliness" value="5" required><span>😍</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="cleanliness" value="4" required><span>😊</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="cleanliness" value="3" required><span>😐</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="cleanliness" value="2" required><span>😞</span></label></td>
                                <td><label class="emoji-radio"><input type="radio" name="cleanliness" value="1" required><span>😢</span></label></td>
                            </tr>
                        </tbody>
                    </table>

                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('footer.php'); ?>