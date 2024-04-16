<?php
include "header.php";
$movies = getMovies($page);
// Задача 9 - Добавить в проект функциональность страниц (пока только для главной странцы)
// При передаче в адресную строку параметра page=номер_страницы, нужно чтобы показывались 8 фильмов согласно номеру страницы
// page=1 - певрые 8 фильмов 1-8
// page=2 - вторый 8 фильмов 9-16
// ... и так далее
?>

<!-- главный контейнер -->
<div class="container">
    <!-- Нзвание страницы -->
    <h1>Movies</h1>

    <!-- контейнер для фильмов -->
    <div id="movies-container" class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3 g-3">
        <?php foreach ($movies as $movie) { ?>
            <div class="col">
                <div class="card border border-0 shadow-sm">
                    <img src="./content/movies-thumbnails/<?php echo $movie["thumbnail"]; ?>" onError="this.src='./images/movie-default.png'" class="card-img-top" alt="Movie thumbnail">
                    <div class="card-header border border-0"><?php echo $movie["genres"]; ?></div>
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <span><?php echo $movie["title"] ?></span>
                            <small class="text-body-tertiary">(<?php echo $movie["year"]; ?>)</small>
                        </h5>
                        <h6 class="card-text mb-3 text-secondary"><em><?php echo $movie["cast"]; ?></em></h6>
                        <p class="card-text"><?php echo $movie["extract"]; ?></p>
                        <a href="./single-movie.php?id=<?php echo $movie["id"] ?>" class="btn btn-primary">
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