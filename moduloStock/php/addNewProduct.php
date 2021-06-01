<?php
require "../../conn/conn.php";
$articulo = json_decode($_POST['articulo']);
if(isset($_FILES["archivo"])){
    $archivo = $_FILES["archivo"];
    move_uploaded_file($archivo["tmp_name"], "../imagenesStock/".$archivo["name"]);
    $direccion="imagenesStock/".$archivo["name"];
}else{
    $direccion="";
}

    $sqlAddNewProduct="INSERT INTO `articulos`(`nombre`, `stockmin`,
    `descripcion`, `imagen`, `categoria`, `codBarra`,
    `idEsta`,`keyTwoLabor`,fechaVence) VALUES
       (:nombre,
        :stockmin,
        :descripcion,
        :imagen,
        :categoria,
        :codBarra,
        :idEsta,
        :labor,
        :fechaVence)";
    $addNewProduct=$conn->prepare($sqlAddNewProduct);
    $addNewProduct->bindParam(":nombre",$articulo->nombre);
    $addNewProduct->bindParam(":stockmin",$articulo->stockMinA);
    $addNewProduct->bindParam(":descripcion",$articulo->descripcionNewA);
    $addNewProduct->bindParam(":imagen",$direccion);
    $addNewProduct->bindParam(":categoria",$articulo->categoriaNew);
    $addNewProduct->bindParam(":codBarra",$articulo->codBarraNew);
    $addNewProduct->bindParam(":idEsta",$articulo->establecimiento);
    $addNewProduct->bindParam(":labor",$articulo->laboratoriosSearch);
    $addNewProduct->bindParam(":fechaVence",$articulo->fechaVencimiento);

    if($addNewProduct->execute()){
    echo json_encode("perfecto");
}



?>