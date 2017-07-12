<?php
	session_start();
?>

<br/>
<button class="btn btn-default" onclick="showStats()">Atualizar estatísticas</button>
<br/>

<p>
	Número de hits: <?php echo $_SESSION['stats']['hits'];?>
</p>
<p>
	Número de miss: <?php echo $_SESSION['stats']['miss'];?>
</p>
<p>
	Número de escritas na memória: <?php echo $_SESSION['stats']['writemp'];?>
</p>
<p>
	Número de leituras na memória: <?php echo $_SESSION['stats']['readmem'];?>
</p>