<?php 
session_start();
require "../conn/conn.php";
$idEntradaNew=$_POST['idEntradaNew'];
$idDelArticuloSelect=$_POST['idDelArticuloSelect'];
$cantidadNew=$_POST['cantidadNew'];
$costoNew=$_POST['costoNew'];
$precioNew=$_POST['precioNew'];


/* SUMO LA CANTIDAD DEL NUEVO INGRESO DE UN ARTICULO */
$sumoSql="UPDATE `articulos` SET `cantidad`=(cantidad+:cantidad2), `precioVenta`=:precio,`costo`=:costo WHERE articulo=:id";
$sumaCantidadNewArticulo=$conn->prepare($sumoSql);
$sumaCantidadNewArticulo->bindParam(":cantidad2",$cantidadNew);
$sumaCantidadNewArticulo->bindParam(":precio",$precioNew);
$sumaCantidadNewArticulo->bindParam(":costo",$costoNew);
$sumaCantidadNewArticulo->bindParam(":id",$idDelArticuloSelect);
$sumaCantidadNewArticulo->execute();

/* INSERTO EL INGRESO A LA FACTURA */
$sql="INSERT INTO `facturaentrada`(`idEntrada`, `idArticulo`, `cantidad`, `fecha`, `costo`) 
            VALUES 
            (:idEntrada,
             :idArticulo,
             :cantidad,
             :fecha,
             :costo)";
$fecha=date("Y-m-d");
$facturaentrada=$conn->prepare($sql);
$facturaentrada->bindParam(":idEntrada",$idEntradaNew);
$facturaentrada->bindParam(":idArticulo",$idDelArticuloSelect);
$facturaentrada->bindParam(":cantidad",$cantidadNew);
$facturaentrada->bindParam(":costo",$costoNew);
$facturaentrada->bindParam(":fecha",$fecha);
$facturaentrada->execute();

header("location:detalleCompra.php?idEntrada=$idEntradaNew");


?>