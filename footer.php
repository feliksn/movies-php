<!-- Задача 11 - Сделать рабочую пагинацию -->
<?php
    // Получить данные из фукнции и применить их к каждому элементу пагинации
    // $pagination = getPagination();
?>
<!-- контейнер для пагинации -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <!-- ссылка на предыдущую страницу -->
        <li class="page-item">
            <a  class="page-link"
                href=""
                aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <!-- ссылка на первую страницу  -->
        <li class="page-item">
            <a  class="page-link"
                href="">
                
            </a>
        </li>
        <!-- пустая ссылка с тремя точками -->
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        <!-- тут будем менять номера постоянных страниц -->
        <li class="page-item">
            <a  class="page-link"
                href="">
                
            </a>
        </li>
        <li class="page-item">
            <a  class="page-link"
                href="">
                
            </a>
        </li>
        <li class="page-item">
            <a  class="page-link"
                href="">
                
            </a>
        </li>
        <!-- пустая ссылка с тремя точками -->
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        <!-- ссылка на последнюю страницу -->
        <li class="page-item">
            <a  class="page-link"
                href="">
                
            </a>
        </li>
        <!-- ссылка следующая страница -->
        <li class="page-item">
            <a  class="page-link"
                href=""
                aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<!-- Поиск страницы -->
<form action="/" method="GET" class="row justify-content-center g-1">
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3" id="btnGoToPage">Go to page</button>
    </div>
    <div class="col-auto">
        <input type="text" name="page" class="form-control input-go-to-page" id="inputGoToPage">
    </div>
</form>


<script src="./lib/bootstrap/bootstrap.bundle.min.js"></script>
<script src="./script.js"></script>
</body>

</html>