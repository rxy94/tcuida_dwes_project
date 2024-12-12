<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Medico.php";
    require_once "./clases_proyecto/Especialidad.php";
    require_once "./session.php";

    // Comprobamos si se ha pasado en la URL el ID del médico a eliminar
    if (!empty($_GET["idMed"])) {
        $idMed = $_GET["idMed"];

        require_once "./conexion.php";

        // Eliminamos primero las especialidades asociadas al médico que queremos borrar
        // Ya que si no salta un error por las restrincciones definidas en la bbdd
        $sql = "DELETE FROM medico_especialidad WHERE idMed = :idMed";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
        $result->execute();

        // Ahora eliminamos el médico
        $sql = "DELETE FROM medico WHERE idMed = :idMed";

        try {
            $result = $pdo->prepare($sql);
            $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
            $result->execute();

            if ($result->rowCount() > 0) {
                // Reseteo el auto_increment del idMed en la bbdd
                $sql = "ALTER TABLE medico AUTO_INCREMENT = 1;";
                $result = $pdo->prepare($sql);
                $result->execute();

                die(header("location: doctorSearch.php?message=Doctor+deleted+successfully"));

            } else {
                die(header("location: doctorSearch.php?message=Doctor+not+found"));
            }
        } catch (PDOException $e) {
            die(header("location: doctorSearch.php?message=Error+deleting+doctor"));

        }

    } else {
        die(header("location: doctorSearch.php"));

    }

