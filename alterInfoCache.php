<?php
	include("functions.php");
	
	writeCache($_POST['index'], $_POST['tag'], $_POST['val']);
	
	$cache = $_SESSION['cache'][$_POST['index']];
	
	echo '<th id="cache-adr-'.$_POST['index'].'" onClick="toChange('.$_POST['index'].', '.$cache['tag'].','.$cache['info'].')">'.str_pad(decbin($_POST['index']), CACHEADRESS, "0", STR_PAD_LEFT).'</th>';
	echo '<td id="cache-tag-'.$_POST['index'].'" onClick="toChange('.$_POST['index'].', '.$cache['tag'].','."'".$cahe['info']."'".')">'.$cache['missorhit'].'</td>';
	echo '<td id="cache-tag-'.$_POST['index'].'" onClick="toChange('.$_POST['index'].', '.$cache['tag'].','."'".$cache['info']."'".')">'.$cache['validate'].'</td>';
	echo '<td id="cache-tag-'.$_POST['index'].'" onClick="toChange('.$_POST['index'].', '.$cache['tag'].','."'".$cache['info']."'".')">'.$cache['tag'].'</td>';
	echo '<td id="cache-info-'.$_POST['index'].'" onClick="toChange('.$_POST['index'].', '.$cache['tag'].','."'".$cache['info']."'".')">'.$cache['info'].'</td>';
	
?>