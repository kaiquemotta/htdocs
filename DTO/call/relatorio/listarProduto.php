<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/VendaDTO.php');


$data = $_POST['datain'];

echo ListaRelatorioProduto($data);
 
?>