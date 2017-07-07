<?php
	require_once("functions.php");
	
	connect();
	$query = "SELECT info FROM block WHERE block =".$_POST['adr']."";
	$sql = mysql_query($query) or print(mysql_error());
	$info = "";
	while($row = mysql_fetch_assoc($sql)){
		$info .= decbin($row['info']);
	}
	mysql_close(connect());
	
	$cache = $_POST['adr']%16;
	$tag = decbin($_POST['adr']);
	$tag = substr($tag, 0, -4);
	echo '<th id="cache-adr-'.$cache.'">'.decbin($cache).'</th>';
	echo '<td id="cache-tag-'.$cache.'">'.$tag.'</td>';
	echo '<td id="cache-info-'.$cache.'">'.$info.'</td>';
?>