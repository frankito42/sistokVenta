<?php
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
require __DIR__ . '/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;



/*
Este ejemplo imprime un hola mundo en una impresora de tickets
en Windows.
La impresora debe estar instalada como genérica y debe estar
compartida
 */

/*
Conectamos con la impresora
 */

/*
Aquí, en lugar de "POS-58" (que es el nombre de mi impresora)
escribe el nombre de la tuya. Recuerda que debes compartirla
desde el panel de control
 */




 
/*
	Vamos a simular algunos productos. Estos
	podemos recuperarlos desde $_POST o desde
	cualquier entrada de datos. Yo los declararé
	aquí mismo
*/
 

/*
	Aquí, en lugar de "POS-58" (que es el nombre de mi impresora)
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/
 
$nombre_impresora = "tmu admin"; 
 
 
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
 
 
/*
	Vamos a imprimir un logotipo
	opcional. Recuerda que esto
	no funcionará en todas las
	impresoras
 
	Pequeña nota: Es recomendable que la imagen no sea
	transparente (aunque sea png hay que quitar el canal alfa)
	y que tenga una resolución baja. En mi caso
	la imagen que uso es de 250 x 250
*/
$printer->setJustification(Printer::JUSTIFY_RIGHT);
$printer->text("user: ".$_SESSION['user']['user']. "\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("Nro "."1". "\n");
# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);
 

 
/*
	Ahora vamos a imprimir un encabezado
*/
 
$printer->text("Tu empresa" . "\n");
/* $printer->text("asdasdasd" . "\n"); */
#La fecha también
$printer->text(date("Y-m-d H:i:s") . "\n");
$printer->text("----------------------------------------\n");
 
 
/*
	Ahora vamos a imprimir los
	productos
*/
 
# Para mostrar el total
$total = 0;
foreach ($productos as $producto) {
	$total += $producto[2] * $producto[3];
 
	/*Alinear a la izquierda para la cantidad y el nombre*/
	$printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text($producto[1]." ".$producto[2]."x".$producto[3]. "\n");
 
    /*Y a la derecha para el importe*/
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text(' $' . $producto[3]*$producto[2] . "\n");
}
 
/*
	Terminamos de imprimir
	los productos, ahora va el total
*/
$printer->text("----------------------------------------\n");
 
	function title(Printer $printer, $text){
    	$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    	$printer -> text($text);
    	$printer -> selectPrintMode(); // Reset
	}
	
	/* $printer->text("TOTAL: $". $total ."\n"); */
	title($printer, "TOTAL: $". $total ."\n");
	

	$printer->text("---------------------------------\n");

 
 
/*
	Podemos poner también un pie de página
*/
$printer->text("Muchas gracias por su compra\nTu Empresa");
 
 
 
/*Alimentamos el papel 3 veces*/
$printer->feed(3);
 
/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();
 
/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
$printer->pulse();

 
/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();
