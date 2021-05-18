<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("location:Login/index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="mdb/css/mdb.min.css">
    <link rel="stylesheet" href="mdb/css/all.min.css">
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
            <li class="nav-item active">
                <a class="nav-link waves-effect waves-light" href="index.php">inicio
                <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos
                  </a>
                  <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
                  <a class="dropdown-item waves-effect waves-light" href="moduloStock/stock.php">Stock</a>
                  <a class="dropdown-item waves-effect waves-light" href="moduloCategorias/categorias.php">Categorias</a>
                  <!-- <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a> -->
                  </div>
              </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="moduloCompras/compras.php">Compras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="moduloVentas/ventas.php">ventas</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin
                </a>
                <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
                <a class="dropdown-item waves-effect waves-light" href="moduloProvedor/provedor.php">Provedores</a>
                <a class="dropdown-item waves-effect waves-light" href="../moduloLaboratorios/laboratorios.php">Laboratorios</a>
                <a class="dropdown-item waves-effect waves-light" href="moduloVentasDetalle/todasLasVentas.php">Caja</a>
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
    <section>
    <div class="container-fluid my-4 py-4">

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
  </style>

  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-md-6 col-lg-3 mb-4">

      <!-- Card -->
      <div class="card primary-color white-text">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <p class="h2-responsive font-weight-bold mt-n2 mb-0">150</p>
            <p class="mb-0">New Orders</p>
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
            <p class="h2-responsive font-weight-bold mt-n2 mb-0">53 %</p>
            <p class="mb-0">Bounce Rate</p>
          </div>
          <div>
            <i class="fas fa-chart-bar fa-4x text-black-40"></i>
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
            <p class="mb-0">User Registrations</p>
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

    <!-- Grid column -->
    <div class="col-md-6 col-lg-3 mb-4">

      <!-- Card -->
      <div class="card red accent-2 white-text">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <p style="color:white;" class="h2-responsive font-weight-bold mt-n2 mb-0">65</p>
            <p style="color:white;" class="mb-0">Unique Visitors</p>
          </div>
          <div>
            <i class="fas fa-chart-pie fa-4x text-black-40"></i>
          </div>
        </div>
        <a class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
      </div>
      <!-- Card -->

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

</section>
<!-- Section: Block Content -->

</div>
    </section>
    <section>
    <div class="container my-5 pt-5 pb-2 px-4 z-depth-1">


    <!--Section: Block Content-->
    <section>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <h5 class="text-center font-weight-bold mb-4">Hoy</h5>

          <div class="d-flex justify-content-between">
            <small class="text-muted">Add products to cart</small>
            <small><span><strong>160</strong></span>/<span></span>200</small>
          </div>
          <div class="progress md-progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <div class="d-flex justify-content-between">
            <small class="text-muted">Complete Purchase</small>
            <small><span><strong>310</strong></span>/<span></span>400</small>
          </div>
          <div class="progress md-progress">
            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
              aria-valuemax="100"></div>
          </div>

          <div class="d-flex justify-content-between">
            <small class="text-muted">Visit Premium Page</small>
            <small><span><strong>480</strong></span>/<span></span>800</small>
          </div>
          <div class="progress md-progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <div class="d-flex justify-content-between">
            <small class="text-muted">Send Inquiries</small>
            <small><span><strong>250</strong></span>/<span></span>500</small>
          </div>
          <div class="progress md-progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <h5 class="text-center font-weight-bold mb-4">Ayer</h5>

          <div class="d-flex justify-content-between">
            <small class="text-muted">Add products to cart</small>
            <small><span><strong>160</strong></span>/<span></span>200</small>
          </div>
          <div class="progress md-progress">
            <div class="progress-bar bg-success" role="progressbar" style="width: 55%" aria-valuenow="55"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <div class="d-flex justify-content-between">
            <small class="text-muted">Complete Purchase</small>
            <small><span><strong>310</strong></span>/<span></span>400</small>
          </div>
          <div class="progress md-progress">
            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0"
              aria-valuemax="100"></div>
          </div>

          <div class="d-flex justify-content-between">
            <small class="text-muted">Visit Premium Page</small>
            <small><span><strong>480</strong></span>/<span></span>800</small>
          </div>
          <div class="progress md-progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="45"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>

          <div class="d-flex justify-content-between">
            <small class="text-muted">Send Inquiries</small>
            <small><span><strong>250</strong></span>/<span></span>500</small>
          </div>
          <div class="progress md-progress">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </section>
    <!--Section: Block Content-->


  </div>
    </section>
    
</body>
<style>
.grey-bg {  
    background-color: #F5F7FA;
}
</style>
<script src="mdb/js/jquery.min.js"></script>
<script src="mdb/js/bootstrap.min.js"></script>
<script src="mdb/js/mdb.min.js"></script>
<script src="mdb/js/all.min.js"></script>
</html>