<?PHP

date_default_timezone_set('Asia/Kuala_Lumpur');


//localhost
$dbHost = "localhost";	// Database host
$dbName = "fkkiosk";	// Database name


$dbUser = "root";		// Change according to your phpMyAdmin Username
$dbPass = "1234";		//  Change according to your phpMyAdmin Password

$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);


function verifyAdmin($con)
{
	if ($_SESSION['username'] && $_SESSION['password']) {
		$result = mysqli_query($con, "SELECT  `username`, `password` FROM `admin` WHERE `username`='$_SESSION[username]' AND `password`='$_SESSION[password]' ");

		if (mysqli_num_rows($result) == 1)
			return true;
	}
	return false;
}

function verifyUser($con)
{
	if ($_SESSION['email'] && $_SESSION['password']) {
		$result = mysqli_query($con, "SELECT  `email`, `password` FROM `user` WHERE `email`='$_SESSION[email]' AND `password`='$_SESSION[password]' ");

		if (mysqli_num_rows($result) == 1)
			return true;
	}
	return false;
}


function numRows($con, $query)
{
	$result  = mysqli_query($con, $query);
	$rowcount = mysqli_num_rows($result);
	return $rowcount;
}

function Notify($status, $alert, $redirect)
{
	$color = ($status == "success") ? "w3-green" : "w3-red";

	echo '<div class="' . $color . ' w3-top w3-card w3-padding-24" style="z-index=999">
			<span onclick="this.parentElement.style.display=\'none\'" class="w3-button w3-large w3-display-topright">&times;</span>
				<div class="w3-padding w3-center">
				<div class="w3-large">' . $alert . '</div>
				</div>
			</div>';
	if ($_SERVER['HTTP_HOST'] == "localhost")
		header("refresh:1;url=$redirect");
	else
		print "<script>self.location='$redirect';</script>";
}
