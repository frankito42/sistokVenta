<?php
session_start();
require "../conn/conn.php";
/* require "chimichurri/trataFechas.php"; */


/* if(!isset($_SESSION['user'])){
header("location:login/login_v5/index.php");
}
 */
$sqlTodosLosArticulos="SELECT a.`articulo`, a.`nombre`, a.`costo`, a.`stockmin`, a.`cantidad`, a.`descripcion`, a.`imagen`, a.`categoria`, a.`codBarra`, a.`precioVenta`, a.`idEsta`, a.`idProveedor`,e.nombreEsta,p.nombreP FROM `articulos` =a LEFT OUTER join proveedores=p on p.idProveedor=a.idProveedor 
JOIN establecimiento =e ON a.idEsta=e.idEsta";
$articulos=$conn->prepare($sqlTodosLosArticulos);
$articulos->execute();
$articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);

$sqlLaboratorio="SELECT * FROM `laboratorios`";
$laboratorios=$conn->prepare($sqlLaboratorio);
$laboratorios->execute();
$laboratorios=$laboratorios->fetchAll(PDO::FETCH_ASSOC);



$sqlEntradas="SELECT * FROM `entrada`";
$entradas=$conn->prepare($sqlEntradas);
$entradas->execute();
$entradas=$entradas->fetchAll(PDO::FETCH_ASSOC);


$sqlProveedores="SELECT * FROM `proveedores`";
$proveedores=$conn->prepare($sqlProveedores);
$proveedores->execute();
$proveedores=$proveedores->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
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
                  <!-- <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a> -->
                  </div>
              </li>
              <li class="nav-item active">
                  <a class="nav-link waves-effect waves-light" href="compras.php">Compras</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link waves-effect waves-light" href="../moduloVentas/ventas.php">ventas</a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin
                  </a>
                  <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-4">
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
    </header>
    <section>
    <div class="container">
    <div class="row">
    <div class="col">
    <a class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#addEntradaProducto">Nueva entrada</a>
    </div>
    </div>


<div class="table-responsive">
      <table class="table table-hover">
        <thead style="background: #da70b9d1;">
          <tr>
            <th scope="col">Fecha</th>
            <th scope="col">N° factura</th>
            <th scope="col">Observacion</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($entradas as $key):?>
          <tr id="entrada<?php echo $key['idEntrada']?>">
            <td scope="row" style="white-space: nowrap;" ><?php echo $key['fecha']?></td>
            <td><?php echo $key['nFactura']?></td>
            <td><?php echo $key['observacion']?></td>
            <td><a href="detalleCompra.php?idEntrada=<?php echo $key['idEntrada']?>" class="btn btn-blue btn-sm">VER</a> <a onclick="abrirModalBorrar(<?php echo $key['idEntrada']?>,'<?php echo $key['fecha'];?>','<?php echo $key['nFactura'];?>','<?php echo $key['observacion'];?>')" class="btn btn-danger btn-sm" hrefs="moduloCompras/borrarEntradaCompleta.php?idEntrada=">x</a></td>
          </tr>
          <?php endforeach?>
        </tbody>
      </table>
</div>
















    </div>
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <!-- Modal -->
<div class="modal fade right" id="addEntradaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form action="newFactu.php" method="post">
      <div style="background: #4285f4;" class="modal-header">
        <h5 class="modal-title text-white" id="exampleModalPreviewLabel">Entrada de productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="padding:0px;" class="modal-body">
     <div style="padding:2%;padding-bottom: 0px;" class="row">
      <div class="col">
        <div class="md-form">
          <input required type="text" id="form1" name="factura" class="form-control">
          <label for="form1">Numero de factura</label>
        </div>
      </div>
      <div class="col">
        <div class="md-form">
          <select required name="proveedor" class="browser-default custom-select">
            <option selected disabled value="">Provedores</option>
            <?php foreach ($proveedores as $key):?>
            <option value="<?php echo $key['idProveedor']?>"><?php echo $key['nombreP']?></option>
            <?php endforeach?>
          </select>
        </div>
      </div>
      <!-- <div class="col">
        <div class="md-form">
          <select required name="laboratorio" class="browser-default custom-select">
            <option selected disabled value="">Laboratorios</option>
            <?php foreach ($laboratorios as $key):?>
            <option value="<?php echo $key['idLaboratorio']?>"><?php echo $key['nombreLaboratorio']?></option>
            <?php endforeach?>
          </select>
        </div>
      </div> -->
      <div class="col-sm">
      <a href="../moduloProvedor/provedor.php" class="btn btn-blue btn-lg">Nuevo Provedor</a>
      <!-- <a href="../moduloLaboratorios/laboratorios.php" class="btn btn-blue btn-sm">Nuevo Laboratorio</a> -->
      </div>
      </div>
      <div class="col">
        <div class="md-form">
        <textarea id="form7" name="observacion" class="md-textarea form-control" rows="1"></textarea>
        <label for="form7">Observaciones</label>
      </div>
      </div>
   
      <div class="col">
      <div class="md-form text-center">



          <select required autofocus onchange="addNewProductFrom(this.value)" class="mdb-select md-form" searchable="Buscar">
          <option value="" disabled selected>Productos</option>
          <?php foreach ($articulos as $key):?>
          <option value="<?php echo $key['articulo']?>"><?php echo $key['nombre']?> (<?php echo "En stock: ".$key['cantidad']?> <?php echo ($key['nombreP']=="")?"":"Proveedor: ".$key['nombreP']?> <?php echo " Galpon: ".$key['nombreEsta']?>)</option>
          <?php endforeach?>
          </select>



      </div>
            <!-- //////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////// -->
            <!-- <div class="row">
              <div class="col">
                  <div class="md-form">
                    <input required type="number" id="transporte" name="transporte" class="form-control">
                    <label for="transporte">Transporte</label>
                  </div>
              </div>
              <div class="col">
                  <div class="md-form">
                    <input required type="number" id="minoritario" name="minoritario" class="form-control">
                    <label for="minoritario">Por menor%</label>
                  </div>
              </div>
              <div class="col">
                  <div class="md-form">
                    <input required type="number" id="mayoritario" name="mayoritario" class="form-control">
                    <label for="mayoritario">Por mayor%</label>
                  </div>
              </div>
              <div class="col">
                  <div class="md-form">
                    <a class="btn btn-success btn-sm"><i class="fas fa-circle"></i></a>
                  </div>
              </div>
            </div> -->
            <!-- //////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////// -->


        <!-- Shopping Cart table -->
        <div class="table-responsive">
        <table id="tablaEscondida" style="display:none;" class="table table-hover">
        <thead style="background:#00b8ffa3;">
        <!-- <th>imagen</th> -->
        <th>nombre</th>
        <th>cantidad</th>
        <th>costo</th>
        <th>Venta por menor</th>
        <th>Venta por mayor</th>
        <th></th>
        </thead>
        <tbody id="addProducto">
        </tbody>
        </table>
        </div>
    
      </div>
      <div style="position:relative;" class="modal-footer">



        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
       
      </div>
    </div>
  </div>
</div>

</form>
</div>
<!-- Modal -->
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////////////// -->


  



    <!-- ////////////////////////////////////////////////////////////////////// -->
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
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=text]{
    text-transform:capitalize;
}
.modal-lg, .modal-xl {
    max-width: 976px;
}
</style>
</html>
  