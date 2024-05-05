<?php
include "header.php";
$genre = getSingleGenre();
$movies = getMovies($genre['movies']);
?>

<div class="container">
    <h1 class="fw-light">
        <span class="text-primary"><?php echo $genre["name"]?></span> movies
        <small class="text-secondary">(<?php echo $movies["length"]; ?>)</small>
    </h1>
    <?php include "movies-loop.php"; ?>
</div>
       
<?php
include "footer.php"
?>