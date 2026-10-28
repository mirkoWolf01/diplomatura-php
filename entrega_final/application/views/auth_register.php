<?php include("partials/head.php"); ?>
<link rel="stylesheet" href="<?php echo base_url('public/css/auth_style.css'); ?>">

<main class="auth-conteiner">
    <div class="form-container">
        <h2 class="auth-title">Registrarse</h2>
        
        <?php if (validation_errors() || isset($error)): ?>
            <div class="error-messages">
                <?php echo validation_errors(); ?>
                <?php echo isset($error) ? htmlspecialchars($error) : ''; ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('exito')): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($this->session->flashdata('exito')); ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo site_url('auth/register'); ?>" method="POST">
            
            <div class="input-group">
                <label for="nombre" class="input-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="input-field" value="" required>
            </div>

            <div class="input-group">
                <label for="mail" class="input-label">Mail</label>
                <input type="email" id="mail" name="mail" class="input-field" value="" required>
            </div>
            
            <div class="input-group">
                <label for="password" class="input-label">Contraseña</label>
                <input type="password" id="password" name="password" class="input-field" required>
            </div>

            <div class="input-group">
                <label for="password-confirmation" class="input-label">Confirmar Contraseña</label>
                <input type="password" id="password-confirmation" name="password-confirmation" class="input-field" required>
            </div>
            
            <button type="submit" class="submit-button">Registrarse</button>
        
        </form>
        
        <div class="auth-footer">
            <span>¿Ya tenes una cuenta?</span> 
            <a href="<?php echo site_url('auth/login'); ?>" class="register-link">Inicia sesion</a>
        </div>
    </div>
</main>