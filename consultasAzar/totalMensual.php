<?php
require "../conn/conn.php";

$sqlSumaVentasMes="Select SUM(`totalV`) as totalMes FROM ventas WHERE MONTH(`fechaV`) = MONTH(NOW())";
$sumaMes=$conn->prepare($sqlSumaVentasMes);
$sumaMes->execute();
$sumaMes=$sumaMes->fetch(PDO::FETCH_ASSOC);

echo json_encode($sumaMes);



?>