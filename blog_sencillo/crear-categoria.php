<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="contenedor">
        

        <div id="principal">
        <h1>Crear Categorias</h1>
        <p>Añade nuevas categorias al blog para que los usuarios puedan usarlas al crear sus entradas.</p>
        <form action="guardar-categoria.php" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre">

            <input type="submit" value="Guardar">
        </form>
        </div>    
        </div>
<?php require_once 'includes/footer.php'; ?>