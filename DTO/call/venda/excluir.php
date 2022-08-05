<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/VendaDTO.php');

$idproduto = $_POST['idproduto'];
$idvenda = $_POST['idvenda'];
echo ExcluirProdutoVenda($idproduto,$idvenda);
 
?>