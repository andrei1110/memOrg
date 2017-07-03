<?php

/*
	Trabalho sobre memória
	Organização de computadores
	Andrei Toledo, Jardel Anton e Marcelo Acordi
*/

define("MAXMEM", 256); //TAMANHO MÁXIMO DA MEMÓRIA PRINCIPAL (blocos)
define("MAXCACHE", 16); //TAMANHO MÁXIMO DA CACHE (quadros)
define("MAXWORD", 4); //TAMANHO DA PALAVRA (bytes)
define("MAXCELL", 4); //NÚMERO DE CÉLULAS POR BLOCO DA MEMÓRIA

/*
	Para a simulação da cache, usaremos a memória principal do usuário (o que esta sendo exibido na tela)
	Para a memória principal, usaremos um banco de dados para simular, esse banco de dados será limpo toda vez que o navegador for atualizado ou reiniciado.
*/

//DADOS DO BANCO DE DADOS
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "mem");



?>