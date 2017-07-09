<?php
	require_once("functions.php");
	
	connect();
	$query = "SELECT info FROM block WHERE block =".str_pad(decbin($_POST['adr']),"0",8,STR_PAD_LEFT)."";
	$sql = mysql_query($query) or print(mysql_error());
	$info = "";
	while($row = mysql_fetch_assoc($sql)){
		$info .= $row['info'];
	}
	mysql_close(connect());
	
	$cache = $_POST['adr']%16;
	$tag = str_pad(decbin($_POST['adr']), 8, "0", STR_PAD_LEFT);
	$tag = substr($tag, 0, -4);
	$validate = 1;
	echo '<th id="cache-adr-'.$cache.'" onClick="toChange('."'".$info."'".')">'.decbin($cache).'</th>';
	echo '<td id="cache-tag-'.$cache.'" onClick="toChange('."'".$info."'".')">'.$validate.'</td>';
	echo '<td id="cache-tag-'.$cache.'" onClick="toChange('."'".$info."'".')">'.$tag.'</td>';
	echo '<td id="cache-info-'.$cache.'" onClick="toChange('."'".$info."'".')">'.$info.'</td>';
?>