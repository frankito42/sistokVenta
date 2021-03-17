<?php
require "../../conn/conn.php";
$id=$_GET["id"];
$sqlDeleteProveedor="DELETE FROM `proveedores` WHERE `idProveedor`=:id";
$borrarProveedor=$conn->prepare($sqlDeleteProveedor);
$borrarProveedor->bindParam(":id",$id);
if($borrarProveedor->execute()){
    echo json_encode("perfecto");
}else{
    echo json_encode("error");
}



?>