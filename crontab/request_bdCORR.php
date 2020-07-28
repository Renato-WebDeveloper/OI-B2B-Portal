<?php

$year = date('Y');
$month = date('m');

require "../connect_db/config.php";

 $curl = curl_init();
 curl_setopt_array($curl, array(
   CURLOPT_PORT => "80",
   CURLOPT_URL => "http://10.22.75.98/api/atividades/?atividade=BD_CORR_FE&dt_ref=".$year."-".$month."-01",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 30,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "GET",
 //  CURLOPT_HTTPHEADER => array(
 // "Authorization: Bearer ".$token,
 //  ),
 ));
 $response = curl_exec($curl); $err = curl_error($curl);
 //echo $response;
 curl_close($curl);
 if ($err) {
 // echo "<p>cURL Error #: " . $err . "</p>";
 } else {
  libxml_use_internal_errors(true);
  
  $dom = new DOMDocument();
  $dom->loadHTML($response);
  $dom->preserveWhiteSpace = false;
  // Initialize arrays
  $thArray = $tdArray = $array = array();
  
  // Get all Table Headers and throw them in an array
  //$th = $dom->getElementsByTagName('th');
  //foreach ( $th as $th ) {
  // $thArray[] = $th->nodeValue;
  // echo $th->nodeValue;
  //}
  
  // Get all Table Headers and throw them in an array
  $rows = $dom->getElementsByTagName('tr');
  foreach ($rows as $row) {
   $cols = $row->getElementsByTagName('td'); 
   if (isset($cols)){
    $j=1;
   }else{
    $j=0;
   }
   if (empty($cols -> item(0) -> nodeValue)){
    $j=0;
   }else{
    $j=1;
   }
   if ($j>0) {
    $protocolo   = trim( $cols -> item(0) -> nodeValue ); 
    $local   = trim( $cols -> item(1) -> nodeValue ); 
    $acesso = trim( $cols -> item(2) -> nodeValue ); 
    $_cliente = trim( $cols -> item(3) -> nodeValue ); 
    $servico = trim( $cols -> item(4) -> nodeValue ); 
    $produto = trim( $cols -> item(5) -> nodeValue ); 
    $uf = trim( $cols -> item(6) -> nodeValue ); 
    $gra = trim( $cols -> item(7) -> nodeValue ); 
    $_reinc_30 = trim( $cols -> item(8) -> nodeValue ); 
    $cod_encer = trim( $cols -> item(9) -> nodeValue ); 
    $uf_posto = trim( $cols -> item(10) -> nodeValue ); 
    $posto = trim( $cols -> item(11) -> nodeValue ); 
    $gra_posto = trim( $cols -> item(12) -> nodeValue ); 
    $abertura = trim( $cols -> item(13) -> nodeValue ); 
    $promessa = trim( $cols -> item(14) -> nodeValue ); 
    $aprazamento = trim( $cols -> item(15) -> nodeValue ); 
    $fechamento = trim( $cols -> item(16) -> nodeValue ); 

    $fechamento = explode('/',$fechamento);
    $dia = $fechamento[0];
    $mes = $fechamento[1];
    
    $array = explode(' ',$fechamento[2]);
    $ano = $array[0];
    $hora = $array[1];

    $data_fechamento = $ano."-".$mes."-".$dia." ".$hora;
    //echo $data_fechamento;


    $igq = trim( $cols -> item(17) -> nodeValue ); 
    $_velocidade = trim( $cols -> item(18) -> nodeValue ); 
    $segm = trim( $cols -> item(19) -> nodeValue ); 
    $estacao = trim( $cols -> item(20) -> nodeValue ); 

    $sql = "SELECT protocolo FROM base_bd_corr WHERE protocolo = '$protocolo'";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    if ($sql->rowCount()==0) {
        $sql = "INSERT INTO base_bd_corr (protocolo,local,acesso,_cliente,servico,produto,uf,gra_,_reinc_30,cod_encer,uf_posto,posto,gra_posto,abertura,
        promessa,aprazamento,fechamento,igq,_velocidade,segm,estacao) VALUES ('$protocolo','$local','$acesso','$_cliente','$servico','$produto','$uf',
        '$gra','$_reinc_30','$cod_encer','$uf_posto','$posto','$gra_posto','$abertura','$promessa','$aprazamento','$data_fechamento','$igq','$_velocidade',
        '$segm','$estacao')";
        $sql = $pdo->prepare($sql);
        $sql->execute();
    } else {
      $sql = "UPDATE base_bd_corr SET _reinc_30 = '$_reinc_30' WHERE protocolo = '$protocolo'";
      $sql = $pdo->prepare($sql);
      $sql->execute();
    }

   }
  }
  // count the array for future comparison
  $count = count($thArray);

 } 
 //################################ Fim Importação
 ?>