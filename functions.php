<?php
/*
	Trabalho sobre memória
	Organização de computadores
	Andrei Toledo, Jardel Anton e Marcelo Acordi
*/
include("struct.php");

session_start();

function connect(){ //FUNÇÃO PARA CONEXÃO NO BANCO DE DADOS
	$conn = mysql_connect(HOST, USER, PASSWORD) or print(msql_error());
	mysql_select_db(DB, $conn);
	return $conn;
}

function startDB(){//INICIALIZAR O BANCO
	connect();
	
	
	$cell = INFOSIZE/4;
	
	$rand = pow(2,$cell);
	
	//criação dos blocos (256 blocos) com as células
	$query = "CREATE TABLE IF NOT EXISTS mp(
				adr VARCHAR(".MEMADRESS."),
				cell00 VARCHAR(".$cell."),
				cell01 VARCHAR(".$cell."),
				cell10 VARCHAR(".$cell."),
				cell11 VARCHAR(".$cell.")
				)";
	$sql = mysql_query($query) or print(mysql_error());
	
	//população da tabela de memória
	for($i = 0; $i < MAXMEM; $i++){
		$block = str_pad(decbin($i), MEMADRESS, "0", STR_PAD_LEFT);
		$info[0] = str_pad(decbin(rand(0,$rand)), $cell, "0", STR_PAD_LEFT);
		$info[1] = str_pad(decbin(rand(0,$rand)), $cell, "0", STR_PAD_LEFT);
		$info[2] = str_pad(decbin(rand(0,$rand)), $cell, "0", STR_PAD_LEFT);
		$info[3] = str_pad(decbin(rand(0,$rand)), $cell, "0", STR_PAD_LEFT);
		$sql = "INSERT INTO mp(adr, cell00, cell01, cell10, cell11) VALUES ('".$block."','".$info[0]."','".$info[1]."', '".$info[2]."', '".$info[3]."')";
		mysql_query($sql) or print(mysql_error());
	}
	
	mysql_close(connect());
}

function startCache(){//INICIAR A CACHE
	for($countcache = 0; $countcache <= MAXCACHE; $countcache++){
		$cache[$countcache]['info'] = 'NULL';
		$cache[$countcache]['missorhit'] = '';
		$cache[$countcache]['validate'] = '0';
		$cache[$countcache]['tag'] = 'NULL';
	}
	$_SESSION['cache'] = $cache;
}


function loadMem(){//CARREGAR A MEMÓRIA
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

function memToCache($adr){//TRANSFERIR DA MEMÓRIA PARA A CACHE

	connect();
	
	$r['missorhit'] = missOrHit($adr);
	

	$query = "SELECT * FROM mp WHERE adr =".str_pad(decbin($adr),"0",MEMADRESS,STR_PAD_LEFT)."";
	$sql = mysql_query($query) or print(mysql_error());
	
	$info = "";
	
	while($row = mysql_fetch_assoc($sql)){
		$info = $row['cell00'].$row['cell01'].$row['cell10'].$row['cell11'];
	}
	
	mysql_close(connect());
	
	
	//retorno das informações para aparecer no html
	$r['info'] = $info;
	$r['cache'] = $adr%MAXCACHE;
	$r['tag'] = str_pad(decbin($adr), MEMADRESS, "0", STR_PAD_LEFT);
	$r['tag'] = substr($r['tag'], 0, -4);
	$r['validate'] = 1;
	
	if($_SESSION['cache'][$adr%MAXCACHE]['tag'] != 'NULL' && $r['missorhit'] != "HIT"){//WRITE MEM
		$tag = $_SESSION['cache'][$adr%MAXCACHE]['tag'];
		$index = str_pad(decbin($adr%MAXCACHE), CACHEADRESS, "0", STR_PAD_LEFT);
		$info = $_SESSION['cache'][$adr%MAXCACHE]['info'];
		writeMem($tag, $index, $info);
	}
	if($r['missorhit'] == "MISS"){
		stats("READMEM");
	}
	
	//salva as informações na cache
	$_SESSION['cache'][$adr%MAXCACHE]['tag'] = $r['tag'];
	$_SESSION['cache'][$adr%MAXCACHE]['info'] = $r['info'];
	$_SESSION['cache'][$adr%MAXCACHE]['missorhit'] = $r['missorhit'];
	$_SESSION['cache'][$adr%MAXCACHE]['validate'] = $r['validate'];
	
	stats("ACCESS");
	
	return $r;
}

function writeMem($tag, $index, $info){//ESCREVER NA MEMÓRIA
	
	connect();
	
	
	$cell = INFOSIZE/4;
	//concatena o index da memória (bits menos significativos)  com a tag (bits mais significativos) para formar o endereço de memória
	$adr = $tag.$index;
	//divide a info para caber nas células de memória
	$infoW[0] = substr($info,0,$cell);
	$infoW[1] = substr($info,$cell,$cell);
	$infoW[2] = substr($info,$cell*2,$cell);
	$infoW[3] = substr($info,$cell*3,$cell);
	
	$query = "UPDATE mp SET cell00 = '".$infoW[0]."', cell01 = '".$infoW[1]."', cell10 = '".$infoW[2]."', cell11 = '".$infoW[3]."' WHERE adr='".$adr."'";
	$sql = mysql_query($query) or print(mysql_error());
	
	mysql_close(connect());
	
	stats("WRITEMP");
	
	return 1;
}


function missOrHit($adr){//FUNÇÃO PARA VERIFICAR SE O DADO ESTÁ NA CACHE

	$r = "MISS";
	for($i = 0; $i < MAXCACHE; $i++){
		$search = $_SESSION['cache'][$i]['tag'].str_pad(decbin($i), CACHEADRESS, "0", STR_PAD_LEFT);
		if(str_pad(decbin($adr), MEMADRESS ,"0", STR_PAD_LEFT) == $search){
			$r = "HIT";
			stats($r);
			return $r;
		}
	}
	stats($r);
	return $r;
}

function resetStats(){//RESETA AS ESTATÍSTICAS
	
	if(isset($_SESSION['stats']['control'])) unset($_SESSION['stats']);
	
	$_SESSION['stats']['control'] = 1;//CONTROLE PARA ATIVAR AS ESTATÍSTICAS
	$_SESSION['stats']['miss'] = 0;
	$_SESSION['stats']['hits'] = 0;
	$_SESSION['stats']['writemp'] = 0;
	$_SESSION['stats']['readmem'] = 0;
	$_SESSION['stats']['access'] = 0;
}

function stats($type){//INCREMENTA AS ESTATÍSTICAS

	if($type == "MISS"){//MISS
		$_SESSION['stats']['miss'] ++;
	}
	
	if($type == "HIT"){//HITS
		$_SESSION['stats']['hits'] ++;
	}
	
	if($type == "WRITEMP"){//ESCRITA EM MEMÓRIA
		$_SESSION['stats']['writemp'] ++;
	}
	
	if($type == "READMEM"){//ESCRITA EM MEMÓRIA
		$_SESSION['stats']['readmem'] ++;
	}
	
	if($type == "ACCESS"){//ACESSO A CACHE
		$_SESSION['stats']['access'] ++;
	}

}

?>