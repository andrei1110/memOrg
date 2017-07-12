function toChange(index, tag, info, adr){
	$("#change-bin").val(info);
	$("#index-change").val(index);
	$("#tag-change").val(tag);
	$("#adr-change").val(adr);
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

function alterValue(){
	var val = $("#change-bin").val();
	var tag = $("#tag-change").val();
	var adr = $("#adr-change").val();
	var index = $("#index-change").val();
	$.post("alterInfoCache.php", {val : val, tag : tag, index : index},
	function(data){
		$("#cache-"+index).html(data); 
	}, "html");
	$.post("alterInfoMp.php", {val : val, tag : tag, index : index},
	function(data){
		$("#mp-adr-"+adr).html(data); 
	}, "html");
}