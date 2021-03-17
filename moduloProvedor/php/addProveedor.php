<?php
require "../../conn/conn.php";
$proveedor=json_decode($_POST['proveedorNew']);
$sqlAddProveedor="INSERT INTO `proveedores`(`nombreP`, `direccionP`, `telefonoP`, `informacionExtra`) 
                        VALUES (:nombre,:direccionP,:telefonoP,:informacionExtra)";
$addProveedor=$conn->prepare($sqlAddProveedor);
$addProveedor->bindParam(":nombre",$proveedor->nombre);
$addProveedor->bindParam(":direccionP",$proveedor->direccion);
$addProveedor->bindParam(":telefonoP",$proveedor->telefono);
$addProveedor->bindParam(":informacionExtra",$proveedor->informacionExtra);

if($addProveedor->execute()){
    echo json_encode("perfecto");
}



?>