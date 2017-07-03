<?php
/*
	Trabalho sobre memória
	Organização de computadores
	Andrei Toledo, Jardel Anton e Marcelo Acordi
*/
include("struct.php");

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