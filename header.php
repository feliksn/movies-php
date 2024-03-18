<?php
    // Подключаем функциональность сайта из файла function.php
    include "functions.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KINO</title>
    <link href="./libs/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body class="bg-light">

    <!-- навигационная панель -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom ">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="./images/bootstrap-logo.svg" alt="Bootstrap" width="41.25" height="33">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#genresModal">Genres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#castModal">Cast</a>
                    </li>
                    <!-- <li class="nav-item">
						<a class="nav-link disabled" aria-disabled="true">Disabled</a>
					</li> -->
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>