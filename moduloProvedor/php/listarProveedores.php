<?php
require "../../conn/conn.php";
$sqlListarProveedores="SELECT * FROM `proveedores`";
$listar=$conn->prepare($sqlListarProveedores);
if($listar->execute()){
    $listar=$listar->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($listar);
}else{
    echo json_encode("error");
}



?>