<?php 
session_start();
require "../../conn/conn.php";
$id=$_GET['id'];
$sqlDelete="DELETE FROM `laboratorios` WHERE `idLaboratorio`=:id";
$delete=$conn->prepare($sqlDelete);
$delete->bindparam(":id",$id);
$delete->execute();

header("location:../laboratorios.php");

?>