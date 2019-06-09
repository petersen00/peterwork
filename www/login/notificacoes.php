<?php session_start(); ?>
<?php include "conexao.php"; ?>
<?php include "header.php"; ?>
<?php include "coluna_esquerda.php"; ?>
<?php
$pubs = "SELECT * FROM amizades WHERE para='{$_SESSION['nomePessoa']}' AND aceite='nao' ORDER BY id desc";
$publi= mysqli_query($conexao, $pubs); 

$peguei = "SELECT * FROM notificacoes WHERE userpara='{$_SESSION['nomePessoa']}' ORDER BY id desc";
$notificacoes= mysqli_query($conexao, $peguei);



if(isset($_GET['id'])){
    $id = $_GET["id"];
    $return = ("SELECT * FROM usuario WHERE id='$id'");
    $saberr = mysqli_query($conexao, $return); 
    $saber = mysqli_fetch_assoc($saberr);
    $usuario = $saber["nome"];
    $data = date("y-m-d");

    $ins = "UPDATE amizades SET aceite='sim' WHERE de='$usuario' AND para='{$_SESSION['nomePessoa']}'";
    $conf = mysqli_query($conexao, $ins);
    
    if ($conf){
        echo "<script>location.href='notificacoes.php';</script>";
    }else{
      echo "<script>alert('Erro ao aceitar pedido!');</script>";
    }
}


if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    $return = ("SELECT * FROM usuario WHERE id='$id'");
        
    $saberr = mysqli_query($conexao, $return); 
    $saber = mysqli_fetch_assoc($saberr);
    $usuario = $saber["nome"];
  
    $ins = "DELETE FROM amizades WHERE id=$id";
    $conf = mysqli_query($conexao, $ins);    
        
    if ($conf){
        echo "<script>location.href='notificacoes.php';</script>";
    }else{
        echo "<script>alert('Erro ao recusar amizade!');</script>";
         
    }
}

    if (isset($_POST['editar'])){
      echo "<script>
                location.href='editar.php';
        </script>";
    }

    if (isset($_POST['amigos'])){
      echo "<script>
                location.href='notificacoes.php';
        </script>";
    }
    
    
  
?>
<style>
#pic_url{
  float:right;
  margin-top: 14px;
}

img {
  max-width: 100%;
  height: auto;
}

.footer {
   position: absolute;
   left: 0;
   width: 100%;
   background-color: red;
   color: white;
   text-align: center;
}


</style>

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


                if(mysqli_num_rows($publi)>=1){
                    
                    while ($pub = mysqli_fetch_assoc($publi)){
                        $nome = $pub['de'];
                        $pegar = ("SELECT * FROM usuario WHERE nome = '$nome'");
                        $saberr = mysqli_query($conexao, $pegar); 
                        $saber = mysqli_fetch_assoc($saberr);
                        $user = $saber['username'];
                        $id = $pub['id'];
                      
                     
                      ?>
                       <div class="w3-container w3-card w3-white w3-round w3-margin" id= <?php echo "'.$id.'" ?>><br>
                        <img src="<?php echo $saber["foto"] ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                        <span class="w3-right w3-opacity"><?php echo $pub["dia"] ?></span>
                        <?php echo '<a href="profile.php?id='.$saber['id'].'"><h5>'.$nome.'</h5></a>' ?>
                        <hr class="w3-clear">
                        <p><?php echo "$nome" ?> quer ser seu amigo! </p>
                        <?php echo '<a href="notificacoes.php?id='.$saber['id'].'"</a><input type="submit" class="w3-button w3-block w3-green w3-section" value="Aceitar" name="aceitar"></a>
                        <a href="notificacoes.php?remove='.$id.'"><input type="submit" class="w3-button w3-block w3-red w3-section" value="Recusar" name="remove"></a>';?>
                        </div>
               <?php } 
                }
                ?>
                <?php 


                if(mysqli_num_rows($notificacoes)>=1){
                    
                    while ($noti = mysqli_fetch_assoc($notificacoes)){
                        $nome = $noti['userde'];
                        $pegar = ("SELECT * FROM usuario WHERE nome = '$nome'");
                        $saberr = mysqli_query($conexao, $pegar); 
                        $saber = mysqli_fetch_assoc($saberr);
                        $user = $saber['username'];
                        $id = $noti['id'];
                      
                    
                      ?>
                      <?php if($noti['tipo']=="1"){  ?>
                        <div class="w3-container w3-card w3-white w3-round w3-margin" id= <?php echo "'.$id.'" ?>><br>
                        <img src="<?php echo $saber["foto"] ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                        <span class="w3-right w3-opacity"><?php echo $pub["dia"] ?></span>
                        <?php echo '<a href="profile.php?id='.$noti['post'].'"><h5>'.$nome.' curtiu a sua publicação</h5></a>' ?>
                        <hr class="w3-clear">
                        </div>
                      <?php }elseif ($noti['tipo']=="2"){ ?>
                        <div class="w3-container w3-card w3-white w3-round w3-margin" id= <?php echo "'.$id.'" ?>><br>
                        <img src="<?php echo $saber["foto"] ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                        <span class="w3-right w3-opacity"><?php echo $pub["dia"] ?></span>
                        <?php echo '<a href="comentarios.php?id='.$noti['post'].'"><h5>'.$nome.' comentou sua publicação</h5></a>' ?>
                        <hr class="w3-clear">
                        </div>
                
                <?php 
                }
              }
                }else {
                      echo '<h3></h3>';
                } 
              
                ?>
              
       
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
