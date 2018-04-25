<!DOCTYPE html>

<?php
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
?>

<?php
	echo "<meta HTTP-EQUIV='refresh' CONTENT='15;URL=ultima.php?Isso=Enviar'>";
?>

<!DOCTYPE html>

<html lang="pt">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="15">
	<title>Monitoramento - DataCenter</title>
</head>
	<style>
		h1{
			text-align: center;
			color: antiquewhite;
			background-color: blue;
			margin-left: auto;
			margin-right: auto;
		}
		h3{
			text-align: center;
			color: black;
			top:50%;
			left:50%;
			width:300px;
			background-color: dodgerblue;
			margin-left: auto;
			margin-right: auto;
		}
		a{	
			font:12px "Trebuchet MS", arial;
			float: right;
		}
		p.var{
			text-align: center;
		}
		
	</style>
<body>
	<header>
		<h1>DataCenter - Semsa</h1>
	</header>
	<section>
		<h3>Temperatura ambiente</h3> <p class="var"><?php echo $var1; ?> ºC
		<h3>Umidade relativa do ar</h3> <p class="var"><?php echo $var2; ?> %
		<h3>Fornecimento de energia</h3> <p class="var"><?php if ($var3 == 1){ echo "OK";} else{ echo "Queda de energia no local";} ?>
		<h3>Luminosidade</h3> <p class="var"><?php if($var4 < 920){ echo "Luz acesa";} else{ echo "Luz apagada";} ?>
		<h3>Presença de chama</h3> <p class="var"><?php if($var5 == 1){ echo "Não há";} else{ echo "Possível presença de fogo no local";} ?>
	</section>

	<?php 

	$conexion = mysqli_connect('localhost', 'root', '');
	mysqli_select_db($conexion, "semsa");
	date_default_timezone_set('America/Manaus');
	$resultado = mysqli_query($conexion, "SELECT UNIX_TIMESTAMP(data_hora) FROM monitoramento ORDER BY id DESC LIMIT 1");
	while($row=mysqli_fetch_array($resultado)){
		echo "Última leitura: ";
		echo date ('d/m/y - h:i a', $row[0]);
	}
	mysqli_close($conexion);
	
	?>

</body>
</html>