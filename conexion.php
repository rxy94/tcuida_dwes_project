<?php
    
    try {
        $pdo = new PDO("mysql:host=db;dbname=tcuida", "root", "");

    } catch (PDOException $exception) {
        die("Error en la conexión a la base de datos: {$exception->getMessage()}<br>");
    }