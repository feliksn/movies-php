<?php 
    include "header.php";
    // Фукния возвращает массив из 4 колонок. Каждая колонка это массив из 11элементов (41/4 = 10.25 = сeil(10.25) = 11)
    $cols = getGenresColsData();
    $colsOrderSM = [1,3,2,4];
?>

<div class="container py-3">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
        <?php foreach($cols as $colIndex => $col) { ?>
            <div class="col <?php echo "order-sm-$colsOrderSM[$colIndex] order-lg-$colIndex" ?>">
                <?php foreach($col as $genreIndex => $genre) { ?>
                    <a href="" class="fs-5 link-offset-1 link-underline link-underline-opacity-25">
                        <?php echo $genre['name']; ?>
                    </a><br>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<?php
    include "footer.php"
?>