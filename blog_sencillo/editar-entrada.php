<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php'; ?>
<?php 
            $entrada_actual = conseguirEntrada($db, $_GET['id']);
            if(!isset($entrada_actual['id'])){
                header("Location:index.php");
            }
?>

<div id="contenedor">

        <div id="principal">

        <h1>Edita tu entrada </h1>
        <p>Edita tu entrada: <?=$entrada_actual['titulo']?></p>
        <br>
<form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
            <label for="titulo">Titulo: </label>
            <input type="text" name="titulo" id="titulo" value="<?=$entrada_actual['titulo']?>"><br>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'titulo') : ''; ?>
            <label for="categoria">Categoría: </label>
            <select name="categoria" id="categoria">
                <option value="">-- Elige Categoria --</option>
                <?php 
                    $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
                        
                ?>
                <option value="<?=$categoria['id']?>" <?= ($categoria['id']== $entrada_actual['categoria_id']) ? 'selected= "selected"': '' ?>>
                
                    <?=$categoria['nombre'];?>
                </option>
                <?php 
                    endwhile;
                endif;
                ?>
                
            </select><br>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'categoria') : ''; ?>
            <label for="descripcion">Descripción: </label>
            <textarea rows="4" cols="50" name="descripcion"><?=$entrada_actual['descripcion']?></textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'descripcion') : ''; ?>

            <input type="submit" value="Guardar">
        </form>

</div>
   </div>    
<?php require_once 'includes/footer.php'; ?>