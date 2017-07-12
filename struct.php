<?php

/*
	Trabalho sobre memória
	Organização de computadores
	Andrei Toledo, Jardel Anton e Marcelo Acordi
*/

define("MAXMEM", 256); //TAMANHO MÁXIMO DA MEMÓRIA PRINCIPAL (blocos)
define("MEMADRESS", 8); //TAMANHO DO ENDEREÇO DA MEMÓRIA (bits)
define("MAXCACHE", 16); //TAMANHO MÁXIMO DA CACHE (quadros)
define("CACHEADRESS", 4); //TAMANHO DO ENDEREÇO DA CACHE (bits)
define("INFOSIZE", 24); //TAMANHO DA INFO (bits)
define("MAXCELL", 4); //NÚMERO DE CÉLULAS POR BLOCO DA MEMÓRIA

/*
	Para a simulação da cache, usaremos a memória principal do usuário (o que esta sendo exibido na tela)
	Para a memória principal, usaremos um banco de dados para simular. Teremos uma função que gera automaticamente dados para a memória principal.
*/

//DADOS DO BANCO DE DADOS
define("HOST", "localhost"); // <-- ALTERE O NOME DO HOST DO SEU BANCO DE DADOS
define("USER", "root"); // <-- ALTERE O NOME DE USUÁRIO DO SEU BANCO DE DADOS
define("PASSWORD", ""); // <-- ALTERE A SENHA DO SEU BANCO DE DADOS
define("DB", "mem"); // <-- ALTERE O NOME DO BANCO DE DADOS

?>