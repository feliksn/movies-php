<?php
include "header.php";
$genresCols = getGenresCols();
$colsOrderSM = [0, 2, 1, 3];
?>

<div class="container py-3">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
        <?php foreach ($genresCols as $colIndex => $genres) { ?>
            <div class="col <?php echo "order-sm-$colsOrderSM[$colIndex] order-lg-$colIndex" ?>">
                <?php foreach ($genres as $genre) { ?>
                    <a href="./single-genre.php?id=<?php echo $genre["id"] ?>" class="fs-5 link-offset-1 link-underline link-underline-opacity-25">
                        <?php echo $genre["name"]; ?>
                    </a><br>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<?php
?>