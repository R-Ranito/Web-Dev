<?php
session_start();
if(!empty($_SESSION['id'])){
	echo "Hi ".$_SESSION['nome'].", Welcome <br>";
	echo '<link rel="stylesheet" type="text/css" href="site.css">';
    echo '<div id="nav">
           <ul>
              <li><a href="form.php">Search a book by Author</a></li>
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


<?php  
	include_once 'conexao.php'
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Search by Books</title>
	</head>
		<body>

			

 			<h1>Ranito's Library</h1>

 		<h1>Search Books</h1>

		<?php
	// $servidor = "localhost";
	// $usuario = "root";
	// $senha = "";
	// $dbname = "celke";
	// //Criar a conexao
	// $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
		$pesquisar = $_POST['pesquisar'];
		$result_cursos = "SELECT * FROM books WHERE author LIKE '%$pesquisar%' LIMIT 5";
		$resultado_cursos = mysqli_query($conn, $result_cursos);
		$quaryresult = mysqli_num_rows($resultado_cursos);

		if($quaryresult > 0)
    	{
	
			while($rows_cursos = mysqli_fetch_assoc($resultado_cursos))
			{
				$isbn = $rows_cursos['ISBN'];
            	$state = $rows_cursos['reserved'];

                echo "ISBN: " . $rows_cursos['ISBN'] . "<br>";
                echo "Book Title: " . $rows_cursos['bookTitle'] . "<br>";
                echo "Author: " . $rows_cursos['author'] . "<br>";
                echo "Edition: " . $rows_cursos['edition'] . "<br>";
                echo "Year: " . $rows_cursos['year'] . "<br>";
                echo "reserved: " . $rows_cursos['reserved']."<br><br>";
                    
         	if($rows_cursos['reserved']=='no')
         	{
         		?>
                 <form action="reservation.php" method="POST"><td colspan=7><button name="enter"  class="seperate" value="<?php echo $isbn ?><br><br>">Reserve</button></td></tr></form>


                 <?php

                       echo "<br>";
         	}
         	else
         	{
         		echo'<div><td colspan=7><button class="seperate">Reserved</button></td></tr></div>';
                       
            	echo "<br>";

 
         	}
		}
	}
	else
    {
        echo"No results found";
    }

    	echo "<br><br>";


    	echo "<a href='formAut.php'>New Search</a>";
	?>

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

