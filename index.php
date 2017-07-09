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
	
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>

<div class="container">

 <div id="teste">
 </div>

	<div class="row">
		<div class="col-md-6">
			<h3>Cache</h3>
			<table class="table table-bordered table-hover">
				<tr>
					<th>Quadro</th>
					<th>Validade</th>
					<th>Tag</th>
					<th>Info</th>
				</tr>
				<?php
						for ($i = 0; $i < MAXCACHE; $i++) {
							$tag = $cache[$i]['tag'];
							$info = $cache[$i]['info'];
							$validate = $cache[$i]['validate'];
							echo '<tr id="cache-'.$i.'">';
								echo '<th id="cache-adr-'.$i.'">'.str_pad(decbin($i), 4, "0", STR_PAD_LEFT).'</th>';
								echo '<td id="cache-tag-'.$i.'">'.$validate.'</td>';
								echo '<td id="cache-tag-'.$i.'">'.$tag.'</td>';
								echo '<td id="cache-info-'.$i.'">'.$info.'</td>';
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
					$mem = loadMem();
					$j = 0;
					for ($i = 0; $i < MAXMEM; $i++) {
						echo '<tr onClick="memToCache('.$i.')">';
							$id = str_pad(decbin($i), 8, "0", STR_PAD_LEFT);
							echo '<th>'.$id.'</th>';
							while($mem[$j]['block'] == $id){
								echo '<td>'.$mem[$j]['info'].'</td>';
								$j++;
							}
						echo '</tr>';
					}
				?>
			</table>
		</div> <!-- FIM GRID 6 -->
		
	</div> <!-- FIM ROW -->
	
</div> <!-- FIM CONTAINER -->

</body>
</html>