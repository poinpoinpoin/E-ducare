<?php
  session_start();
  
  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
    exit(); // Agrega un exit para evitar que el código siga ejecutándose después de la redirección.
  }
  
  require 'database.php';
  
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    
    // Busca al usuario por su dirección de correo electrónico
    $stmt = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($_POST['password'], $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      header("Location: /php-login");
      exit(); // Asegura que no se ejecute más código después de la redirección.
    } else {
      $message = 'Lo siento, estas credenciales no coinciden';
    }
  }
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Iniciar Sesión</title>
    <link rel="icon" href="./img/logo.png">
    <link rel="stylesheet" href="./css/style_login.css">
  </head>
  <body>

    <?php if(!empty($message)): ?>
      <p class="el_mensaje"> <?= $message ?></p>
    <?php endif; ?>


    <form class="formulario" action="login.php" method="POST">
      <p class="titulo">Inicio de Sesión</p>
      <input name="email" type="text" placeholder="Ingrese su Correo" id="email">
      <input name="password" type="password" placeholder="Ingrese su Contraseña">
      <input type="submit" value="Inicia Sesión" class="boton">
      <p class="registro">
        ¿No tienes cuenta?
        <a href="signup.php">Regístrate</a>
        <br>
        <a href="../OLVIDAR_CONTRASEÑA/olvidar_contraseña.html">¿Olvidaste la contraseña?</a>
      </p>
    </form>
  </body>
</html>