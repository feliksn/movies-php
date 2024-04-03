<?php 
    include "header.php";
    $genre = getGenreData()
?>

<div class="container">
    <h1><?php echo $genre["name"]; ?></h1>
</div>

<?php
    include "footer.php"
?>