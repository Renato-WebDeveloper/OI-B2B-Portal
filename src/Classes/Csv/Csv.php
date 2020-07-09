<?php

namespace src\Classes\Csv;

class Csv 
{
    private $connMysql;
    private $year;
    private $spreadsheetmonth;


    public function __construct($pdo)
    {
        $this->connMysql = $pdo;
        $this->year = date('Y');
        $this->setSpreadsheetMonth();
    }
    

    public function insertCsvR1IntoTheDb($file_directory) 
    {
        $this->validatingSpreadsheetMonthR1($file_directory);
        $file = fopen($file_directory, 'r');
        while (($row_data = fgetcsv($file)) !== false) {
            $sql = "INSERT INTO base_reparos_r1 (mes, chave, protocolo, servico, produto, posto, 
            status_, uf, uf_posto, sigla_gra, sigla_estacao, abertura, resolucao, data_promessa_ori,
            data_pri_apz2, data_aprazamento, ind_aprazamento, data_entrada, data_saida, inclusao_stc, 
            tempo_bd_hora, tempo_tram_hora, cod_abertura, cod_encer_rep, cod_exame, segm,
            cod_localidade, local_, num_meio_acesso, num_circuito, tipo_reparo, nome_cliente, 
            num_conglomerado_emp, veloc_circuito, data_inst, desc_livre_abertura, desc_fechamento, 
            uf_ofensora, novo_segm, ident_atendente, matric_tecnico_resp, velocidade_kbps, 
            faixa_veloc_1, faixa_veloc_2, conc, prazo, geografia, tp_conf, tp_cos, tp_eqpto, tp_even, 
            tp_oemp, tp_ptfa, tp_rms, tp_tade, tp_cgs, tp_fcr, tp_fcrdc, tp_fcrde, tp_fcrvc, tp_fcrve, 
            tp_sred, tp_tave, tp_tria, tp_fibra, tp_trans, tp_cld, tp_eiad, tp_parc, tp_dg, tp_redea, 
            tp_slda, repetido, tp_pend_cli, prazo_real, tempo_bd_hs, dia_fechamento, ano_fechamento, 
            segmento_b2b, grupo_causa_raiz, u_f, geografia_2, diretoria, prazo_2, mes_2, tempo_bd_hs_2, 
            tempo_pend, tempo_em_andamento) 
            VALUES ('$row_data[0]','$row_data[1]','$row_data[2]','$row_data[3]','$row_data[4]', 
            '$row_data[5]','$row_data[6]','$row_data[7]','$row_data[8]','$row_data[9]','$row_data[10]', 
            '$row_data[11]','$row_data[12]','$row_data[13]','$row_data[14]','$row_data[15]',
            '$row_data[16]', '$row_data[17]','$row_data[18]','$row_data[19]','$row_data[20]',
            '$row_data[21]','$row_data[22]', '$row_data[23]','$row_data[24]','$row_data[25]',
            '$row_data[26]','$row_data[27]','$row_data[28]', '$row_data[29]','$row_data[30]',
            '$row_data[31]','$row_data[32]','$row_data[33]','$row_data[34]','$row_data[35]',
            '$row_data[36]','$row_data[37]','$row_data[38]','$row_data[39]','$row_data[40]',
            '$row_data[41]','$row_data[42]','$row_data[43]','$row_data[44]','$row_data[45]',
            '$row_data[46]','$row_data[47]','$row_data[48]','$row_data[49]','$row_data[50]',
            '$row_data[51]','$row_data[52]','$row_data[53]','$row_data[54]','$row_data[55]',
            '$row_data[56]','$row_data[57]','$row_data[58]','$row_data[59]','$row_data[60]',
            '$row_data[61]','$row_data[62]','$row_data[63]','$row_data[64]','$row_data[65]',
            '$row_data[66]','$row_data[67]','$row_data[68]','$row_data[69]','$row_data[70]', 
            '$row_data[71]','$row_data[72]','$row_data[73]','$row_data[74]','$row_data[75]',
            '$row_data[76]','$row_data[77]','$row_data[78]','$row_data[79]','$row_data[80]',
            '$row_data[81]','$row_data[82]','$row_data[83]','$row_data[84]','$row_data[85]',
            '$row_data[86]','$row_data[87]')";
            $sql = $this->connMysql->prepare($sql);
            $sql->execute();           
        }
        fclose($file);
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function validatingSpreadsheetMonthR1($file_directory) 
    {
        $file = fopen($file_directory, 'r');
        $get_csv = fgetcsv($file);
        $spreadsheet_month = $get_csv[0];
        $sql = "SELECT * FROM base_reparos_r1 
        WHERE mes = '$spreadsheet_month' AND ano_fechamento = '$this->year'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = "DELETE FROM base_reparos_r1 
            WHERE mes = '$spreadsheet_month' AND ano_fechamento = '$this->year'";
            $sql = $this->connMysql->prepare($sql);
            $sql->execute();
            fclose($file);
        } else {
            fclose($file);
        }
    }

    public function insertCsvR2IntoTheDb($file_directory) 
    {
        $this->validatingSpreadsheetMonthR2($file_directory);
        $file = fopen($file_directory, 'r');
        while (($row_data = fgetcsv($file)) !== false) {
            $sql = "INSERT INTO base_reparos_r2 (arquivo, data_arquivo, filial, geo, codigo, data_encerramento, local_circuito, numero_circuito,
            situacao, codigo_abertura, data_abertura, codigo_encerramento, codigo_exame_linha, aprazado,
            data_promessa, data_mudanca_origem, tipo_circuito, tipo_classe, tipo_velocidade, classificacao,
            degrau_tarifario, nome_usuario, cliente_ponta_a, cliente_ponta_b, tipo_cliente_ponta_a, 
            tipo_cliente_ponta_b, localidade_ponta_a, endereco_ponta_a, localidade_ponta_b,
            endereco_ponta_b, cabo_ponta_a, cabo_ponta_b, caixa_ponta_a, caixa_ponta_b, armario_ponta_a,
            armario_ponta_b, par_primario_ponta_a, par_primario_ponta_b, par_secundario_ponta_a, 
            par_secundario_ponta_b, estacao_ponta_a, estacao_ponta_b, matricula_irla_ponta_a, 
            matricula_irla_ponta_b, macro_area_ponta_a, macro_area_ponta_b, centro_resultado_atual, 
            data_despacho_ponta_a, data_despacho_ponta_b, subsequente, cpf_cnpj_ponta_a, cpf_cnpj_ponta_b, 
            nrc_ponta_a, nrc_ponta_b, unidade_atual, data_atual, obs_atendente, obs_unidade, contrato, 
            micro_area_ponta_a, micro_area_ponta_b, codigo_sla, codigo_segmento_ponta_a, 
            codigo_segmento_ponta_b, empresa_pe_ponta_a, empresa_pe_ponta_b, empresa_pi_ponta_a, 
            empresa_pi_ponta_b, empresa_fechamento_2, uf_ponta_a, uf_ponta_b, tipo_localidade_ponta_a, 
            tipo_localidade_ponta_b, centro_resultado_ponta_a, centro_resultado_ponta_b, familia_produto, 
            area_responsavel, area_ofensora, duas_pontas, defeito_repetido, no_prazo, preventivo, descartar, 
            tempo_reparo, empresa_int_ponta_a, empresa_int_ponta_b, tipo_reclamacao, data_promessa_maxima, 
            uso_adsl, porta_adsl, no_prazo_maximo, modem, tipo_modem, numero_de_terminais, segmento, 
            repetido, no_column_name, no_column_name_2, ano_encerramento, segmento_b2b, grupo_causa_raiz, 
            u_f, geografia, diretoria, no_prazo2, mes, reincidencia, tempo_bd_hs) 
            VALUES ('$row_data[0]','$row_data[1]','$row_data[2]','$row_data[3]','$row_data[4]', 
            '$row_data[5]','$row_data[6]','$row_data[7]','$row_data[8]','$row_data[9]','$row_data[10]', 
            '$row_data[11]','$row_data[12]','$row_data[13]','$row_data[14]','$row_data[15]',
            '$row_data[16]', '$row_data[17]','$row_data[18]','$row_data[19]','$row_data[20]',
            '$row_data[21]','$row_data[22]', '$row_data[23]','$row_data[24]','$row_data[25]',
            '$row_data[26]','$row_data[27]','$row_data[28]', '$row_data[29]','$row_data[30]',
            '$row_data[31]','$row_data[32]','$row_data[33]','$row_data[34]','$row_data[35]',
            '$row_data[36]','$row_data[37]','$row_data[38]','$row_data[39]','$row_data[40]',
            '$row_data[41]','$row_data[42]','$row_data[43]','$row_data[44]','$row_data[45]',
            '$row_data[46]','$row_data[47]','$row_data[48]','$row_data[49]','$row_data[50]',
            '$row_data[51]','$row_data[52]','$row_data[53]','$row_data[54]','$row_data[55]',
            '$row_data[56]','$row_data[57]','$row_data[58]','$row_data[59]','$row_data[60]',
            '$row_data[61]','$row_data[62]','$row_data[63]','$row_data[64]','$row_data[65]',
            '$row_data[66]','$row_data[67]','$row_data[68]','$row_data[69]','$row_data[70]', 
            '$row_data[71]','$row_data[72]','$row_data[73]','$row_data[74]','$row_data[75]',
            '$row_data[76]','$row_data[77]','$row_data[78]','$row_data[79]','$row_data[80]',
            '$row_data[81]','$row_data[82]','$row_data[83]','$row_data[84]','$row_data[85]',
            '$row_data[86]','$row_data[87]','$row_data[88]','$row_data[89]','$row_data[90]',
            '$row_data[91]','$row_data[92]','$row_data[93]','$row_data[94]','$row_data[95]',
            '$row_data[96]','$row_data[97]','$row_data[98]','$row_data[99]','$row_data[100]',
            '$row_data[101]','$row_data[102]','$row_data[103]','$row_data[104]','$row_data[105]',
            '$row_data[106]','$row_data[107]')";
            $sql = $this->connMysql->prepare($sql);
            $sql->execute() or die(print_r($sql->errorInfo(), true));
        }
        fclose($file);
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function validatingSpreadsheetMonthR2($file_directory) 
    {
        $file = fopen($file_directory, 'r');
        $get_csv = fgetcsv($file);
        $spreadsheet_month = $get_csv[105];
        $sql = "SELECT * FROM base_reparos_r2 
        WHERE mes = '$spreadsheet_month' AND ano_encerramento = '$this->year'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = "DELETE FROM base_reparos_r2 
            WHERE mes = '$spreadsheet_month' AND ano_encerramento = '$this->year'";
            $sql = $this->connMysql->prepare($sql);
            $sql->execute();
            fclose($file);
        } else {
            fclose($file);
        }
    }

    private function setSpreadsheetMonth() 
    {
        $sql = "SELECT MAX(id) as id FROM base_reparos_r1";
        $sql = $this->connMysql->query($sql);
        $row = $sql->fetch();
        $ultimo_id = $row['id'];
        $sql = "SELECT * FROM base_reparos_r1 WHERE id = '$ultimo_id'";
        $sql = $this->connMysql->query($sql);
        if ($sql->rowCount() > 0) {
          $dados = $sql->fetch();
          $this->spreadsheetmonth = $dados['mes'];
        }
    }

    public function insertPlanIntoTheDb($file_directory) 
    {
        $file = fopen($file_directory, 'r');
        while (($row_data = fgetcsv($file)) !== false) {
            $sql = "INSERT INTO planta_mensal (indicador, diretoria, geografia, uf, valor, mes, 
            ano) 
            VALUES ('$row_data[0]','$row_data[1]','$row_data[2]','$row_data[3]','$row_data[4]','$this->spreadsheetmonth', '$this->year' )";
            $sql = $this->connMysql->prepare($sql);
            $sql->execute() or die(print_r($sql->errorInfo(), true));           
        }
        fclose($file);
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function insertMetaIntoTheDb($file_directory) 
    {
        $file = fopen($file_directory, 'r');
        while (($row_data = fgetcsv($file)) !== false) {
            $sql = "INSERT INTO meta (regiao, mes, ano, meta, tp_meta) 
            VALUES ('$row_data[0]','$row_data[1]','$row_data[2]','$row_data[3]','$row_data[4]')";
            $sql = $this->connMysql->prepare($sql);
            $sql->execute() or die(print_r($sql->errorInfo(), true));           
        }
        fclose($file);
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}








