<?php

// Создаем функцию подключения к базе данных и получения данных по sql запросу, который передаем как аргумент функции
function getDBdata($sql)
{
    // Пропысываем переменные с данными для подключения к базе данных
    $servername = "localhost";
    $username = "db_movies_user";
    $password = "db_movies_pass";
    $dbname = "db_movies";
    // Создаем подключение к базе данных, передавая ей даннные из переменных
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Проверяем подключение к базе данных.
    if (!$conn) {
        // Если не удалось подключиться к базе данных функция вернет сообщение о неудачном подключении
        die ("Не удалось подлючиться к базе данных: " . mysqli_connect_error());
    }
    // Если удалось поключиться к базе, то получаем данные по sql запросу из аругмента функции
    $data = $conn->query($sql);
    // Проверяем наличие данных в базе данных по sql запросу
    if ($data->num_rows > 0) {
        // Если по запросу sql есть какие-то данные, создаем массив для наполнения данных
        $result = [];
        // Проходясь по каждой записи в таблице, наполняем массив данными из таблицы 
        while ($row = $data->fetch_assoc()) {
            // Фукнция добавления в массив в php - array_push(arr, item) cостоит из двух аргументов.
            // $result - массив, который будем заполнять
            // $row - элемент, который добавляем в конец массива
            array_push($result, $row);
        }
    } else {
        // Если по запросу sql нет записей, то возвращаем только строку с информацией
        $result = "Каких-либо записей не найдено!";
    }
    // Закрывем подключение к базе данных
    mysqli_close($conn);
    // Возвращаем данные которые удалось получить из базы данных        
    return $result;
}

// Функция показывает данные, записанные в переменной, которую можно передевать как параметр функции
function showRawData($data)
{
    print ("<pre>" . print_r($data, true) . "</pre>");
}

// Функция возвращает обрезанную строку с "..." если ее длина превышает определенное кол-во символов 
function getShortStr($str, $maxLen){
    return strlen($str) > $maxLen ? substr($str, 0, $maxLen) . "..." : $str;
}

// Функция возвращает данные всех фильмов для главной страницы
// Все приготовления и изменения данных должны происходить перед загрузкой страницы.
// А на самой странце показывем только готовы данные без каких-либо функций и изменений
function getMoviesData(){
    $rows = getDBdata("SELECT * FROM data ORDER BY id LIMIT 8");
    $rowIndex = 0;
    $result = [];
    foreach ($rows as $row) {
        $result[$rowIndex] = array(
            "id" => $row["id"],
            "title" => $row["title"],
            "year" => $row["year"],
            "genres" => getShortStr($row["genres"], 30),
            "cast" => getShortStr($row["cast"], 30),
            "extract" => getShortStr($row["extract"], 90),
            "thumbnail" => $row["thumbnail"],
        );
        $rowIndex++;
    }
    return $result;
}

// Задача 3.2
// Создать функцию которая получает данные из базы для отдельного фильма по id колонке в таблице
// Функция будет называться getMovieData. Для функции будет аргумент $id фильма
function getMovieData($id){
    $rows = getDBdata("SELECT * FROM data WHERE id = '$id'");
    $result = [];
    foreach ($rows as $row) {
        $result[$id] = array(
            "id" => $row["id"],
            "title" => $row["title"],
            "year" => $row["year"],
            "genres" => $row["genres"],
            "cast" => $row["cast"],
            "extract" => $row["extract"],
            "thumbnail" => $row["thumbnail"],
        );  
    }
    return $result;
} 