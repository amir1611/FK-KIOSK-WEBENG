<?PHP
session_start();

include("../../config/database.php");
if (!verifyAdmin($con)) {
	header("Location: ../user/index.php");
	return false;
}
?>
<?PHP
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';
$id_user	= (isset($_REQUEST['id_user'])) ? trim($_REQUEST['id_user']) : '';
$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$password	= (isset($_POST['password'])) ? trim($_POST['password']) : '';
$role		= (isset($_POST['role'])) ? trim($_POST['role']) : '';
$name		=	mysqli_real_escape_string($con, $name);


$success = "";

if ($act == "edit") {
	$SQL_update = " 
	UPDATE
		`user`
	SET
		`name` = '$name',
		`email` = '$email',
		`phone` = '$phone',
		`password` = '$password',
		`role` = '$role'
	WHERE
		id_user = $id_user
	";

	$result = mysqli_query($con, $SQL_update);

	$success = "Successfully Updated";

	//print "<script>self.location='a-user.php';</script>";
}

if ($act == "del") {
	$SQL_delete = " DELETE FROM `user` WHERE `id_user` =  '$id_user' ";
	$result = mysqli_query($con, $SQL_delete);

	print "<script>self.location='a-user.php';</script>";
}
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

	<link href="../../css/table.css" rel="stylesheet" />
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


		.btn-grad {
			background-image: linear-gradient(to right, #43cea2 0%, #185a9d 51%, #43cea2 100%);
			margin: 10px;
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
			background-position: right center;
			/* change the direction of the change here */
			color: #fff;
			text-decoration: none;
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

		<div class="w3-container w3-content w3-xxlarge " style="max-width:1200px;"> All User</div>


		<div class="w3-container">

			<!-- Page Container -->
			<div class="w3-container w3-content w3-white w3-card w3-padding-16 w3-round" style="max-width:1200px;">
				<!-- The Grid -->
				<div class="w3-row w3-white w3-padding">

					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr style="text-align: center;">
									<th>#</th>
									<th>Name</th>
									<th>Contact</th>
									<th>Email</th>
									<th>Role</th>
									<th>Document</th>
									<th>Action</th>
								</tr>
							</thead>
							<?PHP
							$bil = 0;
							$SQL_list = "SELECT * FROM `user` WHERE `status` = 'Approved'";
							$result = mysqli_query($con, $SQL_list);
							while ($data = mysqli_fetch_array($result)) {
								$bil++;
								$id_user = $data["id_user"];
							?>
								<tr>
									<td style="text-align: center;"><?PHP echo $bil; ?></td>
									<td style="text-align: center;"><?PHP echo $data["name"]; ?></td>
									<td style="text-align: center;"><?PHP echo $data["phone"]; ?></td>
									<td style="text-align: center;"><?PHP echo $data["email"]; ?></td>
									<td style="text-align: center;"><?PHP echo $data["role"]; ?></td>
									<td style="text-align: center;">
										<a target="_blank" class="w3-tag w3-round" href="../../upload/<?php echo $data["document"]; ?>">View</a>
									</td>


									<td style="text-align: center;">
										<a href="a-viewprofile.php?id_user=<?php echo $id_user; ?>" class="w1-padding"><i class="fas fa-eye"></i></a>

										<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='block'" class="w3-padding"><i class="fas fa-edit"></i></a>
										<a href="#" onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='block'" class="w3-text-red"><i class="fas fa-trash-alt"></i></a>
									</td>

								</tr>
								<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10; border-radius:-17px; background-color: rgb(0 0 0 / 81%);">
									<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
										<header class="w3-container ">
											<span onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='none'" class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
										</header>

										<div class="w3-container w3-padding w3-margin">

											<form action="" method="post" enctype="multipart/form-data">
												<div class="w3-padding"></div>
												<div style="text-align: center;">
													<b class="w3-large">Update User</b>
												</div>

												<hr>

												<div class="w3-section">
													<label style="font-weight: bold; color: black;">Role <span style="color: red;">*</span></label>
													<select class="w3-input w3-border w3-round" name="role" required>
														<option value="user" <?PHP if ($data["role"] == "user") echo "selected"; ?>>User</option>
														<option value="vendor" <?PHP if ($data["role"] == "vendor") echo "selected"; ?>>Vendor</option>
													</select>
												</div>

												<div class="w3-section">
													<label style="font-weight: bold; color: black;">Full Name <span style="color: red;">*</span></label>
													<input class="w3-input w3-border w3-round" type="text" name="name" value="<?php echo $data["name"]; ?>" placeholder="Enter user name" required>
												</div>


												<div class="w3-section">
													<label style="font-weight: bold; color: black;">Contact <span style="color: red;">*</span></label>
													<input class="w3-input w3-border w3-round" type="text" name="phone" value="<?php echo $data["phone"]; ?>" placeholder="">
												</div>


												<div class="w3-section">
													<label style="font-weight: bold; color: black;">Email <span style="color: red;">*</span></label>
													<input class="w3-input w3-border w3-round" type="email" name="email" value="<?php echo $data["email"]; ?>" placeholder="">
												</div>


												<div class="w3-section">
													<label style="font-weight: bold; color: black;">Password <span style="color: red;">*</span></label>
													<input class="w3-input w3-border w3-round" type="password" name="password" value="<?php echo $data["password"]; ?>" placeholder="">
												</div>


												<input type="hidden" name="id_user" value="<?PHP echo $data["id_user"]; ?>">
												<input type="hidden" name="act" value="edit">
												<button type="submit" class="btn-grad w3-button w3-blue w3-margin-bottom w3-round" style="margin-left: 161px;">UPDATE</button>

											</form>
										</div>
									</div>
								</div>

								<div id="idDelete<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
									<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
										<header class="w3-container ">
											<span onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'" class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
										</header>

										<div class="w3-container w3-padding">

											<form action="" method="post">
												<div class="w3-padding"></div>
												<b class="w3-large">Delete Confirmation</b>

												<hr class="w3-clear">

												Are you sure to delete this record?

												<div class="w3-padding-16"></div>

												<input type="hidden" name="id_user" value="<?PHP echo $data["id_user"]; ?>">
												<input type="hidden" name="act" value="del">
												<button type="button" onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'" class="w3-right w3-button w3-black w3-margin-bottom w3-round" style="margin-right: 180px;">NO</button>

												<button type="submit" class="w3-left w3-button w3-red w3-margin-bottom w3-round" style="margin-left: 150px;">YES</button>

											</form>
										</div>
									</div>
								</div>
							<?PHP } ?>
						</table>
					</div>


					<!-- End Grid -->
				</div>

				<!-- End Page Container -->
			</div>




		</div>
		<!-- container end -->


		<footer class="w3-container w3-padding-1 w3-center" style="background: white;margin-top: 446px;">
			<p>&copy; 2023 FK KIOSK. All rights reserved.</p>
		</footer>


	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="js/scripts.js"></script>
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