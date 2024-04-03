<?php 
    include "header.php";
    $cols = getGenresColsData();
    $colsOrderSM = [0,2,1,3];
?>

<div class="container py-3">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
        <?php foreach($cols as $colIndex => $colGenres) { ?>
            <div class="col <?php echo "order-sm-$colsOrderSM[$colIndex] order-lg-$colIndex" ?>">
                <?php foreach($colGenres as $genre) { ?>
                    <!-- Задача 6 - Сделать ссылку по клику которой будет открываться отдельная страница с названием жанра -->
                    <a href="" class="fs-5 link-offset-1 link-underline link-underline-opacity-25">
                        <?php echo $genre["name"]; ?>
                    </a><br>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<?php
    include "footer.php"
?>