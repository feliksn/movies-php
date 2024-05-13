<?php

// ---------------------------- GLOBAL

// Создаем функцию подключения к базе данных и получения данных по sql запросу, который передаем как аргумент функции
function getDBdata($sql)
{
    $servername = "localhost";
    $username = "db_movies_user";
    $password = "db_movies_pass";
    $dbname = "db_movies";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Не удалось подлючиться к базе данных: " . $conn->connect_error);
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

// функция возвращает параметр страницы
function getPageParametr($parameter, $otherParameter)
{
    return isset($_GET[$parameter]) && !empty($_GET[$parameter]) ?  $_GET[$parameter] : $otherParameter;
}

// Разделяет массив, переданный как 1-й параметр, на кол-во колонок, переданные как 2-й параметр
// По умолчанию кол-во колонок = 4. Если не указвать второй параметр при вызове функции, то кол-во колонок всегда будет = 4
function getArrCols($pos)
{
    $letter = getPageParametr("letter", "");
    $posWhere = $pos === "actors" ? " WHERE letter = '$letter' " : "";
    $sqlz = getDBdata("SELECT * FROM $pos $posWhere ORDER BY name ASC");
    $rowsLen = ceil(count($sqlz) / 4);
    $arrCols = array_chunk($sqlz, $rowsLen);
    return $arrCols;
}

// Функция пределывает обычную строку со значениями через запятую на строку со значениями для sql запроса
function getSqlFromStr($str)
{
    return '"' . str_replace(',', '","', $str) . '"';
}

// Функция возвращает данные отдельной позиции(актер или жанр) по id параметру
function getSingle($pos)
{
    $id = $_GET["id"];
    $single = getDBdata("SELECT * FROM $pos WHERE id = '$id'")[0];
    $str_mov = explode(",", $single["movies"]);
    $moviesQuantity = count($str_mov);
    return array(
        "id" => $single["id"],
        "name" => $single["name"],
        "movies" => $single["movies"],
        "moviesQuantity" => $moviesQuantity
    );
}


// Функция возвращает данные для каждого элемента пагинации
// Функция принимает два параметра. $page - номер актуальной страницы. $pages - кол-во всех страниц
function getPagination($page, $pages)
{
    // Функция создает массив с данными ссыкли, передавая ей аргумент номера страницы. Если при вызове функции не передавать номер страницы, функция вернет массив с пустыми данными. Это будет нужно для пустых ссылок без номеров 
    function getLink($page = "")
    {
        $id = getPageParametr("id", "");
        $id = $id !== "" ? "id=" . $id . "&" : $id;
        return array(
            "class" => "",
            "text" => $page,
            "link" => "?" . $id . "page=" . $page
        );
    }

    $prevPageArrow = getLink($page - 1);
    $firstPage = getLink(1);
    $emptyLeft = getLink();
    $page1 = getLink($page - 1);
    $page2 = getLink($page);
    $page2["class"] = "active";
    $page3 = getLink($page + 1);
    $emptyRight = getLink();
    $lastPage = getLink($pages);
    $nextPageArrow = getLink($page + 1);

    if ($page == 1) {
        $prevPageArrow["class"] = "disabled";
        $page1 = getLink($page);
        $page1["class"] = "active";
        $page2 = getLink($page + 1);
        $page3 = getLink($page + 2);
    }

    if ($page <= 2) {
        $firstPage["class"] = "d-none";
    }

    if ($page <= 3) {
        $emptyLeft["class"] = "d-none";
    }

    if ($page >= $pages - 2) {
        $emptyRight["class"] = "d-none";
    }

    if ($page >= $pages - 1) {
        $lastPage["class"] = "d-none";
    }

    if ($page == $pages) {
        $nextPageArrow["class"] = "disabled";
        $page1 = getLink($pages - 2);
        $page2 = getLink($pages - 1);
        $page3 = getLink($pages);
        $page3["class"] = "active";
    }

    if ($pages == 1) {
        $prevPageArrow["class"] = "d-none";
        $firstPage["class"] = "d-none";
        $emptyLeft["class"] = "d-none";
        $page1["class"] = "d-none";
        $page2["class"] = "d-none";
        $page3["class"] = "d-none";
        $emptyRigh["class"] = "d-none";
        $lastPage["class"] = "d-none";
        $nextPageArrow["class"] = "d-none";
    }

    if ($pages == 2) {
        $page1 = getLink(1);
        $page1["class"] = "active";
        $page2 = getLink(2);
        if ($page == 2) {
            $page1["class"] = "";
            $page2["class"] = "active";
        }
        $page3["class"] = "d-none";
    }

    if ($pages == 3) {
        $firstPage["class"] = "d-none";
        $lastPage["class"] = "d-none";
    }


    // Функция возвращает ассоциированный массив ключ=значение, по которым будем получать данные и заполнять пагинацию
    return array(
        "prevPageArrow" => $prevPageArrow,
        "firstPage" => $firstPage,
        "emptyRight" => $emptyRight,

        "page1" => $page1,
        "page2" => $page2,
        "page3" => $page3,

        "emptyLeft" => $emptyLeft,
        "lastPage" => $lastPage,
        "nextPageArrow" => $nextPageArrow,
    );
}

// ---------------------------- MOVIES

// Функция возвращает массив с 4 типами данных о фильмах. Данные из этой функции можно использовать в для построения пагинации страниц
function getMovies($list = false)
{
    // Список фильмов по id. Параметр функции по умолчанию = false. Если в параметр функции передадим список фильмов, то в запрос базы данных добавиться дополнительный параметр (результат переменных $moviesLength и $movies)
    $sqlList = $list ? " WHERE id IN ($list)" : "";
    // Кол-во фильмов на одной странице
    $moviesOnPage = 8;
    // Номер актуальной страницы
    $page = getPageParametr("page", 1);
    // Позиция фильма с которой надо получить 8 фильмов
    $firstMoviePos = $page * $moviesOnPage - $moviesOnPage;
    // Кол-во всех фильмов по запросу sql
    $length = getDBdata("SELECT COUNT(id) as total FROM movies $sqlList")[0]["total"];
    // Кол-во страниц в зависимости от кол-ва фильмов на одной странице
    $pages = ceil($length / $moviesOnPage);
    // Все данные 8 фильмов для определенной страницы
    $movies = getDBdata("SELECT * FROM movies $sqlList ORDER BY id LIMIT $firstMoviePos, $moviesOnPage");
    foreach ($movies as $movieIndex => $movie) {
        $movie["genres"] = getShortStr($movie["genres"], 30);
        $movie["cast"] = getShortStr($movie["cast"], 30);
        $movie["extract"] = getShortStr($movie["extract"], 90);
        $movies[$movieIndex] = $movie;
    }
    return array(
        "movies" => $movies,
        "length" => $length,
        "page"   => $page,
        "pages"  => $pages
    );
}

// Функция возвращает данные фильма по id параметру
function getSingleMovie()
{
    $id = $_GET["id"];
    $movies = getDBdata("SELECT * FROM movies WHERE id = '$id'");
    $movie = $movies[0];
    $genresSql = getSqlFromStr($movie["genres"]);
    $castSql = getSqlFromStr($movie["cast"]);
    $genres = getDBdata("SELECT name, id FROM genres WHERE name IN ($genresSql)");
    $cast = getDBdata("SELECT * FROM actors WHERE name IN ($castSql)");
    $movie["genres"] = $genres;
    $movie["cast"] = $cast;
    return $movie;
}


// ----------------------------- ACTORS

// Функция возвращает уникальные буквы из БД actors (для менюшки поиска по буквам)
function getUniqueActorsLetters()
{
    $letters = getDBdata("SELECT DISTINCT letter FROM actors ORDER BY letter ASC");
    foreach ($letters as $letterIndex => $letter) {
        $letters[$letterIndex] = $letter["letter"];
    }
    return $letters;
}

//---------------------SEARCH----------------------------//

function getSearch()
{
    $search = $_GET['id'];
    $search_mass_mov = getDBdata("SELECT * FROM movies WHERE title LIKE '%$search%' OR cast LIKE '%$search%' OR genres LIKE '%$search%'");
    $mov = [];
    for($i = 0; $i < count($search_mass_mov); $i++){
        array_push($mov, $search_mass_mov[$i]["id"]);
    };    
    $str_mov = implode(",", $mov);
    $moviesQuantity = count($mov);
    return array(
        "movies" => $str_mov, 
        "moviesQuantity" => $moviesQuantity
    );        
}

