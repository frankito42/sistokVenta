<?php
require "../../conn/conn.php";
$sqlAllLaboratorios="SELECT * FROM `laboratorios`";
$allLaboratorios=$conn->prepare($sqlAllLaboratorios);
$allLaboratorios->execute();
$allLaboratorios=$allLaboratorios->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($allLaboratorios);
?>