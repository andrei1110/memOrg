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
	$status = "miss";
	echo '<th id="cache-adr-'.$cache.'">'.decbin($cache).'</th>';
	echo '<td id="cache-status-'.$cache.'">'.$status.'</td>';
	echo '<td id="cache-info-'.$cache.'">'.$info.'</td>';
?>