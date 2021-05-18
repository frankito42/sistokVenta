<?php
session_start();
require "../conn/conn.php";

if(!isset($_SESSION['user'])){
  header("location:../Login/index.html");
}
$sqlEntradas="SELECT fE.`id`, fE.`idEntrada`,fE.idArticulo , a.`nombre`, fE.`cantidad`, fE.`fecha`, fE.`costo` FROM `facturaentrada` = fE
JOIN articulos = a on a.articulo=fE.idArticulo WHERE fE.`idEntrada`=:id";
$entradas=$conn->prepare($sqlEntradas);
$entradas->bindParam(":id",$_GET['idEntrada']);
$entradas->execute();
$entradas=$entradas->fetchAll(PDO::FETCH_ASSOC);

$sqlTodosLosArticulos="SELECT * FROM `articulos`";
$articulos=$conn->prepare($sqlTodosLosArticulos);
$articulos->execute();
$articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle compra</title>
    <link rel="stylesheet" type="text/css" href="../mdb/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../mdb/css/mdb.min.css">
    <link rel="stylesheet" href="../mdb/css/all.min.css">
</head>
<body>
    <header>
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
                  <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a>
                  </div>
              </li>
              <li class="nav-item active">
                  <a class="nav-link waves-effect waves-light" href="compras.php">Compras</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link waves-effect waves-light" href="#">ventas</a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin
                  </a>
                  <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-4">
                  <a class="dropdown-item waves-effect waves-light" href="../moduloProvedor/provedor.php">Proveedores</a>
                  <a class="dropdown-item waves-effect waves-light" href="../moduloVentasDetalle/todasLasVentas.php">Caja</a>
                  <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a>
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
    </header>
    <div class="container">
    <div>
    <button class="btn aqua-gradient" data-toggle="modal" data-target="#centralModalSuccess">Añadir producto</button>


    </div>


    <div class="table-responsive">
    <table class="table table-hover">
    <thead style="background: #da70b9d1;">
    <tr>
    <th>Fecha</th>
    <th>Nombre</th>
    <th>Cantidad</th>
    <th>Costo</th>
    <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($entradas as $key):?>
    <tr id="entradaDetalle<?php echo $key['id']?>">
    <td style="white-space: nowrap;" ><?php echo $key['fecha']?></td>
    <td><?php echo $key['nombre']?></td>
    <td><?php echo $key['cantidad']?></td>
    <td><?php echo $key['costo']?></td>
    <td><button data-toggle="modal" data-target="#editar<?php echo $key['id']?>" class="btn btn-blue btn-sm">Editar</button><a onclick="abrirModalBorrarDetalle(<?php echo $key['id']?>,<?php echo $key['cantidad']?>,<?php echo $key['idArticulo']?>,'<?php echo $key['nombre']?>')" class="btn btn-danger btn-sm">Eliminar</a></td>
    </tr>
    <?php require "modalEdit.php";?>
    <?php endforeach?>
    </tbody>
    </table>
    </div>
















    </div>
    </section>


</body>
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="compras.js"></script>
<style>
li:hover{
    background:#33b5e5ab;
    color:white;
    border-radius: 8px;
}
.select-dropdown{
    position: absolute;
    top: 24px;
    left: 0px;
    background: white;
    z-index: 1;
    box-shadow: 0 11px 20px black;
    position: initial;
    list-style-type: none; 
    padding: 3%;
    max-height: 300px !important;
    overflow-y: scroll;/*le pones scroll*/
}
.initialized{
  display:none;
}
.caret{
  display:none;
}
</style>
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div style="margin: 5.75rem auto !important;" class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div style="margin-left: 5%;margin-right: 5%;margin-top: -5%;box-shadow: 0px 0px 20px 0px #00000073;" class="modal-header">
         <p style="padding: 3%;" class="heading lead">Añadir un producto</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
      <form action="addProductEntrada.php" method="post">
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <input type="number" name="idEntradaNew" value="<?php echo $_GET['idEntrada']?>" style="display:none;">
         <input type="number" id="idDelArticuloSelect" name="idDelArticuloSelect" value="" style="display:none;">
         <select required onchange="tomarId2(this.value)" class="mdb-select md-form" searchable="Buscar">
            <option selected disabled>Selecciona un producto</option>
            <?php foreach ($articulos as $articulo):?>
            <option value="<?php echo $articulo['articulo']?>"><?php echo $articulo['nombre']?> (<?php echo "en stock: ".$articulo['cantidad']?>)</option>
           
            <?php endforeach?>
          </select>

          <div class="md-form">
            <input required type="number" name="cantidadNew" id="cantidadNew" value="" class="form-control">
            <label for="cantidadNew">Cantidad</label>
          </div>
          <div class="md-form">
            <input required type="number" name="costoNew" id="costoNew" value="" class="form-control">
            <label for="costoNew">Costo</label>
          </div>
          <div class="md-form">
            <input required type="number" name="precioNew" id="precioNew" value="" class="form-control">
            <label for="precioNew">Precio</label>
          </div>

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
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->

</html>