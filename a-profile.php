<?PHP
session_start();

include("database.php");
if (!verifyAdmin($con)) {
	header("Location: index.php");
	return false;
}
?>
<?PHP
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';

$username 	= (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';
$email 		= (isset($_POST['email'])) ? trim($_POST['email']) : '';

$success = "";

if ($act == "edit") {
	$SQL_update = " 
	UPDATE
		`admin`
	SET
		`username` = '$username',
		`password` = '$password',
		`email` = '$email'
	WHERE
		`username`='$_SESSION[username]' 
		";

	$result = mysqli_query($con, $SQL_update);


	$success = "Successfully Registered";
	//print "<script>self.location='a-profile.php';</script>";
}


$SQL_list = "SELECT * FROM `admin` WHERE `username`='$_SESSION[username]' ";
$result = mysqli_query($con, $SQL_list);
$data	= mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>FKKIOSK</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="w3.css">
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
            background-image: linear-gradient(to right, #556270 0%, #FF6B6B  51%, #556270  100%);
            margin: 0px;
            padding: 15px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }
         

	</style>
</head>

<body class="w3-biru">

	<!--- Toast Notification -->
	<?PHP
	if ($success) {
		Notify("success", $success, "a-profile.php");
	}
	?>

	<!-- Side Navigation -->
	<nav class="w3-sidebar w3-bar-block w3-collapse  w3-card" style="z-index:3;width:250px; background:#e7c0ff;" id="mySidebar">
		<a href="a-main.php" class="w3-bar-item w3-large" style="border-bottom: 2px solid #877272f0;"><img src="images/logo.png" class="w3-padding" style="width:216px;"></a>
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
					<a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-sign-out-alt "></i> Signout</a>
				</div>
			</div>

		</div>

		<div class="w3-padding-16"></div>



		<div class="w3-padding-16"></div>

		<div class="w3-container">

			<!-- Page Container -->
			<div class="w3-container w3-white w3-content w3-card w3-padding-16" style="max-width:400px; border-radius: 20px;">
				<!-- The Grid -->
				<div class="w3-row w3-padding">

					<form action="" method="post">
						<div class="w3-padding">
							<div style="text-align: center;">
								<b class="w3-large">Profile</b>
							</div>
							<hr>

							<div class="w3-section">
								<label style="font-weight: bold; color: black;">Email <span style="color: red;">*</span></label>
								<input class="w3-input w3-border w3-round" type="email" name="email" value="<?php echo $data["email"]; ?>" placeholder="Email Address" required>
							</div>


							<div class="w3-section">
								<label style="font-weight: bold; color: black;">Username <span style="color: red;">*</span></label>
								<input class="w3-input w3-border w3-round" type="text" name="username" value="<?php echo $data["username"]; ?>" placeholder="Username" required>
							</div>


							<div class="w3-section">
								<label style="font-weight: bold; color: black;">Password <span style="color: red;">*</span></label>
								<input class="w3-input w3-border w3-round" type="password" name="password" value="<?php echo $data["password"]; ?>" placeholder="Password" required>
							</div>



							<input type="hidden" name="id_admin" value="<?PHP echo $data["id_admin"]; ?>">
							<input type="hidden" name="act" value="edit">
							<div style="text-align: center;">
								<button type="submit" class=" btn-grad  w3-button w3-black w3-margin-bottom w3-round" style="margin-left: 72px;">UPDATE</button>
							</div>

						</div>
					</form>




					<!-- End Grid -->
				</div>

				<!-- End Page Container -->
			</div>




		</div>
		<!-- container end -->


		<footer class="w3-container w3-padding-1 w3-center" style="background: white;margin-top: 308px;">
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