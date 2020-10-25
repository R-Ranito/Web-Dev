<?php
	session_start();
	$db = mysqli_connect('localhost','root','','labdb');
	
	print_r($_SESSION);
	
	if(mysqli_query($db, 'delete from product where productid = '.$_SESSION['id'])){
		echo '<script type="text/javascript">alert ("'.$_SESSION['item'][0].
		' with product ID: '.$_SESSION['id'].' has been deleted!");
		window.location.href="show.php";</script>';
	}
	
?>
