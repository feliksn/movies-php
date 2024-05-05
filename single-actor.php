<?php
include "header.php";
$actor = getSingleActor();
$movies = getMovies($actor['movies']);
?>

<div class="container">
    <h1 class="fw-light">Movies with
        <span class="text-primary"><?php echo $actor["name"]?></span>
        <small class="text-secondary">(<?php echo $movies["length"]; ?>)</small>
    </h1>
    <?php include "movies-loop.php"; ?>    
</div>

<?php
include "footer.php"
?>