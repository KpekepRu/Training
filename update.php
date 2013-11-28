<?php
	$name = $_POST['Name'];
	$surname = $_POST['Surname'];
	$course = $_POST['Course'];
	$faculty = $_POST['Faculty'];
	$index = $_POST['Index'];

	$host = "localhost";
	$user = "root";
	$password = "";
	$dataBase = "mainbase";
	$mysqli = new mysqli($host, $user, $password, $dataBase);


	if ($_POST['add'] )
	{
		$res = $mysqli->query("SELECT COUNT(*) FROM `mainbase`.`my_info`");
		$row = $res->fetch_assoc();
		$index = $row['COUNT(*)']+1;
		$mysqli->query("INSERT INTO `mainbase`.`my_info` (`Index`, `Name`, `Surname`, `Course`, `Faculty`) VALUES ('$index','$name', '$surname', '$course', '$faculty')");
	}

	if ($_POST['edit'] AND $name AND $surname AND $course AND $faculty AND $index)
	{
		$mysqli->query("UPDATE `mainbase`.`my_info` SET `Name`='$name', `Surname`='$surname', `Course`='$course', `Faculty`='$faculty' WHERE `Index`='$index'");
	}

	if ($_POST['delete'] AND $index)
	{
		$mysqli->query("DELETE FROM `mainbase`.`my_info` WHERE `Index`='$index'");
		$mysqli->query("UPDATE `mainbase`.`my_info` SET `Index`= `Index`-1 WHERE `Index`>'$index'");
	}
	echo '<script type="text/javascript">
	window.location = "index.php"
	</script>';

?>
