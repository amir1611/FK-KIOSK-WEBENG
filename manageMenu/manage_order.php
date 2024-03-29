<?php
	include("./utils/navigation.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Manage Order</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../w3.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link href="../css/table.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

	<style>
		a {
			text-decoration: none;
		}

		html,
		body,
		h1,
		h2,
		h3,
		h4,
		h5 {
			font-family: "RobotoDraft", "Roboto", sans-serif
		}

		.w3-bar-block .w3-bar-item {
			padding: 16px
		}

		.w3-biru {
			background-color: #f6f9ff;
		}
	</style>
</head>

<body class="w3-biru">


	<!-- Side Navigation -->
	<nav class="w3-sidebar w3-bar-block w3-collapse  w3-card" style="z-index:3;width:250px; background:#e7c0ff;" id="mySidebar">
		<a href="dashboard.php" class="w3-bar-item w3-large" style="border-bottom: 2px solid #877272f0;"><img src="../../images/logo.png" class="w3-padding" style="width:216px;"></a>
		<a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>

		<?php foreach ($menu_url as $menu) {?>
			<?php if ($menu['name'] == 'Manage Order') {?>
				<a href="<?php echo $menu['link']; ?>" class="w3-bar-item w3-button w3-pale-blue">
					<i class="<?php echo $menu['icon'];?>"></i> <?php echo $menu['name'];?></a>
			<?php } else { ?>

				<a href="<?php echo $menu['link']; ?>" class="w3-bar-item w3-button  ">
					<i class="<?php echo $menu['icon'];?>"></i> <?php echo $menu['name'];?></a>
			<?php } ?>
		<?php } ?>

	</nav>



	<!-- Overlay effect when opening the side navigation on small screens -->
	<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

	<!-- Page content -->
	<div class="w3-main" style="margin-left:250px;">

		<!-- sidebar -->
		<div class="w3-white w3-bar w3-card ">


			<i class="fa fa-bars w3-buttonx w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>


			<div class="w3-large w3-buttonx w3-bar-item w3-right w3-white w3-dropdown-hover">
				<button class="w3-button"><i class="fa fa-fw fa-user-circle"></i> Vendor <i class="fa fa-fw fa-chevron-down w3-small"></i></button>
				<div class="w3-dropdown-content w3-bar-block w3-card-4">
					<a href="../../manageAccount/profile.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-user-cog "></i> Profile</a>
					<a href="../../config/userlogout.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-sign-out-alt "></i> Signout</a>
				</div>
			</div>

		</div>



		<div class="w3-padding-16"></div>

        <div class="w3-row">
            <div class="w3-container w3-content w3-xxlarge w3-cell" style="width: 90%;"> All Orders  </div>
        </div>



		<div class="w3-container">

			<!-- Page Container -->
			<div class="w3-container w3-content w3-white w3-card w3-padding-16 w3-round" style="max-width:1200px;">
				<!-- The Grid -->
				<div class="w3-row w3-white w3-padding">

					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
							<thead>
								<tr>
									<th>#</th>
									<th>Customer Name</th>
									<th>Menu</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							
								<tr>
									<td>1</td>
									<td>Ahmad Zubair</td>
									<td>Nasi Goreng</td>
									<td>1</td>
									<td>2.50</td>
									<td><span class="w3-badge w3-green">Ready</span></td>
									<td>
										<a href="#" class="w3-button w3-green" style="border-radius: 20px;"><i class="fas fa-check"></i> Ready</a>
										<a href="#" class="w3-button w3-red" style="border-radius: 20px;"><i class="fas fa-times"></i> Not Ready</a>

									</td>

								</tr>
							
						</table>
					</div>


					<!-- End Grid -->
				</div>

				<!-- End Page Container -->
			</div>




		</div>
		<!-- container end -->


		<footer class="w3-container w3-padding-1 w3-center" style="background: white;margin-top: 475px;">
			<p>&copy; 2023 FK KIOSK. All rights reserved.</p>
		</footer>


	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="../js/scripts.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<!--<script src="assets/demo/datatables-demo.js"></script>-->

	<script>
		$(document).ready(function() {


			$('#dataTable').DataTable({
				paging: true,

				searching: true
			});


		});
	</script>


	<script>
		var openInbox = document.getElementById("myBtn");
		openInbox.click();

		function w3_open() {
			document.getElementById("mySidebar").style.display = "block";
			document.getElementById("myOverlay").style.display = "block";
		}

		function w3_close() {
			document.getElementById("mySidebar").style.display = "none";
			document.getElementById("myOverlay").style.display = "none";
		}

		function myFunc(id) {
			var x = document.getElementById(id);
			if (x.className.indexOf("w3-show") == -1) {
				x.className += " w3-show";
				x.previousElementSibling.className += " w3-pale-red";
			} else {
				x.className = x.className.replace(" w3-show", "");
				x.previousElementSibling.className =
					x.previousElementSibling.className.replace(" w3-red", "");
			}
		}
	</script>

</body>

</html>