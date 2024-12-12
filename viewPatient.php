<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Medico.php";
    require_once "./clases_proyecto/Paciente.php";
    require_once "./session.php";

    if (!empty($_GET["idPac"])) {
        $idPac = $_GET["idPac"];
        // Recupero el from definido en la URL de viewPatient.php del script patients.php
        $from = isset($_GET["from"]) ? $_GET["from"] :"";
        require_once "./conexion.php";
    
        // Obtenemos los datos del paciente
        $sql = "SELECT * FROM paciente WHERE idPac = :idPac";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idPac", $idPac, PDO::PARAM_INT);
        $result->execute();
    
        if($result->rowCount() > 0) {

            $paciente = $result->fetchObject("Paciente");
            $idMed = $paciente->getIdMed(); 
    
            // Obtenemos los datos del médico asignado al paciente
            if ($idMed) {
                $sqlMedico = "SELECT * FROM medico WHERE idMed = :idMed";
                $resultMedico = $pdo->prepare($sqlMedico);
                $resultMedico->bindParam(":idMed", $idMed, PDO::PARAM_INT);
                $resultMedico->execute();
    
                if ($resultMedico->rowCount() > 0) {
                    $medico = $resultMedico->fetchObject("Medico");
                } else {
                    die("Doctor not found");
                }
            } else {
                die("Not doctor assigned yet");
            }

            // Obtenemos los diagnósticos del paciente
            $sqlDiagnosticos = "SELECT d.nomDiag FROM diagnostico d
                                JOIN paciente_diagnostico pd ON d.idDiag = pd.idDiag
                                WHERE pd.idPac = :idPac";

            $resultDiagnosticos = $pdo->prepare($sqlDiagnosticos);
            $resultDiagnosticos->bindParam(":idPac", $idPac, PDO::PARAM_INT);
            $resultDiagnosticos->execute();
    
            $diagnosticos = [];

            while ($diagnostico = $resultDiagnosticos->fetch(PDO::FETCH_ASSOC)) {
                $diagnosticos[] = $diagnostico["nomDiag"];
            }
    
            // Obtenemos las alergias del paciente
            $sqlAlergias = "SELECT a.nomAlergia FROM alergia a
                            JOIN paciente_alergia pa ON a.idAlergia = pa.idAlergia
                            WHERE pa.idPac = :idPac";

            $resultAlergias = $pdo->prepare($sqlAlergias);
            $resultAlergias->bindParam(":idPac", $idPac, PDO::PARAM_INT);
            $resultAlergias->execute();
    
            $alergias = [];

            while ($alergia = $resultAlergias->fetch(PDO::FETCH_ASSOC)) {
                $alergias[] = $alergia["nomAlergia"];
            }
        } else {
            die("Patient not found");
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ Patients</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body id="patient-body">
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
        <!-- Card con la información del paciente -->
        <div class="patient-card">
            <div class="patient-card-content">
                <!-- Información del paciente -->
                <div>
                    <h2>Patient <?= $paciente->getNomPac() ?> <?= $paciente->getApePac() ?></h2>
                </div>
                <!-- Datos generales -->
                <div class="patient-card-left">
                    <p><strong>ID:</strong> <?= $paciente->getDniPac() ?></p>
                    <p><strong>Gender:</strong> <?= $paciente->getGenero() ?></p>
                    <p><strong>Date of Birth:</strong> <?= $paciente->getFechaNac() ?></p>
                    <p><strong>Contact:</strong> <?= $paciente->getContactoPac() ?></p>
                    <p><strong>Address:</strong> <?= $paciente->getDirPac() ?></p>
                </div>

                <!-- Datos médicos -->
                <div class="patient-card-right">
                    <p><strong>History Nº:</strong> <?= $paciente->getNumHistoria() ?></p>
                    <p><strong>Assigned Doctor:</strong> <?= $medico->getNomMed()." ". $medico->getApeMed()?></p>

                    <!-- Diagnósticos -->
                    <p><strong>Diagnosis:</strong> 
                        <?php 
                            if (!empty($diagnosticos)) { 
                                echo implode(", ", $diagnosticos); 
                            } else { 
                                echo "No diagnoses found"; 
                            } 
                        ?>
                    </p>

                    <!-- Alergias -->
                    <p><i class="fa-solid fa-triangle-exclamation"></i><strong>Allergies:</strong><br>
                        <?php 
                            if (!empty($alergias)) { 
                                echo implode(", ", $alergias); 
                            } else { 
                                echo "No known allergies"; 
                            } 
                        ?>
                    </p>
                </div>

                <div>
                    <button>
                        <!-- Redirigirá a patientSearch.php o patients.php dependiendo de la página 
                            donde se haya hecho la petición -->
                        <a type="button" href="<?= ($from == "patients.php") ? "patients.php?idMed={$medico->getIdMed()}" : "patientSearch.php" ?>">Back</a>
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>