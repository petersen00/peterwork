<?php session_start(); ?>
<?php include "verifica_login.php"; ?>
<?php include "conexao.php"; ?>
<?php include "header.php"; ?>
<?php include "coluna_esquerda.php"; ?>
<?php
    
      
    
      $pubs = ("SELECT * FROM publicacao as p, amizades as a WHERE p.user = a.de AND a.para = '{$_SESSION["nomePessoa"]}' AND a.aceite='sim'
      OR p.user = a.para AND a.de = '{$_SESSION["nomePessoa"]}' AND a.aceite='sim' ORDER BY p.id desc");
      $publi = mysqli_query($conexao, $pubs); 

      
      
        

        if (isset($_POST['editar'])){
          echo "<script>
                    location.href='editar.php';
            </script>";
        }

        if (isset($_POST['amigos'])){
          echo "<script>
                    location.href='amigos.php';
            </script>";
        }
    
    
    if (isset($_POST['publicar'])) {
        $texto = $_POST["texto"];
        $imagem = $_POST["foto"];
        $hoje = Date('Y-m-d H:i:s');
  
        if ($texto == "") {
          echo "<h3>Tens de escrever alguma coisa antes de publicar!</h3>";
        }else {
          $consulta = "INSERT INTO publicacao (user, texto, imagem, dia) 
          VALUES ('{$_SESSION['nomePessoa']}', '$texto', '$imagem', '$hoje')";
          $retorno = $conexao->query($consulta);
         if($retorno == true){
          echo "<script>
                  alert('Publicado com sucesso!');
                  location.href='timeline.php';
                </script>";
          }else{
            echo "Tenta outra vez mais tarde";
          }
        }
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
        $user = $post['user'];
          
        $receber = "INSERT INTO `curtidas` ( `user`, `pub`, `dia`) VALUES ('{$_SESSION["nomePessoa"]}',$publica,$data)";
        $info = mysqli_query($conexao, $receber);

        if($info){
          $pegar = "INSERT INTO notificacoes (`userde`,`userpara`,`tipo`,`post`,`dia`) VALUES ('{$_SESSION["nomePessoa"]}','$user','1','$publica','$data')";
          $noti = mysqli_query($conexao, $pegar);
          echo "<script>location.href='timeline.php#$publica'</script>";
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
            echo "<script>location.href='timeline.php#$publica'</script>";
            }else{
              echo "<h3>Erro ao descurtir</h3> ".$conexao->connect_error."<br>";
      }
    }
    /*Fim função*/
?>
<style>
textarea{
    box-sizing: border-box;
    width: 100%;
}

#pic_url{
  float:right;
  margin-top: 14px;
}

img {
  max-width: 100%;
  height: auto;
}

.url{
  padding: 2px;
  margin-top: 8px;
  margin-right: 10px;
  float: right;
}



</style>

<!-- Middle Column -->
<div class="w3-col m7">
    
    <div class="w3-row-padding">
      <div class="w3-col m12">
        <div class="w3-card w3-round w3-white">
          <div class="w3-container w3-padding">
            <h6 class="w3-opacity"></h6>
              <form method="POST" enctype="multipart/form-data">
                  <br>
                  <textarea placeholder="Escreva uma publicação" name="texto" maxlength="500" rows="4" style="resize: none;"></textarea>
                  <br>
                  <br>
                  <input  type="submit" value="Publicar" name="publicar" class="w3-button w3-theme">
                  <label>
                      <img src="https://www.pinclipart.com/picdir/big/69-690269_camera-identification-icon-add-camera-icon-png-clipart.png" id="pic_url"  title="Inserir fotografia" style="height:20px;width:20px"/>
                      <input class="url" type="text" class="w3-margin-right" name="foto" placeholder="Url da imagem aqui">
                  </label>
              </form>
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

