<?php
session_start();

include("../../config/database.php");
include("phpqrcode/qrlib.php");
// Include the QR code library

$id_user = (isset($_GET['id_user'])) ? intval($_GET['id_user']) : 0;

if ($id_user <= 0) {
    // Redirect or handle invalid user ID
    header("Location: a-user.php");
    exit();
}

$SQL_select = "SELECT * FROM `user` WHERE `id_user` = $id_user";
$result = mysqli_query($con, $SQL_select);

if (!$result) {
    // Handle the SQL error
    die("Error: " . mysqli_error($con));
}

if (mysqli_num_rows($result) == 0) {
    // Handle the case where no user is found with the given ID
    header("Location: a-user.php");
    exit();
}

$userData = mysqli_fetch_assoc($result);


$qrCodeData = "{$userData['id_user']},{$userData['role']},{$userData['name']},{$userData['phone']},{$userData['email']},{$userData['status']}";
$qrCodeFilename = "qrcodes/user_{$userData['id_user']}.png";
QRcode::png($qrCodeData, $qrCodeFilename, QR_ECLEVEL_L, 5);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../w3.css">

    <style>
        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-top: 20px;
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 20px rgba(0, 0, 255, 0.7);
            }

            50% {
                box-shadow: 0 0 30px rgba(0, 0, 255, 0.9);
            }

            100% {
                box-shadow: 0 0 20px rgba(0, 0, 255, 0.7);
            }
        }

        .glow-animation {
            animation: glow 3s infinite;
        }



        .btn-grad {
            background-image: linear-gradient(to right, #4776E6 0%, #8E54E9 51%, #4776E6 100%);
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
            width: auto;
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
    <div class="w3-container w3-content w3-xlarge" style="max-width: 800px; margin-top: 50px; background: white;">
        <div class="w3-card w1-round w2-white glow-animation" style="border-radius: 25px;">
            <div class="w3-container w1-padding" style="text-align: center;">
                <h1 style="text-align: center; "><b>PROFILE</b></h1>
                <img src="<?php echo $qrCodeFilename; ?>" alt="QR Code" style="max-width: 100%; height: auto;" class="glow-animation">
                <p> <b>User ID: </b> <?php echo $userData['id_user']; ?></p>
                <p> <b> Role: </b> <?php echo $userData['role']; ?></p>
                <p> <b>Name:</b> <?php echo $userData['name']; ?></p>
                <p> <b>Phone:</b> <?php echo $userData['phone']; ?></p>
                <p><b>Email:</b> <?php echo $userData['email']; ?></p>
                <p><b> Status: </b> <?php echo $userData['status']; ?></p>
                <button onclick="window.location.href='a-user.php'" class="btn-grad w3-button w3-block w3-padding-large w3-blue w3-margin-bottom w3-round" style="margin-left: auto; margin-right: auto;"><b>BACK</b></button>
            </div>
        </div>
    </div>
</body>

</html>
