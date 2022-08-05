<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/VendaDTO.php');


$idvenda = $_POST['idvenda'];

ImprimeVenda("EPSON",$idvenda);
ImprimeCozinha("EPSON",$idvenda);
 
?>