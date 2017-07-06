function memToCache(adr){
	$.post("memToCache.php", {adr : adr},
	function(data){
		var cacheAdr = adr%16;
		$("#cache-"+cacheAdr).html(data); //SUBSTITUIR PELO ID DA CACHE
	}, "html");
}