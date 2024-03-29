<?php 
    include "header.php";
    // Фукния возвращает массив из 4 колонок. Каждая колонка это массив из 11элементов (41/4 = 10.25 = сeil(10.25) = 11)
    $genresCols = getGenresColsData();
?>

<div class="container py-3">
    <!-- Для правильного отображения жанров, так как задуманно, используем схему сеток bootstrap с определенными классами -->
    <!--     
    .row
    |-- >.col
           |
           >--.row
                |
                >--.col
                    |
                    -- Action
                    -- Adventure
                    -- Animated
                    --...
                >--.col
                    |
                    --Family
                    --Fantasy
                    --...
    |--  >.col
            |
            >--.row
                |
                >--.col
                    |
                    --Noir
                    --Perfomence
                    --Political
                    --...
                >--.col
                     |
                     --Spy
                     --Superhero
                     --...
    -->
    <div class="row">
        <!-- Запускаем цикл и проходимся по каждой колонке -->
        <?php for($colIndex = 0; $colIndex < count($genresCols); $colIndex++) { ?>
            <!-- Согласно схеме выше .col x 2 надо обернуь в .col>.row -->
            <!-- Делаем условие при котором если индекс колонки в массиве четный (в нашем случае 0 или 2), Добавляем дополнительную хтмл разметку -->
            <?php if($colIndex % 2 == 0) echo "<div class='col'><div class='row row-cols-1 row-cols-md-2'>"?>
            <!-- Далее добавляем каждую колонку из массива -->
            <div class="col">
                <!-- Запускаем цикл и проходимся по каждому жанру в колонке -->
                <?php for($genreIndexInCol = 0; $genreIndexInCol < count($genresCols[$colIndex]); $genreIndexInCol++) { ?>
                    <!-- Отображаем имя жанра в сслыке с хтмл переносом <br>, т.к. ссылка не блочный элемент, а строчный -->
                    <a href="" class="fs-5 link-offset-1 link-underline link-underline-opacity-25">
                        <?php echo $genresCols[$colIndex][$genreIndexInCol]['name']; ?>
                    </a><br>
                <?php } ?>
            </div>
            <!-- Если индекс колонки нечетный закрываем хтмл элементы .col>.row -->
            <?php if($colIndex % 2 !== 0) echo "</div></div>"?>
        <?php } ?>
    </div>
</div>

<?php
    include "footer.php"
?>