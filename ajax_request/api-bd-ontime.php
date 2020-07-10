<?php

require "../connect_db/config.php";

$year = date('Y');
$month = date('m');
$date = $year."-".$month."-01";

$month_r2 = date('m');
if ($month_r2 < 10) {
    $month_r2 = $month_r2[1];
}

$sql = "SELECT count(*) as total_r2 FROM base_reparos_r2 WHERE geografia = 'GRJ' AND segmento_b2b != 'OUTROS' AND mes = '$month_r2' AND ano_encerramento = '$year' AND no_prazo = 'S'" ;
$sql = $pdo->prepare($sql);
$sql->execute();
if ($sql->rowCount()>0) {
    $result_r2 = $sql->fetch();
} else {
    echo "...";
}

$sql = "SELECT count(*) as total_r1 FROM base_bd_corr 
WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND _cliente != 'OI MOVEL SA EM RECUPERACAO JUDICIAL' AND fechamento >= '$date' AND igq = 'Dentro'"; //verificar depois a OI TELECOM PRA REMOVER
$sql = $pdo->prepare($sql);
$sql->execute();
if ($sql->rowCount()>0) {
    $result = $sql->fetch();
    $total =  $result['total_r1'] + $result_r2['total_r2'];
    echo $total;
} else {
    echo "...";
}

?>