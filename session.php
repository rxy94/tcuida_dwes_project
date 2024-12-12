<?php
    session_start();

    if ((empty($_SESSION)) || (time() >= $_SESSION["_tiempo"])) {
        die(header("location: http://localhost:8080/PROYECTO/logout.php"));
    }

    // Actualizamos el tiempo de sesión
    $_SESSION["_tiempo"] = time() + 300;
    // Definimos el token (evita ataques CRSF)
    $_SESSION["_token"] = bin2hex(random_bytes(32));

    //Recuperamos el usuario logueado
    if (!empty($_SESSION["_usuario"])) {
        $usuario = unserialize($_SESSION["_usuario"]);
    } else {
        die(header("location: http://localhost:8080/PROYECTO/"));
    }