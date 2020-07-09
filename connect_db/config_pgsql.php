<?php


try {
   $pdo_pgsql = new PDO("pgsql:host=10.22.75.96;port=5432;dbname=sgo1;user=marcio.nunes;password=Dados@2020");
   global $pdo_pgsql;
   } catch (PDOException $th) {
      echo "Connection failed pgsql - ";
      echo $th->getMessage();
      
   }



?>