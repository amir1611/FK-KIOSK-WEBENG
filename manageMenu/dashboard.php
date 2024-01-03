<?php
	session_start();
	include("../config/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../w3.css">
	<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Manage Menu Dashboard</title>
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
		<a href="dashboard.php" class="w3-bar-item w3-large" style="border-bottom: 2px solid #877272f0;"><img src="../../images/logo.png" class="w3-padding" style="width:216px;"></a>
		<a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>

		<a href="dashboard.php" class="w3-bar-item w3-button w3-pale-blue">
			<i class="fa fa-fw fa-tachometer-alt w3-margin-right"></i> DASHBOARD</a>

		<a href="profile.php" class="w3-bar-item w3-button  ">
			<i class="fa fa-fw fa-user w3-margin-right"></i> PROFILE</a>

		<a href="manage_menu.php" class="w3-bar-item w3-button  ">
			<i class="fa fa-fw fa-book-reader w3-margin-right"></i> Manage Menu</a>

		<a href="manage_order.php" class="w3-bar-item w3-button ">
			<i class="fa fa-fw fa-check w3-margin-right"></i> Manage Order</a>

		<a href="manage_kiosk.php" class="w3-bar-item w3-button ">
			<i class="fa fa-fw fa-store w3-margin-right"></i> Manage Kiosk</a>

	</nav>



	<!-- Overlay effect when opening the side navigation on small screens -->
	<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

	<!-- Page content -->
	<div class="w3-main" style="margin-left:250px;">



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

		<div class="w3-container w3-content w3-xxlarge " style="max-width:1200px;"> <b>Dashboard </b> </div>




		<div class="w3-container">

			<!-- Page Container -->
			<div class="w3-containerx w3-content  w3-padding-16 " style="max-width:1200px;">
				<!-- The Grid -->
				<div class="w3-row ">

					<div class="w3-col m3 w3-container w3-padding">
						<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16 glow-animation">
							<div class="w3-row"><i class="fa fa-fw fa-book-reader fa-2x w3-left w3-text-blue"></i></div>
							<h1><b>4</b></h1>
							Menus<br>
						</div>
					</div>


					<div class="w3-col m3 w3-container w3-padding">
						<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16 glow-animation">
							<div class="w3-row"><i class="fa fa-fw fa-check fa-2x w3-left w3-text-blue"></i></div>
							<h1><b>20</b></h1>
							Orders<br>
						</div>
					</div>

					<div class="w3-col m3 w3-container w3-padding">
						<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16 glow-animation">
							<div class="w3-row"><i class="fa fa-fw fa-chart-pie fa-2x w3-left w3-text-blue"></i></div>
							<h1><b>20</b></h1>
							Total Sales<br>
						</div>
					</div>

					<div class="w3-col m3 w3-container w3-padding">
						<div class="w3-card w3-border w3-white w3-center w3-round-xlarge w3-margin w3-padding w3-padding-16 glow-animation">
							<div class="w3-row"><i class="fa fa-fw fa-user-check fa-2x w3-left w3-text-blue"></i></div>
							<h1><span class="w3-text-green">Open</span></h1>
							Current Kiosk Status<br>
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
		var food1 = 20;
		var food2 = 20;
		var food3 = 20;
		var food4 = 20;

		var options = {
			chart: {
				type: 'donut',
				height: 250, // Set the height of the chart
				background: 'transparent', // Set the background color
			},
			labels: ['Menu 1', 'Menu 2', 'Menu 3', 'Menu 4'],
			series: [food1, food2, food3, food4],
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