<?php
include "header.php";
$genre = getSingle("genres");
$movies = getMovies($genre['movies'], $genre["moviesQuantity"]);
?>

<div class="container">
    <h3>Found movies by <u><b><?php echo $genre["name"]; ?></b></u> : <?php echo $movies["length"]; ?></h3>

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
include "pagination.php";
?>

<?php if ($movies["pages"] != 1) {
    echo
    '
<!-- Поиск страницы -->
<form class="row justify-content-center g-1" action="/single-genre.php" method="GET" id="#formGoToPage">
    
    <!-- Будем применять скрытое поле ввода -->
    <input type="hidden"  name="id" value="' . $genre["id"] . '">

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3"  id="#btnGoToPage">Go to page</button>
    </div>

    <div class="col-auto">
        <input type="number" class="form-control input-go-to-page" name="page" id="#inputGoToPage" required min="1" max="'. $movies["pages"].'">
    </div>
    
</form>
    ';
} ?>

<?php
include "footer.php"
?>