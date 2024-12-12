<?php
    session_start();
    require_once "./clases_proyecto/Usuario.php";

    $visible = "hidden"; 

    if (!empty($_POST)) {
        require_once "./conexion.php";

        $emailUsu = $_POST["email"];
        $nomUsu = $_POST["nombre"];
        $apeUsu = $_POST["apellido"];
        $claveUsu = md5($_POST["password"]);

        $sql = "SELECT emailUsu FROM usuario WHERE emailUsu = :emailUsu";
        $result = $pdo->prepare($sql);
        $result->bindParam(":emailUsu", $emailUsu);
        $result->execute();

        if ($result->rowCount() > 0) {
            $visible = "";

        } else {

            $sql = "INSERT INTO usuario (emailUsu, nomUsu, apeUsu, claveUsu) VALUES (:emailUsu, :nomUsu, :apeUsu, :claveUsu)";

            $result = $pdo->prepare($sql);

            $result->bindParam(":emailUsu", $emailUsu);
            $result->bindParam(":nomUsu", $nomUsu);
            $result->bindParam(":apeUsu", $apeUsu);
            $result->bindParam(":claveUsu", $claveUsu);

            $result->execute();
            
            //Recupero el id del último usuario insertado
            $lastIdUsu = $pdo->lastInsertId(); 

            $sql = "SELECT emailUsu, nomUsu, apeUsu FROM usuario WHERE idUsu = :idUsu";
            $result = $pdo->prepare($sql);

            // Vinculamos los parámetros con los valores correspondientes
            $result->bindParam(":idUsu", $lastIdUsu);

            // Ejecutamos la consulta
            $result->execute();

            if ($result->rowCount() > 0) {
                $usuario = $result->fetchObject("Usuario");
                
                $_SESSION["_tiempo"] = time() + 300;
                $_SESSION["_usuario"] = serialize($usuario);
    
                die(header("location: main.php"));
            }

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ Register</title>
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

        <!-- Formulario de registro -->
        <form action="register.php" method="post" class="form-container" id="register">
            <h1 class="register">REGISTER</h1>

            <!-- Campo de Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Username@tcuida.com" required>
            </div>

            <!-- Campo de Nombre -->
            <div class="form-group">
                <label for="nombre" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="John" required>
            </div>

            <!-- Campo de Apellido -->
            <div class="form-group">
                <label for="apellido" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Doe" required>
            </div>

            <!-- Campo de Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <div class="password-container">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Minimum 5 characters" required>
                    <span id="togglePassword"><i class="fa-regular fa-eye-slash"></i></span>
                </div>
            </div>

            <div id="errorMessage" class="form-text" style="visibility: <?= $visible ?>;">This email is already registered.</div>

            <button type="submit">Register</button>
            <div><a id="login" href="index.php">Already have an account? Log in here!</a></div>
        </form>
    </div>

</body>
</html>
