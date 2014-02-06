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

            $empty = true;

            $username = $_SESSION['username'];

            while ($row = $result->fetch_assoc())
            {
                  $record[] = $row;
            }

            if ($_SESSION['words'])
            {     
                 $empty = false;
                 $words = $_SESSION['words'];
            }
            else $words = "Пусто...";

            echo $template->render(array(
                  'empty' => $empty,
                  'username' => $username,
                  'autho' => $autho,
                  'record' => $record,
                  'words' => $words
            ));


      }
      catch (Exception $e) 
      {
            die ('ERROR: ' . $e->getMessage());
      }
?>
