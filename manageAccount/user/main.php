<?PHP
session_start();

include("../../config/database.php");
include("../../main_utils/navigation.php");
if (!verifyUser($con)) {
	header("Location: index.php");
	return false;
}
?>
<?PHP
$id_user	= $_SESSION["id_user"];

$SQL_list 	= "SELECT * FROM `user` WHERE `id_user` = '$id_user' ";
$result 	= mysqli_query($con, $SQL_list);
$data		= mysqli_fetch_array($result);
$name 		= $data["name"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>FKKIOSK</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../w3.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<style>
		html,
		body,
		h1,
		h2,
		h3,
		h4,
		h5 {
			font-family: "RobotoDraft", "Roboto", sans-serif
		}

		a:link {
			text-decoration: none;
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
	<nav class="w3-sidebar w3-bar-block w3-collapse  w3-card" style="z-index:3;width:250px; background:pink;" id="mySidebar">
		<a href="main.php" class="w3-bar-item w3-large" style="border-bottom: 2px solid #877272f0;"><img src="../../images/logo.png" class="w3-padding" style="width:216px;"></a>
		<a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>
		<?php 
			$menu_url = returnMenu($_SESSION['role']);
		?>
		<?php foreach ($menu_url as $menu) {?>
			<?php if ($menu['name'] == 'Dashboard') {?>
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



		<div class="w3-white w3-bar w3-card ">


			<i class="fa fa-bars w3-buttonx w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>


			<div class="w3-large w3-buttonx w3-bar-item w3-right w3-white w3-dropdown-hover">
				<button class="w3-button"><i class="fa fa-fw fa-user-circle"></i> User <i class="fa fa-fw fa-chevron-down w3-small"></i></button>
				<div class="w3-dropdown-content w3-bar-block w3-card-4" style="min-width: 54px;">
					<a href="profile.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-user-cog "></i> Profile</a>
					<a href="../../config/userlogout.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-sign-out-alt "></i> Logout</a>
				</div>
			</div>

		</div>



		<div class="w3-padding-32"></div>

		<div class="w3-container w3-content w3-xxlarge " style="max-width:900px;"> Hi, <?PHP echo $name; ?></div>


		<div class="w3-container">

			<!-- Page Container -->
			<div class="w3-container w3-content  w3-padding-16 " style="max-width:900px;">
				<!-- The Grid -->
				<div class="w3-row ">
					Welcome Back. <?PHP echo $_SESSION["role"]; ?>

					<!-- End Grid -->
				</div>

				<!-- End Page Container -->
			</div>




		</div>
		<!-- container end -->




		<footer class="w3-container w3-padding-1 w3-center" style="background: white;margin-top: 625px;">
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