<?php

ini_set('memory_limit', '1024M');
require_once "../connect_db/config.php";

require_once "../connect_db/config_pgsql.php";

$sqlD = "DELETE FROM base_bdON";
$sqlD = $pdo->prepare($sqlD);
$sqlD->execute();

$sql = "SELECT * FROM (SELECT (CASE WHEN v4.dthr_entrada_ultima_tramita>v3.promessa THEN 'Não é reaprazável. O prazo desse circuito foi perdido.' 
ELSE 'Circuito Reaprazavel' END) AS reaprazavel, (CASE WHEN (dthr_entrada_ultima_tramita<=promessa) THEN (promessa-dthr_entrada_ultima_tramita)::text 
ELSE ''::text END) as tempo_reaprazavel, v4.dthr_entrada_ultima_tramita, v3.* FROM ((SELECT v1.*, v2.dthr_entrada_tramita, v2.numero_ba 
FROM (SELECT * FROM (Select *, (CASE WHEN pendencia is not null THEN 'PENDENTE' WHEN promessa>CURRENT_TIMESTAMP THEN 'A VENCER' ELSE 'VENCIDO' 
END) as igq from vs_corretivo_bd_v2 WHERE status=1 and (uf_posto='RJ' or uf_posto='MZ') order by igq asc, promessa asc) v1 
LEFT JOIN circuitos_top ON circuitos_top.conc=v1.chave order by v1.igq asc, v1.promessa asc ) v1 LEFT JOIN ( SELECT DISTINCT ON (protocolo) protocolo, 
MAX(dthr_entrada) AS dthr_entrada_tramita, numero_ba FROM reparos_tramita WHERE numero_ba IS NOT NULL GROUP BY protocolo, dthr_entrada ,numero_ba 
ORDER BY protocolo, dthr_entrada DESC ) v2 ON v1.protocolo=v2.protocolo) v3 LEFT JOIN ( SELECT DISTINCT ON (protocolo) protocolo, MAX(dthr_entrada) 
AS dthr_entrada_ultima_tramita FROM reparos_tramita GROUP BY protocolo, dthr_entrada ,numero_ba ORDER BY protocolo, dthr_entrada DESC) v4 
ON v4.protocolo=v3.protocolo)) vfinal order by vfinal.igq asc, vfinal.promessa asc";
$sql = $pdo_pgsql->prepare($sql);
$sql->execute();
if ($sql->rowCount()>0) {
    foreach ($sql->fetchAll() as $value) {

        $reaprazavel = $value['reaprazavel'];
        $tempo_reaprazavel = $value['tempo_reaprazavel'];
        $dthr_entrada_ultima_tramita = $value['dthr_entrada_ultima_tramita'];
        $local_ = $value['local'];
        $circuito = $value['circuito'];
        $servico = $value['servico'];
        $produto = $value['produto'];
        $promessa = $value['promessa'];
        $segmento = $value['segmento'];
        $uf_posto = $value['uf_posto'];
        $gra = $value['gra'];
        $loc = $value['loc'];
        $estacao = $value['estacao'];
        $tempo = $value['tempo'];
        $ponta = $value['ponta'];
        $dpto = $value['dpto'];
        $area = $value['area'];
        $cliente = $value['cliente'];
        $aprazado = $value['aprazado'];
        $obs = $value['obs'];
        $mat_despachado = $value['mat_despachado'];
        $velocidade = $value['velocidade'];
        $enderecopta = $value['enderecopta'];
        $bairropta = $value['bairropta        '];
        $complemento_endera = $value['complemento_endera'];
        $enderecoptb = $value['enderecoptb'];
        $bairroptb = $value['bairroptb'];
        $complemento_enderb = $value['complemento_enderb'];
        $cpf_cgc = $value['cpf_cgc'];
        $tipo_pessoa = $value['tipo_pessoa'];
        $data_inclusao = $value['data_inclusao'];
        $data_atualizacao = $value['data_atualizacao'];
        $chave = $value['chave'];
        $posto = $value['posto'];
        $status_ = $value['status'];
        $contatoa = $value['contatoa'];
        $contatob = $value['contatob'];
        $tel_contatoa = $value['tel_contatoa'];
        $tel_contatob = $value['tel_contatob'];
        $protocolo = $value['protocolo'];
        $cod_abertura = $value['cod_abertura'];
        $tipo_solicitacao = $value['tipo_solicitacao'];
        $defeito_inf1 = $value['defeito_inf1'];
        $defeito_inf2 = $value['defeito_inf2'];
        $pendencia = $value['pendencia'];
        $desc_pend = $value['desc_pend'];
        $resp_pend = $value['resp_pend'];
        $saida_pend = $value['saida_pend'];
        $veloc_tipo = $value['veloc_tipo'];
        $tecnologia = $value['tecnologia'];
        $gerenciado = $value['gerenciado'];
        $data_atendimento = $value['data_atendimento'];
        $qtd_tramitacao = $value['qtd_tramitacao'];
        $despachado = $value['despachado'];
        $tmp_posto_cld = $value['tmp_posto_cld'];
        $status_atualizacao = $value['status_atualizacao'];
        $id_tecnico_despachado = $value['id_tecnico_despachado'];
        $tecnico_despachado = $value['tecnico_despachado'];
        $contato_tecnico_despachado = $value['contato_tecnico_despachado'];
        $dthr_despacho_tec = $value['dthr_despacho_tec'];
        $reinc_30 = $value['reinc_30'];
        $reinc_60 = $value['reinc_60'];
        $dthr_atualizacao_msg = $value['dthr_atualizacao_msg'];
        $ultima_msg = $value['ultima_msg'];
        $tipo_abertura_msg = $value['tipo_abertura_msg'];
        $sms1prior = $value['sms1prior'];
        $origem_solicitacao = $value['origem_solicitacao'];
        $lido_em_campo = $value['lido_em_campo'];
        $resposta_campo = $value['resposta_campo'];
        $mensagem_campo = $value['mensagem_campo'];
        $lido_em_campo_dthr = $value['lido_em_campo_dthr'];
        $area_oi = $value['area_oi'];
        $psr = $value['psr'];
        $dthr_ultima_entrada = $value['dthr_ultima_entrada'];
        $qtd_tramit = $value['qtd_tramit'];
        $segmento_comp = $value['segmento_comp'];
        $tempo_sem_pendencia = $value['tempo_sem_pendencia'];
        $dthr_ultima_tramita_fora_pend = $value['dthr_ultima_tramita_fora_pend'];
        $dthr_ultima_tramita_fora_pend_menos_tp_sem_pend = $value['dthr_ultima_tramita_fora_pend_menos_tp_sem_pend'];
        $tecnologia_acesso = $value['tecnologia_acesso'];
        $reinc_oi_30 = $value['reinc_oi_30'];
        $projeto_identificacao = $value['projeto_identificacao'];
        $projeto_mensagem = $value['projeto_mensagem'];
        $_protocolo_uag = $value['_protocolo_uag'];
        $prev90d_antes_prev_atual = $value['prev90d_antes_prev_atual'];
        $cancelado_oi_30 = $value['cancelado_oi_30'];
        $area_psr = $value['area_psr'];
        $igq = $value['igq'];
        $conc = $value['conc'];
        $tipo_top = $value['tipo_top'];
        $acoes_planejadas = $value['acoes_planejadas'];
        $acoes_serede = $value['acoes_serede'];
        $se_acao = $value['se_acao'];
        $prev_acao = $value['prev_acao'];
        $melhorias_acao = $value['melhorias_acao'];
        $melhorias_acao1 = $value['melhorias_acao1'];
        $melhorias_acao2 = $value['melhorias_acao2'];
        $melhorias_acao3 = $value['melhorias_acao3'];
        $melhorias_acao4 = $value['melhorias_acao4'];
        $status_melhor_acao = $value['status_melhor_acao'];
        $outras_acao = $value['outras_acao'];
        $desc_outras_acao = $value['desc_outras_acao'];
        $status_outra_acao = $value['status_outra_acao'];
        $cliente_final = $value['cliente_final'];
        $segmento_atuacao = $value['segmento_atuacao'];
        $dthr_entrada_tramita = $value['dthr_entrada_tramita'];
        $numero_ba = $value['numero_ba'];
        

        $sql = "INSERT INTO base_bdON (reaprazavel, tempo_reaprazavel, dthr_entrada_ultima_tramita, local_, circuito, servico, produto,
        promessa, segmento, uf_posto, gra, loc, estacao, tempo, ponta, dpto, area, cliente, aprazado, obs, mat_despachado, velocidade,
        enderecopta, bairropta, complemento_endera, enderecoptb, bairroptb, complemento_enderb, cpf_cgc, tipo_pessoa, data_inclusao,
        data_atualizacao, chave, posto, status_, contatoa, contatob, tel_contatoa, tel_contatob, protocolo, cod_abertura, tipo_solicitacao,
        defeito_inf1, defeito_inf2, pendencia, desc_pend, resp_pend, saida_pend, veloc_tipo, tecnologia, gerenciado, data_atendimento,
        qtd_tramitacao, despachado, tmp_posto_cld, status_atualizacao, id_tecnico_despachado, tecnico_despachado, contato_tecnico_despachado,
        dthr_despacho_tec, reinc_30, reinc_60, dthr_atualizacao_msg, ultima_msg, tipo_abertura_msg, sms1prior, origem_solicitacao,
        lido_em_campo, resposta_campo, mensagem_campo, lido_em_campo_dthr, area_oi, psr, dthr_ultima_entrada, qtd_tramit, segmento_comp,
        tempo_sem_pendencia, dthr_ultima_tramita_fora_pend, dthr_ultima_tramita_fora_pend_menos_tp_sem_pend, tecnologia_acesso, reinc_oi_30,
        projeto_identificacao, projeto_mensagem, _protocolo_uag, prev90d_antes_prev_atual, cancelado_oi_30, area_psr, igq, conc, tipo_top,
        acoes_planejadas, acoes_serede, se_acao, prev_acao, melhorias_acao, melhorias_acao1, melhorias_acao2, melhorias_acao3, melhorias_acao4,
        status_melhor_acao, outras_acao, desc_outras_acao, status_outra_acao, cliente_final, segmento_atuacao, dthr_entrada_tramita, numero_ba )
        VALUES ('$reaprazavel', '$tempo_reaprazavel', '$dthr_entrada_ultima_tramita', '$local', '$circuito', '$servico', '$produto',
        '$promessa', '$segmento', '$uf_posto', '$gra', '$loc', '$estacao', '$tempo', '$ponta', '$dpto', '$area', '$cliente', '$aprazado', '$obs', '$mat_despachado', '$velocidade',
        '$enderecopta', '$bairropta', '$complemento_endera', '$enderecoptb', '$bairroptb', '$complemento_enderb', '$cpf_cgc', '$tipo_pessoa', '$data_inclusao',
        '$data_atualizacao', '$chave', '$posto', '$status', '$contatoa', '$contatob', '$tel_contatoa', '$tel_contatob', '$protocolo', '$cod_abertura', '$tipo_solicitacao',
        '$defeito_inf1', '$defeito_inf2', '$pendencia', '$desc_pend', '$resp_pend', '$saida_pend', '$veloc_tipo', '$tecnologia', '$gerenciado', '$data_atendimento',
        '$qtd_tramitacao', '$despachado', '$tmp_posto_cld', '$status_atualizacao', '$id_tecnico_despachado', '$tecnico_despachado', '$contato_tecnico_despachado',
        '$dthr_despacho_tec', '$reinc_30', '$reinc_60', '$dthr_atualizacao_msg', '$ultima_msg', '$tipo_abertura_msg', '$sms1prior', '$origem_solicitacao',
        '$lido_em_campo', '$resposta_campo', '$mensagem_campo', '$lido_em_campo_dthr', '$area_oi', '$psr', '$dthr_ultima_entrada', '$qtd_tramit', '$segmento_comp',
        '$tempo_sem_pendencia', '$dthr_ultima_tramita_fora_pend', '$dthr_ultima_tramita_fora_pend_menos_tp_sem_pend', '$tecnologia_acesso', '$reinc_oi_30',
        '$projeto_identificacao', '$projeto_mensagem', '$_protocolo_uag', '$prev90d_antes_prev_atual', '$cancelado_oi_30', '$area_psr', '$igq', '$conc', '$tipo_top',
        '$acoes_planejadas', '$acoes_serede', '$se_acao', '$prev_acao', '$melhorias_acao', '$melhorias_acao1', '$melhorias_acao2', '$melhorias_acao3', '$melhorias_acao4',
        '$status_melhor_acao', '$outras_acao', '$desc_outras_acao', '$status_outra_acao', '$cliente_final', '$segmento_atuacao', '$dthr_entrada_tramita', '$numero_ba' )";
        $sql = $pdo->prepare($sql);
        $sql->execute();
    }
}




?>








