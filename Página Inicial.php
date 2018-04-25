<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Monitoramento Semsa</title>
</head>
<body>


<?php 

$foto = 'ManausAM.png';

$conexion = mysqli_connect('localhost', 'root', '');
mysqli_select_db($conexion, "semsa");

$resultado = mysqli_query($conexion, "SELECT DISTINCT `chipId` FROM `monitoramento` WHERE 1");
?>



<style>
	h1{
		text-align:center;
	}
	a{	
		font:12px "Trebuchet MS", arial;
		float: right;
		margin-top: 190px;
	}
	p.dados{
		text-align:center;
	}
	p.consulta{
		margin-top: 50px;
		text-align:center;
	}
	p.isso{
		margin-left: 330px;
		text-align:center;
	}

	.container img{
		max-width:520px;
		max-height:200px;
		width: auto;
		height: auto;
	}
	
	.container {
		clear: both;
		margin-top: 20px;
		text-align: center;
	}
	
	img {
		vertical-align: top;
	}

</style>
<div class="container"><img src="fotos/<?php echo $foto;?>" /></div>
<h1>Monitoramento - Data Center</h1>
<form action = "ultima.php" method = "GET">
	<p class="dados"><input type="submit" value="Últimos Dados Coletados">
</form>

<form action = "resposta.php" method = "GET">
	<p class="consulta"><select name="chipId">
<?php
	while($row=mysqli_fetch_array($resultado)){
		echo "<option>";
		echo $row[0];
		if($row[0] == 1){
			echo " - Gráficos - Data Center";
		}
		echo"</option>";
	}
	mysqli_close($conexion);
?>
	<select><br>
	<p class="dados"><input type="date" name="data" ><br>
	<p class="isso"><input type="submit" value="Consultar" >
<a>© Departamento de Tecnologia da Informação (SEMSA).</a>
</form>
</body>
</html>