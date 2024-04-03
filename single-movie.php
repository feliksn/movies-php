<?php
    include 'header.php';
    $movie = getMovieData();
?>

<div class="container py-4">
    <div class="row">
        <div class="col-3 offset-1">
            <img src="./content/movies-thumbnails/<?php echo $movie["thumbnail"]; ?>" alt="Movie thumbnail" class="d-block w-100">
        </div>
        <div class="col-7">
            <h1><?php echo $movie["title"]; ?><br></h1>
            <p class="fs-4 text-secondary">(<?php echo $movie["year"]; ?>)</p>
            <!-- Задача 7 - Переделать текст жанров на ссылки, которые будут вести на отдельную страницу жанра -->
            <p><?php echo $movie["genres"]; ?></p>
            <p><?php echo $movie["cast"]; ?></p>
            <p><?php echo $movie["extract"]; ?></p>
        </div>
    </div>
</div>

<?php
    include 'footer.php';
?>