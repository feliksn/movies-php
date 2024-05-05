<?php
include "header.php";
$movies = getMovies();
?>

<!-- главный контейнер -->
<div class="container">
    <!-- Нзвание страницы -->
    <h1 class="fw-light">All Movies
        <small class="text-secondary">(<?php echo $movies["length"]; ?>)</small>
    </h1>
    <!-- Цикл фильмов -->
    <?php include "movies-loop.php"; ?>
</div>

<?php
include "footer.php";
?>