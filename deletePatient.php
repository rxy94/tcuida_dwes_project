<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Medico.php";
    require_once "./clases_proyecto/Paciente.php";
    require_once "./session.php";
    require_once "./conexion.php";

    // Comprobamos si se ha pasado en la URL el ID del médico a eliminar
    if (!empty($_GET["idPac"])) {
        $idPac = $_GET["idPac"];

        // Eliminamos primero los diagnósticos y alergias asociadas al paciente que queremos borrar
        // Ya que si no salta un error por las restrincciones definidas en la bbdd
        $sql = "DELETE FROM paciente_diagnostico WHERE idPac = :idPac";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
        $result->execute();

        $sql = "DELETE FROM paciente_alergia WHERE idPac = :idPac";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
        $result->execute();

        // Ahora eliminamos el paciente
        $sql = "DELETE FROM paciente WHERE idPac = :idPac";

        try {
            $result = $pdo->prepare($sql);
            $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
            $result->execute();

            if ($result->rowCount() > 0) {
                // Reseteo el auto_increment del idPac en la bbdd
                $sql = "ALTER TABLE medico AUTO_INCREMENT = 1;";
                $result = $pdo->prepare($sql);
                $result->execute();

                die(header("location: patientSearch.php?message=Patient+deleted+successfully"));

            } else {
                die(header("location: patientSearch.php?message=Patient+not+found"));
            }
        } catch (PDOException $e) {
            die(header("location: patientSearch.php?message=Error+deleting+patient"));

        }

    } else {
        die(header("location: patientSearch.php"));

    }

