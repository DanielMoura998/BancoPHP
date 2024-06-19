<?php
session_start();

if (!isset($_SESSION['email']) && isset($_COOKIE['email']))
{
    $_SESSION['email'] = $_COOKIE['email'];
}
if (!isset($_SESSION['email']))
{
    header('Location: CadPage.html');
    exit();
}
$email = $_SESSION['email'];
?>