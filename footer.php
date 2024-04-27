<!-- Main Footer -->
<footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y') ?></strong> All rights reserved.
</footer>

<div class="control-sidebar-bg"></div>
</div>
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.2.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.min.js"></script>
<!-- DataTables Bootstrap JavaScript (external link) -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

<script>


$(document).ready(function() {


    $('#example1').DataTable();

    function checkInventory() {
    $.ajax({
        url: 'check_inventory.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var lowQuantityItems = data.lowQuantityItems;
            var dropdownMenu = $('.dropdown-menu'); // Select the dropdown menu
            var badge = $('.navbar-badge'); // Select the badge element

            // Clear existing notification items and badge content
            dropdownMenu.empty();
            badge.empty();

            if (lowQuantityItems.length > 0) {


                // Show notification alert icon
                $('#notificationIcon').addClass('text-danger');

                // Play notification sound
                playNotificationSound();

                // Add header for low quantity items
                dropdownMenu.append('<li class="header">Low Quantity Items</li>');

                // Add notification items for each low quantity item
                lowQuantityItems.forEach(function(item) {
                    dropdownMenu.append('<li><a href="inventory.php"><i class="fa fa-exclamation-triangle text-warning"></i> ' + item + '</a></li>');
                    dropdownMenu.append('<br>'); // Add a line break after each notification item
                });

                // Update badge content with total count of low quantity items
                badge.text(lowQuantityItems.length);
                badge.show(); // Show the badge if there are low quantity items
            } else {
                // Add message if no low quantity items
                dropdownMenu.append('<li><a href="#">No low quantity items</a></li>');

                // Hide the badge if there are no low quantity items
                badge.hide();

                // Hide notification alert icon
                $('#notificationIcon').removeClass('text-danger');

            }

            // Add menu footer
            // dropdownMenu.append('<li class="footer"><a href="#">View all</a></li>');
        },
        error: function(xhr, status, error) {
            console.error('Error checking inventory:', error);
        }
    });
}

    function playNotificationSound() {
    var notificationSound = document.getElementById("notificationSound");
    notificationSound.play();
    }

    // Check inventory every 3 seconds
    setInterval(checkInventory, 3000);
});




</script>
</body>
</html>

