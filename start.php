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

startCache();

//RESETA AS ESTATÍSTICAS
resetStats();

//INICIALIZAÇÃO DA MEMÓRIA PRINCIPAL
startMP();

?>