<?PHP
# Conexão com o banco de dados

error_reporting(1);
$conexao = new mysqli("localhost", "root", "", "rede_social");
$banco = mysqli_select_db($conexao,'rede_social') or die("Erro ao selecionar o banco de dados");
?>