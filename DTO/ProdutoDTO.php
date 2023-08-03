<?php

require_once('Connection.php');

 function ListaProduto(){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "select * from Produto";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($produto = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center'>".$produto['ID_Produto']."</td>
        <td align = 'center'>".$produto['Descricao']."</td>
         <td align = 'center'>R$ ".number_format($produto['Preco'],2,",",".")."</td>
        <td>
          <button class='btn btn-warning' title='Editar' value='".$produto['ID_Produto']."' onclick='editar(this)'>
            <i class='fas fa-edit'></i>
            <button class='btn btn-danger' title='Excluir' value='".$produto['ID_Produto']."' onclick='excluir(this)'>
            <i class='fas fa-edit'></i>
         </td>   
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

function CadastroProduto($descricao,$preco,$tipo){

$conexao = new Conexao();
 
    $sql = "INSERT INTO Produto (Descricao,Preco,Tipo) 
            VALUES ('$descricao',$preco,$tipo);";
    
    mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;

}
function ExcluirProduto($id){

$conexao = new Conexao();
 
    $sql = "delete from Produto where ID_Produto =".$id;
    
    mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;

}


function ListaProdutoUnico($id){

 $conexao = new Conexao();

 $sql = "select * from Produto where ID_Produto =".$id;

  $exec = mysqli_query($conexao->getConexao(),$sql);
  
  $result = mysqli_fetch_assoc($exec);

  $retorno = json_encode($result);

  return $retorno;

}

function ListaProdutoVenda(){

 $conexao = new Conexao();

 $sql = "select ID_Produto,Descricao from produto order by Descricao asc";

  $exec = mysqli_query($conexao->getConexao(),$sql);

  $json = [];

 while($produto=  mysqli_fetch_assoc($exec)){
     $json[] = ['id'=>$produto['ID_Produto'], 'text'=>$produto['Descricao']];
}

  $retorno = json_encode($json);

  return $retorno;

}

function EditarProduto($id,$descricao,$preco){

$conexao = new Conexao();
 
    $sql = "UPDATE Produto set Descricao = '$descricao',Preco = $preco
            WHERE ID_Produto = $id";  
    mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;

}







?>