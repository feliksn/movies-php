<?php 
    include "header.php";
    $cast = getCastData();
?>

<div class="container">
    <h1><?php echo $cast["name"]; ?></h1>
</div>

<?php
    include "footer.php"
?>