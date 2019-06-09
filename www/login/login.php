<?php
session_start();
include 'conexao.php';

if(empty($_POST['username']) || empty($_POST['senha'])){
    echo "<script>
                alert('Preencha os campos corretamente!');
                location.href='../index.php';
        </script>";
    
    exit();
}

if(isset($_POST['login'])){
    
    
    
    $sql = ("SELECT * FROM usuario WHERE username = '".htmlspecialchars($_POST['username'])."'");
    
    $result = mysqli_query($conexao, $sql); 
    $dados = mysqli_fetch_assoc($result);
    
    if($dados == false){
        echo "<script>
                alert('Usuário não cadastrado!');
                location.href='../index.php';
        </script>";
    }

    if(is_array($dados)){
        if($_POST['senha'] == $dados['senha']){
            $_SESSION['username'] = $dados['username'];
            $_SESSION['senha'] = $dados['senha'];
            $_SESSION['email'] = $dados['email'];
            $_SESSION['loggedin'] = true;
            $_SESSION['nomePessoa'] = $dados['nome'];
            $_SESSION['imagem'] = $dados['foto'];
            $_SESSION['nascimento'] = $dados['nascimento'];
            $_SESSION['profissao'] = $dados['profissao'];
            $_SESSION['nacionalidade'] = $dados['nacionalidade'];
            $_SESSION['userId'] = $dados['id'];
            header('location: ../login/timeline.php ');
            

    
            
            

            }else{
                echo "<script>
                alert('Dados incorretos!');
                location.href='../index.php';
        </script>"; 
            }
        }
    }


?>