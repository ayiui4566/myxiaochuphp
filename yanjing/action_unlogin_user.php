<?php
session_start();
unset($_SESSION['adminLogin']);
echo "<script>";
echo "window.parent.location.href ='index.php';";
echo "</script>";

?>
