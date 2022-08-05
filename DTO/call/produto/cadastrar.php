<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/ProdutoDTO.php');

$descricao = $_POST['desc'];
$preco = $_POST['preco'];
$tipo = $_POST['tipo'];

echo CadastroProduto($descricao,$preco,$tipo);
 
?>