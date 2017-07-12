<?php
	session_start();
?>

<br/>
<button class="btn btn-default" onclick="showStats()">Atualizar estatísticas</button>
<br/>

<div class="col-sm-6">
	Número de hits: <?php echo $_SESSION['stats']['hits'];?>
</div>
<div class="col-sm-6">
	Número de miss: <?php echo $_SESSION['stats']['miss'];?>
</div>
<div class="col-sm-6">
	Número de escritas na memória: <?php echo $_SESSION['stats']['writemp'];?>
</div>
<div class="col-sm-6">
	Número de leituras na memória: <?php echo $_SESSION['stats']['readmem'];?>
</div>
<div class="col-sm-6">
	Número de acessos: <?php echo $_SESSION['stats']['access'];?>
</div>