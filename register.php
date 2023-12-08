<?PHP

include("database.php");
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

if($act == "register")
{
	$found 	= numRows($con, "SELECT * FROM `user` WHERE `email` = '$email' ");
	if($found) $error ="Email already registered";
}

if(($act == "register") && (!$error))
{	
	if ($role == "user") $status = "Approved";
	
	$SQL_insert = " 
	INSERT INTO `user`(`id_user`, `role`, `name`, `phone`, `email`, `password`, `document`, `status`) 
				VALUES (NULL, '$role', '$name', '$phone', '$email', '$password', '', '$status')
	";	

	$result = mysqli_query($con, $SQL_insert) or die("Error in query: ".$SQL_insert."<br />".mysqli_error($con));
	
	$id_user = mysqli_insert_id($con);
	
	// -------- Document  -----------------
	if(isset($_FILES['document'])){
		 
		if($_FILES["document"]["error"] == 4) {
				//means there is no file uploaded
		} else {

			$file_name = $_FILES['document']['name'];
			$file_size = $_FILES['document']['size'];
			$file_tmp = $_FILES['document']['tmp_name'];
			$file_type = $_FILES['document']['type'];
			
			$fileNameCmps = explode(".", $file_name);
			$file_ext = strtolower(end($fileNameCmps));

			$extensions= array("pdf","doc","jpg","png");

			if(in_array($file_ext,$extensions)=== false){
				$errors="extension not allowed, please choose a PDF, DOC, JPG, PNG";
			}

			if($file_size > 12097152) {
				$errors='File size must be smaller than 12 MB';
			}

			if(empty($errors)==true) {
				move_uploaded_file($file_tmp,"upload/".$file_name);
				
				$query = "UPDATE `user` SET `document`='$file_name' WHERE `id_user` = '$id_user'";			
				$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
			}else{
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
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

body, html {
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
  background-attachment:fixed;
  min-height: 100%;
  background-image: url(images/banner.jpg);
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="bgimg-1" >

<?PHP include("menu.php"); ?>

<div >

	<div class="w3-padding-32"></div>
		
<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px">
		<div class="w3-padding">

<?PHP if($success) { ?>
<div class="w3-panel w3-green w3-display-container w3-animate-zoom">
  <span onclick="this.parentElement.style.display='none'"
  class="w3-button w3-large w3-display-topright">&times;</span>
  <h3>Success!</h3>
  <p>Your registration was successful!</p>
  <?PHP if($role == "vendor") echo "Waiting for admin approval";?>
</div>
<?PHP  } ?>

<?PHP if($error) { ?>
<div class="w3-panel w3-red w3-display-container w3-animate-zoom">
  <span onclick="this.parentElement.style.display='none'"
  class="w3-button w3-large w3-display-topright">&times;</span>
  <h3>Error!</h3>
  <p><?PHP echo $error;?></p>
</div>
<?PHP  } ?>

<?PHP if(!$success) { ?>	
		
			<form method="post" action="" enctype = "multipart/form-data" >
			<div class="w3-center"><img src="images/logo.png" class="w3-image"></div>
			<hr>
			<h3><b>Registration</b></h3>
			
				<div class="w3-section">
					<label>Role *</label>
					<select class="w3-input w3-border w3-round" name="role" required>
						<option value="user">User</option>
						<option value="vendor">Vendor</option>
					</select>
				</div>
				
				<div class="w3-section" >
					<label>Full Name *</label>
					<input class="w3-input w3-border w3-round" type="text" name="name"  required>
				</div>
			  
				<div class="w3-section" >
					<label>Contact *</label>
					<input class="w3-input w3-border w3-round" type="text" name="phone"  required>
				</div>
				
				<div class="w3-section" >
					<label>Email *</label>
					<input class="w3-input w3-border w3-round" type="email" name="email"  required>
				</div>			  
			  
				<div class="w3-section">
					<label>Password *</label>
					<input class="w3-input w3-border w3-round" type="password" name="password" required>
				</div>
			  
				<div class="w3-section" >
					<label>Matric Card (User)  @ Business Proposal (Vendor) </label>
					<div class="custom-file">
						<input type="file" class="w3-input w3-border w3-round" name="document" id="document" accept=".pdf, .doc, .jpg,.png">
						<small>  only PDF, DOC, JPG or PNG allowed </small>
					</div>
				</div>
			  
			  <input type="hidden" name="act" value="register">
			  <button type="submit" class="w3-button w3-block w3-padding-large w3-blue w3-margin-bottom w3-round"><b>SUBMIT</b></button>
			</form>
			
<?PHP } ?>
			<div class="w3-center">Already registered? <a href="index.php" class="w3-text-blue">Login here</a></div>
		</div>
    </div>
</div>



	
</div>

	
<?PHP //include("footer.php"); ?>
 
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
