<?php include("partials/head.php"); ?>
<link rel="stylesheet" href="<?php echo base_url('public/css/auth_style.css'); ?>">

<main class="auth-conteiner">
    <div class="form-container">
        <h2 class="auth-title">Iniciar sesión</h2>
        
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

        <form action="<?php echo site_url('auth/login'); ?>" method="POST">
            
            <div class="input-group">
                <label for="mail" class="input-label">Mail</label>
                <input type="email" id="mail" name="mail" class="input-field" value="<?php echo set_value('mail'); ?>" required>
            </div>
            
            <div class="input-group">
                <label for="password" class="input-label">Contraseña</label>
                <input type="password" id="password" name="password" class="input-field" required>
            </div>
            
            <button type="submit" class="submit-button">Ingresar</button>
        
        </form>
        
        <div class="auth-footer">
            <span>¿No tenés cuenta?</span> 
            <a href="<?php echo site_url('auth/register'); ?>" class="register-link">Registrate</a>
        </div>
    </div>
</main>