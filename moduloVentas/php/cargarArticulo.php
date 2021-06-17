<?php
require "../../conn/conn.php";

if ($_GET['codigo']=="no") {
    $sqlTraerArticulo="SELECT `articulo`, `nombre`, `costo`, `stockmin`,
                     `cantidad`, `descripcion`, `imagen`, `categoria`,
                     `codBarra`, `precioVenta`, `idEsta`, `idProveedor`,mayoritario
                      FROM `articulos` WHERE `articulo`=:id";
    $producto=$conn->prepare($sqlTraerArticulo);
    $producto->bindParam(":id",$_GET['idPro']);
    $producto->execute();
    $producto=$producto->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sqlTraerArticulo="SELECT `articulo`, `nombre`, `costo`, `stockmin`,
                     `cantidad`, `descripcion`, `imagen`, `categoria`,
                     `codBarra`, `precioVenta`, `idEsta`, `idProveedor`,mayoritario
                      FROM `articulos` WHERE `codBarra`=:codigo";
    $producto=$conn->prepare($sqlTraerArticulo);
    $producto->bindParam(":codigo",$_GET['codigo']);
    $producto->execute();
    $producto=$producto->fetchAll(PDO::FETCH_ASSOC);
}


echo json_encode($producto);
?>