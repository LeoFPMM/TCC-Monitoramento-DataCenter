<!DOCTYPE html>
<html>
<head>
	<title>Data Center</title>
	<meta charset="UTF-8">
	
</head>
<body>
<style>
	a{	
		font:12px "Trebuchet MS", arial;
		float: right;
	}
</style>
<script src="code/modules/boost.js"></script>
<script src="code/highcharts.js"></script>
<script src="code/modules/series-label.js"></script>
<script src="code/modules/exporting.js"></script>

<div id="container" style="width: 50%; height: 310px;"></div>
<script type="text/javascript">

Highcharts.chart('container', {
	
		chart: {
            zoomType: 'x'
        },
		
		title: {
			text: 'Temperatura (ºC) e Umidade (%)'
		},
		
		xAxis:{
			title:{
				text: 'Dados Coletados'
			}
		},
		
		yAxis:{
			title:{
				text: 'Amplitude'	
			}
		},
		
		plotOptions:{
			series:{
				turboThreshold: 0,
			},
		},
		
		series: [{
			<?php 
				$conexion = mysqli_connect('localhost', 'root', '');
				mysqli_select_db($conexion, "semsa");
				$dataFiltro = $_GET['data'];
				$chip = $_GET['chipId'];
				$ano = substr("$dataFiltro",0,4);
				$mes = substr("$dataFiltro",5,2);
				$dia = substr("$dataFiltro",8,2);
			?>
			name: 'Temperatura',
			color: '#FF8C00',
			data: [
				<?php
				$x = "C";
				date_default_timezone_set('America/Manaus');
				$resultado = mysqli_query($conexion, "SELECT UNIX_TIMESTAMP(data_hora), temperatura FROM monitoramento WHERE year(`data_hora`) = '$ano' AND month(`data_hora`) = '$mes' AND day(`data_hora`) = '$dia' AND `chipId`= '$chip'");
				while($row=mysqli_fetch_array($resultado)){?>
					['<?php echo date('d/m/y - h:i a', $row[0]) ?>', <?php echo $row[1]?>],
				<?php }?>]}, 
			{
			name: 'Umidade',
			data: [<?php
				$resultado = mysqli_query($conexion, "SELECT UNIX_TIMESTAMP(data_hora), umidade FROM monitoramento WHERE year(`data_hora`) = '$ano' AND month(`data_hora`) = '$mes' AND day(`data_hora`) = '$dia' AND `chipId`= '$chip'");
				while($row=mysqli_fetch_array($resultado)){?>
					['<?php echo date('d/m/y - h:i a', $row[0]) ?>', <?php echo $row[1]?>],
			<?php }?>]
			}],
	});
</script>

<div id="container3" style="margin-top: -310px; float: right; width: 50%; height: 310px;"></div>

<script type="text/javascript">

Highcharts.chart('container3', {
		
		chart: {
            zoomType: 'x'
        },
		
		title: {
			text: 'Energia'
		},
		
		subtitle:{
			text: 'Energia em 1 - OK'
		},
		
		xAxis:{
			title:{
				text: 'Dados Coletados'
			}
			
		},
		
		yAxis:{
			title:{
				text: 'Amplitude'	
			}
		},
		
		series: [{
			turboThreshold: 0,
			<?php 
				$conexion = mysqli_connect('localhost', 'root', '');
				mysqli_select_db($conexion, "semsa");
				$dataFiltro = $_GET['data'];
				$chip = $_GET['chipId'];
				$ano = substr("$dataFiltro",0,4);
				$mes = substr("$dataFiltro",5,2);
				$dia = substr("$dataFiltro",8,2);
			?>
			name: 'Energia',
			color: '#000080',
			data: [<?php
				date_default_timezone_set('America/Manaus');
				$ponto = mysqli_query($conexion, "SELECT UNIX_TIMESTAMP(data_hora), energia FROM monitoramento WHERE year(`data_hora`) = '$ano' AND month(`data_hora`) = '$mes' AND day(`data_hora`) = '$dia' AND `chipId`= '$chip'");
				while($row=mysqli_fetch_array($ponto)){?>
					['<?php echo date('d/m/y - h:i a', $row[0]) ?>', <?php echo $row[1]?>],
				<?php }?>]
			}],
				
	});
	
</script>


<div id="container1" style="width: 50%; height: 310px;"></div>

<script type="text/javascript">
	Highcharts.chart('container1', {
		
		chart: {
            zoomType: 'x'
        },
		
		title: {
			text: 'Presença de Chama'
		},
		
		subtitle: {
        text: 'Chama em 0 - OK',
		},
		
		xAxis:{
			title:{
				text: 'Dados Coletados'
			}
		},
		
		yAxis:{
			title:{
				text: 'Amplitude'	
			}
		},
		
		series: [{
			turboThreshold: 0,
			<?php $conexion = mysqli_connect('localhost', 'root', '');
				mysqli_select_db($conexion, "semsa");
				$dataFiltro = $_GET['data'];
				$chip = $_GET['chipId'];
				$ano = substr("$dataFiltro",0,4);
				$mes = substr("$dataFiltro",5,2);
				$dia = substr("$dataFiltro",8,2);
			?>
			name: 'Chama',
			color: 'red',
			data: [<?php
				$ponto = mysqli_query($conexion, "SELECT UNIX_TIMESTAMP(data_hora), chama FROM monitoramento WHERE year(`data_hora`) = '$ano' AND month(`data_hora`) = '$mes' AND day(`data_hora`) = '$dia' AND `chipId`= '$chip'");
				while($row=mysqli_fetch_array($ponto)){?>
					['<?php echo date('d/m/y - h:i a', $row[0]) ?>', <?php if($row[1] == 1){ $row[1] = 0;} elseif($row[1] == 0){ $row[1] = 1;}  echo $row[1]?>],
			<?php }?>]
			}],
	});

</script>

<div id="container2" style="margin-top: -310px; float: right; width: 50%; height: 310px;"></div>

<script type="text/javascript">
	Highcharts.chart('container2', {
			
		chart: {
        zoomType: 'x'
        },
		
		title: {
			text: 'Luminosidade'
		},
		
		subtitle: {
        text: 'Luz em 1 - Acesa'
		},
		
		xAxis:{
			title:{
				text: 'Dados Coletados'
			}
			
		},
		
		yAxis:{
			title:{
				text: 'Amplitude'	
			}
		},
		
		series: [{
			turboThreshold: 0,
			<?php $conexion = mysqli_connect('localhost', 'root', '');
				mysqli_select_db($conexion, "semsa");
				$dataFiltro = $_GET['data'];
				$chip = $_GET['chipId'];
				$ano = substr("$dataFiltro",0,4);
				$mes = substr("$dataFiltro",5,2);
				$dia = substr("$dataFiltro",8,2);
			?>
			name: 'Luminosidade',
			color: '#FFD700',
			data: [<?php
				$luz = 0;
				$ponto = mysqli_query($conexion, "SELECT UNIX_TIMESTAMP(data_hora), luminosidade FROM monitoramento WHERE year(`data_hora`) = '$ano' AND month(`data_hora`) = '$mes' AND day(`data_hora`) = '$dia' AND `chipId`= '$chip'");
				while($row=mysqli_fetch_array($ponto)){?>
					['<?php echo date('d/m/y - h:i a', $row[0]) ?>', <?php if ($row[1]<920){ $luz = 1; echo $luz;} else{ $luz = 0; echo $luz;}?>],
			<?php }?>]
			}],
	});

</script>
<a>© Departamento de Tecnologia da Informação (SEMSA).</a>
</body>
</html>