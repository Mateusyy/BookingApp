<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 06.03.2018
 * Time: 11:36
 */


require_once('models/functions.php');
require_once('controllers/DBController.php');

session_start();
$myController = new DBController();
$siteTitle = $myController->getDBValue('settings','siteTitle');

//Użyte w tytule strony
$receivedMessage = $message;
if($receivedMessage!="")$receivedMessage .= " - ";
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="System rezerwacji obiektów sportowych">
    <meta name="keywords" content="PHP,HTML,CSS,BOOTSTRAP,JavaScript">
    <meta name="author" content="Jakub Radzik & Mateusz Gryboś">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $receivedMessage.$siteTitle ?></title>
    <!--    Ikonki od Google-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/zawieszka.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="icon" type="image/png" href="/content/logo.png">
    <script type="text/javascript" src="/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/js/messages_pl.js"></script>
    <script type="text/javascript" src="/js/functions.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

