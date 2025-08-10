
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - IMPHAMA Manager</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
  <div class="login-wrapper">
    <div class="left-section">
      <div class="brand-overlay">
        <div class="brand-content">
          <div class="company-logo">
            <img src="assets/img/logo.png" alt="IMPHAMA" class="logo-image">
            <h1 class="company-name">IMPHAMA</h1>
            <p class="company-tagline">Seguridad Industrial</p>
          </div>
        </div>
      </div>
    </div>

    <div class="right-section">
      <div class="login-container">
        <div class="login-header">
          <h2 class="form-title">Iniciar Sesión</h2>
          <p class="form-subtitle">Accede a tu cuenta para continuar</p>
        </div>

      <?php if (isset($_GET['error']) && $_GET['error']): ?>
        <div style="color:red; margin-bottom:10px; text-align:center;">
          <?= htmlspecialchars($_GET['error']) ?>
        </div>
      <?php endif; ?>
      <form class="login-form" method="POST" action="../controlador/loginController.php" autocomplete="off">
          <div class="form-group">
            <label for="usuario" class="form-label">Usuario</label>
            <div class="input-wrapper">
              <i class="fas fa-user input-icon"></i>
              <input 
                type="text" 
                id="usuario"
                name="usuario" 
                placeholder="Ingresa tu usuario" 
                class="form-input"
                value="<?= isset($_GET['usuario']) ? htmlspecialchars($_GET['usuario']) : '' ?>"
              >
            </div>
          </div>
          
          <div class="form-group">
            <label for="contrasena" class="form-label">Contraseña</label>
            <div class="input-wrapper">
              <i class="fas fa-lock input-icon"></i>
              <input 
                type="password" 
                id="contrasena"
                name="contrasena" 
                placeholder="Ingresa tu contraseña" 
                class="form-input"
                autocomplete="off"
              >
              <button type="button" class="toggle-password" onclick="togglePassword()">
                <i class="fas fa-eye" id="toggleIcon"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="login-btn">
            <span>Iniciar Sesión</span>
            <i class="fas fa-arrow-right btn-icon"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
