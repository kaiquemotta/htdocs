<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/VendaDTO.php');


$idvenda = $_POST['idvenda'];
$total = $_POST['totalpgto'];
$tipopgto = $_POST['tipopgto'];
$obs = $_POST['obs'];


echo FinalizaVenda($idvenda,$total,$tipopgto,$obs);
 
?>