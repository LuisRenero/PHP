<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php';?>

<div id="contenedor">


<div id="principal">
        <h1>Crear Entradas</h1>
        <p>Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de su contenido</p>
        <form action="guardar-entrada.php" method="POST">
            <label for="titulo">Titulo: </label>
            <input type="text" name="titulo" id="titulo"><br>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'titulo') : ''; ?>
            <label for="categoria">Categoría: </label>
            <select name="categoria" id="categoria">
                <option value="">-- Elige Categoria --</option>
                <?php 
                    $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
                        
                ?>
                <option value="<?=$categoria['id']?>">
                    <?=$categoria['nombre'];?>
                </option>
                <?php 
                    endwhile;
                endif;
                ?>
                
            </select><br>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'categoria') : ''; ?>
            <label for="descripcion">Descripción: </label>
            <textarea rows="4" cols="50" name="descripcion"></textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'descripcion') : ''; ?>

            <input type="submit" value="Guardar">
        </form>
        <?php borrarErrores(); ?>
    </div>  
    
</div>

<?php require_once 'includes/footer.php';?>