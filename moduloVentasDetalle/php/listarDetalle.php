<?php
require "../../conn/conn.php";

$sqlDetalleVenta="SELECT * FROM `detalleventa` WHERE `idV`=:idV";
$detalleVenta=$conn->prepare($sqlDetalleVenta);
$detalleVenta->bindParam(":idV",$_GET['idV']);
$detalleVenta->execute();
$detalleVenta=$detalleVenta->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($detalleVenta);



?>