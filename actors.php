<?php
include "header.php";
$letters = getUniqueActorsLetters();
$actorsCols = getArrCols("actors");
$colsOrderSM = [0, 2, 1, 3];
?>

<div class="container py-3">
    <ul class="nav nav-pills">
        <?php foreach ($letters as $letter) { ?>
            <?php $activeClass = $_GET["letter"] == $letter ? "active" : "" ?>
            <?php $ariaCurrentPage = $_GET["letter"] == $letter ? "aria-current='page'" : "" ?>
            <li class="nav-item">
                <a  href="./actors.php?letter=<?php echo $letter; ?>"
                    class="nav-link <?php echo $activeClass ?>"
                    <?php echo $ariaCurrentPage ?>>
                    <?php echo $letter; ?>
                </a>
            </li>
        <?php  } ?>
    </ul>
    <hr>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
        <?php foreach ($actorsCols as $colIndex => $actors) { ?>
            <div class="col <?php echo "order-sm-$colsOrderSM[$colIndex] order-lg-$colIndex" ?>">
                <?php foreach ($actors as $actor) { ?>
                    <a href="./single-actor.php?id=<?php echo $actor["id"]; ?>" class="fs-5 link-offset-1 link-underline link-underline-opacity-25">
                        <?php echo $actor["name"] ?>
                    </a><br>
                <?php  } ?>
            </div>
        <?php  } ?>
    </div>
</div>

<?php
?>