<?php
	session_start();

	if ($_POST['enter'])
	{
		$host = "127.0.0.1";
        $user = "root";
        $password = "";
        $dataBase = "mainbase";

        $return = false;

        $login = $_POST['Login'];
		$pass = $_POST['Pass'];

        $mysqli = new mysqli($host, $user, $password, $dataBase);
        $result = $mysqli->query("SELECT * FROM `users` WHERE `Login` LIKE '$login' AND `Password` LIKE '$pass'");
        $row = $result->fetch_assoc();
        if ($row)
		{
			$_SESSION['autho'] = true;
			$_SESSION['username'] = $login;
			$return = true;
		}
		echo json_encode($return);
	}

	if ($_POST['rega'])
	{
		$return = false;
		if ($_POST['Login'] AND $_POST['Pass'])
		{
			$host = "127.0.0.1";
        	$user = "root";
        	$password = "";
        	$dataBase = "mainbase";
			$mysqli = new mysqli($host, $user, $password, $dataBase);

        	$login = $_POST['Login'];
			$pass = $_POST['Pass'];

			$return = true;

        	$mysqli->query("INSERT INTO `mainbase`.`users` (`Login`, `Password`) VALUES ('$login','$pass')");
        }
		echo json_encode($return);
	}

	if ($_POST['exit'])
	{
		session_destroy();
	}
?>