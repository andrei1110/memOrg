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
	$query = "CREATE TABLE IF NOT EXISTS mp(
				block VARCHAR(8) PRIMARY KEY)";
	$sql = mysql_query($query) or print(mysql_error());
	
	//criação das células, cada célula com 1 byte (4 células por bloco)
	$query = "CREATE OR REPLACE TABLE block(
				cel VARCHAR(2),
				info VARCHAR(8),
				block VARCHAR(8) NOT NULL, 
				FOREIGN KEY (block) REFERENCES mp(block))";
	$sql = mysql_query($query) or print(mysql_error());
	
	//população da tabela de memória
	for($i = 0; $i < MAXMEM; $i++){
		$block = str_pad(decbin($i), 8, "0", STR_PAD_LEFT);
		$sql = "INSERT INTO mp(block) VALUES ('".$block."')";
		mysql_query($sql) or print(mysql_error());
		for($j = 0; $j < MAXCELL; $j++){
			$cell = str_pad(decbin($i), 2, "0", STR_PAD_LEFT);
			$info = str_pad(decbin(rand(0,255)), 8, "0", STR_PAD_LEFT);
			$sql = "INSERT INTO block(cel, info, block) VALUES('".$cell."', '".$info."','".$block."')";
			mysql_query($sql) or print(mysql_error());
		}
	}
	
	mysql_close(connect());
}


function loadMem(){//Carregar a memória
	connect();
	
	$n = 0;
	$query = "SELECT * FROM block";
	$sql =  mysql_query($query) or print(mysql_error());
	while($row[$n] = mysql_fetch_assoc($sql)){
		$n++;
	}
	
	mysql_close(connect());
	return $row;
}

?>