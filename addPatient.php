<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Paciente.php";
    require_once "./session.php";
    require_once "./conexion.php";

    $message = "";

    // Recuperamos los diagnósticos de la bbdd 
    $sqlDiagnosticos = "SELECT * FROM diagnostico";
    $resultDiagnosticos = $pdo->query($sqlDiagnosticos);
    $diagnosticos = $resultDiagnosticos->fetchAll(PDO::FETCH_OBJ);

    // Recuperamos las alergias de la bbdd
    $sqlAlergias = "SELECT * FROM alergia";
    $resultAlergias = $pdo->query($sqlAlergias);
    $alergias = $resultAlergias->fetchAll(PDO::FETCH_OBJ);

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

        // Creamos una instancia de Paciente y le asignamos los valores de los atributos
        $paciente = new Paciente();
        $paciente->setNomPac($nombre);
        $paciente->setApePac($apellido);
        $paciente->setContactoPac($contacto);
        $paciente->setNumHistoria($numHistoria);
        $paciente->setFechaNac($fechaNac);
        $paciente->setGenero($genero);
        $paciente->setDniPac($dni);
        $paciente->setDirPaciente($direccion);
        $paciente->setIdMed($idMed);

        try {
            $sql = "INSERT INTO paciente (nomPac, apePac, contactoPac, numHistoria, dniPac, fechaNac, genero, dirPaciente, idMed)
                    VALUES (:nombre, :apellido, :contacto, :numHistoria, :dni, :fechaNac, :genero, :direccion, :idMed)";

            $result = $pdo->prepare($sql);
            $result->bindParam(":nombre", $nombre);
            $result->bindParam(":apellido", $apellido);
            $result->bindParam(":contacto", $contacto);
            $result->bindParam(":numHistoria", $numHistoria);
            $result->bindParam(":fechaNac", $fechaNac);
            $result->bindParam(":dni", $dni);
            $result->bindParam(":genero", $genero);
            $result->bindParam(":direccion", $direccion);
            $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
            $result->execute();

            $idPac = $pdo->lastInsertId();

            // Insertamos los diagnósticos seleccionados
            if (!empty($_POST["diagnosticos"])) {
                foreach ($_POST["diagnosticos"] as $idDiag) {
                    $sqlDiagnostico = "INSERT INTO paciente_diagnostico (idPac, idDiag) VALUES (:idPac, :idDiag)";
                    $resultDiagnostico = $pdo->prepare($sqlDiagnostico);
                    $resultDiagnostico->bindParam(":idPac", $idPac, PDO::PARAM_INT);
                    $resultDiagnostico->bindParam(":idDiag", $idDiag, PDO::PARAM_INT);
                    $resultDiagnostico->execute();
                }
            }

            // Insertamos las alergias seleccionadas
            if (!empty($_POST["alergias"])) {
                foreach ($_POST["alergias"] as $idAlergia) {
                    $sqlAlergia = "INSERT INTO paciente_alergia (idPac, idAlergia) VALUES (:idPac, :idAlergia)";
                    $resultAlergia = $pdo->prepare($sqlAlergia);
                    $resultAlergia->bindParam(":idPac", $idPac, PDO::PARAM_INT);
                    $resultAlergia->bindParam(":idAlergia", $idAlergia, PDO::PARAM_INT);
                    $resultAlergia->execute();
                }
            }

            $message = "Patient added successfully <span><i class=\"fa-solid fa-check\"></i></span>";

        } catch(PDOException $e) {
            $message = "Error adding patient <span><i class=\"fa-solid fa-circle-exclamation\"></i></span>";
        }
    }

    $sql = "SELECT * FROM medico";
    $result = $pdo->query($sql);
    $medicos = $result->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ add patient form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body id="addPatient-body">
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
            <h2>Add New Patient</h2>

            <?php
                if ($message) {
                    echo "<p>". $message ."</p>";
                }
            ?>

            <form action="addPatient.php" method="post" class="form-container">
                <!-- Campo nombre -->
                <div class="form-group">
                    <label for="nombre" class="form-label">First Name:</label>
                    <input type="text" name="nombre" id="nombre" 
                        class="form-control" placeholder="John" required>
                </div>

                <!-- Campo apellido -->
                <div class="form-group">
                    <label for="apellido" class="form-label">Last Name:</label>
                    <input type="text" name="apellido" id="apellido" 
                        class="form-control" placeholder="Doe" required>
                </div>

                <!-- Campo fecha de nacimiento -->
                <div class="form-group">
                    <label for="fechaNacimiento" class="form-label">Date of Birth:</label>
                    <input type="date" name="fechaNacimiento" id="fechaNacimiento" 
                        class="form-control" required>
                </div>

                <!-- Campo contacto -->
                <div class="form-group">
                    <label for="contacto" class="form-label">Contact Number:</label>
                    <input type="text" name="contacto" id="contacto" 
                        class="form-control" placeholder="9-digit-phone number: 123456789 or 123 456 789" 
                        pattern="^\d{9}$|^\d{3} \d{3} \d{3}$" required>
                </div>

                <!-- Campo numero historia -->
                <div class="form-group">
                    <label for="numHistoria" class="form-label">History Number:</label>
                    <input type="text" name="numHistoria" id="numHistoria" 
                        class="form-control" placeholder="10-digit-history number" required>
                </div>

                <!-- Campo dni -->
                <div class="form-group">
                    <label for="dni" class="form-label">ID Number:</label>
                    <input type="text" name="dni" id="dni" 
                        class="form-control" placeholder="Example: 12345678T" 
                        pattern="^\d{8}[A-Z]$" required>
                </div>

                <!-- Campo dirección -->
                <div class="form-group">
                    <label for="direccion" class="form-label">Address:</label>
                    <input type="text" name="direccion" id="direccion" 
                        class="form-control" placeholder="Patient's address" required>
                </div>

                <!-- Campo médico -->
                <div class="form-group">
                    <label for="idMed" class="form-label">Assigned Doctor:</label>
                    <select name="idMed" id="idMed" class="form-control" required>
                        <option value="">Select Doctor</option>
                        <?php
                            foreach($medicos as $medico) {
                                echo "<option value={$medico->idMed}>{$medico->nomMed} {$medico->apeMed}</option>";
                            }
                        ?>
                    </select>
                </div>

                <!-- Campo género -->
                <div class="form-group">
                    <label for="genero" class="form-label">Gender:</label>
                    <select name="genero" id="genero" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <!-- Campo diagnósticos -->
                <div class="form-group">
                    <label for="diagnosticos">Select Diagnoses:</label>
                    <select name="diagnosticos[]" id="diagnosticos" multiple>
                        <?php
                            foreach ($diagnosticos as $diagnostico) {
                                echo "<option value={$diagnostico->idDiag}>{$diagnostico->nomDiag}</option>";
                            }
                        ?>
                    </select>
                </div>

                <!-- Campo alergias -->
                <div class="form-group">
                    <label for="alergias">Select Allergies:</label><br>
                    <select name="alergias[]" id="alergias" multiple>
                        <?php
                            foreach ($alergias as $alergia) {
                                echo "<option value={$alergia->idAlergia}>{$alergia->nomAlergia}</option>";
                            }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn-submit">Add Patient</button>
                <button><a href="patientSearch.php">Back to Patients</a></button>
            </form>

        </div>
    </main>
</body>
</html>
