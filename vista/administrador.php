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
  <?php
    session_start();
    // Protección: si no hay usuario logueado, redirigir a login
    if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['nombre'])) {
      header('Location: ../index.php');
      exit();
    }
    // Ejemplo: $_SESSION['permisos'] = ['dashboard', 'auditoria', 'roles', 'empleados'];
    // Si no existen permisos, por defecto todos desactivados
    $permisos = isset($_SESSION['permisos']) ? $_SESSION['permisos'] : [];
    function btnDisabled($permiso) {
      global $permisos;
      return in_array($permiso, $permisos) ? '' : 'disabled-panel';
    }
  ?>
  <style>
    .disabled-panel {
      opacity: 0.5 !important;
      pointer-events: none !important;
      filter: grayscale(0.7);
    }
  </style>
  <header style="display:flex; justify-content:space-between; align-items:center; background: linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,41,59,0.85) 100%); color:#fff; padding:0.7em 2em; position:fixed; top:0; left:0; right:0; z-index:100; height:70px;">
    <div style="display:flex; align-items:center;">
      <img src="assets/img/logo.png" alt="IMPHAMA Logo" style="height:40px; margin-right:14px; object-fit:contain; image-rendering:auto;">
  <span style="font-size:1.7em; font-weight:700; color:#fff; font-family:'Poppins',sans-serif; letter-spacing:1px;">IMPHAMA</span>
    </div>
    <div style="display:flex; align-items:center; gap:18px;">
      <i class="fas fa-user-circle" style="font-size:2em; color:#fff; margin-right:8px;"></i>
      <span style="font-size:1.1em; color:#fff; font-weight:500; text-shadow:0 2px 8px rgba(0,0,0,0.18);">
        Bienvenido
        <?php
          if (isset($_SESSION['nombre']) && isset($_SESSION['apellido'])) {
            echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']);
          }
        ?>
      </span>
      <a href="../controlador/logout.php" style="background:#e74c3c; color:#fff; padding:8px 14px; border-radius:5px; text-decoration:none; font-weight:bold; display:flex; align-items:center; box-shadow:0 2px 8px rgba(0,0,0,0.08); margin-left:12px;">
        <i class="fas fa-sign-out-alt" style="margin-right:6px;"></i> Cerrar sesión
      </a>
    </div>
  </header>
  <div class="admin-wrapper" style="display:flex; min-height:100vh; padding-top:70px;">
    <aside class="sidebar" style="margin-top:70px;">
      <nav class="nav" style="margin-top:1em;">
        <button class="nav-item <?php echo btnDisabled('dashboard'); ?>" id="btn-dashboard" type="button"><i class="fas fa-tachometer-alt"></i> Dashboard</button>
        <button class="nav-item <?php echo btnDisabled('auditoria'); ?>" id="btn-auditoria" type="button"><i class="fas fa-search"></i> Auditoria</button>
        <button class="nav-item <?php echo btnDisabled('roles'); ?>" id="btn-roles" type="button"><i class="fas fa-user-shield"></i> Roles</button>
        <button class="nav-item <?php echo btnDisabled('empleados'); ?>" id="btn-empleados" type="button"><i class="fas fa-users"></i> Empleados</button>
        <button class="nav-item <?php echo btnDisabled('usuarios'); ?>" id="btn-usuarios" type="button"><i class="fas fa-user"></i> Usuarios</button>
        <button class="nav-item <?php echo btnDisabled('productos'); ?>" id="btn-productos" type="button"><i class="fas fa-box"></i> Productos</button>
        <button class="nav-item <?php echo btnDisabled('proveedores'); ?>" id="btn-proveedores" type="button"><i class="fas fa-handshake"></i> Proveedores</button>
        <button class="nav-item <?php echo btnDisabled('detalleProductos'); ?>" id="btn-detalle-productos" type="button"><i class="fas fa-info-circle"></i> Detalle Productos</button>
        <button class="nav-item <?php echo btnDisabled('cotizaciones'); ?>" id="btn-cotizaciones" type="button"><i class="fas fa-file-invoice-dollar"></i> Cotizaciones</button>
        <button class="nav-item <?php echo btnDisabled('clientes'); ?>" id="btn-clientes" type="button"><i class="fas fa-address-book"></i> Clientes</button>
        <button class="nav-item <?php echo btnDisabled('generarCotizacion'); ?>" id="btn-generar-cotizacion" type="button"><i class="fas fa-file-signature"></i> Generar Cotización</button>
      </nav>
    </aside>
    <main class="main-content" id="main-content">
      
    </main>
  <!-- Eliminado: la navegación ahora es dinámica vía admin.js -->
  <script src="../validaciones/admin.js"></script>
  </div>
</body>
</html>
