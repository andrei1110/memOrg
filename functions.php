<?php
/*
	Trabalho sobre memória
	Organização de computadores
	Andrei Toledo, Jardel Anton e Marcelo Acordi
*/
include("struct.php");

session_start();

function startMP(){//INICIALIZAR A MP
	
	
	$cell = INFOSIZE/4;
	
	$rand = pow(2,$cell);
	
	for($i = 0; $i < MAXMEM; $i++){
		$info[0] = str_pad(decbin(rand(0,$rand)), $cell, "0", STR_PAD_LEFT);
		$info[1] = str_pad(decbin(rand(0,$rand)), $cell, "0", STR_PAD_LEFT);
		$info[2] = str_pad(decbin(rand(0,$rand)), $cell, "0", STR_PAD_LEFT);
		$info[3] = str_pad(decbin(rand(0,$rand)), $cell, "0", STR_PAD_LEFT);
		
		$_SESSION['mp'][$i]['cell00'] = $info[0];
		$_SESSION['mp'][$i]['cell01'] = $info[1];
		$_SESSION['mp'][$i]['cell10'] = $info[2];
		$_SESSION['mp'][$i]['cell11'] = $info[3];
	}
	
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

function memToCache($adr){//TRANSFERIR DA MEMÓRIA PARA A CACHE
	
	$r['missorhit'] = missOrHit($adr);
	
	
	if($r['missorhit'] == 'MISSCACHE'){
		$info = $_SESSION['mp'][$adr]['cell00'].$_SESSION['mp'][$adr]['cell01'].$_SESSION['mp'][$adr]['cell10'].$_SESSION['mp'][$adr]['cell11'];
		stats('WRITECACHE');
		stats("READMEM");
	}
	else{
		$info = $_SESSION['cache'][$adr%16]['info'];
	}
	
	//retorno das informações para aparecer no html
	$r['info'] = $info;
	$r['cache'] = $adr%MAXCACHE;
	$r['tag'] = str_pad(decbin($adr), MEMADRESS, "0", STR_PAD_LEFT);
	$r['tag'] = substr($r['tag'], 0, -4);
	$r['validate'] = 1;
	
	/*
	
	A ESCRITA NA MEMÓRIA SÓ SE DÁ NA MODIFICAÇÃO DO DADO, QUANDO O DADO É MODIFICADO, ELE É ESCRITO EM AMBAS AS MEMÓRIAS
	
	if($_SESSION['cache'][$adr%MAXCACHE]['tag'] != 'NULL' && $r['missorhit'] != "HIT"){//WRITE MEM
		$tag = $_SESSION['cache'][$adr%MAXCACHE]['tag'];
		$index = str_pad(decbin($adr%MAXCACHE), CACHEADRESS, "0", STR_PAD_LEFT);
		$info = $_SESSION['cache'][$adr%MAXCACHE]['info'];
		writeMem($tag, $index, $info);
	}*/
	
	//salva as informações na cache
	$_SESSION['cache'][$adr%MAXCACHE]['tag'] = $r['tag'];
	$_SESSION['cache'][$adr%MAXCACHE]['info'] = $r['info'];
	$_SESSION['cache'][$adr%MAXCACHE]['missorhit'] = $r['missorhit'];
	$_SESSION['cache'][$adr%MAXCACHE]['validate'] = $r['validate'];
	
	stats("ACCESS");
	
	return $r;
}

function writeCache($index, $tag, $info){//ESCREVER NA CACHE
	
	$_SESSION['cache'][$index]['info'] = $info;
	
	//writeMem($tag, $index, $info);
	
	stats("WRITECACHE");
	stats("ACCESS");
}

function writeMem($tag, $index, $info){//ESCREVER NA MEMÓRIA
	
	
	$cell = INFOSIZE/4;
	//concatena o index da memória (bits menos significativos)  com a tag (bits mais significativos) para formar o endereço de memória
	$index = str_pad(bindec($index), 4,"0",STR_PAD_LEFT);
	$adr = $tag.$index;
	//divide a info para caber nas células de memória
	$infoW[0] = substr($info,0,$cell);
	$infoW[1] = substr($info,$cell,$cell);
	$infoW[2] = substr($info,$cell*2,$cell);
	$infoW[3] = substr($info,$cell*3,$cell);
	
	$_SESSION['mp'][bindec($adr)]['cell00'] = $infoW[0];
	$_SESSION['mp'][bindec($adr)]['cell01'] = $infoW[1];
	$_SESSION['mp'][bindec($adr)]['cell10'] = $infoW[2];
	$_SESSION['mp'][bindec($adr)]['cell11'] = $infoW[3];
	
	stats("WRITEMP");
	
	return 1;
}


function missOrHit($adr){//FUNÇÃO PARA VERIFICAR SE O DADO ESTÁ NA CACHE

	$r = "MISSCACHE";
	for($i = 0; $i < MAXCACHE; $i++){
		$search = $_SESSION['cache'][$i]['tag'].str_pad(decbin($i), CACHEADRESS, "0", STR_PAD_LEFT);
		if(str_pad(decbin($adr), MEMADRESS ,"0", STR_PAD_LEFT) == $search){
			$r = "HITCACHE";
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
	$_SESSION['stats']['misscache'] = 0;
	$_SESSION['stats']['hitscache'] = 0;
	$_SESSION['stats']['writecache'] = 0;
	$_SESSION['stats']['writemp'] = 0;
	$_SESSION['stats']['readmem'] = 0;
	$_SESSION['stats']['access'] = 0;
}

function stats($type){//INCREMENTA AS ESTATÍSTICAS

	if($type == "MISSCACHE"){//MISS
		$_SESSION['stats']['misscache'] ++;
	}
	
	if($type == "HITCACHE"){//HITS
		$_SESSION['stats']['hitscache'] ++;
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
	if($type == "WRITECACHE"){//ESCRITAS NA CACHE
		$_SESSION['stats']['writecache'] ++;
	}

}

?>