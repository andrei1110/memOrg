<?php
	session_start();
?>

<br/>
<button class="btn btn-default" onclick="showStats()">Atualizar estatísticas</button>
<br/>

<div class="col-sm-6">
	Número de hits na cache: <?php echo $_SESSION['stats']['hitscache'];?>
</div>
<div class="col-sm-6">
	Número de miss na cache: <?php echo $_SESSION['stats']['misscache'];?>
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
<div class="col-sm-6">
	Número de escritas na cache: <?php echo $_SESSION['stats']['writecache'];?>
</div>