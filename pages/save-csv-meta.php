<?php 
require "../template/template_full.php"; 

use src\Classes\Csv\Csv as Csv;
use src\Classes\Telegram\Telegram as Telegram;

if($user->permissions('ADMIN')) {

} else {
	?><script type="text/javascript">window.location.href="403.html";</script><?php
}


$directory = '/var/www/html/OI-B2B-Portal/uploads/meta/';
$file_csv = ($_FILES['userfile']['name']);
$file_temp = ($_FILES['userfile']['tmp_name']);
$file_directory = $directory.basename($file_csv);

$csv = new Csv($pdo);

$chat_id="956137999";
$token="1249615584:AAEBrojFt5ggJ465pbZyjLl6KeLcIPw_iRE";
$bot = new Telegram($chat_id, $token);

if (file_exists($file_directory)) {
	$message = ("Olá Grande mestre! Tentativa de envio de arquivo frustrada... Tentarei novamente! ");
	$bot->sendMessage($message);
	?><script type="text/javascript">window.location.href="upload-csv-report.php";</script><?php
} else {
	move_uploaded_file($file_temp, $file_directory);
	if($csv->insertMetaIntoTheDb($file_directory)) {
		$message = ("Olá Grande mestre! A meta do ano acaba de ser atualizado e encontra-se no diretório padrão ");
		$bot->sendMessage($message);
		?><script type="text/javascript">window.location.href="upload-csv-report.php";</script><?php
	} else {
		$message = ("ATENÇÃO - Erro na execução da query de armazenamento da planilha! VERIFIQUE COM URGÊNCIA O ARQUIVO DE CLASSE DO CSV");
		$bot->sendMessage($message);
		?><script type="text/javascript">window.location.href="upload-csv-report.php";</script><?php
	}
}


require "../template/template_footer.php"; ?>