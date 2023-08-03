<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];
require_once('Connection.php');
require_once($raiz.'/plugins/autoload.php');
require_once($raiz.'/plugins/mpdf60/mpdf.php');
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;



function CadastroVenda(){

$conexao = new Conexao();
 
    $sql = "call AbreVenda()";
    
   $exec = mysqli_query($conexao->getConexao(),$sql);

    $retorno = mysqli_fetch_assoc($exec);
    
    $retorno = $retorno['ID_Venda']; 
    
    $conexao->FechaConexao($conexao->getConexao());
  
    return $retorno;

}

function CadastroItemVenda($idvenda,$idproduto,$qtd){

$conexao = new Conexao();

$existe = VerificaItemVenda($idvenda,$idproduto);

 if($existe == 0){

  $sql = "Insert into item_venda (FK_Produto,FK_Venda,Quantidade) values (".$idproduto.",".$idvenda.",".$qtd.")";
 }

 else{

 $sql = "update item_venda set Quantidade = Quantidade +".$qtd."
where FK_Venda = ".$idvenda." and FK_Produto =".$idproduto."";

 }
 

  mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;


}


function VerificaItemVenda($idvenda,$idproduto){

$conexao = new Conexao();

$sql = "select count(FK_Produto) as cont from item_venda where FK_Venda = ".$idvenda." and FK_Produto = ".$idproduto;

$exec = mysqli_query($conexao->getConexao(),$sql);

 $retorno = mysqli_fetch_assoc($exec);
    
    $retorno = $retorno['cont']; 
    
    $conexao->FechaConexao($conexao->getConexao());
  
    return $retorno;


}

