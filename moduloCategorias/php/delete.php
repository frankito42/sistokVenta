<?php 
session_start();
require "../../conn/conn.php";
$id=$_GET['id'];
$sqlDelete="DELETE FROM `categoria` WHERE `idCategoria`=:id";
$delete=$conn->prepare($sqlDelete);
$delete->bindparam(":id",$id);
$delete->execute();

header("location:../categorias.php");

?>