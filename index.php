<!DOCTYPE HTML>
<html>

<?php
/*
	Trabalho sobre memória
	Organização de computadores
	Andrei Toledo, Jardel Anton e Marcelo Acordi
*/

include("start.php");

//require_once("start.php");

?>
<head>
	<title>Trabalho Organização</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>


<body>

<div class="container">

	
	<!-- <h1>Organização de Computadores</h1>
	<h2>Trabalho sobre cache</h2>
	<h3>Cache de mapeamento direto com write-through</h3>
	<h3>Andrei Toledo, Jardel Anton e Marcelo Acordi</h3> -->
	
	<!-- MODIFICAR VALOR CACHE -->
	<div class="row">
		<div class="col-sm-6 form-inline">
			<label for="change">Binário</label>
			<input type="text" class="form-control" width="35" id="change-bin" value="" disabled pattern="[0-1]{32}">
			<button class="btn btn-default" type="submit">Alterar</button>
		</div>
		<!--<div class="col-sm-2">
			<label for="change">Decimal</label>
			<input type="text" class="form-control" id="change-dec" value="" disabled pattern="[0-1]{32}">
		</div> -->
		
		<!-- ESTATÍSTICAS -->
		<div id="stats" class="col-sm-6 panel panel-default" onload="showStats()">
			<br/>
			<button class="btn btn-default" onclick="showStats()">Mostrar estatísticas</button>
			<p> </p>
		</div>
		<!-- FIM ESTATÍSTICAS -->
	</div>
	<!-- FIM MODIFICAR VALOR CACHE -->
	
	


	<!-- CACHE -->
	<div class="row">
		<div class="col-md-6">
			<h3>Cache</h3>
			<table class="table table-bordered table-hover">
				<tr>
					<th>Quadro</th>
					<th>Miss or Hit</th>
					<th>Validade</th>
					<th>Tag</th>
					<th>Info</th>
				</tr>
				<?php
					$cache = $_SESSION['cache'];
					for ($i = 0; $i < MAXCACHE; $i++) {
						$tag = $cache[$i]['tag'];
						$info = $cache[$i]['info'];
						$validate = $cache[$i]['validate'];
						$missorhit = $cache[$i]['missorhit'];
						echo '<tr id="cache-'.$i.'">';
							echo '<th id="cache-adr-'.$i.'">'.str_pad(decbin($i), CACHEADRESS, "0", STR_PAD_LEFT).'</th>';
							echo '<td id="cache-tag-'.$i.'">'.$missorhit.'</td>';
							echo '<td id="cache-tag-'.$i.'">'.$validate.'</td>';
							echo '<td id="cache-tag-'.$i.'">'.$tag.'</td>';
							echo '<td id="cache-info-'.$i.'">'.$info.'</td>';
						echo '</tr>';
					}
				?>
			</table>
		</div> <!-- FIM GRID 6 -->
		<!-- FIM CACHE -->

		<!-- MEMÓRIA PRINCIPAL -->
		<div class="col-md-6">
			<h3>Memória principal</h3>
			<div class="row">
				<div class="col-md-6">
					<select class="form-control" onChange="memToCache(this.value)">
						<option value="">Selecione um endereço</option>
						<?php
						for($i = 0; $i < MAXMEM; $i++){
							echo '<option value="'.$i.'">'.str_pad(decbin($i), MEMADRESS, "0", STR_PAD_LEFT).'</option>';
						}
						?>
					</select>
				</div>
			</div>
			<br/>
			<table class="table table-bordered table-hover">
				<tr>
					<th>Bloco</th>
					<th>cell 00</th>
					<th>cell 01</th>
					<th>cell 10</th>
					<th>cell 11</th>
				</tr>
				<?php
					$mem = loadMem();
					for ($i = 0; $i < MAXMEM; $i++) {
						echo '<tr onClick="memToCache('.$i.')">';
							$id = str_pad(decbin($i), MEMADRESS, "0", STR_PAD_LEFT);
							echo '<th>'.$id.'</th>';
							echo '<td>'.$mem[$i]['cell00'].'</td>';
							echo '<td>'.$mem[$i]['cell01'].'</td>';
							echo '<td>'.$mem[$i]['cell10'].'</td>';
							echo '<td>'.$mem[$i]['cell11'].'</td>';
						echo '</tr>';
					}
				?>
			</table>
		</div> <!-- FIM GRID 6 -->
		<!-- FIM MEMÓRIA PRINCIPAL -->
		
	</div> <!-- FIM ROW -->
	
</div> <!-- FIM CONTAINER -->

</body>
</html>