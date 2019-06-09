<?php session_start(); ?>
<?php include "verifica_login.php"; ?>
<?php include "conexao.php"; ?>
<?php include "header.php"; ?>
<?php

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
    background:url(https://icon-icons.com/icons2/1102/PNG/32/1485969921-5-refresh_78908.png) no-repeat 0 0;
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
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['profissao']; ?> </p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['nacionalidade']; ?> </p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['nascimento']; ?> </p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Grupos</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p>Some text..</p>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i>Eventos</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p>Some other text..</p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Minhas fotos</button>
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
                    <h5>Resultados da busca</h5>
                </div>
	            <div id="formContent">
                
                <?php
                    $pesquisar = $_GET['pesquisar'];

                    $min_length = 4;
        
                    if (strlen($pesquisar) >= $min_length) {
                        
        
                        $pegar = ("SELECT * FROM usuario WHERE nome LIKE '%".$pesquisar."%'");
                        $resultado = mysqli_query($conexao, $pegar); 

        
                        if (mysqli_num_rows($resultado) > 0) {
                            echo "<br /><br />";
                            while ($result = mysqli_fetch_array($resultado)) {
                ?>          <img src="<?php echo $result["foto"] ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">    
                <?php
                                echo '<a href="profile.php?id='.$result["id"].'" name="p"><br /><p name="p"><h3>'.$result["nome"].'</h3></p><br /></a><br /><hr /><br />';
                            }
                        }else{
                            echo "<br /><h3>Não foram encontrados resultados.</h3>";
                        }
                    }else{
                        echo "<br /><h3>Mínimo de 4 letras para pesquisa.</h3>";
                    }
                    
                
                
                ?>
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

<?php include "footer.php"; ?>
 
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
