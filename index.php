<?php 
    include "header.php";

    // Делаем запрос в базу данных и получаем первые 8 фильмов
    // "ORDER BY id" -  сортируем фильмы по столбику id в таблице начиная от 1
    // Записываем все это в переменную $rows.
    
    // Переменная $rows обозначает, что это все строки от 1 до 8 сортированные по id взятые из таблицы data 
    // $rows - это у нас массив данных
    $rows = getDBdata('SELECT * FROM data ORDER BY id LIMIT 8');

    // Чтобы перебрать массив данных можно использовать цикл foreach
    // $rows - это наш массив с данными
    // $row - это каждый элемент в массиве $rows. Внутри цикла $row это каждый элемент в массиве
    // $rows as $row - означает (в массиве $rows перебрать каждый элемент как $row)
    // для $row название может быть любое другое. Но лучше выбирать имена логические, которые соответствуют массиву (т.е. массив $rows - это строки множ.число, $row - это одна строка и т.п.)
    foreach($rows as $row){
        // Внутри цикла перебераем каждоый элемент
        // Команда echo в php означает вывести/показать элемент на странице. Если не напишем echo ничего не покажет
        // Строки в php соединяются точкой ("string1 " . " string") ($var . "string")
        echo $row . "<br>";

        // Однако $row - это переменная является тоже массивом.
        // В $row - это одна строка, но в ней еще есть столбцы(id, title, year, genres, cast, extract, thumbnail)
        // Это тоже массив, но ассоциированный. Т.е. в каждой строке можем получить доступ к каждому столбцу через имя столбца
        echo $row['title'] . "<br>";
        echo $row['year'] . "<br>";
        //... и т.д.
    }
?>

<!-- главный контейнер -->
<div class="container">
    <!-- Нзвание страницы -->
    <h1>Movies</h1>

    <!-- тот же самый массив можно перебирать с хтмл элементами -->
    <!-- и таким способом мы будем часто делать переборы элементов в цикле с хмтл элементами? -->
    <?php foreach($rows as $row) { ?>
        <div><?php echo $row["title"]; ?></div>
    <?php } ?>
    
    
    <!-- ЗАДАЧА!
    Внедрить php цикл в хтмл код ниже, чтобы при загрузке страницы показывало 8 первых фильмов со всеми данными каждого фильма -->

    <!-- контейнер для фильмов -->
    <div id="movies-container" class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-3 g-3">
    <?php foreach($rows as $row) { ?>
        <div class="col">
            <div class="card border border-0 shadow-sm">
                <img src="./images/movie-default.png" class="card-img-top" alt="Movie thumbnail">
                <div class="card-header border border-0"><?php echo $row["genres"]; ?></div>
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <span><?php echo $row["title"]; ?></span>
                        <small class="text-body-tertiary">(<?php echo $row["year"]; ?>)</small>
                    </h5>
                    <h6 class="card-text mb-3 text-secondary"><em><?php echo $row["cast"]; ?></em></h6>
                    <p class="card-text"><?php echo $row["extract"]; ?></p>
                    <button type="button" class="btn btn-primary">
                        Read more...
                    </button>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php 
    include "footer.php";
?>