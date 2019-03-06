<?php require_once 'includes/cabecera.php';?>
<?php require_once 'includes/lateral.php'; ?>

    <div id="contenedor">
        

        <div id="principal">
            <h1>Ultimas entradas</h1>
            <?php 
                $entradas = conseguirEntradas($db,true);
                if(!empty($entradas)):
                    while($entrada = mysqli_fetch_assoc($entradas)):
            ?>
                <article>
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2><?=$entrada['titulo']?></h2>
                    <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha'];?>
                    <p>
                    <?=substr($entrada['descripcion'], 0, 180)."..."?>
                    </p>
                    </a>
                </article>
            <?php
                    endwhile;
                endif;
            ?>
            
            <div id="ver-todas">
            <a href="entradas.php">Ver todas las entradas</a>
            </a></div>
        </div>
        
        <div class="clearfix"></div>
    </div>    
<?php require_once 'includes/footer.php'; ?>