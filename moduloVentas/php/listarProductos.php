<?php
require "../../conn/conn.php";
$sqlTodosLosArticulos="SELECT a.`articulo`, a.`nombre`, a.`costo`, a.`stockmin`, a.`cantidad`,
                           a.`descripcion`, a.`imagen`, a.`categoria`, a.`codBarra`, a.`precioVenta`,
                           a.`idEsta`, e.nombreEsta, c.nombreCategoria,mayoritario FROM `articulos` = a 
                           JOIN establecimiento=e on a.idEsta=e.idEsta 
                           JOIN categoria=c on c.idCategoria=a.categoria";
$articulos=$conn->prepare($sqlTodosLosArticulos);
$articulos->execute();
$articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($articulos)
?>