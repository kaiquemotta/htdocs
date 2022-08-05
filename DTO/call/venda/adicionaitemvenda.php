<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/VendaDTO.php');

$idvenda = $_POST['idvenda'];
$idproduto = $_POST['idproduto'];
$quantidade = $_POST['quantidade'];

echo CadastroItemVenda($idvenda,$idproduto,$quantidade);
 
?>