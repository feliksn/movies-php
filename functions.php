<?php
    // В этом файле будем прописывать общую фукнциональность для сайта

    // Тут пропысываем переменные для подключения к базе данных
    // Все переменные записываються через знак $ - $varName
    $servername = "localhost";
    $username = "db_movies_user";
    $password = "db_movies_pass";
    $dbname = "db_movies";

    // Создаем подключение к базе данных, передавая ей даннные из переменных
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Проверяем подключение. Если все хорошо, то ничего не происходит. В инном случае выбросит ошибку.
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>