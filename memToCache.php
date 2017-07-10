<?php
	require_once("functions.php");
	
	$result = memToCache($_POST['adr']);
	
	echo '<th id="cache-adr-'.$result['cache'].'" onClick="toChange('."'".$result['info']."'".')">'.str_pad(decbin($result['cache']), 4, "0", STR_PAD_LEFT).'</th>';
	echo '<td id="cache-tag-'.$result['cache'].'" onClick="toChange('."'".$result['info']."'".')">'.$result['validate'].'</td>';
	echo '<td id="cache-tag-'.$result['cache'].'" onClick="toChange('."'".$result['info']."'".')">'.$result['tag'].'</td>';
	echo '<td id="cache-info-'.$result['cache'].'" onClick="toChange('."'".$result['info']."'".')">'.$result['info'].'</td>';
?>