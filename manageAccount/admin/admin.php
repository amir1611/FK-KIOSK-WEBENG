<?PHP
session_start();
?>
<?PHP
include("../../config/database.php");
$act = (isset($_POST['act'])) ? trim($_POST['act']) : '';

$error = "";

if ($act == "login") {
	$username 	= (isset($_POST['username'])) ? trim($_POST['username']) : '';
	$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';


	$SQL_login = " SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'  ";

	$result = mysqli_query($con, $SQL_login);
	$data	= mysqli_fetch_array($result);

	$valid = mysqli_num_rows($result);

	if ($valid > 0) {
		$_SESSION["password"] = $password;
		$_SESSION["username"] = $username;

		header("Location:a-main.php");
	} else {
		$error = "Invalid";
		header("refresh:1;url=admin.php");
		//print "<script>alert('Login tidak sah!'); self.location='index.php';</script>";
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
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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
		background-image: url(images/banner.jpg);
		min-height: 100%;
	}

	.w3-bar .w3-button {
		padding: 16px;
	}

         
	.btn-grad {
            background-image: linear-gradient(to right, #DD5E89 0%, #F7BB97  51%, #DD5E89  100%);
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

<body>

<div class="bgimg-1" style="background-image: linear-gradient(to top, #fdcbf1 0%, #fdcbf1 1%, #e6dee9 100%);">

		<div class="w3-padding-32"></div>

		<div class=" w3-center w3-text-white w3-padding">
			<span class="w3-large"></span><br>
		</div>


		<div class="w3-container w3-padding-16" id="contact">
			<div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px; border-radius: 20px;">
				<div class="w3-padding">
					<form action="" method="post">
						<div class="w3-center" style="pointer-events: none;"> <img src="../../images/logo.png" class="w3-image"></div>
						<hr>

						<?PHP if ($error) { ?>
							<div class="w3-container w3-padding-32" id="contact">
								<div class="w3-content w3-container w3-red w3-round w3-card" style="max-width:600px">
									<div class="w3-padding w3-center">
										<h3>Error! Invalid login</h3>
										<p>Please try again...</p>
									</div>
								</div>
							</div>
						<?PHP } ?>


						<div class="w3-section">
						<label><b>Username </b> <span style="color: red;">*</span></label>
							<input class="w3-input w3-border w3-round" type="text" name="username" required>
						</div>
						<div class="w3-section">
						<label><b>Password  </b> <span style="color: red;">*</span></label>

							<input class="w3-input w3-border w3-round" type="password" name="password" required>
						</div>

						<input name="act" type="hidden" value="login">
						<button type="submit" class="btn-grad w3-button w3-block w3-padding-large w3-blue w3-margin-bottom w3-round"><b>LOGIN</b></button>
					</form>

					<div class="w3-center w3-padding"><a href="../user/index.php" class="w3-text-blue">Login as User</a></div>

				</div>

			</div>
		</div>

		<footer class="w3-container w3-padding-1 w3-center" style="background: white;margin-top: 238px;">
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