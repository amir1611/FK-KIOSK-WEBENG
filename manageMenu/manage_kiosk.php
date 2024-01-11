<?php
	session_start();
	include("../config/database.php");
	include("./utils/navigation.php");
	$act = (isset($_POST['act'])) ? trim($_POST['act']) : '';
	if ($act == 'submit') {
		$kiosk_name = (isset($_POST['kiosk_name'])) ? trim($_POST['kiosk_name']) : '';
		$operating_hours = (isset($_POST['operating_hours'])) ? trim($_POST['operating_hours']) : '';
		$kiosk_information = (isset($_POST['kiosk_information'])) ? trim($_POST['kiosk_information']) : '';
		$status = (isset($_POST['status'])) ? trim($_POST['status']) : '';
		$id_user = $_SESSION['id_user'];
		$timestamp = date("Y-m-d H:i:s");

		$query = "
		INSERT INTO `kiosk` (`id_user`, `kiosk_name`, `operating_hours`, `kiosk_information`, `kiosk_img_dir`, `status`, `updated_at`)
					VALUES ('$id_user', '$kiosk_name', '$operating_hours', '$kiosk_information', 'none', '$status', '$timestamp')
		";

		$result = mysqli_query($con, $query) or die("Error in query: " . $query . "<br />" . mysqli_error($con));
		$id_kiosk = mysqli_insert_id($con);

		$_SESSION['id_kiosk'] = $id_kiosk;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Kiosk</title>
    <link rel="stylesheet" href="../../w3.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

		         
		         
		.btn-grad {
            background-image: linear-gradient(to right, #D38312 0%, #A83279  51%, #D38312  100%);
            margin: 0px;
            padding: 15px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            align-self: center;;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }
         
         

	</style>
</head>

<body class="w3-biru">



	<!-- Side Navigation -->
	<nav class="w3-sidebar w3-bar-block w3-collapse  w3-card" style="z-index:3;width:250px; background:#e7c0ff;" id="mySidebar">
		<a href="dashboard.php" class="w3-bar-item w3-large" style="border-bottom: 2px solid #877272f0;"><img src="../../images/logo.png" class="w3-padding" style="width:216px;"></a>
		<a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>

		<?php foreach ($menu_url as $menu) {?>
			<?php if ($menu['name'] == 'Manage Kiosk') {?>
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



		<div class="w3-padding-32"></div>



		<div class="w3-container">

			<!-- Page Container -->
			<div class="w3-container w3-white w3-content w3-card w3-padding-16" style="max-width:400px; border-radius:20px;">
				<!-- The Grid -->
				<div class="w3-row w3-padding">

					<form action="" method="post">
						<div class="w3-padding">
							<div style="text-align: center;">
								<b class="w3-large">Kiosk Details</b>
							</div>

							<hr>

							<div class="w3-section">
								<label style="font-weight: bold; color: black;">Kiosk Name <span style="color: red;">*</span></label>

								<input class="w3-input w3-border w3-round" type="text" name="kiosk_name" value="" required>
							</div>

							<div class="w3-section">
								<label style="font-weight: bold; color: black;">Enter Operating Hours <span style="color: red;">*</span></label>

								<input class="w3-input w3-border w3-round" type="text" name="operating_hours" value="" required>
							</div>

							<div class="w3-section">
								<label style="font-weight: bold; color: black;">Description <span style="color: red;">*</span></label>
								<input class="w3-input w3-border w3-round" type="text" name="kiosk_information" value="" required>
							</div>

							<div class="w3-section">
								<label style="font-weight: bold; color: black;">Upload Image <span style="color: red;">*</span></label>

								<input type="file" name="image">
							</div>

							<div class="w3-section">
								<label style="font-weight: bold; color: black;">Kiosk Status <span style="color: red;">*</span></label>
								<span class="w3-badge w3-large w3-green">Open</span>
								<select class="w3-input w3-border w3-round" name="status" required>
									<option value="open">Open</option>
									<option value="close">Close</option>
								</select>
							</div>

							<hr class="w3-clear">
							<input type="hidden" name="act" value="edit">
							<div style="text-align: center;">
		  						<input type="hidden" name="act" value="submit">
								<button type="submit" class="btn-grad w3-button w3-blue w3-margin-bottom w3-round">UPDATE</button>
							</div>

						</div>
					</form>


					<!-- End Grid -->
				</div>

				<!-- End Page Container -->
			</div>




		</div>
		<!-- container end -->




		<footer class="w3-container w3-padding-1 w3-center" style="background: white;margin-top: 140px;">
			<p>&copy; 2023 FK KIOSK. All rights reserved.</p>
		</footer>


	</div>

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