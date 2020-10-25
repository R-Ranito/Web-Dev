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





	echo "<a href='sair.php'>Sair</a>";
}else{
	$_SESSION['msg'] = "Área restrita";
	header("Location: login.php");	
}
