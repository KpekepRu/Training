<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>The Best Table!</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<div id="container">
		<div class="header">
			<div id="titleBlock">
				<h1 align="center">Добро пожаловать!</h1>
			</div>
		</div>
		<div id="content">
                  <div id="form_block">
                        <div class="form_header" align="center">
                               <h3> <b> Панель управления </b> </h3>
                        </div>
      			<form method='post' action="update.php">
      				Имя:      <div class="field"><input type="text" name="Name">        </div> <br/>
      				Фамилия:  <div class="field"><input type="text" name="Surname">     </div> <br/>
      				Курс:     <div class="field"><input type="integer" name="Course">   </div> <br/>
      				Факультет:<div class="field"><input type="text" name="Faculty">     </div> <br/>
                              Номер:   <div class="field"><input type="integer" name="Index">    </div> <br/>
      				<input type = "submit" name = "add" value = "Добавить студента">           <br/>
                              <input type = "submit" name = "edit" value = "Изменить данные о студенте"> <br/>
                              <input type = "submit" name = "delete" value = "Удалить студента">         <br/>
      			</form>
                        <div class="signature" onmousedown=>
                        Нужна помощь?
                        </div>
                  </div>
                  <div id="table_block">
                        <div class="form_header">
                               <b> Данные о студентах </b> 
                        </div>
      			<?php
      				$host = "localhost";
      				$user = "root";
      				$password = "";
      				$dataBase = "mainbase";
      				$mysqli = new mysqli($host, $user, $password, $dataBase);
      				$result = $mysqli->query("SELECT * FROM my_info");
      				
      			
      			
      				echo '<table>
      				<table width = "100%" >
                                    <thead>
                                          <tr>
                                          <th></th>
      						<th>Name</th>
      						<th>Surname</th>
      						<th>Course</th>
      						<th>Faculty</th>
                                          </tr>
                                    </thead>
                                    <tbody>';
                              while ($row = $result->fetch_assoc())
                                    echo "<tr>
                                          <td>" . $row['Index']   . "</td>
                                          <td>" . $row['Name']    . "</td>
                                          <td>" . $row['Surname'] . "</td>
                                          <td>" . $row['Course']  . "</td>
                                          <td>" . $row['Faculty'] . "</td>
                                          </tr>";
                              echo '</tbody>
                                    </table>';
      				
      			?>
                  </div>
		</div>
	</div>
</body>
</html>
