<?PHP

include("../../config/database.php");
$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';
$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$role 		= (isset($_POST['role'])) ? trim($_POST['role']) : '';
$phone 		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$email 		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$name	=	mysqli_real_escape_string($con, $name);

$found = 0;
$error = "";
$status = "Pending";
$success = false;

if ($act == "register") {
	$found 	= numRows($con, "SELECT * FROM `user` WHERE `email` = '$email' ");
	if ($found) $error = "Email already registered";
}

if (($act == "register") && (!$error)) {
	if ($role == "user") $status = "Approved";

	$SQL_insert = " 
	INSERT INTO `user`(`id_user`, `role`, `name`, `phone`, `email`, `password`, `document`, `status`) 
				VALUES (NULL, '$role', '$name', '$phone', '$email', '$password', '', '$status')
	";

	$result = mysqli_query($con, $SQL_insert) or die("Error in query: " . $SQL_insert . "<br />" . mysqli_error($con));

	$id_user = mysqli_insert_id($con);

	// -------- Document  -----------------
	if (isset($_FILES['document'])) {

		if ($_FILES["document"]["error"] == 4) {
			//means there is no file uploaded
		} else {

			$file_name = $_FILES['document']['name'];
			$file_size = $_FILES['document']['size'];
			$file_tmp = $_FILES['document']['tmp_name'];
			$file_type = $_FILES['document']['type'];

			$fileNameCmps = explode(".", $file_name);
			$file_ext = strtolower(end($fileNameCmps));

			$extensions = array("pdf", "doc", "jpg", "png");

			if (in_array($file_ext, $extensions) === false) {
				$errors = "extension not allowed, please choose a PDF, DOC, JPG, PNG";
			}

			if ($file_size > 12097152) {
				$errors = 'File size must be smaller than 12 MB';
			}

			if (empty($errors) == true) {
				move_uploaded_file($file_tmp, "../../upload/" . $file_name);

				$query = "UPDATE `user` SET `document`='$file_name' WHERE `id_user` = '$id_user'";
				$result = mysqli_query($con, $query) or die("Error in query: " . $query . "<br />" . mysqli_error($con));
			} else {
				print_r($errors);
			}
		}
	}
	// -------- End Lampiran -----------------

	$success = true;
}
?>
<!DOCTYPE html>
<html>
<title>FKKIOSK</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	body,
	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		font-family: "Poppins", sans-serif
	}

	body,
	html {
		height: 100%;
		line-height: 1.8;
	}

	a:link {
		text-decoration: none;
	}

	/* Full height image header */
	.bgimg-1 {
		background-position: top;
		background-size: cover;
		background-attachment: fixed;
		min-height: 100%;
		background-image: url(images/banner.jpg);
	}

	.w3-bar .w3-button {
		padding: 16px;
	}

	/* Style for the info icon */
	.info-icon {
		font-size: 16px;
		margin-left: 5px;
		cursor: help;
	}

	/* Style for the tooltip */
	.tooltip {
		position: relative;
		display: inline-block;
	}

	.tooltip .tooltiptext {
		visibility: hidden;
		width: 300px;
		background-color: #333;
		color: #fff;
		text-align: left;
		border-radius: 5px;
		padding: 5px;
		position: absolute;
		z-index: 1;
		top: 125%;
		left: 50%;
		margin-left: -100px;
		opacity: 0;
		transition: opacity 0.3s;
	}

	.tooltip:hover .tooltiptext {
		visibility: visible;
		opacity: 1;
	}



	.btn-grad {
		background-image: linear-gradient(to right, #16A085 0%, #F4D03F 51%, #16A085 100%);
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
		background-position: right center;
		/* change the direction of the change here */
		color: #fff;
		text-decoration: none;
	}
</style>

<body class="bgimg-1" style="background-image: linear-gradient(60deg, #abecd6 0%, #fbed96 100%);">

	<?PHP include("menu.php"); ?>

	<div>

		<div class="w3-padding-32"></div>

		<div class="w3-container w3-padding-16" id="contact">
			<div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px; border-radius: 20px;">
				<div class="w3-padding">

					<?PHP if ($success) { ?>
						<div class="w3-panel w3-green w3-display-container w3-animate-zoom" style="width:451px ;">
							<span onclick="this.parentElement.style.display='none'" class="w3-button w3-large w3-display-topright">&times;</span>
							<h3>Your registration was successful!</h3>
							<?PHP if ($role == "vendor") echo "Waiting for admin approval"; ?>
						</div>
					<?PHP  } ?>

					<?PHP if ($error) { ?>
						<div class="w3-panel w3-red w3-display-container w3-animate-zoom">
							<span onclick="this.parentElement.style.display='none'" class="w3-button w3-large w3-display-topright">&times;</span>
							<h3>Error!</h3>
							<p><?PHP echo $error; ?></p>
						</div>
					<?PHP  } ?>

					<?PHP if (!$success) { ?>

						<form method="post" action="" enctype="multipart/form-data">
							<div class="w3-center" style="pointer-events: none;"><img src="../../images/logo.png" class="w3-image"></div>
							<hr>

							<div class="w3-section">
								<label><strong>Role</strong> <span style="color: red;">*</span></label>

								<select class="w3-input w3-border w3-round" name="role" required>
									<option value="user">User</option>
									<option value="vendor">Vendor</option>
								</select>
							</div>

							<div class="w3-section">
								<label><strong>Full Name</strong> <span style="color: red;">*</span></label>

								<input class="w3-input w3-border w3-round" type="text" name="name" required>
							</div>

							<div class="w3-section">
								<label><strong>Contact</strong> <span style="color: red;">*</span></label>

								<input class="w3-input w3-border w3-round" type="text" name="phone" required>
							</div>

							<div class="w3-section">
								<label><strong>Email</strong> <span style="color: red;">*</span></label>

								<input class="w3-input w3-border w3-round" type="email" name="email" required>
							</div>

							<div class="w3-section">
								<label><strong>Password</strong> <span style="color: red;">*</span></label>

								<input class="w3-input w3-border w3-round" type="password" name="password" required>
							</div>

							<div class="w3-section">
								<label>
									<b style="color: black;">Upload File</b>
									<span style="color: red;">*</span>
									<div class="tooltip">
										<i class="fa fa-info-circle info-icon" title="Matric Card for User OR Business Proposal for Vendor. Only PDF, DOC, JPG, or PNG allowed"></i>
										<div class="tooltiptext">
											<p>- Matric Card for <b>User</b></p>
											<p>- Business Proposal for <b>Vendor</b></p>
											<p>- Only PDF, DOC, JPG or PNG allowed</p>
										</div>
									</div>
								</label>

								<div class="custom-file">
									<input type="file" class="w3-input w3-border w3-round" name="document" id="document" accept=".pdf, .doc, .jpg, .png">
								</div>

								<br>

								<input type="hidden" name="act" value="register">
								<button type="submit" class="btn-grad w3-button w3-block w3-padding-large w3-blue w3-margin-bottom w3-round"><b>REGISTER</b></button>
						</form>

					<?PHP } ?>
					<div class="w3-center">Already registered? <a href="index.php" class="w3-text-blue">Login here</a></div>
				</div>
			</div>
		</div>

		<br>
		<br>


		<footer class="w3-container w3-padding-1 w3-center" style="background: white;margin: -27px;">
			<p>&copy; 2023 FK KIOSK. All rights reserved.</p>
		</footer>


		<?PHP //include("footer.php"); 
		?>

		<script>
			// Toggle between showing and hiding the sidebar when clicking the menu icon
			var mySidebar = document.getElementById("mySidebar");

			function w3_open() {
				if (mySidebar.style.display === 'block') {
					mySidebar.style.display = 'none';
				} else {
					mySidebar.style.display = 'block';
				}
			}

			// Close the sidebar with the close button
			function w3_close() {
				mySidebar.style.display = "none";
			}
		</script>

</body>

</html>