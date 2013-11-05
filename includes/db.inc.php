<?php

$dbname = "register";
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost";

$link = new PDO("mysql:host=". $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass );