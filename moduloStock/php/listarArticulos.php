<?php
require "../../conn/conn.php";
$todo=[];
$selcCategoria="SELECT * FROM `categoria`";
$allCategorias=$conn->prepare($selcCategoria);
$allCategorias->execute();
$allCategorias=$allCategorias->fetchAll(PDO::FETCH_ASSOC);

$sqlAllLaboratorios="SELECT * FROM `laboratorios`";
$allLaboratorios=$conn->prepare($sqlAllLaboratorios);
$allLaboratorios->execute();
$allLaboratorios=$allLaboratorios->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['id']) && !empty($_GET['id'])){
    $idEsta=$_GET['id'];
    $sqlTodosLosArticulos="SELECT a.`articulo`, a.`nombre`, a.`costo`, a.`stockmin`, a.`cantidad`, a.`descripcion`, a.`imagen`, a.`categoria`, a.`codBarra`, a.`precioVenta`, a.`idEsta`, e.nombreEsta, c.nombreCategoria,mayoritario,`keyTwoLabor`,l.nombreLaboratorio,(SELECT DATEDIFF(a.`fechaVence`,NOW()) FROM articulos limit 1) as diasPaVencer FROM `articulos` = a JOIN establecimiento=e on a.idEsta=e.idEsta JOIN categoria=c on c.idCategoria=a.categoria JOIN laboratorios=l on l.idLaboratorio=keyTwoLabor where a.idEsta=$idEsta";
}else{
    $sqlTodosLosArticulos="SELECT a.`articulo`, a.`nombre`, a.`costo`, a.`stockmin`, a.`cantidad`, a.`descripcion`, a.`imagen`, a.`categoria`, a.`codBarra`, a.`precioVenta`, a.`idEsta`, e.nombreEsta, c.nombreCategoria,mayoritario,`keyTwoLabor`,l.nombreLaboratorio,(SELECT DATEDIFF(a.`fechaVence`,NOW()) FROM articulos limit 1) as diasPaVencer FROM `articulos` = a JOIN establecimiento=e on a.idEsta=e.idEsta JOIN categoria=c on c.idCategoria=a.categoria JOIN laboratorios=l on l.idLaboratorio=keyTwoLabor";
}
$articulos=$conn->prepare($sqlTodosLosArticulos);
$articulos->execute();
$articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);

$sqlEstablecimientos="SELECT `idEsta`, `nombreEsta` FROM `establecimiento`";
$establecimientos=$conn->prepare($sqlEstablecimientos);
$establecimientos->execute();
$establecimientos=$establecimientos->fetchAll(PDO::FETCH_ASSOC);


array_push($todo, $allCategorias, $articulos, $establecimientos,$allLaboratorios);

echo json_encode($todo);



?>