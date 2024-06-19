<?php
include 'header.php';
$movie = getSingleMovie();
?>

<div class="container py-4">
    <div class="row">
        <div class="col-3 offset-1">
            <img src="./content/movies-thumbnails/<?php echo $movie["thumbnail"]; ?>" onError="this.src='./images/movie-default.png'" alt="Movie thumbnail" class="d-block w-100">
        </div>
        <div class="col-7">
            <h1><?php echo $movie["title"]; ?><br></h1>
            <p class="fs-4 text-secondary">(<?php echo $movie["year"]; ?>)</p>
            <p>
                <?php foreach ($movie["genres"] as $genre) { ?>
                    <a href="./single-genre.php?id=<?php echo $genre["id"] ?>"><?php echo $genre["name"] ?></a>
                <?php } ?>
            </p>
            <p>
                <?php foreach ($movie["cast"] as $cast) { ?>
                    <a href="./single-actor.php?id=<?php echo $cast["id"] ?>"><?php echo $cast["name"]; ?></a>
                <?php } ?>
            </p>
            <p><?php echo $movie["extract"]; ?></p>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>