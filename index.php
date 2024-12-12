<?php

    session_start();
    require_once "./clases_proyecto/Usuario.php";

    if (!empty($_SESSION)) {
        die(header("location: main.php"));
    }

    $visible = "hidden";

    if (!empty($_POST)) {

        require_once "./conexion.php";

        $email = $_POST["email"];
        $clave = md5($_POST["password"]);

        $sql = "SELECT emailUsu, nomUsu, apeUsu 
                FROM usuario 
                WHERE emailUsu = :emailUsu 
                AND claveUsu = :claveUsu";
        $result = $pdo->prepare($sql);

        // Vinculamos los parámetros con los valores correspondientes
        $result->bindParam(":emailUsu", $email);
        $result->bindParam(":claveUsu", $clave);

        // Ejecutamos la consulta
        $result->execute();

        // Si encontramos un usuario
        if ($result->rowCount() > 0) {

            $usuario = $result->fetchObject("Usuario");

            // Guardamos el usuario en la sesión y establecemos el tiempo de expiración
            $_SESSION["_tiempo"] = time() + 300;
            $_SESSION["_usuario"] = serialize($usuario);

            die(header("location: main.php"));

        } else {
            $visible = "";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css">
    <script defer src="./js/script.js"></script>
</head>

<body id="login-body">
    
    <div class="container-login">
        <!-- Logo de bienvenida -->
        <div class="logo-container">
            <div class="title">
                <h1>Welcome to T-Cuida<span style="color: orange;">+</span></h1>
            </div>
            <div class="subtitle">
                <h2>A web application where you'll administer your patient's information more efficiently</h2>
            </div>
        </div>
        <!-- Formulario de login -->
        <form action="index.php" method="post" class="form-container" >
            <h1>LOGIN</h1>

            <!-- Campo de Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" 
                    placeholder="Username@tcuida.com" value="mriddel0@vistaprint.com" required>
            </div>

            <!-- Campo de Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <div class="password-container">
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Minimum 5 characters" value="dZ0@mX_xe|" required>
                    <span id="togglePassword"><i class="fa-regular fa-eye-slash"></i></span>
                </div>

                <div id="errorMessage" class="form-text" style="visibility: <?= $visible ?>;">
                    Incorrect email and/or password.</div>
            </div>

            <button type="submit">Enter</button>
            <div><a href="register.php">Not registered yet? Register here!</a></div>
        </form>
    </div>

</body>
</html>