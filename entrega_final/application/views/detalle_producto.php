<?php include("partials/head.php"); ?>
<link rel="stylesheet" href="<?php echo base_url('public/css/detalle_producto_style.css'); ?>">

<?php /** @var Object $producto */ ?>
<main class="detalle-container">
    
    <article class="product-detail-card">
        <h2>Detalle del Producto</h2>

        <div class="detalle-seccion-producto">
            <span class="detail-label" >Codigo</span>
            <span class="detail-value"><?php echo $producto->codigo_producto; ?></span>
        </div>

        <div class="detalle-seccion-producto">
            <span class="detail-label">Nombre</span>
            <span class="detail-value"><?php echo htmlspecialchars($producto->nombre); ?></span>
        </div>

        <div class="detalle-seccion-producto">
            <span class="detail-label">Precio</span>
            <span class="detail-value price-value">$<?php echo number_format($producto->precio, 2); ?></span>
        </div>

        <div class="detalle-seccion-producto">
            <span class="detail-label">Stock</span>
            <span class="detail-value">
                <?php
                if($producto->stock > 30):
                    echo "<span class=\"huge-stock-label\">" . $producto->stock . "</span>";
                elseif($producto->stock > 0):
                    echo "<span class=\"last-stock-label\">¡Últimas " . $producto->stock . " unidades!</span>";
                else:
                    echo "<span class=\"no-stock-label\">Agotado</span>";
                endif;
                ?>
            </span>
        </div>
    </article>

    <div class="back-link-container">
        <a class="boton-link" href="<?php echo site_url(); ?>">&larr; Volver al listado</a>
    </div>

</main>