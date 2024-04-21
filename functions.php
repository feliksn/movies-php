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

// Разделяет массив, переданный как 1-й параметр, на кол-во колонок, переданные как 2-й параметр
// По умолчанию кол-во колонок = 4. Если не указвать второй параметр при вызове функции, то кол-во колонок всегда будет = 4
function getArrCols($arr, $colsLen=4)
{
    $rowsLen = ceil(count($arr) / $colsLen);
    $arrCols = array_chunk($arr, $rowsLen);
    return $arrCols;
}

// Функция пределывает обычную строку со значениями через запятую на строку со значениями для sql запроса
function getSqlFromStr($str)
{
    return '"' . str_replace(',', '","', $str) . '"';
}

// Функция возвращает данные для каждого элемента пагинации
// Функция принимает два параметра. $page - номер актуальной страницы. $pages - кол-во всех страниц
function getPagination($page, $pages)
{
    // Функция создает массив с данными ссыкли, передавая ей аргумент номера страницы. Если при вызове функции не передавать номер страницы, функция вернет массив с пустыми данными. Это будет нужно для пустых ссылок без номеров 
    function getLink($page="")
    {
        return array(
            // Данные класса. В свойство класса будет записывать класс для скрытия ненужных ссылок на странице, добавляя класс бустрап .d-none и другие классы если будет необходимость
            "class" => "",
            // Данные номера страницы. Обычный текст чтобы показывать в ссылке
            "text" => $page,
            // Данные ссылки. Полноценная ссылка в виде строки, которую будем передавать атрибут href
            "link" => "/?page=" . $page
        );
    }

    // Записываем данные ссылки на предыдущюю страницу исползуюя номер активной страницы $page - 1 
    $prevPageArrow = getLink($page - 1);
    // Записываем данные для ссылки на первую страницу. Первая страницы всегда будет первой)))
    $firstPage = getLink(1);
    // Записываем данные для пустой ссылки. Она не имеет каких-либо текста либо ссылки на какую-либо страницу. Поэтому не передаем в функцию getLink() каких-либо данные о номере страницы. Тут эти данные не нужны. Однако пстая ссылка содержит массив с данными(class, text, link). Позже будем использовать эти данные а именно class, для того чтобы скрывать пустую ссылку в ненужных местах добавляя класс бутстрапа .d-none
    $emptyLeft = getLink();
    
    // Данные ссылки которая всегда меньше на 1 чем актуальная
    $page1 = getLink($page - 1);
    // Актуальная ссылка
    $page2 = getLink($page);
    // После того как создали ссылку с массивом данных, записываем активный класс к центральной ссылке 
    $page2["class"] = "active";
    // Данные ссылки которая всегда больше на 1 чем актуальная
    $page3 = getLink($page + 1);
    
    // Пустая ссылка справа без номера страницы
    $emptyRight = getLink();
    // Данные ссылки на последнюю страницу - это параметр $pages, т.е. кол-во всех страниц, в зависимости от кол-ва фильмов на странице
    $lastPage = getLink($pages);
    // Данные ссылки на следующую страницу - $page + 1
    $nextPageArrow = getLink($page + 1);
    
    // Блок swith-case сосдаем условия при которых будем менять номера страниц для разных эелементов пагинации, а также скрывать ненужные элементы на определенных страницах добавляя класс бустрап .d-none
    // Просьба заметить!!! В блоке switch-case изменяем данные только для тех ссылок, которые необходимо изменить. Остальные ссылки не трогаем, так как они уже были определенны перед блоком switch-case
    // Перед блоком определяем данные для всех ссылок, по умолчанию, а в самом блоке меняем данные ссылок только для первых трех страниц и для последних трех страниц. Для остальных страниц условия будут неизменными.  
    switch ($page) {
        case 1:
            // Если страница 1, то скрываем ссылки (сслыка стрелка слева, ссылка на первую страницу, ссылка пустая слева)
            $prevPageArrow["class"] = "d-none";
            $firstPage["class"] = "d-none";
            $emptyLeft["class"] = "d-none";
            // Если на первой странице, то меняем схему для центральных постоянных ссылок
            $page1 = getLink($page);
            $page1["class"] = "active";
            $page2 = getLink($page + 1);
            $page3 = getLink($page + 2);
            // Не меняем данные для последних 3 ссылок(пустая справа, ссылка на последнюю страницу, ссылка на следущюю страницу), т.к. данные для этих ссылок не меняются, если находимся на первой странице. Данные для последних 3 ссылок были определены перед блоком switch-case и не нуждаются в изменении для страницы 1. Последние три сслыки пагинации не попадают в первый switch-case, а обходят строной этот блок условий и попадают финальный массив после блока switch-case
            break;
        case 2:

            break;
        case 3:

            break;
        case $pages - 2:

            break;
        case $pages - 1:

            break;
        case $pages:

            break;
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
function getMovies()
{
    // Кол-во фильмов на одной странице
    $moviesOnPage = 8;
    // Номер актуальной страницы
    $page = isset($_GET["page"]) && !empty($_GET["page"]) ? $_GET["page"] : 1;
    // Позиция фильма с которой надо получить 8 фильмов
    $firstMoviePos = $page * $moviesOnPage - $moviesOnPage;
    // Кол-во всех фильмов по запросу sql
    $length = getDBdata("SELECT COUNT(id) as total FROM movies")[0]["total"];
    // Кол-во страниц в зависимости от кол-ва фильмов на одной странице
    $pages = ceil($length / $moviesOnPage);
    // Все данные 8 фильмов для определенной страницы
    $movies = getDBdata("SELECT * FROM movies ORDER BY id LIMIT $firstMoviePos, $moviesOnPage");
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

  
// ---------------------------- GENRES

// Функция возвращает данные отдельного жанра по id параметру
function getSingleGenre()
{
    $id = $_GET["id"];
    $genres = getDBdata("SELECT * FROM genres WHERE id = '$id'");
    return $genres[0];
}

// Функция возвращает данные всех жанров
function getGenres()
{
    $genres = getDBdata("SELECT * FROM genres ORDER BY name ASC");
    return $genres;
}

// Функция возвращает данные всех жанров в разделенные на колонки
function getGenresCols()
{
    $genres = getGenres();
    $genresCols = getArrCols($genres);
    return $genresCols;
}


// ----------------------------- ACTORS

// Функция возвращает данные отдельного аткера по id параметру
function getSingleActor()
{
    $id = $_GET["id"];
    $actors = getDBdata("SELECT * FROM actors WHERE id = '$id'");
    return $actors[0];
}

// Функция возвращает уникальные буквы из БД actors (для менюшки поиска по буквам)
function getUniqueActorsLetters()
{
    $letters = getDBdata("SELECT DISTINCT letter FROM actors ORDER BY letter ASC");
    foreach($letters as $letterIndex => $letter)
    {
        $letters[$letterIndex] = $letter["letter"];
    }
    return $letters;
}

// Функция возвращает всех актеров по первой букве имени
function getActors()
{
    $letter = $_GET["letter"];
    $actors = getDBdata("SELECT * FROM actors WHERE letter = '$letter' ORDER BY name ASC");
    return $actors;
}

// Функция возвращает данные всех актеров разделенные на колонки
function getActorsCols()
{
    $actors = getActors();
    $actorsCols = getArrCols($actors);
    return $actorsCols;
}

// Функция возвращает данные фильмов по переданному списку id в параметр функции
function getMoviesByIdList($list)
{
    $movies = getDBdata("SELECT * FROM movies WHERE id IN ($list) LIMIT 8");
    foreach ($movies as $movieIndex => $movie) {
        $movie["genres"] = getShortStr($movie["genres"], 30);
        $movie["cast"] = getShortStr($movie["cast"], 30);
        $movie["extract"] = getShortStr($movie["extract"], 90);
        $movies[$movieIndex] = $movie;
    };
    return $movies;
}
