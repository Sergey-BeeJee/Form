<?php 
	//script logout
	require 'data/db.php'; //connection database
	unset($_SESSION['logged_user']);//clear session
	header('Location: ../index.php');//redirect on main page
?>