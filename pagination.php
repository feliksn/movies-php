<?php
// Данные для параметра функции получаем из функции getMovies(), которая определеная в index.php. Так как footer.php это часть страницы и вызываем ее в самом низу index.php, то footer.php так же имеет доступ к переменной $movies, в которую записывается резултать функции getMovies(), т.е. данные фильмов для определенной страницы
$pagination = getPagination($movies["page"], $movies["pages"]);
?>
<!-- контейнер для пагинации -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <!-- ссылка на предыдущую страницу -->
        <li class="page-item <?php echo $pagination["prevPageArrow"]["class"]; ?>">
            <a class="page-link" href="<?php echo $pagination["prevPageArrow"]["link"]; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <!-- ссылка на первую страницу  -->
        <li class="page-item <?php echo $pagination["firstPage"]["class"]; ?>">
            <a class="page-link" href="<?php echo $pagination["firstPage"]["link"]; ?>">
                <?php echo $pagination["firstPage"]["text"]; ?>
            </a>
        </li>
        <!-- пустая ссылка с тремя точками -->
        <li class="page-item disabled <?php echo $pagination["emptyLeft"]["class"]; ?>">
            <span class="page-link">...</span>
        </li>
        <!-- тут будем менять номера постоянных страниц -->
        <li class="page-item <?php echo $pagination["page1"]["class"]; ?>">
            <a class="page-link" href="<?php echo $pagination["page1"]["link"]; ?>">
                <?php echo $pagination["page1"]["text"]; ?>
            </a>
        </li>
        <li class="page-item <?php echo $pagination["page2"]["class"]; ?>">
            <a class="page-link" href="<?php echo $pagination["page2"]["link"]; ?>">
                <?php echo $pagination["page2"]["text"]; ?>
            </a>
        </li>
        <li class="page-item <?php echo $pagination["page3"]["class"]; ?>">
            <a class="page-link" href="<?php echo $pagination["page3"]["link"]; ?>">
                <?php echo $pagination["page3"]["text"]; ?>
            </a>
        </li>
        <!-- пустая ссылка с тремя точками -->
        <li class="page-item disabled <?php echo $pagination["emptyRight"]["class"]; ?>">
            <span class="page-link">...</span>
        </li>
        <!-- ссылка на последнюю страницу -->
        <li class="page-item <?php echo $pagination["lastPage"]["class"]; ?>">
            <a class="page-link" href="<?php echo $pagination["lastPage"]["link"]; ?>">
                <?php echo $pagination["lastPage"]["text"]; ?>
            </a>
        </li>
        <!-- ссылка следующая страница -->
        <li class="page-item <?php echo $pagination["nextPageArrow"]["class"]; ?>">
            <a class="page-link" href="<?php echo $pagination["nextPageArrow"]["link"]; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>