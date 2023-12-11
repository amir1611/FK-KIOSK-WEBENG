<?PHP
session_start();

include("../../config/database.php");
if (!verifyAdmin($con)) {
	header("Location: ../user/index.php");
	return false;
}
?>
<?PHP
$tot_user 		= numRows($con, "SELECT * FROM `user` WHERE `role` = 'user' ");
$tot_vendor		= numRows($con, "SELECT * FROM `user` WHERE `role` = 'vendor' ");
$tot_pending	= numRows($con, "SELECT * FROM `user` WHERE `role` = 'vendor' AND `status` = 'Pending'");
$tot_approved	= numRows($con, "SELECT * FROM `user` WHERE `role` = 'vendor' AND `status` = 'Approved'");
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
	<!-- ApexCharts -->
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


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

		.w3-bar-block .w3-bar-item {
			padding: 16px
		}

		.w3-biru {
			background-color: #f6f9ff;
		}

		@keyframes glow {
			0% {
				box-shadow: 0 0 20px rgba(0, 0, 255, 0.7);
			}

			50% {
				box-shadow: 0 0 30px rgba(0, 0, 255, 0.9);
			}

			100% {
				box-shadow: 0 0 20px rgba(0, 0, 255, 0.7);
			}
		}

		.glow-animation {
			animation: glow 3s infinite;
		}

		
	</style>
</head>

<body class="w3-biru">


	<!-- Side Navigation -->
	<nav class="w3-sidebar w3-bar-block w3-collapse  w3-card" style="z-index:3;width:250px; background:#e7c0ff;" id="mySidebar">
		<a href="a-main.php" class="w3-bar-item w3-large" style="border-bottom: 2px solid #877272f0;"><img src="../../images/logo.png" class="w3-padding" style="width:216px;"></a>
		<a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>

		<a href="a-main.php" class="w3-bar-item w3-button ">
			<i class="fa fa-fw fa-tachometer-alt w3-margin-right"></i> DASHBOARD</a>

		<a href="a-profile.php" class="w3-bar-item w3-button  ">
			<i class="fa fa-fw fa-user w3-margin-right"></i> PROFILE</a>

		<a href="a-user.php" class="w3-bar-item w3-button  ">
			<i class="fa fa-fw fa-users w3-margin-right"></i> USER LIST</a>

		<a href="a-pending.php" class="w3-bar-item w3-button ">
			<i class="fa fa-fw fa-user-plus w3-margin-right"></i> APPROVAL LIST</a>

	</nav>



	<!-- Overlay effect when opening the side navigation on small screens -->
	<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

	<!-- Page content -->
	<div class="w3-main" style="margin-left:250px;">



		<div class="w3-white w3-bar w3-card ">


			<i class="fa fa-bars w3-buttonx w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>


			<div class="w3-large w3-buttonx w3-bar-item w3-right w3-white w3-dropdown-hover">
				<button class="w3-button"><i class="fa fa-fw fa-user-circle"></i> Administrator <i class="fa fa-fw fa-chevron-down w3-small"></i></button>
				<div class="w3-dropdown-content w3-bar-block w3-card-4">
					<a href="a-profile.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-user-cog "></i> Profile</a>
					<a href="../../config/adminlogout.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-sign-out-alt "></i> Signout</a>
				</div>
			</div>

		</div>



		<div class="w3-padding-16"></div>

		<div class="w3-container w3-content w3-xxlarge " style="max-width:1200px;"> <b>Dashboard </b> </div>




		<div class="w3-container">

			<!-- Page Container -->
			<div class="w3-containerx w3-content  w3-padding-16 " style="max-width:1200px;">
				<!-- The Grid -->
				<div class="w3-row ">

					<div class="w3-col m3 w3-container w3-padding">
						<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16 glow-animation">
							<div class="w3-row"><i class="fa fa-fw fa-users fa-2x w3-left w3-text-blue"></i></div>
							<h1><b><?php echo $tot_user; ?></b></h1>
							Users<br>
						</div>
					</div>


					<div class="w3-col m3 w3-container w3-padding">
						<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16 glow-animation">
							<div class="w3-row"><i class="fa fa-fw fa-store fa-2x w3-left w3-text-blue"></i></div>
							<h1><b><?PHP echo $tot_vendor; ?></b></h1>
							Vendor<br>
						</div>
					</div>

					<div class="w3-col m3 w3-container w3-padding">
						<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16 glow-animation">
							<div class="w3-row"><i class="fa fa-fw fa-history fa-2x w3-left w3-text-blue"></i></div>
							<h1><b><?PHP echo $tot_pending; ?></b></h1>
							<span class="w3-text-red">Pending Approval</span>
						</div>
					</div>

					<div class="w3-col m3 w3-container w3-padding">
						<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16 glow-animation">
							<div class="w3-row"><i class="fa fa-fw fa-user-check fa-2x w3-left w3-text-blue"></i></div>
							<h1><b><?PHP echo $tot_approved; ?></b></h1>
							<span class="w3-text-green">Approved</span>
						</div>
					</div>



					<!-- End Grid -->
				</div>



				<!-- End Page Container -->
			</div>





		</div>
		<!-- container end -->


   
		<div id="myChart" style="height: 250px; max-width: 1200px; margin-bottom: -50px;"></div>









		<footer class="w3-container w3-padding-1 w3-center" style="background: white;margin-top: 472px;">
			<p>&copy; 2023 FK KIOSK. All rights reserved.</p>
		</footer>


	</div>

	<script>
		var totUser = <?php echo $tot_user; ?>;
		var totVendor = <?php echo $tot_vendor; ?>;
		var totPending = <?php echo $tot_pending; ?>;
		var totApproved = <?php echo $tot_approved; ?>;

		var options = {
			chart: {
				type: 'donut',
				height: 250, // Set the height of the chart
				background: 'transparent', // Set the background color
			},
			labels: ['User', 'Vendor', 'Pending Approval', 'Approved'],
			series: [totUser, totVendor, totPending, totApproved],
			colors: ['#3498db', '#2ecc71', '#e74c3c', '#f1c40f'],
			plotOptions: {
				pie: {
					donut: {
						size: '50%', // Set the size of the donut
					}
				}
			}
		};

		var chart = new ApexCharts(document.querySelector("#myChart"), options);
		chart.render();

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