<?php
	session_start();
if(!empty($_SESSION['id'])){
	echo "Hi ".$_SESSION['nome'].", Welcome <br>";
	echo "What do you want to do?<br>";

	echo '<link rel="stylesheet" type="text/css" href="site.css">';
	echo '<div id="nav">
			<ul>
				<li><a href="form.php">Search a book by Title</a><br></li>
				<li><a href="formAut.php">Search a book by Author</a></li>
				<li><a href="pesqCat.php">Search a book by Category</a></li>
				<li><a href="show.php">Reservations</a></li>

				<li><a href="sair.php">Log off</a></li>
			</ul>
		</div>';
	

	
}else{
	$_SESSION['msg'] = "Restricted area";
	header("Location: login.php");	
}

	$db = mysqli_connect('localhost','root','','celkeCopy') or die(mysqli_error());
	echo '<table border="1px solid black">';
	$r = mysqli_query($db, 'select * from reservation');
	$count = mysqli_num_fields($r);
	$id = [];
	$j = 0;
	$info = mysqli_fetch_fields($r);
	
	foreach ($info as $val){
		echo '<th>'.$val->name.'</th>';
	}
	
	echo '<th>Update</th><th>Delete</th>';
	
	while($data = mysqli_fetch_array($r)){
		for($i = 0; $i < $count + 2; $i++){
			if($i == 0){
				echo '<tr>';
			}
			
			if($i < $count){
				if($i == 0){
					echo '<td id="'.$data[$i].'">'.$data[$i].'</td>';
					$id[$i] = $data[$i];
				}else{
					echo '<td>'.$data[$i].'</td>';
				}
			}else if($i == $count){
				echo '<td>';
				echo '<form action="update.php" method="post">';
				echo '<input type="submit" name="'.$id[$j].'" value="update">';
				echo '</form>';
				echo '</td>';
			}else{
				echo '<td>';
				echo '<form action="confirm_delete.php" method="post">';
				echo '<input type="submit" name="'.$id[$j].'" value="delete">';
				echo '</form>';
				echo '</td>';
			}
			
			if($i == $count + 2){
				echo '</tr>';
				$j++;
			}
		}
	}
	echo '</table>';
?>
