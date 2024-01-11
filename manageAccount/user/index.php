<?PHP
session_start();
include("../../config/database.php");
$act = (isset($_POST['act'])) ? trim($_POST['act']) : '';

$error = "";
// Construct a URL for localhost
$localhost = "http://" . $_SERVER['HTTP_HOST'];

if ($act == "login") {
	$email 		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
	$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';
	$role 		= (isset($_POST['role'])) ? trim($_POST['role']) : '';

	$SQL_login = " SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'  ";
	$result = mysqli_query($con, $SQL_login);
	$data	= mysqli_fetch_array($result);
	$valid = mysqli_num_rows($result);

	if ($valid > 0) {
		$_SESSION["email"] 		= $email;
		$_SESSION["password"] 	= $password;
		$_SESSION["id_user"] 	= $data["id_user"];
		$id_user = $data["id_user"];
		$_SESSION["role"] 		= $data["role"];

		if($data["role"] == "user"){

			header("Location:main.php");
		}
		else{
			if($data["status"] == "Approved"){

				header("Location:main.php");
			}
			else {
				$error = "Pending Approval";
				header("refresh:1;url=index.php");
			}
		}
		if($data["role"] == "vendor"){

			$vendor_sql = " SELECT * FROM `kiosk` WHERE `id_user` = '$id_user' ";
			$result = mysqli_query($con, $vendor_sql);
			$data_vendor	= mysqli_fetch_array($result);

			$_SESSION['id_kiosk'] = $data_vendor['id_kiosk'];
			header("Location: $localhost/manageMenu/dashboard.php");
		}

	} else {
		$error = "Invalid";
		header("refresh:1;url=index.php");
		//print "<script>alert('Invalid Login!'); self.location='index.php';</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<title>FKKIOSK</title>
<meta charset="UTF-8">
<link rel="icon" type="image/x-icon" href="/images/icon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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

	.btn-grad {
		background-image: linear-gradient(to right, #7474BF 0%, #348AC7 51%, #7474BF 100%);
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



	.w3-bar .w3-button {
		padding: 12px;
	}
</style>

<body class="bgimg-1" style="background-color: #8EC5FC;
background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
">

	<?PHP include("menu.php"); ?>

	<div>

		<div class="w3-padding-48"></div>

		<div class="w3-container w3-padding-16" id="contact">
			<div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px; border-radius:20px">
				<div class="w3-padding">
					<form action="" method="post">
						<div class="w3-center" style="pointer-events: none;"><img src="../../images/logo.png" class="w3-image"></div>
						<hr>


						<?PHP if ($error) { ?>
							<div class="w3-container w3-padding-32" id="contact">
								<div class="w3-content w3-container w3-red w3-round w3-card" style="max-width:600px">
									<div class="w3-padding w3-center">
										<h3>Error! <?PHP echo $error; ?></h3>
										<p>Please try again...</p>
									</div>
								</div>
							</div>
						<?PHP } ?>


						<div class="w3-section">
							<label><b>Email</b> <span style="color: red;">*</span></label>

							<input class="w3-input w3-border w3-round" type="email" name="email" required>
						</div>
						<div class="w3-section">
							<label> <b>Password</b> <span style="color: red;">*</span></label>

							<input class="w3-input w3-border w3-round" type="password" name="password" required>
						</div>
						<div class="w3-section">
							<label> <b> Role </b> <span style="color: red;">*</span></label>

							<select class="w3-input w3-border w3-round" name="role" required>
								<option value="user">User</option>
								<option value="vendor">Vendor</option>
							</select>
						</div>

						<input name="act" type="hidden" value="login">
						<button type="submit" class="btn-grad w3-button w3-block w3-padding-large w3-blue w3-margin-bottom w3-round"><b>LOGIN</b></button>
					</form>

					<div class="w3-center w3-padding">Don’t have an account? <a href="register.php" class="w3-text-blue">Sign Up</a></div>
					<div class="w3-center w3-padding">Login as Guest? <a href="guest_main.php" class="w3-text-blue">Guest Login</a></div>
				</div>



			</div>
		</div>

		<footer class="w3-container w3-padding-1 w3-center" style="background: white;margin-top: 131px;">
			<p>&copy; 2023 FK KIOSK. All rights reserved.</p>
		</footer>



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