function toChange(info){
	$("#change").val(info);
}

function memToCache(adr){
	var cacheAdr = adr%16;
	$.post("memToCache.php", {adr : adr},
	function(data){
		$("#cache-"+cacheAdr).html(data); //SUBSTITUIR PELO ID DA CACHE
	}, "html");
}

function cacheToMain(){
	//implementar
}