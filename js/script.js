function memToCache(adr){
	$.post("memToCache.php", {adr : adr},
	function(data){
		$("#ID DA CACHE").html(data); //SUBSTITUIR PELO ID DA CACHE
	}, "html");
}