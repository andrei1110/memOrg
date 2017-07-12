<?php
	require_once("functions.php");
	
	
	$result = memToCache($_POST['adr']);
	$index = $_POST['adr']%16;
	
	
	echo '<th id="cache-adr-'.$result['cache'].'" onClick="toChange('.$index.', '.$result['tag'].','.$result['info'].','.$_POST['adr'].')">'.str_pad(decbin($result['cache']), CACHEADRESS, "0", STR_PAD_LEFT).'</th>';
	echo '<td id="cache-tag-'.$result['cache'].'" onClick="toChange('.$index.', '.$result['tag'].','."'".$result['info']."'".','.$_POST['adr'].')">'.$result['missorhit'].'</td>';
	echo '<td id="cache-tag-'.$result['cache'].'" onClick="toChange('.$index.', '.$result['tag'].','."'".$result['info']."'".','.$_POST['adr'].')">'.$result['validate'].'</td>';
	echo '<td id="cache-tag-'.$result['cache'].'" onClick="toChange('.$index.', '.$result['tag'].','."'".$result['info']."'".','.$_POSt.')">'.$result['tag'].'</td>';
	echo '<td id="cache-info-'.$result['cache'].'" onClick="toChange('.$index.', '.$result['tag'].','."'".$result['info']."'".','.$_POST['adr'].')">'.$result['info'].'</td>';
?>