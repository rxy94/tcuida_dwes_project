<?php
    require_once "./clases_proyecto/Usuario.php";
    require_once "./session.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Cuida+ Main Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body id="main-body">
    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="logout.php"><i class="fa-solid fa-power-off"></i></a></li>
    </ul>
    <main>
        <header>
            <div>
                <h1>Welcome to T-Cuida<span style="color: orange;">+</span></h1>
                <h3><?= $usuario ?></h3>
            </div>
        </header>
        <div class="container-main">
            <div class="card card-doctor">
                <div class="card-title"><a href="doctorSearch.php">Doctors</a> </div>
            </div>
            <div class="card card-patient">
                <div class="card-title"><a href="patientSearch.php">Patients</a> </div>
            </div>
        </div>
    </main>
</body>
</html>