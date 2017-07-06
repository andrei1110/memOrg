function memToCache(adr){
	$.post("memToCache.php", {adr : adr},
	function(data){
		$("#cache-"+adr).html(data); //SUBSTITUIR PELO ID DA CACHE
	}, "html");
}