<?php
 
 session_start();
 include "conexao.php"; 
 include "header.php"; 

 if (isset($_POST['amigos'])){
  echo "<script>
            location.href='amigos.php';
    </script>";
}
	

  $receber = ("SELECT * FROM usuario WHERE username='{$_SESSION["username"]}'");
  $infoo = mysqli_query($conexao, $receber); 
	$info = mysqli_fetch_assoc($infoo);

	if (isset($_POST['botao'])) {
    
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $username= $_POST['username'];
        $foto= $_POST['foto'];
        $nascimento = $_POST['nascimento'];
        $profissao = $_POST['profissao'];
        $nacionalidade = $_POST['nacionalidade'];

		
        if($nome==""){
          echo "<script>
          alert('Digite seu nome!');
          </script>";
        }elseif($senha==""){
          echo "<script>
          alert('Digite sua senha!');
          </script>";
        }elseif($email==""){
          echo "<script>
          alert('Digite seu email!');
          </script>";
        }else{
        $query = ("UPDATE usuario SET `nome`='$nome', `email`='$email', 
        `senha`='$senha', `username`='$username', `foto`='$foto', `nascimento`='$nascimento', `profissao`='$profissao', `nacionalidade`='$nacionalidade'
        WHERE username='{$_SESSION["username"]}'");
            
        
        
        if ($result = mysqli_query($conexao, $query)) {
          echo "<script>
                alert('Atulizado com Sucesso, você terá que fazer login novamente!');
                location.href='logout.php';
            </script>";
          
		    }else{
          echo "<h2>Erro ao atualizar</h2>";
        }
		}
	}
?>
<style>
textarea{
    box-sizing: border-box;
    width: 100%;
}

.w3-theme{
    float: right;
}

img {
  max-width: 100%;
  height: auto;
}

#formContent{
    float: left;
    width: 70%;
}

#atualizar{
    width: 100%;
    text-align: center;
    
}

#botao{
    display:block;
    text-indent:-9000em;
    overflow:hidden;
    height:36px;
    width:36px;
    background:url(https://i.imgur.com/Uah28H7.png) no-repeat 0 0;
}

</style>


<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?php echo $_SESSION['nomePessoa']; ?></h4>
         <p class="w3-center"><img src="<?php echo $_SESSION['imagem'];?>" class="w3-circle" style="height:115px;width:115px" alt="Avatar"></p>
         <hr>
         <?php $dia=$_SESSION['nascimento']; 
                $data = new DateTime($dia);?>
         <p><i class="fas fa-pen-alt fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['profissao'];  ?> </p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['nacionalidade']; ?> </p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i><?php echo $data->format('d/m/y') ?> </p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          
          <div id="Demo1" class="w3-hide w3-container">
            
          </div>
          
          <div id="Demo2" class="w3-hide w3-container">
            
          </div>
          
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
          </div>
        </div>      
      </div>
      <br>
<!-- End Left Column -->
</div>
<!-- Middle Column -->

<div class="w3-col m7">
    
    <div class="w3-row-padding">
    
      <div class="w3-col m12">
        <div class="w3-card w3-round w3-white">
          <div class="w3-container w3-padding">
            <h6 class="w3-opacity"></h6>
            <div class="wrapper fadeInDown">
    <div class="w3-container w3-blue" id="atualizar">
        <h5>Atualizar suas infomações</h5>
    </div>
	<div id="formContent">
    
    
	<!-- Icon -->
	<!-- Tabs Titles -->
	<!-- Login Form -->
    	<form method="POST"><br>
            <label>
                <p>Nome</p>
			    <input type="text" class="w3-input" name="nome" value="<?php echo $_SESSION['nomePessoa'] ?>" placeholder="Seu nome..." maxlength="150"><br><br>
            </label>

            <label>
                <p>Email</p>
                <input type="text" class="w3-input" name="email" value="<?php echo $_SESSION['email'] ?>" placeholder="Seu email..." maxlength="150"><br><br>
            </label>

            <label>
                <p>Username</p>
                <input type="text" class="w3-input" name="username" value="<?php echo $_SESSION['username'] ?>" placeholder="Nome de usuário..." maxlength="20"><br><br>
            </label>

            <label>
                <p>Data de nascimento</p>
                <input type="text" class="w3-input" name="nascimento" value="<?php echo $_SESSION['nascimento'] ?>" placeholder="Sua data de nascimento Ano-mês-dia" maxlength="20"><br><br>
            </label>

            <label>
                <p>Profissão</p>
                <input type="text" class="w3-input" name="profissao" value="<?php echo $_SESSION['profissao'] ?>" placeholder="Profissão" maxlength="50"><br><br>
            </label>

            <label>
                <p>Nacionalidade</p>
                <input type="text" class="w3-input" name="nacionalidade" value="<?php echo $_SESSION['nacionalidade'] ?>" placeholder="País onde nasceu " maxlength="20"></p><br><br>
            </label>

            <label>
                <p>Foto URL</p>
		        <input type="text" class="w3-input" name="foto" value="<?php echo $_SESSION['imagem'] ?>" placeholder="Coloque URL da sua foto" maxlength="1000"><br><br>
            </label>

            <label>
                <p>Senha</p>
			      <input type="password" id="myInsert" class="w3-input" value="<?php echo $_SESSION['senha'] ?>" name="senha" placeholder="*************">
            </label><br><br>
			<input type="submit" id="botao" name="botao" value="Atualizar" ><br><br>
			<a href="editar.php"></a>
		</form>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
          
            
        
</div>


<!-- Right Column -->
<div class="w3-col m2 ">
    <div class="w3-card w3-round w3-white w3-center w3-right">
        <div class="w3-container" id="menu">
            <form method="POST" >
              <h5><?php echo $_SESSION['nomePessoa']; ?></h5><br />
              <div>
                    <input type="submit" value="Alterar informações" class="w3-button w3-block w3-red w3-section" name="editar">
                    <input type="submit" class="w3-button w3-block w3-teal w3-section" name="amigos" value="Ver amigos">
                  </div>
            </form>
            </div>
          </div>
        </div>
      </div>
      <br>
  <!-- End Right Column -->
  </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>


 
<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 
