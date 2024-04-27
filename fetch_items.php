
<?php
// Include database connection or any necessary files
include 'db_connection.php';

// Check if accommodation ID is provided
if (isset($_GET['accommodation_id'])) {
    $accommodationId = $_GET['accommodation_id'];
    
    // Fetch items for the selected accommodation from the database
    $sql = "SELECT id, item, price FROM inventory WHERE accommodation_id = $accommodationId AND quantity > 0";
    $result = $conn->query($sql);

    // Prepare data to send back as JSON
    $items = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    echo json_encode($items);
} else {
    echo json_encode([]);
}
?>
