<?php
	session_start();
	include("../config/database.php");
	include("./utils/navigation.php");
	$id_kiosk = $_SESSION['id_kiosk'];
	$localhost = "http://" . $_SERVER['HTTP_HOST'];

	$act = (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';
	$id_menu = (isset($_REQUEST['id_menu'])) ? trim($_REQUEST['id_menu']) : '';

	if ($act == "available") {
		$SQL_update = " UPDATE `menu` SET `status` = 'available' WHERE `id_menu` = $id_menu";
		$result = mysqli_query($con, $SQL_update);
		$success = "Successfully Updated";
		print "<script>self.location='manage_menu.php';</script>";
	}
	
	if ($act == "unavailable") {
		$SQL_update = " UPDATE `menu` SET `status` = 'unavailable' WHERE `id_menu` = $id_menu";
		$result = mysqli_query($con, $SQL_update);
		$success = "Successfully Updated";
		print "<script>self.location='manage_menu.php';</script>";
	}

	if ($act == 'delete') {
		$query = "DELETE FROM `menu` WHERE id_menu = $id_menu";
		$result = mysqli_query($con, $query);
		print "<script>self.location='manage_menu.php';</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Manage Menu</title>
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

		#qrcode {
			margin-left: 3.5em;
		}
	</style>
</head>

<body class="w3-biru">


	
	<!-- Side Navigation -->
	<nav class="w3-sidebar w3-bar-block w3-collapse  w3-card" style="z-index:3;width:250px; background:#e7c0ff;" id="mySidebar">
		<a href="dashboard.php" class="w3-bar-item w3-large" style="border-bottom: 2px solid #877272f0;"><img src="../../images/logo.png" class="w3-padding" style="width:216px;"></a>
		<a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>
		<?php foreach ($menu_url as $menu) {?>
			<?php if ($menu['name'] == 'Manage Menu') {?>
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
            <div class="w3-container w3-content w3-xxlarge w3-cell" style="width: 90%;"> All Menus  </div>
            <div class="w3-container w3-padding-16 w3-cell" style="width: 5%;"><button onclick="document.getElementById('generate-qr').style.display='block'" class="w3-button w3-indigo w3-round-large"><i class="fas fa-qrcode"></i> Generate QR Code</button></div>
            <div class="w3-container w3-padding-16 w3-cell" style="width: 5%;"><a href="register_menu.php" class="w3-button w3-teal w3-round-large"><i class="fas fa-plus"></i> Add Menu</a></div>
        </div>

		<div id="generate-qr" class="w3-modal">
			<div class="w3-modal-content w3-animate-top w3-card-4" style="width: 25%;">
				<header class="w3-container w3-teal">
				<span onclick="document.getElementById('generate-qr').style.display='none'" class="w3-button w3-display-topright">&times;</span>
					<h2>Qr Code</h2>
				</header>
				<div class="w3-container w3-padding-32">
					<input type="hidden" value="<?php echo $localhost;?>/manageMenu/manage_menu.php?id_kiosk=<?php echo $id_kiosk?>" id="menu_url">
					<div id="qrcode"></div>
				</div>
			</div>
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
									<th>Menu Name</th>
									<th>Price</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<?php 
								$bil = 0;
								$query_list = "SELECT * FROM `menu` WHERE `id_kiosk` = '$id_kiosk'";
								$result = mysqli_query($con, $query_list);
								while ($data = mysqli_fetch_array($result)) {
									$bil++;
							?>
								<tr>
									<td><?php echo $bil;?></td>
									<td><?php echo $data["menu_name"];?></td>
									<td><?php echo $data["price"];?></td>
									<td>
										<?php if($data["status"] == 'available') {?>
										<span class="w3-badge w3-green">Available</span></td>
										<?php } ?>
										<?php if($data["status"] == 'unavailable') {?>
											<span class="w3-badge w3-red">Unavailable</span></td>
										<?php } ?>


									<td>
										<a href="?act=available&id_menu=<?php echo $data['id_menu'];?>" class="w3-button w3-green" style="border-radius: 20px;"><i class="fas fa-check"></i> Available</a>
										<a href="?act=unavailable&id_menu=<?php echo $data['id_menu'];?>" class="w3-button w3-red" style="border-radius: 20px;"><i class="fas fa-times"></i> Unavailable</a>
										<a href="edit_menu.php?id_menu=<?php echo $data['id_menu']; ?>" class="w3-button w3-deep-orange" style="border-radius: 20px;"><i class="fas fa-clipboard"></i> Edit</a>
										<a href="?act=delete&id_menu=<?php echo $data['id_menu'];?>" class="w3-button w3-red" style="border-radius: 20px;"><i class="fas fa-trash"></i> Delete</a>

									</td>

								</tr>
							<?php } ?>
							
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
	<script src="../js/qrcode.min.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<!--<script src="assets/demo/datatables-demo.js"></script>-->

	<script>
		$(document).ready(function() {


			$('#dataTable').DataTable({
				paging: true,

				searching: true
			});

			let menu_url = $('#menu_url').val();

			var qrcode = new QRCode("qrcode", {
				text: menu_url,
				width: 228,
				height: 228,
				colorDark : "#000000",
				colorLight : "#ffffff",
				correctLevel : QRCode.CorrectLevel.H
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