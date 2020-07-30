<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: white;">
        <table border="10" width="100%" style="background-color:black; color:white">

        <tr>
            <th>Supervisao</th>
            <th>Supervisor</th>
            <th>Planta</th>
            <th>Entradas</th>
            <th>Percentual entrada</th>
            <th>Percentual na planta</th>
            <th>Repetidos</th>
            <th>Percentual repetido</th>
            <th>Percentual regional</th>
        </tr>

</body>
</html>


<?php 
require "../connect_db/config.php";

$sql = "SELECT * FROM planta_analitica_sup_count";
$sql = $pdo->prepare($sql);
$sql->execute();
if ($sql->rowCount()>0) {
    $row = $sql->fetchAll();
    foreach ($row as $singleRow) {

            if ($singleRow['supervisao'] == '' ) {
                $singleRow['supervisao'] = 'REGIAO-2';
                $singleRow['supervisor'] = 'REGIAO-2';
            }

        $planta = $singleRow['count(*)'];
        $supervisao = $singleRow['supervisao'];
        $supervisor = $singleRow['supervisor'];


        $sql = "SELECT count(*) as total FROM base_bdCorr_sup WHERE supervisao = '$supervisao' AND uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
        AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND _cliente != 'OI MOVEL SA EM RECUPERACAO JUDICIAL'";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
        } else{
            $row['total'] = 0;
        }


        $sql = "SELECT count(*) as total FROM base_reparos_r1_sup WHERE geografia_2 = 'GRJ'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'PROJETO ESCOLA', 'EMPRESARIAL') AND u_f = 'RJ' AND uf != 'RJ' AND supervisao = '$supervisao'";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $row2 = $sql->fetch();
        } else{
            $row2['total'] = 0;
        }


        $total = $row['total'] + $row2['total'];

        $percentual = ($total / $planta) * 100;
        $percentual = substr($percentual,0,4)."%";
        
        $planta_total = 45657;
        $percentual_regional = ($total / $planta_total) * 100;
        $percentual_regional = substr($percentual_regional,0,4)."%";



       $sql = "SELECT count(*) as total_vult_repeated FROM base_reparos_r1_sup WHERE repetido = 'S' AND geografia_2 = 'GRJ'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND u_f = 'RJ' AND uf != 'RJ";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $repetido = $sql->fetch();           
        } else {
            $repetido['total_vult_repeated'] = 0;
        }

        $vulto_repetido = $repetido['total_vult_repeated'];


        $sql = "SELECT count(*) as total FROM base_bdCorr_sup
        WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
        AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND _cliente != 'OI MOVEL SA EM RECUPERACAO JUDICIAL'
        AND _reinc_30 = 'S' AND supervisao = '$supervisao'"; 
        $sql = $pdo->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $repetidoCorr = $sql->fetch();
        } else {
            $repetidoCorr['total'] = 0;
        }

        $totalRepetido = $repetidoCorr['total'] + $vulto_repetido;

        $percentual_entrada_repetido = ($totalRepetido / $total) * 100;
        $percentual_entrada_repetido = substr($percentual_entrada_repetido,0,5)."%";

        $percentual_entrada_repetido_regional = ($totalRepetido / $planta_total) * 100;
        $percentual_entrada_repetido_regional = substr($percentual_entrada_repetido_regional,0,4)."%";

        ?>
        <tr>
            <td><?= $supervisao ?></td>
            <td><?= $supervisor ?></td>
            <td><?= $planta ?></td>
            <td><?= $total ?></td>
            <td><?= $percentual ?></td>
            <td><?= $percentual_regional ?></td>
            <td><?= $totalRepetido ?></td>
            <td><?= $percentual_entrada_repetido ?></td>
            <td><?= $percentual_entrada_repetido_regional ?></td>
        </tr>
        <?php
    }
}
?>

</table>