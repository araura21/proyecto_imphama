<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Administrador - IMPHAMA</title>
  <link rel="stylesheet" href="assets/css/estilos.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
  <a href="logout.php" style="position:fixed; top:20px; right:30px; z-index:1000; background:#e74c3c; color:#fff; padding:8px 14px; border-radius:5px; text-decoration:none; font-weight:bold; display:flex; align-items:center; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
    <i class="fas fa-sign-out-alt" style="margin-right:6px;"></i> Cerrar sesión
  </a>
  <div class="admin-wrapper" style="display:flex; min-height:100vh;">
    <aside class="sidebar">
      <div class="logo">
        <img src="assets/img/logo.png" alt="IMPHAMA Logo">
        <span class="logo-text">IMPHAMA</span>
      </div>
      <div class="desc">Panel de administración<br>Bienvenido Administrador</div>
      <nav class="nav">
        <button class="nav-item active"><i class="fas fa-chart-line"></i>Roles</button>
      </nav>
    </aside>
    <main class="main-content">
      Selecciona una opción del menú para ver el contenido.
    </main>
  </div>
</body>
</html>
