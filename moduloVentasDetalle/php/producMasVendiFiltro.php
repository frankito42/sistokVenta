<?php
require "../../conn/conn.php";
/* filto por fecha */
$fecha1=$_GET['fecha1'];
$fecha2=$_GET['fecha2'];
$sqlProductosMasVendidos="SELECT `nombreProducto`,SUM(`cantidadV`) AS cantidadVendida FROM detalleventa 
    WHERE `fecha` BETWEEN :fecha1 and :fecha2
    GROUP BY `nombreProducto` ORDER BY SUM(cantidadV) DESC";
$prouctosMasVendidos=$conn->prepare($sqlProductosMasVendidos);
$prouctosMasVendidos->bindparam(":fecha1",$fecha1);
$prouctosMasVendidos->bindparam(":fecha2",$fecha2);
$prouctosMasVendidos->execute();
$prouctosMasVendidos=$prouctosMasVendidos->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($prouctosMasVendidos);



?>