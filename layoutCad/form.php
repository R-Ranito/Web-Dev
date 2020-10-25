<?php
session_start();
if(!empty($_SESSION['id'])){
	echo "Hi ".$_SESSION['nome'].", Welcome <br>";
	echo '<link rel="stylesheet" type="text/css" href="site.css">';
   	echo '<div id="nav">
        	<ul>
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
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Search Books by name</title>
	</head>
		<body>

		
 			<h1>Ranito's Library</h1>

 			<h1>Search Books by Title</h1>

 			<form method="POST" action="pesquisar.php">
				Search:<input type="text" name="pesquisar" placeholder="Type book's Title">
			<input type="submit" value="Search">
			</form>
			<?php  
				echo "<br><br><br><br>";
			?>


		<footer>
        	<div class="footer">
            	@ Rui Ranito DT228
        	</div>
        
    	</footer>
	</body>
</html>



