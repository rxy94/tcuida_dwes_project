<?php
    session_start();

    $_SESSION = [];

    session_destroy();

    die(header("location: http://localhost:8080/PROYECTO/"));
