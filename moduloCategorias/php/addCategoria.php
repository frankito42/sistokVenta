<?php 
session_start();
require "../../conn/conn.php";
$categoria=$_POST['categoria'];
$sqlAddCategoria="INSERT INTO `categoria`(`nombreCategoria`) VALUES (:cate)";
$addNew=$conn->prepare($sqlAddCategoria);
$addNew->bindparam(":cate",$categoria);
$addNew->execute();

header("location:../categorias.php");

?>