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
        <a class="navbar-brand" href="#">Stock Sistem</a>
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
            <li class="nav-item active">
                <a class="nav-link waves-effect waves-light" href="stock.php">Stock</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="../moduloCompras/compras.php">Compras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="../moduloVentas/ventas.php">ventas</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown
                </a>
                <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
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
    
    <section>
        <div class="container">
        <div class="row">
            <div class="col">
                <button data-toggle="modal" data-target="#addnew" class="btn btn-blue btn-lg">Nuevo producto</button>
            </div>
            
            
                <div class="col-sm">
                    <div class="md-form form-group">
                        <select id="establecimientos" class="browser-default custom-select">
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <button data-toggle="modal" style="background:#a160b6e6;" data-target="#modalNewEstablecimiento" class="btn btn-lg"><i class="fas fa-plus fa-2x"></i></button>
                    <button data-toggle="modal" data-target="#modalPorcentaje" class="btn aqua-gradient btn-lg"><i class="fas fa-percentage fa-2x"></i></button>
                </div>

            
            <div class="col">
                <div class="md-form form-group">
                    <i class="fa fa-search prefix"></i>
                    <input type="text" id="filtroProductos" class="form-control validate">
                    <label for="filtroProductos" >Nombre del producto</label>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="mytable" class="table table-hover">
                    <thead style="background: #19d6f5b0;">
                        <th>Nombre</th>
                        <!-- <th>Costo</th> -->
                        <th style="white-space: nowrap;">Precio venta</th>
                        <!-- <th>Descripcion</th> -->
                        <th>Stock</th>
                        <th>Establecimiento</th>
                        <th>Categoria</th>
                        <th>Img</th>
                        <th>Acción</th>
                    </thead>
                    <tbody id="articulosTabla">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section>
    <!-- ///////////////////////////MODALES MODALES MODALES/////////////////////////////////// -->
    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
    <!-- Agregar Nuevo -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" action="" id="form" method="post">
            <div style="background:#33b5e5;" class="modal-header text-white">
            	<h4 class="modal-title heading lead" id="myModalLabel">Agregar producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span style="color: white;" aria-hidden="true">&times;</span>
		      </button>
                
            </div>
            <div style="padding-top: 0px;" class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col">

						<div class="md-form">
  							<input required type="text" id="newNombreA" name="newNombreA" class="form-control">
  							<label for="newNombreA">Nombre del articulo</label>
						</div>
					</div>
					<div style="margin-top: 6%;" class="col">
						
								<select required id="newArticuloEnEstablecimiento" class="form-control">
								</select>	
								
							
						
					</div>
				</div>
				
					<div class="md-form">
  						<input required type="number" id="stockMinA" name="stockMinA" class="form-control">
  						<label for="stockMinA">Stock minino</label>
					</div>

				
					<!-- <div class="md-form">
  						<input type="number" id="cantidad" name="cantidad" class="form-control">
  						<label for="cantidad">Cantidad</label>
					</div> -->


					<div class="md-form">
  						<textarea required id="descripcionNewA" name="descripcionNewA" class="md-textarea form-control" rows="2"></textarea>
  						<label for="descripcionNewA">Descripcion</label>
					</div>


				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Imagen:</label>
					</div>
					<div class="col-sm-10">
						<input id="inputFile" name="archivo" type="file">
					</div>
				</div>
				
				<div class="row">
				<div style="margin-top: 6%;" class="col">
				
						<select required id="categoriaNew" name="categoria" class="form-control">
						</select>
				
				</div>
				<div class="col">
					<div class="md-form">
  						<input required type="text" id="codBarraNew" name="codBarraNew" class="form-control">
  						<label for="codBarraNew">Codigo de barra</label>
					</div>
				</div>
				</div>
            </div> 
            <!-- /////////////////////////////ERROR ERROR//////////////////////////////////////////// -->
            <p id="erroAddNewProducto" class="animated" style="text-align:center;color:red;display: none;">Rellenar los campos vacios.</p>
            <!-- /////////////////////////////ERROR ERROR//////////////////////////////////////////// -->
			</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                <button name="add" type="submit" id="guardarNewProducto" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</a>
            </div>
        </form>

        </div>
    </div>
</div>
    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
    <div class="modal fade" id="modalNewEstablecimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div style="background: #a160b6e6;" class="modal-header">
         <p class="heading lead">Añadir nuevo establecimiento </p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
        <div class="md-form">
            <input type="text" name="nombreEstablecimiento" id="nombreEstablecimiento" class="form-control">
        <label id="labelIdEstablecimineto" for="nombreEstablecimiento">Nombre del establecimiento</label>
        </div>
        <p id="errorEstablecimiento" class="animated" style="color:red;display: none;">Ingrese el nombre del establecimiento.</p>
       </div>

       <!--Footer-->
       <div class="modal-footer">
         <a type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
         <button id="guardarEstablecimiento" class="btn btn-success">Guardar</button>
       </div>
     </div>
    
     <!--/.Content-->
   </div>
 </div>
    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
    <!-- Modal -->
    <div class="modal fade right" id="modalPorcentaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-white">
                <div style="background: #aa66cc;" class="modal-header">
                    <h5 class="modal-title" id="exampleModalPreviewLabel">Aumentar precio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div id="modalBody" style="background: white;" class="modal-body animated">
                        <div style="text-align: right;margin:0px;" class="md-form">
                            <button id="botonAvanzadoPorcentaje" class="btn btn-success">Por provedor</button>
                        </div>
                        <div class="md-form">
                            <input type="number" id="porcentaje" class="form-control validate">
                            <label for="porcentaje">Porcentaje</label>
                        </div>
                    </div>
                    <div id="modalBody2" style="background: white;display:none;" class="modal-body animated">
                        <div style="text-align: right;margin:0px;" class="md-form">
                            <button id="botonAvanzadoPorcentaje2" class="btn btn-blue">Porcentaje general</button>
                        </div>
                        <div class="md-form">
                            <select name="" class="form-control" id="selectProvedorAumentar">
                            <option value="">Seleccionar proovedor</option>
                            </select>
                        </div>
                        <div class="md-form">
                            <input type="number" id="porcentajeFiltro" class="form-control validate">
                            <label for="porcentajeFiltro">Porcentaje</label>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="porcentajeNormal" onclick="subirPorcentajeEnPrecios()" class="btn btn-primary">guardar</button>
                    <button type="button" id="porcentajePorProveedor" style="display:none;" onclick="subirPorcentajeEnPreciosProveedor()" class="btn btn-primary">guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
    </section>
    
</body>
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="js/stock.js"></script>
</html> 