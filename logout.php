<?php

session_start();
$_SESSION['loggedin'] = false;

session_unset();
session_destroy();

header("Location: index.php");