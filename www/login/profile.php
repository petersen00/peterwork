<?php session_start(); ?>
<?php include "verifica_login.php"; ?>
<?php include "conexao.php"; ?>
<?php include "header.php"; ?>

<?php 
    
  if (isset($_POST['editar'])){
      header("Location: editar.php");
  }
 
  /*Função adicionar amigos*/
  if (isset($_POST['add'])){
      add();
  }


    
    function add(){
    session_start();
    include "conexao.php";
      
    if(!isset($_SESSION['nomePessoa'])){
      echo "<script>location.href='logout.php';</script>";
      }
      $id = $_GET["id"];
      $return = ("SELECT * FROM usuario WHERE id='$id'");
      $tera = mysqli_query($conexao, $return); 
      $pegar = mysqli_fetch_assoc($tera);
      $usuario = $pegar["nome"];
      $data = date("y-m-d");

      $ins = "INSERT INTO amizades (`de`,`para`,`dia`) VALUES ('{$_SESSION['nomePessoa']}','$usuario','$data')";
      $conf = mysqli_query($conexao, $ins);
      
      if ($conf){
        echo "<script>location.href='profile.php?id=".$id."</script>";
      }else{
        echo "<script>alert('Erro ao enviar o pedido!');</script>";
      }
      
    }
/*Fim função*/

/*Função cancelar pedido de amizade*/
if (isset($_POST['cancelar'])){
      cancela();
  }

  
    
    function cancela(){
    session_start();
    include "conexao.php";
      
    if(!isset($_SESSION['nomePessoa'])){
      echo "<script>location.href='logout.php';</script>";
      }
      
      $id = $_GET["id"];
      $return = ("SELECT * FROM usuario WHERE id='$id'");
      $pegar = mysqli_query($conexao, $return); 
      $receber = mysqli_fetch_assoc($pegar);
      $usuario = $receber["nome"];

      $ins = "DELETE FROM amizades WHERE `de`='{$_SESSION['nomePessoa']}' AND para='$usuario'";
      $conf = mysqli_query($conexao, $ins);
      
      if ($conf){
        echo "<script>location.href='profile.php?id=".$id."</script>";
      }else{
        echo "<script>alert('Erro ao cancelar pedido!');</script>";
      }
      
    }
/*Fim função*/

/*Função remover amigos*/
if (isset($_POST['remover'])){
      remove();
  }
    
    
    function remove(){
      session_start();
      include "conexao.php";
        
      if(!isset($_SESSION['nomePessoa'])){
        echo "<script>location.href='notificacoes.php';</script>";
        }
        
        $id = $_GET["id"];
        $return = ("SELECT * FROM usuario WHERE id=$id");
        $pegar = mysqli_query($conexao, $return); 
        $receber = mysqli_fetch_assoc($pegar);
        $usuario = $receber["nome"];
  
        $ins = "DELETE FROM amizades WHERE `de`='{$_SESSION['nomePessoa']}' 
        AND para='$usuario' OR `para`='{$_SESSION['nomePessoa']}' AND de='$usuario'";
        $conf = mysqli_query($conexao, $ins);
        
        if ($conf){
          echo "<script>location.href='profile.php?id=".$id."</script>";
        }else{
          echo "<script>alert('Erro ao remover amigo!');</script>";
        }
        
      }
  /*Fim função*/

  /*Função adicionar amigos*/
  if (isset($_POST['aceitar'])){
    aceitar();
}


  
  function aceitar(){
  session_start();
  include "conexao.php";
    
  if(!isset($_SESSION['nomePessoa'])){
    echo  "<script>location.href='logout.php';</script>";
    }
    $id = $_GET["id"];
    $return = ("SELECT * FROM usuario WHERE id='$id'");
    $pegar = mysqli_query($conexao, $return); 
    $receber = mysqli_fetch_assoc($pegar);
    $usuario = $receber["nome"];
    $data = date("y-m-d");

    $ins = "UPDATE amizades SET aceite='sim' WHERE de='$usuario' AND para='{$_SESSION['nomePessoa']}'";
    $conf = mysqli_query($conexao, $ins);
    
    if ($conf){
      echo "<script>location.href='profile.php?id=".$id."</script>";
    }else{
      echo "<script>alert('Erro ao enviar o pedido!');</script>";
    }
    
  }
/*Fim função*/

