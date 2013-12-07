<?php
      require_once 'Twig/Autoloader.php';
      Twig_Autoloader::register();

      try 
      {
            $loader = new Twig_Loader_Filesystem('templates');
            $twig = new Twig_Environment($loader);
            $template = $twig->loadTemplate('MainTemplate.tmpl');

            $host = "localhost";
            $user = "root";
            $password = "";
            $dataBase = "mainbase";
            $mysqli = new mysqli($host, $user, $password, $dataBase);
            $result = $mysqli->query("SELECT * FROM my_info");

            while ($row = $result->fetch_assoc())
            {
                  $record[] = $row;
            }

            echo $template->render(array(
                  'record' => $record
            ));

      }
      catch (Exception $e) 
      {
            die ('ERROR: ' . $e->getMessage());
      }
?>
