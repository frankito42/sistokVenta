<?php
require "../../conn/conn.php";
$articulo = json_decode($_POST['articulo']);

    $sqlUpdateArticulo="UPDATE `articulos` SET   `nombre`=:nombre,`costo`=:costo,
                                                `stockmin`=:stockmin,`cantidad`=:cantidad,
                                                `descripcion`=:descripcion,`categoria`=:categoria,
                                                `codBarra`=:codBarra,`precioVenta`=:precio,`mayoritario`=:mayo,`keyTwoLabor`=:labor
                                                 WHERE `articulo`=:articulo";
    $editProducto=$conn->prepare($sqlUpdateArticulo);
    $editProducto->bindParam(":nombre",$articulo->nombreEdit);
    $editProducto->bindParam(":costo",$articulo->costoEdit);
    $editProducto->bindParam(":stockmin",$articulo->stockMinEdit);
    $editProducto->bindParam(":cantidad",$articulo->cantidadEdit);
    $editProducto->bindParam(":descripcion",$articulo->descripcionEdit);
    $editProducto->bindParam(":categoria",$articulo->categoriaEdit);
    $editProducto->bindParam(":codBarra",$articulo->codBarraEdit);
    $editProducto->bindParam(":precio",$articulo->precioEdit);
    $editProducto->bindParam(":mayo",$articulo->precioMayo);
    $editProducto->bindParam(":articulo",$articulo->articulo);
    $editProducto->bindParam(":labor",$articulo->labor);

    if($editProducto->execute()){
    echo json_encode("perfecto");
}



?>