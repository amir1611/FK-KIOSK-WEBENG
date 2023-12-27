<!DOCTYPE html>
<html>
<title>Menu Page</title>
<meta charset="UTF-8">
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
        background-image: linear-gradient(to right, #DD5E89 0%, #F7BB97 51%, #DD5E89 100%);
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

<body>

    <div class="bgimg-1 w3-main"
        style="background-image: linear-gradient(to top, #fdcbf1 0%, #fdcbf1 1%, #e6dee9 100%);">

        <!-- navbar -->
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

        <div class=" w3-center w3-text-white w3-padding">
            <span class="w3-large"></span><br>
        </div>

        <div class="w3-container w3-center">
            
            <div class="w3-third w3-container w3-padding-16" id="contact">
                <div class="w3-white w3-card-4 w3-r" style="max-width:400px;">
                    <img src="./images/nasi_goreng_kampung.jpeg" style="width: 100%;" alt="nasi_goreng_kampung">
                    <div class="w3-padding-16 w3-container w3-center">
                        <p>Nasi Goreng Kampung</p>
                        <p>Price: 5.70 MYR</p>
                        <a href="#" class="w3-button w3-green">Add To Cart</a>
                    </div>
                </div>
            </div>
            <div class="w3-third w3-container w3-padding-16" id="contact">
                <div class="w3-white w3-card-4 w3-r" style="max-width:400px;">
                    <img src="./images/nasi_goreng_kampung.jpeg" style="width: 100%;" alt="nasi_goreng_kampung">
                    <div class="w3-padding-16 w3-container w3-center">
                        <p>Nasi Goreng Kampung</p>
                        <p>Price: 5.70 MYR</p>
                        <a href="#" class="w3-button w3-green">Add To Cart</a>
                    </div>
                </div>
            </div>
            <div class="w3-third w3-container w3-padding-16" id="contact">
                <div class="w3-white w3-card-4 w3-r" style="max-width:400px;">
                    <img src="./images/nasi_goreng_kampung.jpeg" style="width: 100%;" alt="nasi_goreng_kampung">
                    <div class="w3-padding-16 w3-container w3-center">
                        <p>Nasi Goreng Kampung</p>
                        <p>Price: 5.70 MYR</p>
                        <a href="#" class="w3-button w3-green">Add To Cart</a>
                    </div>
                </div>
            </div>
            <div class="w3-third w3-container w3-padding-16" id="contact">
                <div class="w3-white w3-card-4 w3-r" style="max-width:400px;">
                    <img src="./images/nasi_goreng_kampung.jpeg" style="width: 100%;" alt="nasi_goreng_kampung">
                    <div class="w3-padding-16 w3-container w3-center">
                        <p>Nasi Goreng Kampung</p>
                        <p>Price: 5.70 MYR</p>
                        <a href="#" class="w3-button w3-green">Add To Cart</a>
                    </div>
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