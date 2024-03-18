<?php 
    include "header.php";

    // Делаем запрос в базу данных и получаем первые 8 фильмов
    // "ORDER BY id" -  сортируем фильмы по столбику id в таблице начиная от 1
    // Записываем все это в переменную дата
    $data = getDBdata('SELECT * FROM data ORDER BY id LIMIT 8');
?>

<!-- главный контейнер -->
<div class="container">
    <!-- Нзвание страницы -->
    <h1>Movies</h1>

    <!-- контейнер для фильмов -->
    <div id="movies-container" class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3 g-3">
        <div class="col">
            <div class="card border border-0 shadow-sm">
                <img src="./images/movie-default.png" class="card-img-top" alt="Movie thumbnail">
                <div class="card-header border border-0">genres</div>
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <span>title</span>
                        <small class="text-body-tertiary">(year)</small>
                    </h5>
                    <h6 class="card-text mb-3 text-secondary"><em>cast</em></h6>
                    <p class="card-text">extract</p>
                    <button type="button" class="btn btn-primary">
                        Read more...
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    include "footer.php";
?>