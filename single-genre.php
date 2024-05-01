<?php
include "header.php";
$genre = getSingleGenre();
$genre_movies = getMoviesByIdList($genre['movies']);
// Задача 12.1 - Активировать пагинацию для фильмов отдельного жанра
?>

<div class="container">
    <h1><?php echo $genre["name"]; ?></h1>
    <?php include "movies-loop.php"; ?>
</div>
       
<?php
include "footer.php"
?>