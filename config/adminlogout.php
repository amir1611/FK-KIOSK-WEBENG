<?PHP
session_start();
session_destroy();
header("Location:../manageAccount/admin/admin.php");

?>