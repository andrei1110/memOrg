function toChange(info){
	$("#change").val(info);
}

function showStats(){
	var r = 1;
	$.post("showStats.php", {r : r},
	function(data){
		$("#stats").html(data); 
	}, "html");
}

function memToCache(adr){
	var cacheAdr = adr%16;
	$.post("memToCache.php", {adr : adr},
	function(data){
		$("#cache-"+cacheAdr).html(data); 
	}, "html");
}
