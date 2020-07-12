<?php

require "../connect_db/config.php";

$year = date('Y');
$month = date('m');
$date = $year."-".$month."-01";


$month_r2 = date('m');
if ($month_r2 < 10) {
    $month_r2 = $month_r2[1];
}


$sql = "SELECT count(*) as total_r2 FROM base_reparos_r2 WHERE geografia = 'GRJ' AND segmento_b2b != 'OUTROS' AND mes = '$month_r2' AND ano_encerramento = '$year' AND repetido = 'S'" ;
$sql = $pdo->prepare($sql);
$sql->execute();
if ($sql->rowCount()>0) {
    $result_r2 = $sql->fetch();
} else {
    $result_r2 = 0;
}

$sql = "SELECT count(*) as total_vult_repeated FROM base_reparos_r1 WHERE geografia_2 = 'GRJ'
AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$month_r2' 
AND ano_fechamento = '$year' AND repetido = 'S' AND u_f = 'RJ' AND uf != 'RJ'";
$sql = $pdo->prepare($sql);
$sql->execute() or die(print_r($sql->errorInfo(), true));
if($sql->rowCount()>0){
    $row = $sql->fetch();
    $vultRepeated = $row['total_vult_repeated'];
} else {
    $vultRepeated = 0;
}

$sql = "SELECT count(*) as total_r1 FROM base_bd_corr 
WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND _cliente != 'OI MOVEL SA EM RECUPERACAO JUDICIAL' AND fechamento >= '$date' AND _reinc_30 = 'S'"; //verificar depois a OI TELECOM PRA REMOVER
$sql = $pdo->prepare($sql);
$sql->execute();
if ($sql->rowCount()>0) {
    $result = $sql->fetch();
    $total =  $result['total_r1'] + $result_r2['total_r2'] + $vultRepeated;
    echo $total;
} else {
    $total = 0;
    echo $total;
}
        
?>
