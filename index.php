<?php
      require_once 'Twig/Autoloader.php';
      Twig_Autoloader::register();

      session_start();

      try 
      {
            $loader = new Twig_Loader_Filesystem('templates');
            $twig = new Twig_Environment($loader);
            $template = $twig->loadTemplate('MainTemplate.tmpl');

            $host = "127.0.0.1";
            $user = "User";
            $password = "123";
            $dataBase = "mainbase";
            $mysqli = new mysqli($host, $user, $password, $dataBase);
            $result = $mysqli->query("SELECT * FROM my_info");

            if  ($_SESSION['autho']) $autho = true;
            else $autho = false;    
            $username = $_SESSION['username'];

            while ($row = $result->fetch_assoc())
            {
                  $record[] = $row;
            }

            echo $template->render(array(
                  'username' => $username,
                  'autho' => $autho,
                  'record' => $record
            ));



      }
      catch (Exception $e) 
      {
            die ('ERROR: ' . $e->getMessage());
      }
?>
