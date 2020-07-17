<?php

require "../connect_db/config.php";

$date = date('Y-m-d');
$sql = "SELECT count(*) as total FROM base_bd_corr WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND _cliente != 'OI MOVEL SA EM RECUPERACAO JUDICIAL' AND fechamento >= '$date'";
$sql = $pdo->prepare($sql);
$sql->execute();
if ($sql->rowCount()>0) {
    $count = $sql->fetch();
    $count = $count['total'];
    echo $count;
} else {
    $count = 0;
    echo $count;
}
