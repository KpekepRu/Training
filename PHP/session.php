<?php
	session_start();

	if ($_POST['enter'])
	{
		$host = "127.0.0.1";
        $user = "root";
        $password = "";
        $dataBase = "mainbase";

        $login = $_POST['Login'];
		$pass = $_POST['Pass'];

        $mysqli = new mysqli($host, $user, $password, $dataBase);
        $result = $mysqli->query("SELECT * FROM `users` WHERE `Login` LIKE '$login' AND `Password` LIKE '$pass'");
        $row = $result->fetch_assoc();
        if ($row)
		{
			$_SESSION['autho'] = true;
			$_SESSION['username'] = $login;
		}
		
	}

	if ($_POST['exit'])
	{
		session_destroy();
	}
?>