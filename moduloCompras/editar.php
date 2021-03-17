<?php 
require "../conn/conn.php";
/* VARIABLES A UTILIZAR */
$idArticulo=$_GET['articulo'];
$cantidadAnterior=$_GET['cantidadAnterior'];
$cantidad = $_GET['cantidad'];
$id=$_GET['id'];
$idEntrada=$_GET['idEntrada'];
$articuloOriginal=$_GET['articuloOriginal'];


/* SI EL ARTICULO ES EL MISMO SOLO ACTUALIZO LA CANTIDAD */
if($articuloOriginal==$idArticulo){
    /* RESTO LA CANTIDAD INGRESADA ANTERIORMENTE Y LE SUMO LA NUEVA */
    $selectArticuloEntrada="UPDATE `articulos` SET `cantidad`=(cantidad-:cantidadAnterior)+:cantidad WHERE articulo=:id";
    $articuloEntrada=$conn->prepare($selectArticuloEntrada);
    $articuloEntrada->bindParam(":id",$articuloOriginal);
    $articuloEntrada->bindParam(":cantidadAnterior",$cantidadAnterior);
    $articuloEntrada->bindParam(":cantidad",$cantidad);
    $articuloEntrada->execute();

    /* EDITO LA CANTIDAD EN FACTURA */
    $editarEntradaArticuloSql="UPDATE `facturaentrada` 
                                SET `cantidad`=:cantidad
                                WHERE `id`=:id";
    $edit=$conn->prepare($editarEntradaArticuloSql);
    $edit->bindParam(":cantidad",$cantidad);
    $edit->bindParam(":id",$id);
    $edit->execute();

    header("location:detalleCompra.php?idEntrada=$idEntrada");

}else{/* DE LO CONTRARIO RESTO LA CANTIDAD AL PRODUCTO ANTERIOR Y LE SUMO AL NUEVO SELECCIONADO */
    $selectArticuloEntrada="UPDATE `articulos` SET `cantidad`=(cantidad-:cantidadAnterior) WHERE articulo=:id";
    $articuloEntrada=$conn->prepare($selectArticuloEntrada);
    $articuloEntrada->bindParam(":id",$articuloOriginal);
    $articuloEntrada->bindParam(":cantidadAnterior",$cantidadAnterior);
    $articuloEntrada->execute();
    
    $sumoSql="UPDATE `articulos` SET `cantidad`=(cantidad+:cantidadAnterior) WHERE articulo=:id";
    $sumaCantidadNewArticulo=$conn->prepare($sumoSql);
    $sumaCantidadNewArticulo->bindParam(":id",$idArticulo);
    $sumaCantidadNewArticulo->bindParam(":cantidadAnterior",$cantidadAnterior);
    $sumaCantidadNewArticulo->execute();

    $cambioEntradaSql="UPDATE `facturaentrada` 
                        SET `idArticulo`=:idArticulo
                        WHERE `id`=:id";
    $cambioArticulo=$conn->prepare($cambioEntradaSql);
    $cambioArticulo->bindParam(":idArticulo",$idArticulo);
    $cambioArticulo->bindParam(":id",$id);
    $cambioArticulo->execute();

    header("location:detalleCompra.php?idEntrada=$idEntrada");
}



?>