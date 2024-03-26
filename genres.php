<?php 
    include "header.php";
    $genres = getGenresData();
    // Задача 4.1 - Создать функцию getGernesData() в fucntions.php которая получает название всех жанров
    // Задача 4.2 - Вызвать эту функцию и записать ее результат в переменную $genres в genres.php 
    // Задача 4.3 - В genres.php сделать список всех жанров, чтобы при открытии в браузере страницы genres.php, можно было видеть сслыки всех жарнов  
?>

<div class="container py-3">
    <?php foreach($genres as $genre) { ?>
    <div class="row">
        <div class="col">
            <a href="" class="fs-5 link-offset-1 link-underline link-underline-opacity-25"><?php echo $genre['name']; ?></a>
        </div>
    </div>
    <?php } ?>
</div>

<?php
    include "footer.php"
?>