<?php
    $msg = '';
            
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
				
        if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = 'admin';
            header("Location: ../../upload.html?loginSuccess");
        }else {
			header("Location: ../../login.html?invalidCredentials");
        }
    }
?>