<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fabuloso|Venda</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap4.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="/plugins/select2/css/select2.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include("../includes/navbar.php"); ?>
    <?php include("../includes/sidebar.php"); ?>
     <div class="content-wrapper">
      <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vendas PDV</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Vendas PDV</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Venda PDV</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <select class="form-control" id="produto">
                    </select>
                    <input type="hidden" id="idvenda" value="0">             
                  </div>
                <table class="table" id="tabelaitem">
                   <thead>
                    <tr>
                    <th style="width:50%">Produto</th>
                    <th>Preço</th>
                    <th>Qtd</th>
                    <th>Subtotal</th>
                    <th>Excluir</th>
                   </tr>
                  </thead>
                   <tbody id="divitens">
                   </tbody> 
                     <tfoot id="totalvenda">
                   </tfoot>
                </table>
                </div>
                 </form>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-danger" onclick='cancelarVenda();'>Cancelar Venda</button>
                  <button type="button" data-toggle="modal" data-target="#modalPagamento" class="btn btn-success" style="margin-left:72%" onclick="listarPagamento()">Pagamento</button>
                </div>
                </div>
            </div>
          </div>
        </div>
    </section>
            <!-- /.card -->
<div class="modal fade col-xs-12" id="modalPagamento" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form enctype="multipart/form-data" name="formProduto" id="formProduto" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pagamentos</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group">
                                <label for="razao" class="control-label">Valor Pago</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="vlrpago" name="vlrpago">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group">
                                <label for="razao" class="control-label">Pagar em</label>
                                <div class="controls">
                                    <select name="pgto" id="pgto" class="form-control">
                                      <option value="1"> Dinheiro </option>
                                       <option value="2"> Outros </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="razao" class="control-label">Observações</label>
                                <div class="controls">
                                    <textarea class="form-control" id="obs" name="obs"></textarea> 
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group">
                                <label for="razao" class="control-label">Total de Itens</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="totalitens" name="totalitens" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group">
                                <label for="razao" class="control-label">Total Pago</label>
                                <div class="controls">
                                  <input type="text" class="form-control" id="totalpago" name="totalpago" readonly="">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group">
                                <label for="razao" class="control-label">Total a Pagar</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="totalpagar" name="totalpagar" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="form-group">
                                <label for="razao" class="control-label">Troco</label>
                                <div class="controls">
                                  <input type="text" class="form-control" id="troco" name="troco" readonly="">
                                </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btncadastrar" name="btncadastrar" onclick="finalizar()">Finalizar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                </div>
           
            </div>
        </form>
    </div>
  </div>

    </div>
      
    <?php include("../includes/footer.php"); ?>
  </div>
