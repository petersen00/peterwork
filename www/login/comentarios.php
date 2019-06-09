<?php session_start(); ?>
<?php include "verifica_login.php"; ?>
<?php include "conexao.php"; ?>
<?php include "header.php"; ?>
<?php include "coluna_esquerda.php"; ?>
<?php
    
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        
    }else  {
        echo "<script> location.href='timeline.php';</script>";
    } 

        $pegando = ("SELECT * FROM comentarios WHERE post='$id'");
        $publi = mysqli_query($conexao, $pegando);
      
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
        $hoje = date("y-m-d");

        $postei= ("SELECT * FROM publicacao WHERE id=$id");
        $posti = mysqli_query($conexao, $postei); 
        $menor = mysqli_fetch_assoc($posti);
        $userinfo = $menor['user'];
  
        if ($texto == "") {
          echo "<h3>Texto vazio!</h3>";
        }else {
          $consulta = "INSERT INTO comentarios (user, texto, post, dia) 
          VALUES ('{$_SESSION['nomePessoa']}','$texto','$id','$hoje')";
          $retorno = mysqli_query($conexao, $consulta); 
         if($retorno){
            $tentar = "INSERT INTO notificacoes (`userde`,`userpara`,`tipo`,`post`,`dia`) VALUES ('{$_SESSION["nomePessoa"]}','$userinfo','2','$id','$hoje')";
            $noti = mysqli_query($conexao, $tentar);  
          echo "<script>alert('Publicado com sucesso!');location.href='comentarios.php?id=$id'; </script>";
          }else{
            echo "Tenta outra vez mais tarde";
          }
        }
      } 
  
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
                  <textarea placeholder="Comente abaixo" name="texto" maxlength="500" rows="4" style="resize: none;"></textarea>
                  <br>
                  <br>
                  <input  type="submit" value="Comentar" name="publicar" class="w3-button w3-theme">
                  <label>
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
                $saberr = mysqli_query($conexao, $pegar); 
                $saber = mysqli_fetch_assoc($saberr);
                
            ?>
              <div class="w3-container w3-card w3-white w3-round w3-margin"  id=<?php echo "'.$id.'" ?>><br>
                    <span class="w3-right w3-opacity"><?php echo $pub["dia"] ?></span>
                    <?php echo '<a href="profile.php?id='.$saber['id'].'"><h5>'.$nome.'</h5></a>' ?>
                    <hr class="w3-clear">
                    <p><?php echo $pub["texto"] ?></p>
                      <div class="w3-row-padding" style="margin:0 -16px">
                          <div class="w3-half">
                              <img src="<?php echo $pub["imagem"] ?>" style="width:100%">
                              <br><br>
                          </div>
                        </div>
                      </div>   
            <?php   } ?>
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

