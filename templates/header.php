<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">

    <title><?= $title ?> </title>

</head>

<body>





    <?php  if($_SESSION['nameUser_rNzTWBtGEZNozETWvgM7'] ){ ?>


    Приветствую тебя: <b><?= $_SESSION['nameUser_rNzTWBtGEZNozETWvgM7']  ?> </b>
    <br><br>
    <a href="index.php?c=Main&act=Logout"><button>Выйти</button></a>
    <br>
    <br>



    <?php } else if($_GET['form'] == 'registration') {

              include($_SERVER['DOCUMENT_ROOT'].'/templates/formRegistration.html');

          } else {

              include($_SERVER['DOCUMENT_ROOT'].'/templates/login.html');

          }
  ?>
