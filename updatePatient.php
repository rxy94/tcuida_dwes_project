<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Paciente.php";
    require_once "./session.php";
    require_once "./conexion.php";

    $message = "";
    $diagnosticosAsignados = [];
    $alergiasAsignadas = [];

    // Comprobamos si se ha enviado el id del paciente para actualizar
    if (!empty($_GET["idPac"])) {
        $idPac = $_GET["idPac"];
        
        // Obtenemos la información del paciente de la bbdd
        $sql = "SELECT * FROM paciente WHERE idPac = :idPac";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
        $result->execute();

        if ($result->rowCount() > 0) {
            $paciente = $result->fetch(PDO::FETCH_OBJ);

        } else {
            die("Patient not found.");
        }

        // Recuperamos los diagnósticos del paciente
        $sql = "SELECT pd.idDiag FROM paciente_diagnostico pd
                WHERE pd.idPac = :idPac";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
        $result->execute();
        $diagnosticosAsignados = $result->fetchAll(PDO::FETCH_COLUMN);

        // Recuperamos las alergias del paciente
        $sql = "SELECT pa.idAlergia FROM paciente_alergia pa
                WHERE pa.idPac = :idPac";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
        $result->execute();
        $alergiasAsignadas = $result->fetchAll(PDO::FETCH_COLUMN);

    }

    if (!empty($_POST)) {
        // Recuperamos los datos introducidos en el formulario
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $contacto = $_POST["contacto"];
        $numHistoria = $_POST["numHistoria"];
        $fechaNac = $_POST["fechaNacimiento"];
        $dni = $_POST["dni"];
        $genero = $_POST["genero"];
        $direccion = $_POST["direccion"];
        $idMed = $_POST["idMed"];

        try {
            // Actualizamos los datos del paciente
            $sql = "UPDATE paciente 
                    SET nomPac = :nombre, 
                    apePac = :apellido, 
                    contactoPac = :contacto, 
                    numHistoria = :numHistoria, 
                    dniPac = :dni, 
                    fechaNac = :fechaNac, 
                    genero = :genero, 
                    dirPaciente = :direccion, 
                    idMed = :idMed 
                    WHERE idPac = :idPac";

            $result = $pdo->prepare($sql);
            $result->bindParam(":nombre", $nombre);
            $result->bindParam(":apellido", $apellido);
            $result->bindParam(":contacto", $contacto);
            $result->bindParam(":numHistoria", $numHistoria);
            $result->bindParam(":dni", $dni);
            $result->bindParam(":fechaNac", $fechaNac);
            $result->bindParam(":genero", $genero);
            $result->bindParam(":direccion", $direccion);
            $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
            $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
            $result->execute();

            // Eliminamos los diagnósticos y alergias anteriores antes de insertar los nuevos
            $sql = "DELETE FROM paciente_diagnostico WHERE idPac = :idPac";
            $result = $pdo->prepare($sql);
            $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
            $result->execute();

            // Insertamos los nuevos diagnósticos
            if (!empty($_POST["diagnosticos"])) {
                foreach ($_POST["diagnosticos"] as $idDiag) {
                    $sqlDiagnostico = "INSERT INTO paciente_diagnostico (idPac, idDiag) VALUES (:idPac, :idDiag)";
                    $resultDiagnostico = $pdo->prepare($sqlDiagnostico);
                    $resultDiagnostico->bindParam(":idPac", $idPac, PDO::PARAM_INT);
                    $resultDiagnostico->bindParam(":idDiag", $idDiag, PDO::PARAM_INT);
                    $resultDiagnostico->execute();
                }
            }

            $sql = "DELETE FROM paciente_alergia WHERE idPac = :idPac";
            $result = $pdo->prepare($sql);
            $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
            $result->execute();

            // Insertamos las nuevas alergias
            if (!empty($_POST["alergias"])) {
                foreach ($_POST["alergias"] as $idAlergia) {
                    $sqlAlergia = "INSERT INTO paciente_alergia (idPac, idAlergia) VALUES (:idPac, :idAlergia)";
                    $resultAlergia = $pdo->prepare($sqlAlergia);
                    $resultAlergia->bindParam(":idPac", $idPac, PDO::PARAM_INT);
                    $resultAlergia->bindParam(":idAlergia", $idAlergia, PDO::PARAM_INT);
                    $resultAlergia->execute();
                }
            }

            $message = "Patient updated successfully <span><i class=\"fa-solid fa-check\"></i></span>";

        } catch(PDOException $e) {
            $message = "Error updating patient <span><i class=\"fa-solid fa-circle-exclamation\"></i></span>";
        }
    }

    // Obtenemos los médicos para el select
    $sqlMedicos = "SELECT * FROM medico";
    $resultMedicos = $pdo->query($sqlMedicos);
    $medicos = $resultMedicos->fetchAll(PDO::FETCH_OBJ);

    //Obtenemos los diagnósticos
    $sqlDiagnosticos = "SELECT * FROM diagnostico";
    $resultDiagnosticos = $pdo->query($sqlDiagnosticos);
    $diagnosticos = $resultDiagnosticos->fetchAll(PDO::FETCH_OBJ);

    //Obtenemos las alergias
    $sqlAlergias = "SELECT * FROM alergia";
    $resultAlergias = $pdo->query($sqlAlergias);
    $alergias = $resultAlergias->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ Update Patient form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body id="updatePatient-body">
    <ul>
        <li><a href="main.php">Home</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="logout.php"><i class="fa-solid fa-power-off"></i></a></li>
    </ul>
    <main>
        <header>
            <div>
                <h1>T-Cuida<span style="color: orange;">+</span></h1>
                <h3>
                    <span class="user-icon">
                        <i class="fa-regular fa-user"></i>
                    </span>
                    <?= $usuario ?>
                </h3>
            </div>
        </header>
        
        <div class="container-patient">
            <h2>Update Patient Information</h2>

            <?php
                if ($message) {
                    echo "<p>". $message ."</p>";
                }
            ?>

            <form action="updatePatient.php?idPac=<?= $idPac ?>" method="post" class="form-container">
                <div class="form-group">
                    <label for="nombre" class="form-label">First Name:</label>
                    <input type="text" name="nombre" id="nombre" 
                        class="form-control" value="<?= $paciente->nomPac ?>" required>
                </div>

                <div class="form-group">
                    <label for="apellido" class="form-label">Last Name:</label>
                    <input type="text" name="apellido" id="apellido" 
                        class="form-control" value="<?= $paciente->apePac ?>" required>
                </div>

                <div class="form-group">
                    <label for="fechaNacimiento" class="form-label">Date of Birth:</label>
                    <input type="date" name="fechaNacimiento" id="fechaNacimiento" 
                        class="form-control" value="<?= $paciente->fechaNac ?>" required>
                </div>

                <div class="form-group">
                    <label for="contacto" class="form-label">Contact Number:</label>
                    <input type="text" name="contacto" id="contacto" 
                        class="form-control" value="<?= $paciente->contactoPac ?>" required>
                </div>

                <div class="form-group">
                    <label for="numHistoria" class="form-label">History Number:</label>
                    <input type="text" name="numHistoria" id="numHistoria" 
                        class="form-control" value="<?= $paciente->numHistoria ?>" required>
                </div>

                <div class="form-group">
                    <label for="dni" class="form-label">ID Number:</label>
                    <input type="text" name="dni" id="dni" 
                        class="form-control" value="<?= $paciente->dniPac ?>" required>
                </div>

                <div class="form-group">
                    <label for="direccion" class="form-label">Address:</label>
                    <input type="text" name="direccion" id="direccion" 
                        class="form-control" value="<?= $paciente->dirPaciente ?>" required>
                </div>

                <div class="form-group">
                    <label for="idMed" class="form-label">Assigned Doctor:</label>
                    <select name="idMed" id="idMed" class="form-control" required>
                        <option value="">Select Doctor</option>
                        <?php
                            foreach ($medicos as $medico) {
                                $selected = ($paciente->idMed == $medico->idMed) ? "selected" : "";
                                echo "<option value={$medico->idMed} $selected>{$medico->nomMed} {$medico->apeMed}</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="genero" class="form-label">Gender:</label>
                    <select name="genero" id="genero" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="male" <?= $paciente->genero == "male" ? "selected" : "" ?>>Male</option>
                        <option value="female" <?= $paciente->genero == "female" ? "selected" : "" ?>>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="diagnosticos">Select Diagnoses:</label>
                    <select name="diagnosticos[]" id="diagnosticos" multiple>
                        <?php foreach ($diagnosticos as $diagnostico): ?>
                            <option value="<?= $diagnostico->idDiag ?>"
                                <?php 
                                    echo in_array($diagnostico->idDiag, $diagnosticosAsignados) ? "selected": ""; 
                                ?>>
                                <?= $diagnostico->nomDiag ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="alergias">Select Allergies:</label><br>
                    <select name="alergias[]" id="alergias" multiple>
                        <?php foreach ($alergias as $alergia): ?>
                            <option value="<?= $alergia->idAlergia ?>"
                                <?php 
                                    echo in_array($alergia->idAlergia, $alergiasAsignadas) ? "selected": ""; 
                                ?>>
                                <?= $alergia->nomAlergia ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn-submit">Update Patient</button>
                <button><a href="patientSearch.php">Back to Patients</a></button>
            </form>
        </div>
    </main>
</body>
</html>
