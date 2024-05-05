<?php
include "header.php";
$genre = getSingle("genres");
$movies = getMovies($genre["single"]['movies'], $genre["len_str_mov"]);
?>

<div class="container">
    <!-- Задача 13.3 - Добавить текст в заголовок h1 "Found movies by $genreName genre: 1234" -->
    <h2>Found movies by <b><?php echo $genre["single"]["name"]; ?></b>: <?php echo $movies["length"]; ?></h2>

    <div id="genre-movies-container" class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3 g-3">
        <?php foreach ($movies["movies"] as $genre_movie) { ?>
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