</body>
  <script>

       $(document).ready(function () {
        $.ajax({
            type: "post",
            url: "/DTO/call/produto/ListarCombo.php",
            data: { empresa: $("#produto").val() },
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function (obj) {
                if (obj != null) {
                    var data = obj;
                    var selectbox = $('#produto');
                    selectbox.find('option').remove();
                    $.each(data, function (i, d) {
                        $('<option>').val(d.id).text(d.text).appendTo(selectbox);
                    });
                }
            }
        });

    });
  
   $("#produto").select2();
  function realParaNumber(valor){
      
      if(valor === ""){
         valor =  0;
      }else{
         valor = valor.replace(".","");
         valor = valor.replace(",",".");
         valor = parseFloat(valor);
      }
      return valor;

   }
    function converteFloatMoeda(valor){
      var inteiro = null, decimal = null, c = null, j = null;
      var aux = new Array();
      valor = ""+valor;
      c = valor.indexOf(".",0);
      //encontrou o ponto na string
      if(c > 0){
         //separa as partes em inteiro e decimal
         inteiro = valor.substring(0,c);
         decimal = valor.substring(c+1,valor.length);
      }else{
         inteiro = valor;
      }
      
      //pega a parte inteiro de 3 em 3 partes
      for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
         aux[c]=inteiro.substring(j-3,j);
      }
      
      //percorre a string acrescentando os pontos
      inteiro = "";
      for(c = aux.length-1; c >= 0; c--){
         inteiro += aux[c]+'.';
      }
      //retirando o ultimo ponto e finalizando a parte inteiro
      
      inteiro = inteiro.substring(0,inteiro.length-1);
      
      decimal = parseInt(decimal);
      if(isNaN(decimal)){
         decimal = "00";
      }else{
         decimal = ""+decimal;
         if(decimal.length === 1){
            decimal = decimal+"0";
         }
      }
      decimal = ""+decimal+"";
      decimal = decimal.substr(0,2);
      
      valor = "R$:"+inteiro+","+decimal;
      
      
      return valor;

   }

           AbreVenda();

           $("#vlrpago").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});


      function cancelarVenda(){

         var confirm1 = false;
  
   confirm1 = confirm("Deseja Realmente Cancelar a Venda?");

      if (confirm1 == true){

        window.location.reload();
      }


      }     

     function table(){
    $('#tabelaitem').DataTable({
      "language": {
      "info": "Exibindo _START_ de _END_ no total de _TOTAL_ registros",
      "emptyTable": "Não há produtos nessa venda.",
      "paginate": {
      "previous": "Anterior",
       "next": "Proximo"
        }
        },
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
   }
        

function listar(){

  var idvenda = $("#idvenda").val();
  $.ajax({
    type: "POST",
    url: "/DTO/call/venda/listar.php",
    data: {idvenda:idvenda},
    success: function (result) {
      $("#divitens").html(result);
      table();
    },
    error: function() {
    }
  });
}

function listarPagamento(){
  $("#vlrpago").val("");
   $("#totalitens").val("");
   $("#totalpagar").val("");
    $("#totalpago").val("");
   $("#troco").val("");
 
  var idvenda = $("#idvenda").val();
  $.ajax({
    type: "POST",
    url: "/DTO/call/venda/listarTot.php",
    data: {idvenda:idvenda},
    success: function (result) {
      var aux = JSON.parse(result);
    $('#totalpagar').val("R$:"+aux.Total);
     $('#totalitens').val(aux.TotalItem);
    },
    error: function() {
    }
  });
}


function excluir(id) {

   var confirm1 = false;
  
   confirm1 = confirm("Deseja Realmente Excluir o Produto?");
  
   var data = {idproduto:$(id).val(),idvenda:$('#idvenda').val()};
    if(confirm1 == true){
    $.ajax({
      type: "POST",
      url: "/DTO/call/venda/excluir.php",
      data:  data,
      success: function (result) {
        if (result == 1) {

          var table = $("#tabelaitem").dataTable();
            table.dataTable().fnDestroy();
            listarTotal();
            listar();

        }
      },
      error: function() {
      }
    });
  }
}

function listarTotal(){

  var idvenda = $("#idvenda").val();
  $.ajax({
    type: "POST",
    url: "/DTO/call/venda/listarTotal.php",
    data: {idvenda:idvenda},
    success: function (result) {
      $("#totalvenda").html(result);
    },
    error: function() {
    }
  });
}

 
      
      
    

     function AbreVenda(){

       $.ajax({
      type: "POST",
      url: "/DTO/call/venda/abrevenda.php",
      data:  null,
      success: function (result) {
           $('#idvenda').val(result);
           listar();     

      },
      error: function() {
      }
    });

     }

     function AdicionaProdutoVenda(idvenda,idproduto,quantidade){

        $.ajax({
      type: "POST",
      url: "/DTO/call/venda/adicionaitemvenda.php",
     data: {idvenda:idvenda,idproduto:idproduto,quantidade:quantidade},
      success: function (result) {


      var table = $("#tabelaitem").dataTable();
            table.dataTable().fnDestroy();
            listarTotal();
            listar();


        //$("#produto").val('').trigger('change');

           

      },
      error: function() {
      }
    });
     }


   $("#produto").change(function() {

      var venda = $('#idvenda').val();
      var produto = $('#produto').val();
      var qtd = 1;

      AdicionaProdutoVenda(venda,produto,qtd);
      $("#produto").val(null);

    
      });

     $("#vlrpago").change(function() {
        attPgto();
    
      });

   function attPgto(){
    var totalpgto = null;
    var idvenda = $("#idvenda").val();
  $.ajax({
    type: "POST",
    url: "/DTO/call/venda/listarPgto.php",
    data: {idvenda:idvenda},
    success: function (result) {
      var aux = JSON.parse(result);
      totalpgto = aux.Total;
       var valor = realParaNumber($('#vlrpago').val());
      console.log("Valor:"+valor+"total:"+totalpgto);      
      if(valor < totalpgto){
        alert("Valor menor que o Total a Pagar");
        $('#modalPagamento').modal('hide');

        return;
      }

      $('#troco').val(converteFloatMoeda((valor - totalpgto)));
      $('#totalpago').val(converteFloatMoeda(valor)); 
    },
    error: function() {
    }
  });

}


function finalizar(){


if($("#totalpago").val() != "" & $("#troco").val() !=""){

 var confirm1 = false;
  
   confirm1 = confirm("Deseja Realmente Finalizar a Venda?");

   if(confirm1 == true){
    var totalpgto = $("#totalpagar").val();
    totalpgto = totalpgto.replace("R$:","");
    totalpgto = realParaNumber(totalpgto);
    var idvenda = $("#idvenda").val();
    var tipopgto = $("#pgto").val();
    var obs = $("#obs").val();
      $.ajax({
    type: "POST",
    url: "/DTO/call/venda/finalizavenda.php",
    data: {idvenda:idvenda,totalpgto:totalpgto,tipopgto:tipopgto,obs:obs},
    success: function (result) {
      if(result == 1){
          $.ajax({
    type: "POST",
    url: "/DTO/call/venda/imprime.php",
     data: {idvenda:idvenda},
    success: function (result) {
      alert("Venda Emitida com Sucesso");
      document.location.reload(true);
      
    },
    error: function() {
    }
  });

      }

    },
    error: function() {
    }
  });


   }

}


}


function add(id){
  $.ajax({
    type: "POST",
    url: "/DTO/call/venda/attQtd.php",
    data: {idprod:id},
    success: function (result) {
       var table = $("#tabelaitem").dataTable();
            table.dataTable().fnDestroy();
            listarTotal();
            listar();

    },
    error: function() {
    }
  });




}
 </script> 
}
</html> 