<?php 
session_start();
require "../conn/conn.php";
if(!isset($_SESSION['user'])){
    header("location:../Login/index.html");
}
$sqlLaboratorios="SELECT * FROM `laboratorios`";
$laboratoriosAll=$conn->prepare($sqlLaboratorios);
$laboratoriosAll->execute();
$laboratoriosAll=$laboratoriosAll->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Laboratorios</title>
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
                  <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos
                  </a>
                  <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
                  <a class="dropdown-item waves-effect waves-light" href="../moduloStock/stock.php">Stock</a>
                  <a class="dropdown-item waves-effect waves-light" href="../moduloCategorias/categorias.php">Categorias</a>
                  <!-- <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a> -->
                  </div>
              </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="../moduloCompras/compras.php">Compras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="../moduloVentas/ventas.php">ventas</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin
                </a>
                <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-4">
                <a class="dropdown-item waves-effect waves-light" href="../moduloProvedor/provedor.php">Proveedores</a>
                <a class="dropdown-item waves-effect waves-light" href="laboratorios.php">Laboratorios</a>
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
                <a class="dropdown-item waves-effect waves-light" href="Login/php/logout.php">Cerrar sesion</a>
                </div>
            </li>
            </ul>
        </div>
        </nav>
    </section>
    <div class="container">
    <button class="btn btn-blue" data-toggle="modal" data-target="#addLaboratorio">Nuevo Laboratorio</button>
        <table class="table table-hover">
            <thead style="background: #b451ffa3;">
                <tr>
                    <th>ID</th>
                    <th>Laboratorio</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($laboratoriosAll as $key):?>
                <tr>
                    <td><?php echo $key['idLaboratorio']?></td>
                    <td><?php echo $key['nombreLaboratorio']?></td>
                    <td><a href="php/delete.php?id=<?php echo $key['idLaboratorio']?>" class="btn btn-danger">x</a></td>
                </tr>
            <?php endforeach?>
            </tbody>
        </table>
    </div>
</body>
<style>
.grey-bg {  
    background-color: #F5F7FA;
}
input[type="text"]{
    text-transform:capitalize;
}
</style>
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="addLaboratorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div style="margin: 5.75rem auto !important;" class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div style="margin-left: 5%;margin-right: 5%;margin-top: -5%;box-shadow: 0px 0px 20px 0px #00000073;" class="modal-header">
         <p style="padding: 3%;" class="heading lead">Añadir Laboratorio</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
      <form action="php/addLaboratorio.php" method="post">
       <!--Body-->
       <div class="modal-body">
         
          <div class="md-form">
            <input required type="text" name="laboratorio" id="laboratorio" value="" class="form-control">
            <label for="laboratorio">Laboratorio</label>
          </div>

         </div>
       

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
         <button type="submit" class="btn btn-success">Guardar</button>
       </div>
       </form>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Success-->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="exito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Completado.</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
           <p>Se añadio un proveedor correctamente.</p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer">
         <a type="button" class="btn btn-success waves-effect" data-dismiss="modal">Cerrar</a>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Success-->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-danger" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p id="tituloEliminarP" class="heading lead">Modal Danger</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-times fa-6x animated rotateIn"></i>
           <p>¿Esta seguro que desea eliminar este proveedor?</p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" class="btn btn-blue" data-dismiss="modal">Cancelar</a>
         <div id="cambiarBoton">
         <a type="button" class="btn btn-danger">Eliminar</a>
         </div>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Danger-->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>

</html>