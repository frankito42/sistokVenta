<?php
require "../../conn/conn.php";

$sqlListarTodasLasVentas="SELECT v.`idVenta`, v.`fechaV`, v.`totalV`, v.`idUser`,u.user FROM `ventas` = v
                         JOIN users = u on u.id=v.`idUser` WHERE v.fechaV= CURDATE()";
$listaDeVentas=$conn->prepare($sqlListarTodasLasVentas);
$listaDeVentas->execute();
$listaDeVentas=$listaDeVentas->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($listaDeVentas);



?>