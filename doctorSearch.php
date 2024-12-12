<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./clases_proyecto/Medico.php";
    require_once "./session.php";

    $message = "";
    $resultados = [];
    $limit = 6;
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $offset = ($page - 1) * $limit; 
    $patron = isset($_POST["patron"]) ? $_POST["patron"] : (isset($_GET["patron"]) ? $_GET["patron"] : ""); 

    if($patron) {
        
        require_once "./conexion.php";

        // Query para la paginación
        $sqlCount = "SELECT COUNT(*) AS total FROM medico 
                    WHERE nomMed LIKE :patron OR numColegiado LIKE :patron";
        $resultCount = $pdo->prepare($sqlCount);
        $resultCount->bindValue(":patron", "%" . $patron . "%");
        $resultCount->execute();
        $totalRecords = $resultCount->fetch(PDO::FETCH_OBJ)->total;

        $totalPages = ceil($totalRecords / $limit);

        $sql = "SELECT idMed, nomMed, apeMed, numColegiado FROM medico 
                WHERE nomMed LIKE :patron OR numColegiado LIKE :patron 
                LIMIT :limit OFFSET :offset; ";

        $result = $pdo->prepare($sql);
        $result->bindValue(":patron", "%" . $patron . "%");
        $result->bindValue(":limit", $limit, PDO::PARAM_INT);
        $result->bindValue(":offset", $offset, PDO::PARAM_INT);
        $result->execute();

        $resultados = $result->fetchAll(PDO::FETCH_OBJ);

        if (count($resultados) == 0) {
            $message = "No matches found";
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
        
        <div class="container-doctor">
            <!-- Buscador -->
            <h2>Search by Doctor <span><i class="fa-solid fa-user-doctor"></i></span></h2>
            <form action="doctorSearch.php" method="post" class="form-container">
                <div class="form-group">
                    <label for="patron" class="form-label">
                        Introduce doctor's name or registration number:</label>
                    <input type="text" class="form-control" id="patron" name="patron" 
                        placeholder="Examples: 'maria' or 'ma' or '9-digit-number: 236954879'" required>
                </div>
                <button type="submit">Search</button>
                <button><a href="addDoctor.php">Add new</a></button>
            </form>

            <?php 
                if ($message) {
                    echo "<p>". $message ."</p>";
                } 

                // Mostrar el mensaje si existe en la URL
                if (isset($_GET["message"])) {
                    $message = $_GET["message"];
                    echo "<script>alert(\"$message\");</script>";
                }
            ?>

            <!-- Tabla de resultados -->
            <?php if (count($resultados) > 0): ?>
                <div class="search-results">
                    <table>
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Register Nº</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados as $medico): ?>
                                <tr>
                                    <td><?= $medico->nomMed ?></td>
                                    <td><?= $medico->apeMed ?></td>
                                    <td><?= $medico->numColegiado?></td>
                                    <td>
                                        <a href="viewDoctor.php?idMed=<?= $medico->idMed ?>">
                                            <i class="fa-solid fa-eye" title="Ver"></i>
                                        </a>
                                        <a href="updateDoctor.php?idMed=<?= $medico->idMed ?>">
                                            <i class="fa-solid fa-pen" title="Actualizar"></i>
                                        </a>
                                        <a href="deleteDoctor.php?idMed=<?= $medico->idMed ?>" onclick="return confirm('Are you sure you want to delete this record?');">
                                            <i class="fa-solid fa-trash" title="Borrar"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="pagination">
                    <ul>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li>
                                <a href="?page=<?= $i ?>&patron=<?= urlencode($patron) ?>" 
                                    <?= ($i == $page) ? "style=\"color: orange;\"" : "" ?>><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            <?php endif; ?>

        </div>
    </main>
</body>
</html>