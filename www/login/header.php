<?
session_start();
include 'conexao.php';
?>
<!DOCTYPE html>
<html>
<title>PeterWork</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" type="text/css" href="../css/style.css">

<style>
html, body, h1, h2, h3, h4, h5 {
  font-family: "Open Sans", sans-serif;
}
#logout {
  float: right;
}
.pesquisa {
  padding: 2px;
  margin-top: 8px;
  margin-right: 100px;
  float: right;
}
#sair{
  margin-right: 20px;
}
</style>
<body class="w3-theme-l5">
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

<!-- Navbar -->
<div class="w3-top w3-centered">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="../login/timeline.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i></a>
  <a href="../login/timeline.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Inicio"><i class="fa fa-globe"></i>  Início</a>
  <a href="notificacoes.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Notificações"><i class="fa fa-user"></i>  Notificações</a>
  <a href="editar.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Configurações"><i class='fas fa-cog'></i>  Configurações</a>
  <a href="myprofile.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Minha conta">
    <img src="<?php echo $_SESSION['imagem'] ?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
  </a>
  <a href="logout.php" id="logout" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i id="sair" class="fas fa-sign-in-alt"></i>Logout</a>
  <form action="pesquisar.php" method="GET">
      <input  class="pesquisa" type="text" class="w3-bar-item w3-right fa fa-search"  placeholder="Pesquisar usuário..." name="pesquisar" autocomplete="off"><input  type="submit" hidden>
  </form>
 </div>
 
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large"></a>
</div>