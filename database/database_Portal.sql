-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 09/07/2020 às 16:30
-- Versão do servidor: 10.1.44-MariaDB-0+deb9u1
-- Versão do PHP: 7.0.33-0+deb9u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `portal_indicadores`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `base_bdON`
--

CREATE TABLE `base_bdON` (
  `id` int(10) NOT NULL,
  `reaprazavel` varchar(100) NOT NULL,
  `tempo_reaprazavel` varchar(100) NOT NULL,
  `dthr_entrada_ultima_tramita` varchar(100) NOT NULL,
  `local_` varchar(100) NOT NULL,
  `circuito` varchar(100) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `produto` varchar(100) NOT NULL,
  `promessa` varchar(100) NOT NULL,
  `segmento` varchar(100) NOT NULL,
  `uf_posto` varchar(100) NOT NULL,
  `gra` varchar(100) NOT NULL,
  `loc` varchar(100) NOT NULL,
  `estacao` varchar(100) NOT NULL,
  `tempo` varchar(100) NOT NULL,
  `ponta` varchar(100) NOT NULL,
  `dpto` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `aprazado` varchar(100) NOT NULL,
  `obs` varchar(100) NOT NULL,
  `mat_despachado` varchar(100) NOT NULL,
  `velocidade` varchar(100) NOT NULL,
  `enderecopta` varchar(100) NOT NULL,
  `bairropta` varchar(100) NOT NULL,
  `complemento_endera` varchar(100) NOT NULL,
  `enderecoptb` varchar(100) NOT NULL,
  `bairroptb` varchar(100) NOT NULL,
  `complemento_enderb` varchar(100) NOT NULL,
  `cpf_cgc` varchar(100) NOT NULL,
  `tipo_pessoa` varchar(100) NOT NULL,
  `data_inclusao` varchar(100) NOT NULL,
  `data_atualizacao` varchar(100) NOT NULL,
  `chave` varchar(100) NOT NULL,
  `posto` varchar(100) NOT NULL,
  `status_` varchar(100) NOT NULL,
  `contatoa` varchar(100) NOT NULL,
  `contatob` varchar(100) NOT NULL,
  `tel_contatoa` varchar(100) NOT NULL,
  `tel_contatob` varchar(100) NOT NULL,
  `protocolo` varchar(100) NOT NULL,
  `cod_abertura` varchar(100) NOT NULL,
  `tipo_solicitacao` varchar(100) NOT NULL,
  `defeito_inf1` varchar(100) NOT NULL,
  `defeito_inf2` varchar(100) NOT NULL,
  `pendencia` varchar(100) NOT NULL,
  `desc_pend` varchar(100) NOT NULL,
  `resp_pend` varchar(100) NOT NULL,
  `saida_pend` varchar(100) NOT NULL,
  `veloc_tipo` varchar(100) NOT NULL,
  `tecnologia` varchar(100) NOT NULL,
  `gerenciado` varchar(100) NOT NULL,
  `data_atendimento` varchar(100) NOT NULL,
  `qtd_tramitacao` varchar(100) NOT NULL,
  `despachado` varchar(100) NOT NULL,
  `tmp_posto_cld` varchar(100) NOT NULL,
  `status_atualizacao` varchar(100) NOT NULL,
  `id_tecnico_despachado` varchar(100) NOT NULL,
  `tecnico_despachado` varchar(100) NOT NULL,
  `contato_tecnico_despachado` varchar(100) NOT NULL,
  `dthr_despacho_tec` varchar(100) NOT NULL,
  `reinc_30` varchar(100) NOT NULL,
  `reinc_60` varchar(100) NOT NULL,
  `dthr_atualizacao_msg` varchar(100) NOT NULL,
  `ultima_msg` varchar(100) NOT NULL,
  `tipo_abertura_msg` varchar(100) NOT NULL,
  `sms1prior` varchar(100) NOT NULL,
  `origem_solicitacao` varchar(100) NOT NULL,
  `lido_em_campo` varchar(100) NOT NULL,
  `resposta_campo` varchar(100) NOT NULL,
  `mensagem_campo` varchar(100) NOT NULL,
  `lido_em_campo_dthr` varchar(100) NOT NULL,
  `area_oi` varchar(100) NOT NULL,
  `psr` varchar(100) NOT NULL,
  `dthr_ultima_entrada` varchar(100) NOT NULL,
  `qtd_tramit` varchar(100) NOT NULL,
  `segmento_comp` varchar(100) NOT NULL,
  `tempo_sem_pendencia` varchar(100) NOT NULL,
  `dthr_ultima_tramita_fora_pend` varchar(100) NOT NULL,
  `dthr_ultima_tramita_fora_pend_menos_tp_sem_pend` varchar(100) NOT NULL,
  `tecnologia_acesso` varchar(100) NOT NULL,
  `reinc_oi_30` varchar(100) NOT NULL,
  `projeto_identificacao` varchar(100) NOT NULL,
  `projeto_mensagem` varchar(100) NOT NULL,
  `_protocolo_uag` varchar(100) NOT NULL,
  `prev90d_antes_prev_atual` varchar(100) NOT NULL,
  `cancelado_oi_30` varchar(100) NOT NULL,
  `area_psr` varchar(100) NOT NULL,
  `igq` varchar(100) NOT NULL,
  `conc` varchar(100) NOT NULL,
  `tipo_top` varchar(100) NOT NULL,
  `acoes_planejadas` varchar(100) NOT NULL,
  `acoes_serede` varchar(100) NOT NULL,
  `se_acao` varchar(100) NOT NULL,
  `prev_acao` varchar(100) NOT NULL,
  `melhorias_acao` varchar(100) NOT NULL,
  `melhorias_acao1` varchar(100) NOT NULL,
  `melhorias_acao2` varchar(100) NOT NULL,
  `melhorias_acao3` varchar(100) NOT NULL,
  `melhorias_acao4` varchar(100) NOT NULL,
  `status_melhor_acao` varchar(100) NOT NULL,
  `outras_acao` varchar(100) NOT NULL,
  `desc_outras_acao` varchar(100) NOT NULL,
  `status_outra_acao` varchar(100) NOT NULL,
  `cliente_final` varchar(100) NOT NULL,
  `segmento_atuacao` varchar(100) NOT NULL,
  `dthr_entrada_tramita` varchar(100) NOT NULL,
  `numero_ba` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `base_bd_corr`
--

CREATE TABLE `base_bd_corr` (
  `id` int(11) NOT NULL,
  `protocolo` varchar(100) NOT NULL,
  `local` varchar(100) NOT NULL,
  `acesso` varchar(100) NOT NULL,
  `_cliente` varchar(100) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `produto` varchar(100) NOT NULL,
  `uf` varchar(100) NOT NULL,
  `gra` varchar(100) NOT NULL,
  `_reinc_30` varchar(100) NOT NULL,
  `cod_encer` varchar(100) NOT NULL,
  `uf_posto` varchar(100) NOT NULL,
  `posto` varchar(100) NOT NULL,
  `gra_posto` varchar(100) NOT NULL,
  `abertura` varchar(100) NOT NULL,
  `promessa` varchar(100) NOT NULL,
  `aprazamento` varchar(100) NOT NULL,
  `fechamento` datetime DEFAULT CURRENT_TIMESTAMP,
  `igq` varchar(100) NOT NULL,
  `_velocidade` varchar(100) NOT NULL,
  `segm` varchar(100) NOT NULL,
  `estacao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `base_reparos_r1`
--

CREATE TABLE `base_reparos_r1` (
  `id` int(100) NOT NULL,
  `mes` varchar(100) NOT NULL,
  `chave` varchar(100) NOT NULL,
  `protocolo` varchar(100) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `produto` varchar(100) NOT NULL,
  `posto` varchar(100) NOT NULL,
  `status_` varchar(100) NOT NULL,
  `uf` varchar(100) NOT NULL,
  `uf_posto` varchar(100) NOT NULL,
  `sigla_gra` varchar(100) NOT NULL,
  `sigla_estacao` varchar(100) NOT NULL,
  `abertura` varchar(100) NOT NULL,
  `resolucao` varchar(100) NOT NULL,
  `data_promessa_ori` varchar(100) NOT NULL,
  `data_pri_apz2` varchar(100) NOT NULL,
  `data_aprazamento` varchar(100) NOT NULL,
  `ind_aprazamento` varchar(100) NOT NULL,
  `data_entrada` varchar(100) NOT NULL,
  `data_saida` varchar(100) NOT NULL,
  `inclusao_stc` varchar(100) NOT NULL,
  `tempo_bd_hora` varchar(100) NOT NULL,
  `tempo_tram_hora` varchar(100) NOT NULL,
  `cod_abertura` varchar(100) NOT NULL,
  `cod_encer_rep` varchar(100) NOT NULL,
  `cod_exame` varchar(100) NOT NULL,
  `segm` varchar(100) NOT NULL,
  `cod_localidade` varchar(100) NOT NULL,
  `local_` varchar(100) NOT NULL,
  `num_meio_acesso` varchar(100) NOT NULL,
  `num_circuito` varchar(100) NOT NULL,
  `tipo_reparo` varchar(100) NOT NULL,
  `nome_cliente` varchar(200) NOT NULL,
  `num_conglomerado_emp` varchar(100) NOT NULL,
  `veloc_circuito` varchar(100) NOT NULL,
  `data_inst` varchar(100) NOT NULL,
  `desc_livre_abertura` text NOT NULL,
  `desc_fechamento` text NOT NULL,
  `uf_ofensora` varchar(100) NOT NULL,
  `novo_segm` varchar(100) NOT NULL,
  `ident_atendente` varchar(100) NOT NULL,
  `matric_tecnico_resp` varchar(100) NOT NULL,
  `velocidade_kbps` varchar(100) NOT NULL,
  `faixa_veloc_1` varchar(100) NOT NULL,
  `faixa_veloc_2` varchar(100) NOT NULL,
  `conc` varchar(100) NOT NULL,
  `prazo` varchar(100) NOT NULL,
  `geografia` varchar(100) NOT NULL,
  `tp_conf` varchar(100) NOT NULL,
  `tp_cos` varchar(100) NOT NULL,
  `tp_eqpto` varchar(100) NOT NULL,
  `tp_even` varchar(100) NOT NULL,
  `tp_oemp` varchar(100) NOT NULL,
  `tp_ptfa` varchar(100) NOT NULL,
  `tp_rms` varchar(100) NOT NULL,
  `tp_tade` varchar(100) NOT NULL,
  `tp_cgs` varchar(100) NOT NULL,
  `tp_fcr` varchar(100) NOT NULL,
  `tp_fcrdc` varchar(100) NOT NULL,
  `tp_fcrde` varchar(100) NOT NULL,
  `tp_fcrvc` varchar(100) NOT NULL,
  `tp_fcrve` varchar(100) NOT NULL,
  `tp_sred` varchar(100) NOT NULL,
  `tp_tave` varchar(100) NOT NULL,
  `tp_tria` varchar(100) NOT NULL,
  `tp_fibra` varchar(100) NOT NULL,
  `tp_trans` varchar(100) NOT NULL,
  `tp_cld` varchar(100) NOT NULL,
  `tp_eiad` varchar(100) NOT NULL,
  `tp_parc` varchar(100) NOT NULL,
  `tp_dg` varchar(100) NOT NULL,
  `tp_redea` varchar(100) NOT NULL,
  `tp_slda` varchar(100) NOT NULL,
  `repetido` varchar(100) NOT NULL,
  `tp_pend_cli` varchar(100) NOT NULL,
  `prazo_real` varchar(100) NOT NULL,
  `tempo_bd_hs` varchar(100) NOT NULL,
  `dia_fechamento` varchar(100) NOT NULL,
  `ano_fechamento` varchar(100) NOT NULL,
  `segmento_b2b` varchar(100) NOT NULL,
  `grupo_causa_raiz` varchar(100) NOT NULL,
  `u_f` varchar(100) NOT NULL,
  `geografia_2` varchar(100) NOT NULL,
  `diretoria` varchar(100) NOT NULL,
  `prazo_2` varchar(100) NOT NULL,
  `mes_2` varchar(100) NOT NULL,
  `tempo_bd_hs_2` varchar(100) NOT NULL,
  `tempo_pend` varchar(100) NOT NULL,
  `tempo_em_andamento` varchar(100) NOT NULL,
  `data_armazenamento` varchar(10) NOT NULL,
  `hora_armazenamento` varchar(10) NOT NULL,
  `dia_armazenamento` varchar(10) NOT NULL,
  `mes_armazenamento` varchar(10) NOT NULL,
  `ano_armazenamento` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `base_reparos_r2`
--

CREATE TABLE `base_reparos_r2` (
  `id` int(10) NOT NULL,
  `arquivo` varchar(100) NOT NULL,
  `data_arquivo` varchar(100) NOT NULL,
  `filial` varchar(100) NOT NULL,
  `geo` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `data_encerramento` varchar(100) NOT NULL,
  `local_circuito` varchar(100) NOT NULL,
  `numero_circuito` varchar(100) NOT NULL,
  `situacao` varchar(100) NOT NULL,
  `codigo_abertura` varchar(100) NOT NULL,
  `data_abertura` varchar(100) NOT NULL,
  `codigo_encerramento` varchar(100) NOT NULL,
  `codigo_exame_linha` varchar(100) NOT NULL,
  `aprazado` varchar(100) NOT NULL,
  `data_promessa` varchar(100) NOT NULL,
  `data_mudanca_origem` varchar(100) NOT NULL,
  `tipo_circuito` varchar(100) NOT NULL,
  `tipo_classe` varchar(100) NOT NULL,
  `tipo_velocidade` varchar(100) NOT NULL,
  `classificacao` varchar(100) NOT NULL,
  `degrau_tarifario` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `cliente_ponta_a` varchar(100) NOT NULL,
  `cliente_ponta_b` varchar(100) NOT NULL,
  `tipo_cliente_ponta_a` varchar(100) NOT NULL,
  `tipo_cliente_ponta_b` varchar(100) NOT NULL,
  `localidade_ponta_a` varchar(100) NOT NULL,
  `endereco_ponta_a` varchar(100) NOT NULL,
  `localidade_ponta_b` varchar(100) NOT NULL,
  `endereco_ponta_b` varchar(100) NOT NULL,
  `cabo_ponta_a` varchar(100) NOT NULL,
  `cabo_ponta_b` varchar(100) NOT NULL,
  `caixa_ponta_a` varchar(100) NOT NULL,
  `caixa_ponta_b` varchar(100) NOT NULL,
  `armario_ponta_a` smallint(100) NOT NULL,
  `armario_ponta_b` varchar(100) NOT NULL,
  `par_primario_ponta_a` varchar(100) NOT NULL,
  `par_primario_ponta_b` varchar(100) NOT NULL,
  `par_secundario_ponta_a` varchar(100) NOT NULL,
  `par_secundario_ponta_b` varchar(100) NOT NULL,
  `estacao_ponta_a` varchar(100) NOT NULL,
  `estacao_ponta_b` varchar(100) NOT NULL,
  `matricula_irla_ponta_a` varchar(100) NOT NULL,
  `matricula_irla_ponta_b` varchar(100) NOT NULL,
  `macro_area_ponta_a` varchar(100) NOT NULL,
  `macro_area_ponta_b` varchar(100) NOT NULL,
  `centro_resultado_atual` varchar(100) NOT NULL,
  `data_despacho_ponta_a` varchar(100) NOT NULL,
  `data_despacho_ponta_b` varchar(100) NOT NULL,
  `subsequente` varchar(100) NOT NULL,
  `cpf_cnpj_ponta_a` varchar(100) NOT NULL,
  `cpf_cnpj_ponta_b` varchar(100) NOT NULL,
  `nrc_ponta_a` varchar(100) NOT NULL,
  `nrc_ponta_b` varchar(100) NOT NULL,
  `unidade_atual` varchar(100) NOT NULL,
  `data_atual` varchar(100) NOT NULL,
  `obs_atendente` text NOT NULL,
  `obs_unidade` text NOT NULL,
  `contrato` varchar(100) NOT NULL,
  `micro_area_ponta_a` varchar(100) NOT NULL,
  `micro_area_ponta_b` varchar(100) NOT NULL,
  `codigo_sla` varchar(100) NOT NULL,
  `codigo_segmento_ponta_a` varchar(100) NOT NULL,
  `codigo_segmento_ponta_b` varchar(100) NOT NULL,
  `empresa_pe_ponta_a` varchar(100) NOT NULL,
  `empresa_pe_ponta_b` varchar(100) NOT NULL,
  `empresa_pi_ponta_a` varchar(100) NOT NULL,
  `empresa_pi_ponta_b` varchar(100) NOT NULL,
  `empresa_fechamento_2` varchar(100) NOT NULL,
  `uf_ponta_a` varchar(100) NOT NULL,
  `uf_ponta_b` varchar(100) NOT NULL,
  `tipo_localidade_ponta_a` varchar(100) NOT NULL,
  `tipo_localidade_ponta_b` varchar(100) NOT NULL,
  `centro_resultado_ponta_a` varchar(100) NOT NULL,
  `centro_resultado_ponta_b` varchar(100) NOT NULL,
  `familia_produto` varchar(100) NOT NULL,
  `area_responsavel` varchar(100) NOT NULL,
  `area_ofensora` varchar(100) NOT NULL,
  `duas_pontas` varchar(100) NOT NULL,
  `defeito_repetido` varchar(100) NOT NULL,
  `no_prazo` varchar(100) NOT NULL,
  `preventivo` varchar(100) NOT NULL,
  `descartar` varchar(100) NOT NULL,
  `tempo_reparo` varchar(100) NOT NULL,
  `empresa_int_ponta_a` varchar(100) NOT NULL,
  `empresa_int_ponta_b` varchar(100) NOT NULL,
  `tipo_reclamacao` varchar(100) NOT NULL,
  `data_promessa_maxima` varchar(100) NOT NULL,
  `uso_adsl` varchar(100) NOT NULL,
  `porta_adsl` varchar(100) NOT NULL,
  `no_prazo_maximo` varchar(100) NOT NULL,
  `modem` varchar(100) NOT NULL,
  `tipo_modem` varchar(100) NOT NULL,
  `numero_de_terminais` varchar(100) NOT NULL,
  `segmento` varchar(100) NOT NULL,
  `repetido` varchar(100) NOT NULL,
  `no_column_name` varchar(100) NOT NULL,
  `no_column_name_2` varchar(100) NOT NULL,
  `ano_encerramento` varchar(100) NOT NULL,
  `segmento_b2b` varchar(100) NOT NULL,
  `grupo_causa_raiz` varchar(100) NOT NULL,
  `u_f` varchar(100) NOT NULL,
  `geografia` varchar(100) NOT NULL,
  `diretoria` varchar(100) NOT NULL,
  `no_prazo2` varchar(100) NOT NULL,
  `mes` varchar(100) NOT NULL,
  `reincidencia` varchar(100) NOT NULL,
  `tempo_bd_hs` varchar(100) NOT NULL,
  `data_armazenamento` varchar(10) NOT NULL,
  `hora_armazenamento` varchar(10) NOT NULL,
  `dia_armazenamento` varchar(10) NOT NULL,
  `mes_armazenamento` varchar(10) NOT NULL,
  `ano_armazenamento` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `meta`
--

CREATE TABLE `meta` (
  `id` int(10) NOT NULL,
  `regiao` varchar(50) NOT NULL,
  `mes` varchar(50) NOT NULL,
  `ano` varchar(50) NOT NULL,
  `meta` varchar(50) NOT NULL,
  `tp_meta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `planta_mensal`
--

CREATE TABLE `planta_mensal` (
  `id` int(10) NOT NULL,
  `indicador` varchar(50) NOT NULL,
  `diretoria` varchar(50) NOT NULL,
  `geografia` varchar(20) NOT NULL,
  `uf` varchar(10) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `mes` varchar(10) NOT NULL,
  `ano` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `permissoes` varchar(20) NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `base_bdON`
--
ALTER TABLE `base_bdON`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `base_bd_corr`
--
ALTER TABLE `base_bd_corr`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `base_reparos_r1`
--
ALTER TABLE `base_reparos_r1`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `base_reparos_r2`
--
ALTER TABLE `base_reparos_r2`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `planta_mensal`
--
ALTER TABLE `planta_mensal`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `base_bdON`
--
ALTER TABLE `base_bdON`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1324630;
--
-- AUTO_INCREMENT de tabela `base_bd_corr`
--
ALTER TABLE `base_bd_corr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54625;
--
-- AUTO_INCREMENT de tabela `base_reparos_r1`
--
ALTER TABLE `base_reparos_r1`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194290;
--
-- AUTO_INCREMENT de tabela `base_reparos_r2`
--
ALTER TABLE `base_reparos_r2`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47181;
--
-- AUTO_INCREMENT de tabela `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5296;
--
-- AUTO_INCREMENT de tabela `planta_mensal`
--
ALTER TABLE `planta_mensal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1121;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
