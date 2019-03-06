<?php 

if(isset($_POST)){
    require_once 'includes/conexion.php';
    $nombre = (isset($_POST['nombre'])) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = (isset($_POST['apellidos']))? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = (isset($_POST['email'])) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
    
    $errores = array();

    if(!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/', $nombre)){
        $nombre_validado = true;
    }else{
        $errores['nombre'] = 'El nombre no es válido';  
    }
    
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match('/[0-9]/', $apellidos)){
        $apellido_validado = true;
    }else{
        $errores['apellidos'] = 'El apellido no es valido';
    }

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else{
        $errores['email'] ='El email no es válido';
    }

    

    $guardar_usuario = false;

    if(empty($errores)){
        $guardar_usuario = true;

        $query = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $existe_email = mysqli_query($db, $query);
        $existe_user = mysqli_fetch_assoc($existe_email);
        if($existe_user['id'] == $usuario['id'] || empty($existe_user)){ 


            $usuario = $_SESSION['usuario'];
            $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', email = '$email' WHERE id = ".$usuario['id'].";";
            
            $guardar = mysqli_query($db, $sql);


            if($guardar){
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $Email;
                $_SESSION['completado'] = "Tus datos se han actualizado con exito";
            }else{
                $_SESSION['errores']['general'] ="Fallo al guardar actualizar tus datos";
            }
        }else{
            $_SESSION['errores']['general'] ="El usuario ya existe";
        }
    
    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: mis-datos.php');

?>