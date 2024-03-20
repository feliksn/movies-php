<?php 
    include "header.php";

    // Делаем запрос в базу данных и получаем первые 8 фильмов
    // "ORDER BY id" -  сортируем фильмы по столбику id в таблице начиная от 1
    // Записываем все это в переменную $rows.
    $rows = getDBdata('SELECT * FROM data ORDER BY id LIMIT 8');
?>

<!-- главный контейнер -->
<div class="container">
    <!-- Нзвание страницы -->
    <h1>Movies</h1>

    <!-- контейнер для фильмов -->
    <div id="movies-container" class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3 g-3">
    <?php foreach($rows as $row) { ?>
        <div class="col">
            <div class="card border border-0 shadow-sm">
                <!-- Задание 2.1
                Добавить картинки из папки content/movies-thumbnails для фильмов используя данные из базы данных -->
                <img src="./content/movies-thumbnails/<?php echo $row["thumbnail"]; ?>" class="card-img-top" alt="Movie thumbnail">
                <!-- Задание 2.2
                а) Сократить данные о жанрах до 30 символов и добавить 3 точки в конце
                б) Доп.задание необязательное (если (а) показалось легким)
                - если длина жанров более 30 символов обрезать до 30 символов и добавить ...,
                - если длина менее 30 симвлов оставить без изменений  -->
                <div class="card-header border border-0"><?php getMoviesProp($row, 'genres', 30);?></div>
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <span><?php echo $row["title"] ?></span>
                        <small class="text-body-tertiary">(<?php echo $row["year"] ?>)</small>
                    </h5>
                    <!-- Задание 2.3
                    a) Сократить список актеров до 30 символов и добавить 3 точки в конце
                    б) Доп.задание необязательное (если (а) показалось легким)
                    - если длина актеров более 30 символов обрезать до 30 символов и добавить ...,
                    - если длина менее 30 симвлов оставить без изменений -->
                    <h6 class="card-text mb-3 text-secondary"><em><?php getMoviesProp($row, 'cast', 30);?></em></h6>
                    <!-- Задание 2.4
                    Сократить данные описания до 90 символов и добавить 3 точки в конце
                    б) Доп.задание необязательное (если (а) показалось легким)
                    - если длина описания более 90 символов обрезать до 90 символов и добавить ...,
                    - если длина менее 90 симвлов оставить без изменений -->
                    <p class="card-text"><?php getMoviesProp($row, 'extract', 90);?></p>
                    <button type="button" class="btn btn-primary">
                        Read more...
                    </button>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php 
    include "footer.php";
?>