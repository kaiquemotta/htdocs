<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fabuloso|Produtos</title>
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
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include("../includes/navbar.php"); ?>
    <?php include("../includes/sidebar.php"); ?>
       <div class="content-wrapper">
          <div class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                <div class="col-sm-6">
            <h1>Controle de Produtos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Controle de Produtos</li>
            </ol>
          </div>
        </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalAdd">Adicionar Produto</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="produto" class="table table-bordered table-hover">
                <thead>
                  <tr>
                  <th style="text-align:center">Código do Produto</th>
                  <th style="text-align:center">Descrição do Produto</th>
                  <th style="text-align:center">Preço</th>
                  <th>Opções</th>
                </tr>
                </thead>
                <tbody id="produtoresultado">
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
            </div>
          </div>
        </section>


      </div>
    </div>
  </div>
  <div class="modal fade col-xs-12" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form enctype="multipart/form-data" name="formProduto" id="formProduto" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastro de Produto</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="razao" class="control-label">Descrição do Produto</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="desc" name="desc">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="razao" class="control-label">Tipo</label>
                                <div class="controls">
                                    <select class="form-control" id="tipo" name="tipo">
                                      <option value="1">Comida</option>
                                      <option value="2">Bebida</option>
                                      <option value="3">Outros</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="razao" class="control-label">Preço</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="preco" name="preco">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btncadastrar" name="btncadastrar" onclick="adicionar()">Adicionar</button>
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
  <!-- Modal de Editar -->
    <div class="modal fade col-xs-12" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form enctype="multipart/form-data" name="formProdutoEdit" id="formProdutoEdit" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Produto</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="razao" class="control-label">Descrição do Produto</label>
                                <div class="controls">
                                   <input type="text" class="form-control" id="idedit" name="idedit" type="readonly" style="display: none">
                                    <input type="text" class="form-control" id="descedit" name="descedit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="razao" class="control-label">Preço</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="precoedit" name="precoedit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btncadastrar" name="btncadastrar" onclick="editarSave()">Salvar</button>
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
    <?php include("../includes/footer.php"); ?>
  </div>
</body>
<script>
   function table(){
    $('#produto').DataTable({
      "language": {
      "info": "Exibindo _START_ de _END_ no total de _TOTAL_ registros",
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
  $.ajax({
    type: "POST",
    url: "/DTO/call/produto/listar.php",
    data: null,
    dataType: "html",
    success: function (result) {
      $("#produtoresultado").html(result);
      table();
    },
    error: function() {
    }
  });
}

function adicionar() {


  if ($("#formProduto").valid()) {
  var descricao = document.getElementById('desc').value;
  var tipo = document.getElementById('tipo').value;
   var preco = document.getElementById('preco').value;
  $.ajax({
    type: "POST",
    url: "/DTO/call/produto/cadastrar.php",
    data: { desc: descricao,preco:preco,tipo:tipo },
    success: function(result) {
        if(result == 1){

            var table = $("#produto").dataTable();
            table.dataTable().fnDestroy();
            listar();
              document.getElementById('desc').value = "";
              document.getElementById('preco').value= "";
              $("#modalAdd").modal('hide');
       }

    },
    error: function() {
    }
  });
}
}


  $("#formProduto").validate({
    errorClass: 'error',
    focusInvalid: true,
    rules: {
      desc: {
        required: true
      },
      preco: {
        required: true,
         number: true
      }
    },
     messages:{
         //exemplo
      desc: {
       required: "Descricão é obrigatorio!"
                  },
      preco: {
       required: "Preço é obrigatorio!",
        number: "Preço é um campo númerico!"
                  }

   }


  });

  $("#formProdutoEdit").validate({
    errorClass: 'error',
    focusInvalid: true,
    rules: {
      descedit: {
        required: true
      },
      precoedit: {
        required: true,
         number: true
      }
    },
     messages:{
         //exemplo
      descedit: {
       required: "Descricão é obrigatorio!"
                  },
      precoedit: {
       required: "Preço é obrigatorio!",
        number: "Preço é um campo númerico!"
                  }

   }


  });

function excluir(id) {

   var confirm1 = false;
  
   confirm1 = confirm("Deseja Realmente Excluir o Produto?");

   var data = {id:$(id).val()};
    if(confirm1 == true){
    $.ajax({
      type: "POST",
      url: "/DTO/call/produto/excluir.php",
      data:  data,
      success: function (result) {
        if (result == 1) {

          var table = $("#produto").dataTable();
            table.dataTable().fnDestroy();
            listar();

        }
      },
      error: function() {
      }
    });
  }
}

function editar(id){
  // Listar Produto
   var data = {id:$(id).val()};

    $.ajax({
      type: "POST",
      url: "/DTO/call/produto/listarUnico.php",
      data:  data,
      success: function (result) {
        var obj = jQuery.parseJSON(result);
       $('#idedit').val(obj.ID_Produto); 
       $('#descedit').val(obj.Descricao);
       $('#precoedit').val(obj.Preco);

        $('#modalEdit').modal('show');
      },
      error: function() {
      }
    });
  }

function editarSave(){

    // Atualizar Produto
    if ($("#formProdutoEdit").valid()) {
     var produto = $('#formProdutoEdit').serialize();

       $.ajax({
      type: "POST",
      url: "/DTO/call/produto/editar.php",
      data:  produto,
      success: function (result) {
         if (result == 1) {
         var table = $("#produto").dataTable();
            table.dataTable().fnDestroy();
            listar();
        $('#modalEdit').modal('hide');
      }
      },
      error: function() {
      }
    });
    }
}


listar();
</script>
 </script> 
</html> 