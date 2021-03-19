<?php
require "../../conn/conn.php";
$fechaInicial=$_GET['fechaI'];
$fechaFin=$_GET['fechaF'];

$sqlVentasPorFecha="SELECT v.`idVenta`, v.`fechaV`, v.`totalV`, v.`idUser`,u.user FROM `ventas` = v
JOIN users = u on u.id=v.`idUser` WHERE v.`fechaV` BETWEEN :fechaI AND :fechaF";
$ventasFecha=$conn->prepare($sqlVentasPorFecha);
$ventasFecha->bindParam(":fechaI",$fechaInicial);
$ventasFecha->bindParam(":fechaF",$fechaFin);
$ventasFecha->execute();
$ventasFecha=$ventasFecha->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($ventasFecha);



?>

