<?php
error_reporting(1);
session_start();


if(!$_SESSION['loggedin']) {
   
   header('Location: /redesocial/index.php');
   exit(); 
   
}
?>