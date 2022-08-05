<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/VendaDTO.php');

$idprod = $_POST['idprod'];

echo AttQtd($idprod);
 
?>