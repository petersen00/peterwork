<?php session_start(); ?>
<?php include "verifica_login.php"; ?>
<?php include "conexao.php"; ?>
<?php include "header.php"; ?>
<?php include "coluna_esquerda.php"; ?>
<?php
    
    
    
    
    
    $pubs = ("SELECT * FROM amizades WHERE de='{$_SESSION["nomePessoa"]}' OR para='{$_SESSION["nomePessoa"]}'");
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
               
               while ($pub = mysqli_fetch_assoc($publi)){
                 if($pub["aceite"]=='nao'){
                   
                 }else{
                    if ($pub['de']==$_SESSION["nomePessoa"] ) {
                        $para = $pub['para'];
                        $pegar = ("SELECT * FROM usuario WHERE nome = '$para'");
                        $info = mysqli_query($conexao, $pegar); 
                        $amigo = mysqli_fetch_assoc($info);    
               
               ?>
                <div class="w3-container w3-card w3-white w3-round w3-margin" id= <?php echo "'.$id.'" ?>><br>
                 <img src="<?php echo $amigo["foto"] ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                 <span class="w3-right w3-opacity"><?php echo $pub["dia"] ?></span>
                 <?php echo '<a href="profile.php?id='.$amigo['id'].'"><h5>'.$amigo['nome'].'</h5></a>' ?>
                 <hr class="w3-clear">
                 
                 </div>
                 <?php }else{
                 $de = $pub['de'];
                 $pegar = ("SELECT * FROM usuario WHERE nome = '$de'");
                 $info = mysqli_query($conexao, $pegar); 
                 $amigo = mysqli_fetch_assoc($info);
                 ?>
                <div class="w3-container w3-card w3-white w3-round w3-margin" id= <?php echo "'.$id.'" ?>><br>
                 <img src="<?php echo $amigo["foto"] ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                 <span class="w3-right w3-opacity"><?php echo $pub["dia"] ?></span>
                 <?php echo '<a href="profile.php?id='.$amigo['id'].'"><h5>'.$amigo['nome'].'</h5></a>' ?>
                 <hr class="w3-clear">
                 
                 </div>   
        <?php  
            }
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

