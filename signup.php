<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Usuario creado';
      header("Location: ./METODO_DE_PAGO/index.html");
    } else {
      $message = 'Lo sentimos, debe haber habido un problema al crear tu cuenta.';
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Formulario de Registro</title>
  <link rel="icon" href="./img/logo.png">
  <link rel="stylesheet" href="./css/style_signup.css">
</head>
<body>

  <?php if(!empty($message)): ?>
    <p class="el_mensaje"> <?= $message ?></p>
  <?php endif; ?>

  <main>
    <form action="signup.php" method="POST" id="registrationForm" onsubmit="return validarRegistro()">
      <p class="titulo">Formulario de Registro</p>
      <input name="email" type="text" placeholder="Ingrese su Correo" id="email">
      <input name="password" type="password" placeholder="Ingrese su Contraseña" id="password">
      <input name="confirm_password" type="password" placeholder="Repita su Contraseña" id="confirmPassword" style="margin-bottom: 10px">
      <span id="passwordError" style="color: red; font-weight: bold; font-size: 20px"></span><br>
      <p>Estoy de acuerdo con
        <a href="../TERMINOS_Y_CONDICIONES/terminos_y_condiciones.html" target="_blank">
          Términos y Condiciones
        </a>
      </p>
      <input type="submit" value="Registrarse" class="boton">
      <p><a href="login.php">¿Ya tengo Cuenta?</a></p>
    </form>
  </main>
  <script>
    const registrationForm = document.getElementById("registrationForm");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const passwordError = document.getElementById("passwordError");

    registrationForm.addEventListener("submit", function (event) {
      if (passwordInput.value !== confirmPasswordInput.value) {
        passwordError.textContent = "Las contraseñas no coinciden.";
        event.preventDefault();
      }
    });

    function validarRegistro() {
      var email = document.getElementById("email").value;

      // Verificar el formato del correo electrónico usando una expresión regular
      var patronCorreo = /^[a-zA-Z0-9._%+-]+@(gmail\.com|hotmail\.com)$/;
      if (!patronCorreo.test(email)) {
        alert("Ingrese un correo válido.");
        return false;
      }
    }

    </script>

  </body>
</html>