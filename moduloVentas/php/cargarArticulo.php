<?php
require "../../conn/conn.php";

$sqlTraerArticulo="SELECT `articulo`, `nombre`, `costo`, `stockmin`,
                     `cantidad`, `descripcion`, `imagen`, `categoria`,
                     `codBarra`, `precioVenta`, `idEsta`, `idProveedor`
                      FROM `articulos` WHERE `codBarra`=:codigo";
$producto=$conn->prepare($sqlTraerArticulo);
$producto->bindParam(":codigo",$_GET['codigo']);
$producto->execute();
$producto=$producto->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($producto);
?>