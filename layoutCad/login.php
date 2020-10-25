<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Library Login</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/signin.css" rel="stylesheet">
	</head>
	<body>

		<div id="nav">
			<ul>
				<li><a href="home.html">Home</a></li> 
				<!-- <li><a href="login.php">Login</a></li>
				<li><a href="cadastrar.php">Create Account</a></li> -->
			</ul>
		</div>

		<div class="container">
			<div class="form-signin" style="background: #42dea4;">
				<h2 class="text-center">Library Log in</h2>
				<?php
					if(isset($_SESSION['msg'])){
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					}
					if(isset($_SESSION['msgcad'])){
						echo $_SESSION['msgcad'];
						unset($_SESSION['msgcad']);
					}
				?>
				<form method="POST" action="valida.php">
					<!--<label>Usuário</label>-->
					<input type="text" name="usuario" placeholder="Enter your username" class="form-control"><br>
					
					<!--<label>Senha</label>-->
					<input type="password" name="senha" placeholder="Enter your password" class="form-control"><br>
					
					<input type="submit" name="btnLogin" value="Access" class="btn btn-success btn-block">
					
					<div class="row text-center" style="margin-top: 20px;"> 
						<h4>Don't have an account yet?</h4>
						<a href="cadastrar.php">Create one for free</a>
					</div>
					
					
				</form>
			</div>
		</div>			
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<footer>
        	<div class="footer">
           		@ Rui Ranito DT228
        	</div>
        
    	</footer>
	</body>
</html>