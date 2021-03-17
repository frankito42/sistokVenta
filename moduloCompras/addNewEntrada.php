<?php
require "../conn/conn.php";
$factura=$_POST['factura'];
/* $provedor=$_POST['provedor']; */
$observacion=$_POST['observacion'];
$idArticulo=$_POST['idArticulo'];
$costo=$_POST['costo'];
$cantidad=$_POST['cantidad'];
$precioVenta=$_POST['precioventa'];
$fecha=date('Y-m-d');
$idProve=$_POST['proveedor'];

/* INSERTO UNA ENTRADA O FACTURA DE PRUDUSCTOS A INGRESAR */
$entradaSql="INSERT INTO `entrada`(`fecha`, `nFactura`, `observacion`,`idProve`) VALUES 
                                                                    (:fecha,
                                                                     :nFactura,
                                                                     :observacion,
                                                                     :idProve)";
$entrada=$conn->prepare($entradaSql);
$entrada->bindParam(":fecha",$fecha);
$entrada->bindParam(":nFactura",$factura);
$entrada->bindParam(":observacion",$observacion);
$entrada->bindParam(":idProve",$idProve);
$entrada->execute();
/* TRAIGO EL ID INGRESADO "EL ULTIMO" */
$elIdEntrada=$conn->lastInsertId();
/* CUENTO CUANTOS ARTICULOS SE VAN A INGRESAR AL STOCK */
for ($i=0; $i < count($idArticulo) ; $i++) {
    /* SELEECCIONO EL ARTICULO */ 
    $sqlSelectArticulo="SELECT * FROM `articulos` WHERE `articulo`=:id";
    $sellArticulo=$conn->prepare($sqlSelectArticulo);
    $sellArticulo->bindParam(":id",$idArticulo[$i]);
    $sellArticulo->execute();
    $sellArticulo=$sellArticulo->fetch(PDO::FETCH_ASSOC);

    $sumaStock=$sellArticulo['cantidad']+$cantidad[$i];

    $sqlUpdateStock="UPDATE `articulos` SET `costo`=:costo, `cantidad`=:cantidad, `precioVenta`=:precioVenta,`idProveedor`=:idProveedor WHERE `articulo`=:id";
    $upCantidad=$conn->prepare($sqlUpdateStock);
    $upCantidad->bindParam(":id",$idArticulo[$i]);
    $upCantidad->bindParam(":precioVenta",$precioVenta[$i]);
    $upCantidad->bindParam(":cantidad",$sumaStock);
    $upCantidad->bindParam(":costo",$costo[$i]);
    $upCantidad->bindParam(":idProveedor",$idProve);
    $upCantidad->execute();
    
    /* INSERTO EN FACTURA ENTRADA LOS PRODUCTOS QUE INGRESARON */
    $sql="INSERT INTO `facturaentrada`(`idEntrada`, `idArticulo`, `cantidad`, `fecha`, `costo`) 
            VALUES 
            (:idEntrada,
             :idArticulo,
             :cantidad,
             :fecha,
             :costo)";
    $facturaentrada=$conn->prepare($sql);
    $facturaentrada->bindParam(":idEntrada",$elIdEntrada);
    $facturaentrada->bindParam(":idArticulo",$idArticulo[$i]);
    $facturaentrada->bindParam(":cantidad",$cantidad[$i]);
    $facturaentrada->bindParam(":costo",$costo[$i]);
    $facturaentrada->bindParam(":fecha",$fecha);
    $facturaentrada->execute();
}


header("location:compras.php");


?>