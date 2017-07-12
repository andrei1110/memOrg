<?php
	include("functions.php");
	
	$adr = writeMem($_POST['tag'], $_POST['index'], $_POST['val']);
	
?>

<th><?php echo str_pad(decbin($adr), MEMADRESS, "0", STR_PAD_LEFT);?></th>
<td><?php echo $_SESSION['mp'][$adr]['cell00'];?></td>
<td><?php echo $_SESSION['mp'][$adr]['cell01'];?></td>
<td><?php echo $_SESSION['mp'][$adr]['cell10'];?></td>
<td><?php echo $_SESSION['mp'][$adr]['cell11'];?></td>
