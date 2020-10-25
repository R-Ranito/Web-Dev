<?php
session_start();
if(!empty($_SESSION['id'])){
	echo "Hi ".$_SESSION['nome'].", Welcome <br>";
	echo '<link rel="stylesheet" type="text/css" href="site.css">';
	echo '<div id="nav">
			<ul>
                <li><a href="form.php">Search a book by Title</a></li>
                <li><a href="formAut.php">Search a book by Author</a></li>
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
// session_start();
include_once("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search by category</title>
		<style type="text/css">
			.carregando{
				color:#ff0000;
				display:none;
			}
		</style>
    </head>
    <body>

    	<h1>Search Books by Category</h1>
		<form action="" method="POST">        
			<label>Category:</label>
			<select name="id_categoria" id="id_categoria">
				<option value="">Choose Category</option>
				<?php
					$result_cat = "SELECT * FROM category ORDER BY nome";
					$resultado_cat = mysqli_query($conn, $result_cat);
					while($row_cat = mysqli_fetch_assoc($resultado_cat) ) {
						echo '<option value="'.$row_cat['id'].'">'.$row_cat['nome'].'</option>';
					}
				?>
			</select><br><br>
			
			<label>Subcategory:</label>
			<span class="carregando">Wait, loading...</span>
			<select name="id_sub_categoria" id="id_sub_categoria">
				<option value="">Choose Subcategory</option>
			</select><br><br>
			
			<input type="submit" value="Search">
			
		</form>
		
		<?php
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$id_categoria = $_POST['id_categoria'];
				$id_sub_categoria = $_POST['id_sub_categoria'];
				$pagina = 1;
				$_SESSION['id_categoria'] = $id_categoria;
				$_SESSION['id_sub_categoria'] = $id_sub_categoria;
				
				listar($id_categoria, $id_sub_categoria, $pagina, $conn);
				
			}elseif((isset($_SESSION['id_categoria'])) AND (isset($_SESSION['id_sub_categoria']))){
				$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
				listar($_SESSION['id_categoria'], $_SESSION['id_sub_categoria'], $pagina, $conn);
			}
			
			function listar($id_categoria, $id_sub_categoria, $pagina, $conn){
				//Selcionar todas as empresas da tabela
				$result_empresa = "SELECT bookTitle FROM books WHERE categoryID = '$id_categoria' AND sub_id = '$id_sub_categoria'";				
				$resultado_empresa = mysqli_query($conn, $result_empresa);
				
				//Contar o total de empresas
				$total_empresas = mysqli_num_rows($resultado_empresa);
				
				//Setar quantidade de empresas por pagina
				$qnt_result_pg = 5;
				
				//Calcular o inicio da visualização
				$inicio = ($qnt_result_pg*$pagina)-$qnt_result_pg;
				
				//Selecionar as empresas a serem apresentado na página
				$result_empresas = "SELECT * FROM books WHERE categoryID = '$id_categoria' AND sub_id = '$id_sub_categoria' LIMIT $inicio, $qnt_result_pg";				
				$resultado_empresas = mysqli_query($conn, $result_empresas);
				
				while ($row_empresas = mysqli_fetch_assoc($resultado_empresas))
				{
					echo "<br>";

					$isbn = $row_empresas['ISBN'];
					$state = $row_empresas['reserved'];

					echo "ISBN: " . $row_empresas['ISBN'] . "<br>";
                	echo "Book Title: " . $row_empresas['bookTitle'] . "<br>";
                	echo "Author: " . $row_empresas['author'] . "<br>";
                	echo "Edition: " . $row_empresas['edition'] . "<br>";
                	echo "Year: " . $row_empresas['year'] . "<br>";
                	echo "Reserved: " . $row_empresas['reserved'] . "<br>";

                	if($row_empresas['reserved']=='no')
         			{
         				echo "<br>";
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
				
				//************* INICIO PAGINAÇÂO **************/
				//Qunatidade de paginas
				$quantidade_pg = ceil($total_empresas / $qnt_result_pg);
				
				//Limite de link antes e depois 
				$MaxLinks = 2;
				
				echo "<br>";
				
				// echo "<a href='pesCat.php?pagina=1'>Primeira</a> ";
				
				for($iPag = $pagina - $MaxLinks; $iPag <= $pagina - 1; $iPag++){
					if($iPag >= 1){
						// echo "<a href='index.php?pagina=$iPag'>$iPag</a> ";
					}
				}
				
				// echo " $pagina ";
				
				for($dPag = $pagina + 1; $dPag <= $pagina + $MaxLinks; $dPag++){
					if($dPag <= $quantidade_pg){
						// echo "<a href='pesCat.php?pagina=$dPag'>$dPag</a> ";
					}
				}
				
				// echo "<a href='pesCat.php?pagina=$quantidade_pg'>Última</a>";
			}
		?> 
		
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		
		<script type="text/javascript">
		$(function(){
			$('#id_categoria').change(function(){
				if( $(this).val() ) {
					$('#id_sub_categoria').hide();
					$('.carregando').show();
					$.getJSON('sub_categorias.php?search=',{id_categoria: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Escolha Subcategoria</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';
						}	
						$('#id_sub_categoria').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#id_sub_categoria').html('<option value="">– Escolha Subcategoria –</option>');
				}
			});
		});
		</script>


		<footer>
        	<div class="footer">
            	@ Rui Ranito DT228
        	</div>
        
    	</footer>
	</body>
</html>
