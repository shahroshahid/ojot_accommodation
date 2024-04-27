<ul class="sidebar-menu tree" data-widget="tree">

    <li class="header">Dashboard</li>
	<li><a href="dashboard.php"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>


	<!--  MANAGER -->
	<?php
	if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "manager" || $_SESSION['user_role'] == "admin"){
		?>
		
		<?php /* ?>
		<li class="header">Real time stock</li>
		<li><a href="view_stock.php"><i class="fa fa-link"></i> <span>Real time stock</span></a></li>
		<?php */ ?>


		
		<li class="header">Users</li>
		<li><a href="user_list.php"><i class="fa fa-link"></i> <span>Users</span></a></li>

		

		<li class="header">Inventory</li>
		<li><a href="inventory.php"><i class="fa fa-link"></i> <span>Inventory</span></a></li>

		<li class="header">Orders</li>
		<li><a href="orders.php"><i class="fa fa-link"></i> <span>Orders</span></a></li>
		
		<?php /* ?>
		<li class="header">Sales</li>
		<li><a href="sales.php"><i class="fa fa-link"></i> <span>Sales</span></a></li>
		<?php */ ?>
		
		<li class="header">Accommodations</li>
		<li><a href="accommodations.php"><i class="fa fa-link"></i> <span>Accommodations</span></a></li>

		<li class="header">Feedback</li>
		<li><a href="feedback.php"><i class="fa fa-link"></i> <span>Feedback</span></a></li>
		<?php
	}
	?>
	
	<!--  STAFF - Sales Transaction -->
	<?php
	if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "staff"){
		?>
		<?php /* ?>
		<li class="header">Real time stock</li>
		<li><a href="view_stock.php"><i class="fa fa-link"></i> <span>Real time stock</span></a></li>
		<?php */ ?>

		

		
		<li class="header">Inventory</li>
		<li><a href="inventory.php"><i class="fa fa-link"></i> <span>Inventory</span></a></li>

		<li class="header">Orders</li>
		<li><a href="orders.php"><i class="fa fa-link"></i> <span>Orders</span></a></li>
		
		<?php /* ?>
		<li class="header">Sales</li>
		<li><a href="sales.php"><i class="fa fa-link"></i> <span>Sales</span></a></li>
		<?php */ ?>

		<li class="header">Feedback</li>
		<li><a href="feedback.php"><i class="fa fa-link"></i> <span>Feedback</span></a></li>
		<?php
	}
	?>
	
	
	<!--  Student - Sales Transaction -->
	<?php
	if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "student"){
		?>
		<?php /* ?>
		<li class="header">Real time stock</li>
		<li><a href="view_stock.php"><i class="fa fa-link"></i> <span>Real time stock</span></a></li>
		<?php */ ?>
		
		
		<li class="header">Accommodations</li>
		<li><a href="accommodations_grid.php"><i class="fa fa-link"></i> <span>Accommodations</span></a></li>


		<li class="header">Orders</li>
		<li><a href="orders.php"><i class="fa fa-link"></i> <span>Orders</span></a></li>

		<li class="header">Feedback</li>
		<li><a href="feedback.php"><i class="fa fa-link"></i> <span>Feedback</span></a></li>
		<?php
	}
	?>
	
	
    

</ul>