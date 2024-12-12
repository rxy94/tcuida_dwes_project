<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Medico.php";
    require_once "./clases_proyecto/Especialidad.php";
    require_once "./session.php";

    if (!empty($_GET["idMed"])) {

        $idMed = $_GET["idMed"];

        require_once "./conexion.php";

        $sql = "SELECT * FROM medico WHERE idMed = :idMed";

        $result = $pdo->prepare($sql);
        $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
        $result->execute();

        // Si se encuentra el médico, obtenemos los datos
        if ($result->rowCount() > 0) {
            $medico = $result->fetchObject("Medico");

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

        } else {
            die("Doctor not found");
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ Doctors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body id="doctor-body">
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
        <!-- Card con la información del médico -->
        <div class="doctor-card">
            <div class="doctor-card-content">
                <!-- Foto del médico -->
                <div class="doctor-card-left">
                    <img src="<?= $medico->getFotoMed() ?>" alt="Foto de <?= $medico->getNomMed() ?>" class="doctor-photo">
                </div>

                <!-- Información del médico -->
                <div class="doctor-card-right">
                    <h2><?= $medico->getNomMed() ?> <?= $medico->getApeMed() ?></h2>
                    <p><strong>Register Nº:</strong> <?= $medico->getNumColegiado() ?></p>
                    <p><strong>Contact:</strong> <?= $medico->getContactoMed() ?></p>
                    <p><strong>Email:</strong> <?= $medico->getEmailMed() ?></p>

                    <p><strong>Medical specialties:</strong></p>
                    <p id="especialidades">
                        <?php
                            if(count($especialidades) > 0) {
                                foreach ($especialidades as $especialidad) {
                                    echo "<li>". $especialidad->nomEsp ."</li>";
                                }
                            }
                        ?>
                    </p>
                    <button><a type="button" href="doctorSearch.php">Back</a></button>
                    <button><a type="button" href="patients.php?idMed=<?= $medico->getIdMed() ?>">View patients</a></button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>