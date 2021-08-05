<?php
require "../../conn/conn.php";

$porcentaje=$_GET['porcentaje'];

    $sqlTodosLosArticulos="SELECT * FROM `articulos` where keyTwoLabor=:id";
    $articulos=$conn->prepare($sqlTodosLosArticulos);
    $articulos->bindParam(":id",$_GET['idLab']);
    $articulos->execute();
    $articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);



foreach ($articulos as $key) {
    $aumento=($key['costo']*$porcentaje/100)+$key['costo'];
    /* $aumento2=($key['mayoritario']*$porcentaje/100)+$key['mayoritario']; */
    $sqlUpdateArticulo="UPDATE `articulos` SET `costo`=:costo
                                                 WHERE `articulo`=:articulo";
    $editProducto=$conn->prepare($sqlUpdateArticulo);
    $editProducto->bindParam(":costo",$aumento);
    $editProducto->bindParam(":articulo",$key['articulo']);
    
    $editProducto->execute();

}




?>