<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Medico.php";
    require_once "./clases_proyecto/Especialidad.php";
    require_once "./clases_proyecto/Paciente.php";
    require_once "./session.php";

    if (!empty($_GET["idMed"])) {
        $idMed = $_GET["idMed"];

        require_once "./conexion.php";

        // Obtenemos los datos del médico
        $sql = "SELECT * FROM medico WHERE idMed = :idMed";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
        $result->execute();

        // Si se encuentra el médico, recuperamos los datos
        if ($result->rowCount() > 0) {
            $medico = $result->fetchObject("Medico");

            // Obtener las especialidades del médico
            $sql = "SELECT e.idEsp, e.nomEsp FROM especialidad e
                    JOIN medico_especialidad me ON e.idEsp = me.idEsp
                    WHERE me.idMed = :idMed";
            $result = $pdo->prepare($sql);
            $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
            $result->execute();

            $especialidades = [];
            while ($especialidad = $result->fetchObject()) {
                $especialidades[] = $especialidad;
            }

            // Obtener los pacientes del médico
            $sql = "SELECT * FROM paciente WHERE idMed = :idMed";
            $result = $pdo->prepare($sql);
            $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
            $result->execute();

            $pacientes = [];
            while ($paciente = $result->fetchObject()) {
                $pacientes[] = $paciente;
            }

        } else {
            die("Doctor not found");
        }
    } else {
        die("Invalid request");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ Doctors-Patients</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body id="patients-body">
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

        <!-- Listado de pacientes -->
        <div class="patients-list">
            <h3>Patients assigned to Dr. <?= $medico->getNomMed() ?> <?= $medico->getApeMed() ?></h3>
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Patient Surname</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($pacientes) > 0): ?>
                        <?php foreach ($pacientes as $paciente): ?>
                            <tr>
                                <td><?= $paciente->nomPac ?></td>
                                <td><?= $paciente->apePac ?></td>
                                <td>
                                    <a href="viewPatient.php?idMed=<?= $medico->getIdMed() ?>&idPac=<?= $paciente->idPac ?>&from=patients.php">
                                        <span>View info</span><i class="fa-solid fa-eye" title="View"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No patients assigned to this doctor</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <button><a type="button" href="viewDoctor.php?idMed=<?= $medico->getIdMed() ?>">Back</a></button>
        </div>
    </main>
</body>

</html>
