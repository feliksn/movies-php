<?php
    include 'header.php';
    // Получаем параметр id фильма из адреснной строки браузера "https://movies-phpmysql/single-movie.php?id=..."
    $id = $_GET["id"];
    
    // Задача 3.3
    // Вызвать функцию получения данных фильма по параметру $id и записать ее в переменную $movie
    // $movie = фукцния_получения_данных_отдельного_фильма($id)
    $movie = getMovieData($id);
?>

<!-- Задача 3.4
Добавить данные фильма в разметку хтмл из переменной $movie -->
<div class="container">
<?php foreach($movie as $mov) { ?>
    <div class="row">
        <div class="col-4">
            <img src="./content/movies-thumbnails/<?php echo $mov["thumbnail"]; ?>" alt="Movie thumbnail">
        </div>
        <div class="col-8">
            <h5>
               <?php echo $mov["title"]; ?><br>
                <small>(<?php echo $mov["year"]; ?>)</small>
            </h5>
            <p><?php echo $mov["genres"]; ?></p>
            <p><?php echo $mov["cast"]; ?></p>
            <p><?php echo $mov["extract"]; ?></p>
        </div>
    </div>
    <?php } ?>
</div>

<?php
    include 'footer.php';
?>