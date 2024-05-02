<?php
include "header.php";
$actor = getSingleActor();
$movies = getMovies($actor['movies']);
?>

<div class="container">
    <h1><?php echo $actor["name"]; ?></h1>
    <?php include "movies-loop.php"; ?>    
</div>

<?php
include "footer.php"
?>