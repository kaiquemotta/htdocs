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
            <h1>Relatorio de Vendas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Relatorio de Vendas</li>
            </ol>
          </div>
        </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
               <div class="row">
                <div class="col-3">
                <div class="input-group">
                   <input type="text" class="form-control" id="dataInicio" name="dataInicio">
                     <div class="input-group-prepend" style="padding-left:2%">
                      <button class="btn btn-info" onclick="Pesquisar()"> Pesquisar </button>
                </div>
                </div>
                </div>
               </div> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="produto" class="table table-bordered table-hover">
                <thead>
                  <tr>
                  <th style="text-align:center;width: 30%">Data Venda</th>
                  <th style="text-align:center;width: 30%">Código da Venda</th>
                  <th style="text-align:center;width: 20%">Quantidade</th>
                  <th style="text-align:center;width:20%">Total</th>
                </tr>
                </thead>
                <tbody id="vendasresultado">
                </tbody>
                <tfoot id="vendasresultadofoot">
                </tfoot>
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

  <!-- Modal de Editar -->
   
    <?php include("../includes/footer.php"); ?>
  </div>
</body>
<script>
$('#dataInicio').daterangepicker({
    "startDate":moment(),
    "endDate": moment()
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
});

listar();

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
    var datain = $('#dataInicio').val();
  $.ajax({
    type: "POST",
    url: "/DTO/call/relatorio/listar.php",
    data: {datain:datain},
    dataType: "html",
    success: function (result) {
      $.ajax({
    type: "POST",
    url: "/DTO/call/relatorio/listarTotal.php",
    data: {datain:datain},
    dataType: "html",
    success: function (result) {

      
      $("#vendasresultadofoot").html(result);
   
    },
    error: function() {
    }
  });

      $("#vendasresultado").html(result);
      table();
    },
    error: function() {
    }
  });
}

function Pesquisar(){

var table = $("#produto").dataTable();
            table.dataTable().fnDestroy();
            listar();

}

</script> 
</html> 