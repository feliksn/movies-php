<?php
include "header.php";
$cast = getCastData();
$cast_movies = getCastIdMovieData($cast['movies']);
?>

<div class="container">
    <!-- АКТЁР -->
    <h1><?php echo $cast["name"]; ?></h1>

    <div id="cast-movies-container" class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3 g-3">
        <?php foreach ($cast_movies as $cast_movie) { ?>
            <div class="col">
                <div class="card border border-0 shadow-sm">
                    <img src="./content/movies-thumbnails/<?php echo $cast_movie["thumbnail"]; ?>" class="card-img-top" alt="Movie thumbnail">
                    <div class="card-header border border-0"><?php echo $cast_movie["genres"]; ?></div>
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <span><?php echo $cast_movie["title"] ?></span>
                            <small class="text-body-tertiary">(<?php echo $cast_movie["year"]; ?>)</small>
                        </h5>
                        <h6 class="card-text mb-3 text-secondary"><em><?php echo $cast_movie["cast"]; ?></em></h6>
                        <p class="card-text"><?php echo $cast_movie["extract"]; ?></p>
                        <a href="./single-movie.php?id=<?php echo $cast_movie["id"] ?>" class="btn btn-primary">
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