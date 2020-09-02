<?php

require "../connect_db/config_pgsql.php";

$sql = "SELECT count(*) as total FROM vs_corretivo_bd_v2";
$sql = $pdo_pgsql->prepare($sql);
$sql->execute();
if ($sql->rowCount()>0) {
   $result = $sql->fetch();
   echo $result['total'];
} else {
   $result = 0;
   echo $result;
}
?>