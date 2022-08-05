<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/ProdutoDTO.php');

$id = $_POST['id'];

echo ListaProdutoUnico($id);
 
?>