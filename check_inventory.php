<?php
// Include database connection or any necessary files
include 'db_connection.php';

// Fetch inventory items with quantity less than 5 from the database
$sql = "SELECT i.*, a.name AS accommodation_name 
        FROM inventory i 
        JOIN accommodations a ON i.accommodation_id = a.id 
        WHERE i.quantity < 5";

$result = $conn->query($sql);

// Prepare data to send back as JSON
$lowQuantityItems = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Check if accommodation name is retrieved successfully
        $accommodationName = isset($row['accommodation_name']) ? $row['accommodation_name'] : 'Unknown Accommodation';
        
        // Construct the notification message
        $notificationMessage = $accommodationName . " - " . $row['item'] . " (Low Qty)";

        $lowQuantityItems[] = $notificationMessage;
    }
}
echo json_encode(['lowQuantityItems' => $lowQuantityItems]);
?>
