<?php session_start(); ?>
<?php include "verifica_login.php"; ?>
<?php include "conexao.php"; ?>
<?php include "header.php"; ?>

<?php 

if (isset($_POST['editar'])){
  header("Location: editar.php");
}

if (isset($_POST['amigos'])){
  header("Location: amigos.php");
}

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

  if($info == true){
    header("Location: myprofile.php#".$publica);  
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
    $userinfo = $post['user'];
      
    $receber = "DELETE FROM `curtidas` WHERE user='{$_SESSION["nomePessoa"]}' AND pub=$publica";
    $info = mysqli_query($conexao, $receber);

    if($info){
      header("Location: myprofile.php#".$publica);
      }else{
      echo "<h3>Erro ao curtir</h3> ". $conexao->connect_error . "<br>";
}
}
/*Fim função*/
/*Função Apagar*/
if (isset($_GET["deletar"])) {
  deletar();
}

    function deletar() {
    session_start();
    include "conexao.php";
    $publica = $_GET['deletar'];
    $data = date("Y-m-d");

    $post = ("SELECT * FROM publicacao WHERE id=$publica");
    $publi = mysqli_query($conexao, $post); 
    $post = mysqli_fetch_assoc($publi);
    $userinfo = $post['user'];
      
    $receber = "DELETE FROM publicacao WHERE user='{$_SESSION["nomePessoa"]}' AND id=$publica";
    $info = mysqli_query($conexao, $receber);

    if($info){
      header("Location: myprofile.php#".$publica);
      }else{
      echo "<h3>Erro ao apagar</h3> ". $conexao->connect_error . "<br>";
}
}
/*Fim função*/
    
$query = ("SELECT * FROM usuario WHERE nome='{$_SESSION["nomePessoa"]}'");
$saberr = mysqli_query($conexao, $query); 
$saber = mysqli_fetch_assoc($saberr);
$usuario = $saber["nome"];

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
         <h4 class="w3-center"><?php echo $_SESSION['nomePessoa']; ?></h4>
         <p class="w3-center"><img src="<?php echo $_SESSION['imagem'];?>" class="w3-circle" style="height:115px;width:115px" alt="Avatar"></p>
         <hr><?php $dia=$_SESSION['nascimento']; $data = new DateTime($dia);?>
         <p><i class="fas fa-pen-alt fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['profissao']; ?> </p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['nacionalidade']; ?> </p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i><?php echo $data->format('d/m/y') ?> </p>
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
                    if($nome == $_SESSION["nomePessoa"]){
                      $check = ("SELECT * FROM publicacao WHERE id='$id' AND userde='{$_SESSION["nomePessoa"]}'");
                      echo '<p class="w3-right" ><a  href="myprofile.php?deletar='.$id.'">Apagar</p>';
                      $valor = mysqli_query($conexao, $check); 
                      $del = mysqli_num_rows($valor); 
                    }
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
                        echo '<p><a href="myprofile.php?deslike='.$id.'">Gostei</a> | Você e mais '.$like.' curtiram</p>';
                      }else{
                       echo '<p><a href="myprofile.php?like='.$id.'">Gostar</a> | '.$like.' curtiram</p>';
                      }
                    
                      ?>
                          
                     </div>
                </div>
                <?php }else {?>
              <div class="w3-container w3-card w3-white w3-round w3-margin"  id= <?php echo "'.$id.'" ?>><br>
                    <img src="<?php echo $receba["foto"] ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                    <span class=" w3-opacity w3-right"><?php echo $data->format('d/m/Y H:i:s')  ?></span>
                    <?php
                      if($nome == $_SESSION["nomePessoa"]){
                       $check = ("SELECT * FROM publicacao WHERE id='$id' AND userde='{$_SESSION["nomePessoa"]}'");
                       echo '<p class="w3-right" ><a  href="myprofile.php?deletar='.$id.'">Apagar</p>';
                       $valor = mysqli_query($conexao, $check); 
                       $del = mysqli_num_rows($valor); 
                     }
                      
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
                        echo '<p><a href="myprofile.php?deslike='.$id.'">Gostei</a> | Você e mais '.$like.' curtiram</p>';
                      }else{
                       echo '<p><a href="myprofile.php?like='.$id.'">Gostar</a> | '.$like.' curtiram</p>';
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
                  
                    <input type="submit" value="Alterar informações" class="w3-button w3-block w3-red w3-section" name="editar" class="button_active">
                    <input type="submit" class="w3-button w3-block w3-teal w3-section" name="amigos" value="Ver amigos">
                  
                
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
