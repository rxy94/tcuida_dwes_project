<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Medico.php";
    require_once "./clases_proyecto/Especialidad.php";
    require_once "./session.php";
    require_once "./conexion.php";

    $message = "";
    $medico = null;
    $especialidadesAsignadas = [];

    // Recuperamos los datos del médico
    if (!empty($_GET["idMed"])) {
        $idMed = $_GET["idMed"];

        $sql = "SELECT * FROM medico WHERE idMed = :idMed";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
        $result->execute();

        if ($result->rowCount() > 0) {
            $medico = $result->fetchObject("Medico");

        } else {
            die("Doctor not found.");
        }

        $sql = "SELECT e.idEsp FROM especialidad e
                JOIN medico_especialidad me ON e.idEsp = me.idEsp
                WHERE me.idMed = :idMed";
        $result = $pdo->prepare($sql);
        $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
        $result->execute();
        $especialidadesAsignadas = $result->fetchAll(PDO::FETCH_COLUMN);
    }

    // Recupero los datos nuevos introducidos en el formulario de Update
    if (!empty($_POST)) {

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $contacto = $_POST["contacto"];
        $numColegiado = $_POST["numColegiado"];
        $email = $_POST["email"];
        $foto = $_POST["foto"];

        if (empty($foto)) {
            $foto = $medico->getFotoMed();
        }

        try {
            $sql = "UPDATE medico 
                    SET nomMed = :nombre, apeMed = :apellido,
                    contactoMed = :contacto, numColegiado = :numColegiado,
                    emailMed = :email, fotoMed = :foto
                    WHERE idMed = :idMed";

            $result = $pdo->prepare($sql);
            $result->bindParam(":nombre", $nombre);
            $result->bindParam(":apellido", $apellido);
            $result->bindParam(":contacto", $contacto);
            $result->bindParam(":numColegiado", $numColegiado);
            $result->bindParam(":email", $email);
            $result->bindParam(":foto", $foto);
            $result->bindParam(":idMed", $idMed);
            $result->execute();

            // Para actualizar las especialidades asignadas
            // Primero eliminamos las especialidades actuales
            $sql = "DELETE FROM medico_especialidad WHERE idMed = :idMed";
            $result = $pdo->prepare($sql);
            $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
            $result->execute();

            // Insertamos las nuevas especialidades
            if (!empty($_POST["especialidades"])) {
                foreach ($_POST["especialidades"] as $idEsp) {
                    $sql = "INSERT INTO medico_especialidad (idMed, idEsp) VALUES (:idMed, :idEsp)";
                    $result = $pdo->prepare($sql);
                    $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
                    $result->bindParam(":idEsp", $idEsp, PDO::PARAM_INT);
                    $result->execute();
                }
            }

            $message = "Doctor updated successfully <span><i class=\"fa-solid fa-check\"></i></span>";

        } catch (PDOException $e) {
            $message = "Error updating doctor <span><i class=\"fa-solid fa-circle-exclamation\"></i></span>";
        }

    }

    $sql = "SELECT * FROM especialidad";
    $result = $pdo->query($sql);
    $especialidades = $result->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ Update Doctor form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body id="updateDoctor-body">
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
        
        <div class="container-doctor">
            <h2>Update Doctor Information</h2>

            <?php
                if ($message) {
                    echo "<p>". $message ."</p>";
                }
            ?>

            <form action="updateDoctor.php?idMed=<?= $idMed ?>" method="post" class="form-container">
                <div class="form-group">
                    <label for="nombre" class="form-label">First Name:</label>
                    <input type="text" name="nombre" id="nombre" 
                        class="form-control" value="<?= $medico->getNomMed() ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="apellido" class="form-label">Last Name:</label>
                    <input type="text" name="apellido" id="apellido" 
                        class="form-control" value="<?= $medico->getApeMed() ?>" required>
                </div>

                <div class="form-group">
                    <label for="contacto" class="form-label">Contact Number:</label>
                    <input type="text" name="contacto" id="contacto" 
                        class="form-control" value="<?= $medico->getContactoMed() ?>" required>
                </div>

                <div class="form-group">
                    <label for="numColegiado" class="form-label">Medical Registration Number:</label>
                    <input type="text" name="numColegiado" id="numColegiado" 
                        class="form-control" value="<?= $medico->getNumColegiado() ?>" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" 
                        class="form-control" value="<?= $medico->getEmailMed() ?>" required>
                </div>

                <div class="form-group">
                    <label for="foto" class="form-label">Profile Photo URL:</label>
                    <input type="url" name="foto" id="foto" 
                        class="form-control" value="<?= $medico->getFotoMed() ?>" placeholder="Enter the URL of the photo">
                </div>

                <div class="form-group">
                    <label for="especialidades" class="form-label">Medical Specialties:</label>
                    <select name="especialidades[]" id="especialidades" class="form-control" multiple>
                        <?php foreach ($especialidades as $especialidad): ?>
                            <option value="<?= $especialidad->idEsp ?>"
                                <?php 
                                    echo in_array($especialidad->idEsp, $especialidadesAsignadas) ? "selected": ""; 
                                ?>>
                                <?= $especialidad->nomEsp ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn-submit">Update Doctor</button>
                <button><a href="doctorSearch.php">Back to Doctors</a></button>
            </form>
        </div>
    </main>
</body>
</html>