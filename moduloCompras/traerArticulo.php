<?php
require "../conn/conn.php";
$id=$_GET['id'];
$selectArticulo="SELECT * FROM `articulos` WHERE articulo=:id";
$articulo=$conn->prepare($selectArticulo);
$articulo->bindParam(":id",$id);
$articulo->execute();
$articulo=$articulo->fetch(PDO::FETCH_ASSOC);

echo json_encode($articulo);
?>