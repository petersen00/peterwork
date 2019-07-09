<?php
  // Não exibe mensagens de alerta
  error_reporting(1);
  // Clicou em enviar?
  if ($_POST != NULL) {
		
		$conexao = new mysqli("localhost", "root", "", "rede_social"););
		$banco = mysqli_select_db($conexao,'rede_social') or die("Erro ao selecionar o banco de dados");
    // Obtém dados do formulário
	    $nome = $_POST["nome"];
	    $email = $_POST["email"];
		$username = $_POST["username"];
		$foto = $_POST["foto"];
		$senha = $_POST["senha"];
		$repitaSenha = $_POST["repitaSenha"];
	
	if($senha == $repitaSenha) {
        echo "<script>
					window.location.hostname;
	  	</script>";
    }else {
		echo "<script>
								alert('Erro ao cadastrar!');
								location.href='criarconta.php';
              </script>";
		exit();
		
	}

	if($foto == "") {
		$foto = "http://www.defesaagricola.com.br/inicio/uploads/representantes/no-img.png";
}else {
	
}


	// Cria comando SQL
      $sql = "INSERT INTO usuario (nome, email, senha, username, foto) 
              VALUES ('$nome', '$email', '$senha', '$username', '$foto')";
	  // Executa no BD
      $retorno = $conexao->query($sql);
	  
	  // Executou no BD?
	  
	  if ($retorno == true) {
        echo "<script>
								alert('Cadastrado com Sucesso!');
								location.href=' ../index.php';
                window.location.hostname;
              </script>";
      } else {
        echo "<script>
                alert('Erro ao Cadastrar!');
              </script>";
        echo $conexao->error;
	  	}
}   

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="cadastro.css">
	<!-- Required meta tags -->
    <meta charset="utf-8">
</head>
<body>
<script type="text/javascript">
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<script type="text/javascript">
function functionpass() {
  var x = document.getElementById("myInsert");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
	
<div class="wrapper fadeInDown">
	<div id="formContent">
	<!-- Icon -->
    <div class="fadeIn first">
      <img src="http://www.pngmart.com/files/7/Network-PNG-Clipart.png" style="padding: 35px;" id="icon" alt="User Icon"/>
	</div>
	<!-- Tabs Titles -->
	<h1 class="inactive underlineHover"></h1>
	<!-- Login Form -->
    	<form method="POST">
					
					<div >
						
						<input class="input100" type="text" class="fadeIn first" name="nome" placeholder="Seu nome..." maxlength="150">	
					</div>
					<div >
						
						<input class="input100" type="text" name="email" class="fadeIn second" placeholder="Endereço de email..." maxlength="100">				
					</div>
					<div >
						
						<input class="input100" type="text" class="fadeIn third" name="username" placeholder="Username" maxlength="20">
					</div>
					<div >
						
						<input class="input100" type="text" class="fadeIn fourth" name="foto" placeholder="Coloque URL da sua foto" maxlength="1000">
					</div>
					<div >
						
						<input class="input100" id="myInput" type="password" class="fadeIn fourth" name="senha" placeholder="*************">
						<input type="checkbox" onclick="myFunction()">
					</div>
					<div >
						
						<input class="input100" id="myInsert" type="password" name="repitaSenha" class="fadeIn fourth" placeholder="*************">
						<input type="checkbox" onclick="functionpass()">
					</div>
					<div >
					<input class="input100" type="submit" class="fadeIn fourth" value="Cadastrar" >
					</div>
					<a href="../index.php">
					<img src="https://img.icons8.com/cotton/2x/circled-left--v2.png" height="42" width="42">
					</a>
		</form>
	</div>
</div>
</body>
</html>