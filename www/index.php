<?php
session_start();
include './login/conexao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<style>
.fa {
  font-size: 50px;
  cursor: pointer;
  user-select: none;
}

.fa:hover {
  color: darkblue;
}
</style>
	<title>PeterWork</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"></h2>
    <h2 class="inactive underlineHover"></h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="logimage.png" id="icon" alt="User Icon" />
    </div>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                  <?php
                  if(isset($_SESSION['nao_autenticado'])):
                  ?>
                    <div class="notification is-danger">
                      <p>Usuário ou senha inválidos.</p>
                    </div>
                  <?php 
                  endif;
                  unset($_SESSION['nao_autenticado']); 
                  ?>  
    <!-- Login Form -->
    <form action="login/login.php" method="POST">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="Usuário">
      <input type="password"  id="myInput" id="password" class="fadeIn third" name="senha" placeholder="Senha"><input type="checkbox" onclick="myFunction()"><br><br><br>
      
      
      <input type="submit" class="fadeIn fourth" value="Entrar" name="login">
    </form>

    
    <!-- Remind Passowrd -->
    <!--
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a><br>
        -->
      <h5>Cadastre-se</h5>
      <a class="underlineHover" href="criarconta/criarconta.php">
		    Criar uma nova conta
	    </a>
    </div>
  
  </div>
</div>
</body>
</html>