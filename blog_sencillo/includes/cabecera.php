<?php require_once 'conexion.php'; ?>
<?php require_once 'helpers.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Blog de Videojuegos</title>
</head>
<body>
    <!--Cabecera-->
    <header>
        <div id="logo">
            <a href="index.php">Blog de Videojuegos</a>
        </div>
        
        <nav id="menu">
        <ul>
            <li><a href="./">Inicio</a></li>
            <?php 
                $categorias = conseguirCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)) : 
            ?>
                <li><a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a></li>
            <?php 
                endwhile;
                    endif;
            ?>

            <li><a href="#">Sobre mi</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
        </nav>
        <div class="clearfix"></div>
    </header>