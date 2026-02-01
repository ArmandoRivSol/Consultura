<?php
include "php/auth.php";
include "php/conexion.php";

$qSolicitudes = mysqli_query($conn, "SELECT COUNT(*) AS total FROM solicitudes");
$totalSolicitudes = mysqli_fetch_assoc($qSolicitudes)['total'];

$qHoy = mysqli_query($conn, "SELECT COUNT(*) AS hoy FROM solicitudes WHERE DATE(fecha) = CURDATE()");
$solicitudesHoy = mysqli_fetch_assoc($qHoy)['hoy'];

$qAdmins = mysqli_query($conn, "SELECT COUNT(*) AS admins FROM admin");
$totalAdmins = mysqli_fetch_assoc($qAdmins)['admins'];

$result = mysqli_query($conn, "SELECT * FROM solicitudes ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Admin | Chat Corporación</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<header class="header">
  <div class="navbar">
    <div class="logo-container">
      <img src="img/logo.png" alt="Chat Corporación" class="logo">
      <span class="brand">Chat Corporación</span>
    </div>
    <nav class="nav-links">
      <a href="index.html">Inicio</a>
      <a href="php/logout.php" class="admin-btn">Salir</a>
    </nav>
  </div>
</header>

<section class="hero hero-admin">
  <h1>Panel de Administración</h1>
  <p>Gestión de solicitudes recibidas</p>
</section>

<section class="admin-dashboard">

  <div class="admin-cards">
    <div class="admin-card">
      <h3>Solicitudes</h3>
      <p class="number"><?php echo $totalSolicitudes; ?></p>
    </div>

    <div class="admin-card">
      <h3>Solicitudes Hoy</h3>
      <p class="number"><?php echo $solicitudesHoy; ?></p>
    </div>

    <div class="admin-card">
      <h3>Administradores</h3>
      <p class="number"><?php echo $totalAdmins; ?></p>
    </div>
  </div>

  <div class="admin-table">
    <h2>Últimas solicitudes</h2>
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Mensaje</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['nombre']; ?></td>
          <td><?php echo $row['correo']; ?></td>
          <td><?php echo $row['telefono']; ?></td>
          <td><?php echo $row['mensaje']; ?></td>
          <td><?php echo $row['fecha']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

</section>

</body>
</html>
