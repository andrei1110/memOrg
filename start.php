<?php
/*
	Trabalho sobre memória
	Organização de computadores
	Andrei Toledo, Jardel Anton e Marcelo Acordi
	
	********************************************
	Página que irá iniciar todo o sistema
*/

include("functions.php");

//INICIALIZAÇÃO DA CACHE
for($countcache = 0; $countcache <= MAXCACHE; $countcache++){
	$cache[$countcache]['info'] = 'NULL';
	$cache[$countcache]['preinfo'] = 'NULL';
	$cache[$countcache]['status'] = 'NULL';
}

//INICIALIZAÇÃO DA MEMÓRIA PRINCIPAL
startDB();

?>