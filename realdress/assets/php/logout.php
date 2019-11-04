<?php
	session_start();
	unset($_SESSION["username"]);
	unset($_SESSION["password"]);
	unset($_SESSION["loggedin"]);
	header("Location: ../../login.html?loggedOut");
?>