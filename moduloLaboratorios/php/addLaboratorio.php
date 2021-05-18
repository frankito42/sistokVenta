<?php 
session_start();
require "../../conn/conn.php";
$laboratorio=$_POST['laboratorio'];
$sqlAddLaboratorio="INSERT INTO `laboratorios`(`nombreLaboratorio`) VALUES (:labo)";
$addNew=$conn->prepare($sqlAddLaboratorio);
$addNew->bindparam(":labo",$laboratorio);
$addNew->execute();

header("location:../laboratorios.php");

?>