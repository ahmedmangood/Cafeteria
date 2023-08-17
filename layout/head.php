<?php
// function getTitle() {

//     global $pageTitle;

//     if (isset($pageTitle)) {
//         echo $pageTitle;
//     } else {
//         echo 'Default';
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caffe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $title  ?></title>

    <!-- CDN Swiper Css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- CDN Font Awesome V 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CDN Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;0,500;0,600;0,800;1,400;1,500;1,700;1,800&family=Cormorant+Upright:wght@500;600;700&family=Domine:wght@400;500;600;700&family=Grandiflora+One&family=Kalam:wght@300;400;700&family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&family=Macondo&family=Oregano:ital@0;1&family=Parisienne&family=Patrick+Hand&family=Rancho&family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CDN Font Awesome V 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap" rel="stylesheet">
    <!-- Hover Master Library -->
    <link rel="stylesheet" href="../layout/CSS/hover-min.css">
    <link rel="stylesheet" href="/Cafe_php_project/assets/style.css">

</head>

<body>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // include "/Cafe_php_project/layout/navbar.php";
    // include "/Cafe_php_project/layout/header.php";
    include $_SERVER["DOCUMENT_ROOT"] . '/Cafe_php_project/layout/navbar.php';
    include $_SERVER["DOCUMENT_ROOT"] . '/Cafe_php_project/layout/header.php';
    ?>
    <!-- Main Css File For Cart-->
    <!-- <link rel="stylesheet" href="../assets/style.css"> -->
    </head>