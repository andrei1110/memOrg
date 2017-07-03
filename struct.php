<?php

/*
	Trabalho sobre memória
	Organização de computadores
	Andrei Toledo, Jardel Anton e Marcelo Acordi
*/

define("MAXMEM", 256); //TAMANHO MÁXIMO DA MEMÓRIA PRINCIPAL (blocos)
define("MAXCACHE", 256); //TAMANHO MÁXIMO DA CACHE (quadros)
define("MAXWORD", 4); //TAMANHO DA PALAVRA (bytes)

/*
	Para a simulação da cache, usaremos a memória principal do usuário (o que esta sendo exibido na tela)
	Para a memória principal, usaremos um banco de dados para simular, esse banco de dados será limpo toda vez que o navegador for atualizado ou reiniciado.
*/

//DADOS DO BANCO DE DADOS
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "mem");


function connect(){ //FUNÇÃO PARA CONEXÃO NO BANCO DE DADOS
	$conn = mysql_connect(HOST, USER, PASSWORD) or print(msql_error());
	mysql_select_db(DB, $conn);
	return $conn;
}

function startDB(){//INICIALIZAR O BANCO
	connect();
	$query = "CREATE OR REPLACE TABLE mem(
				block INT(9), PRIMARY KEY)";
	$sql = mysql_query($query) or print(mysql_error());
	$query = "CREATE OR REPLACE TABLE block(
				cell INT(4), PRIMARY KEY),
				info INT(1),
				block INT(9) NOT NULL, 
				FOREIGN KEY (block) REFERENCES mem(block)";
	$sql = mysql_query($query) or print(mysql_error());
	
	mysql_close(connect());
}



?>