<?php 

require "../connect_db/config.php";

$sql = "SELECT COUNT(acesso) as count_acesso, supervisao FROM planta_analitica WHERE acesso IN
 (select base_reparos_r1.num_meio_acesso FROM base_reparos_r1) GROUP BY supervisao";

$sql = $pdo->prepare($sql);

$sql->execute();

if ($sql->rowCount()>0)
{
    $row = $sql->fetchAll();
    foreach ($row as $value) {
        echo $value['count_acesso']." ---- ";
        echo $value['supervisao']." ----- ";
        $count_acesso = $value['count_acesso'];
        $supervisao = $value['supervisao'];
        $sql = "SELECT count(acesso) as planta FROM planta_analitica WHERE supervisao = '$supervisao'";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
            $count_planta = $row['planta'];
            echo $count_planta." ----- ";
        }
        $porcentagem = ($count_acesso / $row['planta']) * 100;
        $porcentagem = substr($porcentagem, 0, 4)."% ----- ";
        echo $porcentagem;

        $planta = 45657;
        $porcentagem_na_planta = ($count_acesso / $planta) * 100;
        $porcentagem_na_planta = substr($porcentagem_na_planta, 0 ,4)."% <br/>";
        echo $porcentagem_na_planta;

    }
}