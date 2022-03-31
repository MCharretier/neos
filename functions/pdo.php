<?php

    $pdo = new PDO('mysql:host=localhost;dbname=u977792562_neos',
        'neos', 'MAMS9neos',
        [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
?>