<?php 
require "../conn/conn.php";
$idEntrada=$_GET['idEntrada'];

/* SELECCIONO TODOS LOS PRODUCTOS QUE ENTRARON */
$sqlEntradas="SELECT fE.`id`, fE.`idEntrada`,fE.idArticulo , a.`nombre`, fE.`cantidad`, fE.`fecha`, fE.`costo` FROM `facturaentrada` = fE
JOIN articulos = a on a.articulo=fE.idArticulo WHERE fE.`idEntrada`=:id";
$entradas=$conn->prepare($sqlEntradas);
$entradas->bindParam(":id",$idEntrada);
$entradas->execute();
$entradas=$entradas->fetchAll(PDO::FETCH_ASSOC);

foreach ($entradas as $key) {
    /* CORRIJO EL STOCK DE CADA PRODUCTO */
    $selectArticuloEntrada="UPDATE `articulos` SET `cantidad`=(cantidad-:cantidadADescontar) WHERE articulo=:id";
    $articuloEntrada=$conn->prepare($selectArticuloEntrada);
    $articuloEntrada->bindParam(":cantidadADescontar",$key['cantidad']);
    $articuloEntrada->bindParam(":id",$key['idArticulo']);
    $articuloEntrada->execute();
    /* ELIMINO EL ARTICULO DE ENTRADA EN FECHAENTRADA */
    $sqlDeleteArticuloEntrada="DELETE FROM `facturaentrada` WHERE `id`=:id";
    $delete=$conn->prepare($sqlDeleteArticuloEntrada);
    $delete->bindParam(":id",$key['id']);
    $delete->execute();
}







$sqlDeleteArticuloEntrada="DELETE FROM `entrada` WHERE `idEntrada`=:id";
$delete=$conn->prepare($sqlDeleteArticuloEntrada);
$delete->bindParam(":id",$idEntrada);


if ($delete->execute()) {
    echo json_encode("ok");
}

/* header("location:../compras.php"); */

?>