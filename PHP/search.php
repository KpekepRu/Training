<?php
	
  session_start();    
  
  $host = "127.0.0.1";
  $user = "User";
  $password = "123";
  $dataBase = "mainbase";
  $mysqli = new mysqli($host, $user, $password, $dataBase);

  $alpha = "абвгдежзийклмнопрстуфхцчшщьыъэюя";
  $sql = "SELECT word FROM `words` WHERE";
  
  if ($_POST['search'])
  {
    $letters = $_POST['word'];

    if ($letters == "Поиск") $letters = '';
    $i = strlen($letters);

    while ($i)
    {
      $i -= 2;
      $let = substr($letters, $i, 2);
      for ($t=0; $t<64; $t+=2)
      {
        $let2 = substr($alpha, $t, 2);
        if ($let == $let2) {$letter[$t/2+1]++; break;}
      }
    }

    for ($t=0; $t<64; $t+=2)
    {
      $let = substr($alpha, $t, 2);
      $sql = $sql." word NOT LIKE '%".$let."%";
      while ($letter[$t/2+1])
      {
        $letter[$t/2+1]--; 
        $sql = $sql.$let."%";
      }
      if ($t != 62)
      $sql = $sql."' AND";
    }
    $sql = $sql."' ORDER BY length DESC";
        
    $result = $mysqli->query($sql);
    array_splice($_SESSION['words'], 0);
    while ($row = $result->fetch_assoc())
      $_SESSION['words'][] = $row;
  }

?>