<?php 
session_start();
require "../conn/conn.php";
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
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="../moduloStock/stock.php">Stock</a>
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
                <a class="dropdown-item waves-effect waves-light" href="#">Action</a>
                <a class="dropdown-item waves-effect waves-light" href="todasLasVentas.php">Caja</a>
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
    <div class="container">
    <!-- Section: Block Content -->
    
    <section>

    
        <style>
            .footer-hover {
            background-color: rgba(0, 0, 0, 0.1);
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out
            }

            .footer-hover:hover {
            background-color: rgba(0, 0, 0, 0.2)
            }

            .text-black-40 {
            color: rgba(0, 0, 0, 0.4)
            }
            .noselect {
                -webkit-touch-callout: none; /* iOS Safari */
                -webkit-user-select: none; /* Safari */
                -khtml-user-select: none; /* Konqueror HTML */
                -moz-user-select: none; /* Firefox */
                -ms-user-select: none; /* Internet Explorer/Edge */
                user-select: none; 
            }
        </style>

    <!-- Grid row -->
    <div class="row justify-content-center">

        <!-- Grid column -->
        <div class="col-md-6 col-lg-3 mb-4">

        <!-- Card -->
        <div class="card primary-color white-text">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="h2-responsive font-weight-bold mt-n2 mb-0">150</p>
                    <p class="mb-0">Lo mas vendido</p>
                </div>
            <div>
                <i class="fas fa-shopping-bag fa-4x text-black-40"></i>
            </div>
            </div>
                <a class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
        <!-- Card -->

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-6 col-lg-3 mb-4">

        <!-- Card -->
        <div class="card warning-color white-text">
            <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <p id="ventasDelDia" class="h2-responsive font-weight-bold mt-n2 mb-0"></p>
                <p class="mb-0">Ventas del dia</p>
            </div>
            <div>
                <!-- <i class="fas fa-chart-bar fa-4x text-black-40"></i> -->
            </div>
            </div>
            <a class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
        <!-- Card -->

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-6 col-lg-3 mb-4">

        <!-- Card -->
        <div class="card light-blue lighten-1 white-text">
            <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <p class="h2-responsive font-weight-bold mt-n2 mb-0">44</p>
                <p class="mb-0">Ventas del mes</p>
            </div>
            <div>
                <i class="fas fa-user-plus fa-4x text-black-40"></i>
            </div>
            </div>
            <a class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
        <!-- Card -->

        </div>
        <!-- Grid column -->

    </div>
    <!-- Grid row -->
    <div class="card">
      <div class="card-body">

        <h5 class="text-center font-weight-bold mb-4">Ventas del dia <?php echo date("d-m-Y l")?></h5>

        <hr>

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div id="listaVentas" class="col-12 mb-3 mx-auto">
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- /////////////////////////lista de ventas js js////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

        <hr>

        <p class="text-center mt-4 mb-1"><a href="#!">Wiew All Products</a></p>

      </div>
    </div>


    </section>
    <!-- Section: Block Content -->
        </div>
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    
    
</body>
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="js/todasLasVentas.js"></script>
</html>