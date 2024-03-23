<?php 
    include "header.php";
    // Функция возвращает данные фильмов для главной страницы
    $movies = getMoviesData();
?>

<!-- главный контейнер -->
<div class="container">
    <!-- Нзвание страницы -->
    <h1>Movies</h1>

    <!-- контейнер для фильмов -->
    <div id="movies-container" class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3 g-3">
    <?php foreach($movies as $movie) { ?>
        <div class="col">
            <div class="card border border-0 shadow-sm">
                <img src="./content/movies-thumbnails/<?php echo $movie["thumbnail"]; ?>" class="card-img-top" alt="Movie thumbnail">
                <div class="card-header border border-0"><?php echo $movie["genres"]; ?></div>
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <span><?php echo $movie["title"] ?></span>
                        <small class="text-body-tertiary">(<?php echo $movie["year"]; ?>)</small>
                    </h5>
                    <h6 class="card-text mb-3 text-secondary"><em><?php echo $movie["cast"]; ?></em></h6>
                    <p class="card-text"><?php echo $movie["extract"]; ?></p>
                    <!-- Создаем ссылку для перехода на страницу для отдельного фильма single-movie.php
                    В php можно передавать параметры для страницы на которую переходим прямо в строке со ссылкой
                    Например id. Параметр может быть любого другого названия(title, user_name, age...)
                    Параметры может быть одним словом без пробелов и специальных симвлов, кроме нижнего подчеркивания)
                    Параметр передаем после знака ?
                    (http://сайт/страница.php?имя_параметра=значение_параметра -->
                    
                    <!-- Задача 3.1 Добавить параметр id фильма в строку ссылки -->
                    <a href="./single-movie.php?id=" class="btn btn-primary">
                        Read more...
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>


<?php 
    include "footer.php";
?>