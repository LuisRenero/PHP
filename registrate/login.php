<?php 
require_once 'includes/conexion.php';

if(isset($_POST)){

    if(isset($_SESSION['error_login'])){
        session_unset($_SESSION['error_login']);
    }
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email ='$email'";
    $login = mysqli_query($db, $sql);

    $usuario = mysqli_fetch_assoc($login);
    

    
    if($login && mysqli_num_rows($login)==1){

        
        $verify = password_verify($password, $usuario['password']);        

        if($verify){
            $_SESSION['usuario'] = $usuario;

       }else{
            $_SESSION['error_login'] = "Login incorrecto";
        }
    }else{
        $_SESSION['error_login'] = "Login incorrecto";
    }
}
header('Location: index.php');
?>


