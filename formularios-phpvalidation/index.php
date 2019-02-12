<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario</title>
    <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css" type="text/css">
    <style>
        .validado{
            padding:10px;
            background-color: rgb(12, 102, 12);
            font-size: 12px;
            margin:10px;
        }
        .error{
            padding:10px;
            background-color: rgb(212, 96, 96);
            font-size: 12px;
            margin:-20px 10px 10px 10px;
            
        }
    </style>    
</head>
<body>
    <div class="contenedor">
    <form method="POST" action="#">
        <div class="zona-error">    
            <?php 
                $user = "";
                $password = "";
                $email = "";
                $pais = "";
                $nivel ="";
                $lenguaje = array();
                             
                //First i checked if user has sent user, password, email and country.
                //And(&&) needs all options set as true to be true.
                if(!empty($_POST['usuario'])){
                    $user = $_POST['usuario'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $pais = $_POST['pais'];
                    //Now i checked if level and lenguage were sent.
                    if(isset($_POST['nivel'])){
                        $nivel = $_POST['nivel'];
                    }else{
                        $nivel = "";
                    }
                    if(!empty($_POST['lenguaje'])){
                        $lenguaje = $_POST['lenguaje'];
                    }else{
                        $lenguaje = [];
                    }
                    //I declared a variable to know what is incorrect and could show the errors.
                    $error = array();
                    //once i know there's none empty field in the form, i will ask for the validation.
                    //User name: length(5,20), with not special caracteres ('ñ', '_' and blanck space included).
                    if(!preg_match('/^[A-Za-z0-9_ñ ]{5,20}$/',$user)){
                        array_push($error,"Usuario invalido");
                    }
                    //Password: At least 1 number, 1 upper and 1 lower with a 8-16 length.
                    if(!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,16}$/',$password)){
                        array_push($error,"Contraseña invalida");
                    }
                    //HTML uses the same validation for email, but we are doing this on the back for more security.
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        array_push($error,"Email invalido");
                    }
                    //Here for languages we need to select at least 2 values to pass
                    if(count($lenguaje)<2){
                        array_push($error,"Selecciona al menos 2 preferencias");
                    }
                    //Here we print the errors founds
                    if($error == null){
                        echo "<div class=\"validado\">";
                        echo "<li>Datos Validados Correctamente</li>";
                    }else{
                        echo "<div class=\"error\">";
                        foreach ($error as $result){
                            echo "<li>".$result."</li>";
                        }
                        echo "</div>";
                    }
                }
            ?>
        <!--    The values previously sent are printed. Thus user doesn't have to rewrite 
        them again. Except for password, to avoid mistakes.         -->
        </div>
        <h1>Formulario</h1>
        <label class="marg-agregar" for="user">Usuario</label> <br>
        <input type="text" name="usuario" id="user" placeholder="Usuario" value="<?=$user;?>"> <br>
        <label class="marg-agregar" for="pass">Contraseña</label> <br>
        <input type="password" name="password" id="pass" placeholder="Contraseña" > <br>
        <label class="marg-agregar" for="correo" >Correo</label> <br>
        <input type="email" name="email" id="correo" placeholder="name@domain.com" value="<?=$email;?>">
        
    <div class="intereses">
        <p>Selecciona tus intereses (Al menos 2)</p>
        
        <input type="checkbox" name="lenguaje[]" value="HTML" id="HTML" <?php if(in_array('HTML',$lenguaje)) echo "checked"; ?>> <label for="HTML">HTML5</label><br>
        <input type="checkbox" name="lenguaje[]" value="CSS" id="CSS" <?php if(in_array('CSS',$lenguaje)) echo "checked"; ?>> <label for="CSS">CSS</label><br>
        <input type="checkbox" name="lenguaje[]" value="JS" id="JS" <?php if(in_array('JS',$lenguaje)) echo "checked"; ?>> <label for="JS">Javascript</label><br>
        <input type="checkbox" name="lenguaje[]" value="PHP" id="PHP" <?php if(in_array('PHP',$lenguaje)) echo "checked"; ?>> <label for="PHP">php</label><br>
        <input type="checkbox" name="lenguaje[]" value="Java" id="Java" <?php if(in_array('Java',$lenguaje)) echo "checked"; ?>> <label for="Java">Java</label><br>
        <input type="checkbox" name="lenguaje[]" value="PY" id="PY" <?php if(in_array('PY',$lenguaje)) echo "checked"; ?>> <label for="PY">Python</label><br>
        <input type="checkbox" name="lenguaje[]" value="CSh" id="CSh" <?php if(in_array('CSh',$lenguaje)) echo "checked"; ?>> <label for="CSh">C#</label><br>
        <input type="checkbox" name="lenguaje[]" value="ERRE" id="ERRE" <?php if(in_array('ERRE',$lenguaje)) echo "checked"; ?>> <label for="ERRE">R</label><br>
    </div>
        <p>¿Cuál es tu nivel programando?</p>
        <input type="radio" name="nivel" id="basico" value="basico" <?php if($nivel == "basico") echo "checked"; ?>> <label for="basico">Básico</label>
        <input type="radio" name="nivel" id="intermedio" value="intermedio" <?php if($nivel == "intermedio") echo "checked"; ?>><label for="intermedio">Intermedio</label>
        <input type="radio" name="nivel" id="avanzado" value="avanzado" <?php if($nivel == "avanzado") echo "checked"; ?>> <label for="avanzado">Avanzado</label>
        
        <p>País de origen</p>
        <input list="pais" name="pais" value="<?= $pais;?>">
        <datalist id="pais">
            <option value="">Selecciona un país
            <option value="AR">Argentina
            <option value="MX">México
            <option value="PY">Paraguay
            <option value="PE">Peru
            <option value="CL">Chile
            <option value="PA">Panama
            <option value="CO">Colombia
        </datalist>
    <div class="contenedor-boton">
        <input type="submit" value="Enviar" id="button">
    </div>
    </form>
</body>
</html>