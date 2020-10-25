<?php
	session_start();
	$db = mysqli_connect('localhost','root','','celkeCopy');
	$id = array_keys($_POST);
	$_SESSION['id'] = $id[0];
	$r = mysqli_query($db, 'select ISBN from reservation where id = '.$id[0]);
	$item = mysqli_fetch_row($r);
	$_SESSION['item'] = $item;
	
	echo '<script type="text/javascript">function confirm(){window.location.href="delete.php";}
	function cancel(){alert("Delete cancelled");
	window.location.href="show.php";}</script>';
	echo '<p>Book: '.$item[0].' with ISBN: '.$id[0].' will be deleted, please confirm:</p><br />';
	echo '<div onclick="confirm()" 
	style="border:1px solid black; width:20rem; text-align:center; height:3rem; padding-top:1rem;">
	Confirm Delete</div><br /><br />
	<div onclick="cancel()" 
	style="border:1px solid black; width:20rem; text-align:center; height:3rem; padding-top:1rem;">
	Cancel Delete</div>';
?>