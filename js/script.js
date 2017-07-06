function memToCache(adr){
	$.post("memToCache.php", {adr : adr},
	function(data){
		$("#teste").html(data); //SUBSTITUIR PELO ID DA CACHE
	}, "html");
}