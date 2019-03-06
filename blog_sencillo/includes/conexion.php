<?php 
$server = "localhost";
$usuario = "root";
$password = '';
$database = 'blog_master';
$db = mysqli_connect($server, $usuario, $password, $database) or die("Error al abrir la base de datos");

mysqli_query($db, "SET NAMES 'utf8'");

if(!isset($_SESSION)){
    session_start();
}
?>