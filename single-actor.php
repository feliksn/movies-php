<?php
include "header.php";
$actor = getSingle("actors");
$movies = getMovies($actor['movies'], $actor["moviesQuantity"]);
?>

<div class="container">
    <h3>Found movies with <u><b><?php echo $actor["name"]; ?></b></u> : <?php echo $movies["length"]; ?></h3>

    <div id="cast-movies-container" class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3 g-3">
        <?php foreach ($movies["movies"] as $actor_movie) { ?>
            <div class="col">
                <div class="card border border-0 shadow-sm">
                    <img src="./content/movies-thumbnails/<?php echo $actor_movie["thumbnail"]; ?>" onError="this.src='./images/movie-default.png'" class="card-img-top" alt="Movie thumbnail">
                    <div class="card-header border border-0"><?php echo $actor_movie["genres"]; ?></div>
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <span><?php echo $actor_movie["title"] ?></span>
                            <small class="text-body-tertiary">(<?php echo $actor_movie["year"]; ?>)</small>
                        </h5>
                        <h6 class="card-text mb-3 text-secondary"><em><?php echo $actor_movie["cast"]; ?></em></h6>
                        <p class="card-text"><?php echo $actor_movie["extract"]; ?></p>
                        <a href="./single-movie.php?id=<?php echo $actor_movie["id"] ?>" class="btn btn-primary">
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

<?php if($movies["pages"] != 1 ) { 
echo
'
<!-- Поиск страницы -->
<form class="row justify-content-center g-1" action="/single-actor.php" method="GET" id="#formGoToPage">

    <!-- Будем применять скрытое поле ввода -->
    <input type="hidden"  name="id" value="' . $actor["id"] . '">

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3" id="#btnGoToPage">Go to page</button>
    </div>
    <div class="col-auto">
        <input type="number" class="form-control input-go-to-page" name="page" id="#inputGoToPage" required min="1" max="' . $movies["pages"] .'">
    </div>
</form>
';
}?>

<?php
include "footer.php"
?>