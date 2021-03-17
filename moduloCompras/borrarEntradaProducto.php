<?php 
require "../conn/conn.php";
/* VARIABLES A UTILIZAR */
$cantidadADescontar=$_GET['cantidad'];
$idArticulo=$_GET['idArticulo'];
$idFacturaArticulo=$_GET['id'];

/* DESCUENTO LA CANTIDAD INGRESADA EN LA FACUTUA DEL STOCK */
$selectArticuloEntrada="UPDATE `articulos` SET `cantidad`=(cantidad-:cantidadADescontar) WHERE articulo=:id";
$articuloEntrada=$conn->prepare($selectArticuloEntrada);
$articuloEntrada->bindParam(":cantidadADescontar",$cantidadADescontar);
$articuloEntrada->bindParam(":id",$idArticulo);
$articuloEntrada->execute();

/* BORRO LO QUE SE INGRESO */
$sqlDeleteArticuloEntrada="DELETE FROM `facturaentrada` WHERE `id`=:id";
$delete=$conn->prepare($sqlDeleteArticuloEntrada);
$delete->bindParam(":id",$idFacturaArticulo);

if($delete->execute()){
    echo json_encode("ok");
}

?>