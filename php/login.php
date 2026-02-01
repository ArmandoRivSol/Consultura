<?php
session_start();
include "conexion.php";

$correo   = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE correo='$correo' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
  $_SESSION['admin'] = $correo;
  header("Location: ../admin.php");
} else {
  echo "<script>
    alert('Credenciales incorrectas');
    window.location.href = '../login.html';
  </script>";
}
?>
