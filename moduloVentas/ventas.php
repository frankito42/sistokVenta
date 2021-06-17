<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("location:../Login/index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="../mdb/css/mdb.min.css">
    <link rel="stylesheet" href="../mdb/css/all.min.css">
    <title>Inicio</title>
</head>
<body>
    <section>
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
        <a class="navbar-brand" href="#">Lauchi Damnotti</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="../index.php">inicio
                <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos
                  </a>
                  <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-5">
                  <a class="dropdown-item waves-effect waves-light" href="../moduloStock/stock.php">Stock</a>
                  <a class="dropdown-item waves-effect waves-light" href="../moduloCategorias/categorias.php">Categorias</a>
                  <!-- <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a> -->
                  </div>
              </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="../moduloCompras/compras.php">Compras</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link waves-effect waves-light" href="ventas.php">ventas</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin
                </a>
                <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
                <a class="dropdown-item waves-effect waves-light" href="../moduloProvedor/provedor.php">Proveedores</a>
                <a class="dropdown-item waves-effect waves-light" href="../moduloLaboratorios/laboratorios.php">Laboratorios</a>
                <a class="dropdown-item waves-effect waves-light" href="../moduloVentasDetalle/todasLasVentas.php">Caja</a>
                </div>
            </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="#">
                <i class="fas fa-envelope"></i> Contact
                <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="#">
                <i class="fas fa-gear"></i> Settings</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> <?php echo $_SESSION['user']['user']?> </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                <a class="dropdown-item waves-effect waves-light" href="#">My account</a>
                <a class="dropdown-item waves-effect waves-light" href="../Login/php/logout.php">Cerrar sesion</a>
                </div>
            </li>
            </ul>
        </div>
        </nav>
    </section>
    <section>
        <div class="container">
            <button class="btn btn-blue" data-toggle="modal" data-target="#mostarProductElegir">Buscar por nombre</button>
            <br>
            <div class="row">
                    <div class="col-8">
                        <div class="md-form md-outline input-with-pre-icon">
                        <!-- <i class="fas fa-envelope  input-prefix"></i> -->
                        <i class="fas fa-barcode input-prefix"></i>
                        <input autofocus style="font-size: 125%;" type="number" id="codigoDeBarra" class="form-control">
                        <label for="codigoDeBarra">Codigo de barra</label>
                        </div> 
                    </div>
                    <div class="col">
                        <button id="btnEscanear" class="btn btn-blue btn-sm"><i class="fas fa-camera fa-3x"></i></button>  
                    </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>subTotal</th>
                        <th></th>
                    </thead>
                    <tbody id="ProductosVender">
                        
                    </tbody>
                    <tfoot>
                        <td colspan="3">TOTAL $$$$$$</td>
                        <td id="total">0</td>
                        <td></td>
                    </tfoot>
                </table>
            </div> 
            <button id="btnGuardarVenta" class="btn btn-blue">Imprimir ticket</button>
        </div>
    </section>
    
    <section>
    <!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="pregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Desea terminar la operacion?</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
           <!-- <p>Venta realizada correctamente.</p> -->
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer">
         <a type="button" class="btn btn-success waves-effect" data-dismiss="modal">Cerrar</a>
         <button class="btn btn-success waves-effect" id="imprimeTicket">imprimir ticket</button>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Success-->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->


<div class="modal fade" id="mostarProductElegir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div style="background: #2db6e8;color: white;" class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="eligeProductoNombre" class="modal-body">
                 <div style="margin: -2%;" class="md-form form-group">
                    <i class="fa fa-search prefix"></i>
                    <input type="text" id="filtroProductos" class="form-control validate">
                    <label for="filtroProductos" >Nombre del producto</label>
                </div>
                <table id="mytable" class="table table-sm">
                    <thead>
                        <tr> 
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio por Menor</th>
                        <th scope="col">Precio por Mayor</th>
                        </tr>
                    </thead>
                    <tbody id="aquiMostrarTodo">
                        
                    </tbody>
                    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
    </section>
    
</body>
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="js/ventas.js"></script>
<script src="script.js"></script>
</html>