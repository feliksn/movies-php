<?php
include "header.php";
$letters = getUniqueActorsLetters();
$actorsCols = getActorsCols();
$colsOrderSM = [0, 2, 1, 3];
?>

<div class="container py-3">
    <div class="row">
        <div class="col-xs-1 text-center">
            <?php foreach ($letters as $letter) { ?>
                <?php $activeClass = $_GET["letter"] == $letter["letter"] ? "active" : "" ?>
                <a  href="./actors.php?letter=<?php echo $letter["letter"]; ?>"
                    class="fs-5 link-offset-1 link-underline link-underline-opacity-25 <?php echo $activeClass ?>">
                    <?php echo $letter["letter"]; ?>
                </a>
            <?php  } ?>
        </div>
    </div>
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
include "footer.php"
?>