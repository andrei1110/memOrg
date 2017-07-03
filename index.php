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
			<table class="table">
				<tr>
					<th>Quadro</th>
					<th>Info</th>
				</tr>
				<?php
						for ($i = 1; $i < MAXCACHE; $i++) {
							echo '<tr>';
								echo '<td>'.decbin($i).'</td>';
								echo '<td>'.$cache[$i]['info'].'</td>';
							echo '</tr>';
						}
				?>
			</table>
		</div> <!-- FIM GRID 6 -->

		<div class="col-md-6">
			<h3>Memória principal</h3>
			<table class="table">
				<tr>
					<th>Quadro</th>
					<th>Info</th>
				</tr>
				<?php
						for ($i = 1; $i < MAXMEM; $i++) {
							echo '<tr>';
								echo '<td>'.decbin($i).'</td>';
								echo '<td>'.'exemplo de info para '.$i.'</td>';
							echo '</tr>';
						}
				?>
			</table>
		</div> <!-- FIM GRID 6 -->
		
	</div> <!-- FIM ROW -->
	
</div> <!-- FIM CONTAINER -->

</body>
</html>