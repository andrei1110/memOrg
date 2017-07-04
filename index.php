<!DOCTYPE HTML>
<html>
<?php
/*
	Trabalho sobre memória
	Organização de computadores
	Andrei Toledo, Jardel Anton e Marcelo Acordi
*/

include("start.php");
?>
<head>
	<title>Trabalho Organização</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

	<div class="row">
		<div class="col-md-6">
			<h3>Cache</h3>
			<table class="table table-bordered table-hover">
				<tr>
					<th>Quadro</th>
					<th>Estado</th>
					<th>Info Anterior</th>
					<th>Info</th>
				</tr>
				<?php
						for ($i = 0; $i < MAXCACHE; $i++) {
							echo '<tr id="cache-'.$i.'">';
								echo '<th>'.decbin($i).'</th>';
								echo '<td>'.$cache[$i]['status'].'</td>';
								echo '<td>'.$cache[$i]['preinfo'].'</td>';
								echo '<td>'.$cache[$i]['info'].'</td>';
							echo '</tr>';
						}
				?>
			</table>
		</div> <!-- FIM GRID 6 -->

		<div class="col-md-6">
			<h3>Memória principal</h3>
			<table class="table table-bordered table-hover">
				<tr>
					<th>Bloco</th>
					<th>cell 00</th>
					<th>cell 01</th>
					<th>cell 10</th>
					<th>cell 11</th>
				</tr>
				<?php
						for ($i = 0; $i < MAXMEM; $i++) {
							echo '<tr>';
								echo '<th>'.decbin($i).'</th>';
								echo '<td>'.decbin(rand(0,255)).'</td>';
								echo '<td>'.decbin(rand(0,255)).'</td>';
								echo '<td>'.decbin(rand(0,255)).'</td>';
								echo '<td>'.decbin(rand(0,255)).'</td>';
							echo '</tr>';
						}
				?>
			</table>
		</div> <!-- FIM GRID 6 -->
		
	</div> <!-- FIM ROW -->
	
</div> <!-- FIM CONTAINER -->

</body>
</html>