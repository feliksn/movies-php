<?php
include "header.php";
$actor = getSingleActor();
$actor_movies = getMoviesByIdList($actor['movies']);
// Задача 12.2 - Активировать пагинацию для фильмов отдельного аткера
?>

<div class="container">
    <h1><?php echo $actor["name"]; ?></h1>
    <?php include "movies-loop.php"; ?>    
</div>

<?php
include "footer.php"
?>