<?php
require "../../conn/conn.php";
$nombreEstablecimiento=$_GET['nEstablecimineto'];
$sqlAddEstablecimiento="INSERT INTO `establecimiento`(`nombreEsta`) VALUES (:nombre)";
$addEstablecimiento=$conn->prepare($sqlAddEstablecimiento);
$addEstablecimiento->bindParam(":nombre",$nombreEstablecimiento);

if($addEstablecimiento->execute()){
    echo json_encode("perfecto");
}



?>