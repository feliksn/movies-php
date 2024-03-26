<?php 
    include "header.php";
    $genres = getGenresData();
    // Задача 5.1 - Жанры должны показываться в 4 столбика вместо одного.
    // Задача 5.2 - Жарны должны располагаться по алфавиту сверху вниз
    // Action
    // Adventure
    // Animated
    // Не так! Action Adventrue Animated
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