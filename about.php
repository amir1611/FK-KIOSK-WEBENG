<?PHP
session_start();
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

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  min-height: 100%;
  background-attachment:fixed;
  background-image: url(images/banner.jpg);
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<?PHP include("menu.php"); ?>


<div class="bgimg-1" >

	<div class="w3-padding-48"></div>
	
<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:800px">
		<div class="w3-padding">

			<h3>Who are we?</h3>
			<p>
			
			<img src="images/logo.png" class="w3-image w3-padding" >
			
			<p><b>FK-KIOSK</b>. Lorem ipsum dolor sit amet. Et eaque velit eum dolor inventore id laborum veritatis. Qui officia consectetur est maxime provident eum voluptatum quia est similique vero sit odit quaerat et blanditiis iure.</p>

			<p>Ex dignissimos excepturi rem voluptas aperiam sed quos consequatur eum ipsam sunt. Non voluptatem quibusdam est galisum fuga ut repellendus delectus rem veniam culpa est mollitia ipsum est ullam totam a voluptatem quia!</p>

			<p>Et odit odit eos veritatis optio non reiciendis internos et fugit quia. In rerum beatae et maiores quisquam et earum neque. Non suscipit tempore in commodi sunt ut officiis aliquam!</p>

		</div>
		<div class="w3-padding-16"></div>
    </div>
</div>


<div class="w3-padding-16"></div>
	
</div>

	
 
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
