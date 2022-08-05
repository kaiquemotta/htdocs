<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DTO/ProdutoDTO.php');


$id = $_POST['idedit'];
$desc = $_POST['descedit'];
$preco = $_POST['precoedit'];


echo EditarProduto($id,$desc,$preco);
 
?>