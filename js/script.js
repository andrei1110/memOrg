function toChange(index, tag, info){
	$("#change-bin").val(info);
	$("#index-change").val(index);
	$("#tag-change").val(tag);
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

/*function alterValue(){
	var val = document.getElementById("#change-bin");
	$.post("alterInfoCache.php", {val : val},
	function(data){
		$("#cache-"+cacheAdr").html(data); 
	}, "html");
	$.post("alterInfoMp.php", {val : val},
	function(data){
		$("#mp-adr-"+mpAdr).html(data); 
	}, "html");
}
*/