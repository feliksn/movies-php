<?php
include "header.php";
$movies = getMovies();
?>

<!-- главный контейнер -->
<div class="container">
    <!-- Нзвание страницы -->
    <h1>Movies</h1>
    <!-- Цикл фильмов -->
    <?php include "movies-loop.php"; ?>
</div>

<?php
include "footer.php";
?>