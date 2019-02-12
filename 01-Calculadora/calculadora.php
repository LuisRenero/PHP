<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculadora</title>
    <style>
        input[type="submit"]{
            margin:5px;
            padding:5px;
            min-width:30px;
        }
        div.borrado{
            float:left;
        }
        div.operaciones{
            float:left;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <?php
        $pantalla = "";
        //i've set 'mostrar'(show) as an array if it doesn't exists
        if(!isset($_SESSION['mostrar'])){
            $_SESSION['mostrar'] = array();
        }
        if(!isset($_SESSION['saveoperator'])){
            $_SESSION['saveoperator'] = "";
        }
        if(!isset($_SESSION['valor1'])){
            $_SESSION['valor1'] = 0;
            $_SESSION['valor2'] = 0;
        }
        //I ask if a number is sent
        if(isset($_POST['num'])){
            //Condition to not allow more than 1 dot
            if($_POST['num'] == "." && in_array(".",$_SESSION['mostrar'])){
            }else{
                //adding values to the array
                array_push($_SESSION['mostrar'],$_POST['num']);
                //array to string
                $pantalla = implode($_SESSION['mostrar']);
            }
        }
        //clear options ('c' and 'borrar1')
        if(isset($_POST['borrar'])){
            if($_POST['borrar'] == "C"){
                $_SESSION['mostrar'] = array();
            }elseif($_POST['borrar'] == "borrar1"){
                array_pop($_SESSION['mostrar']);
                $pantalla = implode($_SESSION['mostrar']);
            }
        }
        //operator options ('+','-','*','/')
        if(isset($_POST['operator'])){
            $pantalla = implode($_SESSION['mostrar']);
            $_SESSION['valor1'] = (int)$pantalla;
            if($_POST['operator'] == "+"){
                $_SESSION['saveoperator'] = 'sum';
            }elseif($_POST['operator'] == "-"){
                $_SESSION['saveoperator'] = 'res';
            }elseif($_POST['operator'] == "*"){
                $_SESSION['saveoperator'] = 'mult';
            }elseif($_POST['operator'] == "/"){
                $_SESSION['saveoperator'] = 'div';
            }
            $_SESSION['mostrar'] = array();
        }
        //Do the math
        if(isset($_POST['equals'])){
            $pantalla = implode($_SESSION['mostrar']);
            $_SESSION['valor2'] = (int)$pantalla;
            if($_SESSION['saveoperator'] == 'sum'){
                $pantalla = $_SESSION['valor1'] + $_SESSION['valor2'];
            }elseif($_SESSION['saveoperator'] == 'res'){
                $pantalla = $_SESSION['valor1'] - $_SESSION['valor2'];
            }elseif($_SESSION['saveoperator'] == 'mult'){
                $pantalla = $_SESSION['valor1'] * $_SESSION['valor2'];
            }elseif($_SESSION['saveoperator'] == 'div'){
                $pantalla = $_SESSION['valor1'] / $_SESSION['valor2'];
            }
                $_SESSION['mostrar'] = array();
        }
    ?>
    <div class=calculadora>
        <form action="" method="POST">
            <input type="text" name="pantalla" id="pantalla" value="<?=$pantalla;?>"><br>
            <div class="borrado">
                <input type="submit" value="borrar1" name="borrar"> <input type="submit" value="C" name="borrar"> <br>
                <input type="submit" value="7" name="num"> <input type="submit" value="8" name="num"> <input type="submit" value="9" name="num"><br>
                <input type="submit" value="4" name="num"> <input type="submit" value="5" name="num"> <input type="submit" value="6" name="num"><br>
                <input type="submit" value="1" name="num"> <input type="submit" value="2" name="num"> <input type="submit" value="3" name="num"><br>
                <input type="submit" value="0" name="num"> <input type="submit" value="." name="num"> <input type="submit" value="=" name="equals"><br>
            </div>
            <div class=operaciones>
                <input type="submit" value="+" name="operator"> <br>
                <input type="submit" value="-" name="operator"> <br>
                <input type="submit" value="*" name="operator"> <br>
                <input type="submit" value="/" name="operator"> <br>
            </div>
        </form>
    </div>
</body>
</html>