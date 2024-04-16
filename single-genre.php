<?php
include "header.php";
$genre = getSingleGenre();
$genre_movies = getMoviesByIdList($genre['movies']);
// Задача 10.1 - Ограничить кол-во фильмов до 8 для отдельного жанра
?>

<div class="container">
    <h1><?php echo $genre["name"]; ?></h1>

    <div id="genre-movies-container" class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3 g-3">
        <?php foreach ($genre_movies as $genre_movie) { ?>
            <div class="col">
                <div class="card border border-0 shadow-sm">
                    <img src="./content/movies-thumbnails/<?php echo $genre_movie["thumbnail"]; ?>" onError="this.src='./images/movie-default.png'" class="card-img-top" alt="Movie thumbnail">
                    <div class="card-header border border-0"><?php echo $genre_movie["genres"]; ?></div>
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <span><?php echo $genre_movie["title"] ?></span>
                            <small class="text-body-tertiary">(<?php echo $genre_movie["year"]; ?>)</small>
                        </h5>
                        <h6 class="card-text mb-3 text-secondary"><em><?php echo $genre_movie["cast"]; ?></em></h6>
                        <p class="card-text"><?php echo $genre_movie["extract"]; ?></p>
                        <a href="./single-movie.php?id=<?php echo $genre_movie["id"] ?>" class="btn btn-primary">
                            Read more...
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
       
<?php
include "footer.php"
?>