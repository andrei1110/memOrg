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
	
	//criação dos blocos (256 blocos)
	$query = "CREATE OR REPLACE TABLE mem(
				block INT, PRIMARY KEY)";
	$sql = mysql_query($query) or print(mysql_error());
	
	//criação das células, cada célula com 1 byte (4 células por bloco)
	$query = "CREATE OR REPLACE TABLE block(
				cell INT, PRIMARY KEY),
				info INT,
				block INT NOT NULL, 
				FOREIGN KEY (block) REFERENCES mem(block)";
	$sql = mysql_query($query) or print(mysql_error());
	
	//população da tabela
	for($i = 0, $i < MAXMEM; i++){
		$sql = "INSERT INTO mem(block) VALUES ('".$i."')";
		mysql_query($sql) or print(mysql_error());
		for($j = 0; $j < MAXCELL; $j++){
			$info = rand(0,255);
			$sql = "INSERT INTO block(cell, info, block) VALUES('".$j."', '".$info."','".$i."')";
			mysql_query($sql) or print(mysql_error());
		}
	}
	
	mysql_close(connect());
}


?>