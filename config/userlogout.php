<?PHP
session_start();
session_destroy();
header("Location:../manageAccount/user/index.php");

?>