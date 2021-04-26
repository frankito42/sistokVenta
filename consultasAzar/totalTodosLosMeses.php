<?php
require "../conn/conn.php";

$sqlSumaTodosLosMeses="Select MONTHNAME(`fechaV`) as mes ,SUM(`totalV`) as totalMes FROM ventas GROUP BY MONTH(`fechaV`)";
$sumaMeses=$conn->prepare($sqlSumaTodosLosMeses);
$sumaMeses->execute();
$sumaMeses=$sumaMeses->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($sumaMeses);

?>