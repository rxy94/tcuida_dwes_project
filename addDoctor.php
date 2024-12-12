<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Medico.php";
    require_once "./clases_proyecto/Especialidad.php";
    require_once "./session.php";

    const DUMMY_IMG = "https://dummyimage.com/250x250/494b54/ffffff.png&text=img+not+available";

    $message = "";

    if (!empty($_POST)) {
        
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $contacto = $_POST["contacto"];
        $numColegiado = $_POST["numColegiado"];
        $email = $_POST["email"];
        $foto = $_POST["foto"];

        if (empty($foto)) {
            $foto = DUMMY_IMG;
        }

        $medico = new Medico();
        $medico->setNomMed($nombre);
        $medico->setApeMed($apellido);
        $medico->setContactoMed($contacto);
        $medico->setNumColegiado($numColegiado);
        $medico->setEmailMed($email);
        $medico->setFotoMed($foto);

        require_once "./conexion.php";

        try {

            $sql = "INSERT INTO medico (nomMed, apeMed, contactoMed, numColegiado, emailMed, fotoMed)
                    VALUES (:nombre, :apellido, :contacto, :numColegiado, :email, :foto)";

            $result = $pdo->prepare($sql);
            $result->bindParam(":nombre", $nombre);
            $result->bindParam(":apellido", $apellido);
            $result->bindParam(":contacto", $contacto);
            $result->bindParam(":numColegiado", $numColegiado);
            $result->bindParam(":email", $email);
            $result->bindParam(":foto", $foto);
            $result->execute();

            // Obtener el ID del médico insertado
            $idMed = $pdo->lastInsertId();

            if (!empty($_POST["especialidades"])) {
                foreach ($_POST["especialidades"] as $idEsp) {
                    $sql = "INSERT INTO medico_especialidad (idMed, idEsp) VALUES (:idMed, :idEsp)";
                    $result = $pdo->prepare($sql);
                    $result->bindParam(":idMed", $idMed, PDO::PARAM_INT);
                    $result->bindParam(":idEsp", $idEsp, PDO::PARAM_INT);
                    $result->execute();
                }
            }

            $message = "Doctor added successfully <span><i class=\"fa-solid fa-check\"></i></span>";

        } catch(PDOException $e) {
            $message = "Error adding doctor <span><i class=\"fa-solid fa-circle-exclamation\"></i></span>";
        }
    }

    require_once "./conexion.php";
    $sql = "SELECT * FROM especialidad";
    $result = $pdo->query($sql);
    $especialidades = $result->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ add doctor form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body id="addDoctor-body">
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
            <h2>Add New Doctor</h2>

            <?php
                if ($message) {
                    echo "<p>". $message ."</p>";
                }
            ?>

            <form action="addDoctor.php" method="POST" enctype="multipart/form-data" class="form-container">
                <div class="form-group">
                    <label for="nombre" class="form-label">First Name:</label>
                    <input type="text" name="nombre" id="nombre" 
                        class="form-control" placeholder="John" required>
                </div>
                
                <div class="form-group">
                    <label for="apellido" class="form-label">Last Name:</label>
                    <input type="text" name="apellido" id="apellido" 
                        class="form-control" placeholder="Doe" required>
                </div>

                <div class="form-group">
                    <label for="contacto" class="form-label">Contact Number:</label>
                    <input type="text" name="contacto" id="contacto" 
                        class="form-control" placeholder="9-digit-phone number: 123456789 or 123 456 789" 
                        pattern="^\d{9}$|^\d{3} \d{3} \d{3}$" required>
                </div>

                <div class="form-group">
                    <label for="numColegiado" class="form-label">Medical Registration Number:</label>
                    <input type="text" name="numColegiado" id="numColegiado" 
                        class="form-control" placeholder="9-digit-number: 123456789" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" 
                        class="form-control" placeholder="username@tcuida.com" required>
                </div>

                <div class="form-group">
                    <label for="foto" class="form-label">Profile Photo URL:</label>
                    <input type="url" name="foto" id="foto" 
                        class="form-control" placeholder="Enter the URL of the photo">
                </div>


                <div class="form-group">
                    <label for="especialidades" class="form-label">Medical Specialties:</label>
                    <select name="especialidades[]" id="especialidades" class="form-control" multiple>
                        <?php
                            foreach($especialidades as $especialidad) {
                                echo "<option value={$especialidad->idEsp}>{$especialidad->nomEsp}</option>";
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn-submit">Add Doctor</button>
                <button><a href="doctorSearch.php">Back to Doctors</a></button>
            </form>

        </div>
    </main>
</body>
</html>