/*Função curtir*/
if (isset($_GET["like"])) {
  like();
}

  function like() {
  session_start();
  include "conexao.php";
  $publica = $_GET['like'];
  $data = date("Y-m-d");

  $post = ("SELECT * FROM publicacao WHERE id=$publica");
  $publi = mysqli_query($conexao, $post); 
  $post = mysqli_fetch_assoc($publi);
  $userinfo = $post['user'];
    
  $receber = "INSERT INTO `curtidas`( `user`, `pub`, `dia`) VALUES ('{$_SESSION["nomePessoa"]}',$publica,$data)";
  $info = mysqli_query($conexao, $receber);

  if($info){
    echo "<script>location.href='profile.php#$publica'</script>";
  }else{
    echo "<h3>Erro ao curtir</h3> ". $conexao->connect_error . "<br>";
  
  }

}

/*Fim função*/
/*Função descurtir*/

if (isset($_GET["deslike"])) {
  deslike();
}

  function deslike() {
    session_start();
    include "conexao.php";
    $publica = $_GET['deslike'];
    $data = date("Y-m-d");

    $post = ("SELECT * FROM publicacao WHERE id=$publica");
    $publi = mysqli_query($conexao, $post); 
    $post = mysqli_fetch_assoc($publi);
    $user = $post['user'];
      
    $receber = "DELETE FROM `curtidas` WHERE user='{$_SESSION["nomePessoa"]}' AND pub=$publica";
    $info = mysqli_query($conexao, $receber);

    if($info){
      echo "<script>location.href='profile.php#$publica'</script>";
      }else{
      echo "<h3>Erro ao curtir</h3> ". $conexao->connect_error . "<br>";
    }

}
/*Fim função*/
    
  $id = $_GET["id"];
	$sql = ("SELECT * FROM usuario WHERE id='$id'");
  $resultado = mysqli_query($conexao, $sql); 
  $voltar = mysqli_fetch_assoc($resultado);
	$usuario = $voltar["nome"];

	if ($usuario==$_SESSION['nomePessoa']) {
		header("Location: myprofile.php?id=$id");
}

  $pubs = ("SELECT * FROM publicacao WHERE user='$usuario'  ORDER BY id desc");
  $publi = mysqli_query($conexao, $pubs); 



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
         <h4 class="w3-center"><?php echo $voltar['nome'] ?></h4>
         <p class="w3-center"><img src="<?php echo $voltar['foto'] ?>" class="w3-circle" style="height:115px;width:115px" alt="Avatar"></p>
         <hr>
         <p><i class="fas fa-pen-alt fa-fw w3-margin-right w3-text-theme"></i><?php echo $voltar['profissao'] ?> </p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $voltar['nacionalidade'] ?> </p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i><?php echo $voltar['nascimento'] ?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          
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
            </div>
          </div>
        </div>
      </div>
          
      <?php 
               
                 while ($pub = mysqli_fetch_assoc($publi)){
               $nome = $pub['user'];
               $pegar = ("SELECT * FROM usuario WHERE nome = '$nome'");
               $tera = mysqli_query($conexao, $pegar); 
               $receba = mysqli_fetch_assoc($tera);
               $user = $receba['nome'];
               $id = $pub['id'];
               $dia = $pub['dia'];
               $data = new DateTime($dia);
               $receber = ("SELECT * FROM curtidas WHERE pub='$id'"); 
               $pegarlikes = mysqli_query($conexao, $receber);
               $like = mysqli_num_rows($pegarlikes);


             
              if ($pub['imagem'] == "") { 
             ?>
             <div class="w3-container w3-card w3-white w3-round w3-margin"  id= <?php echo "'.$id.'" ?>><br>
                   <img src="<?php echo $receba["foto"] ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                   <span class="w3-right w3-opacity"><?php echo $data->format('d/m/Y H:i:s')  ?></span>
                   <?php
                     $check = ("SELECT * FROM publicacao WHERE id='$id' AND userde='{$_SESSION["nomePessoa"]}'");
                     $valor = mysqli_query($conexao, $check); 
                     $del = mysqli_num_rows($valor); 
                     
                     ?>
                   <?php echo '<a href="profile.php?id='.$receba['id'].'"><h5>'.$nome.'</h5></a>' ?>
                   <hr class="w3-clear">
                   <p><?php echo $pub["texto"] ?></p>
                     <div class="w3-row-padding" style="margin:0 -16px">
                         <div class="w3-half">
                             <img src="<?php echo $pub["imagem"] ?>" style="width:100%">
                             <br><br>
                         </div>
                       </div>
                       <div>
                     <a href="comentarios.php?id=<?php echo "$id" ?>"><span class="w3-right w3-opacity"><P>Comentários</P></span></a>
                     <?php
                     $comandos = ("SELECT user FROM curtidas WHERE pub='$id' AND user='{$_SESSION["nomePessoa"]}'");
                     $valor = mysqli_query($conexao, $comandos); 
                     $checar = mysqli_num_rows($valor);
                     if($checar >= 1){
                      $like = $like - 1;
                       echo '<p><a href="timeline.php?deslike='.$id.'">Gostei</a> | Você e mais '.$like.' curtiram</p>';
                     }else{
                      echo '<p><a href="timeline.php?like='.$id.'">Gostar</a> | '.$like.' curtiram</p>';
                     } 
                     ?>
                         
                    </div>
               </div>
               <?php }else {?>
             <div class="w3-container w3-card w3-white w3-round w3-margin"  id= <?php echo "'.$id.'" ?>><br>
                   <img src="<?php echo $receba["foto"] ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                   <span class=" w3-opacity w3-right"><?php echo $data->format('d/m/Y H:i:s')  ?></span>
                   <?php
                     $check = ("SELECT * FROM publicacao WHERE id='$id' AND userde='{$_SESSION["nomePessoa"]}'");
                     $valor = mysqli_query($conexao, $check); 
                     $del = mysqli_num_rows($valor); 
                     echo '<p class="w3-right" ><a  href="profile.php?deletar='.$id.'">Apagar</p>';
                     ?>
                   <?php echo '<a href="profile.php?id='.$receba['id'].'"><h5>'.$nome.'</h5></a>' ?>
                   <hr class="w3-clear">
                   <p><?php echo $pub["texto"] ?></p>
                     <div class="w3-row-padding" style="margin:0 -16px">
                         <div class="w3-half">
                             <img src="<?php echo $pub["imagem"] ?>" style="width:100%">
                             <br><br>
                         </div>
                       </div>
                     <div>
                     <a href="comentarios.php?id=<?php echo "$id" ?>"><span class="w3-right w3-opacity"><P>Comentários</P></span></a>
                     <?php
                     $comandos = ("SELECT user FROM curtidas WHERE pub='$id' AND user='{$_SESSION["nomePessoa"]}'");
                     $valor = mysqli_query($conexao, $comandos); 
                     $checar = mysqli_num_rows($valor);
                     if($checar >= 1){
                       $like = $like - 1;
                       echo '<p><a href="timeline.php?deslike='.$id.'">Gostei</a> | Você e mais '.$like.' curtiram</p>';
                     }else{
                      echo '<p><a href="timeline.php?like='.$id.'">Gostar</a> | '.$like.' curtiram</p>';
                     } 
                     ?>
                         
                    </div>
               
             
            </div>
            <?php 
               }

           }
            ?>
            
     
        
