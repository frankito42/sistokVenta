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
/* $keyLaboratorio=$_POST['laboratorio']; */
/* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
$transporte=$_POST['transporte']; 
$preciomayor=$_POST['preciomayor']; 
/* $minoritario=$_POST['minoritario']; 
$mayoritario=$_POST['mayoritario'];  */

/* INSERTO UNA ENTRADA O FACTURA DE PRUDUSCTOS A INGRESAR */
$entradaSql="INSERT INTO `entrada`(`fecha`, `nFactura`, `observacion`,`idProve` VALUES 
                                                                    (:fecha,
                                                                     :nFactura,
                                                                     :observacion,
                                                                     :idProve)";
/* $entradaSql="INSERT INTO `entrada`(`fecha`, `nFactura`, `observacion`,`idProve`,`KeyLaboratorio`,`transporte`) VALUES 
                                                                    (:fecha,
                                                                     :nFactura,
                                                                     :observacion,
                                                                     :idProve,
                                                                     :laboratorio,
                                                                     :tranport)"; */
$entrada=$conn->prepare($entradaSql);
$entrada->bindParam(":fecha",$fecha);
$entrada->bindParam(":nFactura",$factura);
$entrada->bindParam(":observacion",$observacion);
$entrada->bindParam(":idProve",$idProve);
/* $entrada->bindParam(":laboratorio",$keyLaboratorio); */
/* $entrada->bindParam(":tranport",$transporte); */
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

    $sqlUpdateStock="UPDATE `articulos` SET `costo`=:costo, `cantidad`=:cantidad, `precioVenta`=:precioVenta,`idProveedor`=:idProveedor, `mayoritario`=:mayo WHERE `articulo`=:id";
    $upCantidad=$conn->prepare($sqlUpdateStock);
    $upCantidad->bindParam(":id",$idArticulo[$i]);
    $upCantidad->bindParam(":precioVenta",$precioVenta[$i]);
    $upCantidad->bindParam(":cantidad",$sumaStock);
    $upCantidad->bindParam(":costo",$costo[$i]);
    $upCantidad->bindParam(":idProveedor",$idProve);
 /*    $upCantidad->bindParam(":labor",$keyLaboratorio); */
    $upCantidad->bindParam(":mayo",$preciomayor[$i]);
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