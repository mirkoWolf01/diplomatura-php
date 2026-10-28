<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo html_escape(isset($titulo) ? $titulo : 'TiendaDeRopa'); ?></title>
    <link rel="stylesheet" href="<?php echo base_url('public/css/head_style.css'); ?>">
</head>
<body>


<header class="topbar">
    <a class="homepage-button" href="<?php echo site_url('/'); ?>">TiendaDeRopa</a>

    <?php $sessionUser = $this->session->userdata('usuario');  ?>
    
    <nav class="menu">
        <?php if ($sessionUser): ?>
            <span class="saludo-usuario">Hola, <?php echo html_escape($sessionUser['nombre']); ?></span>
            <a href="<?php echo site_url('auth/logout'); ?>">Salir</a>
        <?php else: ?>
            <a href="<?php echo site_url('auth/login'); ?>">Ingresar</a>
            <a href="<?php echo site_url('auth/register'); ?>">Registrarse</a>
        <?php endif; ?>
    </nav>
</header>