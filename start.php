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
for($contcache = 0; $contcache <= MAXCACHE; $contcache++){
	$cache[$contcache]['info'] = 'NULL';
	$cache[$contcache]['preinfo'] = 'NULL';
}



?>