<?PHP
# Conexão com o banco de dados

error_reporting(1);
$conexao = new mysqli("mysql105.prv.f1.k8.com.br.", "peterwork", "Tp121933", "peterwork");
$banco = mysqli_select_db($conexao,'peterwork') or die("Erro ao selecionar o banco de dados");
?>