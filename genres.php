<?php 
    include "header.php";
    // Фукния возвращает массив из 4 колонок. Каждая колонка это массив из 11элементов (41/4 = 10.25 = сeil(10.25) = 11)
    $genresCols = getGenresColsData();
?>

<div class="container py-3">
  <div class="row">
    <?php for($i = 0; $i<count($genresCols); $i++) { ?>
      <div class='col'>
        <?php for($j = 0; $j<count($genresCols[$i]); $j++) { ?>
          <div class="row">
            <a href="" class="fs-5 link-offset-1 link-underline link-underline-opacity-25">
              <?php echo $genresCols[$i][$j]['name']; ?>
            </a>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>

<?php
    include "footer.php"
?>