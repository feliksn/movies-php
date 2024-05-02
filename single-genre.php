<?php
include "header.php";
$genre = getSingleGenre();
$movies = getMovies($genre['movies']);
?>

<div class="container">
    <h1><?php echo $genre["name"]; ?></h1>
    <?php include "movies-loop.php"; ?>
</div>
       
<?php
include "footer.php"
?>