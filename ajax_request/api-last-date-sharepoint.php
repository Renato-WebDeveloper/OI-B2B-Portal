<?php

require "../connect_db/config.php";

$sql = "SELECT MAX(data_armazenamento) as last_date FROM base_reparos_r1";
$sql = $pdo->prepare($sql);
$sql->execute();
if ($sql->rowCount()>0) {
    $data = $sql->fetch();
    $data = $data['last_date'];
    echo $data;
} else {
    echo "Atualizando...";
}
