<?php
    include 'header.php';
    // Получаем параметр id фильма из адреснной строки браузера "https://movies-phpmysql/single-movie.php?id=..."
    $id = $_GET["id"];
    
    // Задача 3.3
    // Вызвать функцию получения данных фильма по параметру $id и записать ее в переменную $movie
    // $movie = фукцния_получения_данных_отдельного_фильма($id)
?>

<!-- Задача 3.4
Добавить данные фильма в разметку хтмл из переменной $movie -->
<div class="container">
    <div class="row">
        <div class="col-4">
            <img src="movie-thumbnail.img" alt="Movie thumbnail">
        </div>
        <div class="col-8">
            <h5>
                Movie title<br>
                <small>(movie year)</small>
            </h5>
            <p>Movie genres</p>
            <p>Movie cast</p>
            <p>Movie extract</p>
        </div>
    </div>
</div>

<?php
    include 'footer.php';
?>