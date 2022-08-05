<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/VendaDTO.php');

date_default_timezone_set('America/Sao_Paulo');
$data = date("Y-m-d");

FechamentoCaixa($data);


 
?>