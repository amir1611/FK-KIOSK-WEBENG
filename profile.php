<?PHP
session_start();

include("database.php");
if( !verifyUser($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP
$id_user	= $_SESSION["id_user"];
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$password	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$success = "";

if($act == "edit")
{	
	$SQL_update = " 
	UPDATE
		`user`
	SET
		`name` = '$name',
		`email` = '$email',
		`phone` = '$phone',
		`password` = '$password'
	WHERE
		`id_user`='$id_user' 
		";
	
	$result = mysqli_query($con, $SQL_update);

	$success = "Successfully Update";
	//print "<script>self.location='a-profile.php';</script>";
}

$SQL_list = "SELECT * FROM `user` WHERE `id_user` = '$id_user' ";
$result = mysqli_query($con, $SQL_list) ;
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
a {text-decoration: none;}
html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif}
.w3-bar-block .w3-bar-item {padding: 16px}.w3-biru {background-color:#f6f9ff;}
</style>
</head>
<body class="w3-biru">

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "profile.php"); }
?>	

<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-blue w3-card" style="z-index:3;width:250px;" id="mySidebar">
	<a href="main.php" class="w3-bar-item w3-large"><img src="images/logo.png" class="w3-padding" style="width:100%;"></a>
	<a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" 
	class="w3-bar-item w3-button w3-hide-large w3-large">Close <i class="fa fa-remove"></i></a>

	<a href="main.php" class="w3-bar-item w3-button">
	<i class="fa fa-fw fa-tachometer-alt w3-margin-right"></i> DASHBOARD</a>
	
	<a href="profile.php" class="w3-bar-item w3-button w3-pale-blue">
	<i class="fa fa-fw fa-user w3-margin-right"></i> PROFILE</a>
	
	<div class="w3-bar-item w3-bottom w3-small">ver1.0</div>
</nav>



<!-- Overlay effect when opening the side navigation on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

<!-- Page content -->
<div class="w3-main" style="margin-left:250px;">



<div class="w3-white w3-bar w3-card ">


	<i class="fa fa-bars w3-buttonx w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>

	
	<div class="w3-large w3-buttonx w3-bar-item w3-right w3-white w3-dropdown-hover">
      <button class="w3-button"><i class="fa fa-fw fa-user-circle"></i> User <i class="fa fa-fw fa-chevron-down w3-small"></i></button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="profile.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-user-cog "></i> Profile</a>
        <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-sign-out-alt "></i> Signout</a>
      </div>
    </div>

</div>

<div class="w3-padding-32"></div>
	
<div class="w3-container">

	<!-- Page Container -->
	<div class="w3-container w3-white w3-content w3-card w3-padding-16" style="max-width:600px;">    
	  <!-- The Grid -->
	  <div class="w3-row w3-padding">
	  
		<form action="" method="post" >
			<div class="w3-padding">
			<b class="w3-large">Profile</b>
			<hr>
		
				<div class="w3-section" >
					<label>Full Name *</label>
					<input class="w3-input w3-border w3-round" type="text" name="name" value="<?PHP echo $data["name"];?>" required>
				</div>
			  
				<div class="w3-section" >
					<label>Contact *</label>
					<input class="w3-input w3-border w3-round" type="text" name="phone" value="<?PHP echo $data["phone"];?>"  required>
				</div>
				
				<div class="w3-section" >
					<label>Email *</label>
					<input class="w3-input w3-border w3-round" type="email" name="email" value="<?PHP echo $data["email"];?>"  required>
				</div>			  
			  
				<div class="w3-section">
					<label>Password *</label>
					<input class="w3-input w3-border w3-round" type="password" name="password" value="<?PHP echo $data["password"];?>" required>
				</div>
			    
			<hr class="w3-clear">
			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-button w3-blue w3-margin-bottom w3-round">UPDATE</button>
			
			</div>  
		</form>

		
	  <!-- End Grid -->
	  </div>
	  
	<!-- End Page Container -->
	</div>
	
	
	

</div>
<!-- container end -->


<div class="w3-padding-24"></div>

     
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
