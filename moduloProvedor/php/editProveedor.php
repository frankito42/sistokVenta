<?php
require "../../conn/conn.php";
$proveedor=json_decode($_POST['proveedor']);
$sqlEditProveedor="UPDATE `proveedores` SET `nombreP`=:nombre,`direccionP`=:direccionP,
                        `telefonoP`=:telefonoP,`informacionExtra`=:informacionExtra
                         WHERE `idProveedor`=:id";
$editProveedor=$conn->prepare($sqlEditProveedor);
$editProveedor->bindParam(":nombre",$proveedor->nombreP);
$editProveedor->bindParam(":direccionP",$proveedor->direccionP);
$editProveedor->bindParam(":telefonoP",$proveedor->telefonoP);
$editProveedor->bindParam(":informacionExtra",$proveedor->infoExtra);
$editProveedor->bindParam(":id",$proveedor->idProveedor);

if($editProveedor->execute()){
    echo json_encode("perfecto");
}



?>