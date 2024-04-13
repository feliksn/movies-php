<?php

// ---------------------------- GLOBAL

// Создаем функцию подключения к базе данных и получения данных по sql запросу, который передаем как аргумент функции
function getDBdata($sql)
{
    $servername = "localhost";
    $username = "db_movies_user";
    $password = "db_movies_pass";
    $dbname = "db_movies";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Не удалось подлючиться к базе данных: " . mysqli_connect_error());
    }

    $data = $conn->query($sql);

    if ($data->num_rows > 0) {
        $result = [];
        while ($row = $data->fetch_assoc()) {
            array_push($result, $row);
        }
    } else {
        $result = "Каких-либо записей не найдено!";
    }

    mysqli_close($conn);

    return $result;
}

// Функция показывает данные, записанные в переменной, которую можно передевать как параметр функции
function showRawData($data)
{
    print("<pre>" . print_r($data, true) . "</pre>");
}

// Функция возвращает обрезанную строку с "..." если ее длина превышает определенное кол-во символов 
function getShortStr($str, $maxLen)
{
    return strlen($str) > $maxLen ? substr($str, 0, $maxLen) . "..." : $str;
}



// ---------------------------- MOVIES

// Функция возвращает данные всех фильмов для главной страницы
function getMovies()
{
    $movies = getDBdata("SELECT * FROM movies ORDER BY id LIMIT 8");
    $result = [];
    foreach ($movies as $movieIndex => $movie) {
        $result[$movieIndex] = array(
            "id" => $movie["id"],
            "title" => $movie["title"],
            "year" => $movie["year"],
            "genres" => getShortStr($movie["genres"], 30),
            "cast" => getShortStr($movie["cast"], 30),
            "extract" => getShortStr($movie["extract"], 90),
            "thumbnail" => $movie["thumbnail"],
        );
        $rowIndex++;
    }
    return $result;
}

// Функция возвращает данные фильма по id параметру
function getSingleMovie()
{
    $id = $_GET["id"];
    $movies = getDBdata("SELECT * FROM movies WHERE id = '$id'");
    $movie = $movies[0];
    $genresSqlStr = '"' . str_replace(',', '","', $movie["genres"]) . '"';
    $castSqlStr = '"' . str_replace(',', '","', $movie["cast"]) . '"';
    $genresArray = getDBdata("SELECT name, id FROM genres WHERE name IN ($genresSqlStr)");
    $castArray = getDBdata("SELECT * FROM actors WHERE name IN ($castSqlStr)");
    $movie["genres"] = $genresArray;
    $movie["cast"] = $castArray;
    return $movie;
}


// ---------------------------- GENRES

// Функция возвращает genre фильма по id параметру
function getSingleGenre()
{
    $id = $_GET["id"];
    $genres = getDBdata("SELECT * FROM genres WHERE id = '$id'");
    return $genres[0];
}

// Функция возвращает genre фильма из БД genres
function getGenres()
{
    $genres = getDBdata("SELECT * FROM genres ORDER BY name ASC");
    return $genres;
}

// Делаем отдельную фукнцию для сетки жанров чтобы не запутаться в действии каждой функции
// Фукния возвращает массив из 4 колонок. Каждая колонка это массив из 11 элементов (41/4 = 10.25 = сeil(10.25) = 11)
function getGenresInCols()
{
    $data = getGenresData();
    $colsLen = 4;
    $rowsLen = ceil(count($data) / $colsLen);
    $result = array_chunk($data, $rowsLen);
    return $result;
}


// ----------------------------- ACTORS

// Функция возвращает cast фильма по id параметру
function getSingleActor()
{
    $id = $_GET["id"];
    $actors = getDBdata("SELECT * FROM actors WHERE id = '$id'");
    return $actors[0];
}

// Функция возвращает уникальные буквы из БД cast (для менюшки поиска по буквам)
function getActorsLetters()
{
    $letters = getDBdata("SELECT DISTINCT letter FROM actors ORDER BY letter ASC");
    return $letters;
}

// Функция возвращает cast фильма по letter параметру
function getActorsByLetter()
{
    $letter = $_GET["letter"];
    $actors = getDBdata("SELECT * FROM actors WHERE letter = '$letter'");
    return $actors;
}

// Делаем отдельную фукнцию для сетки актеров чтобы не запутаться в действии каждой функции
// Фукния возвращает массив из 4 колонок. Каждая колонка это массив из 11 элементов (41/4 = 10.25 = сeil(10.25) = 11)
function getActorsInCols()
{
    $data = getCastLetterData();
    $colsLen = 4;
    $rowsLen = ceil(count($data) / $colsLen);
    $result = array_chunk($data, $rowsLen);
    return $result;
}

// Функция возвращает данные фильмов согласно переданного списка в параметр функции
function getMoviesFromList($list)
{
    $movies = getDBdata("SELECT * FROM movies WHERE id IN ($list)");
    $result = [];
    foreach ($movies as $movie) {
        array_push($result, [
            "id" => $movie["id"],
            "title" => $movie["title"],
            "year" => $movie["year"],
            "genres" => getShortStr($movie["genres"], 30),
            "cast" => getShortStr($movie["cast"], 30),
            "extract" => getShortStr($movie["extract"], 90),
            "thumbnail" => $movie["thumbnail"],
        ]);
    };
    return $result;
}
