<?php
include "header.php";
$casts_letter = getCastUniqueLetterData();
$cols_cast = getCastColsData();
$colsOrderSM = [0, 2, 1, 3];
?>

<div class="container py-3">
    <div class="row">
        <div class="col-xs-1 text-center">
            <?php foreach ($casts_letter as $cast_letter) { ?>
                <!-- php active link-->
                <a href="./cast.php?letter=<?php echo $cast_letter["letter"]; ?>" <?php echo ($_GET['letter'] == $cast_letter["letter"]) ? "class='fs-5 link-offset-1 link-underline link-underline-opacity-25 active'" : "class='fs-5 link-offset-1 link-underline link-underline-opacity-25'"; ?>>
                    <?php echo $cast_letter["letter"]; ?>
                </a>
            <?php  } ?>
        </div>
    </div>
    <hr>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
        <?php foreach ($cols_cast as $col_cast_index => $col_cast) { ?>
            <div class="col <?php echo "order-sm-$colsOrderSM[$col_cast_index] order-lg-$col_cast_index" ?>">
                <?php foreach ($col_cast as $cast) { ?>
                    <a href="./single-cast.php?id=<?php echo $cast["id"]; ?>" class="fs-5 link-offset-1 link-underline link-underline-opacity-25">
                        <?php echo $cast["name"] ?>
                    </a><br>
                <?php  } ?>
            </div>
        <?php  } ?>
    </div>
</div>

<?php
include "footer.php"
?>