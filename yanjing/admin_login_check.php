<?php
 session_start();

 if(!$_SESSION['adminLogin']){
	echo "<script>";
	echo "location.href='login.html';";
	echo "</script>";
 }
?>