function VerificarQuantidadeItemVenda($idvenda,$idproduto){

$conexao = new Conexao();

$sql = "select Quantidade as cont from item_venda where FK_Venda = ".$idvenda." and FK_Produto = ".$idproduto;

$exec = mysqli_query($conexao->getConexao(),$sql);

 $retorno = mysqli_fetch_assoc($exec);
    
    $retorno = $retorno['cont']; 
    
    $conexao->FechaConexao($conexao->getConexao());
  
    return $retorno;


}

 function ListaItemVenda($idvenda){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "select iv.ID_Item_Venda as cod, p.ID_Produto,p.Descricao,p.Preco,iv.Quantidade,(p.Preco * iv.Quantidade) as SubTotal
from item_venda as iv
inner join produto p on iv.FK_Produto = P.ID_Produto where iv.FK_Venda =".$idvenda;

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($produto = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center'>".$produto['Descricao']."</td>
        <td align = 'left'>R$ ".number_format($produto['Preco'],2,",",".")."</td>
        <td>".$produto['Quantidade'].  "<i class='fa fa-plus' style='padding-left:10%' aria-hidden='true' onclick='add(".$produto['cod'].")'></i></td>
         <td align = 'left'>R$ ".number_format($produto['SubTotal'],2,",",".")."</td>
        <td>
            <button class='btn btn-danger' type='Button' title='Excluir' value='".$produto['ID_Produto']."' onclick='excluir(this)'>
            <i class='fas fa-trash'></i>
         </td>   
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

 function TotalVenda($idvenda){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "
select sum(p.Preco * iv.Quantidade) as Total
from item_venda as iv
inner join produto p on iv.FK_Produto = P.ID_Produto where iv.FK_Venda =".$idvenda;

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($produto = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."

         <td colspan='4'><b>Total a Pagar:</b> 
         <td colspan='1'><b>R$ ".number_format($produto['Total'],2,",",".")."</b>
     ";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

 function TotalQtdPagamento($idvenda){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "select sum(p.Preco * Quantidade) as Total,sum(Quantidade) as TotalItem from venda v
inner join item_venda iv on v.ID_venda = iv.FK_Venda
inner join produto p on p.ID_Produto = iv.FK_Produto
where v.ID_Venda =".$idvenda;

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);


 $resultado = mysqli_fetch_assoc($resultado);

 $resultado['Total'] = number_format($resultado['Total'],2,",",".");
 $resultado = json_encode($resultado);

  $conexao->FechaConexao($conexao->getConexao());

  return $resultado;

}

function TotalPagamento($idvenda){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "select sum(p.Preco * Quantidade) as Total,sum(Quantidade) as TotalItem from venda v
inner join item_venda iv on v.ID_venda = iv.FK_Venda
inner join produto p on p.ID_Produto = iv.FK_Produto
where v.ID_Venda =".$idvenda;

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);


 $resultado = mysqli_fetch_assoc($resultado);

 $resultado = json_encode($resultado);

  $conexao->FechaConexao($conexao->getConexao());

  return $resultado;

}



function ExcluirProdutoVenda($idproduto,$idvenda){

$conexao = new Conexao();

    $quantidade =  VerificarQuantidadeItemVenda($idvenda,$idproduto);

    if($quantidade == 1){
    $sql = "delete from item_venda where FK_Produto =".$idproduto." AND FK_Venda=".$idvenda;
    }
    else{

      $sql = "update item_venda set Quantidade = Quantidade - 1  where FK_Produto =".$idproduto." AND FK_Venda=".$idvenda;
    }
    mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;

}


function FinalizaVenda($idvenda,$total,$tipo,$obs){

 $conexao = new Conexao();


$sql = "insert into pagamento_venda (FK_Venda,Pagamento,Valor) values(".$idvenda.",".$tipo.",".$total.")";

 mysqli_query($conexao->getConexao(),$sql);

 if($obs != null){
  $sql = "update Venda set Observacao ='".$obs."' where ID_Venda = ".$idvenda;
 mysqli_query($conexao->getConexao(),$sql);
 }

   $conexao->FechaConexao($conexao->getConexao());

    echo 1;

}

function ImprimeVenda($impressora,$idvenda){
  $raiz = $_SERVER['DOCUMENT_ROOT'];

$conexao = new Conexao();

$nomeimpressora = $impressora;
$connector = new WindowsPrintConnector($nomeimpressora);
$printer = new Printer($connector);


$sql = "select p.Descricao,iv.Quantidade,(iv.Quantidade * p.Preco) as SubTotal from venda v
inner join item_venda iv on iv.FK_Venda = v.ID_Venda
inner join produto p on iv.FK_Produto = p.ID_Produto 
where v.ID_Venda =".$idvenda;


$exec = mysqli_query($conexao->getConexao(),$sql);

$sql2 = "select sum(iv.Quantidade) as TotalItens,sum(p.Preco * iv.Quantidade) as Total from venda v
inner join item_venda iv on iv.FK_Venda = v.ID_Venda
inner join produto p on iv.FK_Produto = p.ID_Produto 
where v.ID_Venda =".$idvenda;

$exec2 = mysqli_query($conexao->getConexao(),$sql2);

$rs = mysqli_fetch_assoc($exec2);
$totalItens = $rs['TotalItens'];
$total = $rs['Total'];
date_default_timezone_set('America/Sao_Paulo');
$data = date("d/m/Y",time());
$hora = date("H:i",time());

/* Initialize */
$printer -> initialize();


/* Font modes */
/* Font modes */
$modes = array(
    Printer::MODE_FONT_B,
    Printer::MODE_EMPHASIZED,
    Printer::MODE_DOUBLE_HEIGHT,
    Printer::MODE_DOUBLE_WIDTH,
    Printer::MODE_UNDERLINE);
  
     // Fonte 56 grande 8 pequeno
    $printer -> selectPrintMode(56);
    // Imagem
    $logo = EscposImage::load($raiz."/imagens/logo.png", false);
    $printer -> graphics($logo, 1);

     // Cabeçalho
    
    $printer -> text("PEDIDO N:".$idvenda."\n");
    $printer -> feed(1);
    // Corpo
     
      $printer -> selectPrintMode(8);
      $printer->text("______________________________________________\n");
      $printer -> selectPrintMode(56);
      $printer->text("\n");
      $printer -> selectPrintMode(8);
      $printer->text("Descricão             Qtd          Sub Total\n");
      $printer->text("______________________________________________\n");

     //
      $printer->text("\n");
      //
      $printer -> selectPrintMode(8);
      while($rs = mysqli_fetch_assoc($exec)){

        $descricao = $rs['Descricao'];

        if(strlen($descricao) < 18){
          $quantidade = strlen($descricao);
          while($quantidade < 18){

            $descricao = $descricao." ";
            $quantidade = $quantidade +1;
          }


        }

       if(strlen($descricao) > 19){


         $descricao = substr($descricao,0,18);

       }

      $printer->text($descricao);
       $printer->text("     ".$rs['Quantidade']);
        $printer->text("             "."R$ ".$rs['SubTotal']."\n");
      $printer -> feed(1);
    }
      $printer->text("______________________________________________\n");
      $printer->text("\n\n");
      $printer -> selectPrintMode(8);
      $printer->text("Total de Itens:".$totalItens."       Valor Total R$ ".$total."\n");
      $printer->text("\n");
      $printer->text("______________________________________________\n");
      $printer -> selectPrintMode(8);
      $printer->text("Data:".$data."             Hora  ".$hora."\n");



     $printer -> feed(1);
    $printer ->cut();



/* Pulse */
$printer -> pulse();

/* Always close the printer! On some PrintConnectors, no actual
 * data is sent until the printer is closed. */
$printer -> close();


}

function ImprimeCozinha($impressora,$idvenda){
 $raiz = $_SERVER['DOCUMENT_ROOT'];
$nomeimpressora = $impressora;
$connector = new WindowsPrintConnector($nomeimpressora);
$printer = new Printer($connector);

 $conexao = new Conexao();

 $sql = "select p.Descricao,iv.Quantidade,v.Observacao from venda v
inner join item_venda iv on iv.FK_Venda = v.ID_Venda
inner join produto p on iv.FK_Produto = p.ID_Produto 
where p.Tipo = 1 and v.ID_Venda =".$idvenda;

 $exec = mysqli_query($conexao->getConexao(),$sql);



/* Initialize */
$printer -> initialize();


/* Font modes */
/* Font modes */
$modes = array(
    Printer::MODE_FONT_B,
    Printer::MODE_EMPHASIZED,
    Printer::MODE_DOUBLE_HEIGHT,
    Printer::MODE_DOUBLE_WIDTH,
    Printer::MODE_UNDERLINE);
  
     // Fonte 56 grande 8 pequeno
    $printer -> selectPrintMode(56);
    // Imagem
     $logo = EscposImage::load($raiz."/imagens/logo.png", false);
    $printer -> graphics($logo, 1);

     // Cabeçalho
    
    $printer -> feed(2);
    $printer -> text("PEDIDO N:".$idvenda."\n");
    $printer -> feed(1);
    // Corpo
     
      $printer -> selectPrintMode(8);
      $printer->text("_____________________________________________\n");
      $printer -> selectPrintMode(56);
      $printer->text("\n\n");

      $printer -> selectPrintMode(56);
      $obs = "";
      while($rs = mysqli_fetch_assoc($exec)){
       $obs = $rs['Observacao'];
      $printer->text("".$rs['Quantidade']." - ".$rs['Descricao']."\n");
      $printer -> feed(1);
    }

      if($obs != null){ 
      $printer -> selectPrintMode(56);
      $printer->text("**OBS :".$obs);
    }

     $printer -> feed(1);
    $printer ->cut();



/* Pulse */
$printer -> pulse();

/* Always close the printer! On some PrintConnectors, no actual
 * data is sent until the printer is closed. */
$printer -> close();


}
function FechamentoCaixa($data){
 
 $conexao = new Conexao();

  $sql =  "select sum(p.Preco * iv.Quantidade) as Total, 
CASE 
WHEN pv.Pagamento = 1 THEN 'Dinheiro'
WHEN pv.Pagamento = 2 THEN 'Cartão'
WHEN pv.Pagamento = 3 THEN 'Pix'
ELSE 'Outros' END as Pagamento
from venda v inner join 
item_venda iv on v.ID_Venda = iv.FK_Venda inner join 
produto p on p.ID_Produto = iv.Fk_Produto inner join 
pagamento_venda pv on pv.FK_Venda = v.ID_Venda
where v.DataVenda like '%".$data."%'
group by pv.Pagamento";


 $exec = mysqli_query($conexao->getConexao(),$sql);

    $raiz = $_SERVER['DOCUMENT_ROOT'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');

   $html = "
 <fieldset>
 <h1>Fechamento de Caixa ".$data."</h1>";

  
   $total = 0;
   while($rs = mysqli_fetch_assoc($exec)){
    
  $html= $html. "<p class='center sub-titulo'>".$rs["Pagamento"]." - <strong>R$ ".number_format($rs['Total'],2,',','.')."</strong> </p>";

  $total = $total + $rs['Total'];
 }

  $html= $html. "<p class='center sub-titulo'> Total - <strong>R$ ".number_format($total,2,',','.')."</strong> </p>";


echo($html);

 exit;
}


function ListaRelatorio($data){



$data = explode("-",$data);
$data[0] = date("Y-m-d", strtotime($data[0]));
$data[1] = date("Y-m-d", strtotime($data[1]));
$datainicio = $data[0]." 00:00:00";
$datafim = $data[1]." 23:59:59";





 $conexao = new Conexao();

$sql = "select v.ID_Venda as CodigoVenda,sum(iv.Quantidade) as Quantidade,sum(p.Preco * iv.Quantidade) as Total,v.DataVenda
from venda v inner join 
item_venda iv on v.ID_Venda = iv.FK_Venda inner join 
produto p on p.ID_Produto = iv.Fk_Produto inner join 
pagamento_venda pv on pv.FK_Venda = v.ID_Venda
where v.DataVenda >= '".$datainicio."' AND v.DataVenda <='".$datafim."' group by CodigoVenda";




 $resultado = mysqli_query($conexao->getConexao(), $sql);
 


  while($produto = mysqli_fetch_assoc($resultado)){
    $retorno = $retorno."
      <tr>
        <td align = 'center'>".date("d/m/Y",strtotime($produto['DataVenda']))."</td>
        <td align = 'center'>".$produto['CodigoVenda']."</td>
        <td align = 'center'>".$produto['Quantidade']."</td>
         <td align = 'center'>R$ ".number_format($produto['Total'],2,",",".")."</td> 
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());


  return $retorno;


}

function ListaTotalRelatorio($data){



$data = explode("-",$data);
$data[0] = date("Y-m-d", strtotime($data[0]));
$data[1] = date("Y-m-d", strtotime($data[1]));
$datainicio = $data[0]." 00:00:00";
$datafim = $data[1]." 23:59:59";





 $conexao = new Conexao();

$sql = "select v.ID_Venda as CodigoVenda,sum(iv.Quantidade) as Quantidade,sum(p.Preco * iv.Quantidade) as Total,v.DataVenda
from venda v inner join 
item_venda iv on v.ID_Venda = iv.FK_Venda inner join 
produto p on p.ID_Produto = iv.Fk_Produto inner join 
pagamento_venda pv on pv.FK_Venda = v.ID_Venda
where v.DataVenda >= '".$datainicio."' AND v.DataVenda <='".$datafim."'";



 $resultado = mysqli_query($conexao->getConexao(), $sql);
 


  while($produto = mysqli_fetch_assoc($resultado)){
    $retorno = $retorno."

        <tr>
        <td align = 'center'></td>
         <td align = 'center'></td>
         <td align = 'center'><b>".$produto['Quantidade']."</b></td> 
         <td align = 'center'><b>R$ ".number_format($produto['Total'],2,",",".")."</b></td> 
      </tr>
     ";
  }

  $conexao->FechaConexao($conexao->getConexao());


  return $retorno;


}

function ListaRelatorioProduto($data){



$data = explode("-",$data);
$data[0] = date("Y-m-d", strtotime($data[0]));
$data[1] = date("Y-m-d", strtotime($data[1]));
$datainicio = $data[0]." 00:00:00";
$datafim = $data[1]." 23:59:59";





 $conexao = new Conexao();

$sql = "select p.Descricao as Produto,sum(iv.Quantidade) as Quantidade,sum(p.Preco * iv.Quantidade) as Total
from venda v inner join 
item_venda iv on v.ID_Venda = iv.FK_Venda inner join 
produto p on p.ID_Produto = iv.Fk_Produto inner join 
pagamento_venda pv on pv.FK_Venda = v.ID_Venda
where v.DataVenda >= '".$datainicio."' AND v.DataVenda <='".$datafim."' group by Produto";




 $resultado = mysqli_query($conexao->getConexao(), $sql);




  while($produto = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center'>".$produto['Produto']."</td>
        <td align = 'center'>".$produto['Quantidade']."</td>
         <td align = 'center'>R$ ".number_format($produto['Total'],2,",",".")."</td> 
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  echo $retorno;die;

  return $retorno;


}

function ListaTotalRelatorioProduto($data){



$data = explode("-",$data);
$data[0] = date("Y-m-d", strtotime($data[0]));
$data[1] = date("Y-m-d", strtotime($data[1]));
$datainicio = $data[0]." 00:00:00";
$datafim = $data[1]." 23:59:59";





 $conexao = new Conexao();

$sql = "select p.Descricao as Produto,sum(iv.Quantidade) as Quantidade,sum(p.Preco * iv.Quantidade) as Total
from venda v inner join 
item_venda iv on v.ID_Venda = iv.FK_Venda inner join 
produto p on p.ID_Produto = iv.Fk_Produto inner join 
pagamento_venda pv on pv.FK_Venda = v.ID_Venda
where v.DataVenda >= '".$datainicio."' AND v.DataVenda <='".$datafim."'";



 $resultado = mysqli_query($conexao->getConexao(), $sql);
 


  while($produto = mysqli_fetch_assoc($resultado)){
    $retorno = $retorno."

        <tr>
        <td align = 'center'></td>
         <td align = 'center'><b>".$produto['Quantidade']."</b></td> 
         <td align = 'center'><b>R$ ".number_format($produto['Total'],2,",",".")."</b></td> 
      </tr>
     ";
  }

  $conexao->FechaConexao($conexao->getConexao());


  return $retorno;


}

 function AttQtd($id){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "update item_venda set Quantidade = Quantidade +1  where ID_Item_Venda =".$id;

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);


  $conexao->FechaConexao($conexao->getConexao());

  return 1;

}


?>