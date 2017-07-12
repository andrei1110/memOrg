function toChange(info){
	$("#change-bin").val(info);
	//var dec = parseInt( info, 2);
	//$("#change-dec").val(dec);
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
