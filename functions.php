<?php

// ---------------------------- DB

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
            $result[] = $row;
        }
    } else {
        $result = "Каких-либо записей не найдено!";
    }
    
    mysqli_close($conn);
    
    return $result;
}

// Фнукция возвращает данные из определенной таблицы для отдельной записи по id
function getTableRowById($table, $id)
{
    return getDBdata("SELECT * FROM $table WHERE id = '$id'")[0];
}


// ----------------------------------- GLOBAL

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

// функция возвращает параметр id страницы
function getPageID(){
    return isset($_GET["id"]) && !empty($_GET["id"]) ?  $_GET["id"] : "";
}

// Функция возвращает данные для каждого элемента пагинации
// Функция принимает два параметра. $currPage - номер актуальной страницы. $maxPage - последняя страница
function getPagination($currPage, $maxPage)
{
    // Функция создает массив с данными ссыкли, передавая ей аргумент номера страницы. Если при вызове функции не передавать номер страницы, функция вернет массив с пустыми данными. Это будет нужно для пустых ссылок без номеров 
    function getLink($page="")
    {
        // Получаем id страницы из функции
        $id = getPageID();
        // Если id страницы не пустой, то создаем строку для ссылки и позже вставляем в массив данных о ссылке
        $id = $id ? "id=$id&" : $id;
        return array(
            // Данные класса. В свойство класса будет записывать класс для скрытия ненужных ссылок на странице, добавляя класс бустрап .d-none и другие классы если будет необходимость
            "class" => "",
            // Данные номера страницы. Обычный текст чтобы показывать в ссылке
            "text" => $page,
            // Данные ссылки. Полноценная ссылка в виде строки, которую будем передавать атрибут href
            "link" => "?" . $id . "page=" . $page
        );
    }

    // Записываем данные ссылки на предыдущюю страницу исползуюя номер активной страницы $currPage - 1 
    $prevPageArrow = getLink($currPage - 1);
    // Записываем данные для ссылки на первую страницу. Первая страницы всегда будет первой)))
    $firstPage = getLink(1);
    // Записываем данные для пустой ссылки. Она не имеет каких-либо текста либо ссылки на какую-либо страницу. Поэтому не передаем в функцию getLink() каких-либо данные о номере страницы. Тут эти данные не нужны. Однако пстая ссылка содержит массив с данными(class, text, link). Позже будем использовать эти данные а именно class, для того чтобы скрывать пустую ссылку в ненужных местах добавляя класс бутстрапа .d-none
    $emptyLeft = getLink();
    
    // Данные ссылки которая всегда меньше на 1 чем актуальная
    $page1 = getLink($currPage - 1);
    // Актуальная ссылка
    $page2 = getLink($currPage);
    // После того как создали ссылку с массивом данных, записываем активный класс к центральной ссылке 
    $page2["class"] = "active";
    // Данные ссылки которая всегда больше на 1 чем актуальная
    $page3 = getLink($currPage + 1);
    
    // Пустая ссылка справа без номера страницы
    $emptyRight = getLink();
    // Данные ссылки на последнюю страницу - это параметр $maxPage, т.е. кол-во всех страниц, в зависимости от кол-ва фильмов на странице
    $lastPage = getLink($maxPage);
    // Данные ссылки на следующую страницу - $page + 1
    $nextPageArrow = getLink($currPage + 1);

    if($currPage == 1){
        $prevPageArrow["class"] = "disabled";
        $page1 = getLink($currPage);
        $page1["class"] = "active";
        $page2 = getLink($currPage + 1);
        $page3 = getLink($currPage + 2);
    }

    if($currPage <= 2){
        $firstPage["class"] = "d-none";
    }

    if($currPage <= 3){
        $emptyLeft["class"] = "d-none";
    }

    if($currPage >= $maxPage - 2){
        $emptyRight["class"] = "d-none";
    }

    if($currPage >= $maxPage - 1){
        $lastPage["class"] = "d-none";
    }

    if($currPage == $maxPage){
        $nextPageArrow["class"] = "disabled";
        $page1 = getLink($maxPage - 2);        
        $page2 = getLink($maxPage - 1);        
        $page3 = getLink($maxPage);
        $page3["class"] = "active";        
    }

    // Дополнительные условия для скрытия ссылок при кол-ве страниц (2,3,4)
    // Если всего 2 страницы и активная страница не 2
    if($maxPage == 2 && $currPage != 2){
        // Скрываем 3 ссылку из цетральной группы
        $page3["class"] = "d-none";
    }
    // Если 2 страницы и активаня 2
    if($maxPage == 2 && $currPage == 2){
        // Скрываем 1 ссылку из центральной группы
        $page1["class"] = "d-none";
    }
    // Если кол-во страниц 3 и менее, тогда скрываем скрываем ссылки на певрую и последнюю страницу, т.к. эти ссылки не нужны. При 3 страницах достаточно показывать 3 центральные ссылки
    if($maxPage <= 3){
        $firstPage["class"] = "d-none";
        $lastPage["class"] = "d-none";
    }
    // Если кол-во страниц 4 и менее, тогда скрываем все пустые ссылки с тремя точками.
    if($maxPage <= 4){
        $emptyLeft['class'] = "d-none";
        $emptyRight['class'] = "d-none";
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
    $currPage = isset($_GET["page"]) && !empty($_GET["page"]) ? $_GET["page"] : 1;
    // Позиция фильма с которой надо получить 8 фильмов
    $firstMoviePos = $currPage * $moviesOnPage - $moviesOnPage;
    // Кол-во всех фильмов по запросу sql
    $moviesLength = getDBdata("SELECT COUNT(id) as total FROM movies $sqlList")[0]["total"];
    // Кол-во страниц в зависимости от кол-ва фильмов на одной странице
    $maxPage = ceil($moviesLength / $moviesOnPage);
    // Все данные 8 фильмов для определенной страницы
    $movies = getDBdata("SELECT * FROM movies $sqlList ORDER BY id LIMIT $firstMoviePos, $moviesOnPage");
    foreach ($movies as $movieIndex => $movie) {
        $movie["genres"] = getShortStr($movie["genres"], 30);
        $movie["cast"] = getShortStr($movie["cast"], 30);
        $movie["extract"] = getShortStr($movie["extract"], 90);
        $movies[$movieIndex] = $movie;
    }
    return array(
        "list"      => $movies,
        "length"    => $moviesLength,
        "currPage"  => $currPage,
        "maxPage"   => $maxPage
    );
}

// Функция возвращает данные фильма по id параметру
function getSingleMovie()
{
    $id = getPageID();
    $movie = getTableRowById("movies", $id);
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
    $id = getPageID();
    $genre = getTableRowById("genres", $id);
    return $genre;
}


// Функция возвращает данные всех жанров в разделенные на колонки
function getGenresCols()
{
    $genres = getDBdata("SELECT * FROM genres ORDER BY name ASC");
    $genresCols = getArrCols($genres);
    return $genresCols;
}


// ----------------------------- ACTORS

// Функция возвращает данные отдельного аткера по id параметру
function getSingleActor()
{
    $id = getPageID();
    $actor = getTableRowById("actors", $id);
    return $actor;
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

// Функция возвращает данные всех актеров разделенные на колонки
function getActorsCols()
{
    $letter = $_GET["letter"];
    $actors = getDBdata("SELECT * FROM actors WHERE letter = '$letter' ORDER BY name ASC");
    $actorsCols = getArrCols($actors);
    return $actorsCols;
}