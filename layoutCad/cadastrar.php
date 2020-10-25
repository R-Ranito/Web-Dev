<?php
session_start();
ob_start();
$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
if($btnCadUsuario){
	include_once 'conexao.php';
	$dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	
	$erro = false;
	
	$dados_st = array_map('strip_tags', $dados_rc);
	$dados = array_map('trim', $dados_st);
	
	if(in_array('',$dados)){
		$erro = true;
		$_SESSION['msg'] = "Fill all form";
	}elseif((strlen($dados['senha'])) != strlen($dados['confsenha'])){
		$erro = true;
		$_SESSION['msg'] = "Password and Confirm Password have to be the same";

	}elseif((strlen($dados['senha'])) < 6){
		$erro = true;
		$_SESSION['msg'] = "Password must have 6 characters";
	}elseif(stristr($dados['senha'], "'")) {
		$erro = true;
		$_SESSION['msg'] = "Character ( ' ) invalid";
	}else{
		$result_usuario = "SELECT id FROM usuarios WHERE usuario='". $dados['usuario'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "User already registered";
		}
		
		$result_usuario = "SELECT id FROM usuarios WHERE email='". $dados['email'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "E-mail already registered";
		}
	}
	
	
	//var_dump($dados);
	if(!$erro){
		//var_dump($dados);
		$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
		
		$result_usuario = "INSERT INTO usuarios (nome, surname, phone, address1, address2, city, email, usuario, senha) VALUES (
						'" .$dados['nome']. "',
						'" .$dados['surname']. "',
						'" .$dados['phone']. "',
						'" .$dados['address1']. "',
						'" .$dados['address2']. "',
						'" .$dados['city']. "',
						'" .$dados['email']. "',
						'" .$dados['usuario']. "',
						'" .$dados['senha']. "'
						)";

		$resultado_usario = mysqli_query($conn, $result_usuario);
		if(mysqli_insert_id($conn)){
			$_SESSION['msgcad'] = "User has been registered";
			header("Location: login.php");
		}else{
			$_SESSION['msg'] = "Error could not register";
		}
	}
	
}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Register</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/signin.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="form-signin" style="background: #42dea4;">
				<h2>User Register</h2>
				<?php
					if(isset($_SESSION['msg'])){
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					}
				?>
				<form method="POST" action="">
					<!--<label>Nome</label>-->
					<input type="text" name="nome" placeholder="Enter First Name" class="form-control"><br>
					<!--<label>surname</label>-->
					<input type="text" name="surname" placeholder="Enter Surname" class="form-control"><br>
					<!--<label>phone</label>-->
					<input type="text" name="phone" placeholder="Enter Phone" class="form-control"><br>
					<!--<label>address1</label>-->
					<input type="text" name="address1" placeholder="Enter address1" class="form-control"><br>
					<!--<label>address2</label>-->
					<input type="text" name="address2" placeholder="Enter address2" class="form-control"><br>
					<!--<label>city</label>-->
					<input type="text" name="city" placeholder="Enter your city" class="form-control"><br>
					
					<!--<label>E-mail</label>-->
					<input type="text" name="email" placeholder="Enter your email" class="form-control"><br>
					
					<!--<label>Usuário</label>-->
					<input type="text" name="usuario" placeholder="Enter the user" class="form-control"><br>
					
					<!--<label>Senha</label>-->
					<input type="password" name="senha" placeholder="Enter password (6 characters allowed)" class="form-control"><br>

					<input type="password" name="confsenha" placeholder="Confirm Password" class="form-control"><br>
					
					<input type="submit" name="btnCadUsuario" value="Cadastrar" class="btn btn-success"><br><br>
					
					<div class="row text-center" style="margin-top: 20px;"> 
						Lembrou? <a href="login.php">Clique aqui</a> para logar
					</div>
				</form>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>