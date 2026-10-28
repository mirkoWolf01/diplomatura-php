<?php include("partials/head.php"); ?>
<link rel="stylesheet" href="<?php echo base_url('public/css/home_style.css'); ?>">

<main class="catalogo-container">
<h2>Catalogo de Ropa</h2>

<div class="stacked-product-list">
    <?php
    /** @var array $productos */
     foreach ($productos as $producto): ?>
        <?php $id = $producto->codigo_producto; ?>
        
        <article class="product-horizontal-card">
            
            <div class="product-id">
                <a class="link-detalle-producto" href="<?php echo site_url('home/detalle_producto/' . $id); ?>">
                    Código: <?php echo $id; ?>
                </a>
            </div>
            
            <div class="product-name">
                <?php echo htmlspecialchars($producto->nombre); ?>
            </div>
            
            <div class="product-price">
                <?php echo '$' . number_format($producto->precio, 0, ',', '.'); ?>
            </div>
            
            <div class="product-stock">
                <?php
                if ($producto->stock > 30):
                    echo "<span class=\"huge-stock-label\">Stock: " . $producto->stock . "</span>";
                elseif ($producto->stock > 0):
                    echo "<span class=\"last-stock-label\">¡Últimas " . $producto->stock . "!</span>";
                else:
                    echo "<span class=\"no-stock-label\">Agotado</span>";
                endif;
                ?>
            </div>
            
        </article>
    <?php endforeach; ?>
</div>

</main>