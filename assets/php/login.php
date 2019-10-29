<?php
session_start();
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
				
        if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
			session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = 'admin';
            header("Location: ../../upload.html?loginSuccess");
        } else if (isset($_POST['logout']) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){	
		unset($_SESSION["username"]);
		unset($_SESSION["password"]);
		header("Location: ../../login.html?loggedOut");
		} else {
			header("Location: ../../login.html?invalidCredentials");
        }
    }
?>