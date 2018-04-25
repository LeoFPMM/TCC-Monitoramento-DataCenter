<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Monitoramento Semsa</title>
</head>
<body>

<?php 

$conexion = mysqli_connect('localhost', 'root', '');
mysqli_select_db($conexion, "semsa");

if(!file_exists("Temp&Hum&Energia&Luz&Chama.txt")){
		file_put_contents("Temp&Hum&Energia&Luz&Chama.txt", "0.0");
	}
	if(isset($_GET['Temp']) && isset($_GET['Hum'])&& isset($_GET['Energia']) && isset($_GET['Luz']) && isset($_GET['Chama'])){
		$var6 = $_GET['Temp'];
		$var7 = $_GET['Hum'];
		$var8 = $_GET['Energia'];
		$var9 = $_GET['Luz'];
		$var10 = $_GET['Chama'];
		$fileContent = $var6 . "\r\n" . $var7 . "\r\n" . $var8 . "\r\n" . $var9 . "\r\n" . $var10;
		$fileSave = file_put_contents("Temp&Hum&Energia&Luz&Chama.txt", $fileContent);
	}
	
	$fileStr = file_get_contents("Temp&Hum&Energia&Luz&Chama.txt");
	$pos1 = strpos($fileStr, "\r\n");
	$var1 = substr($fileStr, 0, $pos1);
	$var2 = substr($fileStr, 7, $pos1);
	$var3 = substr($fileStr, 12, $pos1);
	$var4 = substr($fileStr, 16, $pos1);
	$var5 = substr($fileStr, 21, $pos1);
mysqli_query($conexion, "INSERT INTO `semsa`.`Monitoramento` (`id`, `chipId`, `temperatura`, `umidade`, `energia`, `luminosidade`, `chama`, `data_hora`) 
	VALUES (NULL, 1, '$var1', '$var2', '$var8', '$var9', '$var10', CURRENT_TIMESTAMP);");

mysqli_close($conexion);

echo "Dados inseridos com sucesso";

?>