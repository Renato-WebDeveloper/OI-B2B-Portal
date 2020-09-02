<head>
    <meta charset="UTF-8">
</head>
<style>
    tr:nth-child(even) {background-color: #f2f2f2}
</style>
<?php

require "../connect_db/config.php";

    if (isset($_GET['bdCorr']) && !empty($_GET['bdCorr'])) {

        $dadosXls  = "";
        $dadosXls .= "  <table border='1'>";
        $dadosXls .= "      <tr>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Local</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Acesso</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Cliente</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Serviço</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Produto</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>UF</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>U_F</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>GRA</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Repetido</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>UF - Posto</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Posto</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>GRA - Posto</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Abertura</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Promessa</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Fechamento</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Prazo</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Supervisor</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Supervisao</th>";
        $dadosXls .= "      </tr>";


        $year = date('Y');
        $month = date('m');
        $date = $year."-".$month."-01";

                
        $month_r2 = date('m');
        if ($month_r2 < 10) {
            $month_r2 = $month_r2[1];
        }

        $sql = "SELECT * FROM base_bdCorr_sup
        WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
        AND _cliente NOT LIKE '%TELEMAR%' AND _cliente != 'OI MOVEL SA EM RECUPERACAO JUDICIAL' AND fechamento >= '$date'"; 
        $sql = $pdo->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $result = $sql->fetchAll();
            foreach ($result as $res) {
                $dadosXls .= "      <tr>";
                $dadosXls .= "          <td>".$res['local']."</td>";
                $dadosXls .= "          <td>".$res['acesso']."</td>";
                $dadosXls .= "          <td>".$res['_cliente']."</td>";
                $dadosXls .= "          <td>".$res['servico']."</td>";
                $dadosXls .= "          <td>".$res['produto']."</td>";
                $dadosXls .= "          <td>".$res['uf']."</td>";
                $dadosXls .= "          <td>NULL</td>";
                $dadosXls .= "          <td>".$res['gra_']."</td>";
                $dadosXls .= "          <td>".$res['_reinc_30']."</td>";
                $dadosXls .= "          <td>".$res['uf_posto']."</td>";
                $dadosXls .= "          <td>".$res['posto']."</td>";
                $dadosXls .= "          <td>".$res['gra_posto']."</td>";
                $dadosXls .= "          <td>".$res['abertura']."</td>";
                $dadosXls .= "          <td>".$res['promessa']."</td>";
                $dadosXls .= "          <td>".$res['fechamento']."</td>";
                $dadosXls .= "          <td>".$res['igq']."</td>";
                $dadosXls .= "          <td>".$res['supervisor']."</td>";
                $dadosXls .= "          <td>".$res['supervisao']."</td>";
                $dadosXls .= "      </tr>";
            }


            $sql = "SELECT * FROM base_reparos_r1_sup WHERE geografia_2 = 'GRJ'
            AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'PROJETO ESCOLA', 'EMPRESARIAL') AND mes = '$month_r2'
            AND ano_fechamento = '$year' AND u_f = 'RJ' AND uf != 'RJ'";
            $sql = $pdo->prepare($sql);
            $sql->execute();
            if ($sql->rowCount()>0) {
                $result = $sql->fetchAll();
                foreach ($result as $res) {
                    $dadosXls .= "      <tr>";
                    $dadosXls .= "          <td>".$res['local_']."</td>";
                    $dadosXls .= "          <td>".$res['num_meio_acesso']."</td>";
                    $dadosXls .= "          <td>".$res['nome_cliente']."</td>";
                    $dadosXls .= "          <td>".$res['servico']."</td>";
                    $dadosXls .= "          <td>".$res['produto']."</td>";
                    $dadosXls .= "          <td>".$res['uf']."</td>";
                    $dadosXls .= "          <td>".$res['u_f']."</td>";
                    $dadosXls .= "          <td>".$res['sigla_gra']."</td>";
                    $dadosXls .= "          <td>".$res['repetido']."</td>";
                    $dadosXls .= "          <td>".$res['uf_posto']."</td>";
                    $dadosXls .= "          <td>".$res['posto']."</td>";
                    $dadosXls .= "          <td>NULL</td>";
                    $dadosXls .= "          <td>".$res['abertura']."</td>";
                    $dadosXls .= "          <td>".$res['data_promessa_ori']."</td>";
                    $dadosXls .= "          <td>".$res['resolucao']."</td>";
                    $dadosXls .= "          <td>".$res['prazo_real']."</td>";
                    $dadosXls .= "          <td>".$res['supervisor']."</td>";
                    $dadosXls .= "          <td>".$res['supervisao']."</td>";
                    $dadosXls .= "      </tr>";
                }

            } else {
                $dadosXls .= "  </table>";
            }

            $dadosXls .= "  </table>";

            // Definimos o nome do arquivo que será exportado  
            $arquivo = "Base_Reparos_R1.xls";  
            // Configurações header para forçar o download  
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$arquivo.'"');
            header('Cache-Control: max-age=0');
            // Se for o IE9, isso talvez seja necessário
            header('Cache-Control: max-age=1');
            
            // Envia o conteúdo do arquivo  
            echo $dadosXls;  
            exit;

        } else {
            $dadosXls .= "  </table>";
        }

    } elseif(isset($_GET['bdR2']) && !empty($_GET['bdR2'])) {

        $dadosXls  = "";
        $dadosXls .= "  <table border='1' >";
        $dadosXls .= "          <tr>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Local</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Acesso</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Cliente_ponta_A</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Cliente_ponta_B</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>UF_A</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>UF_B</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>GRA</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Repetido</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Abertura</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Fechamento</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Prazo</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Supervisor</th>";
        $dadosXls .= "          <th style='background-color:#0277bd;color:white;'>Supervisao</th>";
        $dadosXls .= "      </tr>";

        $year = date('Y');
        $month = date('m');
        $date = $year."-".$month."-01";

                
        $month_r2 = date('m');
        if ($month_r2 < 10) {
            $month_r2 = $month_r2[1];
        }

        $sql = "SELECT * FROM base_reparos_r2_sup WHERE geografia = 'GRJ' AND segmento_b2b != 'OUTROS' AND mes = '$month_r2' AND ano_encerramento = '$year'" ;
        $sql = $pdo->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $result = $sql->fetchAll();
            foreach ($result as $res) {
            $dadosXls .= "      <tr>";
            $dadosXls .= "          <td>".$res['local_circuito']."</td>";
            $dadosXls .= "          <td>".$res['numero_circuito']."</td>";
            $dadosXls .= "          <td>".$res['cliente_ponta_a']."</td>";
            $dadosXls .= "          <td>".$res['cliente_ponta_b']."</td>";
            $dadosXls .= "          <td>".$res['uf_ponta_a']."</td>";
            $dadosXls .= "          <td>".$res['uf_ponta_b']."</td>";
            $dadosXls .= "          <td>".$res['sigla_gra']."</td>";
            $dadosXls .= "          <td>".$res['repetido']."</td>";
            $dadosXls .= "          <td>".$res['data_abertura']."</td>";
            $dadosXls .= "          <td>".$res['data_encerramento']."</td>";
            $dadosXls .= "          <td>".$res['no_prazo']."</td>";
            $dadosXls .= "          <td>".$res['supervisor']."</td>";
            $dadosXls .= "          <td>".$res['supervisao']."</td>";
            $dadosXls .= "      </tr>";
            
        }

        } else {
            $dadosXls .= "  </table>";
        }

        $dadosXls .= "  </table>";

        // Definimos o nome do arquivo que será exportado  
        $arquivo = "Base_Reparos_R2.xls";  
        // Configurações header para forçar o download  
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$arquivo.'"');
        header('Cache-Control: max-age=0');
        // Se for o IE9, isso talvez seja necessário
        header('Cache-Control: max-age=1');
            
        // Envia o conteúdo do arquivo  
        echo $dadosXls;  
        exit;      
        
    } else {
        ?><script type="text/javascript">window.location.href="index.php";</script><?php
    }

?>