</div>


<!-- Right Column -->
  <div class="w3-col m2 ">
    <div class="w3-card w3-round w3-white w3-center w3-right">
        <div class="w3-container" id="menu">
            <form method="POST">
            <h5><?php echo $_SESSION['nomePessoa']; ?></h5><br />
          <?php
                $result = ("SELECT * FROM amizades WHERE de='{$_SESSION["nomePessoa"]}' AND para='$usuario' OR 
                para='{$_SESSION["nomePessoa"]}' AND de='$usuario'");
                $amigos = mysqli_query($conexao, $result);
                $amigoss = mysqli_fetch_assoc($amigos);
                if (mysqli_num_rows($amigos)>=1 AND $amigoss["aceite"]=="sim") {
                  echo '<input type="submit" value="Remover amigo" class="w3-button w3-block w3-red w3-section" name="remover">';
                }elseif (mysqli_num_rows($amigos)>=1 AND $amigoss["aceite"]=="nao" AND $amigoss["para"]==$_SESSION['nomePessoa']){
                  echo '<input type="submit" class="w3-button w3-block w3-red w3-section" value="Aceitar Pedido" name="aceitar">';
                }elseif (mysqli_num_rows($amigos)>=1 AND $amigoss["aceite"]=="nao" AND $amigoss["de"]==$_SESSION['nomePessoa']){
                  echo '<input type="submit" class="w3-button w3-block w3-red w3-section" value="Cancelar pedido" name="cancelar">';
                }else{
                  echo '<input type="submit" class="w3-button w3-block w3-green w3-section" value=" Adicionar amigo " name="add">';
                }
          ?>
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

<!-- Footer -->
 
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
