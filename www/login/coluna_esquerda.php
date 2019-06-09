<?
session_start();
include 'login/conexao.php';
?>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
        <h4 class="w3-center">Bem vindo, <?php echo $_SESSION['nomePessoa']; ?></h4>
         <p class="w3-center"><img src="<?php echo $_SESSION['imagem']; ?>" class="w3-circle" style="height:115px;width:115px" alt="Avatar"></p>
         <hr><?php $dia=$_SESSION['nascimento']; $data = new DateTime($dia);?>
         <p><i class="fas fa-pen-alt fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['profissao']; ?> </p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['nacionalidade']; ?> </p>
         
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i><?php echo $data->format('d/m/y') ?> </p>
        </div>
      </div>
      <br>
      <style>
      
    </style>
      <!-- Accordion -->
      <div class="w3-card w3-round"  >
        <div  id="esquerda">
          
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