<?php
session_start();
session_destroy();
echo "<script>
                alert('Você saiu da sua conta. Até breve!');
                location.href='../index.php';
        </script>";
exit();

?>