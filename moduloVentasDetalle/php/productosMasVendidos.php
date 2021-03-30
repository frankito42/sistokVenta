<?php
require "../../conn/conn.php";

$sqlProductosMasVendidos="SELECT `nombreProducto`,SUM(`cantidadV`) AS cantidadVendida
FROM detalleventa
GROUP BY `nombreProducto`
ORDER BY SUM(cantidadV) DESC";
$prouctosMasVendidos=$conn->prepare($sqlProductosMasVendidos);
$prouctosMasVendidos->execute();
$prouctosMasVendidos=$prouctosMasVendidos->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($prouctosMasVendidos);



?>