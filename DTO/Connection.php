<?php 

class Conexao{


public function getConexao(){

$conexao = mysqli_connect('localhost:3309','root','','Fabuloso');

if($conexao){

mysqli_query($conexao,"SET NAMES 'utf8'");
mysqli_query($conexao,'SET character_set_connection=utf8');
mysqli_query($conexao,'SET character_set_client=utf8');
mysqli_query($conexao,'SET character_set_results=utf8');


return $conexao;

}

else{

return mysqli_close();

}


}

public function FechaConexao($conexao){

  mysqli_close($conexao);


    $conexao = null;

}

}