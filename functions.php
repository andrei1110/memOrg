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
	
	//criação dos blocos (256 blocos) com as células
	$query = "CREATE TABLE IF NOT EXISTS mp(
				adr VARCHAR(8),
				cell00 VARCHAR(8),
				cell01 VARCHAR(8),
				cell10 VARCHAR(8),
				cell11 VARCHAR(8)
				)";
	$sql = mysql_query($query) or print(mysql_error());
	
	//população da tabela de memória
	for($i = 0; $i < MAXMEM; $i++){
		$block = str_pad(decbin($i), 8, "0", STR_PAD_LEFT);
		$info[0] = str_pad(decbin(rand(0,255)), 8, "0", STR_PAD_LEFT);
		$info[1] = str_pad(decbin(rand(0,255)), 8, "0", STR_PAD_LEFT);
		$info[2] = str_pad(decbin(rand(0,255)), 8, "0", STR_PAD_LEFT);
		$info[3] = str_pad(decbin(rand(0,255)), 8, "0", STR_PAD_LEFT);
		$sql = "INSERT INTO mp(adr, cell00, cell01, cell10, cell11) VALUES ('".$block."','".$info[0]."','".$info[1]."', '".$info[2]."', '".$info[3]."')";
		mysql_query($sql) or print(mysql_error());
	}
	
	mysql_close(connect());
}


function loadMem(){//Carregar a memória
	connect();
	
	$n = 0;
	$query = "SELECT * FROM mp";
	$sql =  mysql_query($query) or print(mysql_error());
	while($row[$n] = mysql_fetch_assoc($sql)){
		$n++;
	}
	
	mysql_close(connect());
	return $row;
}

function memToCache($adr){//transferir da memória para a cache

	connect();

	$query = "SELECT * FROM mp WHERE adr =".str_pad(decbin($_POST['adr']),"0",8,STR_PAD_LEFT)."";
	$sql = mysql_query($query) or print(mysql_error());
	
	$info = "";
	
	while($row = mysql_fetch_assoc($sql)){
		$info = $row['cell00'].$row['cell01'].$row['cell10'].$row['cell11'];
	}
	
	mysql_close(connect());
	
	$r['info'] = $info;
	$r['cache'] = $adr%16;
	$r['tag'] = str_pad(decbin($_POST['adr']), 8, "0", STR_PAD_LEFT);
	$r['tag'] = substr($r['tag'], 0, -4);
	$r['validate'] = 1;
	
	return $r;
}

function writeMem($tag, $index, $info){
	
	connect();
	
	//concatena o index da memória (bits menos significativos)  com a tag (bits mais significativos) para formar o endereço de memória
	$adr = $tag.$index;
	//divide a info para caber nas células de memória
	$infoW[0] = substr($info,0,8);
	$infoW[1] = substr($info,8,8);
	$infoW[2] = substr($info,16,8);
	$infoW[3] = substr($info,24,8);
	
	$query = "UPDATE mp SET cell00 = '".$infoW[0]."', cell01 = '".$infoW[1]."', cell10 = '".$infoW[2]."', cell11 = '".$infoW[3]."' WHERE adr='".$adr."'";
	$sql = mysql_query($query) or print(mysql_error());
	
	mysql_close(connect());
	
	return 1;
}


?>