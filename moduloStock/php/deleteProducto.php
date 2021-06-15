<?php 
session_start();
require "../../conn/conn.php";
$id=$_GET['id'];
$sqlDelete="DELETE FROM `articulos` WHERE `articulo`=:id";
$delete=$conn->prepare($sqlDelete);
$delete->bindparam(":id",$id);


if($delete->execute()){
    echo json_encode("exito");
}

?>